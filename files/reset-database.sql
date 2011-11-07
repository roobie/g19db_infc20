use g19db;

-- ================================================================================================
-- DROPS
-- ================================================================================================
DROP TABLE IF EXISTS student_section;
DROP TABLE IF EXISTS section;
DROP TABLE IF EXISTS course_requirements;
DROP TABLE IF EXISTS studies;
DROP TABLE IF EXISTS has_studied;
DROP TABLE IF EXISTS course;
DROP TABLE IF EXISTS student;

-- ================================================================================================
-- CREATES
-- ================================================================================================
CREATE SCHEMA IF NOT EXISTS `g19db` DEFAULT CHARACTER SET utf8 ;
USE `g19db` ;

-- -----------------------------------------------------
-- Table `g19db`.`student`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `g19db`.`student` ;

CREATE  TABLE IF NOT EXISTS `g19db`.`student` (
  `idstudent` INT NOT NULL AUTO_INCREMENT ,
  `social_security_number` VARCHAR(12) NULL ,
  `first_name` VARCHAR(45) NOT NULL ,
  `last_name` VARCHAR(45) NOT NULL ,
  `address` VARCHAR(255) NOT NULL ,
  `phone_number` VARCHAR(45) NOT NULL ,
  `email` VARCHAR(45) NOT NULL ,
  `type` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idstudent`) ,
  UNIQUE INDEX `social_security_number_UNIQUE` (`social_security_number` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `g19db`.`course`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `g19db`.`course` ;

CREATE  TABLE IF NOT EXISTS `g19db`.`course` (
  `idcourse` INT NOT NULL AUTO_INCREMENT ,
  `code` VARCHAR(45) NULL COMMENT '	' ,
  `name` VARCHAR(45) NULL ,
  `points` VARCHAR(5) NULL ,
  PRIMARY KEY (`idcourse`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `g19db`.`course_requirements`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `g19db`.`course_requirements` ;

CREATE  TABLE IF NOT EXISTS `g19db`.`course_requirements` (
  `idcourse` INT NOT NULL ,
  `idcourse_required` INT NOT NULL ,
  PRIMARY KEY (`idcourse`, `idcourse_required`) ,
  INDEX `fk_course` (`idcourse` ASC) ,
  INDEX `fk_course_required` (`idcourse_required` ASC) ,
  CONSTRAINT `fk_course`
    FOREIGN KEY (`idcourse` )
    REFERENCES `g19db`.`course` (`idcourse` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_course_required`
    FOREIGN KEY (`idcourse_required` )
    REFERENCES `g19db`.`course` (`idcourse` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `g19db`.`studies`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `g19db`.`studies` ;

CREATE  TABLE IF NOT EXISTS `g19db`.`studies` (
  `idstudent` INT NOT NULL ,
  `idcourse` INT NOT NULL ,
  PRIMARY KEY (`idstudent`, `idcourse`) ,
  INDEX `fk_student_studies` (`idstudent` ASC) ,
  INDEX `fk_course_studies` (`idcourse` ASC) ,
  CONSTRAINT `fk_student_studies`
    FOREIGN KEY (`idstudent` )
    REFERENCES `g19db`.`student` (`idstudent` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_course_studies`
    FOREIGN KEY (`idcourse` )
    REFERENCES `g19db`.`course` (`idcourse` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `g19db`.`has_studied`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `g19db`.`has_studied` ;

CREATE  TABLE IF NOT EXISTS `g19db`.`has_studied` (
  `idstudent` INT NOT NULL ,
  `idcourse` INT NOT NULL ,
  `grade` VARCHAR(45) NOT NULL ,
  CONSTRAINT CHECK (`grade` IN ('A','B','C','D','E','F','Fx')),
  PRIMARY KEY (`idstudent`, `idcourse`) ,
  INDEX `fk_student_has_studied` (`idstudent` ASC) ,
  INDEX `fk_course_has_studied` (`idcourse` ASC) ,
  CONSTRAINT `fk_student_has_studied`
    FOREIGN KEY (`idstudent` )
    REFERENCES `g19db`.`student` (`idstudent` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_course_has_studied`
    FOREIGN KEY (`idcourse` )
    REFERENCES `g19db`.`course` (`idcourse` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `g19db`.`section`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `g19db`.`section` ;

CREATE  TABLE IF NOT EXISTS `g19db`.`section` (
  `idsection` INT NOT NULL ,
  `idcourse` INT NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idsection`, `idcourse`) ,
  INDEX `fk_course_section` (`idcourse` ASC) ,
  CONSTRAINT `fk_course_section`
    FOREIGN KEY (`idcourse` )
    REFERENCES `g19db`.`course` (`idcourse` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `g19db`.`student_section`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `g19db`.`student_section` ;

CREATE  TABLE IF NOT EXISTS `g19db`.`student_section` (
  `idstudent` INT NOT NULL COMMENT '	' ,
  `idsection` INT NOT NULL ,
  `name` VARCHAR(45) NULL ,
  `description` VARCHAR(45) NULL ,
  `grade` VARCHAR(45) NULL ,
  `points` VARCHAR(5) NULL ,
  CONSTRAINT CHECK (`grade` IN ('A','B','C','D','E','F','Fx')),
  PRIMARY KEY (`idstudent`, `idsection`) ,
  INDEX `fk_s_section_id` (`idsection` ASC) ,
  INDEX `fk_s_student_id` (`idstudent` ASC) ,
  CONSTRAINT `fk_student_section_section`
    FOREIGN KEY (`idsection` )
    REFERENCES `g19db`.`section` (`idsection` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_student_section_student`
    FOREIGN KEY (`idstudent` )
    REFERENCES `g19db`.`student` (`idstudent` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- ================================================================================================
-- ROUTINES
-- ================================================================================================
-- Change DELIMITER
DELIMITER $$

-- Use the correct database
USE g19db $$

-- ===============================================================================================
-- BEGIN defs
-- ===============================================================================================

-- Remove from studies when student + course is inserted in has_studied 
DROP TRIGGER IF EXISTS InsertStudentPassedCourse; $$

CREATE TRIGGER InsertStudentPassedCourse
AFTER INSERT ON has_studied
FOR EACH ROW 
	BEGIN
		IF NEW.grade IN ( 'A', 'B', 'C', 'D', 'E') THEN
			DELETE FROM studies
			WHERE 
			idstudent = NEW.idstudent
			AND
			idcourse = NEW.idcourse;
		END IF;
END; $$


-- Prevent insert in studies when student has passed course
DROP TRIGGER IF EXISTS InsertStudentAlreadyPassedCourse; $$

CREATE TRIGGER InsertStudentAlreadyPassedCourse
BEFORE INSERT ON studies
FOR EACH ROW
	BEGIN
	IF NEW.idstudent IN
		(
			SELECT idstudent
			FROM has_studied h
			WHERE	
					h.idstudent = NEW.idstudent
				AND h.idcourse	= NEW.idcourse
				AND h.grade IN ( 'A', 'B', 'C', 'D', 'E')
		)
	THEN
		UPDATE studies
		SET
			idstudent = null
		WHERE 
			idstudent = NEW.idstudent
			AND
			idcourse = NEW.idcourse
		AND
		RAISE(ROLLBACK, 'The student already has a grade on this course');
	END IF;
END; $$

-- Gets all students that match the search term.
DROP PROCEDURE IF EXISTS GetAllStudents $$

CREATE PROCEDURE GetAllStudents (
	IN term VARCHAR(255)
)
BEGIN
	SELECT
		*
	FROM
		student
	WHERE
		idstudent LIKE term OR
		social_security_number LIKE term OR
		first_name LIKE term OR
		last_name LIKE term OR
		address LIKE term OR
		phone_number LIKE term OR
		email LIKE term OR
		type LIKE term;
END $$

-- updates student by idstudent
DROP PROCEDURE IF EXISTS UpdateStudent $$

CREATE PROCEDURE UpdateStudent (
	IN id VARCHAR(255),
	IN ssn VARCHAR(255),
	IN fname VARCHAR(255),
	IN lname VARCHAR(255),
	IN inaddress VARCHAR(255),
	IN phone VARCHAR(255),
	IN inemail VARCHAR(255),
	IN intype VARCHAR(255)
)
BEGIN
	UPDATE
		student
	SET
		social_security_number = ssn,
		first_name = fname,
		last_name = lname,
		address = inaddress,
		phone_number = phone,
		email = inemail,
		type = intype
	WHERE
		idstudent = id;
END $$

-- insert student
DROP PROCEDURE IF EXISTS InsertStudent $$

CREATE PROCEDURE InsertStudent(
	IN ssn VARCHAR(255),
	IN fname VARCHAR(255),
	IN lname VARCHAR(255),
	IN inaddress VARCHAR(255),
	IN phone VARCHAR(255),
	IN inemail VARCHAR(255),
	IN intype VARCHAR(255)
)
BEGIN
	INSERT INTO
		student
	VALUES (
		null,
		ssn,
		fname,
		lname,
		inaddress,
		phone,
		inemail,
		intype
);
END $$

DROP PROCEDURE IF EXISTS RemoveStudent $$

CREATE PROCEDURE RemoveStudent( IN id VARCHAR (255) )
BEGIN
	DELETE FROM student
	WHERE
		idstudent = id;
END $$

-- insert course
DROP PROCEDURE IF EXISTS InsertCourse $$

CREATE PROCEDURE InsertCourse ( 
	IN incode VARCHAR (255),
	IN inname VARCHAR (255),
	IN inpoints VARCHAR (255)
)
BEGIN
	INSERT INTO course
	VALUES (
		null,
		incode,
		inname,
		inpoints
	);
END $$

-- get all courses matching the terms
DROP PROCEDURE IF EXISTS GetAllCourses $$

CREATE PROCEDURE GetAllCourses (
	IN term VARCHAR (255)
)
BEGIN
	SELECT * FROM course
	WHERE
		idcourse LIKE term OR
		code LIKE term OR
		name LIKE term OR
		points LIKE term;
END $$

-- remove course
DROP PROCEDURE IF EXISTS RemoveCourse $$

CREATE PROCEDURE RemoveCourse ( 
	IN id VARCHAR (255)
)
BEGIN
	DELETE FROM course
	WHERE idcourse = id;
END $$

-- update course
DROP PROCEDURE IF EXISTS UpdateCourse $$

CREATE PROCEDURE UpdateCourse (
	IN id VARCHAR (255),
	IN incode VARCHAR (255),
	IN inname VARCHAR (255),
	IN inpoints VARCHAR (255)
)
BEGIN
	UPDATE course
	SET
		code = incode,
		name = inname,
		points = inpoints
	WHERE
		idcourse = id;
END $$

-- insert studies relationship
DROP PROCEDURE IF EXISTS InsertStudies $$

CREATE PROCEDURE InsertStudies (
	IN inidstudent VARCHAR (255),
	IN inidcourse VARCHAR (255)
)
BEGIN
	INSERT INTO studies
	VALUES (
		inidstudent,
		inidcourse
	);
END $$

-- remove studies relationship
DROP PROCEDURE IF EXISTS RemoveStudies $$

CREATE PROCEDURE RemoveStudies (
	IN inidstudent VARCHAR (255),
	IN inidcourse VARCHAR (255)
)
BEGIN
	DELETE FROM
		studies
	WHERE
		idstudent = inidstudent AND
		idcourse = inidcourse;
END $$

-- update studies relationship
DROP PROCEDURE IF EXISTS UpdateStudies $$

CREATE PROCEDURE UpdateStudies (
	IN inidstudent VARCHAR (255),
	IN inidcourse VARCHAR (255),
	IN inidstudentNEW VARCHAR (255),
	IN inidcourseNEW VARCHAR (255)
)
BEGIN
	UPDATE
		studies
	SET
		idstudent = inidstudentNEW,
		idcourse = inidcourseNEW
	WHERE
		idstudent = inidstudent AND
		idcourse = inidcourse;
END $$


-- get all studies relationship
DROP PROCEDURE IF EXISTS GetAllStudies $$

CREATE PROCEDURE GetAllStudies (
	IN term VARCHAR (255)
)
BEGIN
	SELECT
		*
	FROM
		studies
	WHERE
		idstudent LIKE term AND
		idcourse LIKE term;
END $$

-- insert has_studied relationship
DROP PROCEDURE IF EXISTS InsertHasStudied $$

CREATE PROCEDURE InsertHasStudied (
	IN inidstudent VARCHAR (255),
	IN inidcourse VARCHAR (255),
	IN ingrade VARCHAR(255)
)
BEGIN
	INSERT INTO has_studied
	VALUES (
		inidstudent,
		inidcourse,
		ingrade
	);
END $$

-- remove has_studied relationship
DROP PROCEDURE IF EXISTS RemoveHasStudied $$

CREATE PROCEDURE RemoveHasStudied (
	IN inidstudent VARCHAR (255),
	IN inidcourse VARCHAR (255)
)
BEGIN
	DELETE FROM
		has_studied
	WHERE
		idstudent = inidstudent AND
		idcourse = inidcourse;
END $$

-- update has_studied relationship
DROP PROCEDURE IF EXISTS UpdateHasStudied $$

CREATE PROCEDURE UpdateHasStudied (
	IN inidstudent VARCHAR (255),
	IN inidcourse VARCHAR (255),
	IN ingrade VARCHAR (255),
	IN inidstudentNEW VARCHAR (255),
	IN inidcourseNEW VARCHAR (255)
)
BEGIN
	UPDATE
		has_studied
	SET
		idstudent = inidstudentNEW,
		idcourse = inidcourseNEW,
		grade = ingrade
	WHERE
		idstudent = inidstudent AND
		idcourse = inidcourse;
END $$


-- get all has_studied relationship
DROP PROCEDURE IF EXISTS GetAllHasStudied $$

CREATE PROCEDURE GetAllHasStudied (
	IN term VARCHAR (255)
)
BEGIN
	SELECT
		*
	FROM
		has_studied
	WHERE
		idstudent LIKE term AND
		idcourse LIKE term AND
		grade LIKE term;
END $$



-- ===============================================================================================
-- END defs
-- ===============================================================================================

-- Change back the delimiter!
DELIMITER ;

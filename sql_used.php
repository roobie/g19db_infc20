<?php
	include('includes/functions.php');
	head('SQL Used');
?>

	<script type="text/javascript" src="SyntaxHighlighter/scripts/shBrushSql.js"></script>
	<pre id="sql-code" class="brush: sql;">
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
  `idsection` INT NOT NULL AUTO_INCREMENT ,
  `idcourse` INT NOT NULL ,
  `name` VARCHAR(45) NULL ,
  `description` VARCHAR(45) NULL ,
  `points` VARCHAR(5) NULL ,
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
  `grade` VARCHAR(45) NULL ,
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

-- Change DELIMITER
DELIMITER $$

-- Use the correct database
USE g19db $$

-- ===============================================================================================
-- BEGIN defs
-- ===============================================================================================

-- TRIGGERS
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


-- PROCS
-- ===============================================================================================
-- ===============================================================================================

-- STUDENT
-- ===============================================================================================
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

-- COURSE
-- ===============================================================================================
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


-- STUDIES
-- ===============================================================================================
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


-- HAS_STUDIED
-- ===============================================================================================
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


-- COURSE-REQs
-- ===============================================================================================
-- insert course_requirements relationship
DROP PROCEDURE IF EXISTS InsertCourseRequirements $$

CREATE PROCEDURE InsertCourseRequirements (
	IN inidcourse VARCHAR (255),
	IN inidcourse_req VARCHAR(255)
)
BEGIN
	INSERT INTO course_requirements
	VALUES (
		inidcourse,
		inidcourse_req
	);
END $$

-- remove course_requirements relationship
DROP PROCEDURE IF EXISTS RemoveCourseRequirements $$

CREATE PROCEDURE RemoveCourseRequirements (
	IN inidcourse VARCHAR (255),
	IN inidcourse_req VARCHAR(255)
)
BEGIN
	DELETE FROM
		course_requirements
	WHERE
		idcourse = inidcourse AND
		idcourse_required = inidcourse_req;
END $$

-- update course_requirements relationship
DROP PROCEDURE IF EXISTS UpdateCourseRequirements $$

CREATE PROCEDURE UpdateCourseRequirements (
	IN inidcourse_req VARCHAR (255),
	IN inidcourse VARCHAR (255),
	IN inidcourse_reqNEW VARCHAR (255),
	IN inidcourseNEW VARCHAR (255)
)
BEGIN
	UPDATE
		course_requirements
	SET
		idcourse_required = inidcourse_reqNEW,
		idcourse = inidcourseNEW
	WHERE
		idcourse_required = inidcourse_req AND
		idcourse = inidcourse;
END $$


-- get all course_requirements relationship
DROP PROCEDURE IF EXISTS GetAllCourseRequirements $$

CREATE PROCEDURE GetAllCourseRequirements (
	IN term VARCHAR (255)
)
BEGIN
	SELECT
		*
	FROM
		course_requirements
	WHERE
		idcourse_required LIKE term AND
		idcourse LIKE term;
END $$
DELIMITER $$

-- SECTION
-- ===============================================================================================
-- insert section relationship
DROP PROCEDURE IF EXISTS InsertSection $$

CREATE PROCEDURE InsertSection (
	IN inidcourse VARCHAR (255),
	IN inname VARCHAR(255),
	IN indesc VARCHAR(255),
	IN inpoints VARCHAR(255)
)
BEGIN
	INSERT INTO section
	VALUES (
		null,
		inidcourse,
		inname,
		indesc,
		inpoints
	);
END $$

-- remove section relationship
DROP PROCEDURE IF EXISTS RemoveSection $$

CREATE PROCEDURE RemoveSection (
	IN inidsection VARCHAR (255)
)
BEGIN
	DELETE FROM
		section
	WHERE
		idsection = inidsection;
END $$

-- update section relationship
DROP PROCEDURE IF EXISTS UpdateSection $$

CREATE PROCEDURE UpdateSection (
	IN inidsection VARCHAR (255),
	IN inidcourse VARCHAR (255),
	IN inidsectionNEW VARCHAR (255),
	IN inidcourseNEW VARCHAR (255),
	IN inname VARCHAR (255),
	IN indesc VARCHAR(255),
	IN inpoints VARCHAR(255)
)
BEGIN
	UPDATE
		section
	SET
		idsection = inidsectionNEW,
		idcourse = inidcourseNEW,
		name = inname,
		description = indesc,
		points = inpoints
	WHERE
		idsection = inidsection AND
		idcourse = inidcourse;
END $$


-- get all section relationship
DROP PROCEDURE IF EXISTS GetAllSection $$

CREATE PROCEDURE GetAllSection (
	IN term VARCHAR (255)
)
BEGIN
	SELECT
		*
	FROM
		section
	WHERE
		idsection LIKE term AND
		idcourse LIKE term AND
		name LIKE term AND
		description LIKE term AND
		points LIKE term;
END $$


-- STUDENT_SECTION
-- ===============================================================================================
-- insert student_section relationship
DROP PROCEDURE IF EXISTS InsertStudentSection $$

CREATE PROCEDURE InsertStudentSection (
	IN inidstudent VARCHAR (255),
	IN inidsection VARCHAR(255),
	IN ingrade VARCHAR(255)
)
BEGIN
	INSERT INTO student_section
	VALUES (
		inidstudent,
		inidsection,
		ingrade
	);
END $$

-- remove student_section relationship
DROP PROCEDURE IF EXISTS RemoveStudentSection $$

CREATE PROCEDURE RemoveStudentSection (
	IN inidstudent VARCHAR (255),
	IN inidsection VARCHAR(255)
)
BEGIN
	DELETE FROM
		student_section
	WHERE
		idstudent = inidstudent AND
		idsection = inidsection;
END $$

-- update student_section relationship
DROP PROCEDURE IF EXISTS UpdateStudentSection $$

CREATE PROCEDURE UpdateStudentSection (
	IN inidsection VARCHAR (255),
	IN inidstudent VARCHAR (255),
	IN inidsectionNEW VARCHAR (255),
	IN inidstudentNEW VARCHAR (255),
	IN ingrade VARCHAR(255)
)
BEGIN
	UPDATE
		student_section
	SET
		idsection = inidsectionNEW,
		idstudent = inidstudentNEW,
		grade = ingrade

	WHERE
		idsection = inidsection AND
		idstudent = inidstudent;
END $$


-- get all student_section relationship
DROP PROCEDURE IF EXISTS GetAllStudentSection $$

CREATE PROCEDURE GetAllStudentSection (
	IN term VARCHAR (255)
)
BEGIN
	SELECT
		*
	FROM
		student_section
	WHERE
		idsection LIKE term AND
		idstudent LIKE term AND
		grade LIKE term;
END $$

-- Misc routines
-- ===============================================================================================
DROP PROCEDURE IF EXISTS GetAllPossibleCoursesForStudent $$

CREATE PROCEDURE GetAllPossibleCoursesForStudent (
	IN inidstudent VARCHAR (255)
)
BEGIN
	SELECT
		c.idcourse,
		c.code,
		c.name
	FROM
		course c
	WHERE
		c.idcourse NOT IN (
			SELECT r.idcourse
			FROM course_requirements r
		)
	
	UNION
	
	SELECT
		c.idcourse,
		c.code,
		c.name
	FROM (
		SELECT
			r.idcourse AS courseid,
			h.idstudent
		FROM
			course_requirements r, has_studied h
		WHERE
			r.idcourse_required = h.idcourse
		GROUP BY
			r.idcourse,
			h.grade
		HAVING
			h.grade IN ('A', 'B', 'C', 'D', 'E') AND
			h.idstudent = inidstudent
	) AS T1, course c
	WHERE
		T1.courseid = c.idcourse
	GROUP BY
		c.idcourse;
END $$

-- get all studies relationship by courseid
DROP PROCEDURE IF EXISTS GetAllStudiesByCourseID $$

CREATE PROCEDURE GetAllStudiesByCourseID (
	IN inidcourse VARCHAR (255)
)
BEGIN
	SELECT
		idstudent
	FROM
		studies
	WHERE
		idcourse = inidcourse;
END $$

-- get all section -> course relationship by courseid
DROP PROCEDURE IF EXISTS GetAllSectionsByCourseID $$

CREATE PROCEDURE GetAllSectionsByCourseID (
	IN inidcourse VARCHAR (255)
)
BEGIN
	SELECT
		idsection
	FROM
		section
	WHERE
		idcourse = inidcourse;
END $$

-- ===============================================================================================
-- END defs
-- ===============================================================================================

-- Change back the delimiter!
DELIMITER ;

-- ===============================================================================================
-- BEGIN test data insert
-- ===============================================================================================

-- STUDENT
INSERT INTO student VALUES (null, '8504039536', 'Lighthouses', 'Moller', 'Gibe Rd 24', '+46075-304-17-46', 'Embody@Testings.com', 'domestic');
INSERT INTO student VALUES (null, null, 'Tame', 'Lothario', 'Solely Rd 51', '+46075-551-86-16', 'Dope@Armload.dk', 'foreign');
INSERT INTO student VALUES (null, '8012135513', 'Shim', 'Denverite', 'Sexes Rd 58', '+46075-278-23-55', 'Keen@Teamwork.com', 'domestic');
INSERT INTO student VALUES (null, '7908261586', 'Staggering', 'Possibly', 'Saran Rd 70', '+46070-563-41-81', 'Aware@Whether.no', 'domestic');
INSERT INTO student VALUES (null, '7907145160', 'Eulogizers', 'Direction', 'Argive Rd 7', '+46076-089-67-98', 'Nondriver@Stingy.se', 'domestic');
INSERT INTO student VALUES (null, '7903047567', 'Bedtime', 'Brushcut', 'Dentures Rd 41', '+46079-691-14-60', 'Sketchbook@Underwriter.com', 'domestic');
INSERT INTO student VALUES (null, '8611023240', 'Unlinked', 'Phase', 'Leaped Rd 40', '+46077-619-93-62', 'Stratford@Confessions.no', 'domestic');
INSERT INTO student VALUES (null, '7909124690', 'Poet\'s', 'Images', 'Zeros Rd 65', '+46076-583-48-51', 'Disservice@Romp.se', 'domestic');
INSERT INTO student VALUES (null, '8109163698', 'Acclaims', 'Shan', 'Blotting Rd 26', '+46077-240-98-41', 'Buttery@Deutsche.no', 'domestic');
INSERT INTO student VALUES (null, '8307289615', 'Decca', 'Clubbed', 'Cards Rd 35', '+46072-596-24-92', 'Rotelli@Finney\'s.se', 'domestic');
INSERT INTO student VALUES (null, '9001158365', 'Dumpty', 'Aseptic', 'Callin Rd 85', '+46078-743-24-37', 'Catholics@Screened.com', 'domestic');
INSERT INTO student VALUES (null, '9201013245', 'Palmed', 'Arty', 'Metabolic Rd 22', '+46075-073-02-19', 'Championship@Kent.dk', 'domestic');
INSERT INTO student VALUES (null, '9004142495', 'Mermaid', 'Lineman', 'Discriminate Rd 85', '+46071-921-02-45', 'Loneliness@Chroniclers.no', 'domestic');
INSERT INTO student VALUES (null, '9206041460', 'Shipley', 'Acala', 'Interest Rd 92', '+46074-803-15-58', 'Indian\'s@Neared.no', 'domestic');
INSERT INTO student VALUES (null, '8212194536', 'Deepest', 'Sugar', 'Desensitized Rd 37', '+46070-610-02-07', 'Handsomer@Urban.no', 'domestic');
INSERT INTO student VALUES (null, '9009119728', 'Tumors', 'Froid', 'Gothicism Rd 52', '+46072-506-56-06', 'Perceptiveness@Bleeps.com', 'domestic');
INSERT INTO student VALUES (null, '8502227131', 'Vicky', 'Kindest', 'Champs Rd 93', '+46078-197-82-70', 'Publishers@Escutcheon.se', 'domestic');
INSERT INTO student VALUES (null, '7707037082', 'Inference', 'Imperial', 'Dictate Rd 99', '+46071-477-54-49', 'Fumbled@Grassers.dk', 'domestic');
INSERT INTO student VALUES (null, '9210268330', 'Reverend', 'Waffles', 'Gaspingly Rd 28', '+46071-473-98-02', 'Beige\'s@Bruckner.net', 'domestic');
INSERT INTO student VALUES (null, '8912234088', 'Adapting', 'Gnp', 'Unmistakably Rd 77', '+46070-190-98-80', 'Sweepstakes@Premonitions.net', 'domestic');
INSERT INTO student VALUES (null, '7701282329', 'Gateways', 'Accords', 'Tantamount Rd 84', '+46073-691-57-40', 'Boobify@Mooed.no', 'domestic');
INSERT INTO student VALUES (null, '9109038940', 'Bragged', 'Boonton', 'Cams Rd 7', '+46076-278-37-91', 'Reciprocate@Wove.com', 'domestic');
INSERT INTO student VALUES (null, '9212075929', 'Shies', 'Raftered', 'Davidson\'s Rd 65', '+46074-364-07-36', 'Polybutene@Cocked.no', 'domestic');
INSERT INTO student VALUES (null, '8406088835', 'Developmental', 'Septa', 'Lawrence Rd 93', '+46076-006-02-17', 'Borderlands@Pixies.net', 'domestic');
INSERT INTO student VALUES (null, '7601252802', 'Hwa', 'Pavement', 'Ello Rd 57', '+46074-699-12-83', 'Ministered@Dramatizing.net', 'domestic');
INSERT INTO student VALUES (null, '9204221265', 'O\'brien', 'Chided', 'Olson Rd 48', '+46076-197-18-90', 'Asthma@Folsom.se', 'domestic');
INSERT INTO student VALUES (null, null, 'Gyration', 'Wishful', 'Accessory Rd 38', '+46070-250-53-10', 'Herb@Follicular.se', 'foreign');
INSERT INTO student VALUES (null, '7506202753', 'Infiltration', 'Soon\'s', 'Hypothetical Rd 25', '+46075-860-40-72', 'Rooted@Reexamination.no', 'domestic');
INSERT INTO student VALUES (null, '9202115720', 'Bailly', 'Punishments', 'Chronologically Rd 70', '+46073-163-53-58', 'Amaral@Marcel\'s.com', 'domestic');
INSERT INTO student VALUES (null, '8510171053', 'Modality', 'Clutch', 'Throats Rd 100', '+46070-820-06-54', 'Folly@Addressed.com', 'domestic');
INSERT INTO student VALUES (null, '7910278393', 'Diet', 'Pullings', 'Spaniel\'s Rd 10', '+46072-768-52-93', 'Gute@Maps.net', 'domestic');
INSERT INTO student VALUES (null, '7508171593', 'Seasoned', 'Respiratory', 'Gonzalez Rd 49', '+46072-704-59-36', 'Striding@Aryl.no', 'domestic');
INSERT INTO student VALUES (null, '8805193643', 'Affirming', 'Earsplitting', 'Aforesaid Rd 16', '+46077-977-53-87', 'Catsup@Allegedly.net', 'domestic');
INSERT INTO student VALUES (null, '7604066686', 'Koreans', 'Slackening', 'Ionizing Rd 79', '+46074-052-32-59', 'Meringue@Candle.com', 'domestic');
INSERT INTO student VALUES (null, '7511085846', 'Persisted', 'Exciting', 'Rebuffed Rd 64', '+46074-635-95-12', 'Adventitious@Waisted.com', 'domestic');
INSERT INTO student VALUES (null, '8307208636', 'Lynched', 'Ceramic', 'Imaginations Rd 58', '+46073-903-83-90', 'Hitched@More\'s.no', 'domestic');
INSERT INTO student VALUES (null, '9012138167', 'Riotous', 'Trempler', 'Holding Rd 49', '+46071-095-66-44', 'Gunther@Tact.com', 'domestic');
INSERT INTO student VALUES (null, null, 'Idaho', 'Capitalists', 'Pulmonary Rd 85', '+46076-775-71-32', 'Insulator@Variability.no', 'foreign');
INSERT INTO student VALUES (null, '8208151709', 'Refrigerated', 'Cleaved', 'Pawtucket Rd 15', '+46071-534-58-40', 'Ass@Greenfield.dk', 'domestic');
INSERT INTO student VALUES (null, '8008169957', 'Means\'s', 'Electronography', 'Goddamn Rd 61', '+46072-957-50-78', 'Askin@Moody.dk', 'domestic');
INSERT INTO student VALUES (null, '8904174720', 'Purified', 'Mayor', 'Drunks Rd 51', '+46076-358-90-86', 'Browne@Peaceful.net', 'domestic');
INSERT INTO student VALUES (null, '9211275975', 'Equatorial', 'Quipping', 'Postgraduate Rd 87', '+46070-308-76-28', 'Segregating@Silone.se', 'domestic');
INSERT INTO student VALUES (null, '9211069130', 'Auspiciously', 'Johnny', 'Audited Rd 94', '+46071-911-70-76', 'Kelts@Ticket.se', 'domestic');
INSERT INTO student VALUES (null, '8407193037', 'Curled', 'Deafened', 'Selective Rd 86', '+46075-515-43-44', 'Erudite@Delaware.net', 'domestic');

-- COURSE
INSERT INTO course VALUES (null, 'INF663', 'Translations', '5.0');
INSERT INTO course VALUES (null, 'EKO704', 'Kimberly', '7.5');
INSERT INTO course VALUES (null, 'EKO948', 'Eatables', '10.0');
INSERT INTO course VALUES (null, 'LIT113', 'Differentiability', '15.0');
INSERT INTO course VALUES (null, 'INF689', 'Musta', '5.0');
INSERT INTO course VALUES (null, 'INF831', 'Dismay', '5.0');
INSERT INTO course VALUES (null, 'FIL584', 'Distract', '10.0');
INSERT INTO course VALUES (null, 'FIL442', 'Chantey', '7.5');
INSERT INTO course VALUES (null, 'EKO504', 'Tailback', '7.5');
INSERT INTO course VALUES (null, 'FIL969', 'Appreciable', '5.0');
INSERT INTO course VALUES (null, 'FIL384', 'Fireworks', '15.0');
INSERT INTO course VALUES (null, 'LIT705', 'Dehaviland', '10.0');
INSERT INTO course VALUES (null, 'LIT125', 'Unjacketed', '7.5');

-- COURSE REQS
INSERT INTO course_requirements (idcourse, idcourse_required) VALUES ('6', '5');
INSERT INTO course_requirements (idcourse, idcourse_required) VALUES ('6', '1');
INSERT INTO course_requirements (idcourse, idcourse_required) VALUES ('10', '7');
INSERT INTO course_requirements (idcourse, idcourse_required) VALUES ('11', '10');
INSERT INTO course_requirements (idcourse, idcourse_required) VALUES ('12', '8');
INSERT INTO course_requirements (idcourse, idcourse_required) VALUES ('2', '4');

-- STUDIES
INSERT INTO studies (`idstudent`,`idcourse`) VALUES ('3', '1');
INSERT INTO studies (`idstudent`,`idcourse`) VALUES ('4', '5');
INSERT INTO studies (`idstudent`,`idcourse`) VALUES ('5', '7');
INSERT INTO studies (`idstudent`,`idcourse`) VALUES ('6', '5');
INSERT INTO studies (`idstudent`,`idcourse`) VALUES ('7', '1');
INSERT INTO studies (`idstudent`,`idcourse`) VALUES ('3', '3');
INSERT INTO studies (`idstudent`,`idcourse`) VALUES ('8', '3');
INSERT INTO studies (`idstudent`,`idcourse`) VALUES ('9', '9');
INSERT INTO studies (`idstudent`,`idcourse`) VALUES ('10', '13');
INSERT INTO studies (`idstudent`,`idcourse`) VALUES ('11', '9');

-- HAS_STUDIED
INSERT INTO has_studied (`idstudent`,`idcourse`,`grade`) VALUES ('1', '1', 'A');
INSERT INTO has_studied (`idstudent`,`idcourse`,`grade`) VALUES ('1', '5', 'C');
INSERT INTO has_studied (`idstudent`,`idcourse`,`grade`) VALUES ('2', '7', 'A');
INSERT INTO has_studied (`idstudent`,`idcourse`,`grade`) VALUES ('2', '5', 'C');
INSERT INTO has_studied (`idstudent`,`idcourse`,`grade`) VALUES ('2', '1', 'F');

-- SECTIONS
INSERT INTO section (`idcourse`, `name`, `description`, `points`) VALUES ('4', 'Exam', 'desc', '7.5');
INSERT INTO section (`idcourse`, `name`, `description`, `points`) VALUES ('4', 'Handin', 'desc', '7.5');
INSERT INTO section (`idcourse`, `name`, `description`, `points`) VALUES ('11', 'Exam', 'desc', '7.5');
INSERT INTO section (`idcourse`, `name`, `description`, `points`) VALUES ('11', 'Handin', 'desc', '7.5');
INSERT INTO section (`idcourse`, `name`, `description`, `points`) VALUES ('12', 'Exam', 'desc', '5.0');
INSERT INTO section (`idcourse`, `name`, `description`, `points`) VALUES ('12', 'Handin', 'desc', '5.0');


-- ===============================================================================================
-- END test data insert
-- ===============================================================================================

	</pre>
	
<?php
	foot();
?>

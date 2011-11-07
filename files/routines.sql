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
DROP PROCEDURE GetAllStudents $$

CREATE PROCEDURE GetAllStudents (IN term VARCHAR(255) )
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
	IN id VARCHAR (255),
	IN incode VARCHAR (255),
	IN inname VARCHAR (255),
	IN inpoints VARCHAR (255)
)
BEGIN
	SELECT * FROM course
	WHERE
		idcourse LIKE id OR
		code LIKE incode OR
		name LIKE inname OR
		inponts LIKE inpoints;
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
	INSERT INTO course
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
		course
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
		course
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
	IN inidstudent VARCHAR (255),
	IN inidcourse VARCHAR (255)
)
BEGIN
	SELECT
		*
	FROM
		studies
	WHERE
		idstudent LIKE inidstudent AND
		idcourse LIKE inidcourse;
END $$



-- ===============================================================================================
-- END defs
-- ===============================================================================================

-- Change back the delimiter!
DELIMITER ;

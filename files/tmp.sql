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

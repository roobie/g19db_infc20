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
		st.idstudent, st.first_name, st.last_name
	FROM
		studies s, student st
	WHERE
		s.idstudent = st.idstudent AND 
		s.idcourse = inidcourse;
END $$

-- get all studies relationship by courseid
DROP PROCEDURE IF EXISTS GetStudentByID $$

CREATE PROCEDURE GetStudentByID (
	IN inidstudent VARCHAR (255)
)
BEGIN
	SELECT
		idstudent
	FROM
		student
	WHERE
		idstudent = inidstudent;
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

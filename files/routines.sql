-- Change DELIMITER
DELIMITER $$

-- Use the correct database
USE g19db $$

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


-- Change back the delimiter!
DELIMITER ;

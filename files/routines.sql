-- Remove from studies when student + course is inserted in has studied 
DELIMITER $$

DROP TRIGGER IF EXISTS insert_student_passed_course; $$

CREATE TRIGGER insert_student_passed_course
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
DROP TRIGGER IF EXISTS insert_student_already_passed_course; $$

CREATE TRIGGER insert_student_already_passed_course
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


-- blegh.. Name says it all...
DROP PROCEDURE IF EXISTS `g19db`.`view_ten_youngest_students`; $$

CREATE PROCEDURE `g19db`.`view_ten_youngest_students` ()
BEGIN
	SELECT *
	FROM student
	WHERE social_security_number IS NOT NULL
	ORDER BY social_security_number DESC
	LIMIT 10;
END $$


-- returns students that have passed all their courses
DROP PROCEDURE IF EXISTS `g19db`.`students_with_no_fails`; $$

CREATE PROCEDURE `g19db`.`students_with_no_fails` ()
BEGIN
	SELECT e.idstudent
	FROM student e
	WHERE e.idstudent IN (
		SELECT s.idstudent
		FROM student s, has_studied h
		WHERE s.idstudent = h.idstudent
		GROUP BY s.idstudent
		HAVING h.grade IN ( 'A', 'B', 'C', 'D', 'E')
	);
END $$
DROP PROCEDURE IF EXISTS GetAllPossibleCoursesForStudent $$

CREATE PROCEDURE GetAllPossibleCourses (
	IN inidstudent VARCHAR (255)
)
BEGIN
	SELECT
		h.idstudent,
		c.idcourse AS applicable_courses
	FROM
		has_studied h, course_requirements c
	WHERE
		h.idstudent = inidstudent
		h.idcourse = c.idcourse_required AND
		h.idstudent NOT IN (
			SELECT
				h.idstudent
			FROM
				has_studied h
			WHERE
				h.grade IN ('F', 'Fx')
		)
	GROUP BY h.idstudent,	c.idcourse
END $$
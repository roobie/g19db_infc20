<?php
	
	require 'database_props.php';

	ini_set('display_errors', 'On');
	error_reporting(E_ALL | E_STRICT);
	try {
		$db = new PDO($pdo_connection_string, $user, $password);

		//====================================================================
		// TABLE DROPS && DEFS
		//====================================================================
		
		//--- BEGIN:	DROPS ---
		
		$db->query("DROP TABLE IF EXISTS student_section");
		

		$db->query("DROP TABLE IF EXISTS section");
		
		
		$db->query("DROP TABLE IF EXISTS course_requirements");
		
		
		$db->query("DROP TABLE IF EXISTS studies");
		
		
		$db->query("DROP TABLE IF EXISTS has_studied");
		
		
		$db->query("DROP TABLE IF EXISTS course");
		
		
		$db->query("DROP TABLE IF EXISTS student");
		
		
		//--- END:		DROPS ---
		
		//--------------------------------------------------------------------
		
		$db->query("CREATE  TABLE IF NOT EXISTS `g19db`.`student` (
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
				ENGINE = InnoDB");
		

		//---
		
		$db->query("CREATE  TABLE IF NOT EXISTS `g19db`.`course` (
				  `idcourse` INT NOT NULL AUTO_INCREMENT ,
				  `code` VARCHAR(45) NULL COMMENT '	' ,
				  `name` VARCHAR(45) NULL ,
				  `points` VARCHAR(5) NOT NULL ,
				  PRIMARY KEY (`idcourse`) )
				ENGINE = InnoDB");
		
		
		//---
		
		$db->query("CREATE  TABLE IF NOT EXISTS `g19db`.`section` (
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
				ENGINE = InnoDB");
		
		
		//---
		
		$db->query("CREATE  TABLE IF NOT EXISTS `g19db`.`student_section` (
					  `idstudent` INT NOT NULL COMMENT '	' ,
					  `idsection` INT NOT NULL ,
					  `name` VARCHAR(45) NULL ,
					  `description` VARCHAR(45) NULL ,
					  `grade` VARCHAR(45) NULL ,
					  `points` VARCHAR(5) NULL ,
					  PRIMARY KEY (`idstudent`, `idsection`) ,
					  INDEX `fk_section_assignment` (`idsection` ASC) ,
					  INDEX `fk_student_assignments` (`idstudent` ASC) ,
					  CONSTRAINT `fk_section_assignment`
					    FOREIGN KEY (`idsection` )
					    REFERENCES `g19db`.`section` (`idsection` )
					    ON DELETE NO ACTION
					    ON UPDATE NO ACTION,
					  CONSTRAINT `fk_student_assignments`
					    FOREIGN KEY (`idstudent` )
					    REFERENCES `g19db`.`student` (`idstudent` )
					    ON DELETE NO ACTION
					    ON UPDATE NO ACTION)
					ENGINE = InnoDB");
		
		
		//---
		
		$db->query("CREATE  TABLE IF NOT EXISTS `g19db`.`course_requirements` (
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
				ENGINE = InnoDB");
		
		
		//---
		
		$db->query("CREATE  TABLE IF NOT EXISTS `g19db`.`studies` (
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
				ENGINE = InnoDB");
		
		
		//---
		
		$db->query("CREATE  TABLE IF NOT EXISTS `g19db`.`has_studied` (
				  `idstudent` INT NOT NULL ,
				  `idcourse` INT NOT NULL ,
				  `grade` VARCHAR(45) NOT NULL ,
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
				ENGINE = InnoDB");
		
		$db->query("
		DELIMITER $$

		DROP PROCEDURE IF EXISTS view_ten_youngest_students; $$

		CREATE PROCEDURE `g19db`.`view_ten_youngest_students` ()
		BEGIN
			SELECT *
			FROM student
			WHERE social_security_number IS NOT NULL
			ORDER BY social_security_number DESC
			LIMIT 10;
		END $$");
		
		$db->query("
		DELIMITER $$

		DROP PROCEDURE IF EXISTS students_with_no_fails; $$

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
		END $$");
		
		//--- END:		CREATES ---
		
		//====================================================================

		// RELEASE THE connection
		$db = null;
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		echo "Error!: " . $e->getMessage() . "<br/>";
		$e;
		
		header("Location: application.php?error=" . $e->getMessage() );
	}
	
	// Redirects to the referring page.
	if (header("Location: ".$_SERVER["HTTP_REFERER"]) == 'localhost') {
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}
	

?>

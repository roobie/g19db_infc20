<?php
	
	$user="g19usr";
	$password="group19";
	$database="g19db";
	mysql_connect('localhost',$user,$password);
	@mysql_select_db($database) or die( "Unable to select database");
	
	//=========================================================================
	// TABLE DROPS && DEFS
	//=========================================================================
	
	//--- BEGIN:	DROPS ---
	
	$query="DROP TABLE assignments";
	mysql_query($query);
	
	$query="DROP TABLE section";
	mysql_query($query);
	
	$query="DROP TABLE course_requirements";
	mysql_query($query);
	
	$query="DROP TABLE studies";
	mysql_query($query);
	
	$query="DROP TABLE has_studied";
	mysql_query($query);
	
	$query="DROP TABLE course";
	mysql_query($query);
	
	$query="DROP TABLE student";
	mysql_query($query);
	
	//--- END:		DROPS ---
	//--- BEGIN:	CREATES ---
	
	$query="";
	mysql_query($query);

	//---
	
	$query="CREATE  TABLE IF NOT EXISTS `g19db`.`student` (
			  `idstudent` INT NOT NULL AUTO_INCREMENT ,
			  `social_secutiry_number` INT(12) NULL ,
			  `first_name` VARCHAR(45) NOT NULL ,
			  `last_name` VARCHAR(45) NOT NULL ,
			  `address` VARCHAR(255) NOT NULL ,
			  `phone_number` VARCHAR(45) NOT NULL ,
			  `email` VARCHAR(45) NOT NULL ,
			  `type` VARCHAR(45) NOT NULL ,
			  PRIMARY KEY (`idstudent`) ,
			  UNIQUE INDEX `social_secutiry_number_UNIQUE` (`social_secutiry_number` ASC) )
			ENGINE = InnoDB";
	mysql_query($query);

	//---
	
	$query="CREATE  TABLE IF NOT EXISTS `g19db`.`course` (
			  `idcourse` INT NOT NULL AUTO_INCREMENT ,
			  `code` VARCHAR(45) NULL COMMENT '	' ,
			  `name` VARCHAR(45) NULL ,
			  PRIMARY KEY (`idcourse`) )
			ENGINE = InnoDB";
	mysql_query($query);
	
	//---
	
	$query="CREATE  TABLE IF NOT EXISTS `g19db`.`section` (
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
			ENGINE = InnoDB";
	mysql_query($query);
	
	//---
	
	$query="CREATE  TABLE IF NOT EXISTS `g19db`.`assigments` (
			  `idassigments` INT NOT NULL COMMENT '	' ,
			  `idsection` INT NOT NULL ,
			  `name` VARCHAR(45) NULL ,
			  `description` VARCHAR(45) NULL ,
			  PRIMARY KEY (`idassigments`, `idsection`) ,
			  INDEX `fk_section_assignment` (`idsection` ASC) ,
			  CONSTRAINT `fk_section_assignment`
			    FOREIGN KEY (`idsection` )
			    REFERENCES `g19db`.`section` (`idsection` )
			    ON DELETE NO ACTION
			    ON UPDATE NO ACTION)
			ENGINE = InnoDB";
	mysql_query($query);
	
	//---
	
	$query="CREATE  TABLE IF NOT EXISTS `g19db`.`course_requirements` (
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
			ENGINE = InnoDB";
	mysql_query($query);
	
	//---
	
	$query="CREATE  TABLE IF NOT EXISTS `g19db`.`studies` (
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
			ENGINE = InnoDB";
	mysql_query($query);
	
	//---
	
	$query="CREATE  TABLE IF NOT EXISTS `g19db`.`has_studied` (
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
			ENGINE = InnoDB";
	mysql_query($query);
	
	//--- END:		CREATES ---
	
	//=========================================================================
	
	mysql_close();
	
	// Redirects to the referring page.
	if (header("Location: ".$_SERVER["HTTP_REFERER"]) == 'localhost') {
			header("Location: ".$_SERVER["HTTP_REFERER"]);
	}
	

?>
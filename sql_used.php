<?php
	include('includes/functions.php');
	head('SQL Used');
?>

	<script type="text/javascript" src="SyntaxHighlighter/scripts/shBrushSql.js"></script>
	<pre id="sql-code" class="brush: sql;">
	
CREATE SCHEMA IF NOT EXISTS `g19db` DEFAULT CHARACTER SET utf8;
USE `g19db`;

-- -----------------------------------------------------
-- Table `g19db`.`student`
-- -----------------------------------------------------

DROP TABLE IF EXISTS `g19db`.`student`;

CREATE  TABLE IF NOT EXISTS `g19db`.`student` (
	`idstudent` INT NOT NULL AUTO_INCREMENT ,
	`social_secutiry_number` VARCHAR(12) NULL ,
	`first_name` VARCHAR(45) NOT NULL ,
	`last_name` VARCHAR(45) NOT NULL ,
	`address` VARCHAR(255) NOT NULL ,
	`phone_number` VARCHAR(45) NOT NULL ,
	`email` VARCHAR(45) NOT NULL ,
	`type` VARCHAR(45) NOT NULL ,
	PRIMARY KEY (`idstudent`) ,
	UNIQUE INDEX `social_secutiry_number_UNIQUE` (`social_secutiry_number` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `g19db`.`course`
-- -----------------------------------------------------

DROP TABLE IF EXISTS `g19db`.`course`;

CREATE  TABLE IF NOT EXISTS `g19db`.`course` (
	`idcourse` INT NOT NULL AUTO_INCREMENT ,
	`code` VARCHAR(45) NULL COMMENT '	' ,
	`name` VARCHAR(45) NULL ,
	PRIMARY KEY (`idcourse`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `g19db`.`course_requirements`
-- -----------------------------------------------------

DROP TABLE IF EXISTS `g19db`.`course_requirements ;

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

DROP TABLE IF EXISTS `g19db`.`studies`;

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

DROP TABLE IF EXISTS `g19db`.`has_studied`;

CREATE  TABLE IF NOT EXISTS `g19db`.`has_studied` (
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
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `g19db`.`section`
-- -----------------------------------------------------

DROP TABLE IF EXISTS `g19db`.`section`;

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

DROP TABLE IF EXISTS `g19db`.`student_section`;

CREATE  TABLE IF NOT EXISTS `g19db`.`student_section` (
	`idstudent` INT NOT NULL COMMENT '	' ,
	`idsection` INT NOT NULL ,
	`name` VARCHAR(45) NULL ,
	`description` VARCHAR(45) NULL ,
	`grade` VARCHAR(45) NULL ,
	`points` VARCHAR(5) NULL ,
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
	</pre>
	
<?php
	foot();
?>

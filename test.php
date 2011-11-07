<?php 
	include('includes/functions.php');
	head('Documentation');
?>

		<script type="text/javascript">

			// Add CSS to hyperlight dynamically, so not all pages get this.
			$(function() {
				$('head').append('<link rel="stylesheet" type="text/css" href="colors/lightness.css">');
			});
		</script>
		
		<blockquote class="all-rounded ui-widget">
			<?php 
				require(dirname(__FILE__) . '/hyperlight/hyperlight.php');
				
				hyperlight('
					$BASE_PATH = dirname(__FILE__);
					$DEPENDS_PATH  = ".;".$BASE_PATH;
					$DEPENDS_PATH .= ";".$BASE_PATH."/lib";
					$DEPENDS_PATH .= ";".$BASE_PATH."/test";
					ini_set("include_path", ini_get("include_path").";".$DEPENDS_PATH);
					?>', 'php');
			;?>
		</blockquote>
		
		<div id="sql-test">
			<?php
				define("PARSER_LIB_ROOT", dirname(__FILE__) . "/sqlparserlib/");
				require_once PARSER_LIB_ROOT."sqlparser.lib.php";
				
				function SQLFormatPHP($in) {
					return PMA_SQP_formatHtml(PMA_SQP_parse($in), 'text');
				}

				$sql = <<<EOB
					CREATE TABLE IF NOT EXISTS `g19db`.`student` (
					  	`idstudent` INT NOT NULL AUTO_INCREMENT ,
					  	`social_security_number` INT(12) NULL ,
						`first_name` VARCHAR(45) NOT NULL ,
						`last_name` VARCHAR(45) NOT NULL ,
						`address` VARCHAR(255) NOT NULL ,
						`phone_number` VARCHAR(45) NOT NULL ,
						`email` VARCHAR(45) NOT NULL ,
						`type` VARCHAR(45) NOT NULL ,
						PRIMARY KEY (`idstudent`) ,
						UNIQUE INDEX `social_security_number_UNIQUE` (`social_security_number` ASC) )
						ENGINE = InnoDB;

					CREATE TABLE IF NOT EXISTS `g19db`.`course` (
						`idcourse` INT NOT NULL AUTO_INCREMENT ,
						`code` VARCHAR(45) NULL COMMENT '	' ,
						`name` VARCHAR(45) NULL ,
						PRIMARY KEY (`idcourse`) )
						ENGINE = InnoDB;

					CREATE TABLE IF NOT EXISTS `g19db`.`section` (
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

					CREATE TABLE IF NOT EXISTS `g19db`.`assigments` (
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
						ENGINE = InnoDB;

					CREATE TABLE IF NOT EXISTS `g19db`.`course_requirements` (
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

					CREATE TABLE IF NOT EXISTS `g19db`.`studies` (
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

					CREATE TABLE IF NOT EXISTS `g19db`.`has_studied` (
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
EOB;

				SQLFormatPHP($sql);
			?>
		</div>
		
<?php
	foot();
?>

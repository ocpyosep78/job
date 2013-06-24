2013-06-08 :
CREATE TABLE  `job_db`.`article_status` ( `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , `nama` VARCHAR( 200 ) NOT NULL ) ENGINE = MYISAM ;

2013-06-10 :
CREATE TABLE `job_db`.`editor` ( `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , `nama` VARCHAR( 255 ) NOT NULL , `email` VARCHAR( 255 ) NOT NULL , `passwd` VARCHAR( 255 ) NOT NULL ) ENGINE = MYISAM ;
CREATE TABLE  `job_db`.`widget` ( `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , `nama` VARCHAR( 255 ) NOT NULL , `content` LONGTEXT NOT NULL ) ENGINE = MYISAM ; 
ALTER TABLE  `widget` ADD  `alias` VARCHAR( 255 ) NOT NULL AFTER  `nama`;

2013-06-11 :
CREATE TABLE  `job_db`.`vacancy_status` ( `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , `nama` VARCHAR( 100 ) NOT NULL ) ENGINE = MYISAM ;
CREATE TABLE `job_db`.`seeker_summary` ( `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , `seeker_id` INT NOT NULL , `jenjang_id` INT NOT NULL , `score` FLOAT NOT NULL , `location` VARCHAR( 255 ) NOT NULL , `experience` VARCHAR( 255 ) NOT NULL ) ENGINE = MYISAM ;

2013-06-15 :
CREATE TABLE  `job_db`.`seeker_language` ( `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , `seeker_id` INT NOT NULL , `nama` VARCHAR( 255 ) NOT NULL , `lisan` VARCHAR( 255 ) NOT NULL , `tulis` VARCHAR( 255 ) NOT NULL ) ENGINE = MYISAM ;

2013-06-21 :
ALTER TABLE `company_membership` CHANGE `status` `status` INT( 11 ) NOT NULL COMMENT '{ 0: pending, 1: confirm, 2: delete }';
ALTER TABLE `company` ADD `vacancy_count_left` INT NOT NULL , ADD `membership_date` DATE NOT NULL;

2013-06-24 :
ALTER TABLE  `seeker` ADD  `validation` VARCHAR( 255 ) NOT NULL, ADD  `is_active` INT NOT NULL;
ALTER TABLE  `company` ADD  `validation` VARCHAR( 255 ) NOT NULL, ADD  `is_active` INT NOT NULL;
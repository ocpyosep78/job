2013-06-08 :
CREATE TABLE  `job_db`.`article_status` ( `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , `nama` VARCHAR( 200 ) NOT NULL ) ENGINE = MYISAM ;

2013-06-10 :
CREATE TABLE `job_db`.`editor` ( `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , `nama` VARCHAR( 255 ) NOT NULL , `email` VARCHAR( 255 ) NOT NULL , `passwd` VARCHAR( 255 ) NOT NULL ) ENGINE = MYISAM ;
CREATE TABLE  `job_db`.`widget` ( `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , `nama` VARCHAR( 255 ) NOT NULL , `content` LONGTEXT NOT NULL ) ENGINE = MYISAM ; 
ALTER TABLE  `widget` ADD  `alias` VARCHAR( 255 ) NOT NULL AFTER  `nama`;

2013-06-11 :
CREATE TABLE  `job_db`.`vacancy_status` ( `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , `nama` VARCHAR( 100 ) NOT NULL ) ENGINE = MYISAM ;

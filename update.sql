2013-07-19 :
ALTER TABLE  `seeker_reference` ADD  `content` VARCHAR( 255 ) NOT NULL AFTER  `nama`;
CREATE TABLE  `seeker_subscribe` ( `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , `seeker_id` INT NOT NULL , `subkategori_id` INT NOT NULL ) ENGINE = MYISAM ;
ALTER TABLE `vacancy` ADD `job_reff` VARCHAR( 255 ) NOT NULL AFTER `nama`;
ALTER TABLE `vacancy` CHANGE `jenjang_id` `jenjang_id` VARCHAR( 50 ) NULL ;
ALTER TABLE `exam` CHANGE `apply_id` `vacancy_id` INT( 11 ) NOT NULL;
CREATE TABLE `seeker_exam` ( `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , `exam_id` INT NOT NULL , `exam_start` DATETIME NOT NULL , `exam_file` VARCHAR( 50 ) NOT NULL ) ENGINE = MYISAM ;
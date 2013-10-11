2013-07-29 :
- ALTER TABLE `vacancy` ADD `vacancy_submit_via` INT NOT NULL
- ALTER TABLE `vacancy` ADD `link_apply` VARCHAR( 255 ) NOT NULL AFTER `email_quick` 

2013-10-08 :
- ALTER TABLE  `seeker` ADD  `about_me` VARCHAR( 255 ) NOT NULL AFTER  `ibu_kandung` ;
- ALTER TABLE  `vacancy` ADD  `invitation` VARCHAR( 255 ) NOT NULL AFTER  `article_link` ;
- ALTER TABLE  `company` ADD  `code_random` VARCHAR( 50 ) NOT NULL AFTER  `contact_no` ;

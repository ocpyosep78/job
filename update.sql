2013-07-06 :
- ALTER TABLE `seeker` ADD `is_disable` INT NOT NULL
- ALTER TABLE `company` ADD `is_disable` INT NOT NULL 

2013-07-07 :

CREATE TABLE IF NOT EXISTS `exam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `apply_id` int(11) NOT NULL,
  `exam_time` varchar(50) NOT NULL,
  `exam_file` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  title varchar(200) not null,
  `body` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  show_title tinyint(1) default 1,
  role_id int(11) not null,

  PRIMARY KEY  (`id`),
  KEY `name` (`name`),
  KEY `created_at` (`created_at`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `pages`
--

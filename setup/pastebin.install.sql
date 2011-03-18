CREATE TABLE IF NOT EXISTS `cot_pastebin` (
  `paste_id` int(11) NOT NULL auto_increment,
  `paste_username` varchar(24) NOT NULL default 'Anonymous',
  `paste_userid` int(11) NOT NULL,
  `paste_userip` varchar(15) NOT NULL default '0.0.0.0',
  `paste_type` varchar(24) NOT NULL default 'php',
  `paste_flagged` tinyint(1) NOT NULL default 0,
  `paste_private` tinyint(1) NOT NULL default 0,
  `paste_password` varchar(16) NOT NULL default '',
  `paste_created` int(11) NOT NULL,
  `paste_expire` int(11) NOT NULL,
  `paste_title` varchar(64) NOT NULL default '',
  `paste_desc` varchar(255) NOT NULL default '',
  `paste_text` text NOT NULL default '',
  PRIMARY KEY  (`paste_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
CREATE TABLE `ads` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Text` varchar(255) NOT NULL DEFAULT '',
  `Price` decimal(8,2) unsigned NOT NULL DEFAULT 0.00,
  `Limit` smallint(5) unsigned NOT NULL DEFAULT 1,
  `Shown` smallint(5) unsigned NOT NULL DEFAULT 0,
  `Banner` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `ads_views` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Ad_ID` int(10) unsigned NOT NULL,
  `Price` decimal(8,2) unsigned NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
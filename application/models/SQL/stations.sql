
drop table if exists stations;

CREATE TABLE stations (
  id mediumint(8) unsigned NOT NULL auto_increment,
  name varchar(50) DEFAULT '',
  url varchar(200) DEFAULT '',
  options varchar(50) DEFAULT '',
  count mediumint(8) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY  (id),
  KEY svc_ID (id)
) TYPE=MyISAM;

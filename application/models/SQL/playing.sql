
drop table if exists playing;

CREATE TABLE playing (
  station_id mediumint(8) unsigned NOT NULL DEFAULT 0,
  type varchar(10) DEFAULT 's',
  name varchar(200) DEFAULT '',
  url varchar(200) DEFAULT '',
  PRIMARY KEY  (station_id),
  KEY svc_ID (station_id)
) TYPE=MyISAM;


drop table if exists bbcindex;

CREATE TABLE bbcindex (
  bbcindex mediumint(8) unsigned default 0,
  bbctype varchar(20) DEFAULT '',
  bbcname varchar(200) DEFAULT '',
  pid varchar(20) DEFAULT '',
  available varchar(20) DEFAULT '',
  episode varchar(200) DEFAULT '',
  seriesnum varchar(200) DEFAULT '',
  episodenum varchar(200) DEFAULT '',
  versions varchar(200) DEFAULT '',
  duration varchar(200) DEFAULT '',
  bbcdesc varchar(200) DEFAULT '',
  channel varchar(200) DEFAULT '',
  categories varchar(200) DEFAULT '',
  thumbnail varchar(200) DEFAULT '',
  timeadded varchar(200) DEFAULT '',
  guidance varchar(200) DEFAULT '',
  web varchar(200) DEFAULT '',
  PRIMARY KEY  (bbcindex),
  KEY svc_ID (bbcindex)
) TYPE=MyISAM;


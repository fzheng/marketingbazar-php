USE "marketingbazar_com";

CREATE TABLE IF NOT EXISTS auth (
  id INT(20) unsigned NOT NULL AUTO_INCREMENT,
  userid INT(20) unsigned NOT NULL,
  username VARCHAR(64) NOT NULL,
  uid VARCHAR(128) NOT NULL,
  name VARCHAR(128) NOT NULL,
  email VARCHAR(255) DEFAULT NULL,
  location VARCHAR(512) DEFAULT NULL,
  token VARCHAR(255) DEFAULT NULL,
  secret VARCHAR(255) DEFAULT NULL,
  provider VARCHAR(16) NOT NULL,
  summary VARCHAR(512) DEFAULT NULL,
  profileimage VARCHAR(1024) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='users accounts';

CREATE TABLE IF NOT EXISTS ci_sessions (
	session_id varchar(40) DEFAULT '0' NOT NULL,
	id INT(20) unsigned NOT NULL,
	ip_address varchar(45) DEFAULT '0' NOT NULL,
	user_agent varchar(120) NOT NULL,
	last_activity int(10) unsigned DEFAULT 0 NOT NULL,
	user_data text NOT NULL,
	PRIMARY KEY (session_id),
	KEY last_activity_idx (last_activity)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='users sessions';
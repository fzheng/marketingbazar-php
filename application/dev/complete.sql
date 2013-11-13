USE "marketingbazar_com";

CREATE TABLE IF NOT EXISTS auths (
  id INT(11) unsigned NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='users oauth accounts';

CREATE TABLE IF NOT EXISTS users (
  id INT(11) unsigned NOT NULL AUTO_INCREMENT,
  auth_id INT(11) unsigned NOT NULL,
  user_type ENUM('customer', 'consultant', 'admin'),
  PRIMARY KEY (id),
  FOREIGN KEY (auth_id) REFERENCES auths(id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8 COMMENT='users accounts in marketingbazar';

CREATE TABLE IF NOT EXISTS sessions (
  session_id varchar(40) DEFAULT '0' NOT NULL,
  auth_id INT(11) unsigned NOT NULL,
  ip_address varchar(45) DEFAULT '0' NOT NULL,
  user_agent varchar(120) NOT NULL,
  last_activity int(10) unsigned DEFAULT 0 NOT NULL,
  user_data text NOT NULL,
  PRIMARY KEY (session_id),
  KEY last_activity_idx (last_activity),
  FOREIGN KEY (auth_id) REFERENCES auths(id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='table to cache users sessions';

CREATE TABLE IF NOT EXISTS competitions (
  id INT(11) unsigned NOT NULL AUTO_INCREMENT,
  user_id INT(11) unsigned NOT NULL,
  name VARCHAR(255) DEFAULT NULL,
  description VARCHAR(255) DEFAULT NULL,
  statement VARCHAR(255) DEFAULT NULL,
  project_type ENUM('Targeting', 'Engagement', 'Alignment', 'Automation', 'Analytics'),
  scope VARCHAR(255) DEFAULT NULL,
  platform VARCHAR(255) DEFAULT NULL,
  must_haves VARCHAR(255) DEFAULT NULL,
  nice_haves VARCHAR(255) DEFAULT NULL,
  not_haves VARCHAR(255) DEFAULT NULL,
  criteria ENUM('Qualitative', 'Quantitative'),
  deliverables VARCHAR(255) DEFAULT NULL,
  begin_at DATETIME DEFAULT NULL,
  end_at DATETIME DEFAULT NULL,
  award VARCHAR(255) DEFAULT NULL,
  deleted TINYINT(1) DEFAULT 0,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='competitions table';

CREATE TABLE IF NOT EXISTS comments (
  id INT(11) unsigned NOT NULL AUTO_INCREMENT,
  competition_id INT(11) unsigned NOT NULL,
  user_id INT(11) unsigned NOT NULL,
  create_time int(10) unsigned DEFAULT 0 NOT NULL,
  last_modified_time int(10) unsigned DEFAULT 0 NOT NULL,
  text longtext DEFAULT NULL,
  has_attachment boolean DEFAULT false,
  PRIMARY KEY (id),
  FOREIGN KEY (competition_id) REFERENCES competitions(id) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='comments table';

CREATE TABLE IF NOT EXISTS attachments (
  id INT(11) unsigned NOT NULL AUTO_INCREMENT,
  comment_id INT(11) unsigned NOT NULL,
  content BLOB DEFAULT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (comment_id) REFERENCES comments(id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='attachments table';

CREATE TABLE IF NOT EXISTS solutions (
  id INT(11) unsigned NOT NULL AUTO_INCREMENT,
  user_id INT(11) unsigned NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='solutions table';

CREATE TABLE IF NOT EXISTS attendees (
  id INT(11) unsigned NOT NULL AUTO_INCREMENT,
  competition_id INT(11) unsigned NOT NULL,
  user_id INT(11) unsigned NOT NULL,
  solution_id INT(11) unsigned NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (competition_id) REFERENCES competitions(id) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (solution_id) REFERENCES solutions(id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='attendees table';
USE "marketingbazar_com";

CREATE TABLE IF NOT EXISTS users (
  id INT(11) unsigned NOT NULL AUTO_INCREMENT,
  username VARCHAR(64) NOT NULL,
  email VARCHAR(255) NOT NULL,
  pwd_salt VARCHAR(512) NOT NULL,
  email_salt VARCHAR(512) NOT NULL,
  user_type ENUM('regular', 'admin') DEFAULT 'regular',
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8 COMMENT='users accounts in marketingbazar';

CREATE TABLE IF NOT EXISTS auths (
  id INT(11) unsigned NOT NULL AUTO_INCREMENT,
  user_id INT(11) unsigned NOT NULL,
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

CREATE TABLE IF NOT EXISTS sessions (
  id varchar(40) DEFAULT '0' NOT NULL,
  auth_id INT(11) unsigned NOT NULL,
  ip_address varchar(45) DEFAULT '0' NOT NULL,
  user_agent varchar(120) NOT NULL,
  last_activity int(10) unsigned DEFAULT 0 NOT NULL,
  user_data text NOT NULL,
  PRIMARY KEY (id)
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
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='competitions table';

CREATE TABLE IF NOT EXISTS comments (
  id INT(11) unsigned NOT NULL AUTO_INCREMENT,
  competition_id INT(11) unsigned NOT NULL,
  user_id INT(11) unsigned NOT NULL,
  last_modified_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  text longtext DEFAULT NULL,
  has_attachment boolean DEFAULT false,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='comments table';

CREATE TABLE IF NOT EXISTS attachments (
  id INT(11) unsigned NOT NULL AUTO_INCREMENT,
  comment_id INT(11) unsigned NOT NULL,
  content BLOB DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='attachments table';

CREATE TABLE IF NOT EXISTS solutions (
  id INT(11) unsigned NOT NULL AUTO_INCREMENT,
  user_id INT(11) unsigned NOT NULL,
  competition_id INT(11) unsigned NOT NULL,
  file_name VARCHAR(128) NOT NULL,
  file_path VARCHAR(255) NOT NULL,
  title VARCHAR(255) DEFAULT NULL,
  first_place TINYINT(1) DEFAULT 0,
  second_place TINYINT(1) DEFAULT 0,
  third_place TINYINT(1) DEFAULT 0,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='solutions table';

CREATE TABLE IF NOT EXISTS attendees (
  id INT(11) unsigned NOT NULL AUTO_INCREMENT,
  competition_id INT(11) unsigned NOT NULL,
  user_id INT(11) unsigned NOT NULL,
  solution_id INT(11) unsigned NOT NULL,
  PRIMARY KEY (id),
  UNIQUE (user_id, competition_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='attendees table';

CREATE TABLE IF NOT EXISTS profiles (
  id INT(11) unsigned NOT NULL AUTO_INCREMENT,
  user_id INT(11) unsigned NOT NULL,
  first_name VARCHAR(128) DEFAULT NULL,
  last_name VARCHAR(128) DEFAULT NULL,
  city VARCHAR(128) DEFAULT NULL,
  state_province VARCHAR(128) DEFAULT NULL,
  country VARCHAR(128) DEFAULT NULL,
  postal_code VARCHAR(128) DEFAULT NULL,
  phone VARCHAR(128) DEFAULT NULL,
  email VARCHAR(128) DEFAULT NULL,
  website VARCHAR(255) DEFAULT NULL,
  logo VARCHAR(255) DEFAULT NULL,
  background VARCHAR(255) DEFAULT NULL,
  education VARCHAR(255) DEFAULT NULL,
  experience VARCHAR(255) DEFAULT NULL,
  skills VARCHAR(255) DEFAULT NULL,
  facebook VARCHAR(128) DEFAULT NULL,
  linkedin VARCHAR(128) DEFAULT NULL,
  twitter VARCHAR(128) DEFAULT NULL,
  notifications ENUM('email', 'sms'),
  PRIMARY KEY (id),
  UNIQUE(user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='profiles table';

CREATE TABLE IF NOT EXISTS scorecards (
  id INT(11) unsigned NOT NULL AUTO_INCREMENT,
  user_id INT(11) unsigned NOT NULL,
  five_day_visit INT(11) DEFAULT 0,
  facebook_connect INT(11) DEFAULT 0,
  twitter_connect INT(11) DEFAULT 0,
  linkedin_connect INT(11) DEFAULT 0,
  refer_friends INT(11) DEFAULT 0,
  complete_profile INT(11) DEFAULT 0,
  project_signup INT(11) DEFAULT 0,
  solution_submission INT(11) DEFAULT 0,
  fail_submission INT(11) DEFAULT 0,
  third_place INT(11) DEFAULT 0,
  second_place INT(11) DEFAULT 0,
  first_place INT(11) DEFAULT 0,
  written_reviews INT(11) DEFAULT 0,
  PRIMARY KEY (id),
  UNIQUE(user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='scorecards table';

CREATE TABLE IF NOT EXISTS scores (
  id INT(11) unsigned NOT NULL AUTO_INCREMENT,
  user_id INT(11) unsigned NOT NULL,
  score INT(11) DEFAULT 0,
  rank INT(11) DEFAULT 0,
  PRIMARY KEY (id),
  UNIQUE(user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='scores table';
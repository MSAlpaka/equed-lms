
#
# Table structure for table 'tx_equedlms_domain_model_courseprogram'
#
CREATE TABLE tx_equedlms_domain_model_courseprogram (
  uid int(11) NOT NULL auto_increment,
  pid int(11) DEFAULT '0' NOT NULL,
  title varchar(255) DEFAULT '' NOT NULL,
  identifier varchar(100) DEFAULT '' NOT NULL,
  description text,
  certification_goal varchar(255) DEFAULT '',
  prerequisites text,
  is_specialty tinyint(1) DEFAULT '0' NOT NULL,
  requires_validation tinyint(1) DEFAULT '0' NOT NULL,
  hidden smallint(5) unsigned DEFAULT '0' NOT NULL,
  deleted smallint(5) unsigned DEFAULT '0' NOT NULL,
  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
  PRIMARY KEY (uid),
  KEY parent (pid)
);

#
# Table structure for table 'tx_equedlms_domain_model_courseinstance'
#
CREATE TABLE tx_equedlms_domain_model_courseinstance (
  uid int(11) NOT NULL auto_increment,
  pid int(11) DEFAULT '0' NOT NULL,
  program int(11) DEFAULT '0' NOT NULL,
  training_center int(11) DEFAULT '0',
  instructor int(11) DEFAULT '0',
  start_date int(11) DEFAULT '0',
  end_date int(11) DEFAULT '0',
  external_examiner_required tinyint(1) DEFAULT '0' NOT NULL,
  examiner_assigned int(11) DEFAULT '0',
  status varchar(50) DEFAULT '',
  hidden smallint(5) unsigned DEFAULT '0' NOT NULL,
  deleted smallint(5) unsigned DEFAULT '0' NOT NULL,
  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
  PRIMARY KEY (uid),
  KEY parent (pid)
);

#
# Table structure for table 'tx_equedlms_domain_model_usercourserecord'
#
CREATE TABLE tx_equedlms_domain_model_usercourserecord (
  uid int(11) NOT NULL auto_increment,
  pid int(11) DEFAULT '0' NOT NULL,
  fe_user int(11) DEFAULT '0' NOT NULL,
  course_instance int(11) DEFAULT '0' NOT NULL,
  progress int(11) DEFAULT '0' NOT NULL,
  status varchar(50) DEFAULT '',
  certification_code varchar(100) DEFAULT '',
  certificate_file varchar(255) DEFAULT '',
  onboarding_complete tinyint(1) DEFAULT '0' NOT NULL,
  final_validation_date int(11) DEFAULT '0',
  notes text,
  hidden smallint(5) unsigned DEFAULT '0' NOT NULL,
  deleted smallint(5) unsigned DEFAULT '0' NOT NULL,
  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
  PRIMARY KEY (uid),
  KEY parent (pid)
);

#
# Table structure for table 'tx_equedlms_domain_model_lesson'
#
CREATE TABLE tx_equedlms_domain_model_lesson (
  uid int(11) NOT NULL auto_increment,
  pid int(11) DEFAULT '0' NOT NULL,
  title varchar(255) DEFAULT '' NOT NULL,
  course_program int(11) DEFAULT '0' NOT NULL,
  sorting int(11) DEFAULT '0',
  quiz text,
  is_mandatory tinyint(1) DEFAULT '0' NOT NULL,
  hidden smallint(5) unsigned DEFAULT '0' NOT NULL,
  deleted smallint(5) unsigned DEFAULT '0' NOT NULL,
  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
  PRIMARY KEY (uid),
  KEY parent (pid)
);

#
# Table structure for table 'tx_equedlms_domain_model_submission'
#
CREATE TABLE tx_equedlms_domain_model_submission (
  uid int(11) NOT NULL auto_increment,
  pid int(11) DEFAULT '0' NOT NULL,
  user_course_record int(11) DEFAULT '0' NOT NULL,
  type varchar(50) DEFAULT '',
  file varchar(255) DEFAULT '',
  submitted_at int(11) DEFAULT '0',
  status varchar(50) DEFAULT '',
  gpt_analysis text,
  hidden smallint(5) unsigned DEFAULT '0' NOT NULL,
  deleted smallint(5) unsigned DEFAULT '0' NOT NULL,
  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
  PRIMARY KEY (uid),
  KEY parent (pid)
);

#
# Table structure for table 'tx_equedlms_domain_model_instructornote'
#
CREATE TABLE tx_equedlms_domain_model_instructornote (
  uid int(11) NOT NULL auto_increment,
  pid int(11) DEFAULT '0' NOT NULL,
  submission int(11) DEFAULT '0' NOT NULL,
  instructor int(11) DEFAULT '0',
  comment text,
  rating int(11) DEFAULT '0',
  uploaded_file varchar(255) DEFAULT '',
  hidden smallint(5) unsigned DEFAULT '0' NOT NULL,
  deleted smallint(5) unsigned DEFAULT '0' NOT NULL,
  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
  PRIMARY KEY (uid),
  KEY parent (pid)
);

#
# Table structure for table 'tx_equedlms_domain_model_certificate'
#
CREATE TABLE tx_equedlms_domain_model_certificate (
  uid int(11) NOT NULL auto_increment,
  pid int(11) DEFAULT '0' NOT NULL,
  user_course_record int(11) DEFAULT '0' NOT NULL,
  code varchar(100) DEFAULT '',
  created_at int(11) DEFAULT '0',
  download_link varchar(255) DEFAULT '',
  hidden smallint(5) unsigned DEFAULT '0' NOT NULL,
  deleted smallint(5) unsigned DEFAULT '0' NOT NULL,
  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
  PRIMARY KEY (uid),
  KEY parent (pid)
);

#
# Table structure for table 'tx_equedlms_domain_model_qmscase'
#
CREATE TABLE tx_equedlms_domain_model_qmscase (
  uid int(11) NOT NULL auto_increment,
  pid int(11) DEFAULT '0' NOT NULL,
  related_record int(11) DEFAULT '0',
  created_by int(11) DEFAULT '0',
  issue_type varchar(50) DEFAULT '',
  status varchar(50) DEFAULT '',
  comment_log text,
  uploaded_evidence varchar(255) DEFAULT '',
  assigned_to int(11) DEFAULT '0',
  hidden smallint(5) unsigned DEFAULT '0' NOT NULL,
  deleted smallint(5) unsigned DEFAULT '0' NOT NULL,
  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
  PRIMARY KEY (uid),
  KEY parent (pid)
);

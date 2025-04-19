#
# === Kursprogramme (Programmlogik) ===
#
CREATE TABLE tx_equedlms_domain_model_courseprogram (
  uid INT AUTO_INCREMENT PRIMARY KEY,
  pid INT DEFAULT 0 NOT NULL,
  title VARCHAR(255) DEFAULT '' NOT NULL,
  short_title VARCHAR(100) DEFAULT '' NOT NULL,
  description TEXT DEFAULT NULL,
  teaser TEXT DEFAULT NULL,
  certification_goal VARCHAR(255) DEFAULT '' NOT NULL,
  certification_validity_years INT DEFAULT 0 NOT NULL,
  prerequisites TEXT DEFAULT NULL,
  recommended_next_courses TEXT DEFAULT NULL,
  duration_hours INT DEFAULT 0 NOT NULL,
  duration_days INT DEFAULT 0 NOT NULL,
  image INT DEFAULT 0 NOT NULL,
  specialty TINYINT(1) DEFAULT 0 NOT NULL,
  requires_recertification TINYINT(1) DEFAULT 0 NOT NULL,
  language_uid INT DEFAULT 0 NOT NULL,
  l10n_parent INT DEFAULT 0 NOT NULL,
  l10n_diffsource MEDIUMTEXT DEFAULT NULL,
  hidden TINYINT(1) DEFAULT 0 NOT NULL,
  deleted TINYINT(1) DEFAULT 0 NOT NULL,
  sorting INT DEFAULT 0 NOT NULL,
  tstamp INT DEFAULT 0 NOT NULL,
  crdate INT DEFAULT 0 NOT NULL,
  cruser_id INT DEFAULT 0 NOT NULL,
  KEY pid (pid),
  KEY language_uid (language_uid, l10n_parent)
);

#
# === Konkrete Kursdurchführungen ===
#
CREATE TABLE tx_equedlms_domain_model_courseinstance (
  uid INT AUTO_INCREMENT PRIMARY KEY,
  pid INT DEFAULT 0 NOT NULL,
  courseprogram INT DEFAULT 0 NOT NULL,
  start_date INT DEFAULT 0 NOT NULL,
  end_date INT DEFAULT 0 NOT NULL,
  location VARCHAR(255) DEFAULT '' NOT NULL,
  center_id INT DEFAULT 0 NOT NULL,
  instructor INT DEFAULT 0 NOT NULL,
  external_examiner INT DEFAULT 0,
  requires_external_examiner TINYINT(1) DEFAULT 0 NOT NULL,
  seats_total INT DEFAULT 0 NOT NULL,
  seats_available INT DEFAULT 0 NOT NULL,
  language_uid INT DEFAULT 0 NOT NULL,
  l10n_parent INT DEFAULT 0 NOT NULL,
  l10n_diffsource MEDIUMTEXT DEFAULT NULL,
  hidden TINYINT(1) DEFAULT 0 NOT NULL,
  deleted TINYINT(1) DEFAULT 0 NOT NULL,
  tstamp INT DEFAULT 0 NOT NULL,
  crdate INT DEFAULT 0 NOT NULL,
  cruser_id INT DEFAULT 0 NOT NULL,
  KEY pid (pid),
  KEY courseprogram (courseprogram),
  KEY instructor (instructor),
  KEY external_examiner (external_examiner),
  KEY center_id (center_id),
  KEY language_uid (language_uid, l10n_parent)
);

#
# === Teilnahme an Kursen & Fortschritt ===
#
CREATE TABLE tx_equedlms_domain_model_usercourserecord (
  uid INT AUTO_INCREMENT PRIMARY KEY,
  pid INT DEFAULT 0 NOT NULL,
  participant INT DEFAULT 0 NOT NULL,
  courseinstance INT DEFAULT 0 NOT NULL,
  progress FLOAT DEFAULT 0 NOT NULL,
  theory_passed TINYINT(1) DEFAULT 0 NOT NULL,
  practical_passed TINYINT(1) DEFAULT 0 NOT NULL,
  external_exam_passed TINYINT(1) DEFAULT NULL,
  instructor_validated TINYINT(1) DEFAULT 0 NOT NULL,
  certifier_validated TINYINT(1) DEFAULT 0 NOT NULL,
  certification_code VARCHAR(255) DEFAULT '' NOT NULL,
  certification_issued_date INT DEFAULT 0 NOT NULL,
  certification_valid_until INT DEFAULT 0 NOT NULL,
  feedback_submitted TINYINT(1) DEFAULT 0 NOT NULL,
  qms_case_opened TINYINT(1) DEFAULT 0 NOT NULL,
  language_uid INT DEFAULT 0 NOT NULL,
  l10n_parent INT DEFAULT 0 NOT NULL,
  l10n_diffsource MEDIUMTEXT DEFAULT NULL,
  hidden TINYINT(1) DEFAULT 0 NOT NULL,
  deleted TINYINT(1) DEFAULT 0 NOT NULL,
  tstamp INT DEFAULT 0 NOT NULL,
  crdate INT DEFAULT 0 NOT NULL,
  cruser_id INT DEFAULT 0 NOT NULL,
  UNIQUE KEY participant_course (participant, courseinstance),
  KEY courseinstance (courseinstance),
  KEY participant (participant),
  KEY pid (pid),
  KEY language_uid (language_uid, l10n_parent)
);

#
# === Kursinhalte / Lektionen ===
#
CREATE TABLE tx_equedlms_domain_model_lesson (
  uid INT AUTO_INCREMENT PRIMARY KEY,
  pid INT DEFAULT 0 NOT NULL,
  courseprogram INT DEFAULT 0 NOT NULL,
  title VARCHAR(255) DEFAULT '' NOT NULL,
  content MEDIUMTEXT DEFAULT NULL,
  sorting INT DEFAULT 0 NOT NULL,
  attachments INT DEFAULT 0 NOT NULL,
  language_uid INT DEFAULT 0 NOT NULL,
  l10n_parent INT DEFAULT 0 NOT NULL,
  l10n_diffsource MEDIUMTEXT DEFAULT NULL,
  hidden TINYINT(1) DEFAULT 0 NOT NULL,
  deleted TINYINT(1) DEFAULT 0 NOT NULL,
  tstamp INT DEFAULT 0 NOT NULL,
  crdate INT DEFAULT 0 NOT NULL,
  cruser_id INT DEFAULT 0 NOT NULL,
  KEY pid (pid),
  KEY courseprogram (courseprogram),
  KEY language_uid (language_uid, l10n_parent)
);

#
# === Materialien (PDF, Video, Worksheet) ===
#
CREATE TABLE tx_equedlms_domain_model_material (
  uid INT AUTO_INCREMENT PRIMARY KEY,
  pid INT DEFAULT 0 NOT NULL,
  lesson INT DEFAULT 0 NOT NULL,
  title VARCHAR(255) DEFAULT '' NOT NULL,
  file INT DEFAULT 0 NOT NULL,
  type VARCHAR(50) DEFAULT 'pdf' NOT NULL,
  required TINYINT(1) DEFAULT 0 NOT NULL,
  download_only TINYINT(1) DEFAULT 0 NOT NULL,
  sorting INT DEFAULT 0 NOT NULL,
  hidden TINYINT(1) DEFAULT 0 NOT NULL,
  deleted TINYINT(1) DEFAULT 0 NOT NULL,
  tstamp INT DEFAULT 0 NOT NULL,
  crdate INT DEFAULT 0 NOT NULL,
  cruser_id INT DEFAULT 0 NOT NULL,
  KEY lesson (lesson),
  KEY pid (pid)
);

#
# === Submissions (Fallberichte, Prüfprotokolle etc.) ===
#
CREATE TABLE tx_equedlms_domain_model_submission (
  uid INT AUTO_INCREMENT PRIMARY KEY,
  pid INT DEFAULT 0 NOT NULL,
  usercourserecord INT DEFAULT 0 NOT NULL,
  instructor INT DEFAULT 0 NOT NULL,
  document INT DEFAULT 0 NOT NULL,
  type VARCHAR(50) DEFAULT 'document' NOT NULL,
  comment TEXT DEFAULT NULL,
  status VARCHAR(50) DEFAULT 'submitted' NOT NULL,
  submitted_at INT DEFAULT 0 NOT NULL,
  reviewed_at INT DEFAULT 0,
  reviewed_by INT DEFAULT 0,
  hidden TINYINT(1) DEFAULT 0 NOT NULL,
  deleted TINYINT(1) DEFAULT 0 NOT NULL,
  tstamp INT DEFAULT 0 NOT NULL,
  crdate INT DEFAULT 0 NOT NULL,
  cruser_id INT DEFAULT 0 NOT NULL,
  KEY pid (pid),
  KEY usercourserecord (usercourserecord),
  KEY instructor (instructor)
);

#
# === QMS-Fälle (Qualitätsmanagement) ===
#
CREATE TABLE tx_equedlms_domain_model_qmscase (
  uid INT AUTO_INCREMENT PRIMARY KEY,
  pid INT DEFAULT 0 NOT NULL,
  usercourserecord INT DEFAULT 0 NOT NULL,
  certifier INT DEFAULT 0 NOT NULL,
  issue TEXT DEFAULT NULL,
  resolution TEXT DEFAULT NULL,
  status VARCHAR(50) DEFAULT 'open' NOT NULL,
  attachments INT DEFAULT 0 NOT NULL,
  language_uid INT DEFAULT 0 NOT NULL,
  l10n_parent INT DEFAULT 0 NOT NULL,
  l10n_diffsource MEDIUMTEXT DEFAULT NULL,
  hidden TINYINT(1) DEFAULT 0 NOT NULL,
  deleted TINYINT(1) DEFAULT 0 NOT NULL,
  tstamp INT DEFAULT 0 NOT NULL,
  crdate INT DEFAULT 0 NOT NULL,
  cruser_id INT DEFAULT 0 NOT NULL,
  KEY pid (pid),
  KEY usercourserecord (usercourserecord),
  KEY certifier (certifier),
  KEY language_uid (language_uid, l10n_parent)
);

#
# === Zertifizierungs-Badges (Recognition, Fortschritt etc.) ===
#
CREATE TABLE tx_equedlms_domain_model_certificationbadge (
  uid INT AUTO_INCREMENT PRIMARY KEY,
  pid INT DEFAULT 0 NOT NULL,
  fe_user INT DEFAULT 0 NOT NULL,
  courseprogram INT DEFAULT 0 NOT NULL,
  badge_type VARCHAR(50) DEFAULT 'certificate' NOT NULL,
  awarded_date INT DEFAULT 0 NOT NULL,
  badge_image INT DEFAULT 0,
  external_link VARCHAR(255) DEFAULT '',
  hidden TINYINT(1) DEFAULT 0 NOT NULL,
  deleted TINYINT(1) DEFAULT 0 NOT NULL,
  tstamp INT DEFAULT 0 NOT NULL,
  crdate INT DEFAULT 0 NOT NULL,
  cruser_id INT DEFAULT 0 NOT NULL,
  KEY fe_user (fe_user),
  KEY courseprogram (courseprogram),
  KEY pid (pid)
);

#
# === Erweiterung der fe_users (Frontend-User) ===
#
CREATE TABLE fe_users (
  tx_equedlms_onboarding_complete TINYINT(1) DEFAULT 0 NOT NULL,
  tx_equedlms_certifications INT DEFAULT 0 NOT NULL,
  tx_equedlms_instructor TINYINT(1) DEFAULT 0 NOT NULL,
  tx_equedlms_certifier TINYINT(1) DEFAULT 0 NOT NULL,
  tx_equedlms_servicecenter TINYINT(1) DEFAULT 0 NOT NULL,
  tx_equedlms_member_id VARCHAR(50) DEFAULT '' NOT NULL,
  tx_equedlms_center_id INT DEFAULT 0 NOT NULL,
  tx_equedlms_region VARCHAR(100) DEFAULT '' NOT NULL,
  KEY center_id (tx_equedlms_center_id),
  KEY member_id (tx_equedlms_member_id),
  KEY instructor_region (tx_equedlms_instructor, tx_equedlms_region)
);


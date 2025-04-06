-- Optimierte ext_tables.sql mit vollständigen TYPO3-Systemfeldern

CREATE TABLE tx_equedlms_userprofile (
    cruser_id INT(11) DEFAULT 0 NOT NULL,
    crdate INT(11) DEFAULT 0 NOT NULL,
    tstamp INT(11) DEFAULT 0 NOT NULL,

    uid INT(11) NOT NULL AUTO_INCREMENT,
    pid INT(11) DEFAULT 0 NOT NULL,
    user_id INT(11) NOT NULL,  -- Verweis auf fe_users
    preferences TEXT,  -- Zum Beispiel Kurspräferenzen
    progress_summary TEXT,  -- Allgemeine Zusammenfassung des Fortschritts
    PRIMARY KEY (uid),
    KEY user_id (user_id),
    FOREIGN KEY (user_id) REFERENCES fe_users (uid)
,
    deleted TINYINT(1) DEFAULT 0 NOT NULL,
    hidden TINYINT(1) DEFAULT 0 NOT NULL
);

CREATE TABLE tx_equedlms_course_category (
    cruser_id INT(11) DEFAULT 0 NOT NULL,
    crdate INT(11) DEFAULT 0 NOT NULL,
    tstamp INT(11) DEFAULT 0 NOT NULL,

    uid INT(11) NOT NULL AUTO_INCREMENT,
    pid INT(11) DEFAULT 0 NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    PRIMARY KEY (uid)
,
    deleted TINYINT(1) DEFAULT 0 NOT NULL,
    hidden TINYINT(1) DEFAULT 0 NOT NULL
);

CREATE TABLE tx_equedlms_domain_model_course (
    cruser_id INT(11) DEFAULT 0 NOT NULL,
    crdate INT(11) DEFAULT 0 NOT NULL,
    tstamp INT(11) DEFAULT 0 NOT NULL,

    uid INT(11) NOT NULL AUTO_INCREMENT,
    pid INT(11) DEFAULT 0 NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    difficulty_level INT(11) DEFAULT 0 NOT NULL,  -- Schwierigkeitsgrad
    provider VARCHAR(255),  -- Anbieter des Kurses
    category INT(11),  -- Fremdschlüssel zu einer Kategorietabelle
    startDate DATETIME NULL,  -- Neues Feld für Kursstart
    endDate DATETIME NULL,  -- Neues Feld für Kursende
    PRIMARY KEY (uid),
    KEY category (category),
    FOREIGN KEY (category) REFERENCES tx_equedlms_course_category (uid)
,
    deleted TINYINT(1) DEFAULT 0 NOT NULL,
    hidden TINYINT(1) DEFAULT 0 NOT NULL
);

CREATE TABLE tx_equedlms_domain_model_exam (
    cruser_id INT(11) DEFAULT 0 NOT NULL,
    crdate INT(11) DEFAULT 0 NOT NULL,
    tstamp INT(11) DEFAULT 0 NOT NULL,

    uid INT(11) NOT NULL AUTO_INCREMENT,
    pid INT(11) DEFAULT 0 NOT NULL,
    course_id INT(11) NOT NULL,  -- Verweis auf den Kurs
    exam_date DATETIME NOT NULL,
    exam_type VARCHAR(255) NOT NULL, -- Theorie, Praxis
    PRIMARY KEY (uid),
    FOREIGN KEY (course_id) REFERENCES tx_equedlms_domain_model_course (uid)
,
    deleted TINYINT(1) DEFAULT 0 NOT NULL,
    hidden TINYINT(1) DEFAULT 0 NOT NULL
);

CREATE TABLE tx_equedlms_domain_model_certificate (
    cruser_id INT(11) DEFAULT 0 NOT NULL,
    crdate INT(11) DEFAULT 0 NOT NULL,
    tstamp INT(11) DEFAULT 0 NOT NULL,

    uid INT(11) NOT NULL AUTO_INCREMENT,
    pid INT(11) DEFAULT 0 NOT NULL,
    user_id INT(11) NOT NULL,  -- Verweis auf den Benutzer
    exam_id INT(11) NOT NULL,  -- Verweis auf die Prüfung
    certificate_code VARCHAR(255) NOT NULL, -- Zertifikatscode
    PRIMARY KEY (uid),
    FOREIGN KEY (user_id) REFERENCES fe_users (uid),
    FOREIGN KEY (exam_id) REFERENCES tx_equedlms_domain_model_exam (uid)
,
    deleted TINYINT(1) DEFAULT 0 NOT NULL,
    hidden TINYINT(1) DEFAULT 0 NOT NULL
);

CREATE TABLE tx_equedlms_domain_model_auditlog (
    cruser_id INT(11) DEFAULT 0 NOT NULL,
    crdate INT(11) DEFAULT 0 NOT NULL,
    tstamp INT(11) DEFAULT 0 NOT NULL,

    uid INT(11) NOT NULL AUTO_INCREMENT,
    pid INT(11) DEFAULT 0 NOT NULL,
    fe_user INT(11) NOT NULL,  -- Verweis auf fe_users
    action VARCHAR(255) NOT NULL,
    related_type VARCHAR(255),
    related_id INT(11),
    timestamp INT(11) NOT NULL,
    comment TEXT,
    PRIMARY KEY (uid),
    FOREIGN KEY (fe_user) REFERENCES fe_users (uid)
,
    deleted TINYINT(1) DEFAULT 0 NOT NULL,
    hidden TINYINT(1) DEFAULT 0 NOT NULL
);

CREATE TABLE tx_equedlms_domain_model_userlessonprogress (
    cruser_id INT(11) DEFAULT 0 NOT NULL,
    crdate INT(11) DEFAULT 0 NOT NULL,
    tstamp INT(11) DEFAULT 0 NOT NULL,

    uid INT(11) NOT NULL AUTO_INCREMENT,
    pid INT(11) DEFAULT 0 NOT NULL,
    fe_user INT(11) NOT NULL,  -- Verweis auf fe_users
    lesson INT(11) NOT NULL,  -- Verweis auf Lektion
    progress INT(11) DEFAULT 0,  -- Fortschritt in der Lektion
    PRIMARY KEY (uid),
    FOREIGN KEY (fe_user) REFERENCES fe_users (uid),
    FOREIGN KEY (lesson) REFERENCES tx_equedlms_domain_model_lesson (uid)
);

-- Tabelle für Benutzereinreichungen (z.B. Prüfungsversuche,
    deleted TINYINT(1) DEFAULT 0 NOT NULL,
    hidden TINYINT(1) DEFAULT 0 NOT NULL
);

CREATE TABLE tx_equedlms_domain_model_usersubmission (
    cruser_id INT(11) DEFAULT 0 NOT NULL,
    crdate INT(11) DEFAULT 0 NOT NULL,
    tstamp INT(11) DEFAULT 0 NOT NULL,

    uid INT(11) NOT NULL AUTO_INCREMENT,
    pid INT(11) DEFAULT 0 NOT NULL,
    type VARCHAR(255) NOT NULL,  -- Art der Einreichung (z.B. Fallstudie, Theorie, Praxis)
    comment TEXT,
    fe_user INT(11) NOT NULL,  -- Verweis auf fe_users
    lesson INT(11) NOT NULL,  -- Verweis auf Lektion
    exam_attempt INT(11),  -- Verweis auf den Prüfungsversuch
    PRIMARY KEY (uid),
    FOREIGN KEY (fe_user) REFERENCES fe_users (uid),
    FOREIGN KEY (lesson) REFERENCES tx_equedlms_domain_model_lesson (uid),
    FOREIGN KEY (exam_attempt) REFERENCES tx_equedlms_domain_model_examattempt (uid)
);

-- Neue Felder für das Onboarding im `fe_users`
ALTER TABLE fe_users 
ADD COLUMN step1_complete TINYINT(1) UNSIGNED DEFAULT '0',
ADD COLUMN step2_complete TINYINT(1) UNSIGNED DEFAULT '0',
ADD COLUMN step3_complete TINYINT(1,
    deleted TINYINT(1) DEFAULT 0 NOT NULL,
    hidden TINYINT(1) DEFAULT 0 NOT NULL
);

CREATE TABLE tx_equedlms_domain_model_lesson (
    cruser_id INT(11) DEFAULT 0 NOT NULL,
    crdate INT(11) DEFAULT 0 NOT NULL,
    tstamp INT(11) DEFAULT 0 NOT NULL,

    title varchar(255) DEFAULT '' NOT NULL,
    slug varchar(255) DEFAULT '' NOT NULL,
    position int(11) DEFAULT 0 NOT NULL,
    course int(11) DEFAULT 0 NOT NULL
,
    deleted TINYINT(1) DEFAULT 0 NOT NULL,
    hidden TINYINT(1) DEFAULT 0 NOT NULL
);

CREATE TABLE tx_equedlms_domain_model_userlessonprogress (
    cruser_id INT(11) DEFAULT 0 NOT NULL,
    crdate INT(11) DEFAULT 0 NOT NULL,
    tstamp INT(11) DEFAULT 0 NOT NULL,

    fe_user int(11) DEFAULT 0 NOT NULL,
    confirmed tinyint(1) DEFAULT 0 NOT NULL,
    quiz_score double DEFAULT 0,
    completed tinyint(1) DEFAULT 0 NOT NULL,
    lesson int(11) DEFAULT 0 NOT NULL
,
    deleted TINYINT(1) DEFAULT 0 NOT NULL,
    hidden TINYINT(1) DEFAULT 0 NOT NULL
);

CREATE TABLE tx_equedlms_domain_model_usersubmission (
    cruser_id INT(11) DEFAULT 0 NOT NULL,
    crdate INT(11) DEFAULT 0 NOT NULL,
    tstamp INT(11) DEFAULT 0 NOT NULL,

    fe_user int(11) DEFAULT 0 NOT NULL,
    user_course_record int(11) DEFAULT 0 NOT NULL,
    lesson int(11) DEFAULT 0,
    type varchar(255) DEFAULT '' NOT NULL,
    status varchar(255) DEFAULT '',
    grade varchar(255) DEFAULT '',
    comment text
,
    deleted TINYINT(1) DEFAULT 0 NOT NULL,
    hidden TINYINT(1) DEFAULT 0 NOT NULL
);

CREATE TABLE tx_equedlms_domain_model_usercourserecord (
    cruser_id INT(11) DEFAULT 0 NOT NULL,
    crdate INT(11) DEFAULT 0 NOT NULL,
    tstamp INT(11) DEFAULT 0 NOT NULL,

    fe_user int(11) DEFAULT 0 NOT NULL,
    course int(11) DEFAULT 0 NOT NULL,
    completed tinyint(1) DEFAULT 0 NOT NULL,
    validated tinyint(1) DEFAULT 0 NOT NULL,
    certificate_code varchar(255) DEFAULT '',
    completion_date int(11) DEFAULT 0,
    participant_postal_code varchar(255) DEFAULT '',
    matching_status varchar(255) DEFAULT '',
    instructor int(11) DEFAULT 0,
    center int(11) DEFAULT 0
,
    deleted TINYINT(1) DEFAULT 0 NOT NULL,
    hidden TINYINT(1) DEFAULT 0 NOT NULL
);

CREATE TABLE tx_equedlms_domain_model_examattempt (
    cruser_id INT(11) DEFAULT 0 NOT NULL,
    crdate INT(11) DEFAULT 0 NOT NULL,
    tstamp INT(11) DEFAULT 0 NOT NULL,

    type varchar(255) DEFAULT '' NOT NULL,
    passed tinyint(1) DEFAULT 0 NOT NULL,
    feedback text,
    user_course_record int(11) DEFAULT 0 NOT NULL,
    lesson int(11) DEFAULT 0,
    examiner int(11) DEFAULT 0
,
    deleted TINYINT(1) DEFAULT 0 NOT NULL,
    hidden TINYINT(1) DEFAULT 0 NOT NULL
);

CREATE TABLE tx_equedlms_domain_model_instructor (
    cruser_id INT(11) DEFAULT 0 NOT NULL,
    crdate INT(11) DEFAULT 0 NOT NULL,
    tstamp INT(11) DEFAULT 0 NOT NULL,

    fe_user int(11) DEFAULT 0 NOT NULL,
    name varchar(255) DEFAULT '' NOT NULL,
    email varchar(255) DEFAULT '',
    is_available tinyint(1) DEFAULT 1 NOT NULL,
    region_postal_codes text,
    center int(11) DEFAULT 0
,
    deleted TINYINT(1) DEFAULT 0 NOT NULL,
    hidden TINYINT(1) DEFAULT 0 NOT NULL
);


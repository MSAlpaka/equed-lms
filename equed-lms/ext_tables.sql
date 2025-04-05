
-- ================================================
-- Optimierte Tabellenstruktur für equed-lms
-- ================================================

-- Tabelle: UserProfile
CREATE TABLE tx_equedlms_userprofile (
    uid INT UNSIGNED NOT NULL AUTO_INCREMENT,
    pid INT UNSIGNED NOT NULL DEFAULT 0,
    user_id INT UNSIGNED NOT NULL,
    preferences TEXT,
    progress_summary TEXT,
    PRIMARY KEY (uid),
    KEY user_id (user_id),
    CONSTRAINT fk_userprofile_user FOREIGN KEY (user_id) REFERENCES fe_users(uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabelle: Kurskategorien
CREATE TABLE tx_equedlms_course_category (
    uid INT UNSIGNED NOT NULL AUTO_INCREMENT,
    pid INT UNSIGNED NOT NULL DEFAULT 0,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabelle: Kurse
CREATE TABLE tx_equedlms_domain_model_course (
    uid INT UNSIGNED NOT NULL AUTO_INCREMENT,
    pid INT UNSIGNED NOT NULL DEFAULT 0,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    difficulty_level INT DEFAULT 0,
    provider VARCHAR(255),
    category INT UNSIGNED,
    start_date DATETIME NULL,
    end_date DATETIME NULL,
    PRIMARY KEY (uid),
    KEY category (category),
    CONSTRAINT fk_course_category FOREIGN KEY (category) REFERENCES tx_equedlms_course_category(uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabelle: Lektionen
CREATE TABLE tx_equedlms_domain_model_lesson (
    uid INT UNSIGNED NOT NULL AUTO_INCREMENT,
    pid INT UNSIGNED NOT NULL DEFAULT 0,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL,
    position INT DEFAULT 0,
    course INT UNSIGNED NOT NULL,
    PRIMARY KEY (uid),
    KEY course (course),
    CONSTRAINT fk_lesson_course FOREIGN KEY (course) REFERENCES tx_equedlms_domain_model_course(uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabelle: Prüfungen
CREATE TABLE tx_equedlms_domain_model_exam (
    uid INT UNSIGNED NOT NULL AUTO_INCREMENT,
    pid INT UNSIGNED NOT NULL DEFAULT 0,
    course_id INT UNSIGNED NOT NULL,
    exam_date DATETIME NOT NULL,
    exam_type VARCHAR(255) NOT NULL,
    PRIMARY KEY (uid),
    CONSTRAINT fk_exam_course FOREIGN KEY (course_id) REFERENCES tx_equedlms_domain_model_course(uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabelle: Zertifikate
CREATE TABLE tx_equedlms_domain_model_certificate (
    uid INT UNSIGNED NOT NULL AUTO_INCREMENT,
    pid INT UNSIGNED NOT NULL DEFAULT 0,
    user_id INT UNSIGNED NOT NULL,
    exam_id INT UNSIGNED NOT NULL,
    certificate_code VARCHAR(255) NOT NULL,
    PRIMARY KEY (uid),
    CONSTRAINT fk_certificate_user FOREIGN KEY (user_id) REFERENCES fe_users(uid),
    CONSTRAINT fk_certificate_exam FOREIGN KEY (exam_id) REFERENCES tx_equedlms_domain_model_exam(uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabelle: Audit Log
CREATE TABLE tx_equedlms_domain_model_auditlog (
    uid INT UNSIGNED NOT NULL AUTO_INCREMENT,
    pid INT UNSIGNED NOT NULL DEFAULT 0,
    fe_user INT UNSIGNED NOT NULL,
    action VARCHAR(255) NOT NULL,
    related_type VARCHAR(255),
    related_id INT,
    timestamp INT UNSIGNED NOT NULL,
    comment TEXT,
    PRIMARY KEY (uid),
    CONSTRAINT fk_auditlog_user FOREIGN KEY (fe_user) REFERENCES fe_users(uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Tabelle: Benutzerfortschritt in Lektionen
CREATE TABLE tx_equedlms_domain_model_userlessonprogress (
    uid INT UNSIGNED NOT NULL AUTO_INCREMENT,
    pid INT UNSIGNED NOT NULL DEFAULT 0,
    fe_user INT UNSIGNED NOT NULL,
    lesson INT UNSIGNED NOT NULL,
    progress INT DEFAULT 0,
    confirmed TINYINT(1) DEFAULT 0 NOT NULL,
    quiz_score DOUBLE DEFAULT 0,
    completed TINYINT(1) DEFAULT 0 NOT NULL,
    PRIMARY KEY (uid),
    KEY fe_user (fe_user),
    KEY lesson (lesson),
    CONSTRAINT fk_progress_user FOREIGN KEY (fe_user) REFERENCES fe_users(uid),
    CONSTRAINT fk_progress_lesson FOREIGN KEY (lesson) REFERENCES tx_equedlms_domain_model_lesson(uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabelle: UserCourseRecord
CREATE TABLE tx_equedlms_domain_model_usercourserecord (
    uid INT UNSIGNED NOT NULL AUTO_INCREMENT,
    pid INT UNSIGNED NOT NULL DEFAULT 0,
    fe_user INT UNSIGNED NOT NULL,
    course INT UNSIGNED NOT NULL,
    completed TINYINT(1) DEFAULT 0 NOT NULL,
    validated TINYINT(1) DEFAULT 0 NOT NULL,
    certificate_code VARCHAR(255) DEFAULT '',
    completion_date INT DEFAULT 0,
    participant_postal_code VARCHAR(255) DEFAULT '',
    matching_status VARCHAR(255) DEFAULT '',
    instructor INT UNSIGNED DEFAULT 0,
    center INT UNSIGNED DEFAULT 0,
    PRIMARY KEY (uid),
    KEY fe_user (fe_user),
    KEY course (course),
    CONSTRAINT fk_usercourserecord_user FOREIGN KEY (fe_user) REFERENCES fe_users(uid),
    CONSTRAINT fk_usercourserecord_course FOREIGN KEY (course) REFERENCES tx_equedlms_domain_model_course(uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabelle: ExamAttempt
CREATE TABLE tx_equedlms_domain_model_examattempt (
    uid INT UNSIGNED NOT NULL AUTO_INCREMENT,
    pid INT UNSIGNED NOT NULL DEFAULT 0,
    type VARCHAR(255) NOT NULL,
    passed TINYINT(1) DEFAULT 0 NOT NULL,
    feedback TEXT,
    user_course_record INT UNSIGNED NOT NULL,
    lesson INT UNSIGNED DEFAULT 0,
    examiner INT UNSIGNED DEFAULT 0,
    PRIMARY KEY (uid),
    CONSTRAINT fk_examattempt_userrecord FOREIGN KEY (user_course_record) REFERENCES tx_equedlms_domain_model_usercourserecord(uid),
    CONSTRAINT fk_examattempt_lesson FOREIGN KEY (lesson) REFERENCES tx_equedlms_domain_model_lesson(uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabelle: UserSubmission
CREATE TABLE tx_equedlms_domain_model_usersubmission (
    uid INT UNSIGNED NOT NULL AUTO_INCREMENT,
    pid INT UNSIGNED NOT NULL DEFAULT 0,
    fe_user INT UNSIGNED NOT NULL,
    user_course_record INT UNSIGNED NOT NULL,
    lesson INT UNSIGNED,
    type VARCHAR(255) NOT NULL,
    status VARCHAR(255) DEFAULT '',
    grade VARCHAR(255) DEFAULT '',
    comment TEXT,
    exam_attempt INT UNSIGNED DEFAULT NULL,
    PRIMARY KEY (uid),
    KEY fe_user (fe_user),
    KEY lesson (lesson),
    CONSTRAINT fk_submission_user FOREIGN KEY (fe_user) REFERENCES fe_users(uid),
    CONSTRAINT fk_submission_usercourserecord FOREIGN KEY (user_course_record) REFERENCES tx_equedlms_domain_model_usercourserecord(uid),
    CONSTRAINT fk_submission_lesson FOREIGN KEY (lesson) REFERENCES tx_equedlms_domain_model_lesson(uid),
    CONSTRAINT fk_submission_attempt FOREIGN KEY (exam_attempt) REFERENCES tx_equedlms_domain_model_examattempt(uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabelle: Instructor
CREATE TABLE tx_equedlms_domain_model_instructor (
    uid INT UNSIGNED NOT NULL AUTO_INCREMENT,
    pid INT UNSIGNED NOT NULL DEFAULT 0,
    fe_user INT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) DEFAULT '',
    is_available TINYINT(1) DEFAULT 1 NOT NULL,
    region_postal_codes TEXT,
    center INT UNSIGNED DEFAULT 0,
    PRIMARY KEY (uid),
    CONSTRAINT fk_instructor_user FOREIGN KEY (fe_user) REFERENCES fe_users(uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Zusätzliche Felder im fe_users für Onboarding
ALTER TABLE fe_users 
ADD COLUMN step1_complete TINYINT(1) UNSIGNED DEFAULT 0,
ADD COLUMN step2_complete TINYINT(1) UNSIGNED DEFAULT 0,
ADD COLUMN step3_complete TINYINT(1) UNSIGNED DEFAULT 0;

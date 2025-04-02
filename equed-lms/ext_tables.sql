-- Tabelle für Benutzerspezifische LMS-Daten (falls nicht bereits durch `fe_users` abgedeckt)
CREATE TABLE tx_equedlms_userprofile (
    uid INT(11) NOT NULL AUTO_INCREMENT,
    pid INT(11) DEFAULT 0 NOT NULL,
    user_id INT(11) NOT NULL,  -- Verweis auf fe_users
    preferences TEXT,  -- Zum Beispiel Kurspräferenzen
    progress_summary TEXT,  -- Allgemeine Zusammenfassung des Fortschritts
    PRIMARY KEY (uid),
    KEY user_id (user_id),
    FOREIGN KEY (user_id) REFERENCES fe_users (uid)
);

-- Tabelle für Kurskategorien
CREATE TABLE tx_equedlms_course_category (
    uid INT(11) NOT NULL AUTO_INCREMENT,
    pid INT(11) DEFAULT 0 NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    PRIMARY KEY (uid)
);

-- Tabelle für Kurse
CREATE TABLE tx_equedlms_domain_model_course (
    uid INT(11) NOT NULL AUTO_INCREMENT,
    pid INT(11) DEFAULT 0 NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    difficulty_level INT(11) DEFAULT 0 NOT NULL,  -- Schwierigkeitsgrad
    provider VARCHAR(255),  -- Anbieter des Kurses
    category INT(11),  -- Fremdschlüssel zu einer Kategorietabelle
    PRIMARY KEY (uid),
    KEY category (category),
    FOREIGN KEY (category) REFERENCES tx_equedlms_course_category (uid)
);

-- Tabelle für Prüfungen
CREATE TABLE tx_equedlms_domain_model_exam (
    uid INT(11) NOT NULL AUTO_INCREMENT,
    pid INT(11) DEFAULT 0 NOT NULL,
    course_id INT(11) NOT NULL,  -- Verweis auf den Kurs
    exam_date DATETIME NOT NULL,
    exam_type VARCHAR(255) NOT NULL, -- Theorie, Praxis
    PRIMARY KEY (uid),
    FOREIGN KEY (course_id) REFERENCES tx_equedlms_domain_model_course (uid)
);

-- Tabelle für Zertifikate
CREATE TABLE tx_equedlms_domain_model_certificate (
    uid INT(11) NOT NULL AUTO_INCREMENT,
    pid INT(11) DEFAULT 0 NOT NULL,
    user_id INT(11) NOT NULL,  -- Verweis auf den Benutzer
    exam_id INT(11) NOT NULL,  -- Verweis auf die Prüfung
    certificate_code VARCHAR(255) NOT NULL, -- Zertifikatscode
    issued_date DATETIME NOT NULL,  -- Ausstellungsdatum
    PRIMARY KEY (uid),
    FOREIGN KEY (user_id) REFERENCES fe_users (uid),
    FOREIGN KEY (exam_id) REFERENCES tx_equedlms_domain_model_exam (uid)
);

-- Tabelle für Benutzerfortschritte (userprogress)
CREATE TABLE tx_equedlms_userprogress (
    uid INT(11) NOT NULL AUTO_INCREMENT,
    pid INT(11) DEFAULT 0 NOT NULL,
    user_id INT(11) NOT NULL,
    course_id INT(11) NOT NULL,
    points INT(11) DEFAULT 0 NOT NULL,
    level INT(11) DEFAULT 1 NOT NULL,
    badges TEXT,
    PRIMARY KEY (uid),
    KEY user_course (user_id, course_id),
    FOREIGN KEY (user_id) REFERENCES fe_users (uid),
    FOREIGN KEY (course_id) REFERENCES tx_equedlms_domain_model_course (uid)
);

-- Tabelle für Lektionen
CREATE TABLE tx_equedlms_domain_model_lesson (
    uid INT AUTO_INCREMENT PRIMARY KEY,
    pid INT DEFAULT 0 NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    media_reference INT(11),  -- Verweis auf Mediendateien
    course INT(11) NOT NULL,  -- Verweis auf den Kurs
    position INT(11) DEFAULT 0 NOT NULL,
    FOREIGN KEY (course) REFERENCES tx_equedlms_domain_model_course (uid),
    FOREIGN KEY (media_reference) REFERENCES sys_file_reference (uid)
);

-- Tabelle für das Audit-Log
CREATE TABLE tx_equedlms_domain_model_auditlog (
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
);

-- Tabelle für Benutzerfortschritte in Lektionen
CREATE TABLE tx_equedlms_domain_model_userlessonprogress (
    uid INT(11) NOT NULL AUTO_INCREMENT,
    pid INT(11) DEFAULT 0 NOT NULL,
    fe_user INT(11) NOT NULL,  -- Verweis auf fe_users
    lesson INT(11) NOT NULL,  -- Verweis auf Lektion
    progress INT(11) DEFAULT 0,  -- Fortschritt in der Lektion
    PRIMARY KEY (uid),
    FOREIGN KEY (fe_user) REFERENCES fe_users (uid),
    FOREIGN KEY (lesson) REFERENCES tx_equedlms_domain_model_lesson (uid)
);

-- Tabelle für Benutzereinreichungen (z.B. Prüfungsversuche)
CREATE TABLE tx_equedlms_domain_model_usersubmission (
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
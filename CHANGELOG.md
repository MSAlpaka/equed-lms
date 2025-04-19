# Changelog

Alle signifikanten Änderungen an dieser Extension werden in diesem Dokument dokumentiert.  
Dieses Projekt folgt dem [Keep a Changelog](https://keepachangelog.com/de/) Format.

## [1.0.0] – 2025-04-19
### Added
- Initiale produktionsreife Version von EquEd LMS veröffentlicht
- Komplette Kursstruktur mit CourseProgram, CourseInstance und UserCourseRecord
- Fortschrittslogik & Statusanzeige für Teilnehmende
- Zertifizierungsprozess mit Instructor-, Certifier- & ServiceCenter-Logik
- Instructor-Dashboard inkl. Prüfbericht-Uploads & Feedbackfunktionen
- QMS-Fallstruktur inkl. digitalem Feedback und Abweichungsmanagement
- Specialty-Programme & Recognition Award System
- REST-API für SPA & App (Progress, Submissions, Profile, Zertifikate)
- CLI-Kommandos für Zertifikatsprüfung, Reminder, QMS-Verarbeitung, Archivierung
- Caching- & Event-System für automatische Verarbeitung
- Trainingscenter-Funktion mit Kursbuchung & Instructor-Zuweisung
- Mehrsprachigkeit (EN, DE, FR, ES, SW)
- PSR-12 konforme Codebasis, voll TYPO3 13.4.8 kompatibel
- Mitgelieferte README.md und restriktive Lizenzierung (All Rights Reserved)

### Changed
- Finales TCA mit TYPO3-13-konformen `required`, `datetime`, `number`
- `ext_tables.php` & `ext_localconf.php` vollständig optimiert
- Kursstruktur nach SSI-Vorbild modularisiert
- API-Controller getrennt nach Funktion (Progress, Certificate, InstructorDashboard)
- Mehrsprachige Labels vollständig überarbeitet

### Removed
- Veraltete Methoden wie `list_type`, direkte TCA-Zugriffe, `addPageTSConfig`
- Dummy-Inhalte in Templates, TCA, Icons und Sprachen

---

## [0.9.0] – 2025-04-01
### Added
- Vollständige Entwicklung der Datenstruktur & Domain Models
- Erste Implementierung der Kursbuchungslogik
- Instructor-Verknüpfung & Kurs-Fortschrittsanzeige (intern)

---

## [0.1.0] – 2025-03-01
### Added
- Projektinitialisierung
- Basiskonfiguration für TYPO3 13.x
- GitHub-Repository eingerichtet


-- Migration script that imports data from the legacy app into larasta
-- 1. Restore a backup of the legacy app ('snapshot_2021....') in your server, db name = app_insternships
-- 2. Make sure your larasta database is correct (table structure) and named 'larasta'
-- 3. Execute this script

-- Start from an empty database
use larasta;
SET FOREIGN_KEY_CHECKS = 0;
truncate activitytypes;
truncate companies;
truncate contactinfos;
truncate contacttypes;
truncate contracts;
truncate contractstates;
truncate documents;
truncate flocks;
truncate internships;
truncate lifecycles;
truncate locations;
truncate logbooks;
truncate media;
truncate migrations;
truncate params;
truncate persons;
truncate remarks;
truncate visits;
truncate visitsstates;
truncate wishes;

-- Enum tables
INSERT INTO `larasta`.`contacttypes` (id, contactTypeDescription) SELECT IDTypeContact,DescriptionTypeContact FROM app_internships.typecontact;
INSERT INTO `larasta`.`contractstates` (id, stateDescription,details,openForApplication,openForRenewal) SELECT IDStatus,DescriptionStatus,Details,Attribuable,0 FROM app_internships.statuscontrat;
INSERT INTO `larasta`.`lifecycles` (`id`,`from_id`,`to_id`) SELECT IDTransition,FKFrom,FKTo FROM app_internships.cycledevie;

-- Build Address list from enterprises and students 
INSERT INTO `larasta`.`locations` (`address1`,`address2`,`postalCode`,`city`,`lat`,`lng`)
SELECT `entreprise`.`Adresse1`,`entreprise`.`Adresse2`,`entreprise`.`NPA`,`entreprise`.`Localite`,`entreprise`.`Lat`,`entreprise`.`Lng`FROM `app_internships`.`entreprise`;
INSERT INTO `larasta`.`locations` (`address1`,`address2`,`postalCode`,`city`,`lat`,`lng`)
SELECT `personne`.`Adresse1`,`personne`.`Adresse2`,`personne`.`NPA`,`personne`.`Localite`,`personne`.`Lat`,`personne`.`Lng`FROM `app_internships`.`personne`;

-- Persons

-- Students and Company
INSERT INTO `larasta`.`persons`
(`id`,
`firstname`,
`lastname`,
`flock_id`,
`company_id`,
`location_id`,
`initials`,
`upToDateDate`,
`intranetUserId`,
`obsolete`,
`mpt`,
`role`)
SELECT
`IDPersonne`,
`PrenomPersonne`,
`NomPersonne`,
`FKVolee`,
`FKEntreprise`,
(SELECT id FROM locations WHERE personne.adresse1=locations.address1 COLLATE utf8_unicode_ci AND personne.NPA=locations.postalCode LIMIT 1),
`Initiales`,
`AJour`,
`IntranetUser`,
`Obsolet`,
`MPT`,
0
FROM app_internships.personne;

-- Teachers
INSERT INTO `larasta`.`persons`
(`lastname`, `firstname`, `role`, `intranetUserId`, `initials`, `flock_id`, `upToDateDate`, `mpt`, `obsolete`) VALUES
('ALTIERI', 'Patrick', '1', '1677', 'PAI',null,'2019-03-03 00:00:00', '1', '0'),
('BENZONANA', 'Pascal', '1', '10', 'PBA',null,'2019-03-13 19:41:16', '1', '0'),
('CARREL', 'Xavier', '2', '1237', 'XCL',null,'2020-08-01 00:00:00', '1', '0'),
('CHAVEY', 'Jean-Philippe', '1', '9', 'JCY',null,'2019-03-13 19:41:16', '1', '0'),
('EGGER', 'Claude', '3', '11', 'CER',null,'2020-06-10 00:00:00', '1', '0'),
('FASOLA', 'Sylvain', '1', '1451', 'SFA',null,'2019-03-19 00:00:00', '1', '0'),
('FAVRE', 'Raphaël', '1', '16', 'RFA',null,'2020-11-27 00:00:00', '1', '0'),
('HURNI', 'Pascal', '1', '12', 'PHI',null,'2019-03-13 19:41:16', '1', '0'),
('JAGGI', 'Laurent', '1', '1240', 'LJI',null,'2019-04-01 00:00:00', '1', '0'),
('MOTTIER', 'André', '1', '13', 'AMR',null,'2019-03-13 19:41:16', '1', '0'),
('ROCHAT', 'Claude', '1', '18', 'CRT',null,'2019-03-13 19:41:16', '1', '0'),
('ROTEN', 'Cédric', '1', '20', 'CRN',null,'2019-03-13 19:41:16', '1', '0'),
('TINEMBART', 'Jean-Yves', '1', '22', 'JTT',null,'2019-10-31 00:00:00', '1', '0'),
('WULLIAMOZ', 'Didier', '1', '1089', 'DWZ',null,'2020-08-01 00:00:00', '1', '0'),
('ANDOLFATTO', 'Frédérique', '1', '7033', 'FAO',null,'2019-03-13 19:41:16', '1', '0'),
('VARELA', 'Francis', '1', '21', 'FVA',null,'2019-03-13 19:41:16', '1', '0'),
('ITHURBIDE', 'Julien', '1', '8311', 'JIE',null,'2019-05-20 00:00:00', '1', '0'),
('GLASSEY', 'Nicolas', '1', '8310', 'NGY',null,'2020-05-07 00:00:00', '1', '0'),
('WYSSA', 'Michael', '1', '9878', 'MWA',null,'2019-03-13 19:41:16', '1', '0'),
('LAYAZ', 'Agnes', '1', '7032', 'ALZ',null,'2019-03-13 19:41:16', '1', '0'),
('KONOUTSE', 'Yawo', '1', '12760', 'YKE',null,'2019-07-21 03:10:04', '1', '0'),
('VIRET', 'Loic', '1', '12768', 'LVT',null,'2019-07-21 03:10:04', '1', '0'),
('CLIGNEZ', 'David', '1', '14238', 'DCZ',null,'2020-04-08 03:10:06', '1', '0'),
('MARION', 'Romain', '1', '99999', 'RMN',null,'2020-04-08 03:10:06', '1', '1'),
('REGAMEY', 'Christophe', '1', '99999', 'CRY',null,'2020-04-08 03:10:06', '1', '1'),
('CHEVILLAT', 'Jérome', '1', '99999', 'JCT',null,'2020-04-08 03:10:06', '1', '1');


INSERT INTO `larasta`.`flocks`
	(`id`,`flockName`,`startYear`,`classMaster_id`)
SELECT
	IDVolee,LibelleVolee,AnneeDebut,(SELECT id FROM `larasta`.`persons` WHERE initials = (MaitreDeClasse COLLATE utf8_unicode_ci) LIMIT 1)
FROM app_internships.volee;

INSERT INTO `larasta`.`remarks`
(`id`,
`remarkType`,
`remarkOn_id`,
`remarkDate`,
`author`,
`remarkText`)
SELECT `remarque`.`IDRemarque`,
    `remarque`.`TypeRemarque`,
    `remarque`.`FKRemarqueSur`,
    `remarque`.`DateRemarque`,
    `remarque`.`Auteur`,
    `remarque`.`Texte`
FROM `app_internships`.`remarque`;

INSERT INTO `larasta`.`contracts`
(`id`,
`contractType`,
`contractText`)
SELECT `contrats`.`IDContrat`,
    `contrats`.`TypeContrat`,
    `contrats`.`TexteContrat`
FROM `app_internships`.`contrats`;

INSERT INTO `larasta`.`companies`
(`id`,
`companyName`,
`location_id`,
`website`,
`contracts_id`,
`englishSkills`,
`driverLicence`,
`mptOk`)
SELECT `entreprise`.`IDEntreprise`,
    `entreprise`.`NomEntreprise`,
    (SELECT id FROM locations WHERE entreprise.adresse1=locations.address1 COLLATE utf8_unicode_ci AND entreprise.NPA=locations.postalCode LIMIT 1),
    `entreprise`.`SiteWeb`,
    `entreprise`.`FKTypeContrat`,
    `entreprise`.`NiveauAnglais`,
    `entreprise`.`PermisConduire`,
    `entreprise`.`MatuOK`
FROM `app_internships`.`entreprise`;

INSERT INTO `larasta`.`contactinfos`
(`id`,
`contacttypes_id`,
`persons_id`,
`value`,
`rank`,
`icon`)
SELECT `contact`.`IDContact`,
    `contact`.`FKTypeContact`,
    `contact`.`FKPersonne`,
    `contact`.`Valeur`,
    `contact`.`Rang`,
    'unknown.png'
FROM `app_internships`.`contact`;

INSERT INTO `larasta`.`activitytypes`
(`id`,
`typeActivityDescription`,
`RequireDetails`)
SELECT `typeactivite`.`IDTypeActivite`,
    `typeactivite`.`DescriptionTypeActivite`,
    `typeactivite`.`RequireDetails`
FROM `app_internships`.`typeactivite`;

INSERT INTO `larasta`.`internships`
(`id`,
`companies_id`,
`beginDate`,
`endDate`,
`responsible_id`,
`admin_id`,
`intern_id`,
`contractstate_id`,
`previous_id`,
`parent_id`,
`internshipDescription`,
`grossSalary`,
`contractGenerated`,
`externalLogbook`)
SELECT `stage`.`IDStage`,
    `stage`.`FKEntreprise`,
    `stage`.`Debut`,
    `stage`.`Fin`,
    `stage`.`FKResp`,
    `stage`.`FKRespAdmin`,
    `stage`.`FKStagiaire`,
    `stage`.`FKStatusContrat`,
    `stage`.`FKPrecedent`,
    null,
    `stage`.`Descriptif`,
    `stage`.`SalaireBrut`,
    current_timestamp(),
    0
FROM `app_internships`.`stage`;

INSERT INTO `larasta`.`visitsstates`
(`id`,
`stateName`)
VALUES
(1,'proposé'),(2,'accepté');

INSERT INTO `larasta`.`visits`
(`id`,
`moment`,
`confirmed`,
`number`,
`internships_id`,
`grade`,
`visitsstates_id`,
`mailstate`)
SELECT `visite`.`IDVisite`,
    `visite`.`DateHeure`,
    `visite`.`Confirmee`,
    `visite`.`Numero`,
    `visite`.`FKStage`,
    `visite`.`Note`,
    1,
    0
FROM `app_internships`.`visite`;

INSERT INTO `larasta`.`logbooks`
(`id`,
`internships_id`,
`entryDate`,
`duration`,
`activityDescription`,
`activitytypes_id`)
SELECT `journal`.`IDJournal`,
    `journal`.`FKStage`,
    `journal`.`Date`,
    `journal`.`Duree`,
    `journal`.`DescriptionActivite`,
    `journal`.`FKTypeActivite`
FROM `app_internships`.`journal`;

INSERT INTO `larasta`.`wishes`
(`id`,
`internships_id`,
`persons_id`,
`rank`,
`workPlaceDistance`,
`application`)
SELECT `souhait`.`IDSouhait`,
    `souhait`.`FKStage`,
    `souhait`.`FKPersonne`,
    `souhait`.`Rang`,
    `souhait`.`DistanceLieux`,
    `souhait`.`Candidature`
FROM `app_internships`.`souhait`;

INSERT INTO `larasta`.`documents`
(`id`,
`description`,
`file`,
`internships_id`)
SELECT `documents`.`IDDocument`,
    `documents`.`Description`,
    `documents`.`Fichier`,
    `documents`.`FKStage`
FROM `app_internships`.`documents`;

SET FOREIGN_KEY_CHECKS = 1;

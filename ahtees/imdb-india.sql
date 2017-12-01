-- DBTools Manager Professional (Enterprise Edition)
-- Database Dump for: ahtees
-- Backup Generated in: 6/27/2008 11:56:56 PM
-- Database Server Version: MySQL 5.0.37

-- USEGO

SET FOREIGN_KEY_CHECKS=0;
-- GO


--
-- Dumping Tables
--

--
-- Table: aspect_ratio_master
--
CREATE TABLE `aspect_ratio_master` 
(
	`id` integer (10) NOT NULL AUTO_INCREMENT , 
	`description` varchar (30) NOT NULL, 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
);
-- GO

--
-- Dumping Table Data: aspect_ratio_master
--
BEGIN;
-- GO
INSERT INTO `aspect_ratio_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(5, '1.19:1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `aspect_ratio_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(6, '1.25:1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `aspect_ratio_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(7, '1.33:1', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Table: award_master
--
CREATE TABLE `award_master` 
(
	`id` integer (4) NOT NULL AUTO_INCREMENT , 
	`description` varchar (255) NOT NULL, 
	`initiated_by` varchar (100), 
	`initiated_date` datetime, 
	`purpose` varchar (255), 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: award_master
--
BEGIN;
-- GO
INSERT INTO `award_master` (`id`, `description`, `initiated_by`, `initiated_date`, `purpose`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(10, 'Life Time Acheivement', 'Bollywood Movie Awards', '1996-04-28 00:00:00', 'For life time acheivement', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `award_master` (`id`, `description`, `initiated_by`, `initiated_date`, `purpose`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(11, 'Best Actor', 'Bollywood Movie Awards', '1996-04-28 00:00:00', 'For the best actor of the year', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `award_master` (`id`, `description`, `initiated_by`, `initiated_date`, `purpose`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(12, 'Best Actor', 'Filmfare Award', '1999-04-28 00:00:00', 'For the best actor, award provided by filmfare', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `award_master` (`id`, `description`, `initiated_by`, `initiated_date`, `purpose`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(13, 'Best Actor', 'Oscar Award', '1934-04-28 00:00:00', 'The best actor from academy awards', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `award_master` (`id`, `description`, `initiated_by`, `initiated_date`, `purpose`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(14, 'Best Support Actor', 'Filmfare Award', '1969-12-31 16:00:00', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `award_master` (`id`, `description`, `initiated_by`, `initiated_date`, `purpose`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(15, 'Doctor', 'Anna University', '1972-05-02 00:00:00', 'Special award for actors.', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `award_master` (`id`, `description`, `initiated_by`, `initiated_date`, `purpose`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(16, 'Best Actor', 'Film Fare Awards', '1969-12-31 16:00:00', 'Best action for the year', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `award_master` (`id`, `description`, `initiated_by`, `initiated_date`, `purpose`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(18, 'Kalaimamani', 'Govt. of TamilNadu', '1969-12-31 16:00:00', 'Best Artist', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `award_master` (`id`, `description`, `initiated_by`, `initiated_date`, `purpose`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(19, 'Padma Shri', 'Govt. of India', '1969-12-31 16:00:00', 'Life Time Achievement', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `award_master` (`id`, `description`, `initiated_by`, `initiated_date`, `purpose`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(20, 'Best Supporting Actress', 'Govt. of India', '1969-12-31 16:00:00', 'Supporting Role', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `award_master` (`id`, `description`, `initiated_by`, `initiated_date`, `purpose`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(21, 'M.G.R. Award', 'Govt. of TamilNadu', '1969-12-31 16:00:00', 'Best Actor', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `award_master` (`id`, `description`, `initiated_by`, `initiated_date`, `purpose`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(22, 'National Award', 'Govt. Of India', '1969-12-31 16:00:00', 'Best Music Dirctor', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `award_master` (`id`, `description`, `initiated_by`, `initiated_date`, `purpose`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(23, 'Best Singer', 'Govt. of India', '1969-12-31 16:00:00', 'Best Playback Singer', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Table: award_master_extension
--
CREATE TABLE `award_master_extension` 
(
	`award_id` integer (10) NOT NULL AUTO_INCREMENT , 
	`system_lang_code_id` integer (10) NOT NULL, 
	`description` varchar (255) NOT NULL, 
	`initiated_by` varchar (100), 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime, 
	`purpose` varchar (255),
	PRIMARY KEY (`award_id`)
) ;
-- GO

--
-- Dumping Table Data: award_master_extension
--
BEGIN;
-- GO
COMMIT;
-- GO

--
-- Index: IDX_award_master_extension_2
--
ALTER TABLE `ahtees`.`award_master_extension` ADD INDEX IDX_award_master_extension_2 (system_lang_code_id );
-- GO

--
-- Table: category_master
--
CREATE TABLE `category_master` 
(
	`id` integer (4) NOT NULL AUTO_INCREMENT , 
	`description` varchar (255) NOT NULL, 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: category_master
--
BEGIN;
-- GO
INSERT INTO `category_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(7, 'Comedy', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `category_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(8, 'Drama', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `category_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(9, 'Horror', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `category_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(10, 'Thriller', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `category_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(11, 'Romantic', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `category_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(12, 'Adventure', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `category_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(13, 'Epic/Historical', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `category_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(14, 'Musical', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `category_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(15, 'Science Fiction', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `category_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(16, 'War or Anti-war', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `category_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(17, 'Animation', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `category_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(18, 'Fantasy', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `category_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(19, 'Religious', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `category_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(20, 'Supernatural', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `category_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(21, 'Sports', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `category_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(22, 'Detective/Mystery', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `category_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(23, 'Terrorism', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `category_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(24, 'Unknown Category', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `category_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(25, 'Family', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `category_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(26, 'Social', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `category_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(27, 'Action', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Table: category_master_extension
--
CREATE TABLE `category_master_extension` 
(
	`category_id` integer (10) NOT NULL AUTO_INCREMENT , 
	`system_lang_code_id` integer (10) NOT NULL, 
	`description` varchar (255) NOT NULL, 
	`detail_desc` varchar (1000),
	PRIMARY KEY (`category_id`)
) ;
-- GO

--
-- Dumping Table Data: category_master_extension
--
BEGIN;
-- GO
COMMIT;
-- GO

--
-- Index: category_id
--
ALTER TABLE `ahtees`.`category_master_extension` ADD UNIQUE category_id (category_id,system_lang_code_id );
-- GO

--
-- Index: IDX_category_master_extension_3
--
ALTER TABLE `ahtees`.`category_master_extension` ADD INDEX IDX_category_master_extension_3 (system_lang_code_id );
-- GO

--
-- Table: content_type_file_extensions
--
CREATE TABLE `content_type_file_extensions` 
(
	`id` integer (10) NOT NULL AUTO_INCREMENT , 
	`content_type_id` integer (10) NOT NULL, 
	`file_extension` varchar (10) NOT NULL, 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: content_type_file_extensions
--
BEGIN;
-- GO
INSERT INTO `content_type_file_extensions` (`id`, `content_type_id`, `file_extension`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(1, 5, '.jpg', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `content_type_file_extensions` (`id`, `content_type_id`, `file_extension`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(3, 6, '.wav', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `content_type_file_extensions` (`id`, `content_type_id`, `file_extension`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(4, 11, '.mp3', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `content_type_file_extensions` (`id`, `content_type_id`, `file_extension`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(5, 5, '.gif', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `content_type_file_extensions` (`id`, `content_type_id`, `file_extension`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(6, 6, '.mp3', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `content_type_file_extensions` (`id`, `content_type_id`, `file_extension`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(7, 0, '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `content_type_file_extensions` (`id`, `content_type_id`, `file_extension`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(8, 10, '.3pg', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `content_type_file_extensions` (`id`, `content_type_id`, `file_extension`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(9, 14, '.avi', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Index: IDX_content_type_file_extensions_2
--
ALTER TABLE `ahtees`.`content_type_file_extensions` ADD INDEX IDX_content_type_file_extensions_2 (content_type_id );
-- GO

--
-- Table: content_type_master
--
CREATE TABLE `content_type_master` 
(
	`id` integer (2) NOT NULL AUTO_INCREMENT , 
	`description` varchar (50) NOT NULL, 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: content_type_master
--
BEGIN;
-- GO
INSERT INTO `content_type_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(5, 'Picture', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `content_type_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(6, 'Ring Tone', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `content_type_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(8, 'Trailers', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `content_type_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(10, 'Mobile Movie', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `content_type_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(11, 'mp3', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `content_type_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(13, 'Movie Clips (MP4)', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Table: country_master
--
CREATE TABLE `country_master` 
(
	`id` integer (10) NOT NULL AUTO_INCREMENT , 
	`name` varchar (50) NOT NULL, 
	`altitude` varchar (10), 
	`latitude` varchar (10), 
	`timezone_id` varchar (50), 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: country_master
--
BEGIN;
-- GO
INSERT INTO `country_master` (`id`, `name`, `altitude`, `latitude`, `timezone_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(4, 'India', '', '', 'IST', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `country_master` (`id`, `name`, `altitude`, `latitude`, `timezone_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(5, 'USA', '', '', 'GMT', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Index: IDX_country_master_2
--
ALTER TABLE `ahtees`.`country_master` ADD INDEX IDX_country_master_2 (timezone_id );
-- GO

--
-- Table: customer_award
--
CREATE TABLE `customer_award` 
(
	`id` integer (11) NOT NULL AUTO_INCREMENT , 
	`customer_id` char (32) NOT NULL, 
	`award_id` integer (4) NOT NULL, 
	`movie_id` integer (11), 
	`received_date` datetime, 
	`received_occassion` varchar (150), 
	`given_by` varchar (100), 
	`money_received` float (10,2), 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: customer_award
--
BEGIN;
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(7, '4', 2, NULL, '2008-04-12 00:00:00', 'test', 'test', 344.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(12, '4', 0, NULL, '2008-04-18 00:00:00', 'john david sykes the third, principle', 'myself and you', 3434333.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(13, '4', 2, NULL, '2008-04-19 00:00:00', 'john david sykes, III, principle', 'myself and you', 343433.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(15, '4', 2, NULL, '2008-04-17 00:00:00', 'test', 'test', 343.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(16, '4', 1, NULL, '2008-04-19 00:00:00', '4234', '24', 2343.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(22, '3', 1, NULL, '2008-04-11 00:00:00', 'test', 'test', 343.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(23, '3', 2, NULL, '2008-04-16 00:00:00', 'teest', 'test', 34.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(24, '3', 2, NULL, '2008-04-23 00:00:00', '4324', '234', 234.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(25, '3', 2, NULL, '2008-04-10 00:00:00', 'etst', 'test', 344.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(26, '3', 2, NULL, '2008-04-10 00:00:00', '23423', '23', 34.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(27, '3', 2, NULL, '2008-04-17 00:00:00', 'test', 'test', 343.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(28, '3', 1, NULL, '2008-04-17 00:00:00', '5', 'rrtr', 566.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(29, '3', 7, NULL, '2008-04-25 00:00:00', 'special', 'dave', 3232.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(32, '', 10, NULL, '2008-04-29 00:00:00', 'Special', 'Dave', 1000.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(34, '5', 10, NULL, '2008-05-08 00:00:00', '123', '123`', 123.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(35, '3', 10, NULL, '2008-06-12 00:00:00', '50th Birthday', 'Kumar', 100000.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(36, '6', 10, NULL, '2008-06-26 00:00:00', 'SDFGSDFG', 'DSFGDFG', 213123.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(37, '19', 10, NULL, '2008-06-12 00:00:00', '', 'asdsad', 112.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(38, '20', 11, NULL, '1977-01-01 00:00:00', '', 'Arima Sangam', 10000.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(39, '23', 18, NULL, '1969-12-31 16:00:00', 'Tamil Nadu Govt. Function', 'Kalaignar Karunanithi', 100000.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(41, '23', 19, NULL, '2002-01-01 00:00:00', '', 'President of India', 100000.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(42, '23', 20, NULL, '1988-01-01 00:00:00', '', '', 100000.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(43, '17', 19, NULL, '1969-12-31 16:00:00', '', 'President', 100000.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(44, '25', 18, NULL, '2005-01-01 00:00:00', 'TamilNadu Govt. Function', 'Kalignar Karunanithi', 100000.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(45, '26', 11, NULL, '1969-12-31 16:00:00', 'State function', 'Chief Minister', 100000.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(46, '28', 18, NULL, '1969-12-31 16:00:00', 'Tamilnadu Govt. function', 'Chief Minister', 100000.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(47, '28', 21, NULL, '1969-12-31 16:00:00', 'Tamilnadu Govt. function', 'Chief Minister', 100000.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(48, '29', 18, NULL, '1969-12-31 16:00:00', 'Tamilnadu Govt. Function', 'Chief Minister', 100000.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(49, '31', 19, NULL, '1969-12-31 16:00:00', 'Indian Govt. Function', '', 100000.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(50, '32', 22, NULL, '1969-12-31 16:00:00', 'Indian Govt. Function', 'Govt. of Inda', 100000.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(51, '3', 10, NULL, '2008-06-13 00:00:00', 'test', 'test', 0.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(52, '7', 0, NULL, '2008-06-18 00:00:00', 'test', 'test', 0.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(53, '7', 0, NULL, '2008-06-18 00:00:00', 'test', 'test', 0.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(54, '7', 0, NULL, '2008-06-18 00:00:00', 'test', 'test', 0.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(55, '7', 12, 21, '2008-06-20 00:00:00', 'test', 'test', 0.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(58, '7', 12, NULL, '2008-06-20 00:00:00', 'test', 'test', 0.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(60, '7', 10, 9, '2008-06-19 00:00:00', 'test', 'test', 0.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(61, '26', 18, 14, '2008-06-28 00:00:00', 'asd', 'asd', 0.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(62, '26', 20, 0, '2008-06-21 00:00:00', 'asd', 'asd', 0.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(63, '26', 18, 0, '2008-06-19 00:00:00', 'asda', 'sdasd', 0.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(64, '26', 10, 10, '1969-12-31 16:00:00', 'sdfg', 'sdfg', 0.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(65, '14', 11, 7, '2008-06-16 00:00:00', 'asdf', 'asdf', 0.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(66, '33', 19, 0, '1969-12-31 16:00:00', 'Indian Govt. Function', 'President of India', 0.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(67, '33', 19, 0, '1972-01-01 21:39:40', 'Indian Govt. Function', 'President of India', 100000.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(68, '33', 19, 0, '1973-01-01 00:00:00', 'Indian Govt. Function', 'President of India', 100000.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(69, '33', 19, 20, '1969-12-31 16:00:00', 'Indian Govt. Function', 'President of India', 100000.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(70, '33', 22, 0, '1969-12-31 16:00:00', 'Some crap', '', 0.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(71, '4', 10, 0, '2008-06-25 00:00:00', 'test', 'test', 300.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(73, '4', 0, 1, '2008-06-26 00:00:00', 'test', 'test', 400.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(77, '4', 11, NULL, '2008-06-26 00:00:00', 'test', 'test', 33.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(78, '8', 22, NULL, '1969-12-31 16:00:00', 'weqew', '`wefrewr', 0.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_award` (`id`, `customer_id`, `award_id`, `movie_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(79, '8', 19, 14, '1969-12-31 16:00:00', 'afadsf', 'wqerewr', 0.00, NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Index: IDX_customer_award_2
--
ALTER TABLE `ahtees`.`customer_award` ADD INDEX IDX_customer_award_2 (customer_id,award_id );
-- GO

--
-- Index: IDX_customer_award_3
--
ALTER TABLE `ahtees`.`customer_award` ADD INDEX IDX_customer_award_3 (customer_id,award_id );
-- GO

--
-- Table: customer_digital_content
--
CREATE TABLE `customer_digital_content` 
(
	`id` integer (11) NOT NULL DEFAULT 0, 
	`customer_id` integer (11) NOT NULL, 
	`content_type_id` integer (2) NOT NULL, 
	`content_path` varchar (1000) NOT NULL, 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime
) ;
-- GO

--
-- Dumping Table Data: customer_digital_content
--
BEGIN;
-- GO
INSERT INTO `customer_digital_content` (`id`, `customer_id`, `content_type_id`, `content_path`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(0, 3, 5, 'customer/content/3_5_ghost2.jpg', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_digital_content` (`id`, `customer_id`, `content_type_id`, `content_path`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(0, 7, 5, 'customer/content/7_5_suriya_ayan1.jpg', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_digital_content` (`id`, `customer_id`, `content_type_id`, `content_path`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(0, 8, 5, 'customer/content/8_5_arjun1.jpg', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_digital_content` (`id`, `customer_id`, `content_type_id`, `content_path`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(0, 9, 5, 'customer/content/9_5_r-madhavan-8245-maddy_photo1.jpg', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_digital_content` (`id`, `customer_id`, `content_type_id`, `content_path`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(0, 10, 5, 'customer/content/10_5_jai_3.jpg', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_digital_content` (`id`, `customer_id`, `content_type_id`, `content_path`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(0, 20, 5, 'customer/content/20_5_rajinikanth_0100.jpg', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_digital_content` (`id`, `customer_id`, `content_type_id`, `content_path`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(0, 23, 5, 'customer/content/23_5_2006062901710201.jpg', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_digital_content` (`id`, `customer_id`, `content_type_id`, `content_path`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(0, 24, 5, 'customer/content/24_5_16_1206441829.jpg', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_digital_content` (`id`, `customer_id`, `content_type_id`, `content_path`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(0, 17, 5, 'customer/content/17_5_kamal4_1024.jpg', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_digital_content` (`id`, `customer_id`, `content_type_id`, `content_path`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(0, 25, 5, 'customer/content/25_5_jothika.jpg', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_digital_content` (`id`, `customer_id`, `content_type_id`, `content_path`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(0, 26, 5, 'customer/content/26_5_veruthe-oru-bharya-2.jpg', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_digital_content` (`id`, `customer_id`, `content_type_id`, `content_path`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(0, 27, 5, 'customer/content/27_5_Devayani.jpg', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_digital_content` (`id`, `customer_id`, `content_type_id`, `content_path`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(0, 28, 5, 'customer/content/28_5_satyaraj-wallpaper.jpg', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_digital_content` (`id`, `customer_id`, `content_type_id`, `content_path`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(0, 29, 5, 'customer/content/29_5_Vaali.jpg', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_digital_content` (`id`, `customer_id`, `content_type_id`, `content_path`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(0, 31, 5, 'customer/content/31_5_Thotta_Tharani.jpg', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_digital_content` (`id`, `customer_id`, `content_type_id`, `content_path`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(0, 32, 5, 'customer/content/32_5_iraja.jpg', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_digital_content` (`id`, `customer_id`, `content_type_id`, `content_path`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(0, 7, 5, 'customer/content/7_5_Humpback Whale.jpg', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_digital_content` (`id`, `customer_id`, `content_type_id`, `content_path`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(0, 33, 5, 'customer/content/33_5_KJJ.jpg', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_digital_content` (`id`, `customer_id`, `content_type_id`, `content_path`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(0, 4, 5, 'customer/content/4_5_ghost2.jpg', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Table: customer_language
--
CREATE TABLE `customer_language` 
(
	`id` integer (11) NOT NULL AUTO_INCREMENT , 
	`customer_id` char (32) NOT NULL, 
	`lang_id` integer (4) NOT NULL, 
	`fluency_level` integer (1), 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: customer_language
--
BEGIN;
-- GO
INSERT INTO `customer_language` (`id`, `customer_id`, `lang_id`, `fluency_level`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(3, '3', 1, 3, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_language` (`id`, `customer_id`, `lang_id`, `fluency_level`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(4, '4', 5, 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_language` (`id`, `customer_id`, `lang_id`, `fluency_level`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(5, '4', 18, 3, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_language` (`id`, `customer_id`, `lang_id`, `fluency_level`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(6, '6', 16, 2, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_language` (`id`, `customer_id`, `lang_id`, `fluency_level`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(7, '7', 1, 4, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_language` (`id`, `customer_id`, `lang_id`, `fluency_level`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(8, '8', 1, 4, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_language` (`id`, `customer_id`, `lang_id`, `fluency_level`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(9, '9', 1, 4, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_language` (`id`, `customer_id`, `lang_id`, `fluency_level`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(10, '9', 3, 4, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_language` (`id`, `customer_id`, `lang_id`, `fluency_level`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(11, '9', 4, 4, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_language` (`id`, `customer_id`, `lang_id`, `fluency_level`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(13, '10', 1, 3, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_language` (`id`, `customer_id`, `lang_id`, `fluency_level`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(14, '20', 1, 2, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_language` (`id`, `customer_id`, `lang_id`, `fluency_level`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(15, '17', 1, 4, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_language` (`id`, `customer_id`, `lang_id`, `fluency_level`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(16, '17', 3, 4, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_language` (`id`, `customer_id`, `lang_id`, `fluency_level`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(17, '17', 4, 3, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_language` (`id`, `customer_id`, `lang_id`, `fluency_level`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(18, '17', 10, 3, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_language` (`id`, `customer_id`, `lang_id`, `fluency_level`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(19, '17', 2, 3, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_language` (`id`, `customer_id`, `lang_id`, `fluency_level`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(20, '25', 1, 3, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_language` (`id`, `customer_id`, `lang_id`, `fluency_level`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(21, '25', 3, 4, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_language` (`id`, `customer_id`, `lang_id`, `fluency_level`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(22, '25', 4, 3, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_language` (`id`, `customer_id`, `lang_id`, `fluency_level`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(23, '26', 1, 3, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_language` (`id`, `customer_id`, `lang_id`, `fluency_level`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(24, '26', 10, 4, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_language` (`id`, `customer_id`, `lang_id`, `fluency_level`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(25, '28', 1, 3, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_language` (`id`, `customer_id`, `lang_id`, `fluency_level`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(26, '29', 1, 0, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_language` (`id`, `customer_id`, `lang_id`, `fluency_level`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(27, '31', 1, 2, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_language` (`id`, `customer_id`, `lang_id`, `fluency_level`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(28, '31', 4, 3, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_language` (`id`, `customer_id`, `lang_id`, `fluency_level`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(29, '32', 1, 4, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_language` (`id`, `customer_id`, `lang_id`, `fluency_level`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(30, '32', 10, 3, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_language` (`id`, `customer_id`, `lang_id`, `fluency_level`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(31, '33', 1, 4, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_language` (`id`, `customer_id`, `lang_id`, `fluency_level`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(32, '33', 10, 4, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_language` (`id`, `customer_id`, `lang_id`, `fluency_level`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(33, '33', 4, 3, NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Index: IDX_customer_language_2
--
ALTER TABLE `ahtees`.`customer_language` ADD INDEX IDX_customer_language_2 (customer_id,lang_id );
-- GO

--
-- Index: IDX_customer_language_3
--
ALTER TABLE `ahtees`.`customer_language` ADD INDEX IDX_customer_language_3 (customer_id,lang_id );
-- GO

--
-- Table: customer_master
--
CREATE TABLE `customer_master` 
(
	`customer_id` integer (11) NOT NULL AUTO_INCREMENT , 
	`user_id` varchar (30), 
	`password` varchar (30), 
	`first_name` varchar (100), 
	`last_name` varchar (100), 
	`middle_name` varchar (100), 
	`star_name` varchar (100), 
	`star_title` varchar (50), 
	`date_of_birth` datetime, 
	`birth_city` varchar (100), 
	`birth_state` integer (11), 
	`birth_country` integer (11), 
	`mother_tongue` integer (4), 
	`address_1` varchar (100), 
	`address_2` varchar (100), 
	`city` varchar (100), 
	`state` integer (11), 
	`zip` varchar (50), 
	`country` integer (11), 
	`status_id` integer (1), 
	`total_worth` integer (11), 
	`education_degree` integer (11), 
	`self_promo_text` varchar (500), 
	`school_info` varchar (500), 
	`college_info` varchar (500), 
	`status` integer (11) DEFAULT 1, 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`customer_id`)
) ;
-- GO

--
-- Dumping Table Data: customer_master
--
BEGIN;
-- GO
INSERT INTO `customer_master` (`customer_id`, `user_id`, `password`, `first_name`, `last_name`, `middle_name`, `star_name`, `star_title`, `date_of_birth`, `birth_city`, `birth_state`, `birth_country`, `mother_tongue`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `status_id`, `total_worth`, `education_degree`, `self_promo_text`, `school_info`, `college_info`, `status`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(3, NULL, NULL, 'John', 'Sykes', 'David', 'Speed Racer', NULL, '1968-08-29 00:00:00', 'Jacksonville', NULL, NULL, 0, '1700 Ronald Loop', 'NONE', 'Placerville', NULL, '95667', NULL, 0, NULL, NULL, 'I guess i\'m just ok!', 'Monta Vista High School, Cupertino, CA', 'De Anza College, Cupertino, CA', 0, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_master` (`customer_id`, `user_id`, `password`, `first_name`, `last_name`, `middle_name`, `star_name`, `star_title`, `date_of_birth`, `birth_city`, `birth_state`, `birth_country`, `mother_tongue`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `status_id`, `total_worth`, `education_degree`, `self_promo_text`, `school_info`, `college_info`, `status`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(4, NULL, NULL, 'Joanne', 'Caldwell', '', 'Sadie', NULL, '1968-09-21 00:00:00', 'Ormsby', NULL, NULL, 0, '1700 Ronald Loop', 'NONE', 'Placerville', NULL, '95667', NULL, 0, NULL, NULL, 'Sweet as pie, but cross me and I will pound you! ', 'Cupertino High School, Cupertino, CA', 'De Anza, Cupertino, CA\r\nSan Jose State, San Jose, CA', 0, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_master` (`customer_id`, `user_id`, `password`, `first_name`, `last_name`, `middle_name`, `star_name`, `star_title`, `date_of_birth`, `birth_city`, `birth_state`, `birth_country`, `mother_tongue`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `status_id`, `total_worth`, `education_degree`, `self_promo_text`, `school_info`, `college_info`, `status`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(5, NULL, NULL, 'Krishnan', 'Kris', 'Srinivasan', 'Super Star', NULL, '1975-07-30 00:00:00', 'Shencottah', NULL, NULL, 0, '192,SE stre', '', 'Shent', NULL, '98075', NULL, 0, NULL, NULL, 'No promotion for him', 'He didn\'t go to school', 'He never stepped foot into a new college', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_master` (`customer_id`, `user_id`, `password`, `first_name`, `last_name`, `middle_name`, `star_name`, `star_title`, `date_of_birth`, `birth_city`, `birth_state`, `birth_country`, `mother_tongue`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `status_id`, `total_worth`, `education_degree`, `self_promo_text`, `school_info`, `college_info`, `status`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(6, NULL, NULL, 'Sivaji', 'Rao', '', 'Rajini Kanth', NULL, '2004-06-15 00:00:00', 'sadfjk', 3, 4, 1, 'sadfasdf', 'sadfsd', 'sadfsadf', 2, '123213', 5, 8, 1, 1, 'sadf', 'sadfa', 'sdfasdf', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_master` (`customer_id`, `user_id`, `password`, `first_name`, `last_name`, `middle_name`, `star_name`, `star_title`, `date_of_birth`, `birth_city`, `birth_state`, `birth_country`, `mother_tongue`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `status_id`, `total_worth`, `education_degree`, `self_promo_text`, `school_info`, `college_info`, `status`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(7, NULL, NULL, 'Suriya', '', '', 'Suriya', ' ', '1969-12-31 16:00:00', 'Chennai', 0, 0, 0, '', '', 'Chennai', 0, '600001', 0, 0, 0, 0, '', '', '', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_master` (`customer_id`, `user_id`, `password`, `first_name`, `last_name`, `middle_name`, `star_name`, `star_title`, `date_of_birth`, `birth_city`, `birth_state`, `birth_country`, `mother_tongue`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `status_id`, `total_worth`, `education_degree`, `self_promo_text`, `school_info`, `college_info`, `status`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(8, NULL, NULL, 'Arjun', '', '', 'Arjun', NULL, '1969-12-31 16:00:00', 'Banglore', 6, 4, 2, '', '', 'Chennai', 4, '', 4, 8, 1, 1, '', '', '', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_master` (`customer_id`, `user_id`, `password`, `first_name`, `last_name`, `middle_name`, `star_name`, `star_title`, `date_of_birth`, `birth_city`, `birth_state`, `birth_country`, `mother_tongue`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `status_id`, `total_worth`, `education_degree`, `self_promo_text`, `school_info`, `college_info`, `status`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(9, NULL, NULL, 'Ranganathan', 'Madhavan', '', 'Madhavan (Maagi)', NULL, '1970-01-06 00:00:00', 'Jamshedpur', 0, 0, 0, '', '', 'Chennai', 0, '627001', 0, 0, 0, 0, '', '', '', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_master` (`customer_id`, `user_id`, `password`, `first_name`, `last_name`, `middle_name`, `star_name`, `star_title`, `date_of_birth`, `birth_city`, `birth_state`, `birth_country`, `mother_tongue`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `status_id`, `total_worth`, `education_degree`, `self_promo_text`, `school_info`, `college_info`, `status`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(10, NULL, NULL, 'Prasanth', '', '', 'Kathal Ilavarsan', NULL, '1969-12-31 16:00:00', '', 0, 0, 0, '', '', '', 0, '', 0, 0, 0, 0, '', '', '', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_master` (`customer_id`, `user_id`, `password`, `first_name`, `last_name`, `middle_name`, `star_name`, `star_title`, `date_of_birth`, `birth_city`, `birth_state`, `birth_country`, `mother_tongue`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `status_id`, `total_worth`, `education_degree`, `self_promo_text`, `school_info`, `college_info`, `status`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(11, NULL, NULL, 'Sidharth', '', '', 'Sidharth', NULL, '1969-12-31 16:00:00', '', 0, 0, 0, '', '', '', 0, '', 0, 0, 0, 0, '', '', '', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_master` (`customer_id`, `user_id`, `password`, `first_name`, `last_name`, `middle_name`, `star_name`, `star_title`, `date_of_birth`, `birth_city`, `birth_state`, `birth_country`, `mother_tongue`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `status_id`, `total_worth`, `education_degree`, `self_promo_text`, `school_info`, `college_info`, `status`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(12, NULL, NULL, 'Bharath', '', '', 'Bharath', NULL, '1969-12-31 16:00:00', '', 0, 0, 0, '', '', '', 0, '', 0, 0, 0, 0, '', '', '', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_master` (`customer_id`, `user_id`, `password`, `first_name`, `last_name`, `middle_name`, `star_name`, `star_title`, `date_of_birth`, `birth_city`, `birth_state`, `birth_country`, `mother_tongue`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `status_id`, `total_worth`, `education_degree`, `self_promo_text`, `school_info`, `college_info`, `status`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(13, NULL, NULL, 'Sai', '', '', 'Sai', NULL, '1969-12-31 16:00:00', '', 0, 0, 0, '', '', '', 0, '', 0, 8, 0, 0, '', '', '', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_master` (`customer_id`, `user_id`, `password`, `first_name`, `last_name`, `middle_name`, `star_name`, `star_title`, `date_of_birth`, `birth_city`, `birth_state`, `birth_country`, `mother_tongue`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `status_id`, `total_worth`, `education_degree`, `self_promo_text`, `school_info`, `college_info`, `status`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(14, NULL, NULL, 'Manikandan', '', '', 'Manikandan', NULL, '1969-12-31 16:00:00', '', 0, 0, 0, '', '', '', 0, '', 0, 8, 0, 0, '', '', '', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_master` (`customer_id`, `user_id`, `password`, `first_name`, `last_name`, `middle_name`, `star_name`, `star_title`, `date_of_birth`, `birth_city`, `birth_state`, `birth_country`, `mother_tongue`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `status_id`, `total_worth`, `education_degree`, `self_promo_text`, `school_info`, `college_info`, `status`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(15, NULL, NULL, 'Nakul', '', '', 'Nakul', NULL, '1969-12-31 16:00:00', '', 0, 0, 0, '', '', '', 0, '', 0, 8, 0, 0, '', '', '', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_master` (`customer_id`, `user_id`, `password`, `first_name`, `last_name`, `middle_name`, `star_name`, `star_title`, `date_of_birth`, `birth_city`, `birth_state`, `birth_country`, `mother_tongue`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `status_id`, `total_worth`, `education_degree`, `self_promo_text`, `school_info`, `college_info`, `status`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(16, NULL, NULL, 'Sivaji', 'Rao', '', 'Rajni Kanth', 'Super Star', '1938-06-13 00:00:00', 'Bangalore', 0, 0, 0, 'Don\'t know', '', 'Chennai', 0, '1234556', 0, 0, 0, 0, 'Spiritual, self-confident, and simple.', 'No one is aware that if he went to school or not.', 'Same as school', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_master` (`customer_id`, `user_id`, `password`, `first_name`, `last_name`, `middle_name`, `star_name`, `star_title`, `date_of_birth`, `birth_city`, `birth_state`, `birth_country`, `mother_tongue`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `status_id`, `total_worth`, `education_degree`, `self_promo_text`, `school_info`, `college_info`, `status`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(17, NULL, NULL, 'Kamal', 'Hasan', '', 'Kamal', NULL, '1954-11-07 00:00:00', 'Paramakudi', 4, 4, 1, '', '', 'Chennai', 4, '12324', 4, 8, 4, 1, '', '', '', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_master` (`customer_id`, `user_id`, `password`, `first_name`, `last_name`, `middle_name`, `star_name`, `star_title`, `date_of_birth`, `birth_city`, `birth_state`, `birth_country`, `mother_tongue`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `status_id`, `total_worth`, `education_degree`, `self_promo_text`, `school_info`, `college_info`, `status`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(18, NULL, NULL, 'Jothika', '', '', 'Jo', NULL, '1978-06-22 00:00:00', 'Bombay', 8, 4, 0, '', '', 'Chennai', 4, '123456', 4, 9, 2, 2, '', '', '', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_master` (`customer_id`, `user_id`, `password`, `first_name`, `last_name`, `middle_name`, `star_name`, `star_title`, `date_of_birth`, `birth_city`, `birth_state`, `birth_country`, `mother_tongue`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `status_id`, `total_worth`, `education_degree`, `self_promo_text`, `school_info`, `college_info`, `status`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(19, NULL, NULL, 'Asin', 'Asin', '', 'Asin', NULL, '1985-05-20 00:00:00', '', 5, 4, 10, '', '', 'Chennai', 4, '', 4, 8, 1, 1, '', '', '', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_master` (`customer_id`, `user_id`, `password`, `first_name`, `last_name`, `middle_name`, `star_name`, `star_title`, `date_of_birth`, `birth_city`, `birth_state`, `birth_country`, `mother_tongue`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `status_id`, `total_worth`, `education_degree`, `self_promo_text`, `school_info`, `college_info`, `status`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(20, NULL, NULL, 'SivajiRao', 'Gaikwad', '', 'Rajinikanth', NULL, '1950-12-12 00:00:00', 'Banglore', 0, 0, 0, '18, Raghava Veera Avenue, ', 'Poes Garden.', 'Chennai', 0, '600086', 0, 0, 0, 0, '', '', '', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_master` (`customer_id`, `user_id`, `password`, `first_name`, `last_name`, `middle_name`, `star_name`, `star_title`, `date_of_birth`, `birth_city`, `birth_state`, `birth_country`, `mother_tongue`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `status_id`, `total_worth`, `education_degree`, `self_promo_text`, `school_info`, `college_info`, `status`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(21, NULL, NULL, 'Vijaya', 'Shanthi', '', 'Vijaya Shanthi', NULL, '1969-12-31 16:00:00', '', 0, 0, 0, '', '', '', 0, '', 0, 0, 0, 0, '', '', '', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_master` (`customer_id`, `user_id`, `password`, `first_name`, `last_name`, `middle_name`, `star_name`, `star_title`, `date_of_birth`, `birth_city`, `birth_state`, `birth_country`, `mother_tongue`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `status_id`, `total_worth`, `education_degree`, `self_promo_text`, `school_info`, `college_info`, `status`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(22, NULL, NULL, 'Kushboo', '', '', 'Kushboo', NULL, '1969-12-31 16:00:00', '', 0, 0, 0, '', '', '', 0, '', 0, 0, 0, 0, '', '', '', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_master` (`customer_id`, `user_id`, `password`, `first_name`, `last_name`, `middle_name`, `star_name`, `star_title`, `date_of_birth`, `birth_city`, `birth_state`, `birth_country`, `mother_tongue`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `status_id`, `total_worth`, `education_degree`, `self_promo_text`, `school_info`, `college_info`, `status`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(23, NULL, NULL, 'Manorama', '', '', 'Manorama', NULL, '1943-05-24 00:00:00', 'Pallathur', 4, 4, 1, '', '', '', 4, '', 4, 8, 3, 0, '', '', '', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_master` (`customer_id`, `user_id`, `password`, `first_name`, `last_name`, `middle_name`, `star_name`, `star_title`, `date_of_birth`, `birth_city`, `birth_state`, `birth_country`, `mother_tongue`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `status_id`, `total_worth`, `education_degree`, `self_promo_text`, `school_info`, `college_info`, `status`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(24, NULL, NULL, 'Goundamani', '', '', 'Goundamani', NULL, '1969-12-31 16:00:00', 'Coimbatore', 4, 4, 0, '', '', '', 0, '', 0, 8, 0, 0, '', '', '', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_master` (`customer_id`, `user_id`, `password`, `first_name`, `last_name`, `middle_name`, `star_name`, `star_title`, `date_of_birth`, `birth_city`, `birth_state`, `birth_country`, `mother_tongue`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `status_id`, `total_worth`, `education_degree`, `self_promo_text`, `school_info`, `college_info`, `status`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(25, NULL, NULL, 'Jothika', 'Sadhanah', '', 'Jothika', NULL, '1969-12-31 16:00:00', 'Mumbai', 8, 4, 3, '', '', 'Chennai', 4, '', 4, 8, 1, 1, '', '', '', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_master` (`customer_id`, `user_id`, `password`, `first_name`, `last_name`, `middle_name`, `star_name`, `star_title`, `date_of_birth`, `birth_city`, `birth_state`, `birth_country`, `mother_tongue`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `status_id`, `total_worth`, `education_degree`, `self_promo_text`, `school_info`, `college_info`, `status`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(26, NULL, NULL, 'Jeyaram', 'Subramaniam', '', 'Jeyaram', NULL, '1964-01-15 00:00:00', 'Perumbavoor', 5, 4, 0, '', '', 'Trivandram', 5, '', 4, 8, 2, 1, '', '', '', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_master` (`customer_id`, `user_id`, `password`, `first_name`, `last_name`, `middle_name`, `star_name`, `star_title`, `date_of_birth`, `birth_city`, `birth_state`, `birth_country`, `mother_tongue`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `status_id`, `total_worth`, `education_degree`, `self_promo_text`, `school_info`, `college_info`, `status`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(27, NULL, NULL, 'Devayani', 'Rajakumaran', '', 'Devayani', NULL, '1973-06-22 00:00:00', 'Mumbai', 0, 0, 0, '', '', 'Chennai', 0, '', 0, 0, 0, 0, '', '', 'B.Com in National College of Mumbai.', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_master` (`customer_id`, `user_id`, `password`, `first_name`, `last_name`, `middle_name`, `star_name`, `star_title`, `date_of_birth`, `birth_city`, `birth_state`, `birth_country`, `mother_tongue`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `status_id`, `total_worth`, `education_degree`, `self_promo_text`, `school_info`, `college_info`, `status`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(28, NULL, NULL, 'Rengaraj', '', '', 'Sathyaraj', NULL, '1954-10-03 00:00:00', 'Coimbatore', 4, 4, 1, '', '', 'Chennai', 4, '', 4, 8, 0, 1, 'One day Sathyaraj went to see the shooting of the film Annakkili, where he met actor Sivakumar. In Chennai, he met actor Sivakumar and producer Thiruppur Manian and started pestering them to help fulfill his cinematic ambitions.', 'Sathyaraj completed his primary school education in Tamil at St Mary\'s Convent,Coimbatore. He completed the equivalent of the tenth standard in a suburban high school, Ramnagar, Coimbatore. In primary school, he was a first rank holder.He passed his SSLC (Class 10 boards), scoring first-rank marks in history and geography at his school level.', 'He completed a Bachelor of Science Degree in botony at  Government Arts College,Coimbatore ', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_master` (`customer_id`, `user_id`, `password`, `first_name`, `last_name`, `middle_name`, `star_name`, `star_title`, `date_of_birth`, `birth_city`, `birth_state`, `birth_country`, `mother_tongue`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `status_id`, `total_worth`, `education_degree`, `self_promo_text`, `school_info`, `college_info`, `status`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(29, NULL, NULL, 'Rengarajan', '', '', 'Vaali', NULL, '1938-10-30 00:00:00', 'Srirangam', 4, 4, 1, '', '', 'Chennai', 4, '', 4, 8, 3, 1, '', '', '', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_master` (`customer_id`, `user_id`, `password`, `first_name`, `last_name`, `middle_name`, `star_name`, `star_title`, `date_of_birth`, `birth_city`, `birth_state`, `birth_country`, `mother_tongue`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `status_id`, `total_worth`, `education_degree`, `self_promo_text`, `school_info`, `college_info`, `status`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(30, NULL, NULL, 'Vasu', '', '', 'P.Vasu', NULL, '1969-12-31 16:00:00', '', 5, 4, 10, '', '', 'Chennai', 4, '', 4, 8, 2, 1, '', '', '', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_master` (`customer_id`, `user_id`, `password`, `first_name`, `last_name`, `middle_name`, `star_name`, `star_title`, `date_of_birth`, `birth_city`, `birth_state`, `birth_country`, `mother_tongue`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `status_id`, `total_worth`, `education_degree`, `self_promo_text`, `school_info`, `college_info`, `status`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(31, NULL, NULL, 'Thotta Tharani', '', '', 'Thotta Tharani', NULL, '1969-12-31 16:00:00', '', 4, 4, 1, '', '', 'Chennai', 4, '', 4, 8, 1, 1, '', '', '', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_master` (`customer_id`, `user_id`, `password`, `first_name`, `last_name`, `middle_name`, `star_name`, `star_title`, `date_of_birth`, `birth_city`, `birth_state`, `birth_country`, `mother_tongue`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `status_id`, `total_worth`, `education_degree`, `self_promo_text`, `school_info`, `college_info`, `status`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(32, NULL, NULL, 'Daniel', 'Rasayya', '', 'Illayaraja', NULL, '1969-12-31 16:00:00', 'Theni', 4, 4, 1, '', '', 'Chennai', 4, '', 4, 8, 4, 1, '', '', '', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_master` (`customer_id`, `user_id`, `password`, `first_name`, `last_name`, `middle_name`, `star_name`, `star_title`, `date_of_birth`, `birth_city`, `birth_state`, `birth_country`, `mother_tongue`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `status_id`, `total_worth`, `education_degree`, `self_promo_text`, `school_info`, `college_info`, `status`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(33, NULL, NULL, 'Kattassery', 'Yesudas', 'Joseph', 'Dr. K.J. Yesudas', 'Gana Gandharvan', '1940-01-10 00:00:00', 'Fort Cochin', 5, 4, 10, '', '', '', 0, '', 5, 8, 4, 1, '', '', '', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_master` (`customer_id`, `user_id`, `password`, `first_name`, `last_name`, `middle_name`, `star_name`, `star_title`, `date_of_birth`, `birth_city`, `birth_state`, `birth_country`, `mother_tongue`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `status_id`, `total_worth`, `education_degree`, `self_promo_text`, `school_info`, `college_info`, `status`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(34, NULL, NULL, 'Balasubramanian', '', '', 'S.P.Balasubramanian', 'SPB, Balu', '1956-06-04 00:00:00', 'Konetampet', 7, 4, 2, '', '', 'Chennai', 4, '', 4, 8, 4, 1, '', '', '', 1, NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Index: IDX_customer_master_2
--
ALTER TABLE `ahtees`.`customer_master` ADD INDEX IDX_customer_master_2 (user_id );
-- GO

--
-- Table: customer_rating_master
--
CREATE TABLE `customer_rating_master` 
(
	`id` integer (1) NOT NULL DEFAULT 0, 
	`description` varchar (10) NOT NULL, 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime
) ;
-- GO

--
-- Dumping Table Data: customer_rating_master
--
BEGIN;
-- GO
INSERT INTO `customer_rating_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(5, '1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_rating_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(6, '2', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_rating_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(7, '3', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_rating_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(8, '4', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_rating_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(9, '5', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_rating_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(10, '6', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Table: customer_special_interest
--
CREATE TABLE `customer_special_interest` 
(
	`id` integer (11) NOT NULL AUTO_INCREMENT , 
	`customer_id` integer (11) NOT NULL, 
	`lang_id` integer (11), 
	`interest` varchar (500) NOT NULL, 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: customer_special_interest
--
BEGIN;
-- GO
INSERT INTO `customer_special_interest` (`id`, `customer_id`, `lang_id`, `interest`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(14, 3, 1, 'Interest 1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_special_interest` (`id`, `customer_id`, `lang_id`, `interest`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(15, 3, 4, 'interest 2', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_special_interest` (`id`, `customer_id`, `lang_id`, `interest`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(16, 3, 3, 'test 2', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_special_interest` (`id`, `customer_id`, `lang_id`, `interest`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(17, 28, 1, 'Stages speaches', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_special_interest` (`id`, `customer_id`, `lang_id`, `interest`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(18, 32, 1, 'Spiritual', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_special_interest` (`id`, `customer_id`, `lang_id`, `interest`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(19, 33, 1, 'Karnatic Music', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_special_interest` (`id`, `customer_id`, `lang_id`, `interest`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(20, 14, 5, 'asdasd', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_special_interest` (`id`, `customer_id`, `lang_id`, `interest`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(21, 16, 4, 'Spirtial activities.', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Index: IDX_customer_special_interest_2
--
ALTER TABLE `ahtees`.`customer_special_interest` ADD INDEX IDX_customer_special_interest_2 (customer_id );
-- GO

--
-- Table: customer_sports_interest
--
CREATE TABLE `customer_sports_interest` 
(
	`id` integer (11) NOT NULL AUTO_INCREMENT , 
	`customer_id` char (32) NOT NULL, 
	`sports_id` integer (4) NOT NULL, 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: customer_sports_interest
--
BEGIN;
-- GO
INSERT INTO `customer_sports_interest` (`id`, `customer_id`, `sports_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(2, '3', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_sports_interest` (`id`, `customer_id`, `sports_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(3, '3', 3, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_sports_interest` (`id`, `customer_id`, `sports_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(4, '5', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_sports_interest` (`id`, `customer_id`, `sports_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(5, '5', 16, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_sports_interest` (`id`, `customer_id`, `sports_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(6, '5', 15, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_sports_interest` (`id`, `customer_id`, `sports_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(7, '6', 17, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_sports_interest` (`id`, `customer_id`, `sports_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(8, '7', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_sports_interest` (`id`, `customer_id`, `sports_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(9, '7', 2, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_sports_interest` (`id`, `customer_id`, `sports_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(10, '8', 21, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_sports_interest` (`id`, `customer_id`, `sports_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(11, '9', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_sports_interest` (`id`, `customer_id`, `sports_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(12, '10', 21, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_sports_interest` (`id`, `customer_id`, `sports_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(13, '17', 21, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_sports_interest` (`id`, `customer_id`, `sports_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(14, '3', 25, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_sports_interest` (`id`, `customer_id`, `sports_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(15, '28', 21, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_sports_interest` (`id`, `customer_id`, `sports_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(16, '16', 16, NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Index: IDX_customer_sports_interest_2
--
ALTER TABLE `ahtees`.`customer_sports_interest` ADD INDEX IDX_customer_sports_interest_2 (customer_id,sports_id );
-- GO

--
-- Table: customer_status_master
--
CREATE TABLE `customer_status_master` 
(
	`id` integer (1) NOT NULL AUTO_INCREMENT , 
	`description` varchar (30) NOT NULL, 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: customer_status_master
--
BEGIN;
-- GO
INSERT INTO `customer_status_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(8, 'Active', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_status_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(9, 'Inactive', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_status_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(21, 'Pending', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_status_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(22, 'Under Review', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Table: customer_talent
--
CREATE TABLE `customer_talent` 
(
	`id` integer (11) NOT NULL AUTO_INCREMENT , 
	`customer_id` char (32) NOT NULL, 
	`talent_id` integer (4) NOT NULL, 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: customer_talent
--
BEGIN;
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(1, '3', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(3, '3', 4, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(4, '3', 8, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(5, '5', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(6, '5', 0, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(7, '5', 11, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(8, '5', 17, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(9, '3', 11, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(12, '6', 11, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(13, '7', 11, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(14, '8', 11, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(15, '9', 11, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(16, '10', 11, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(17, '10', 15, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(18, '20', 11, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(19, '20', 12, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(20, '17', 11, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(21, '17', 12, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(22, '17', 10, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(23, '17', 18, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(24, '25', 11, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(25, '26', 10, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(26, '26', 15, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(27, '26', 11, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(28, '3', 10, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(30, '28', 11, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(31, '28', 10, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(32, '29', 19, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(33, '29', 11, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(34, '29', 20, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(35, '31', 21, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(36, '32', 15, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(37, '32', 18, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(38, '32', 20, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `customer_talent` (`id`, `customer_id`, `talent_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(39, '33', 18, NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Index: IDX_customer_talent_2
--
ALTER TABLE `ahtees`.`customer_talent` ADD INDEX IDX_customer_talent_2 (customer_id,talent_id );
-- GO

--
-- Table: education_degree_master
--
CREATE TABLE `education_degree_master` 
(
	`id` integer (10) NOT NULL AUTO_INCREMENT , 
	`name` varchar (100) NOT NULL, 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: education_degree_master
--
BEGIN;
-- GO
INSERT INTO `education_degree_master` (`id`, `name`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(1, 'Degree1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `education_degree_master` (`id`, `name`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(2, 'Degree2', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `education_degree_master` (`id`, `name`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(3, 'Degree3', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Table: format_master
--
CREATE TABLE `format_master` 
(
	`id` integer (4) NOT NULL AUTO_INCREMENT , 
	`description` varchar (30) NOT NULL, 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: format_master
--
BEGIN;
-- GO
INSERT INTO `format_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(6, '70MM', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `format_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(7, '35MM', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Table: language_master
--
CREATE TABLE `language_master` 
(
	`id` integer (4) NOT NULL AUTO_INCREMENT , 
	`description` varchar (30) NOT NULL, 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: language_master
--
BEGIN;
-- GO
INSERT INTO `language_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(1, 'Tamil', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `language_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(2, 'Telugu', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `language_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(3, 'Hindi', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `language_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(4, 'English', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `language_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(5, 'Sanskrit', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `language_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(9, 'Kannada', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `language_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(10, 'Malayalam', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `language_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(11, 'Marati', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `language_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(12, 'Urudu', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `language_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(13, 'Nepali', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `language_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(14, 'Bengali', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `language_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(15, 'Gujarati', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `language_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(16, 'Rajasthani', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `language_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(17, 'Punjabi', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `language_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(18, 'Manipuri', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `language_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(19, 'Oriya', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `language_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(20, 'Kashmiri', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Table: location_digital_content
--
CREATE TABLE `location_digital_content` 
(
	`id` integer (10) NOT NULL AUTO_INCREMENT , 
	`location_id` integer (10) NOT NULL, 
	`content_type_id` integer (10) NOT NULL, 
	`content_path` varchar (1000) NOT NULL, 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: location_digital_content
--
BEGIN;
-- GO
COMMIT;
-- GO

--
-- Index: IDX_location_digital_content_2
--
ALTER TABLE `ahtees`.`location_digital_content` ADD INDEX IDX_location_digital_content_2 (location_id,content_type_id );
-- GO

--
-- Table: location_master
--
CREATE TABLE `location_master` 
(
	`id` integer (11) NOT NULL AUTO_INCREMENT , 
	`name` varchar (150) NOT NULL, 
	`description` varchar (500) NOT NULL, 
	`type_id` integer (11), 
	`country_id` integer (11), 
	`state_id` integer (11), 
	`url` varchar (1000), 
	`text` varchar (1000), 
	`contact_number` varchar (50), 
	`email_address` varchar (255), 
	`theme_id` integer (11), 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: location_master
--
BEGIN;
-- GO
INSERT INTO `location_master` (`id`, `name`, `description`, `type_id`, `country_id`, `state_id`, `url`, `text`, `contact_number`, `email_address`, `theme_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(22, 'New York', 'New York - The famous location', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `location_master` (`id`, `name`, `description`, `type_id`, `country_id`, `state_id`, `url`, `text`, `contact_number`, `email_address`, `theme_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(23, 'Dallas', 'Dallas, Texas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `location_master` (`id`, `name`, `description`, `type_id`, `country_id`, `state_id`, `url`, `text`, `contact_number`, `email_address`, `theme_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(24, 'Amsterdam', 'New place for all Indian movies', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `location_master` (`id`, `name`, `description`, `type_id`, `country_id`, `state_id`, `url`, `text`, `contact_number`, `email_address`, `theme_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(25, 'Tirunelveli', 'The famous village location for all tamil movies', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `location_master` (`id`, `name`, `description`, `type_id`, `country_id`, `state_id`, `url`, `text`, `contact_number`, `email_address`, `theme_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(26, 'Madurai', 'Getting to be more famous', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `location_master` (`id`, `name`, `description`, `type_id`, `country_id`, `state_id`, `url`, `text`, `contact_number`, `email_address`, `theme_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(27, 'Chennai', 'Kollywood\'s home town', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `location_master` (`id`, `name`, `description`, `type_id`, `country_id`, `state_id`, `url`, `text`, `contact_number`, `email_address`, `theme_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(28, 'Delhi', 'The capital of India', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `location_master` (`id`, `name`, `description`, `type_id`, `country_id`, `state_id`, `url`, `text`, `contact_number`, `email_address`, `theme_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(29, 'Mysore', 'A beautiful place', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `location_master` (`id`, `name`, `description`, `type_id`, `country_id`, `state_id`, `url`, `text`, `contact_number`, `email_address`, `theme_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(30, 'Bangalore', 'The multi-national town', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `location_master` (`id`, `name`, `description`, `type_id`, `country_id`, `state_id`, `url`, `text`, `contact_number`, `email_address`, `theme_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(31, 'Hyderabed', 'Great town with great movie sets', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `location_master` (`id`, `name`, `description`, `type_id`, `country_id`, `state_id`, `url`, `text`, `contact_number`, `email_address`, `theme_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(33, 'test location', 'test', 1, 5, 3, 'test', 'test', 'test', 'test', 3, NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Index: IDX_location_master_2
--
ALTER TABLE `ahtees`.`location_master` ADD INDEX IDX_location_master_2 (type_id,country_id,state_id,theme_id );
-- GO

--
-- Table: location_type_master
--
CREATE TABLE `location_type_master` 
(
	`id` integer (10) NOT NULL AUTO_INCREMENT , 
	`name` varchar (150) NOT NULL, 
	`description` varchar (500) NOT NULL, 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: location_type_master
--
BEGIN;
-- GO
INSERT INTO `location_type_master` (`id`, `name`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(3, 'Park', 'Just a regular Par', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `location_type_master` (`id`, `name`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(4, 'Hotel', 'Hotelling place', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Table: movie_award
--
CREATE TABLE `movie_award` 
(
	`id` integer (11) NOT NULL AUTO_INCREMENT , 
	`movie_id` integer (11) NOT NULL, 
	`award_id` integer (11) NOT NULL, 
	`received_date` datetime, 
	`received_occassion` varchar (150), 
	`given_by` varchar (100), 
	`money_received` float (10,2), 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: movie_award
--
BEGIN;
-- GO
INSERT INTO `movie_award` (`id`, `movie_id`, `award_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(1, 1, 11, '2008-04-29 00:00:00', 'Special', 'Dave', 1000.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_award` (`id`, `movie_id`, `award_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(3, 3, 10, '2008-04-16 00:00:00', 'ADasd', 'ASDAsd', 123123.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_award` (`id`, `movie_id`, `award_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(5, 7, 10, '2008-05-08 00:00:00', 'asdada', 'asdfsdfasd', 123123.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_award` (`id`, `movie_id`, `award_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(6, 10, 10, '2008-05-14 00:00:00', 'qweqw', 'qweqwe', 1234.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_award` (`id`, `movie_id`, `award_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(7, 1, 10, '2008-05-27 00:00:00', 'my own', 'Joanne', 20.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_award` (`id`, `movie_id`, `award_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(9, 1, 14, '2008-06-03 00:00:00', 'Emmys', 'Kumar', 20.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_award` (`id`, `movie_id`, `award_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(10, 11, 10, '1969-12-31 16:00:00', '', '', 0.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_award` (`id`, `movie_id`, `award_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(11, 11, 13, '1969-12-31 16:00:00', '', '', 0.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_award` (`id`, `movie_id`, `award_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(12, 9, 10, '2008-06-13 00:00:00', 'jhgjhg', '', 0.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_award` (`id`, `movie_id`, `award_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(13, 4, 11, '2008-06-17 00:00:00', 'test', 'test', 0.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_award` (`id`, `movie_id`, `award_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(14, 13, 18, '2008-06-19 00:00:00', 'aDFS', 'SDF', 0.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_award` (`id`, `movie_id`, `award_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(15, 15, 10, '1969-12-31 16:00:00', '', '', 0.00, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_award` (`id`, `movie_id`, `award_id`, `received_date`, `received_occassion`, `given_by`, `money_received`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(16, 1, 10, '2008-06-19 00:00:00', 'test', 'test', 222.00, NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Index: IDX_movie_award_2
--
ALTER TABLE `ahtees`.`movie_award` ADD INDEX IDX_movie_award_2 (movie_id,award_id );
-- GO

--
-- Table: movie_cast
--
CREATE TABLE `movie_cast` 
(
	`id` integer (11) NOT NULL AUTO_INCREMENT , 
	`movie_id` integer (11) NOT NULL, 
	`customer_id` integer (11) NOT NULL, 
	`no_of_roles` integer (2) DEFAULT 1, 
	`role_type_id` integer (11) NOT NULL, 
	`pronoun` varchar (255), 
	`name_in_movie` varchar (100), 
	`highlight` varchar (500), 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: movie_cast
--
BEGIN;
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(8, 3, 5, 1, 19, '', 'Same as his original name', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(9, 3, 3, 1, 6, '', 'Rambo', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(10, 7, 3, 2, 6, '1231', '123123', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(12, 10, 4, 12, 7, 'qeqwe', '12', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(15, 10, 5, 2, 7, 'asdlkfj', 'Test Heroine', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(16, 6, 3, 1, 16, '', '2313123', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(17, 10, 4, 1, 23, '', 'jjjj', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(18, 10, 4, 1, 0, '', '123213123', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(19, 10, 4, 1, 22, '', '123213123', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(20, 1, 4, 1, 0, 'sdaf', 'sadfds', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(24, 2, 5, 2, 6, NULL, 'Kris', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(25, 12, 5, 2, 8, NULL, 'Sucker', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(26, 13, 5, 1, 22, NULL, 'Chicken', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(27, 1, 3, 1, 6, NULL, 'George', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(28, 1, 4, 1, 7, NULL, 'Jill', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(29, 11, 5, 2, 0, NULL, 'Mani', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(30, 11, 3, 1, 7, NULL, 'halelooya', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(31, 11, 3, 1, 24, NULL, 'ASDF', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(32, 1, 3, 2, 8, NULL, 'superbadguy', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(34, 9, 5, 1, 18, NULL, 'qadf', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(35, 14, 3, 1, 19, NULL, 'rAJA', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(36, 13, 5, 1, 6, NULL, 'Raj', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(37, 4, 5, 1, 6, NULL, 'ahaa', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(38, 15, 7, 1, 6, NULL, 'Sanjay Ramasamy', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(39, 16, 8, 1, 6, NULL, 'Kicha', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(40, 17, 9, 1, 6, NULL, 'Raamji', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(41, 18, 10, 2, 6, NULL, 'Vishwanathan, Ramamoorthy', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(42, 19, 11, 1, 6, NULL, 'Munna', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(43, 19, 12, 1, 6, NULL, 'Babu Kalyanam', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(44, 19, 14, 1, 6, NULL, 'Kumar', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(45, 19, 13, 1, 6, NULL, 'Krishna', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(46, 19, 15, 1, 6, NULL, 'Ju Ju', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(47, 15, 5, 1, 7, NULL, 'Something', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(48, 20, 21, 1, 7, NULL, 'Shanthi Devi', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(49, 20, 20, 1, 6, NULL, 'Krishnan', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(50, 20, 22, 1, 7, NULL, 'Meena', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(51, 20, 23, 1, 11, NULL, '', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(52, 21, 17, 1, 6, NULL, 'Thenali', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(53, 21, 25, 1, 7, NULL, 'Janaki', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(54, 21, 26, 1, 10, NULL, 'Dr.Kailash', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(55, 21, 27, 1, 11, NULL, '', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(56, 22, 28, 1, 6, NULL, 'Samraj', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(57, 20, 30, 1, 12, NULL, '', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(58, 20, 29, 1, 20, NULL, '', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(59, 20, 32, 1, 13, NULL, '', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(60, 20, 33, 1, 21, NULL, '', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast` (`id`, `movie_id`, `customer_id`, `no_of_roles`, `role_type_id`, `pronoun`, `name_in_movie`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(61, 1, 33, 21, 6, NULL, 'test', NULL, NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Index: IDX_movie_cast_2
--
ALTER TABLE `ahtees`.`movie_cast` ADD INDEX IDX_movie_cast_2 (movie_id,customer_id,role_type_id );
-- GO

--
-- Table: movie_cast_highlights
--
CREATE TABLE `movie_cast_highlights` 
(
	`id` integer (11) NOT NULL AUTO_INCREMENT , 
	`movie_id` integer (11) NOT NULL, 
	`customer_id` integer (11) NOT NULL, 
	`system_lang_code_id` integer (11), 
	`highlight` varchar (500), 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: movie_cast_highlights
--
BEGIN;
-- GO
INSERT INTO `movie_cast_highlights` (`id`, `movie_id`, `customer_id`, `system_lang_code_id`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(1, 1, 3, 4, 'Live Long and Prosper forever', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast_highlights` (`id`, `movie_id`, `customer_id`, `system_lang_code_id`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(3, 7, 3, NULL, 'saddfsdsfasdf', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast_highlights` (`id`, `movie_id`, `customer_id`, `system_lang_code_id`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(4, 7, 5, NULL, 'asdfasdf', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast_highlights` (`id`, `movie_id`, `customer_id`, `system_lang_code_id`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(5, 3, 3, NULL, 'He is a great actor. He had done a great job in this movie. I think this could considered as one of \"oscar\" level performances.', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast_highlights` (`id`, `movie_id`, `customer_id`, `system_lang_code_id`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(6, 2, 5, NULL, 'bad acting in this movie', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast_highlights` (`id`, `movie_id`, `customer_id`, `system_lang_code_id`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(7, 13, 5, NULL, 'he sucks in this movie.', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast_highlights` (`id`, `movie_id`, `customer_id`, `system_lang_code_id`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(8, 12, 5, NULL, 'asDFKsdfkjsd', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast_highlights` (`id`, `movie_id`, `customer_id`, `system_lang_code_id`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(9, 11, 5, NULL, 'Crappy highlight', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast_highlights` (`id`, `movie_id`, `customer_id`, `system_lang_code_id`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(10, 10, 4, NULL, 'testing', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast_highlights` (`id`, `movie_id`, `customer_id`, `system_lang_code_id`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(11, 9, 5, NULL, 'test', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast_highlights` (`id`, `movie_id`, `customer_id`, `system_lang_code_id`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(13, 15, 7, NULL, 'Bald head makeup', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast_highlights` (`id`, `movie_id`, `customer_id`, `system_lang_code_id`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(14, 16, 8, NULL, 'He comes from various makeup. His stunt and dance is very good. ', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast_highlights` (`id`, `movie_id`, `customer_id`, `system_lang_code_id`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(15, 17, 9, NULL, 'Innocent Character', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast_highlights` (`id`, `movie_id`, `customer_id`, `system_lang_code_id`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(16, 18, 10, NULL, 'Prasanth took in dual role. His style and dance & fight is very good. He should improve his action. His face is not supporting to his action', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast_highlights` (`id`, `movie_id`, `customer_id`, `system_lang_code_id`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(17, 14, 3, NULL, '\r\njust testing the damn thing. it better work.', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast_highlights` (`id`, `movie_id`, `customer_id`, `system_lang_code_id`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(18, 15, 19, NULL, 'She had done a great job in the movie.', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast_highlights` (`id`, `movie_id`, `customer_id`, `system_lang_code_id`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(23, 20, 20, 4, 'Style & Comedy with Koundamany', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast_highlights` (`id`, `movie_id`, `customer_id`, `system_lang_code_id`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(24, 22, 28, 4, 'I would say that this is one of the best movies for Sathyaraj. The trio, Sathyaraj, Raghuvaran, and Ravi had done a fantastic job in the movie. They all have fitted into the role well, and was a welcome change for all three of them. Movie is all about friends and politics, but taken in traditional \"Tamil Masala\" which makes to enjoying for everyone.', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast_highlights` (`id`, `movie_id`, `customer_id`, `system_lang_code_id`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(25, 6, 0, 0, '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast_highlights` (`id`, `movie_id`, `customer_id`, `system_lang_code_id`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(26, 12, 5, 4, 'testing session content..', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Index: IDX_movie_cast_highlights_2
--
ALTER TABLE `ahtees`.`movie_cast_highlights` ADD INDEX IDX_movie_cast_highlights_2 (movie_id,customer_id );
-- GO

--
-- Table: movie_cast_punch_dialogs
--
CREATE TABLE `movie_cast_punch_dialogs` 
(
	`id` integer (11) NOT NULL AUTO_INCREMENT , 
	`movie_id` integer (11) NOT NULL, 
	`customer_id` integer (11) NOT NULL, 
	`system_lang_code_id` integer (11), 
	`dialog` varchar (500), 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: movie_cast_punch_dialogs
--
BEGIN;
-- GO
INSERT INTO `movie_cast_punch_dialogs` (`id`, `movie_id`, `customer_id`, `system_lang_code_id`, `dialog`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(1, 1, 3, 4, 'To Infinity...and BEYOND! and more\r\n', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast_punch_dialogs` (`id`, `movie_id`, `customer_id`, `system_lang_code_id`, `dialog`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(3, 7, 0, NULL, 'sdfgdfgdfgsdfgsdfgsdfgsdfgs', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast_punch_dialogs` (`id`, `movie_id`, `customer_id`, `system_lang_code_id`, `dialog`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(4, 7, 0, NULL, 'sdfgsdfgsdfgsdfgsdfgsdfg dfg sdf sdf sdfg sdfg dfsg sdfg gf fsg sdfgsd fg', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast_punch_dialogs` (`id`, `movie_id`, `customer_id`, `system_lang_code_id`, `dialog`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(5, 7, 3, NULL, 'sadfsdfasdfsadfasdf', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast_punch_dialogs` (`id`, `movie_id`, `customer_id`, `system_lang_code_id`, `dialog`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(6, 7, 3, NULL, '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast_punch_dialogs` (`id`, `movie_id`, `customer_id`, `system_lang_code_id`, `dialog`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(7, 2, 5, NULL, 'Excellent. Dave fixed this. Amazing!', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast_punch_dialogs` (`id`, `movie_id`, `customer_id`, `system_lang_code_id`, `dialog`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(8, 14, 3, NULL, 'test', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast_punch_dialogs` (`id`, `movie_id`, `customer_id`, `system_lang_code_id`, `dialog`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(9, 14, 3, NULL, 'whatever...', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Index: IDX_movie_cast_punch_dialogs_2
--
ALTER TABLE `ahtees`.`movie_cast_punch_dialogs` ADD INDEX IDX_movie_cast_punch_dialogs_2 (movie_id,customer_id );
-- GO

--
-- Table: movie_cast_rating
--
CREATE TABLE `movie_cast_rating` 
(
	`id` integer (11) NOT NULL AUTO_INCREMENT , 
	`movie_id` integer (11) NOT NULL, 
	`customer_id` integer (11) NOT NULL, 
	`rating_id` integer (4) NOT NULL, 
	`user_id` varchar (30), 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: movie_cast_rating
--
BEGIN;
-- GO
INSERT INTO `movie_cast_rating` (`id`, `movie_id`, `customer_id`, `rating_id`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(30, 1, 3, 5, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast_rating` (`id`, `movie_id`, `customer_id`, `rating_id`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(31, 1, 3, 7, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast_rating` (`id`, `movie_id`, `customer_id`, `rating_id`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(32, 4, 5, 6, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast_rating` (`id`, `movie_id`, `customer_id`, `rating_id`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(33, 4, 5, 7, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_cast_rating` (`id`, `movie_id`, `customer_id`, `rating_id`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(34, 22, 28, 6, NULL, NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Index: IDX_movie_cast_rating_2
--
ALTER TABLE `ahtees`.`movie_cast_rating` ADD INDEX IDX_movie_cast_rating_2 (movie_id,customer_id,user_id );
-- GO

--
-- Table: movie_cast_roles
--
CREATE TABLE `movie_cast_roles` 
(
	`id` integer (10) NOT NULL AUTO_INCREMENT , 
	`movie_id` integer (10) NOT NULL, 
	`customer_id` integer (10) NOT NULL, 
	`role_number` integer (2) NOT NULL, 
	`role_type_id` integer (2) NOT NULL, 
	`system_lang_code_id` integer (2) NOT NULL, 
	`pronoun` varchar (255), 
	`name_in_movie` varchar (100), 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: movie_cast_roles
--
BEGIN;
-- GO
COMMIT;
-- GO

--
-- Index: IDX_movie_cast_roles_2
--
ALTER TABLE `ahtees`.`movie_cast_roles` ADD INDEX IDX_movie_cast_roles_2 (movie_id,customer_id,role_type_id,system_lang_code_id );
-- GO

--
-- Table: movie_company_master
--
CREATE TABLE `movie_company_master` 
(
	`id` integer (10) NOT NULL AUTO_INCREMENT , 
	`name` varchar (30) NOT NULL, 
	`address_1` varchar (100), 
	`address_2` varchar (100), 
	`address_3` varchar (100), 
	`city` varchar (100), 
	`state_id` integer (4), 
	`country_id` integer (4), 
	`owner_name` varchar (50), 
	`contact_number` varchar (20), 
	`email_address` varchar (255), 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: movie_company_master
--
BEGIN;
-- GO
INSERT INTO `movie_company_master` (`id`, `name`, `address_1`, `address_2`, `address_3`, `city`, `state_id`, `country_id`, `owner_name`, `contact_number`, `email_address`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(1, 'movie company 1', 'none', 'none', 'none', 'Placerville', 2, 3, 'Dave sykes 2', '313-5366', 'jadus@comcast.net', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_company_master` (`id`, `name`, `address_1`, `address_2`, `address_3`, `city`, `state_id`, `country_id`, `owner_name`, `contact_number`, `email_address`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(3, 'movie company 2', 'none', 'none', 'none', 'folsom', 2, 3, 'none', 'none', 'none', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_company_master` (`id`, `name`, `address_1`, `address_2`, `address_3`, `city`, `state_id`, `country_id`, `owner_name`, `contact_number`, `email_address`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(4, 'AVM', '', '', '', 'Vada Palani', 4, 4, 'Mr. Saravanan', '', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_company_master` (`id`, `name`, `address_1`, `address_2`, `address_3`, `city`, `state_id`, `country_id`, `owner_name`, `contact_number`, `email_address`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(5, 'Vahini Studios', '', '', '', 'Vada Palani', 4, 4, '', '', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_company_master` (`id`, `name`, `address_1`, `address_2`, `address_3`, `city`, `state_id`, `country_id`, `owner_name`, `contact_number`, `email_address`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(6, 'Bride Productions', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_company_master` (`id`, `name`, `address_1`, `address_2`, `address_3`, `city`, `state_id`, `country_id`, `owner_name`, `contact_number`, `email_address`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(7, 'Sri Saravanaa Creations', '', '', '', 'Chennai', 4, 4, 'Salem A. Chandrasekaran', '', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_company_master` (`id`, `name`, `address_1`, `address_2`, `address_3`, `city`, `state_id`, `country_id`, `owner_name`, `contact_number`, `email_address`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(8, 'A.R.S. Film International', '', '', '', 'Chennai', 4, 4, 'K.T. Kunjumon', '', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_company_master` (`id`, `name`, `address_1`, `address_2`, `address_3`, `city`, `state_id`, `country_id`, `owner_name`, `contact_number`, `email_address`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(9, 'Raajkamal Films International', '', '', '', 'Chennai', 4, 4, 'Padmasree Kamal Haasan', '', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_company_master` (`id`, `name`, `address_1`, `address_2`, `address_3`, `city`, `state_id`, `country_id`, `owner_name`, `contact_number`, `email_address`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(10, 'Ashok Kumar Production', '', '', '', '', 0, 0, 'AshokKumar', '', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_company_master` (`id`, `name`, `address_1`, `address_2`, `address_3`, `city`, `state_id`, `country_id`, `owner_name`, `contact_number`, `email_address`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(11, 'Ashok Amritraj Productions', '', '', '', '', 0, 5, 'Ashok Amritraj', '', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_company_master` (`id`, `name`, `address_1`, `address_2`, `address_3`, `city`, `state_id`, `country_id`, `owner_name`, `contact_number`, `email_address`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(12, 'Sri Surya Movies', '', '', '', 'Chennai', 4, 4, 'A.M. Rathnam', '', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_company_master` (`id`, `name`, `address_1`, `address_2`, `address_3`, `city`, `state_id`, `country_id`, `owner_name`, `contact_number`, `email_address`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(13, 'Sivaji Films', '', '', '', 'Chennai', 4, 4, 'Ramkumar', '', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_company_master` (`id`, `name`, `address_1`, `address_2`, `address_3`, `city`, `state_id`, `country_id`, `owner_name`, `contact_number`, `email_address`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(14, 'R.K. Celluloids', '', '', '', 'Chennai', 4, 4, 'R. Karpagam', '', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_company_master` (`id`, `name`, `address_1`, `address_2`, `address_3`, `city`, `state_id`, `country_id`, `owner_name`, `contact_number`, `email_address`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(15, 'Suresh Arts', '', '', '', '', 0, 0, 'Balaji', '', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_company_master` (`id`, `name`, `address_1`, `address_2`, `address_3`, `city`, `state_id`, `country_id`, `owner_name`, `contact_number`, `email_address`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(16, 'Suresh Arts', '', '', '', 'Chennai', 4, 4, 'Balaji', '', '', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Index: IDX_movie_company_master_2
--
ALTER TABLE `ahtees`.`movie_company_master` ADD INDEX IDX_movie_company_master_2 (state_id,country_id );
-- GO

--
-- Table: movie_detail_review
--
CREATE TABLE `movie_detail_review` 
(
	`id` integer (11) NOT NULL AUTO_INCREMENT , 
	`movie_id` integer (11) NOT NULL, 
	`system_lang_code_id` integer (11), 
	`review_text` varchar (5000), 
	`user_id` integer (11), 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: movie_detail_review
--
BEGIN;
-- GO
INSERT INTO `movie_detail_review` (`id`, `movie_id`, `system_lang_code_id`, `review_text`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(1, 1, 4, 'I went to see this re-work of my favourite novel and thought it would be atrocious and envisaged walking out of the theatre in disgust in advance. What I got was an explosion of colour and music, Bollywood style, and sure some of the songs were pretty awful, but hey, there were a few terrible numbers in Grease too, and I still love that movie!\r\n\r\n', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_detail_review` (`id`, `movie_id`, `system_lang_code_id`, `review_text`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(2, 1, 4, 'The lead players were all virtually unknown to me but they were perfect in their roles. The role of Lalita (the Elizabeth role in the original book) was perfectly cast - she was beautiful and she really held the whole movie together. And Martin Henderson was perfect as the American version of the disdainful Mr Darcy, this time Mr Will Darcy.\r\n\r\n', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_detail_review` (`id`, `movie_id`, `system_lang_code_id`, `review_text`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(3, 1, 4, 'Go and see this film if you are open to something new - it really is quite a faithful re-work of the story, and it is very entertaining.\r\n', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_detail_review` (`id`, `movie_id`, `system_lang_code_id`, `review_text`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(5, 7, NULL, 'This is one of the fun movie that I didn\'t want to and couldn\'t see. ', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_detail_review` (`id`, `movie_id`, `system_lang_code_id`, `review_text`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(6, 7, NULL, 'asdfasfasdf', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_detail_review` (`id`, `movie_id`, `system_lang_code_id`, `review_text`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(7, 7, NULL, 'asdfasdfsadfsdf', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_detail_review` (`id`, `movie_id`, `system_lang_code_id`, `review_text`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(10, 18, 5, 'Kumar', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_detail_review` (`id`, `movie_id`, `system_lang_code_id`, `review_text`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(11, 6, 4, 'ladskjsdfkl', NULL, NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Index: IDX_movie_detail_review_2
--
ALTER TABLE `ahtees`.`movie_detail_review` ADD INDEX IDX_movie_detail_review_2 (movie_id,user_id );
-- GO

--
-- Table: movie_digital_content
--
CREATE TABLE `movie_digital_content` 
(
	`id` integer (11) NOT NULL AUTO_INCREMENT , 
	`movie_id` integer (11) NOT NULL, 
	`content_type_id` integer (2) NOT NULL, 
	`content_path` varchar (1000) NOT NULL, 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: movie_digital_content
--
BEGIN;
-- GO
INSERT INTO `movie_digital_content` (`id`, `movie_id`, `content_type_id`, `content_path`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(10, 1, 6, 'movies/content/1_6_shadeactive.gif', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_digital_content` (`id`, `movie_id`, `content_type_id`, `content_path`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(13, 1, 5, 'movies/content/1_5_indentbg2.gif', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_digital_content` (`id`, `movie_id`, `content_type_id`, `content_path`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(14, 7, 5, 'movies/content/7_5_Photo 3.jpg', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_digital_content` (`id`, `movie_id`, `content_type_id`, `content_path`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(15, 15, 5, 'movies/content/15_5_suriya_ayan2.jpg', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_digital_content` (`id`, `movie_id`, `content_type_id`, `content_path`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(16, 20, 5, 'movies/content/20_5_rajini.jpg', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_digital_content` (`id`, `movie_id`, `content_type_id`, `content_path`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(18, 7, 13, 'movies/content/7_13_Winter Leaves.jpg', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Index: IDX_movie_digital_content_2
--
ALTER TABLE `ahtees`.`movie_digital_content` ADD INDEX IDX_movie_digital_content_2 (movie_id,content_type_id );
-- GO

--
-- Table: movie_location
--
CREATE TABLE `movie_location` 
(
	`id` integer (11) NOT NULL AUTO_INCREMENT , 
	`movie_id` integer (11) NOT NULL, 
	`location_id` integer (11) NOT NULL, 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: movie_location
--
BEGIN;
-- GO
INSERT INTO `movie_location` (`id`, `movie_id`, `location_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(1, 1, 22, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_location` (`id`, `movie_id`, `location_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(2, 1, 26, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_location` (`id`, `movie_id`, `location_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(4, 6, 23, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_location` (`id`, `movie_id`, `location_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(5, 2, 26, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_location` (`id`, `movie_id`, `location_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(6, 2, 26, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_location` (`id`, `movie_id`, `location_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(7, 7, 23, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_location` (`id`, `movie_id`, `location_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(8, 7, 26, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_location` (`id`, `movie_id`, `location_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(9, 1, 23, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_location` (`id`, `movie_id`, `location_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(10, 11, 28, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_location` (`id`, `movie_id`, `location_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(11, 11, 33, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_location` (`id`, `movie_id`, `location_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(12, 1, 23, NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Index: IDX_movie_location_2
--
ALTER TABLE `ahtees`.`movie_location` ADD INDEX IDX_movie_location_2 (movie_id,location_id );
-- GO

--
-- Table: movie_master
--
CREATE TABLE `movie_master` 
(
	`id` integer (11) NOT NULL AUTO_INCREMENT , 
	`name` varchar (200), 
	`format_id` integer (2) NOT NULL, 
	`release_date` datetime NOT NULL, 
	`parent_category_id` integer (4) NOT NULL, 
	`child_category_id` integer (4) NOT NULL, 
	`third_category_id` integer (4) NOT NULL, 
	`lang_id` integer (4) NOT NULL, 
	`dubbed_from_movie` varchar (200), 
	`original_lang_id` integer (4), 
	`rating_id` integer (1) NOT NULL, 
	`production_cost_id` integer (11), 
	`aspect_ratio_id` integer (11), 
	`movie_company_id` integer (11), 
	`number_of_songs` integer (4), 
	`active` varchar (50) DEFAULT '1', 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: movie_master
--
BEGIN;
-- GO
INSERT INTO `movie_master` (`id`, `name`, `format_id`, `release_date`, `parent_category_id`, `child_category_id`, `third_category_id`, `lang_id`, `dubbed_from_movie`, `original_lang_id`, `rating_id`, `production_cost_id`, `aspect_ratio_id`, `movie_company_id`, `number_of_songs`, `active`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(1, 'Bride & Prejudice', 7, '2005-02-11 00:00:00', 11, 7, 8, 4, 'Balle Balle! ', 17, 7, 0, 6, 6, NULL, '1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master` (`id`, `name`, `format_id`, `release_date`, `parent_category_id`, `child_category_id`, `third_category_id`, `lang_id`, `dubbed_from_movie`, `original_lang_id`, `rating_id`, `production_cost_id`, `aspect_ratio_id`, `movie_company_id`, `number_of_songs`, `active`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(2, 'Roja', 6, '1992-10-10 00:00:00', 23, 11, 0, 1, 'N/A', 1, 5, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master` (`id`, `name`, `format_id`, `release_date`, `parent_category_id`, `child_category_id`, `third_category_id`, `lang_id`, `dubbed_from_movie`, `original_lang_id`, `rating_id`, `production_cost_id`, `aspect_ratio_id`, `movie_company_id`, `number_of_songs`, `active`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(3, 'Roja V2.0', 6, '1992-10-10 00:00:00', 23, 11, 0, 1, 'N/A', 1, 5, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master` (`id`, `name`, `format_id`, `release_date`, `parent_category_id`, `child_category_id`, `third_category_id`, `lang_id`, `dubbed_from_movie`, `original_lang_id`, `rating_id`, `production_cost_id`, `aspect_ratio_id`, `movie_company_id`, `number_of_songs`, `active`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(4, 'Arasa Kattalai', 7, '1969-12-31 16:00:00', 13, 10, 13, 3, 'Copy cat', 1, 10, 3, 7, 6, NULL, '1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master` (`id`, `name`, `format_id`, `release_date`, `parent_category_id`, `child_category_id`, `third_category_id`, `lang_id`, `dubbed_from_movie`, `original_lang_id`, `rating_id`, `production_cost_id`, `aspect_ratio_id`, `movie_company_id`, `number_of_songs`, `active`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(5, 'Namaste London', 0, '1969-12-31 16:00:00', 0, 0, 0, 0, '', 0, 5, 0, 0, 0, NULL, '1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master` (`id`, `name`, `format_id`, `release_date`, `parent_category_id`, `child_category_id`, `third_category_id`, `lang_id`, `dubbed_from_movie`, `original_lang_id`, `rating_id`, `production_cost_id`, `aspect_ratio_id`, `movie_company_id`, `number_of_songs`, `active`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(6, 'Gemini', 6, '2000-04-12 00:00:00', 9, 8, 7, 1, 'Whatever the crap it is.', 1, 5, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master` (`id`, `name`, `format_id`, `release_date`, `parent_category_id`, `child_category_id`, `third_category_id`, `lang_id`, `dubbed_from_movie`, `original_lang_id`, `rating_id`, `production_cost_id`, `aspect_ratio_id`, `movie_company_id`, `number_of_songs`, `active`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(7, 'test', 6, '2008-05-15 00:00:00', 7, 8, 7, 1, 'test', 1, 5, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master` (`id`, `name`, `format_id`, `release_date`, `parent_category_id`, `child_category_id`, `third_category_id`, `lang_id`, `dubbed_from_movie`, `original_lang_id`, `rating_id`, `production_cost_id`, `aspect_ratio_id`, `movie_company_id`, `number_of_songs`, `active`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(8, 'Sarkar', 0, '1969-12-31 16:00:00', 7, 8, 0, 3, 'Dubbed from Nayagan Tamil Movie somewhat!', 0, 5, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master` (`id`, `name`, `format_id`, `release_date`, `parent_category_id`, `child_category_id`, `third_category_id`, `lang_id`, `dubbed_from_movie`, `original_lang_id`, `rating_id`, `production_cost_id`, `aspect_ratio_id`, `movie_company_id`, `number_of_songs`, `active`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(9, 'Test anme...', 0, '1969-12-31 16:00:00', 8, 11, 9, 2, 'This is a test dubbed movie..', 1, 5, 3, 6, 1, NULL, '1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master` (`id`, `name`, `format_id`, `release_date`, `parent_category_id`, `child_category_id`, `third_category_id`, `lang_id`, `dubbed_from_movie`, `original_lang_id`, `rating_id`, `production_cost_id`, `aspect_ratio_id`, `movie_company_id`, `number_of_songs`, `active`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(10, 'Test Movie', 6, '1969-12-31 16:00:00', 7, 7, 7, 1, 'Test Movie', 1, 5, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master` (`id`, `name`, `format_id`, `release_date`, `parent_category_id`, `child_category_id`, `third_category_id`, `lang_id`, `dubbed_from_movie`, `original_lang_id`, `rating_id`, `production_cost_id`, `aspect_ratio_id`, `movie_company_id`, `number_of_songs`, `active`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(11, 'Just name', 0, '1969-12-31 16:00:00', 7, 9, 12, 2, 'crap', 3, 5, 3, 7, 1, NULL, '1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master` (`id`, `name`, `format_id`, `release_date`, `parent_category_id`, `child_category_id`, `third_category_id`, `lang_id`, `dubbed_from_movie`, `original_lang_id`, `rating_id`, `production_cost_id`, `aspect_ratio_id`, `movie_company_id`, `number_of_songs`, `active`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(12, 'Kakki Sattai', 7, '1969-12-31 16:00:00', 8, 9, 7, 1, 'Fixing the name', 1, 5, 0, 0, 0, NULL, '1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master` (`id`, `name`, `format_id`, `release_date`, `parent_category_id`, `child_category_id`, `third_category_id`, `lang_id`, `dubbed_from_movie`, `original_lang_id`, `rating_id`, `production_cost_id`, `aspect_ratio_id`, `movie_company_id`, `number_of_songs`, `active`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(13, 'Sholey', 6, '2008-05-14 00:00:00', 11, 13, 11, 3, 'Original Movie.', 3, 7, 0, 0, 4, NULL, '1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master` (`id`, `name`, `format_id`, `release_date`, `parent_category_id`, `child_category_id`, `third_category_id`, `lang_id`, `dubbed_from_movie`, `original_lang_id`, `rating_id`, `production_cost_id`, `aspect_ratio_id`, `movie_company_id`, `number_of_songs`, `active`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(14, 'Rajadhi Raja', 7, '1977-06-08 00:00:00', 8, 8, 8, 2, 'Nothing', 3, 5, 3, 6, 4, NULL, '1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master` (`id`, `name`, `format_id`, `release_date`, `parent_category_id`, `child_category_id`, `third_category_id`, `lang_id`, `dubbed_from_movie`, `original_lang_id`, `rating_id`, `production_cost_id`, `aspect_ratio_id`, `movie_company_id`, `number_of_songs`, `active`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(15, 'Gajini', 6, '2006-02-09 00:00:00', 10, 11, 24, 1, '', 1, 10, 0, 7, 7, NULL, '1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master` (`id`, `name`, `format_id`, `release_date`, `parent_category_id`, `child_category_id`, `third_category_id`, `lang_id`, `dubbed_from_movie`, `original_lang_id`, `rating_id`, `production_cost_id`, `aspect_ratio_id`, `movie_company_id`, `number_of_songs`, `active`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(16, 'Gentleman', 6, '1969-12-31 16:00:00', 10, 7, 24, 1, '', 1, 10, 4, 7, 8, NULL, '1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master` (`id`, `name`, `format_id`, `release_date`, `parent_category_id`, `child_category_id`, `third_category_id`, `lang_id`, `dubbed_from_movie`, `original_lang_id`, `rating_id`, `production_cost_id`, `aspect_ratio_id`, `movie_company_id`, `number_of_songs`, `active`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(17, 'Nala Dhamayanthi', 6, '1969-12-31 16:00:00', 7, 24, 24, 1, '', 1, 10, 5, 7, 9, NULL, '1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master` (`id`, `name`, `format_id`, `release_date`, `parent_category_id`, `child_category_id`, `third_category_id`, `lang_id`, `dubbed_from_movie`, `original_lang_id`, `rating_id`, `production_cost_id`, `aspect_ratio_id`, `movie_company_id`, `number_of_songs`, `active`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(18, 'Jeans', 6, '1969-12-31 16:00:00', 11, 7, 24, 1, '', 1, 10, 5, 7, 11, NULL, '1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master` (`id`, `name`, `format_id`, `release_date`, `parent_category_id`, `child_category_id`, `third_category_id`, `lang_id`, `dubbed_from_movie`, `original_lang_id`, `rating_id`, `production_cost_id`, `aspect_ratio_id`, `movie_company_id`, `number_of_songs`, `active`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(19, 'Boys', 6, '1969-12-31 16:00:00', 11, 25, 7, 1, '', 1, 12, 5, 7, 12, NULL, '1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master` (`id`, `name`, `format_id`, `release_date`, `parent_category_id`, `child_category_id`, `third_category_id`, `lang_id`, `dubbed_from_movie`, `original_lang_id`, `rating_id`, `production_cost_id`, `aspect_ratio_id`, `movie_company_id`, `number_of_songs`, `active`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(20, 'Mannan', 6, '1969-12-31 16:00:00', 7, 7, 0, 1, '', 1, 10, 4, 7, 13, NULL, '1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master` (`id`, `name`, `format_id`, `release_date`, `parent_category_id`, `child_category_id`, `third_category_id`, `lang_id`, `dubbed_from_movie`, `original_lang_id`, `rating_id`, `production_cost_id`, `aspect_ratio_id`, `movie_company_id`, `number_of_songs`, `active`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(21, 'Thenali', 6, '2000-10-20 00:00:00', 7, 11, 0, 1, '', 1, 10, 4, 7, 14, NULL, '1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master` (`id`, `name`, `format_id`, `release_date`, `parent_category_id`, `child_category_id`, `third_category_id`, `lang_id`, `dubbed_from_movie`, `original_lang_id`, `rating_id`, `production_cost_id`, `aspect_ratio_id`, `movie_company_id`, `number_of_songs`, `active`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(22, 'Makkal Enn Pakkam', 6, '1969-12-31 16:00:00', 26, 0, 0, 1, '', 1, 12, 4, 7, 16, NULL, '1', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Index: IDX_movie_master_2
--
ALTER TABLE `ahtees`.`movie_master` ADD INDEX IDX_movie_master_2 (format_id,parent_category_id,child_category_id,third_category_id,lang_id,original_lang_id,rating_id );
-- GO

--
-- Table: movie_master_extension
--
CREATE TABLE `movie_master_extension` 
(
	`id` integer (11) NOT NULL AUTO_INCREMENT , 
	`movie_id` integer (10) NOT NULL, 
	`system_lang_code_id` integer (10) NOT NULL, 
	`description` longtext, 
	`message` longtext, 
	`subject_line` varchar (100), 
	`alternate_title` varchar (100), 
	`from_book` varchar (100), 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: movie_master_extension
--
BEGIN;
-- GO
INSERT INTO `movie_master_extension` (`id`, `movie_id`, `system_lang_code_id`, `description`, `message`, `subject_line`, `alternate_title`, `from_book`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(2, 1, 4, 'A Bollywood update of Jane Austen\'s classic tale, in which Mrs. Bakshi is eager to find suitable husbands for her four unmarried daughters. When the rich single gentlemen Balraj and Darcy come to visit, the Bakshis have high hopes, though circumstance and boorish opinions threaten to get in the way of romance.', 'Bollywood meets Hollywood... And it\'s a perfect match ', 'Jane Austen\'s Pride and Prejudice gets a Bollywood treatment.', '', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master_extension` (`id`, `movie_id`, `system_lang_code_id`, `description`, `message`, `subject_line`, `alternate_title`, `from_book`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(3, 1, 5, 'test', 'test', 'test', 'test', 'test', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master_extension` (`id`, `movie_id`, `system_lang_code_id`, `description`, `message`, `subject_line`, `alternate_title`, `from_book`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(4, 13, 8, 'Good movie. One of the best classics the indian movie industry has ever produced.', 'Sholey accha movie kai.', 'okay', 'lksadjf', 'lkjsadf', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master_extension` (`id`, `movie_id`, `system_lang_code_id`, `description`, `message`, `subject_line`, `alternate_title`, `from_book`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(5, 13, 7, 'good for you', 'Telugu is a great language', '', '', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master_extension` (`id`, `movie_id`, `system_lang_code_id`, `description`, `message`, `subject_line`, `alternate_title`, `from_book`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(6, 11, 4, 'lkafdj', 'asdl;kfj', 'lkasdjf', 'lkjsdf', 'lksdjf', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master_extension` (`id`, `movie_id`, `system_lang_code_id`, `description`, `message`, `subject_line`, `alternate_title`, `from_book`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(7, 15, 4, 'This is love Love cum Action movie', 'Affection of Love', '', '', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master_extension` (`id`, `movie_id`, `system_lang_code_id`, `description`, `message`, `subject_line`, `alternate_title`, `from_book`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(8, 16, 5, 'Arjun is a hearo of this movie. His name is kicha. He is running one pupat company. He also doing the robbery & theft from big business man & others. But he send that money for the poor people. Saranraj, he act as a police office in this film. He is trying to find the theif. But arjun is escaping from him. Finally Surnraj got Arjun and handover to the Court.\r\nHe explain his side truth in the court. But the court give the punishment. ', 'Lllegal will be never suceeded', '', '', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master_extension` (`id`, `movie_id`, `system_lang_code_id`, `description`, `message`, `subject_line`, `alternate_title`, `from_book`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(10, 17, 4, '', 'Don\'t go abroad without proper evidence -- whatever', '', 'Foreign thaan Pogalamada', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master_extension` (`id`, `movie_id`, `system_lang_code_id`, `description`, `message`, `subject_line`, `alternate_title`, `from_book`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(11, 18, 4, 'Vishwanathan & Ramamoorty, they are twins. They studying doctorate in America. His father running one hotel in America. ', 'Love Story', 'It is all about the twins', 'Nothing else.', 'Nothing. It was shankar\'s idea.', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master_extension` (`id`, `movie_id`, `system_lang_code_id`, `description`, `message`, `subject_line`, `alternate_title`, `from_book`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(12, 19, 4, '4 friends are studying in a co-education college. They are trying to attacte the heroin. Finaly Heroin false love with hero. The remaing friends support their love. After long strugle, their parents accept their love. ', 'Love Story', 'True Love Never Fails', '', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master_extension` (`id`, `movie_id`, `system_lang_code_id`, `description`, `message`, `subject_line`, `alternate_title`, `from_book`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(13, 20, 4, 'Krishnan (Rajinikanth) is a mechanic in Bombay, Resigns his job and goes to Madras to be by the side of his paralytic mother. The doctor attending his mother gives a recommendation letter to Krishnan a factory owner (Vishwanathan) in Madras for mechanic job. On the way to see the factory owner, Krishnan comes across a crowd attacking a car and the passenger inside. He saves him from the unruly crowd. The passenger (Vishwanathan) comes to know the Krishnan is in search of job and out of gratitude he gives his visiting card and ask him to see the Managing Director of the factory. \r\n\r\nTo his astonishment, the managing director is Shanthi Devi (Vijaya Santhi), daughter of the factory owner, with whom he had once quarreled at the airport. She refuses to give jab to  him and sends him out arrogantly. Vishwanatan persuades his daughter to accommodate him. Krishnan works hard in the factory and becomes the union leader and puts forth some benefits demands to the management for Laborers. But haughty Shanthi Devi wanted to bring Krishnan under her control, by marrying him and making dummy in the house. How Krishnan humbles haughty Shanthy Devi, and leads a happy married life thereafter forms the rest of the story.\r\n', 'Fight for mill workers', '', 'Arasi', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master_extension` (`id`, `movie_id`, `system_lang_code_id`, `description`, `message`, `subject_line`, `alternate_title`, `from_book`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(14, 21, 4, 'In this film, kamal (Thenali) plays a Srilankan Tamil speaking fellow who suffers from all sorts of  phobia and desperately needs treatment from a psychiatrist. His attending psychiatrist (Delhi Ganesh), having had no success but only troubles with Thenali, sends Thenali to a rival, Dr.kailash (Jayaram) in an attempt to destroy Dr.Kailash. The patient pursues Dr.Kailash on vacation with his family all the way to the hill station. By the end of the vacation, the Doctor becomes patient, and the patient becomes Doctor. &#8216;THENALI&#8217; is an uproarious comedy, for the whole family.', '', '', 'Paya Mayam', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master_extension` (`id`, `movie_id`, `system_lang_code_id`, `description`, `message`, `subject_line`, `alternate_title`, `from_book`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(15, 15, 4, 'sdfasdf', 'asdfa', 'sadfasdf', 'asdfasdf', 'asdf', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_master_extension` (`id`, `movie_id`, `system_lang_code_id`, `description`, `message`, `subject_line`, `alternate_title`, `from_book`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(16, 15, 0, '', 'adsfladsknfads', '', '', '', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Index: IDX_movie_master_extension_2
--
ALTER TABLE `ahtees`.`movie_master_extension` ADD INDEX IDX_movie_master_extension_2 (movie_id,system_lang_code_id );
-- GO

--
-- Table: movie_punch_dialog
--
CREATE TABLE `movie_punch_dialog` 
(
	`id` integer (11) NOT NULL AUTO_INCREMENT , 
	`movie_id` integer (11) NOT NULL, 
	`system_lang_code_id` integer (11), 
	`dialog` varchar (1000) NOT NULL, 
	`user_id` varchar (30), 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: movie_punch_dialog
--
BEGIN;
-- GO
INSERT INTO `movie_punch_dialog` (`id`, `movie_id`, `system_lang_code_id`, `dialog`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(4, 1, 4, 'I\'m not British, I\'m American', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_punch_dialog` (`id`, `movie_id`, `system_lang_code_id`, `dialog`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(5, 1, 4, 'Mother thinks that any single man with big bucks is shopping for a wife.', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_punch_dialog` (`id`, `movie_id`, `system_lang_code_id`, `dialog`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(6, 1, 4, '[as Balraj walks off to dance] Watch yourself, Darcy, he\'s about to transform into the Indian MC Hammer! ', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_punch_dialog` (`id`, `movie_id`, `system_lang_code_id`, `dialog`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(7, 7, NULL, 'vczxcvxcvzxcvzxcv', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_punch_dialog` (`id`, `movie_id`, `system_lang_code_id`, `dialog`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(8, 7, NULL, 'zxcvzxcvzxcvzxcvzxcvzxcvz', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_punch_dialog` (`id`, `movie_id`, `system_lang_code_id`, `dialog`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(9, 7, NULL, 'This is <b> great </b>', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_punch_dialog` (`id`, `movie_id`, `system_lang_code_id`, `dialog`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(10, 4, NULL, 'Testing this dialong', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_punch_dialog` (`id`, `movie_id`, `system_lang_code_id`, `dialog`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(11, 18, 4, 'testing...', NULL, NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Index: IDX_movie_punch_dialog_2
--
ALTER TABLE `ahtees`.`movie_punch_dialog` ADD INDEX IDX_movie_punch_dialog_2 (movie_id,user_id );
-- GO

--
-- Table: movie_role_type_master
--
CREATE TABLE `movie_role_type_master` 
(
	`id` integer (11) NOT NULL AUTO_INCREMENT , 
	`description` varchar (128), 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: movie_role_type_master
--
BEGIN;
-- GO
INSERT INTO `movie_role_type_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(6, 'Hero', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_role_type_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(7, 'Heroiene', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_role_type_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(8, 'Villian', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_role_type_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(9, 'Comedian', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_role_type_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(10, 'Supporting Actor', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_role_type_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(11, 'Supporting Actress', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_role_type_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(12, 'Director', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_role_type_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(13, 'Music Director', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_role_type_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(14, 'Editor', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_role_type_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(15, 'Cameraman', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_role_type_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(16, 'Stunt Master', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_role_type_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(17, 'Screen Play Writer', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_role_type_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(18, 'Story Writer', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_role_type_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(19, 'Dialog Writer', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_role_type_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(20, 'Song Writer', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_role_type_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(21, 'Singer', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_role_type_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(22, 'Dance Master', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_role_type_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(23, 'Cinematographer', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_role_type_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(24, 'Producer', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_role_type_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(26, 'Advertiser', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_role_type_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(27, 'PR Agent', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_role_type_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(29, 'Art Director', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Table: movie_sequel
--
CREATE TABLE `movie_sequel` 
(
	`id` integer (10) NOT NULL AUTO_INCREMENT , 
	`movie_id` integer (10) NOT NULL, 
	`sequel_number` integer (10) NOT NULL, 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: movie_sequel
--
BEGIN;
-- GO
COMMIT;
-- GO

--
-- Index: IDX_movie_sequel_2
--
ALTER TABLE `ahtees`.`movie_sequel` ADD INDEX IDX_movie_sequel_2 (movie_id );
-- GO

--
-- Table: movie_status_master
--
CREATE TABLE `movie_status_master` 
(
	`id` integer (10) NOT NULL AUTO_INCREMENT , 
	`name` varchar (50) NOT NULL, 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: movie_status_master
--
BEGIN;
-- GO
INSERT INTO `movie_status_master` (`id`, `name`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(5, 'Released', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_status_master` (`id`, `name`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(6, 'In Making', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_status_master` (`id`, `name`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(7, 'Banned', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_status_master` (`id`, `name`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(8, 'Under Review', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_status_master` (`id`, `name`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(9, 'Rejected', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Table: movie_studio
--
CREATE TABLE `movie_studio` 
(
	`id` integer (11) NOT NULL AUTO_INCREMENT , 
	`movie_id` integer (11) NOT NULL, 
	`studio_id` integer (11) NOT NULL, 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: movie_studio
--
BEGIN;
-- GO
INSERT INTO `movie_studio` (`id`, `movie_id`, `studio_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(3, 1, 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_studio` (`id`, `movie_id`, `studio_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(5, 1, 3, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_studio` (`id`, `movie_id`, `studio_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(6, 7, 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_studio` (`id`, `movie_id`, `studio_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(7, 2, 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_studio` (`id`, `movie_id`, `studio_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(8, 4, 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_studio` (`id`, `movie_id`, `studio_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(9, 22, 1, NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Index: IDX_movie_studio_2
--
ALTER TABLE `ahtees`.`movie_studio` ADD INDEX IDX_movie_studio_2 (movie_id,studio_id );
-- GO

--
-- Table: movie_studio_rating
--
CREATE TABLE `movie_studio_rating` 
(
	`id` integer (11) NOT NULL AUTO_INCREMENT , 
	`movie_id` integer (11) NOT NULL, 
	`studio_id` integer (11) NOT NULL, 
	`rating_id` integer (2), 
	`user_id` varchar (30), 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: movie_studio_rating
--
BEGIN;
-- GO
INSERT INTO `movie_studio_rating` (`id`, `movie_id`, `studio_id`, `rating_id`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(4, 1, 1, 7, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_studio_rating` (`id`, `movie_id`, `studio_id`, `rating_id`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(6, 1, 3, 6, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_studio_rating` (`id`, `movie_id`, `studio_id`, `rating_id`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(7, 4, 1, 2, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_studio_rating` (`id`, `movie_id`, `studio_id`, `rating_id`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(8, 4, 0, 0, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `movie_studio_rating` (`id`, `movie_id`, `studio_id`, `rating_id`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(9, 22, 1, 2, NULL, NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Index: IDX_movie_studio_rating_2
--
ALTER TABLE `ahtees`.`movie_studio_rating` ADD INDEX IDX_movie_studio_rating_2 (movie_id,studio_id,user_id );
-- GO

--
-- Table: production_cost_master
--
CREATE TABLE `production_cost_master` 
(
	`id` integer (11) NOT NULL AUTO_INCREMENT , 
	`cost` varchar (50), 
	`entered_date` datetime, 
	`entered_by` varchar (50), 
	`updated_by` varchar (50), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: production_cost_master
--
BEGIN;
-- GO
INSERT INTO `production_cost_master` (`id`, `cost`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(1, '0-100000', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `production_cost_master` (`id`, `cost`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(3, '10001-500000', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `production_cost_master` (`id`, `cost`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(4, '500001-1000000', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `production_cost_master` (`id`, `cost`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(5, '2000000', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Table: raaga_master
--
CREATE TABLE `raaga_master` 
(
	`id` integer (11) NOT NULL AUTO_INCREMENT , 
	`name` varchar (100) NOT NULL, 
	`description` varchar (500), 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: raaga_master
--
BEGIN;
-- GO
INSERT INTO `raaga_master` (`id`, `name`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(8, 'Unknown', 'Raga Not Identified Yet', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `raaga_master` (`id`, `name`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(9, 'Kanakaangi', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `raaga_master` (`id`, `name`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(10, 'Kanakaambari', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `raaga_master` (`id`, `name`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(11, 'Karnaataka Suddha Saveri', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `raaga_master` (`id`, `name`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(12, 'Latantapriyaa', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `raaga_master` (`id`, `name`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(13, 'Lavaangi', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `raaga_master` (`id`, `name`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(14, 'Megha', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `raaga_master` (`id`, `name`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(15, 'Rishabhavilaasa', '', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Table: raaga_master_extension
--
CREATE TABLE `raaga_master_extension` 
(
	`id` integer (10) NOT NULL AUTO_INCREMENT , 
	`raaga_id` integer (10) NOT NULL, 
	`system_lang_code_id` integer (10) NOT NULL, 
	`name` varchar (100) NOT NULL, 
	`description` varchar (500),
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: raaga_master_extension
--
BEGIN;
-- GO
COMMIT;
-- GO

--
-- Index: IDX_raaga_master_extension_2
--
ALTER TABLE `ahtees`.`raaga_master_extension` ADD INDEX IDX_raaga_master_extension_2 (raaga_id,system_lang_code_id );
-- GO

--
-- Table: rating_master
--
CREATE TABLE `rating_master` 
(
	`id` integer (1) NOT NULL AUTO_INCREMENT , 
	`description` varchar (10) NOT NULL, 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: rating_master
--
BEGIN;
-- GO
INSERT INTO `rating_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(5, 'PG-13', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `rating_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(6, 'R', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `rating_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(7, 'NC-17', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `rating_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(8, 'G', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `rating_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(9, 'A', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `rating_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(10, 'U', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `rating_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(11, 'Not Rated', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `rating_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(12, 'U/A', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Table: song_master
--
CREATE TABLE `song_master` 
(
	`id` integer (11) NOT NULL AUTO_INCREMENT , 
	`movie_id` integer (11), 
	`raaga_id` integer (11), 
	`type_id` integer (11) NOT NULL, 
	`number` integer (11), 
	`link` varchar (200), 
	`release_date` datetime, 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: song_master
--
BEGIN;
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(28, 10, 15, 7, 9, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(70, 13, 10, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(71, 3, 11, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(72, 7, 8, 7, 1, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(97, 1, 8, 6, 1, 'songs/content/97_angry 01.wav', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(101, 1, 8, 6, 2, 'songs/content/101_angry 03.wav', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(102, 1, 9, 7, 3, 'songs/content/102_angry 02.wav', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(103, 1, 9, 6, 4, 'songs/content/103_angry 04.wav', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(104, 1, 9, 6, 5, 'songs/content/104_angry 05.wav', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(105, 10, 9, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(106, 7, 11, 8, 2, 'songs/content/106_109231022_df74c0465f.jpg', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(107, 2, 8, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(108, 9, 10, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(109, 9, 10, 6, 2, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(114, 19, 8, 9, 1, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(115, 18, 9, 7, 1, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(116, 20, 8, 9, 1, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(117, 22, 8, 9, 1, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(118, 4, 9, 8, 3, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(119, 21, 9, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(120, 4, 9, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(121, 4, 9, 6, 2, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(123, 22, 8, 9, 2, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(124, 17, 8, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(125, 12, 9, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(126, 20, 8, 9, 2, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(127, 22, 8, 9, 3, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(128, 8, 9, 6, 4, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(130, 15, 8, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(131, 15, 9, 6, 2, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(132, 16, 9, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(134, 6, 8, 5, 2, 'songs/content/134_4.txt', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(136, 6, 9, 7, 3, 'songs/content/136_6.txt', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(137, 6, 9, 6, 4, 'songs/content/137_1.txt', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(141, 6, 9, 5, 1, 'songs/content/141_1.txt', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(142, 16, 9, 6, 2, 'songs/content/142_index.php', NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master` (`id`, `movie_id`, `raaga_id`, `type_id`, `number`, `link`, `release_date`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(143, 5, 9, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Index: IDX_song_master_3
--
ALTER TABLE `ahtees`.`song_master` ADD UNIQUE IDX_song_master_3 (movie_id,number );
-- GO

--
-- Index: IDX_song_master_2
--
ALTER TABLE `ahtees`.`song_master` ADD INDEX IDX_song_master_2 (movie_id,raaga_id,type_id );
-- GO

--
-- Table: song_master_extension
--
CREATE TABLE `song_master_extension` 
(
	`id` integer (10) NOT NULL AUTO_INCREMENT , 
	`song_id` integer (10) NOT NULL, 
	`system_lang_code_id` integer (2) NOT NULL, 
	`name` varchar (150) NOT NULL, 
	`description` varchar (500) NOT NULL, 
	`lyrics` longtext, 
	`highlight` varchar (500), 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: song_master_extension
--
BEGIN;
-- GO
INSERT INTO `song_master_extension` (`id`, `song_id`, `system_lang_code_id`, `name`, `description`, `lyrics`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(11, 28, 4, 'Song 2', 'Desc2', 'lyrc 2', 'highlight 2', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master_extension` (`id`, `song_id`, `system_lang_code_id`, `name`, `description`, `lyrics`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(12, 28, 5, 'test', 'test', 'test', 'test', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master_extension` (`id`, `song_id`, `system_lang_code_id`, `name`, `description`, `lyrics`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(13, 28, 5, 'bnbnbv', 'bcnnb', 'nvbcvb', 'vbnbn', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master_extension` (`id`, `song_id`, `system_lang_code_id`, `name`, `description`, `lyrics`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(17, 72, 5, 'vxzcac', 'This is great.', 'The update actually worked.', 'This is starting to work', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master_extension` (`id`, `song_id`, `system_lang_code_id`, `name`, `description`, `lyrics`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(27, 74, 4, 'Test Song', 'Test Song', 'Test Song', 'Test Song', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master_extension` (`id`, `song_id`, `system_lang_code_id`, `name`, `description`, `lyrics`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(37, 70, 0, 'test', 'test', 'test', 'test', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master_extension` (`id`, `song_id`, `system_lang_code_id`, `name`, `description`, `lyrics`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(41, 88, 4, 'Ugly song', 'This is a bad song', 'This song sucks', 'This song really sucks!', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master_extension` (`id`, `song_id`, `system_lang_code_id`, `name`, `description`, `lyrics`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(42, 71, 4, 'This song sucks!', '', '', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master_extension` (`id`, `song_id`, `system_lang_code_id`, `name`, `description`, `lyrics`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(43, 107, 4, 'aadsfdsaasdfasdf', 'asdfasdf', 'sadfasdf', 'sdafsdaf', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master_extension` (`id`, `song_id`, `system_lang_code_id`, `name`, `description`, `lyrics`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(44, 104, 4, 'english 1', 'english', 'Not sure what to say here. this sounds more funny and yiky user experience.', 'none', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master_extension` (`id`, `song_id`, `system_lang_code_id`, `name`, `description`, `lyrics`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(45, 97, 4, 'bad boy', 'great song', 'sucks', 'great song but the lyrics are not that great. Still worth listening. ', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master_extension` (`id`, `song_id`, `system_lang_code_id`, `name`, `description`, `lyrics`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(46, 70, 4, 'ZXCcs', '', '', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master_extension` (`id`, `song_id`, `system_lang_code_id`, `name`, `description`, `lyrics`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(50, 114, 4, 'Girl Friend ....', '5 college students singing this songs', '', 'dance', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master_extension` (`id`, `song_id`, `system_lang_code_id`, `name`, `description`, `lyrics`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(54, 88, 4, 'test', 'teset', 'test', 'tset', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master_extension` (`id`, `song_id`, `system_lang_code_id`, `name`, `description`, `lyrics`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(55, 118, 4, 'test', 'test', 'test', 'test', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master_extension` (`id`, `song_id`, `system_lang_code_id`, `name`, `description`, `lyrics`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(56, 120, 4, 'Crappy Song.', '', '', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master_extension` (`id`, `song_id`, `system_lang_code_id`, `name`, `description`, `lyrics`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(57, 124, 4, 'Good Song', 'This is a good song', 'great song...', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master_extension` (`id`, `song_id`, `system_lang_code_id`, `name`, `description`, `lyrics`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(59, 104, 0, '', '', 'namasthe saraswathi devi\r\nprachaiyiya\r\nnirvi sesha sunnya vathi\r\n', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master_extension` (`id`, `song_id`, `system_lang_code_id`, `name`, `description`, `lyrics`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(60, 126, 4, 'Adikkuthu Kuliru', 'Rjinikanth & Vijayasanthy\'s First Night Song', '', 'Rajinikanth also sung this song', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master_extension` (`id`, `song_id`, `system_lang_code_id`, `name`, `description`, `lyrics`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(61, 115, 4, 'Whatever song that is', 'this sucks anyways.', '', 'what do say, this was one of the worst songs in the world :)', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master_extension` (`id`, `song_id`, `system_lang_code_id`, `name`, `description`, `lyrics`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(62, 97, 0, '', '', '', 'bad customer experience.', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master_extension` (`id`, `song_id`, `system_lang_code_id`, `name`, `description`, `lyrics`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(65, 116, 4, 'Amma Enru alaikatha', 'Mother Sentiment Song', '', 'Yesudos Voice & Ilayaraja Music', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master_extension` (`id`, `song_id`, `system_lang_code_id`, `name`, `description`, `lyrics`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(66, 116, 5, 'Amma Enru alaikatha', 'Mother Sentiment Song', '', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master_extension` (`id`, `song_id`, `system_lang_code_id`, `name`, `description`, `lyrics`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(67, 130, 0, '', '', 'test song.', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master_extension` (`id`, `song_id`, `system_lang_code_id`, `name`, `description`, `lyrics`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(69, 130, 4, 'sdfklj', 'sdlfkj', 'test song, good to hear.', '', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master_extension` (`id`, `song_id`, `system_lang_code_id`, `name`, `description`, `lyrics`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(70, 132, 4, 'trees', 'sdfkjdfskj', 'this is a test song.', 'sdlkjdsl', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master_extension` (`id`, `song_id`, `system_lang_code_id`, `name`, `description`, `lyrics`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(71, 131, 4, 'testing this song', 'good song', 'sdfgkjsdfgdfgkljdsfglksdfjgsdklfgjdfsg\r\nsdfgkljdfsgkljdfsglkjdfsgkljdsfg\'kjdfsg\r\ndsfgkljdfsg\'dfslkgjdsgjsdlfgkjsd\'fgkjsdfg\r\nsdfgkljdsfgk\'jsdfgk\'ljdsfg\'kldj\'lkdjfgs\r\ndfgd\'lfkgjd\'fgjd\'gjsd\'fgkjsdfgksdflgjsdf\r\ngsdflgkjsdfgjdfs\'gkjsdg\r\nsdfgkjdsfgkjdfsgkjsldfkgj\r\ndfsgldfskjgds\'lfkgjs\'dfgkjsdf\r\ngdsfgkjdfs\'gkjdsf\'kgjdfsklgj\r\n\r\nsdfgkjsdfgdfgkljdsfglksdfjgsdklfgjdfsg\r\nsdfgkljdfsgkljdfsglkjdfsgkljdsfg\'kjdfsg\r\ndsfgkljdfsg\'dfslkgjdsgjsdlfgkjsd\'fgkjsdfg\r\nsdfgkljdsfgk\'jsdfgk\'ljdsfg\'kldj\'lkdjfgs\r\ndfgd\'lfkgjd\'fgjd\'gjsd\'fgkjsdfgksdflgjsdf\r\ngsdflgkjsdfgjdfs\'gkjsdg\r\nsdfgkjdsfgkjdfsgkjsldfkgj\r\ndfsgldfskjgds\'lfkgjs\'dfgkjsdf\r\ngdsfgkjdfs\'gkjdsf\'kgjdfsklgj\r\n\r\nsdfgkjsdfgdfgkljdsfglksdfjgsdklfgjdfsg\r\nsdfgkljdfsgkljdfsglkjdfsgkljdsfg\'kjdfsg\r\ndsfgkljdfsg\'dfslkgjdsgjsdlfgkjsd\'fgkjsdfg\r\nsdfgkljdsfgk\'jsdfgk\'ljdsfg\'kldj\'lkdjfgs\r\ndfgd\'lfkgjd\'fgjd\'gjsd\'fgkjsdfgksdflgjsdf\r\ngsdflgkjsdfgjdfs\'gkjsdg\r\nsdfgkjdsfgkjdfsgkjsldfkgj\r\ndfsgldfskjgds\'lfkgjs\'dfgkjsdf\r\ngdsfgkjdfs\'gkjdsf\'kgjdfsklgj\\\r\n\r\n\\sdfgkjsdfgdfgkljdsfglksdfjgsdklfgjdfsg\r\nsdfgkljdfsgkljdfsglkjdfsgkljdsfg\'kjdfsg\r\ndsfgkljdfsg\'dfslkgjdsgjsdlfgkjsd\'fgkjsdfg\r\nsdfgkljdsfgk\'jsdfgk\'ljdsfg\'kldj\'lkdjfgs\r\ndfgd\'lfkgjd\'fgjd\'gjsd\'fgkjsdfgksdflgjsdf\r\ngsdflgkjsdfgjdfs\'gkjsdg\r\nsdfgkjdsfgkjdfsgkjsldfkgj\r\ndfsgldfskjgds\'lfkgjs\'dfgkjsdf\r\ngdsfgkjdfs\'gkjdsf\'kgjdfsklgj\r\n\r\nsdfgkjsdfgdfgkljdsfglksdfjgsdklfgjdfsg\r\nsdfgkljdfsgkljdfsglkjdfsgkljdsfg\'kjdfsg\r\ndsfgkljdfsg\'dfslkgjdsgjsdlfgkjsd\'fgkjsdfg\r\nsdfgkljdsfgk\'jsdfgk\'ljdsfg\'kldj\'lkdjfgs\r\ndfgd\'lfkgjd\'fgjd\'gjsd\'fgkjsdfgksdflgjsdf\r\ngsdflgkjsdfgjdfs\'gkjsdg\r\nsdfgkjdsfgkjdfsgkjsldfkgj\r\ndfsgldfskjgds\'lfkgjs\'dfgkjsdf\r\ngdsfgkjdfs\'gkjdsf\'kgjdfsklgj\r\n\r\nsdfgkjsdfgdfgkljdsfglksdfjgsdklfgjdfsg\r\nsdfgkljdfsgkljdfsglkjdfsgkljdsfg\'kjdfsg\r\ndsfgkljdfsg\'dfslkgjdsgjsdlfgkjsd\'fgkjsdfg\r\nsdfgkljdsfgk\'jsdfgk\'ljdsfg\'kldj\'lkdjfgs\r\ndfgd\'lfkgjd\'fgjd\'gjsd\'fgkjsdfgksdflgjsdf\r\ngsdflgkjsdfgjdfs\'gkjsdg\r\nsdfgkjdsfgkjdfsgkjsldfkgj\r\ndfsgldfskjgds\'lfkgjs\'dfgkjsdf\r\ngdsfgkjdfs\'gkjdsf\'kgjdfsklgj\r\n\r\nsdfgkjsdfgdfgkljdsfglksdfjgsdklfgjdfsg\r\nsdfgkljdfsgkljdfsglkjdfsgkljdsfg\'kjdfsg\r\ndsfgkljdfsg\'dfslkgjdsgjsdlfgkjsd\'fgkjsdfg\r\nsdfgkljdsfgk\'jsdfgk\'ljdsfg\'kldj\'lkdjfgs\r\ndfgd\'lfkgjd\'fgjd\'gjsd\'fgkjsdfgksdflgjsdf\r\ngsdflgkjsdfgjdfs\'gkjsdg\r\nsdfgkjdsfgkjdfsgkjsldfkgj\r\ndfsgldfskjgds\'lfkgjs\'dfgkjsdf\r\ngdsfgkjdfs\'gkjdsf\'kgjdfsklgj\r\n\r\nsdfgkjsdfgdfgkljdsfglksdfjgsdklfgjdfsg\r\nsdfgkljdfsgkljdfsglkjdfsgkljdsfg\'kjdfsg\r\ndsfgkljdfsg\'dfslkgjdsgjsdlfgkjsd\'fgkjsdfg\r\nsdfgkljdsfgk\'jsdfgk\'ljdsfg\'kldj\'lkdjfgs\r\ndfgd\'lfkgjd\'fgjd\'gjsd\'fgkjsdfgksdflgjsdf\r\ngsdflgkjsdfgjdfs\'gkjsdg\r\nsdfgkjdsfgkjdfsgkjsldfkgj\r\ndfsgldfskjgds\'lfkgjs\'dfgkjsdf\r\ngdsfgkjdfs\'gkjdsf\'kgjdfsklgj\r\n\r\nsdfgkjsdfgdfgkljdsfglksdfjgsdklfgjdfsg\r\nsdfgkljdfsgkljdfsglkjdfsgkljdsfg\'kjdfsg\r\ndsfgkljdfsg\'dfslkgjdsgjsdlfgkjsd\'fgkjsdfg\r\nsdfgkljdsfgk\'jsdfgk\'ljdsfg\'kldj\'lkdjfgs\r\ndfgd\'lfkgjd\'fgjd\'gjsd\'fgkjsdfgksdflgjsdf\r\ngsdflgkjsdfgjdfs\'gkjsdg\r\nsdfgkjdsfgkjdfsgkjsldfkgj\r\ndfsgldfskjgds\'lfkgjs\'dfgkjsdf\r\ngdsfgkjdfs\'gkjdsf\'kgjdfsklgj\r\n\r\nsdfgkjsdfgdfgkljdsfglksdfjgsdklfgjdfsg\r\nsdfgkljdfsgkljdfsglkjdfsgkljdsfg\'kjdfsg\r\ndsfgkljdfsg\'dfslkgjdsgjsdlfgkjsd\'fgkjsdfg\r\nsdfgkljdsfgk\'jsdfgk\'ljdsfg\'kldj\'lkdjfgs\r\ndfgd\'lfkgjd\'fgjd\'gjsd\'fgkjsdfgksdflgjsdf\r\ngsdflgkjsdfgjdfs\'gkjsdg\r\nsdfgkjdsfgkjdfsgkjsldfkgj\r\ndfsgldfskjgds\'lfkgjs\'dfgkjsdf\r\ngdsfgkjdfs\'gkjdsf\'kgjdfsklgj\r\n\r\nsdfgkjsdfgdfgkljdsfglksdfjgsdklfgjdfsg\r\nsdfgkljdfsgkljdfsglkjdfsgkljdsfg\'kjdfsg\r\ndsfgkljdfsg\'dfslkgjdsgjsdlfgkjsd\'fgkjsdfg\r\nsdfgkljdsfgk\'jsdfgk\'ljdsfg\'kldj\'lkdjfgs\r\ndfgd\'lfkgjd\'fgjd\'gjsd\'fgkjsdfgksdflgjsdf\r\ngsdflgkjsdfgjdfs\'gkjsdg\r\nsdfgkjdsfgkjdfsgkjsldfkgj\r\ndfsgldfskjgds\'lfkgjs\'dfgkjsdf\r\ngdsfgkjdfs\'gkjdsf\'kgjdfsklgj\r\n\r\nsdfgkjsdfgdfgkljdsfglksdfjgsdklfgjdfsg\r\nsdfgkljdfsgkljdfsglkjdfsgkljdsfg\'kjdfsg\r\ndsfgkljdfsg\'dfslkgjdsgjsdlfgkjsd\'fgkjsdfg\r\nsdfgkljdsfgk\'jsdfgk\'ljdsfg\'kldj\'lkdjfgs\r\ndfgd\'lfkgjd\'fgjd\'gjsd\'fgkjsdfgksdflgjsdf\r\ngsdflgkjsdfgjdfs\'gkjsdg\r\nsdfgkjdsfgkjdfsgkjsldfkgj\r\ndfsgldfskjgds\'lfkgjs\'dfgkjsdf\r\ngdsfgkjdfs\'gkjdsf\'kgjdfsklgj\r\n\r\nEND OF SONG', 'don\'t you love it.', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_master_extension` (`id`, `song_id`, `system_lang_code_id`, `name`, `description`, `lyrics`, `highlight`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(72, 143, 4, 'test song. ', 'This is a great song', 'this is a good song to be listened to. I was so happy listening to it.', 'This is height of the best song.', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Index: IDX_song_master_extension_2
--
ALTER TABLE `ahtees`.`song_master_extension` ADD INDEX IDX_song_master_extension_2 (song_id,system_lang_code_id );
-- GO

--
-- Table: song_rating
--
CREATE TABLE `song_rating` 
(
	`id` integer (11) NOT NULL AUTO_INCREMENT , 
	`song_id` integer (11) NOT NULL, 
	`rating` integer (1) NOT NULL, 
	`user_id` varchar (30), 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: song_rating
--
BEGIN;
-- GO
INSERT INTO `song_rating` (`id`, `song_id`, `rating`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(17, 70, 1, '1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_rating` (`id`, `song_id`, `rating`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(18, 70, 3, '1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_rating` (`id`, `song_id`, `rating`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(23, 88, 2, '1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_rating` (`id`, `song_id`, `rating`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(24, 28, 2, '1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_rating` (`id`, `song_id`, `rating`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(25, 107, 2, '1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_rating` (`id`, `song_id`, `rating`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(29, 114, 3, '6', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_rating` (`id`, `song_id`, `rating`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(31, 116, 4, '6', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_rating` (`id`, `song_id`, `rating`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(32, 143, 2, '1', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Index: IDX_song_rating_2
--
ALTER TABLE `ahtees`.`song_rating` ADD INDEX IDX_song_rating_2 (song_id,user_id );
-- GO

--
-- Table: song_review
--
CREATE TABLE `song_review` 
(
	`id` integer (11) NOT NULL AUTO_INCREMENT , 
	`song_id` integer (11) NOT NULL, 
	`system_lang_code_id` integer (11), 
	`review_text` varchar (500) NOT NULL, 
	`user_id` varchar (30), 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: song_review
--
BEGIN;
-- GO
INSERT INTO `song_review` (`id`, `song_id`, `system_lang_code_id`, `review_text`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(9, 74, 4, 'Good Song it is. But it is not too much fun to work with.', '1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_review` (`id`, `song_id`, `system_lang_code_id`, `review_text`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(10, 74, 0, '<B> <font size=5 color=red>This song totally sucks </font> </B>', '0', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_review` (`id`, `song_id`, `system_lang_code_id`, `review_text`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(21, 70, 4, 'TEsting the review section, that\'s all.', '1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_review` (`id`, `song_id`, `system_lang_code_id`, `review_text`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(23, 88, 4, 'This is bad review.', '1', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_review` (`id`, `song_id`, `system_lang_code_id`, `review_text`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(24, 143, 4, 'this is a great song. pelase make sure to listen to it.', '1', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Index: IDX_song_review_2
--
ALTER TABLE `ahtees`.`song_review` ADD INDEX IDX_song_review_2 (song_id,system_lang_code_id,user_id );
-- GO

--
-- Table: song_singer
--
CREATE TABLE `song_singer` 
(
	`id` integer (11) NOT NULL AUTO_INCREMENT , 
	`song_id` integer (11) NOT NULL, 
	`customer_id` varchar (30) NOT NULL, 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: song_singer
--
BEGIN;
-- GO
INSERT INTO `song_singer` (`id`, `song_id`, `customer_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(1, 97, '3', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_singer` (`id`, `song_id`, `customer_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(2, 97, '22', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_singer` (`id`, `song_id`, `customer_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(5, 110, '26', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_singer` (`id`, `song_id`, `customer_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(8, 116, '33', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_singer` (`id`, `song_id`, `customer_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(9, 110, '12', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_singer` (`id`, `song_id`, `customer_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(11, 110, '7', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_singer` (`id`, `song_id`, `customer_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(14, 141, '0', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_singer` (`id`, `song_id`, `customer_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(15, 141, '3', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_singer` (`id`, `song_id`, `customer_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(16, 142, '5', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_singer` (`id`, `song_id`, `customer_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(17, 143, '5', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Index: IDX_song_singer_2
--
ALTER TABLE `ahtees`.`song_singer` ADD INDEX IDX_song_singer_2 (song_id,customer_id );
-- GO

--
-- Table: song_type_master
--
CREATE TABLE `song_type_master` 
(
	`id` integer (4) NOT NULL AUTO_INCREMENT , 
	`name` varchar (150) NOT NULL, 
	`description` varchar (255) NOT NULL, 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: song_type_master
--
BEGIN;
-- GO
INSERT INTO `song_type_master` (`id`, `name`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(5, 'Carnatic Classical', 'Carnatic Classical Music', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_type_master` (`id`, `name`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(6, 'Rock', 'Rock Music', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_type_master` (`id`, `name`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(7, 'Jazz', 'Jazz Music', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_type_master` (`id`, `name`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(8, 'Hindustani', 'Hindustani Music', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `song_type_master` (`id`, `name`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(9, 'Unknown', 'We just don\'t know what type of song this is', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Table: sports_master
--
CREATE TABLE `sports_master` 
(
	`id` integer (4) NOT NULL AUTO_INCREMENT , 
	`description` varchar (50) NOT NULL, 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: sports_master
--
BEGIN;
-- GO
INSERT INTO `sports_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(1, 'Cricket', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `sports_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(2, 'Soccer', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `sports_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(3, 'Chess', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `sports_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(4, 'Horse Riding', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `sports_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(5, 'Volley Ball', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `sports_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(9, 'Basketball', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `sports_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(10, 'Hockey', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `sports_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(11, 'Carrom', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `sports_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(12, 'Ice Skating', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `sports_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(13, 'Ice Hockey', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `sports_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(14, 'Kabadi', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `sports_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(15, 'Throw Ball', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `sports_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(16, 'Badminton', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `sports_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(17, 'Rugby', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `sports_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(18, 'Curling', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `sports_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(19, 'Atheletics', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `sports_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(20, 'Tennis', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `sports_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(21, 'Body Building', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `sports_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(22, 'American Football', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `sports_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(23, 'Kung-fu', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `sports_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(24, 'karate', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `sports_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(25, 'Gymnastics', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Table: state_master
--
CREATE TABLE `state_master` 
(
	`id` integer (10) NOT NULL AUTO_INCREMENT , 
	`name` varchar (50) NOT NULL, 
	`country_id` integer (10), 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: state_master
--
BEGIN;
-- GO
INSERT INTO `state_master` (`id`, `name`, `country_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(1, 'State 1', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `state_master` (`id`, `name`, `country_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(2, 'State 2', 2, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `state_master` (`id`, `name`, `country_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(3, 'State 3', 3, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `state_master` (`id`, `name`, `country_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(4, 'Tamil Nadu', 4, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `state_master` (`id`, `name`, `country_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(5, 'Kerala', 4, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `state_master` (`id`, `name`, `country_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(6, 'Karnataka', 4, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `state_master` (`id`, `name`, `country_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(7, 'Andhra Pradhesh', 4, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `state_master` (`id`, `name`, `country_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(8, 'Maharashtra', 0, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `state_master` (`id`, `name`, `country_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(9, 'Maharashtra', 4, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `state_master` (`id`, `name`, `country_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(10, 'Madhya Pradesh', 4, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `state_master` (`id`, `name`, `country_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(11, 'Uttar Pradesh', 4, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `state_master` (`id`, `name`, `country_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(12, 'Arunachal Pradesh', 4, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `state_master` (`id`, `name`, `country_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(13, 'Jharkhand', 4, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `state_master` (`id`, `name`, `country_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(14, 'Uttranchal', 4, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `state_master` (`id`, `name`, `country_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(15, 'Assam', 4, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `state_master` (`id`, `name`, `country_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(16, 'Manipur', 4, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `state_master` (`id`, `name`, `country_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(17, 'Mizoram', 4, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `state_master` (`id`, `name`, `country_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(18, 'Haryana', 4, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `state_master` (`id`, `name`, `country_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(19, 'West Bengal', 4, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `state_master` (`id`, `name`, `country_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(20, 'Rajasthan', 4, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `state_master` (`id`, `name`, `country_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(21, 'Punjab', 4, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `state_master` (`id`, `name`, `country_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(22, 'Tripura', 4, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `state_master` (`id`, `name`, `country_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(23, 'Himachal Pradesh', 4, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `state_master` (`id`, `name`, `country_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(24, 'Sikkim', 4, NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Index: IDX_state_master_2
--
ALTER TABLE `ahtees`.`state_master` ADD INDEX IDX_state_master_2 (country_id );
-- GO

--
-- Table: studio_master
--
CREATE TABLE `studio_master` 
(
	`id` integer (11) NOT NULL AUTO_INCREMENT , 
	`name` varchar (150) NOT NULL, 
	`description` varchar (500) NOT NULL, 
	`address_line_1` varchar (100), 
	`address_line_2` varchar (100), 
	`city` varchar (100), 
	`state` integer (11), 
	`country` integer (11), 
	`email_address` varchar (100), 
	`contact_number_1` varchar (100), 
	`contact_number_2` varchar (100), 
	`contact_number_3` varchar (100), 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: studio_master
--
BEGIN;
-- GO
INSERT INTO `studio_master` (`id`, `name`, `description`, `address_line_1`, `address_line_2`, `city`, `state`, `country`, `email_address`, `contact_number_1`, `contact_number_2`, `contact_number_3`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(1, 'studio 1', 'test', 'test', 'test', 'test', 1, 5, 'test', 'test', 'test', 'test', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `studio_master` (`id`, `name`, `description`, `address_line_1`, `address_line_2`, `city`, `state`, `country`, `email_address`, `contact_number_1`, `contact_number_2`, `contact_number_3`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(2, 'Studio 2', 'test', 'test', 'test', 'test', 4, 4, '', '', '', '', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Table: studio_ratings
--
CREATE TABLE `studio_ratings` 
(
	`id` integer (11) NOT NULL AUTO_INCREMENT , 
	`rating` integer (1) NOT NULL, 
	`user_id` varchar (30), 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: studio_ratings
--
BEGIN;
-- GO
INSERT INTO `studio_ratings` (`id`, `rating`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(1, 1, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `studio_ratings` (`id`, `rating`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(2, 2, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `studio_ratings` (`id`, `rating`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(3, 3, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `studio_ratings` (`id`, `rating`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(4, 4, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `studio_ratings` (`id`, `rating`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(5, 5, NULL, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `studio_ratings` (`id`, `rating`, `user_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(6, 6, NULL, NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Index: IDX_studio_ratings_2
--
ALTER TABLE `ahtees`.`studio_ratings` ADD INDEX IDX_studio_ratings_2 (user_id );
-- GO

--
-- Table: system_lang_code_master
--
CREATE TABLE `system_lang_code_master` 
(
	`id` integer (10) NOT NULL AUTO_INCREMENT , 
	`name` varchar (50) NOT NULL, 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: system_lang_code_master
--
BEGIN;
-- GO
INSERT INTO `system_lang_code_master` (`id`, `name`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(4, 'English', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `system_lang_code_master` (`id`, `name`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(5, 'Tamil', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `system_lang_code_master` (`id`, `name`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(7, 'Telugu', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `system_lang_code_master` (`id`, `name`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(8, 'Hindi', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Table: talent_master
--
CREATE TABLE `talent_master` 
(
	`id` integer (4) NOT NULL AUTO_INCREMENT , 
	`description` varchar (30) NOT NULL, 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: talent_master
--
BEGIN;
-- GO
INSERT INTO `talent_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(10, 'Mimicry', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `talent_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(11, 'Acting', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `talent_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(12, 'Comey', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `talent_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(13, 'Sitcom', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `talent_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(14, 'Athelete', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `talent_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(15, 'Music', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `talent_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(16, 'Direction', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `talent_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(17, 'Spiritual', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `talent_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(18, 'Singer', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `talent_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(20, 'Lyricist', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `talent_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(21, 'Art', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Table: test
--
CREATE TABLE `test` 
(
	`test_id` integer (10) UNSIGNED  NOT NULL DEFAULT 0, 
	`test_desc` varchar (35) NOT NULL
) ;
-- GO

--
-- Dumping Table Data: test
--
BEGIN;
-- GO
COMMIT;
-- GO

--
-- Table: theme_master
--
CREATE TABLE `theme_master` 
(
	`id` integer (10) NOT NULL AUTO_INCREMENT , 
	`name` varchar (50) NOT NULL, 
	`system_lang_code_id` integer (2) NOT NULL, 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: theme_master
--
BEGIN;
-- GO
INSERT INTO `theme_master` (`id`, `name`, `system_lang_code_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(1, 'Theme 1', 2, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `theme_master` (`id`, `name`, `system_lang_code_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(2, 'Theme 2', 1, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `theme_master` (`id`, `name`, `system_lang_code_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(3, 'Theme 3', 2, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `theme_master` (`id`, `name`, `system_lang_code_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(4, 'Romance', 4, NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `theme_master` (`id`, `name`, `system_lang_code_id`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(5, 'Terrorism', 4, NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Index: IDX_theme_master_2
--
ALTER TABLE `ahtees`.`theme_master` ADD INDEX IDX_theme_master_2 (system_lang_code_id );
-- GO

--
-- Table: total_worth_master
--
CREATE TABLE `total_worth_master` 
(
	`id` integer (10) NOT NULL AUTO_INCREMENT , 
	`description` varchar (100) NOT NULL, 
	`entered_date` datetime, 
	`entered_by` varchar (64), 
	`updated_by` varchar (64), 
	`updated_date` datetime,
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: total_worth_master
--
BEGIN;
-- GO
INSERT INTO `total_worth_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(1, '1 million', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `total_worth_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(2, '2 million', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `total_worth_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(3, '3 million', NULL, NULL, NULL, NULL);
-- GO
INSERT INTO `total_worth_master` (`id`, `description`, `entered_date`, `entered_by`, `updated_by`, `updated_date`) VALUES(4, '1 billion', NULL, NULL, NULL, NULL);
-- GO
COMMIT;
-- GO

--
-- Table: user_master
--
CREATE TABLE `user_master` 
(
	`id` integer (11) NOT NULL AUTO_INCREMENT , 
	`username` varchar (100), 
	`password` varchar (50), 
	`level` integer (11) DEFAULT 1, 
	`email` varchar (100),
	PRIMARY KEY (`id`)
) ;
-- GO

--
-- Dumping Table Data: user_master
--
BEGIN;
-- GO
INSERT INTO `user_master` (`id`, `username`, `password`, `level`, `email`) VALUES(1, 'admin', 'ramke', 2, 'krisraman@gmail.com');
-- GO
INSERT INTO `user_master` (`id`, `username`, `password`, `level`, `email`) VALUES(3, 'jadus', 'elprup29', 2, 'jadus@comcast.net');
-- GO
INSERT INTO `user_master` (`id`, `username`, `password`, `level`, `email`) VALUES(4, 'user1', 'login1', 2, 'login@login.com');
-- GO
INSERT INTO `user_master` (`id`, `username`, `password`, `level`, `email`) VALUES(5, 'kumar', 'kumar', 2, 'kuraman10@yahoo.com');
-- GO
INSERT INTO `user_master` (`id`, `username`, `password`, `level`, `email`) VALUES(6, 'maha', 'maha', 1, 'mahalingamvkp@yahoo.co.in');
-- GO
INSERT INTO `user_master` (`id`, `username`, `password`, `level`, `email`) VALUES(7, 'karthick', 'karthick', 1, 'rkarthick06@rediffmail.com');
-- GO
INSERT INTO `user_master` (`id`, `username`, `password`, `level`, `email`) VALUES(8, 'maha', 'maha', 1, 'mahalingamvkp@yahoo.co.in');
-- GO
INSERT INTO `user_master` (`id`, `username`, `password`, `level`, `email`) VALUES(9, 'maha1', 'maha1', 2, 'maha@ahtees.com');
-- GO
COMMIT;
-- GO

--
-- Dumping Tables Foreign Keys
--

--
-- Dumping Triggers
--
SET FOREIGN_KEY_CHECKS=1;
-- GO


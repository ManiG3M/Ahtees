CREATE TABLE resume_categories_master
(
	id integer (10) NOT NULL AUTO_INCREMENT , 
	description varchar (100) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) TYPE=InnoDB CHARACTER SET latin1 COLLATE latin1_swedish_ci;

CREATE TABLE credit_types_master
(
	id integer (10) NOT NULL AUTO_INCREMENT , 
	description varchar (100) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) TYPE=InnoDB CHARACTER SET latin1 COLLATE latin1_swedish_ci;

Film
Television Shows
Advertisements
Drama
Modeling
Standup Comedy
Dance
Mimicry
Show Host
Public Speaking
Music 
Radio 
Print
Internet 
Video 
Dubbing 

CREATE TABLE music_instruments_master
(
	id integer (10) NOT NULL AUTO_INCREMENT , 
	description varchar (100) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
);

CREATE table dance_types_master
(
	id integer (10) NOT NULL AUTO_INCREMENT , 
	description varchar (100) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
);

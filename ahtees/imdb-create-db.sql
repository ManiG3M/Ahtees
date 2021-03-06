CREATE TABLE aspect_ratio_master 
(
	id integer (10) NOT NULL AUTO_INCREMENT , 
	description varchar (30) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE award_master 
(
	id integer (4) NOT NULL AUTO_INCREMENT , 
	description varchar (255) NOT NULL, 
	initiated_by varchar (100), 
	initiated_date datetime, 
	purpose varchar (255), 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE award_master_extension 
(
	award_id integer (10) NOT NULL AUTO_INCREMENT , 
	system_lang_code_id integer (10) NOT NULL, 
	description varchar (255) NOT NULL, 
	initiated_by varchar (100), 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime, 
	purpose varchar (255),
	PRIMARY KEY (award_id)
) ;

ALTER TABLE ahtees.award_master_extension ADD INDEX IDX_award_master_extension_2 (system_lang_code_id );

CREATE TABLE category_master 
(
	id integer (4) NOT NULL AUTO_INCREMENT , 
	description varchar (255) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE category_master_extension 
(
	category_id integer (10) NOT NULL AUTO_INCREMENT , 
	system_lang_code_id integer (10) NOT NULL, 
	description varchar (255) NOT NULL, 
	detail_desc varchar (1000),
	PRIMARY KEY (category_id)
) ;

ALTER TABLE ahtees.category_master_extension ADD UNIQUE category_id (category_id,system_lang_code_id );
ALTER TABLE ahtees.category_master_extension ADD INDEX IDX_category_master_extension_3 (system_lang_code_id );

CREATE TABLE content_type_file_extensions 
(
	id integer (10) NOT NULL AUTO_INCREMENT , 
	content_type_id integer (10) NOT NULL, 
	file_extension varchar (10) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

ALTER TABLE ahtees.content_type_file_extensions ADD INDEX IDX_content_type_file_extensions_2 (content_type_id );

CREATE TABLE content_type_master 
(
	id integer (2) NOT NULL AUTO_INCREMENT , 
	description varchar (50) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE country_master 
(
	id integer (10) NOT NULL AUTO_INCREMENT , 
	name varchar (50) NOT NULL, 
	altitude varchar (10), 
	latitude varchar (10), 
	timezone_id varchar (50), 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

ALTER TABLE ahtees.country_master ADD INDEX IDX_country_master_2 (timezone_id );

CREATE TABLE customer_award 
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	customer_id char (32) NOT NULL, 
	award_id integer (4) NOT NULL, 
	movie_id integer (11), 
	received_date datetime, 
	received_occassion varchar (150), 
	given_by varchar (100), 
	money_received float (10,2), 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

ALTER TABLE ahtees.customer_award ADD INDEX IDX_customer_award_2 (customer_id,award_id );
ALTER TABLE ahtees.customer_award ADD INDEX IDX_customer_award_3 (customer_id,award_id );
ALTER TABLE ahtees.customer_award ADD COLUMN (received_year varchar(4), received_month varchar(3), received_day varchar(3));

CREATE TABLE customer_digital_content 
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	customer_id integer (11) NOT NULL, 
	content_type_id integer (2) NOT NULL, 
	content_path varchar (1000) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE customer_language 
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	customer_id char (32) NOT NULL, 
	lang_id integer (4) NOT NULL, 
	fluency_level integer (1), 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

ALTER TABLE ahtees.customer_language ADD INDEX IDX_customer_language_2 (customer_id,lang_id );
ALTER TABLE ahtees.customer_language ADD INDEX IDX_customer_language_3 (customer_id,lang_id );

CREATE TABLE customer_master 
(
	customer_id integer (11) NOT NULL AUTO_INCREMENT , 
	user_id varchar (30), 
	password varchar (30), 
	first_name varchar (100), 
	last_name varchar (100), 
	middle_name varchar (100), 
	star_name varchar (100), 
	star_title varchar (50), 
	date_of_birth datetime, 
	birth_city varchar (100), 
	birth_state integer (11), 
	birth_country integer (11), 
	mother_tongue integer (4), 
	address_1 varchar (100), 
	address_2 varchar (100), 
	city varchar (100), 
	state integer (11), 
	zip varchar (50), 
	country integer (11), 
	status_id integer (1), 
	total_worth integer (11), 
	education_degree integer (11), 
	self_promo_text varchar (500), 
	school_info varchar (500), 
	college_info varchar (500), 
	status integer (11) DEFAULT 1, 
	primary_industry_id integer(4),
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	struggler integer(1),
	PRIMARY KEY (customer_id)
) ;
ALTER TABLE ahtees.customer_master ADD INDEX IDX_customer_master_2 (user_id );
ALTER TABLE ahtees.customer_master ADD COLUMN (gender_id integer(1), primary_skill_id integer(4)); 
ALTER TABLE ahtees.customer_master ADD COLUMN (alternate_name varchar(50));


CREATE TABLE gender_master 
(
	id 		integer(1) NOT NULL,
	description 	varchar (10) NOT NULL, 
	entered_date 	datetime, 
	entered_by 	varchar (64), 
	updated_by 	varchar (64), 
	updated_date 	datetime
) ;

insert into gender_master (id, description) values (1, 'Male');
insert into gender_master (id, description) values (2, 'Female');

CREATE TABLE customer_rating_master 
(
	id integer (1) NOT NULL DEFAULT 0, 
	description varchar (10) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime
) ;

CREATE TABLE customer_special_interest 
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	customer_id integer (11) NOT NULL, 
	lang_id integer (11), 
	interest varchar (500) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

ALTER TABLE ahtees.customer_special_interest ADD INDEX IDX_customer_special_interest_2 (customer_id );

CREATE TABLE customer_sports_interest 
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	customer_id char (32) NOT NULL, 
	sports_id integer (4) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

ALTER TABLE ahtees.customer_sports_interest ADD INDEX IDX_customer_sports_interest_2 (customer_id,sports_id );

CREATE TABLE customer_status_master 
(
	id integer (1) NOT NULL AUTO_INCREMENT , 
	description varchar (30) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE customer_talent 
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	customer_id char (32) NOT NULL, 
	talent_id integer (4) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;


ALTER TABLE ahtees.customer_talent ADD INDEX IDX_customer_talent_2 (customer_id,talent_id );

CREATE TABLE education_degree_master 
(
	id integer (10) NOT NULL AUTO_INCREMENT , 
	name varchar (100) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;


CREATE TABLE format_master 
(
	id integer (4) NOT NULL AUTO_INCREMENT , 
	description varchar (30) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;


CREATE TABLE language_master 
(
	id integer (4) NOT NULL AUTO_INCREMENT , 
	description varchar (30) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE location_text_content 
(
	id integer (10) NOT NULL AUTO_INCREMENT , 
	location_id integer (10) NOT NULL, 
	system_lang_code_id integer (11), 
	text_content varchar (2000) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE location_digital_content 
(
	id integer (10) NOT NULL AUTO_INCREMENT , 
	location_id integer (10) NOT NULL, 
	content_type_id integer (10) NOT NULL, 
	content_path varchar (1000) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

ALTER TABLE ahtees.location_digital_content ADD INDEX IDX_location_digital_content_2 (location_id,content_type_id );

CREATE TABLE location_master 
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	name varchar (150) NOT NULL, 
	description varchar (500) NOT NULL, 
	type_id integer (11), 
	country_id integer (11), 
	state_id integer (11), 
	url varchar (1000), 
	text varchar (1000), 
	contact_number varchar (50), 
	email_address varchar (255), 
	theme_id integer (11), 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;


ALTER TABLE ahtees.location_master ADD INDEX IDX_location_master_2 (type_id,country_id,state_id,theme_id );

CREATE TABLE location_type_master 
(
	id integer (10) NOT NULL AUTO_INCREMENT , 
	name varchar (150) NOT NULL, 
	description varchar (500) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;


CREATE TABLE movie_award 
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	movie_id integer (11) NOT NULL, 
	award_id integer (11) NOT NULL, 
	received_date datetime, 
	received_occassion varchar (150), 
	given_by varchar (100), 
	money_received float (10,2), 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

ALTER TABLE ahtees.movie_award ADD INDEX IDX_movie_award_2 (movie_id,award_id );

CREATE TABLE movie_cast 
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	movie_id integer (11) NOT NULL, 
	customer_id integer (11) NOT NULL, 
	no_of_roles integer (2) DEFAULT 1, 
	role_type_id integer (11) NOT NULL, 
	pronoun varchar (255), 
	name_in_movie varchar (100), 
	highlight varchar (500), 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

alter table movie_cast modify name_in_movie varchar(500);
ALTER TABLE ahtees.movie_cast ADD INDEX IDX_movie_cast_2 (movie_id,customer_id,role_type_id );

CREATE TABLE movie_cast_highlights 
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	movie_id integer (11) NOT NULL, 
	customer_id integer (11) NOT NULL, 
	system_lang_code_id integer (11), 
	highlight varchar (500), 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;


ALTER TABLE ahtees.movie_cast_highlights ADD INDEX IDX_movie_cast_highlights_2 (movie_id,customer_id );

CREATE TABLE movie_cast_punch_dialogs 
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	movie_id integer (11) NOT NULL, 
	customer_id integer (11) NOT NULL, 
	system_lang_code_id integer (11), 
	dialog varchar (500), 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

ALTER TABLE ahtees.movie_cast_punch_dialogs ADD INDEX IDX_movie_cast_punch_dialogs_2 (movie_id,customer_id );

CREATE TABLE movie_cast_rating 
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	movie_id integer (11) NOT NULL, 
	customer_id integer (11) NOT NULL, 
	rating_id integer (4) NOT NULL, 
	user_id varchar (30), 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;


ALTER TABLE ahtees.movie_cast_rating ADD INDEX IDX_movie_cast_rating_2 (movie_id,customer_id,user_id );

CREATE TABLE movie_cast_roles 
(
	id integer (10) NOT NULL AUTO_INCREMENT , 
	movie_id integer (10) NOT NULL, 
	customer_id integer (10) NOT NULL, 
	role_number integer (2) NOT NULL, 
	role_type_id integer (2) NOT NULL, 
	system_lang_code_id integer (2) NOT NULL, 
	pronoun varchar (255), 
	name_in_movie varchar (100), 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;
ALTER TABLE ahtees.movie_cast_roles ADD INDEX IDX_movie_cast_roles_2 (movie_id,customer_id,role_type_id,system_lang_code_id );

CREATE TABLE movie_company_master 
(
	id integer (10) NOT NULL AUTO_INCREMENT , 
	name varchar (30) NOT NULL, 
	address_1 varchar (100), 
	address_2 varchar (100), 
	address_3 varchar (100), 
	city varchar (100), 
	state_id integer (4), 
	country_id integer (4), 
	owner_name varchar (50), 
	contact_number varchar (20), 
	email_address varchar (255), 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;
ALTER TABLE ahtees.movie_company_master ADD INDEX IDX_movie_company_master_2 (state_id,country_id );
ALTER TABLE ahtees.movie_company_master ADD COLUMN (URL varchar(500));
 

CREATE TABLE movie_detail_review 
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	movie_id integer (11) NOT NULL, 
	system_lang_code_id integer (11), 
	review_text varchar (5000), 
	user_id integer (11), 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;


ALTER TABLE ahtees.movie_detail_review ADD INDEX IDX_movie_detail_review_2 (movie_id,user_id );

CREATE TABLE movie_digital_content 
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	movie_id integer (11) NOT NULL, 
	content_type_id integer (2) NOT NULL, 
	content_path varchar (1000) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;


ALTER TABLE ahtees.movie_digital_content ADD INDEX IDX_movie_digital_content_2 (movie_id,content_type_id );

CREATE TABLE movie_location 
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	movie_id integer (11) NOT NULL, 
	location_id integer (11) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

ALTER TABLE ahtees.movie_location ADD INDEX IDX_movie_location_2 (movie_id,location_id );

CREATE TABLE movie_master 
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	name varchar (200), 
	format_id integer (2) NOT NULL, 
	release_date datetime NOT NULL, 
	parent_category_id integer (4) NOT NULL, 
	child_category_id integer (4) NOT NULL, 
	third_category_id integer (4) NOT NULL, 
	lang_id integer (4) NOT NULL, 
	dubbed_from_movie varchar (200), 
	original_lang_id integer (4), 
	rating_id integer (1) NOT NULL, 
	production_cost_id integer (11), 
	aspect_ratio_id integer (11), 
	movie_company_id integer (11), 
	number_of_songs integer (4), 
	active varchar (50) DEFAULT '1', 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

ALTER TABLE ahtees.movie_master ADD INDEX IDX_movie_master_2 (format_id,parent_category_id,child_category_id,third_category_id,lang_id,original_lang_id,rating_id );
ALTER TABLE ahtees.movie_master ADD COLUMN (censor_number varchar(30));
ALTER TABLE ahtees.movie_master ADD COLUMN (censored_date datetime);   
ALTER TABLE ahtees.movie_master ADD COLUMN (length integer(8));
ALTER TABLE ahtees.movie_master ADD COLUMN (title_message varchar(100));
ALTER TABLE ahtees.movie_master ADD COLUMN (run_time varchar(20));
ALTER TABLE ahtees.movie_master ADD COLUMN (no_of_days integer(4));

CREATE TABLE movie_master_extension 
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	movie_id integer (10) NOT NULL, 
	system_lang_code_id integer (10) NOT NULL, 
	description longtext, 
	message longtext, 
	subject_line varchar (100), 
	alternate_title varchar (100), 
	from_book varchar (100), 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;
ALTER TABLE ahtees.movie_master_extension ADD INDEX IDX_movie_master_extension_2 (movie_id,system_lang_code_id );

CREATE TABLE movie_punch_dialog 
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	movie_id integer (11) NOT NULL, 
	system_lang_code_id integer (11), 
	dialog varchar (1000) NOT NULL, 
	user_id varchar (30), 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

ALTER TABLE ahtees.movie_punch_dialog ADD INDEX IDX_movie_punch_dialog_2 (movie_id,user_id );

CREATE TABLE movie_role_type_master 
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	description varchar (128), 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE movie_sequel 
(
	id integer (10) NOT NULL AUTO_INCREMENT , 
	movie_id integer (10) NOT NULL, 
	sequel_number integer (10) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

ALTER TABLE ahtees.movie_sequel ADD INDEX IDX_movie_sequel_2 (movie_id );

CREATE TABLE movie_status_master 
(
	id integer (10) NOT NULL AUTO_INCREMENT , 
	name varchar (50) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE movie_company 
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	movie_id integer (11) NOT NULL, 
	company_id integer (11) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

ALTER TABLE ahtees.movie_company ADD INDEX IDX_movie_company_1 (movie_id,company_id);

CREATE TABLE movie_studio 
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	movie_id integer (11) NOT NULL, 
	studio_id integer (11) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

ALTER TABLE ahtees.movie_studio ADD INDEX IDX_movie_studio_2 (movie_id,studio_id );

CREATE TABLE movie_studio_rating 
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	movie_id integer (11) NOT NULL, 
	studio_id integer (11) NOT NULL, 
	rating_id integer (2), 
	user_id varchar (30), 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

ALTER TABLE ahtees.movie_studio_rating ADD INDEX IDX_movie_studio_rating_2 (movie_id,studio_id,user_id );

CREATE TABLE production_cost_master 
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	cost varchar (50), 
	entered_date datetime, 
	entered_by varchar (50), 
	updated_by varchar (50), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE raaga_master 
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	name varchar (100) NOT NULL, 
	description varchar (500), 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE raaga_master_extension 
(
	id integer (10) NOT NULL AUTO_INCREMENT , 
	raaga_id integer (10) NOT NULL, 
	system_lang_code_id integer (10) NOT NULL, 
	name varchar (100) NOT NULL, 
	description varchar (500),
	PRIMARY KEY (id)
) ;

ALTER TABLE ahtees.raaga_master_extension ADD INDEX IDX_raaga_master_extension_2 (raaga_id,system_lang_code_id );

CREATE TABLE rating_master 
(
	id integer (1) NOT NULL AUTO_INCREMENT , 
	description varchar (10) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE song_master 
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	movie_id integer (11), 
	raaga_id integer (11), 
	type_id integer (11) NOT NULL, 
	number integer (11), 
	link varchar (200), 
	release_date datetime, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

ALTER TABLE ahtees.song_master ADD UNIQUE IDX_song_master_3 (movie_id,number );
ALTER TABLE ahtees.song_master ADD INDEX IDX_song_master_2 (movie_id,raaga_id,type_id );

CREATE TABLE song_master_extension 
(
	id integer (10) NOT NULL AUTO_INCREMENT , 
	song_id integer (10) NOT NULL, 
	system_lang_code_id integer (2) NOT NULL, 
	name varchar (150) NOT NULL, 
	description varchar (500) NOT NULL, 
	lyrics longtext, 
	highlight varchar (500), 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

ALTER TABLE ahtees.song_master_extension ADD INDEX IDX_song_master_extension_2 (song_id,system_lang_code_id );

CREATE TABLE song_rating 
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	song_id integer (11) NOT NULL, 
	rating integer (1) NOT NULL, 
	user_id varchar (30), 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

ALTER TABLE ahtees.song_rating ADD INDEX IDX_song_rating_2 (song_id,user_id );

CREATE TABLE song_review 
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	song_id integer (11) NOT NULL, 
	system_lang_code_id integer (11), 
	review_text varchar (500) NOT NULL, 
	user_id varchar (30), 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

ALTER TABLE ahtees.song_review ADD INDEX IDX_song_review_2 (song_id,system_lang_code_id,user_id );

CREATE TABLE song_lyricist 
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	song_id integer (11) NOT NULL, 
	customer_id varchar (30) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

ALTER TABLE ahtees.song_lyricist ADD INDEX IDX_song_lyricist (song_id,customer_id );

CREATE TABLE song_singer 
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	song_id integer (11) NOT NULL, 
	customer_id varchar (30) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

ALTER TABLE ahtees.song_singer ADD INDEX IDX_song_singer_2 (song_id,customer_id );

CREATE TABLE song_type_master 
(
	id integer (4) NOT NULL AUTO_INCREMENT , 
	name varchar (150) NOT NULL, 
	description varchar (255) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE sports_master 
(
	id integer (4) NOT NULL AUTO_INCREMENT , 
	description varchar (50) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE state_master 
(
	id integer (10) NOT NULL AUTO_INCREMENT , 
	name varchar (50) NOT NULL, 
	country_id integer (10), 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

ALTER TABLE ahtees.state_master ADD INDEX IDX_state_master_2 (country_id );

CREATE TABLE studio_master 
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	name varchar (150) NOT NULL, 
	description varchar (500) NOT NULL, 
	address_line_1 varchar (100), 
	address_line_2 varchar (100), 
	city varchar (100), 
	state integer (11), 
	country integer (11), 
	email_address varchar (100), 
	contact_number_1 varchar (100), 
	contact_number_2 varchar (100), 
	contact_number_3 varchar (100), 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE studio_ratings 
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	rating integer (1) NOT NULL, 
	user_id varchar (30), 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;


ALTER TABLE ahtees.studio_ratings ADD INDEX IDX_studio_ratings_2 (user_id );

CREATE TABLE system_lang_code_master 
(
	id integer (10) NOT NULL AUTO_INCREMENT , 
	name varchar (50) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE movie_industry_master 
(
	id integer (4) NOT NULL AUTO_INCREMENT , 
	description varchar (30) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE talent_master 
(
	id integer (4) NOT NULL AUTO_INCREMENT , 
	description varchar (30) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;


CREATE TABLE test 
(
	test_id integer (10) UNSIGNED  NOT NULL DEFAULT 0, 
	test_desc varchar (35) NOT NULL
);


CREATE TABLE theme_master 
(
	id integer (10) NOT NULL AUTO_INCREMENT , 
	name varchar (50) NOT NULL, 
	system_lang_code_id integer (2) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;


ALTER TABLE ahtees.theme_master ADD INDEX IDX_theme_master_2 (system_lang_code_id );

CREATE TABLE total_worth_master 
(
	id integer (10) NOT NULL AUTO_INCREMENT , 
	description varchar (100) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE text_type_master 
(
	id integer (2) NOT NULL AUTO_INCREMENT , 
	description varchar (50) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE movie_text_content
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	movie_id integer (11) NOT NULL, 
	system_lang_code_id integer (11), 
	content_type_id integer (2) NOT NULL,
	text_content varchar (2000) NOT NULL, 
	user_id varchar (30), 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;
ALTER TABLE ahtees.movie_text_content ADD INDEX IDX_movie_text_content_1 (movie_id,user_id);

CREATE TABLE customer_text_content
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	customer_id integer (11) NOT NULL, 
	system_lang_code_id integer (11), 
	content_type_id integer (2) NOT NULL,
	text_content varchar (2000) NOT NULL, 
	user_id varchar (30), 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;
ALTER TABLE ahtees.customer_text_content ADD INDEX IDX_customer_text_content_1 (customer_id,user_id);

CREATE TABLE dvd_information
(
        id integer (11) NOT NULL AUTO_INCREMENT ,
        movie_id integer (11) NOT NULL,
	dvd_released_date datetime,
	dvd_released_by integer(4),
	dvd_market_price decimal (6,2),
	dvd_noof_discs integer (2),
        user_id varchar (30),
        entered_date datetime,
        entered_by varchar (64),
        updated_by varchar (64),
        updated_date datetime,
        PRIMARY KEY (id)
);

ALTER TABLE ahtees.dvd_information ADD INDEX IDX_dvd_information (movie_id,user_id);

CREATE TABLE dvd_subtitles
(
	dvd_id			integer (11) not null, 
	subtitle_lang_id	integer (4) not null,
        entered_date datetime,
        entered_by varchar (64),
        updated_by varchar (64),
        updated_date datetime
);

CREATE TABLE cd_information
(
        id integer (11) NOT NULL AUTO_INCREMENT ,
        movie_id integer (11) NOT NULL,
	cd_released_date datetime,
	cd_released_by integer(4),
	cd_market_price decimal (6,2),
	cd_noof_discs integer (2),
        user_id varchar (30),
        entered_date datetime,
        entered_by varchar (64),
        updated_by varchar (64),
        updated_date datetime,
        PRIMARY KEY (id)
) ;
ALTER TABLE ahtees.cd_information ADD INDEX IDX_cd_information (movie_id,user_id);

CREATE TABLE customer_degrees 
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	customer_id char (32) NOT NULL, 
	degree_id integer (4) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE relation_master 
(
	id integer (10) NOT NULL AUTO_INCREMENT , 
	description varchar (100) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE customer_relations
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	customer_id char (32) NOT NULL, 
	relation_id integer (4) NOT NULL, 
	relation_name varchar(64) NOT NULL,
	relation_number int(2),
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE favorite_master 
(
	id integer (10) NOT NULL AUTO_INCREMENT , 
	description varchar (100) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE customer_favorites
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	customer_id char (32) NOT NULL, 
	favorite_id integer (4) NOT NULL, 
	what_they_like varchar(100),
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE attributes_master 
(
	id integer (10) NOT NULL AUTO_INCREMENT , 
	description varchar (100) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE customer_attributes
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	customer_id char (32) NOT NULL, 
	attribute_id integer (4) NOT NULL, 
	attribute_value varchar(100),
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
);


CREATE TABLE associations_master 
(
	id integer (4) NOT NULL AUTO_INCREMENT , 
	name varchar (30) NOT NULL, 
	address_1 varchar (100), 
	address_2 varchar (100), 
	address_3 varchar (100), 
	city varchar (100), 
	state_id integer (4), 
	country_id integer (4), 
	contact_number varchar (20), 
	email_address varchar (255), 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE theater_master
(
	id integer (4) NOT NULL AUTO_INCREMENT , 
	name varchar (30) NOT NULL, 
	address_1 varchar (100), 
	address_2 varchar (100), 
	address_3 varchar (100), 
	city varchar (100), 
	state_id integer (4), 
	country_id integer (4), 
	contact_number varchar (20), 
	email_address varchar (255), 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE shooting_house_master 
(
	id integer (4) NOT NULL AUTO_INCREMENT , 
	name varchar (30) NOT NULL, 
	address_1 varchar (100), 
	address_2 varchar (100), 
	address_3 varchar (100), 
	city varchar (100), 
	state_id integer (4), 
	country_id integer (4), 
	contact_number varchar (20), 
	email_address varchar (255), 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE customer_master_extension 
(
	customer_id integer (11) NOT NULL, 
	height varchar (10) , 
	weight varchar (10), 
	physique_id integer(2),
	eye_color_id  integer(2),
	voice_type_id integer(2),
	passport_no varchar(40),
	passport_country_id integer(2),
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (customer_id)
) ;

CREATE TABLE customer_preferences
(
	customer_id		integer(11) NOT NULL, 
	email_comm 		integer(1) not null,
	direct_contact 		integer(1) not null,
	representation_contact 	integer(1) not null,
	make_resume_public 	integer(1) not null
) ;

CREATE TABLE customer_physique
(
	id integer (11) NOT NULL AUTO_INCREMENT, 
	customer_id integer(11) not null,
	physique_id integer(4) not null,
	PRIMARY KEY(id)
) ;

CREATE TABLE customer_physical_constraints
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	customer_id integer(11) not null,
	physical_constraint_id integer(4) not null,
	PRIMARY KEY(id)
) ;

CREATE TABLE customer_musical_instruments
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	customer_id integer(11) not null,
	music_instrument_id integer(4) not null,
	PRIMARY KEY(id)
) ;

CREATE TABLE customer_dance
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	customer_id integer(11) not null,
	dance_type_id integer(4) not null,
	PRIMARY KEY(id)
) ;

CREATE TABLE customer_representation
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	customer_id integer(11) not null,
	representative_id integer(11) not null,
	PRIMARY KEY(id)
) ;

CREATE TABLE customer_gurus
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	customer_id integer(11) not null,
	guru_name varchar(100) not null,
	guru_id integer(11) ,
	PRIMARY KEY(id)
) ;

CREATE TABLE customer_references
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	customer_id integer(11) not null,
	reference_id integer(11) not null,
	invitation_sent_date datetime,
	invitiation_accepted_date datetime,
	reference_comment varchar(500),
	reference_rating varchar(2),
	PRIMARY KEY(id)
) ;

CREATE TABLE customer_recommendations
(
	id 			integer (11) NOT NULL AUTO_INCREMENT , 
	customer_id 		integer(11) not null,
	recommender_id 		integer(11) not null,
	invitation_sent_date 	datetime,
	invitiation_accepted_date datetime,
	recommender_comment varchar(500),
	recommender_rating varchar(2),
	PRIMARY KEY(id)
) ;

CREATE TABLE customer_associations
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	customer_id integer(11) not null,
	association_id integer(4) not null,
	member_since_year varchar(4) not null,
	member_id varchar(100),
	PRIMARY KEY(id)
) ;

CREATE TABLE customer_credits
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	customer_id integer(11) not null,
	credit_type_id integer(4) not null,
	role_type_id integer(4) not null,
	special_comments varchar(500) not null,
	credit_score	integer(4) not null,
	Year varchar(4) not null,
	shot_location varchar(4) not null,
	title varchar(50) not null,
	PRIMARY KEY(id)
) ;

CREATE TABLE physique_master
(
	id integer (4) NOT NULL AUTO_INCREMENT , 
	description varchar (100) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

insert into physique_master (description) values ('Slim');
insert into physique_master (description) values ('Tall');
insert into physique_master (description) values ('Average');
insert into physique_master (description) values ('Sporty');
insert into physique_master (description) values ('Heavy');

CREATE TABLE color_master
(
	id integer (4) NOT NULL AUTO_INCREMENT , 
	description varchar (100) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

insert into color_master (description) values ('Black');
insert into color_master (description) values ('Blue');
insert into color_master (description) values ('Brown');
insert into color_master (description) values ('Red');
insert into color_master (description) values ('Silver White');
insert into color_master (description) values ('White');
insert into color_master (description) values ('Other');

CREATE TABLE hair_type_master
(
	id integer (4) NOT NULL AUTO_INCREMENT , 
	description varchar (100) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

insert into hair_type_master (description) values ('Straight');
insert into hair_type_master (description) values ('Curly');
insert into hair_type_master (description) values ('Bald');
insert into hair_type_master (description) values ('Other');

CREATE TABLE voice_type_master
(
	id integer (4) NOT NULL AUTO_INCREMENT , 
	description varchar (100) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

insert into voice_type_master (description) values ('Alto');
insert into voice_type_master (description) values ('Baritone');
insert into voice_type_master (description) values ('Bass');
insert into voice_type_master (description) values ('Other');

CREATE TABLE physical_constraint_master
(
	id integer (4) NOT NULL AUTO_INCREMENT , 
	description varchar (100) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

insert into physical_constraint_master (description) values ('Little Person');
insert into physical_constraint_master (description) values ('Visually Impaired');
insert into physical_constraint_master (description) values ('Wheelchair');
insert into physical_constraint_master (description) values ('Leg Handicapped');
insert into physical_constraint_master (description) values ('Hand Handicapped');
insert into physical_constraint_master (description) values ('Deaf');
insert into physical_constraint_master (description) values ('Hearing Issues');
insert into physical_constraint_master (description) values ('Other');

CREATE TABLE musical_instruments_master
(
	id integer (4) NOT NULL AUTO_INCREMENT , 
	description varchar (100) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

insert into musical_instruments_master (description) values ('Sitar');
insert into musical_instruments_master (description) values ('Vialin');
insert into musical_instruments_master (description) values ('Veena');
insert into musical_instruments_master (description) values ('Mirudangam');
insert into musical_instruments_master (description) values ('Drums');
insert into musical_instruments_master (description) values ('Flute');
insert into musical_instruments_master (description) values ('Kottu');
insert into musical_instruments_master (description) values ('Nathaswaram');
insert into musical_instruments_master (description) values ('Other');

CREATE TABLE dance_type_master
(
	id integer (4) NOT NULL AUTO_INCREMENT , 
	description varchar (100) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

insert into dance_type_master (description) values ('Ballroom');
insert into dance_type_master (description) values ('Bharatanatyam');
insert into dance_type_master (description) values ('Kuccipidi');
insert into dance_type_master (description) values ('Disco');
insert into dance_type_master (description) values ('Break');
insert into dance_type_master (description) values ('Ballet');
insert into dance_type_master (description) values ('Other');

CREATE TABLE credit_type_master
(
	id integer (4) NOT NULL AUTO_INCREMENT , 
	description varchar (100) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

insert into credit_type_master (description) values ('Film');
insert into credit_type_master (description) values ('Television Show');
insert into credit_type_master (description) values ('Advertisement');
insert into credit_type_master (description) values ('Stage Drama');
insert into credit_type_master (description) values ('Modelling');
insert into credit_type_master (description) values ('Standup Comedy');
insert into credit_type_master (description) values ('Dance Performance');
insert into credit_type_master (description) values ('Mimicry');
insert into credit_type_master (description) values ('Show Host');
insert into credit_type_master (description) values ('Public Speaking');
insert into credit_type_master (description) values ('Music');
insert into credit_type_master (description) values ('Radio Host');
insert into credit_type_master (description) values ('Print Specialist');
insert into credit_type_master (description) values ('Animation');
insert into credit_type_master (description) values ('Music');
insert into credit_type_master (description) values ('Internet Specialist');
insert into credit_type_master (description) values ('Dubbing Specialist');
insert into credit_type_master (description) values ('Video Specialist');
insert into credit_type_master (description) values ('Comunication/PR');
insert into credit_type_master (description) values ('4000eyes Contest');
insert into credit_type_master (description) values ('Other');

CREATE TABLE representation_type_master
(
	id integer (4) NOT NULL AUTO_INCREMENT , 
	description varchar (100) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

insert into credit_type_master (description) values ('Self');
insert into credit_type_master (description) values ('Agent');
insert into credit_type_master (description) values ('Manager');
insert into credit_type_master (description) values ('Lawyer');
insert into credit_type_master (description) values ('Other');

CREATE TABLE customer_job_history 
(
	id integer (4) NOT NULL AUTO_INCREMENT , 
	customer_id integer(11) not null,
	start_month_id integer(2) not null,
	start_year_id varchar(4) not null,	
	end_month_id integer(2) not null,
	end_year_id varchar(4) not null,	
	title varchar(100) not null,
	description varchar(500) not null, 
	keywords varchar(500) not null,
	credit_type_id integer(4) not null,
	PRIMARY KEY(id)
) ;

CREATE TABLE customer_visited_countries
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	customer_id integer(11) not null,
	country_id integer(4) not null,
	visited_year_id integer(2) not null,
	special_notes varchar(100),
	PRIMARY KEY(id)
) ;

CREATE TABLE customer_photos
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	customer_id integer(11) not null,
	photo_link varchar(1000),
	resume_photo integer(1) ,
	PRIMARY KEY(id)
) ;

CREATE TABLE contest_type_master
(
	id integer (4) NOT NULL AUTO_INCREMENT , 
	description varchar (100) NOT NULL, 
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

insert into contest_type_master (description) values ('Ad Film Making');
insert into contest_type_master (description) values ('Three Minutes Movie');
insert into contest_type_master (description) values ('Three Minutes Animation Movie');
insert into contest_type_master (description) values ('7-Jokes');
insert into contest_type_master (description) values ('Mimicry');
insert into contest_type_master (description) values ('Short Story Writing');
insert into contest_type_master (description) values ('Animated Posters');

CREATE TABLE contest_master
(
	id 		integer (11) NOT NULL AUTO_INCREMENT , 
	title 		varchar(100) not null,
	description 	varchar(1000) not null,
	type_id		integer(2) not null,
	category_id 	integer(4) not null,
	theme_id	integer(4) not null,
	created_date	datetime not null,
	created_by	integer(11) not null,
	start_date	datetime not null,
	end_date	datetime not null,
	was_extended	integer(1) not null,
	total_participants integer(10),
	PRIMARY KEY(id)		
) ;

CREATE TABLE contest_prices
(
	id 		integer (11) NOT NULL AUTO_INCREMENT , 
	contest_id	integer(11) not null,
	price_order	integer(4) not null,
	price_money 	double(10,2) not null,
	price_currency 	varchar(10) not null,
	PRIMARY KEY(id)		
) ;

CREATE TABLE contest_participants
(
	id 		integer (11) NOT NULL AUTO_INCREMENT , 
	participant_id	integer(11) not null,
	applied_date	datetime not null,
	approved	integer(1),
	approved_date	datetime,
	approved_reason	varchar(100),
	approved_by	integer(11),
	rejected	integer(1),
	rejected_date	datetime,
	rejected_reason varchar(100),
	rejected_by	integer(11),
	PRIMARY KEY(id)
) ;

CREATE TABLE contest_results
(
	id 			integer (11) NOT NULL AUTO_INCREMENT , 
	winner_id		integer(11) not null,
	price_sent_method	integer(1) not null,
	price_money_given	double(10,2),
	price_money_currency	varchar(10),
	price_sent_to_address1	varchar(100),
	price_sent_to_address2	varchar(100),
	city			varchar(100),
	state_id		integer(2),
	country_id		integer(2),
	zipcode			varchar(15),
	redeemed_date		datetime,
	redeemed_commen		varchar(100),
	tracking_number		varchar(50),
	price_ack_date		datetime,
	price_ack_by		varchar(50),
	PRIMARY KEY(id)
) ;

CREATE TABLE sent_method_master
(
	id 		integer (4) NOT NULL AUTO_INCREMENT , 
	description 	varchar (100) NOT NULL, 
	entered_date 	datetime, 
	entered_by 	varchar (64), 
	updated_by 	varchar (64), 
	updated_date 	datetime,
	PRIMARY KEY (id)
) ;

insert into sent_method_master (description) values ('Post Mail');
insert into sent_method_master (description) values ('DHL');
insert into sent_method_master (description) values ('Blue Dart');

CREATE TABLE contest_text_content
(
	id 		integer (11) NOT NULL AUTO_INCREMENT , 
	contest_id	integer (11) not null,
	customer_id	integer(11) not null,
	text_content	varchar(5000) not null,
	entered_date	datetime not null,
	PRIMARY KEY(id)
) ;

CREATE TABLE contest_digital_content
(
	id integer (11) NOT NULL AUTO_INCREMENT , 
	contest_id	integer (11) not null,
	customer_id 	integer(11) not null,
	digital_link	varchar(2000) not null,
	entered_date	datetime,
	PRIMARY KEY(id)
) ;

CREATE TABLE site_keywords
(
	id 		integer (4) NOT NULL AUTO_INCREMENT , 
	industry_id	integer (4) not null,
	keyword 	varchar (100) NOT NULL, 
	entered_date 	datetime, 
	entered_by 	varchar (64), 
	updated_by 	varchar (64), 
	updated_date 	datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE `user_master`
(
        `id` integer (11) NOT NULL AUTO_INCREMENT ,
        `username` varchar (100),
        `password` varchar (50),
        `level` integer (11) DEFAULT 1,
        `email` varchar (100),
        PRIMARY KEY (`id`)
) ;

CREATE TABLE page_seo_details 
(
	id		integer(10)	not null auto_increment, 
	page_id		integer(11)	not null, 
	page_desc	varchar(255)	not null, 
	meta_keyword	varchar(999), 
	h1_words	varchar(999),
	h2_words	varchar(999),
	title_keyword	varchar(999),
	meta_desc	varchar(999),
	industry_id	integer(4),
	primary key (id)
);

CREATE TABLE actor_rating 
(
	id		integer(11)	not null auto_increment,
	actor_id	integer(11)	not null,
	member_id 	integer(11)	not null,
	rating		decimal(4,2)	not null,
	date_listed	datetime,
	primary key (id)
);

CREATE TABLE movie_rating 
(
	id		integer(11)	not null auto_increment,
	movie_id	integer(11)	not null,
	member_id 	integer(11)	not null,
	rating		decimal(4,2)	not null,
	date_listed	datetime,
	primary key (id)
);

CREATE TABLE messages 
(
	id 		integer(11)	not null auto_increment,
	message		varchar(100), 
	primary key (id)
);

CREATE TABLE actor_review 
(
	id		integer(11)	not null auto_increment,
	customer_id	integer(11)	not null,
	member_id 	integer(11)	not null,
	title		varchar(255), 
	review		varchar(999),
	date_listed	datetime,
	primary key (id)
);

CREATE TABLE movie_review 
(
	id		integer(11)	not null auto_increment,
	movie_id	integer(11)	not null,
	member_id 	integer(11)	not null,
	title		varchar(255), 
	review		varchar(999),
	date_listed	datetime,
	primary key (id)
);

CREATE TABLE actor_vote
(
	id		integer(11)	not null auto_increment,
	customer_id	integer(11)	not null,
	actor_id 	integer(11)	not null,
	vote		integer(4), 
	ip_address	varchar(999),
	primary key (id)
);

CREATE TABLE movie_vote
(
	id		integer(11)	not null auto_increment,
	movie_id	integer(11)	not null,
	user_id 	integer(11)	not null,
	vote		integer(4), 
	ip_address	varchar(999),
	primary key (id)
);

CREATE TABLE favorites 
(
	id		integer(11)	not null auto_increment,
	user_id 	integer(11)	not null,
	why_comments	varchar(999), 
	fav_type	integer(4), 
	actor_movie_id	integer(11),
	primary key (id)
);

CREATE TABLE links_master
(
	id 		integer(11)	not null auto_increment,
	link_info	varchar(999),
	obj_id		integer(4),
	obj_type	integer(4),
	user_id		integer(11),
	primary key(id)
);

CREATE TABLE actor_videos
(
	id 		integer(11)	not null auto_increment,
	actor_id	integer(11),
	videofilename	varchar(999),
	ahtees_userid	integer(11),
	primary key(id)
);

CREATE TABLE movie_videos
(
	id 		integer(11)	not null auto_increment,
	movie_id	integer(11),
	videofilename	varchar(999),
	ahtees_userid	integer(11),
	primary key(id)
);

CREATE TABLE news_master
(
	id		integer(11) not null auto_increment, 
	heading		varchar(255), 
	content		varchar(255), 
	posted_date 	datetime, 
	arrived_date 	datetime, 
	published	integer(1),
	status		integer(1),
	picture_to_take_from varchar(255), 
	published_date  datetime, 
	primary key(id)
);

CREATE TABLE news_movies
(
	id		integer(11)	not null auto_increment,
	news_id		integer(11),
	movie_id	integer(11),
	primary key (id)
);

CREATE TABLE discussions 
(
	discussion_id		integer(11)	not null auto_increment, 
	parent_message_id	integer(4), 
	title			varchar(255),
	user_id			integer(11),  
	message			varchar(999), 
	obj_type		integer(4),
	obj_id			integer(4),
	primary key(discussion_id)
);


CREATE TABLE members 
(
	member_id	integer(11) 	not null auto_increment, 
	userid		varchar(100), 
	password	varchar(255), 
	user_full_name	varchar(255),
	customer_id	integer(11),
	talent_id	integer(11),
	primary key (member_id)
);

CREATE TABLE search_items_ignore
(
	id		integer(11)	not null auto_increment, 
	ignore_word	varchar(255),
	primary key(id)
);

CREATE TABLE actor_images
(
	id		integer(11)	not null auto_increment, 
	actor_id	integer(11), 
        ahtees_userid   integer(11),
        imagefilename	varchar(255),
	datelisted	datetime,
	primary key (id)
);

CREATE TABLE movie_images
(
	id		integer(11)	not null auto_increment, 
	movie_id	integer(11), 
        ahtees_userid   integer(11),
        imagefilename	varchar(255),
	datelisted	datetime,
	primary key (id)
);

CREATE TABLE movie_dailogs
(
	id		integer(11)	not null auto_increment, 
	movie_id	integer(11), 
        ahtees_userid   integer(11),
        dialogs		varchar(255),
	primary key (id)

);

CREATE TABLE playlist_master 
(
	id		integer(11)	not null auto_increment, 
	playlist_name	varchar(100),
	primary key(id)
);

CREATE TABLE user_playlist
(
	id		integer(11)	not null auto_increment, 
	playlist_id	integer(11)	not null, 
	user_id		integer(11)	not null,
	song_id		integer(11)	not null,
	primary key (id)
);

CREATE TABLE my_favorites 
(
	id		integer(11)	not null auto_increment,
	obj_type	integer(4),
	obj_id		integer(4),
	obj_db 		integer(4),
	content_type	integer(4),
	content_type_id	integer(4),
	primary key (id)
);

CREATE TABLE points_allocations  
(
	id			integer(11)	not null auto_increment, 
	description		varchar(255),
	earn_or_spend		integer(1),
	allocated_points	integer(11) not null default 0, 	
	primary key (id)
);

INSERT INTO points_allocations (description, earn_or_spend, allocated_points) values ('Watching Video', 1, 5);
INSERT INTO points_allocations (description, earn_or_spend, allocated_points) values ('Listening to a Song', 1, 3);
INSERT INTO points_allocations (description, earn_or_spend, allocated_points) values ('Test Spending', 0, 3);
INSERT INTO points_allocations (description, earn_or_spend, allocated_points) values ('Add to Favorites', 1, 2);
INSERT INTO points_allocations (description, earn_or_spend, allocated_points) values ('Rating', 1, 3);
INSERT INTO points_allocations (description, earn_or_spend, allocated_points) values ('Test Earning', 1, 3);
INSERT INTO points_allocations (description, earn_or_spend, allocated_points) values ('Submit a Review ', 1, 3);
INSERT INTO points_allocations (description, earn_or_spend, allocated_points) values ('Song Rating', 1, 3);
INSERT INTO points_allocations (description, earn_or_spend, allocated_points) values ('Add Dialog', 1, 3);
INSERT INTO points_allocations (description, earn_or_spend, allocated_points) values ('Upload Video', 1, 5);
INSERT INTO points_allocations (description, earn_or_spend, allocated_points) values ('Upload Picture', 1, 5);


CREATE TABLE member_total_points
(
	id		integer(11)	not null auto_increment, 
	member_id	integer(11)	not null,
	total_earned	integer(11)	not null default 0, 
	total_spent 	integer(11)	not null default 0, 
	balance		integer(11)	not null default 0,
	updateddate	datetime,
	primary key (id)
);

CREATE TABLE member_points_ledger 
(
	id		integer(11)	not null auto_increment, 
	member_id	integer(11)	not null,
	earn_or_spend	integer(1)	not null, 
	points		integer(4)	not null, 
	updateddate	datetime	not null, 
	allocation_id	integer(11)	not null, 
	movie_id	integer(11), 
	actor_id	integer(11),
	primary key (id)
);

CREATE TABLE allowed_allocation_limits 
(
	id		integer(11)	not null auto_increment, 
	allocation_id	integer(1)	not null,
	movie_id	integer(4)	not null,
	allowed_limit	integer(4)	not null,
	primary key (id)
);

CREATE TABLE customer_limits_count 
(
	id		integer(11)	not null auto_increment, 
	limit_id	integer(11)	not null, 
	member_id	integer(11)	not null, 
	current_count	integer(4)	not null default 0,
	primary key (id)
);


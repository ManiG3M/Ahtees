CREATE TABLE tabs_master
(
	id integer (2) NOT NULL AUTO_INCREMENT , 
	name varchar(30) not null,
	status integer (1) NOT NULL,
	lang_id	integer(2) not null,
	industry_id integer(4) not null,
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE home_page_status_master
(
	id integer (2) NOT NULL AUTO_INCREMENT , 
	description varchar(30) not null,
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE tab_columns
(
	id integer (1) NOT NULL AUTO_INCREMENT , 
	tab_id	integer(2) not null,
	name varchar(30) not null,
	height integer(4) not null,
	width integer(4) not null,
	bgcolor varchar(50) not null,
	font 	varchar(50) not null,
	font_size integer(2) not null,
	border_flag integer(1) not null,
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE box_type_master
(
	id integer (2) NOT NULL AUTO_INCREMENT , 
	name varchar(30) not null,
	status integer (1) NOT NULL,
	min_options integer(1) not null,
	max_options integer(1) not null,
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
);


CREATE TABLE boxes_master
(
	id integer (4) NOT NULL AUTO_INCREMENT , 
	tab_id integer (2) not null,
	column_id integer (1) not null,
	box_type_id  integer(2) not null,
	name varchar(30) not null,
	no_title integer (1) not null,
	rolling_title integer(1) not null,
	blinking_title integer(1) not null,
	title_text varchar(50) not null, 
	title_font varchar(50) not null,
	title_font_size integer(4) not null,
	title_image varchar(500), 
	border_flag integer(1), 
	rounded_corners integer(1),
	status integer (1) NOT NULL,
	no_of_options integer (2) default 1,
	box_order integer(2) not null,
	box_start_date datetime not null,
	box_end_date datetime not null,
	box_height integer(4) not null,
	box_width integer(4) not null, 
	box_border_color varchar(255),
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE boxes_options_content
(
	id integer (2) NOT NULL AUTO_INCREMENT , 
	tab_id 			integer(4) not null,
	column_id 		integer(4) not null,
	box_id 			integer(4) not null,
	status 			integer(1) not null,
	display_order		integer (2) NOT NULL, 
	short_text		varchar(500),
	top_text		varchar(500),
	side_text		varchar(500),
	bottom_text		varchar(500),
	outside_text		varchar(50),
	news_heading		varchar(500),
	news_subtitle_text	varchar(100),
	detailed_text 		varchar(3000),
	digital_storage_url	varchar(1000),
	digital_link		varchar(1000),
	digital_height 		integer(4),
	digital_width 		integer(4),
	digital_layover_text	varchar(500),
	digital_display_time	integer(4),
	keywords		varchar(1000),
	start_date 		datetime not null,
	expiry_date 		datetime not null,
	entered_date 		datetime, 
	entered_by 		varchar (64), 
	updated_by 		varchar (64), 
	updated_date 		datetime,
	PRIMARY KEY (id)
) ;

CREATE TABLE key_type_master
(
	id integer (2) NOT NULL AUTO_INCREMENT , 
	description varchar(30) not null,
	entered_date datetime, 
	entered_by varchar (64), 
	updated_by varchar (64), 
	updated_date datetime,
	PRIMARY KEY (id)
);

CREATE TABLE ad_boxes
(
	id integer (2) NOT NULL AUTO_INCREMENT , 
	box_id 		integer(4) not null,
	ket_type_id 	integer(1) not null,
	key_id		integer(11) not null,
	PRIMARY KEY (id)
);


CREATE TABLE  tab_column_types_master
(
	id integer (2) NOT NULL AUTO_INCREMENT , 
	name	varchar(100), 
	PRIMARY KEY (id)
);


CREATE TABLE knowledge_center
(
	id integer (10) NOT NULL AUTO_INCREMENT , 
	question varchar (255) NOT NULL, 
	question_entered_date datetime, 
	question_entered_by varchar (64), 
	answer varchar (500) NOT NULL, 
	answer_entered_date datetime, 
	answer_entered_by varchar (64), 
	PRIMARY KEY (id)
) TYPE=InnoDB CHARACTER SET latin1 COLLATE latin1_swedish_ci;

CREATE TABLE news_indutry_company_proirty
(
	industry_id 	integer(4) not null,
	company_id	integer(4) not null,
	priority	integer(2) not null,
	PRIMARY KEY (industry_id, company_id)
) TYPE=InnoDB CHARACTER SET latin1 COLLATE latin1_swedish_ci;

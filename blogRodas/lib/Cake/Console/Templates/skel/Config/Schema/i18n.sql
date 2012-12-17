CREATE TABLE i18n (
	id int(10) NOT NULL auto_increment,
	locale varchar(6) NOT NULL,
	model varchar(255) NOT NULL,
	foreign_key int(10) NOT NULL,
	field varchar(255) NOT NULL,
	content mediumtext,
	PRIMARY KEY	(id),
	INDEX locale (locale),
	INDEX model (model),
	INDEX row_id (foreign_key),
	INDEX field (field)
);
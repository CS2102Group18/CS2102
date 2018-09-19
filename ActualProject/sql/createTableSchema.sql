CREATE TABLE member (
	username VARCHAR(16) PRIMARY KEY,
	password VARCHAR(16) NOT NULL,
	is_admin INT NOT NULL CHECK(is_admin=0 OR is_admin=1)
);

CREATE TABLE project (
	id NUMERIC(16) PRIMARY KEY CHECK(id >=0),
	title VARCHAR(256) NOT NULL,
	description VARCHAR(2048) DEFAULT '' NOT NULL,
	category VARCHAR(256) NOT NULL CHECK(category='Fashion' OR category='Technology' OR category='Games' OR category='Food' OR category='Music' OR category='Photography' OR category='Handicraft' OR category='Community'),
	start_date DATE NOT NULL DEFAULT CURRENT_DATE,
	duration TIME NOT NULL DEFAULT '00:00:00'
);

CREATE TABLE advertise (
	entrepreneur VARCHAR(16) REFERENCES member(username),
	proj_id NUMERIC(16) REFERENCES project(id),
	amt_needed NUMERIC(15,2) NOT NULL DEFAULT '0.00' CHECK(amt_needed >= 0),
	amt_raised NUMERIC(15,2) NOT NULL DEFAULT '0.00' CHECK(amt_raised<=amt_needed AND amt_raised>=0),
	status INT NOT NULL DEFAULT 0 CHECK(status=0 OR status=1),
	PRIMARY KEY(entrepreneur, proj_id)
);

CREATE TABLE fund (
	investor VARCHAR(16) REFERENCES member(username),
	proj_id NUMERIC(16) REFERENCES project(id),
	amount NUMERIC(15,2) NOT NULL DEFAULT '0.00' CHECK(amount >= 0),
	PRIMARY KEY(investor, proj_id)
);
CREATE TABLE member (
	username VARCHAR(16) PRIMARY KEY,
	password VARCHAR(16) NOT NULL,
	is_admin INT NOT NULL CHECK(is_admin=0 OR is_admin=1)
);

CREATE TABLE project (
	id NUMERIC(16) PRIMARY KEY CHECK(id >=0),
	title VARCHAR(256) NOT NULL,
	description VARCHAR(2048) DEFAULT '',
	category VARCHAR(256) CHECK(category='Business' OR category='IT' ),
	start_date DATE DEFAULT CURRENT_DATE NOT NULL,
	duration TIME DEFAULT '00:00:00' NOT NULL
);

CREATE TABLE advertise (
	entrepreneur VARCHAR(16) REFERENCES member(username) ON DELETE CASCADE,
	proj_id NUMERIC(16) REFERENCES project(id) CHECK(proj_id >=0),
	amount NUMERIC(15,2) DEFAULT '0.00' NOT NULL CHECK(amount >= 0),
	PRIMARY KEY(entrepreneur, proj_id)
);

CREATE TABLE fund (
	investor VARCHAR(16) REFERENCES member(username) ON DELETE CASCADE,
	proj_id NUMERIC(16) REFERENCES project(id) CHECK(proj_id >=0),
	amount NUMERIC(15,2) DEFAULT '0.00' NOT NULL CHECK(amount >= 0),
	status INT NOT NULL CHECK(status=0 OR status=1)
);
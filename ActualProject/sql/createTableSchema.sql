CREATE TABLE member (
	username VARCHAR(16) PRIMARY KEY,
	password VARCHAR(16) NOT NULL,
	is_admin INT NOT NULL DEFAULT 0 CHECK(is_admin=0 OR is_admin=1)
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
	entrepreneur VARCHAR(16) REFERENCES member(username) ON DELETE CASCADE,
	proj_id NUMERIC(16) REFERENCES project(id) ON DELETE CASCADE,
	amt_needed NUMERIC(15,2) NOT NULL DEFAULT '0.00' CHECK(amt_needed >= 0),
	amt_raised NUMERIC(15,2) NOT NULL DEFAULT '0.00' CHECK(amt_raised<=amt_needed AND amt_raised>=0),
	status INT NOT NULL DEFAULT 0 CHECK(status=0 OR status=1),
	PRIMARY KEY(entrepreneur)
);

CREATE TABLE invest (
	investor VARCHAR(16) REFERENCES member(username) ON DELETE CASCADE,
	proj_id NUMERIC(16) REFERENCES project(id) ON DELETE CASCADE,
	amount NUMERIC(15,2) NOT NULL DEFAULT '0.00' CHECK(amount >= 0),
	PRIMARY KEY(investor, proj_id)
);


-------------------------------Trigger when inserting into TABLE Invest----------------------------------------------
CREATE OR REPLACE FUNCTION update_amt_raised_when_insert_invest()
RETURNS TRIGGER AS $$
DECLARE 
    amtNeeded NUMERIC(15,2);
    currentAmtRaised NUMERIC(15,2);
    resultingAmtRaised NUMERIC(15,2);
BEGIN
    amtNeeded = (SELECT amt_needed FROM advertise WHERE proj_id = NEW.proj_id);
    currentAmtRaised = (SELECT amt_raised FROM advertise WHERE proj_id = NEW.proj_id);
    IF currentAmtRaised + NEW.amount <= amtNeeded THEN
        UPDATE advertise SET amt_raised=NEW.amount + amt_raised WHERE NEW.proj_id = proj_id;
        RETURN NEW;
    ELSE
        RAISE 'Your investment has exceeded the amount needed. PLease reduce.';
        RETURN NULL;
    END IF;
END; $$ LANGUAGE PLPGSQL;

CREATE TRIGGER trigger_update_amt_raised_when_insert_invest
BEFORE INSERT ON invest 
FOR EACH ROW
EXECUTE PROCEDURE update_amt_raised_when_insert_invest();
---------------------------------------------------------------------------------------------------------------------

-------------------------------Trigger when updating amount in TABLE Invest----------------------------------------------
CREATE OR REPLACE FUNCTION update_amt_raised_when_update_invest()
RETURNS TRIGGER AS $$
DECLARE 
    amtNeeded NUMERIC(15,2);
    currentAmtRaised NUMERIC(15,2);
    resultingAmtRaised NUMERIC(15,2);
BEGIN
    amtNeeded = (SELECT amt_needed FROM advertise WHERE proj_id = NEW.proj_id);
    currentAmtRaised = (SELECT amt_raised FROM advertise WHERE proj_id = NEW.proj_id);
    resultingAmtRaised = currentAmtRaised - OLD.amount + NEW.amount;
    IF (resultingAmtRaised > amtNeeded) THEN
        RAISE 'Your investment exceed the amount needed. Please reduce.';
        RETURN NULL;
    ELSE
        UPDATE advertise SET amt_raised=(amt_raised-OLD.amount+NEW.amount) WHERE NEW.proj_id = proj_id;
        RETURN NEW;
    END IF;
END; $$ LANGUAGE PLPGSQL;

CREATE TRIGGER trigger_update_amt_raised_when_update_invest
BEFORE UPDATE ON invest 
FOR EACH ROW
EXECUTE PROCEDURE update_amt_raised_when_update_invest();
--------------------------------------------------------------------------------------------------------------------

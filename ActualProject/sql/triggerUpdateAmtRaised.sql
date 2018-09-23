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

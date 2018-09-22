CREATE OR REPLACE FUNCTION update_amt_raised_when_insert()
RETURNS TRIGGER AS $$
BEGIN
IF (SELECT amt_raised FROM advertise WHERE NEW.proj_id = proj_id) + NEW.amount <= (SELECT amt_needed FROM advertise WHERE NEW.proj_id = proj_id) THEN
    UPDATE advertise SET amt_raised=NEW.amount + amt_raised WHERE NEW.proj_id = proj_id;
    RETURN NEW;
ELSE
    RAISE 'Your investment has exceeded the amount needed. PLease reduce.';
    RETURN NULL;
END IF;
END; $$ LANGUAGE PLPGSQL;

CREATE TRIGGER trigger_for_insert
BEFORE INSERT ON invest 
FOR EACH ROW
EXECUTE PROCEDURE update_amt_raised_when_insert();



/*CREATE OR REPLACE FUNCTION for_update()
RETURNS TRIGGER AS $$
BEGIN
UPDATE advertise SET status=1 WHERE OLD.amt_needed = NEW.amt_raised + OLD.amt_raised;
RETURN NULL;
END; $$ LANGUAGE PLPGSQL;

CREATE TRIGGER trigger_for_update
BEFORE UPDATE
on advertise
FOR EACH ROW
WHEN (OLD.amt_needed = NEW.amt_raised + OLD.amt_raised)
EXECUTE PROCEDURE for_update();
*/
CREATE OR REPLACE FUNCTION for_update()
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

CREATE OR REPLACE FUNCTION for_insert()
RETURNS TRIGGER AS $$
BEGIN
UPDATE advertise SET status=1 WHERE entrepreneur=NEW.entrepreneur AND proj_id=NEW.proj_id;
RETURN NEW;
END; $$ LANGUAGE PLPGSQL;

CREATE TRIGGER trigger_for_insert
AFTER INSERT
on advertise 
FOR EACH ROW
WHEN (NEW.amt_needed = NEW.amt_raised)
EXECUTE PROCEDURE for_insert();
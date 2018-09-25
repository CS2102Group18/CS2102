<?php
	// Connect to the database. Please change the password in the following line accordingly
    $db = pg_connect("host=localhost port=5432 dbname=cs2102 user=postgres password=group18@CS2102");

	// Delete all tables from database - a clean start
	$clear_database = file_get_contents('../sql/dropTable.sql', true);
	$database_cleaning_result = pg_query($db, $clear_database);

	// Create table in database
	$table_schema = file_get_contents('../sql/createTableSchema.sql', true);
	$table_creation_result = pg_query($db, $table_schema);

    // Insert members
    pg_query($db, "INSERT INTO member(username, password, email, biography, status) VALUES('admin', 'admin', 'admin@cs2102.com', 'This is an admin acount', 0)");
    pg_query($db, "INSERT INTO member(username, password, email, biography) VALUES('user', 'pass', 'user@cs2102.com', 'This is a user account')");
    pg_query($db, "INSERT INTO member(username, password) VALUES('Naruto', '12r42345f')");
    pg_query($db, "INSERT INTO member(username, password) VALUES('Sasuke', 'wg453g25')");
    pg_query($db, "INSERT INTO member(username, password) VALUES('Sakura', 'qwe342b')");
    pg_query($db, "INSERT INTO member(username, password) VALUES('Ino', 'u45b3456h')");
    pg_query($db, "INSERT INTO member(username, password) VALUES('Shikamaru', 'g3423g45')");
    pg_query($db, "INSERT INTO member(username, password, email) VALUES('Jiraya', '4v57i6bc5g', 'jirayathesage@konoha.com')");
    pg_query($db, "INSERT INTO member(username, password, biography) VALUES('Tsunade', 'q3v6e33', 'Gambling is my forte!')");
    pg_query($db, "INSERT INTO member(username, password, email, biography) VALUES('Kakashi', '3v4645u75j', 'kakashi@konoha.com', 'I was the 6th Hokage of the Hidden Leaf Village. I can summon dogs.')");


    // Insert projects
    pg_query($db, "INSERT INTO project(title, description, category) VALUES('Chasing a girl named Sakura', 'A quest that Naruto sets out for', 'Community')");
    pg_query($db, "INSERT INTO project(title, description, category) VALUES('A Rogue Ninja', 'Sasuke finding his own identity', 'Games')");
    pg_query($db, "INSERT INTO project(title, description, category) VALUES('The Fourth Ninja War', 'The final showdown featuring Naruto', 'Games')");
    pg_query($db, "INSERT INTO project(title, description, category) VALUES('Bakery Shop', 'Own by Ino', 'Food')");
    pg_query($db, "INSERT INTO project(title, description, category) VALUES('A new gambling casino to be opened in the Hidden Leaf Vilalge', 'Fund me! The winning rate are super high. I can guarantee you that the casino will shower you with all the luck you need. The more you play, the higher chance of winning. go big or go home! Thank you for your support, see you there!', 'Games')");

    // Insert advertisement
    pg_query($db, "INSERT INTO advertise (entrepreneur, proj_id, amt_needed) VALUES ('Naruto', 1, 200)");
    pg_query($db, "INSERT INTO advertise (entrepreneur, proj_id, amt_needed) VALUES ('Sasuke', 2, 100)");
    pg_query($db, "INSERT INTO advertise (entrepreneur, proj_id, amt_needed) VALUES ('Naruto', 3, 500)");
    pg_query($db, "INSERT INTO advertise (entrepreneur, proj_id, amt_needed) VALUES ('Ino', 4, 75)");
    pg_query($db, "INSERT INTO advertise (entrepreneur, proj_id, amt_needed) VALUES ('Tsunade', 5, 1000000)");

    // Insert investments
    pg_query($db, "INSERT INTO invest (investor, proj_id, amount) VALUES ('Ino', 1, 100)");
    pg_query($db, "INSERT INTO invest (investor, proj_id, amount) VALUES ('Shikamaru', 1, 50)");
    pg_query($db, "INSERT INTO invest (investor, proj_id, amount) VALUES ('Sakura', 2, 90)");
	echo yay;
?>

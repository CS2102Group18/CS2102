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
  pg_query($db, "INSERT INTO member(username, password, email, biography, is_admin) VALUES('admin', 'admin', 'admin@cs2102.com', 'This is an admin acount', 1)");
  pg_query($db, "INSERT INTO member(username, password, email, biography) VALUES('user', 'pass', 'user@cs2102.com', 'This is a user account')");
  pg_query($db, "INSERT INTO member(username, password) VALUES('Naruto', '12r42345f')");
  pg_query($db, "INSERT INTO member(username, password) VALUES('Sasuke', 'wg453g25')"); //Just an entrepreneur
  pg_query($db, "INSERT INTO member(username, password) VALUES('Sakura', 'qwe342b')");
  pg_query($db, "INSERT INTO member(username, password) VALUES('Ino', 'u45b3456h')");
  pg_query($db, "INSERT INTO member(username, password) VALUES('Shikamaru', 'g3423g45')");  //Just an Investor
  pg_query($db, "INSERT INTO member(username, password, email) VALUES('Jiraya', '4v57i6bc5g', 'jirayathesage@konoha.com')");  // Neither entrepreneur nor investor
  pg_query($db, "INSERT INTO member(username, password, biography) VALUES('Tsunade', 'q3v6e33', 'Gambling is my forte!')");
  pg_query($db, "INSERT INTO member(username, password, email, biography) VALUES('Kakashi', '3v4645u75j', 'kakashi@konoha.com', 'I was the 6th Hokage of the Hidden Leaf Village. I can summon dogs.')");
  pg_query($db, "INSERT INTO member(username, password, email, biography) VALUES('Iruka', 'mo9w3ttwo', 'iruka@konohaacademy.com', 'I who served primarily as an instructor at the Academy until being promoted to Headmaster years later. I am both big-hearted, and soft-hearted. This is most often seen through my teaching methods, often giving a watchful eye over my students as they progress. This however, does not mean that I is a pushover, as I can be stern when the situation calls for it most  often seen when I shouts at my students in order to get them to obey me.')");
  pg_query($db, "INSERT INTO member(username, password, email, biography) VALUES('Itachi', 'jpmoilvwc5i', 'itachi@akatsuki.com', 'I was a prodigy of the Uchiha clan and also served as an Anbu Captain. I later became an international criminal after murdering my entire clan, sparing only my younger brother, Sasuke. I afterwards joined the international criminal organisation known as Akatsuki')");
  pg_query($db, "INSERT INTO member(username, password, email, biography) VALUES('Hinata', 'hnvow44238c', 'hinata@konohagakure.com', 'I am a kunoichi and the former heiress of the Hyūga clan. Because of my meek disposition, my father doubted that I was suited for the responsibilities of leading the clan, much less life as a ninja, leading him to disinherit me. Nonetheless, Hinata persevered and from observation of Naruto Uzumaki especially, I found both an example to follow to be more assertive, and a person to love. ')");
  pg_query($db, "INSERT INTO member(username, password, email, biography) VALUES('Kiba', 'vbaery53', 'kiba@konohateam8.com', 'I am a member of the Inuzuka clan and a member of Team Kurenai. Despite my headstrong, and at times egotistic attitude, Kiba is loyal to my comrades and will do anything to protect them with my trusted canine companion, Akamaru, by my side.')");

  // Insert projects
  pg_query($db, "INSERT INTO project(title, description, category) VALUES('Chasing a girl named Sakura', 'A quest that Naruto sets out for', 'Community')");
  pg_query($db, "INSERT INTO project(title, description, category) VALUES('A Rogue Ninja', 'Sasuke finding his own identity', 'Games')");
  pg_query($db, "INSERT INTO project(title, description, category) VALUES('The Fourth Ninja War', 'The final showdown featuring Naruto', 'Games')");
  pg_query($db, "INSERT INTO project(title, description, category) VALUES('Bakery Shop', 'Own by Ino', 'Food')");
  pg_query($db, "INSERT INTO project(title, description, category) VALUES('A new gambling casino to be opened in the Hidden Leaf Vilalge', 'Fund me! The winning rate are super high. I can guarantee you that the casino will shower you with all the luck you need. The more you play, the higher chance of winning. go big or go home! Thank you for your support, see you there!', 'Games')");
  pg_query($db, "INSERT INTO project(title, description, category, start_date) VALUES('Bikochu Search Mission', 'Help Naruto find a bikochu, so that he can use it to locate Sasuke by scent.', 'Food', '2009-02-18')");
  pg_query($db, "INSERT INTO project(title, description, category, duration) VALUES('Itachi Pursuit Mission', 'This is a mission to locate Sasuke or Itachi. May have contact with Kabuto Yakushi and the Akatsuki.', 'Fashion', '18:30:55')");
  pg_query($db, "INSERT INTO project(title, description, category, start_date, duration) VALUES('Land of Tea Escort Mission', 'To protext Idate Morino as he runs a race. May encounter Team oboro and Aoi Rokusho. Returns to Konoha after the race', 'Music', '1998-09-03', '00:15:20')");

  // Insert advertisement
  pg_query($db, "INSERT INTO advertise (entrepreneur, proj_id, amt_needed) VALUES ('Naruto', 1, 200)");
  pg_query($db, "INSERT INTO advertise (entrepreneur, proj_id, amt_needed) VALUES ('Sasuke', 2, 100)");
  pg_query($db, "INSERT INTO advertise (entrepreneur, proj_id, amt_needed) VALUES ('Naruto', 3, 500)");
  pg_query($db, "INSERT INTO advertise (entrepreneur, proj_id, amt_needed) VALUES ('Ino', 4, 75)");
  pg_query($db, "INSERT INTO advertise (entrepreneur, proj_id, amt_needed) VALUES ('Tsunade', 5, 1000000)");
  pg_query($db, "INSERT INTO advertise (entrepreneur, proj_id, amt_needed) VALUES ('Hinata', 6, 600)");
  pg_query($db, "INSERT INTO advertise (entrepreneur, proj_id, amt_needed) VALUES ('Hinata', 7, 1000)");
  pg_query($db, "INSERT INTO advertise (entrepreneur, proj_id, amt_needed) VALUES ('Sakura', 8, 222)");

  // Insert investments
  pg_query($db, "INSERT INTO invest (investor, proj_id, amount) VALUES ('Ino', 1, 100)");
  pg_query($db, "INSERT INTO invest (investor, proj_id, amount) VALUES ('Shikamaru', 1, 50)");
  pg_query($db, "INSERT INTO invest (investor, proj_id, amount) VALUES ('Sakura', 2, 90)");
  pg_query($db, "INSERT INTO invest (investor, proj_id, amount) VALUES ('Naruto', 6, 400)");
  pg_query($db, "INSERT INTO invest (investor, proj_id, amount) VALUES ('Kiba', 6, 200)");  //Make Project 7 fully funded
  pg_query($db, "INSERT INTO invest (investor, proj_id, amount) VALUES ('Kiba', 7, 500)");

  // Display Tables
  include 'UnitTest/displayTable.php';
  displayTableMember($db);
  echo "<br><br>";
  displayTableProject($db);
  echo "<br><br>";
  displayTableAdvertise($db);
  echo "<br><br>";
  displayTableInvest($db);
  echo "<br><br>";
?>

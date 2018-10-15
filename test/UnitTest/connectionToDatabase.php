<?php
    function getDB() {
        // Connect to the database.
        $db = pg_connect("host=localhost port=5432 dbname=cs2102 user=postgres password=group18@CS2102");
        
        // Delete all tables from database - a clean start
        $clear_database = file_get_contents('../../sql/dropTable.sql', true);
        $database_cleaning_result = pg_query($db, $clear_database);
        
        // Create table in database
        $table_schema = file_get_contents('../../sql/createTableSchema.sql', true);
        $table_creation_result = pg_query($db, $table_schema);
        
        return $db;
    }
?>

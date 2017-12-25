<?php
    $db = pg_connect('host=dbpg.cs.ui.ac.id port=5432 dbname=f104 user=f104 password=jeig7G');
    $set_search_path = 'set search_path to SIANGBANG';

    if (!$db) {
        echo "Error : unable to open database \n";
        die();
    }
    $set_scheme = pg_query($db, $set_search_path);
?>
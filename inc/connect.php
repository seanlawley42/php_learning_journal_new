<?php

//Create a PDO connection to the SQLite (database.db) file within the inc folder.

try{
    $db = new PDO('sqlite:'.__DIR__.'/journal.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo 'Sorry, friend. You are unable to connect to the database.';
    echo $e->getMessage();
    exit;
}
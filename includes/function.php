<?php

function connectToDB(){
    $database = new PDO (
    "mysql:host=devkinsta_db;dbname=assignment",
    "root",
    "LrJHyxBK8VE6Afq8");

    return $database;
}

?>
<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "test";

    global $connect;

    try {
        $connect = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    } catch (PDOException $e) {
        die($e);
    }
<?php
    $host = "127.0.0.1";
    $user = "root";
    $password = "";
    $db = "core-forge";

    global $connect;

    try {
        $connect = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    } catch (PDOException $e) {
        die($e);
    }
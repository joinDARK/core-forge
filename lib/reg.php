<?php
    function regUser($login, $password, $email) {
        require('./connect/connect.php');
        
        $login = htmlspecialchars($login);
        $password = htmlspecialchars($password);
        $email = htmlspecialchars($email);
        $password = md5($password."top_secret");
        $query = "INSERT INTO users (login, password, email) VALUES ('$login', '$password', '$email')";

        $result = $connect->exec($query);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
?> 
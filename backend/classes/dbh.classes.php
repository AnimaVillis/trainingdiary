<?php

class Dbh
{
    protected function connect()
    {
        try {
            $username = "projektbaza";
            $password = "ViJbqNT0cFFHAkSoN8tm";
            $dbh = new PDO('mysql:host=89.117.56.9:3306;dbname=projekt', $username, $password);
            return $dbh;
        } catch (PDOException $e) {
            echo "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
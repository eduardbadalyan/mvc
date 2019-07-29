<?php


class Model
{
    public static function connnectDB ()
    {
        $mysqli = new mysqli("localhost", "root", "root", "myBase");
        $mysqli->query ("SET NAMES 'utf8'");
        return $mysqli;
    }
}


?>
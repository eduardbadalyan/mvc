<?php


class Model
{
    public static function connnectDB ()
    {
        $mysqli = new mysqli("localhost", "root", "root", "mvcBase");
        $mysqli->query ("SET NAMES 'utf8'");
        return $mysqli;
    }
}


?>
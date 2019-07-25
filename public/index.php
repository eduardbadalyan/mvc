<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../app/Controllers/MainController.php";

function view($path,$params)
{
    extract($params);

    include __DIR__ . "/../app/Views/" . $path . ".php";
}

(new MainConntroller)->getMainPage();
?>
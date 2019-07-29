<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../app/Controllers/MainController.php";
require "../app/Controllers/LoginController.php";
require "../app/Controllers/AuthController.php";

function view($path,$params)
{
    extract($params);

    include __DIR__ . "/../app/Views/" . $path . ".php";
}
if ($_SERVER["REQUEST_URI"] == "/login") {
    (new LoginConntroller)->getLoginPage();
}else if ($_SERVER["REQUEST_URI"] == "/login/auth") {
    (new AuthConntroller)->auth();
}else{
    session_start();
    if ($_SESSION['user_id']) {
        (new MainConntroller)->getMainPage($_SESSION['user_id']);
    }else{
        (new MainConntroller)->getMainPage(NULL);
    }
}
?>
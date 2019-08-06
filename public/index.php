<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



require __DIR__ . "/../app/Models/User.php";
require __DIR__ . "/../app/Models/Post.php";
require __DIR__ . "/../app/Models/Like.php";



require "../app/Controllers/UserController.php";
require "../app/Controllers/PostController.php";
require "../app/Controllers/LikeController.php";




function view($path,$params)
{
    extract($params);

    include __DIR__ . "/../app/Views/" . $path . ".php";
}



session_start();

if($_SESSION != null){

    if ($_SERVER["REQUEST_URI"] == "/exit") {
        (new UserConntroller)->exit();
    }

    else if ($_SERVER["REQUEST_URI"] == "/avatar/change") {
        (new UserConntroller)->getChangeAvatarPage($_SESSION["user_id"]);
    }

    else if ($_SERVER["REQUEST_URI"] == "/avatar/change/check") {
        (new UserConntroller)->changeAvatar($_SESSION["user_id"]);
    }

    else if ($_SERVER["REQUEST_URI"] == "/password/change") {
        (new UserConntroller)->getChangePasswordPage();
    }

    else if ($_SERVER["REQUEST_URI"] == "/password/change/check") {
        (new UserConntroller)->changePassword($_SESSION["user_id"]);
    }

    else if ($_SERVER["REQUEST_URI"] == "/parameters/change") {
        (new UserConntroller)->getChangeParametersPage($_SESSION["user_id"]);
    }

    else if ($_SERVER["REQUEST_URI"] == "/parameters/change/check") {
        (new UserConntroller)->changeParameters($_SESSION["user_id"]);
    }

    else if ($_SERVER["REQUEST_URI"] == "/post/add") {
        (new PostConntroller)->getAddPostPage($_SESSION["user_id"]);
    }

    else if ($_SERVER["REQUEST_URI"] == "/post/add/add"){   
        (new PostConntroller)->addPost();
    }

    else if ($_SERVER["REQUEST_URI"] == "/post/edit") {   
        (new PostConntroller)->getEditPostPage($_SESSION["user_id"]);
    }

    else if ($_SERVER["REQUEST_URI"] == "/post/edit/edit") {   
        (new PostConntroller)->editPost();
    }

    else if ($_SERVER["REQUEST_URI"] == "/post/delete"){
        (new PostConntroller)->deletePost();
    }

    else if ($_SERVER["REQUEST_URI"] == "/post/like"){
        (new LikeConntroller)->like();
    }

    else if ($_SERVER["REQUEST_URI"] == "/post/dislike"){
        (new LikeConntroller)->dislike();
    }

    else{
        (new PostConntroller)->getMainPage($_SESSION["user_id"]);
    }

}
else { 
    if ($_SERVER["REQUEST_URI"] == "/login") {
        (new UserConntroller)->getLoginPage();
    }

    else if ($_SERVER["REQUEST_URI"] == "/login/auth") {
        (new UserConntroller)->auth();
    }

    else if ($_SERVER["REQUEST_URI"] == "/register") {
        (new UserConntroller)->getRegisterPage();
    }

    else if ($_SERVER["REQUEST_URI"] == "/register/check") {
        (new UserConntroller)->check();
    }

    else{
        (new PostConntroller)->getMainPage(NULL);
    }
}
?>
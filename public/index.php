<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



require __DIR__ . "/../app/Models/User.php";
require __DIR__ . "/../app/Models/Post.php";
require __DIR__ . "/../app/Models/Like.php";



require "../app/Controllers/UsersController.php";
require "../app/Controllers/PostsController.php";
require "../app/Controllers/LikesController.php";




function view($path,$params = [])
{
    extract($params);

    include __DIR__ . "/../app/Views/" . $path . ".php";
}



session_start();

if($_SESSION != null){

    if ($_SERVER["REQUEST_URI"] == "/exit") {
        (new UsersController)->exit();
    }

    else if ($_SERVER["REQUEST_URI"] == "/avatar/change") {
        (new UsersController)->getChangeAvatarPage($_SESSION["user_id"]);
    }

    else if ($_SERVER["REQUEST_URI"] == "/avatar/change/check") {
        (new UsersController)->changeAvatar($_SESSION["user_id"]);
    }

    else if ($_SERVER["REQUEST_URI"] == "/password/change") {
        (new UsersController)->getChangePasswordPage();
    }

    else if ($_SERVER["REQUEST_URI"] == "/password/change/check") {
        (new UsersController)->changePassword($_SESSION["user_id"]);
    }

    else if ($_SERVER["REQUEST_URI"] == "/parameters/change") {
        (new UsersController)->getChangeParametersPage($_SESSION["user_id"]);
    }

    else if ($_SERVER["REQUEST_URI"] == "/parameters/change/check") {
        (new UsersController)->changeParameters($_SESSION["user_id"]);
    }

    else if ($_SERVER["REQUEST_URI"] == "/post/add") {
        (new PostsController)->getAddPostPage($_SESSION["user_id"]);
    }

    else if ($_SERVER["REQUEST_URI"] == "/post/add/add"){   
        (new PostsController)->addPost();
    }

    else if ($_SERVER["REQUEST_URI"] == "/post/edit") {   
        (new PostsController)->getEditPostPage($_SESSION["user_id"]);
    }

    else if ($_SERVER["REQUEST_URI"] == "/post/edit/edit") {   
        (new PostsController)->editPost();
    }

    else if ($_SERVER["REQUEST_URI"] == "/post/delete"){
        (new PostsController)->deletePost();
    }

    else if ($_SERVER["REQUEST_URI"] == "/post/like"){
        (new LikesController)->like();
    }

    else if ($_SERVER["REQUEST_URI"] == "/post/dislike"){
        (new LikesController)->dislike();
    }

    else{
        (new PostsController)->getMainPage($_SESSION["user_id"]);
    }

}
else { 
    if ($_SERVER["REQUEST_URI"] == "/login") {
        (new UsersController)->getLoginPage();
    }

    else if ($_SERVER["REQUEST_URI"] == "/login/auth") {
        (new UsersController)->auth();
    }

    else if ($_SERVER["REQUEST_URI"] == "/register") {
        (new UsersController)->getRegisterPage();
    }

    else if ($_SERVER["REQUEST_URI"] == "/register/check") {
        (new UsersController)->check();
    }

    else{
        (new PostsController)->getMainPage(NULL);
    }
}
?>
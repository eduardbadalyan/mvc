<?php

require __DIR__ . "/../Models/Post.php";

/**
 * TestsController
 */
class MainConntroller
{
    public function getMainPage($user_id)
    {
        $select_posts = Post::select();
        if(is_null($user_id)){
            view('main/main',['select_posts' => $select_posts]);
        }else {
            view('main/mainLogedin',['select_posts' => $select_posts]);
        }
    }
}
?>

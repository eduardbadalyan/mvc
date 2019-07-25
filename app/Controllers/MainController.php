<?php

require __DIR__ . "/../Models/Post.php";

/**
 * TestsController
 */
class MainConntroller
{
    public function getMainPage()
    {
        $select_posts = Post::select();
        
        view('main/main',['select_posts' => $select_posts]);
    }
}
?>

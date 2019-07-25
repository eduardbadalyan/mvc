<?php

require __DIR__ . "/../Models/UseDB.php";

/**
 * TestsController
 */
class MainConntroller
{
    public function getMainPage()
    {
        $select_posts = UseDB::selectPosts();
        
        view('main/main',['select_posts' => $select_posts]);
    }
}
?>

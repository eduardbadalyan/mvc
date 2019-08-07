<?php

/**
 * TestsController
 */
class PostsController
{
    public function getMainPage($user_id)
    {
        $select_posts = Post::select();
        if(is_null($user_id)){
            view('main/main',['select_posts' => $select_posts]);
        }else {
            $user_id = filter_var(trim($user_id),FILTER_SANITIZE_NUMBER_INT);
            $user = User::select_user($user_id);
            view('main/mainLogedin',['select_posts' => $select_posts , 'user' => $user]);
        }
    }



    public function getAddPostPage($user_id)
    {
        $user = User::select_user($user_id);
        view('post/add',['user' => $user]);
    }


    
    public function addPost()
    {
        session_start();
        $user_id = $_SESSION["user_id"];
        $result = Post::add($user_id);
    
        echo $result;
    }

    public function getEditPostPage($user_id)
    {
        $user = User::select_user($user_id);
        $post_id = intval(array_keys($_POST,"Edit post")[0]);
        if ($post_id == null) {
            header ("Location: /");
        }
        $post = Post::select_post($post_id);
        view('post/edit',['user' => $user, 'post' => $post]);
    }



    public function editPost()
    {
        $result = Post::edit();
    
        echo $result;
    }



    public function deletePost()
    {
        $result = Post::delete();
    
        echo $result;
    }
}
?>
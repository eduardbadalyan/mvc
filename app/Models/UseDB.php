<?php

/**
 * Test
 */
class UseDB
{

    public static function connnect ()
    {
        $mysqli = new mysqli("localhost", "root", "root", "myBase");
        $mysqli->query ("SET NAMES 'utf8'");
        return $mysqli;
    }

    public static function selectPosts ()
    {
        $mysqli = UseDB::connnect ();
        $select_posts = $mysqli->query ("SELECT `posts`.*,`users`.name FROM `posts` INNER JOIN `users` ON `posts`.user_id=`users`.id ORDER BY `posts`.id DESC");
        return $select_posts;
    }
}
?>

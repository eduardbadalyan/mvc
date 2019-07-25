<?php
require __DIR__ . "/Model.php";
/**
 * Test
 */
class Post extends Model
{
    public static function select ()
    {
        $mysqli = Model::connnectDB ();
        $select_posts = $mysqli->query ("SELECT `posts`.*,`users`.name FROM `posts` INNER JOIN `users` ON `posts`.user_id=`users`.id ORDER BY `posts`.id DESC");
        return $select_posts;
    }
}
?>

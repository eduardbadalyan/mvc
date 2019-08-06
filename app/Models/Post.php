<?php
require_once __DIR__ . "/Model.php";
/**
 * Test
 */
class Post extends Model
{
    public static function select ()
    {
        $mysqli = Model::connnectDB ();
        $select_posts = $mysqli->query ("SELECT p.*,`users`.name FROM (SELECT x.*,y.count_dislikes FROM 
                                                                    (SELECT a.*,b.count_likes FROM 
                                                                        (SELECT `posts`.* FROM `posts`) a 
                                                                    LEFT JOIN 
                                                                    (SELECT `posts`.*,COUNT(`likes`.user_id) count_likes FROM `posts` 
                                                                        INNER JOIN `likes` ON `posts`.id=`likes`.post_id WHERE `likes`.result = 1 
                                                                            GROUP BY `likes`.post_id) b 
                                                                    ON a.id=b.id) x
                                                                LEFT JOIN 
                                                                (SELECT `posts`.*,COUNT(`likes`.user_id) count_dislikes FROM `posts` 
                                                                    INNER JOIN `likes` ON `posts`.id=`likes`.post_id 
                                                                        WHERE `likes`.result = 0 
                                                                            GROUP BY `likes`.post_id) y 
                                                                    ON x.id=y.id) p
                                     INNER JOIN `users` ON users.id=p.user_id ORDER BY p.id DESC;");
        return $select_posts;
    }



    public static function select_post ($post_id)
    {
        $mysqli = Model::connnectDB ();
        $post = $mysqli->query ("SELECT `posts`.* FROM `posts` WHERE `posts`.id='".$post_id."'")->fetch_assoc();
        return $post;
    }



    public static function add ($user_id)
    {
        if (is_null($_POST["title"])) {
            header ("Location: /");
        }

        $title = $_POST["title"];
        $description = $_POST["description"];

        $mysqli = Model::connnectDB ();

        if ($title == "" || $description == "")
        {
            return 'fail';
        }
        else 
        {

            $title = addcslashes($title, "'");
            $description = addcslashes($description, "'");

            $mysqli->query("INSERT INTO `posts` VALUES (NULL,'".$title."','".$description."','".$user_id."')");

            return 'success';
        }
    }   


    public static function edit ()
    {
        if (is_null($_POST["title"])) {
            header ("Location: /");
        }

        $title = $_POST["title"];
        $description = $_POST["description"];
        $id = $_POST["post_id"];

        $mysqli = Model::connnectDB ();

        if ($title == "" || $description == "")
        {
            return 'fail';
        }
        else 
        {

            $title = addcslashes($title, "'");
            $description = addcslashes($description, "'");

            $mysqli->query ("UPDATE `posts` SET `title` = '".$title."' WHERE `posts`.`id` = ".$id.";");
            $mysqli->query ("UPDATE `posts` SET `description` = '".$description."' WHERE `posts`.`id` = ".$id.";");

            return 'success';
        }
    } 

    public static function delete ()
    {
        if (is_null($_POST["id"])) {
            header ("Location: /");
        }

        $id = $_POST["id"];

        $mysqli = Model::connnectDB ();

        $mysqli->query ("DELETE FROM `posts` WHERE `posts`.`id` =".$id.";");
        $mysqli->close ();
        return 'success';
    } 
}
?>

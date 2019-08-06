<?php
require_once __DIR__ . "/Model.php";
/**
 * Test
 */
class Like extends Model
{
    public static function findResult ($user_id,$post_id)
    {
        $mysqli = Model::connnectDB ();
        $like_result = $mysqli->query ("SELECT * FROM `likes` WHERE `likes`.`post_id` = ".$post_id." AND `likes`.`user_id` = ".$user_id.";")->fetch_assoc()["result"];

        return $like_result;
    }

    public static function putLike ()
    {
        if (is_null($_POST["post_id"])) {
            header ("Location: /");
        }

        $post_id = $_POST["post_id"];
        $user_id = $_POST["user_id"];

        $mysqli = Model::connnectDB ();

        $like_result = Like::findResult($user_id,$post_id); 

        if (is_null($like_result) == true)
        {
            $mysqli->query("INSERT INTO `likes` VALUES (NULL,'".$post_id."','".$user_id."',1)");
            return 'add';
        }
        else
        {
            if($like_result == 1){
                $mysqli->query ("DELETE FROM `likes` WHERE `likes`.`post_id` = ".$post_id." AND `likes`.`user_id` = ".$user_id.";");
                return 'subtract';
            }else {
                $mysqli->query ("UPDATE `likes` SET `result` = 1 WHERE `likes`.`post_id` = ".$post_id." AND `likes`.`user_id` = ".$user_id.";");
                return 'change';
            }
        }
    }

    public static function putDislike ()
    {
        if (is_null($_POST["post_id"])) {
            header ("Location: /");
        }

        $post_id = $_POST["post_id"];
        $user_id = $_POST["user_id"];

        $mysqli = Model::connnectDB ();

        $like_result = Like::findResult($user_id,$post_id); 

        if (is_null($like_result) == true)
        {
            $mysqli->query("INSERT INTO `likes` VALUES (NULL,'".$post_id."','".$user_id."',0)");
            return 'add';
        }
        else
        {
            if($like_result == 1){
                $mysqli->query ("UPDATE `likes` SET `result` = 0 WHERE `likes`.`post_id` = ".$post_id." AND `likes`.`user_id` = ".$user_id.";");
                return 'change';
            }else {
                $mysqli->query ("DELETE FROM `likes` WHERE `likes`.`post_id` = ".$post_id." AND `likes`.`user_id` = ".$user_id.";");
            return 'subtract';
            }
        }
    }
}
?>
<?php
//require __DIR__ . "/Model.php";
/**
 * Test
 */
class User extends Model
{
    public static function select ()
    {
        $mysqli = Model::connnectDB ();
        $select_users = $mysqli->query ("SELECT `users`.* FROM `users` ORDER BY `users`.id");
        return $select_users;
    }

    // public static function select ()
    // {
    //     $mysqli = Model::connnectDB ();
    //     $select_users = $mysqli->query ("SELECT `users`.* FROM `users` ORDER BY `users`.id");
    //     return $select_users;
    // }

    public static function auth ()
    {
        if (is_null($_POST["email"])) {
            header ("Location: /");
        }

        $email = $_POST["email"];
        $password = md5($_POST["password"]);

        $mysqli = Model::connnectDB ();

        $user = $mysqli->query ("SELECT `users`.* FROM `users` WHERE `users`.email = '".$email."'")->fetch_assoc();

        if($user == false)
        {
            $user = $mysqli->query ("SELECT `users`.* FROM `users` WHERE `users`.password = '".$password."'")->fetch_assoc();

            if($user)
            {
                return "failEmail";
            }
            else 
            {
                return "failBoth";
            }
        }
        else
        {
            $user = $mysqli->query ("SELECT `users`.* FROM `users` WHERE `users`.email = '".$email."' AND `users`.password = '".$password."'")->fetch_assoc();

            if ($user == false) 
            {
                return "failPassword";
            }
            else
            {
                return $user["id"];
            } 
        }
    }
}
?>
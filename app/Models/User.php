<?php
require_once __DIR__ . "/Model.php";
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

    public static function select_user ($user_id)
    {
        $mysqli = Model::connnectDB ();
        $user = $mysqli->query ("SELECT `users`.* FROM `users` WHERE `users`.id='".$user_id."'")->fetch_assoc();
        return $user;
    }

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



    public static function check ()
    {
        if (is_null($_POST["email"])) {
            header ("Location: /");
        }

        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $age = $_POST["age"];

        $mysqli = Model::connnectDB ();

        if ($name == "" || 
            $email == "" || 
            !preg_match ("/@/", $email) || 
            $password == "" ||
            $age == "")
        {
            return 'fail';
        }
        else 
        {
            $AvailableEmail =  $mysqli->query ("SELECT `users`.* FROM `users` WHERE `users`.email = '".$email."'")->fetch_assoc();

            if ($AvailableEmail != false) 
            {
                return "failEmail";
            }
            else
            {
                $password = md5($password);
                $repeatPassword = md5($_POST["repeatPassword"]);

                if ($password != $repeatPassword)
                {
                    return 'failPassword';
                }
                else 
                {
                    $mysqli->query("INSERT INTO `users` VALUES (NULL,'".$name."','".$age."','".$email."','".$password."','/avatar/avatar.png')");

                    $user = $mysqli->query ("SELECT `users`.* FROM `users` WHERE `users`.email = '".$email."'")->fetch_assoc();

                    return $user["id"];
                }
            }
        }
    }

    public static function changeAvatar($user)
    {
        $mysqli = Model::connnectDB ();
        if ($_FILES["file"]["tmp_name"] == "") {
            header ("Location: /");
        }
        else 
        {
            $file_tmp = $_FILES["file"]["tmp_name"];
            $img = file_get_contents($file_tmp);
            $data = base64_encode($img);
            $data = "data:image/gif;base64,".$data;
            $mysqli->query ("UPDATE `users` SET `avatar` = '".$data."' WHERE `users`.`id` = ".$user["id"].";");
            $mysqli->close ();

            return $data;
        }
    }

    public static function changePassword($user)
    {
        $oldPassword = $_POST["oldPassword"];
        if (is_null($oldPassword)) {
            header ("Location: /");            
        }
        $oldPassword = md5($oldPassword);
        if ($oldPassword == $user["password"]) {
            $password = $_POST["password"];
            if ($password == "") {
                return "failPassword";
            }
            else {
                $password = md5($password);
                $repeatPassword = md5($_POST["repeatPassword"]);
                if ($password != $repeatPassword) {
                    return "failRepeatPassword";
                }
                else {
                    $mysqli = Model::connnectDB ();
                    $mysqli->query ("UPDATE `users` SET `password` = '".$password."' WHERE `users`.`id` = ".$user["id"].";");
                    return "success";
                }
            }
        }
        else {
            return "failOldPassword";
        }
    }

    public static function changeParameters($user)
    {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $age = $_POST["age"];
        if (is_null($name)) {
            header ("Location: /");            
        }
        if ($name == "" || 
            $email == "" || 
            !preg_match ("/@/", $email) ||
            $age == "")
        {
            return 'fail';
        }
        else
        {
            $mysqli = Model::connnectDB ();
            $AvailableEmail =  $mysqli->query ("SELECT `users`.* FROM `users` WHERE `users`.email = '".$email."'")->fetch_assoc();

            if ($AvailableEmail != false) 
            {
                if ($email == $user["email"]) {
                    $mysqli->query ("UPDATE `users` SET `name` = '".$name."' WHERE `users`.`id` = ".$user["id"].";");
                    $mysqli->query ("UPDATE `users` SET `age` = '".$age."' WHERE `users`.`id` = ".$user["id"].";");
                    return "success";
                }else {
                    return "failEmail";
                }
            }
            else
            {
                $mysqli->query ("UPDATE `users` SET `name` = '".$name."' WHERE `users`.`id` = ".$user["id"].";");
                $mysqli->query ("UPDATE `users` SET `email` = '".$email."' WHERE `users`.`id` = ".$user["id"].";");
                $mysqli->query ("UPDATE `users` SET `age` = '".$age."' WHERE `users`.`id` = ".$user["id"].";");
                return "success";
            }
        }
        
    }
}
?>
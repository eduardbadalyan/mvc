<?php

require __DIR__ . "/../Models/User.php";

/**
 * TestsController
 */
class AuthConntroller
{
    public function auth()
    {
        $result = User::auth();

        if (is_numeric($result)) {
            session_start();
            $_SESSION['user_id'] = $result;
        }
 
        echo $result;
    }
}
?>

<?php

/**
 * TestsController
 */
class UserConntroller
{
    public function getLoginPage()
    {       
        view('user/login',[]);
    }



    public function auth()
    {
        $result = User::auth();

        if (is_numeric($result)) {
            session_start();
            $_SESSION['user_id'] = $result;
        }
 
        echo $result;
    }



    public function getRegisterPage()
    {       
        view('user/register',[]);
    }



    public function check()
    {
        $result = User::check();

        if (is_numeric($result)) {
            session_start();
            $_SESSION['user_id'] = $result;
        }
 
        echo $result;
    }



    public function exit()
    {
        session_start();
        session_unset();
        session_destroy();
        header ("Location: /");
    }

    public function getChangeAvatarPage($user_id)
    {
        $user = User::select_user($user_id);
        view('user/avatar/change',['user' => $user]);
    }

    public function changeAvatar($user_id)
    {
        $user = User::select_user($user_id);
        
        $result = User::changeAvatar($user);

        echo $result;
    }

    public function getChangePasswordPage()
    {     
        view('user/password',[]);
    }

    public function changePassword($user_id)
    {
        $user = User::select_user($user_id);
        $result = User::changePassword($user);
 
        echo $result;
    }

    public function getChangeParametersPage($user_id)
    {     
        $user = User::select_user($user_id);
        view('user/parameters',["user" => $user]);
    }

    public function changeParameters($user_id)
    {
        $user = User::select_user($user_id);
        $result = User::changeParameters($user);
 
        echo $result;
    }
}
?>
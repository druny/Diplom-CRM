<?php


class VerificationController
{

    public function actionLogin()
    {
        $login = $_POST['login'];
        $password = $_POST['password'];

        if(!empty($login) && $login != " "
            && !empty($password) && $password != " " )
        {
            $users =  UsersModel::usersVerification($login);
            if(!empty($users)) {
                $check = new AdditionalFunction();
                $chekUsers = $check->checkupUsers($users, $login, $password);
                if ($chekUsers == true) {
                    $_SESSION['login'] = $login;
                    $key = 'category';
                    $category = UsersModel::selectCategory($login);
                    $setCategory = new AdditionalFunction();
                    $_SESSION[$key] = $setCategory->selectKeyValue($key ,$category);
                } else {
                    echo 'Не верный пароль';
                }
            }else {
                echo 'Не верный логин';
            }
        }
        if(isset($_SESSION['login']) && !empty($_SESSION['hash']))
        {
            header('Location: /task/all/');
        }
        $view = new View();
        $view->display('verification/login.php');


    }
    public function actionExit()
    {
        unset($_SESSION);
        session_destroy();
        header('Location: /');
    }
}
<?php


class UserController
{
    public function actionProfile()
    {
        if(isset($_SESSION['login']) && !empty($_SESSION['hash']))
        {
            $user = new UsersModel();
            $user_id = $user->findByColumn
                        ('user_verification' ,'login', $_SESSION['login']);
            $user  = UsersModel::selectUsers($user_id[0]->user_id);
            $view = new View();
            $view->user = $user;
            $view->display($_SESSION['category'] . '/header.php');
            $view->display($_SESSION['category'] . '/user/profile.php');
            $view->display($_SESSION['category'] . '/footer.php');
        }else
        {
            header('Location: /verification/login');
        }
    }
    public function actionAll()
    {
        if(isset($_SESSION['login']) && !empty($_SESSION['hash']))
        {
            if(!empty($_SESSION['category']) && $_SESSION['category'] !== 'user')
            {
                $positions = UsersModel::findAdditional('position');
                $departments = UsersModel::findAdditional('department');
                $users  = UsersModel::selectUsers();

                if(!empty($_GET['position']) || !empty($_GET['department']))
                {
                    $position = $_GET['position'];
                    $department = $_GET['department'];
                    /*$users =  UsersModel::selectUsers('' ,'position_id', $position);*/
                    if(!empty($_GET['position']) && empty($_GET['department'])){
                        $users = UsersModel::selectUsersWhere($position, '');
                    }
                    if(!empty($_GET['department']) && empty($_GET['position'])){
                        $users = UsersModel::selectUsersWhere('', $department);
                    }
                    if(!empty($_GET['department']) && !empty($_GET['position']))
                    {
                        $users = UsersModel::selectUsersWhere($position, $department);
                    }
                }
                /*if(!empty($_GET['department']))
                {
                    $department = $_GET['department'];
                    $users = UsersModel::selectUsers('', 'department_id', $department);
                }*/

                $view = new View();
                $view->positions = $positions;
                $view->departments = $departments;
                $view->users = $users;
                $view->display($_SESSION['category'] . '/header.php');
                $view->display($_SESSION['category'] . '/user/all.php');
                $view->display($_SESSION['category'] . '/footer.php');

            }else
                {
                    echo 'Нет доступа';
                }
        }else
            {
                header('Location: /verification/login');
            }
    }
    public function actionOne()
    {
        if(isset($_SESSION['login']) && !empty($_SESSION['hash']))
        {
            if(!empty($_SESSION['category']) && $_SESSION['category'] != 'user')
            {
                $id = $_GET['id'];
                if(isset($id) && !empty($id)) {
                    $user = UsersModel::selectUsers($id);
                    $view = new View();
                    $view->user = $user;
                    $view->display($_SESSION['category'] . '/header.php');
                    $view->display($_SESSION['category'] . '/user/one.php');
                    $view->display($_SESSION['category'] . '/footer.php');
                }else
                    {
                        header('Location: /users/all');
                    }
            }else
                {
                    echo 'Нет Доступа';
                }

        }else
            {
                echo 'header(\'Location: /verification/login\');';
            }
    }
    public function actionResult()
    {
        if(isset($_SESSION['login']) && !empty($_SESSION['hash']))
        {
            if(!empty($_SESSION['category']) && $_SESSION['category'] == 'editor') {
                $users = UsersModel::OrderByValue('rating');
                $view = new View();
                $view->users = $users;
                $view->display($_SESSION['category'] . '/header.php');
                $view->display($_SESSION['category'] . '/user/result.php');
                $view->display($_SESSION['category'] . '/footer.php');
            }else
                {
                    echo 'Нет Доступа';
                }
        }else
        {
            header('Location: /verification/login');
        }
    }

    public function actionAdd()
    {

        if(isset($_SESSION['login']) && !empty($_SESSION['hash'])) {
            if(!empty($_SESSION['category']) && $_SESSION['category'] == 'admin') {
                $user_category = UsersModel::findAdditional('user_category');
                $position = UsersModel::findAdditional('position');
                $department = UsersModel::findAdditional('department');

                $name = $_POST['name'];
                $s_name = $_POST['s_name'];
                $patronymic = $_POST['patronymic'];
                $email = $_POST['e-mail'];
                $user_category_id = $_POST['user_category_id'];
                $position_id = $_POST['position_id'];
                $department_id = $_POST['department_id'];
                $login = $_POST['login'];
                $password = $_POST['password'];
                $photo = $_FILES['photo']['name'];
                $photo_tmp = $_FILES['photo']['tmp_name'];


                $user = UsersModel::usersVerification($login);
                if (!empty($user)) {
                    echo 'Данный Login уже существует, придумай новый';
                } else {
                    if (!empty($_POST)) {
                        header('Location: /user/add');
                    }

                    $upload_photo = new AdditionalFunction();
                    $upload_photo->uploadFiles($photo, $photo_tmp);

                    $user_add = new UsersModel();
                    $user_add->name = $name;
                    $user_add->s_name = $s_name;
                    $user_add->patronymic = $patronymic;
                    $user_add->photo = $photo;
                    $user_add->email = $email;
                    $user_add->position_id = $position_id;
                    $user_add->department_id = $department_id;
                    $user_add->insert();
                    
                    if (!empty($user_add) && $user_add != NULL) {

                        $hash_pass = new AdditionalFunction();
                        $pass = $hash_pass->hashPassword($password);
                        $user_id = new UsersModel();
                        $userid = $user_id->lastEntry();
                        $verifi = new VerificationModel();
                        $verifi->user_id = $userid['user_id'];
                        $verifi->login = $login;
                        $verifi->password = $pass;
                        $verifi->user_category_id = $user_category_id;
                        $verifi->insert();

                    }
                }
                $view = new View();
                $view->user_category = $user_category;
                $view->position = $position;
                $view->department = $department;
                $view->display($_SESSION['category'] . '/header.php');
                $view->display($_SESSION['category'] . '/user/add.php');
                $view->display($_SESSION['category'] . '/footer.php');
            }else
                {
                    echo 'Нет доступа';
                }
        }else
            {
                header('Location: /verification/login');
            }
    }
    public function actionDelet()
    {
        if(isset($_SESSION['login']) && !empty($_SESSION['hash']))
        {
            if(!empty($_SESSION['category']) && $_SESSION['category'] !== 'user')
            {
                $id = $_GET['id'];
                $delet = new UsersModel();
                $del = $delet->deletById($id);
                $del_verification = new VerificationModel();
                $del_verification->deletById($id);
                if($del == true)
                {
                    header('Location: /users/all');
                }

            }else
            {
                echo 'Нет доступа';
            }

        }else
        {
            header('Location: /verification/login');
        }
    }
    public function actionUpdate()
    {
        if(isset($_SESSION['login']) && !empty($_SESSION['hash']))
        {
            if(!empty($_SESSION['category']) && $_SESSION['category'] !== 'user')
            {
                if (isset($_GET['id']) && !empty($_GET['id'])) {
                    $id = $_GET['id'];
                    $session_login = $_SESSION['login'];

                    if (!empty($_POST)) {
                        header('Location: /user/update?id=' . $_GET['id']);
                    }

                    $select_position = UsersModel::selectConnectTable('position', $session_login);
                    $select_department = UsersModel::selectConnectTable('department', $session_login);

                    $user_category = UsersModel::findExpect
                    ('user_category', 'category', $_SESSION['category']);
                    $position = UsersModel::findExpect
                    ('position', 'position_id', $select_position[0]->position_id);
                    $department = UsersModel::findExpect
                    ('department', 'department_id', $select_department[0]->department_id);
                    $users = UsersModel::selectUsers($id);
                    if(!empty($_POST)) {

                        $name = $_POST['name'];
                        $s_name = $_POST['s_name'];
                        $patronymic = $_POST['patronymic'];
                        $email = $_POST['e-mail'];
                        $user_category_id = $_POST['user_category_id'];
                        $position_id = $_POST['position_id'];
                        $department_id = $_POST['department_id'];
                        $login = $_POST['login'];
                        $password = $_POST['password'];
                        $photo = $_FILES['photo']['name'];
                        $photo_tmp = $_FILES['photo']['tmp_name'];

                        if(!empty($photo))
                        {
                            $upload_photo = new AdditionalFunction();
                            $upload_photo->uploadFiles($photo, $photo_tmp);
                        }
                        $inspect_login = UsersModel::usersVerification($login);

                        if(!empty($password) && isset($password)) {
                            $hash_pass = new AdditionalFunction();
                            $pass = $hash_pass->hashPassword($password);
                        }
                        $verifi = new VerificationModel();
                        if (!empty($inspect_login)) {
                            echo 'Данный Login уже существует, придумай новый';
                        } else {

                            $verifi->login = $login;

                        }


                        $user_update = new UsersModel();
                        $user_update->name = $name;
                        $user_update->s_name = $s_name;
                        $user_update->patronymic = $patronymic;
                        $user_update->email = $email;
                        $user_update->photo = $photo;
                        $user_update->position_id = $position_id;
                        $user_update->department_id = $department_id;
                        $user_update->update('user', $users[0]->user_id);

                        $verifi->user_id = $users[0]->user_id;
                        $verifi->password = $pass;
                        $verifi->user_category_id = $user_category_id;
                        $verifi->update('user_verification', $users[0]->user_id);

                    }


                    $view = new View();
                    $view->select_category = $_SESSION['category'];
                    $view->select_department = $select_department;
                    $view->select_position = $select_position;
                    $view->user_category = $user_category;
                    $view->position = $position;
                    $view->department = $department;
                    $view->users = $users;
                    $view->display($_SESSION['category'] . '/header.php');
                    $view->display($_SESSION['category'] . '/user/update.php');
                    $view->display($_SESSION['category'] . '/footer.php');
                }else
                {
                    echo 'Не выбран ID пользователя';
                }
            }else
            {
                echo 'Нет доступа';
            }
        }else
        {
            header('Location: /verification/login');
        }
    }
}
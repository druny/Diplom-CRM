<?php


class DepartmentController
{
    public function actionOne()
    {
        if(isset($_SESSION['login']) && !empty($_SESSION['hash']))
        {
            if (!empty($_SESSION['category']) && $_SESSION['category'] !== 'user') {
                $id = $_GET['id'];
                $user = new VerificationModel();
                $user_id = $user->findByColumn('user_verification', 'login', $_SESSION['login']);
                $department = new DepartmentModel();
                $department_id = $department->findByColumn('department', 'department_id', $id);
                $users = new VerificationModel();
                $users_id = $users->findByColumn('user', 'department_id', $id );

                if(!empty($department_id))
                {
                    $view = new View();
                    $view->users = $users_id;
                    $view->depart = $department_id;
                    
                    $view->display($_SESSION['category'] . '/header.php');
                    $view->display($_SESSION['category'] . '/depart/one.php');
                    $view->display($_SESSION['category'] . '/footer.php');
                }else{
                    echo 'Отдела с таким ID не существует';
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
    public function actionAll() {
        if(isset($_SESSION['login']) && !empty($_SESSION['hash'])) {
            if (!empty($_SESSION['category']) && $_SESSION['category'] == 'editor')
            {
                $login = $_SESSION['login'];
                $departs = DepartmentModel::findAll();
                if ($departs == NULL) {
                    echo 'Нет записей';
                } else {
                    $view = new View();
                    $view->departs = $departs;
                    $view->display($_SESSION['category'] . '/header.php');
                    $view->display($_SESSION['category'] . '/depart/all.php');
                    $view->display($_SESSION['category'] . '/footer.php');
                }
            }else
                {
                    echo 'Нет доступа';
                }
        } else
            {
                header('Location: /verification/login');
            }
    }
    public function actionAdd()
    {
        if(isset($_SESSION['login']) && !empty($_SESSION['hash'])) {
            if (!empty($_SESSION['category']) && $_SESSION['category'] == 'admin')
            {
                $department_name = $_POST['department_name'];
                $department_text = $_POST['department_text'];
                if(!empty($_POST))
                {
                    header('Location: /department/add');
                }
                if(!empty($department_name) && !empty($department_text))
                {
                    $addTask = new DepartmentModel();
                    $addTask->department_text = $department_text;
                    $addTask->department_name = $department_name;
                    $addTask->insert();
                }else
                {
                    echo 'Введите данные';
                }
                $view = new View();
                $view->display($_SESSION['category'] . '/header.php');
                $view->display('admin/depart/add.php');
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
  /*  public function actionDelet()
    {
        if(isset($_SESSION['login']) && !empty($_SESSION['hash']))
        {
            if (!empty($_SESSION['category']) && $_SESSION['category'] == 'admin')
            {
                
            }else
            {
                echo 'Нет доступа';
            }
        }else
        {
            header('Location: /verification/login');
        }
    }*/
    public function actionMoney()
    {
        if(isset($_SESSION['login']) && !empty($_SESSION['hash']))
        {
            if (!empty($_SESSION['category']) && $_SESSION['category'] == 'editor') 
            {
                $first_date = $_POST['first_date'];
                $second_date = $_POST['second_date'];
                $department_id = $_POST['department_id'];
                $user_id = $_POST['user_id'];
                if ($first_date > $second_date) {
                    echo ' Не верный формат ';
                }
                if (!empty($first_date) && !empty($second_date) && ($first_date <= $second_date)) {

                    if (!empty($department_id) && !empty($user_id)) {
                        echo '<br>' . 'Введите 1 из значений';
                    }
                    if (!empty($department_id)) {
                        $sum = DepartmentModel::getSumMoney($first_date, $second_date, $department_id);
                    }
                    if (!empty($user_id)) {
                        $sum = DepartmentModel::getSumMoney($first_date, $second_date, '', $user_id);
                    }
                } else {
                    echo ' Введите дату ';
                }

                $department = UsersModel::findAdditional('department');
                $users = UsersModel::findAll();

                $view = new View();

                $view->sum = $sum;

                $view->department = $department;
                $view->users = $users;
                $view->display($_SESSION['category'] . '/header.php');
                $view->display($_SESSION['category'] . '/depart/money.php');
                $view->display($_SESSION['category'] . '/footer.php');
            } else
                {
                    echo 'Нет доступа';
                }
        }else
        {
            header('Location: /verification/login');
        }
    }
}
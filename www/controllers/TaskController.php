<?php


class TaskController
{

    public function actionAll()
    {
        if (isset($_SESSION['login']) && !empty($_SESSION['hash'])) {

            $login = $_SESSION['login'];
            $tasks = TaskModel::findAllTask($login, '1');
            if ($tasks == NULL) {
                echo 'Нет записей';
            } else {
                $view = new View();
                $view->tasks = $tasks;
                $view->display($_SESSION['category'] . '/header.php');
                $view->display($_SESSION['category'] . '/task/all.php');
                $view->display($_SESSION['category'] . '/footer.php');
            }
        } else {
            header('Location: /verification/login');
        }
    }

    public function actionArhive()
    {
        if (isset($_SESSION['login']) && !empty($_SESSION['hash']))
        {

            $login = $_SESSION['login'];
            $tasks = TaskModel::findAllTask($login, '2');
            if ($tasks == NULL) {
                echo 'Нет записей';
            } else {
                $view = new View();
                $view->tasks = $tasks;
                $view->display($_SESSION['category'] . '/header.php');
                $view->display($_SESSION['category'] . '/task/arhive.php');
                $view->display($_SESSION['category'] . '/footer.php');
            }
        } else {
            header('Location: /verification/login');
        }
    }

    public function actionOne()
    {
        if (isset($_SESSION['login']) && !empty($_SESSION['hash'])) {
            $id = $_GET['id'];
            $user = new VerificationModel();
            $user_id = $user->findByColumn('user_verification', 'login', $_SESSION['login']);
            $task = new TaskModel();
            $task_id = $task->findByColumn('user_task', 'user_id', $user_id[0]->user_id);

            $fin_user_id = new VerificationModel();
            $fin_user_id->findAll();

            $select_one = new TaskModel();
            $task = $select_one->findOneById($id);

            if ($task == true) {


                $check = new AdditionalFunction();
                $data = $check->checkOfPresence($task_id, $user_id);

               /* if ($data == $id || $_SESSION['category'] !== 'user') { */

                    $user_id = AbstractModel::selectUserId($id);
                    $login_user = UsersModel::UserLoginOnTask($id);
                    $view = new View();
                    $view->task = $task;
                    $view->login_user = $login_user;
                    $view->user_id = $user_id;
                    $view->display($_SESSION['category'] . '/header.php');
                    $view->display($_SESSION['category'] . '/task/one.php');
                    $view->display($_SESSION['category'] . '/footer.php');

                /*} else {
                    echo 'Куда лезешь?';
                }*/


            } else {
                echo 'Такой записи не существует';
            }
        } else {
            header('Location: /verification/login');
        }
    }

    public function actionDelet()
    {
        if (isset($_SESSION['login']) && !empty($_SESSION['hash'])) {
            if (!empty($_SESSION['category']) && $_SESSION['category'] == 'admin') {
                $id = $_GET['id'];
                $delet = new TaskModel();
                $del = $delet->deletById($id);
                if ($del == true) {
                    echo 'Задание успешно удалено';
                }

            } else {
                echo 'Нет доступа';
            }
        } else {
            header('Location: /verification/login');
        }
    }

    public function actionAdd()
    {
        if (isset($_SESSION['login']) && !empty($_SESSION['hash'])) {
            if (!empty($_SESSION['category']) && $_SESSION['category'] == 'admin') {

                $title = $_POST['title'];
                $text = $_POST['text'];
                $time_start = $_POST['time_start'];
                $time_finish = $_POST['time_finish'];
                $deg = $_POST['task_priority_id'];
                $user_id = $_POST['user_id'];
                $task_price = $_POST['task_price'];
                $rating = $_POST['rating_value'];
                $file_name = $_FILES['task_file']['name'];
                $file_tmp_name = $_FILES['task_file']['tmp_name'];
                if (!empty($_POST)) {
                    header('Location: /task/add');
                }

                $degree = TaskModel::findAdditional('task_priority');
                $status = TaskModel::findAdditional('task_status');
                $users = UsersModel::findAll();


                if (!empty($title) && !empty($text)
                    && !empty($time_start) && !empty($time_finish)
                    && !empty($deg) && !empty($rating)
                    && !empty($user_id)
                ) {

                    if (!empty($file_name)) {
                        $files = new AdditionalFunction();
                        $files->uploadFiles($file_name, $file_tmp_name);
                    }

                    $addTask = new TaskModel();
                    $addTask->title = $title;
                    $addTask->text = $text;
                    $addTask->time_start = $time_start;
                    $addTask->time_finish = $time_finish;
                    $addTask->task_priority_id = $deg;
                    $addTask->task_status_id = $status[0]->task_status_id;
                    $addTask->task_price = $task_price;
                    $addTask->rating_value = $rating;
                    $addTask->admin_login = $_SESSION['login'];
                    $addTask->task_file = $file_name;
                    $addTask->insert();

                    if ($addTask != false) {
                        $task_id = new TaskModel();
                        $taskid = $task_id->lastEntry();

                        $table = 'user_task';
                        $user_task = new TaskModel();
                        $user_task->task_id = $taskid['task_id'];
                        $user_task->user_id = $user_id;
                        $user_task->insertByTable($table);

                    }
                } else {
                    echo 'Введите данные';
                }
                $view = new View();
                $view->users = $users;
                $view->degree = $degree;
                $view->display($_SESSION['category'] . '/header.php');
                $view->display('admin/task/add.php');
                $view->display($_SESSION['category'] . '/footer.php');
            } else {
                echo 'Нет доступа';
            }
        } else {
            header('Location: /verification/login');
        }

    }

    public function actionUpdate()
    {
        if (isset($_SESSION['login']) && !empty($_SESSION['hash'])) {
            if (!empty($_SESSION['category']) && $_SESSION['category'] !== 'user'
            ) {

                $id = $_GET['id'];

                $title = $_POST['title'];
                $text = $_POST['text'];
                $time_start = $_POST['time_start'];
                $time_finish = $_POST['time_finish'];
                $deg = $_POST['task_priority_id'];
                $rating = $_POST['rating_value'];
                $file_name = $_FILES['task_file']['name'];
                $file_tmp_name = $_FILES['task_file']['tmp_name'];
                if (!empty($_POST)) {
                    header('Location: /task/update?id=' . $id);
                }

                $degree = TaskModel::findAdditional('task_priority');
                $status = TaskModel::findAdditional('task_status');
                $user_id = AbstractModel::selectUserId($id);


                $task = new TaskModel();
                $task_value = $task->findByColumn
                ('task', 'task_id', $id);


                if (!empty($file_name)) {
                    $files = new AdditionalFunction();
                    $files->uploadFiles($file_name, $file_tmp_name);
                }

                $addTask = new TaskModel();
                $addTask->title = $title;
                $addTask->text = $text;

                if (!empty($time_start) && !empty($time_finish)) {
                    $addTask->time_start = $time_start;
                    $addTask->time_finish = $time_finish;
                }

                $addTask->task_priority_id = $deg;
                $addTask->task_status_id = $status[0]->task_status_id;
                $addTask->rating_value = $rating;
                $addTask->admin_login = $_SESSION['login'];
                $addTask->task_file = $file_name;
                $addTask->update('task', $id);

                if ($addTask != false) {
                    $task_id = new TaskModel();
                    $taskid = $task_id->lastEntry();

                    $table = 'user_task';
                    $user_task = new TaskModel();
                    $user_task->task_id = $taskid['task_id'];
                    $user_task->user_id = $user_id;
                    $user_task->insertByTable($table);

                    $view = new View();
                    $view->degree = $degree;
                    $view->task = $task_value;
                    $view->user = $user_id[0]->user_id;
                    $view->display($_SESSION['category'] . '/header.php');
                    $view->display($_SESSION['category'] . '/task/update.php');
                    $view->display($_SESSION['category'] . '/footer.php');
                }
            } else {
                echo 'Нет доступа';
            }

        } else {
            header('Location: /verification/login');
        }
    }

    public function actionConfirm()
    {
        if (isset($_SESSION['login']) && !empty($_SESSION['hash'])) {
            if (!empty($_SESSION['category']) && $_SESSION['category'] == 'admin') {

                $user_id = $_POST['user_id'];
                $task_id = $_POST['task_id'];
                $rating_value = $_POST['rating'];
                $task_status_id = $_POST['task_status_id'];
                $rating = UsersModel::selectUsers($user_id);
                $new_rait = ($rating[0]->rating) + $rating_value;

                if (!empty($user_id) && !empty($task_id) &&
                    !empty($new_rait) && !empty($task_status_id)
                ) {
                    $user = new  UsersModel();
                    $user->rating = $new_rait;
                    $check_user = $user->update('user', $user_id);

                    $task = new TaskModel();
                    $task->task_status_id = $task_status_id;
                    $check_task = $task->update('task', $task_id);
                    if ($check_user == true && $check_task == true) {
                        header('Location: /task/all ');
                    } else {
                        echo 'Что-то пошло не так';
                    }
                }

            } else {
                echo 'Нет доступа';
            }

        } else {
            header('Location: /verification/login');
        }
    }

    public function actionEverything()
    {
        if (isset($_SESSION['login']) && !empty($_SESSION['hash'])) {
            if (!empty($_SESSION['category']) && $_SESSION['category'] !== 'user') {
                $tasks = TaskModel::findAll();
                $users = UsersModel::findAll();
                if (!empty($_GET['user_id']) && empty($_GET['column'])) {
                    $user_id = $_GET['user_id'];
                    $tasks = UsersModel::findUsersTask($user_id, '');
                }
                if (!empty($_GET['column']) && empty($_GET['user_id'])) {
                    $column = $_GET['column'];
                    /*$tasks = TaskModel::orderByValue($column);*/
                    $tasks = TaskModel::findUsersTask('', $column);
                }
                if (!empty($_GET['column']) && !empty($_GET['user_id'])) {
                    $user_id = $_GET['user_id'];
                    $column = $_GET['column'];
                    $tasks = UsersModel::findUsersTask($user_id, $column);
                }

                $view = new View();
                $view->tasks = $tasks;
                $view->users = $users;
                $view->display($_SESSION['category'] . '/header.php');
                $view->display($_SESSION['category'] . '/task/everything.php');
                $view->display($_SESSION['category'] . '/footer.php');
            } else {
                echo 'Нет доступа';
            }
        } else {
            header('Location: /verification/login');
        }
    }

    public function actionConfirmation()
    {
        if (isset($_SESSION['login']) && !empty($_SESSION['hash'])) {
            if (!empty($_SESSION['category']) && $_SESSION['category'] == 'admin')
            {
                $login = $_SESSION['login'];
                $tasks = TaskModel::findConfirmTask($login, '3');
                if ($tasks == NULL)
                {
                    echo 'Нет записей';
                }else {

                    $view = new View();
                    $view->tasks = $tasks;
                    $view->display($_SESSION['category'] . '/header.php');
                    $view->display($_SESSION['category'] . '/task/confirmation.php');
                    $view->display($_SESSION['category'] . '/footer.php');
                }
            } else {
                echo 'Нет доступа';
            }
        } else {
            header('Location: /verification/login');
        }
    }

    public function actionChecks()
    {
        if (isset($_SESSION['login']) && !empty($_SESSION['hash'])) {

            $login = $_SESSION['login'];
            $tasks = TaskModel::findAllTask($login, '3');
            if ($tasks == NULL)
            {
                echo 'Нет записей';
            }else {
                $view = new View();
                $view->tasks = $tasks;
                $view->display($_SESSION['category'] . '/header.php');
                $view->display($_SESSION['category'] . '/task/checks.php');
                $view->display($_SESSION['category'] . '/footer.php');
            }
            if(isset($_GET['id']))
            {
                $task_status_id = $_POST['task_status_id'];
                $tasks_comment = $_POST['task_comment'];
                $task_ready_file = $_FILES['task_ready_file']['name'];
                $task_ready_file_tmp = $_FILES['task_ready_file']['tmp_name'];
                $id = $_GET['id'];
                if (!empty($task_ready_file)) {
                    $files = new AdditionalFunction();
                    $files->uploadFiles($task_ready_file, $task_ready_file_tmp);
                }
            

                $task_update = new TaskModel();
                $task_update->task_status_id = $task_status_id;
                $task_update->task_comment = $tasks_comment;
                $task_update->task_ready_file = $task_ready_file;
                $task_update->update('task', $id);
            }

        } else {
            header('Location: /verification/login');
        }
    }
}
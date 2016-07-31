<?php


class TaskModel extends AbstractModel
{
    protected static $table = 'task';
    
    public static function findAllTask($login, $status_id)
    {
        $class = get_called_class();
        $db = new DB();
        $db->setClassName($class);
        $sql = 'SELECT 
                user_verification.user_id, user_verification.login,
                user_task.user_id, user_task.task_id,
                task.*
                FROM user_verification 
                INNER JOIN user_task 
                ON user_verification.user_id = user_task.user_id
                INNER JOIN task
                ON user_task.task_id = task.task_id
                WHERE user_verification.login = "' . $login . '"' .
            ' && task.task_status_id = ' . $status_id .  '
            ORDER BY task.task_id DESC';
       
        $res  = $db->query($sql);
        return $res;
    }
    public static function findConfirmTask($login, $status_id)
    {
        $class = get_called_class();
        $db = new DB();
        $db->setClassName($class);
        $sql = 'SELECT 
                user_verification.user_id, user_verification.login,
                user_task.user_id, user_task.task_id, user_verification.login,
                task.*
                FROM user_verification 
                INNER JOIN user_task 
                ON user_verification.user_id = user_task.user_id
                INNER JOIN task
                ON user_task.task_id = task.task_id
                 WHERE task.admin_login = "' . $login . '"' .
                ' &&  task.task_status_id = ' . $status_id .  '
            ORDER BY task.task_id DESC';

        $res  = $db->query($sql);
        return $res;
    }
}
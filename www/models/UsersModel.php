<?php

class UsersModel extends AbstractModel
{
    protected static $table = 'user';


    public function __set($k, $v)
    {
        $this->data[$k] = $v;
    }
    public function __get($k)
    {
        return $this->data[$k];
    }
    public static function selectUsersWhere($position = '', $department = '')
    {
        $class = get_called_class();
        $db = new DB();
        $db->setClassName($class);
        $sql = 'SELECT user.user_id, user.name, user.s_name, 
                user.patronymic, user.photo, user.email, 
                user.rating , position.position_name, department.department_name, 
                user_verification.login FROM  user 
                INNER JOIN position
                ON user.position_id = position.position_id
                INNER JOIN department
                ON user.department_id = department.department_id
                INNER JOIN user_verification
                ON user.user_id = user_verification.user_id 
                ';

        if($position !== '' && $department == '')
        {
            $sqlCondition = $sql . ' WHERE user.position_id '. ' = ' . $position;
            $var = $db->query($sqlCondition);
            return $var;
        }
        if($position == '' && $department !== '')
        {
            $sqlCondition = $sql . ' WHERE user.department_id '. ' = ' . $department;
            $var = $db->query($sqlCondition);
            return $var;
        }
        if($position !== '' && $department !== '')
        {
            $sqlCondition = $sql . ' WHERE user.department_id '. ' = ' . $department .
                        ' &&  user.position_id '. ' = ' . $position;
            $var = $db->query($sqlCondition);

            return $var;
        }
        $var = $db->query($sql);
        return $var;
    }
    
    public static function selectUsers($id = '', $column = '', $value = '')
    {
        $class = get_called_class();
        $db = new DB();
        $db->setClassName($class);
        $sql = 'SELECT user.user_id, user.name, user.s_name, 
                user.patronymic, user.photo, user.email, 
                user.rating , position.position_name, department.department_name, 
                user_verification.login FROM  user 
                INNER JOIN position
                ON user.position_id = position.position_id
                INNER JOIN department
                ON user.department_id = department.department_id
                INNER JOIN user_verification
                ON user.user_id = user_verification.user_id';
        if(isset($column) && !empty($column))
        {
            $sqlCondition = $sql . ' WHERE user.' . $column . ' = ' . $value;
            $var = $db->query($sqlCondition);
            return $var;
        }
        if(isset($id) && !empty($id))
        {
            $sqlCondition = $sql . ' WHERE user.user_id = ' . $id;
            $var = $db->query($sqlCondition);
            return $var;
        }
        $var = $db->query($sql);
        return $var;
    }


    public static function selectCategory($value)
    {
        $class = get_called_class();
        $db = new DB();
        $db->setClassName($class);
        $sql = 'SELECT ' . static::$table . '_verification.user_id, '
            . static::$table .'_verification.login, '
            . static::$table . '_category.* 
                FROM ' . static::$table . '_verification 
                INNER JOIN ' . static::$table . '_category 
                ON ' . static::$table . '_verification.'
            . static::$table . '_category_id =
                ' . static::$table . '_category.'
            . static::$table . '_category_id WHERE '
            . static::$table . '_verification.login ="' . $value . '"';
        $var = $db->queryMas($sql);
        return $var;
    }
    
    public static function selectConnectTable($column, $login)
    {
        $db = new DB();
        $sql = 'SELECT user.' . $column . '_id,' . $column . '.' . $column . '_name, 
                user_verification.login 
                FROM user RIGHT JOIN '. $column . '
                ON user.' . $column . '_id = ' . $column .'.' . $column . '_id
                INNER JOIN user_verification
                ON user.user_id = user_verification.user_id
                WHERE user_verification.login = "' . $login . '"';

        $res = $db->query($sql);
        return $res;
    }
    public static function UserLoginOnTask($id_task)
    {
        $db = new DB();
        $sql = 'SELECT user_verification.login FROM user_verification
                LEFT JOIN user_task
                ON user_verification.user_id = user_task.user_id
                WHERE user_task.task_id = ' . $id_task;

        $res = $db->query($sql);
        return $res;
    }

}
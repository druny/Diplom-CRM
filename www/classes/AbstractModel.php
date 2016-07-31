<?php


class AbstractModel
{
    static protected $table;

    protected $data = [];

    public function __set($k, $v)
    {
        $this->data[$k] = $v;
    }
    public function __get($k)
    {
        return $this->data[$k];
    }
    public  static function usersVerification($login)
    {
        $class = get_called_class();
        $db = new DB();
        $db->setClassName($class);
        $sql = 'SELECT * FROM ' . static::$table . '_verification 
            WHERE login=:login';
        $var = $db->queryMas($sql, [':login' =>  $login]);
        return $var[0];

    }
    public static function findAdditional($table)
    {
        $db = new DB();
        $sql = 'SELECT * FROM ' . $table;
        $res = $db->query($sql);
        return $res;
    }
    public static function findAll()
    {
        $db = new DB();
        $sql = 'SELECT * FROM ' . static::$table;
        $res = $db->query($sql);
        return $res;
    }
    public function findByColumn($table , $column, $value)
    {
        $class = get_called_class();
        $db = new  DB();
        $db->setClassName($class);
        $sql = 'SELECT * FROM ' .$table .
            ' WHERE ' . $column . '=:' . $column;
        $res = $db->query($sql, [':' . $column => $value]);
        return $res;
    }

    public  function findOneById($value)
    {
        $class = get_called_class();
        $db = new DB();
        $db->setClassName($class);
        $sql =  'SELECT * FROM ' . static::$table .
                ' WHERE ' . static::$table . '_id=:'.
                static::$table .'_id';
        
        $res = $db->query($sql, [':' . static::$table . '_id' => $value]);
        return $res;
    }
    public function deletById($value)
    {

        $db = new DB();
        $sql = 'DELETE FROM ' . static::$table .
                ' WHERE ' . static::$table . '_id=:' .
                static::$table . '_id';
        
        $res = $db->query($sql, [':' . static::$table . '_id' => $value]);
        return $res;
    }
    
    public function insert()
    {
        $cols = array_keys($this->data);
        $data = [];
        foreach ($cols as $col)
        {
            $data[':' . $col] = $this->data[$col];
        }
        $class = get_called_class();
        $db = new DB;
        $db->setClassName($class);

        $sql = 'INSERT INTO ' . static::$table .
            ' (' . implode(', ', $cols) . ') VALUES ' .
            ' (' . implode(', ', array_keys($data) ) . ') ';

        $db->execute($sql, $data);
    }
   
    public function insertByTable($table = '')
    {
        
        $cols = array_keys($this->data);
        $data = [];
        foreach ($cols as $col)
        {
            $data[':' . $col] = $this->data[$col];
        }
        $class = get_called_class();
        $db = new DB;
        $db->setClassName($class);

        $sql = 'INSERT INTO ' . $table .
            ' (' . implode(', ', $cols) . ') VALUES ' .
            ' (' . implode(', ', array_keys($data) ) . ') ';

        $db->execute($sql, $data);
    }
    public function lastEntry()
    {
        $class = get_called_class();
        $db = new DB();
        $db->setClassName($class);
        $sql = 'SELECT * FROM ' . static::$table . ' ORDER BY ' . static::$table . '_id DESC LIMIT 1';
        $res = $db->queryMas($sql);
        return $res[0];
    }
    
    public function updateHash($hash, $users)
    {
        $db = new DB();
        $sql = "UPDATE " . static::$table . "_verification 
            SET password=:password WHERE password='" . $users . "'";
        $db->execute($sql, [':password' => $hash]);
    }
    public function update($table, $id)
    {
        $cols = [];
        $data = [];
        foreach ($this->data as $k => $v) {
            if($v !== NULL) {
                $data[':' . $k] = $v;

                if ($k == 'id') {
                    continue;
                }
                $cols[] = $k . '=:' . $k;
            }
        }
        $sql = '
            UPDATE ' . $table . '
            SET ' . implode(', ', $cols) . '
            WHERE ' . $table . '_id = ' . $id;
        $db = new DB();
        
        return $db->execute($sql, $data);
    }
    public static function findExpect($table, $column, $value)
    {
        $db = new DB();
        $sql = 'SELECT * FROM ' . $table .
            ' WHERE ' . $column . ' <> "' . $value . '"';
        $res = $db->query($sql);
        return $res;
    }
    public static  function selectUserId($id)
    {
        $db = new DB();
        $sql = 'SELECT user.user_id FROM user
                INNER JOIN user_task
                ON user_task.user_id = user.user_id
                WHERE user_task.task_id = "' . $id . '"';
        $res = $db->query($sql);
        //var_dump($sql);
        return $res;
    }
    public static function orderByValue($value)
    {
        $db = new DB();
        $sql = 'SELECT * FROM ' . static::$table .  ' ORDER by ' . $value . ' DESC';
        $res = $db->query($sql);
        return $res;
    }
    public static function findUsersTask($id = '', $column = '')
    {
        $db = new DB();
        $sql = 'SELECT task.* FROM task 
              LEFT JOIN user_task ON task.task_id = user_task.task_id ';
        if($id !== '' && $column == '')
        {
            $sqlCondition = $sql . 'WHERE user_task.user_id ='  .  $id;
            $res = $db->query($sqlCondition);
            return $res;
        }
        if($column !== '' && $id == '')
        {
            $sqlCondition = $sql .  ' ORDER by task.' . $column . ' DESC';
            $res = $db->query($sqlCondition);
            return $res;
        }
        if($column !== '' && $id !== '')
        {
            $sqlCondition = $sql . 'WHERE user_task.user_id = '  .  $id
                .  ' ORDER by task.' . $column . ' DESC';
            $res = $db->query($sqlCondition);
            return $res;
        }

        $res = $db->query($sql);
        return $res;
    }
    public static function getSumMoney($first_date, $second_date, $department_id = '', $user_id = '')
    {
        $db = new DB();
        $sql = 'SELECT SUM(task.task_price) FROM task 
            INNER JOIN user_task
            ON task.task_id = user_task.task_id
            INNER JOIN user
            ON user.user_id  = user_task.user_id
            WHERE " '. $first_date .'" <= time_finish 
            &&  "' . $second_date . '" >= time_finish
            && task_status_id = 2 ';

        if($department_id !== '' && $user_id == '')
        {
            $sqlCondition = $sql .  ' && user.department_id = ' .  $department_id;
            $res = $db->queryMas($sqlCondition);
            return $res;
        }
        if($user_id !== '' && $department_id == '')
        {
            $sqlCondition = $sql .  ' && user.user_id = ' .  $user_id;
            $res = $db->queryMas($sqlCondition);
            return $res;
        }
        $res = $db->query($sql);
        return $res;
    }

}
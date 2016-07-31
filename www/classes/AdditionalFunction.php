<?php


class AdditionalFunction
{
    protected $data = [];
    public  function  __set($k, $v)
    {
        $this->data[$k] = $v;
    }

    public  function  __get($k)
    {
        return $this->data[$k];
    }
    public function hashPassword($password)
    {
        $options = [
            'cost' => 11,
            'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
        ];
        $hash = password_hash($password, PASSWORD_BCRYPT, $options);
        return $hash;
    }
    public function checkupUsers($users, $login, $password)
    {

        if (in_array($login, $users) && password_verify($password, $users['password'])) {
                $hash = $this->hashPassword($password);
                $hashUpdate = new UsersModel();
                $hashUpdate->updateHash($hash, $users['password']);
                $_SESSION['hash'] = $hash;
                return true;
        } else {
            return false;
        }
    }
    public function selectKeyValue($key, $value)
    {
        
        foreach ($value as $k)
        {
            return $k[$key];
         }
    }
   public  function uploadFiles($file, $file_tmp)
   {
       $upload_dir = __DIR__ . '\..\template\files\\';
       $new_name = $upload_dir . basename($file);
       if (is_uploaded_file($file_tmp)) {
           $res = move_uploaded_file($file_tmp, $new_name);
       }

   }
    public function checkOfPresence($task_id, $user_id)
    {
        $data = [];
        for ($i = 0; $i <= count($task_id) - 1; $i++)
        {
            $t_id = $task_id[$i];
            $data = $t_id;
            if($user_id[0]->user_id == $t_id->user_id)
            {
                $data = $t_id->task_id;
            }
        }
        return $data;
    }

}
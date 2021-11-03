<?php
session_start();
class Apps_Libs_UserIdentity
{
    public $username;
    public $password;
    
    protected $id;

    public function __construct($username = '',$password='') {
        $this->username = $username;
        $this->password = $password;
    }

    public function encrytPassword()
    {
        return md5($this->password);
    }

    public function login()
    {
        $db=new Apps_Models_Users();
        $query = $db->buildQueryParams([
            'where'=>'username =:username AND password=:password',
            'params'=>[
                ':username'=>trim($this->username),
                ':password'=>$this->encrytPassword()
            ]
            ])->selectOne();
            if ($query) {
                $_SESSION['userId']=$query['id'];
                $_SESSION['username']=$query['username'];
                return true;
            }
            return false;
    }

    public function logout()
    {
        unset($_SESSION['userId']);
        unset($_SESSION['username']);
    }

    public function getSESSION($name)
    {
        if ($name !== null) {
            return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
        }
        return $_SESSION;
    }

    public function isLogin()
    {
        if ($this->getSESSION('userId')) {
            return true;
        }else{
            return false;
        }
    }

    public function getId()
    {
        return $this->getSESSION('userId');
    }
}
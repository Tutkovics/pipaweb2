<?php

class User
{
    private $id;
    private $username;
    private $admin;
    private $oauth_internal_id;
    private $super_admin;
    private $salt;
    private $password_hashed;
    private $last_login;

    public function __construct($id)
    {
        global $mysql;

        $query = $mysql->query("SELECT * FROM users WHERE id='$id'");
        $user_data = $query->fetch_assoc();

        $this->id = $id;
        $this->username = $user_data['username'];
        $this->admin = $user_data['admin'];
        $this->oauth_internal_id = $user_data['oauth_internal_id'];
        $this->super_admin = $user_data['super_admin'];
        $this->salt = $user_data['salt'];
        $this->password_hashed = $user_data['password'];
        $this->last_login = $user_data['last_login'];
    }

    public function checkLogin($password)
    {
        $hashed_password = str_rot13(sha1(md5($password) . $this->salt));
        if ($hashed_password == $this->password_hashed) {
            return true;
        } else {
            return false;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getAdmin()
    {
        return $this->admin;
    }

    public function getSuperAdmin()
    {
        return $this->super_admin;
    }

    public function getUuid()
    {
        return $this->oauth_internal_id;
    }

    public function setLastLogin()
    {
        global $mysql;
        $mysql->query("UPDATE users SET last_login=NOW() WHERE id='$this->id'");
    }
}
<?php

class UserModel extends Database
{
    function __construct()
    {
        parent::__construct();
    }

    public function getUsers()
    {
        return $this->select("SELECT * FROM user");
    }

    public function getUserById($id)
    {
        return $this->select("SELECT * FROM user WHERE id = ?", [$id], 'i');
    }

    public function getUserByUsername($username)
    {
        return $this->select("SELECT * FROM user WHERE username = ?", [$username], 's');
    }

    public function createUser($email, $name)
    {
        $username = $this->emailToUsername($email);
        $password = $this->hashPassword($username);
        $role = "user";
        $status = "inactive";
        $this->action("INSERT INTO user (username, password, email, name, role, status) VALUES (?, ?, ?, ?, ?, ?)", [$username, $password, $email, $name, $role, $status], 'ssssss');

        $this->action("INSERT INTO token (email) VALUES (?)", [$email], 's');
    }

    public function saveUser($username, $password, $email, $name, $avatar, $status)
    {

    }

    private function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    private function emailToUsername($email)
    {
        $parts = explode('@', $email);
        return $parts[0];
    }

    public function saveChangePassword($username, $password){
        $rowsAffected = $this->action("UPDATE user SET password = ? WHERE username = ?", [$this->hashPassword($password), $username], 'ss');
        if($rowsAffected > 0){
            $_SESSION['announce'] = "Đổi mật khẩu thành công";
            return true;
        }
        else{
            $_SESSION['announce'] = "Đổi mật khẩu không thành công";
            return false;
        }
    }
}

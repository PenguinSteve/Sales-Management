<?php
require_once("app/Models/EmailModel.php");
class UserModel extends Database
{
    private EmailModel $emailModel;

    function __construct()
    {
        $this->emailModel = new EmailModel();
        parent::__construct();
    }

    public function getUsers()
    {
        return $this->select("SELECT * FROM user");
    }

    public function getUserById($id)
    {
        return $this->select("SELECT * FROM user WHERE user_id = ?", [$id], 'i');
    }

    public function getUserByUsername($username)
    {
        return $this->select("SELECT * FROM user WHERE username = ?", [$username], 's');
    }

    public function getUserByEmail($email)
    {
        return $this->select("SELECT * FROM user WHERE email = ?", [$email], 's');
    }

    public function getUserByEmailAndToken($email, $token)
    {
        return $this->select("SELECT * FROM token WHERE email = ?, token = ?", [$email, $token], 'ss');
    }

    public function createUser($email, $name)
    {
        $username = $this->emailToUsername($email);
        $password = $this->hashPassword($username);
        $role = "user";
        $status = "inactive";
        $rowsAffected = $this->action("INSERT INTO user (username, password, email, name, role, status) VALUES (?, ?, ?, ?, ?, ?)", [$username, $password, $email, $name, $role, $status], 'ssssss');

        if ($rowsAffected > 0) {
            $this->action("INSERT INTO token (email) VALUES (?)", [$email], 's');
            $this->emailModel->sendEmailOnCreateUser($email);
            return true;
        } else {
            return false;
        }
    }

    public function saveUserInformation($username, $name, $avatar = null, $status = null)
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

    public function saveChangePassword($username, $password)
    {
        if (password_verify($password, $this->getUserByUsername($username)[0]['password'])) {
            $_SESSION['announce'] = "Mật khẩu mới không được trùng với mật khẩu cũ";
            return false;
        }
        $rowsAffected = $this->action("UPDATE user SET password = ? WHERE username = ?", [$this->hashPassword($password), $username], 'ss');
        if ($rowsAffected > 0) {
            $_SESSION['announce'] = "Đổi mật khẩu thành công";
            return true;
        } else {
            $_SESSION['announce'] = "Đổi mật khẩu không thành công";
            return false;
        }
    }
}

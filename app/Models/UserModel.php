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
        return $this->select("SELECT * FROM token WHERE email = ? AND token = ?", [$email, $token], 'ss');
    }

    public function createUser($email, $name)
    {
        if (!empty($this->getUserByEmail($email))) {
            $_SESSION['announce'] = "Email đã tồn tại";
            return false;
        }

        $username = $this->emailToUsername($email);
        $password = $this->hashPassword($username);
        $role = "user";
        $status = "inactive";
        $rowsAffected = $this->action("INSERT INTO user (username, password, email, name, avatar, role, status) VALUES (?, ?, ?, ?, ?, ?, ?)", [$username, $password, $email, $name, "public/images/avatar/default_avatar.png", $role, $status], 'sssssss');

        if ($rowsAffected > 0) {
            $this->action("INSERT INTO token (email) VALUES (?)", [$email], 's');
            $this->emailModel->sendEmailOnCreateUser($email);
            return true;
        } else {
            return false;
        }
    }

    public function updateUserStatus($status, $email)
    {
        $rowsAffected = $this->action(
            "UPDATE user SET status = ? WHERE email = ?",
            [$status, $email],
            'ss'
        );
        return $rowsAffected > 0;
    }

    public function updateUser($id, $name, $targetFile)
    {
        $rowsAffected = $this->action(
            "UPDATE user SET name = ?, avatar = ? WHERE user_id = ?",
            [$name, $targetFile, $id],
            'ssi'
        );

        return $rowsAffected > 0;
    }

    public function updateUserNoAvatar($id, $name)
    {
        $rowsAffected = $this->action(
            "UPDATE user SET name = ? WHERE user_id = ?",
            [$name, $id],
            'si'
        );

        return $rowsAffected > 0;
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

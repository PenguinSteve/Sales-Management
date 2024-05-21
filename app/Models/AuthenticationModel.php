<?php
require_once("./app/Models/UserModel.php");
class AuthenticationModel extends Database
{

    private UserModel $userModel;

    function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
    }

    public function checkLogin($username, $password)
    {
        $user = $this->userModel->getUserByUsername($username)[0];

        if ($username === "admin" && empty($user)) {
            $this->createUserAdmin();
            $user = $this->userModel->getUserByUsername($username)[0];
        }

        if(empty($user)) {
            $_SESSION['announce'] = "Tên đăng nhập hoặc mật khẩu không đúng";
            return false;
        }
        if(!password_verify($password, $user["password"])) {
            $_SESSION['announce'] = "Tên đăng nhập hoặc mật khẩu không đúng";
            return false;
        }
        if($user["status"] === "inactive"){
            $_SESSION['announce'] = "Tài khoản chưa được kích hoạt, hãy đăng nhập bằng đường link được gửi tới email đăng ký";
            return false;
        }
        if($user["status"] === "locked"){
            $_SESSION['announce'] = "Tài khoản đã bị khóa";
            return false;
        }
        if(password_verify($username, $user["password"])){
            $_SESSION["isNeedToChangePassword"] = true;
        }
        $_SESSION['user'] = $user;
        return true;
    }

    public function createUserAdmin()
    {
        $this->action("INSERT INTO user (username, password, email, name, role, status) VALUES (?, ?, ?, ?, ?, ?)", ["admin", password_hash("admin", PASSWORD_DEFAULT), "admin@gmail.com", "Quản lý", "admin", "activated"], 'ssssss');
    }
}

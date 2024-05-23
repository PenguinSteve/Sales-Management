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
        $user = $this->userModel->getUserByUsername($username);

        if ($username === "admin" && empty($user)) {
            $this->createUserAdmin();
            $user = $this->userModel->getUserByUsername($username);
        }

        if(empty($user)){
            $_SESSION['announce'] = "Tên đăng nhập hoặc mật khẩu không đúng";
            return false;
        }
        $user = $user[0];

        if(!password_verify($password, $user["password"])) {
            $_SESSION['announce'] = "Tên đăng nhập hoặc mật khẩu không đúng";
            return false;
        }
        if($user["status"] === "inactive"){
            $_SESSION['announce'] = "Tài khoản chưa được kích hoạt, liên hệ quản trị viên để được hỗ trợ";
            return false;
        }
        if($user["status"] === "locked"){
            $_SESSION['announce'] = "Tài khoản đã bị khóa, liên hệ quản trị viên để được hỗ trợ";
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
        $this->action("INSERT INTO user (username, password, email, name, avatar, role, status) VALUES (?, ?, ?, ?, ?, ?, ?)", ["admin", password_hash("admin", PASSWORD_DEFAULT), "admin@gmail.com", "Quản lý", "public/images/avatar/avatar-s-1.png", "admin", "activated"], 'sssssss');
    }

    public function loginViaEmail($email, $token){
        $userCheck = $this->userModel->getUserByEmailAndToken($email, $token);

        if(empty($userCheck)){
            $_SESSION['announce'] = "Đường link không hợp lệ, liên hệ quản trị viên để được hỗ trợ";
            return false;
        }
        $userCheck = $userCheck[0];
        if($userCheck["expire_on"] < date('Y-m-d H:i:s')){
            $_SESSION['announce'] = "Đường link đã hết hạn, liên hệ quản trị viên để được hỗ trợ";
            return false;
        }

        $rowsAffected = $this->action("UPDATE user SET status = 'activated' WHERE email = ?", [$email], 's');
        if($rowsAffected > 0){
            $_SESSION['user'] = $this->userModel->getUserByEmail($email)[0];
            $_SESSION['announce'] = "Kích hoạt tài khoản thành công";
            $_SESSION['isNeedToChangePassword'] = true;
            return true;
        } else {
            $_SESSION['announce'] = "Kích hoạt tài khoản không thành công, liên hệ quản trị viên để được hỗ trợ";
            return false;
        }
    }
}
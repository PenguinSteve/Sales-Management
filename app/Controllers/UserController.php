<?php
require_once("app/Models/UserModel.php");
class UserController extends Controller
{
    private UserModel $userModel;
    
    public function __construct(){
        $this->userModel = new UserModel();
    }
    public function index()
    {
        $this->render("personal_information", ['title' => "Thông tin cá nhân"]);
    }

    public function changePassword()
    {
        $this->render("change_password", ['title' => "Đổi mật khẩu"]);
    }

    public function changePasswordFirstTime(){
        if($_SESSION['isNeedToChangePassword'] === true){
            $this->render("change_password_first_time", ["title"=> "Đổi mật khẩu lần đầu"]);
        }
        else{
            header("Location:" . _HOST . "home");
        }
    }

    public function saveChangePasswordFirstTime(){
        $username = $_POST['username'];
        $password = $_POST['pass'];
        if($this->userModel->saveChangePassword($username, $password)){
            unset($_SESSION['isNeedToChangePassword']);
            $_SESSION['user'] = $this->userModel->getUserByUsername($username)[0];
            header("Location:" . _HOST . "home");
        }
        else{
            header("Location:" . _HOST . "user/changePasswordFirstTime");
        }
    }
}

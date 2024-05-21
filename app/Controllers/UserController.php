<?php
class UserController extends Controller
{

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

    // public function 
}

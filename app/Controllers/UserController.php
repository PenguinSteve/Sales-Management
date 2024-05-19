<?php
    class UserController extends Controller{
        
        public function index(){
            $this->render("personal-information", ['title' => "Thông tin cá nhân"]);
        }

        public function changePassword(){
            $this->render("change-password", ['title' => "Đổi mật khẩu"]);
        }
    }
?>
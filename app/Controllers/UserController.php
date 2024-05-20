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
}

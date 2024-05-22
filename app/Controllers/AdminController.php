<?php
require_once('./app/Models/UserModel.php');
require_once('./app/Models/EmailModel.php');


class AdminController extends Controller
{
    private UserModel $userModel;
    private EmailModel $emailModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->emailModel = new EmailModel();
    }

    public function index()
    {
        $users = $this->userModel->getUsers();
        $this->render("admin/account_management", ['title' => 'Quản lý tài khoản', 'users' => $users]);
    }

    public function createUser(){
        $email = $_POST['email'];
        $name = $_POST['name'];
        if($this->userModel->createUser($email, $name)){
            $_SESSION['announce'] = "Tạo tài khoản thành công";
        } else {
            $_SESSION['announce'] = "Tạo tài khoản thất bại";
        }
        header('Location: ' . _HOST . 'admin');
    }

    public function resendEmail($email){
        $this->emailModel->resendEmail($email);
        $_SESSION['announce'] = "Gửi email thành công";
        header('Location: ' . _HOST . 'admin');
    }
}

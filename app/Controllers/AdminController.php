<?php
require_once('./app/Models/UserModel.php');

class AdminController extends Controller
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
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
}

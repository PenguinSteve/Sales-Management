<?php
    require_once('./app/Models/UserModel.php');
    
    class AdminController extends Controller{
        private UserModel $userModel;

        public function __construct(){
            $this->userModel = new UserModel();
        }

        public function index(){
            $users = $this->userModel->getUsers();
            $this->render("admin/account_management", ['title' => 'Quản lý tài khoản', 'users'=> $users]);
        }
    }
?>
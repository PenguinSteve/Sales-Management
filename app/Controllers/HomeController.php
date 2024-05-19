<?php
    class HomeController extends Controller{

         
        
        public function __construct()
        {
            
        }

        public function index(){
            $this->render("home", ['title' => 'Trang chủ']);
        }

        public function login(){
            $this->render("login", ['title' => 'Đăng nhập']);
        }

        public function postLogin(){
            if(isset($_POST["username"]) && isset($_POST["password"])){
                $username = $_POST["username"];
                $password = $_POST["password"];
                
                header("Location:". _HOST."home");
            }
        }

        public function logout(){

        }
    }
?>
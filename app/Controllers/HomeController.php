<?php
require_once("./app/Models/UserModel.php");
class HomeController extends Controller
{
    private UserModel $userModel;


    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $this->render("home", ['title' => 'Trang chủ']);
    }

    public function login()
    {
        $this->render("login", ['title' => 'Đăng nhập']);
    }

    public function postLogin()
    {
        if (isset($_POST["username"]) && isset($_POST["password"])) {

            $username = $_POST["username"];
            $password = $_POST["password"];
            $_SESSION['user'] = ['role' => "admin"];

            header("Location:" . _HOST . "home");
        } else {
            $_SESSION['announce'] = "Đăng nhập thất bại";
            header("Location:" . _HOST . "home/login");
        }
    }

    public function logout()
    {
        session_destroy();
        header("Location:" . _HOST . "home/login");
    }
}

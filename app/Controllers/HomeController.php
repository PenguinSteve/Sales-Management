<?php
require_once("./app/Models/AuthenticationModel.php");
class HomeController extends Controller
{
    private AuthenticationModel $authenticationModel;

    public function __construct()
    {
        $this->authenticationModel = new AuthenticationModel();
    }

    public function index()
    {
        $this->render("home", ['title' => 'Trang chủ']);
    }

    public function login()
    {
        $this->render("login", ['title' => 'Đăng nhập']);
    }

    public function checkLogin()
    {
        $username = $_POST["username"];
        $password = $_POST["password"];
        if ($this->authenticationModel->checkLogin($username, $password)) {
            if (isset($_SESSION['isNeedToChangePassword'])) {
                if ($_SESSION['isNeedToChangePassword'] === true) {
                    header("Location:" . _HOST . "user/changePasswordFirstTime");
                    exit;
                }
            } else {
                header("Location:" . _HOST . "home");
                exit;
            }
        } else {
            header("Location:" . _HOST . "home/login");
            exit;
        }
    }

    public function logout()
    {
        unset($_SESSION["user"]);
        session_destroy();
        header("Location:" . _HOST . "home/login");
        exit;
    }

    public function loginViaEmail()
    {
        $email = $_GET["email"];
        $token = $_GET["token"];
        if ($this->authenticationModel->loginViaEmail($email, $token)) {
            if (isset($_SESSION['isNeedToChangePassword'])) {
                if ($_SESSION['isNeedToChangePassword'] === true) {
                    header("Location:" . _HOST . "user/changePasswordFirstTime");
                    exit;
                }
            } else {
                header("Location:" . _HOST . "home");
                exit;
            }
        } else {
            header("Location:" . _HOST . "home/login");
            exit;
        }
    }
}

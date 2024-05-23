<?php
require_once("app/Models/UserModel.php");
class UserController extends Controller
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function index()
    {
        // $id = $_SESSION['user']['user_id'];
        // $user = $this->userModel->getUserById($id);
        $this->render("personal_information", ['title' => "Thông tin cá nhân"]);
    }

    public function changePassword()
    {
        $this->render("change_password", ['title' => "Đổi mật khẩu"]);
    }

    public function changePasswordFirstTime()
    {
        if ($_SESSION['isNeedToChangePassword'] === true) {
            $this->render("change_password_first_time", ["title" => "Đổi mật khẩu lần đầu"]);
        } else {
            header("Location:" . _HOST . "home");
        }
    }

    public function saveChangePasswordFirstTime()
    {
        $username = isset($_SESSION['user']['username']) ? $_SESSION['user']['username'] : "";
        $password = $_POST['pass'];
        if ($this->userModel->saveChangePassword($username, $password)) {
            unset($_SESSION['isNeedToChangePassword']);
            $_SESSION['user'] = $this->userModel->getUserByUsername($username)[0];
            header("Location:" . _HOST . "home");
        } else {
            header("Location:" . _HOST . "user/changePasswordFirstTime");
        }
    }

    public function saveChangePassword()
    {
        $username = $_SESSION['user']['username'];
        $curr_pass = $_POST['curr_pass'];
        $new_pass = $_POST['new_pass'];

        if (password_verify($curr_pass, $_SESSION['user']['password'])) {
            if ($this->userModel->saveChangePassword($username, $new_pass)) {
                $_SESSION['user'] = $this->userModel->getUserByUsername($username)[0];
                header("Location:" . _HOST . "home");
                exit();
            }
        }
        header("Location:" . _HOST . "user/changePassword");
        exit();
    }

    public function updatePersonalAccount($id)
    {
        $name = $_POST['name'];

        $targetFile = "public/product_images/" . basename($_FILES['avatar']['name']);

        if ($_FILES['avatar']['error'] != 4) {
            $row_affected = $this->userModel->updateUser($id, $name, $targetFile);
            move_uploaded_file($_FILES['avatar']['tmp_name'], $targetFile);
        } else {
            $row_affected = $this->userModel->updateUserNoAvatar($id, $name);
        }

        if ($row_affected) {
            $_SESSION['announce'] = "Cập nhật thông tin thành công";
            $_SESSION['user'] = $this->userModel->getUserById($id)[0];
        } else {
            $_SESSION['announce'] = "Cập nhật thông tin thất bại";
        }

        header("Location: " . _HOST . "user");
    }
}

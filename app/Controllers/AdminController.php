<?php
require_once('./app/Models/UserModel.php');
require_once('./app/Models/EmailModel.php');
require_once('./app/Models/TransactionModel.php');

class AdminController extends Controller
{
    private UserModel $userModel;
    private EmailModel $emailModel;
    private TransactionModel $transactionModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->emailModel = new EmailModel();
        $this->transactionModel = new TransactionModel();
    }

    public function index()
    {
        $users = $this->userModel->getUsers();
        $this->render("admin/account_management", ['title' => 'Quản lý tài khoản', 'users' => $users]);
    }

    public function createUser()
    {
        $email = $_POST['email'];
        $name = $_POST['name'];
        if ($this->userModel->createUser($email, $name)) {
            $_SESSION['announce'] = "Tạo tài khoản thành công";
        }
        header('Location: ' . _HOST . 'admin');
    }

    public function updateUserStatus()
    {
        $status = $_POST['status'];
        $email = $_POST['email'];
        if ($this->userModel->updateUserStatus($status, $email)) {
            $_SESSION['announce'] = "cập nhật thông tin thành công";
        } else {
            $_SESSION['announce'] = "Cập nhật thông tin thất bại";
        }
        header('Location: ' . _HOST . 'admin');
    }

    public function resendEmail($email)
    {
        $this->emailModel->resendEmail($email);
        $_SESSION['announce'] = "Gửi email thành công";
        header('Location: ' . _HOST . 'admin');
    }

    public function sales_history($user_id)
    {
        $user = $this->userModel->getUserByID($user_id)[0];
        $this->render("admin/sales_history", ['title' => 'Lịch sử bán hàng', 'user' => $user]);
    }

    public function getSalesHistory($user_id)
    {
        header('Content-Type: application/json');
        $sales_history = $this->transactionModel->getTransactionsByUserID($user_id);
        echo json_encode($sales_history);
    }

    public function getTransactionDetail($transaction_id)
    {
        header('Content-Type: application/json');
        $transaction_detail = $this->transactionModel->getTransactionDetail($transaction_id);
        echo json_encode($transaction_detail);
    }
}
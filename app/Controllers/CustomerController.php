<?php
require_once("./app/Models/CustomerModel.php");
require_once("./app/Models/TransactionModel.php");

class CustomerController extends Controller
{
    private CustomerModel $customerModel;
    private TransactionModel $transactionModel;

    public function __construct()
    {
        $this->customerModel = new CustomerModel();
        $this->transactionModel = new TransactionModel();
    }

    public function index()
    {
        $customer = $this->customerModel->getCustomers();
        $this->render("customer/customer_management", ['title' => 'Quản lý khách hàng', 'customers' => $customer]);
    }

    public function customer_information($idCustomer)
    {
        $customer = $this->customerModel->getCustomerById($idCustomer);
        $this->render('customer/customer_information', ['title' => 'Thông tin khách hàng', "customer" => $customer]);
    }

    public function getTransactionHistory($customer_phone)
    {
        header('Content-Type: application/json');
        $purchase_history = $this->transactionModel->getTransactionsByCustomerPhone($customer_phone);
        echo json_encode($purchase_history);
    }

    public function getTransactionDetail($transaction_id)
    {
        header('Content-Type: application/json');
        $transaction_detail = $this->transactionModel->getTransactionDetail($transaction_id);
        echo json_encode($transaction_detail);
    }
}

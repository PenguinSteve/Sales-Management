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
        $history = $this->transactionModel->getPurchasingHistory($idCustomer);

        $this->render('customer/customer_information', ['title' => 'Thông tin khách hàng', "customer" => $customer, "history" => $history]);
    }

    public function detailsInfo()
    {
        $id = $_POST['id'];
    }
}

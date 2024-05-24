<?php
require_once('./app/Models/ProductModel.php');
require_once('./app/Models/TransactionModel.php');
require_once('./app/Models/CustomerModel.php');

class TransactionController extends Controller
{
    private ProductModel $productModel;
    private TransactionModel $transactionModel;
    private CustomerModel $customerModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->transactionModel = new TransactionModel();
        $this->customerModel = new CustomerModel();
    }

    public function index()
    {
        if (isset($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }
        $this->render("transaction/transaction_processing", ['title' => 'Giao dịch']);
    }

    public function checkout()
    {
        if (isset($_POST['cart']) && isset($_POST['totalProducts']) && isset($_POST['totalAmount'])) {
            $_SESSION['cart'] = [
                'products' => $_POST['cart'],
                'totalProducts' => $_POST['totalProducts'],
                'totalAmount' => $_POST['totalAmount']
            ];
        }
        $this->render('transaction/transaction_checkout', ['title' => 'Thanh toán']);
    }

    public function searchProduct()
    {
        header('Content-Type: application/json');
        if (isset($_POST['text'])) {
            $text = $_POST['text'];
            echo json_encode($this->productModel->getProductByNameOrBarCode($text));
        }
    }

    public function searchCustomer()
    {
        header('Content-Type: application/json');
        if (isset($_POST['phone'])) {
            $phone = $_POST['phone'];
            echo json_encode($this->customerModel->getCustomerByPhone($phone));
        }
    }

    public function saveTransaction()
    {
        header('Content-Type: application/json');
        //Get data from client
        $customer = $_POST['customer'];
        $customer_give = $_POST['cusGives'];
        $products = $_SESSION['cart']['products'];
        $totalAmount = $_SESSION['cart']['totalAmount'];

        //Format date before insert to database
        $date = DateTime::createFromFormat('d/m/Y H:i:s', $_POST['date']);
        $formatted_date = $date->format('Y-m-d H:i:s');

        //Check if customer exist in database
        if (empty($this->customerModel->getCustomerByPhone($customer['phone']))) {
            $this->customerModel->createCustomer($customer['name'], $customer['phone'], $customer['address']);
        }

        //Save transaction
        if ($this->transactionModel->createTransaction($products, $totalAmount, $customer_give, $formatted_date, $customer['phone'])) {
            echo json_encode(['status' => 'success']);
            $_SESSION['announce'] = "Thanh toán thành công";
        } else {
            $_SESSION['announce'] = "Thanh toán thất bại";
        };
    }
}

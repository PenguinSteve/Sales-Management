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
        if(isset($_SESSION['cart'])){
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
        if (isset($_POST['customer']) && isset($_POST['totalAmount']) && isset($_POST['totalProducts']) && isset($_POST['cart'])) {
            $customer = $_POST['customer'];
            $totalAmount = $_POST['totalAmount'];
            $totalProducts = $_POST['totalProducts'];
            $cart = $_POST['cart'];

            $customer_id = $this->customerModel->getCustomerByPhone($customer['phone']);
            if ($customer_id == null) {
                $customer_id = $this->customerModel->insertCustomer($customer);
            } else {
                $customer_id = $customer_id['id'];
            }

            $transaction_id = $this->transactionModel->insertTransaction($customer_id, $totalAmount, $totalProducts);

            foreach ($cart as $product) {
                $this->transactionModel->insertTransactionDetail($transaction_id, $product['id'], $product['quantity'], $product['price']);
            }

            echo json_encode(['status' => 'success']);
        }
    }
}
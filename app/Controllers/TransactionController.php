<?php
require_once('./app/Models/ProductModel.php');
require_once('./app/Models/TransactionModel.php');

class TransactionController extends Controller
{
    private ProductModel $productModel;
    private TransactionModel $transactionModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->transactionModel = new TransactionModel();
    }

    public function index()
    {
        $this->render("transaction/transaction_processing", ['title' => 'Giao dịch']);
    }

    public function checkout()
    {
        $this->render('transaction/transaction_checkout', ['title' => 'Thanh toán']);
    }

    public function searchProduct($text)
    {
        header('Content-Type: application/json');
        if (isset($_POST['text'])) {
            echo json_encode($this->productModel->getProductByNameOrBarCode($text));
        }
    }
}
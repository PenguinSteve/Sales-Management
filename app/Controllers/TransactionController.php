<?php
class TransactionController extends Controller
{

    public function index()
    {
        $this->render("transaction/transaction_processing", ['title' => 'Giao dịch']);
    }

    public function checkout()
    {
        $this->render('transaction/transaction_checkout', ['title' => 'Thanh toán']);
    }
}

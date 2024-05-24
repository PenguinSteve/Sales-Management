<?php

require_once("./app/Models/CustomerModel.php");
class TransactionModel extends Database
{
    function __construct()
    {
        parent::__construct();
    }

    public function getPurchasingHistory($id)
    {
        return $this->select("SELECT * FROM transaction WHERE user_id = ?", [$id], 'i');
    }

    public function getTransactions()
    {
        return $this->select("SELECT * FROM transaction");
    }

    public function getTransactionsByCustomerPhone($phone)
    {
        return $this->select("SELECT * FROM transaction WHERE customer_phone = ?", [$phone], 's');
    }

    public function getTransactionsByUserID($id)
    {
        return $this->select("SELECT * FROM transaction WHERE user_id = ?", [$id], 'i');
    }

    // public function getTransactionsByDateRange($from, $to)
    // {
    //     return $this->select("SELECT * FROM transaction WHERE date BETWEEN ? AND ?", [$from, $to], 'ss');
    // }

    public function getTransactionsByDateRange($from, $to)
    {
        return $this->select(
            "SELECT *
            FROM transaction
            WHERE transaction_date BETWEEN ? AND ?
            ORDER BY transaction_date",
            [$from, $to],
            'ss'
        );
    }

    public function createTransaction($products, $totalAmount, $customer_give, $date, $customer_phone)
    {
        try {
            $this->action("INSERT INTO transaction (total_amount, amount_receive, amount_back, transaction_date, user_id, customer_phone) VALUES (?, ?, ?, ?, ?, ?)", [$totalAmount, $customer_give, $customer_give - $totalAmount, $date, $_SESSION['user']['user_id'], $customer_phone], 'dddsis');

            $transaction_id = $this->getConn()->insert_id;
            foreach ($products as $product) {
                //Create transaction detail
                $this->action("INSERT INTO transaction_detail (product_id, transaction_id, quantity, price) VALUES (?, ?, ?, ?)", [$product['product_id'], $transaction_id, $product['quantity'], $product['retail_price']], 'iiid');

                //Update product quantity have been sold
                $this->action("UPDATE product SET sold = sold + ? WHERE product_id = ?", [$product['quantity'], $product['product_id']], 'ii');
            }
            unset($_SESSION['cart']);
            return true;
        } catch (Exception $th) {
            print_r($th->getMessage());
            return false;
        }
    }
}

<?php

require_once("./app/Models/CustomerModel.php");
class TransactionModel extends Database
{
    function __construct()
    {
        parent::__construct();
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

    public function getTransactionDetail($transaction_id)
    {
        return $this->select("SELECT td.*, total_amount, transaction_date, customer_phone, customer_name, name, product_name FROM transaction_detail td INNER JOIN product p ON td.product_id = p.product_id INNER JOIN transaction t ON t.transaction_id = td.transaction_id INNER JOIN customer c ON t.customer_phone = c.phone INNER JOIN user u ON t.user_id = u.user_id WHERE td.transaction_id = ?", [$transaction_id], 'i');
    }

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
            $total_quantity = 0;
            foreach ($products as $product) {
                $total_quantity += $product['quantity'];
            }

            //Create transaction
            $this->action("INSERT INTO transaction (total_amount, total_quantity, amount_receive, amount_back, transaction_date, user_id, customer_phone) VALUES (?, ?, ?, ?, ?, ?, ?)", [$totalAmount, $total_quantity, $customer_give, $customer_give - $totalAmount, $date, $_SESSION['user']['user_id'], $customer_phone], 'diddsis');

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

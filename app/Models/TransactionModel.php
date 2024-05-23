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

    public function getTransactionDetailById($id)
    {
        return $this->select("SELECT * FROM transaction_detail WHERE transaction_id = ?", [$id], 'i');
    }

    public function getTransactionsByCustomerPhone($phone)
    {
        return $this->select("SELECT * FROM transaction WHERE customer_phone = ?", [$phone], 'i');
    }

    public function getTransactionsByUserID($id)
    {
        return $this->select("SELECT * FROM transaction WHERE user_id = ?", [$id], 'i');
    }

    public function getTransactionsByDateRange($from, $to)
    {
        return $this->select("SELECT * FROM transaction WHERE date BETWEEN ? AND ?", [$from, $to], 'ss');
    }
}

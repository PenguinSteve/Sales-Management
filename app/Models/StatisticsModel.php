<?php
class StatisticsModel extends Database
{
    function __construct()
    {
        parent::__construct();
    }

    public function getProfitByTimelines($dateFrom, $datoTo)
    {
        return $this->select(
            "SELECT SUM(quantity) AS count_product, import_price, transaction_detail.price
            FROM product, transaction_detail, transaction
            WHERE transaction_detail.product_id = product.product_id AND (transaction_date BETWEEN ? AND ?) AND transaction_detail.transaction_id=transaction.transaction_id 
            GROUP BY transaction_detail.product_id",
            [$dateFrom, $datoTo],
            'ss'
        );
    }

    public function getTotalProfit()
    {
        return $this->select(
            "SELECT SUM(quantity) AS count_product, import_price, transaction_detail.price
            FROM product, transaction_detail, transaction
            WHERE transaction_detail.product_id = product.product_id AND transaction_detail.transaction_id=transaction.transaction_id 
            GROUP BY transaction_detail.product_id"
        );
    }

    public function getAmountReceived_numberOrder($dateFrom, $datoTo)
    {
        return $this->select(
            "SELECT SUM(total_amount) AS total, COUNT(transaction_id) AS orders
            FROM transaction
            WHERE transaction_date >= ? AND transaction_date <= ?",
            [$dateFrom, $datoTo],
            'ss'
        );
    }

    public function getTotalAmountReceived_numberOrder()
    {
        return $this->select(
            "SELECT SUM(total_amount) AS total, COUNT(transaction_id) AS orders
            FROM transaction"
        );
    }

    public function getNumberProduct($dateFrom, $datoTo)
    {
        return $this->select(
            "SELECT SUM(total_quantity) AS products
            FROM transaction
            WHERE (transaction_date BETWEEN ? AND ?)",
            [$dateFrom, $datoTo],
            'ss'
        );
    }

    public function getTotalNumberProduct()
    {
        return $this->select(
            "SELECT SUM(total_quantity) AS products
            FROM transaction"
        );
    }

    public function getTransactions()
    {
        return $this->select(
            "SELECT *
            FROM transaction
            ORDER BY transaction_date DESC"
        );
    }

    public function getTransactionForModal($id)
    {
        return $this->select(
            "SELECT quantity, price, product_name, transaction.transaction_date, transaction.total_amount, customer_phone, customer.customer_name, user.name
            FROM transaction_detail, customer, user, transaction, product
            WHERE transaction_detail.transaction_id = ?
            AND user.user_id = transaction.user_id
            AND transaction.customer_phone = customer.phone
            AND transaction.transaction_id = transaction_detail.transaction_id
            AND transaction_detail.product_id = product.product_id",
            [$id],
            'i'
        );
    }
}

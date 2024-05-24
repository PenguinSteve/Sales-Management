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
            "SELECT COUNT(transaction_detail.product_id) AS count_product, import_price
                            FROM product, transaction_detail, transaction
                            WHERE transaction_detail.product_id = product.product_id AND (transaction_date >= ? AND transaction_date <= ?) AND transaction_detail.transaction_id=transaction.transaction_id GROUP BY transaction_detail.product_id",
            [$dateFrom, $datoTo],
            'ss'
        );
    }

    public function getTotalProfit($dateFrom, $datoTo)
    {
        return $this->select(
            "SELECT COUNT(transaction_detail.product_id) AS count_product, import_price
                            FROM product, transaction_detail, transaction
                            WHERE transaction_detail.product_id = product.product_id AND (transaction_date >= ? AND transaction_date <= ?) AND transaction_detail.transaction_id=transaction.transaction_id GROUP BY transaction_detail.product_id",
            [$dateFrom, $datoTo],
            'ss'
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

    public function getNumberProduct($dateFrom, $datoTo)
    {
        return $this->select(
            "SELECT COUNT(DISTINCT product_id) AS products
            FROM transaction_detail, transaction
            WHERE transaction_date >= ? AND transaction_date <= ?",
            [$dateFrom, $datoTo],
            'ss'
        );
    }

    public function getOrderByTimelines($idOrder)
    {
        // return $this->select(
        //     "SELECT *
        //     FROM transaction
        //     WHERE transaction_date >= ? AND transaction_date <= ? AND ",
        //     [$dateFrom, $datoTo],
        //     'ss'
        // );
    }

    public function getTransactionForModal($id)
    {
        return $this->select(
            "SELECT transaction_detail.*, product.*, user.name
            FROM transaction_detail
            INNER JOIN product ON transaction_detail.product_id = product.product_id
            INNER JOIN transaction ON transaction.transaction_id = transaction_detail.transaction_id
            INNER JOIN user ON user.user_id = transaction.user_id
            WHERE transaction_detail.transaction_id = ?",
            [$id],
            'i'
        );
    }
}
<?php
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
}

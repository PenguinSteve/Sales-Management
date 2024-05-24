<?php
class CustomerModel extends Database
{
    function __construct()
    {
        parent::__construct();
    }

    public function getCustomers()
    {
        return $this->select("SELECT * FROM customer");
    }

    public function getCustomerById($id)
    {
        return $this->select("SELECT * FROM customer WHERE customer_id = ?", [$id], 'i');
    }

    public function getCustomerByPhone($phone)
    {
        return $this->select("SELECT * FROM customer WHERE phone = ?", [$phone], 's');
    }

    public function createCustomer($name, $phone, $address)
    {
        return $this->action("INSERT INTO customer (customer_name, phone, address) VALUES (?, ?, ?)", [$name, $phone, $address], 'sss');
    }
}

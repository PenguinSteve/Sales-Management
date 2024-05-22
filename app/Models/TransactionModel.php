<?php
class TransactionModel extends Database
{
    function __construct()
    {
        parent::__construct();
    }

    public function getProducts()
    {
        return $this->select("SELECT * FROM product");
    }

    public function getProductById($id)
    {
        return $this->select("SELECT * FROM product WHERE id = ?", [$id], 'i');
    }

    public function getProductByName($name)
    {
        return $this->select("SELECT * FROM product WHERE name LIKE ?", ["%" . $name . "%"], 's');
    }

    public function getProductByBarcode($barcode)
    {
        return $this->select("SELECT * FROM product WHERE barcode = ?", [$barcode], 'i');
    }

    public function createProduct($name, $import_price, $retail_price, $date, $targetFile, $category) {
    //     $this->action("INSERT INTO product (name, import_price, retail_price, created, image_url, category_id) VALUES (?, ?, ?, ?, ?, ?)", [$name, $import_price, $retail_price, $date, $targetFile, $category], 'sddsss');
    }

    
}

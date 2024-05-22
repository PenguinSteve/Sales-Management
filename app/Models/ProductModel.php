<?php
class ProductModel extends Database
{
    function __construct()
    {
        parent::__construct();
    }

    public function getProducts()
    {
        return $this->select("SELECT p.*, c.name FROM product p INNER JOIN category c ON p.category_id = c.id");
    }

    public function getProductById($id)
    {
        return $this->select("SELECT * FROM product WHERE id = ?", [$id], 's');
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

        $rowsAffected = $this->action("INSERT INTO product (name, import_price, retail_price, created, image_url, category_id) VALUES (?, ?, ?, ?, ?, ?)", [$name, $import_price, $retail_price, $date, $targetFile, $category], 'sddsss');
        return $rowsAffected > 0;
    }
}

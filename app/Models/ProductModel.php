<?php
class ProductModel extends Database
{
    function __construct()
    {
        parent::__construct();
    }

    public function getProducts()
    {
        return $this->select("SELECT p.*, category_name FROM product p INNER JOIN category c ON p.category_id = c.category_id");
    }

    public function getProductById($id)
    {
        return $this->select("SELECT * FROM product WHERE product_id = ?", [$id], 'i');
    }

    public function getProductByName($name)
    {
        return $this->select("SELECT * FROM product WHERE name LIKE ?", ["%" . $name . "%"], 's');
    }

    public function getProductByBarcode($barcode)
    {
        return $this->select("SELECT * FROM product WHERE barcode = ?", [$barcode], 'i');
    }

    public function getProductByNameOrBarCode($text)
    {
        return $this->select("SELECT * FROM product WHERE product_name LIKE ? OR CAST(product_id AS CHAR) LIKE ?", ["%" . $text . "%", "%" . $text . "%"], 'ss');
    }

    public function createProduct($name, $import_price, $retail_price, $date, $targetFile, $category)
    {
        $rowsAffected = $this->action("INSERT INTO product (product_name, import_price, retail_price, created, image_url, category_id) VALUES (?, ?, ?, ?, ?, ?)", [$name, $import_price, $retail_price, $date, $targetFile, $category], 'sddsss');
        return $rowsAffected > 0;
    }

    public function updateProduct($id, $name, $import_price, $retail_price, $date, $targetFile, $category)
    {
        $rowsAffected = $this->action(
            "UPDATE product SET product_name = ?, import_price = ?, retail_price = ?, created = ?, image_url = ?, category_id = ? WHERE product_id = ?",
            [$name, $import_price, $retail_price, $date, $targetFile, $category, $id],
            'sddssss'
        );

        return $rowsAffected > 0;
    }

    public function deleteProduct($id)
    {
        return $this->action("DELETE FROM product WHERE product_id = ? AND sold = 0", [$id], 's');
    }
}

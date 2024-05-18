<?php
    class UserModel extends Database{
        function __construct()
        {
            parent::__construct();
        }

        public function getProducts(){
            return $this->select("SELECT * FROM user");
        }

        public function getProductById($id){
            return $this->select("SELECT * FROM user WHERE id = ?", [$id], 'i');
        }

        public function getProductByName($name){
            return $this->select("SELECT * FROM user WHERE name LIKE ?", ["%".$name."%"], 's');
        }

        public function getProductByBarcode($barcode){
            return $this->select("SELECT * FROM user WHERE barcode = ?", [$barcode], 'i');
        }
    }
?>
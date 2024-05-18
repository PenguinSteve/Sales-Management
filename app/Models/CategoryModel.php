<?php
    class CategoryModel extends Database{
        function __construct()
        {
            parent::__construct();
        }

        public function getCategory(){
            return ["products" => ["sản phẩm 1", "sản phẩm 2"], "category" => "nước"];
        }
    }
?>
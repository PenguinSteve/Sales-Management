<?php 
    class ProductController extends Controller{

        public function index(){
            $productModel = $this->model("ProductModel");
            $this->render("products/product_management", ["title" => "Danh mục sản phẩm"]);
        }
    }
?>
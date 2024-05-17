<?php 
    class ProductController extends Controller{

        public function index(){
            $productModel = $this->model("ProductModel");
            $this->render("products/index", ["product" => $productModel->getProducts()]);
        }
    }
?>
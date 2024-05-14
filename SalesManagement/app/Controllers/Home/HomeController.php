<?php
    class HomeController extends Controller{
        public function index(){
            $productModel = $this->model("ProductModel");
            $productModel->getProducts();

            $this->render("products/index");
        }
        
        public function test($a, $b){
            echo "".$a."".$b."";
        }
    }
?>
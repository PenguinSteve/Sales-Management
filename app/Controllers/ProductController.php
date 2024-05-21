<?php
class ProductController extends Controller
{

    public function index()
    {
        $productModel = $this->model("ProductModel");
        $this->render("products/product_management", ["title" => "Danh mục sản phẩm"]);
    }

    public function addProduct()
    {
        $productModel = $this->model("ProductModel");
        $this->render("products/product_information", ["title" => "Thêm sản phẩm"]);    
    }
}

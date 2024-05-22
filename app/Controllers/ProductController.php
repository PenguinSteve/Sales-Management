<?php
require_once("./app/Models/ProductModel.php");
require_once("./app/Models/CategoryModel.php");
class ProductController extends Controller
{
    private ProductModel $productModel;
    private CategoryModel $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $productModel = $this->model("ProductModel");
        $this->render("products/product_management", ["title" => "Danh mục sản phẩm"]);
    }

    public function addProduct() {
        $productModel = $this->model("ProductModel");
        $categories = $this->categoryModel->getCategories();
        $this->render("products/product_information", ['title' => 'Thêm sản phẩm', 'categories' => $categories]);
    }

    public function createProduct() {
    //     $name = $_POST["name"];
    //     $import_price = $_POST["import_price"];
    //     $retail_price = $_POST["retail_price"];
    //     $category = $_POST["category"];
    //     $date = $_POST["date"];

    //     // Move product image to new folder and $targetFile is the its new url
    //     $targetFile = "public/product_images/" . basename($_FILES['userImage']['name']);
    //     move_uploaded_file($_FILES['userImage']['tmp_name'], $targetFile);

    //     // $this->productModel->

    }
}

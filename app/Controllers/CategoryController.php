<?php
class ProductController extends Controller
{
    private CategoryModel $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $categories = $this->categoryModel->getCategories();
        $this->render("products/product_information", ['title' => 'Thêm sản phẩm', 'categories' => $categories]);
    }    
}

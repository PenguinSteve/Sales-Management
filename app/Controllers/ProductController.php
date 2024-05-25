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
        $products = $this->productModel->getProducts();
        $this->render("products/product_management", ["title" => "Danh mục sản phẩm", "products" => $products]);
    }

    public function addProduct()
    {
        $categories = $this->categoryModel->getCategories();

        $this->render("products/add_product_information", ['title' => 'Thêm sản phẩm', 'categories' => $categories]);
    }

    public function createProduct()
    {
        $name = $_POST["name"];
        $import_price = $_POST["import_price"];
        $retail_price = $_POST["retail_price"];
        $category = $_POST["category"];
        $date = $_POST["date"];

        // Move product image to new folder and $targetFile is the its new url
        $targetFile = "public/product_images/" . basename($_FILES['imageProduct']['name']);
        move_uploaded_file($_FILES['imageProduct']['tmp_name'], $targetFile);

        $row_affected = $this->productModel->createProduct($name, $import_price, $retail_price, $date, $targetFile, $category);
        if ($row_affected) {
            $_SESSION['announce'] = "Thêm sản phẩm thành công";
        } else {
            $_SESSION['announce'] = "Thêm sản phẩm thất bại";
        }
        header('Location: ' . _HOST . 'product');
    }

    // for update action
    public function getProduct($id)
    {
        $categories = $this->categoryModel->getCategories();
        $product = $this->productModel->getProductById($id);
        $this->render("products/update_product_information", ['title' => 'Cập nhập sản phẩm', 'product' => $product, 'categories' => $categories]);
    }

    public function updateProduct($id)
    {
        $name = $_POST["name"];
        $import_price = $_POST["import_price"];
        $retail_price = $_POST["retail_price"];
        $category = $_POST["category"];
        $date = $_POST["date"];

        $targetFile = "public/product_images/" . basename($_FILES['imageProduct']['name']);

        if ($_FILES['imageProduct']['error'] != 4) {
            $row_affected = $this->productModel->updateProduct($id, $name, $import_price, $retail_price, $date, $targetFile, $category);
            move_uploaded_file($_FILES['imageProduct']['tmp_name'], $targetFile);
        } else {
            $row_affected = $this->productModel->updateProductNoImage($id, $name, $import_price, $retail_price, $date, $category);
        }

        if ($row_affected) {
            $_SESSION['announce'] = "Cập nhật sản phẩm thành công";
        } else {
            $_SESSION['announce'] = "Cập nhật sản phẩm thất bại";
        }
        header('Location: ' . _HOST . 'product');
    }

    public function deleteProduct($id)
    {
        // $product = extract($this->productModel->getProductById($id));
        // $urlImg = $product[0]['image_url'];
        $row_affected = $this->productModel->deleteProduct($id);

        if ($row_affected) {
            // unlink($urlImg);
            $_SESSION['announce'] = "Xóa sản phẩm thành công";
        } else {
            $_SESSION['announce'] = "Không thể xóa những sản phẩm đã được bán";
        }
        header('Location: ' . _HOST . 'product');
    }
}

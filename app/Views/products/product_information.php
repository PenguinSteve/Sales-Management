<?php
$isAuthenticated = (isset($_SESSION['user']) && !isset($_SESSION['isNeedToChangePassword']));
if ($isAuthenticated) :
    $currentUser = $_SESSION['user'];
?>
    <?php
    require_once(_DIR_ROOT . '/app/Views/layouts/header.php')
    ?>

    <body>
        <div id="app">

            <?php require_once(_DIR_ROOT . '/app/Views/layouts/sidebar.php') ?>
            <?php require_once(_DIR_ROOT . '/app/Views/layouts/nav.php') ?>

            <div id="main">
            <form enctype="multipart/form-data" method="POST" action="">
                <div class="row gx-4 pl-5 align-items-center pt-5">

                    <!--image and upload image-->
                    <div class="col-md-4 mr-4">
                        <img class="card-img-top" id="image" />
                            <div class="form-file mt-3">
                                <input type="file" name="imageProduct" class="form-file-input" accept=".jpg,.jpeg,.png" onchange="chooseFile(this)" required>
                                <label class="form-file-label" for="customFile">
                                    <span class="form-file-text" id="customFile">Choose image...</span>
                                    <span class="form-file-button btn-primary "><i data-feather="upload"></i></span>
                                </label>
                            </div>
                    </div>

                    <div class="col-md-6">

                        <!--barcode-->
                        <div class="d-flex align-items-center">
                            <svg id="barcode"></svg>
                            <div class="small fa-barcode" id="productId" style="margin-left: 4rem;">SKU: BST-498</div>
                        </div>

                        <!--information details-->
                        <div class="col-md-9 pt-4">
                            <div class="mb-2 d-flex justify-content-between">
                                <label for="name" class="col-form-label">Product name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>

                            <div class="mb-2 d-flex justify-content-between">
                                <label for="import_price" class="col-form-label">Import price</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="import_price" required>
                                </div>
                            </div>

                            <div class="mb-2 d-flex justify-content-between">
                                <label for="retail_price" class="col-form-label" required>Retail price</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="retail_price">
                                </div>
                            </div>

                            <div class="mb-2 d-flex justify-content-between">
                                <label for="category" name='category' class="col-form-label">Category</label>
                                <select class="form-select" style="width: 14.5rem;">
                                    <option selected>Phone</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>

                            <div class="mb-2 d-flex justify-content-between">
                                <label for="date" class="col-form-label">Creation date</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" name="date" required>
                                </div>
                            </div>

                            <div class="mb-2 d-flex justify-content-end">
                                <button type="submit" class="btn btn-outline-success float-right" style="margin-top: 2rem; width: 6rem;">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>

        <!--Footer-->
        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-left">
                    <p>2020 &copy; Voler</p>
                </div>
                <div class="float-right">
                    <p>Crafted with <span class='text-danger'><i data-feather="heart"></i></span> by <a href="#">Ahmad Saugi</a></p>
                </div>
            </div>
        </footer>

        <?php require_once(_DIR_ROOT . '/app/Views/layouts/announce.php') ?>

        <script src="public/js/feather-icons/feather.min.js"></script>
        <script src="public/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="public/js/app.js"></script>
        <script src="public/js/main.js"></script>

        <script>
            // show barcode when product id is available
            $(document).ready(function() {
                var check = $('#productId').text()

                if (check != '') {
                    $('#barcode').show();
                } else {
                    $('#barcode').hide();
                }
            })

            JsBarcode("#barcode", "SKU: BST-498", {
                height: 40,
                width: 1,
                displayValue: false
            });


            // show image on <img> tag
            var selectedImage;
            function chooseFile(fileInput) {
                if (fileInput.files && fileInput.files[0]) {
                    selectedImage = fileInput.files[0]
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $("#image").attr("src", e.target.result)
                        $('#customFile').text(fileInput.files[0].name);
                    }
                    reader.readAsDataURL(fileInput.files[0])
                }
            }
        </script>
    </body>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_FILES['imageProduct'])) {
            $targetDir = "public/product_images/";
            $targetImage = $targetDir . basename($_FILES['imageProduct']['name']);

            // Move the image file to the product_images folder
            move_uploaded_file($_FILES['imageProduct']['tmp_name'], $targetImage);
        }
    }
    ?>

</html>

<?php
else : header("Location:" . _HOST . "home/logout");
endif;
?>
<?php
$isAuthenticated = (isset($_SESSION['user']) && !isset($_SESSION['isNeedToChangePassword']));
if (isset($_SESSION['isNeedToChangePassword'])) {
    header("Location:" . _HOST . "user/changePasswordFirstTime");
    exit();
}
if ($isAuthenticated) :
    $currentUser = $_SESSION['user'];
?>
    <?php
    require_once(_DIR_ROOT . '/app/Views/layouts/header.php')
    ?>

    <body>
        <?php require_once(_DIR_ROOT . '/app/Views/layouts/announce.php') ?>

        <div id="app">

            <?php require_once(_DIR_ROOT . '/app/Views/layouts/sidebar.php')
            ?>
            <?php require_once(_DIR_ROOT . '/app/Views/layouts/nav.php') ?>

            <div id="main">

                <form method="POST" enctype="multipart/form-data" action="product/createProduct">
                    <div class="row gx-4 pl-5 align-items-center pt-5">

                        <!--image and upload image-->
                        <div class="col-md-4 mr-4">
                            <img class="card-img-top" id="image" src="" />
                            <div class="form-file mt-3">
                                <input type="file" name="imageProduct" class="form-file-input" accept=".jpg,.jpeg,.png" onchange="chooseFile(this)" required>
                                <label class="form-file-label" for="customFile">
                                    <span class="form-file-text" id="customFile">Choose image...</span>
                                    <span class="form-file-button btn-primary "><i data-feather="upload"></i></span>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-6">

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
                                        <input type="number" class="form-control inputNum" name="import_price" required>
                                    </div>
                                </div>

                                <div class="mb-2 d-flex justify-content-between">
                                    <label for="retail_price" class="col-form-label" required>Retail price</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control inputNum" name="retail_price" required>
                                    </div>
                                </div>

                                <div class="mb-2 d-flex justify-content-between">
                                    <label for="category" class="col-form-label">Category</label>
                                    <select name="category" class="form-select" style="width: 14.6rem;" required>
                                        <?php foreach ($categories as $category) {
                                            echo "<option value=\"" . $category['category_id'] . "\">" . $category['category_name'] . "</option>";
                                        }
                                        ?>
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
            </div>
            </form>
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


        <script src="public/js/feather-icons/feather.min.js"></script>
        <script src="public/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="public/js/app.js"></script>
        <script src="public/js/main.js"></script>

        <script>
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

            //Prevent input quantity less than 1
            $(document).on('input', '.inputNum', function() {
                var value = $(this).val();
                if (value < 1 || value == '') {
                    $(this).val(1);
                }
            });
        </script>
    </body>

    </html>

<?php
else : header("Location:" . _HOST . "home/logout");
endif;
?>
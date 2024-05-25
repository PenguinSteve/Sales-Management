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
    require_once(_DIR_ROOT . '/app/Views/layouts/header.php') ?>

    <body>
        <?php require_once(_DIR_ROOT . '/app/Views/layouts/announce.php') ?>

        <div id="app">

            <?php require_once(_DIR_ROOT . '/app/Views/layouts/sidebar.php') ?>
            <?php require_once(_DIR_ROOT . '/app/Views/layouts/nav.php') ?>

            <div id="main">

                <form id="form" class="ml-5" method="POST" enctype="multipart/form-data" action="product/updateProduct/<?php echo $product[0]['product_id'] ?>">

                    <div class="row gx-4 pl-5 align-items-center pt-5">

                        <!--image and upload image-->
                        <div class="col-md-3 mr-2">
                            <img class="card-img-top" id="image" src="<?php echo $product[0]['image_url'] ?>" />
                            <div class="form-file mt-3">
                                <input id="uploadImg" type="file" name="imageProduct" class="form-file-input" accept=".jpg,.jpeg,.png" onchange="chooseFile(this)">
                                <label class="form-file-label" for="customFile">
                                    <span class="form-file-text" id="customFile"></span>
                                    <span class="form-file-button btn-primary "><i data-feather="upload"></i></span>
                                </label>
                            </div>
                            <small style="color: red; display: none">Choose an image!</small>
                        </div>


                        <div class="col-md-7">

                            <!--id and barcode-->
                            <div class="col-md-12">
                                <div class="d-flex align-items-center">
                                    <svg id="barcode"></svg>
                                    <div class="fa-barcode">
                                        <input class="idProduct" type="text" disabled value="<?php echo $product[0]['product_id'] ?>" style="color:black; margin-left: 3rem">

                                    </div>
                                </div>

                                <!--information details-->
                                <div class="col-md-9 pt-4">
                                    <div class="mb-2 d-flex justify-content-between">
                                        <label for="name" class="col-form-label">Product name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="name" required value="<?php echo $product[0]['product_name'] ?>">
                                        </div>
                                    </div>

                                    <div class="mb-2 d-flex justify-content-between">
                                        <label for="import_price" class="col-form-label">Import price</label>
                                        <div class="col-sm-8">
                                            <input style="width: 100%" type="number" class="form-control inputNum" name="import_price" required value="<?php echo $product[0]['import_price']; ?>">
                                        </div>
                                    </div>

                                    <div class="mb-2 d-flex justify-content-between">
                                        <label for="retail_price" class="col-form-label" required>Retail price</label>
                                        <div class="col-sm-8">
                                            <input style="width: 100%" type="number" class="form-control inputNum" name="retail_price" required value="<?php echo $product[0]['retail_price']; ?>">
                                        </div>
                                    </div>

                                    <div class="mb-2 d-flex justify-content-between">
                                        <label for="category" class="col-form-label">Category</label>
                                        <select style="width: 21rem" name="category" class="form-select" style="width: 16.2rem;" required>
                                            <?php foreach ($categories as $category) {
                                                if ($category['category_id'] == $product[0]['category_id']) {
                                                    echo "<option value=\"" . $category['category_id'] . "\" selected>" . $category['category_name'] . "</option>";
                                                } else {
                                                    echo "<option value=\"" . $category['category_id'] . "\">" . $category['category_name'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="mb-2 d-flex justify-content-between">
                                        <label for="date" class="col-form-label">Creation date</label>
                                        <div class="col-sm-8">
                                            <?php
                                            $createdDate = DateTime::createFromFormat('Y-m-d H:i:s', $product[0]['created']);
                                            $formattedDate = $createdDate ? $createdDate->format('Y-m-d') : ''; ?>

                                            <input type="date" class="form-control" name="date" required value="<?php echo htmlspecialchars($formattedDate); ?>">

                                        </div>
                                    </div>

                                    <div class="mb-2 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-outline-success float-right" style="margin-top: 2rem; width: 6rem;" onclick="sendForm()">Save</button>
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

    </body>

    <script>
        // show image on <img> tag-->
        function chooseFile(fileInput) {
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $("#image").attr("src", e.target.result)
                    $('#customFile').text(fileInput.files[0]['name'])
                }
                reader.readAsDataURL(fileInput.files[0])
            }
        }


        // show barcode
        JsBarcode("#barcode", <?php echo $product[0]['product_id'] ?>, {
            height: 40,
            width: 2,
            displayValue: true
        })

        //Prevent input quantity less than 1
        $(document).on('input', '.inputNum', function() {
            var value = $(this).val()
            if (value < 1 || value == '') {
                $(this).val(1)
            }
        })
    </script>


    </html>

<?php
else : header("Location:" . _HOST . "home/logout");
endif;
?>
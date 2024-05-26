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

            <?php require_once(_DIR_ROOT . '/app/Views/layouts/sidebar.php') ?>
            <?php require_once(_DIR_ROOT . '/app/Views/layouts/nav.php') ?>

            <div id="main">
                <?php require_once(_DIR_ROOT . '/app/Views/modal/ModalDeleteConfirm.php') ?>

                <script>
                    $('.sidebar-link').removeClass('active')
                    $('a[href="product/"]').closest('li').addClass('active')
                </script>

                <section class="py-2">
                    <div class="container mt-5">

                        <div class="d-flex justify-content-end mb-4">
                            <?php
                            if ($currentUser['role'] === "admin") {
                                echo "<div><a href=\"product/addProduct\" class=\"btn btn-primary mr-4\">Add</a></div>";
                            }
                            ?>
                        </div>

                        <div class="row gx-lg-4 row-cols-xl-4 justify-content-left">

                            <?php
                            if (count($products) > 0) {
                                foreach ($products as $product) {
                                    // card
                                    echo <<<HTML
                                        <div class="col">
                                            <div class="card" style="width: 105%;">
                                                <img class="card-img-top p-1 mx-auto pt-2" style="width: 10rem; height: 10rem; object-fit: contain" src="{$product['image_url']}"/>

                                                <div class="card-body pl-4 pr-2 pb-0">
                                                    <h6 class="fw-bolder nameProduct nunito">{$product['product_name']}</h6>
                                                    <p class="category">{$product['category_name']}</p>
                                                    <p class="nunito">Code: {$product['product_id']}</p>
                                                    <div class="d-flex justify-content-left">
                                                        <h5 class="price nunito mr-2">{$product['retail_price']} đ</h5>
                                        HTML;
                                    if ($currentUser['role'] === "admin") {
                                        echo '<p class="retail_price original_price text-sm nunito">' . $product['import_price'] . ' đ</p>';
                                    }

                                    echo <<<HTML
                                                                </div>
                                                            </div>
                                                            <div class="card-footer pt-2 pb-3 pr-4 border-top-0 bg-transparent d-flex justify-content-end">
                                                    HTML;

                                    if ($currentUser['role'] === "admin") {
                                        echo <<<HTML
                                            <a href="product/getProduct/{$product['product_id']}" class="btn btn-outline-success">Edit</a>
                                            <button id="{$product['product_id']}" type="button" class="btn btn-outline-danger ml-1" data-toggle="modal" data-target="#confirmDeleteModal">Delete</button>
                                            HTML;
                                    }

                                    echo <<<HTML
                                                    </div>
                                                </div>
                                            </div>
                                        HTML;
                                }
                            }
                            ?>
                        </div>
                    </div>
                </section>
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
        $(document).ready(function() {

            $('.price').each(function() {
                let numberStr = $(this).text();
                let formattedNumber = numberStr.replace(/(\d{2})(\d{3})(\d{3})/, '$1.$2.$3');
                $(this).text(formattedNumber);
            });

            $('.retail_price').each(function() {
                let numberStr1 = $(this).text();
                let formattedNumber = numberStr1.replace(/(\d{2})(\d{3})(\d{3})/, '$1.$2.$3');
                $(this).text(formattedNumber);                
            });

            var idProduct

            $('.btn-outline-danger').on('click', function() {
                idProduct = $(this).attr('id');
            })

            $("#deleteSomething").click(function() {
                $.ajax({
                    url: "product/deleteProduct/" + idProduct,
                    method: "POST",
                    success: function(response) {
                        $('#confirmDeleteModal').modal('hide');
                        $('.modal-backdrop').remove();
                        $('body').html(response);
                    },
                    error: function(error) {

                    }
                })
            })
        })
    </script>

    </html>
<?php
else : header("Location:" . _HOST . "home/logout");
endif;
?>
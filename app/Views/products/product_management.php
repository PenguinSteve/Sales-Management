<?php
$isAuthenticated = (isset($_SESSION['user']) && !isset($_SESSION['isNeedToChangePassword']));
if($_SESSION['isNeedToChangePassword']){
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
                <?php
                require_once(_DIR_ROOT . '/app/Views/modal/ModalDeleteConfirm.php');
                ?>

                <section class="py-2">
                    <div class="container mt-5">

                        <div class="d-flex justify-content-between">
                            <div class="form-group col-lg-4">
                                <input type="text" class="form-control mb-4" id="search" placeholder="Search">
                            </div>
                            <?php
                            if ($currentUser['role'] === "admin") {
                                echo "<div><a href=\"#\" class=\"btn btn-primary mr-4\">Add</a></div>";
                            }
                            ?>


                        </div>

                        <div class="row gx-lg-4 row-cols-xl-4 justify-content-left">
                            <!-- card-->
                            <div class="col">
                                <div class="card" style="width: 100%;">
                                    <img class="card-img-top p-1 mx-auto pt-2" style="width: 10rem;" src="public/product_images/samsung.jpeg" />

                                    <div class="card-body pl-4 pr-4 pb-0">
                                        <h6 class="fw-bolder nameProduct">SAMSUNG Galaxy A55 5G</h6>
                                        <p class="category">Phone</p>
                                        <p>Code: SE-S3BT</p>
                                        <div class="d-flex">
                                            <h5 class="fw-bolder price mr-2">9.800.000</h5>
                                            <p class="retail_price text-sm">8.780.000</p>
                                        </div>
                                    </div>

                                    <div class="card-footer pt-2 pb-3 pr-4 border-top-0 bg-transparent d-flex justify-content-end">
                                        <button type="button" class="btn btn-outline-success">Edit</button>
                                        <button type="button" class="btn btn-outline-danger ml-1" data-toggle="modal" data-target="#confirmDeleteModal">Delete</button>
                                    </div>
                                </div>
                            </div>
                            <!-- end card-->


                            <!-- card-->
                            <div class="col">
                                <div class="card" style="width: 100%;">
                                    <img class="card-img-top p-1 mx-auto pt-2" style="width: 10rem;" src="public/product_images/PIONEER.jpeg" />

                                    <div class="card-body pl-4 pr-4 pb-0">
                                        <h6 class="fw-bolder nameProduct">PIONEER SE-S3BT Earphone</h6>
                                        <p class="category">Earphone</p>
                                        <p>Code: SE-S3BT</p>
                                        <div class="d-flex">
                                            <h5 class="fw-bolder price mr-2">9.800.000</h5>
                                            <p class="retail_price">8.780.000</p>
                                        </div>
                                    </div>

                                    <div class="card-footer pt-2 pb-3 pr-4 border-top-0 bg-transparent d-flex justify-content-end">
                                        <button type="button" class="btn btn-outline-success">Edit</button>
                                        <button type="button" class="btn btn-outline-danger ml-1" data-toggle="modal" data-target="#confirmDeleteModal">Delete</button>
                                    </div>
                                </div>
                            </div>
                            <!-- end card-->


                            <!-- card-->
                            <div class="col">
                                <div class="card" style="width: 100%;">
                                    <img class="card-img-top p-1 mx-auto pt-2" style="width: 10rem;" src="public/product_images/PIONEER.jpeg" />

                                    <div class="card-body pl-4 pr-4 pb-0">
                                        <h6 class="fw-bolder nameProduct">PIONEER SE-S3BT Earphone</h6>
                                        <p class="category">Earphone</p>
                                        <p>Code: SE-S3BT</p>
                                        <div class="d-flex">
                                            <h5 class="fw-bolder price mr-2">9.800.000</h5>
                                            <p class="retail_price">8.780.000</p>
                                        </div>
                                    </div>

                                    <div class="card-footer pt-2 pb-3 pr-4 border-top-0 bg-transparent d-flex justify-content-end">
                                        <button type="button" class="btn btn-outline-success">Edit</button>
                                        <button type="button" class="btn btn-outline-danger ml-1" data-toggle="modal" data-target="#confirmDeleteModal">Delete</button>
                                    </div>
                                </div>
                            </div>
                            <!-- end card-->

                            <!-- card-->
                            <div class="col">
                                <div class="card" style="width: 100%;">
                                    <img class="card-img-top p-1 mx-auto pt-2" style="width: 10rem;" src="public/product_images/PIONEER.jpeg" />

                                    <div class="card-body pl-4 pr-4 pb-0">
                                        <h6 class="fw-bolder nameProduct">PIONEER SE-S3BT Earphone</h6>
                                        <p class="category">Earphone</p>
                                        <p>Code: SE-S3BT</p>
                                        <div class="d-flex">
                                            <h5 class="fw-bolder price mr-2">9.800.000</h5>
                                            <p class="retail_price">8.780.000</p>
                                        </div>
                                    </div>

                                    <div class="card-footer pt-2 pb-3 pr-4 border-top-0 bg-transparent d-flex justify-content-end">
                                        <button type="button" class="btn btn-outline-success">Edit</button>
                                        <button type="button" class="btn btn-outline-danger ml-1" data-toggle="modal" data-target="#confirmDeleteModal">Delete</button>
                                    </div>
                                </div>
                            </div>
                            <!-- end card-->

                            <!-- card-->
                            <div class="col">
                                <div class="card" style="width: 100%;">
                                    <img class="card-img-top p-1 mx-auto pt-2" style="width: 10rem;" src="public/product_images/PIONEER.jpeg" />

                                    <div class="card-body pl-4 pr-4 pb-0">
                                        <h6 class="fw-bolder nameProduct">PIONEER SE-S3BT Earphone</h6>
                                        <p class="category">Earphone</p>
                                        <p>Code: SE-S3BT</p>
                                        <div class="d-flex">
                                            <h5 class="fw-bolder price mr-2">9.800.000</h5>
                                            <p class="retail_price">8.780.000</p>
                                        </div>
                                    </div>

                                    <div class="card-footer pt-2 pb-3 pr-4 border-top-0 bg-transparent d-flex justify-content-end">
                                        <button type="button" class="btn btn-outline-success">Edit</button>
                                        <button type="button" class="btn btn-outline-danger ml-1" data-toggle="modal" data-target="#confirmDeleteModal">Delete</button>
                                    </div>
                                </div>
                            </div>
                            <!-- end card-->

                            <!-- card-->
                            <div class="col">
                                <div class="card" style="width: 100%;">
                                    <img class="card-img-top p-1 mx-auto pt-2" style="width: 10rem;" src="public/product_images/PIONEER.jpeg" />

                                    <div class="card-body pl-4 pr-4 pb-0">
                                        <h6 class="fw-bolder nameProduct">PIONEER SE-S3BT Earphone</h6>
                                        <p class="category">Earphone</p>
                                        <p>Code: SE-S3BT</p>
                                        <div class="d-flex">
                                            <h5 class="fw-bolder price mr-2">9.800.000</h5>
                                            <p class="retail_price">8.780.000</p>
                                        </div>
                                    </div>

                                    <div class="card-footer pt-2 pb-3 pr-4 border-top-0 bg-transparent d-flex justify-content-end">
                                        <button type="button" class="btn btn-outline-success">Edit</button>
                                        <button type="button" class="btn btn-outline-danger ml-1" data-toggle="modal" data-target="#confirmDeleteModal">Delete</button>
                                    </div>
                                </div>
                            </div>
                            <!-- end card-->

                            <!-- card-->
                            <div class="col">
                                <div class="card" style="width: 100%;">
                                    <img class="card-img-top p-1 mx-auto pt-2" style="width: 10rem;" src="public/product_images/PIONEER.jpeg" />

                                    <div class="card-body pl-4 pr-4 pb-0">
                                        <h6 class="fw-bolder nameProduct">PIONEER SE-S3BT Earphone</h6>
                                        <p class="category">Earphone</p>
                                        <p>Code: SE-S3BT</p>
                                        <div class="d-flex">
                                            <h5 class="fw-bolder price mr-2">9.800.000</h5>
                                            <p class="retail_price">8.780.000</p>
                                        </div>
                                    </div>

                                    <div class="card-footer pt-2 pb-3 pr-4 border-top-0 bg-transparent d-flex justify-content-end">
                                        <button type="button" class="btn btn-outline-success">Edit</button>
                                        <button type="button" class="btn btn-outline-danger ml-1" data-toggle="modal" data-target="#confirmDeleteModal">Delete</button>
                                    </div>
                                </div>
                            </div>
                            <!-- end card-->

                            <!-- card-->
                            <div class="col">
                                <div class="card" style="width: 100%;">
                                    <img class="card-img-top p-1 mx-auto pt-2" style="width: 10rem;" src="public/product_images/PIONEER.jpeg" />

                                    <div class="card-body pl-4 pr-4 pb-0">
                                        <h6 class="fw-bolder nameProduct">PIONEER SE-S3BT Earphone</h6>
                                        <p class="category">Earphone</p>
                                        <p>Code: SE-S3BT</p>
                                        <div class="d-flex">
                                            <h5 class="fw-bolder price mr-2">9.800.000</h5>
                                            <p class="retail_price">8.780.000</p>
                                        </div>
                                    </div>

                                    <div class="card-footer pt-2 pb-3 pr-4 border-top-0 bg-transparent d-flex justify-content-end">
                                        <button type="button" class="btn btn-outline-success">Edit</button>
                                        <button type="button" class="btn btn-outline-danger ml-1" data-toggle="modal" data-target="#confirmDeleteModal">Delete</button>
                                    </div>
                                </div>
                            </div>
                            <!-- end card-->

                            <!-- card-->
                            <div class="col">
                                <div class="card" style="width: 100%;">
                                    <img class="card-img-top p-1 mx-auto pt-2" style="width: 10rem;" src="public/product_images/PIONEER.jpeg" />

                                    <div class="card-body pl-4 pr-4 pb-0">
                                        <h6 class="fw-bolder nameProduct">PIONEER SE-S3BT Earphone</h6>
                                        <p class="category">Earphone</p>
                                        <p>Code: SE-S3BT</p>
                                        <div class="d-flex">
                                            <h5 class="fw-bolder price mr-2">9.800.000</h5>
                                            <p class="retail_price">8.780.000</p>
                                        </div>
                                    </div>

                                    <div class="card-footer pt-2 pb-3 pr-4 border-top-0 bg-transparent d-flex justify-content-end">
                                        <button type="button" class="btn btn-outline-success">Edit</button>
                                        <button type="button" class="btn btn-outline-danger ml-1" data-toggle="modal" data-target="#confirmDeleteModal">Delete</button>
                                    </div>
                                </div>
                            </div>
                            <!-- end card-->

                        </div>
                    </div>
                </section>
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


        <script src="public/js/feather-icons/feather.min.js"></script>
        <script src="public/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="public/js/app.js"></script>
        <script src="public/js/main.js"></script>
    </body>

    </html>
<?php
else : header("Location:" . _HOST . "home/logout");
endif;
?>
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
                <?php
                require_once(_DIR_ROOT . '/app/Views/modal/ModalTransactionDetails.php');
                ?>
                <div class="container p-5 d-flex justify-content-center">
                    <div class="card col-6">

                        <div class="card-header">
                            <h4 class="card-title">Customer Information</h4>
                        </div>

                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal">
                                    <div class="form-body">
                                        <div class="row">

                                            <!--Phone number-->
                                            <div class="col-md-4">
                                                <label>Mobile</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="number" class="form-control" id="phonenumber" disabled value="<?php echo $customer[0]['phone']; ?>">
                                                        <div class="form-control-icon">
                                                            <i data-feather="phone"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--Name-->
                                            <div class="col-md-4">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" id="name" disabled value="<?php echo $customer[0]['customer_name']; ?>">
                                                        <div class="form-control-icon">
                                                            <i data-feather="user"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--Address-->
                                            <div class="col-md-4">
                                                <label>Address</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="email" class="form-control" id="address" disabled value="<?php echo $customer[0]['address']; ?>">
                                                        <div class="form-control-icon">
                                                            <i data-feather="home"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                require_once("purchase_history.php");
                ?>
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
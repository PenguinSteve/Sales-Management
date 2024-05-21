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
                                                        <input type="number" class="form-control" placeholder="Mobile" id="phonenumber">
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
                                            <div class="col-md-8"> <!--input field-->
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" placeholder="Name" id="name" disabled>
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
                                                        <input type="email" class="form-control" placeholder="Address" id="address" disabled>
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

                <div class="container mt-0 pl-5 pr-5 pt-0 pb-0 d-flex justify-content-center">
                    <div class="card col-6">
                        <div class="card-header">
                            <h4 class="card-title">Order Summary</h4>
                        </div>

                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal">
                                    <div class="form-body">
                                        <div class="row">

                                            <!--Total amount-->
                                            <div class="d-flex justify-content-between">
                                                <label>Total amount</label>
                                                <label id="totalAmount" style="font-weight: bold; color:#5A8DEE; font-size:medium">9.000.000 VND</label>
                                            </div>


                                            <!--The amount of money the customer gives-->
                                            <div class="d-flex justify-content-between">
                                                <div class="col-md-4 mt-3">
                                                    <label>Customer gives</label>
                                                </div>
                                                <div class="col-md-4 mt-2 d-flex justify-content-end">
                                                    <div class="form-group">
                                                        <div class="position-relative">
                                                            <input type="number" class="form-control" id="cusGives">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="divider divider-right mt-1 mb-1">
                                                <div class="divider-text">.</div>
                                            </div>

                                            <!--The amount of money the customer receives back.-->
                                            <div class="d-flex justify-content-between mt-1">
                                                <label>Change</label>
                                                <label id="change" style="font-size: medium;">420.000 VND</label>
                                            </div>

                                            <div class="d-flex justify-content-end mt-3 mb-1">
                                                <button type="button" class="btn btn-primary mr-1 mb-1" data-toggle="modal" data-target="#printInvoice">Print invoice</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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
    </body>

    </html>


    <script>
        $(document).ready(function() {
            $("#phonenumber").keyup(function() {
                if ($(this).val().toString().length == 10) {
                    $("#name").removeAttr("disabled")
                    $("#address").removeAttr("disabled")
                } else {
                    $("#name").attr("disabled", "disabled").val('');
                    $("#address").attr("disabled", "disabled").val('');
                }
            })
        })
    </script>

<?php
else : header("Location:" . _HOST . "home/logout");
endif;
?>
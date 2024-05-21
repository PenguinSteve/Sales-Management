<?php
$isAuthenticated = isset($_SESSION['user']);
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

            <script>
                var sidebarLinks = $('.sidebar-link')

                $('.sidebar-link').each(function() {
                    if ($(this).hasClass('active')) {
                        $(this).removeClass('active')
                    }
                })

                var activeElement = $('a[href="transaction/"]')
                activeElement.closest('li').addClass('active')
            </script>

            <div id="main">
                <div class="main-content container-fluid">
                    <div class="page-title">
                        <div>
                            <h3>Transaction Processing</h3>
                            <p class="text-subtitle text-muted">The added products will be displayed in a listview where you can see the list of products being purchased.</p>

                            <div class="d-flex justify-content-left mt-5">
                                <div class="form-group col-lg-4">
                                    <input type="text" class="form-control" id="basicInput" placeholder="Search or Enter barcode">
                                </div>
                                <a class="btn btn-primary ml-2" style="height: 2.3rem;">Add</a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-light mb-0">
                            <thead>
                                <tr>
                                    <th>Product name</th>
                                    <th>Number of items</th>
                                    <th>Unit price</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <!--Column 1: name-->
                                    <td>Samsung Galaxy A55</td>

                                    <!--Column 2: number of items-->
                                    <td class="d-flex justify-content-center text-bold-500">
                                        <input type="number" class="form-control inputNum">
                                    </td>

                                    <!--Column 3: unit price-->
                                    <td>9.000.000</td>

                                    <!--Column 4: total amount of each product-->
                                    <td>9.000.000</td>

                                    <td>
                                        <button type="button" class="btn btn-outline-danger ml-1">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="d-flex mt-3 justify-content-between">
                            <div class="d-flex" style="margin-left: 23rem;">
                                <h6 class="mr-3 mt-2">Total:</h6>
                                <h4 style="color: #5A8DEE;">1</h4>
                            </div>

                            <div class="d-flex justify-content-end" style="margin-right: 16rem;">
                                <h6 class="mr-3 mt-2">Total:</h6>
                                <h4 style="color: #5A8DEE;">9.000.000</h4>
                            </div>
                        </div>

                        <button type="button" class="btn btn-outline-primary m-5 float-right" id="btnCheckout">Next</button>
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
        document.getElementById("btnCheckout").onclick = function() {
            window.location.href = "transaction/checkout";
        };
    </script>
<?php
else : header("Location:" . _HOST . "home/login");
endif;
?>
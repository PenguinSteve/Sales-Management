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
                <div class="main-content container-fluid">
                    <div class="page-title">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3>List of Customers</h3>
                                <p class="text-subtitle text-muted">View a list of customers.</p>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-light mb-0">
                            <thead>
                                <tr>
                                    <th>MOBILE</th>
                                    <th>NAME</th>
                                    <th>ADDRESS</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                foreach ($customers as $customer) {

                                    echo <<<HTML
                                    <tr>
                                        <td>{$customer['phone']}</td>
                                        <td>{$customer['customer_name']}</td>
                                        <td>{$customer['address']}</td>
                                        <td>
                                            <button id="{$customer['customer_id']}" type="button" class="btn btn-outline-primary">See details</button>
                                        </td>
                                    </tr>
                                    HTML;
                                }
                                ?>
                            </tbody>
                        </table>
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


        <script src="public/js/feather-icons/feather.min.js"></script>
        <script src="public/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="public/js/app.js"></script>
        <script src="public/js/main.js"></script>

        <script>
            $('.btn-outline-primary').on('click', function() {
                idCustomer = $(this).attr('id');

                $.ajax({
                    url: "customer/customer_information/" + idCustomer,
                    method: "POST",
                    success: function(response) {
                        window.location.href = "customer/customer_information/" + idCustomer;
                    },
                    error: function(error) {

                    }
                })
            })



            // document.getElementById("btnSeeDetail").onclick = function() {
            //     window.location.href = "customer/customer_information";
            // };
        </script>
    </body>

    </html>
<?php
else : header("Location:" . _HOST . "home/logout");
endif;
?>
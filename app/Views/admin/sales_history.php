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
                                <h3>Sales History</h3>
                                <p class="text-subtitle text-muted">View sales history of sales staff.</p>
                            </div>
                            <div class="mt-5 mr-4">
                                <p id="name">Sales people: Michael Right</p>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-light mb-0">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Quantity</th>
                                    <th>Total amount</th>
                                    <th>Date of purchase</th>
                                    <th>Customer mobile</th>
                                    <th>Customer Name</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td data-toggle="modal" data-target="#printInvoice">BST-498</td>
                                    <td>1</td>
                                    <td>9.000.000</td>
                                    <td>19/05/2024</td>
                                    <td>0123456789</td>
                                    <td>Nguyen Van A</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <?php require_once 'ModalInvoice.php' ?>

                <script>
                    $(document).ready(function() {
                        $('td').on('click', function() {
                            var td = $(this).closest('tr').children('td');

                            $("#totalAmount").val(td.eq(2).text())
                            $("#customerName").val(td.eq(5).text())
                            $("#salesName").val($("#name").val())
                            $("#date").val(td.eq(3).text())
                        })
                    })
                </script>
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
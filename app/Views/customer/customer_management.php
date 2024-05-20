<?php
require_once(_DIR_ROOT . '/app/Views/layouts/header.php')
?>

<body>
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
                            <tr>
                                <td>0123456789</td>
                                <td>Michael Right</td>
                                <td>132, My Street, Kingston</td>

                                <td>
                                    <button type="button" class="btn btn-outline-primary">See details</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
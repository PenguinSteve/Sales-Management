<?php
$isAuthenticated = (isset($_SESSION['user']) && !isset($_SESSION['isNeedToChangePassword']));
if(isset($_SESSION['isNeedToChangePassword'])){
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

            <script>
                var sidebarLinks = $('.sidebar-link')

                $('.sidebar-link').each(function() {
                    if ($(this).hasClass('active')) {
                        $(this).removeClass('active')
                    }
                })

                var activeElement = $('a[href="statistics/"]')
                activeElement.closest('li').addClass('active')
            </script>

            <div id="main">
                <div class="main-content container-fluid">
                    <div class="page-title">
                        <p class="text-subtitle text-muted ml-5">A good Reporting and Analytics to display statistics</p>
                    </div>

                    <div class="mb-5 d-flex justify-content-end">
                        <!-- Date Range Picker -->
                        <div class="d-flex mr-3">
                            <label for="date" class="col-form-label mr-2" id="labelFrom">From</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="dateFrom">
                            </div>
                        </div>

                        <div class="d-flex">
                            <label for="date" class="col-form-label mr-2" id="labelTo">To</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="dateTo">
                            </div>
                        </div>

                        <select class="form-select" id="selectTime" style="width: 15rem;">
                            <option selected>Timeline</option>
                            <option value="today">Today</option>
                            <option value="yesterday">Yesterday</option>
                            <option value="7days">Last 7 days</option>
                            <option value="month">This month</option>
                            <option value="specific_time">Specific time</option>
                        </select>

                        <script>
                            // show Date Range Picker only when user selects "Specific time"
                            $(document).ready(function() {
                                $("#labelFrom").hide();
                                $("#dateFrom").hide();
                                $("#labelTo").hide();
                                $("#dateTo").hide();

                                $('#selectTime').on('change', function() {
                                    var selectedValue = $(this).val();
                                    console.log(selectedValue)
                                    if (selectedValue != "specific_time") {
                                        $("#labelFrom").hide();
                                        $("#dateFrom").hide();
                                        $("#labelTo").hide();
                                        $("#dateTo").hide();
                                    } else {
                                        $("#labelFrom").show();
                                        $("#dateFrom").show();
                                        $("#labelTo").show();
                                        $("#dateTo").show();
                                    }
                                });
                            });
                        </script>
                    </div>


                    <!--Reporting and Analytics-->
                    <section class="section">

                        <div class="card">
                            <div class="card-body pl-5 pr-5 d-flex justify-content-between">
                                <div>
                                    <h4 class="mt-4">Total profit</h4>
                                </div>

                                <div class="">
                                    <h6>VND</h6>
                                    <h1 class='text-green'>23.682.720</h1>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-9">
                                <?php require_once(_DIR_ROOT . '/app/Views/customer/purchase_history.php') ?>
                            </div>

                            <div class="col-md-3 mt-5">
                                <div class="card ">
                                    <div class="card-header">
                                        <h5>Total amount received</h5>
                                    </div>

                                    <div class="card-body">
                                        <div class="text-center mb-5">
                                            <h6>VND</h6>
                                            <h2 class='text-green'>23.682.720</h2>
                                        </div>
                                    </div>
                                </div>

                                <div class="card ">
                                    <div class="card-header">
                                        <h5>Number of Orders</h5>
                                    </div>

                                    <div class="card-body">
                                        <div class="text-center mb-5">
                                            <h6>up to now</h6>
                                            <h2 class='text-green'>241</h2>
                                        </div>
                                    </div>
                                </div>

                                <div class="card ">
                                    <div class="card-header">
                                        <h5>Number of Products</h5>
                                    </div>

                                    <div class="card-body">
                                        <div class="text-center mb-5">
                                            <h6>up to now</h6>
                                            <h2 class='text-green'>372</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
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
    </body>

    </html>

<?php
else : header("Location:" . _HOST . "home/logout");
endif;
?>
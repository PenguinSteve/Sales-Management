<?php
$isAuthenticated = (isset($_SESSION['user']) && !isset($_SESSION['isNeedToChangePassword']));
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
                <div class="col-md-5 mx-auto">
                    <div class="card pt-5 mt-5 cardLogin">
                        <div class="card-body">

                            <div class="text-center mb-5">
                                <h3>Change Password</h3>
                                <p>Change your password when whenever you want.</p>
                            </div>

                            <form action="" class="m-4">
                                <div class="form-floating mb-3">
                                    <label for="curr_pass" class="form-label">Current password</label>
                                    <input type="password" class="form-control" name="curr_pass" id="curr_pass" required>
                                </div>

                                <div class="form-floating mb-3">
                                    <label for="new_pass" class="form-label">New password</label>
                                    <input type="password" class="form-control" name="pass" id="new_pass" required>
                                </div>

                                <div class="form-floating mb-3">
                                    <label for="confirm_pass" class="form-label">Confirm password</label>
                                    <input type="password" class="form-control" name="confirmPass" id="confirm_pass" required>
                                </div>
                            </form>

                            <button class="btn btn-primary mr-4 mt-4 mb-3 float-right" type="submit">Save</button>
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
        </div>

        <?php require_once(_DIR_ROOT . '/app/Views/layouts/nav.php') ?>

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
<?php
$isAuthenticated = (isset($_SESSION['user']) && isset($_SESSION['isNeedToChangePassword']));
if ($isAuthenticated) :
    $currentUser = $_SESSION['user'];
?>
    <?php
    require_once(_DIR_ROOT . '/app/Views/layouts/header.php')
    ?>

    <body>
        <?php require_once(_DIR_ROOT . '/app/Views/layouts/announce.php') ?>

        <?php require_once(_DIR_ROOT . '/app/Views/layouts/nav.php') ?>
        <div class="col-md-5 mx-auto">
            <div class="card pt-5 mt-5 cardLogin">
                <div class="card-body">

                    <div class="text-center mb-5">
                        <img src="public/images/favicon.svg" height="48" class='mb-4'>
                        <h3>Change Password</h3>
                        <p>Change your password when logging in for the first time.</p>
                    </div>

                    <form action="" class="m-4">
                        <div class="form-floating mb-3">
                            <label for="pass" class="form-label">New password</label>
                            <input type="pass" class="form-control" name="pass" id="pass" required>
                        </div>

                        <div class="form-floating mb-3">
                            <label for="confirmPass" class="form-label">Confirm password</label>
                            <input type="password" class="form-control" name="confirmPass" id="confirmPass" required>
                        </div>
                    </form>

                    <button class="btn btn-primary mr-4 mt-4 mb-3 float-right" type="submit">Confirm</button>
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
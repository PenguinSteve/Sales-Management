<?php
$isAuthenticated = (isset($_SESSION['user']) && isset($_SESSION['isNeedToChangePassword']));
if ($isAuthenticated) :
    $currentUser = $_SESSION['user'];
    $currentUsername = $_SESSION['user']['username'];
?>
    <?php
    require_once(_DIR_ROOT . '/app/Views/layouts/header.php')
    ?>

    <body>
        <?php require_once(_DIR_ROOT . '/app/Views/layouts/nav.php') ?>
        <?php require_once(_DIR_ROOT . '/app/Views/layouts/announce.php') ?>
        <div class="col-md-5 mx-auto">
            <div class="card pt-5 mt-5 cardLogin">
                <div class="card-body">

                    <div class="text-center mb-5">
                        <img src="public/images/favicon.svg" height="48" class='mb-4'>
                        <h3>Change Password</h3>
                        <p>Change your password when logging in for the first time.</p>
                    </div>

                    <form id="changeFirstTime" action="user/saveChangePasswordFirstTime" class="m-4" method="POST">
                        <div class="form-floating mb-3">
                            <label for="pass" class="form-label">New password</label>
                            <input type="password" class="form-control" name="pass" id="pass" required>
                        </div>

                        <div class="form-floating mb-3">
                            <label for="confirmPass" class="form-label">Confirm password</label>
                            <input type="password" class="form-control" name="confirmPass" id="confirmPass" required>
                        </div>

                        <small style="color: red; display: none">New password cannot be empty!</small>
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

    <script>
        $(document).ready(function() {
            $('.btn-primary').click(function() {
                const currUser = <?php echo json_encode($currentUsername); ?>

                if ($("#pass").val() == "") {
                    $("small").show()
                    $("#pass").focus()

                } else if ($("#confirmPass").val() == "") {
                    $("small").html("You need to confirm your password!").show()
                    $("#confirmPass").focus()

                } else if ($("#pass").val() != $("#confirmPass").val()) {
                    $("small").html("Confirmation password is incorrect!").show()
                    $("#confirmPass").focus()

                } else if ($("#pass").val() === currUser) {
                    $("small").html("The new password must not be the same as the username!").show()
                    $("#pass").focus()
                } else {
                    $("#changeFirstTime").submit()
                }
            })
        })
    </script>

    </html>
<?php
else : header("Location:" . _HOST . "home/logout");
endif;
?>
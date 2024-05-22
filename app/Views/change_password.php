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
                <div class="col-md-5 mx-auto">
                    <div class="card pt-5 mt-5 cardLogin">
                        <div class="card-body">

                            <div class="text-center mb-5">
                                <h3>Change Password</h3>
                                <p>Change your password when whenever you want.</p>
                            </div>

                            <form id="changePassForm" action="user/saveChangePassword" method="POST" class="m-4">
                                <div class="form-floating mb-3">
                                    <label for="curr_pass" class="form-label">Current password</label>
                                    <input type="password" class="form-control" name="curr_pass" id="curr_pass" required>
                                </div>

                                <div class="form-floating mb-3">
                                    <label for="new_pass" class="form-label">New password</label>
                                    <input type="password" class="form-control" name="new_pass" id="new_pass" required>
                                </div>

                                <div class="form-floating mb-3">
                                    <label for="confirm_pass" class="form-label">Confirm password</label>
                                    <input type="password" class="form-control" name="confirm_pass" id="confirm_pass" required>
                                </div>
                                <small style="color: red; display: none">New password cannot be empty!</small>
                            </form>
                            <button id="changePassButton" class="btn btn-primary mr-4 mt-4 mb-3 float-right" type="">Save</button>
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


        <script src="public/js/feather-icons/feather.min.js"></script>
        <script src="public/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="public/js/app.js"></script>
        <script src="public/js/main.js"></script>
    </body>
    <script>
        $(document).ready(function() {
            $('#changePassButton').click(function() {

                if ($("#curr_pass").val() == "") {
                    $("small").show()
                    $("#curr_pass").focus()

                } else if ($("#confirm_pass").val() == "") {
                    $("small").html("You need to confirm your password!").show()
                    $("#confirm_pass").focus()

                } else if ($("#new_pass").val() != $("#confirm_pass").val()) {
                    $("small").html("Confirmation password is incorrect!").show()
                    $("#confirmPass").focus()

                } else if ($("#new_pass").val() == $("#curr_pass").val()) {
                    $("small").html("New password must not be the same as current password!").show()
                    $("#confirmPass").focus()

                } else {
                    $("small").hide()
                    $("#changePassForm").submit()
                }
            })
        })
    </script>

    </html>
<?php
else : header("Location:" . _HOST . "home/logout");
endif;
?>
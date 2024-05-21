<?php
require_once(_DIR_ROOT . '/app/Views/layouts/header.php');
require_once(_DIR_ROOT . '/app/Views/layouts/announce.php')
?>

<body>
    <div class="col-md-5 mx-auto">
        <div class="card pt-5 mt-5 cardLogin">
            <div class="card-body">

                <div class="text-center mb-5">
                    <img src="public/images/favicon.svg" height="48" class='mb-4'>
                    <h3>Sign In</h3>
                    <p>Please sign in to continue.</p>
                </div>

                <form action="home/postLogin" method="POST" class="m-4" id="loginForm">
                    <div class="form-floating mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" autocomplete="username">
                    </div>

                    <div class="form-floating mb-3">
                        <label for="pass" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="pass" autocomplete="password">
                        <a href="#" class='float-right'>
                            <small>Forgot password?</small>
                        </a>
                    </div>
                </form>
                <button class="btn btn-primary mr-4 mt-5 mb-3 float-right" id="submitButton" onclick="validate()">Log in</button>
            </div>
        </div>
    </div>


    <script>
        function validate() {
            if ($("#username").val() == "" || $("#pass").val()) {
                <?php $_SESSION['announce'] = "Username and Password cannot be empty" ?>
            } else {
                $('#loginForm').submit();
            }
        }
    </script>
</body>

</html>
<?php
require_once(_DIR_ROOT . '/app/Views/layouts/header.php');
?>

<body>
    <?php require_once(_DIR_ROOT . '/app/Views/layouts/announce.php') ?>
    <div class="col-md-5 mx-auto">
        <div class="card pt-5 mt-5 cardLogin">
            <div class="card-body">

                <div class="text-center mb-5">
                    <img src="public/images/favicon.svg" height="48" class='mb-4'>
                    <h3>Sign In</h3>
                    <p>Please sign in to continue.</p>
                </div>

                <form action="home/checkLogin" method="POST" class="m-4" id="loginForm">
                    <div class="form-floating mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="username" class="form-control" name="username" id="username" required autocomplete="username">
                    </div>

                    <div class="form-floating mb-3">
                        <label for="pass" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="pass" required autocomplete="password">
                    </div>

                    <small style="color: red; display: none">Username and password cannot be empty!</small>
                </form>
                <button class="btn btn-primary mr-4 mt-5 mb-3 float-right" onclick="validate()">Log in</button>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            // $("small").hide()

            $(".btn-primary").click(function(){
                if ($("#username").val() == "" && $("#pass").val() == "") {
                    $("small").show()
                    $("#username").focus();

                } else if ($("#username").val() == "") {
                    $("small").html("Username cannot be empty!");
                    $("small").show()
                    $("#username").focus()
                
                } else if ($("#pass").val() == "") {
                    $("small").html("Password cannot be empty!");
                    $("small").show()
                    $("#pass").focus()

                } else {
                    $("#loginForm").submit()
                }
            })
        })

    </script>
</body>

</html>
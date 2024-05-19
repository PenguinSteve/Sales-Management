<?php
require_once(_DIR_ROOT . '/app/Views/layouts/header.php')
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

                <form action="home/postLogin" method="POST" class="m-4">
                    <div class="form-floating mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="usename" class="form-control" name="username" id="username" required autocomplete="username">
                    </div>

                    <div class="form-floating mb-3">
                        <label for="pass" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="pass" required autocomplete="password">
                        <a href="#" class='float-right'>
                            <small>Forgot password?</small>
                        </a>
                    </div>
                    <button class="btn btn-primary mr-4 mt-5 mb-3 float-right" type="submit">Log in</button>
                </form>
            </div>
        </div>
    </div>

    <?php require_once(_DIR_ROOT . '/app/Views/layouts/announce.php') ?>

</body>

</html>
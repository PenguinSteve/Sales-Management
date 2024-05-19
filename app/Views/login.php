<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone and Accessories</title>

    <link rel="stylesheet" href="public/css/bootstrap.css">
    <link rel="stylesheet" href="public/vendors/chartjs/Chart.min.css">
    <link rel="stylesheet" href="public/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="public/css/app.css">
    <link rel="shortcut icon" href="public/images/favicon.svg" type="image/x-icon">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <div class="col-md-5 mx-auto">
        <div class="card pt-5 mt-5 cardLogin">
            <div class="card-body">

                <div class="text-center mb-5">
                    <img src="public/images/favicon.svg" height="48" class='mb-4'>
                    <h3>Sign In</h3>
                    <p>Please sign in to continue.</p>
                </div>

                <form action="" class="m-4">
                    <div class="form-floating mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="usename" class="form-control" name="username" id="username" required>
                    </div>

                    <div class="form-floating mb-3">
                        <label for="pass" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="pass" required>
                        <a href="auth-forgot-password.html" class='float-right'>
                            <small>Forgot password?</small>
                        </a>
                    </div>
                </form>

                <button class="btn btn-primary mr-4 mt-5 mb-3 float-right" type="submit">Log in</button>
            </div>
        </div>
    </div>

    <script src="public/js/feather-icons/feather.min.js"></script>
    <script src="public/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="public/js/app.js"></script>
    <script src="public/js/main.js"></script>
</body>

</html>
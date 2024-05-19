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
</head>

<body>
    <div id="app">

        <?php require_once('sidebar.php') ?>
        <?php require_once('nav.php') ?>

        <div id="main">
            <?php 
                // require_once ('InformationCustomer.php');
                // require_once ('Products.php');
            ?>
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

</html>
<?php
require_once(_DIR_ROOT . '/app/Views/layouts/header.php')
?>

<body>
    <div id="app">

        <?php require_once(_DIR_ROOT . '/app/Views/layouts/sidebar.php') ?>
        <?php require_once(_DIR_ROOT . '/app/Views/layouts/nav.php') ?>

        <div id="main">
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
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
                <div class="row gx-6 pl-5 align-items-center pt-5 ml-5">

                    <!--image and upload image-->
                    <div class="col-md-4 mr-4 userImg">
                        <img class="card-img-top image image-avatar" src="public/images/avatar/avatar-s-1.png" id="image" onclick="importFile()" />
                        <input type="file" id="fileInput" style="display: none;" onclick="changeAvatar()">
                    </div>

                    <script>
                        function importFile() {
                            $("#fileInput").click()
                        }

                        function changeAvatar() {
                            const file = document.getElementById('fileInput').files[0]

                            if (file) {
                                const reader = new FileReader()
                                reader.onload = function(event) {
                                    $(".image-avatar").attr("src", event.target.result)
                                }
                                reader.readAsDataURL(file)
                            }
                        }
                    </script>


                    <!--information details-->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Your Profile</h4>
                            </div>

                            <div class="card-body">
                                <div class="mb-2 d-flex justify-content-between">
                                    <label for="id" class="col-form-label">ID</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="id" disabled>
                                    </div>
                                </div>

                                <div class="mb-2 d-flex justify-content-between">
                                    <label for="name" class="col-form-label">Full name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="name">
                                    </div>
                                </div>

                                <div class="mb-2 d-flex justify-content-between">
                                    <label for="email" class="col-form-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="email">
                                    </div>
                                </div>

                                <div class="mb-2 d-flex justify-content-between">
                                    <label for="role" class="col-form-label">Role</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="role" disabled>
                                    </div>
                                </div>

                                <div class="mb-2 d-flex justify-content-end">
                                    <button type="button" class="btn btn-outline-success float-right" style="margin-top: 2rem; width: 6rem;">Save</button>
                                </div>
                            </div>
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
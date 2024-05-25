<?php
$isAuthenticated = (isset($_SESSION['user']) && !isset($_SESSION['isNeedToChangePassword']));
if (isset($_SESSION['isNeedToChangePassword'])) {
    header("Location:" . _HOST . "user/changePasswordFirstTime");
    exit();
}
if ($isAuthenticated) :
    $currentUser = $_SESSION['user'];
    if ($currentUser['role'] != 'admin') {
        header("Location:" . _HOST . "home");
        exit();
    }
?>
    <?php
    require_once(_DIR_ROOT . '/app/Views/layouts/header.php')
    ?>

    <body>
        <div id="app">
            <?php require_once(_DIR_ROOT . '/app/Views/layouts/announce.php') ?>
            <?php require_once(_DIR_ROOT . '/app/Views/layouts/sidebar.php') ?>
            <?php require_once(_DIR_ROOT . '/app/Views/layouts/nav.php') ?>

            <div id="main">
                <?php
                require_once(_DIR_ROOT . '/app/Views/admin/ModalAddEmployee.php');
                require_once(_DIR_ROOT . '/app/Views/admin/ModalUpdateEmployee.php');
                require_once(_DIR_ROOT . '/app/Views/modal/ModalDeleteConfirm.php');
                ?>
                <div class="main-content container-fluid">
                    <div class="page-title">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3>Account</h3>
                                <p class="text-subtitle text-muted">View a list of employees.</p>
                            </div>
                            <div class="mt-4"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addEmployee">Add</a></div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-light mb-0">
                            <thead>
                                <tr>
                                    <th>AVATAR</th>
                                    <th>NAME</th>
                                    <th>LOCKED</th>
                                    <th>ACTIVATED</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($users as $user) {


                                    echo "<tr data-user-id = \"" . $user['user_id']
                                        . "\" data-user-username = \"" . $user['username']
                                        . "\" data-user-email = \"" . $user['email']
                                        . "\" data-user-name = \"" . $user['name']
                                        . "\" data-user-avatar = \"" . $user['avatar']
                                        . "\" data-user-role = \"" . $user['role']
                                        . "\" data-user-status = \"" . $user['status']
                                        . "\">";
                                    //Column 1: avatar
                                    $defaultAvatar = $user['avatar'] ? $user['avatar'] : "public/images/avatar/avatar-s-1.png";
                                    echo "<td> <div class=\"avatar avatar-lg mr-3\"> <img src=\"" . $defaultAvatar . "\"> </div> </td>";

                                    //Column 2: name
                                    echo "<td>" . $user['name'] . "</td>";

                                    //Column 3: status account
                                    $statusChecked = $user['status'] === 'locked' ? 'checked' : '';
                                    echo "<td> <div class=\"custom-control custom-checkbox\"> <input type=\"checkbox\" class=\"form-check-input form-check-primary\" " . $statusChecked . " name=\"customCheck\" id=\"{$user['user_id']}\" disabled> </div> </td>";

                                    //Column 4: activated
                                    if ($user['status'] === 'inactive') {
                                        echo "<td><i id=\"{$user['email']}\" class=\"badge-circle badge-circle-light-secondary font-medium-1\" data-feather=\"mail\"></i></td>";
                                    } else {
                                        echo "<td></td>";
                                    }

                                    //Column 5: button
                                    if ($user['role'] != 'admin') {
                                        echo "<td><button type=\"button\" class=\"btn btn-outline-success emp-update\" data-toggle=\"modal\" data-target=\"#updateEmployee\">Edit</button>
                                    </td>";
                                    } else {
                                        echo "<td></td>";
                                    }

                                    //Column 6: button sales history
                                    echo "<td><a href=\"admin/sales_history/{$user['user_id']}\" class=\"btn btn-outline-primary\">Sales History</a></td>";
                                    echo "</tr>";
                                } ?>
                            </tbody>
                        </table>
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


        <script src="public/js/feather-icons/feather.min.js"></script>
        <script src="public/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="public/js/app.js"></script>
        <script src="public/js/main.js"></script>
    </body>

    <script>
        $(document).ready(function() {
            // resend mail
            $(".badge-circle-light-secondary").click(function() {
                var emailUser = $(this).attr("id");
                $.ajax({
                    url: "admin/resendEmail/" + emailUser,
                    method: "POST",
                    success: function(response) {
                        $('body').html(response);
                    },
                    error: function(error) {

                    }
                })
            })

            //add
            $("#saveAdd").click(function() {
                if ($("#name").val() == "") {
                    $("small").show()
                    $("#name").focus()
                } else if ($("#email").val() == "") {
                    $("small").html("Email cannot be empty!").show()
                    $("#email").focus()
                } else {
                    $("#formAdd").submit()
                }
            })

            //update
            $(".emp-update").click(function() {
                var currentRow = $(this).closest("tr");
                var id = $(currentRow).data("user-id");
                var name = $(currentRow).data("user-name");
                var email = $(currentRow).data("user-email");
                var status = $(currentRow).data("user-status");

                $("#update-id").val(id);
                $("#update-name").val(name);
                $("#update-email").val(email);

                if (status == "inactive") {
                    $('#customColorCheck1').hide();
                    return false;
                } else {
                    $('#customColorCheck1').show();
                }

                if (status == "activated") {
                    $('#customColorCheck1').prop('checked', false);
                } else {
                    $('#customColorCheck1').prop('checked', true);
                }

                //confirm-update
                $("#saveUpdate").click(function() {
                    if ($('#customColorCheck1').prop('checked')) {
                        $status = "locked";
                    } else {
                        $status = "activated";
                    }

                    $.ajax({
                        url: 'admin/updateUserStatus',
                        method: 'POST',
                        data: {
                            status: $status,
                            email: $(currentRow).data("user-email"),
                        },
                        success: function() {
                            location.reload();
                        },
                    });

                })
            })
        })
    </script>

    </html>
<?php
else : header("Location:" . _HOST . "home/logout");
endif;
?>
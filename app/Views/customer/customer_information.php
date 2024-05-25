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
                <?php
                require_once(_DIR_ROOT . '/app/Views/modal/ModalTransactionDetails.php');
                ?>
                <div class="container p-5 d-flex justify-content-center">
                    <div class="card col-6">

                        <div class="card-header">
                            <h4 class="card-title">Customer Information</h4>
                        </div>

                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal">
                                    <div class="form-body">
                                        <div class="row">

                                            <!--Phone number-->
                                            <div class="col-md-4">
                                                <label>Mobile</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="number" class="form-control nunito" id="phonenumber" disabled value="<?php echo $customer[0]['phone']; ?>">
                                                        <div class="form-control-icon">
                                                            <i data-feather="phone"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--Name-->
                                            <div class="col-md-4">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" id="name" disabled value="<?php echo $customer[0]['customer_name']; ?>">
                                                        <div class="form-control-icon">
                                                            <i data-feather="user"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--Address-->
                                            <div class="col-md-4">
                                                <label>Address</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="email" class="form-control" id="address" disabled value="<?php echo $customer[0]['address']; ?>">
                                                        <div class="form-control-icon">
                                                            <i data-feather="home"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                require_once("purchase_history.php");
                ?>
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
            $.ajax({
                url: "customer/getTransactionHistory/" + "<?php echo $customer[0]['phone']; ?>",
                method: "POST",
                dataType: "json",
                success: function(response) {
                    let html = "";
                    response.forEach(transaction => {
                        //Format date
                        let date = new Date(transaction['transaction_date']);
                        let day = date.getDate();
                        let month = date.getMonth() + 1;
                        let year = date.getFullYear();
                        let hours = date.getHours();
                        let minutes = date.getMinutes();
                        let seconds = date.getSeconds();

                        day = (day < 10) ? '0' + day : day;
                        month = (month < 10) ? '0' + month : month;
                        hours = (hours < 10) ? '0' + hours : hours;
                        minutes = (minutes < 10) ? '0' + minutes : minutes;
                        seconds = (seconds < 10) ? '0' + seconds : seconds;

                        let formattedDate = day + '/' + month + '/' + year + ' ' + hours + ':' + minutes + ':' + seconds;
                        html +=
                            `
                            <tr>
                                <td>${transaction['transaction_id']}</td>
                                <td class="nunito">${transaction['total_amount']}</td>
                                <td class="nunito">${transaction['amount_receive']}</td>
                                <td class="nunito">${transaction['amount_back']}</td>
                                <td class="nunito">${formattedDate}</td>
                                <td>${transaction['total_quantity']}</td>
                                <td>
                                    <button id="${transaction['transaction_id']}" type="button" class="detail-transaction btn btn-outline-primary">See details</button>
                                </td>
                            </tr>
                        `;
                    });
                    $("#purchase_history").html(html);
                },
                error: function(error) {
                    console.log(error);
                }
            });

            $(document).on("click", ".detail-transaction", function() {
                let transaction_id = $(this).attr("id");
                $.ajax({
                    url: "customer/getTransactionDetail/" + transaction_id,
                    method: "POST",
                    dataType: "json",
                    success: function(response) {

                        //Format date
                        let date = new Date(response[0]['transaction_date']);
                        let day = date.getDate();
                        let month = date.getMonth() + 1;
                        let year = date.getFullYear();
                        let hours = date.getHours();
                        let minutes = date.getMinutes();
                        let seconds = date.getSeconds();

                        day = (day < 10) ? '0' + day : day;
                        month = (month < 10) ? '0' + month : month;
                        hours = (hours < 10) ? '0' + hours : hours;
                        minutes = (minutes < 10) ? '0' + minutes : minutes;
                        seconds = (seconds < 10) ? '0' + seconds : seconds;

                        let formattedDate = day + '/' + month + '/' + year + ' ' + hours + ':' + minutes + ':' + seconds;

                        //Fill data to modal
                        $("#date").text(formattedDate);
                        $("#customerName").text(response[0]['customer_name']);
                        $("#customerPhone").text(response[0]['customer_phone']);
                        $("#staffName").text(response[0]['name']);
                        $("#totalAmountModal").text((response[0]['total_amount']).toLocaleString('vi-VN') + " VND");

                        //Clear old data
                        $(".modal-body").empty();
                        $(".modal-body").append(
                            `
                            <div class="d-flex justify-content-between">
                                <p>Product</p>
                                <p>Quantity</p>
                                <p>Unit price</p>
                            </div>
                            `);

                        //Fill transaction detail
                        response.forEach(transaction_detail => {
                            $(".modal-body").append(
                                `
                                <div class="d-flex justify-content-between">
                                    <p>${transaction_detail['product_name']}</p>
                                    <p>${transaction_detail['quantity']}</p>
                                    <p class="nunito">${transaction_detail['price']}</p>
                                </div>
                                `);
                        });

                        $("#InvoiceModal").modal("show");
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        })
    </script>

    </html>

<?php
else : header("Location:" . _HOST . "home/logout");
endif;
?>
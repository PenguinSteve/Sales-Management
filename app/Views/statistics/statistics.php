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

            <script>
                $('.sidebar-link').removeClass('active');
                $('a[href="statistics/"]').closest('li').addClass('active')
            </script>

            <div id="main">
                <div class="main-content container-fluid">
                    <div class="page-title">
                        <p class="text-subtitle text-muted ml-5">A good Reporting and Analytics to display statistics</p>
                    </div>

                    <div class="mb-1 d-flex justify-content-end">
                        <!-- Date Range Picker -->
                        <div class="d-flex mr-3">
                            <label for="date" class="col-form-label mr-2" id="labelFrom" style="display: none;">From</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="dateFrom" style="display: none;">
                            </div>
                        </div>

                        <div class="d-flex">
                            <label for="date" class="col-form-label mr-2" id="labelTo" style="display: none;">To</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="dateTo" style="display: none;">
                            </div>
                        </div>

                        <select class="form-select" id="selectTime" style="width: 15rem;">
                            <option value="overall" selected>Overall</option>
                            <option value="today">Today</option>
                            <option value="yesterday">Yesterday</option>
                            <option value="7days">Last 7 days</option>
                            <option value="month">This month</option>
                            <option value="specific_time">Specific time</option>
                        </select>

                        <script>
                            // show Date Range Picker only when user selects "Specific time"
                            $(document).ready(function() {
                                $('#selectTime').on('change', function() {
                                    var selectedValue = $(this).val();
                                    console.log(selectedValue)
                                    if (selectedValue != "specific_time") {
                                        $("#labelFrom").hide();
                                        $("#dateFrom").hide();
                                        $("#labelTo").hide();
                                        $("#dateTo").hide();
                                    } else {
                                        $("#labelFrom").show();
                                        $("#dateFrom").show();
                                        $("#labelTo").show();
                                        $("#dateTo").show();
                                    }
                                });
                            });
                        </script>
                    </div>

                    <div class="d-flex justify-content-center mb-5">
                        <small style="color: red; display: none">Ngày kết thúc không được nhỏ hơn ngày bắt đầu!</small>
                    </div>

                    <!--Reporting and Analytics-->
                    <section class="section">
                        <?php
                        if ($currentUser['role'] === 'admin') :
                            echo '<div class="card">
                            <div class="card-body pl-5 pr-5 d-flex justify-content-between">
                                <div>
                                    <h4 class="mt-4">Total profit</h4>
                                </div>

                                <div class="">
                                    <h6>VND</h6>
                                    <h1 id="totalProfit" class="text-green nunito">0</h1>
                                </div>
                            </div>
                        </div>';
                        endif;
                        ?>

                        <div class="row mb-2">
                            <div class="col-md-9">
                                <?php require_once(_DIR_ROOT . '/app/Views/customer/purchase_history.php') ?>
                            </div>

                            <div class="col-md-3 mt-5">
                                <div class="card ">
                                    <div class="card-header">
                                        <h5>Total amount received</h5>
                                    </div>

                                    <div class="card-body">
                                        <div class="text-center mb-5">
                                            <h6>VND</h6>
                                            <h3 class='text-green nunito' id="amountReceived"></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="card ">
                                    <div class="card-header">
                                        <h5>Number of Orders</h5>
                                    </div>

                                    <div class="card-body">
                                        <div class="text-center mb-5">
                                            <h6>up to now</h6>
                                            <h2 class='text-green nunito' id="orders"></h2>
                                        </div>
                                    </div>
                                </div>

                                <div class="card ">
                                    <div class="card-header">
                                        <h5>Number of Products</h5>
                                    </div>

                                    <div class="card-body">
                                        <div class="text-center mb-5">
                                            <h6>up to now</h6>
                                            <h2 class='text-green nunito' id="products"></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
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

        <?php require(_DIR_ROOT . '/app/Views/modal/ModalTransactionDetails.php') ?>
        <script src="public/js/feather-icons/feather.min.js"></script>
        <script src="public/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="public/js/app.js"></script>
        <script src="public/js/main.js"></script>
    </body>

    <script>
        $(document).ready(function() {
            loadPage()

            function loadPage() {
                $("#totalProfit").text(<?php echo json_encode($statistics["total"]) ?>)
                $("#amountReceived").text(<?php echo json_encode($statistics["received"]) ?>)
                $("#orders").text(<?php echo json_encode($statistics["order"]) ?>)
                $("#products").text(<?php echo json_encode($statistics["products"]) ?>)

                $('tbody').empty()

                var orders = (<?php echo json_encode($statistics["orders"]) ?>)

                $.each(orders, function(key, value) {
                    var order = orders[key]

                    var newRow = "<tr id=\"" + order['transaction_id'] + "\">" +
                        "<td class=\"nunito\">" + order['transaction_id'] + "</td>" +
                        "<td class=\"nunito\">" + order['total_amount'].toLocaleString('vi-VN') + " VND</td>" +
                        "<td class=\"nunito\">" + order['amount_receive'].toLocaleString('vi-VN') + " VND</td>" +
                        "<td class=\"nunito\">" + order['amount_back'].toLocaleString('vi-VN') + " VND</td>" +
                        "<td class=\"nunito\">" + order['transaction_date'] + "</td>" +
                        "<td class=\"nunito\">" + order['total_quantity'] + "</td>" +
                        "</tr>";

                    $("tbody").append(newRow)
                })
            }


            var selectedValue_1
            var selectedValue_2 = 'null'
            var type

            $('#selectTime').change(function() {
                type = $(this).val()
                selectedValue_1 = $(this).val()
                getStatistics()
            })

            $('#dateFrom').on('change', function() {
                selectedValue_1 = $(this).val();
                validateDay()
            })

            $('#dateTo').on('change', function() {
                selectedValue_2 = $(this).val();
                validateDay()
            })

            function validateDay() {
                if (selectedValue_1 != null && selectedValue_2 != null && selectedValue_1 > selectedValue_2) {
                    $("small").show()
                } else {
                    $("small").hide()
                    getStatistics()
                }
            }


            function getStatistics() {
                if (selectedValue_1 == "overall") {
                    loadPage()
                } else {
                    $.ajax({
                        url: "statistics/getStatistics/" + type + "/" + selectedValue_1 + "/" + selectedValue_2,
                        method: "POST",
                        success: function(response) {
                            response = JSON.parse(response)

                            $("#totalProfit").text(response['total'])
                            $("#amountReceived").text(response['received'])
                            $("#orders").text(response['order'])
                            $("#products").text(response['products'])

                            $('tbody').empty();
                            $.each(response['orders'], function(key, value) {
                                var order = response['orders'][key]

                                //Format date
                                let date = new Date(order['transaction_date']);
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

                                var newRow = "<tr id=\"" + order['transaction_id'] + "\">" +
                                    "<td class=\"nunito\">" + order['transaction_id'] + "</td>" +
                                    "<td class=\"nunito\">" + order['total_amount'].toLocaleString('vi-VN') + " VND</td>" +
                                    "<td class=\"nunito\">" + order['amount_receive'].toLocaleString('vi-VN') + " VND</td>" +
                                    "<td class=\"nunito\">" + order['amount_back'].toLocaleString('vi-VN') + " VND</td>" +
                                    "<td class=\"nunito\">" + formattedDate + "</td>" +
                                    "<td class=\"nunito\">" + order['total_quantity'] + "</td>" +
                                    "</tr>";

                                $("tbody").append(newRow)
                            })
                        },
                        error: function(error) {
                            alert(error)
                        }
                    })
                }
            }

            $("table").on("click", "tbody tr", function() {
                var idOrder = $(this).attr('id')

                $.ajax({
                    url: "statistics/orderDetails/" + idOrder,
                    method: "POST",
                    success: function(response) {
                        response = JSON.parse(response)

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
                        $("#date").text(formattedDate)
                        $("#customerName").text(response[0]['customer_name'])
                        $("#customerPhone").text(response[0]['customer_phone'])
                        $("#staffName").text(response[0]['name'])
                        $("#totalAmountModal").text((response[0]['total_amount']).toLocaleString('vi-VN') + " VND")

                        // remove all <div> in modal-body except the first <div>
                        var elementsToRemove = $('.modal-body').children(':not(:first-child)')
                        elementsToRemove.remove()

                        $.each(response, function(key, value) {
                            var order = response[key]

                            $(".modal-body").append(

                                `
                                <div class="row">
                                    <div class="col">
                                        <p class="nunito">${order['product_id']}</p>
                                    </div>
                                    <div class="col">
                                        <p class="nunito">${order['product_name']}</p>
                                    </div>
                                    <div class="col">
                                        <p class="text-center nunito">${order['quantity']}</p>
                                    </div>
                                    <div class="col">
                                        <p class="text-center nunito">${order['price']}</p>
                                    </div>
                                </div>
                                
                                `);

                        })

                        $('#InvoiceModal').modal('show')
                    },
                    error: function(error) {}
                })
            })
        })
    </script>

    </html>

<?php
else : header("Location:" . _HOST . "home/logout");
endif;
?>
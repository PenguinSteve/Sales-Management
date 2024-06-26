<?php
$isAuthenticated = (isset($_SESSION['user']) && !isset($_SESSION['isNeedToChangePassword']));
if (isset($_SESSION['isNeedToChangePassword'])) {
    header("Location:" . _HOST . "user/changePasswordFirstTime");
    exit();
}
if ($isAuthenticated) :
    if (!isset($_SESSION['cart']) || count($_SESSION['cart']['products']) == 0 || $_SESSION['cart']['totalAmount'] == 0 || $_SESSION['cart']['totalProducts'] == 0) {
        $_SESSION['announce'] = "Chưa có sản phẩm trong giỏ hàng";
        header('Location: ' . _HOST . 'transaction');
        exit();
    }
    $currentUser = $_SESSION['user'];
?>
    <?php
    require_once(_DIR_ROOT . '/app/Views/layouts/header.php')
    ?>

    <body>

        <div id="app">
            <?php require_once(_DIR_ROOT . '/app/Views/layouts/nav.php') ?>
            <?php
            require_once(_DIR_ROOT . '/app/Views/layouts/sidebar.php')
            ?>

            <div id="main">
                <?php
                require_once(_DIR_ROOT . '/app/Views/modal/ModalTransactionDetails.php');
                ?>
                <?php require_once(_DIR_ROOT . '/app/Views/layouts/announce.php') ?>

                <div class="container p-5 d-flex justify-content-center" id="InforCard">
                    <div class="card col-6">

                        <div class="card-header">
                            <h4 class="card-title">Customer Information</h4>
                            <small style="color: red; display: none; margin-bottom: 3px" id="warningInformationCustomer">Hãy nhập số điện thoại khách hàng!</small>
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
                                                        <input type="number" class="form-control nunito" placeholder="Mobile" id="phone" name="phone">
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
                                            <div class="col-md-8"> <!--input field-->
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control nunito" placeholder="Name" id="name" name="name" disabled>
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
                                                        <input type="text" class="form-control nunito" placeholder="Address" id="address" name="address" disabled>
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

                <div class="container mt-0 pl-5 pr-5 pt-0 pb-0 d-flex justify-content-center">
                    <div class="card col-6">
                        <div class="card-header">
                            <h4 class="card-title">Order Summary</h4>
                        </div>

                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal">
                                    <div class="form-body">
                                        <div class="row">

                                            <!--Total amount-->
                                            <div class="d-flex justify-content-between">
                                                <label>Total amount</label>
                                                <label id="totalAmount" style="font-weight: bold; color:#5A8DEE; font-size:medium" class="nunito"></label>
                                            </div>


                                            <!--The amount of money the customer gives-->
                                            <div class="d-flex justify-content-between">
                                                <div class="col-md-4 mt-3">
                                                    <label>Customer gives</label>
                                                </div>
                                                <div class="col-md-4 mt-2 d-flex justify-content-end">
                                                    <div class="form-group">
                                                        <div class="position-relative">
                                                            <input type="number" class="form-control nunito" id="cusGives">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <small style="color: red; display: none; margin-bottom: 3px" id="warningOrderSummary">Không được để trống trường thông tin!</small>

                                            <div class="divider divider-right mt-1 mb-1">
                                                <div class="divider-text">.</div>
                                            </div>

                                            <!--The amount of money the customer receives back.-->
                                            <div class="d-flex justify-content-between mt-1">
                                                <label>Change</label>
                                                <label id="change" style="font-size: medium;" class="nunito"></label>
                                            </div>

                                            <div class="d-flex justify-content-end mt-3 mb-1">
                                                <button type="button" class="btn btn-primary mr-1 mb-1" data-toggle="modal" data-target="#printInvoice" id="printInvoiceBtn">Print invoice</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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

        <script src="public/js/feather-icons/feather.min.js"></script>
        <script src="public/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="public/js/app.js"></script>
        <script src="public/js/main.js"></script>
    </body>

    </html>


    <script>
        $(document).ready(function() {

            //Get total amount of cart
            var totalAmount = <?php echo $_SESSION['cart']['totalAmount'] ?>;
            $('#totalAmount').text((totalAmount).toLocaleString('vi-VN') + " VND");
            $('#totalAmountModal').text((totalAmount).toLocaleString('vi-VN') + " VND");

            //Get customer information by phone number
            $("#phone").keyup(function() {
                if ($(this).val().toString().length == 10) {
                    $.ajax({
                        url: 'transaction/searchCustomer',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            phone: $(this).val()
                        },
                        success: function(response) {
                            if (response.length > 0) {
                                $("#name").val(response[0].customer_name)
                                $("#address").val(response[0].address)
                                $("#warningInformationCustomer").hide()
                            } else {
                                $("#warningInformationCustomer").html("Hãy tạo khách hàng mới!").show()
                                $("#name").val('')
                                $("#address").val('')
                                $("#name").removeAttr("disabled")
                                $("#address").removeAttr("disabled")
                            }
                        }
                    })
                } else {
                    $("#name").attr("disabled", "disabled").val('');
                    $("#address").attr("disabled", "disabled").val('');
                }

                if (("#name").val() != "" && $("#address").val() != "") {
                    $('small').hide()
                }
            })

            //Prevent input phone number more than 10 characters
            $(document).on('input', '#phone', function() {
                var value = $(this).val();
                if (value.length > 10) {
                    $(this).val(value.slice(0, 10));
                }
            });

            //Prevent input customer gives less than 1 and empty
            $(document).on('input', '#cusGives', function() {
                var value = $(this).val();
                if (value < 1) {
                    $(this).val(totalAmount);
                }

                var change = value - totalAmount;
                if (change < 0) {
                    $('#change').text("0 VND");
                } else {
                    $('#change').text(change.toLocaleString('vi-VN') + " VND");
                }
            });

            //Validate invoice

            $('#printInvoiceBtn').on('click', function(e) {
                if ($('#phone').val() == '') {
                    $("#warningInformationCustomer").show()
                    $("html").animate({
                        scrollTop: $("#InforCard").offset().top
                    }, "fast");
                    e.preventDefault();

                } else if ($('#phone').val().length < 10) {
                    $("#warningInformationCustomer").html("Số điện thoại không hợp lệ!").show()
                    $("html").animate({
                        scrollTop: $("#InforCard").offset().top
                    }, "fast");
                    e.preventDefault();

                } else if ($('#name').val() == '' || $('#address').val() == '') {
                    $("#warningInformationCustomer").html("Hãy nhập đầy đủ thông tin khách hàng!").show()
                    $("html").animate({
                        scrollTop: $("#InforCard").offset().top
                    }, "fast");
                    e.preventDefault();

                } else if ($('#cusGives').val() == '') {
                    $("#warningOrderSummary").show()
                    e.preventDefault();

                } else if ($('#cusGives').val() < totalAmount) {
                    $("#warningOrderSummary").html("Số tiền khách đưa không hợp lệ!").show()
                    e.preventDefault();

                } else {
                    //Format date
                    let now = new Date();
                    let date = now.toLocaleDateString('vi-VN');
                    let time = now.toLocaleTimeString('vi-VN');
                    $('#date').text(date + ' ' + time);

                    //Fill data to invoice modal
                    $('#customerName').text($('#name').val());
                    $('#totalAmountModal').text($('#totalAmount').text());
                    $('#customerPhone').text($('#phone').val());
                    $('#staffName').text('<?php echo $currentUser['name'] ?>');

                    //Fill products to invoice modal
                    var products = <?php echo json_encode($_SESSION['cart']['products']); ?>;
                    $('.modal-body .product').empty();
                    products.forEach(function(product) {
                        var total = product.quantity * product.retail_price;
                        $(".modal-body").append(
                                `
                                <div class="row">
                                    <div class="col">
                                        <p class="nunito">${product.product_id}</p>
                                    </div>
                                    <div class="col">
                                        <p class="nunito">${product.product_name}</p>
                                    </div>
                                    <div class="col">
                                        <p class="text-center nunito">${product.quantity}</p>
                                    </div>
                                    <div class="col">
                                        <p class="text-center nunito">${total}</p>
                                    </div>
                                </div>
                                
                                `);
                    });

                    //Save transaction
                    $.ajax({
                        url: 'transaction/saveTransaction',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            customer: {
                                name: $('#name').val(),
                                address: $('#address').val(),
                                phone: $('#phone').val()
                            },
                            cusGives: $('#cusGives').val(),
                            products: products,
                            date: $('#date').text()
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                $('#InvoiceModal').modal('show');

                                $('#InvoiceModal').on('shown.bs.modal', function(e) {
                                    //Print invoice as pdf
                                    var modalContent = document.querySelector('#InvoiceModal');

                                    html2canvas(modalContent).then(function(canvas) {
                                        var imgData = canvas.toDataURL('image/png');

                                        // Create a new jsPDF instance
                                        var pdf = new jsPDF('p', 'mm', 'a4');

                                        var imgProps = pdf.getImageProperties(imgData);
                                        var scale = 1.7;
                                        var pdfWidth = (pdf.internal.pageSize.getWidth())*scale;
                                        var pdfHeight = ((imgProps.height * pdfWidth) / imgProps.width)*scale;

                                        pdf.addImage(imgData, 'PNG', (pdf.internal.pageSize.getWidth() - pdfWidth) / 2, (pdf.internal.pageSize.getHeight() - pdfHeight) / 2, pdfWidth, pdfHeight);

                                        // Save the PDF
                                        pdf.save('invoice.pdf');
                                    });
                                });
                            } else {
                                window.location.href = "transaction/checkout";
                            }
                        }
                    })
                }
            });

            //Header to transaction process when close invoice modal
            $('#InvoiceModal').on('hidden.bs.modal', function(e) {
                window.location.href = "transaction";
            });
        })
    </script>

<?php
else : header("Location:" . _HOST . "home/logout");
endif;
?>
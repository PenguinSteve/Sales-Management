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
                $('a[href="transaction/"]').closest('li').addClass('active')
            </script>

            <div id="main">

                <div class="main-content container-fluid">
                    <div class="page-title">
                        <div>
                            <h3>Transaction Processing</h3>
                            <p class="text-subtitle text-muted">The added products will be displayed in a listview where you can see the list of products being purchased.</p>

                            <div class="d-flex justify-content-left mt-5">
                                <div class="form-group col-lg-4">
                                    <input type="text" class="form-control" id="searchProduct" placeholder="Search or Enter barcode">
                                </div>

                                <?php
                                if (isset($cart['totalProducts']) && isset($cart['totalAmount'])) {
                                    $totalProducts = $cart['totalProducts'];
                                    $totalAmount = $cart['totalAmount'];
                                } else {
                                    $totalProducts = 0;
                                    $totalAmount = 0;
                                }
                                ?>
                                <div class="d-flex mt-1 justify-content-between ">
                                    <div class="d-flex">
                                        <h6 class="mr-3 mt-1" style="margin-left: 6.5rem;">Total product:</h6>
                                        <h4 style="color: #5A8DEE;" id="totalProducts" class="nunito"><?php echo $totalProducts ?></h4>
                                    </div>

                                    <div class="d-flex justify-content-end" style="margin-left: 9rem;">
                                        <h6 class="mr-3 mt-1">Total amount:</h6>
                                        <h4 style="color: #5A8DEE;" id="totalAmount" class="nunito"><?php echo $totalAmount ?> VND</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="suggested-products">
                                <div class="product-list" id="product-list">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="table-responsive" id="cart">
                        <table class="table table-light mb-0">
                            <thead>
                                <tr>
                                    <th>Product id</th>
                                    <th>Product name</th>
                                    <th>Number of items</th>
                                    <th>Unit price</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                if (isset($_SESSION['cart'])) {
                                    $cart = $_SESSION['cart'];
                                    foreach ($cart['products'] as $product) {
                                        echo '<tr data-product-id="' . $product['product_id'] . '" data-product-name="' . $product['product_name'] . '" data-retail-price="' . $product['retail_price'] . '">' +
                                            '<td class="nunito">' . $product['product_id'] . '</td>' +
                                            '<td class="nunito">' . $product['product_name'] . '</td>' +
                                            '<td class="d-flex justify-content-center text-bold-500"><input type="number" class="form-control inputNum nunito" min="1" value="' . $product['quantity'] . '"></td>' +
                                            '<td class="nunito">' . $product['retail_price'] . '</td>' +
                                            '<td class="nunito total-price">' . $product['retail_price'] * $product['quantity'] . '</td>' +
                                            '<td><button type="button" class="btn btn-outline-danger ml-1">Delete</button></td>' +
                                            '</tr>';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>



                        <button type="button" class="btn btn-outline-primary m-5 float-right" id="btnCheckout">Next</button>
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

            //Button checkout
            $("#btnCheckout").on('click', function() {
                var cart = [];
                var totalProducts = 0;
                var totalAmount = 0;

                $('tbody tr').each(function() {
                    var product_id = $(this).data('product-id');
                    var product_name = $(this).data('product-name');
                    var retail_price = $(this).data('retail-price');
                    var quantity = $(this).find('input.inputNum').val();

                    cart.push({
                        product_id: product_id,
                        product_name: product_name,
                        retail_price: retail_price,
                        quantity: quantity,
                    });

                    totalProducts += parseInt(quantity);
                    totalAmount += parseInt(quantity * retail_price);
                });

                $.ajax({
                    url: 'transaction/checkout',
                    method: 'POST',
                    data: {
                        cart: cart,
                        totalProducts: totalProducts,
                        totalAmount: totalAmount
                    },
                    success: function() {
                        window.location.href = "transaction/checkout";
                    }
                });
            });

            //Suggestions for products when searching
            $('#searchProduct').on('input', function() {
                var productListView = $('#product-list');
                productListView.empty();
                var text = $(this).val()
                if (!text == "") {
                    $.ajax({
                        url: 'transaction/searchProduct',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            text: text
                        },
                        success: function(response) {
                            var productListView = $('#product-list');

                            productListView.empty();
                            response.forEach(product => {
                                productListView.append('<div class="product-item" data-product-id="' + product.product_id + '" data-product-name="' + product.product_name + '" data-retail-price="' + product.retail_price + '"><p class="nunito">' + product.product_name + ' - Giá: ' + product.retail_price + '</p></div>')
                            })
                        }
                    })
                }
            })

            //Add product to cart when click on product item on suggestion list
            $(document).on('click', '.product-item', function() {
                var productId = $(this).data('product-id');
                var productName = $(this).data('product-name');
                var retailPrice = $(this).data('retail-price');

                var existingProduct = $('tbody').find('tr[data-product-id="' + productId + '"]');
                // Check if the product is already in the cart
                if (existingProduct.length > 0) {
                    var quantity = existingProduct.find('input.inputNum');
                    quantity.val(parseInt(quantity.val()) + 1);

                    var totalPrice = existingProduct.find('td.total-price');
                    totalPrice.text(parseInt(quantity.val()) * retailPrice);
                } else {

                    // The product is not in the cart, add a new row
                    var newRow = '<tr data-product-id="' + productId + '" data-product-name="' + productName + '" data-retail-price="' + retailPrice + '">' +
                        '<td class="nunito">' + productId + '</td>' +
                        '<td class="nunito">' + productName + '</td>' +
                        '<td class="d-flex justify-content-center text-bold-500"><input type="number" class="form-control inputNum nunito" min="1" value="1"></td>' +
                        '<td class="nunito">' + retailPrice + '</td>' +
                        '<td class="total-price nunito">' + retailPrice + '</td>' +
                        '<td><button type="button" class="btn btn-outline-danger ml-1">Delete</button></td>' +
                        '</tr>';
                    $('tbody').append(newRow);
                }

                // Update total products
                var totalProducts = parseInt($('#totalProducts').text());
                $('#totalProducts').text(totalProducts + 1);

                // Update total amount
                var totalAmount = parseInt($('#totalAmount').text().replace(/\./g, ''));
                $('#totalAmount').text((totalAmount + retailPrice).toLocaleString('vi-VN'));
            });

            //Prevent input quantity less than 1
            $(document).on('input', '.inputNum', function() {
                var value = $(this).val();
                if (value < 1 || value == '') {
                    $(this).val(1);
                }
            });

            //Update total amount when change quantity of product
            $('tbody').on('change', '.inputNum', function() {
                var quantity = $(this).val();
                var price = $(this).closest('tr').data('retail-price');
                var totalPrice = quantity * price;
                $(this).closest('tr').find('.total-price').text(totalPrice.toLocaleString('vi-VN'));

                // Update total amount
                var totalAmount = 0;
                $('.total-price').each(function() {
                    totalAmount += parseInt($(this).text().replace(/\./g, ''));
                });
                $('#totalAmount').text(totalAmount.toLocaleString('vi-VN'));

                // Update total products
                var totalProducts = 0;
                $('.inputNum').each(function() {
                    totalProducts += parseInt($(this).val());
                });
                $('#totalProducts').text(totalProducts);
            });

            //Remove product from cart
            $('tbody').on('click', '.btn-outline-danger', function() {
                // Get the quantity of the product in the row
                var quantity = parseInt($(this).closest('tr').find('.inputNum').val());

                // Remove the row
                $(this).closest('tr').remove();

                // Update total products
                var totalProducts = parseInt($('#totalProducts').text());
                $('#totalProducts').text(totalProducts - quantity);

                // Update total amount
                var totalAmount = 0;
                $('.total-price').each(function() {
                    totalAmount += parseInt($(this).text().replace(/\./g, ''));
                });
                $('#totalAmount').text(totalAmount.toLocaleString('vi-VN'));
            });
        })
    </script>
<?php
else : header("Location:" . _HOST . "home/logout");
endif;
?>
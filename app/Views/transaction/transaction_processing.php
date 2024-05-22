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
                var sidebarLinks = $('.sidebar-link')

                $('.sidebar-link').each(function() {
                    if ($(this).hasClass('active')) {
                        $(this).removeClass('active')
                    }
                })

                var activeElement = $('a[href="transaction/"]')
                activeElement.closest('li').addClass('active')
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
                            </div>

                            <div class="suggested-products">
                                <div class="product-list" id="product-list">
                                    <!-- Each product item can be structured like this -->
                                    <div class="product-item">
                                        <p>Product Name</p>
                                    </div>
                                    <div class="product-item">
                                        <p>Product Name</p>
                                    </div>
                                    <div class="product-item">
                                        <p>Product Name</p>
                                    </div>
                                    <div class="product-item">
                                        <p>Product Name</p>
                                    </div>
                                    <!-- Repeat the product item structure for each suggested product -->
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="table-responsive" id="cart">
                        <table class="table table-light mb-0">
                            <thead>
                                <tr>
                                    <th>Product name</th>
                                    <th>Number of items</th>
                                    <th>Unit price</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <!--Column 1: name-->
                                    <td>Samsung Galaxy A55</td>

                                    <!--Column 2: number of items-->
                                    <td class="d-flex justify-content-center text-bold-500">
                                        <input type="number" class="form-control inputNum" min="1" value="1">
                                    </td>

                                    <!--Column 3: unit price-->
                                    <td>9.000.000</td>

                                    <!--Column 4: total amount of each product-->
                                    <td>9.000.000</td>

                                    <td>
                                        <button type="button" class="btn btn-outline-danger ml-1">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="d-flex mt-3 justify-content-between">
                            <div class="d-flex" style="margin-left: 23rem;">
                                <h6 class="mr-3 mt-2">Total:</h6>
                                <h4 style="color: #5A8DEE;" id="totalProducts">0</h4>
                            </div>

                            <div class="d-flex justify-content-end" style="margin-right: 16rem;">
                                <h6 class="mr-3 mt-2">Total:</h6>
                                <h4 style="color: #5A8DEE;" id="totalAmount">0</h4>
                            </div>
                        </div>

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
        document.getElementById("btnCheckout").onclick = function() {
            window.location.href = "transaction/checkout";
        };

        $(document).ready(function() {

            //Suggestions for products when searching
            $('#searchProduct').on('input', function() {
                var text = $(this).val()
                $.ajax({
                    url: 'transaction/searchProduct/' + text,
                    type: 'POST',
                    success: function(response) {
                        var productListView = $('#product-list')
                        productListView.empty()
                        response.forEach(product => {
                            productListView.append('<div class="product-item" data-product-id="' + product.id + '" data-product-name="' + product.name + '" data-retail-price="' + product.retailPrice + '"><p>' + product.name + ' - ' + product.price + '</p></div>')

                        })
                    }
                })
            })

            //Add product to cart when click on product item on suggestion list
            $('.product-item').click(function() {
                var productId = $(this).data('product-id');
                var productName = $(this).data('product-name');
                var retailPrice = $(this).data('retail-price');

                var newRow = '<tr data-product-id="' + productId + '" data-product-name="' + productName + '" data-retail-price="' + retailPrice + '">' +
                    '<td>' + productName + '</td>' +
                    '<td class="d-flex justify-content-center text-bold-500"><input type="number" class="form-control inputNum" min="1" value="1"></td>' +
                    '<td>' + retailPrice + '</td>' +
                    '<td class="total-price">' + retailPrice + '</td>' +
                    '<td><button type="button" class="btn btn-outline-danger ml-1">Delete</button></td>' +
                    '</tr>';

                $('tbody').append(newRow);

                // Update total products
                var totalProducts = parseInt($('#totalProducts').text());
                $('#totalProducts').text(totalProducts + 1);

                // Update total amount
                var totalAmount = parseInt($('#totalAmount').text().replace(/\./g, ''));
                $('#totalAmount').text((totalAmount + retailPrice).toLocaleString('it-IT'));
            });

            $('tbody').on('change', '.inputNum', function() {
                var quantity = $(this).val();
                var price = $(this).closest('tr').data('retail-price');
                var totalPrice = quantity * price;
                $(this).closest('tr').find('.total-price').text(totalPrice.toLocaleString('it-IT'));

                // Update total amount
                var totalAmount = 0;
                $('.total-price').each(function() {
                    totalAmount += parseInt($(this).text().replace(/\./g, ''));
                });
                $('#totalAmount').text(totalAmount.toLocaleString('it-IT'));
                
                // Update total products
                var totalProducts = 0;
                $('.inputNum').each(function() {
                    totalProducts += parseInt($(this).val());
                });
                $('#totalProducts').text(totalProducts);    
            });
        })
    </script>
<?php
else : header("Location:" . _HOST . "home/logout");
endif;
?>
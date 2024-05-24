<div class="main-content container-fluid">
    <div class="page-title">
        <div class="d-flex justify-content-between">
            <div>
                <h3>Recent orders.</h3>
                <p class="text-subtitle text-muted">List of orders arranged in chronological order..</p>
            </div>
        </div>
    </div>

    <?php require_once(_DIR_ROOT . '/app/Views/modal/ModalTransactionDetails.php') ?>

    <div class="table-responsive">
        <table class="table table-light mb-0">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <!-- <th>Quantity</th> -->
                    <th>Total amount</th>
                    <th>Money given</th> <!--tiền khách đưa-->
                    <th>Excess amount</th> <!--tiền thừa-->
                    <th>Date of purchase</th>
                </tr>
            </thead>

            <tbody>
                <?php
                // foreach ($orders as $order) {
                //     echo <<<HTML
                //             <tr id="{$order['transaction_id']}">
                //                 <td>{$order['transaction_id']}</td>
                //                 <!-- <td>1</td> -->
                //                 <td>{$order['total_amount']}</td>
                //                 <td>{$order['amount_receive']}</td>
                //                 <td>{$order['amount_back']}</td>
                //                 <td>{$order['amount_back']}</td>
                //             </tr>
                //         HTML;
                // }
                ?>


            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("tbody tr").click(function() {
            var id = $(this).attr("id")

            $.ajax({
                url: 'statistics/getOrderByTimelines' + type + "/" + selectedValue_1 + "/" + selectedValue_2,
                type: 'POST',
                success: function(response) {
                    // if (response.status == 'success') {
                    //     $('#InvoiceModal').modal('show');
                    // } else {
                    //     window.location.href = "transaction/checkout";
                    // }
                }
            })

            // $("#date").val()
        })
    })
</script>
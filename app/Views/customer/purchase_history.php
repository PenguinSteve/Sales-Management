<div class="main-content container-fluid">
    <div class="page-title">
        <div class="d-flex justify-content-between">
            <div>
                <h3>Purchase History</h3>
                <p class="text-subtitle text-muted">View purchase history of customer.</p>
            </div>
        </div>
    </div>

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
                    <th></th>
                </tr>
            </thead>

            <tbody>

                <?php
                // foreach ($history as $h) {
                //     echo <<<HTML
                //         <tr>
                //             <td>{$h['transaction_id']}</td>
                //             <!-- <td>{$h['quantity']}</td> -->
                //             <td>{$h['amount_receive']} - {$h['amount_receive']}</td>
                //             <td>{$h['amount_receive']}</td>
                //             <td>{$h['amount_receive']}</td>
                //             <td>{$h['transaction_date']}</td>
                //             <td>
                //                 <button id="{$customer['customer_id']}" type="button" class="btn btn-outline-primary">See details</button>
                //             </td>
                //         </tr>
                //     HTML;
                // }
                ?>
                <tr>
                    <td>BST-498</td>
                    <!-- <td>1</td> -->
                    <td>9.000.000</td>
                    <td>9.000.000</td>
                    <td>0</td>
                    <td>19/05/2024</td>
                    <td><button id="{$customer['customer_id']}" type="button" class="btn btn-outline-primary">See details</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
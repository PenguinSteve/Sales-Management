<?php
require_once("app/Models/StatisticsModel.php");
require_once("app/Models/TransactionModel.php");
require_once("app/Models/CustomerModel.php");

class StatisticsController extends Controller
{

    private StatisticsModel $statisticsModel;
    private TransactionModel $transactionModel;
    private CustomerModel $customerModel;

    public function __construct()
    {
        $this->statisticsModel = new StatisticsModel();
        $this->transactionModel = new TransactionModel();
        $this->customerModel = new CustomerModel();
    }

    public function index()
    {
        $this->render("statistics/statistics", ['title' => 'Thống kê']);
    }

    // private function showModal($idOrder, $dateTime, $total, $phone)
    // {
    //     $transactionDetails = $this->statisticsModel->getTransactionForModal($idOrder);
    //     $customer = $this->customerModel->getCustomerByPhone($phone);
    //     print_r($transactionDetails[0]);


    //     echo <<<HTML
    //         <script>
    //             $("table").on("click", "tbody tr", function(){
    //                 $("#date").text("{$dateTime}")
    //                 $("#customerName").text("{$customer[0]['customer_name']}")
    //                 $("#customerPhone").text("{$phone}")
    //                 $("#staffName").text("{$transactionDetails[0]['name']}")

    //     HTML;

    //     foreach ($transactionDetails as $trans) {
    //         $totalAmount = (int)$trans['retail_price'] * (int)$trans['quantity'];

    //         echo <<<HTML
    //             $(".modal-body").append("<div class='d-flex justify-content-between'>" +
    //                                     "<p>{$trans['product_name']}</p>" +
    //                                     "<p>{$trans['quantity']}</p>" + 
    //                                     "<p>{$totalAmount}</p>" + 
    //                                     "</div>")

    //         HTML;
    //     }

    //     echo <<<HTML
    //                 $("#totalAmountModal").text("{$total}")
    //                 $('#InvoiceModal').modal('show')
    //             })
    //         </script>
    //     HTML;
    // }

    // public function printOrder($orders)
    // {
    //     echo <<<HTML
    //     <div class="main-content container-fluid">
    //         <div class="page-title">
    //             <div class="d-flex justify-content-between">
    //                 <div>
    //                     <h3>Recent orders.</h3>
    //                     <p class="text-subtitle text-muted">List of orders arranged in chronological order..</p>
    //                 </div>
    //             </div>
    //         </div>

    //         <div class="table-responsive">
    //             <table class="table table-light mb-0">
    //                 <thead>
    //                     <tr>
    //                         <th>Order ID</th>
    //                         <!-- <th>Quantity</th> -->
    //                         <th>Total amount</th>
    //                         <th>Money given</th> 
    //                         <th>Excess amount</th>
    //                         <th>Date of purchase</th>
    //                     </tr>
    //                 </thead>

    //                 <tbody>
    //     HTML;

    //     foreach ($orders as $o) {
    //         echo <<<HTML
    //                     <tr id="{$o['transaction_id']}">
    //                         <td>{$o['transaction_id']}</td>
    //                         <!-- <td>1</td> -->
    //                         <td>{$o['total_amount']}</td>
    //                         <td>{$o['amount_receive']}</td>
    //                         <td>{$o['amount_back']}</td>
    //                         <td>{$o['transaction_date']}</td>
    //                     </tr> 
    //             HTML;
    //     }

    //     require(_DIR_ROOT . '/app/Views/modal/ModalTransactionDetails.php');

    //     echo <<<HTML
    //                 </tbody>
    //             </table>
    //         </div>
    //     </div>
    //     HTML;

    //     $this->showModal($o['transaction_id'], $o['transaction_date'], $o['total_amount'], $o['customer_phone']);
    // }


    // public function printHtmlBody($profit, $received, $order, $product, $orders)
    // {
    //     echo <<<HTML
    //         <div class="card">
    //             <div class="card-body pl-5 pr-5 d-flex justify-content-between">
    //                 <div>
    //                     <h4 class="mt-4">Total profit</h4>
    //                 </div>

    //                 <div class="">
    //                     <h6>VND</h6>
    //                     <h1 class='text-green'>{$profit}</h1>
    //                 </div>
    //             </div>
    //         </div>

    //         <div class="row mb-2">
    //             <div class="col-md-9">
    //         HTML;

    //     $this->printOrder($orders);

    //     echo <<<HTML
    //             </div>

    //             <div class="col-md-3 mt-5">
    //                 <div class="card ">
    //                     <div class="card-header">
    //                         <h5>Total amount received</h5>
    //                     </div>

    //                     <div class="card-body">
    //                         <div class="text-center mb-5">
    //                             <h6>VND</h6>
    //                             <h2 class='text-green'>{$received}</h2>
    //                         </div>
    //                     </div>
    //                 </div>

    //                 <div class="card ">
    //                     <div class="card-header">
    //                         <h5>Number of Orders</h5>
    //                     </div>

    //                     <div class="card-body">
    //                         <div class="text-center mb-5">
    //                             <h6>up to now</h6>
    //                             <h2 class='text-green'>{$order}</h2>
    //                         </div>
    //                     </div>
    //                 </div>

    //                 <div class="card ">
    //                     <div class="card-header">
    //                         <h5>Number of Products</h5>
    //                     </div>

    //                     <div class="card-body">
    //                         <div class="text-center mb-5">
    //                             <h6>up to now</h6>
    //                             <h2 class='text-green'>{$product}</h2>
    //                         </div>
    //                     </div>
    //                 </div>
    //             </div>
    //         </div>
    //     HTML;
    // }

    public function handleDayTime($type, $dayFrom, $dayTo)
    {
        if ($type != 'specific_time') {
            $dayFrom = new DateTime('today');
            $dayTo = (new DateTime('today'))->setTime(23, 59, 59);
        } else {
        }
        if ($type == 'yesterday') {
            $dayFrom = new DateTime('yesterday');
            $dayTo = (new DateTime('yesterday'))->setTime(23, 59, 59);
        } else if ($type == '7days') {
            $dayFrom = (new DateTime('7 days ago'))->setTime(0, 0, 0);
        } else if ($type == 'month') {
            $dayFrom = (new DateTime('first day of this month'))->setTime(0, 0, 0);
            $dayTo = (new DateTime('last day of this month'))->setTime(23, 59, 59);
        } else if ($type == 'specific_time') {
            $dayFrom = $dayFrom . ' ' . "00:00:00";
            $dayTo = $dayTo . ' ' . "00:00:00";
            return array('dayFrom' => $dayFrom, 'dayTo' => $dayTo);
        }
        return array('dayFrom' => $dayFrom->format('Y-m-d H:i:s'), 'dayTo' => $dayTo->format('Y-m-d H:i:s'));;
    }

    public function getStatistics($type, $dayFrom, $dayTo)
    {
        $dayFrom = $this->handleDayTime($type, $dayFrom, $dayTo)['dayFrom'];
        $dayTo = $this->handleDayTime($type, $dayFrom, $dayTo)['dayTo'];

        //Total profit
        $transaction = $this->statisticsModel->getProfitByTimelines($dayFrom, $dayTo);
        $total = 0;

        foreach ($transaction as $innerArray) {
            $total += $innerArray['count_product'] * $innerArray['import_price'];
        }
        $total = number_format($total, 0, '.', '.');

        // Total amount received
        $transaction = $this->statisticsModel->getAmountReceived_numberOrder($dayFrom, $dayTo);
        $received = number_format($transaction[0]['total'], 0, '.', '.');

        // number of orders
        $order = number_format($transaction[0]['orders'], 0, '.', '.');;

        // number of products
        $products = $this->statisticsModel->getNumberProduct($dayFrom, $dayTo)[0]['products'];
        $products = number_format($products, 0, '.');

        // $orders = $this->transactionModel->getTransactionsByDateRange($dayFrom, $dayTo);

        // $this->printHtmlBody($total, $received, $order, $product, $orders);
        $response = array(
            "total" => $total,
            "received" => $received,
            "order" => $order,
            "products" => $products
        );

        // $response = array(
        //     "dayFrom" => $dayFrom,
        //     "dayTo" => $dayTo
        // );

        echo json_encode($response);
        // echo $product;

    }

    // public function getOrderByTimelines($type, $dayFrom, $dayTo)
    // {
    //     $dayFrom = $this->handleDayTime($type, $dayFrom, $dayTo)['dayFrom'];
    //     $dayTo = $this->handleDayTime($type, $dayFrom, $dayTo)['dayTo'];

    //     $orders = $this->transactionModel->getTransactionsByDateRange($dayFrom, $dayTo);
    //     $this->printOrder($orders);
    // }
}

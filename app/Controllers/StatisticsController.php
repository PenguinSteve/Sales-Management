<?php
require_once("app/Models/StatisticsModel.php");
require_once("app/Models/TransactionModel.php");

class StatisticsController extends Controller
{
    private StatisticsModel $statisticsModel;
    private TransactionModel $transactionModel;

    public function __construct()
    {
        $this->statisticsModel = new StatisticsModel();
        $this->transactionModel = new TransactionModel();
    }

    public function index()
    {
        $this->render("statistics/statistics", ['title' => 'Thống kê']);
    }

    public function handleDayTime($type, $dayFrom, $dayTo)
    {
        if ($type != 'specific_time') {
            $dayFrom = new DateTime('today');
            $dayTo = (new DateTime('today'))->setTime(23, 59, 59);
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
            $dayTo = $dayTo . ' ' . "23:59:59";
            return array('dayFrom' => $dayFrom, 'dayTo' => $dayTo);
        }
        return array('dayFrom' => $dayFrom->format('Y-m-d H:i:s'), 'dayTo' => $dayTo->format('Y-m-d H:i:s'));
    }

    public function getStatistics($type, $dayFrom, $dayTo)
    {
        $dayFrom = $this->handleDayTime($type, $dayFrom, $dayTo)['dayFrom'];
        $dayTo = $this->handleDayTime($type, $dayFrom, $dayTo)['dayTo'];

        //Total profit
        $transaction = $this->statisticsModel->getProfitByTimelines($dayFrom, $dayTo);
        $total = 0;

        foreach ($transaction as $innerArray) {
            $total += $innerArray['count_product'] * ($innerArray['price'] - $innerArray['import_price']);
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

        // recent purchase history
        $orders = $this->transactionModel->getTransactionsByDateRange($dayFrom, $dayTo);

        $response = array(
            "total" => $total,
            "received" => $received,
            "order" => $order,
            "products" => $products,
            "orders" => $orders
        );

        echo json_encode($response);
    }

    public function orderDetails($idOrder)
    {
        $details = $this->statisticsModel->getTransactionForModal($idOrder);
        echo json_encode($details);
    }
}
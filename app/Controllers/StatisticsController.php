<?php
class StatisticsController extends Controller
{

    public function index()
    {
        $this->render("statistics/statistics", ['title' => 'Thống kê']);
    }
}

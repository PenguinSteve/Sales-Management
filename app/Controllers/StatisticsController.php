<?php
    class StatisticsController extends Controller{
        
        public function index(){
            $this->render("statistics/index", ['title' => 'Thống kê']);
        }
    }
?>
<?php
    class TransactionController extends Controller{
        
        public function index(){
            $this->render("transaction/index", ['title' => 'Giao dịch']);
        }
    }
?>
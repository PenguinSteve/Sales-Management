<?php
    class CustomerController extends Controller{
        
        public function index(){
            $this->render("customer/customer_management", ['title' => 'Quản lý khách hàng']);
        }
    }
?>
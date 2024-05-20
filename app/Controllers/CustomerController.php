<?php
class CustomerController extends Controller
{

    public function index()
    {
        $this->render("customer/customer_management", ['title' => 'Quản lý khách hàng']);
    }

    public function customer_information()
    {
        $this->render('customer/customer_information', ['title' => 'Thông tin khách hàng']);
    }
}

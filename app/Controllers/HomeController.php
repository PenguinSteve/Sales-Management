<?php
    class HomeController extends Controller{
        
        public function index(){
            $this->render("home");
        }

        public function login(){
            $this->render("login");
        }
    }
?>
<?php
    class Controller{

        public function model($model){
            if(file_exists("./app/Models/".$model.".php")){
                require_once("./app/Models/".$model.".php");
                if(class_exists($model)){
                    return new $model;
                }
            }
            return false;
        }

        public function render( $view, $data = [] ){
            if(file_exists("./app/Views/".$view.".php")){
                require_once("./app/Views/".$view.".php");
            }

        }
    }
?>
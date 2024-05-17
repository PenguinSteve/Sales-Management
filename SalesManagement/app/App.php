<?php
    class App{
        protected $controller;
        protected $action;
        protected $params;

        public function __construct(){
            global $routes;

            $this->controller = $routes['default_controller'];
            $this->action = 'index';
            $this->params = [];

            $this->URLProcess();
        }

        private function getURL(){
            if(!empty($_SERVER['PATH_INFO'])){
                $url = $_SERVER['PATH_INFO'];
            }
            else{
                $url = "/";
            }
            return $url;
        }

        private function URLProcess(){
            $url = $this->getURL();
            $urlArr = explode("/", filter_var(trim($url, "/"), FILTER_SANITIZE_URL));
            
            //Xu ly controller
            if(!empty($urlArr[0])){
                $this->controller = ucfirst(strtolower($urlArr[0]));
                unset($urlArr[0]);
            }
            if(file_exists(_DIR_ROOT.'/app/Controllers/'.($this->controller)."Controller".'.php')){
                require_once(_DIR_ROOT.'/app/Controllers/'.($this->controller)."Controller".'.php');
                if(class_exists($this->controller."Controller")){
                    $this->controller = new ($this->controller."Controller");
                }
                else{
                    $this->loadError();
                    exit;
                }
            }
            else{
                $this->loadError();
                exit;
            }

            //Xu ly action
            if(!empty($urlArr[1])){
                if(method_exists($this->controller, strtolower($urlArr[1]))){
                    $this->action = strtolower($urlArr[1]);
                }
                else{
                    $this->loadError();
                    exit;
                }
                unset($urlArr[1]);
            }

            //Xu ly params
            $this->params = array_values($urlArr);
            try {
                call_user_func_array([ $this->controller, $this->action], $this->params);
            } catch (ArgumentCountError $e) {
                $this->loadError();
                exit;
            }
            
        }

        public function loadError($name = "404"){
            require_once(_DIR_ROOT."/app/errors/".$name.".php");
        }
    }
?>
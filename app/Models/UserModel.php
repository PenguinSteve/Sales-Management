<?php
    
    class UserModel extends Database{
        function __construct()
        {
            parent::__construct();
        }

        public function getUsers(){
            return $this->select("SELECT * FROM user");
        }

        public function getUserById($id){
            return $this->select("SELECT * FROM user WHERE id = ?", [$id], 'i');
        }

        public function getUserByUsername($username){
            return $this->select("SELECT * FROM user WHERE username = ?", [$username], 's');
        }

    }
?>
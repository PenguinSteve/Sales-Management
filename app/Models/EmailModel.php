<?php

class EmailModel extends Database
{
    function __construct()
    {
        parent::__construct();
    }

    private function generateToken()
    {
        $token = bin2hex(random_bytes(16)) . dechex(time());
        $now = new DateTime();
        $now->add(new DateInterval('PT1M'));
        $expired = $now->format('Y-m-d H:i:s');
        $this->action("UPDATE token SET token = ?, expire_on = ?", [$token, $expired], 'ss');
    }
}
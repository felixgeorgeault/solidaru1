<?php

namespace App;

class Helper
{

    public static function sessionStart(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }


}
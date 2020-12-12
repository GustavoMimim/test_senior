<?php
class ErrorController
{
    public function index( $msg_error )
    {
        require_once('views/error.php');
    }
}
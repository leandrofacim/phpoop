<?php

namespace Sts\Controllers;

if (!defined('URL')) {
    header('Location: /');
    exit();
}

class Contato
{
    public function index()
    {
        echo "Contato <br>";
    }
}
<?php

namespace Sts\Controllers;

if (!defined('URL')) {
    header('Location: /');
    exit();
}

class Blog
{
    public function index()
    {
        echo "Blog <br>";
    }
}
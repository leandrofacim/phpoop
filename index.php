<?php


require "./vendor/autoload.php";

// Carrega as constantes

require "./core/Config.php";

use Core\ConfigController as Home;

$url = new Home();

// Carrega Controllers

$url->carregar();


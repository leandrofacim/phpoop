<?php
session_start();
ob_start();

define('URL', 'http://localhost/lfsite/');

define("URL_ADM", 'http://localhost/lfsite/adm');

define('CONTROLLER', 'Home');

define('METODO', 'index');

// Credenciais de acesso ao BD

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB_NAME', 'lfproject');

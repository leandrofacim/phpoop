<?php

namespace Sts\Models;

if (!defined('URL')) {
    header('Location: /');
    exit();
}

class StsVideo
{
    private string $tabela = 'sts_videos';
    private $resultado;
    
    public function listar()
    {
        $listar = new \Sts\Models\helper\StsRead();
        $listar->exeRead($this->tabela, 'LIMIT :limit', 'limit=1');
        $this->resultado = $listar->getResultado();
        return $this->resultado;
    }
}
<?php 

namespace Sts\Models;

if (!defined('URL')) {
    header('Location: /');
    exit();
}

class StsServico
{
    private $resultado;
    private $table = 'sts_servicos';

    public function listar()
    {
        $listar = new \Sts\Models\helper\StsRead();
        $listar->exeRead($this->table, 'LIMIT :limit', 'limit=1');
        $this->resultado = $listar->getResultado();
        
        return $this->resultado;
    }
}
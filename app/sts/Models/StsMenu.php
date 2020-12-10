<?php

namespace Sts\Models;

if (!defined('URL')) {
    header('Location: /');
    exit();
}

class StsMenu
{
    private $resultado;

    public function listarMenu()
    {
        $listar = new \Sts\Models\helper\StsRead();
        $listar->fullRead(
            'SELECT endereco, nome_pagina FROM sts_paginas 
            WHERE lib_bloq =:lib_bloq 
            AND sts_situacao_pg_id =:sts_situacao_pg_id
            ORDER BY ordem ASC', "lib_bloq=1&sts_situacao_pg_id=1"
        );
        $this->resultado = $listar->getResultado();
        return $this->resultado;
    }
}
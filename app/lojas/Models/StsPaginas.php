<?php

namespace Sts\Models;

if (!defined('URL')) {
    header('Location: /');
    exit();
}

class StsPaginas
{
    private $resultado;
    private $urlController;

    public function listarPaginas($urlController = null)
    {
        $this->urlController = (string) $urlController;
        $listar = new \Sts\Models\helper\StsRead();
        $listar->fullRead(
            'SELECT 
            pg.id,
            tpg.tipo tipo_tpg 
            FROM sts_paginas pg
            INNER JOIN sts_tps_pgs tpg ON tpg.id = pg.sts_tps_pg_id
            WHERE pg.sts_situacao_pg_id =:sts_situacao_pg_id
            AND pg.controller =:controller
            LIMIT :limit',
            "sts_situacao_pg_id=1&controller={$this->urlController}&limit=1"
        );
        $this->resultado = $listar->getResultado();
        
        return $this->resultado;
    }
}

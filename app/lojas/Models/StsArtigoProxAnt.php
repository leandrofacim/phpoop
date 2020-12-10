<?php

declare(strict_types=1);

namespace Sts\Models;

if (!defined('URL')) {
    header('Location: /');
    exit();
}

class StsArtigoProxAnt
{
    private array $resultado;
    private int $idArtigo;

    public function artigoProximo(int $idArtigo = null): array
    {
        $this->idArtigo = $idArtigo;
        $listar = new \Sts\Models\helper\StsRead();
        $listar->fullRead(
            'SELECT slug FROM sts_artigos 
            WHERE adms_sit_id=:adms_sit_id 
            AND id >:id 
            ORDER BY id ASC 
            LIMIT :limit',
            "adms_sit_id=1&id={$this->idArtigo}&limit=1"
        );
        $this->resultado = $listar->getResultado();

        return $this->resultado;
    }

    public function artigoAnterior(int $idArtigo = null): array
    {
        $this->idArtigo = $idArtigo;
        $listar = new \Sts\Models\helper\StsRead();
        $listar->fullRead(
            'SELECT slug FROM sts_artigos 
            WHERE adms_sit_id=:adms_sit_id 
            AND id <:id 
            ORDER BY id DESC 
            LIMIT :limit',
            "adms_sit_id=1&id={$this->idArtigo}&limit=1"
        );
        $this->resultado = $listar->getResultado();

        return $this->resultado;
    }
}

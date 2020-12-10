<?php

namespace Sts\Models;

class StsArtigo
{
    private $resultado;
    private $artigo;

    public function visualizarArtigo($artigo = null)
    {
        $this->artigo = (string) $artigo;
        $visualizarArtigo = new \Sts\Models\helper\StsRead();
        $visualizarArtigo->fullRead(
            'SELECT id, titulo, conteudo, imagem 
                FROM  sts_artigos 
            WHERE adms_sit_id=:adms_sit_id 
            AND slug=:slug ORDER BY id DESC 
            LIMIT :limit', 
            "adms_sit_id=1&slug={$this->artigo}&limit=1"
        );
        $this->resultado = $visualizarArtigo->getResultado();
        return $this->resultado;
    }
}
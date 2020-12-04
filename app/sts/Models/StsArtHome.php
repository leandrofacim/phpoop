<?php

namespace Sts\Models;

if (!defined('URL')) {
    header('Location: /');
    exit();
}

class StsArtHome
{
    private $resultado;

    public function listarArtHome()
    {
        $listar = new \Sts\Models\helper\StsRead();
        $query = '
        SELECT id, titulo, descricao, imagem, slug
            FROM sts_artigos
            WHERE adms_sit_id = :adms_sit_id
        ORDER BY id DESC
        LIMIT :limit';

        $parseString = 'adms_sit_id=1&limit=3';
        
        $listar->fullRead($query, $parseString);
        $this->resultado = $listar->getResultado();
        
        return $this->resultado;
    }
}

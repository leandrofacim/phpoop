<?php

namespace Sts\Models;
class StsSobreAutor
{
    private $resultado;

    public function sobreAutor()
    {
        $visSobreAutor = new \sts\Models\helper\StsRead();
        $visSobreAutor->fullRead('
        SELECT id, titulo, descricao, imagem 
        FROM sts_sobres 
        WHERE adms_sit_id=:adms_sit_id 
        AND id =:id 
        LIMIT :limit', "adms_sit_id=1&id=1&limit=1");
        $this->resultado = $visSobreAutor->getResultado();
        return $this->resultado;
    }
}

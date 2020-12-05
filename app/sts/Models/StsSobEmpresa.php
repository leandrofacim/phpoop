<?php

namespace Sts\Models;

if (!defined('URL')) {
    header('Location: /');
    exit();
}

class StsSobEmpresa
{

    private array $resultado;

    /**
     * @method Responsável por listar informações sobre empresa
     * 
     * @return array
     */
    public function listarSobEmp(): array
    {
        $listar = new \Sts\Models\helper\StsRead();
        $listar->fullRead(
            'SELECT id, titulo, descricao, imagem 
                FROM sts_sobs_emps
            WHERE adms_sit_id =:adms_sit_id ORDER BY ordem ASC',
            'adms_sit_id=1'
        );
        $this->resultado = $listar->getResultado();
        return $this->resultado;
    }
}

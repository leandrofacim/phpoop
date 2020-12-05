<?php

namespace Sts\Controllers;

if (!defined('URL')) {
    header('Location: /');
    exit();
}

class SobreEmpresa
{
    private array $dados;

    public function index()
    {
        $listarSobreEmpresa = new \Sts\Models\StsSobEmpresa();
        $this->dados['sts_sobs_emps'] = $listarSobreEmpresa->listarSobEmp();

        $carregarView = new \Core\ConfigView('sts/Views/sobEmp/sobEmp', $this->dados);
        $carregarView->renderizar();
    }
}

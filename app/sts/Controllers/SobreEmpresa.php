<?php

namespace App\Sts\Controllers;

if (!defined('URL')) {
    header('Location: /');
    exit();
}

class SobreEmpresa
{
    private array $dados;

    public function index()
    {
        $listarMenu = new \Sts\Models\StsMenu();
        $this->dados['menu'] = $listarMenu->listarMenu();

        $listarSeo = new \Sts\Models\StsSeo();
        $this->dados['seo'] = $listarSeo->listarSeo();
        
        $listarSobreEmpresa = new \Sts\Models\StsSobEmpresa();
        $this->dados['sts_sobs_emps'] = $listarSobreEmpresa->listarSobEmp();

        $carregarView = new \Core\ConfigView('sts/Views/sobEmp/sobEmp', $this->dados);
        $carregarView->renderizar();
    }
}

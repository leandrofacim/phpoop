<?php

namespace App\Sts\Controllers;

if (!defined('URL')) {;
    header('Location: /');
    exit();
}

class Home
{
    private array $dados;

    public function index()
    {
        $listarMenu = new \Sts\Models\StsMenu();
        $this->dados['menu'] = $listarMenu->listarMenu();

        $listarSeo = new \Sts\Models\StsSeo();
        $this->dados['seo'] = $listarSeo->listarSeo();

        $listarCarousel = new \Sts\Models\StsCarousel();

        $this->dados['sts_carousels'] = $listarCarousel->listar();

        $listarServicos = new \Sts\Models\StsServico();
        $this->dados['sts_servicos'] = $listarServicos->listar();

        $listarVideo = new \Sts\Models\StsVideo();
        $this->dados['sts_videos'] = $listarVideo->listar();
        
        $listarArtHome = new \Sts\Models\StsArtHome();
        $this->dados['sts_artigos'] = $listarArtHome->listarArtHome();
        
        $carregarView = new \Core\ConfigView('sts/Views/home/home', $this->dados);
        $carregarView->renderizar();
    }
}

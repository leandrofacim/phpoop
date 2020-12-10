<?php

namespace App\Sts\Controllers;
class Artigo
{
    private $dados;
    private $artigo;

    public function index($artigo = null)
    {
        $listarMenu = new \Sts\Models\StsMenu();
        $this->dados['menu'] = $listarMenu->listarMenu();
        
        $this->artigo = (string) $artigo;
        $visualizarArtigo = new \Sts\Models\StsArtigo();
        $this->dados['sts_artigos'] = $visualizarArtigo->visualizarArtigo($this->artigo);

        $listarArtRecente = new \Sts\Models\StsArtRecente();
        $this->dados['artRecente'] = $listarArtRecente->listgarArtRecente();

        $listarArtDestaque = new \Sts\Models\StsArtDestaque();
        $this->dados['artDestaque'] = $listarArtDestaque->listarArtDestaque();

        $visSobreAutor = new \Sts\Models\StsSobreAutor();
        $this->dados['sobreAutor'] = $visSobreAutor->sobreAutor();

        $listarSeo = new \Sts\Models\StsSeo();
        $this->dados['seo'] = $listarSeo->listarSeo();

        if (!empty($this->dados['sts_artigos'][0])) {
            $artproximo = new \Sts\Models\StsArtigoProxAnt();
            $this->dados['artProximo'] = $artproximo->artigoProximo($this->dados['sts_artigos'][0]['id']);
            $this->dados['artAnterior'] = $artproximo->artigoAnterior($this->dados['sts_artigos'][0]['id']);

            $this->dados['seo'] = $listarSeo->listarSeo('sts_artigos', 'slug', $this->artigo);
        } else {
            $this->dados['seo'] = $listarSeo->listarSeo();
        }

        $carregarView = new \Core\ConfigView('sts/Views/blog/artigo', $this->dados);
        $carregarView->renderizar();
    }
}

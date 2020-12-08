<?php

namespace Sts\Controllers;

if (!defined('URL')) {
	header('Location: /');
	exit();
}

class Blog
{
	private array $dados;
	private $page;

	public function index()
	{
		$this->page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);
		$this->page = $this->page ? $this->page : 1;

		$blogArtigo = new \Sts\Models\StsBlog();

		$this->dados['artigos'] = $blogArtigo->listarArtigos($this->page);
		$this->dados['paginacao'] = $blogArtigo->getResultadoPg();
		
		$listarArtRecente = new \Sts\Models\StsArtRecente();
		$this->dados['artRecente'] = $listarArtRecente->listgarArtRecente();

		$listarArtDestaque = new \Sts\Models\StsArtDestaque();
		$this->dados['artDestaque'] = $listarArtDestaque->listarArtDestaque();

		$visSobreAutor = new \Sts\Models\StsSobreAutor();
		$this->dados['sobreAutor'] = $visSobreAutor->sobreAutor();
		$carregarView = new \Core\ConfigView('sts/Views/blog/blog', $this->dados);   
		$carregarView->renderizar();
	}
}
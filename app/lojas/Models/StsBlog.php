<?php

declare(strict_types=1);

namespace Sts\Models;

class StsBlog
{
    private $resultado;
    private $page;
    private $resultadoPg;
    private $limiteResultado = 2;

    public function getResultadoPg()
    {
        return $this->resultadoPg;
    }

    public function listarArtigos($page = null)
    {
        $this->page = (int) $page;
        $paginacao = new \Sts\Models\helper\StsPaginacao(URL . 'blog');
        $paginacao->condicao($this->page, $this->limiteResultado);
        $paginacao->paginacao('SELECT COUNT(id) AS num_result
        FROM sts_artigos
        WHERE adms_sit_id =:adms_sit_id', 'adms_sit_id=1');
        $this->resultadoPg = $paginacao->getResultado();

        $listar = new \Sts\Models\helper\StsRead();
        $listar->fullRead('SELECT id, titulo, descricao, imagem, slug 
        FROM sts_artigos 
        WHERE adms_sit_id =:adms_sit_id
        ORDER BY id DESC
        LIMIT :limit OFFSET :offset', "adms_sit_id=1&limit={$this->limiteResultado}&offset={$paginacao->getOffset()}");

        $this->resultado = $listar->getResultado();
       
        return $this->resultado;
    }
}

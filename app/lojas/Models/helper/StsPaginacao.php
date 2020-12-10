<?php

declare(strict_types=1);

namespace Sts\Models\helper;

class StsPaginacao
{
    private $link;
    private $maxLinks;
    private $pagina;
    private $limiteResultado;
    private $offset;
    private $query;
    private $parseString;
    private $resultado;
    private $resultadoBd;
    private $totalPaginas;

    public function __construct($link)
    {
        $this->link = $link;
        $this->maxLinks = 2;
    }

    public function getResultado()
    {
        return $this->resultado;
    }

    public function getOffset()
    {
        return $this->offset;
    }

    public function condicao($pagina, $limiteResultado)
    {
        $this->pagina = (int) $pagina ? $pagina : 1;
        $this->limiteResultado = (int) $limiteResultado;
        $this->offset = ($this->pagina * $this->limiteResultado) - $this->limiteResultado;
    }

    public function paginacao($query, $parseString = null)
    {
        $this->query = (string) $query;
        $this->parseString = (string) $parseString;
        $contar = new \Sts\Models\helper\StsRead();
        $contar->fullRead($this->query, $this->parseString);
        $this->resultadoBd = $contar->getResultado();
        
        if ($this->resultadoBd[0]['num_result'] > $this->limiteResultado) {
            $this->instrucaoPaginacao();
        } else {
            $this->resultado = null;
        }
    }

    private function instrucaoPaginacao()
    {
        $this->totalPaginas = ceil($this->resultadoBd[0]['num_result'] / $this->limiteResultado);
        if ($this->totalPaginas >= $this->pagina) {
            $this->layoutPaginacao();
        } else {
            header("Location: {$this->link}");
        }
    }

    private function layoutPaginacao()
    {
        $this->resultado = "<nav aria-label='paginacao'>";
        $this->resultado .= "<ul class='pagination justify-content-center'>";
        $this->resultado .= "<li class='page-item'>";
        $this->resultado .= "<a class='page-link' href=\"{$this->link}\" tabindex='-1'>Primeira</a>";
        $this->resultado .= "</li>";
        for ($iPag = $this->pagina - $this->maxLinks; $iPag <= $this->pagina - 1; $iPag++) {
            if ($iPag >= 1) {
                $this->resultado .= "<li class='page-item'><a class='page-link' href=\"{$this->link}?page={$iPag}\">$iPag</a></li>";
            }
        }

        $this->resultado .= "<li class='page-item active'>";
        $this->resultado .= "<a class='page-link' href='#'>{$this->pagina} <span class='sr-only'>(current)</span></a>";
        $this->resultado .= "</li>";

        for ($dPag = $this->pagina + 1; $dPag <= $this->pagina + $this->maxLinks; $dPag++) {
            if ($dPag <= $this->totalPaginas) {
                $this->resultado .= "<li class='page-item'><a class='page-link' href=\"{$this->link}?page={$dPag}\">$dPag</a></li>";
            }
        }
        $this->resultado .= "<li class='page-item'>";
        $this->resultado .= "<a class='page-link' href=\"{$this->link}?page={$this->totalPaginas}\">Última</a>";
        $this->resultado .= "</li>";
        $this->resultado .= "</ul>";
        $this->resultado .= "</nav>";
    }
}

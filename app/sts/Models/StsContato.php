<?php

namespace Sts\Models;

if (!defined('URL')) {
    header('Location: /');
}

class StsContato
{
    private $resultado;
    private array $dados;

    public function cadContato(array $dados)
    {
        $this->dados = $dados;
        $cadContato = new \Sts\Models\helper\StsCreate();
        $cadContato->exeCreate('sts_contatos', $this->dados);
    }
}
<?php

namespace Sts\Controllers;

if (!defined('URL')) {
    header('Location: /');
    exit();
}

class Contato
{
    private $dados;

    public function index()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($this->dados['cadMsgCont'])) {
            unset($this->dados['cadMsgCont']);
            $cadContato = new \Sts\Models\StsContato();
            $cadContato->cadContato($this->dados);
        }

        $carregarView = new \Core\ConfigView('sts/Views/contato/contato', $this->dados);
        $carregarView->renderizar();
    }
}

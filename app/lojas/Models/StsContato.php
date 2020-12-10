<?php

namespace Sts\Models;

if (!defined('URL')) {
    header('Location: /');
}
class StsContato
{
    private $resultado;
    private array $dados;

    public function getResultado()
    {
        return $this->resultado;
    }

    public function cadContato(array $dados)
    {
        $this->dados = $dados;
        $this->validarDados();

        if ($this->resultado) {
            $this->inserir();
        }
    }

    private function validarDados()
    {
        $this->dados = array_map('strip_tags', $this->dados);
        $this->dados = array_map('trim', $this->dados);
        if (in_array('', $this->dados)) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Para enviar a mensagem preencha todos os campos</div>";
            $this->resultado = false;
        } else {
            if (filter_var($this->dados['email'], FILTER_VALIDATE_EMAIL)) {
                $this->resultado = true;
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: E-mail invalido!</div>";
                $this->resultado = false;
            }
        }
    }

    private function inserir()
    {
        $cadContato = new \Sts\Models\helper\StsCreate();
        $cadContato->exeCreate('sts_contatos', $this->dados);

        if ($cadContato->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Mensagem enviada com sucesso!</div>";
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Mensagem não foi enviada!</div>";
            $this->resultado = false;
        }
    }
}

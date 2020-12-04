<?php

declare(strict_types=1);

namespace Core;

/**
 * Description of ConfigView
 *
 * copyrigt (c) year, Leandro Facim
 */
class ConfigView 
{
    private string $nome;
    private array $dados;

    public function __construct(string $nome, array $dados = []) 
    {
        $this->nome = $nome;
        $this->dados = $dados;
    }

    public function renderizar() 
    {
        if (file_exists('app/' . $this->nome . '.php')) {
            include 'app/sts/Views/include/cabecalho.php';
            include 'app/sts/Views/include/menu.php';
            include 'app/' . $this->nome . '.php';
            include 'app/sts/Views/include/rodape.php';
        } else {
            echo "Erro ao carregar a Página: {$this->nome}";
        }
    }

}

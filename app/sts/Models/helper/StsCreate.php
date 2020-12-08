<?php

namespace Sts\Models\helper;

if (!defined('URL')) {
    header('Location: /');
    exit();
}

use PDO;

class StsCreate extends StsConn
{
    private string $tabela;
    private array $dados;
    private $resultado;
    private $query;
    private object $conn;

    public function getResultado()
    {
        return $this->resultado;
    }

    public function exeCreate(string $tabela, array $dados)
    {
        $this->tabela = $tabela;
        $this->dados = $dados;
        $this->getInstrucao();
        $this->executarInstrucao();
    }

    private function getInstrucao()
    {
        $colunas = implode(', ', array_keys($this->dados));
        $valores = ':' . implode(', :', array_keys($this->dados));
        $this->query = "INSERT INTO {$this->tabela} ({$colunas}) VALUES ({$valores})";
    }

    private function executarInstrucao()
    {
        $this->conexao();
        try {
            $this->query->execute($this->dados);
            $this->resultado = $this->conn->lastInsertId();
        } catch (\Exception $ex) {
            $this->resultado = null;
        }
    }

    private function conexao()
    {
        $this->conn = parent::getConn();
        $this->query = $this->conn->prepare($this->query);
    }
}

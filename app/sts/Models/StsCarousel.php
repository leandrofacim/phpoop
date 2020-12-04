<?php

declare(strict_types=1);

namespace Sts\Models;

if (!defined('URL')) {
    header('Location: /');
    exit();
}

/**
 * Description of StsCarousel
 *
 * copyrigt (c) year, Leandro Facim
 */
class StsCarousel
{
    private array $resultado;
    private string $table = 'sts_carousels';

    public function listar(): array
    {
        $listar = new \Sts\Models\helper\StsRead();

        $query = "SELECT 
            car.id,
            car.nome, 
            car.link,
            car.imagem,
            car.titulo,
            car.descricao,
            car.posicao_text,
            car.titulo_botao, 
            cors.cor
                FROM {$this->table} car
            INNER JOIN adms_cors cors ON cors.id = adms_cor_id
            WHERE adms_situacoe_id=:adms_situacoe_id 
            ORDER BY ordem ASC
            LIMIT :limit";

        $parseString = 'adms_situacoe_id=1&limit=4';

        // $listar->exeRead($this->table, ' WHERE adms_situacoe_id=:adms_situacoe_id 
        // LIMIT :limit', $parseString);

        $listar->fullRead($query, $parseString);

        $this->resultado['sts_carousels'] = $listar->getResultado();

        return $this->resultado['sts_carousels'];
    }
}

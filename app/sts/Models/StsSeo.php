<?php

namespace Sts\Models;

if (!defined('URL')) {
    header('Location: /');
    exit();
}

class StsSeo
{
    private $resultado;
    private $urlController;
    private $url;
    private $urlConjunto;
    private $urlParametro;
    private $resultadoFace;
    private $tabela;
    private $coluna;
    private $listarSeoBasico;
    private static $format;

    public function listarSeo($tabela = null, $coluna = null, $valor = null)
    {
        $this->montarUrl();
        $this->urlParametro = (string) $valor;
        if (!empty($this->urlParametro)) {
            $this->tabela = (string) $tabela;
            $this->coluna = (string) $coluna;
            $this->listarSeoBasico = $this->listarSeoPagina();
            $this->listarSeoPersonalizado();
        } else {
            $this->listarSeoPagina();
            $this->resultado[0]['dir_img'] = 'pagina';
        }
        $this->listarSeoFace();
        return $this->resultado;
    }

    private function listarSeoPersonalizado()
    {
        $listar = new \Sts\Models\helper\StsRead();
        $listar->fullRead(
            "SELECT id, titulo, keywords, 
            description, author, imagem
            FROM {$this->tabela}
            WHERE {$this->coluna} =:valor
            ORDER BY id ASC 
            LIMIT :limit",
            "valor={$this->urlParametro}&limit=1"
        );

        $this->resultado = $listar->getResultado();
        $this->resultado[0]['tipo_robo'] = $this->listarSeoBasico[0]['tipo_robo'];
        $this->resultado[0]['endereco'] = $this->listarSeoBasico[0]['endereco'] . '/' . $this->urlParametro;
        $this->resultado[0]['dir_img'] = $this->listarSeoBasico[0]['endereco'];
    }

    private function listarSeoFace()
    {
        $listarFace = new \Sts\Models\helper\StsRead();
        $listarFace->fullRead(
            'SELECT og_site_name, og_locale, fb_admins, twitter_site
            FROM sts_seo 
            WHERE id =:id
            LIMIT :limit',
            "id=1&limit=1"
        );
        $this->resultadoFace = $listarFace->getResultado();

        $this->resultado[0]['og_site_name'] = $this->resultadoFace[0]['og_site_name'];
        $this->resultado[0]['og_locale'] = $this->resultadoFace[0]['og_locale'];
        $this->resultado[0]['fb_admins'] = $this->resultadoFace[0]['fb_admins'];
        $this->resultado[0]['twitter_site'] = $this->resultadoFace[0]['twitter_site'];
    }

    private function listarSeoPagina()
    {
        $listar = new \Sts\Models\helper\StsRead();
        $listar->fullRead(
            'SELECT pg.id, pg.endereco, pg.titulo, pg.keywords, 
            pg.description, pg.author, pg.imagem, robo.tipo tipo_robo
            FROM sts_paginas pg
            INNER JOIN sts_robots robo ON robo.id = pg.sts_robot_id
            WHERE pg.controller =:controller
            ORDER BY pg.id ASC LIMIT :limit',
            "controller={$this->urlController}&limit=1"
        );
        $this->resultado = $listar->getResultado();
        return $this->resultado;
    }

    private function montarUrl()
    {
        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) {
            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
            $this->limparUrl();
            $this->urlConjunto = explode('/', $this->url);

            if (isset($this->urlConjunto[0])) {
                $this->urlController = $this->slugController($this->urlConjunto[0]);
            } else {
                $this->urlController = $this->slugController(CONTROLLER);
            }

            if (isset($this->urlConjunto[1])) {
                $this->urlParametro = $this->urlConjunto[1];
            } else {
                $this->urlParametro = null;
            }
        } else {
            $this->urlController = $this->slugController(CONTROLLER);
            $this->urlParametro = null;
        }
    }

    /**
     * @method remove caracteres especiais
     */
    private function limparUrl()
    {
        $this->url = strip_tags($this->url);

        $this->url = trim($this->url);

        $this->url = rtrim($this->url, '/');

        self::$format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
        self::$format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr--------------------------------';
        $this->url = strtr(utf8_decode($this->url), utf8_decode(self::$format['a']), self::$format['b']);
    }

    private function slugController($slugController)
    {
        $urlController = str_replace(' ', '', ucwords(implode(
            ' ',
            explode('-', strtolower($slugController))
        )));

        return $urlController;
    }
}

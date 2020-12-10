<?php

declare(strict_types=1);

namespace Core;

class ConfigController
{
    private string $url;
    private array $urlConjunto;
    private string $urlController;
    private ?string $urlParametro;
    private $classe;
    private $paginas;
    private static $format = [];

    public function __construct()
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

    public function carregar()
    {
        $listarPage = new \Sts\Models\StsPaginas();
        $this->paginas = $listarPage->listarPaginas($this->urlController);

        if ($this->paginas) {
            extract($this->paginas[0]);
            $this->classe = "\\App\\{$tipo_tpg}\\Controllers\\{$this->urlController}";
            if (class_exists($this->classe)) {
                $this->carregarMetodo();
            } else {
                $this->urlController = $this->slugController(CONTROLLER);
                $this->carregar();
            }
        } else {
            $this->urlController = $this->slugController(CONTROLLER);
            $this->carregar();
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

    private function carregarMetodo()
    {
        $classeCarregar = new $this->classe;
        if (method_exists($classeCarregar, 'index')) {
            if ($this->urlParametro !== null) {
                $classeCarregar->index($this->urlParametro);
            } else {
                $classeCarregar->index();
            }
        } else {
            $this->urlController = $this->slugController(CONTROLLER);
            $this->carregar();
        }
    }
}

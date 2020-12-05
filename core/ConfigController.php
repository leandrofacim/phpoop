<?php declare(strict_types=1);

namespace Core;

class ConfigController
{
    private string $url;
    private array $urlConjunto;
    private string $urlController;
    private ?string $urlParametro;
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
                $this->urlController = CONTROLLER;
            }

            if (isset($this->urlConjunto[1])) {
                $this->urlParametro = $this->urlConjunto[1];
            } else {
                $this->urlParametro = null;
            }
        } else {
            $this->urlController = CONTROLLER;
            $this->urlParametro = null;
        }
    }

    public function carregar()
    {
        $classe = "\\Sts\\Controllers\\{$this->urlController}";
        $classeCarregar = new $classe;
        $classeCarregar->index();
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

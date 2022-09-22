<?php

namespace Controller;

use Entity\Url;

class PageController
{

    private Url $url;
    private array $template;

    public function __construct()
    {

        $url =  parse_url((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
        $this->url = new Url($url['scheme'], $url['host'], $url['path'], $url['query'] ?? null);

        $viewsPath = ROOT . '/views/templates';


        // TODO: implement redirection control for page uri.
        switch($this->url->path){
            case '/':
                $this->template['name'] = 'home';

                // validate if file exists.
                $this->template['path'] = $viewsPath . '/' . $this->template['name'] . '.php';
                break;
            case '/home':
                // redirect to site url when home is searched
                self::redirect('/');
                break;
            default:
                $this->template['name'] = $this->url->path;

                if(file_exists($viewsPath . $this->url->path . '.php')) {
                    $this->template['path'] = $viewsPath . $this->url->path . '.php';
                } else {
                    $this->template['name'] = '404';
                    $this->template['path'] = $viewsPath . '/404.php';
                }

                break;
        }

    }

    public function renderTemplate(string $file, array $arguments = []): void
    {

        if(!empty($arguments)) {
            extract($arguments);
        }

        include $file;

    }

    public function locateTemplate(): void
    {
        //TODO: Implement some kind of redirection tool when failed.

        $file = $this->template['path'];

        if(!file_exists($file)){
            $file = 'views/templates/404.php';
        }

        $this->renderTemplate($file);
    }

    public static function redirect(string $page): void
    {
        $location = 'Location: ' . SITE_URL . DIRECTORY_SEPARATOR . $page;

        if($page === '/') {

            $location = 'Location: ' . SITE_URL;
        }

        header($location);

    }

}
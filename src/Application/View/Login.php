<?php

namespace Application\View;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Twig\Environment as Engine;

class Login
{
    private $engine;


    public function __construct(Engine $engine)
    {
        $this->engine = $engine;
    }


    public function getDefault()
    {
        $template = $this->engine->load('login.html.twig');

        return new Response($template->render([]));
    }


    public function postDefault()
    {
        return new RedirectResponse('/');
    }
}

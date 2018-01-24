<?php

namespace Application\View;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Model\Service\SignUp;
use Twig\Environment as Engine;
use Model\Exception\AccessDenied;


class Register
{
    private $engine;
    private $signup;


    public function __construct(Engine $engine, SignUp $signup)
    {
        $this->engine = $engine;
        $this->signup = $signup;
    }



    public function getDefault()
    {
        $template = $this->engine->load('register.html.twig');

        return new Response($template->render([]));
    }


    public function postDefault()
    {
        return new RedirectResponse('/');
    }


}

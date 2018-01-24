<?php

namespace Application\View;

use Symfony\Component\HttpFoundation\RedirectResponse;

class Logout
{
    public function getDefault()
    {
        return new RedirectResponse('/login');
    }
}

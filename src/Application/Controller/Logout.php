<?php

namespace Application\Controller;

use Symfony\Component\HttpFoundation\Request;
use Model\Service\SignUp;

class Logout
{
    private $signup;


    public function __construct(SignUp $signup)
    {
        $this->signup = $signup;
    }


    public function getDefault()
    {
        $this->signup->forgetCurrentAccount();
    }
}

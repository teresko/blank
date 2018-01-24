<?php

namespace Application\Controller;

use Symfony\Component\HttpFoundation\Request;
use Palladium\Entity\Identity;
use Palladium\Service\Identification;
use Palladium\Service\Search;
use Model\Service\SignUp;

class Logout
{


    private $identification;
    private $search;


    public function __construct(Identification $identification, Search $search, SignUp $signup)
    {
        $this->identification = $identification;
        $this->search = $search;
        $this->signup = $signup;
    }


    public function getDefault(Request $request)
    {
        $this->signup->forgetCurrentAccount();
    }
}

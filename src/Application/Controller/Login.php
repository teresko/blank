<?php

namespace Application\Controller;

use Symfony\Component\HttpFoundation\Request;
use Palladium\Entity\Identity;
use Palladium\Service\Identification;
use Palladium\Service\Search;
use Model\Service\SignUp;

class Login
{
    private $identification;
    private $search;
    private $signup;


    public function __construct(Identification $identification, Search $search, SignUp $signup)
    {
        $this->identification = $identification;
        $this->search = $search;
        $this->signup = $signup;
    }


    public function getDefault()
    {
        
    }


    public function postDefault(Request $request)
    {
        $identity = $this->search->findEmailIdentityByEmailAddress($request->get('email'));
        $this->identification->loginWithPassword(
            $identity,
            $request->get('password')
        );

        $account = $this->signup->retrieveAccountById($identity->getAccountId());
        $this->signup->rememberCurrentAccount($account);
    }
}

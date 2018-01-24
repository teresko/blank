<?php

namespace Application\Controller;

use Symfony\Component\HttpFoundation\Request;
use Palladium\Entity\Identity;
use Palladium\Service\Identification;
use Palladium\Service\Registration;
use Model\Service\SignUp;

class Register
{

    private $registration;
    private $signup;


    public function __construct(Registration $registration, SignUp $signup)
    {
        $this->registration = $registration;
        $this->signup = $signup;
    }


    public function getDefault(Request $request){}


    public function postDefault(Request $request)
    {
        $account = $this->signup->createAccount();
        $this->signup->rememberCurrentAccount($account);

        $identity = $this->registration->createEmailIdentity(
            $request->get('email'),
            $request->get('password')
        );

        $this->registration->bindAccountToIdentity($account->getId(), $identity);
        $this->registration->verifyEmailIdentity($identity); // bypass the verification
    }
}

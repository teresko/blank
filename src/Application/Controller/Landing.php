<?php

namespace Application\Controller;

use Model\Entity\Account;

class Landing
{
    private $account;


    public function __construct(Account $account)
    {
        $this->account = $account;
    }


    public function getDefault()
    {

    }
}

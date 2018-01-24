<?php

namespace Model\Service;

use DateTimeImmutable;
use Model\Exception\AccessDenied;
use Model\Entity\Account;
use Model\Mapper;

class SignUp
{

    private $mapper;
    private $session;

    public function __construct(Mapper\Account $mapper, Mapper\Session $session)
    {
        $this->mapper = $mapper;
        $this->session = $session;
    }


    public function createAccount(): Account
    {
        $account = new Account;
        $account->setCreatedOn(new DateTimeImmutable);

        $this->mapper->store($account);

        return $account;
    }


    public function retrieveAccountById(int $accountId): Account
    {
        $account = new Account;
        $account->setId($accountId);

        $this->mapper->fetch($account);

        return $account;
    }


    public function rememberCurrentAccount(Account $account)
    {
        $this->session->set('account', $account->getId());
    }


    public function forgetCurrentAccount()
    {
        $this->session->set('account', null);
    }


    public function retrieveCurrentAccount(): Account
    {
        $id = $this->session->get('account');

        if (null === $id) {
            throw new AccessDenied;
        }

        return new Account($id);
    }
}

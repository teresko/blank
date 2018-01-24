<?php

namespace Model\Entity;

use DateTimeImmutable;
use Model\Contract\HasId;

class Account implements HasId
{

    private $accountId;
    private $createdOn;


    public function __construct(int $accountId = null)
    {
        $this->accountId = $accountId;
    }


    public function setId(int $accountId)
    {
        $this->accountId = $accountId;
    }


    public function getId()
    {
        return $this->accountId;
    }


    public function setCreatedOn(DateTimeImmutable $createdOn)
    {
        $this->createdOn = $createdOn;
    }


    public function getCreatedOn(): DateTimeImmutable
    {
        return $this->createdOn;
    }
}

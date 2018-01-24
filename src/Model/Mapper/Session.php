<?php

namespace Model\Mapper;

use Symfony\Component\HttpFoundation\Session\Session as Persistence;

class Session
{

    private $persistence;

    public function __construct(Persistence $persistence)
    {
        $this->persistence = $persistence;
    }


    public function set($name, $value)
    {
        $this->persistence->set($name, $value);
    }


    public function get($name)
    {
        return $this->persistence->get($name);
    }
}

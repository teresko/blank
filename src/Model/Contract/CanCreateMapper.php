<?php

namespace Model\Contract;

interface CanCreateMapper
{
    public function create(string $className);
}

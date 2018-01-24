<?php

namespace Component;


class View
{
    protected $engine;

    public function setTemplatingEngine(Engine $engine)
    {
        var_dump(11); exit;
        $this->engine = $engine;
    }
}

<?php

#[Attribute]
class CDef
{
    public $type;

    public function __construct($type)
    {
        $this->type = $type;
    }
}

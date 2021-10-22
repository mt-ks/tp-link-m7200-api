<?php

namespace TPLink;

use MClient\HttpInterface;
use MClient\Request;

class Client extends Request
{
    protected TPLinkM7200 $parent;
    public function __construct($address, TPLinkM7200 $parent)
    {
        parent::__construct($address);
        $this->parent = $parent;
    }

    public function execute(): HttpInterface
    {
        return parent::execute();
    }

}

<?php

namespace TPLink\model;

use EJM\MainMapper;

/**
 * @method string getToken()
 * @method string getAuthedip
 * @method int getFactorydefault()
 * @method int getResult()
 */
class LoginResponse extends MainMapper
{
    public const MAP = [
        'token' => 'string',
        'authedIP' => 'string',
        'factoryDefault' => 'string',
        'result' => 'int'
    ];
}

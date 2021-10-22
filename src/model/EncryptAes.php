<?php

namespace TPLink\model;

use EJM\MainMapper;

/**
 * @method string getEncryptedData()
 * @method string getKey()
 * @method string getIv()
 */
class EncryptAes extends MainMapper
{
    public const MAP = [
        'encrypted_data' => 'string',
        'key' => 'string',
        'iv' => 'string'
    ];
}

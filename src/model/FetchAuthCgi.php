<?php

namespace TPLink\model;

use EJM\MainMapper;

/**
 * @method getAuthedip()
 * @method getNonce()
 * @method getRsapubkey()
 * @method getRsamod()
 * @method getSeqnum()
 */
class FetchAuthCgi extends MainMapper
{
    public const MAP = [
      'authedIP' => 'string',
      'nonce' => 'string',
      'rsaPubKey' => 'string',
      'rsaMod' => 'string',
      'seqNum' => 'string'
    ];
}

<?php
/**
* @author SignpostMarv
*/
declare(strict_types=1);

namespace SignpostMarv\EasyDBHiddenString;

use ParagonIE\EasyDB\EasyDB;
use ParagonIE\EasyDB\Factory;
use ParagonIE\Halite\Symmetric\Crypto;
use ParagonIE\Halite\Symmetric\EncryptionKey;
use ParagonIE\HiddenString\HiddenString;

class HiddenStringDeferredEasyDB extends AbstractHiddenStringDeferredEasyDB
{
    public function Factory(EncryptionKey $key) : EasyDB
    {
        return static::Factory($key, $this->dsn, $this->username, $this->password, $this->options);
    }
}

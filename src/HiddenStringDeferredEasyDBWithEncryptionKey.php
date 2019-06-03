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

class HiddenStringDeferredEasyDBWithEncryptionKey extends AbstractHiddenStringDeferredEasyDB
{
    /**
    * @var EncryptionKey
    */
    protected $key;

    /**
    * @var EasyDB|null
    */
    protected $db;

    public function __construct(
        EncryptionKey $key,
        HiddenString $dsn,
        ? HiddenString $username,
        ? HiddenString $password,
        ? array $options
    ) : EasyDB {
        parent::__construct($dsn, $username, $password, $options);

        $this->key = $key;
    }

    public function EasyDB() : EasyDB
    {
        if (is_null($this->db)) {
            $this->db = static::Factory(
                $this->key,
                $this->dsn,
                $this->username,
                $this->password,
                $this->options
            );
        }

        return $this->db;
    }
}

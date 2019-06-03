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

abstract class AbstractHiddenStringDeferredEasyDB
{
    /**
    * @var HiddenString
    */
    protected $dsn;

    /**
    * @var HiddenString|null
    */
    protected $username;

    /**
    * @var HiddenString|null
    */
    protected $password;

    /**
    * @var array|null
    */
    protected $options;

    public function __construct(
        HiddenString $dsn,
        ? HiddenString $username,
        ? HiddenString $password,
        ? array $options
    ) {
        $this->dsn = $dsn;
        $this->username = $username;
        $this->password = $password;
        $this->options = $options;
    }

    public static function Factory(
        EncryptionKey $key,
        HiddenString $dsn,
        ? HiddenString $username,
        ? HiddenString $password,
        ? array $options
    ) : EasyDB {
        return Factory::fromArray([
            Crypto::decrypt($dsn->getString(), $key)->getString(),
            (
                is_null($username)
                    ? null
                    : Crypto::decrypt($username->getString(), $key)->getString()
            ),
            (
                is_null($password)
                    ? null
                    : Crypto::decrypt($password->getString(), $key)->getString()
            ),
            (is_null($options) ? $options : null),
        ]);
    }
}

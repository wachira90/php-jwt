<?php

namespace Firebase\JWT;

use OpenSSLAsymmetricKey;
use TypeError;
use InvalidArgumentException;

class Key
{
    /**
     * @param string|resource|OpenSSLAsymmetricKey $keyMaterial
     * @param string $algorithm
     */
    public function __construct(
        private mixed $keyMaterial,
        private string $algorithm
    ) {
        if (
            !is_string($keyMaterial)
            && !is_resource($keyMaterial)
            && !$keyMaterial instanceof OpenSSLAsymmetricKey
        ) {
            throw new TypeError('Key material must be a string, resource, or OpenSSLAsymmetricKey');
        }

        if (empty($keyMaterial)) {
            throw new InvalidArgumentException('Key material must not be empty');
        }

        if (empty($algorithm)) {
            throw new InvalidArgumentException('Algorithm must not be empty');
        }

        $this->keyMaterial = $keyMaterial;
        $this->algorithm = $algorithm;
    }

    /**
     * Return the algorithm valid for this key
     *
     * @return string
     */
    public function getAlgorithm(): string
    {
        return $this->algorithm;
    }

    /**
     * @return string|resource|OpenSSLAsymmetricKey
     */
    public function getKeyMaterial(): mixed
    {
        return $this->keyMaterial;
    }
}

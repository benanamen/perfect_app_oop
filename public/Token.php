<?php

/**
 * Class Token
 *
 * Generates a Cryptographically Secure Pseudo Random Number Generator (CSPRNG)
 *
 * @author Kevin Rubio
 * @license Proprietary
 * @copyright 04-21-2018
 *
 */

class Token
{
    /**
     * Returns CSPRNG hexadecimal ASCII string
     *
     * @return string
     */
    public function getEncodedToken()
    {
        return $this->setEncodedToken($this->setRandomBytes());
    }

    /**
     * Generates a pseudo-random string of bytes
     *
     * @return string
     */
    protected function setRandomBytes()
    {
        return openssl_random_pseudo_bytes(16);
    }

    /**
     * Convert binary data into hexadecimal representation
     *
     * Returns an ASCII string containing the hexadecimal representation of $randomBytes
     *
     * @param $randomBytes
     * @return string
     */
    protected function setEncodedToken($randomBytes)
    {
        return bin2hex($randomBytes);
    }
}

//----------------------------------------------------------------------------
//Test
//----------------------------------------------------------------------------

$token = new Token();
echo $encoded_token = $token->getEncodedToken();

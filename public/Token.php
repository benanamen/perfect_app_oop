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
     * Generates a pseudo-random string of bytes
     *
     * @return string
     */
    public function getRandomBytes()
    {
        return openssl_random_pseudo_bytes(16);
    }

    /**
     * Convert (Encodes) binary data into hexadecimal representation
     *
     * Returns an ASCII string containing the hexadecimal representation of $randomBytes
     *
     * @param $randomBytes
     * @return string
     */
    public function getEncodedToken($randomBytes)
    {
        return bin2hex($randomBytes);
    }

    /**
     * Decodes a hexadecimally encoded binary string
     *
     * @param $encoded_token
     * @return string
     */
    public function getDecodedToken($encoded_token)
    {
        return hex2bin($encoded_token);
    }


    /**
     * Generate a hash value
     *
     * @param $raw_token
     * @return string
     */
    public function sha256Hash($raw_token)
    {
        return hash('sha256', $raw_token);
    }
}

//----------------------------------------------------------------------------
//Test
//----------------------------------------------------------------------------

$token = new Token();

/** Encode token and hash it */
$raw_token = $token->getRandomBytes();

echo $encoded_token =$token->getEncodedToken($raw_token);// Sent to User
echo '<br>';
echo $token_hash = $token->sha256Hash($raw_token);// Stored in DB
echo '<br>';


/** Decode token and hash it */
$raw_token = $token->getDecodedToken($encoded_token);
echo $token_hash = $token->sha256Hash($raw_token);// Compare user token to DB token

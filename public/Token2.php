<?php
/*
Revision of my Token Class by kicken
https://forums.phpfreaks.com/topic/307191-oop-token-generator/
*/
class Token
{
    private $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public static function generate($length=16)
    {
        $raw = random_bytes($length);
        $token = bin2hex($raw);

        return new static($token);
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getHash()
    {
        return password_hash($this->token, PASSWORD_DEFAULT);
    }

    public function matches($hash)
    {
        return password_verify($this->token, $hash);
    }
}


$token = Token::generate();
echo $token_plain = $token->getToken(); // Sent to User
echo '<br>';
echo $token_hash = $token->getHash(); //Stored in DB
echo '<br>';


/** Decode token and hash it */
$token = new Token($token_plain);
var_dump($token->matches($token_hash)); //Compare user token to DB token
?>
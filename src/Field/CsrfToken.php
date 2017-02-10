<?php
namespace Jokuf\Form\Field;


class CsrfToken extends Input
{
    const SESSION_KEY = 'csrf';

    protected $entropy = 256;


    public function __construct($post_data=array())
    {
        $this->data['type'] = 'hidden';
        $this->data['value'] = $this->generateToken();
        if($_SERVER['REQUEST_METHOD'] !== "POST"){
            $this->store();
        }

        parent::__construct($post_data);
        return $this;
    }

    public function store()
    {
        $_SESSION[SESSION_KEY] = $this->data['value'];
    }

    public function getId()
    {
        return $this->entropy;
    }

    public function generateId()
    {
        $this->entropy = random_int(1,256);
        return $this->entropy;
    }

    public function generateToken()
    {
        // Generate an URI safe base64 encoded string that does not contain "+",
        // "/" or "=" which need to be URL encoded and make URLs unnecessarily
        // longer.
        $bytes = random_bytes($this->generateId() / 8);
        return rtrim(strtr(base64_encode($bytes), '+/', '-_'), '=');
    }

    public function getToken()
    {
        return $this->data['value'];
    }

    public function is_valid()
    {
        if(!isset($_SESSION[self::SESSION_KEY])){
            throw new \Jokuf\Form\Exceptions\ValidationError("session not start!", self::SESSION_NOT_START);
        }

        $token = $_SESSION[self::SESSION_KEY];
        if(hash_equals($token, $this->data['value'])){
            return True;
        }

        throw new \Jokuf\Form\Exceptions\ValidationError("CSRF Token validation fail", self::INVALID_CSRF_TOKEN);
    }
}

<?php
namespace Jokuf\Form\Field;
use Jokuf\Form\Validators\EmailValidator;


class Email extends Input
{
    public function __construct($kwargs=array())
    {
        $this->data['type'] = 'email';
        $this->add_validator(EmailValidator::init());
        parent::__construct($kwargs);
        return $this;
    }
}

?>

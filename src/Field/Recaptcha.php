<?php
namespace Jokuf\Form\Field;
use Jokuf\Form\Exceptions\ValidationError;

 /**
  * Class TextInput extends from Input
  *
  * @param  this is type of the input field'
  *
  * @author  Radoslav Yordanov cc@Jokuf.bg>
  *
  * @since 1.0
  */
class Recaptcha extends Input
{
    public function __construct(array $kwargs=array()){
        parent::__construct($kwargs);
        return $this;
    }

    public function __toString()
    {
        return "<div class=\"g-recaptcha\" data-sitekey=\"".$this->data['site_key']."\"></div>";
    }

    public function is_valid()
    {
        if (!isset($this->data['site_key'])) :
            throw new ValidationError("In recaptcha field is MUST site_key setting");
        endif;

        $recaptcha = new \ReCaptcha\ReCaptcha($this->data['secret']);
        $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

        if (!$resp->isSuccess()):
            throw new ValidationError("Incorect recaptcha");
        endif;

        return True;
    }
}

?>

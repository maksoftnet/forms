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
class Integer extends Input
{
    public function __construct(array $kwargs=array())
    {
        $this->data['type'] = 'number';
        parent::__construct($kwargs);
        return $this;
    }

    public function setStep($step)
    {
        $this->data['step'] = $step;
    }

    public function setMin($min)
    {
        $this->data['min'] = $min;
    }

    public function setMax($max)
    {
        $this->data['max'] = $max;
    }

    public function is_valid()
    {
        parent::is_valid();

        if (!filter_var($this->value, FILTER_VALIDATE_INT) === false) {
            return True;
        }

        throw new ValidationError("Невалидни данни", 32);
    }
}

?>

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
class Phone extends Input
{
    public $err_msg = 'Invalid phone number provided';

    public function __construct(array $kwargs=array()){
        $this->data['type'] = 'tel';
        $this->data['pattern'] = "[0-9/+]{7,16}";
        parent::__construct($kwargs);
        return $this;
    }
    public function is_valid()
    {
        preg_match("/^[0-9\/+]{9,16}$/", $this->value, $output);
        if(count($output) < 1){
            $this->data['errors'][] = $this->err_msg;
            return false;
        }
        return true;
    }
}

?>

<?php
namespace Jokuf\Form\Validators;
use Jokuf\Form\Exceptions\ValidationError;

class Integerish extends Base
{
    public function __construct($args=null, $kwargs=null){
        $this->msg = "O������� �������� - �����. ��������: %s";
    }

    public function __invoke($value=null){
        if(func_num_args() == 0){
            throw new ValidationError(__FUNCTION__ .' insufficient parameters supplied',
                                 Validator::INSUFFICENT_PARAMETERS);
        }
        if (!is_numeric($value) || $value != (int) $value) {
            $this->msg = sprintf($this->msg, $value);
            throw new ValidationError($this->msg);
        }
        return true;
    }
}

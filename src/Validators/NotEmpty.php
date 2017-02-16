<?php
namespace Jokuf\Form\Validators;
use Jokuf\Form\Exceptions\ValidationError;

class NotEmpty extends Base
{
    public function __construct()
    {
        $this->not_empty = func_get_arg(0);
        $this->msg = "���� ���� �� ���� �� ���� ������!";
    }

    public function __invoke()
    {
        if(func_num_args() == 0){
            $value = null;
        } else {
            $value = func_get_arg(0);
        }

        switch(gettype($value)){
        case "integer":
            return $this->_check(111);
        case "string":
            if (is_numeric($value)) {
                return $this->_check(111);
            }
            return $this->_check($value);
        case "object":
            return $this->_check((array) $value);
        default:
            return $this->_check($value);
        }
    }

    private function _check($value)
    {
        if (empty($value)) {
            return !$this->not_empty;
        }

        return $this->not_empty;
    }
}

?>

<?php
namespace Jokuf\Form\Validators;
use Jokuf\Form\Exceptions\ValidationError;

class HasUpperCase extends Base
{
    public function __construct($default=True)
    {
        $default = true;
        if(func_num_args() > 0){
            $default = func_get_arg(0);
            if(!is_bool($default)){
                throw new ValidationError("HasDigit takes BOOLEAN argument");
            }
        }
        $this->default = $default;
        $this->msg = "�� ������� ������ �����!";
    }

    public function __invoke()
    {
        if(func_num_args() == 0){
            throw new ValidationError(__FUNCTION__ .' insufficient parameters supplied',
                                 Validator::INSUFFICENT_PARAMETERS);
        }
        $string = func_get_arg(0);
        foreach (str_split($string) as $char) {
            if(ctype_upper($char)){
                return true;
            }
        }
        throw new ValidationError($this->msg);
    }
}

?>

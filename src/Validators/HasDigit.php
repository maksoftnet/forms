<?php
namespace Jokuf\Form\Validators;
use Jokuf\Form\Exceptions\ValidationError;

class HasDigit extends Base
{
    public function __construct()
    {
        $default = true;
        if(func_num_args() > 0){
            $default = func_get_arg(0);
            if(!is_bool($default)){
                throw new ValidationError("HasDigit takes BOOLEAN argument");
            }
        }
        $this->default = $default;
        $this->msg = "������������ ������ �� ��� �����";
    }

    public function __invoke()
    {
        if(func_num_args() == 0){
            throw new ValidationError(__FUNCTION__ .' insufficient parameters supplied',
                                 Validator::INSUFFICENT_PARAMETERS);
        }
        foreach (str_split(func_get_arg(0)) as $char) {
            if(is_numeric($char))
                return True;
        }
        return False;
    }
}

?>

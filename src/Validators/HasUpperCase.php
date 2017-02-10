<?php
namespace Jokuf\Form\Validators;


class HasUpperCase extends Base
{
    public function __construct($default=True)
    {
        $default = true;
        if(func_num_args() > 0){
            $default = func_get_arg(0);
            if(!is_bool($default)){
                throw new \Exception("HasDigit takes BOOLEAN argument");
            }
        }
        $this->default = $default;
        $this->msg = "�� ������� ������ �����!";
    }

    public function __invoke()
    {
        if(func_num_args() == 0){
            throw new \Exception(__FUNCTION__ .' insufficient parameters supplied', 
                                 Validator::INSUFFICENT_PARAMETERS);
        }
        foreach (str_split(func_get_arg(0)) as $char) {
            if(ctype_upper($char))
                return True;
        }
        return False;
    }
}

?>

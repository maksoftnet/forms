<?php
namespace Jokuf\Form\Validators;


class HasSpecialChars extends Base
{
     public function __construct()
    {
        $this->allowed_chars = func_get_arg(0);
        $this->msg = sprintf("���� ��������� ����[%s]", $this->allowed_chars);
    }

    public function __invoke()
    {
        if(func_num_args() == 0){
            throw new \Exception(__FUNCTION__ .' insufficient parameters supplied',
                                 Validator::INSUFFICENT_PARAMETERS);
        }
        $string = func_get_arg(0);
        foreach (str_split($this->allowed_chars) as $spec_char):
            if(strpos($string, $spec_char))
                return True;
        endforeach;
        return False;
    }
}

?>

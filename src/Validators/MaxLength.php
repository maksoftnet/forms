<?php
namespace Jokuf\Form\Validators;


class MaxLength extends Base
{
    public function __construct()
    {
        $this->length = func_get_arg(0);
        $this->msg = "��������� �������! ������������ ��������� ������� � ".$this->length;
    }

    public function __invoke()
    {
        if(func_num_args() == 0){
            throw new \Exception(__FUNCTION__ .' insufficient parameters supplied',
                                 Validator::INSUFFICENT_PARAMETERS);
        }
        return strlen(func_get_arg(0)) <= $this->length;
    }
}

?>

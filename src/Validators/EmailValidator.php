<?php
namespace Jokuf\Form\Validators;


class EmailValidator extends Base
{
    public function __construct(){
    }

    public function  __invoke()
    {
        if(func_num_args() == 0){
            throw new \Exception(__FUNCTION__ .' insufficient parameters supplied',
                                 Validator::INSUFFICENT_PARAMETERS);
        }
        $email = func_get_arg(0);
        $this->msg = sprintf("����� �������, ����� ��� ������������(%s) � ���������.", $email); 
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

}

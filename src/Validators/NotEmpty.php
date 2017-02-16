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
            $valie = null;
        } else {
            $value = func_get_arg(0);
        }

        if(empty($value))
            return !$this->not_empty;
        return $this->not_empty;
    }
}

?>

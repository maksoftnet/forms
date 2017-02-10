<?php
namespace Jokuf\Form\Validators;


class FileNotBiggerThan extends Base
{
    public function __construct()
    {
        $this->size = func_get_arg(0);
        $this->msg = sprintf("������ �� ���� �� ���� ��-����� �� %s", $this->format_size($this->size));
    }

    public function __invoke()
    {
        if(func_num_args() == 0){
            throw new \Exception(__FUNCTION__ .' insufficient parameters supplied',
                                 Validator::INSUFFICENT_PARAMETERS);
        }
        $field = func_get_arg(0);
        switch($field->is_multiple()){
            case true:
                $i =0;
                foreach($data->files['size'] as $filesize){
                    if($this->size > $filesize){
                        throw new \Exception($field->files['name'][$i] . " is bigger than expected size of ". $this->size);
                    }
                    $i++;
                }
                break;
            case false:
                var_dump($field->files['size']);
                return $field->files['size'] <= $this->size;
                break;
            default:
                return false;
        }
    }
}

?>

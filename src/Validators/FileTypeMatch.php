<?php
namespace Jokuf\Form\Validators;
use Jokuf\Form\Exceptions\ValidationError;

class FileTypeMatch extends Base
{
    public $extensions = array();
    public function __construct()
    {
        foreach(func_get_args() as $key => $type){
            $this->types[] = strtolower($type);
        }
        return $this;
    }

    public function add($file_type)
    {
        $this->extensions[] = $file_type;
        return $this;
    }

    public function __invoke($file=array())
    {
        if(func_num_args() == 0){
            throw new ValidationError(__FUNCTION__ .' insufficient parameters supplied',
                                 Validator::INSUFFICENT_PARAMETERS);
        }
        if(!array_key_exists('type', $file)){ return false; }
        foreach($this->types as $type){
        if($type == $file["type"]){
            return True;
        }
            $this->msg = sprintf("��������� ������! ��������� ������ - %s", $type);
    }
        return false;
    }
}

?>

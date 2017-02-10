<?php
namespace Jokuf\Form\Field;
use Jokuf\Form\Exceptions\ValidationError;


class Input extends Base
{
    private $type="input";

    public function __construct(array $kwargs=array()){
        parent::__construct($kwargs);
        return $this;
    }

    /**
     * Check if given field is valid
     *
     * Loops over each element in the validators array which
     * is callable objects and check state for True
     *
     *
     * @param null
     * @return null
     * @throws ValidationError if element in array return False or throw ValidationError
     */

    public function is_valid(){
        foreach ($this->__default_validators as $validator){
            try{
                $validator($this->value);
            } catch (\Exception $e){
                $this->data['errors'][] = $e->getMessage();
            }
        }

        if(!empty($this->data['errors'])){
            throw new ValidationError("validation filed" , 1);
        }

        return True;
    }

    public function __toString()
    {
        return "    <".$this->type." ".$this->createFieldAttr().'>'.PHP_EOL;
    }
}

?>

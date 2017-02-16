<?php
namespace Jokuf\Form\Field;
use \Jokuf\Form\Exceptions\ValidationError;


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
                if($validator($this->data['value']) === false){
                    $this->data['errors'][] = $validator->msg;
                }
            } catch (ValidationError $e){
                $this->data['errors'][] = $e->getMessage();
            }
        }

        if(count($this->data['errors']) > 0){
            throw new ValidationError($this->name . ' has error\n');
        }

        return True;
    }

    public function __toString()
    {
        return "    <".$this->type." ".$this->create_field_attributes().'>'.PHP_EOL;
    }
}

?>

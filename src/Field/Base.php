<?php
namespace Jokuf\Form\Field;
use Jokuf\Form\Exceptions\ValidationError;
use Jokuf\Form\Validators\Validator;

/**
 * This is a summary
 *
 * This is a description
 *
 * @author Radoslav Yordanov
 */
abstract class Base implements Field
{
    /**  @var get all defined vars */
    public  $__dict__;

    /**  @var array that store all empty instances */
    private $__empty_values = array();


    /**  @var get all defined vars */
    protected $data = array('errors' => array());

    /**  @var get all defined vars */
    protected $__default_validators = array();

    public function __construct()
    {
        return $this;
    }

    public abstract function __toString();

    public function __set($attribute, $value)
    {
        $this->data[$attribute] = $value;
    }

    public function __get($attribute)
    {
        return $this->exist($attribute) ? $this->data[$attribute] : null;
    }

    public function __isset($attribute)
    {
        return isset($this->data[$attribute]);
    }

    public function __unset($attribute)
    {
        unset($this->data[$attribute]);
    }

    public function is_valid(){
        return True;
    }

    public function add($attribute, $value)
    {
        $this->data[$attribute] = $value;
        return $this;
    }

    public function getErrors(){
        return $this->data['errors'];
    }

    private function run_validators($valueToValidate){
        $errors = array();

        foreach($this->__default_validators as $validatorInstance){
            try{
                $validatorInstance($valueToValidate);
            }catch (ValidationError $e){
                $e[] = $e->message();
            }
        }
        if($errors){
            throw new ValidationError($errors, self::VALIDATOR_FAIL);
        }
    }

    public function add_validator(Validator $validator)
    {
        $this->__default_validators[] = $validator;
        return $this;
    }

    protected function create_field_attributes()
    {
        $element = "";
        foreach ($this->data as $htmlAttribute => $value){
            if(is_array($value)){ continue; }
            if(is_bool($value) && $value){
                $element .= ' '.$htmlAttribute.' ';
                continue;
            }
            if(!is_null($value) && $value && $value !== '_'){
                $element .= $htmlAttribute.'="'.$value.'" ';
            }
        }
        return $element;
    }

   public function has_changed($data, $initial){
        /*
         * Return True if data differs from initial
         */
        try{
            if(in_array('_coerce', get_class_methods($this)))
                return ($this->_coerce($data) != $this->_coerce($initial)) ? True : False;
        }catch (ValidationError $e){
            return True;
        }
        /*
         * For purposes of seeing weather something has changed, None is the same
         * as an empty string, if the data or initial value we get is None, replace with '',
         */
        $initial_value = ($initial == null) ? '' : $initial;
        $data_value = ($data == null) ? '' : $data;

        return ($initial_value != $data_value) ? True : False;
    }

    public function exist($attribute)
    {
        return array_key_exists($attribute, $this->data);
    }

    public function getLabel()
    {
        if($this->exist('label')){
            return sprintf("<label for\"%s\">%s</label>", $this->data['name'], $this->data['label']);
        }
        return "";
    }

    public static function init()
    {
        $cls = get_called_class();

        $args = func_get_args();

        if(version_compare(phpversion(), '5.6.0', '>=')){
            return new $cls(...$args);
        }
        $reflect  = new \ReflectionClass($class);
        return $reflect->newInstanceArgs($args);
    }
}

?>

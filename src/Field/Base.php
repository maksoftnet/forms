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

    /**
     * @codeCoverageIgnore
     */
    public function __set($attribute, $value)
    {
        $this->data[$attribute] = $value;
    }

    /**
     * @codeCoverageIgnore
     */
    public function __get($attribute)
    {
        return $this->exist($attribute) ? $this->data[$attribute] : null;
    }

    /**
     * @codeCoverageIgnore
     */
    public function __isset($attribute)
    {
        return isset($this->data[$attribute]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function __unset($attribute)
    {
        unset($this->data[$attribute]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function is_valid(){
        return True;
    }

    /**
     * @codeCoverageIgnore
     */
    public function add($attribute, $value)
    {
        $this->data[$attribute] = $value;
        return $this;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getErrors(){
        return $this->data['errors'];
    }

    /**
     * @codeCoverageIgnore
     */
    public function get_errors(){
        return $this->data['errors'];
    }


    /**
     * @codeCoverageIgnore
     */
    public function add_validator(Validator $validator)
    {
        $this->__default_validators[] = $validator;
        return $this;
    }

    /**
     * @codeCoverageIgnore
     */
    public function create_field_attributes()
    {
        $attributes = array();
        foreach ($this->data as $htmlAttribute => $value) {
            $htmlAttribute = strtolower(trim($htmlAttribute));
            switch(true){
                case is_array($value):
                    break;
                case $value === true:
                    $attributes[] = $htmlAttribute;
                    break;
                case $htmlAttribute === 'label':
                    break; 
                default:
                    if (!is_null($value) &&  $value !== '_') {
                        $attributes[$htmlAttribute] = sprintf("%s=\"%s\"", $htmlAttribute, $value);
                    }
            }
        }
        return $attributes;
    }

    public function attributes(){
        return implode(" ", $this->create_field_attributes());
    }

    /**
     * @codeCoverageIgnore
     */
    public function exist($attribute)
    {
        return array_key_exists($attribute, $this->data);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getLabel(string $cls="")
    {
        echo PHP_EOL.'this method '.__FUNCTION__.' will be depreciate till end of march. Please use get_label'.PHP_EOL;
        return $this->get_label($cls);
    }

    /**
     * @codeCoverageIgnore
     */
    public function get_label(string $cls="")
    {
        if (!$this->exist('label')) {
            return "";
        }
        $pattern = "<label for=\"%s\" class=\"%s\">%s</label>";

        return sprintf($pattern, $this->data['name'], $cls, $this->data['label']);
    }


    /**
     * @codeCoverageIgnore
     */
    public static function init()
    {
        $cls = get_called_class();

        $args = func_get_args();

        return new $cls(...$args);
    }

    public function do_it_wrong($text, $code=1)
    {
        throw new ValidationError($text, $code);
    }
}

?>

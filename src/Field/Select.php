<?php
namespace Jokuf\Form\Field;


 /**
  * Class Select extends from Input
  *
  *
  * @author  Radoslav Yordanov cc@Jokuf.bg>
  *
  * @since 1.0
  */
class Select extends Input
{
    private $__data = array();

    public function __construct(array $kwargs=array()){
        parent::__construct($kwargs);
        return $this;
    }

/**
 * Loops over each attribute of the class
 *
 * if param is not null or param is not protected e.g. starts with __
 * add to $tmp variable param_name param_value  and creates field
 * For options must be defined method data which return array
 *
 *
 * @param none
 * @return string
 */
    public function __toString()
    {
        $options = '';
        $tmp = "select ";
        foreach ($this->data as $instance=>$value):
            if(is_array($value)){
                $options = $this->parse_options($this->options);
            } else {
                $tmp .= sprintf("%s=\"%s\" ", $instance, $value);
            }
        endforeach;
        return "    <".$tmp." >".PHP_EOL.$options."    </select>".PHP_EOL;
    }

    /**
     * predefine _data property
     *
     * if param is array predefine _data property else throw ValidationError Exception
     *
     *
     * @param array
     * @return none
     * @throws ValidationError
     */
    protected function parse_options($arr)
    {
        $tmp='';
        foreach ($arr as $key=>$value):
            $tmp  .= '     <option ';
            if(is_numeric($this->value))
                $this->value = (int) $this->value;
            if ($this->value == $key)
                $tmp .= 'selected ';
            $tmp .= 'value="'.$key.'">'.$value.'</option>'.PHP_EOL;
        endforeach;
        return $tmp;
    }



}

?>

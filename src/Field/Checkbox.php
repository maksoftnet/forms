<?php
namespace Jokuf\Form\Field;


 /**
  * Class TextInput extends from Input
  *
  * @param  this is type of the input field'
  *
  * @author  Radoslav Yordanov cc@Jokuf.bg>
  *
  * @since 1.0
  */
class Checkbox extends Input
{
    public function __construct(array $kwargs=array())
    {
        $this->data['type'] = 'checkbox';
        parent::__construct($kwargs);
        return $this;
    }

    public function __toString()
    {
        $options = '';
        $tmp = "select ";
        $tmp = array();
        $attributes = array();
        $checkboxes = "";
        foreach ($this->data as $instance=>$value){
            if($instance == 'label'){
                continue;
            }
            if(is_array($value)) {
                $checkboxes = $value;
                continue;
            }
            $attributes[] = sprintf("%s=\"%s\" ", $instance, $value);
        }

        $attributes = implode(" ", $attributes);
        foreach($checkboxes as $checkbox_value => $checkbox_name){
            $tmp[] = sprintf("<input %s value=\"%s\">%s ", $attributes, $checkbox_value, $checkbox_name);
        }
        return implode("", $tmp);
    }
}


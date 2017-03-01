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
        $tmp = array();
        foreach ($this->as_array() as $checkbox) {
            $tmp[] = sprintf("<input %s value=\"%s\">%s ", $checkbox['attr'], $checkbox['value'], $checkbox['name']);
        }

        return implode("", $tmp);
    }

    public function as_array()
    {
        $tmp = array();
        $checkboxes = "";
        foreach ($this->data as $instance=>$value){
            if(!is_array($value)){
                continue;
            }
            $checkboxes = $value;
            break;
        }

        $attributes = $this->create_field_attributes();
        foreach ($checkboxes as $checkbox_value => $checkbox_name) {
            $tmp[] = array(
                "attr"   => $attributes,
                "value" => $checkbox_value,
                "name"  => $checkbox_name
            );
        }
        return (empty($tmp) ? array(parent::__toString()) : $tmp);
    }
}


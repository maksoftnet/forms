<?php
namespace Jokuf\Form\Field;


 /**
  * Class Checkbox extends from Input
  *
  * @category Field
  *
  * @package Form
  *
  * @author Radoslav Yordanov <jokuf2010@gmail.com>
  *
  * @since 1.0
  *

  *

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
        $checked = false;

        if(isset($this->data['post'])){
            $checked = true;
        }
        foreach ($this->as_array() as $checkbox) {
            $pre_select = "";
            if($checked){
                switch(true){
                    case is_array($this->data['post']):
                        if(in_array($this->data['value'], $this->data['post'])){
                            $pre_select = "checked";
                        }
                        break;
                    case $this->data['post'] == $this->data['value']:
                        $pre_select = "checked";
                        break;
                    default:
                        $pre_select = "";

                }
            }
            $tmp[] = sprintf("<input %s value=\"%s\" %s>%s ", $checkbox['attr'], $checkbox['value'], $pre_select, $checkbox['name']);
        }

        return implode("", $tmp);
    }

    public function is_valid()
    {

    }

    public function as_array()
    {
        $tmp = array();
        $checkboxes = "";
        foreach ($this->data as $instance=>$value){
            if(is_array($value) and strtolower($instance) !== 'post'){
                $checkboxes = $value;
            }
        }

        $attributes = $this->attributes();
        foreach ($checkboxes as $checkbox_value => $checkbox_name) {
            $tmp[] = array(
                "attr"   => $attributes,
                "value" => $checkbox_value,
                "name"  => $checkbox_name
            );
        }
        return $tmp;
    }
}


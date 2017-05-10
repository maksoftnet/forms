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
        $this->data['value'] = '';
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
                        foreach($this->data['post'] as $choice){
                            if($checkbox['value'] == $choice){
                                $pre_select = "checked";
                            }
                        }
                        break;
                    case $this->data['post'] == $checkbox['value']:
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

    public function as_array()
    {
        $tmp = array();
        $checkboxes = "";
        foreach ($this->data as $instance=>$value) {
            if (is_array($value) and !in_array(strtolower($instance), array('value', 'post'))) {
                $checkboxes = $value;
            }
        }

        $attributes = $this->create_field_attributes();
        $predefined_value = $this->data['value'];
        unset($attributes['value']);
        foreach ($checkboxes as $checkbox_value => $checkbox_name) {
            if ($predefined_value == $checkbox_value) {
                $attributes['checked'] = true;
            }
            $tmp[] = array(
                "attr"   => implode(" ", $attributes),
                "value" => $checkbox_value,
                "name"  => $checkbox_name
            );
        }
        return $tmp;
    }
}


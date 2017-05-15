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
        $checkboxes;
        foreach ($this->data as $instance=>$value) {
            if (is_array($value) and !in_array(strtolower($instance), array('value', 'post'))) {
                $checkboxes = $value;
            }
        }
        return $this->build_checkboxes($checkboxes);
    }

    public function as_array()
    {
        $tmp = array();
        $checkboxes = "";
        $predefined_value = false;
        foreach ($this->data as $instance=>$value) {
            if (is_array($value) and !in_array(strtolower($instance), array('value', 'post'))) {
                $checkboxes = $value;
            }
        }

        $attributes = $this->create_field_attributes();
        if(isset($this->data['value']) and !is_array($this->data['value'])){
            $predefined_value = $this->data['value'];
        }
        unset($attributes['value']);
        foreach ($checkboxes as $checkbox_value => $checkbox_name) {
            if ($predefined_value and $predefined_value == $checkbox_value) {
                $attributes['checked'] = 'checked';
            }
            $tmp[] = array(
                "attr"   => implode(" ", $attributes),
                "value" => $checkbox_value,
                "name"  => $checkbox_name
            );
        }
        return $tmp;
    }

    protected function build_checkboxes($checkboxes)
    {
        $tmp = array();
        foreach($checkboxes as $checkbox_value => $checkbox_description){
            $tmp[] = $this->construct_checkbox($checkbox_value, $checkbox_description);
        }
        return implode(' ', $tmp);
    }


    protected function build_attributes()
    {
        $attributes = $this->create_field_attributes();
        if (isset($attributes['value'])) {
            unset($attributes['value']);
        }

        return implode(' ', $attributes);
    }

    protected function selected($value)
    {
        if(!isset($this->data['value'])){
            return;
        }
        if(is_array($this->data['value']) or !$this->data['value']){
            return;
        }

        if($value != $this->data['value']){
            return;
        }

        return 'selected';
    }

    protected function construct_checkbox($value, $description)
    {
        return sprintf("<input %s value=\"%s\" %s>%s ", $this->build_attributes(), $value, $this->selected($value), $description);
    }
}


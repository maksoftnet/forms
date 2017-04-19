<?php
namespace Jokuf\Form;
use Jokuf\Form\Field\Text;
use Jokuf\Form\Field\Email;
use Jokuf\Form\Field\Select;
use Jokuf\Form\Field\Phone;
use Jokuf\Form\Field\Hidden;
use Jokuf\Form\Field\Checkbox;
use Jokuf\Form\Field\Radio;
use Jokuf\Form\Field\Textarea;
use Jokuf\Form\Field\Submit;


class Bootstrap extends BaseForm
{
    public $class = array(
        "div"      => "form-group",
        "form"     => false,
        "label"    => false,
        "select"   => false,
        "input"    => false,
        "fieldset" => false,
    );

    public $fieldset = false;

    public function __toString()
    {
        $tmp = '';

        foreach ($this->fields as $field) {
            $has_error = count($field->errors) > 0; 
            if($has_error){
                $tmp .= '<div class="has-error">';
            }

            $tmp .= sprintf('  <div class="%s">', $this->class['div']).PHP_EOL;

            switch (true){
                case $field instanceof Radio:
                    $tmp .= $this->rend_radio($field);
                    break;
                case $field instanceof Checkbox:
                    $tmp .= $this->rend_checkbox($field); 
                    break;
                case $field instanceof File:
                    $this->_attr["enctype"] = "multipart/form-data";
                    break;
                default:
                    $tmp .= $field->get_label();
                    $tmp .= (string) $field;
            }

            if($has_error){
                $tmp .= $this->construct_errors($field->errors);
            }

            $tmp .= '  </div>'.PHP_EOL;
            if($has_error){
                $tmp .= '</div>';
            }
        }
        $form = $this->start().$tmp.PHP_EOL.$this->end().PHP_EOL;

        if($this->fieldset){
            return "<fieldset>".$form.'</fieldset></form>'.PHP_EOL;
        }
        return $form;
    }

    protected function rend_checkbox(Checkbox $field){
        $checkboxes = $field->as_array();
        $str = <<<HERE
<div class="bs-callout bs-callout-info" id="callout-navbar-breakpoint">
 <h4>{$field->label}</h4> 
 <p></p> </div>
HERE;
        foreach($checkboxes as $checkbox){
            extract($checkbox);
            $str .= '
<div class="checkbox">
  <label>
    <input '.$attr.' value="'.$value.'">
        '.$name.'
  </label>
</div>
';
        }
        return $str;
    }

    protected function rend_radio(Radio $field)
    {
        $radios = $field->as_array();
        $str = <<<HERE
<div class="bs-callout bs-callout-info" id="callout-navbar-breakpoint">
 <h4>{$field->label}</h4> 
 <p></p> </div>
HERE;
        foreach($radios as $radio){
            extract($radio);
            $str .= <<<HERE
    <label class="radio-inline">
      <input $attr value="$value"">$name
    </label>
HERE;
        }
        return $str;
    }

    public function construct_errors($errors){
        $ul = "<ul>";
        foreach ($errors as $error) {
            $ul .= "<li>$error</li>";
        }
        $ul .= "</ul>";
        return $ul;
    }

    public function add_class($selector, $value){
        if(isset($this->class[$selector])){
            $this->class[$selector] = $value;
            return $this;
        }
        echo "<br>Опитвате се да зададете клас на несъществуващ селектор.
Моля, изберете един от тези селектори: <ul><li>".implode('</li><li>', array_keys($this->class))."</li></ul><br>";
        return $this;
    }


    public function div_class($class=null)
    {
        $this->class['div'] = $class;
    }


    public function form_class($class=null)
    {
        $this->class['form'] = $class;
    }
}


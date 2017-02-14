<?php
namespace Jokuf\Form;


class DivForm extends BaseForm
{
    public $class = '';
    public $fieldset = false;

    public function __toString()
    {
        $tmp = '';
        foreach ($this->fields as $field) {
            $tmp .= sprintf('  <div %s>', $this->class).PHP_EOL;
            if($field->label){
                $tmp .= '    <label for="'.$field->name.'">'.$field->label.'</label>'.PHP_EOL;
            }

            if(count($field->errors)){
                $tmp .= $this->construct_errors($field->errors);
            }
            $tmp .= (string) $field;
            $tmp .= '  </div>'.PHP_EOL;
            if($input_field instanceof \Jokuf\Form\Field\File){
                $this->_attr["enctype"] = "multipart/form-data";
            }
        }

        if($this->fieldset){
            $form = "<form ".$this->get_id()." ".$this->_enctype." ".$this->get_method(). " ".$this->get_action() ." ". $this->get_name().">".PHP_EOL;
            return "<fieldset>".$form.$tmp.PHP_EOL.'</fieldset></form>'.PHP_EOL;
        }
        return $this->start().$tmp.PHP_EOL.$this->end().PHP_EOL;
    }

    public function construct_errors($arr){
        $ul = "<ul>";
        foreach ($errors as $error) {
            $ul .= "<li>$error</li>";
        }
        $ul .= "</ul>";
        return $ul;
    }

    public function div_class($class=null)
    {
        $this->class = sprintf('class="%s"', $class);
    }

    public function form_class($class=null)
    {
        $this->class = sprintf('class="%s"', $class);
    }
}
?>

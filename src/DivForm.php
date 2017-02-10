<?php
namespace Jokuf\Form;


class DivForm extends BaseForm
{
    public $class = '';
    public $fieldset = false;

    public function __toString()
    {
        $tmp = '';
        foreach (get_object_vars($this) as $input_field):
            if(is_object($input_field)):
                $tmp .= sprintf('  <div %s>', $this->class).PHP_EOL;
                if($input_field->label)
                    $tmp .= '    <label for="'.$input_field->name.'">'.$input_field->label.'</label>'.PHP_EOL;
                $tmp .= (string) $input_field;
                $tmp .= '  </div>'.PHP_EOL;
                if($input_field instanceof \Jokuf\Form\Field\File){
                    $this->_attr["enctype"] = "multipart/form-data";
                }
            endif;
        endforeach;

        if($this->fieldset){
            $form = "<form ".$this->get_id()." ".$this->_enctype." ".$this->get_method(). " ".$this->get_action() ." ". $this->get_name().">".PHP_EOL;
            return "<fieldset>".$form.$tmp.PHP_EOL.'</fieldset></form>'.PHP_EOL;
        }
        return $this->start().$tmp.PHP_EOL.$this->end().PHP_EOL;
    }

    public function div_class($class=null)
    {
        $this->class = sprintf('class="%s"', $class);
    }

    public function set_class($class=null)
    {
        $this->class = sprintf('class="%s"', $class);
    }
}
?>

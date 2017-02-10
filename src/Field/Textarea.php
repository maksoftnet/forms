<?php
namespace Jokuf\Form\Field;


 /**
  * Class Textarea extends from Input
  *
  * @param  this is type of the input field'
  *
  * @author  Radoslav Yordanov cc@Jokuf.bg>
  *
  * @since 1.0
  */
class Textarea extends Input
{
    public function __toString()
    {
        $field = '';
        $field .= "    <textarea ";
        foreach ($this->data as $attribute=>$value):
            if(substr($attribute, 0,1) == '_' )
                continue;
            if(is_bool($value) && $value){
                $field .= ' '.$attribute.' ';
                continue;
            }
            if(!is_null($value) && $value && $value !== '_')
                $field .= $attribute.'="'.$value.'" ';
        endforeach;
        $field .= '></textarea>'.PHP_EOL;
        return $field;
    }
}

?>

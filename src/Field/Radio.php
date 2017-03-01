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
class Radio extends Checkbox
{
    public function __construct(array $kwargs=array())
    {
        parent::__construct($kwargs);
        $this->data['type'] = 'radio';
        return $this;
    }
}


<?php
namespace Jokuf\Form\Field;


 /**
  * Class PasswordInput extends from Input
  *
  *
  * @author  Radoslav Yordanov cc@Jokuf.bg>
  *
  * @since 1.0
  */
class Password extends Input
{
    public function __construct(array $kwargs=array()){
        $this->data['type'] = 'password';
        parent::__construct($kwargs);
        return $this;
    }
}

?>

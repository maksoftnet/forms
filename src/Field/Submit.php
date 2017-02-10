<?php
namespace Jokuf\Form\Field;


 /**
  * Class Submit extends from Input
  *
  *
  * @author  Radoslav Yordanov cc@Jokuf.bg>
  *
  * @since 1.0
  */
class Submit extends Input
{
    public function __construct(array $kwargs=array()){
        $this->data['type'] = 'submit';
        parent::__construct($kwargs);
        return $this;
    }
}

?>

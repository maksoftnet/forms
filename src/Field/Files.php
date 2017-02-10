<?php
namespace Jokuf\Form\Field;


 /**
  * Class File extends from Input
  *
  *
  * @author  Radoslav Yordanov cc@Jokuf.bg>
  *
  * @since 1.0
  */
class Files extends Input
{
    public function __construct(array $kwargs=array()){
        $this->data['type'] = 'file';
        parent::__construct($kwargs);
        return $this;
    }

    public function is_valid()
    {
        foreach ($this->__default_validators as $validator){
            try{
                if($validator instanceof \Jokuf\Form\Validators\Files){
                    $validator($this);
                    continue;
                }
            } catch (\Jokuf\Form\Exceptions\ValidationError $e) {
                $this->data['errors'][] = $e->getMessage();
            }
        }
        if(!empty($this->data['errors'])){
            throw new \Jokuf\Form\Exceptions\ValidationError("Validation filed");
        }
        return True;
    }

    public function is_multiple(){
        if(isset($this->data['multiple'])){
            return boolval($this->data['multiple']);
        }

        return false;
    }
}

?>

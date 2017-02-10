<?php
namespace Jokuf\Form\Field;


class Datetime extends Input
{
    public function __construct($kwargs=array()){
        $this->data['type'] = 'datetime';
        parent::__construct($kwargs);
        return $this;
    }

    /**
     * Check if DateInput field is valid
     * See constructor of Form class second loop -> form_data
     *
     * @param null
     * @return str today date format dd-mm-YYYY
     */
    public function is_valid()
    {
        parent::is_valid();
        $date = new Datetime($this->value);
        #return (string) $date;
    }
}

?>

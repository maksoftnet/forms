<?php
namespace Jokuf\Form\Field;


class Date extends Input
{
    protected $format = "Y-m-d";
    public function __construct($kwargs=array()){
        $this->data['type'] = 'date';
        $this->data['format'] = $this->format;
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
        try{
            $date = new \DateTime($this->data['value']);
            $this->data['value'] = $date->format($this->data['format']);
            return $this->data['value'];
        } catch (\Exception $e){
            throw new \Exception(sprintf("Invalid Date[\"%s\"] provided", $this->value), self::INVALID_DATE);
        }
    }

    public function set_format($date_format){
        $this->data['format'] = $date_format;
    }
}

?>

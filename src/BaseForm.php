<?php
namespace Jokuf\Form;
use \Jokuf\Form\Exceptions\ValidationError;


class BaseForm implements \Iterator, \Countable
{
    public $attributes = array(
        'action' => false,
        'name' => false,
        'enctype' => "application/x-www-form-urlencoded",
        'method' => "POST",
        'id' => false,
    );
    protected $cleaned_data=array();
    protected $fields = array();
    protected $post = array();

    /**
     * Loops over each element in the defined object variables check if there is some private or protected
     * properties and add all of them in fields array.
     * Second Loop check if form_data is not null and iterate over it. If form_data[KEY] is equal to
     * some of object variables check if this var is object. If is true add value to object (eg. for validation)
     *
     *
     * @param array $arr
     * @return none
     */

    public function __construct($post_data=null, $files=null){
        $this->post = $post_data;
        foreach(get_object_vars($this) as $instance=>$value){
            if($value instanceof \Jokuf\Form\Field\Base){
                $value->name = $instance;
                $this->{$instance} = $value;
                $this->fields[$instance] = $this->{$instance};
            }
        }

        $this->clean_files($files);

    }

    public function count()
    {
        return count($this->fields);
    }

    public function start() {
        $str = '';
        foreach ($this->attributes as $attribute_name => $attribute_value){
            if(!$attribute_value){ continue; }
            $str .= sprintf("%s=\"%s\" ", $attribute_name, $attribute_value);
        }
        return sprintf("<form %s>", $str);
    }

    public function end() {
        return "</form>";
    }

    protected function clean_files($files){
        if(empty($files)){
            return;
        }

        foreach($files as $file_input_name => $file_arr){
            if(in_array($file_input_name, $this->fields)){
                $this->fields[$file_input_name]->files = $file_arr;
            }
        }
        return;
    }

    protected function clean_request($post_data)
    {
        /*
         * TODO
         * array array_diff ( array $array1 , array $array2 [, array $... ] )
         * Compares array1 against one or more other arrays and returns the
         * values in array1 that are not present in any of the other arrays.
         */

        foreach($post_data as $key=>$value){
            if(!array_key_exists($key, $this->fields)){ continue; }
            $this->fields[$key]->value = $value;
        }
    }

    public function is_valid()
    {
        $this->clean_request($this->post);

        $errors = array();

        foreach($this->fields as $field_name => $field){
            try{
                $field->is_valid();
                $custom_validator = sprintf("validate_%s", $field_name);
                if(method_exists($field, $custom_validator)){
                    $field->$custom_validator($field->value);
                }
            } catch (ValidationError $e){
                $errors[$field_name] = $e->getMessage();
            }

            $this->cleaned_data[$field_name] = $field->value;
        }
        if(count($errors) > 0){
            throw new ValidationError("Errors in fields. Please iterate over them");
        }

        return true;
    }

    /**
     * Return string representation of form
     *
     * @param null
     * @return string
     */
    public function __toString()
    {
        $tmp = '';
        foreach (get_object_vars($this) as $input_field):
            if(is_object($input_field)):
                $tmp.= (string) $input_field;
            endif;
        endforeach;
        return $tmp;
    }

	public function save()
	{
        if(array_key_exists("csrf", $this->cleaned_data)){
            unset($this->cleaned_data['csrf']);
        }
        return $this->cleaned_data;
	}

    public function set_action($url){
        $this->attributes['action'] = $url;
    }

    public function get_action(){
        if(!$this->attributes['action']){
            return '';
        }
        return $this->attributes['action'];
    }

    public function set_method($method){
        $this->attributes['method'] = $method;
    }

    public function get_method(){
        return $this->attributes['method'];
    }

    public function set_name($name){
        $this->attributes['name'] = $name;
    }

    public function get_name(){
        if(empty($this->attributes['name'])){
            return '';
        }
        return $this->attributes['name'];
    }

    public function set_id($id){
        $this->attributes['id'] = $id;
    }

    public function get_id()
    {
        return $this->attributes['id'];
    }

    public function clean_data()
    {
        return $this->cleaned_data;
    }

    public function rewind()
    {
        reset($this->fields);
    }

    public function current()
    {
        return current($this->fields);
    }

    public function key()
    {
        return key($this->fields);
    }

    public function next()
    {
        return next($this->fields);
    }
    public function valid()
    {
        $key = key($this->fields);
        return ($key !== NULL && $key !== FALSE);
    }
}
?>

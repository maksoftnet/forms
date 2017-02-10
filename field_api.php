<?php
include 'vendor/autoload.php';
use Jokuf\Form\Forms\DivForm;


function randStrGen($len){
    $result = "";
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
    $charArray = str_split($chars);
    for($i = 0; $i < $len; $i++){
	    $randItem = array_rand($charArray);
	    $result .= "".$charArray[$randItem];
    }
    return $result;
}
#var_dump(json_decode($_POST['data']));
$request_post = json_decode($_POST['data']);
if($_SERVER['REQUEST_METHOD'] === "POST"){
    $fields = array();
    foreach ($request_post as $field) {
        $field_data = array();
        $field_data["class"] = 'form-control';
        if(isset($field->required)){
            $required = ($field->required == "on" ? $field_data['required'] = True : '');
        }
        if(isset($field->disabled)){
            $disabled = ($field->disabled == "on" ? $field_data['disabled'] = True : '');
        }
        if(isset($field->id)){
            $id = (strlen($field->id) > 0 ? $field_data['id'] = $field->id : '');
        }
        if(empty($field->obj)){
            throw new Exception("Messing with form Fuck you!", 1);
        }
        if(isset($field->label)){
            $label = (strlen($field->label) > 0  ? $field_data['label'] = $field->label : '');
        }
        (empty($field->name) ? $field_data['name'] = randStrGen(7) : $field_data['name'] = $field->name);
        if(isset($field->options)){
            $options = explode(' ', rtrim($field->options));
            $field_data['options'] = $options;
        }
        if(isset($field->class)){
            $field_data['class'] = $field->class;
        }
        $fields[] = array("class"=>$field->obj, "attr"=>$field_data);
        #$fields[] = "new ".$field->class."(".var_export($field_data, true).");";
    }
}

#$f = implode('',$fields);
class MakForm extends DivForm
{
    public function __construct($form_data=null){
        global $fields;
        foreach ($fields as $field) {
            $this->$field['attr']['name'] = new $field['class']($field['attr']);
        }
        $this->submit = new Jokuf\Form\Fields\SubmitButton(["class"=>"btn btn-default"]);
        parent::__construct($form_data);
        $this->div_class("input-field col s12");
    }
}
$c = new MakForm();
echo $c;

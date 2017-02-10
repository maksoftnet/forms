<?php
namespace Jokuf\Form\Validators;


class FileExtensionMatch extends Base
{
	public $extensions = array();

    public function __construct()
    {
        $this->msg = "invalid extension"; 
        foreach(func_get_args() as $extension){
            $this->extensions[] = strtolower(str_replace(".", "", $extension));
        }
        return $this;

    }

    public function __invoke()
    {
        if(func_num_args() == 0){
            throw new \Exception(__FUNCTION__ .' insufficient parameters supplied',
                                 Validator::INSUFFICENT_PARAMETERS);
        }
        $file = func_get_arg(0);
        $file_ext = explode(".", $file["name"]);
        $file_ext = strtolower(str_replace(".", "", end($file_ext)));

        return in_array($file_ext, $this->extensions);
    }
}

?>

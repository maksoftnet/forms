<?php
namespace Jokuf\Form\Validators;


abstract class Base implements Validator
{
    public $msg = "";

    public function format_size($bytes)
    {
        if(is_array($bytes)){
            $bytes = array_shift($bytes);
        }
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' kB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

    public function err_msg($msg){
        $this->msg = $msg;
        return $this;
    }

    public static function init()
    {
        $cls = get_called_class();

        $args = func_get_args();

        #if(version_compare(phpversion(), '5.6.0', '>=')){
        #    return new $cls(...$args);
        #}
        $reflect  = new \ReflectionClass($cls);
        $instance = $reflect->newInstanceArgs($args);
        return $instance;
    }

}


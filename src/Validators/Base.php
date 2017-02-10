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

    public static function init()
    {
        $cls_name = get_called_class();
        return new $cls_name(func_get_args());
    }

}


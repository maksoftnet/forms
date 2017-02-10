<?php
namespace Jokuf\Form\Field;
use Jokuf\Form\Validators\Validator;


interface Field
{
    public function __toString();

    public function is_valid();

    public function add_validator(Validator $validator);

    public static function init();

    const VALIDATOR_FAIL = 101;

    const NOT_CALLABLE = 100;

    const SESSION_NOT_START = 102;

    const INVALID_CSRF_TOKEN = 103;

    const INVALID_DATE = 31;

    const EMPTY_FILE = 1233;
}

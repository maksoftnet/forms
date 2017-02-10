<?php
namespace Jokuf\Form\Validators;
use Jokuf\Form\Exceptions\ValidationError;


interface Files{
    public function __construct();

    public function __invoke();
}

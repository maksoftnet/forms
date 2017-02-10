<?php
namespace Jokuf\Form\Validators;



interface Validator{
    public function __construct();

    public function __invoke();

    const INSUFFICENT_PARAMETERS = 500;
}

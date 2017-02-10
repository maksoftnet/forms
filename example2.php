<?php
include 'vendor/autoload.php';

use Jokuf\Form\Field\Text;
use Jokuf\Form\Field\Email;
use Jokuf\Form\Field\Textarea;
use Jokuf\Form\Field\Submit;
use Jokuf\Form\Exceptions\ValidationError;
use Jokuf\Form\DivForm;


class ContactForm extends DivForm
{
    public function __construct($form_data=null)
    {
        $this->test = Text::init()
                ->add('name' , 'test')
                ->add('required' , True)
                ->add("class", "form-group");
        $this->from = Text::init()
                ->add('label', 'Вашето Име:')
                ->add('class', 'form-control')
                ->add('required', True);

        $this->email = Email::init()
                ->add("label", "Email*")
                ->add("name" , "email")
                ->add("class", 'form-control')
                ->add("required",True);

        $this->subject = Textarea::init()
                ->add("label", "Запитване")
                ->add("name" , "subject")
                ->add("class", 'form-control')
                ->add("required", True);
        $this->submit = Submit::init()
            ->add("class", "btn btn-default")
            ->add("value", "Изпрати");
        parent::__construct($form_data);
    }
}

$form = new ContactForm();
$form->setId('csv_form');
$form->setAction('/url/goes/here.php');
echo $form;

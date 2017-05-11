<?php

use PHPUnit\Framework\TestCase;

use Jokuf\Form\Validators\FileTypeMatch;
use Jokuf\Form\Validators\NotEmpty;
use Jokuf\Form\Field\Files;
use Jokuf\Form\Exceptions\ValidationError;
use Jokuf\Form\BaseForm;
use Jokuf\Form\Field\Text;
use Jokuf\Form\Field\Integer;
use Jokuf\Form\Field\Radio;
use Jokuf\Form\Field\Hidden;
use Jokuf\Form\Field\TextArea;
use Jokuf\Form\Field\Checkbox;
use Jokuf\Form\Field\Submit;


class CommentForm extends BaseForm
{
    public function __construct($post)
    {
        $this->author = Text::init()
            ->add("label", "author")
            ->add("required", true)
            ->add_validator(
                NotEmpty::init(true)
                    ->err_msg("field author cannot be empty")
            );

        $this->email = Text::init()
            ->add("label", "email:")
            ->add("required", true)
            ->add_validator(
                NotEmpty::init(true)
                    ->err_msg("field email cannot be empty")
            );

        $this->subject = Text::init()
            ->add("label", "subject: ")
            ->add("required", true)
            ->add_validator(
                NotEmpty::init(true)
                    ->err_msg("subject cannot be empty")
            );
        $this->checkboxes = Checkbox::init()
            ->add("label", "checkboxes")
            ->add("data", array('asda'=>3, 'asdasda'=>6));

        parent::__construct($post);
    }
}


class TestBaseForm extends TestCase 
{
    public function test_form_populate_with_data()
    {
        $populated = array('author' => 'Radi', 'email' => 'iordanov_@mail.bg', 'subject' => 'test subject', "checkboxes" => 'asda');
        $f = new CommentForm($populated);
        $this->assertEquals($populated['author'], $f->author->value);
        $this->assertEquals($populated['email'], $f->email->value);
        $this->assertEquals($populated['subject'], $f->subject->value);
        $this->assertEquals($populated['checkboxes'], $f->checkboxes->value);
    }
}




<?php
require __DIR__ . "/../vendor/autoload.php";


use PHPUnit\Framework\TestCase;
use Jokuf\Form\Validators\FileTypeMatch;
use Jokuf\Form\Validators\NotEmpty;
use Jokuf\Form\Validators\EmailValidator;
use Jokuf\Form\Field\Files;
use Jokuf\Form\Exceptions\ValidationError;
use Jokuf\Form\Field\Base;
use Jokuf\Form\Field\Text;
use Jokuf\Form\Field\Radio;
use Jokuf\Form\Field\Hidden;
use Jokuf\Form\Field\TextArea;
use Jokuf\Form\Field\Checkbox;
use Jokuf\Form\Field\Submit;
use Jokuf\Form\DivForm;
use Jokuf\Form\BaseForm;
use Jokuf\Form\Bootstrap;


class TestForm extends Bootstrap
{
    public function __construct($data=null)
    {
        $this->checkbox = Checkbox::init()
                            ->add("name", "bulletin[]")
                            ->add("data", array(
                                            "choice 1",
                                            "choice 2",
                                            "choice 3"
                                        )
                                    );
        parent::__construct($data);
    } 
}


class InputFieldClassTest extends TestCase
{
    /**
     * @covers Input::create_field_attribute
     */
    public function test_create_field_attribute()
    {
        $input = Text::init()
            ->add("value", "test")
            ->add("class", "test_class")
            ->add("required", true)
            ->add_validator(NotEmpty::init(true));

        $str = "<input type=\"text\" value=\"test\" class=\"test_class\" required>";
        $this->assertTrue(!empty((string) $input));
        $this->assertEquals($str, trim((string) $input));
    }

    /**
     * @covers Input::create_field_attribute
     */
    public function test_get_label()
    {
        $class = "test_class";
        $input = Text::init()
            ->add("name", "test")
            ->add("value", "test")
            ->add("class", $class)
            ->add("required", true)
            ->add_validator(NotEmpty::init(true));
        $this->assertTrue(empty((string) $input->get_label()));

        $label = sprintf("<label for=\"%s\" class=\"%s\">%s</label>", $input->name, $class, "test label");
        $input->label = "test label";
        $this->assertEquals($label, $input->get_label($class));
    }

    /**
     * @covers Input::is_valid
     * @expectedException Jokuf\Form\Exceptions\ValidationError
     */
    public function test_is_valid()
    {
        $class = "test_class";
        $input = Text::init()
            ->add("name", "test")
            ->add("class", $class)
            ->add("required", true)
            ->add_validator(NotEmpty::init(true));
        $input->is_valid();
    }

    /**
     * @covers Input::is_valid
     */
    public function test_is_valid_with_value()
    {
        $class = "test_class";
        $input = Text::init()
            ->add("name", "test")
            ->add("value", "test_value")
            ->add("class", $class)
            ->add("required", true)
            ->add_validator(NotEmpty::init(true));
        $this->assertTrue($input->is_valid());
    }

    /**
     * @covers Input::__toString
     */
    public function test___toString()
    {
        $class = "test_class";
        $input = Text::init()
            ->add("name", "test")
            ->add("value", "test_value")
            ->add("class", $class)
            ->add("required", true)
            ->add_validator(NotEmpty::init(true));
        $expected = '<input type="text" name="test" value="test_value" class="'.$class.'" required>'.PHP_EOL;
        $this->assertEquals($expected, (string) $input);
    }

    /**
     * @covers EmailValidator::_invoke
     */
    public function test_email_is_valid_expect_true()
    {
        $validator = EmailValidator::init(true);

        $valid_email = 'iordanov_@mail.bg';

        $this->assertTrue($validator($valid_email));
    }

    /**
     * @covers EmailValidator::_invoke
     */
    public function test_email_is_valid_expect_false()
    {
        $validator = EmailValidator::init(true);

        $valid_email = 'iordanov_@mail.';

        $this->assertFalse($validator($valid_email));
        $valid_email = 'iordanov_mail.bg';
        $this->assertFalse($validator($valid_email));
    }

    public function test_checkbox_functionality()
    {
        $f = new TestForm(array("checkbox" => array(0, 1)));
        $f->is_valid();
        echo $f;
        #echo $checkbox;
    }


}

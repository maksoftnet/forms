<?php
require __DIR__ . "/../vendor/autoload.php";


use PHPUnit\Framework\TestCase;
use Jokuf\Form\Validators\FileTypeMatch;
use Jokuf\Form\Validators\NotEmpty;
use Jokuf\Form\Field\Files;
use Jokuf\Form\Exceptions\ValidationError;
use Jokuf\Form\DivForm;
use Jokuf\Form\Field\Text;
use Jokuf\Form\Field\Integer;
use Jokuf\Form\Field\Radio;
use Jokuf\Form\Field\Hidden;
use Jokuf\Form\Field\TextArea;
use Jokuf\Form\Field\Checkbox;
use Jokuf\Form\Field\Submit;



class NewComment extends DivForm
{
    public function __construct($post_data){

        $this->author = Text::init()
            ->add("label", "�����")
            ->add("required", true)
            ->add_validator(
                NotEmpty::init(true)
                    ->err_msg("field author cannot be empty")
            );

        $this->email = Text::init()
            ->add("label", "����� �����:")
            ->add("required", true)
            ->add_validator(
                NotEmpty::init(true)
                    ->err_msg("field email cannot be empty")
            );

        $this->subject = Text::init()
            ->add("label", "��������: ")
            ->add("required", true)
            ->add_validator(
                NotEmpty::init(true)
                    ->err_msg("subject cannot be empty")
            );

        $this->text = Text::init()
            ->add("label", "������ ��������: ")
            ->add("required", true)
            ->add_validator(
                NotEmpty::init(true)
                    ->err_msg("text cannot be emptyt")
            );

        $this->parent = Hidden::init()
            ->add("value", 0)
            ->add_validator(
                NotEmpty::init(true)
                    ->err_msg("parent cannot be empty")
            );

        $this->user_id = Hidden::init()
            ->add("value", 0)
            ->add_validator(
                NotEmpty::init(true)
                    ->err_msg("user_id cannot be null")
            );
        $this->image  = Hidden::init();

        $this->action = Hidden::init()
            ->add("value", "insert_comment")
            ->add_validator(
                NotEmpty::init(true)
                    ->err_msg("action must not be null")
            );

        $this->status = Hidden::init()
            ->add("value", 0)
            ->add_validator(
                NotEmpty::init(true)
                    ->err_msg("status must be set first")
            );

        parent::__construct($post_data);
    }

    public function validate_subject($field){
        $this->subject->value = strip_tags($field->value);
        return true;
    }

    public function validate_author($field){
        $this->subject->value = strip_tags($field->value);
        return true;
    }

    public function validate_text($field){
        $this->subject->value = strip_tags($field->value, '<ul><li><div><ol><h1><h2><h3><h4><pre><code><p><em><strong><blockquote>');
        return true;
    }

    public function save(){
        $this->page->insertComment(
            $this->n,
            $this->subject->value,
            $this->author->value,
            $this->email->value,
            $this->text->value,
            $this->image->value,
            "",
            $this->user_id->value,
            $this->parent->value,
            $this->status->value
        );
    }
}


class TestForm extends \Jokuf\Form\DivForm
{
    public function __construct($form_data=null)
    {
        $this->name = \Jokuf\Form\Field\Text::init(array(
                "name" => "name",
                "class" => "asdasd",
                "id" => "23339213012",
        ));

        $this->SiteID = \Jokuf\Form\Field\Text::init(array(
                "name" => "SiteID",
                "hidden" => True,
        ));
        $this->SiteID->add_validator(Jokuf\Form\Validators\Integerish::init());
        $a = Jokuf\Form\Validators\Integerish::init();
        parent::__construct($form_data);
    }
}


class TestFormEmail extends \Jokuf\Form\DivForm
{
    public function __construct($form_data=null)
    {
        $this->email = \Jokuf\Form\Field\Text::init()
                ->add("class", "asdasd")
                ->add("id"   , "23339213012");

        $this->SiteID = \Jokuf\Form\Field\Text::init()
                ->add("name", "SiteID")
                ->add("hidden", True)
                ->add_validator(Jokuf\Form\Validators\Integerish::init());
        parent::__construct($form_data);
    }
}


class Input extends \Jokuf\Form\DivForm
{
    public function __construct($form_data)
    {
         $this->csv = \Jokuf\Form\Field\Filess::init()
             ->add("name"    , "csv")
             ->add("id"      , "csv")
             ->add("label"   , "Drop csv here")
             ->add("class"   , "form-control")
             ->add("required", True )
             ->add_validator(new Jokuf\Form\Validators\FileTypeMatch("text/csv"));

         $this->images = \Jokuf\Form\Field\Filess::init()
             ->add("label"   , "DropImages Here")
             ->add("name"    , "images[]")
             ->add("id"      , "img")
             ->add("class"   , "form-control")
             ->add("multiple", True)
             ->add_validator(\Jokuf\Form\Validators\FileNotBiggerThan::init(4194304)) // 4MB
             ->add_validator(new FileTypeMatch("image/jpeg"))
             ->add_validator(\Jokuf\Form\Validators\FileExtensionMatch::init("jpg", "JPG", ".jpg"));

         $this->submit = \Jokuf\Form\Field\Submit::init()
            ->add("class", "btn btn-default");
         parent::__construct($form_data);
    }
}


class Validators extends TestCase
{
    public function setUp()
    {
        $_SESSION = array();

        $this->password = Jokuf\Form\Field\Password::init()
            ->add("label", 'Парола')
            ->add("class", 'form-control')
            ->add_validator(new Jokuf\Form\Validators\MaxLength(8))
            ->add_validator(new Jokuf\Form\Validators\MinLength(5))
            ->add_validator(new Jokuf\Form\Validators\HasDigit())
            ->add_validator(new Jokuf\Form\Validators\HasUpperCase());
        $this->special_chars = "?!@#$%^&(*)";
        $this->file = array(
            "name" => "img1.jpg",
            "size" => 512,
            "type" => "image/jpeg"
        );
        $this->file = array("name"     => "adads.csv",
                            "type"     => "text/csv",
                            "size"     => 123213123,
                            "tmp_name" => "tmp/asdasd/");

        $_FILES = array (
            'csv' => array(
                'name' => 'new_import_sheet.csv',
                'type' => 'text/csv',
                'tmp_name' => '/tmp/phpgnWjew',
                'error' => 0, 'size' => 3091,
                ),
            'images' => array (
                'name' => array ( 0 => '354.jpg', 1 => '34914.jpg', 2 => '42365.jpg',),
                'type' => array ( 0 => 'image/jpeg', 1 => 'image/jpeg', 2 => 'image/jpeg',),
                'tmp_name' => array ( 0 => '/tmp/phpUCE5Z9', 1 => '/tmp/phpSiM4w6', 2 => '/tmp/php4ylTk3',),
                'error' => array ( 0 => 0, 1 => 0, 2 => 0,),
                'size' => array ( 0 => 267355, 1 => 51991, 2 => 273041,),)
            );
    }

    /**
     * @covers Jokuf\Form\Validators\NotEmpty::__invoke
     */
    public function test_newCommentForm(){
        $form_data = array(
            "author"  => "Radoslav",
            "email"   => "iordanov_@mail.bg",
            "subject" => "asd",
            "text"    => "comment",
            "parent"  => 0,
            "user_id" => 1424,
            "image"   => "asdlkjasdlkajslkas",
            "status"  => 1,
            "action"  => "insert_comment"
        );

        $save_comment = new NewComment($form_data);
        $save_comment->is_valid(); 
    }

    /**
     * @covers Jokuf\Form\Validators\NotEmpty::__invoke
     */
    public function test_notEmpty_validator(){
        $validator = NotEmpty::init(true);
        $this->assertTrue($validator("asdasa"), "Проверява се дали полето не е empty, очаквана стойност boolean(True)");
        $validator = NotEmpty::init(false);
        $this->assertTrue($validator(), "Проверка дали полето е празно, очаквана стойност boolean(True)");
    }

    /**
     * @covers Jokuf\Form\Validators\FileBiggerThan::__invoke
     */
    public function test_not_bigger_than()
    {
        $file = array(
            "name" => "img1.jpg",
            "size" => 512,
            "type" => "image/jpeg");
        $file_input_field = Files::init()
            ->add("files", $this->file)
            ->add_validator(new Jokuf\Form\Validators\FileBiggerThan(1024));
        $this->assertTrue($file_input_field->is_valid());
    }

    /**
     * @covers Jokuf\Form\Validators\MaxLength::__invoke
     * @covers Jokuf\Form\Validators\MinLength::__invoke
     * @covers Jokuf\Form\Validators\HasDigit::__invoke
     * @covers Jokuf\Form\Validators\HasUpperCase::__invoke
     */
    public function test_mulitple_validators()
    {
        $password = Jokuf\Form\Field\Password::init()
            ->add("label", 'Парола')
            ->add("value", "admni")
            ->add("class", 'form-control')
            ->add_validator(new \Jokuf\Form\Validators\MaxLength(8))
            ->add_validator(new \Jokuf\Form\Validators\MinLength(5))
            ->add_validator(new \Jokuf\Form\Validators\HasDigit())
            ->add_validator(new \Jokuf\Form\Validators\HasUpperCase());
            try {
                $password->is_valid();
            } catch (\Exception $e) {
            }

            $this->assertTrue(count($password->errors) > 0);
    }

    /**
     * @covers Jokuf\Form\Validators\FileExtensionMatch::__invoke
     */
    public function test_add_images()
    {
        $_FILES = array (
                'name' => 'new_import_sheet.pdf',
                'type' => 'text/csv',
                'tmp_name' => '/tmp/phpgnWjew',
                'error' => 0, 'size' => 3091,
            );

        $validator = new \Jokuf\Form\Validators\FileExtensionMatch('.pdf');

        $this->assertTrue($validator($_FILES));
    }

    /**
     * @covers Jokuf\Form\Validators\FileBiggerThan::__invoke
     */
    public function test_bigger_than()
    {
        $case = true;
        $file = array(
            "name" => "img1.jpg",
            "size" => 1512,
            "type" => "image/jpeg");
        $file_input_field = Files::init()
            ->add("files", $this->file)
            ->add_validator(new Jokuf\Form\Validators\FileBiggerThan(1024));
        $this->assertTrue($file_input_field->is_valid());
    }

    /**
     * @covers Jokuf\Form\Validators\FileNotBiggerThan::__invoke
     */
    public function test_filesize_smaller_than_given_value()
    {
        $file = array(
            "name" => "img1.jpg",
            "size" => 200,
            "type" => "image/jpeg");
        $file_input_field = Files::init()
            ->add("files", $this->file)
            ->add_validator(new Jokuf\Form\Validators\FileNotBiggerThan(1024));
        $this->assertTrue($file_input_field->is_valid());
    }

    /**
     * @covers Jokuf\Form\Validators\FileBiggerThan::__invoke
     */
    public function test_bigger_than_no_value()
    {
        $validator = new Jokuf\Form\Validators\FileBiggerThan(1024);
        $code = 0;
        try{
            $validator();
        } catch( \Exception $e){
            $code = $e->getCode();

        }
        $this->assertEquals($validator::INSUFFICENT_PARAMETERS, $code);
    }

    /**
     * @covers Jokuf\Form\Validators\FileTypeMatch::__invoke
     */
    public function test_file_match()
    {
        $file = array(
            "name" => "img1.jpg",
            "size" => 200,
            "type" => "image/jpeg");
        $validator = new Jokuf\Form\Validators\FileTypeMatch("image/jpeg");
        $file_input_field = Files::init()
            ->add("files", $this->file)
            ->add_validator($validator);
        $this->assertTrue($file_input_field->is_valid());
    }

    /**
     * @covers Jokuf\Form\Validators\FileExtensionMatch::__invoke
     */
    public function test_file_extension_assert_False()
    {
        $validator = new Jokuf\Form\Validators\FileExtensionMatch(".JPEG");
        $this->assertFalse($validator($this->file)); //file extension is jpg
    }

    /**
     * @covers Jokuf\Form\Validators\FileExtensionMatch::__invoke
     */
    public function test_file_extension_single_input_assert_True()
    {
        $file = array(
                'name' => 'new_import_sheet.jpg',
                'type' => 'text/csv',
                'tmp_name' => '/tmp/phpgnWjew',
                'error' => 0, 'size' => 3091);
        $validator = new Jokuf\Form\Validators\FileExtensionMatch(".jpg");
        $this->assertTrue($validator($file)); //file extension is jpg
    }

    /**
     * @covers Jokuf\Form\Validators\FileExtensionMatch::__invoke
     */
    public function test_file_extenstion_multiple_assert_True()
    {
        $validator = new Jokuf\Form\Validators\FileExtensionMatch("JPEG", "png", "jpeg", "gif");
        $this->assertFalse($validator($this->file)); //file extension is jpg
    }


    /**
     * @covers Jokuf\Form\Validators\FileExtensionMatch::__invoke
     */
    public function test_file_extenstion_multiple_assert_False()
    {
        $validator = new Jokuf\Form\Validators\FileExtensionMatch("JPEG", "png", "swf", "gif");
        $this->assertFalse($validator($this->file)); //file extension is jpg
    }

    /**
     * @covers Jokuf\Form\Validators\FileTypeMatch::__invoke
     */
    public function test_file_not_match()
    {
        $this->file['type'] = "image/png";
        $validator = new Jokuf\Form\Validators\FileTypeMatch("image/jpeg");
        $this->assertFalse($validator($this->file));
    }

    /**
     * @covers Jokuf\Form\Validators\FileTypeMatch::__invoke
     */
    public function test_file_not_match_no_value_provided()
    {
        $validator = new Jokuf\Form\Validators\FileTypeMatch("image/jpeg");
        $code = 0;
        try{
            $validator();
        } catch( \Exception $e){
            $code = $e->getCode();

        }
        $this->assertEquals($validator::INSUFFICENT_PARAMETERS, $code);
    }

    /**
     * @covers Jokuf\Form\Validators\NotEmpty::__invoke
     */
    public function test_not_empty()
    {
        $validator = new Jokuf\Form\Validators\NotEmpty(True);
        $this->assertTrue($validator("asdasda"));
    }

    /**
     * @covers Jokuf\Form\Validators\NotEmpty::__invoke
     */
    public function test_is_empty()
    {
        $validator = new Jokuf\Form\Validators\NotEmpty(false);
        $this->assertTrue($validator(""), "Must return true if value is empty");
    }

    /**
     * @covers Jokuf\Form\Validators\HasDigit::__invoke
     */
    public function test_has_digit()
    {
        $validator = new Jokuf\Form\Validators\HasDigit();
        $this->assertTrue($validator("asdasd1"));
    }
    /**
     * @covers Jokuf\Form\Validators\HasDigit::__invoke
     */
    public function test_hasnt_digit()
    {
        $validator = new Jokuf\Form\Validators\HasDigit();
        $this->assertFalse($validator("asdasd"));
    }

    /**
     * @covers Jokuf\Form\Validators\HasSpecialChar::__invoke
     */
    public function test_has_special_char()
    {
        $validator = new Jokuf\Form\Validators\HasSpecialChars($this->special_chars);
        $this->assertTrue($validator("jaskdhaskjdhksaj%"));
    }

    /**
     * @covers Jokuf\Form\Validators\HasSpecialChar::__invoke
     */
    public function test_hasn_special_char()
    {
        $validator = new Jokuf\Form\Validators\HasSpecialChars($this->special_chars);
        $this->assertFalse($validator("jaskdhaskjdhksaj"));
    }

    /**
     * @covers Jokuf\Form\Validators\HasUpperCase::__invoke
     */
    public function test_has_upper_case_letter()
    {
        $validator = new Jokuf\Form\Validators\HasUpperCase();
        $this->assertTrue($validator("jaskdhaskjdhksaAAA"));
    }

    /**
     * @covers Jokuf\Form\Validators\HasUpperCase::__invoke
     * @expectedException \Exception
     */
    public function test_hasnt_upper_case_letter()
    {
        $validator = new Jokuf\Form\Validators\HasUpperCase();
        $this->assertFalse($validator("jaskdhaskjdhksaj"));
    }

    /**
     * @covers Jokuf\Form\Validators\MaxLength::__invoke
     */
    public function test_max_length_true()
    {
        $validator = new Jokuf\Form\Validators\MaxLength(10);
        $this->assertTrue($validator("asdfgh"));
    }

    /**
     * @covers Jokuf\Form\Validators\MaxLength::__invoke
     */
    public function test_max_length_false()
    {
        $validator = new Jokuf\Form\Validators\MaxLength(5);
        $this->assertFalse($validator("jaskdhaskjdhksaj"));
    }

    /**
     * @covers Jokuf\Form\Validators\MinLength::__invoke
     */
    public function test_min_length_true()
    {
        $validator = new Jokuf\Form\Validators\MinLength(10);
        $this->assertTrue($validator("asdfghsasasdasdasdas"));
    }
    /**
     * @covers Jokuf\Form\Validators\MinLength::__invoke
     */
    public function test_min_length_false()
    {
        $validator = new Jokuf\Form\Validators\MinLength(5);
        $this->assertFalse($validator("asd"));
    }

    /**
     * @covers Jokuf\Form\Field\Filess::is_valid
     * @covers Jokuf\Form\Validators\FileTypeMatch::__invoke
     */
    public function test_file_input_field_one_file_csv_true()
    {
        $csv = Jokuf\Form\Field\Files::init()
                      ->add("files", array(
                                        "name"     => "adads.csv",
                                        "type"     => "text/csv",
                                        "size"     => 123213123,
                                        "tmp_name" => "tmp/asdasd/"
                                    ));


        $csv->add_validator(new Jokuf\Form\Validators\FileTypeMatch("text/csv"));
        $this->assertTrue($csv->is_valid());
    }

    /**
     * @covers Jokuf\Form\Field\Filess::is_valid
     * @covers Jokuf\Form\Validators\FileTypeMatch::__invoke
     */
    public function test_file_input_field_one_file_not_csv_return_exception()
    {
        $csv = new Jokuf\Form\Field\Files(array(
              "name" => "csv",
              "id"   => "csv",
              "label"=>"Drop csv here",
              "class"=>'form-control',
              "required"=>True ));
        $_FILES['csv']['type'] = "image/jpeg";
        $validator = new Jokuf\Form\Validators\FileTypeMatch("text/csv");
        $csv->add_validator($validator);
        try {
            $csv->is_valid();
        } catch (Exception $e) {
            $this->assertEquals(Jokuf\Form\Field\Base::VALIDATOR_FAIL, $e->getCode());
            $this->assertEquals($validator->msg, $e->getMessage());
        }
    }

    /**
     * @covers Jokuf\Form\Field\Filess::is_valid
     * @covers Jokuf\Form\Validators\FileTypeMatch::__invoke
     */
    public function test_multiple_files_input_filetype_validation_true()
    {
        $images = new Jokuf\Form\Field\Files(array(
            "label"=>"DropImages Here",
            "name" => "images[]",
            "id"   => "img",
            "class"=>'form-control',
            "multiple" => True,
            ));
        $images->add_validator(new Jokuf\Form\Validators\FileTypeMatch("image/jpeg"));
        $this->assertTrue($images->is_valid());
    }


    /**
     * @covers Jokuf\Form\Field\Filess::is_valid
     * @covers Jokuf\Form\Validators\FileNotBiggerThan::__invoke
     */
    public function test_is_valid_with_no_files_attached()
    {
        $images = new Jokuf\Form\Field\Files(array(
            "label"=>"DropImages Here",
            "name" => "images",
            "id"   => "img",
            "class"=>'form-control',
            "multiple" => True,
            ));
    $_FILES = array();
        try {
        $images->add_validator(new Jokuf\Form\Validators\FileNotBiggerThan(2000000));
            $images->is_valid();
        } catch (Exception $e) {
            $this->assertEquals("no files attached. What to validate?", $e->getMessage());
        }
    }


    /**
     * @covers Jokuf\Form\Field\Filess::is_valid
     * @covers Jokuf\Form\Validators\FileTypeMatch::__invoke
     */
    public function test_multiple_files_input_filetype_validation_expect_exception()
    {
        $images = new Jokuf\Form\Field\Files(array(
            "label"=>"DropImages Here",
            "name" => "images[]",
            "id"   => "img",
            "class"=>'form-control',
            "multiple" => True,
            ));
        $validator = new Jokuf\Form\Validators\FileTypeMatch("image/gif");
        $images->add_validator($validator);
        try {
            $images->is_valid();
        } catch (Exception $e) {
            $this->assertEquals(Jokuf\Form\Field\Base::VALIDATOR_FAIL, $e->getCode());
            $this->assertEquals($validator->msg, $e->getMessage());
        }
    }

    /**
     * @covers Jokuf\Form\Field\Files::is_valid
     * @covers Jokuf\Form\Field\Files::add_validator
     * @covers Jokuf\Form\Validator\FileNotBiggerThan::__invoke
     */
    public function test_multiple_files_input_filesize_validator_expect_exception()
    {
        $images = new Jokuf\Form\Field\Files(array(
            "label"=>"DropImages Here",
            "name" => "images[]",
            "id"   => "img",
            "class"=>'form-control',
            "multiple" => True,
            ));
        $validator = new Jokuf\Form\Validators\FileNotBiggerThan(123);
        $images->add_validator($validator);
        try {
            $images->is_valid();
        } catch (Exception $e) {
            $this->assertEquals(Jokuf\Form\Field\Base::VALIDATOR_FAIL, $e->getCode());
            $this->assertEquals($validator->msg, $e->getMessage());
        }
    }

    /**
     * @covers Jokuf\Form\Field\Filess::is_valid
     */
    public function test_multiple_files_input_filesize_validator_expect_true()
    {
        $images = new Jokuf\Form\Field\Files(array(
            "label"=>"DropImages Here",
            "name" => "images[]",
            "id"   => "img",
            "class"=>'form-control',
            "multiple" => True,
            ));
        $validator = new Jokuf\Form\Validators\FileNotBiggerThan(1212333);
        $images->add_validator($validator);
        $this->assertTrue($images->is_valid());
    }
    /**
     * @covers Jokuf\Form\Validators\Password::__invoke
     * @expectedException \Jokuf\Form\Exceptions\ValidationError
     */
    public function test_is_valid_must_throw_ValidationError()
    {
        $this->password->value = 'asda';
        $this->password->is_valid();
    }

    /**
     * @covers Jokuf\Form\Validators\Password::__invoke
     */
    public function test_check_that_all_validators_added_to_password_field_are_valid()
    {
        $password = Jokuf\Form\Field\Password::init()
                        ->add("name", "password")
                        ->add("label", 'Парола')
                        ->add("class", 'form-control');
        $password->add_validator(new Jokuf\Form\Validators\MaxLength(8));
        $password->add_validator(new Jokuf\Form\Validators\MinLength(4));
        $password->add_validator(new Jokuf\Form\Validators\HasDigit());
        $password->add_validator(new Jokuf\Form\Validators\HasUpperCase());
        $password->add_validator(new Jokuf\Form\Validators\HasSpecialChars("?!@#$%^&(*)"));
        $password->value = 'd5A!k';
        $this->assertEquals($password->is_valid(), True);
    }
    /**
     * @covers Jokuf\Form\Validators\Password::__invoke
     * @expectedException Jokuf\Form\Exceptions\ValidationError
     */
    public function test_check_that_all()
    {
        $this->password->value = '.';
        $this->password->is_valid();
    }

    /**
     * @covers Jokuf\Form\Validators\HasSpecialChars::__invoke
     * @covers Jokuf\Form\Validators\MaxLength::__invoke
     * @covers Jokuf\Form\Validators\MinLength::__invoke
     * @covers Jokuf\Form\Validators\HasDigit::__invoke
     * @covers Jokuf\Form\Validators\HasUpperCase::__invoke
     * @covers Jokuf\Form\Field\Password::is_valid
     */
    public function test_testAddValidators_on_success()
    {
        $this->password->add_validator(new Jokuf\Form\Validators\HasSpecialChars('%&%*'));
        $this->password->value = "A3&n0A%%";
        $this->assertTrue($this->password->is_valid());
    }

    public function test_Form_cleaned_fields_not_exist_extra_information_passed_to_form()
    {
        $form = new TestForm();
        $post = array("name" => "adkksakld", "SiteID" => '999', "csrf" => 'asdasd');
        $form = new TestForm($post);
        $form->is_valid();
        $this->assertNotEquals(json_encode($post), $form->save());
    }

    /**
     * @covers Jokuf\Form\Validators\Email::__invoke
     */
    public function test_email_validator()
    {
        $email = "sales@Jokuf.bg";
        $validator = new \Jokuf\Form\Field\Email();
        $validator->value=$email;
        $this->assertTrue($validator->is_valid());
    }

    /**
     * @covers Jokuf\Form\Validators\Email::__invoke
     * @covers Jokuf\Form\BaseForm::is_valid()
     */
    public function test_form_with_email()
    {
        $post = array("email" => "sales@Jokuf.bg", "SiteID" => '999');
        $form = new TestFormEmail($post);
        $this->assertTrue(boolval($form->is_valid()));
    }

    /**
     * @covers Jokuf\Form\Validators\Integerish::__invoke
     */
    public function test_validators_integerish_assert_true()
    {
        $validator = new \Jokuf\Form\Validators\Integerish();
        $this->assertTrue($validator("50"));
    }

    /**
     * @covers Jokuf\Form\Validators\Integerish::__invoke
     * @expectedException Jokuf\Form\Exceptions\ValidationError
     */
    public function test_validators_integerish_assert_false()
    {
        $validator = new \Jokuf\Form\Validators\Integerish();
        $validator("50sa");
    }

    /**
     * @covers Jokuf\Form\Validators\Integerish::__invoke
     * @expectedException Jokuf\Form\Exceptions\ValidationError
     */
    public function test_validators_integerish_float__assert_false()
    {
        $validator = new \Jokuf\Form\Validators\Integerish();
        $validator("1.123");
        $validator(1.123);
    }

    /**
     * @covers Jokuf\Form\Validators\Integerish::__invoke
     * @expectedException Jokuf\Form\Exceptions\ValidationError
     */
    public function test_DateField_default_validation()
    {
        $date = \Jokuf\Form\Field\Date::init()
                    ->add("name",  "to_date")
                    ->add("id", "to_date")
                    ->add("value", "28.02.1988");
        $date->set_format('Y%m%d');
        $this->assertEquals("1988%02%28", (string) $date->is_valid(),
            "Проверява дали връща валидна дата в предварително  зададен формат"
        );

        $code = 0;

        $date->value = "kljsahsadjfas";
        $date->is_valid();

        $date->value = "02.02.jsadhsakj";
        $code = 0;
        $date->is_valid();
        $code = $e->getCode();

        $date->value = "2016";
        $code = 0;
        $this->assertEquals(date('Y%m%d',time()), (string) $date->is_valid(),
            "При въвеждане само на година трябва да върне
            днешната дата в предаврително зададеният формат"
        );
    }
    /**
     * @covers Jokuf\Form\Validators\PhoneField::__invoke
     * @expectedException Jokuf\Form\Exceptions\ValidationError
     */
    public function test_PhoneField()
    {
        $phone = new \Jokuf\Form\Field\Phone();
        $phone->value= "02/8464646";
        $this->assertTrue($phone->is_valid(), "Валидира номера по регулярен израз и връща True ако е валиден");

        $phone->value= "02/846464s6";
        $code = 0;
        $phone->is_valid();

        $this->assertEquals(33, $code);

        $phone->value= "+35902/846464s6";
        $code = 0;
        $phone->is_valid();
        $this->assertEquals(33, $code);

        $phone->value= "+35902/8464646";
        $this->assertTrue($phone->is_valid(), "Валидира номера по регулярен израз и връща True ако е валиден");
    }
    /**
     * @covers Jokuf\Form\Field\Radio::as_array
     */
    public function test_radio_as_array_method()
    {
        $data = array(
            "asdsad asd sad sa",
            "asd asdas dasd ds",
            "ads asdojsdklpoqeiqpwoe",
        );
        $radio = Radio::init()
                        ->add("choices", $data);
        $this->assertCount(3, $radio->as_array(), "Проверява дали при зададени 3 чекбокса връща точно 3");
    }


    /**
     * @covers Jokuf\Form\Field\Integer::is_valid
     * @expectedException Jokuf\Form\Exceptions\ValidationError
     */
    public function test_integer_field()
    {
        $this->assertTrue(Integer::init()->add("value", "123")->is_valid());
        Integer::init()->add("value", "123a")->is_valid();
    }

    /**
     * @covers Jokuf\Form\Field\Checkbox::as_array
     */
    public function test_checkbox_as_array_method()
    {
        $data = array(
            "asdsad asd sad sa",
            "asd asdas dasd ds",
            "ads asdojsdklpoqeiqpwoe",
        );
        $checkbox = Checkbox::init()
                        ->add("choices", $data);
        $this->assertCount(3, $checkbox->as_array(), "Проверява дали при зададени 3 чекбокса връща точно 3");
    }

}

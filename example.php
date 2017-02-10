<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<?php

session_start();
#$_SESSION = array();

include 'vendor/autoload.php';
use \Jokuf\Form\DivForm;
use \Jokuf\Form\Field\Email;
use \Jokuf\Form\Field\Password;
use \Jokuf\Form\Field\Textarea;
use \Jokuf\Form\Field\RepeatPassword;
use \Jokuf\Form\Field\Submit;
use \Jokuf\Form\Field\Text;


class LoginForm extends DivForm
{
    public function __construct($form_data=null)
    {
        $this->email = new Email([
            "label"=>"Въведи Email",
            "name"=>"email",
            "class"=>'form-control',
            "required"=>False ]);
        $this->password = new Password([
            "label"=>'Парола',
            "name"=>"password",
            "class"=>'form-control']);
        $this->password->add_validators(new \Jokuf\Form\Validators\MaxLength(8));
        $this->password->add_validators(new \Jokuf\Form\Validators\MinLength(5));
        $this->password->add_validators(new \Jokuf\Form\Validators\HasDigit());
        $this->password->add_validators(new \Jokuf\Form\Validators\HasUpperCase());
        $this->password23 = new RepeatPassword([
            "label"=>'Повторете паролata',
            "name"=>"password23",
            "class"=>'form-control']);
        $this->textarea = new Textarea([
            "name"=>"textarea",
            "cols"=>50,
            "rows"=>30,
            "required"=>false]);

        $this->csrf = \Jokuf\Form\Field\CsrfToken::init();
        $this->submit = new Submit(["class"=>"btn btn-default"]);
        parent::__construct($form_data);
    }

    public function validate_password($pwd_field)
    {
        if($this->password->value === $this->password23->value)
            return True;
        throw new \Jokuf\Form\Exceptions\ValidationError("Password does not match!", 1);
    }
}

var_dump($_SESSION);
var_dump($_POST);
?>
<div class="row">
  <div class="col-md-4 col-md-offset-4">
        <pre><b>Abstraction over forms</b></pre>
        <hr>
        <br>
        <?php
        $_SERVER['REQUEST_METHOD'] = "POST";
        if($_SERVER['REQUEST_METHOD'] === "POST"):
            $form = new LoginForm($_POST);
            try {
                $form->is_valid();
                echo '<div class="alert alert-success" role="alert">Passed validation</div>';
            } catch (Exception $e) {
            ?>
            <div class="alert alert-danger" role="alert">
                  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                  <span class="sr-only">Error:</span>
                  <?php echo iconv('cp1251', 'utf8', $e->getMessage()); ?>
            </div>
            <?php
            }
            echo $form;
        else:
            $form = new LoginForm();
            $form->setAction($_SERVER['PHP_SELF']);
            echo $form;
        endif;
        ?>
    </div>
</div>

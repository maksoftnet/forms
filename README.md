# Make some abstraction over forms #


### What is this repository for? ###

* This is for people who is bored to make another validation over simple form.

### Contribution guidelines ###

* Writing tests
* Code review
* Refactoring code
* Extend functionality

### TODO ###
* extend BaseField class with getLabel method

### How it works ###
```php
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

        $this->email = Email::init() //the name attribute is auto added if isnt set
                ->add("label", "Email*")
                ->add("class", 'form-control')
                ->add("required",True);

        $this->subject = Textarea::init()
                ->add("label", "Запитване")
                ->add("class", 'form-control')
                ->add("required", True);
        $this->submit = Submit::init()
            ->add("class", "btn btn-default")
            ->add("value", "Изпрати");
        parent::__construct($form_data);
    }
}

```
In view
```php
<?php
$form = new ContactForm();
$form->setId('csv_form');
$form->setAction('/url/goes/here.php');
?>
```

In Template
```php
<?php 
echo $form; // and that`s it
?>
```
This produce the following code
```html
<form id="csv_form" enctype="application/x-www-form-urlencoded" method="POST" action="/url/goes/here.php" >
  <div class="form-group">
    <label for="name">Вашето име:</label>
    <input type="text" name="name" label="Вашето име:" class="form-control"  required >
  </div>
  <div class="form-group">
    <label for="email">Email*</label>
    <input type="email" name="email" label="Email*" class="form-control"  required >
  </div>
  <div class="form-group">
    <label for="subject">Запитване</label>
    <textarea name="subject" label="Запитване" class="form-control"  required ></textarea>
  </div>
  <div class="form-group">
    <input type="submit" class="btn btn-default" >
  </div>

</form>
```

Example login form is included in package, check it.

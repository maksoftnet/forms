<?php

include 'vendor/autoload.php';

?>


<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico in the root directory -->
          <!-- Compiled and minified CSS -->
          <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">

<script   src="https://code.jquery.com/jquery-3.1.0.min.js"   integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="   crossorigin="anonymous"></script>



    </head>
    <body>
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <h3>Form Builder</h3>

        <div class="container">
            <div class="row">
                <div class="col m4">
                  <ul class="collapsible" data-collapsible="accordion">
                      <li>
                        <div class="collapsible-header"><i class="material-icons prefix">mode_edit</i>Text Field</div>
                        <div class="collapsible-body">
                              <form name="input" class="col m12">
                                <div class="row">
                                  <div class="input-field col s12">
                                    <input name="name" id="name" type="text" class="validate" required>
                                    <label for="name">name</label>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="input-field col s12">
                                    <input name="class" id="class" type="text" class="validate">
                                    <label for="class">Class</label>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="input-field col s12">
                                    <input name="id" id="id" type="text" class="validate">
                                    <label for="id">id</label>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="input-field col s12">
                                    <input name="label" id="label" type="text" class="validate">
                                    <label for="label">Label Text</label>
                                  </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 m6">
                                        <label for="required">
                                            <i class="tiny material-icons orange-text text-darken-3">star</i>
                                            Required
                                        </label>
                                        <div class="switch">
                                            <label>
                                              No
                                              <input name="required" id="required" type="checkbox">
                                              <span class="lever"></span>
                                              Yes
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col s12 m6">
                                        <label for="required">
                                            <i class="tiny material-icons orange-text text-darken-3">star</i>
                                            Disabled
                                        </label>
                                        <div class="switch">
                                            <label>
                                              No
                                              <input name="disabled" id="disabled" type="checkbox">
                                              <span class="lever"></span>
                                              Yes
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="obj" value="Jokuf\Form\Fields\TextField">
                                <button class="btn waves-effect waves-light" type="submit" name="action">Добави
                                  <i class="material-icons right">send</i>
                                </button>
                              </form>
                        </div>
                      </li>
                      <li>
                        <div class="collapsible-header"><i class="material-icons prefix">email</i>Email Field</div>
                        <div class="collapsible-body">
                            <form class="col s12">
                              <div class="row">
                                <div class="input-field col s12">
                                  <input name="name" id="name" type="text" class="validate">
                                  <label for="name">Name</label>
                                </div>
                              </div>
                              <div class="row">
                                <div class="input-field col s12">
                                  <input name="class" id="class" type="text" class="validate">
                                  <label for="class">Class</label>
                                </div>
                              </div>
                              <div class="row">
                                <div class="input-field col s12">
                                  <input name="id" id="id" type="text" class="validate">
                                  <label for="id">ID</label>
                                </div>
                              </div>
                              <div class="row">
                                <div class="input-field col s12">
                                  <input name="label" id="label" type="text" class="validate">
                                  <label for="label">Label Text</label>
                                </div>
                              </div>
                              <div class="row">
                                  <div class="col s12 m6">
                                      <label for="required">
                                          <i class="tiny material-icons orange-text text-darken-3">star</i>
                                          Required
                                      </label>
                                      <div class="switch">
                                          <label>
                                            No
                                            <input name="required" id="required" type="checkbox">
                                            <span class="lever"></span>
                                            Yes
                                          </label>
                                      </div>
                                  </div>
                                  <div class="col s12 m6">
                                      <label for="required">
                                          <i class="tiny material-icons orange-text text-darken-3">star</i>
                                          Disabled
                                      </label>
                                      <div class="switch">
                                          <label>
                                            No
                                            <input name="disabled" id="disabled" type="checkbox">
                                            <span class="lever"></span>
                                            Yes
                                          </label>
                                      </div>
                                  </div>
                              </div>
                              <input type="hidden" name="obj" value="Jokuf\Form\Fields\EmailField">
                              <button class="btn waves-effect waves-light" type="submit" name="action">Добави
                                <i class="material-icons right">send</i>
                              </button>
                            </form>
                        </div>
                      </li>
                      <li>
                        <div class="collapsible-header"><i class="material-icons prefix">lock</i>Password Field</div>
                        <div class="collapsible-body">
                            <form class="col s12">
                              <div class="row">
                                <div class="input-field col s12">
                                  <input name="name" id="name" type="text" class="validate">
                                  <label for="name">Name</label>
                                </div>
                              </div>
                              <div class="row">
                                <div class="input-field col s12">
                                  <input name="class" id="class" type="text" class="validate">
                                  <label for="class">Class</label>
                                </div>
                              </div>
                              <div class="row">
                                <div class="input-field col s12">
                                  <input name="id" id="id" type="text" class="validate">
                                  <label for="id">ID</label>
                                </div>
                              </div>
                              <div class="row">
                                <div class="input-field col s12">
                                  <input name="label" id="label" type="text" class="validate">
                                  <label for="label">Label Text</label>
                                </div>
                              </div>
                              <div class="row">
                                  <div class="col s12 m6">
                                      <label for="required">
                                          <i class="tiny material-icons orange-text text-darken-3">star</i>
                                          Required
                                      </label>
                                      <div class="switch">
                                          <label>
                                            No
                                            <input name="required" id="required" type="checkbox">
                                            <span class="lever"></span>
                                            Yes
                                          </label>
                                      </div>
                                  </div>
                                  <div class="col s12 m6">
                                      <label for="required">
                                          <i class="tiny material-icons orange-text text-darken-3">star</i>
                                          Disabled
                                      </label>
                                      <div class="switch">
                                          <label>
                                            No
                                            <input name="disabled" id="disabled" type="checkbox">
                                            <span class="lever"></span>
                                            Yes
                                          </label>
                                      </div>
                                  </div>
                              </div>
                              <input type="hidden" name="obj" value="Jokuf\Form\Fields\PasswordField">
                              <button class="btn waves-effect waves-light" type="submit" name="action">Добави
                                <i class="material-icons right">send</i>
                              </button>
                            </form>
                        </div>
                      </li>
                      <li>
                        <div class="collapsible-header"><i class="material-icons prefix">list</i>Select Field</div>
                        <div class="collapsible-body">
                            <form class="col s12">
                              <div class="row">
                                <div class="input-field col s12">
                                  <input name="name" id="name" type="text" class="validate">
                                  <label for="name">Name</label>
                                </div>
                              </div>
                              <div class="row">
                                <div class="input-field col s12">
                                  <input name="class" id="class" type="text" class="validate">
                                  <label for="class">Class</label>
                                </div>
                              </div>
                              <div class="row">
                                <div class="input-field col s12">
                                  <input name="id" id="id" type="text" class="validate">
                                  <label for="id">ID</label>
                                </div>
                              </div>
                              <div class="row">
                                <div class="input-field col s12">
                                  <input name="label" id="label" type="text" class="validate">
                                  <label for="label">Label Text</label>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col s12">
                                  <div class="input-field col s12">
                                    <textarea name="options" id="textarea1" class="materialize-textarea"></textarea>
                                    <label for="textarea1">Textarea</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                  <div class="col s12 m6">
                                      <label for="required">
                                          <i class="tiny material-icons orange-text text-darken-3">star</i>
                                          Required
                                      </label>
                                      <div class="switch">
                                          <label>
                                            No
                                            <input name="required" id="required" type="checkbox">
                                            <span class="lever"></span>
                                            Yes
                                          </label>
                                      </div>
                                  </div>
                                  <div class="col s12 m6">
                                      <label for="required">
                                          <i class="tiny material-icons orange-text text-darken-3">star</i>
                                          Disabled
                                      </label>
                                      <div class="switch">
                                          <label>
                                            No
                                            <input name="disabled" id="disabled" type="checkbox">
                                            <span class="lever"></span>
                                            Yes
                                          </label>
                                      </div>
                                  </div>
                              </div>
                              <input type="hidden" name="obj" value="Jokuf\Form\Fields\SelectField">
                              <button class="btn waves-effect waves-light" type="submit" name="action">Добави
                                <i class="material-icons right">send</i>
                              </button>
                            </form>
                        </div>
                      </li>
                      <li>
                        <div class="collapsible-header"><i class="material-icons prefix">textsms</i>Text Area</div>
                        <div class="collapsible-body">
                            <form class="col s12">
                              <div class="row">
                                <div class="input-field col s12">
                                  <input name="name" id="name" type="text" class="validate">
                                  <label for="name">Name</label>
                                </div>
                              </div>
                              <div class="row">
                                <div class="input-field col s12">
                                  <input name="class" id="class" type="text" class="validate">
                                  <label for="class">Class</label>
                                </div>
                              </div>
                              <div class="row">
                                <div class="input-field col s12">
                                  <input name="id" id="id" type="text" class="validate">
                                  <label for="id">ID</label>
                                </div>
                              </div>
                              <div class="row">
                                <div class="input-field col s12">
                                  <input name="label" id="label" type="text" class="validate">
                                  <label for="label">Label Text</label>
                                </div>
                              </div>
                              <div class="row">
                                  <div class="col s12 m6">
                                      <label for="required">
                                          <i class="tiny material-icons orange-text text-darken-3">star</i>
                                          Required
                                      </label>
                                      <div class="switch">
                                          <label>
                                            No
                                            <input name="required" id="required" type="checkbox">
                                            <span class="lever"></span>
                                            Yes
                                          </label>
                                      </div>
                                  </div>
                                  <div class="col s12 m6">
                                      <label for="required">
                                          <i class="tiny material-icons orange-text text-darken-3">star</i>
                                          Disabled
                                      </label>
                                      <div class="switch">
                                          <label>
                                            No
                                            <input name="disabled" id="disabled" type="checkbox">
                                            <span class="lever"></span>
                                            Yes
                                          </label>
                                      </div>
                                  </div>
                              </div>
                              <input type="hidden" name="obj" value="Jokuf\Form\Fields\TextAreaField">
                              <button class="btn waves-effect waves-light" type="submit" name="action">Добави
                                <i class="material-icons right">send</i>
                              </button>
                            </form>
                        </div>
                      </li>

                      <li>
                        <div class="collapsible-header"><i class="material-icons prefix">assignment</i>File Input</div>
                        <div class="collapsible-body">
                            <form class="col s12">
                              <div class="row">
                                <div class="input-field col s12">
                                  <input name="name" id="name" type="text" class="validate">
                                  <label for="name">Name</label>
                                </div>
                              </div>
                              <div class="row">
                                <div class="input-field col s12">
                                  <input name="class" id="class" type="text" class="validate">
                                  <label for="class">Class</label>
                                </div>
                              </div>
                              <div class="row">
                                <div class="input-field col s12">
                                  <input name="id" id="id" type="text" class="validate">
                                  <label for="id">ID</label>
                                </div>
                              </div>
                              <div class="row">
                                <div class="input-field col s12">
                                  <input name="label" id="label" type="text" class="validate">
                                  <label for="label">Label Text</label>
                                </div>
                              </div>
                              <div class="row">
                                  <div class="col s12 m6">
                                      <label for="required">
                                          <i class="tiny material-icons orange-text text-darken-3">star</i>
                                          Required
                                      </label>
                                      <div class="switch">
                                          <label>
                                            No
                                            <input name="required" id="required" type="checkbox">
                                            <span class="lever"></span>
                                            Yes
                                          </label>
                                      </div>
                                  </div>
                                  <div class="col s12 m6">
                                      <label for="required">
                                          <i class="tiny material-icons orange-text text-darken-3">star</i>
                                          Disabled
                                      </label>
                                      <div class="switch">
                                          <label>
                                            No
                                            <input name="disabled" id="disabled" type="checkbox">
                                            <span class="lever"></span>
                                            Yes
                                          </label>
                                      </div>
                                  </div>
                              </div>
                              <input type="hidden" name="obj" value="Jokuf\Form\Fields\FileInputField">
                              <button class="btn waves-effect waves-light" type="submit" name="action">Добави
                                <i class="material-icons right">send</i>
                              </button>
                            </form>
                        </div>
                      </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col m7 push-m1">
                      <div class="card">
                        <div class="card-content">
                          <span class="card-title">My form name</span>
                          <div id="fields"> </div>
                        </div>
                        <div class="card-action">
                          <a href="#">This is a link</a>
                          <a href="#">This is a link</a>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>

            <div id="results" class="col m12">
                <pre>
                    <code id="html"> </code>
                </pre>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
        <script>
            var fields = [];
            $("form").each(function(){
                $(this).submit(function(e){
                    e.preventDefault();
                    console.log($(this));
                    var form_data = $(this).serializeArray();
                    var data = {};
                    $(form_data ).each(function(index, obj){
                        data[obj.name] = obj.value;
                    });
                    fields.push(data);
                    var json = JSON.stringify(fields);
                    $.post("field_api.php", {data: json}, function(result){
                        $("#fields").html(result);
                        $("#html").text(result).html();
                    $('select').material_select();
                    });


                });
            });
        </script>

        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.4.min.js"><\/script>')</script>

        <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
<script>
$(document).ready(function() {
    $('select').material_select();
});
$(document).ready(function(){
  $('.collapsible').collapsible({
    accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
  });
});

            window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
            ga('create','UA-XXXXX-Y','auto');ga('send','pageview')
        </script>
        <script src="https://www.google-analytics.com/analytics.js" async defer></script>
    </body>
</html>

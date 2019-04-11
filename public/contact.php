<?php
require '../core/processContactForm.php';
//Declare namespaces
use About\Validation;
$valid = new About\Validation\Validate();
$args = [
  'firstName'=>FILTER_SANITIZE_STRING,
  'lastName'=>FILTER_SANITIZE_STRING,
  'email'=>FILTER_SANITIZE_EMAIL,
  'subject'=>FILTER_SANITIZE_STRING,
  'comment'=>FILTER_SANITIZE_STRING,
];
$input = filter_input_array(INPUT_POST, $args);

$message=null;
if(!empty($input)){

  $valid->validation = [        
      'firstName'=>[[
          'rule'=>'notEmpty',
          'message'=>'Please enter your first name'
      ]],
      'lastName'=>[[
        'rule'=>'notEmpty',
        'message'=>'Please enter your last name'
      ]],
      'email'=>[[
        'rule'=>'email',
        'message'=>'Please enter a valid email'
            ],[
              'rule'=>'notEmpty',
              'message'=>'Please enter an email'
      ]],
      'comment'=>[[
          'rule'=>'notEmpty',
          'message'=>'Please add a comment'
      ]],
  ];

  $valid->check($input);

  if(empty($valid->errors)){
      $message = "<div class=\"alert alert-success\">Your form has been submitted!</div>";
      //header('Location: thanks.php');
  }else{
      $message = "<div class=\"alert alert-danger\">Your form has errors!</div>";
  }
}

$meta=[];
$meta['title']='Contact Chris';
$meta['description']='My Contact Page';
$meta['keywords']=false;

$content=<<<EOT
  <form action="contact.php" method="POST">
    <div id=thanks class="quickFade">
      Thank you for taking interest in having something creatively constructed by Chris. It will be a pleasure to serve you.
    </div>

    {$message}
    
<form action="contact.php" method="POST">
  
  <input type="hidden" name="subject" value="New submission!">
  
  <div class="form-group">
    <label for="firstName">First Name</label>
    <input class="form-control" id="firstName" type="text" name="name" value="{$valid->userInput('name')}">
    <div class="text-danger">{$valid->error('name')}</div>
  </div>

  <div class="form-group">
    <label for="lastName">Last Name</label>
    <input class="form-control" id="lastName" type="text" name="name" value="{$valid->userInput('name')}">
    <div class="text-danger">{$valid->error('name')}</div>
  </div>

  <div class="form-group">
    <label for="email">Email</label>
    <input class="form-control" id="email" type="text" name="email" value="{$valid->userInput('email')}">
    <div class="text-danger">{$valid->error('email')}</div>
  </div>

  <div class="form-group">
    <label for="comment">Comment</label>
    <textarea class="form-control" id="message" name="message">{$valid->userInput('message')}</textarea>
    <div class="text-danger">{$valid->error('message')}</div>
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" value="Send">
  </div>

</form>
  <div>
    <input type="hidden" name="subject" value="New submission!">
  </div>
</div>
EOT;

require '../core/layout.php';
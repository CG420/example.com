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
      $message = "<div class=\"message-success\">Your form has been submitted!</div>";
      //header('Location: thanks.php');
  }else{
      $message = "<div class=\"message-error\">Your form has errors!</div>";
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

    <table id="table1" height="500px width="900px">
      <thead>
        <div id="tablehead">Please Fill out a Contact Form and I will get back to you as soon as possible.</div>
      </thead>
      <tbody class="quickFade">
        <tr class="quickFade delayOne">
          <td valign="top">
            <label for="first_name">First Name *</label>
          </td>
          <td valign="top">
            <input id="firstName" type="text" name="firstName" maxlength="50" size="30">
            <div class="text-error">{$valid->error('firstName')}</div>
          </td>
        </tr>

        <tr class="quickFade delayTwo">
          <td valign="top"">
            <label for="last_name">Last Name *</label>
          </td>
          <td valign="top">
            <input id="lastName" type="text" name="lastName" maxlength="50" size="30">
            <div class="text-error">{$valid->error('lastName')}</div>
          </td>
        </tr>

        <tr class="quickFade delayThree">
          <td valign="top">
            <label for="email">Email Address *</label>
          </td>
          <td valign="top">
            <input id="email" type="text" name="email" maxlength="80" size="30">
            <div class="text-error">{$valid->error('email')}</div>
          </td>
        </tr>

        <tr class="quickFade delayFour">
          <td valign="top">
            <label for="telephone">Telephone Number</label>
          </td>
          <td valign="top">
            <input type="text" name="telephone" maxlength="30" size="30">
          </td>
        </tr>

        <tr class="quickFade delayFive">
          <td valign="top">
            <label for="comment">Comments *</label>
          </td>
          <td valign="top">
            <textarea id="comment" name="comment" maxlength="1000" cols="25" rows="6"></textarea>
            <div class="text-error">{$valid->error('message')}</div>
          </td>
        </tr>

        <tr class="quickFade delaySix">
          <td colspan="2" style="text-align:center">
            <button>Submit</button>
          </td>
        </tr>
      </tbody>
    </table>
  </form>

  <div>
    <input type="hidden" name="subject" value="New submission!">
  </div>
</div>
EOT;

require '../core/layout.php';
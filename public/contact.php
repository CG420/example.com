<?php
//Include non-vendor files
require '../core/About/src/Validation/Validate.php';

//Declare Namespaces
use About\Validation;

//Validate Declarations
$valid = new About\Validation\Validate();
$args = [
  'name'=>FILTER_SANITIZE_STRING,
  'subject'=>FILTER_SANITIZE_STRING,
  'message'=>FILTER_SANITIZE_STRING,
  'email'=>FILTER_SANITIZE_EMAIL,
];
$input = filter_input_array(INPUT_POST, $args);

if(!empty($input)){

    $valid->validation = [
        'first_name'=>[[
            'rule'=>'notEmpty',
            'message'=>'Please enter your first name'
        ]],
        'last_name'=>[[
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
        'subject'=>[[
            'rule'=>'notEmpty',
            'message'=>'Please enter a subject'
        ]],
        'message'=>[[
            'rule'=>'notEmpty',
            'message'=>'Please add a message'
        ]],
    ];


    $valid->check($input);
}

if(empty($valid->errors) && !empty($input)){
    $message = "<div>Success!</div>";
}else{
    $message = "<div>Error!</div>";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Chris</title>
  <link rel="stylesheet" type="text/css" href="./dist/css/contact.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<header>
  <span class="logo">Chris' WebSite</span>
  <a id="toggleMenu">Menu<a></a>
    <nav>
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="resume.html">Resume</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </nav>
</header>

<body>
  <div id="cv" class="instaFade">
  <form action="contact.php" method="POST">
    <div id=thanks class="quickFade">
      Thank you for taking interest in having something creatively constructed by Chris. It will be a pleasure to serve you.
    </div>

    <?php echo (!empty($message)?$message:null); ?>
    
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
            <input id="firstName" type="text" name="first_name" maxlength="50" size="30">
            <div class="text-error"><?php echo $valid->error('firstName'); ?></div>
          </td>
        </tr>

        <tr class="quickFade delayTwo">
          <td valign="top"">
            <label for="last_name">Last Name *</label>
          </td>
          <td valign="top">
            <input id="lastName" type="text" name="last_name" maxlength="50" size="30">
            <div class="text-error"><?php echo $valid->error('lastName'); ?></div>
          </td>
        </tr>

        <tr class="quickFade delayThree">
          <td valign="top">
            <label for="email">Email Address *</label>
          </td>
          <td valign="top">
            <input id="email" type="text" name="email" maxlength="80" size="30">
            <div class="text-error"><?php echo $valid->error('email'); ?></div>
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
            <label for="comments">Comments *</label>
          </td>
          <td valign="top">
            <textarea id="comments" name="comments" maxlength="1000" cols="25" rows="6"></textarea>
            <div class="text-error"><?php echo $valid->error('message'); ?></div>
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
</body>

</html>

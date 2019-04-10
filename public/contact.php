<?php

class Validate{

    public $validation = [];

    public $errors = [];

    private $data = [];

    public function notEmpty($value){

        if(!empty($value)){
            return true;
        }

        return false;

    }

    public function email($value){

        if(filter_var($value, FILTER_VALIDATE_EMAIL)){
            return true;
        }

        return false;

    }

    public function check($data){

        $this->data = $data;

        foreach(array_keys($this->validation) as $fieldName){

            $this->rules($fieldName);
        }

    }

    public function rules($field){
        foreach($this->validation[$field] as $rule){
            if($this->{$rule['rule']}($this->data[$field]) === false){
                $this->errors[$field] = $rule;
            }
        }
    }

    public function error($field){
        if(!empty($this->errors[$field])){
            return $this->errors[$field]['message'];
        }

        return false;
    }

    public function userInput($key){
        return (!empty($this->data[$key])?$this->data[$key]:null);
    }
}

$valid = new Validate();

$args = [
  'firstName'=>FILTER_SANITIZE_STRING,
  'lastName'=>FILTER_SANITIZE_STRING,
  'email'=>FILTER_SANITIZE_EMAIL,
  'comment'=>FILTER_SANITIZE_STRING,
  'subject'=>FILTER_SANITIZE_STRING,
];

$input = filter_input_array(INPUT_POST, $args);

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
    <div class="quickFade">
      Thank you for taking interest in having something creatively constructed by Chris. It will be a pleasure to serve you.
    </div>

    <?php echo (!empty($message)?$message:null); ?>
    
    <form action="contact.php" method="POST">

    <table id="table1" height="500px width="900px">
      <thead id="tablehead">
        Please Fill out a Contact Form and I will get back to you as soon as possible.
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

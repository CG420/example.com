<?php
//Usage
require '../../core/session.php';
//checkSession();
require '../../core/functions.php';
require '../../config/keys.php';
require '../../core/db_connect.php';
require '../../core/About/src/Validation/Validate.php';

checkSession();

use About\Validation;

$valid = new About\Validation\Validate();

$message=null;

$args = [
    'first_name'=>FILTER_SANITIZE_STRING, //strips HMTL
    'last_name'=>FILTER_SANITIZE_STRING, //strips HMTL
    'email'=>FILTER_SANITIZE_STRING, //strips HMTL
];

$input = filter_input_array(INPUT_POST, $args);

//var_dump($input);

//1. First validate
if(!empty($input)){

    $valid->validation = [
        'first_name'=>[[
            'rule'=>'notEmpty',
            'message'=>'Please enter a first_name'
        ]],

        'last_name'=>[[
            'rule'=>'notEmpty',
            'message'=>'Please enter a last name'
        ]],
        
        'email'=>[[
            'rule'=>'email',
            'message'=>'Please enter a valid email'
        ],[
            'rule'=>'notEmpty',
            'message'=>'Please enter a email'
        ]],
    ];

    $valid->check($input);

    if(empty($valid->errors)){
        //2. Only process if we pass validation

        //Strip white space, begining and end
        $input = array_map('trim', $input);
    
        //Sanitiezed insert
        $sql = 'INSERT INTO users SET id=UUID(), first_name=:first_name, last_name=:last_name, email=:email';
    
        if($pdo->prepare($sql)->execute([
            'first_name'=>$input['first_name'],
            'last_name'=>$input['last_name'],
            'email'=>$input['email'],            
        ])){
            header('LOCATION:/users');
        }else{
            $message = 'Something bad happened';
        }

    }else{
        //3. If validation fails create a message, DO NOT forget to add the validation 
        //methods to the form.
        $message = "<div class=\"alert alert-danger\">Your form has errors!</div>";
    }
}

$meta=[];
$meta['title']='Add a new user';

$content = <<<EOT
<h1>Add a New User</h1>
{$message}
<form method="post">

<div class="form-group">
    <label for="first_name">First Name</label>
    <input id="first_name" name="first_name" type="text" class="form-control" value="{$valid->userInput('first_name')}">
    <div class="text-danger">{$valid->error('first_name')}</div>
</div>

<div class="form-group">
    <label for="last_name">Last Name</label>
    <input id="last_name" name="last_name" type="text" class="form-control" value="{$valid->userInput('last_name')}">
    <div class="text-danger">{$valid->error('last_name')}</div>
</div>

<div class="form-group">
    <label for="email">Email</label>
    <input id="email" name="email" type="text" class="form-control" value="{$valid->userInput('email')}">
    <div class="text-danger">{$valid->error('email')}</div>
</div>
</div>

<div class="form-group">
    <input type="submit" value="Submit" class="btn btn-primary">
</div>

</form>
EOT;

include '../../core/layout.php';
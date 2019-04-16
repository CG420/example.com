<?php
require '../../core/functions.php';
require '../../config/keys.php';
require '../../core/db_connect.php';
require '../../core/About/src/Validation/Validate.php';

use About\Validation;

$valid = new About\Validation\Validate();

$message=null;

$args = [
    'first_name'=>FILTER_SANITIZE_STRING, //strips HMTL
    'last_name'=>FILTER_SANITIZE_STRING, //strips HMTL
    'email'=>FILTER_UNSAFE_RAW  //NULL FILTER
];

$input = filter_input_array(INPUT_POST, $args);

//1. First validate
if(!empty($input)){

    $valid->validation = [
        'first_name'=>[[
            'rule'=>'notEmpty',
            'message'=>'Please enter a first_name'
        ]]
    ];

    $valid->check($input);

    if(empty($valid->errors)){
        //2. Only process if we pass validation

        //Strip white space, begining and end
        $input = array_map('trim', $input);
    
        //Allow only whitelisted HTML
        $input['first_name'] = cleanHTML($input['first_name']);
    
        //Allow only whitelisted HTML
        $input['last_name'] = cleanHTML($input['last_name']);

        //Create the email
        $email = email($input['email']);
    
        //Sanitiezed insert
        $sql = 'UPDATE users SET first_name=:first_name, last_name=:last_name, email=:email';
    
        if($pdo->prepare($sql)->execute([
            'id'=>$input['id'],
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

/* Preload the page */
$args = [
    'id'=>FILTER_SANITIZE_STRING
];

$getParams = filter_input_array(INPUT_GET, $args);

$sql = 'SELECT * FROM users WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'id'=>$getParams['id']
]);

$row = $stmt->fetch();

$fields=[];
$fields['id']=$row['id'];
$fields['first_name']=$row['first_name'];
$fields['last_name']=$row['last_name'];
$fields['email']=$row['email'];

if(!empty($input)){
    $fields['id']=$valid->userInput('id');
    $fields['first_name']=$valid->userInput('first_name');
    $fields['last_name']=$valid->userInput('last_name');
    $fields['email']=$valid->userInput('email');
}

$meta=[];
$meta['title']='Edit: ' . $fields['title'];

$content = <<<EOT
<h1>{$meta['title']}</h1>

{$message}
<form method="post">

<input name="id" type="hidden" value="{$fields['id']}">

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
<hr>
<div>
    <a class="btn btn-danger"
        onclick="return confirm('Are you sure?')"
        href="/users/delete.php?id={$fields['id']}">
       
            <i class="fa fa-trash" aria-hidden="true"></i>
            Delete
    
    </a>
</div>
EOT;

include '../../core/layout.php';

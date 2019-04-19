<?php
require '../core/bootstrap.php';
require '../core/db_connect.php';
require '../core/About/src/Validation/Validate.php';

use About\Validation;

$valid = new About\Validation\Validate();

$message=null;

$input = filter_input_array(INPUT_POST,[
    'first_name'=>FILTER_SANITIZE_STRING,
    'last_name'=>FILTER_SANITIZE_STRING,
    'email'=>FILTER_SANITIZE_EMAIL,
    'password'=>FILTER_UNSAFE_RAW,
    'confirm_password'=>FILTER_UNSAFE_RAW
]);

if(!empty($input)){
    $valid->validation = [
        'first_name'=>[[
            'rule'=>'notEmpty',
            'message'=>'Please enter a first name'
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
        'password'=>[[
            'rule'=>'notEmpty',
            'message'=>'Please enter a password'
        ],[
            'rule'=>'strength',
            'message'=>'Password isn\'t strong enough'
        ]],

        'confirm_password'=>[[
            'rule'=>'notEmpty',
            'message'=>'Please confirm your password'
        ],[
            'rule'=>'matchPassword',
            'message'=>'Passwords do not match'
        ]],
        
    ];

    $valid->check($input);
//var_dump($valid->errors);
    if(empty($valid->errors)){

    $input = array_map('trim', $input);
    $hash = password_hash($input['password'], PASSWORD_DEFAULT); 

    $sql='INSERT INTO
        users    
    SET
        id=UUID(),
        email=:email,
        first_name=:first_name,
        last_name=:last_name,
        hash=:hash
    ';
    
    $stmt=$pdo->prepare($sql);

try {
    $stmt->execute([
        'email'=>$input['email'],
        'first_name'=>$input['first_name'],
        'last_name'=>$input['last_name'],
        'hash'=>$hash
    ]);
        header('LOCATION: /login.php');

    } catch(PDOException $e) {
        $message="<div class=\"alert alert-danger\">{$e->errorInfo[2]}</div>";

    }
  }else{
    $message="<div class=\"alert alert-danger\">Your form has errors</div>";
  }
}
    //var_dump($hash);
    //$_SESSION['user'] = [];
    //$_SESSION['user']['id']=12345;
    //
    //var_dump(password_verify('12345g',$hash));
    //header('LOCATION: ' . $_POST['goto']);

$meta=[];
$meta['title']="Register";

$content=<<<EOT

<h1>{$meta['title']}</h1>
{$message}

<form method="post" autocomplete="off">
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input 
            class="form-control" 
            id="first_name" 
            name="first_name"
            value="{$valid->userInput('first_name')}" 
        >
        <div class="text text-danger">{$valid->error('first_name')}</div>
    </div>
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input 
            class="form-control" 
            id="last_name" 
            name="last_name"
            value="{$valid->userInput('last_name')}"  
        >
        <div class="text text-danger">{$valid->error('last_name')}</div>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input 
            class="form-control" 
            id="email" 
            name="email"
            value="{$valid->userInput('email')}"  
        >
        <div class="text text-danger">{$valid->error('email')}</div>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input 
            class="form-control" 
            id="password" 
            name="password" 
            type="password"
            value="{$valid->userInput('password')}" 
        >
        <div class="text text-danger">{$valid->error('password')}</div>
    </div>
    <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
        <input 
            class="form-control" 
            id="confirm_password" 
            name="confirm_password" 
            type="password"
            value="{$valid->userInput('confirm_password')}" 
        >
        <div class="text text-danger">{$valid->error('confirm_password')}</div>
    </div>
    <input type="submit" class="btn btn-primary">
</form>
EOT;

require '../core/layout.php';
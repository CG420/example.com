<?php
require '../core/About/src/Validation/Validate.php';
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
        require '../core/mailgun.php';
        $message = "<div class=\"alert alert-success\">Your form has been submitted!</div>";
        //header('Location: thanks.php');
    }else{
        $message = "<div class=\"alert alert-danger\">Your form has errors!</div>";
    }
}
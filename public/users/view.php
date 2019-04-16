<?php
include '../../core/db_connect.php';

$args = [
    'email'=>FILTER_SANITIZE_EMAIL
];

$input = filter_input_array(INPUT_GET, $args);
$email = preg_replace("/[^a-z0-9-]+/", "", $input['email']);

$stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
$stmt->execute([$email]);

$row = $stmt->fetch();

$meta=[];
$meta['first_name']=$row['first_name'];
$meta['description']=$row['meta_description'];
$meta['keywords']=$row['meta_keywords'];

$content=<<<EOT
<h1>{$row['first_name']}</h1>
{$row['last_name']}

<hr>
<div>
    <a class="btn btn-primary" href="/users/edit.php?id={$row['id']}">
        <i class="fa fa-pencil" aria-hidden="true"></i>
        Edit
    </a>
</div>
EOT;

require '../../core/layout.php';
<?php
//Usage
require '../../bootstrap.php';
//checkSession();
require '../../core/db_connect.php';

$args = [
    'slug'=>FILTER_SANITIZE_STRING
];

$input = filter_input_array(INPUT_GET, $args);
$slug = preg_replace("/[^a-z0-9-]+/", "", $input['slug']);

$stmt = $pdo->prepare('SELECT * FROM posts WHERE slug = ?');
$stmt->execute([$slug]);

$row = $stmt->fetch();

$meta=[];
$meta['title']=$row['title'];
$meta['description']=$row['meta_description'];
$meta['keywords']=$row['meta_keywords'];

$content=<<<EOT
<h1>{$row['title']}</h1>
{$row['body']}

<hr>
<div>
    <a class="btn btn-primary" href="/posts/edit.php?id={$row['id']}">
        <i class="fa fa-pencil" aria-hidden="true"></i>
        Edit
    </a>
</div>
EOT;

require '../../core/layout.php';
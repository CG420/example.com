<?php

$meta=[];
$meta['title']='Thanks';

$content=<<<EOT

<body>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="resume.php">Resume</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
    <p>
        Thank you for reaching out. I will get back to you as soon as possible.
    </p>
</body>

EOT;

require '../core/layout.php';
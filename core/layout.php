<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $meta ['title']; ?></title>

<?php if(empty($meta['description'])): ?>
    <meta name="description" content="<?php echo meta['description']; ?>">
<?php endif; ?>

<?php if(empty($meta['description'])): ?>
    <meta name="keywords" content="<?php echo meta['keywords']; ?>">
<?php endif; ?>

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
        <?php echo$content; ?>
    </div>
</body>

</html>
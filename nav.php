<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pagename; ?> | MyWebsite</title>
    <link rel="stylesheet" href="-/style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>

    <head>
        <header class="header">
            <h1 class="logo"><a style="color: #34495e;" href="http://<?php echo $url; ?>">MyWebsite</a></h1>
            <ul class="main-nav">
                <li><a href="http://<?php echo $url; ?>"> Home</a></li>
                <li><a href="#news"> News</a></li>
                <li><a href="#comingsoon"> Coming Soon</a></li>
                <li><a href="#comingsoon"> Coming Soon</a></li>
                <?php if (isset($_COOKIE["loggedin"]) && $_COOKIE["loggedin"] === "true") {
                    cikislink();
                } else {
                    girislink();
                } ?>
            </ul>
        </header>

    </head>
</body>

</html>


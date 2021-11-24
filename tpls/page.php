<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php
            $site = new Site;
            $page = $site->getPage($site->getPath());
        ?>

        <h1><?php echo $page["name"]; ?></h1>
        <p>
            <?php echo $page["content"]; ?>
        </p>
    </body>
</html>
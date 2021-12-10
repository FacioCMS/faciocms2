<?php
    $site = new Site;
    $page = $site->getPage($site->getPath());
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FacioCMS Website</title>

        <!-- For style better use link rel="stylesheet" but for this template We used <style> tag :o -->
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins&family=Raleway:wght@100;400;700&display=swap');
            
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Poppins', 'Raleway', sans-serif;
            }

            body {
                height: 100vh;
                width: 100vw;
                overflow: hidden;
                background: #060606;
                color: #fff;
            }

            .content {
                display: flex;
                align-items: center;
                justify-content: flex-start;
                padding: 40px;
                flex-direction: column;
                height: 100vh;
                text-align: center;
            }

            .content header {
                font-weight: 100;
                font-size: 60px;
                user-select: none;
            }

            .content header span {
                font-weight: 700;
                color: #fff;
                font-size: 8rem;
            }

            .content p {
                margin-top: 50px;
                width: 600px;
                text-align: justify;
                font-size: 24px;
                color: #ddd;
            }

            .content header .letter {
                color: #f52e2e;
                text-shadow: 5px 5px #ca1e1e, -5px -5px #09f;
                font-size: 12rem;
            }

            .content header .cms {
                color: #f52e2e;
                text-shadow: 5px 5px #8f1313;
                font-size: 10rem;
            }

            .links {
                display: flex;
                justify-content: space-around;
                margin-top: 50px;
            }

            .links .link-btn {
                color: #fff;
                text-decoration: none;
                margin: 5px;
                padding: 10px 15px;
                background: #f52e2e;
                border-radius: 12px;
            }
        </style>
    </head>
    <body>
        <div class="content">
            <header><span><span class="letter">F</span>acio<span class="cms">CMS</span></span></header>
            <p>
                <?php echo $page["content"]; ?>
            </p>

            <div class="links">

                <a href="./admin" role="button" class="link-btn">Admin panel</a>
                <a href="https://www.faciocms.com" role="button" class="link-btn">FacioCMS.com</a>
                <a href="https://www.faciocms.com/documentation" role="button" class="link-btn">Documentation</a>

            </div>
        </div>
    </body>
</html> 

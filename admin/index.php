<?php
    header('Cache-Control: no cache');
    session_cache_limiter('private_no_expire');
    session_start();
    
    require_once 'utils/modules.php';
    requireModule("../configuration/db.php"); // using module
    $db = getDatabaseConnection();
    $pluginsInstances = [];
    $faciocmsVersion = "2.0.0";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <script>
            window.globalError = function(text) { // FacioCMS error
                alert(text)
            }

            window._appData = {
                version: '<?php echo $faciocmsVersion ?>'
            }
        </script>

        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    </head>
    <body>
        <?php
            requireModule("versions/$faciocmsVersion/index.php"); // requiring admin panel
        ?>
    </body>
</html>
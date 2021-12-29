<?php
    header('Cache-Control: no cache');
    session_cache_limiter('private_no_expire');
    session_start();
    
    require_once 'utils/modules.php';
    requireModule("../configuration/db.php"); // using module
    $db = getDatabaseConnection();
    $pluginsInstances = [];
    $faciocmsVersion = "";

    $query = "SELECT `fcms-version` FROM `fcms-settings` LIMIT 1";
    if($r = $db->query($query)) {
        if($r->num_rows > 0) {
            while($row = $r->fetch_assoc()) {
                $faciocmsVersion = $row["fcms-version"];
            }
        }
        else {
            echo "Database error";
        }
    }
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

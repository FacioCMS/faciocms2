<?php
    require "utils/modules.php";

    requireModule("configuration/db.php");
    $db = getDatabaseConnection();

    $query = "SELECT `fcms-version` FROM `fcms-settings` LIMIT 1";
    $fcms_version = '';
    if($res = $db->query($query)) {
        if($res->num_rows > 0) {
            // get version
            while($row = $res->fetch_assoc()) {
                $fcms_version = $row["fcms-version"];
            }
        }
        else {
            include 'errors/configerr.php';
        }
    }

    requireModule("admin/versions/" . $fcms_version . "/phpmodule/phpmodule.php");
<?php
    $authToken = $_GET["authtoken"];
    $id = $_GET["id"];

    require_once '../../../utils/modules.php';
    requireModule("../../../../configuration/db.php");
    requireModule("../../../modules/apiauth.php");

    $db = getDatabaseConnection();

    if(authApi($authToken) == true) {
        $query = "DELETE FROM pages WHERE id = '$id' AND deleted = 1";
        if($db->query($query)) {
            echo "Deleted! <script>window.close();</script>";
        }
        else {
            echo "An error occured!";
        }
    }
    else {
        echo 'An error occured with API authentication, authToken is Invalid!';
    }
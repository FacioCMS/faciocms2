<?php
    $authToken = $_GET["apiauth"];
    $userid = $_GET["userId"];

    require_once '../../../utils/modules.php';
    requireModule("../../../../configuration/db.php");
    requireModule("../../../modules/apiauth.php");

    $db = getDatabaseConnection();

    if(authApi($authToken) == true) {
        $query = "DELETE FROM users WHERE id = '$userid'";
        if($db->query($query)) {
            echo "<script>window.close();</script>";
        }
        else {
            echo "Something went wrong...";
        }
    }
    else {
        echo 'An error occured with API authentication, authToken is Invalid!';
    }
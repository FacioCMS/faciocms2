<?php
    print_r($_GET);
    $authToken = $_GET["apiauth"];
    $id = $_GET["addonId"];
    require_once '../../../utils/modules.php';
    requireModule("../../../../configuration/db.php");
    requireModule("../../../modules/apiauth.php");
    
    $db = getDatabaseConnection();
    if(authApi($authToken) == true) {
        $query = "DELETE FROM addons WHERE id = '$id'";
        if($db->query($query)) {
            echo "<script>window.close();</script>";
        }
        else {
            echo 'Could not remove addon!';
        }
    }
    else {
        echo 'An error occured with API authentication, authToken is Invalid!';
    }
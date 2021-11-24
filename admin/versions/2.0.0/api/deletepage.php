<?php
    $authToken = $_GET["authToken"];
    require_once '../../../utils/modules.php';
    requireModule("../../../../configuration/db.php");
    $db = getDatabaseConnection();
    $id = $db->real_escape_string($_GET["id"]);

    requireModule("../../../modules/apiauth.php");

    if(authApi($authToken) == true) {
        $date = date("F j, Y, g:i a");
        $query = "UPDATE pages SET deleted = 1 WHERE id = '$id'";
        echo $db->query($query) ? 'Page deleted' : 'An error occured with Database!';
    }
    else { 
        echo 'An error occured with API authentication, authToken is Invalid!';
    }
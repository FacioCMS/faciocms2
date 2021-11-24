<?php
    $authToken = $_GET["authToken"];
    require_once '../../../utils/modules.php';
    requireModule("../../../../configuration/db.php");
    $db = getDatabaseConnection();
    $parentId = $db->real_escape_string($_GET["parentid"]);

    requireModule("../../../modules/apiauth.php");

    if(authApi($authToken) == true) {
        $date = date("F j, Y, g:i a");
        $query = "INSERT INTO pages VALUES ('', 'New page', 'Hello, Content!', 'never', 'created using api', '$date', '0', '0', '$parentId', 'page.tplc', '')";
        echo $db->query($query) ? 'Page created' : 'An error occured with Database!';
    }
    else { 
        echo 'An error occured with API authentication, authToken is Invalid!';
    }
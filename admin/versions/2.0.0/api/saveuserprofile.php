<?php
    session_start();
    $authToken = $_POST["apiauth"];
    require_once '../../../utils/modules.php';
    requireModule("../../../../configuration/db.php");
    $db = getDatabaseConnection();

    requireModule("../../../modules/apiauth.php");

    if(authApi($authToken) == true) {
        $username = $_POST["username"];
        $oldPass = md5($_POST["passwordold"]);

        $query = "UPDATE users SET username = '$username' WHERE password = '$oldPass'";
        if($db->query($query)) {
            session_unset();
            session_destroy();
            header('Location: ../../../');
        }

        else {
            echo "An error occured";
        }
    }
    else { 
        echo 'An error occured with API authentication, authToken is Invalid!';
    }
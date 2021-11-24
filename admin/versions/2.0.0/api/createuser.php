<?php
    $authToken = $_GET["apiauth"];
    $username = $_GET["user"];
    $password = md5($_GET["password"]);

    require_once '../../../utils/modules.php';
    requireModule("../../../../configuration/db.php");
    requireModule("../../../modules/apiauth.php");

    $db = getDatabaseConnection();

    if(authApi($authToken) == true) {
        $query = "INSERT INTO users VALUES ('', '$username', '$password', '', 'admin')";
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
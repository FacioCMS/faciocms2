<?php
    $authToken = $_POST["apiauthtoken"];
    $pageid = $_POST["pageid"];

    require_once '../../../utils/modules.php';
    requireModule("../../../../configuration/db.php");
    requireModule("../../../modules/apiauth.php");

    $db = getDatabaseConnection();

    if(authApi($authToken) == true) {
        foreach($_POST as $key => $post) {
            if($key == "apiauthtoken" || $key == "pageid") continue;

            
            if($r = $db->query("SELECT id FROM addons WHERE name = '$key' AND pageid = '$pageid'")) {
                if($r->num_rows > 0) {
                    $query = "UPDATE addons SET value = '$post' WHERE name = '$key' AND pageid = '$pageid'";
            
                    if($db->query($query)) {
                        // saved
                        echo "Successfully saved addon $key with value: $post";
                    }
                    else {
                        echo "An error occured with saving addon $key with value: $post";
                    }
                }
                else {
                    // creating addon
                    $query = "INSERT INTO addons VALUES ('', '$pageid', '$key', '$post')";
                    if($db->query($query)) {
                        echo "Successfully created addon $key with value: $post";
                    }
                    else {
                        echo "An error occured with creating addon $key with value: $post";
                    }
                }
            }
        }

        echo "<script>window.close();</script>";
    }
    else {
        echo 'An error occured with API authentication, authToken is Invalid!';
    }
<?php
    require_once '../../../utils/modules.php';
    requireModule("../../../../configuration/db.php");
    requireModule("../../../modules/apiauth.php");

    $authToken = $_POST["apiauth"];

    $db = getDatabaseConnection();
    if(authApi($authToken) == true) {
        $aut = $_POST["ws-author"];
        $desc = $_POST["ws-desc"];
        $keywords = $_POST["ws-keywords"];
        $ogtit = $_POST["og-title"];
        $ogtyp = $_POST["og-type"];
        $ogimg = $_POST["og-imageurl"];
        $ogurl = $_POST["og-url"];
        $oglocale = $_POST["og-locale"];
        $query = "UPDATE seo SET author = '$aut', description = '$desc', keywords = '$keywords', ogtitle = '$ogtit', ogtype = '$ogtyp', ogimage = '$ogimg', ogurl = '$ogurl', oglocale = '$oglocale' WHERE 1 = 1";
    
        if($db->query($query)) {
            echo "<script>window.close();</script>";
        }
        else {
            echo "An error occured";
        }
    }
    else {
        echo "An error occured with API authentication, authToken is Invalid!";
    }
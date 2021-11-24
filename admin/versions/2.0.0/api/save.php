saving...
<?php
    $authToken = $_POST["authtoken"];
    $name = $_POST["name"];
    $content = $_POST["content"];
    $isdefault = @$_POST["isdefault"] == 'on' ? 1 : 0;
    $pageid = $_POST["pageid"];
    $template = $_POST["template"];
    $link = $_POST["pagelink"];
    
    // echo "<strong>Updating for:</strong> <br> $name <br> $content <br> $isdefault <br> $authToken";

    require_once '../../../utils/modules.php';
    requireModule("../../../../configuration/db.php");
    requireModule("../../../modules/apiauth.php");

    $db = getDatabaseConnection();
    echo $pageid;

    if(authApi($authToken) == true) {
        $query = "UPDATE pages SET name = '$name', content = '$content', isDefault = '$isdefault', template= '$template', link = '$link' WHERE id = '$pageid'";
        if($db->query($query)) {
            echo $query;
            echo "<script>window.close();</script>";
            //header('Location: ../../../');
        }
        else echo "An error occured with updating!";
    }
    else {
        echo "An error occured with API authentication, authToken is Invalid!";
    }

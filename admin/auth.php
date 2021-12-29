<?php 
    session_start();

    function loginError($errorDesc): void {
        $_SESSION["loginerror"] = $errorDesc;
        header('Location: ../admin');
    }

    function newAuthToken(): string {
        global $db;
        $token = uniqid("APIAuthToken_");
        $date = time();
        $query = "INSERT INTO apiauth VALUES ('', '$token', '$date')";
        $db->query($query);

        return $token;
    }

    $username = $_POST["username"];
    $password = hash('sha256', $_POST["password"]);

    if(!$username || !$password) {
        loginError("Invalid data!");
    }

    require_once "utils/modules.php";
    requireModule("../configuration/db.php");

    $db = getDatabaseConnection();
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

    if($res = $db->query($query)) {
        if($res->num_rows > 0) {
            // User is logged !

            while($row = $res->fetch_assoc()) {
                $_SESSION["logged"] = true;
                $_SESSION["username"] = $row["username"];
                $_SESSION["permissions"] = $row["permissions"]; 
                $_SESSION["authtoken"] = newAuthToken();
                loginError("Logged succesful!");
            }

        }

        else {
            loginError("Invalid credentials!");
        }
    }

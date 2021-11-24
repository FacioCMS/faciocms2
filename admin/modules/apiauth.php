<?php
    function authApi($token) {
        global $db;

        $query = "SELECT id FROM apiauth WHERE token = '$token'";
        if($res = $db->query($query)) {
            if($res->num_rows > 0) {
                // got!
                return true;
            }
            else {
                return false;
            }
        }
    }
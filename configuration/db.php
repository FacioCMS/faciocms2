<?php
    function getDatabaseConnection(): mysqli {
        //                 DB NAME      USER  PASS   DBNAME
        return new mysqli("localhost", "root", "", "faciocms2");
    }
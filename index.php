<?php
    require_once "admin/faciocms_phpmodule.php";
    require_once "configuration/db.php";
    $db = getDatabaseConnection();

    $site = new Site;
    $site->showPage($site->getPath());
?>
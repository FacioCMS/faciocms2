<?php
    function readConfig($conf): array {
        $config = [];
        $validKeys = ["Name", "TemplateVersion", "Author", "Description", "fcms:TemplateFile", "fcms:MinVersion", "fcms:StableVersion", "danger:AllowUncompatibileVersion"];
        $exp = explode(";", $conf);
        foreach($exp as $item) {
            $exp2 = explode("=", $item);
            if(str_contains($item, '=')) {
                $key = $exp2[0];
                $val = $exp2[1];

                if($key[0] != "#") {
                    $config[] = $val;
                } 
            }   
        }
        if(count($config) != 8) {
            echo "Config is incorrectly formated!";
        } 
        return $config;
    }
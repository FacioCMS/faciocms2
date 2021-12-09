<?php 
    session_start();
    if(!$_SESSION["logged"]) {
        header('Location: ../../../');
    }

    $url = "https://faciocms.com/fcms-updates/currentUpdate.json";
    $data = file_get_contents($url);
    $data_parsed = json_decode($data);
    $ver = $data_parsed->{'avatible'};
    echo "Downloading FacioCMS version $ver! <br>"; 
    $mainpath = '../../'.$ver;
    @mkdir($mainpath);
    function downloadPath($path, $prev) {
        if(@$path->{'file'}) {
            // File
            $path_l = $prev . '/' . $path->{'file'};
            echo "<strong>Downloading</strong> $path_l <br>";
            $content = @file_get_contents($path->{'url'});
            
            $fileopened = fopen("$path_l", "w");
            fwrite($fileopened, $content);
            fclose($fileopened);
        }
        else {
            // Folder
            @mkdir($prev . '/' . $path->{'path'});
            foreach(json_decode(json_encode($path->{'contents'})) as $file_) {
                @downloadPath($file_, $prev . '/' . $path->{'path'});
            }
            
        }
    }
    $updatemap = json_decode(file_get_contents($data_parsed->{'updatemap'}));
    foreach($updatemap->{'contents'} as $contentFile) {
        downloadPath($contentFile, $mainpath);
    }
    echo "<strong style='color: green;'>Ended downloading FacioCMS Update!</strong>";
?>

<?php
    class Site {
        /**
         * @name getPath();
         * @return path to site (GET query body param "path") 
         */
        function getPath(): string {
            return @$_GET["path"] ? $_GET["path"] : $this->getDefaultPageLink();
        }

        function fastSelectQuery($db, $q) {
            $ro = [];
            if($res = $db->query($q)) {
                while($row = $res->fetch_assoc()) {
                    array_push($ro, $row);
                }
            }

            return $ro;
        }

        /**
         * @name getPage();
         * @return database_row with page which have link = '$link'
         */
        function getPage($link) {
            global $db;

            // $link could be home/test
            // so then we create array from this like ["home", "test"]
            // looking for page which has prevlink (index - 1) and then searching for page which has link (index) and is children of (index - 1)

            $linkSplitted = explode("/", $link);
            $prevparentid = -1;
            foreach($linkSplitted as $key => $_link) {
                $query = "SELECT * FROM pages WHERE link = '$_link' AND parentid = '$prevparentid'";
                $ready = $this->fastSelectQuery($db, $query)[0];
                $prevparentid = $ready["id"];

                if($key == count($linkSplitted) - 1) {
                    return $ready;
                }

            }

            return 0;
        }

        /**
         * 
         * @info1 Warning!
         * @info2 You shouldn't use this function.
         * @info3 It's only for CMS to show page.
         * @info4 For more info go to docs.
         * 
         * @void 
         * @name showPage();
         * @return null
         * 
         * @include template of page which link is $link
         */

        function showPage($link): void {
            global $db;
            require 'admin/modules/templateconfig.php';

            // cfg

            $page = $this->getPage($link);
            $f = fopen('tpls/' . $page["template"], 'r');
            $cfg = readConfig(fread($f, filesize('tpls/' . $page["template"])));

            include 'tpls/'.implode('', explode(' ', $cfg[4]));

            // meta datas
            $query = "SELECT * FROM seo LIMIT 1";
            $data = [];
            if($res = $db->query($query)) {
                while($row = $res->fetch_assoc()) {
                    $data = $row;
                }
            }

            $aut        = $data["author"]; 
            $desc       = $data["description"]; 
            $keywords   = $data["keywords"];     
            $ogtit      = $data["ogtitle"]; 
            $ogtyp      = $data["ogtype"]; 
            $ogimg      = $data["ogimage"]; 
            $ogurl      = $data["ogurl"]; 
            $oglocale   = $data["oglocale"];     

            echo   "<meta type='author' content='$aut'><meta type='description' content='$desc'><meta type='keywords' content='$keywords'><meta type='og:title' content='$ogtit'><meta type='og:type' content='$ogtyp'><meta type='og:image' content='$ogimg'><meta type='og:url' content='$ogurl'><meta type='og:locale' content='$oglocale'>";
        }

        /**
         * @name getDefaultPageLink()
         * @return String link to default page
         */

        function getDefaultPageLink(): string {
            global $db;

            $query = "SELECT link FROM pages WHERE isDefault = 1 AND deleted = 0 LIMIT 1";
            return $this->fastSelectQuery($db, $query)[0]["link"];
        }
    }
<?php 
    function countAllPages(): int {
        global $db;
        $q = "SELECT * FROM pages WHERE deleted = 0";
        if($r = $db->query($q)) {
            return $r->num_rows;
        }
    }

    function getAllSubpages($pid, $it): string {
        global $db;
        $pageslist = "";

        $query = "SELECT * FROM pages WHERE deleted = 0 AND parentid = $pid";
        if($res = $db->query($query)) {
            if($res->num_rows > 0) {
                while($row = $res->fetch_assoc()) {
                    $item = "<div class='page-row-subchild' style='margin-left: ".($it * 10)."px;'>
                    <div class='page-row-top'>
                        <div class='page-row-left'>
                            <header class='page-name'>".$row['name']."</header>
                        </div>
                        <div class='page-row-right'>
                            <button class='btn-edit-page' data-pageid='".$row['id']."'><em class='fas fa-pen'></em></button>
                            <button class='btn-remove-page' data-pageid='".$row['id']."'><em class='fas fa-trash'></em></button>
                            <button class='btn-add-subpage' data-pageid='".$row['id']."'><em class='fas fa-plus'></em></button>
                        </div>
                    </div>

                    ".getAllSubpages($row['id'], $it + 1)."
                </div>";
                    $pageslist .= $item;
                }
            }
        }

        return $pageslist;
    }
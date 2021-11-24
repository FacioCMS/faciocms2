<!-- FacioCMS version: 2.0.0 -->
<!-- Author: Maciej Dębowski -->

<?php
    $faciocmsVersion2 = "2.0.0";
    // route
    $route = $_POST["route"] == 0 ? "home" : $_POST["route"];

    if(!$_SESSION["logged"]) {
        $route = "Login";
    }

    $db = getDatabaseConnection();

    require_once "./utils/modules.php";

    requireModule("versions/".$faciocmsVersion2."/utils/pagesfunctions.php");
    requireModule("versions/".$faciocmsVersion2."/utils/routerecognisation.php");
    requireModule("modules/templateconfig.php");
    
?>

<div id="use-as-head">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FacioCMS v.<?php echo $faciocmsVersion2; ?> | Admin</title>

    <!-- CSS/LESS -->
    <link rel="stylesheet/less" type="text/css" href="versions/<?php echo $faciocmsVersion2; ?>/less/main.less">

    <!-- RenderOnly JavaScript -->
    <script src="versions/<?php echo $faciocmsVersion2; ?>/js/headtransform.js" id="head-transform-script"></script>
</div>

<div id="routeid" style="display: none"><?php echo $route; ?></div>
<div id="authtoken" style="display: none"><?php echo $_SESSION["authtoken"]; ?></div>

<div class="adminpanel">
    <div class="sidebar">
        <h1 class="cms-name">FacioCMS</h1>
        <h3 class="cms-version"><i>v. <?php echo $faciocmsVersion; ?></i></h3>

        <ul class="navigation">
            <li class="nav-item nav-item-header"><header class="nav-header">General</header></li>
            <li class="nav-item redirect-nav-item" data-route="Pages"><a class="nav-link" href="#!"> <em class="mr-10 fas fa-sitemap"></em> Pages </a></li>
            <li class="nav-item redirect-nav-item" data-route="Users"><a class="nav-link" href="#!"> <em class="mr-10 fas fa-users"></em> Users </a></li>
            <li class="nav-item redirect-nav-item" data-route="Templates"><a class="nav-link" href="#!"> <em class="mr-10 fas fa-layer-group"></em> Templates </a></li>
            <li class="nav-item"></li>
            <li class="nav-item nav-item-header"><header class="nav-header">Advanced</header></li>
            <li class="nav-item redirect-nav-item" data-route="Website Settings"><a class="nav-link" href="#!"> <em class="mr-10 fas fa-cogs"></em> Website Settings </a></li>
            <li class="nav-item redirect-nav-item" data-route="Plugins"><a class="nav-link" href="#!"> <em class="mr-10 fas fa-plug"></em> Plugins </a></li>
            <li class="nav-item"></li>
            <li class="nav-item nav-item-header"><header class="nav-header">Utils</header></li>
            <li class="nav-item redirect-nav-item" data-route="Bin"><a class="nav-link" href="#!"> <em class="mr-10 fas fa-trash"></em> Bin </a></li>
            <li class="nav-item redirect-nav-item" data-route="Updater"><a class="nav-link" href="#!"> <em class="fas fa-download mr-10"></em> Updater </a></li>
            <li class="nav-item"></li>
            <li class="nav-item nav-item-header"><header class="nav-header">User</header></li>
            <li class="nav-item redirect-nav-item" data-route="Profile"><a class="nav-link" href="#!"> <em class="mr-10 fas fa-user"></em> Profile </a></li>
            <li class="nav-item redirect-nav-item"><a class="nav-link" href="logout.php" target="_blank"> <em class="fas fa-sign-out-alt mr-10"></em> Logout </a></li>
        </ul>
    </div>
    <div class="center-block">
        <h1 class="editor-name"> <?php echo isPageEditRoute($route) ? 'Page editor' : $route; ?> </h1>
        <?php if($route == "Pages"): ?>
            <div class="editor-pages-top">
                <h2>Active Pages</h2> <button id="add-global-page"> <em class="fas fa-plus-circle"></em> Add page</button>
            </div>
            <div class="active-pages-container">
                <?php

                    $query = "SELECT * FROM pages WHERE deleted = 0 AND parentid = -1";

                    if($res = $db->query($query)) {
                        if($res->num_rows > 0) {
                            // we got some pages

                            while($row = $res->fetch_assoc()) {
                                echo "<div class='page-row'>
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

                                    ".getAllSubpages($row['id'], 1)."
                                </div>";
                            }
                            
                        }

                        echo "<p class='page-rows-results'>Found ".countAllPages()." pages</p>";
                    }
                ?>
            </div>
        <?php elseif(isPageEditRoute($route)): ?>
            <div id="pageeditor">
                <form action="versions/<?php echo $faciocmsVersion2; ?>/api/save.php" method="POST" target="_blank">
                    <?php
                        $page = "";
                        $pageid = getPageEditId($route);

                        $query = "SELECT * FROM pages WHERE id = '$pageid' AND deleted = 0";
                        $page = [];
                        if($r = $db->query($query)) {
                            if($r->num_rows > 0) {
                                while($row = $r->fetch_assoc()) {
                                    $page = $row;
                                }
                            }
                            else {
                                echo "<h1>404. Page not found</h1>";
                            }
                        }
                    ?>
                    <h2>Page</h2> <br>

                    <input type="hidden" name="authtoken" value="<?php echo $_SESSION["authtoken"]; ?>">
                    <input type="hidden" name="pageid" value="<?php echo getPageEditId($route); ?>">
                    <input type="hidden" name="pageroute" id="pageroute_name" value="<?php echo $route; ?>">

                    <div class="input-group">
                        <label class="form-label" for="pagename">Name</label>
                        <input class="form-input" type="text" id="pagename" name="name" value="<?php echo $page["name"]; ?>">
                    </div>

                    <div class="input-group">
                        <label class="form-label" for="pagecontent">Content</label>
                        
                        <div class="text-editor-tools">
                            <button type="button" data-command="bold" class="btn-text-editor-tool"><em class="fas fa-bold"></em></button>
                            <button type="button" data-command="italic" class="btn-text-editor-tool"><em class="fas fa-italic"></em></button>
                            <button type="button" data-command="underline" class="btn-text-editor-tool"><em class="fas fa-underline"></em></button>

                            <button type="button" data-command="justifyLeft" class="btn-text-editor-tool"><em class="fas fa-align-left"></em></button>
                            <button type="button" data-command="justifyCenter" class="btn-text-editor-tool"><em class="fas fa-align-center"></em></button>
                            <button type="button" data-command="justifyRight" class="btn-text-editor-tool"><em class="fas fa-align-right"></em></button>
                            <button type="button" data-command="justifyFull" class="btn-text-editor-tool"><em class="fas fa-align-justify"></em></button>

                            <button type="button" data-command="undo" class="btn-text-editor-tool"><em class="fas fa-undo-alt"></em></button>
                            <button type="button" data-command="redo" class="btn-text-editor-tool"><em class="fas fa-redo-alt"></em></button>
                        </div>
                        <div class="text-editor" text-editor-for="pagecontent_send" contenteditable="true">
                            <?php echo $page["content"]; ?>
                        </div>

                        <input class="form-input" type="hidden" id="pagecontent_send" name="content" value="<?php echo htmlspecialchars($page["content"]); ?>">
                    </div>

                    <div class="input-group">
                        <label class="form-label" for="templatename">Template</label>
                        <select class="form-input form-option" id="templatename" name="template">
                            <?php
                                foreach(scandir("../tpls/") as $file) {
                                    // if file is .tplc
                                    if($file == "." || $file == ".." || (explode(".", $file)[count(explode(".", $file)) - 1] != "tplc")) continue;
                                    
                                    // file config
                                    $f = fopen("../tpls/$file", "r");
                                    $cfg = readConfig(fread($f, filesize("../tpls/$file")));

                                    echo intval(implode("", explode(".", $faciocmsVersion2)));
                                    // if template is compatibile with faciocms
                                    if(intval(implode("", explode(".", $cfg[5]))) <= intval(implode("", explode(".", $faciocmsVersion2)))) {
                                        $tr = "<option value='$file' ".(($file == $page["template"]) ? 'selected' : '').">$cfg[0] <small>(v. $cfg[1])</small></option>";
                                        echo $tr; 
                                    }
                                    else { // incompatibile
                                        if(implode('', explode(' ', $cfg[7])) == 'false') {
                                            $tr = "<option disabled>$cfg[0] <small><strong>(incompatible): requires at least fcms v.$cfg[5]</strong></small></option>";
                                            echo $tr; 
                                        } // incompatibile but allowed
                                        else {
                                            $tr = "<option value='$file' ".(($file == $page["template"]) ? 'selected' : '').">$cfg[0] <small>(v. $cfg[1])</small></option>";
                                            echo $tr; 
                                        }
                                    }
                                    fclose($f);
                                }
                            ?>
                        </select>
                    </div>

                    <div class="input-group">
                        <label class="form-label" for="pageisdefault">Home Page</label>
                        <input class="form-checkbox" type="checkbox" <?php echo $page["isDefault"] == 1 ? 'checked' : '' ?> id="pageisdefault" name="isdefault">
                    </div>

                    <button class="btn-save">Save</button> <button class='btn-removepage' type="button" data-pageid='<?php echo $page["id"]; ?>'>Delete</button>
                </form>

                <form action="versions/<?php echo $faciocmsVersion2; ?>/api/addonssave.php" method="POST" target="_blank">
                    <br> <h2>Addons <button class="add-addon-key" type="button"><em class="fas fa-plus"></em></button></h2> <br>
                    <input type="hidden" id="authtoken__api" name="apiauthtoken">
                    <input type="hidden" id="pageid_api" name="pageid" value="<?php echo $pageid; ?>">
                    <div class="addons-container-div">
                        <?php
                            $pageid = getPageEditId($route);
                            $query = "SELECT * FROM addons WHERE pageid = '$pageid'";

                            if($res = $db->query($query)) {
                                if($res->num_rows > 0) {

                                    while($row = $res->fetch_assoc()): ?>
                                        <div class="row-page-addon">
                                            <div class="row-page-addon-left">
                                                <?php echo $row["name"]; ?>
                                            </div>
                                            <div class="row-page-addon-right">
                                                <input class="row-page-addon-input" value="<?php echo $row["value"]; ?>" name="<?php echo $row["name"]; ?>" type="text"> <a href="" data-addonid="<?php echo $row["id"]; ?>" class="link-remove-addon" target="_blank"><em class="fas fa-minus-circle"></em></a>
                                            </div>
                                        </div>
                                    <?php endwhile;
                                    
                                    // echo "<br><strong>Found $res->num_rows addons</strong>";
                                }
                                else {
                                    echo "<strong>Page contains 0 addons</strong>";
                                }
                            }
                        ?>
                    </div>
                    <br>
                    <button class="btn-save" id="saveaddonsbutton">Save</button>
                </form>
            </div>
        <?php elseif($route == "Users"): ?>
            <div class="container-users">
                <div class="topmenu-user">
                    <h3>Users list</h3>
                    <div class="topmenu-users-right">
                        <button class="add-new-user-button"><em class="fas fa-plus-circle"></em> New User</button>
                    </div>
                </div>
                <div class="container-users-box">
                    <?php
                        $query = "SELECT * FROM users ORDER BY username ASC";
                        if($res = $db->query($query)) {
                            if($res->num_rows > 0) {
                                while($row = $res->fetch_assoc()): ?>
                                    <div class="user-row-user-list">
                                        <div class="user-row-nickname-container">
                                            <header class="user-row-user-name"><?php echo $row["username"]; ?></header>
                                        </div>
                                        
                                        <div class="user-row-right-section">
                                            <a href="#unformatted_link" data-userid="<?php echo $row["id"]; ?>" class="remove-user-button-as-link" target="_blank">
                                                <em class="fas fa-minus-circle"></em>
                                            </a>
                                        </div>
                                    </div>
                                <?php endwhile;
                            }  
                            else {
                                echo "FacioCMS could not find any users in database. Please contact with admin.";
                            }
                        }
                    ?>
                </div>
            </div>
        <?php elseif($route == "Templates"): ?>
            <div class="templates-container">
                <?php
                    $files = scandir("../tpls");
                    $filesWithContens = [];

                    

                    foreach($files as $key => $file) {
                        if($file != ".." 
                            && $file != "." 
                            && (explode(".", $file)[count(explode(".", $file)) - 1] == "tplc")
                        ) {
                            $fileo = fopen("../tpls/$file", "r");
                            array_push($filesWithContens, fread($fileo, filesize("../tpls/$file")));
                            fclose($fileo);
                        }
                    }

                    foreach($filesWithContens as $file): ?>
                        <?php $cfg = readConfig($file); ?>
                        <div 
                            class="template-box"
                            title="Author: <?php echo $cfg[2]; ?>"
                        >
                            <header class="template-name"><?php echo $cfg[0]; ?> <small>v.<?php echo $cfg[1]; ?></small> </header>
                            <p>
                                <?php echo $cfg[3]; ?>
                            </p>
                        </div>
                    <?php endforeach;
                ?>
            </div>
        <?php elseif($route == "Plugins"): ?>
            <div class="plugins-container">
                <?php
                    print_r($pluginsInstances);
                ?>
                <?php foreach($_SESSION["loadedPlugins"] as $pluginInstance): ?>
                    <div class="plugin-box">
                        <header class="plugin-name">
                            <?php
                                echo $pluginInstance["name"];
                            ?>
                        </header>

                        <span class="plugin-status active">Active</span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php elseif($route == "Website Settings"): ?>
            <div class="seo-container">
                <?php
                    $data = [];

                    $query = "SELECT * FROM seo";
                    if($res = $db->query($query)) {
                        while($row = $res->fetch_assoc()) {
                            $data = $row;
                        }
                    }
                ?>
                <form class='form-settings' target="_blank" action="versions/<?php echo $faciocmsVersion2; ?>/api/savesettings.php" method="post">
                    <input type="hidden" value="<?php echo $_SESSION["authtoken"]; ?>" name="apiauth">
                    <div class="input-group">
                        <label for="ws-author" class="form-label">Website Author (*)</label>
                        <input type="text" name="ws-author" class="form-input" id="ws-author" value="<?php echo $data["author"]; ?>">
                    </div>

                    <div class="input-group">
                        <label for="ws-desc" class="form-label">Website Description (*)</label>
                        <input type="text" name="ws-desc" class="form-input" id="ws-desc" value="<?php echo $data["description"]; ?>">
                    </div>

                    <div class="input-group">
                        <label for="og-title" class="form-label">OpenGraph Title (*)</label>
                        <input type="text" name="og-title" class="form-input" id="og-title"  value="<?php echo $data["ogtitle"]; ?>">
                    </div>

                    <div class="input-group">
                        <label for="og-type" class="form-label">OpenGraph Type (*)</label>
                        <input type="text" name="og-type" class="form-input" id="og-type" value="<?php echo $data["ogtype"]; ?>">
                    </div>

                    <div class="input-group">
                        <label for="og-image-url" class="form-label">OpenGraph Image Url (*)</label>
                        <input type="text" name="og-imageurl" class="form-input" id="og-image-url" value="<?php echo $data["ogimage"]; ?>">
                    </div>

                    <div class="input-group">
                        <label for="og-url" class="form-label">OpenGraph URL (*)</label>
                        <input type="text" name="og-url" class="form-input" id="og-url" value="<?php echo $data["ogurl"]; ?>">
                    </div>

                    <div class="input-group">
                        <label for="og-locale" class="form-label">OpenGraph Locale (*)</label>
                        <input type="text" name="og-locale" class="form-input" id="og-locale" value="<?php echo $data["oglocale"]; ?>">
                    </div>

                    <div class="input-group">
                        <label for="keyword-add-input" class="form-label">Website Keywords (*)</label>
                        <input type="text" class="form-input" id="keyword-add-input">

                        <div class="group-of-keywords">
                            <?php
                                $keywords = explode(",", $data["keywords"]);

                                foreach($keywords as $keyword): ?>
                                    <div class="keyword-item" onclick="this.remove(); window.faciocms.keywordsToInput();"><?php echo $keyword; ?></div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <input type="hidden" name="ws-keywords" id="keywords-meta-input">

                    <button class="btn-save">Save</button>

                    <p class="meta-description-settings">
                        (*) - meta tag
                    </p>
                </form>
            </div>
        <?php elseif($route == "Login"): ?>
            Sorry, you aren't logged to FacioCMS. Please sign in below.
            <div class="login-form-outer">
                <form class="login-form-inner" method="POST" action="auth.php">
                    <h3>Sign In</h3>

                    <label for="username" class="login-form-label">
                        Username
                    </label>    
                    <input id="username" type="text" name="username" class="login-form-input">

                    <label for="password" class="login-form-label">
                        Password
                    </label>   
                    <input id="password" type="password" name="password" class="login-form-input">

                    <button class="btn-login">Login</button>
                
                    <?php 
                        echo @$_SESSION["loginerror"];
                        $_SESSION["loginerror"] = "";
                    ?>

                </form>
            </div>
        <?php elseif($route == "Updater"): ?>
            <?php
                $url = "https://raw.githubusercontent.com/FacioCMS/faciocms2/update/currentupdate.json";
                $data = file_get_contents($url);
                $data_parsed = json_decode($data);
                $ver = $data_parsed->{'avatible'};
                $parsedVersion = intval(implode('', explode('.', $ver)));
                $thisFacioCmsVersion = intval(implode('', explode('.', $faciocmsVersion2)));

                if($parsedVersion > $thisFacioCmsVersion) {
                    echo "<h2 class='update-info'>Update is avatible (v.$ver)</h2> <button class='btn-start-updating'>Start Update!</button>";
                }
                else {
                    echo "<h2 class='update-info'>Your FacioCMS is updated to lasted version!</h2>";
                }
                
            ?>
        <?php elseif($route == "Profile"): ?>

            <form class="profile-configurate" action="versions/<?php echo $faciocmsVersion2; ?>/api/saveuserprofile.php" method="POST">
                <input type="hidden" name="apiauth" value="<?php echo $_SESSION["authtoken"]; ?>">
                <input type="hidden" name="passwordold" id="oldpassword__user">

                <label for="username___form_user_info" class="form-label">Username</label>
                <input type="text" class="form-input" id="username___form_user_info" value="<?php echo $_SESSION["username"]; ?>" name="username">

                <button type="button" class="btn-save save-user-info">Save</button>
            </form>

        <?php elseif($route == "Bin"): ?>
            <h2>Deleted pages:</h2> <br>
            <div class="deleted-pages-container">
                <?php
                    $query = "SELECT * FROM pages WHERE deleted = 1";
                    if($res = $db->query($query)) {
                        if($res->num_rows > 0) {
                            // got
                            while($row = $res->fetch_assoc()): ?>
                                <div class="row-deleted-page">
                                    <header><?php echo $row["name"] ?></header> <div class="btn-group-at-right">
                                        <button data-pageid="<?php echo $row["id"]; ?>" class="btn-delete-pernamently" title="Delete pernamently"><em class="fas fa-trash"></em></button> 
                                        <button data-pageid="<?php echo $row["id"]; ?>" class="btn-restore-page" title="Restore"><em class="fas fa-check"></em></button>
                                    </div>
                                </div>
                            <?php endwhile;
                        }
                        else {
                            echo "You don't have any deleted pages";
                        }
                    }
                ?>
            </div>
        <?php endif ?>
    </div>
</div>

<div id="javascript-import-section">
    <script src="https://cdn.jsdelivr.net/npm/less@4.1.1" ></script>
    <script src="versions/<?php echo $faciocmsVersion2; ?>/js/main.js"></script>

    <!-- FontAwesome Icons -->
    <script src="https://kit.fontawesome.com/f6412110a3.js" crossorigin="anonymous"></script>
</div>

<div id="prompt-section"></div>

<!-- Plugin Loader -->
<?php
    requireModule("versions/".$faciocmsVersion2."/pluginloader/pluginloader.php");
?>
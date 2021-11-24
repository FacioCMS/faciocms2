<?php
    require_once "plugin.class.php";

    function pluginLoadingError($additional = "", $docsInfo = ""): void { echo "<script>console.error(`FacioCMS Error: Could not load plugin $plugin. More information: $additional. ".(($docsInfo != "") ? 'Documentation: ${window.location.origin}${window.location.pathname}docs/'.$docsInfo : "")."`)</script>"; }

    $plugins = scandir("plugins");
    foreach($plugins as $plugin) {
        if($plugin != "_" && $plugin != ".." && $plugin != ".") {
            if(include "plugins/$plugin/plugin.php") {
                $plug = new Plugin;
                // Loading plugin

                if($plug->onAdminPanelStart() == 1) {
                    echo "<!-- Loading $plugin -->";

                    $pluginsInstances[] = $plug->getConfig();
                }
                else {
                    pluginLoadingError("int function onAdminPanelStart() didn't returned 1", "onAdminPanelStart_returns_0.html");
                }
            }
            else {
                pluginLoadingError("plugin.php not found", "No article for this.");
            }
        }
    }

    $_SESSION["loadedPlugins"] = $pluginsInstances;

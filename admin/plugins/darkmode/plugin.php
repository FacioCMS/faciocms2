<?php
    class Plugin extends fcms_plugin {
        public function getConfig(): array {
            return [
                "name" => "Example plugin",
                "version" => "1.0.0"
            ];
        }
        
        public function onAdminPanelStart(): int {
            include 'admin.php';

            return 1; // Status
        }
    }
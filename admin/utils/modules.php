<?php
    function requireModule($path) {
        if(@include $path) {
            echo "<!-- Module $path included -->";
        }
        else {
            echo "<script>setTimeout(() => window.globalError('Cannot include module $path!'), 50)</script>";
        }
    }
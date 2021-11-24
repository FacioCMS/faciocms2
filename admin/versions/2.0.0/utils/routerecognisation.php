<?php
    function isPageEditRoute($text): bool {
        return explode(':', $text)[0] == 'pageedit' && getPageEditId($text) != -1;
    }

    function getPageEditId($text): int {
        return explode(':', $text)[0] == 'pageedit' ? explode(':', $text)[1] : -1;
    }
Logging Out!
<?php
    session_start();
    session_unset();
    session_destroy();
?>
<script>window.close();</script>
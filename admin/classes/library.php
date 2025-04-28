<?php
    function sanitize($evilstring){
        $clean = strip_tags($evilstring);
        $clean = addslashes($clean);
        $clean = htmlentities($clean);

        //$clean = htmlentities(addslashes(strip_tags($evilstring)));
        return $clean;
    }

?>
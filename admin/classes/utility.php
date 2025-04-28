<?php

    class Utility{

        public static function sanitize($evilstr){
            $safestr = addslashes($evilstr);
            $safestr = htmlentities($safestr);
            return $safestr;
        }
        
    }

?>
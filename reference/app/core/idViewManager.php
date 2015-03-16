<?php

    class idViewManager
    {
        public static function Show( $view )
        {
            include( "app/views/".$view.".php" );
        }
    }

?>
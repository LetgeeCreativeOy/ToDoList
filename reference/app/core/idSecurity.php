<?php
    session_start();

    class idSecurity
    {
        public static function StringToUnharmful( $str )
        {
            return mysql_real_escape_string( htmlspecialchars( $str ) );
        }
        
        public static function isLoggedIn()
        {
            return( isset( $_SESSION['id'] ) && isset( $_SESSION['key'] ) );
        }

        public static function isBanned( $id, $db )
        {
            $q = $db->Query( "SELECT * FROM users WHERE id='$id'" );
            $user = mysql_fetch_assoc( $q );

            return $user['banned'];
        }
        
        public static function Encrypt( $str )
        {
            $salt = "¤%aasd%&%¤&".md5($str).".f4f6ae5567abce32wer€µµµAVbHfZ5454***^^^Pihbasd";
            return hash( "sha256", $str.crypt( $str.$salt.$str.$salt.$str.$salt.$str, $salt ) ).md5( $str.crypt( $salt.$str.$salt.$str.$salt.$str, $salt ) );
        }
        
        public static function GenerateKey( $id )
        {
            return md5( $usr['id'].$_SERVER['HTTP_USER_AGENT'] );
        }
    }
?>
<?php
    include_once( "app/idConfig.php" );
    include_once( "app/core/idDB.php" );
    include_once( "app/core/idSecurity.php" );
    include_once( "app/core/idMessager.php" );
    include_once( "app/core/idViewManager.php" );
    include_once( "app/core/idNotify.php" );

    $db = new idDB( DB_HOST, DB_USERNAME, DB_PASSWORD );
    $db->Open( DB_NAME );

    $notify = new idNotify();

    if( !idSecurity::isLoggedIn() )
    {
        header( "location: index.php" );
    }


    $user = null;

    if( isset($_GET['id']) )
    {
        if( is_numeric( $_GET['id'] ) )
        {
            $id = idSecurity::StringToUnharmful( $_GET['id'] );
            $q = $db->Query( "SELECT * FROM users WHERE id='$id'" );
            
            if( mysql_num_rows( $q ) != 0 )
                $user = mysql_fetch_assoc( $q );
            else
            {
                header( "location: index.php" );
            }
        }
        else
        {
            header( "location: index.php" );
        }

    }else
    {
        $id = idSecurity::StringToUnharmful( $_SESSION['id'] );
        $q = $db->Query( "SELECT * FROM users WHERE id='$id'" );
        $user = mysql_fetch_assoc( $q );
    }

    idViewManager::Show( "Profile" );

?>
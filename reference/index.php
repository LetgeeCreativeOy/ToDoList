<?php
    include_once( "app/idConfig.php" );
    include_once( "app/core/idDB.php" );
    include_once( "app/core/idSecurity.php" );
    include_once( "app/core/idViewManager.php" );

    $db = new idDB( DB_HOST, DB_USERNAME, DB_PASSWORD );
    $db->Open( DB_NAME );

    if( idSecurity::isLoggedIn() )
    {
        idViewManager::Show( "Home" );
    }
    else
    {
        idViewManager::Show( "Preview" );
    }
?>
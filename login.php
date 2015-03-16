<?php
    include_once( "app/idConfig.php" );
    include_once( "app/core/idDB.php" );
    include_once( "app/core/idSecurity.php" );
    include_once( "app/core/idViewManager.php" );
    include_once( "app/core/idNotify.php" );

    $db = new idDB( DB_HOST, DB_USERNAME, DB_PASSWORD );
    $db->Open( DB_NAME );

    $notify = new idNotify();

    if( idSecurity::isLoggedIn() )
    {
        header( "location: index.php" );
    }


    if( isset( $_POST['submit'] ) )
    {
        $username = idSecurity::StringToUnharmful( $_POST['username'] );
        $password = idSecurity::StringToUnharmful( $_POST['password'] );
        
        if( !empty( $username ) && !empty( $password ) )
        {
            $password = idSecurity::Encrypt( $password );
            $usr = $db->Query( "SELECT * FROM users WHERE username='$username' AND password='$password'" );
            
            $rows = mysql_num_rows( $usr );
            
            if( $rows != 0 )
            {
                $usr = mysql_fetch_assoc( $usr );
                $_SESSION['id'] = $usr['id'];
                $_SESSION['key'] = idSecurity::GenerateKey( $usr['id'] );
                
                header( "location: index.php" );
            }
            
            else
            {
                //Username or password is wrong message
                $notify->setNotify( 0, "Username or password is wrong!" );
            }
        }
        
        else
        {
            //Fill all fields message
            $notify->setNotify( 0, "You need to enter your username and password!" );
        }
    }

    idViewManager::Show( "Login" );

?>
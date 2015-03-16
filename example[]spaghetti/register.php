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
        $repassword = idSecurity::StringToUnharmful( $_POST['repassword'] );
        
        if( !empty( $username ) && !empty( $password ) && !empty( $repassword ) )
        {
            if( $password == $repassword )
            {
                $password = idSecurity::Encrypt( $password );
                $usr = $db->Query( "SELECT * FROM users WHERE username='$username'" );
                
                $rows = mysql_num_rows( $usr );
                
                if( $rows != 0 )
                {
                    //Username is allready used message 
                    $notify->setNotify( 0, "Username is already used!" );                  
                }
                
                else
                {
                    $db->Query( "INSERT INTO users( username, password ) VALUES( '$username', '$password' )" );
                    
                    $usr = $db->Query( "SELECT * FROM users WHERE username='$username' AND password='$password'" );
            
                    $rows = mysql_num_rows( $usr );
                    
                    if( $rows != 0 )
                    {
                        $usr = mysql_fetch_assoc( $usr );
                        $_SESSION['id'] = $usr['id'];
                        $_SESSION['key'] = idSecurity::GenerateKey( $usr['id'] );
                        
                        header( "location: index.php" );
                    }
                }   
            }
            
            else
            {
                //Passwords doesn't match message
                $notify->setNotify( 0, "Passwords don't match!" );
            }
        }
        
        else
        {
            //Fill all fields message
            $notify->setNotify( 0, "Fill all fields!" );
        }
    }

    idViewManager::Show( "Register" );

?>
<?php
    include_once( "app/idConfig.php" );
    include_once( "app/core/idDB.php" );
    include_once( "app/core/idSecurity.php" );
    include_once( "app/core/idMessager.php" );
    include_once( "app/core/idModeratorTools.php" );

    if( idSecurity::isLoggedIn() )
    {
        $db = new idDB( DB_HOST, DB_USERNAME, DB_PASSWORD );
        $db->Open( DB_NAME );
        
        if( $_POST['type'] == "sentTwoot" )
        {
            if( !idSecurity::isBanned( $_SESSION['id'], $db ) )
            {
                $text = idSecurity::StringToUnharmful( $_POST['msg'] );        
                idMessager::SentTwoot( $_SESSION['id'], $text, $db );
            }

            else {
                return "banned";
            }
        }
        
        else if( $_POST['type'] == "getTwoots" )
        {
			
			//if( idMessager::getLatestTwootId() <= 0 )
				idMessager::getTwoots( idModeratorTools::isModerator( $_SESSION['id'], $db ), $db );
			/*else {
				echo idMessager::getLatestTwootId();
				idMessager::getLatestTwoots( idModeratorTools::isModerator( $_SESSION['id'], $db ), $db );
			}*/
			
			
		}
		
		else if( $_POST['type'] == "like" ) 
		{
			$twootId = idSecurity::StringToUnharmful( $_POST['twootid'] );
			idMessager::Like( $twootId, $db );
		}

        else if( $_POST['type'] == "ban" )
        {
            $ban_id = idSecurity::StringToUnharmful( $_POST['userid'] );
            idModeratorTools::giveBanana( $ban_id, $_SESSION['id'], $db );
        }
    }
    
?>
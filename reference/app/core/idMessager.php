<?php

    include_once( "idDB.php" );
    include_once( "app/core/idModeratorTools.php" );

    class idMessager
    {		
        public static function SentTwoot( $id, $text, $db )
        {
            date_default_timezone_set( "Europe/Helsinki" );
            $date = date( "H:i d.m.Y" );
            $db->Query( "INSERT INTO twoots( `from`, `text`, `date` ) VALUES( '$id', '$text', '$date' )" );
        }
        
		public static function Like( $id, $db ) 
		{
			$likes = $db->Query( "SELECT * FROM twoots WHERE `id`='$id'" );
			
			$q = mysql_fetch_assoc( $likes );
			$q['likes'] += 1;
			
			$db->Query( "UPDATE twoots SET `likes`='$q[likes]' WHERE `id`='$id'" );
		}
		
        public static function getTwoots( $moderator = 0, $db )
        {
            $twoots = $db->Query( "SELECT * FROM twoots ORDER BY id DESC" );
            
            $amount = 0;		
            
			$_SESSION[ "latestId" ] = -1;
			
            while( $twoot = mysql_fetch_array( $twoots ) )
            {
				if( $_SESSION[ "latestId" ] < $twoot[ 'id' ] ) 
				{
					$_SESSION[ "latestId" ] = $twoot[ 'id' ];
				}
				
                if( $amount < 100 )
                {
                    $user = $db->Query( "SELECT * FROM users WHERE id='$twoot[from]'" );
                    $user = mysql_fetch_assoc( $user );
                    
                    $text = str_replace( "\n", "<br>", $twoot['text'] );
                    
                    echo '<div id="entry">
                            <div class="title"><a href="profile.php?id='.$user['id'].'">'.$user['username']."</a><span style='margin-left: 16px; font-size: 12px;'>Likes: ".$twoot['likes']."</span>";

					echo '<img id="banButton" src="imgs/like.png" onclick="Like('.$twoot['id'].')"></img>';
							
                    if( $moderator && !idModeratorTools::isModerator( $user['id'], $db ) )
                    {
                        echo '<img id="banButton" src="imgs/ban.png" onclick="BanUser('.$user['id'].')"></img>';
                    }

                    echo '</div>
                            <div class="text">'.$text.'<br><div class="date">'.$twoot['date'].'</div></div>
                        </div>';
                }
                
                else{
                    break;
                }
                
                $amount ++;
            }
        }

        public static function getTwootsById( $id, $moderator = 0, $db )
        {
            $twoots = $db->Query( "SELECT * FROM twoots WHERE `from`='$id' ORDER BY id DESC" );
            
            $amount = 0;
            
            while( $twoot = mysql_fetch_array( $twoots ) )
            {
                $user = $db->Query( "SELECT * FROM users WHERE id='$twoot[from]'" );
                $user = mysql_fetch_assoc( $user );
                
                $text = str_replace( "\n", "<br>", $twoot['text'] );
                
                echo '<div id="entry">
                        <div class="title"><a href="profile.php?id='.$user['id'].'">'.$user['username']."</a>";

                if( $moderator && !idModeratorTools::isModerator( $user['id'], $db ) )
                {
                    echo '<img id="banButton" src="imgs/ban.png" onclick="BanUser('.$user['id'].')"></img>';
                }

                echo '</div>
                        <div class="text">'.$text.'<br><div class="date">'.$twoot['date'].'</div></div>
                    </div>';
                
            }
        }
		
		public static function getLatestTwoots( $moderator = 0, $db )
        {
            $twoots = $db->Query( "SELECT * FROM twoots WHERE `id`>'$_SESSION[latestId]' ORDER BY `id` ASC" );
            
            while( $twoot = mysql_fetch_array( $twoots ) )
            {
				if( $_SESSION[ "latestId" ] < $twoot[ 'id' ] ) 
				{
					$_SESSION[ "latestId" ] = $twoot[ 'id' ];
					
					$user = $db->Query( "SELECT * FROM users WHERE id='$twoot[from]'" );
                    $user = mysql_fetch_assoc( $user );
                    
                    $text = str_replace( "\n", "<br>", $twoot['text'] );
                    
                    echo '<div id="entry">
                            <div class="title"><a href="profile.php?id='.$user['id'].'">'.$user['username']."</a>";

                    if( $moderator && !idModeratorTools::isModerator( $user['id'], $db ) )
                    {
                        echo '<img id="banButton" src="imgs/ban.png" onclick="BanUser('.$user['id'].')"></img>';
                    }

                    echo '</div>
                            <div class="text">'.$text.'<br><div class="date">'.$twoot['date'].'</div></div>
                        </div>';
				}
            }
        }
		
		public static function getLatestTwootId() {
			if( isset( $_SESSION[ "latestId" ] ) )
				return $_SESSION[ "latestId" ];
		}
    }

?>
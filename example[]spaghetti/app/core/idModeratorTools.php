<?php

	include_once( "idDB.php" );

	class idModeratorTools
	{
		public static function giveBanana( $ban_id, $user_id, $db ) {
			
			if( idModeratorTools::isModerator( $user_id, $db ) && !idModeratorTools::isModerator( $ban_id, $db ) )
			{
				$css = "class=\'banned\'";
				$db->Query( "UPDATE users SET `banned`='1', `bio`='<b $css>This user is banned!</b>' WHERE id='$ban_id'" );

				$db->Query( "UPDATE twoots SET `text`='<b $css>This user is banned!</b>' WHERE `from`='$ban_id'" );
			}
			
		}

		public static function isModerator( $id, $db )
		{
			$q = $db->Query( "SELECT * FROM users WHERE id='$id'" );
            $user = mysql_fetch_assoc( $q );

			return $user['moderator'];
		}
	}
?>
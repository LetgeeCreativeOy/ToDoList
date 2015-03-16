<?php

	class idNotify
	{
		private $types = array("error" , "warning", "completed"), $type, $msg;

		public function idNotify()
		{
			$this->type = "";
			$this->msg = "";
		}

		public function setNotify( $type, $msg )
		{
			$this->type = $type;
			$this->msg = $msg;
		}

		public function Show()
		{
			echo '<div id="notify" class="'.$this->types[$this->type].'"> <p>'.$this->msg.'</p></div>';
		}
	}

?>
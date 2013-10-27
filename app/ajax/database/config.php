<?php

	class Config
	{
		/**
		* Constructor
		*/
		function __construct()
		{
			$this->production = !preg_match('/localhost/', $_SERVER['SERVER_NAME']);

			// database connection
			if ($this->production)
			{
				$this->database = array(
					'host' 				=> 'localhost',
					'username' 			=> '',
					'password' 			=> '',
					'database' 			=> ''
				);
			}
			else
			{
				$this->database = array(
					'host' 				=> 'localhost',
					'username' 			=> 'usr_pers',
					'password' 			=> 'zegikniet',
					'database' 			=> 'pers_oranjerit'
				);
			}
		}
	}

?>

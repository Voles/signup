<?php
	
	// requires
	require_once('config.php');

	class DAOSubscribe
	{
		/**
		* Constructor
		*/
		function __construct()
		{
			// instances
			$config = new Config();

			// database connection
			$connectie = mysql_connect($config->database['host'], $config->database['username'], $config->database['password']);
			
			// check connection
			if ($connectie)
			{
				// database selecteren
				mysql_select_db($config->database['database']);
				return $connectie;
			}
			else
			{
				// script afbreken
				die('Error: ' . mysql_error());
			}
		}

		/**
		* New subscription
		*/
		function insert($post)
		{
			// values
			$firstname = $post['firstname'];
			$lastname = $post['lastname'];
			$mobile = $post['mobile'];
			$address = $post['address'];
			$postal = $post['postal'];
			$town = $post['town'];
			$car_brand = $post['brand'];
			$car_type = $post['type'];
			$car_year = $post['year'];
			$car_driver = $post['driver'];
			$car_navigator = $post['navigator'];
			$payment_option = $post['payment'];

			// SQL
			$sql = '
				INSERT INTO subscribers
				(
					firstname,
					lastname,
					mobile,
					address,
					postal,
					town,
					car_brand,
					car_type,
					car_year,
					car_driver,
					car_navigator,
					payment_option
				) 
				VALUES 
				(
					"' . mysql_real_escape_string($firstname) . '", 
					"' . mysql_real_escape_string($lastname) . '", 
					"' . mysql_real_escape_string($mobile) . '", 
					"' . mysql_real_escape_string($address) . '", 
					"' . mysql_real_escape_string($postal) . '", 
					"' . mysql_real_escape_string($town) . '", 
					"' . mysql_real_escape_string($car_brand) . '", 
					"' . mysql_real_escape_string($car_type) . '", 
					"' . mysql_real_escape_string($car_year) . '", 
					"' . mysql_real_escape_string($car_driver) . '", 
					"' . mysql_real_escape_string($car_navigator) . '", 
					"' . mysql_real_escape_string($payment_option) . '"
				)
			';
			$qry = mysql_query($sql) or die('Error: ' . mysql_error());
		}

		/**
		* Get all subscriptions
		*/
		function getAll()
		{
			$result = array();

			$sql = 'SELECT * FROM subscribers ORDER BY id ASC';
			$qry = mysql_query($sql) or die('Error: ' . mysql_error());

			while ($res = mysql_fetch_assoc($qry))
			{
				$result[] = $res;
			}

			return $result;
		}
	}

?>

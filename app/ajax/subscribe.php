<?php

	// includes
	require_once('database/DAOSubscribe.php');

	// instances
	$DAOSubscribe = new DAOSubscribe();

	// validation
	if (!isset($_POST['firstname']) || strlen($_POST['firstname']) < 1)
	{
		$message = array('type' => 'error', 'message' => 'Gelieve een geldige voornaam in te vullen');
	}
	elseif (!isset($_POST['lastname']) || strlen($_POST['lastname']) < 1)
	{
		$message = array('type' => 'error', 'message' => 'Gelieve een geldige achternaam in te vullen');
	}
	elseif (!isset($_POST['mobile']) || strlen($_POST['mobile']) < 1)
	{
		$message = array('type' => 'error', 'message' => 'Gelieve een geldig telefoonnummer in te vullen');
	}
	elseif (!isset($_POST['address']) || strlen($_POST['address']) < 1)
	{
		$message = array('type' => 'error', 'message' => 'Gelieve een geldig adres in te vullen');
	}
	elseif (!isset($_POST['postal']) || strlen($_POST['postal']) < 1)
	{
		$message = array('type' => 'error', 'message' => 'Gelieve een geldige postcode in te vullen');
	}
	elseif (!isset($_POST['town']) || strlen($_POST['town']) < 1)
	{
		$message = array('type' => 'error', 'message' => 'Gelieve een geldige plaatsnaam in te vullen');
	}
	elseif (!isset($_POST['year']) || strlen($_POST['year']) < 1)
	{
		$message = array('type' => 'error', 'message' => 'Gelieve een geldig bouwjaar in te vullen');
	}
	elseif (!isset($_POST['brand']) || strlen($_POST['brand']) < 1)
	{
		$message = array('type' => 'error', 'message' => 'Gelieve een geldige merknaam in te vullen');
	}
	elseif (!isset($_POST['type']) || strlen($_POST['type']) < 1)
	{
		$message = array('type' => 'error', 'message' => 'Gelieve een geldige typenaam in te vullen');
	}
	elseif (!isset($_POST['driver']) || strlen($_POST['driver']) < 1)
	{
		$message = array('type' => 'error', 'message' => 'Gelieve een geldige bestuurder in te vullen');
	}
	elseif (!isset($_POST['navigator']) || strlen($_POST['navigator']) < 1)
	{
		$message = array('type' => 'error', 'message' => 'Gelieve een geldige navigator in te vullen');
	}
	elseif (!email_is_valid($_POST['email']))
	{
		$message = array('type' => 'error', 'message' => 'Gelieve een geldig e-mailadres in te vullen');
	}
	elseif (!isset($_POST['firstname']) || strlen($_POST['firstname']) < 1)
	{
		$message = array('type' => 'error', 'message' => 'Gelieve een geldige voornaam in te vullen');
	}
	else
	{
		// save subscription
		$DAOSubscribe->insert($_POST);

		// send email
		$headers = 'Aan: ' . $_POST['firstname'] . ' ' . $_POST['lastname'] . ' <' . $_POST['email'] . '>' . "\r\n";
		$headers .= 'From: Oranjerit <info@oranjerit.nl>' . "\r\n";

		$body = '
Beste

Bedankt voor uw inschrijving, wij verwachten u op 30 april voor CCCO Oranjerit 2013.

Met vriendelijke groeten
Het Oranjerit team
		';
		mail($_POST['email'], 'Inschrijving Oranjerit 2013', $body, $headers);

		$message = array('type' => 'success', 'message' => 'Thank you for signing up!');
	}

	echo json_encode($message);

	/**
	* Check if the emailaddress is valid
	*/
	function email_is_valid($email)
	{
		return filter_var( $email, FILTER_VALIDATE_EMAIL );
	}

	/**
	* Check if user is already signed up
	*/
	function email_is_duplicate($email)
	{
		global $DAOSubscribe;
		return $DAOSubscribe->exists($email);
	}

?>
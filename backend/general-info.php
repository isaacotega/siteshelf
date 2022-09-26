<?php
	
	//temporary login
	
	
					setcookie("siteshelfAccountCookieCode",  "76142422622773108495", time() + (86400 * 30), "/");
		
	
	date_default_timezone_set("Africa/Lagos");
	
	$date = "500051";
	
	require_once("connection.php");
	
//	include_once("functions.php");
	
	$website = array(
		"name"=> "SiteShelf",
		"description" => "Websites organization made easy",
		"url" => array(
			"scheme" => "https://",
			"domain" => "siteshelf",
			"extension" => ".com"
		),
		"email" => array(
		/*	"headers" => "From: mail@theshowglass.com \r\n To: [receiversMail] \r\n MIME-Version: 1.0\r\n Content-Type: text/html; charset=ISO-8859-1\r\n",
			"sender" => "mail@theshowglass.com",
			"maximumSendsNo" => array(
				"emailConfirmation" => 3
			)*/
		),
		"cookies" => array(
			"account" => array(
				"name" => "siteshelfAccountCookieCode",
				"lifetime" => 30
			)
		),
		"special" => array(
			"subdomainUrl" => "siteshelfapp.com"
		),
		"defaults" => array(
			"currency" => "$"
		),
		"user" => array(),
		"content" => array("sites" => array("ids" => array()) )
	);
	
	$user = array(
		"account" => array(
			
		),
		"is" => array(
			"signedIn" => isset($_COOKIE[$website["cookies"]["account"]["name"]])
		)
	);
	
	if($user["is"]["signedIn"]) {
	
		$sql = "SELECT * FROM accounts WHERE cookie_code = '" . mysqli_real_escape_string($conn, $_COOKIE[$website["cookies"]["account"]["name"]]) . "' ";
		
		if($result = mysqli_query($conn, $sql)) {
			
			(mysqli_num_rows($result) > 0) or die( setcookie($website["cookies"]["account"]["name"], "", time() - 1, "/") );
		
			$row = mysqli_fetch_array($result);
			
			$user["account"]["usercode"] = $row["usercode"];
			
		}
		
	}
	
	$website["user"] = $user;
	
	
	
	$sql = "SELECT * FROM sites ";
		
	if($result = mysqli_query($conn, $sql)) {
			
		while($row = mysqli_fetch_array($result)) {
			
			$website["content"]["sites"]["ids"][] = $row["site_id"];
			
		}
			
	}
		
	
	
 ?>
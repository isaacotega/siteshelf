<?php
	
	$page = array("rootPath" => "", "title" => "" );
	
	include_once($page["rootPath"] . "backend/general-info.php");
	
	include_once($page["rootPath"] . "backend/methods.php");
	
	$page["title"] = $website["name"];
	
	if($website["user"]["is"]["signedIn"]) {
	
		include_once($page["rootPath"] . "templates/main-page.php");
	
	}
	
	else {
	
		include_once($page["rootPath"] . "templates/landing-page.php");
	
	}
	
 ?>
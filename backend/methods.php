<?php
	
	require_once("connection.php");
	
	function accountDetails($usercode) {
		
		global $conn, $page;
		
		$sql = "SELECT * FROM accounts WHERE usercode = '$usercode' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$accountDetails = array();
			
			$accountDetails["is"] = array();
			
			$accountDetails["usercode"] = $row["usercode"];
		
			$accountDetails["username"] = $row["username"];
		
			$accountDetails["profilePicture"] = "images/avatar.jpg";
		
			$accountDetails["socialAccountId"] = $row["social_account_id"];
		
			$accountDetails["dateRegistered"] = $row["date_registered"];
		
			$accountDetails["timeRegistered"] = $row["time_registered"];
		
		
			$sql = "SELECT * FROM sites WHERE owner_usercode = '$usercode' ";
		
			if($result = mysqli_query($conn, $sql)) {
		
				$accountDetails["sites"]["ids"] = array();
			
				while($row = mysqli_fetch_array($result)) {
					
					$accountDetails["sites"]["ids"][] = $row["site_id"];
					
				}
				
			}
			
			
			$sql = "SELECT * FROM domains WHERE owner_usercode = '$usercode' ";
		
			if($result = mysqli_query($conn, $sql)) {
			
				$accountDetails["domains"]["ids"] = array();
			
				while($row = mysqli_fetch_array($result)) {
					
					$accountDetails["domains"]["ids"][] = $row["domain_id"];
				
				}
				
			}
			
			return $accountDetails;
	
		}
		
	}
	 
	
	function siteDetails($siteId) {
		
		global $conn, $page, $website;
		
		$sql = "SELECT * FROM sites WHERE site_id = '$siteId' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$siteDetails = array();
			
			$siteDetails["siteId"] = $row["site_id"];
		
			$siteDetails["ownerUsercode"] = $row["owner_usercode"];
		
			$siteDetails["name"] = $row["name"];
		
			$siteDetails["subdomainName"] = $row["subdomain_name"];
		
			$siteDetails["dateAdded"] = $row["date_added"];
		
			$sql = "SELECT * FROM domains WHERE site_id = '$siteId' ";
		
			if($result = mysqli_query($conn, $sql)) {
			
				$row = mysqli_fetch_array($result);
			
				$siteDetails["has"]["domain"] = (mysqli_num_rows($result) > 0);
					
				if($siteDetails["has"]["domain"]) {
					
					$siteDetails["domainId"] = $row["domain_id"];
					
					$siteDetails["url"] = ($row["name"] . $row["extension"]);
					
				}
				
				else {
				
					$siteDetails["url"] = ($siteDetails["subdomainName"] . "." . $website["special"]["subdomainUrl"]);
					
				}
			
			}
		
			return $siteDetails;
	
		}
		
	}
	
	function subdomainSuggestion($name) {
	
		global $conn, $page, $website;
		
		$items = array(" ");
		
		$replacements = array("");
		
		$subdomain = str_replace($items, $replacements, trim(strtolower($name)));
		
		$subdomainExists = false;
			
		
		foreach($website["content"]["sites"]["ids"] as $eachId) {
		
			if(siteDetails($eachId)["subdomainName"] == $name) {
				
				$subdomainExists = true;
			
				break;
			
			}
		
		}
		
		if($subdomainExists) {
		
			$subdomain = ($name . "2");
		
		}
		
		return $subdomain;
			
	}
	
/*
	function icon($name, $type = "svg") {
		
		global $page;
	
		switch($type) {
		
			case "svg" :
			
				return file_get_contents($page["rootPath"] . "icons/" . $name . ".svg");
				
				break;
				
			case "image" :
			
				return file_get_contents($page["rootPath"] . "icons/" . $name . ".jpg");
				
				break;
				
			default :
			
				return file_get_contents($page["rootPath"] . "icons/" . $name . ".svg");
				
				
		}
	
	}
	*/
	function randomDigits($length) {
	
		$digits = "";						
						
		for($i = 0; $i < $length; $i++) {
						
			$digits .= rand(0, 9);
						
		}
		
		return $digits;
		
	}
					
 ?>
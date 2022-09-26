<?php
	
	require_once("connection.php");
	
	include_once("general-info.php");
	
	include_once("methods.php");
	
	include_once("functions.php");
	
	
	$request = $_POST["request"];
	
	
	
	if($request == "websiteData") {
		
		$data = array();
		
		
		$accountDetails = accountDetails($website["user"]["account"]["usercode"]);
		
		$data["accountDetails"] = $accountDetails;
		
		$data["defaults"] = $website["defaults"];
		
		$data["sites"] = array();
		
		$data["domains"] = array();
		
		foreach($accountDetails["sites"]["ids"] as $eachId) {
		
			$data["sites"][] = siteDetails($eachId);
			
		}
		
		foreach($accountDetails["domains"]["ids"] as $eachId) {
		
			$data["domains"][] = domainDetails($eachId);
			
		}
		
		echo json_encode($data);
	
	}
	
	
	if($request == "subdomainSuggestion") {
		
		$data = array();
		
		$name = $_POST["name"];
		
		$subdomain = subdomainSuggestion($name);
		
		$data["subdomain"] = $subdomain;
		
		echo json_encode($data);
	
	}
	
	
	if($request == "addSite") {
		
		$siteId = mysqli_real_escape_string($conn, randomDigits(20));
		
		$ownerUsercode = mysqli_real_escape_string($conn, $website["user"]["account"]["usercode"]);
		
		$name = mysqli_real_escape_string($conn, $_POST["name"]);
		
		$subdomainName = mysqli_real_escape_string($conn, subdomainSuggestion($_POST["name"]));

		
		$sql = "INSERT INTO sites (site_id, owner_usercode, name, subdomain_name, date_added) VALUES ('$siteId', '$ownerUsercode', '$name', '$subdomainName', '$date') ";
		
		if(mysqli_query($conn, $sql)) {
		
			$data = array("status" => "success");
			
		}
		
		else {
		
			$data = array("status" => "error");
			
		}
		
		echo json_encode($data);
	
	}
	
	
	if($request == "domainSearch") {
		
		$historyId = mysqli_real_escape_string($conn, randomDigits(20));
		
		$searcherUsercode = mysqli_real_escape_string($conn, $website["user"]["account"]["usercode"]);
		
		$domain = mysqli_real_escape_string($conn, $_POST["domain"]);
		
		$extension = mysqli_real_escape_string($conn, $_POST["extension"]);

		
		$sql = "INSERT INTO domain_search_history (history_id, searcher_usercode, domain, extension, date_searched) VALUES ('$historyId', '$searcherUsercode', '$domain', '$extension', '$date') ";
		
		mysqli_query($conn, $sql);
		
		
		$extensions = array(
			array(
				"extension" => "com",
				"available" => true,
				"price" => 8.57,
				"renewal" => 9.6
			),
			array(
				"extension" => "com.ng",
				"available" => true,
				"price" => 2.14,
				"renewal" => 3.4
			),
			array(
				"extension" => "site",
				"available" => true,
				"price" => 1.5,
				"renewal" => 2.0
			),
			array(
				"extension" => "name",
				"available" => true,
				"price" => 0.3,
				"renewal" => 0.7
			),
		);
		
		
		$data = array("status" => "success", "extensions" => $extensions);
			
		echo json_encode($data);
	
	}
	
 ?>
<?php
	
	$page = array("rootPath" => "../../");
	
	include_once($page["rootPath"] . "backend/general-info.php");
	
	include_once($page["rootPath"] . "backend/methods.php");
	
	$accountDetails = accountDetails($website["user"]["account"]["usercode"]);
	
?>

<style>

	 #mainDetailsHolder #siteFavicon {
		width: 5cm;
		height: 5cm;
		border-radius: 50%;
		background-color: rgba(0, 0, 0, 0.1);
		margin: 3mm;
	}
	
	#mainDetailsHolder #name {
		color: white;
		font-size: 50px;
	}
	
	#mainDetailsHolder #url {
		color: cyan;
		font-size: 30px;
	}
	
	#mainDetailsHolder #nameHolder {
		display: inline-block;
		height: 5cm;
		transform: translateY(-25%);
	}
	
	#domainHolder #url {
		color: cyan;
		font-size: 30px;
	}
	
	#toolsDisplay {
	
	}
	
	#toolsDisplay td {
		text-align: center;
	}
	
	#toolsDisplay img {
		width: 1cm;
		color: white;
		margin: 0 10mm;
	}
	
	#actionsDisplay {
	
	}
	
	#actionsDisplay td {
		text-align: center;
	}
	
	#actionsDisplay img {
		width: 1cm;
		color: white;
		margin: 0 10mm;
	}
	
</style>

<script>

	function displaySiteDetails() {
		
		for(var i = 0; i < website["data"]["sites"].length; i++) {
		
			if(website["data"]["sites"][i]["siteId"] == active["site"]) {
			
				var siteDetails = website["data"]["sites"][i];
				
				$("#mainDetailsHolder #name").html(siteDetails["name"]);
			
				$("#mainDetailsHolder #siteFavicon").attr("alt", siteDetails["name"]);
			
				$("#mainDetailsHolder #url").html(siteDetails["url"]);
			
				if(siteDetails["hasDomain"]) {
				
					$("#domainHolder #url").show();
					
					$("#domainHolder #linkDomainHolder").hide();
				
				}
				
				else {
				
					$("#domainHolder #url").hide();
					
					$("#domainHolder #linkDomainHolder").show();
				
				}
			
			}
		
		}
		
	}
		
	$(document).ready(function() {
		
		$("#linkDomainHolder #linkDomainButton").click(function() {
			
			loadPage("domain-chooser");
		
		});
		
	});

</script>

<div id="mainDetailsHolder">

	<img id="siteFavicon" alt="name"></img>

	<div id="nameHolder">

	<label id="name">Name</label>

	<br><br>

	<a href="">

		<label id="url">url</label>
	
	</a>
	
	</div>

</div>

<div class="heading">

	<label id="text">Domain</label>
	
</div>

<div id="domainHolder">

	<label id="url">url</label>
	
	<div id="linkDomainHolder">
	
		<div class="placeholder">No domain linked</div>
	
		<button id="linkDomainButton" class="bigButton">Link domain</div>
		
	</div>

</div>

<div class="heading">

	<label id="text">Tools</label>
	
</div>

<div id="toolsDisplay">

	<table>
	
		<tr>
		
			<td id="">
			
				<img src="" alt="File Manager"></img>
			
			</td>
		
			<td id="">
			
				<img src="" alt="MySQL"></img>
			
			</td>
		
			<td id="">
			
				<img src="" alt="phpMyAdmin"></img>
			
			</td>
		
			<td id="">
			
				<img src="" alt="SSH"></img>
			
			</td>
		
			<td id="">
			
				<img src="" alt="FTP manager"></img>
			
			</td>
		
			<td id="">
			
				<img src="" alt="cPanel"></img>
			
			</td>
		
		</tr>
		
	</table>

</div>

<div class="heading">

	<label id="text">Actions</label>
	
</div>

<div id="actionsDisplay">

	<table>
	
		<tr>
		
			<td id="">
			
				<img src="" alt="Pause"></img>
			
			</td>
		
			<td id="">
			
				<img src="" alt="Resume"></img>
			
			</td>
		
			<td id="">
			
				<img src="" alt="Delete"></img>
			
			</td>
		
		</tr>
		
	</table>

</div>
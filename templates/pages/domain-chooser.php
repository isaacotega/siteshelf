<?php
	
	$page = array("rootPath" => "../../");
	
	include_once($page["rootPath"] . "backend/general-info.php");
	
	include_once($page["rootPath"] . "backend/methods.php");
	
	$accountDetails = accountDetails($website["user"]["account"]["usercode"]);
	
?>

<style>
	
</style>

<script>

	$(document).ready(function() {
		
		var domains = website["data"]["domains"];
		
		if(domains.length == 0) {
		
			$("#domainsHolder").append(website["templates"].placeholder("You have no domains!"));
		
		}
		
		
 		for(var i = 0; i < domains.length; i++) {
 							
 			var domain = response[i]["name"];
 								
 			$("#domainsHolder").append(website["templates"].option(domain));
 								
 		}
 					
 		$("#actionsHolder").append(website["templates"].option("Buy a new domain", "", "", 'loadPage("domain-finder")'));
 			
	});

</script>



<div class="heading">

	<label id="text">Choose domain</label>
	
</div>
	
	
<div id="domainsHolder" class="optionHolder"></div>
 
<div id="actionsHolder" class="optionHolder"></div>
 
 
<?php
	
	$page = array("rootPath" => "../../");
	
	include_once($page["rootPath"] . "backend/general-info.php");
	
	include_once($page["rootPath"] . "backend/methods.php");
	
	$accountDetails = accountDetails($website["user"]["account"]["usercode"]);
	
?>

<style>
	
	#domainResultsHolder {
		display: none;
	}
	
</style>

<script>
	
	function displayDomain(domain, extension, price, renewal) {
		
		var description = "Purchase of <em>" + domain + "." + extension + "</em> domain";
		
		website["paymentInformation"] = {
			price: price,
			description: description
		} 
		
		website["templates"]["bigDisplay"].show('<label class="comment">Price: ' + website["data"]["defaults"]["currency"] + price + ' <br> Annual renewal: ' + website["data"]["defaults"]["currency"] + renewal + '</label> <br><br> <button class="bigButton" onclick=\' website["templates"]["bigDisplay"].hide(); loadPage("payment-gateway-paypal", prepareForm());\'>Purchase</button>', domain + "." + extension);
	
	}

	$(document).ready(function() {
		
		$("#domainSeachHolder form").submit(function() {
		
			event.preventDefault();
		
 			var domain = $(this).children("[name=domain]").val().toLowerCase().trim();
 			
 			var extension = "";
 			
 			if(domain == "") {
 			
 				toast("Please type in a domain name");
 			
 			}
 			
 			else {
 			
 				if(domain.indexOf(".") !== -1) {
 					
 					extension = domain.substr((domain.indexOf(".") + 1), (domain.length - domain.indexOf(".") - 1));
 					
 					
 					domain = domain.substr(0, domain.indexOf("."));
 					
 				}
 				
 				var fullDomain = domain + (extension == "" ? "" : "." + extension);
 					
 					loader.show();
 		
 					$.ajax({
 						type: "POST",
 						url: "backend/ajax-handler.php",
 						dataType: "JSON",
 						data: {
 							request: "domainSearch",
 							domain: domain,
 							extension: extension
 						},
 						success: function(response) {
 							
 							loader.hide();
 							
 							$("#domainResultsHolder").show();
 							
 							$("#domainResultsHolder [special=fullDomain]").html(fullDomain);
 							
 							$("#domainResultsHolder #main").html("");
 							
 							for(var i = 0; i < response["extensions"].length; i++) {
 							
 								var extension = response["extensions"][i];
 								
 								$("#domainResultsHolder #main").append(website["templates"].option(domain + "." + extension["extension"], website["data"]["defaults"]["currency"] + extension["price"], extension["available"] ? "available" : "unavailable", 'displayDomain("' + domain + '", "' + extension["extension"] + '", "' + extension["price"] + '", "' + extension["renewal"] + '");'));
 								
 							}
 					
 						},
 						error: function(response) {
 			
 							alert(JSON.stringify(response));
 				
 						}
 					});
 	
 			
 			}
 			
		});
		
	});

</script>

<br><br>

<div id="domainSeachHolder">

	<form autocomplete="off" class="form">

		<input name="domain" type="search" placeholder="Search domain by name" class="input">
	
		<button type="submit">Search Domain</button>
	
	</form>
 	 
</div>

<div id="domainResultsHolder">
	
	<div class="heading">

		<label id="text">Search results for <em><label special="fullDomain"></label></em></label>
	
	</div>
	
	<div id="main" class="optionHolder"></div>

 </div>
<?php
	
	$page = array("rootPath" => "../../");
	
	include_once($page["rootPath"] . "backend/general-info.php");
	
	include_once($page["rootPath"] . "backend/methods.php");
	
	$accountDetails = accountDetails($website["user"]["account"]["usercode"]);
	
?>

<style>
	
	#siteBoxHolder #main {
		display: inline-block;
	}
	
	#addSiteForm {
		display: none;
	}
	
	#addSiteForm form [name=name] {
		font-size: 40px;
		color: white;
		border: 0px solid;
		border-bottom: 2px solid white;
		width: 5cm;
		background-color: rgba(0, 0, 0, 0);
	}
	
</style>

<script>

	$(document).ready(function() {
	
		$("[actualSiteBox]").click(function() {
		
			active["site"] = $(this).attr("id");
			
			loadPage("site-display", displaySiteDetails());
		
		});
		
		$("#addSiteBox").click(function() {
		
			$("#addSiteBox").hide();
		
			$("#addSiteForm").show();
		
			$("#addSiteForm form [name=name]").focus();
		
		});
	
		$("#addSiteForm form [name=name]").blur(function() {
		
			var name = $("#addSiteForm form [name=name]").val();
		
			if(name == "") {
			
				$("#addSiteBox").show();
		
				$("#addSiteForm").hide();
			
			}
		
		});
		
		$("#addSiteForm form").submit(function() {
			
			event.preventDefault();
		
			var name = $("#addSiteForm form [name=name]").val();
		
			if(name == "") {
				
				toast("Please enter a name");
			
			}
			
			else {
			
				$("#addSiteBox").show();
		
				$("#addSiteForm").hide();
				
				$("#siteBoxHolder #main").append('<div class="siteBox"> <div id="loader"></div> <div id="iconHolder"> <img src="images/add-site.jpg"></img> </div> <div id="contentHolder"> <label id="siteName">' + name + '</label> <label id="siteUrl">' + $("#addSiteForm #siteUrl").html() + '</label> </div> </div>');
				
				
				$("#addSiteForm form [name=name]").val("");
			
				$("#addSiteForm #siteUrl").html("");
				
			
			$.ajax({
				type: "POST",
				url: "backend/ajax-handler.php",
				dataType: "JSON",
				data: {
					request: "addSite",
					name: name
				},
				success: function(response) {
				
					loadPage("shelf");
				
				},
				error: function(response) {
					alert(  JSON.stringify( response ) );
				}
			});
		
			}
		
		});
		
		$("#addSiteForm form [name=name]").keyup(function() {
		
			$.ajax({
				type: "POST",
				url: "backend/ajax-handler.php",
				dataType: "JSON",
				data: {
					request: "subdomainSuggestion",
					name: $("#addSiteForm form [name=name]").val()
				},
				success: function(response) {
				
					$("#addSiteForm form #siteUrl").html(response["subdomain"] + ".<?php echo $website["special"]["subdomainUrl"]; ?>");
				
				},
				error: function(response) {
					alert(  JSON.stringify( response ) );
				}
			});
		
		});
	
	});

</script>

<div class="heading">

	<label id="text">Sites</label>
	
	<div id="number" for=""><?php echo count($accountDetails["sites"]["ids"]); ?></div>
	
</div>

<div id="siteBoxHolder">

	<div id="main">

<?php
	
	foreach($accountDetails["sites"]["ids"] as $siteId) {
		
		$siteDetails = siteDetails($siteId);
	
		include($page["rootPath"] . "templates/site-box.php");
		
	}
	
 ?>
 
 	</div>
 
<div class="siteBox" id="addSiteBox">
 
 	<div id="iconHolder">
 	
 		<img src="images/add-site.jpg"></img>
 	
 	</div>
 	
 	<div id="contentHolder">
 	
 		<label id="siteName">Add Site</label>
 	
 		<label id="siteUrl"></label>
 	
 	</div>
 
 </div>
 
 </div>
 
<div class="siteBox" id="addSiteForm">
 
 	<div id="iconHolder">
 	
 		<img src="images/add-site.jpg"></img>
 	
 	</div>
 	
 	<div id="contentHolder">
 	
 		<form autocomplete="off">
 	
 			<label id="siteName">

				<input type="text" name="name" placeholder="Name">
		
			</label>
 	
 			<label id="siteUrl"></label>
 			
 		</form>
 	
 	</div>
 
 </div>
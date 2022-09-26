<?php
	
	include_once($page["rootPath"] . "templates/header.php");
	
?>

<div id="body">
	
	<div class="page" page="home"></div>

	<div class="page" page="shelf"></div>

	<div class="page" page="site-display"></div>

	<div class="page" page="domain-display"></div>

	<div class="page" page="domain-finder"></div>

	<div class="page" page="domain-chooser"></div>

	<div class="page" page="payment-gateway-paypal"></div>

	<div class="page" page="tools"></div>

	<div id="loader">
	
		<div id="background"></div>
		
		<div id="roller"></div>
	
	</div>

</div>

<?php
	
	include($page["rootPath"] . "templates/footer.php");
	
?>
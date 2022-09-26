<?php
	
	$page = array("rootPath" => "../../");
	
	include_once($page["rootPath"] . "backend/general-info.php");
	
	include_once($page["rootPath"] . "backend/methods.php");
	
	$accountDetails = accountDetails($website["user"]["account"]["usercode"]);
	
?>

<style>
	
	#detailsHolder {
		width: 90%;
		padding: 0 5%;
		color: white;
		font-size: 30px;
		line-height: 1cm;
	}
	
	#detailsHolder table {
		width: 100%;
	}
	
	#enterLabel {
		width: 100%;
		font-size: 35px;
		text-align: center;
		line-height: 2cm;
		display: block;
		color: white;
	}
	
</style>

<script>
	
	function prepareForm() {
	
		$("[content=price]").html(website["data"]["defaults"]["currency"] + website["paymentInformation"]["price"]);
	
		$("[content=description]").html(website["paymentInformation"]["description"]);
	
	}

	$(document).ready(function() {
		
		$("#cardPaymentForm form").submit(function() {
		
			event.preventDefault();
			
			showLoader();
		
		});
		
	});
	
</script>



<div class="heading">

	<label id="text">Payment gateway</label>
	
</div>

<div id="detailsHolder">

	<table>
		
		<tr>
			
			<td>Amount:</td>
			
			<td content="price"></td>
			
		</tr>

		<tr>
			
			<td>Description:</td>
			
			<td content="description"></td>
			
		</tr>

	</table>
	
</div>
	
<div id="cardPaymentForm">
	
	<form>
		
		<label id="enterLabel">Enter card details</label>

		<input type="number" name="cardNumber" placeholder="Card Number">
		
		<input type="number" name="cvv" placeholder="CVV">
		
		<div id="expiryDateHolder">
		
			<input type="number" name="expiryDateMonth" placeholder="MM">
		
			<label id="expiryDateSlash">/</label>
		
			<input type="number" name="expiryDateYear" placeholder="YY">
			
		</div>
		
		<br>
		
		<button type="submit">Proceed</button>
		
		<br><br>
		
		<label id="power">Powered by PayPal</label>
		
		<br><br>
	
	</form>
	
</div>
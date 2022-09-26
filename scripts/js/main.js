$(document).ready(function() {

	$("footer #bottomNav .option").click(function() {
		
		loadPage($(this).attr("id"));
	
		selectNav($(this).attr("id"));
	
	});
	
	loadAllPages();
			
	selectNav("shelf");

	loadPage("payment-gateway-paypal", setTimeout(function() {prepareForm() }, 1000) );

});

var active = [];

var website = [];
	
getWebsiteData();
	
	function selectNav(id) {
	
		$("footer #bottomNav .option").removeAttr("selected");
		
		$("footer #bottomNav #" + id).attr("selected", "true");
		
	}
	
	var loader = {
		show: function() {
			$("#body #loader").css({
				display: "block"
			});
		},
		hide: function() {
			$("#body #loader").css({
				display: "none"
			});
		}
	}
	
	
	function loadAllPages() {
	
		for(var i = 0; i < $("#body .page").length; i++) {
		
			var pageName = $("#body .page").eq(i).attr("page");
		
			getPage(i);
	
		}
		
		function getPage(index) {
		
			$.ajax({
				type: "POST",
				url: (page["rootPath"] + "templates/pages/" + pageName + ".php"),
				data: {},
				success: function(response) {
				
			//		loader.hide();
				
					$("#body .page").eq(index).html(response);
				
				},
				error: function(response) {
		//		alert(  JSON.stringify( response ) );
				}
			});
		
		}
		
	}
	
	function loadPage(pageName, callBackFunction) {
	
		if(website["currentPage"] !== pageName) {
		
			$("#body .page").attr("id", "");
		
			$("#body [page=" + pageName + "]").attr("id", "mainContent");
		
		}
		
		else {
		
			loader.show();
		
			$.ajax({
				type: "POST",
				url: (page["rootPath"] + "templates/pages/" + pageName + ".php"),
				data: {},
				success: function(response) {
				
					loader.hide();
				
					$("#body [page=" + pageName + "]").html(response);
				
				},
				error: function(response) {
				alert(  JSON.stringify( response ) );
				}
			});
		
		}
	
		if(callBackFunction !== undefined) {
		
			callBackFunction();
			
		}
			
		website["currentPage"] = pageName;
		
	}
	
	function toast(text) {
	
		$("#toast").css({
			display: "block",
			bottom: "4cm",
			opacity: "1"
		}).html(text);
		
		setTimeout(function() {
		
			$("#toast").css({
				display: "none",
				bottom: "2cm",
				opacity: "0"
			}).html(text);
		
		}, 2000);
	
	}
	
	setInterval(function() {
		
		getWebsiteData();
	
		
	//	$("[special=creditsNumber]").html(website["data"]["accountDetails"]["credits"]);
		
	}, 500);
	
	website["templates"] = [];
	
	website["templates"]["bigDisplay"] = {
		show: function(content, topic) {
			
			var heading = '<label id="topic">' + (topic !== undefined ? topic : "") + '</label><br><br>';
		
			$("#bigDisplay").show(100);
			
			$("#bigDisplay #main").html(heading + content);
		
			$("#bigDisplay #background").click(function() {
				
				website["templates"]["bigDisplay"].hide();
			
			});
		
		},
		hide: function() {
			
			$("#bigDisplay").hide(100);
			
			$("#bigDisplay #main").html("");
		
		}
	}
	
	website["templates"]["option"] = function(mainText, cornerText, bottomText, event) {
		
		mainText = mainText !== undefined ? mainText : "";
	
		cornerText = cornerText !== undefined ? cornerText : "";
	
		bottomText = bottomText !== undefined ? bottomText : "";
	
		event = event !== undefined ? event : "";
	
		return '<div class="option" onclick=\'' + event + '\'> <label id="mainText">' + mainText + '</label> <label id="cornerText">' + cornerText + '</label> <label id="bottomText">' + bottomText + '</label> </div>';
		
	}
	
	website["templates"]["placeholder"] = function(text) {
		
		text = text !== undefined ? text : "";
	
		return '<div class="placeholder"> <label id="text">' + text + '</label> </div>';
		
	}
	
	function getWebsiteData() {
		
		$.ajax({
			type: "POST",
			url: (page["rootPath"] + "backend/ajax-handler.php"),
			dataType: "JSON",
			data: {
				"request": "websiteData"
			},
			success: function(response) {
				
		//		alert(  JSON.stringify( response ) );
				
				website["data"] = response;
	
			},
			error: function(response) {
	
				alert(  JSON.stringify( response ) );
				
			},
		});
		
	}
	
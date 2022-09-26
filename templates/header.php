<?php
	
	include_once($page["rootPath"] . "scripts/php/access-restrictor.php");
		
	include_once($page["rootPath"] . "backend/general-info.php");

?>

<!DOCTYPE html>

<html>

	<head>
  
		<title><?php echo ($page["title"] . " - " . $website["name"]); ?></title>
	
		<link rel="stylesheet" type="text/css" href="<?php echo $page["rootPath"]; ?>styles/index.css">
		
		<script>
		
			var page = JSON.parse('<?php echo json_encode($page); ?>');
		
		</script>

		<script src="<?php echo ($page["rootPath"]  . "scripts/js/JQuery.js"); ?>"></script>
	
		<script src="<?php echo ($page["rootPath"]  . "scripts/js/main.js"); ?>"></script>
	
	</head>
	
	<body>

		<header>
			
			<span id="navIcon">&#2497;</span>
      
			<label id="websiteName"><?php echo $website["name"]; ?></label>
      
		</header>
		
		<?php
	
			include_once($page["rootPath"] . "templates/big-display.php");
		
			include_once($page["rootPath"] . "templates/toast.php");

		?>
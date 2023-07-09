<!DOCTYPE html>
<html>
<head>
	<title>Опрос</title>
	<meta charset='UTF-8'>
	<script type="text/javascript" src="js/jq.js"></script>
	<link rel="shortcut icon" href="https://www.axereal.com/sites/default/files/2021-03/organisation_0.png">
	<?php
	include "php/connect_base_sql.php";
	switch ($_GET['page']) {
	case '1':

		break;

	default:
		echo '<link rel="stylesheet" type="text/css" href="styles/style.css">';
		echo '<script type="text/javascript" src="js/script.js"></script>';
		break;
	}
?>
</head>
<body>
<?php
	switch ($_GET['page']) {
	case '1':
		
		break;

	default:
		include "home.html";
		break;
	}
?>
</body>
</html>
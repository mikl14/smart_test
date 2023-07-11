<?php
session_start();

// switch ($_GET['act']) {
//   case 'up':
//     //провальная попытка сделать по умному
//     foreach ($_POST as $key => $value) {
//       if($key != 'navig' && $value)
//       {
//         $_SESSION[$key] = $value;
//       }
//     }
//     header('location:/html/answer_base.php');
//     print_r($_SESSION);
//     break;
//   case 'end':
//     session_destroy();
//     header('location:../');
//     break;
//   default:
    
//     break;
// }
?>
<!DOCTYPE html>
<html>
<head>
	 <title>Опрос</title>
  <meta charset='UTF-8'>
  <script type="text/javascript" src="../js/jq.js"></script>
  <script type="text/javascript" src="../js/opros.js"></script>
  <link rel="shortcut icon" href="https://www.axereal.com/sites/default/files/2021-03/organisation_0.png">
	<link rel="stylesheet" type="text/css" href="../styles/style_answer_base.css">
</head>
<body>
	<header>
		<img src="https://websbor.gks.ru/online/assets/img/logo-rosstat.png">
	</header>
	<div class="window opros">
	</div>
</body>
</html>
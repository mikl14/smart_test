<?php
require_once("user.php");
//require_once("Search_answers.php");
$txt_file = file_get_contents('started_answers.txt'); // путь к текстовику
$rows = explode("\n", $txt_file);// разделили построчно на массив

$user = new User; // создан юзер

for($i = 0; $i < count($rows);$i++) // по количеству  
{
    $user -> check_answer((int)(substr($rows[$i],strpos($rows[$i],'#')+1,strlen($rows[$i]))),"да"); //парсинг вопроса
}
$user -> display();
?>
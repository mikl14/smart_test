<?php
if(isset($_POST['INN']))
{
	require __DIR__.'/php/connect_base_sql.php';
	$arr = find_by_inn($_POST['INN']);
	if($arr != 0)
	{
		$arr['success'] = 1;
		echo json_encode($arr);	
	}
	else
	{
		echo json_encode(array('success'=> 0));
	}
}
else
{
	echo json_encode(array('success'=> 0));
}
?>
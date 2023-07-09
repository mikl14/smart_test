<?php
$GLOBALS['dbconn'] = pg_connect("host=localhost port=5432 dbname=users user=postgres password=schef2002") or die("Could not connect");

function find_by_inn($INN)
{
    if (!pg_connection_busy($GLOBALS['dbconn'])) 
    {
        $result = pg_query($GLOBALS['dbconn'], "SELECT * FROM kirov WHERE inn = '".$INN."' LIMIT 1");
        if ($result) 
        {
            $arr = pg_fetch_array($result);
            return $arr;
        }
        return 0;
    }
}

function get_custom_query($query)
{
    if (!pg_connection_busy($GLOBALS['dbconn'])) 
    {
        $result = pg_query($query);

        if (!$result) 
        {
            echo "Произошла ошибка.\n";
            exit;
        }
        $arr = pg_fetch_array($result);
        
        echo $arr[0];
    }
}
?>
<?php
ob_start();
include "inc.php"; 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://data.fixer.io/api/latest?access_key=78eee79f5ae61d9a4f183eba5f96bb16&base=EUR");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
"API_KEY=78eee79f5ae61d9a4f183eba5f96bb16");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);
curl_close ($ch);


$json_arr = json_decode($server_output, true);

$menu_array = $json_arr;

 
 
 foreach($menu_array['rates'] as $key => $val) { 
 echo $key.'----'; echo $val.'<br>';
  
    }



?>
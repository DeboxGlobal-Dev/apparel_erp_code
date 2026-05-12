<?php
/*function convertCurrency($amount,$from_currency,$to_currency){
  $apikey = 'dfcd40a2be251f202715';

  $from_Currency = urlencode($from_currency);
  $to_Currency = urlencode($to_currency);
  $query =  "{$from_Currency}_{$to_Currency}";

  // change to the free URL if you're using the free version
  $json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apikey}");
  $obj = json_decode($json, true);

  $val = floatval($obj["$query"]);


  $total = $val * $amount;
  return number_format($total, 2, '.', '');
}

//uncomment to test
//echo convertCurrency(1, 'USD', 'INR');
*/

include "inc.php";


$rss=GetPageRecord('*','profileMaster',"1 order by id asc");
while($resListing1s=mysqli_fetch_array($rss)){

	$module=GetPageRecord('*','moduleMaster',"1 order by id asc");
	while($resModule=mysqli_fetch_array($module)){

    $whereCheckref = 'profileId="'.$resListing1s['id'].'" and moduleId="'.$resModule['id'].'"';
    $checkPermission = checkduplicate('permissionMaster',$whereCheckref);

    if($checkPermission=="no"){
      $namevalue ='profileId="'.$resListing1s['id'].'",moduleId="'.$resModule['id'].'",view="1",addentry="1",edit="1",dlt="1",import="1",export="1"';
      addlistinggetlastid('permissionMaster',$namevalue);
    }

	}

}


?>
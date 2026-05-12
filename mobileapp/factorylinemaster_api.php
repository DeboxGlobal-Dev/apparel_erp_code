<?php
include '../inc.php';
header("Content-Type: application/json");
class clsListData
{
  public $lineName;
  public $lineId;
}
$listArray = array();

$rs14 = GetPageRecord('*', 'factoryLineMaster', '1 and factoryId=5 order by id asc');
while ($factoryData = mysqli_fetch_array($rs14)) {

  $objListData = new clsListData();

  $objListData->lineId = $factoryData['id'];
  $objListData->lineName = $factoryData['lineName'];
  array_push($listArray, $objListData);
}

echo json_encode(['Status' => '0', 'Message' => 'Success', 'TotalRecord' => $listArray], JSON_PRETTY_PRINT);
?>
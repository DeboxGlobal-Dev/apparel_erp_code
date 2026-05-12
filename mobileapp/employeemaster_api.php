<?php
include '../inc.php';
header("Content-Type: application/json");
class clsListData
{
  public $name;
  public $id;
}
$listArray = array();

$rs = GetPageRecord('*', 'employeeMaster', '1 and status=1 and empType=2 || empType=3 || empType=1 order by name asc ');
while ($empData = mysqli_fetch_array($rs)) {
  $objListData = new clsListData();
  $objListData->id = $empData['id'];
  $objListData->name = $empData['name'];
  array_push($listArray, $objListData);
}

echo json_encode(['Status' => '0', 'Message' => 'Success', 'DataList' => $listArray], JSON_PRETTY_PRINT);
?>
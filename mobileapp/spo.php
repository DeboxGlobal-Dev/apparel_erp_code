<?php
include '../inc.php';




header("Content-Type: application/json");
class supplierData
{
public $supplier;
public $style;
public $materialList = array();

}

class clsListData
{
	public $Materialid;
	public $value;
	public $styleId;


}

$SummaryArray = array();

$listArray=array();


$no=1;
$select='*';
$where='';
$rs='';
$wheresearch='';

$limit=clean($_GET['records']);

$where='where 1 group By createdDate,supplierId order by createdDate desc';

$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module="'.$modfile['url'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';

$rs=GetRecordList($select,'indentCreationMaster',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
if($totalentry=1){
$totalentry=2;
}
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

if($resultlists['supplierId']!=0){

$list=GetPageRecord('*','indentCreationMaster','1 and supplierId="'.$resultlists['supplierId'].'" and createdDate="'.$resultlists['createdDate'].'"');
$count=mysqli_num_rows($list);


$list2=GetPageRecord('*','indentCreationMaster','1 and supplierId="'.$resultlists['supplierId'].'" and createdDate="'.$resultlists['createdDate'].'" and bomPoStatus=0');
$countPending=mysqli_num_rows($list2);
if($countPending!=0){


if($resultlists['requisitionNo']==""){
$rsList=GetPageRecord('styleId','indentCreationMaster','supplierId="'.$resultlists['supplierId'].'" and createdDate="'.$resultlists['createdDate'].'"  group by styleId');
$productionName=mysqli_fetch_array($rsList);
$rsListbuyer=GetPageRecord('buyerId,brandId','queryMaster','id="'.$productionName['styleId'].'"');
$queryList=mysqli_fetch_array($rsListbuyer);

$objListData = new supplierData();
$objListData->supplier = getSupplierName($resultlists['supplierId']);
$objListData->style =getStyleRefId($productionName['styleId']);

// array_push($listArray, $objListData);

$listArray=array();



$rstype=GetPageRecord('*','materialTypeMaster','1 order by id asc');
while($resListingtype=mysqli_fetch_array($rstype)){


$rsindent=GetPageRecord('*','indentCreationMaster','materialTypeId="'.$resListingtype['id'].'" and supplierId="'.$resultlists['supplierId'].'" and createdDate="'.$resultlists['createdDate'].'"');
while($resListingIndent1=mysqli_fetch_array($rsindent)){
$rs1=GetPageRecord('*','styleSubCategoryMaster','id="'.$resListingIndent1['materialId'].'"');
$resListing1=mysqli_fetch_array($rs1);




$objListData1 = new clsListData();
$objListData1->Materialid = $resListing1['name'];
$objListData1->value= $resListingIndent1['sellingValue'];
$objListData1->styleId= getStyleRefId($productionName['styleId']);

$a=array_push($listArray, $objListData1);

} }
$objListData->materialList=$listArray;
$a= array_push($SummaryArray,$objListData);






} } } }
echo json_encode(['Status'=>'0','Message'=>'Success','TotalRecord'=>$SummaryArray],JSON_PRETTY_PRINT);


?>
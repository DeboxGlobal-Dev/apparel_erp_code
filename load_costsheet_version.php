<?php
include "inc.php";
$id=$_REQUEST['styleId'];
$costsheetVersionId=$_REQUEST['costsheetVersionId'];

if($_REQUEST['action']=='setdefault'){
$namevalue ='defaultcostsheetVersionId="'.$costsheetVersionId.'"';
$where='id="'.$id.'"';
$update = updatelisting('queryMaster',$namevalue,$where);
}


if($_REQUEST['action']=='qualityrequired'){
$namevalue1 ='qtyStatus="'.$_REQUEST['qtystatus'].'"';
$where1='id="'.$_REQUEST['id'].'"';
$update1 = updatelisting('styleSubCategoryMaster',$namevalue1,$where1);

}

if($_REQUEST['action']=='pricerequired'){
$namevalue1 ='priceStatus="'.$_REQUEST['priceStatus'].'"';
$where1='id="'.$_REQUEST['id'].'"';
$update1 = updatelisting('styleSubCategoryMaster',$namevalue1,$where1);

}

if($_REQUEST['action']=='vendorrequired'){
$namevalue1 ='vendorStatus="'.$_REQUEST['vendorStatus'].'"';
$where1='id="'.$_REQUEST['id'].'"';
$update1 = updatelisting('styleSubCategoryMaster',$namevalue1,$where1);

}

if($_REQUEST['action']=='colorseparation'){
$namevalue1 ='colorSeparate="'.$_REQUEST['colorSeparate'].'"';
$where1='id="'.$_REQUEST['id'].'"';
$update1 = updatelisting('styleSubCategoryMaster',$namevalue1,$where1);

}

if($_REQUEST['action']=='sizeseparation'){

$namevalue1 ='sizeSeparate="'.$_REQUEST['sizeSeparate'].'"';
$where1='id="'.$_REQUEST['id'].'"';
$update1 = updatelisting('styleSubCategoryMaster',$namevalue1,$where1);

//=================================NEW CODE APPAREL============================================================
deleteRecord('styleSubCategoryMaster','parentId="'.$_REQUEST['id'].'"');
deleteRecord('techPackDetailMaster','1 and stylesubtabid not in (select id from styleSubCategoryMaster)');

if($_REQUEST['sizeSeparate']==1){

$styleId=$_REQUEST['styleId'];

$sq=GetPageRecord('sizerange','queryMaster','1 and id="'.$styleId.'"');
$styleData=mysqli_fetch_array($sq);

$srq=GetPageRecord('*','sizerangeMaster','1 and id="'.$styleData['sizerange'].'"');
$sizeRangeData=mysqli_fetch_array($srq);

$subq=GetPageRecord('*','styleSubCategoryMaster','1 and id="'.$_REQUEST['id'].'"');
$subCatData=mysqli_fetch_array($subq);

$array =  explode(':', $sizeRangeData['size']);

foreach ($array as $item) {

$namevalue121 ='parentId="'.$_REQUEST['id'].'",name="'.$subCatData['name'].'",materialid="'.$subCatData['materialid'].'",materialType="'.$subCatData['materialType'].'",subCategoryId="'.$subCatData['subCategoryId'].'",status="'.$subCatData['status'].'",deletestatus="'.$subCatData['deletestatus'].'",styleId="'.$subCatData['styleId'].'",sr="'.$subCatData['sr'].'",assignTo="'.$subCatData['assignTo'].'",costsheetVersionId="'.$subCatData['costsheetVersionId'].'",qtyStatus=0,priceStatus=0,vendorStatus=0,materialdescriptionid="'.$subCatData['materialdescriptionid'].'",assignToPurMerchant="'.$subCatData['assignToPurMerchant'].'",colorSeparate=0,sizeSeparate=0,sizeName="'.$item.'"';

$lastId = addlistinggetlastid('styleSubCategoryMaster',$namevalue121);

$techPackDataq=GetPageRecord('*','techPackDetailMaster','1 and stylesubtabid="'.$_REQUEST['id'].'"');
$techPackData=mysqli_fetch_array($techPackDataq);

$namek ='stylesubtabid="'.$lastId.'",sectionType="'.$techPackData['sectionType'].'",styleId="'.$techPackData['styleId'].'",costsheetVersionId="'.$techPackData['costsheetVersionId'].'",bomAvg="'.$techPackData['bomAvg'].'",bomWidth="'.$techPackData['bomWidth'].'",finish="'.$techPackData['finish'].'",bomUnit="'.$techPackData['bomUnit'].'",wastagePersent="'.$techPackData['wastagePersent'].'",avgIncWastage="'.$techPackData['avgIncWastage'].'",matPrice="'.$techPackData['matPrice'].'",matCurrency="'.$techPackData['matCurrency'].'",landingcostper="'.$techPackData['landingcostper'].'",bomRate="'.$techPackData['bomRate'].'",bomvalueonepc="'.$techPackData['bomvalueonepc'].'",bomPlacement="'.$techPackData['bomPlacement'].'"';
$akkkkkkkkk = addlisting('techPackDetailMaster',$namek);

}

//=================END OF CODE APPAREL============================================================================

}


}


?>
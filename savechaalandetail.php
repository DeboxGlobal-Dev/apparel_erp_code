<?php
include('inc.php');


if($_REQUEST['action']=="savechaalanparentdetail" && $_REQUEST['departmentId']!="" && $_REQUEST['fromDepartmentId']!=""){

$id=decode($_REQUEST["id"]);
$departmentId=clean($_REQUEST["departmentId"]);
$fromDepartmentId=clean($_REQUEST["fromDepartmentId"]);
$gdiRemark=clean($_REQUEST["gdiRemark"]);
$chargesDetail=clean($_REQUEST["chargesDetail"]);
$styleId=decode($_REQUEST["styleId"]);
$fromFactoryId=clean($_REQUEST["fromFactoryId"]);
$toFactoryId=clean($_REQUEST["toFactoryId"]);
$authorizedBy=clean($_REQUEST["authorizedBy"]);
$receivedBy=clean($_REQUEST["receivedBy"]);
$supervisor=clean($_REQUEST["supervisor"]);

$namevalue1 = 'departmentId="'.$departmentId.'",fromDepartmentId="'.$fromDepartmentId.'",gdiRemark="'.$gdiRemark.'",chargesDetail="'.$chargesDetail.'",styleId="'.$styleId.'",status=1,toFactoryId="'.$toFactoryId.'",fromFactoryId="'.$fromFactoryId.'",authorizedBy="'.$authorizedBy.'",receivedBy="'.$receivedBy.'",supervisor="'.$supervisor.'"';
$whereval='id="'.$id.'"';
updatelisting('chaalanMaster',$namevalue1,$whereval);




}

if($_REQUEST['action']=="savepdfdetail" && $_REQUEST['id']!=""){

$color=addslashes($_REQUEST['color']);
$size=addslashes($_REQUEST['size']);
$quantity=addslashes($_REQUEST['quantity']);
$fromSr=addslashes($_REQUEST['fromSr']);
$toSr=addslashes($_REQUEST['toSr']);
$quantityType=addslashes($_REQUEST['quantityType']);
$remark=addslashes($_REQUEST['remark']);
$length=addslashes($_REQUEST['length']);
$lengthUom=addslashes($_REQUEST['lengthUom']);
$avg=addslashes($_REQUEST['avg']);
$avgUom=addslashes($_REQUEST['avgUom']);
$materialId=addslashes($_REQUEST['materialId']);
$receivedQty=addslashes($_REQUEST['receivedQty']);

$id=addslashes($_REQUEST['id']);

//$namevalue ='color="'.$color.'",size="'.$size.'",quantity="'.$quantity.'",quantityType="'.$quantityType.'",remark="'.$remark.'",dateAdded="'.time().'",chaalanDate="'.date('Y-m-d').'",fromSr="'.$fromSr.'",toSr="'.$toSr.'",length="'.$length.'",lengthUom="'.$lengthUom.'",avg="'.$avg.'",avgUom="'.$avgUom.'",materialId="'.$materialId.'"';
$namevalue ='color="'.$color.'",size="'.$size.'",quantity="'.$quantity.'",quantityType="'.$quantityType.'",remark="'.$remark.'",dateAdded="'.time().'",chaalanDate="'.date('Y-m-d').'",fromSr="'.$fromSr.'",toSr="'.$toSr.'",materialId="'.$materialId.'",lengthUom="'.$lengthUom.'",avgUom="'.$avgUom.'",length="'.$length.'",avg="'.$avg.'",receivedQty="'.$receivedQty.'",receivedDate="'.date('Y-m-d').'"';

$where='id="'.$id.'"';
$update = updatelisting('chaalanMaster',$namevalue,$where);

$rs1=GetPageRecord('*','chaalanMaster','id="'.$id.'"');
$resultlist1=mysqli_fetch_array($rs1);

updatelisting('chaalanMaster','status=1','id="'.$resultlist1['parentId'].'"');

}

if($_REQUEST['action']=="savegrnitemqty" && $_REQUEST['id']!=""){

$id=clean($_REQUEST["id"]);
$qtyShipBySupplier=clean($_REQUEST["qtyShipBySupplier"]);
$received=clean($_REQUEST["received"]);
$qcShortage=clean($_REQUEST["qcShortage"]);
$netReceived=clean($_REQUEST["netReceived"]);
$sqmQty=clean($_REQUEST["sqmQty"]);
$uom=clean($_REQUEST["uom"]);
$rate=clean($_REQUEST["rate"]);
$value=clean($_REQUEST["value"]);
$excess=clean($_REQUEST["excess"]);

$namevalue1 = 'qtyShipBySupplier="'.$qtyShipBySupplier.'",received="'.$received.'",qcShortage="'.$qcShortage.'",netReceived="'.$netReceived.'",sqmQty="'.$sqmQty.'",uom="'.$uom.'",rate="'.$rate.'",value="'.$value.'",excess="'.$excess.'",status=2';

$whereval='id="'.$id.'"';
updatelisting('grnMaster',$namevalue1,$whereval);

}

if($_REQUEST['action']=="savebillmove" && $_REQUEST['id']!=""){

$id=clean($_REQUEST["id"]);
$qtyShipBySupplier=clean($_REQUEST["qtyShipBySupplier"]);
$received=clean($_REQUEST["received"]);
$qcShortage=clean($_REQUEST["qcShortage"]);
$netReceived=clean($_REQUEST["netReceived"]);
$sqmQty=clean($_REQUEST["sqmQty"]);
$uom=clean($_REQUEST["uom"]);
$rate=clean($_REQUEST["rate"]);
$value=clean($_REQUEST["value"]);
$excess=clean($_REQUEST["excess"]);

$namevalue1 = 'qtyShipBySupplier="'.$qtyShipBySupplier.'",received="'.$received.'",qcShortage="'.$qcShortage.'",netReceived="'.$netReceived.'",sqmQty="'.$sqmQty.'",uom="'.$uom.'",rate="'.$rate.'",value="'.$value.'",excess="'.$excess.'",status=2';

$whereval='id="'.$id.'"';
updatelisting('billMovementMaster',$namevalue1,$whereval);

}

if($_REQUEST['action']=="savepaymentprocessing" && $_REQUEST['id']!=""){

    $id=clean($_REQUEST["id"]);
    $paymentAmount=clean($_REQUEST["paymentAmount"]);

    $namevalue1 = 'paymentAmount="'.$paymentAmount.'"';

    $whereval='id="'.$id.'"';
    updatelisting('billMovementMaster',$namevalue1,$whereval);

    }
?>
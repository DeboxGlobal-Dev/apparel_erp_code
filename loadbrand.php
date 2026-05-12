<?php
include "inc.php";
include "config/logincheck.php";


if($_REQUEST['action']=='changebrandaction'){
$buyerId=$_REQUEST['buyerId'];
$brandId=$_REQUEST['selectId'];
?>

<option value="">Select</option>
<?php

$select='';
$where='';
$rs='';
$select='*';
if($buyerId!=''){
$buyerId=' and buyerId="'.$buyerId.'" ';
}
//$where=' 1 '.$buyerId.' order by name asc';
//$rs=GetPageRecord($select,'brandMaster',$where);
if($loginuserprofileId==1){
$where='1 '.$buyerId.' group by brandId';
}else{
$where='profileId="'.trim($loginuserprofileId).'" '.$buyerId.'  and (FIND_IN_SET('.$_SESSION['userid'].',assignTo) or assignTo=0) group by brandId';
}
$rs=GetPageRecord($select,'resourceAllocationBrandWise',$where);
while($resListing=mysqli_fetch_array($rs)){
    $buyerId=$_REQUEST['buyerId'];

    $valid=$_REQUEST['valid'];

//     $wheregh=' 1  and buyerId="'.$buyerId.'" and bydefault=1';
// $rsgh=GetPageRecord($select,'brandMaster',$wheregh);
// $resListinggh=mysqli_fetch_array($rsgh);

  $buy=GetPageRecord('*','brandMaster','buyerId="'.$buyerId.'" and bydefault=1');
	$buy_tree=mysqli_fetch_array($buy);
if($valid==0 ){

     //$sel=$_REQUEST['selectId'];

}else{
     //$sel=$buy_tree['id'];

}




?>
<option value="<?php echo strip($resListing['brandId']); ?>" <?php if($resListing['brandId']==$sel){ ?>selected="selected"<?php } ?>><?php echo getBrandName(strip($resListing['brandId'])); ?></option>
<?php }


}


if($_REQUEST['action']=='changebrands'){
$buyerId=$_REQUEST['buyer'];
$selectId=$_REQUEST['selectId'];

?>

<option value="">Select</option>
<?php

$select='';
$where='';
$rs='';
$select='*';
if($buyerId!=''){
$buyerId=' and buyerId="'.$buyerId.'" ';
}
$where=' 1 '.$buyerId.' order by name asc';
$rs=GetPageRecord($select,'brandMaster',$where);
while($resListing=mysqli_fetch_array($rs)){
?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id'] == $selectId) { ?>selected <?php } ?> ><?php echo strip($resListing['name']); ?></option>
<?php }

}



if($_REQUEST['action']=='changepurchase'){
$purchaseId=$_REQUEST['purchase'];

$select='';
$where='';
$rs='';
$select='*';
if($purchaseId!=''){
$purchaseId=' and parentId="'.$purchaseId.'" ';
}
$where=' 1 '.$purchaseId.'';

?>
<div style="background: #0288d1;padding:10px;">
                         <td colspan="6"><div style="text-transform:capitalize;color:white;font-size: 15px;">Summary(Totals by Styles/Colors/Size)

                         </div>
                         </td>
                     </div>

<table class="table table-bordered" width="100%">

    <thead style="background-color: #fdffe0;">
        <th>PO No</th>
        <th>Style No</th>

        <th>Color</th>
        <th>Packing Type</th>

        <th>Size</th>
      <th>Quantity</th>


    </thead>
    <?php
    $rs=GetPageRecord($select,'poSizeBreakupMaster',$where);
while($resListing=mysqli_fetch_array($rs)){
  $rsss=GetPageRecord('*','poManageMaster','1 and id="'.$resListing['parentId'].'"');
$resListingss=mysqli_fetch_array($rsss);


$rssse=GetPageRecord('*','queryMaster','1 and id="'.$resListingss['styleId'].'"');
$resListingsse=mysqli_fetch_array($rssse);



    ?>
<tr>
  <td><?php  echo $resListingss['poNumber']; ?></td>
  <td><?php  echo $resListingsse['styleRefId']; ?></td>
  <td><?php echo strip($resListing['color']); ?></td>
   <td>
       <?php if($resListing['ptype']=="1"){ ?> Pre-Pack <?php }else if ($resListing['ptype']=="2") { ?> Bulk <?php }  else {}?>
   </td>

<td><?php echo strip($resListing['size']); ?></td>
<td><?php echo strip($resListing['quantity']); ?></td>
</tr>
<?php }  ?>
</table>
<?php

}



if($_REQUEST['action']=='changeindent'){
$buyerId=$_REQUEST['buyer'];

$styleId=' and id="'.$buyerId.'" ';
$whereax=' 1 '.$styleId.'';
$rsax=GetPageRecord('*','queryMaster',$whereax);
$resListingax=mysqli_fetch_array($rsax);


if($resListingax['sampleStyle']==1){

    $select='';
$where='';
$rs='';
$select='*';
if($buyerId!=''){
$buyerId=' and styleId="'.$buyerId.'" ';
}
$where=' 1 '.$buyerId.'';
$rs=GetPageRecord($select,'buyerPurchaseOrderMaster',$where);
$resListing=mysqli_fetch_array($rs);
?>
<input style="width: 100%" class="erpint" value="<?php echo $resListing['indentNumber']; ?>" name="indentno" id="" readonly>
<?php

}else if($resListingax['sampleStyle']==2){

   $wherew=' 1 and id="'.$buyerId.'"';
$rsw=GetPageRecord('*','queryMaster',$wherew);
$resListingw=mysqli_fetch_array($rsw);

?>

<input style="width: 100%" class="erpint" value="<?php echo $resListingw['sample_indent']; ?>" name="indentno" id="" readonly>
<?php

}



?>
<?php
}
?>













<?php
if($_REQUEST['action']=='changesizeratio'){
$sizerange=$_REQUEST['sizerange'];
$selectedId=$_REQUEST['selectedid'];
?>

<option value="">Select</option>
<?php

$select='';
$where='';
$rs='';
$select='*';
if($sizerange!=''){
$sizerange='and sizeRangeId="'.$sizerange.'" ';
}
$where=' 1 '.$sizerange.' order by name asc';
$rs=GetPageRecord($select,'sizeRatioMaster',$where);
while($resListing=mysqli_fetch_array($rs)){
?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$selectedId){ ?>selected="selected"<?php } ?> ><?php echo strip($resListing['name']); ?></option>
<?php }


}

if($_REQUEST['action']=='changestyle'){

$styleid=$_REQUEST['styleId'];

$select='*';
if($styleid!=''){
$style='and id="'.$styleid.'" ';
$where='1 '.$style.'';
$rs=GetPageRecord($select,'queryMaster',$where);
$resListing=mysqli_fetch_array($rs);
?>
<div style="width: 180px;"><?php echo $resListing['subject'] ?></div>
<?php } }
?>

<!-- next -->

<?php
if($_REQUEST['action']=='changesample'){
$sample=$_REQUEST['sample'];
if($sample!=''){
$style='and id="'.$sample.'" ';
$where='1 '.$style.'';
$rs=GetPageRecord('*','queryMaster',$where);
$resListing=mysqli_fetch_array($rs);
 $res=GetPageRecord('*','sampleTypeMaster','1 and id="'.$resListing['sampleType'].'"');
$sample=mysqli_fetch_array($res);
?>
<div><?php echo $sample['name'] ?></div>
<?php
 }
}
?>

<!-- next -->

<?php
if($_REQUEST['action']=='changereq'){
$styleid=$_REQUEST['styleId'];
$sample=$_REQUEST['sample'];
?>
<option>Select</option>
<?php
$select='*';
if($styleid!=''){
$style='and parentStyleId="'.$styleid.'" ';
$where='1 '.$style.'';
$rs=GetPageRecord($select,'queryMaster',$where);
while($resListing=mysqli_fetch_array($rs)){
?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$sample){ ?> selected="selected" <?php } ?> ><?php echo strip($resListing['styleRefId']); ?>
	</option>
<?php } } }
?>

<!-- next -->

<?php
if($_REQUEST['action']=='changeriskpriority'){
$risk=$_REQUEST['risk'];
$riskId=$_REQUEST['selectId'];
?>
<option value="">Select</option>
<?php
if($risk == '2' || $risk == '3') { ?>
<option value="1" <?php if('1' == $riskId){ ?>selected="selected"<?php } ?>>Operational Risk</option>
<option value="2" <?php if('2' == $riskId){ ?>selected="selected"<?php } ?>>Timeline Risk</option>
<option value="3" <?php if('3' == $riskId){ ?>selected="selected"<?php } ?>>Big Buy</option>
<option value="4" <?php if('4' == $riskId){ ?>selected="selected"<?php } ?>>High SAM</option>
<?php } else{}
}
?>

<!-- next -->

<?php
if($_REQUEST['action']=='changeline'){

$factory=$_REQUEST['factory'];

if($factory!=''){
$main='and factoryId="'.$factory.'" ';
$where='1 '.$main.'';
$rs=GetPageRecord('*','factoryLineMaster',$where);
?>
<label>Line</label>
<input name="line" type="number" class="form-control validate" onkeyup="calculateVlaue();" id="line" value="<?php echo mysqli_num_rows($rs) ?>" readonly>
<?php } }
?>


<!-- next -->


<?php
if($_REQUEST['action']=='changecolor'){
$buyerId=$_REQUEST['buyer'];
$selectId=$_REQUEST['selectId'];


$select='';
$where='';
$rs='';
$select='*';
if($buyerId!=''){

                    $tdr=GetPageRecord('*','styleColorDetailMaster','1 and styleId="'.$buyerId.'"');
                                    $x= "0";
                                    while($temnamer=mysqli_fetch_array($tdr)){

                                    $tdra=GetPageRecord('*','colorCardMaster','1 and id="'.$temnamer['colorId'] .'"');
                                    $temnamera=mysqli_fetch_array($tdra);
                                    ?>
<div style="display: grid;grid-template-columns: 66px 18px;margin-top: 10px">
	<span style="background:<?php echo $temnamera['colorCode']; ?>;border:1px solid black;width: 50px;height: 18px;"></span>
	<i class="fa fa-plus" style="cursor:pointer;padding: 3px;font-size: 13px"></i>
</div>
<?php }

}
}
?>

<!-- next -->

<?php
if($_REQUEST['action']=='changebrandreq'){
$style=$_REQUEST['style'];

$select='';
$where='';
$rs='';
$select='*';
if($style!=''){
$styleId=' and id="'.$style.'" ';
}
$where=' 1 '.$styleId.'';
$rs=GetPageRecord($select,'queryMaster',$where);
$resListing=mysqli_fetch_array($rs);

$rs1=GetPageRecord($select,'brandMaster','1 and id="'.$resListing['brandId'].'"');
$resListing1=mysqli_fetch_array($rs1);

?>
<input style="width: 100%" class="erpint" value="<?php echo $resListing1['name']; ?>" name="brand" id="">
<?php
}
?>

<!-- next -->

<?php
if($_REQUEST['action']=='requisition'){
$issuance= $_REQUEST['issuance'];
$select='';
$where='';
$rs='';
$select='*';
if($issuance!=''){
$id=' and id="'.$issuance.'" ';

$where=' 1 '.$id.'';
$rs=GetPageRecord($select,'requisitionmaster',$where);
$operationData=mysqli_fetch_array($rs);
?>

<table class="table erptab table-hover" style="width:100%">
                     <tr>
                         <td><div style="text-transform:capitalize;"><b>Requisition&nbsp;Type</b></div></td>

                       <td><input style="width:100%;" type="text" class="erpint" name="requisitiondate" <?php if($operationData['requisitiontype'] == "1") { ?> value="Fabric" <?php }
         if($operationData['requisitiontype'] == "2") {  ?> value="Trims" <?php }
         if($operationData['requisitiontype'] == "3") { ?> value="Packaging" <?php } ?>></td>



                         </td>
                          <td style="width:26%"><div style="text-transform:capitalize;text-align:end"><b>Requisition Date</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="requisitiondate" value="<?php echo date('d-m-Y',$operationData['dateAdded']); ?>" readonly></td>
                     </tr>
                        <tr>
                         <td style="width:26%"><div style="text-transform:capitalize;"><b>Style No</b></div></td>
                         <td>
                      <?php
                    $fcref=GetPageRecord('*','queryMaster','1 and id ="'.$operationData['styleId'].'"');
                              $refData=mysqli_fetch_array($fcref);
                               ?>
                      <input style="width:100%;" type="text" class="erpint" name="styleno" value="<?php echo $refData['styleRefId'] ?>" readonly>
                  </td>
                  <td><div style="text-transform:capitalize;text-align: right;"> <b>Indent No</b> </div></td>

                         <td id="brand">
                          <input style="width:100%;" type="text" class="erpint" name="indentno" value="<?php echo $operationData['indentno'] ?>" readonly>
                         </td>

                     </tr>

                     <tr>
                         <td><div style="text-transform:capitalize;"><b>Due Date</b></div></td>
                         <td><input style="width:100%;" type="date" class="erpint" name="duedate" id="phone"  value="<?php echo $operationData['duedate']; ?>" readonly></td>
                          <td><div style="text-transform:capitalize;text-align: right;"><b>Order Qty</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="orderqty" id=""  value="<?php echo $operationData['orderqty']; ?>" readonly></td>

                     </tr>

          <tr>

              <td style="width:%"><div style="text-transform:capitalize;"><b>Brand</b></div></td>
                         <td id="brandId" >
                    <input style="width:100%;" type="text" class="erpint" name="brand" value="<?php echo $operationData['brandId'] ?>" readonly>
                        </td>
                        <td><div style="text-transform:capitalize;text-align: right;"><b>Lot</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="lot" id=""  value="<?php echo $operationData['lot']; ?>" readonly></td>

                     </tr>
                     <tr>


                         <td><div style="text-transform:capitalize;"><b>Requested By</b></div></td>
                         <td>

                      <?php

                  $fcref=GetPageRecord('*','userMaster','1 and id="'.$operationData['requested'].'"') ;
                             $refData=mysqli_fetch_array($fcref);
                              ?>
               <input style="width:100%;" type="text" class="erpint" name="Requested" id="requested"  value="<?php echo $refData['firstName']; ?>&nbsp;<?php echo $refData['lastName']; ?>" readonly>

                        </td>
                        <td><div style="text-transform:capitalize;text-align: right;"><b>Department</b></div></td>
                         <td>
                         <input style="width:100%;" type="text" class="erpint" name="department" id="" value="<?php echo $operationData['department']; ?>" readonly>
                         </td>
                     </tr>

                     </table>

  <?php } } ?>

<!-- next -->

  <?php

  if($_REQUEST['action']=='changepackinglistdesc'){

$styleid=$_REQUEST['styleId'];

$select='*';
if($styleid!=''){
$style='and id="'.$styleid.'" ';
$where='1 '.$style.'';
$rs=GetPageRecord($select,'queryMaster',$where);
$resListing=mysqli_fetch_array($rs);
?>
<input type="text" style="padding: 7px" class="form-control" readonly="readonly" value="<?php echo $resListing['subject'] ?>">
<?php } }
?>

<?php
if($_REQUEST['action']=='changepackinglistpo'){
$styleId=$_REQUEST['styleId'];
// $poId=$_REQUEST['selectId'];
?>

<option value="">Select</option>
<?php

$select='';
$where='';
$rs='';
$select='*';
if($styleId!=''){
$purchaseId='and styleId="'.$styleId.'" ';
}
$where=' 1 '.$purchaseId.'';
$rs=GetPageRecord($select,'poManageMaster',$where);
while($resListing=mysqli_fetch_array($rs)){
?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$poId){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['poNumber']); ?></option>
<?php }


}
?>

<?php

  if($_REQUEST['action']=='changesupaddress'){

$supplierId=$_REQUEST['supplier'];

$select='*';
if($supplierId!=''){
$supplier='and id="'.$supplierId.'" ';
$where='1 '.$supplier.'';
$rs=GetPageRecord($select,'suppliersMaster',$where);
$resListing=mysqli_fetch_array($rs);
?>
<input type="text" style="padding: 7px" class="form-control" readonly="readonly" value="<?php echo $resListing['address'] ?>">
<?php }
else{
  ?>
  <input type="text" style="padding: 7px" class="form-control" readonly="readonly">
  <?php
}
}
?>


<?php
if($_REQUEST['action']=='changesupplierpo'){
$supplierId=$_REQUEST['supplier'];
$poId=$_REQUEST['poId'];
?>
<option value="">Select</option>
<?php
$select='*';
if($supplierId!=''){
$purchaseId='and supplierId="'.$supplierId.'" and bomPoStatus=1 group by poNumber';
}
$where='1 '.$purchaseId.'';
$rs=GetPageRecord($select,'indentCreationMaster',$where);
while($resListing=mysqli_fetch_array($rs)){
?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$poId){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['poNumber']); ?></option>
<?php }


}
?>












<?php
if($_REQUEST['action']=='changestyleindent'){
$buyerId=$_REQUEST['styleid'];

if($_REQUEST['styleType']==1){
$select='';
$where='';
$rs='';
$select='*';
if($buyerId!=''){
$buyerId=' and styleId="'.$buyerId.'"';
}
$where=' 1 '.$buyerId.'';
$rs=GetPageRecord($select,'buyerPurchaseOrderMaster',$where);
$resListing=mysqli_fetch_array($rs);
?>
<input style="width: 100%" class="erpint" value="<?php echo $resListing['indentNumber']; ?>" name="indentnum" id="" readonly>
<?php
}elseif($_REQUEST['styleType']==2){
$rs='';
$rs=GetPageRecord('sample_indent','queryMaster','id="'.$_REQUEST['styleid'].'"');
$resListing=mysqli_fetch_array($rs);
?>
<input style="width: 100%" class="erpint" value="<?php echo $resListing['sample_indent']; ?>" name="indentnum" id="" readonly>
<?php
}elseif($_REQUEST['styleType']=='greige'){
$rs='';
$rs=GetPageRecord('indentNumber','greigeRequisition','requisitionNo="'.$_REQUEST['styleid'].'"');
$resListing=mysqli_fetch_array($rs);
?>
<input style="width: 100%" class="erpint" value="<?php echo $resListing['indentNumber']; ?>" name="indentnum" id="" readonly>
<?php
}elseif($_REQUEST['styleType']=='yarn'){
$rs='';
$rs=GetPageRecord('indentNumber','yarnRequisition','requisitionNo="'.$_REQUEST['styleid'].'"');
$resListing=mysqli_fetch_array($rs);
?>
<input style="width: 100%" class="erpint" value="<?php echo $resListing['indentNumber']; ?>" name="indentnum" id="" readonly>
<?php
}

}
?>



<?php
if($_REQUEST['action']=='changesupplier'){
$buyerId=$_REQUEST['supplierid'];

$select='';
$where='';
$rs='';
$select='*';
if($buyerId!=''){
$buyerId=' and id="'.$buyerId.'" ';
}
$where=' 1 '.$buyerId.'';
$rs=GetPageRecord($select,'suppliersMaster',$where);
$resListing=mysqli_fetch_array($rs);


$buyerIds=' and addressParent="'.$resListing['id'].'" ';
$wheres=' 1 '.$buyerIds.'';
$rsx=GetPageRecord($select,'addressMaster',$wheres);
$resListingx=mysqli_fetch_array($rsx);


?>
<input style="width: 100%" class="erpint" value="<?php echo $resListingx['address']; ?>" name="address" id="address" readonly>
<?php
}
?>

<?php
if($_REQUEST['action']=='changephone'){
$buyerId=$_REQUEST['supplierid'];

$select='';
$where='';
$rs='';
$select='*';
if($buyerId!=''){
$buyerId=' and id="'.$buyerId.'" ';
}
$where=' 1 '.$buyerId.'';
$rs=GetPageRecord($select,'suppliersMaster',$where);
$resListing=mysqli_fetch_array($rs);
?>
<input style="width: 100%" class="erpint" value="<?php echo $resListing['phone']; ?>" name="phone" id="phone" readonly>
<?php
}
?>







<?php
if($_REQUEST['action']=='changegstn'){
$buyerId=$_REQUEST['supplierid'];

$select='';
$where='';
$rs='';
$select='*';
if($buyerId!=''){
$buyerId=' and id="'.$buyerId.'" ';
}
$where=' 1 '.$buyerId.'';
$rs=GetPageRecord($select,'suppliersMaster',$where);
$resListing=mysqli_fetch_array($rs);

$buyerIds=' and addressParent="'.$resListing['id'].'" ';
$wheres=' 1 '.$buyerIds.'';
$rsx=GetPageRecord($select,'addressMaster',$wheres);
$resListingx=mysqli_fetch_array($rsx);

?>
<input style="width: 100%" class="erpint" value="<?php echo $resListingx['gstn']; ?>" name="gstn" id="gstn" readonly>
<?php
}
?>



<?php
if($_REQUEST['action']=='changestate'){
$buyerId=$_REQUEST['supplierid'];

$select='';
$where='';
$rs='';
$select='*';
if($buyerId!=''){
$buyerId=' and id="'.$buyerId.'" ';
}
$where=' 1 '.$buyerId.'';
$rs=GetPageRecord($select,'suppliersMaster',$where);
$resListing=mysqli_fetch_array($rs);

$buyerIds=' and addressParent="'.$resListing['id'].'" ';
$wheres=' 1 '.$buyerIds.'';
$rsx=GetPageRecord($select,'addressMaster',$wheres);
$resListingx=mysqli_fetch_array($rsx);



$buyerIdsx=' and id="'.$resListingx['stateId'].'" ';
$wheresx=' 1 '.$buyerIdsx.'';
$rsxx=GetPageRecord($select,'stateMaster',$wheresx);
$resListingxx=mysqli_fetch_array($rsxx);

?>
<input style="width: 100%" class="erpint" value="<?php echo $resListingxx['name']; ?>" name="state" id="state" readonly>
<?php
}
?>


<?php
if($_REQUEST['action']=='orignalexfactory'){
$orignalexfactory=$_REQUEST['purchaseex'];

$select='*';
$where='';
$rs='';


$buyerIdsxd=' and id="'.$orignalexfactory.'" ';
$wheresxd=' 1 '.$buyerIdsxd.'';
$rsxxd=GetPageRecord($select,'poManageMaster',$wheresxd);
$resListingxxd=mysqli_fetch_array($rsxxd);

?>
<input style="width: 100%" class="erpint" value="<?php echo $resListingxxd['factStart']; ?>" name="orgexfactory" id="orgexfactory" readonly>
<?php
}
?>




<?php
if($_REQUEST['action']=='poqtys'){
$poqty=$_REQUEST['poqty'];

$select='*';
$where='';
$rs='';


$buyerIdsxds=' and id="'.$poqty.'" ';
$wheresxds=' 1 '.$buyerIdsxds.'';
$rsxxds=GetPageRecord($select,'poManageMaster',$wheresxds);
$resListingxxds=mysqli_fetch_array($rsxxds);

?>
<input style="width: 100%" class="erpint" value="<?php echo $resListingxxds['poQty']; ?>" name="poqty" id="poqty" readonly>
<?php
}
?>





<?php
if($_REQUEST['action']=='shipmodes'){
$shipmode=$_REQUEST['shipmode'];

$select='*';
$where='';
$rs='';


$buyerIdsxdsz=' and id="'.$shipmode.'" ';
$wheresxdsz=' 1 '.$buyerIdsxdsz.'';
$rsxxdsz=GetPageRecord($select,'poManageMaster',$wheresxdsz);
$resListingxxdsz=mysqli_fetch_array($rsxxdsz);

?>
<input style="width: 100%" class="erpint" value="<?php echo $resListingxxdsz['shipMode']; ?>" name="orgshipmode" id="orgshipmode" readonly>
<?php
}
?>





<?php
if($_REQUEST['action']=='changestylepoumber_data'){
$styleid=$_REQUEST['styleid'];

// if($data_id!=''){

    $data_id=$_REQUEST['data_id'];
	$rrrl=GetPageRecord('*','externalChallan','1 and id="'.$data_id.'"');
    $operationData=mysqli_fetch_array($rrrl);
// }

if($_REQUEST['styleType']=='1' || $_REQUEST['styleType']=='2'){
	$whereCondition = ' and styleId="'.$styleid.'" ';
}
if($_REQUEST['styleType']=='yarn' || $_REQUEST['styleType']=='greige'){
	$whereCondition = ' and requisitionNo="'.$styleid.'" ';
}

?>
		<option value="">Select</option>
		<?php
		$select='*';
		$fcrefaw=GetPageRecord('*','indentCreationMaster','1 '.$whereCondition.' and bomPoStatus=1 group By poNumber order by id desc');
        while($refDataaw=mysqli_fetch_array($fcrefaw)){ ?>
        <option value="<?php echo $refDataaw['poNumber']; ?>" <?php if($refDataaw['poNumber']==$operationData['pono']){ ?> selected <?php } ?>><?php echo $refDataaw['poNumber']; ?></option>
        <?php }

}
?>

<?php
if($_REQUEST['action']=='geteditdetail'){

$where1='id='.$_REQUEST['editid'].'';
$rs1=GetPageRecord('*','indentCreationMaster',$where1);
$editresult=mysqli_fetch_array($rs1);

?>
<script>
parent.$('#poTypeId').val('<?php echo $editresult['poTypeId']; ?>').change();
parent.$('#supplierId').val('<?php echo $editresult['supplierId']; ?>').change();
parent.$('#materialId').val('<?php echo $editresult['materialId']; ?>').change();
parent.$('#sellingRate').val('<?php echo $editresult['sellingRate']; ?>');
parent.$('#color').val('<?php echo $editresult['color']; ?>').change();
parent.$('#sellingValue').val('<?php echo $editresult['sellingValue']; ?>');
parent.$('#pendingQty').val('<?php echo $editresult['pendingQty']; ?>');
parent.$('#materialQty').val('<?php echo $editresult['materialQty']; ?>');
parent.$('#orderQty').val('<?php echo $editresult['orderQty']; ?>');
parent.$('#editId').val('<?php echo $editresult['id']; ?>');
parent.qtyCount();

</script>
<?php
}
?>












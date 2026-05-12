<?php
//$updatepage='1';

if($_GET['styleid']!='' && $_GET['editid']!=''){

$select='*';
$where='id="'.decode($_GET['styleid']).'"';
$rs=GetPageRecord($select,'queryMaster',$where);
$editresultstyle=mysqli_fetch_array($rs);
$buyerId = $editresultstyle['buyerId'];
$buyerStyleRefNo = $editresultstyle['buyerStyleRefNo'];
$subject = $editresultstyle['subject'];
$displayId = $editresultstyle['displayId'];
$seasonId = $editresultstyle['seasonId'];
$categoryId = $editresultstyle['categoryId'];
$subCategoryId = $editresultstyle['subCategoryId'];
$departmentId = $editresultstyle['departmentId'];
$receivedDate = $editresultstyle['receivedDate'];
$patternDescription = $editresultstyle['patternDescription'];
$patternAttachment = $editresultstyle['patternAttachment'];

$lastId=$editresultstyle['id'];

$chaalanLastId = decode($_GET['editid']);

}else{

$select='*';
$where='id="'.decode($_GET['styleid']).'"';
$rs=GetPageRecord($select,'queryMaster',$where);
$editresultstyle=mysqli_fetch_array($rs);
$buyerId = $editresultstyle['buyerId'];
$buyerStyleRefNo = $editresultstyle['buyerStyleRefNo'];
$subject = $editresultstyle['subject'];
$displayId = $editresultstyle['displayId'];
$seasonId = $editresultstyle['seasonId'];
$categoryId = $editresultstyle['categoryId'];
$subCategoryId = $editresultstyle['subCategoryId'];
$departmentId = $editresultstyle['departmentId'];
$receivedDate = $editresultstyle['receivedDate'];
$patternDescription = $editresultstyle['patternDescription'];
$patternAttachment = $editresultstyle['patternAttachment'];

$lastId=$editresultstyle['id'];

$wheredelete='addedBy="'.$_SESSION['userid'].'" and status=0';
deleteRecord('chaalanMaster',$wheredelete);

$rs1=GetPageRecord('id','chaalanMaster','1 order by id desc');
$lastchaalanid=mysqli_fetch_array($rs1);
$ch=$lastchaalanid['id'];

if($ch==''){
$ch=1;
} else {
$ch=$ch+1;
}




$chaalanno=date('Y-d').'/'.makeQueryId(decode($_GET['styleid'])).'/'.makeQueryId($ch);

$namevalue ='addedBy="'.$_SESSION['userid'].'",chaalanNo="'.$chaalanno.'",dateAdded="'.time().'"';
$chaalanLastId = addlistinggetlastid('chaalanMaster',$namevalue);

}

?>

<?php



if($_GET['id']!=''){

$rs=GetPageRecord('*','gateentrymaster','id="'.decode($_GET['id']).'"');
$editresult=mysqli_fetch_array($rs);
$gateLastId = $editresult['id'];

}

?>

<style>
.erptab tr td{
border-top:0px solid #ccc!important;
padding:0.55rem!important;
}
.erptab2 tr td{
border-top:0px solid #ccc!important;
padding:0.75rem!important;
}
.erptab1 tr td{
border-top:0px solid #ccc!important;
padding:0.40rem!important;
}
.erptab{
border:1px solid #ccc!important;
}
.content-wrapper td{

 padding-right: 6px;

}
.erpint{
    border: 1px solid #b3acac;
    padding: 3px;
    margin-bottom: 15px;
}
</style>

         <div class="page-content">
         <div class="content-wrapper">

         <?php include "savealert.php"; ?>

         <div class="content pt-0" style="margin-top:20px;">
 	     <table class="table erptab" style="width:100%">
         <tr style="background: #0288d1;">
         <td colspan="6"><div style="text-transform:capitalize;color:white;font-size: 15px;">

        <?php echo $pageName; ?>

                         </div>

                         </td>
           </tr>

      </table>

 				<div class="row">

				<div class="col-xl-12">
				<div class="card">
				    <div style="padding: 25px;">
				<?php

				if($_GET['id']!=""){
				 $rrrr=GetPageRecord('*','gateentrymaster','1 and id="'.decode($_GET['id']).'"');
				$operationData=mysqli_fetch_array($rrrr);
				}
				?>
				<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">

					<input name="editId" type="hidden" id="editId" value="<?php echo encode($gateLastId); ?>">


               <br>

               <table class="table erptab table-hover" style="width:100%; margin-top: 15px;">
                     <tr>
                         	<div class="col-xl-3">
								<div class="panel panel-flat">
							       <select id="styleId" name="styleId" class="form-control" onChange="selectStyle();">
										<option value="">Select Style</option>
										<?php
										$styleId = decode($_GET['styleid']);
										$rs=GetPageRecord($select,'queryMaster','1 and deletestatus=0 and subject!="" order by id asc');
										while($resultStyle=mysqli_fetch_array($rs)){
										?>
										<option value="<?php echo encode($resultStyle['id']); ?>" <?php if($styleId==$resultStyle['id']){ echo 'selected'; } ?>><?php echo '#'.$resultStyle['styleRefId']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
								<script>
								function selectStyle(){
				var styleId = $('#styleId').val()
					if(styleId!=''){
						 window.location.href = '<?php echo $fullurl; ?>showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes&styleid='+styleId;
					}
				}
				</script>

				<?php
				if($_GET['styleid']!=''){
					include "top-style.php";
				}
				?>


<!--				<div class="row">-->
<!--				<div class="col-xl-12">-->
<!--				<div class="card">-->
<!--							<div class="card-header bg-white">-->
<!--								<h6 class="card-title">Challan Information</h6>-->
<!--							</div>-->
<!--							<div id="loadchaalan"></div>-->
<!--					<script>-->
<!--					function loadchaalan(){-->
<!--						$('#loadchaalan').load('loadchaalan.php?styleId=<?php echo $_GET['styleid']; ?>&id=<?php echo encode($chaalanLastId); ?>');-->
<!--					}-->
<!--					loadchaalan();-->
<!--					</script>-->


<!--					<script>-->
<!--						function addnewline(lastid){-->
<!--							$('#loadchaalan').load('loadchaalan.php?action=addnewrow&styleId=<?php echo $_GET['styleid']; ?>&addsize=1&id='+lastid);-->
<!--						}-->
<!--					</script>-->

<!--					<script>-->
<!--					function deleterow(deleteid){-->
<!--						$('#loadchaalan').load('loadchaalan.php?deletestatus=yes&id=<?php echo encode($chaalanLastId); ?>&styleId=<?php echo $_GET['styleid']; ?>&&rowid='+deleteid);-->
<!--					}-->
<!--					</script>-->
<!--						</div> -->

<!--</div>-->


<!--					</div>	-->


					 <td><div style="text-transform:capitalize;"><b>Inspection No.</b></div></td>
                         <td><input style="width:200px; height:40px;" type="text" class="erpint" name="registerno" id="ewbn" placeholder="SSI-ddmmyy-0000" value="<?php echo $operationData['registerno'] ?>"></td>

                        <td><div style="text-transform:capitalize"><b>Color</b></div></td>

                          <td><select id="colorId1" name="colorId1" class="form-control" style="width:200px; height:40px;">
						  <option value="">Select</option>
						   						  <option value="5" >Beige</option>
						  						  <option value="10" >Black</option>
						  						  <option value="1" >Blue</option>
						  						  <option value="11" selected="selected">Cream</option>
						  						  <option value="12" >Dusty Blue</option>
						  						  <option value="3" >Green</option>
						  						  <option value="6" >Magenta</option>
						  						  <option value="8" >Purple Hue</option>
						  						  <option value="2" >Red</option>
						  						  <option value="7" >Rust Red</option>
						  						  <option value="4" >White</option>
						  						  <option value="9" >White</option>
						  						</select></td>




                       </tr>

                        <tr>
                           <td><div style="text-transform:capitalize"><b>Size Range</b></div></td>
                         <td><select id="sizerange" name="sizerange" class="form-control " displayname="" style="width:200px; height:40px;">
                          <option  value="0">Select</option>
                                                    <option value="17" >5 : 6 : 7 : 8 : 9 : 10 : 11</option>
                                                    <option value="15" >M</option>
                                                    <option value="11" >S : M : L : XL</option>
                                                    <option value="10" >XS : S : M : L : XL</option>
                                                    <option value="16" selected="selected">XXS:XS:S:M:L:XL:XXL</option>
                                                  </select></td>

                        <td><div style="text-transform:capitalize;"><b>Date</b></div></td>
                         <td><input style="width:200px; height:40px;" type="date" class="erpint" name="billdate" id="gate" value="<?php echo $operationData['billdate'] ?>"></td>




                     </tr>
                     <tr>



                        <td><div style="text-transform:capitalize"><b>Done By</b></div></td>
                        <td><input style="width:200px; height:40px;" type="text" class="erpint" name="gateno" id="lrd" value="<?php echo $operationData['gateno'] ?>"></td>


                        <td><div style="text-transform:capitalize"><b>Measurement Attach</b></div></td>
                         <td><input style="width:200px; height:40px;" type="file" class="erpint" name="challanno" id="gate" value="<?php echo $operationData['challanno'] ?>"></td>
                         <!-- <td><div style="text-transform:capitalize"><b>SSI - ddmmyy - 0000</b></div></td>-->

                     </tr>

       <!--                   <td style="width:18%;"><div style="text-transform:capitalize;"><b>PO Number</b></div></td> -->
       <!--                  <td>-->
						 <!--<select name="ponumber" id="ponumber" class="erpint" style="border: 1px solid;width:100%;" onchange="addnewline(1);showsupplierdetail(this.value);" >-->

       <!--
							<!--if($_GET['id']!=""){-->
							<!--$wheres = 'poNumber="'.$operationData['ponumber'].'" group by poNumber desc';-->
							<!--}else{-->
							<!--?>-->
							<!-- <option value="">Select</option>-->
							<!--
							<!--$wheres = '1 and bomPoStatus=1 group by poNumber desc';-->
							<!--}-->
							<!--$rs=GetPageRecord('*','indentCreationMaster',$wheres); -->
							<!--while($resListing=mysqli_fetch_array($rs)){  -->
							<!--?>-->
       <!--                       <option value="<?php echo strip($resListing['poNumber']); ?>" <?php if($operationData['ponumber']==$resListing['poNumber']){ ?> selected	<?php }?> ><?php echo strip($resListing['poNumber']); ?></option>-->
       <!--

       <!--                    </select>-->
       <!--                     </td>-->

       <!--                  <td><div style="text-transform:capitalize"><b>Supplier</b></div></td>-->
       <!--                  <td>-->
						 <!--<input style="width:100%;" type="text" class="erpint readonly" name="supplierName" id="supplierName" value="">-->
						 <!--<input type="hidden" name="supplier" id="supplierId" value="" >-->
                             <!--<select id="supplierId" name="supplier" class="erpint readonly" style="width:100%;"  >
       <!--                           <option value="">Select</option>-->
       <!--
							<!--		$select=''; -->
							<!--		$where=''; -->
							<!--		$rs='';  -->
							<!--		$select='*';    -->
							<!--		$where='1 and deletestatus=0 order by name asc';  -->
							<!--		$rs=GetPageRecord($select,'suppliersMaster',$where); -->
							<!--		while($resListing=mysqli_fetch_array($rs)){  -->
							<!--		?>-->
       <!--                           <option value="<?php echo strip($resListing['id']); ?>" <?php if($operationData['supplier']==$resListing['id']){ ?> selected <?php }?>><?php echo strip($resListing['name']); ?></option>-->
       <!--                           -->
       <!--                         </select>-->
<script>
function showsupplierdetail(id){
	$('#supplierId').load('loadotherdetails.php?action=supplierdetail&id='+id);
}
showsupplierdetail('<?php echo $operationData['ponumber']; ?>');
</script>
                     </tr>
                     <!-- <tr>-->

                     <!--    <td><div style="text-transform:capitalize"><b>Bill Date</b></div></td>-->
                     <!--    <td><input style="width:100%;" type="date" class="erpint" name="billdate" id="gate" value="<?php echo $operationData['billdate'] ?>"></td>-->
                     <!--    <td style="width:26%"><div style="text-transform:capitalize"><b>Bill No.</b></div></td>-->
                     <!--    <td><input style="width:100%;" type="text" class="erpint" name="billno" id="clearing" value="<?php echo $operationData['billno'] ?>" > </td>-->
                     <!--</tr>-->
                     <!-- <tr>-->

                     <!--    <td><div style="text-transform:capitalize"><b>Vehicle In Time</b></div></td>-->
                     <!--    <td><input style="width:100%;" type="time" class="erpint" name="vehiclein" id="gate" value="<?php echo $operationData['vehiclein'] ?>"></td>-->
                     <!--    <td style="width:26%"><div style="text-transform:capitalize"><b>Vehicle Out Time</b></div></td>-->
                     <!--    <td><input style="width:100%;" type="time" class="erpint" name="vehicleout" id="clearing" value="<?php echo $operationData['vehicleout'] ?>" > </td>-->
                     <!--</tr>-->

                         <!--<tr>-->

                         <!--<td><div style="text-transform:capitalize"><b>Size Range</b></div></td>-->
                         <!--<td><input style="width:100%;" type="text" class="erpint" name="drivername" id="gate" value="<?php echo $operationData['drivername'] ?>"></td>-->
                         <!--<td style="width:26%"><div style="text-transform:capitalize"><b>From Style Screen </b></div></td>-->
                         <!--<td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" > </td>-->
                         <!--</tr>-->
                         <!--<tr>-->


                         <!--<td><input style="width:100%;" type="text" class="erpint" name="challanno" id="gate" value="<?php echo $operationData['challanno'] ?>"></td>-->


                         </tr>





					 <!--<tr>-->

      <!--                   <td><div style="text-transform:capitalize"><b>Factory</b></div></td>-->
      <!--                   <td>-->
						<!--  <select name="factoryId" style="width: 100%" class="erpint">-->
      <!--                      <option value="">Select</option>-->

						<!--	$select=''; -->
						<!--	$where=''; -->
						<!--	$rs='';  -->
						<!--	$select='*';    -->
						<!--	$where='1 and deletestatus=0 order by name asc';  -->
						<!--	$rs=GetPageRecord($select,'factoryMaster',$where); -->
						<!--	while($resListing=mysqli_fetch_array($rs)){  -->
						<!--
						<!--	<option value="<?php echo strip($resListing['id']); ?>"<?php if($operationData['factoryId']==$resListing['id']){ ?> selected <?php }?>><?php echo strip($resListing['name']); ?></option>-->

      <!--                    </select>-->
						<!-- </td>-->
      <!--                   <td style="width:26%"><div style="text-transform:capitalize"><b>Vehicle No.</b></div></td>-->
      <!--                   <td><input style="width:100%;" type="text" class="erpint" name="vehicleNo" id="vehicleNo" value="<?php echo $operationData['vehicleNo'] ?>"></td>-->
      <!--               </tr>-->

      </table>

      <div class="col-md-12">

	  <table cellspacing="0" cellpadding="0">
      <col width="198" />
      <col width="152" />
      <col width="64" span="3" />
      <col width="141" />
      <col width="71" />
      <col width="67" />
      <col width="64" span="2" />
      <tr height="21">
        <td colspan="10" height="21" width="949"><center style="font-size:17px; background-color:#0288d1; height:50px; padding:14px;
        color:white; text-transform: capitalize; padding-right: 775px;">Accessories Checklist</center></td>
      </tr>
        <tr height="20">
        <td height="20">&nbsp;</td>
        <td>Mis.</td>
        <td>Alt.</td>
        <td>Act.</td>
        <td>Plac</td>
        <td></td>
        <td>Mis.</td>
        <td>Alt.</td>
        <td>Act.</td>
        <td>Plac</td>
      </tr>
      <div class="col-sm-6">
      <tr height="20">
        <td height="20">Main Label</td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td style="padding-left:20px;">Polybag</td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
      </tr>
      </div>
      <div class="col-sm-6">
      <tr height="20">
        <td height="20">Book Fold</td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td style="padding-left:20px;">Poly Bag Sticker</td>
       <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
      </tr>
      </div>
      <tr height="20">
        <td height="20">Factory Code</td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td style="padding-left:20px;">Lot Sticker</td>
       <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo  $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
      </tr>
      <tr height="20">
        <td height="20">Hang Tag</td>
       <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo  $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td style="padding-left:20px;">Pre Pack Sticker</td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
      </tr>
      <tr height="20">
        <td height="20">Hanger</td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td style="padding-left:20px;">Carton Markings</td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
      </tr>
      <tr height="20">
        <td height="20">Washcare</td>
       <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td style="padding-left:20px;">Placement<br />
          Upc/P.Pack</td>
       <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
      </tr>
      <tr height="20">
        <td height="20">Interlining</td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td style="padding-left:20px;">Folding</td>
       <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
      </tr>
      <tr height="20">
        <td height="20">Snap</td>
       <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td style="padding-left:20px;">Spare Button Position</td>
       <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
      </tr>
      <tr height="20">
        <td height="20">Elastic</td>
       <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td width="141" style="padding-left:20px;">Print</td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
      </tr>
      <tr height="20">
        <td height="20">Button</td>
       <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td width="141" style="padding-left:20px;">Layout</td>
       <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
      </tr>
      <tr height="20">
        <td height="20" width="198">Hook Eye/Bar</td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td width="141" style="padding-left:20px;">Emb. Thread    Color</td>
       <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
      </tr>
      <tr height="20">
        <td height="20">Lace</td>
       <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td width="141" style="padding-left:20px;">Placement</td>
      <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
      </tr>
      <tr height="20">
        <td height="20">Buckle</td>
       <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td width="141" style="padding-left:20px;">Beads/Sequins</td>
       <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
      </tr>
      <tr height="40">
        <td height="40">Snap</td>
       <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td width="141" style="padding-left:20px;">Beads/Sequins Layout</td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
      </tr>
      <tr height="20">
        <td height="20">Thread</td>
       <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td width="141" style="padding-left:20px;">After Treatment</td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
      </tr>
      <tr height="20">
        <td height="20">Lining</td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td width="141" style="padding-left:20px;">PH</td>
       <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
      </tr>
      <tr height="20">
        <td height="20">Zipper</td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
      </tr>
      <tr height="21">
        <td height="21">&nbsp;</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>&nbsp;</td>
      </tr>
      </div>
      <tr height="21">
      <td colspan="10" height="21"><center style="font-size:17px; background-color:#0288d1; height:50px; padding:14px; color:white; text-transform: capitalize; padding-right: 775px;">Pattern Checklist</center></td>
      </tr>
      <tr height="20">
        <td height="20">Grain Line</td>
        <td>
<select name="cars" class="form-control" style="margin-bottom: 15px; margin-top:20px;">
    <option value="">Select</option>
  <option value="">Ok</option>
  <option value="">Not Ok</option>

</select></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Seam Allowance</td>
        <td>
    <select name="cars" class="form-control" style="margin-bottom: 15px; margin-top:20px;" >
    <option value="">Select</option>
    <option value="">Ok</option>
    <option value="">Not Ok</option>

    </select></td>
        <td></td>
        <td></td>
        <td>&nbsp;</td>
      </tr>
      <tr height="20">
        <td height="20">Notches</td>
        <td>
<select name="cars" class="form-control" style="margin-bottom: 15px;">
    <option value="">Select</option>
  <option value="">Ok</option>
  <option value="">Not Ok</option>

</select></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Cutting Check</td>
         <td>
<select name="cars" class="form-control" style="margin-bottom: 15px;">
    <option value="">Select</option>
  <option value="">Ok</option>
  <option value="">Not Ok</option>

</select></td>
        <td></td>
        <td></td>
        <td>&nbsp;</td>
      </tr>
      <tr height="20">
        <td height="20">&nbsp;Grade Nest</td>
         <td>
    <select name="cars" class="form-control" style="margin-bottom: 15px;">
    <option value="">Select</option>
    <option value="">Ok</option>
    <option value="">Not Ok</option>

</select>
<td></td>
</td>
        <td></td>
        <td></td>
        <td>YY/Mini Marker</td>
       <td>
    <select name="cars" class="form-control" style="margin-bottom: 15px;">
    <option value="">Select</option>
    <option value="">Ok</option>
    <option value="">Not Ok</option>

    </select></td>
        <td></td>
        <td></td>
        <td>&nbsp;</td>
      </tr>
      <tr height="20">
        <td height="20">Corrections Implemented</td>
         <td>
    <select name="cars" class="form-control" style="margin-bottom: 15px;">
    <option value="">Select</option>
    <option value="">Yes</option>
    <option value="">No</option>

</select></td>
        <!--<td>Yes/No</td>-->
        <td></td>
        <td></td>
        <td></td>
        <td>Measurement Spec Sheet</td>
          <td>
    <select name="cars" class="form-control" style="margin-bottom: 15px;">
    <option value="">Select</option>
    <option value="">Pass</option>
    <option value="">Fail</option>

</select></td>
        <!--<td>Pass/Fail</td>-->
        <td></td>
        <td></td>
        <td>&nbsp;</td>
      </tr>
      <tr height="21">
        <td height="21">&nbsp;</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>&nbsp;</td>
      </tr>
      <tr height="21">
        <td colspan="10" height="21">&nbsp;</td>
      </tr>
      <tr height="20">
        <td height="20">FDS Cut width</td>
        <td>From FDS</td>
        <td></td>
        <td></td>
        <td></td>
        <td>Bulk Cut width</td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td></td>
        <td></td>
        <td>&nbsp;</td>
      </tr>
      <tr height="20">
        <td height="20">FDS Full Width</td>
        <td>From FDS</td>
        <td></td>
        <td></td>
        <td></td>
        <td>Bulk Full Width</td>
        <td style="margin-top:15px;"><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td></td>
        <td></td>
        <td>&nbsp;</td>
      </tr>
      <tr height="20">
        <td height="20">&nbsp;</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>&nbsp;</td>
      </tr>
      <tr height="20">
        <td height="20">Planned Size</br> Set Submission Date</td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="font-size:17px;">Shrinkage</td>
         <!--<td><input style="width:150px;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" placeholder="Lengthwise"></td>-->
         <!-- <td><input style="width:150px;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" placeholder="Widthwise"></td>-->
        <!--<td>Lengthwise</td>-->
        <!--<td>Widthwise</td>-->
        <td></td>
        <td>&nbsp;</td>
      </tr>
      <tr height="20">
        <td height="20">Actual </br>Submission Date</td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Shell Shrinkage</td>
      <td><input style="width:150px;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" placeholder="Lengthwise"></td>
          <td><input style="width:150px;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" placeholder="Widthwise"></td>
        <td></td>
        <td></td>
        <td></td>
        <td>&nbsp;</td>
      </tr>
      <tr height="20">
        <td height="20">Cut Quantity</td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" style="margin-top:15px;"></td>

        <td></td>
        <td></td>
        <td></td>
        <td>Shell Pattern Shrinkage</td>
       <td><input style="width:150px;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" placeholder="Lengthwise"></td>
          <td><input style="width:150px;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" placeholder="Widthwise"></td>
        <td></td>
        <td></td>
        <td></td>
        <td>&nbsp;</td>
       </tr>
      <tr height="20">
        <td height="20">Corrections to be done:</td>
        </br>
        <td colspan=""><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
      </tr>
      <tr height="20">
        <td height="20">&nbsp;</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>&nbsp;</td>
      </tr>
      <tr height="20">
        <td height="20">Size Set Implementation Result</td>
        <td> <select name="cars" class="form-control" style="margin-bottom: 15px;">
    <option value="">Select</option>
    <option value="">Pass</option>
    <option value="">Fail</option>

</select></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>&nbsp;</td>
      </tr>
      <tr height="21">
        <td height="21">Cutting Go Ahead</td>
        <td> <select name="cars" class="form-control" style="margin-bottom: 15px;">
    <option value="volvo">Select</option>
    <option value="volvo">Yes</option>
    <option value="saab">No</option>

</select></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
					<input name="action" type="hidden" id="action" value="gateentrymaster" />


    				              <button name="Submit1" type="submit" class="btn btn-primary" style="float:right">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;"></i></button>




				</div>




 	</div>





</div>
			</form>
			</div>

		</div>

	</div>

</div>

    <p>
      <style>
    .datatable-scroll
    {
        overflow:auto!important;
    }
    </style>
    </p>
    <p>&nbsp;</p>

    <p>&nbsp; </p>

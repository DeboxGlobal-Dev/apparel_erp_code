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
b.text {
    float: revert;
    /* float: right; */
    /* padding-left: 49px; */
    /* text-align: center; */
    display: flex;
    justify-content: center;
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
                         <div class="card mb-0 rounded-bottom-0" style="padding:15px;">
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


					 <td><div style="text-transform:capitalize; padding-left:95px;"><b>Inspection No.</b></div></td>
                     <td><input style="width:200px; height:40px; margin-top:15px;" type="text" class="erpint" name="inspection_no" id="inspection_no" placeholder="SSI-ddmmyy-0000" value="<?php echo $operationData['inspection_no'] ?>"></td>

                    <td><div style="text-transform:capitalize"><b class="text">Color</b></div></td>

                    <td><select id="colorId1" name="color" class="form-control" style="width:200px; height:40px;">
				   <option value="" style="height:40px;">Select</option>
						  <option value="5" >Beige</option>
						  <option value="11" selected="selected">Cream</option>
						  <option value="12" >Dusty Blue</option>
						  </select>
						  </td>

                          </tr>

                        <tr>
                           <td><div style="text-transform:capitalize; padding-left:95px;"><b>Size Range</b></div></td>
                         <td><select id="size_range" name="size_range" class="form-control " displayname="" style="width:200px; height:40px;">
                          <option  value="0">Select</option>
                                                    <option value="17" >5 : 6 : 7 : 8 : 9 : 10 : 11</option>
                                                    <option value="15" >M</option>
                                                    <option value="11" >S : M : L : XL</option>
                                                    <option value="10" >XS : S : M : L : XL</option>
                                                    <option value="16" selected="selected">XXS:XS:S:M:L:XL:XXL</option>
                                                   </select></td>

                        <td><div style="text-transform:capitalize;"><b class="text">Date</b></div></td>
                         <td><input style="width:200px; height:40px;" type="text" class="erpint" name="dat" id="datepicker1" value="<?php echo $operationData['dat'] ?>"></td>

                          </tr>
                     <tr>



                        <td><div style="text-transform:capitalize; padding-left:95px;"><b>Done By</b></div></td>
                        <td><input style="width:200px; height:40px;" type="text" class="erpint" name="done_by" id="lrd" value="<?php echo $operationData['done_by'] ?>"></td>


                        <td><div style="text-transform:capitalize"><b class="text">Measurement Attach</b></div></td>
                         <td><input style="width:200px; height:100%" type="file" class="erpint" name="measurement_attach" id="measurement_attach" value="<?php echo $operationData['measurement_attach'] ?>"></td>
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

	  <table cellspacing="0" cellpadding="0" style="width:100%">
      <col width="198" />
      <col width="152" />
      <col width="64" span="3" />
      <col width="141" />
      <col width="71" />
      <col width="67" />
      <col width="64" span="2" />
      <tr height="21">
           <td colspan="12" height="21"><center style="font-size:17px; background-color:#0288d1; height:50px; padding:14px; color:white; text-transform: capitalize; padding-right: 775px;     text-align: left;">Accessories Checklist</center></td>
        <!--<td colspan="12" height="21" width="949"><center style="font-size:17px; background-color:#0288d1; height:50px; padding:5px;-->
        <!--color:white; text-transform: capitalize; padding-right: 1045px; text-align: left;    line-height: 20px;">Accessories Checklist</center></td>-->
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

         <tr height="20">
         <td height="20" style="padding-left: 60px;">Main Label</td>
         <td><input style="" type="text" class="erpint" name="main_label1" id="main_label1" value="<?php echo $operationData['main_label1'] ?>" ></td>
         <td><input style="" type="text" class="erpint" name="main_label2" id="main_label2" value="<?php echo $operationData['main_label2'] ?>" ></td>
         <td><input style="width:100%;" type="text" class="erpint" name="main_label3" id="main_label3" value="<?php echo $operationData['main_label3'] ?>" ></td>
         <td><input style="width:100%;" type="text" class="erpint" name="main_label4" id="main_label4" value="<?php echo $operationData['main_label4'] ?>" ></td>

        <td style="padding-left:20px;">Polybag</td>
        <td><input style="width:100%;" type="text" class="erpint" name="polybag1" id="polybag1" value="<?php echo $operationData['polybag1'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="polybag2" id="polybag2" value="<?php echo $operationData['polybag2'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="polybag3" id="polybag3" value="<?php echo $operationData['polybag3'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="polybag4" id="polybag4" value="<?php echo $operationData['polybag4'] ?>" ></td>

       </tr>


      <tr height="20">
        <td height="20" style="padding-left: 60px;">Book Fold</td>
        <td><input style="width:100%;" type="text" class="erpint" name="book_fold1" id="clearing" value="<?php echo $operationData['book_fold1'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="book_fold2" id="clearing" value="<?php echo $operationData['book_fold2'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="book_fold3" id="clearing" value="<?php echo $operationData['book_fold3'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="book_fold4" id="clearing" value="<?php echo $operationData['book_fold4'] ?>" ></td>
        <td style="padding-left:20px;">Poly Bag Sticker</td>
       <td><input style="width:100%;" type="text" class="erpint" name="drivernumber1" id="drivernumber1" value="<?php echo $operationData['drivernumber1'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber2" id="drivernumber2" value="<?php echo $operationData['drivernumber2'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber3" id="drivernumber3" value="<?php echo $operationData['drivernumber3'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber4" id="drivernumber4" value="<?php echo $operationData['drivernumber4'] ?>" ></td>
      </tr>

      <tr height="20">
        <td height="20" style="padding-left: 60px;">Factory Code</td>
        <td><input style="width:100%;" type="text" class="erpint" name="fac_code1" id="fac_code1" value="<?php echo $operationData['fac_code1'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="fac_code2" id="fac_code2" value="<?php echo $operationData['fac_code2'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="fac_code3" id="fac_code3" value="<?php echo $operationData['fac_code3'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="fac_code4" id="fac_code4" value="<?php echo $operationData['fac_code4'] ?>" ></td>
        <td style="padding-left:20px;">Lot Sticker</td>
       <td><input style="width:100%;" type="text" class="erpint" name="lot_sticker1" id="lot_sticker1" value="<?php echo  $operationData['lot_sticker1'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="lot_sticker2" id="lot_sticker2" value="<?php echo $operationData['lot_sticker2'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="lot_sticker3" id="lot_sticker3" value="<?php echo $operationData['lot_sticker3'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="lot_sticker4" id="lot_sticker4" value="<?php echo $operationData['lot_sticker4'] ?>" ></td>
      </tr>
      <tr height="20">
        <td height="20" style="padding-left: 60px;">Hang Tag</td>
       <td><input style="width:100%;" type="text" class="erpint" name="hang_tag1" id="hang_tag1" value="<?php echo  $operationData['hang_tag1'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="hang_tag2" id="hang_tag2" value="<?php echo $operationData['hang_tag2'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="hang_tag3" id="hang_tag3" value="<?php echo $operationData['hang_tag3'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="hang_tag4" id="hang_tag4" value="<?php echo $operationData['hang_tag4'] ?>" ></td>
        <td style="padding-left:20px;">Pre Pack Sticker</td>
        <td><input style="width:100%;" type="text" class="erpint" name="pre_pack_sticker1" id="pre_pack_sticker1" value="<?php echo $operationData['pre_pack_sticker1'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="pre_pack_sticker2" id="pre_pack_sticker2" value="<?php echo $operationData['pre_pack_sticker2'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="pre_pack_sticker3" id="pre_pack_sticker3" value="<?php echo $operationData['pre_pack_sticker3'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="pre_pack_sticker4" id="pre_pack_sticker4" value="<?php echo $operationData['pre_pack_sticker4'] ?>" ></td>
      </tr>
      <tr height="20">
        <td height="20" style="padding-left: 60px;">Hanger</td>
        <td><input style="width:100%;" type="text" class="erpint" name="hanger1" id="hanger1" value="<?php echo $operationData['hanger1'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="hanger2" id="hanger2" value="<?php echo $operationData['hanger2'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="hanger3" id="hanger3" value="<?php echo $operationData['hanger3'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="hanger4" id="hanger4" value="<?php echo $operationData['hanger4'] ?>" ></td>
        <td style="padding-left:20px;">Carton Markings</td>
        <td><input style="width:100%;" type="text" class="erpint" name="carton_king1" id="carton_king1" value="<?php echo $operationData['carton_king1'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="carton_king2" id="carton_king2" value="<?php echo $operationData['carton_king2'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="carton_king3" id="carton_king3" value="<?php echo $operationData['carton_king3'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="carton_king4" id="carton_king4" value="<?php echo $operationData['carton_king4'] ?>" ></td>
      </tr>
      <tr height="20">
        <td height="20" style="padding-left: 60px;">Washcare</td>
       <td><input style="width:100%;" type="text" class="erpint" name="washcare1" id="washcare1" value="<?php echo $operationData['washcare1'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="washcare2" id="washcare2" value="<?php echo $operationData['washcare2'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="washcare3" id="washcare3" value="<?php echo $operationData['washcare3'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="washcare4" id="washcare4" value="<?php echo $operationData['washcare4'] ?>" ></td>
        <td style="padding-left:20px;">Placement<br />
          Upc/P.Pack</td>
       <td><input style="width:100%;" type="text" class="erpint" name="placement1" id="placement1" value="<?php echo $operationData['placement1'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="placement2" id="placement2" value="<?php echo $operationData['placement2'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="placement3" id="placement3" value="<?php echo $operationData['placement3'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="placement4" id="placement4" value="<?php echo $operationData['placement4'] ?>" ></td>
      </tr>
      <tr height="20">
        <td height="20" style="padding-left: 60px;">Interlining</td>
        <td><input style="width:100%;" type="text" class="erpint" name="interlining1" id="interlining1" value="<?php echo $operationData['interlining1'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="interlining2" id="interlining2" value="<?php echo $operationData['interlining2'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="interlining3" id="interlining3" value="<?php echo $operationData['interlining3'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="interlining4" id="interlining4" value="<?php echo $operationData['interlining4'] ?>" ></td>
        <td style="padding-left:20px;">Folding</td>
       <td><input style="width:100%;" type="text" class="erpint" name="folding1" id="folding1" value="<?php echo $operationData['folding1'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="folding2" id="folding2" value="<?php echo $operationData['folding2'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="folding3" id="folding3" value="<?php echo $operationData['folding3'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="folding4" id="folding4" value="<?php echo $operationData['folding4'] ?>" ></td>
      </tr>
      <tr height="20">
        <td height="20" style="padding-left: 60px;">Snap</td>
       <td><input style="width:100%;" type="text" class="erpint" name="snap1" id="snap1" value="<?php echo $operationData['snap1'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="snap2" id="snap2" value="<?php echo $operationData['snap2'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="snap3" id="snap3" value="<?php echo $operationData['snap3'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="snap4" id="snap4" value="<?php echo $operationData['snap4'] ?>" ></td>
        <td style="padding-left:20px;">Spare Button Position</td>
       <td><input style="width:100%;" type="text" class="erpint" name="spare_but_pos1" id="spare_but_pos1" value="<?php echo $operationData['spare_but_pos1'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="spare_but_pos2" id="spare_but_pos2" value="<?php echo $operationData['spare_but_pos2'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="spare_but_pos3" id="spare_but_pos3" value="<?php echo $operationData['spare_but_pos3'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="spare_but_pos4" id="spare_but_pos4" value="<?php echo $operationData['spare_but_pos4'] ?>" ></td>
      </tr>
      <tr height="20">
        <td height="20" style="padding-left: 60px;">Elastic</td>
       <td><input style="width:100%;" type="text" class="erpint" name="elastic1" id="elastic1" value="<?php echo $operationData['elastic1'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="elastic2" id="elastic2" value="<?php echo $operationData['elastic2'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="elastic3" id="elastic3" value="<?php echo $operationData['elastic3'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="elastic4" id="elastic4" value="<?php echo $operationData['elastic4'] ?>" ></td>
        <td width="141" style="padding-left:20px;">Print</td>
        <td><input style="width:100%;" type="text" class="erpint" name="print1" id="print1" value="<?php echo $operationData['print1'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="print2" id="print2" value="<?php echo $operationData['print2'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="print3" id="print3" value="<?php echo $operationData['print3'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="print4" id="print4" value="<?php echo $operationData['print4'] ?>" ></td>
      </tr>
      <tr height="20">
        <td height="20" style="padding-left: 60px;">Button</td>
       <td><input style="width:100%;" type="text" class="erpint" name="button1" id="button1" value="<?php echo $operationData['button1'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="button2" id="button2" value="<?php echo $operationData['button2'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="button3" id="button3" value="<?php echo $operationData['button3'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="button4" id="button4" value="<?php echo $operationData['button4'] ?>" ></td>
        <td width="141" style="padding-left:20px;">Layout</td>
       <td><input style="width:100%;" type="text" class="erpint" name="layout1" id="layout1" value="<?php echo $operationData['layout1'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="layout2" id="layout2" value="<?php echo $operationData['layout2'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="layout3" id="layout3" value="<?php echo $operationData['layout3'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="layout4" id="layout4" value="<?php echo $operationData['layout4'] ?>" ></td>
      </tr>
      <tr height="20" style="padding-left: 60px;">
        <td height="20" width="198" style="padding-left: 60px;">Hook Eye/Bar</td>
        <td><input style="width:100%;" type="text" class="erpint" name="hok_eye_bar1" id="hok_eye_bar1" value="<?php echo $operationData['hok_eye_bar1'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="hok_eye_bar2" id="hok_eye_bar2" value="<?php echo $operationData['hok_eye_bar2'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="hok_eye_bar3" id="hok_eye_bar3" value="<?php echo $operationData['hok_eye_bar3'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="hok_eye_bar4" id="hok_eye_bar4" value="<?php echo $operationData['hok_eye_bar4'] ?>" ></td>
        <td width="141" style="padding-left:20px;">Emb. Thread Color</td>
       <td><input style="width:100%;" type="text" class="erpint" name="emb_thr_color1" id="emb_thr_color1" value="<?php echo $operationData['emb_thr_color1'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="emb_thr_color2" id="emb_thr_color2" value="<?php echo $operationData['emb_thr_color2'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="emb_thr_color3" id="emb_thr_color3" value="<?php echo $operationData['emb_thr_color3'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="emb_thr_color4" id="emb_thr_color4" value="<?php echo $operationData['emb_thr_color4'] ?>" ></td>
      </tr>
      <tr height="20">
        <td height="20" style="padding-left: 60px;">Lace</td>
       <td><input style="width:100%;" type="text" class="erpint" name="lace1" id="lace1" value="<?php echo $operationData['lace1'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="lace2" id="lace2" value="<?php echo $operationData['lace2'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="lace3" id="lace3" value="<?php echo $operationData['lace3'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="lace4" id="lace4" value="<?php echo $operationData['lace4'] ?>" ></td>
        <td width="141" style="padding-left:20px;">Placement</td>
      <td><input style="width:100%;" type="text" class="erpint" name="plcment1" id="plcment1" value="<?php echo $operationData['plcment1'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="plcment2" id="plcment2" value="<?php echo $operationData['plcment2'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="plcment3" id="plcment3" value="<?php echo $operationData['plcment3'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="plcment4" id="plcment4" value="<?php echo $operationData['plcment4'] ?>" ></td>
      </tr>
      <tr height="20">
        <td height="20" style="padding-left: 60px;">Buckle</td>
       <td><input style="width:100%;" type="text" class="erpint" name="buckle" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="buckle" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td width="141" style="padding-left:20px;">Beads/Sequins</td>
       <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
        <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" ></td>
      </tr>
      <tr height="40">
        <td height="40" style="padding-left: 60px;">Snap</td>
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
        <td height="20" style="padding-left: 60px;">Thread</td>
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
        <td height="20" style="padding-left: 60px;">Lining</td>
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
        <td height="20" style="padding-left: 60px;">Zipper</td>
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
      <td colspan="12" height="21"><center style="font-size:17px; background-color:#0288d1; height:50px; padding:14px; color:white; text-transform: capitalize; padding-right: 775px;     text-align: left;">Pattern Checklist</center></td>
      </tr>
      <tr height="20">
        <td height="20" style="padding-left: 48px;">Grain Line</td>
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
        <td height="20" style="padding-left: 48px;">Notches</td>
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
        <td height="20" style="padding-left: 48px;">&nbsp;Grade Nest</td>
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
        <td height="20" style="padding-left: 48px;">Corrections Implemented</td>
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
        <td height="20" style="padding-left: 48px;">FDS Cut width</td>
        <td>From FDS</td>
        <td></td>
        <td></td>
        <td></td>
        <td>Cutting Go Ahead</td>
        <td><select name="cars" class="form-control" style="margin-bottom: 15px;">
    <option value="volvo">Select</option>
    <option value="volvo">Yes</option>
    <option value="saab">No</option>

</select></td>

        <td></td>
        <td></td>
        <td>&nbsp;</td>
      </tr>
      <tr height="20">
        <td height="20" style="padding-left: 48px;">FDS Cut width</td>
        <td>From FDS</td>
        <td></td>
        <td></td>
        <td></td>
        <td>Size Set Implementation Result</td>
        <td><select name="cars" class="form-control" style="margin-bottom: 15px;">
    <option value="">Select</option>
    <option value="">Pass</option>
    <option value="">Fail</option>

</select></td>

        <td></td>
        <td></td>
        <td>&nbsp;</td>
      </tr>
      <tr height="20">
        <td height="20" style="padding-left: 48px;">FDS Cut width</td>
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
        <td height="20" style="padding-left: 48px;">FDS Full Width</td>
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
        <td height="20" style="padding-left: 48px;">Planned Size</br> Set Submission Date</td>
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
        <td height="20" style="padding-left: 48px;">Actual </br>Submission Date</td>
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
        <td height="20" style="padding-left: 48px;">Cut Quantity</td>
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
        <td height="20" style="padding-left: 48px;">Corrections to be done:</td>
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



    </table>


                <input name="action" type="hidden" id="action" value="setsizeinspection" />

                    <input name="module" type="hidden" id="module" value="<?php echo $_GET['module'];?>"/>

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

    <script>

      var date = new Date();
var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

var optSimple = {
  format: 'mm-dd-yyyy',
  todayHighlight: true,
  orientation: 'bottom right',
  autoclose: true,
  container: '#sandbox'
};

var optComponent = {
  format: 'mm-dd-yyyy',
  container: '#datePicker',
  orientation: 'auto top',
  todayHighlight: true,
  autoclose: true
};

// SIMPLE
$( '#simple' ).datepicker( optSimple );

// COMPONENT
$( '#datePicker' ).datepicker( optComponent );

// ===================================

$( '#datepicker1' ).datepicker({
  format: "mm : dd : yyyy",
  todayHighlight: true,
  autoclose: true,
  container: '#box1',
  orientation: 'top right'
});

$( '#datepicker2' ).datepicker({
  format: 'mm \\ dd \\ yyyy',
  todayHighlight: true,
  autoclose: true,
  container: '#box2',
  orientation: 'top right'
});

$( '#datepicker1, #datepicker2, #simple, #datePicker' ).datepicker( 'setDate', today );
    </script>

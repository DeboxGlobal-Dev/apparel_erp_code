<?php
if($_GET['styleid']!=''){
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

}

if($_GET['id']==''){



  deleteRecord('cdnMaster','1 and buyerId="" and brandId="" and drivername=""');
  deleteRecord('cdnStyleMaster','styleId="0" and indentNo="" and invoiceNo=""');


  $namevalue ='buyerId="",brandId=""';

  $cdnLastId = addlistinggetlastid('cdnMaster',$namevalue);


}else{
  $rrrr=GetPageRecord('*','cdnMaster','1 and id="'.decode($_GET['id']).'"');
	$operationData=mysqli_fetch_array($rrrr);
  $cdnLastId = $operationData['id'];
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
.erpint{
    border: 1px solid #b3acac;
    padding: 3px;
}
</style>

	<div class="page-content">

		<div class="content-wrapper">
		 <?php include "savealert.php"; ?>

 	<div class="content pt-0" style="margin-top:20px;">
 				<div class="row">

				<div class="col-xl-12">
				<div class="card">
				    <div style="padding: 25px;">

				<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
					<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['module']; ?>" />
					<input name="editId" type="hidden" id="editId" value="<?php if($_GET['id']!=""){ echo encode($operationData['id']); }else{ echo encode($cdnLastId); } ?>">

               <table class="table erptab table-hover" style="width:100%">
                     <tr>

                          <td><div style="text-transform:capitalize"><b>Buyer</b></div></td>
                         <td>
                         <select style="width:100%;" class="erpint" name="buyer" id="buyer" onchange="changeBuyer(this.value);">
                                 <option value="">Select</option>
                                   <?php
        $rrrr=GetPageRecord('*','buyerMaster',1);
        while($buyer=mysqli_fetch_array($rrrr)){
        ?>
        <option value="<?php echo $buyer['id'] ?>" <?php if($buyer['id'] == $operationData['buyerId']){ ?> selected <?php } ?>><?php echo $buyer['name'] ?></option>
        <?php }  ?>
                             </select>
                             </td>

                         <td><div style="text-transform:capitalize"><b>Factory Location</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="factorylocation" id="factorylocation" value="<?php echo $operationData['factorylocation'] ?>">
                         </td>

                        <td style="width:10%"><div style="text-transform:capitalize;"><b>Brand</b></div></td>
                         <td>

                         <select style="width:100%;" class="erpint" name="brand" id="brand">
                                 <option value="">Select</option>

                             </select>
                    </td>
                     </tr>
               </table>
<script>
function changeBuyer(buyer){
	$('#brand').load('loadbrand.php?buyer='+buyer+'&action=changebrands&selectId=<?php echo $operationData['brandId'] ?>');
}
<?php
if($_GET['id']!=''){
?>
changeBuyer(<?php echo $operationData['buyerId']; ?>);
<?php } ?>
</script>
               <br>
               <?php
if($_REQUEST['module']=='cdn'){
  ?>
               <table class="table erptab table-hover" style="width:100%">
                     <tr>
                          <td style="width:26%"><div style="text-transform:capitalize;"><b>Currency/Conversion</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="curr" id="curr" value="<?php echo $operationData['currency'] ?>"></td>
                          <td><div style="text-transform:capitalize"><b>Delivery Center</b></div></td>
                         <td>
                            <input style="width:100%;" type="text" class="erpint" name="delivery" id="delivery" value="<?php echo $operationData['deliverycenter'] ?>"></td>


                     </tr>
                          <tr>
                              <td><div style="text-transform:capitalize;"><b>Electronic way Bill Date</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="ewbd" id="ewbd" value="<?php echo $operationData['electronicdate'] ?>"></td>
                                <td><div style="text-transform:capitalize"><b>Lorry Receipt Date</b></div></td>
                         <td><input style="width:100%;" type="date" class="erpint" name="lrd" id="lrd" value="<?php echo $operationData['lrd'] ?>"></td>


                     </tr>
                     <tr>
                        <td><div style="text-transform:capitalize;"><b>Electronic way Bill No.</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="ewbn" id="ewbn" value="<?php echo $operationData['electronicno'] ?>"></td>
                         <td style="width:26%"><div style="text-transform:capitalize"><b>Lorry Receipt No.</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="lrn" id="lrn" value="<?php echo $operationData['lrn'] ?>"> </td>
                     </tr>
                     <tr>
                          <td style="width:18%;"><div style="text-transform:capitalize;"><b>Port Transit Mode</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="ptm" id="ptm" value="<?php echo $operationData['ptm'] ?>"></td>
                         <td><div style="text-transform:capitalize"><b>Shipment Mode</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="shipmentmode" id="shipmentmode" value="<?php echo  $operationData['shipmentmode'] ?>"></td>

                     </tr>
                      <tr>

                         <td><div style="text-transform:capitalize"><b>Gate Entry No.</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="gate" id="gate" value="<?php echo $operationData['gate'] ?>"></td>
                         <td style="width:26%"><div style="text-transform:capitalize"><b>Clearing Agent</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="clearing" id="clearing" value="<?php echo $operationData['clearing'] ?>" > </td>
                     </tr>
               </table>

<?php } ?>
<?php
if($_REQUEST['module']=='samplecdn'){
  ?>
               <table class="table erptab" style="width:100%">
                <tr style="background: #0288d1;">
                         <td colspan="2"><div style="text-transform:capitalize;color:white;font-size: 15px;">Dispatch Details</div>
                         </td>
                     </tr>
                    <tr>
                      <td>
                     <table class="erptab2" width="100%">
                     <tr>
                          <td style="width:%"><div style="text-transform:capitalize;"><b>Office</b></div></td>
                         <td>
                          <select style="width: 170px;padding: 6px" class="erpint" name="office" id="office">
                            <option value="">Select</option>
                      <option value="Local" <?php if($operationData['office'] == 'Local') { ?> selected <?php } ?>>Local Office</option>
                            <option value="Overseas" <?php if($operationData['office'] == 'Overseas') { ?> selected="selected" <?php } ?>>Overseas Office</option>
                          </select>
                        </td>
                          <td><div style="text-transform:capitalize"><b>Destination Address</b></div></td>
                         <td>
                            <input style="width:100%;" type="text" class="erpint" name="destaddress" id="destaddress" value="<?php echo $operationData['destAddress'] ?>"></td>
                          </tr>
                          <tr>
                            <td><div style="text-transform:capitalize;"><b>Carrier</b></div></td>
                         <td>
                          <select style="width: 170px;padding:6px" class="erpint" name="carrier" id="carrier">
                            <option value="">Select</option>
                            <option value="Hand" <?php if($operationData['carrier'] == 'Hand') { ?> selected <?php } ?>>By Hand</option>
                            <option value="courier" <?php if($operationData['carrier'] == 'courier') { ?> selected <?php } ?>>Courier</option>
                          </select>
                        </td>
                          <td><div style="text-transform:capitalize"><b>DHL/Runner's&nbsp;Name</b></div></td>
                         <td>
                            <input style="width:100%;" type="text" class="erpint" name="cname" id="cname" value="<?php echo $operationData['carrierName'] ?>"></td>
                     </tr>
                   </table>
                 </td>
                 <td style="border-left: 1px solid #cccccc;">
                  <table class="erptab1" width="100%">
                     <tr>
                          <td><div style="text-transform:capitalize;"><b>AWB Number</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="awbno" id="awbno" value="<?php echo $operationData['awbNo'] ?>"></td>
                                <td><div style="text-transform:capitalize"><b>Reciepients Name</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="recname" id="recname" value="<?php echo $operationData['rName'] ?>"></td>
                         </tr>

                         <tr>
                         <td><div style="text-transform:capitalize;"><b>Estimated&nbsp;Time&nbsp;of&nbsp;Departure</b></div></td>
                         <td><input style="width:100%;" type="date" class="erpint" name="etod" id="etod" value="<?php echo $operationData['etod'] ?>"></td>
                                <td><div style="text-transform:capitalize"><b>Sender's&nbsp;Name</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="senname" id="senname" value="<?php echo $operationData['sName'] ?>"></td>
                          </tr>

                           <tr>
                              <td><div style="text-transform:capitalize;"><b>Estimated&nbsp;Time&nbsp;of&nbsp;Arrival</b></div></td>
                         <td><input style="width:100%;" type="date" class="erpint" name="etoa" id="etoa" value="<?php echo $operationData['etoa'] ?>"></td>
                                <td><div style="text-transform:capitalize"><b>Proof&nbsp;of&nbsp;Delivery</b></div></td>
                         <td>
                          <div align="center" style="display: flex;width: 135px;margin: auto;">
                    <?php   if($operationData['pod'] != "") {  ?><a href="attachment/<?php echo $operationData['pod'] ?>" target="_blank" ><span class="badge badge-flat mr-3" style="border-color: #02c681; color: #02c681; position: relative;padding: 7px; font-size: 11px;">View</span></a><?php } ?>
                      <div class="uniform-uploader">
            <input type="file" name="pod" id="pod" class="form-input-styled" data-fouc="">
            <span class="badge badge-flat mr-2" style="border-color: #ff7043; color: #ff7043; position: relative;padding: 7px; font-size: 11px;">Upload</span>
            <input type="hidden" name="upload1" id="upload1" value="<?php echo $operationData['pod']; ?>"/>
            </div>
            <?php   if($operationData['pod'] != "") {  ?>
            <div style="cursor: pointer;" >
            <i class="fa fa-trash" style="color: red"></i></div>
          <?php } ?>
          </div>
                         </td>
                          </tr>
                   </table>
                 </td>
               </tr>
               </table>

<?php } ?>
<br>
<?php
if($_REQUEST['module']=='cdn'){
  ?>
                 <table class="table erptab" style="width:100%">
                   <tr style="background: #0288d1;">
                         <td colspan="6"><div style="text-transform:capitalize;color:white;font-size: 15px;">Vehicle & Driver Details

                         </div>
                         </td>
                     </tr>
                     <tr>
                        <td><div style="text-transform:capitalize"><b>Drivers Name</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="driversname" id="driversname" value="<?php echo $operationData['drivername'] ?>"> </td>
                         <td><div style="text-transform:capitalize"><b>Drivers License No.</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="dln" id="dln" value="<?php echo $operationData['dln'] ?>"> </td>
                         <td><div style="text-transform:capitalize"><b>Drivers Mobile No.</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="dmn" id="dmn" value="<?php echo $operationData['dmn'] ?>"> </td>
                     </tr>

                           <tr>
                        <td><div style="text-transform:capitalize"><b>Vehicle No.</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="vehicleno" id="vehicleno" value="<?php echo$operationData['vehicleno'] ?>"> </td>
                        <td><div style="text-transform:capitalize"><b>Vehicle Type</b></div></td>
                        <td><input style="width:100%;" type="text" class="erpint" name="vehicletype" id="vehicletype" value="<?php echo $operationData['vehicletype'] ?>"></td>
                        <td><div style="text-transform:capitalize"><b>Insurance No. & Date</b></div></td>
                        <td><input style="width:100%;" type="text" class="erpint" name="ind" id="ind" value="<?php echo $operationData['ind'] ?>"></td>
                     </tr>
               </table>
               <br>
             <?php } ?>



					<table width="100%" class="table table-bordered table-responsive">

							<tr role="row" style="background-color: #fff7b3;">
								<th><div style="text-transform:capitalize;"><a style="cursor:pointer; color:#0000FF;" onclick="addnewrow(1);">+Add&nbsp;New</a></div></th>
								<th>Style</th>
								<th><?php if($_REQUEST['module']=='samplecdn'){ ?>Sampling&nbsp;Requisition&nbsp;No.<?php } else { ?>Indent&nbsp;No.<?php } ?></th>
                <?php if($_REQUEST['module']=='samplecdn'){ ?><th>Sample&nbsp;Type</th><?php } ?>
								<th>Style&nbsp;Desc.</th>
								<?php if($_REQUEST['module']=='cdn'){ ?><th>HSN&nbsp;Code</th>	<?php } ?>
								<?php if($_REQUEST['module']=='cdn'){ ?><th>Invoice&nbsp;Number</th>	<?php } ?>
								<?php if($_REQUEST['module']=='cdn'){ ?><th>ASN&nbsp;No.</th><?php } ?>
								<?php if($_REQUEST['module']=='cdn'){ ?><th>BPO&nbsp;Number</th><?php } ?>
								<?php if($_REQUEST['module']=='cdn'){ ?><th>Destination&nbsp;Center</th><?php } ?>
								<?php if($_REQUEST['module']=='cdn'){ ?><th>Quantity</th><?php }else{ ?><th>No. of. Pcs.</th><?php } ?>
								<?php if($_REQUEST['module']=='cdn'){ ?><th>Amount</th><?php }else{ ?><th>Price</th><?php } ?>
								<?php if($_REQUEST['module']=='samplecdn'){ ?><th>Value</th><?php } ?>
								<?php if($_REQUEST['module']=='cdn' || $_REQUEST['module']=='samplecdn'){ ?><th>No.&nbsp;of&nbsp;Packages</th><?php } ?>
								<?php if($_REQUEST['module']=='cdn'){ ?><th>Package&nbspNo&nbsp;From</th><?php } ?>
								<?php if($_REQUEST['module']=='cdn'){ ?><th>Package&nbsp;No&nbsp;To</th><?php } ?>
								<?php if($_REQUEST['module']=='cdn'){ ?><th>CBM</th><?php } ?>
							</tr>
                    	<tbody id="loadrow"></tbody>
                  <script>
                  function addnewrow(id){
                    if(id==1){
                        $("#loadrow").load('loadaction.php?add=1&action=cdnstyle&parentId=<?php echo encode($cdnLastId); ?>&module=<?php echo $_REQUEST['module']; ?>');
                    }else{
                        $('#loadrow').load('loadaction.php?action=cdnstyle&parentId=<?php echo encode($cdnLastId); ?>&module=<?php echo $_REQUEST['module']; ?>');
                    }
                  }
                  addnewrow(0);

                  function deleteRow(id){
                    var checkyes = confirm('Are your sure you you want to delete?');
                        if(checkyes==true){
              $('#loadrow').load('loadaction.php?id='+id+'&deletestatus=yes&action=cdnstyle&parentId=<?php echo encode($cdnLastId); ?>&module=<?php echo $_REQUEST['module']; ?>');
                        }
                  }
                  </script>

                  <div id="savedata" style="display: none;"></div>


                     </table>
                   <br>
    				              <button type="submit" class="btn btn-primary" style="float:right">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;"></i></button>




				</div>


 	</div>





</div>
			</form>
			</div>

		</div>

	</div>

</div>

<style>
    .datatable-scroll
    {
        overflow:auto!important;
    }
</style>
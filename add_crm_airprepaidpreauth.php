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
$patternAttachment = $editresultstyle['patternAttachment'];
$attachmentFile = $editresultstyle['attachmentFile'];
$techpackdescription = $editresultstyle['techpackdescription'];
$lastId=$editresultstyle['id'];

}

?>
<style>
    .erptab tr td{
border-top:0px solid #ccc!important;
padding:0.55rem!important;
}
.erptab1 tr td{
border-top:0px solid #ccc!important;
padding:0.40rem!important;
}
.erptab{
border:1px solid #ccc !important;
}
.erptab1{
border:1px solid black !important;
}
.erpint{
    border: 1px solid #b3acac;
    padding: 3px;
}
</style>
	<div class="page-content">
 <?php include "left.php"; ?>
		 <div class="content-wrapper">
 <div class="content pt-0" style="margin-top:20px;">

            <div class="row" style="margin-bottom:10px; ">
                        <div class="col-xl-12">
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
                            </div>
                        </div>

            <script>
            function selectStyle(){
            var styleId = $('#styleId').val()
                if(styleId!=''){
                     window.location.href = '<?php echo $fullurl; ?>showpage.crm?module=airprepaidpreauth&add=yes&styleid='+styleId;
                }
            }
            </script>

            <?php
            if($_GET['styleid']!=''){
                include "top-style.php";
            }
            ?>


			 	<div class="row">
			 	<div class="col-xl-12">
				<div class="card">
				    <?php

				$rrrr=GetPageRecord('*','airFreightMaster','1 and styleId="'.decode($_GET['styleid']).'"');
				$operationData=mysqli_fetch_array($rrrr);

				?>
			  <div style="padding: 25px;">
			 	<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
					<input name="action" type="hidden" id="action" value="airfreight" />
					<input type="hidden" name="styleid" id="styleid" value="<?php echo $_GET['styleid']; ?>" />
					<input name="editId" type="hidden" id="editId" value="<?php echo encode($operationData['id']); ?>">

               <table class="table erptab table-hover" style="width:100%">
                     <tr>
                         <td style="width:10%"><div style="text-transform:capitalize;"><b>Prepared By</b></div></td>
                         <td> <input style="width:100%;" type="text" class="erpint" name="pfor" id="pfor" value="<?php echo $operationData['preparedBy'] ?>"></td>
                    </td>
                         <td><div style="text-transform:capitalize"><b>requested For</b></div></td>
                         <td>
                            <select style="width: 100%;padding:5px" class="erpint" name="rfor" id="rfor">
                            <option value="">Select</option>
                <option value="good" <?php if($operationData['requiredFor'] == 'good') { ?> selected <?php } ?>>Finished Goods</option>
                <option value="raw" <?php if($operationData['requiredFor'] == 'raw') { ?> selected <?php } ?>>Raw Material</option>
                   </select>
                         </td>

                         <td><div style="text-transform:capitalize"><b>Requesting Department</b></div></td>
                         <td>
                         <select style="width:100%;" class="erpint" name="department" id="department">
                                 <option value="">Select</option>
                                   <?php
        $rrrr=GetPageRecord('*','departmentMaster','1 order by name asc');
        while($department=mysqli_fetch_array($rrrr)){
        ?>
        <option value="<?php echo $department['id'] ?>" <?php if($operationData['departmentId'] == $department['id']) { ?> selected <?php } ?>><?php echo $department['name'] ?></option>
        <?php } ?>
                             </select>
                             </td>
                     </tr>
               </table>
               <br>
               <div class="box" id="divid">
               <table class="table erptab" style="width:100%">
                    <tr style="background: #0288d1;">
        <td colspan="4"><div style="text-transform:capitalize;color:white;font-size: 15px;">Finished Goods</div>
                         </td>
                     </tr>
                     <tr>
                         <td style="width:10%"><div style="text-transform:capitalize;"><b>buyer's P.O No</b></div></td>


                         <td>
                             <?php
                             if($_GET['styleid']==''){


                             }

                             ?>


                              <select style="width:100%;"  class="erpint" name="bpo" id="bpo" >
                             <option>Select</option>
                             <?php

                         $rrrrd=GetPageRecord('*','poManageMaster','1  order by id desc');
        while($departmentd=mysqli_fetch_array($rrrrd)){


                         ?>
                             <option value="<?php echo $departmentd['poNumber']; ?>" <?php if($operationData['buyerPo'] ==$departmentd['poNumber']) { ?> selected readonly <?php } ?>><?php echo $departmentd['poNumber']; ?> [<?php echo getStyleRefId($departmentd['styleId']); ?>]</option>

                             <?php } ?>
                         </select>




                         <!--<input style="width:100%;" type="text" class="erpint" name="bpo" id="bpo" value="<?php echo $operationData['buyerPo'] ?>">-->


                         </td>
                    </td>
                         <td><div style="text-transform:capitalize"><b>DCPO</b></div></td>
                         <td>

                             <select style="width:100%;" type="text" class="erpint" name="dcpo" id="dcpo" >
                             <option>Select</option>
                             <?php
                         $rrrrds=GetPageRecord('*','poManageMaster','1  order by id desc');
        while($departmentds=mysqli_fetch_array($rrrrds)){


                         ?>
                             <option value="<?php echo $departmentds['poNumber']; ?>" <?php if($operationData['dcpo'] ==$departmentds['poNumber']) { ?> selected <?php } ?>><?php echo $departmentds['poNumber']; ?> [<?php echo getStyleRefId($departmentds['styleId']); ?>]</option>

                             <?php } ?>
                         </select>






                            <!--<input style="width:100%;" type="text" class="erpint" name="dcpo" id="dcpo" value="<?php echo $operationData['dcpo'] ?>">-->
                         </td>

                     </tr>
               </table>
            <br>
           </div>
                 <div class="box" id="divid1">
               <table class="table erptab" style="width:100%; display:none;">
                     <tr style="background: #0288d1;">
            <td colspan="4"><div style="text-transform:capitalize;color:white;font-size: 15px;">Raw Material</div>
                         </td>
                     </tr>
                     <tr>
                         <td style="width:10%"><div style="text-transform:capitalize;"><b>indent No</b></div></td>
                         <td> <input style="width:100%;" type="text" class="erpint" name="indent" id="indent" value="<?php echo $operationData['indentNo'] ?>" readonly="readonly">
                         </td>
                    </td>
                         <td><div style="text-transform:capitalize"><b>DCPO</b></div></td>
                         <td>


                             <select style="width:100%;" type="text" class="erpint" name="idcpo" id="idcpo" >
                             <option>Select</option>
                             <?php
                         $rrrrdsv=GetPageRecord('*','poManageMaster','1 and styleId="'.decode($_GET['styleid']).'" and poType="2"');
        while($departmentdsv=mysqli_fetch_array($rrrrdsv)){


                         ?>
                             <option value="<?php echo $departmentdsv['poNumber']; ?>" <?php if($operationData['idcpo'] ==$departmentdsv['poNumber']) { ?> selected readonly <?php } ?>><?php echo $departmentdsv['poNumber']; ?></option>

                             <?php } ?>
                         </select>






                            <!--<input style="width:100%;" type="text" class="erpint" name="idcpo" id="idcpo" value="<?php echo $operationData['idcpo'] ?>">-->
                         </td>

                     </tr>
               </table>
               <br>
           </div>

					 <table class="table erptab table-hover" style="width:100%">
                         <tr style="background: #0288d1;">
            <td colspan="4"><div style="text-transform:capitalize;color:white;font-size: 15px;">Air Freight Expense pre-Approval</div>
                         </td>
                     </tr>
                     <tr>
                          <td style="width:24%"><div style="text-transform:capitalize;"><b>cost incurred by</b></div></td>
                         <td> <select style="width: 100%;padding:5px" class="erpint" name="cost" id="cost">
                            <option value="">Select</option>
                <option value="1" <?php if($operationData['costInc'] == '1') { ?> selected <?php } ?>>Buyer</option>
                <option value="2" <?php if($operationData['costInc'] == '2') { ?> selected <?php } ?>>Vendor</option>
                <option value="3" <?php if($operationData['costInc'] == '3') { ?> selected <?php } ?>>DeBox</option>
                          </select></td>
                          <td><div style="text-transform:capitalize"><b>Original Ex-Factory/Ex-Mill</b></div></td>
                         <td>
                            <input style="width:100%;" type="date" class="erpint" name="orgfact" id="orgfact" value="<?php echo $operationData['orgfact'] ?>"></td>
                     </tr>
                          <tr>
                              <td><div style="text-transform:capitalize;"><b>Destination Port for Airing</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="destport" id="destport" value="<?php echo $operationData['destPort'] ?>"></td>
                                <td><div style="text-transform:capitalize"><b>Original Ship Cancel</b></div></td>
                         <td><input style="width:100%;" type="date" class="erpint" name="shipcancel" id="shipcancel" value="<?php echo $operationData['shipCancel'] ?>"></td>
                     </tr>
                     <tr>
                        <td><div style="text-transform:capitalize;"><b>Quantity to be aired with UOM</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="qtyuom" id="qtyuom" value="<?php echo $operationData['qtyuom'] ?>"></td>
                         <td style="width:26%"><div style="text-transform:capitalize"><b>Airing Ex-Factory Date</b></div></td>
                         <td><input style="width:100%;" type="date" class="erpint" name="factdate" id="factdate" value="<?php echo $operationData['factDate'] ?>"> </td>
                     </tr>
                     <tr>
                          <td style="width:18%;"><div style="text-transform:capitalize;"><b>Forwarder Name</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="fname" id="fname" value="<?php echo $operationData['fName'] ?>"></td>
                         <td><div style="text-transform:capitalize"><b>Airing Ship Cancel Date</b></div></td>
                         <td><input style="width:100%;" type="date" class="erpint" name="candate" id="candate" value="<?php echo  $operationData['cancelDate'] ?>"></td>

                     </tr>
                      <tr>

                         <td><div style="text-transform:capitalize"><b>Shipment Term</b></div></td>
                         <td>
                            <select style="width: 100%;padding:5px" class="erpint" name="sterm" id="sterm">
                            <option value="">Select</option>
                <option value="1" <?php if($operationData['shipTerm'] == '1') { ?> selected <?php } ?>>FOB</option>
                <option value="2" <?php if($operationData['shipTerm'] == '2') { ?> selected <?php } ?>>CIF</option>
                <option value="3" <?php if($operationData['shipTerm'] == '3') { ?> selected <?php } ?>>CFR</option>
                          </select>
                         </td>
                         <td style="width:26%"><div style="text-transform:capitalize"><b>Invoice Value</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="invalue" id="invalue" value="<?php echo $operationData['invoiceVal'] ?>" > </td>
                     </tr>
                     <tr>

                         <td><div style="text-transform:capitalize"><b>Reason for Air Shipment</b></div></td>
                         <td>
                             <select style="width: 100%;padding:5px" class="erpint" name="reason" id="reason">
                            <option value="">Select</option>
                <option value="1" <?php if($operationData['reason'] == '1') { ?> selected <?php } ?>>Prodcution Delay</option>
                <option value="2" <?php if($operationData['reason'] == '2') { ?> selected <?php } ?>>Merchandising Delay</option>
                <option value="3" <?php if($operationData['reason'] == '3') { ?> selected <?php } ?>>Fabric Load</option>
                <option value="4" <?php if($operationData['reason'] == '4') { ?> selected <?php } ?>>Line Load</option>
                <option value="5" <?php if($operationData['reason'] == '5') { ?> selected <?php } ?>>Small Quantity</option>
                          </select>
                         </td>
                         <td style="width:26%"><div style="text-transform:capitalize"><b>Estimated&nbsp;Airfreight&nbsp;(In USD)</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="usd" id="usd" value="<?php echo $operationData['usd'] ?>" > </td>
                     </tr>
                     <tr>

                         <td><div style="text-transform:capitalize"><b>Terms of Payment</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="tpayment" id="tpayment" value="<?php echo $operationData['termPayment'] ?>"></td>
                         <td style="width:26%"><div style="text-transform:capitalize"><b>Estimated&nbsp;Airfreight&nbsp;(In INR)</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="inr" id="inr" value="<?php echo $operationData['inr'] ?>" readonly> </td>
                     </tr>
                     <tr>

                         <td><div style="text-transform:capitalize"><b>Incuded in costing</b></div></td>
                         <td>
                         <input type="radio" class="erpint" name="icost" value="yes" <?php if($operationData['costing'] == 'yes') { ?> checked <?php } ?>>&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                         <input type="radio" class="erpint" name="icost" value="no" <?php if($operationData['costing'] == 'no') { ?> checked <?php } ?>>&nbsp;No
                     </td>
                         <td><div style="text-transform:capitalize"><b>Status</b></div></td>
                         <td>
                         <input type="radio" class="erpint" name="status" value="1" <?php if($operationData['statusFinal'] == '1') { ?> checked <?php } ?>>&nbsp;Save&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                         <input type="radio" class="erpint" name="status" value="2" <?php if($operationData['statusFinal'] == '2') { ?> checked <?php } ?>>&nbsp;Approved
                     </td>
                     </tr>
               </table>
              <br>


                   <button type="submit" class="btn btn-primary" style="float:right">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;"></i></button>

               </form>
				</div>






	</div>
</div>
</div>
</div></div></div>



<style>
.nav-justified .nav-item {
    text-align: center;
    width: 50% !important;
    display: contents;
    float: left;
}

.nav-tabs-highlight .nav-link {
    width: 50% !important;
    float: left;

}
.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: #333;
    background-color: #fff;
    border-color: #ddd #ddd #fff;
    background-color: #fff178 !important;
    border: 1px solid #ccc;
}
.nav-tabs-highlight .nav-link {
    width: 50% !important;
    float: left;
    border: 1px solid #e9e9e9;
    background-color: #f9f9f9 !important;
}
.box{
    display: none;
}
</style>

<script>
$(document).ready(function(){
    $('#rfor').on('change', function() {
      if ( this.value == 'good')
      {
        $("#divid").show();
        $("#divid1").hide();
      }
      else if( this.value == 'raw')
      {
        $("#divid1").show();
        $("#divid").hide();
      }
      else
      {
        $("#divid").hide();
        $("#divid1").hide();
      }
    });
    var fgb = "<?php echo $operationData['requiredFor'] ?>"
if(fgb == 'good'){
    $("#divid").show();
    $("#divid1").hide();
}
else if(fgb == 'raw'){
   $("#divid1").show();
   $("#divid").hide();
}
else{
   $("#divid1").hide();
   $("#divid").hide();
}
});
</script>
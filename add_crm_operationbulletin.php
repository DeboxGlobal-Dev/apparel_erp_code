<?php
//add default version using opeation bulletin
$opequ=GetPageRecord('*','operationBulletinVersionMaster','styleId="'.decode($_GET['styleid']).'" order by id desc');
$countversions=mysql_num_rows($opequ);
if($countversions==0){
$versionId = addlistinggetlastid('operationBulletinVersionMaster','styleId="'.decode($_GET['styleid']).'",versionName="V1",dateAdded="'.time().'",versionId="1",addedBy="'.$_SESSION['userid'].'"');
}

if($loginuserprofileId==1 || $loginuserprofileId==93){

 $wheresearchassign=' 1 and ';

} else {

if($loginuserprofileId==92){
$wheresearchassign=' 1 and finalstatus="2" and assignTo in (select id from '._USER_MASTER_.' where empId in (select id from employeeMaster where reportingTo='.$_SESSION['empid'].')) or assignTo="'.$_SESSION['userid'].'" and ';
} else{

$wheresearchassign=' ( id in (select styleId from styleAssignmentMaster where assignTo="'.$_SESSION['userid'].'" and styleAssignTo=0))';

$wheresearchassign=' '.$wheresearchassign.' and ';

 }

}

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
?>

                  <div class="page-content">

		          <div class="content-wrapper">

			    <div class="content pt-0" style="margin-top:20px;">

				<?php include "top-style.php" ?>

				<?php
				$i = 0;
				$costsheetVersionId='0';
				$selectversion='*';
				$whereversion='styleId="'.decode($_GET['styleid']).'" order by id desc';
				$rsversion=GetPageRecord($selectversion,'operationBulletinVersionMaster',$whereversion);

				while($resListingVer=mysqli_fetch_array($rsversion))
				{
				$costsheetVersionId = $resListingVer['versionId'];
				$i++;

				$rrrr=GetPageRecord('*','operationbulletinentry','1 and styleId="'.decode($_GET['styleid']).'" and costsheetVersionId="'.$costsheetVersionId.'"');
				$operationData=mysqli_fetch_array($rrrr);

				$fromDate=date("d-m-Y", strtotime($operationData['operationdate']));

				 ?>

				 <div class="row" style="margin-bottom:10px;">
							<div class="col-xl-12" style="height:auto; margin-bottom:0px;">
								<div class="card border-left-3 border-left-danger-400 rounded-left-0" style="height: auto;border: 1px solid #e3e3e3 !important;  margin-bottom: 0px !important;">

							<div class="card-body">
  <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
  <!--name="operationbulletinFormV<?php echo $costsheetVersionId; ?>" target="operationbulletiniframe<?php echo $costsheetVersionId; ?>" id="operationbulletinFormV<?php echo $costsheetVersionId; ?>">  -->

									 	 <input name="action" type="hidden" id="action" value="addoperationbulletin" />
										<input name="opId" type="hidden" id="opId" class="opId" value="0" />
										<input name="editId" type="hidden" id="editId" value="<?php echo encode($operationData['id']); ?>">
										<input type="hidden" name="styleid" id="styleid" value="<?php echo $_GET['styleid']; ?>" />
										<input type="hidden" name="costsheetVersionId" id="costsheetVersionId" value="<?php echo $costsheetVersionId; ?>" />

										<h6 class="card-title" style="margin:0px;">
										<a onclick="showfobbydefault<?php echo $costsheetVersionId;?>();" style="width: 100%; display: block; float: left; color: #787878; font-size: 14px; margin: 0px 10px; font-weight: 500; cursor:pointer;"> Operation Bulletin - <?php echo $resListingVer['versionName']; ?> - <?php echo date('d M, Y - h:ia',$resListingVer['dateAdded']); ?></a>
										</h6>

										   <div id="showfobdefault<?php echo $costsheetVersionId;?>" class="collapse" data-parent="#accordion-default" style="">


										   <div class="col-xl-12" style="display: flow-root;padding-top: 10px;">

										  <table style="background-color: #ffffff; margin-bottom: 0; width: 100%;">
										  <tr>
										  <td width="33%">
										  <table class="table table-responsive newclass">
										  <tr>
										   <td width="192">Target</td>
										  <td width="216" align="center"><input type="text" name="target" id="target" value="<?php echo $operationData['target']; ?>"></td>
										  </tr>
										  <tr>
										 <td>Output</td>
										 <td align="center"><input type="text" name="output" id="output" value="<?php echo $operationData['output']; ?>" ></td>
										 </tr>
										 <tr>
										 <td>Efficiency(%)</td>
										 <td align="center"><input onkeyup="calcoutput();" type="text" name="efficiency" id="efficiency" value="<?php echo $operationData['efficiency']; ?>" ></td>
										 </tr>
										 <tr>
										 <td>NO.OF WORK PLACES</td>
										 <td align="center"><input onkeyup="calcoutput();" type="text" name="workplaces" id="workplaces" value="<?php echo $operationData['workplaces']; ?>" ></td>
										 </tr>
										 <tr>
										 <td>SEWING M/C</td>
										 <td align="center"><input type="text" name="sewingmc" id="sewingmc" value="<?php echo $operationData['sewingmc']; ?>" ></td>
										 </tr>
										 </table>
										 </td>
										 <td width="33%">
										 <table class="table table-responsive newclass">

										 <tr>
										 <td>Total SAM</td>
										 <td align="center"><input onkeyup="calcoutput();" type="text" name="totalsam" id="totalsam" value="<?php echo $operationData['totalsam']; ?>" ></td>
										 </tr>
										 <tr>
										 <td>M/C SAM</td>
										 <td align="center"><input type="text" name="mcsam" id="mcsam" value="<?php echo $operationData['mcsam']; ?>" ></td>
										 </tr>
										 <tr>
										 <?php

										 $total='0';
										 $kmm=GetPageRecord('*','operationbulletinamaster','1 and styleId="'.$editresultstyle['id'].'" and costsheetVersionId="'.$costsheetVersionId.'" and machinetype="5"');
						              while($operationMachineDat=mysqli_fetch_array($kmm)){
						              	$total+=$operationMachineDat['sam'];
						                   } ?>
										  <td>Manual SAM</td>
										 <td align="center"><input type="text" name="manualsam" id="manualsam" value="<?php echo $operationData['manualsam']; ?>" ></td>
										 </tr>
										 <tr>
										 <td>Clock Time</td>
										 <td align="center"><input onkeyup="calcoutput();" type="text" name="clocktime" id="clocktime" value="<?php echo $operationData['clocktime']; ?>"></td>
										 </tr>
										 <tr>
										 <td width="192"><div style="">

                                           Factory

										 </div>
										 </td>
										 <td width="216" align="center">
										      <?php
							 	$kr=GetPageRecord('*','linePlanMaster','1 and styleId="'.$editresultstyle['id'].'"');
								$lineData=mysqli_fetch_array($kr);

								$km=GetPageRecord('*','factoryMaster','id="'.$lineData['factoryId'].'"');
								$factotyData=mysqli_fetch_array($km);

								echo $factotyData['name'];

								?>
										 </td>
										 </tr>
										 </table>
										 </td>
										 <td width="33%">
										 <table class="table table-responsive newclass">
										 <tr>
										 <td width="192">Date</td>
										 <td width="231" align="center"><input type="text" class="operationdate" name="operationdate" id="operationdate" value="<?php if($fromDate!='' && $fromDate!='01-01-1970'){ echo $fromDate; } ?>"></td>
										 </tr>
										 <tr>
										 <td>Created By</td>
										 <td align="center"><input type="text" name="createdby" id="createdby" value="<?php echo $operationData['createdBy']; ?>"></td>
										 </tr>
										 <tr>
										 <td>PCS/Operator</td>
										 <td align="center"><input type="text" name="pcs" id="pcs" value="<?php echo $operationData['pcs']; ?>" ></td>
										 </tr>
										 <tr>
										   <td>STATUS</td>
										   <td align="center"><input name="status" id="status" type="text" value="<?php echo $operationData['status']; ?>"></td>
										   </tr>
										 <tr>
										   <td>Line</td>
										   <td align="center">
										       <?php

							 	$kk=GetPageRecord('*','linePlanMaster','1 and styleId="'.$editresultstyle['id'].'" and factoryId="'.$lineData['factoryId'].'" group by lineId desc');
								while($lineDataa=mysqli_fetch_array($kk)){
							    $lineDataa['lineId'];


								$lo=GetPageRecord('*','factoryLineMaster','id="'.$lineDataa['lineId'].'"');
								$lineName=mysqli_fetch_array($lo);

									?>
                          <span style="padding: 1px 2px; background-color: #0097a7; color: #fff; margin-right: 1px; font-size: 12px; margin-bottom:5px;display: inline-block;"><?php echo str_replace(' ','&nbsp;',$lineName['lineName']);?></span>
                          <?php


								}


								?>
										   </td>
										   </tr>
										 </table>
										 </td>
										 </tr>
										 </table>

<div class="" style="width: 100%;display: block;margin-top: 15px; margin-bottom: 15px;">

<button type="button" class="btn btn-danger" style=" float: left;" onclick="duplicateCostsheet<?php echo $costsheetVersionId; ?>();">Create Duplicate<i class="fa fa-copy ml-2" aria-hidden="true" style="margin:0px;"></i></button>

<button type="submit" class="btn btn-primary" style="margin:0px;">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;"></i></button>
</div>

<script>
$('.operationdate').Zebra_DatePicker({
format: 'd-m-Y',
});
</script>
										</div>


										<div class="col-xl-12">
			 	<div class="card mb-0 rounded-bottom-0" style="padding:15px;">
				 	<div class="panel panel-flat">
					<div class="table-responsive">
			 			<style>
.buyer-address td{
border:0px solid;
padding:0px;
}
</style>
				        <div id="add_indentmpl<?php echo $costsheetVersionId;?>">
					    <table width="100%" class="table table-bordered">

<tr class="card-body" style="background-color: #fff7b3;">
<td width="11%" align="center"><div><a style="color:#0000FF; cursor: pointer;" onClick="addNewRow<?php echo $costsheetVersionId;?>(1);"><strong>+Add&nbsp;New</strong></a></div></td>
<td width="8%" align="center"><strong>SR.</strong></td>
<td width="25%" align="center"><strong>ASSEMBLY OPERATIONS</strong></td>
<td width="6%" align="center"><strong>SAM </strong></td>
<td width="7%" align="center"><strong>Prod/Hr</strong></td>
<td width="10%" align="center"><strong>Machine&nbsp;Type</strong></td>
<td width="9%" align="center"><strong>WORK&nbsp;AIDS</strong></td>
<td width="9%" align="center"><strong>Opr&nbsp;Req</strong></td>
<td width="13%" align="center"><strong>ROUND&nbsp;OFF</strong></td>
</tr>

				<tbody id="addrow<?php echo $costsheetVersionId;?>"></tbody>

				<script>

				function addNewRow<?php echo $costsheetVersionId;?>(id){
					var target = $('#target').val();
					var clocktime = $('#clocktime').val();
				if(id==1){
				$("#addrow<?php echo $costsheetVersionId;?>").load('loadoperationbulletin.php?add=1&styleId=<?php echo encode($lastId); ?>&costsheetVersionId=<?php echo $costsheetVersionId; ?>&target='+target+'&clocktime='+clocktime);
				}else{
				$("#addrow<?php echo $costsheetVersionId;?>").load('loadoperationbulletin.php?styleId=<?php echo encode($lastId); ?>&costsheetVersionId=<?php echo $costsheetVersionId; ?>&target='+target+'&clocktime='+clocktime);
				}

				}
				addNewRow<?php echo $costsheetVersionId; ?>(0);

				function deleteRow<?php echo $costsheetVersionId; ?>(id){
				var checkyes = confirm('Are your sure you you want to delete?');
				if(checkyes==true){
				$('#addrow<?php echo $costsheetVersionId; ?>').load('loadoperationbulletin.php?id='+id+'&deletestatus=yes&styleId=<?php echo encode($lastId); ?>&costsheetVersionId=<?php echo $costsheetVersionId; ?>');
				}
				}

				function calcoutput(){
					var clocktime = $('#clocktime').val();
					var efficiency = $('#efficiency').val();
					var totalsam = $('#totalsam').val();
					var manualsam = $('#manualsam').val();
					var workplaces = $('#workplaces').val();
					var mcsam = Number(totalsam - manualsam);
					var outpt = Math.round((clocktime*(efficiency/100)*workplaces)/totalsam);
					var pcs = Math.round(outpt/workplaces);
					//$('#output').val(outpt);
					$('#mcsam').val(mcsam);
					//$('#pcs').val(pcs);
			    	}
				</script>

                        </table>
						</div>
					  </div>
					</div>
				  </div>
				 </div>

									 <div class="col-xl-12">
			 	<div class="card mb-0 rounded-bottom-0" style="padding: 15px; width: 100%;">
				 	<div class="panel panel-flat">
					<div class="table-responsive">
			 			<table width="100%" class="table table-bordered table-responsive" style="margin-bottom:5px;">
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body">
                                <td width="100%" style="text-align:center;"><strong style="font-size:23px;">MACHINE  SUMMARY</strong></td>

                            </tr>
                          </tbody>
                        </table>
						<style>
.buyer-address td{
border:0px solid;
padding:0px;
}
</style>

<div class="btn-group justify-content-center" style="width: fit-content; float: left; padding: 10px 0px; margin: 0px; display: none;" id="deactivatebtnpurchasemerchant">

<a onclick="opmodalpop('Assign To Sourcing','modalpop.php?action=assigntosoursingteam&styleId=<?php echo $_GET['styleid']; ?>&costsheetVersionId=1','400px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-teal-400" aria-expanded="false" style="border-radius: 2px; background-color: #0d7544; margin: 0px !important; padding: 5px 10px; font-size: 12px; font-weight: 500;"><i class="fa fa-plus" aria-hidden="true"></i> Assign To</a>

</div>

				        <div id="add_indentmpl">
					    <table width="102%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered table-responsive forbom summaryfinal" id="tableid11" style="display:block; overflow:hidden;">
                          <tbody style="width: 100%;display: inline-table;">

						  <?php
						  $totalfinal=0;
						  $sNoo=0;
						$km=GetPageRecord('*','operationbulletinamaster','1 and styleId="'.$editresultstyle['id'].'" and costsheetVersionId="'.$costsheetVersionId.'" group by machinetype');
						while($operationMachineData=mysqli_fetch_array($km)){

$kmmmmmm=GetPageRecord('sum(roundoff) as totalroundoff','operationbulletinamaster','1 and styleId="'.$editresultstyle['id'].'" and costsheetVersionId="'.$costsheetVersionId.'" and machinetype="'.$operationMachineData['machinetype'].'"');
$countroundtoal=mysqli_fetch_array($kmmmmmm);

						$kkkkkk=GetPageRecord('*','machineMaster','1 and id="'.$operationMachineData['machinetype'].'"');
		                $machineDatamain=mysqli_fetch_array($kkkkkk);

						?>
                          <tr class="card-body">
								<td width="4%"><?php echo ++$sNoo; ?></td>
								<td width="13%" align="left"><?php echo $machineDatamain['name']; ?></td>
								<td width="37%" align="right">&nbsp;</td>
								<td width="38%" align="left"><?php echo $machineDatamain['description']; ?></td>
								<td width="8%" align="right"><?php echo round($countroundtoal['totalroundoff']);$totalfinal=$totalfinal+$countroundtoal['totalroundoff']; ?></td>
					        </tr>
						<?php } ?>

							<tr class="border-top-info" style="font-weight: 500; font-size: 13px; background-color: #9aabff; color:#fff;">
							<th colspan="3" align="right"><div align="right"> </div>							  <div align="right"> </div>							  <div align="right"></div></th>
							<th align="left">TOTAL</th>
							<th><div align="right"><?php echo round($totalfinal); ?></div></th>
							</tr>
                          </tbody>
                        </table>
						</div>
					  </div>
					</div>
				  </div>



				 </div>


										</div>
									    </form>
									</div>

										<script>
										function duplicateCostsheet<?php echo $costsheetVersionId; ?>(){
										var r = confirm("Are you sure you want to create duplicate?");
										if (r == true) {
										$('.opId').val(1);
										$( "#operationbulletinFormV<?php echo $costsheetVersionId; ?>" ).submit();
										}
										}
										</script>

										<script>
										function showfobbydefault<?php echo $costsheetVersionId;?>(){
										var showfobdefault = $('#showfobdefault<?php echo $costsheetVersionId;?>').css('display');
										if(showfobdefault=='block'){
										$('#showfobdefault<?php echo $costsheetVersionId;?>').css('display','none');
										} else {
										$('#showfobdefault<?php echo $costsheetVersionId;?>').css('display','block');
										}
										}
										</script>
								</div>
							</div>

			</div>

			   <?php } ?>
           </div>

  </div> </div>

<style>
.newclass tr td{
border:1px solid #ccc !important;
}
.table td, .table th {
    vertical-align: middle !important;
}
.newclass input{
padding:0px 5px;
width:120px;
text-align:center;
}
.summaryfinal tr td{
border:0px !important;
}
.card-title a:hover .card-body{
background-color: #f2ffff !important;
}
.table-bordered td, .table-bordered th {
    border: 1px solid #ddd !important;
}
</style>
<?php
ob_start();
include "inc.php";
$assignto='download';
$select='*';


///echo decode($_GET['styleid']); die();


$where='id="'.decode($_GET['styleid']).'"';
$rs=GetPageRecord($select,'queryMaster',$where);
$editresultstyle=mysqli_fetch_array($rs);

header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment; filename=\"".$assignto."_".date('d-m-Y-H-i-s').".xls");
header("Cache-control: private");

?>


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
                          <?php
                          $costsheetVersionId='0';
						  $where='1';
                          $rs=GetPageRecord('*', 'operationbulletinentry','1 and styleId="'.decode($_GET['styleid']).'"');
                          $operationData=mysqli_fetch_array($rs);
						  ?>



    	<h3 class="card-title" style="margin:0px;">
										<a onclick="showfobbydefault<?php echo $costsheetVersionId;?>();"> Operation Bulletin - <?php echo $resListingVer['versionName']; ?> - <?php echo date('d M, Y - h:ia',$resListingVer['dateAdded']); ?></a>
										</h3>
	   <br>
	                                         <div>
										  <table style="background-color: #ffffff; margin-bottom: 0;  border:1px solid black; width:1650px;">
										  <tr>
										  <td width="33%">
										  <table class="table table-responsive newclass">
										  <tr>
										  <td width="192">Target</td>
										  <td width="216" align="center"><?php echo $operationData['target']; ?></td>
										  </tr>
										 <tr>
										 <td>Output</td>
										 <td align="center"><?php echo $operationData['output']; ?></td>
										 </tr>
										 <tr>
										 <td>Efficiency(%)</td>
										 <td align="center"><?php echo $editresultstyle['efficiency']; ?></td>
										 </tr>
										 <tr>
										 <td>NO.OF WORK PLACES</td>
										 <td align="center"><?php echo $operationData['workplaces']; ?></td>
										 </tr>
										 <tr>
										 <td>SEWING M/C</td>
										 <td align="center"><?php echo $operationData['sewingmc']; ?></td>
										 </tr>
										 </table>
										 </td>
										 <td width="33%">
										 <table class="table table-responsive newclass">

										 <tr>
										 <td>Total SAM</td>
										 <td align="center"><?php echo $operationData['totalsam']; ?></td>
										 </tr>
										 <tr>
										 <td>M/C SAM</td>
										 <td align="center"><?php echo $operationData['mcsam']; ?></td>
										 </tr>
										 <tr>
										 	<?php
										 $total='0';
										 $kmm=GetPageRecord('*','operationbulletinamaster','1 and styleId="'.$editresultstyle['id'].'" and costsheetVersionId="'.$costsheetVersionId.'" and machinetype="5"');
						              while($operationMachineDat=mysqli_fetch_array($kmm)){
						              	$total+=$operationMachineDat['sam'];
						                   } ?>
										 <td>Manual SAM</td>
										 <td align="center"><?php echo $total; ?></td>
										 </tr>
										 <tr>
										 <td>Clock Time</td>
										 <td align="center"><?php echo $operationData['clocktime']; ?></td>
										 </tr>
										 	 <tr>
										 <td width="192"><div style="">

                                           Factory

										</div></td>
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
										 <td width="231" align="center"><?php if($fromDate!='' && $fromDate!='01-01-1970'){ echo $fromDate; } ?></td>
										 </tr>
										 <tr>
										 <td>Created By</td>
										 <td align="center"><?php echo $operationData['createdBy']; ?></td>
										 </tr>
										 <tr>
										 <td>PCS/Operator</td>
										 <td align="center"><?php echo $operationData['pcs']; ?></td>
										 </tr>
										 <tr>
										   <td>STATUS</td>
										   <td align="center"><?php echo $operationData['status']; ?></td>
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
										 </div>
										  <br>

										  <table width="100%" class="table table-bordered" style="border:1px solid black">

<tr class="card-body" style="background-color: #fff7b3;">

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
<?php
$sNo2 = 0;
$totalsam=0;
$totaloprreq=0;
$select='';
$where='';
$rs='';
$select='*';
 $where=' styleId="'.decode($_GET['styleid']).'" and costsheetVersionId="'.$editresultstyle['defaultcostsheetVersionId'].'" and status=1 and deletestatus=0 order by id asc';
$rs=GetPageRecord($select,'operationbulletinamaster',$where);
$counttotal = mysql_num_rows($rs);
while($resListing1=mysqli_fetch_array($rs)){

$sNo2++;
$totalsam=$totalsam+$resListing1['sam'];
$totaloprreq=$totaloprreq+$resListing1['oprreq'];
$totalroundoff=$totalroundoff+$resListing1['roundoff'];

?>


       <tr class="card-body">


		<td width="2%" align="center"><?php echo $sNo2; ?></td>
		<?php
		$kk=GetPageRecord('*','assemblyoperationsMaster','1 and id="'.$resListing1['particular'].'" order by name asc');
		$assemData=mysqli_fetch_array($kk);?>

	    <td width="19%" align="center"><?php echo stripslashes($assemData['name']); ?></td>



		 <td width="19%" align="center"><?php echo stripslashes($resListing1['sam']); ?></td>
		 <td width="19%" align="center"><?php echo stripslashes($resListing1['prodhrs']); ?></td>

	     <?php
		$kk1=GetPageRecord('*','machineMaster','1 and  id="'.$resListing1['machinetype'].'"');
		$mach=mysqli_fetch_array($kk1);

		?>

	     <td width="19%" align="center"><?php echo $mach['name']; ?></td>


		<script>
				function loadmachineData<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>(){

				var particular = $('#particular<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>').val();
				$('#machinetype<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>').load('loadmachine.php?id='+particular+'&selectId=<?php echo $resListing1['machinetype']; ?>');
				}
				var particular = $('#particular<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>').val();
				if(particular!=''){
				loadmachineData<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>();
				}
		</script>

		 <td width="19%" align="center"><?php echo $resListing1['workads']; ?></td>
		 <td width="19%" align="center"><?php echo $resListing1['oprreq']; ?></td>
		 <td width="19%" align="center"><?php echo $resListing1['roundoff']; ?></td>


  </tr>

  <?php } ?>

                        </table>
						</div>
					  </div>
				  </div>
				  </div>
				  </div>

				   <div class="col-xl-12">
			 	  <div class="card mb-0 rounded-bottom-0" style="padding: 15px; width: 100%;">
				 	<div class="panel panel-flat">
				 	    <center><h3>MACHINE SUMMARY</h3></center>
					<div class="table-responsive">
			 			<!--<table width="100%" class="table table-bordered table-responsive" style="margin-bottom:5px;">-->
       <!--                   <tbody style="width: 100%;display: inline-table;">-->
       <!--                     <tr class="card-body">-->
       <!--                     <center><td width="100%">MACHINE SUMMARY</td></center>-->

       <!--                     </tr>-->
       <!--                   </tbody>-->
       <!--                   </table> -->
						<style>
.buyer-address td{
border:0px solid;
padding:0px;
}
</style>

<div class="btn-group justify-content-center" style="width: fit-content; float: left; padding: 10px 0px; margin: 0px; display: none;" id="deactivatebtnpurchasemerchant">

<a onclick="opmodalpop('Assign To Sourcing','modalpop.php?action=assigntosoursingteam&styleId=<?php echo $_GET['styleid']; ?>&costsheetVersionId=1','400px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-teal-400" aria-expanded="false" style="border-radius: 2px; background-color: #0d7544; margin: 0px !important; padding: 5px 10px; font-size: 12px; font-weight: 500;"><i class="fa fa-plus" aria-hidden="true"></i></a>

</div>

				         <div id="add_indentmpl">
					     <table border="0" cellpadding="0" cellspacing="0" class="table table-bordered table-responsive forbom summaryfinal" id="tableid11" style="display:block; overflow:hidden; border:1px solid black;">
                          <tbody style="display: inline-table;">
                          <?php
						  $totalfinal=0;
						  $sNoo=0;
						$km=GetPageRecord('*','operationbulletinamaster','1 and styleId="'.decode($_GET['styleid']).'"  group by machinetype');
						while($operationMachineData=mysqli_fetch_array($km)){

							//echo decode($_GET['styleid']);

 $kmmmmmm=GetPageRecord('sum(roundoff) as totalroundoff','operationbulletinamaster','1 and styleId="'.decode($_GET['styleid']).'" and costsheetVersionId="2"  and machinetype="'.$operationMachineData['machinetype'].'"');
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
                        <?php } ?>
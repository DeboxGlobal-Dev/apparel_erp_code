<?php
if($loginuserprofileId==1 || $loginuserprofileId==93){

$wheresearchassign=' 1 and ';

} else {

if($loginuserprofileId==92){

$wheresearchassign=' 1 and finalstatus="2" and assignTo in (select id from '._USER_MASTER_.' where empId in (select id from employeeMaster where reportingTo='.$_SESSION['empid'].')) or assignTo="'.$_SESSION['userid'].'" and ';
} else{

$wheresearchassign=' ( id in (select styleId from styleAssignmentMaster where assignTo="'.$_SESSION['userid'].'" and styleAssignTo=0 and statusId in (19,21)))';

$wheresearchassign=' '.$wheresearchassign.' and ';

}

}

?>
<div class="page-content">
<style>
.even{
background-color: #0097a71a;
}
</style>

		<!-- Main sidebar -->
		<?php include "left.php"; ?>
		<div class="content-wrapper">

		<!---Save Alert Notification---->
		<?php include "savealert.php"; ?>



			<div class="content pt-0" style="margin-top:20px;">

				<div class="row">
				<div class="col-xl-12">

				<div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
						<div class="col-xl-9"><h5 class="card-title"><?php echo $pageName; ?></h5></div>
						 <div class="col-xl-3" style="padding-right: 0px;"><div class="btn-group justify-content-center" style="float:right;">
 						 </div></div>
				  </div>



				<div class="card">
				<!--<form name"search" method="GET">
				<div class="row" style="padding:20px;">
						<div class="col-md-3">
						  <div class="">
								<select name="factoryId" id="factoryId" class="form-control">
									<option value="1">Factory 105FF</option>
									<option value="2">Factory 102</option>
								</select>
							</div>
						</div>
					<script>
					$(function(){
						$( "#fromDate" ).datepicker();
					});
					$(function(){
						$( "#toDate" ).datepicker();
					});
					</script>

						<div class="col-md-3" >
							<div class="">
								<input name="fromDate" type="text" class="form-control" id="fromDate" value="<?php if($editresult['fromDate']!=''){ echo date('d-m-Y', strtotime($editresult['fromDate'])); }else{ echo date('d-m-Y'); } ?>">
							</div>
						</div>

						<div class="col-md-3" >
							<div class="">
								<input name="toDate" type="text" class="form-control" id="toDate" value="<?php if($editresult['toDate']!=''){ echo date('d-m-Y', strtotime($editresult['toDate'])); }else{ echo date('d-m-Y'); } ?>">
							</div>
						</div>

						<div class="col-md-2">
							<div class="">
								<input name="search" type="button" class="btn bg-teal-400" id="search" value="Search">
							</div>
						</div>
				  </div>
				</form>-->




				  <table cellspacing="0" cellpadding="0" border="1" class="table table-responsive">

                  <tr style="background-color:#ffffcc;color: #000;">
                      <td colspan="6" align="center" >&nbsp;</td>
                      <td colspan="6" align="center" ><strong>Cutting</strong></td>
					   <td colspan="6" align="center" ><strong>Embroidery</strong></td>
					   <td colspan="6" align="center" ><strong>Printing</strong></td>
					   <td colspan="6" align="center" ><strong>Sewing</strong></td>
                      <td colspan="6" align="center" ><strong>Finishing</strong></td>
                      <td colspan="6" align="center" ><strong>Packing</strong></td>
                      <td colspan="7" align="center" ><strong>Shipment</strong></td>
                    </tr>
                    <tr style="background-color: #e2e1e1;font-weight: 500;">
                     <!-- <td align="center">SrNo</td>-->
                      <td align="center">Buyer</td>
                      <td align="center">Style</td>
                      <td align="center">Style&nbsp;Description</td>
                      <td align="center"><div style="width: 78px;">Color&nbsp;-&nbsp;Size</div></td>
                      <td align="center">Order&nbsp;Qty</td>
                      <td  align="center">Order&nbsp;Qty%</td>
                      <td  align="center">Today&nbsp;Rec.</td>
                      <td  align="center">Till&nbsp;Date&nbsp;Rec.</td>
                      <td  align="center">Bal</td>
                      <td  align="center">Today&nbsp;Sent</td>
                      <td  align="center">TTL&nbsp;Sent</td>
                      <td  align="center">WIP</td>
					  <td  align="center">Today&nbsp;Rec.</td>
                      <td  align="center">Till&nbsp;Date&nbsp;Rec.</td>
                      <td  align="center">Bal</td>
                      <td  align="center">Today&nbsp;Sent</td>
                      <td  align="center">TTL&nbsp;Sent</td>
                      <td  align="center">WIP</td>
					  <td  align="center">Today&nbsp;Rec.</td>
                      <td  align="center">Till&nbsp;Date&nbsp;Rec.</td>
                      <td  align="center">Bal</td>
                      <td  align="center">Today&nbsp;Sent</td>
                      <td  align="center">TTL&nbsp;Sent.</td>
                      <td  align="center">WIP</td>
                      <td  align="center">Today&nbsp;Rec.</td>
                      <td  align="center">Till&nbsp;Date&nbsp;Rec.</td>
                      <td  align="center">Bal</td>
					  <td  align="center">Today&nbsp;Sent</td>
					  <td  align="center">TTL&nbsp;Sent</td>
					  <td  align="center">WIP</td>
                      <td  align="center">Today&nbsp;Rec.</td>
                      <td  align="center">Till&nbsp;Date&nbsp;Rec.</td>
                      <td  align="center">Bal</td>
                      <td  align="center">Today&nbsp;Sent</td>
                      <td  align="center">TTL&nbsp;Sent</td>
                      <td  align="center">WIP</td>
                      <td  align="center">Today&nbsp;Rec.</td>
                      <td  align="center">Till&nbsp;Date&nbsp;Rec.</td>
                      <td  align="center">Bal</td>
                      <td  align="center">Today&nbsp;Sent</td>
                      <td  align="center">TTL&nbsp;Sent</td>
                      <td  align="center">WIP</td>
                      <td  align="center">Today&nbsp;Rec.</td>
                      <td  align="center">Till&nbsp;Date&nbsp;Rec.</td>
                      <td  align="center">Bal</td>
                      <td  align="center">Today&nbsp;Sent</td>
                      <td  align="center">TTL&nbsp;Sent</td>
                      <td  align="center">WIP</td>
					  <td  align="center">Shipped</td>
                    </tr>
					<?php
					$subtotal = 0;
					$grandpototal = 0;
					$grandpototalper = 0;
					$no=1;
					$select='*';
					$where='';
					$rs='';
					$wheresearch='';
					$limit='25';
					$where='where 1 and articleNo!="" and description!="" order by id desc';
					$page=$_GET['page'];
					$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&';
					$rs=GetRecordList($select,'purchaseOrderStyleMaster',$where,$limit,$page,$targetpage);
					$totalentry=$rs[1];
					$paging=$rs[2];
					while($resultlists=mysqli_fetch_array($rs[0])){

					$chaalanTotal=GetPageRecord('*','chaalanMaster','styleId="'.$resultlists['styleId'].'"');
				 	$chaalanTotalList=mysqli_fetch_array($chaalanTotal);
					if($chaalanTotalList['styleId']!=0){

					$poOrderQty=0;
					$poOrderQtyper=0;
					$rsListsize=GetPageRecord('*','purchaseOrderStyleMaster','parentId="'.$resultlists['id'].'"');
					$count=mysql_num_rows($rsListsize);
					while($rsListordersize=mysqli_fetch_array($rsListsize)){
					$styleId = $rsListordersize['styleId'];

					$rscolor=GetPageRecord('*','colorCardMaster','id="'.$rsListordersize['color'].'"');
					$rscolorname=mysqli_fetch_array($rscolor);

					?>

                     <tr align="left">
                     <!-- <td ><?php echo $no; ?></td>-->
                      <td ><div style="width:80px;"><?php
						$rsstatus=GetPageRecord('*','queryMaster','id="'.$styleId.'"');
						$result=mysqli_fetch_array($rsstatus);

						$select1='*';
						$where1='id="'.$result['buyerId'].'"';
						$rs1=GetPageRecord($select1,_BUYER_MASTER_,$where1);
						$resultlist1=mysqli_fetch_array($rs1);
						echo $resultlist1['name'];
						?></div>

					 </td>
                      <td >	<?php echo '#'.getStyleRefId($styleId);?> </td>

					<td><?php echo getCategoryName($result['categoryId']).' '.getSubCategoryName($result['subCategoryId']); ?></td>
					<td><?php if($rsListordersize['color']!=''){ echo $rscolorname['name'].' - '.$rsListordersize['size']; } ?></td>
					 <td><?php $poOrderQty = $poOrderQty+$rsListordersize['gdQty']; echo $rsListordersize['gdQty']; ?></td>
					<td><?php $poOrderQtyper = $poOrderQtyper+$rsListordersize['gdQty']; echo $rsListordersize['gdQty']; ?></td>
					<td>100</td>
					<td>200</td>
					<td>100</td>
					<td>100</td>
					<td>
					<?php
					$todaysewing=GetPageRecord('sum(quantity) as todaysewqty','chaalanMaster','styleId="'.$styleId.'" and color="'.$rsListordersize['color'].'" and size="'.$rsListordersize['size'].'"  and chaalanDate="'.date('Y-m-d').'" and parentId in (select id from chaalanMaster where departmentId=13) ');
				 	$resulttodaysewing=mysqli_fetch_array($todaysewing);
					echo $resulttodaysewing['todaysewqty'];
					?>
					</td>
					<td><?php
					$totalsew=GetPageRecord('sum(quantity) as totalsewqty','chaalanMaster','styleId="'.$styleId.'" and color="'.$rsListordersize['color'].'" and size="'.$rsListordersize['size'].'" and parentId in (select id from chaalanMaster where departmentId=13) ');
					$totalsewqty=mysqli_fetch_array($totalsew);
					echo $totalsewqty['totalsewqty'];
					?></td>
					<td>
					<?php
					$balsew=GetPageRecord('sum(quantity) as balsewqty','chaalanMaster','styleId="'.$styleId.'" and color="'.$rsListordersize['color'].'" and size="'.$rsListordersize['size'].'" and parentId in (select id from chaalanMaster where departmentId=13) ');
				 	$balsewqty=mysqli_fetch_array($balsew);
					if($balsewqty['balsewqty']!=''){ echo $rsListordersize['gdQty']-$balsewqty['balsewqty']; }

					?>
					</td>

					<td><?php
					$totalfinish = GetPageRecord('sum(quantity) as totalfinishqty','chaalanMaster','styleId="'.$styleId.'" and color="'.$rsListordersize['color'].'" and size="'.$rsListordersize['size'].'" and parentId in (select id from chaalanMaster where departmentId=14) ');
					$totalfinishqty=mysqli_fetch_array($totalfinish);
					echo $totalsewqty['totalsewqty']-$totalfinishqty['totalfinishqty'];
					?></td>

                    <td>
					<?php
					$todaytotalfinish = GetPageRecord('sum(quantity) as todaytotalfinishqty','chaalanMaster','styleId="'.$styleId.'" and color="'.$rsListordersize['color'].'" and size="'.$rsListordersize['size'].'" and chaalanDate="'.date('Y-m-d').'" and parentId in (select id from chaalanMaster where departmentId=14) ');
					$todaytotalfinishqty=mysqli_fetch_array($todaytotalfinish);
					echo $todaytotalfinishqty['todaytotalfinishqty'];
					?>
					</td>
                    <td><?php echo $totalfinishqty['totalfinishqty']; ?></td>
                    <td><?php echo $rsListordersize['gdQty']-$totalfinishqty['totalfinishqty']; ?></td>
                    <td>
					  <?php
					$totalpacking = GetPageRecord('sum(quantity) as totalpackqty','chaalanMaster','styleId="'.$styleId.'" and color="'.$rsListordersize['color'].'" and size="'.$rsListordersize['size'].'" and parentId in (select id from chaalanMaster where departmentId=15) ');
					$totalpackingqty=mysqli_fetch_array($totalpacking);
					echo $totalfinishqty['totalfinishqty']-$totalpackingqty['totalpackqty'];
					?>
					  </td>
                      <td><?php
					$todaypacking = GetPageRecord('sum(quantity) as todaypackqty','chaalanMaster','styleId="'.$styleId.'" and color="'.$rsListordersize['color'].'" and size="'.$rsListordersize['size'].'" and chaalanDate="'.date('Y-m-d').'" and parentId in (select id from chaalanMaster where departmentId=15) ');
					$todaypackingqty=mysqli_fetch_array($todaypacking);
					echo $todaypackingqty['todaypackqty'];
					?></td>
                      <td><?php echo $totalpackingqty['totalpackqty']; ?> </td>
                      <td><?php echo  $rsListordersize['gdQty']-$totalpackingqty['totalpackqty']; ?></td>
                      <td><?php
					$totalship = GetPageRecord('sum(quantity) as totalshipqty','chaalanMaster','styleId="'.$styleId.'" and color="'.$rsListordersize['color'].'" and size="'.$rsListordersize['size'].'" and parentId in (select id from chaalanMaster where departmentId=17) ');
					$totalshipqty=mysqli_fetch_array($totalship);
					echo $totalpackingqty['totalpackqty']-$totalshipqty['totalshipqty'];
					?></td>

					  <td><?php
					$todayship = GetPageRecord('sum(quantity) as todayshipqty','chaalanMaster','styleId="'.$styleId.'" and color="'.$rsListordersize['color'].'" and size="'.$rsListordersize['size'].'" and chaalanDate="'.date('Y-m-d').'" and parentId in (select id from chaalanMaster where departmentId=17) ');
					$todayshipqty=mysqli_fetch_array($todayship);
					echo $todayshipqty['todayshipqty'];
					?></td>
                      <td><?php echo $totalshipqty['totalshipqty']; ?></td>
                      <td><?php echo  $rsListordersize['gdQty']-$totalshipqty['totalshipqty']; ?></td>
                      <td></td>
					  <td></td>
                    </tr>



					<?php  } ?>

					  <tr align="left" height="20" style="background-color:#FFFFCC; font-weight:500;">
                      <td height="20">&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>Sub&nbsp;Total</td>
                      <td><?php $grandpototal = $grandpototal+$poOrderQty; echo $poOrderQty; ?></td>
                      <td><?php $grandpototalper = $grandpototalper+$poOrderQtyper; echo $poOrderQtyper; ?></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
					   <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
					   <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>

					<?php  } $no++; } ?>



					<tr align="left" height="20" style="background-color:#3399FF; font-weight:500;">
                      <td height="20">&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td style="color:#fff;">Total</td>
                      <td style="color:#fff;"><?php echo $grandpototal; ?></td>
                      <td style="color:#fff;"><?php echo $grandpototalper; ?></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
					   <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
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

				</div>


				</div></div>




		  </div>
				<!-- /dashboard content -->

  </div>
			<!-- /content area -->


			<!-- Footer -->

			<!-- /footer -->

</div>
		<!-- /main content -->

	</div>

<style>
.liststyleimg{
	float: left;
    width: 70px;
    margin-right: 15px;
    padding: 5px;
    border: 2px solid #e6e6e6;}

.badge.dropdown-toggle:after { display:none;
}
.table td, .table th, .table tr {
    padding: 5px;
    transition: background-color ease-in-out .15s;
}

</style>

<script>
$('#DataTables_Table_2').DataTable( {
"order": [[ 0, "desc" ]]
} );
</script>


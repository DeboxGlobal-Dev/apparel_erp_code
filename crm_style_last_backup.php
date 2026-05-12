<div class="page-content">

		<!-- Main sidebar -->
		<?php include "left.php"; ?>
		<div class="content-wrapper">

			<div class="content pt-0" style="margin-top:20px;">

				<div class="row">


				<div class="col-xl-12">
				<div class="card-header header-elements-inline bg-info-700">
						<div class="col-xl-9"><h5 class="card-title"><?php echo $pageName; ?></h5></div>
						 <div class="col-xl-3" style="    padding-right: 0px;"><div class="btn-group justify-content-center" style="float:right;">
 <a href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes" class="btn bg-teal-400" aria-expanded="false" style="    background-color: #03d873b8;"><i class="fa fa-plus" aria-hidden="true"></i> Create New</a>

							</div></div>
					</div>
				<div class="card">

				<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"> <div class="datatable-scroll"><table class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
						<thead>
							<tr role="row" style="display:none;">
							  <th colspan="1" rowspan="1" align="left" class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_2" aria-sort="ascending" aria-label="First Name: activate to sort column descending">Name</th>
						  </tr>
						</thead>
						<tbody>

						<?php

$no=1;
$select='*';
$where='';
$rs='';
$wheresearch='';
$limit='20000';

$where='where  subject!="" order by id desc';
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
$rs=GetRecordList($select,_QUERY_MASTER_,$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

$selectimg='*';
$whereimg='parentId="'.$resultlists['id'].'" order by id asc';
$rsimg=GetPageRecord($selectimg,'imageGallery',$whereimg);
$imgresult=mysqli_fetch_array($rsimg);
?>

						<tr role="row" class="odd">
								<td width="60%" align="left" class="sorting_1" style="padding:0px;"><div class="card border-left-3 border-left-danger rounded-left-0" style="margin-bottom: 0px;">
									<div class="card-body">
										<div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
										<div class="liststyleimg"><a href="showpage.crm?module=style&view=yes&id=<?php echo encode($resultlists['id']); ?>"><img src="images/<?php if($imgresult['attachmentImage']!=''){?><?php echo $imgresult['attachmentImage']; ?><?php }else{ ?>noimage.png<?php } ?>" width="100%"  ></a></div>
											<div style=" float:left; width:45%;">
												<h6 class="font-weight-semibold"><a href="showpage.crm?module=style&view=yes&id=<?php echo encode($resultlists['id']); ?>"><?php echo clean($resultlists['subject']); ?></a></h6>
												<ul class="list list-unstyled mb-0">
													<li>ID #: <span class="font-weight-semibold"><a href="#"><?php echo makeQueryId($resultlists['displayId']); ?>
	<?php if(countQueryunreadMails($resultlists['id'])!=0){ ?><div class="numberbubbol"><?php echo countQueryunreadMails($resultlists['id']); ?></div><?php } ?>
	</a></span></li>
													<li>Category: <span class="font-weight-semibold"><?php
													$select1='*';
 													$where1='id="'.$resultlists['categoryId'].'"';
													$rs1=GetPageRecord($select1,_CATEGORY_MASTER_,$where1);
													$resultlist1=mysqli_fetch_array($rs1);
													echo $resultlist1['name'];
													?>
													</span></li>
												</ul>
											</div>
											<div style=" float:left;  ">
											<div class="text-sm-left mb-0 mt-3 mt-sm-0 ml-auto">
												<h6 class="font-weight-semibold">Department:
												<?php
													$select1='*';
 													$where1='id="'.$resultlists['departmentId'].'"';
													$rs1=GetPageRecord($select1,_DEPARTMENT_MASTER_,$where1);
													$resultlist1=mysqli_fetch_array($rs1);
													echo $resultlist1['name'];
													?>
												</h6>
												<ul class="list list-unstyled mb-0">
													<li>Assign To: <span class="font-weight-semibold"><?php echo getUserName($resultlists['assignTo']); ?></span></li>
													<li class="dropdown">
														Status: &nbsp;
														<a href="#" class="badge bg-danger-400 align-top dropdown-toggle" >
	<?php if($resultlists['queryStatus']==20){ ?>
	<div class="lossquery">Cancelled</div>
	<?php } else { ?>
	 <?php
$result =mysql_query ("select * from "._PAYMENT_REQUEST_SECTION_MASTER_." where queryid='".$resultlists['id']."' and deletestatus!=1")  or die(mysql_error());
$number =mysql_num_rows($result);
$getpaymentid=mysqli_fetch_array($result);
if($number>0)
{
?>
<?php /*?><div class="wonquery" <?php if($getpaymentid['status']==0){ ?>style="background-color:#CC3300;"<?php } ?>><?php if($getpaymentid['status']==0){ echo 'Unpaid'; } else { echo 'Paid'; } ?></div><?php */?>
		<div class="wonquery" <?php if($getpaymentid['supplierPendingamount']>0){ ?>style="background-color:#CC3300;"<?php } ?>><?php if($getpaymentid['supplierPendingamount']>0){ echo 'Unpaid'; } else { echo 'Paid'; } ?></div>

	<?php } else { ?>
	<?php


	if($resultlists['queryStatus']==6){ echo '<div class="assignquery">Assigned</div>'; }if($resultlists['queryStatus']==7){ echo '<div class="assignquery">Follow-up</div>'; }if($resultlists['queryStatus']==1 || $resultlists['queryStatus']==10){ if($resultlists['queryStatus']==1){ echo '<div class="assignquery">Assigned</div>'; }  if($resultlists['queryStatus']==10){ echo '<div class="assignquery">Created</div>'; }} if($resultlists['queryStatus']==2){ echo '<div class="revertquery">Reverted</div>'; } if($resultlists['queryStatus']==3){ echo '<div class="wonquery">Confirmed</div>'; } if($resultlists['queryStatus']==4){ echo '<div class="lossquery">Lost</div>'; } if($resultlists['queryStatus']==5){ echo '<div class="closequery">Time Limit Booking</div>'; }  if($resultlists['queryStatus']==0){ echo '<div class="assignquery">Assigned</div>'; }  ?>
	<?php } ?>
	<?php } ?>	</a>

													</li>
												</ul>
											</div>
											</div>


											<div class="text-sm-right mb-0 mt-3 mt-sm-0 ml-auto">

												<ul class="list list-unstyled mb-0">
													<li>
													<a href="showpage.crm?module=style&view=yes&id=<?php echo encode($resultlists['id']); ?>"><button type="button" class="btn btn-success btn-labeled btn-labeled-left btn-sm"><b><i class="fa fa-eye" aria-hidden="true" style="    font-size: 16px;"></i></b> View</button></a></li>
													 <li><a href="showpage.crm?module=style&edit=yes&id=<?php echo encode($resultlists['id']); ?>"><button type="button" class="btn btn-danger btn-labeled btn-labeled-left btn-sm"><b><i class="fa fa-pencil" aria-hidden="true" style="    font-size: 16px;"></i></b>&nbsp;Edit&nbsp;</button></a></li>
												</ul>
											</div>
										</div>
									</div>


								</div></td>
						        <td width="0%" style="display:none;"></td>
						        <td width="0%" style="display:none;"></td>
						        <td width="0%" style="display:none;"></td>
								<td width="0%" style="display:none;"></td>
								<td width="0%" style="display:none;"> </td>
						  </tr>


							<?php $no++; } ?>
					  </tbody>
					</table>
					</div></div>

 </div></div></div>




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
 .liststyleimg{float: left;
    width: 70px;
    margin-right: 15px;
    padding: 5px;
    border: 2px solid #e6e6e6;}

	.badge.dropdown-toggle:after { display:none;
}
 </style>
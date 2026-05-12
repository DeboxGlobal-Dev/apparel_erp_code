<div class="page-content">
<style>
.even{
background-color: #0097a71a;
}
</style>
		<!-- Main sidebar -->
		<?php include "left.php"; ?>
		<div class="content-wrapper">

		<div class="page-header page-header-light border-bottom-0">

				<!-- Page header content -->
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4><span class="font-weight-semibold">&nbsp;&nbsp;&nbsp;</span>Messages</h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>

					<div class="header-elements d-none">
						<div class="d-flex justify-content-center">
						<div class="btn-group justify-content-center" style="float:right;">
						<?php if($addpermission==1){ ?>
 <a href="#"  onclick="opmodalpop(' Add Broadcast','modalpop.php?action=<?php echo $_GET['module']; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-teal-400" aria-expanded="false" style="background-color: #03d873b8;"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
							 <?php } ?>
						</div>
						</div>
					</div>
				</div>
				<!-- /page header content -->



			</div>

			<div class="content pt-0" style="margin-top:20px;">
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
$rs=GetRecordList($select,'timelineMaster',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

?>


				<div class="d-flex align-items-start flex-column flex-md-row">

					<!-- Left content -->
					<div class="tab-content w-100 overflow-auto order-2 order-md-1">

						<div class="tab-pane fade active show" id="activity">

							<!-- Timeline -->
							<div class="timeline timeline-left">
								<div class="timeline-container">



									<!-- Blog post -->
									<div class="timeline-row">
										<div class="timeline-icon">
											<div class="bg-info-400">
												<i class="icon-comment"></i>
											</div>
										</div>

										<div class="card">
											<div class="card-header header-elements-sm-inline">
												<h6 class="card-title" style="color:#26c6da;"><?php echo $resultlists['subject']; ?></h6>

											</div>

											<div class="card-body">
												<blockquote class="blockquote blockquote-bordered py-2 pl-3 mb-0">
													<p class="mb-2 font-size-base"><?php echo nl2br($resultlists['postText']); ?></p>
													<footer class="blockquote-footer"><?php echo getUserName($resultlists['addedBy']); ?>, <cite title="Source Title"><?php echo date('d, M Y - h:i A',$resultlists['dateAdded'])?></cite></footer>
												</blockquote>
											</div>


										</div>
									</div>
									<!-- /blog post -->

								</div>
						    </div>
						    <!-- /timeline -->

					    </div>

					    <div class="tab-pane fade" id="schedule">

				    		<!-- Available hours -->
							<div class="card">
								<div class="card-header header-elements-inline">
									<h6 class="card-title">Available hours</h6>
									<div class="header-elements">
										<div class="list-icons">
					                		<a class="list-icons-item" data-action="collapse"></a>
					                		<a class="list-icons-item" data-action="reload"></a>
					                		<a class="list-icons-item" data-action="remove"></a>
					                	</div>
				                	</div>
								</div>

								<div class="card-body">
									<div class="chart-container">
										<div class="chart has-fixed-height" id="available_hours" _echarts_instance_="ec_1562140287232" style="-webkit-tap-highlight-color: transparent; user-select: none; position: relative;"><div style="position: relative; overflow: hidden; width: 100px; height: 400px; padding: 0px; margin: 0px; border-width: 0px;"><canvas data-zr-dom-id="zr_0" width="100" height="400" style="position: absolute; left: 0px; top: 0px; width: 100px; height: 400px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px;"></canvas></div><div></div></div>
									</div>
								</div>
							</div>
							<!-- /available hours -->



				    	</div>


					</div>
					<!-- /left content -->




				</div>


	<?php } ?>



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
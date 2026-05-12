<?php
if($_GET['id']!=''){


$id = decode($_GET['id']);
$rs121=GetPageRecord("*",'slabMaster','id="'.$id.'"');
$resList=mysqli_fetch_array($rs121);


}
?>
	<div class="page-content">


		<!-- Main content -->
		<div class="content-wrapper">


		<div class="content pt-0" style="margin-top:20px;">

				<div class="row">



				 <div class="col-xl-12">
				 <div class="card">
							 <div class="card-body navbar-green" style="padding:7px !important;">
							<div class="media">
									 <div class="col-xl-6">
									<h6 class="media-title font-weight-semibold" style="    margin-top: 8px;">Slab Name: <?php echo $resList['name']; ?></h6>
									</div>
									<div class="col-xl-6" style="text-align:right;">
									<div class="d-flex align-items-center" style="float:right; ">

					 <a href="#" onclick="opmodalpop(' Add Slab Days','modalpop.php?action=addslabdays&parentid=<?php echo encode($id); ?>','600px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-teal-400" aria-expanded="false" style="background-color: #03d873b8;"><i class="fa fa-plus" aria-hidden="true"></i> Create New</a>

					  <a href="showpage.crm?module=<?php echo $_GET['module']; ?>" style="background-color:#8a908db8;" class="btn bg-grey-400 ">Back</a>
						<!-- <div class="btn-group justify-content-center" style="float:right;">
 <a href="showpage.crm?module=<?php echo $_GET['module']; ?>" class="btn bg-grey-400 btn-labeled btn-labeled-right ml-auto" aria-expanded="false" style="margin-right: 0px;
    padding: 2px 10px 2px 10px;">Back </a>

						</div>-->
		                    	</div>

									</div>

							</div>
						</div>
														<div class="card-body listc">
								<table class="table table-bordered ">
							<thead style="background-color: #f9f8f8;">
								<tr class="border-top-info">
									<th>SR#</th>

									<th width="25%">Days</th>
									<th>Efficiency</th>
								    <th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
							$sr=1;
							$select2='*';
							$where2='parentId="'.$id.'"';
							$rs2=GetPageRecord($select2,'slabMaster',$where2);
							while($userss=mysqli_fetch_array($rs2)){

							?>
								<tr class="border-top-info">
									<td><?php echo $sr; ?></td>

									<td><?php echo $userss['days']; ?></td>
									<td><?php echo $userss['efficiency']; ?></td>
								    <td>

									<a href="#" onclick="opmodalpop(' Edit Slab Days','modalpop.php?action=addslabdays&parentid=<?php echo encode($id); ?>&id=<?php echo encode($userss['id']); ?>','600px','auto');" data-toggle="modal" data-target="#modalpop"><button type="button" class="btn btn-warning" style="padding:5px;"><i class="fa fa-pencil" aria-hidden="true" style=" color: #fffffff1;   font-size: 16px; "></i></button></a>
									</td>
								</tr>



							<?php $sr++; } ?>
							</tbody>
						</table>
							</div>

						</div>
				 </div>




				</div>
				<!-- /dashboard content -->
			</div>


			 </div>
			 </div>
		 </div>
<div id="submitlinedetail" style=""></div>



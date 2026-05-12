<div class="page-content">
<div class="content-wrapper">
	<div class="content pt-0" style="margin-top:20px;">
		<div class="row">
			<div class="col-xl-12">
				<div class="card-header header-elements-inline bg-info-700">
					<div class="col-xl-9"><h5 class="card-title"><?php echo $pageName; ?></h5></div>

					<div class="col-xl-3" style="text-align:right;">
									<div class="d-flex align-items-center" style="float:right; ">
		                    								<div class="d-flex align-items-center" style="float:right;margin-right:0px;">
		                    	<a href="showpage.crm?module=<?php echo $_GET['module']; ?>"><button type="button" class="btn bg-grey-400 btn-labeled btn-labeled-right ml-auto"><b><i class="fa fa-arrow-left" aria-hidden="true" style="    font-size: 17px;"></i></b>Back</button></a>
		                    	</div>

		                    	</div>
				  </div>


			  </div>
					<div class="card">

                            <div style="padding: 0px; height: auto; margin-top: 40px;">

							<table class="table table-responsive skill-report" width="27%" style="border-collapse:collapse; font-size:11px;">
							<tr style=" ">
							<td width="10%" rowspan="2" style="background-color: #e5e0ec; vertical-align: bottom;"><div style="font-weight: bold">Emp Code </div></td>
							<td width="17%" rowspan="2" style="background-color: #eaf1dd; vertical-align: bottom;"><div style="font-weight: bold">Employee Name</div></td>

							<td width="18%" style="background-color: #dbe5f1; vertical-align: inherit;"><div style=""><strong>Operations</strong></div></td>
							<?php
							$rsd=GetPageRecord('*','assemblyoperationsMaster','1 and name!="" order by name asc');
							while($assData=mysqli_fetch_array($rsd)){
                            ?>
							<td width="11%" style="background-color: #dbe5f1; vertical-align: inherit;"><div style=" "><?php echo $assData['name']; ?></div></td>
							<?php } ?>

							</tr>

							<tr style=" ">
							<td width="18%" style="background-color: #ddd9c3; vertical-align: inherit;"><div style=""><strong>Machine Type</strong></div></td>
							<?php
							$rsddd=GetPageRecord('*','assemblyoperationsMaster','1 and name!="" order by name asc');
							while($assDataaa=mysqli_fetch_array($rsddd)){
							$mq=GetPageRecord('*','machineMaster','1 and id="'.$assDataaa['machineId'].'"');
                            $machineDaataa=mysqli_fetch_array($mq);
							?>
							<td width="11%" style="background-color: #ddd9c3; vertical-align: inherit;"><div style=""><?php echo $machineDaataa['name']; ?></div></td>

							<?php } ?>

							</tr>

							<?php
							$usq=GetPageRecord('*','employeeMaster','1 and name!="" order by name asc');
							while($userData=mysqli_fetch_array($usq)){
                            ?>
							<tr style=" ">
							<td width="10%" style="background-color: #e5e0ec; vertical-align: bottom;"><div style=""><?php echo $userData['empCode']; ?></div></td>
							<td width="17%" style="background-color: #eaf1dd; vertical-align: bottom;"><div style=""><?php echo $userData['name']; ?></div></td>

							<td width="18%" style="background-color: #fff; vertical-align: inherit;"><div style=""><strong> </strong></div></td>

							<?php
							$rsddddd=GetPageRecord('*','assemblyoperationsMaster','1 and name!="" order by name asc');
							while($assDataaa=mysqli_fetch_array($rsddddd)){

							$mykm=GetPageRecord('*','skillMatrix','1 and empCode="'.$userData['id'].'" and particulars="'.$assDataaa['id'].'" and machineId="'.$assDataaa['machineId'].'" order by id desc');
							$skillData=mysqli_fetch_array($mykm);
							?>

							<td width="18%" style="background-color: #fff; vertical-align: inherit;"><div style="">
							  <div align="right"><strong> </strong><?php echo $skillData['efficiency']; ?></div>
							</div></td>
							<?php } ?>

							</tr>
							<?php } ?>

							</table>


							</div>

					</div>
		  </div>
	  </div>
	</div>
  </div>
</div>
</div>

<style>
.skill-report tr td {
    border: 1px dotted #b9b9b9 !important;
}
</style>
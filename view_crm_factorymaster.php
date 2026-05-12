<?php
if($_GET['factoryId']!=''){


$factoryId = decode($_GET['factoryId']);

$rs121=GetPageRecord("*",'factoryMaster','id="'.$factoryId.'"');
$factoryList=mysqli_fetch_array($rs121);


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
									<h6 class="media-title font-weight-semibold" style="    margin-top: 8px;">Factory Name: <?php echo $factoryList['name']; ?></h6>
									</div>
									<div class="col-xl-6" style="text-align:right;">
									<div class="d-flex align-items-center" style="float:right; ">
		                    		 <div class="btn-group justify-content-center" style="float:right;">
 <a href="showpage.crm?module=<?php echo $_GET['module']; ?>" class="btn bg-grey-400 btn-labeled btn-labeled-right ml-auto" aria-expanded="false" style="margin-right: 0px;
    padding: 2px 10px 2px 10px;">Back </a>

						</div>
		                    	</div>

									</div>

							</div>
						</div>
														<div class="card-body listc">
								<table class="table table-bordered ">
							<thead style="background-color: #f9f8f8;">
								<tr class="border-top-info">
									<th>SR#</th>
									<th width="25%">Line Name</th>
									<th>Operator</th>
									<th>Hours</th>
									<th>Minute(s) Capacity</th>

								</tr>
							</thead>
							<tbody>
							<?php
							$sr=1;
							$select2='*';
							$where2='factoryId="'.$factoryId.'"';
							$rs2=GetPageRecord($select2,'factoryLineMaster',$where2);
							while($userss=mysqli_fetch_array($rs2)){

							?>
								<tr class="border-top-info">
									<td><?php echo $sr; ?></td>
									<td><input name="lineName" id="lineName<?php echo $userss['id']; ?>"  type="text"  class="form-control" onblur="submitValue<?php echo $userss['id']; ?>();" value="<?php echo $userss['lineName']; ?>"   maxlength="200"></td>
									<td style="position: relative;"><input name="workers" id="workers<?php echo $userss['id']; ?>"  type="number"  class="form-control" value="<?php echo $userss['workers']; ?>"  onblur="submitValue<?php echo $userss['id']; ?>();"  maxlength="200"></td>
									<td style="position: relative;"><input name="hours" id="hours<?php echo $userss['id']; ?>"  type="number"  class="form-control" value="<?php echo $userss['hours'];  ?>" onkeyup="submitValue<?php echo $userss['id']; ?>();"  maxlength="200"></td>
									<td style="position: relative;"><input name="minuteCapacity" id="minuteCapacity<?php echo $userss['id']; ?>"  type="text"  class="form-control" value="<?php echo $userss['minuteCapacity']; ?>" onblur="submitValue<?php echo $userss['id']; ?>();" readonly="readonly"   maxlength="200" style="background-color:#CCCCCC;"></td>

								</tr>

<script>
function submitValue<?php echo $userss['id']; ?>(){
	var id = '<?php echo $userss['id']; ?>';
	var lineName = encodeURI($('#lineName<?php echo $userss['id']; ?>').val());
	var workers = $('#workers<?php echo $userss['id']; ?>').val();
	var hours = $('#hours<?php echo $userss['id']; ?>').val();
	if(hours!=''){
		var minuteCapacity = workers*hours*60;
	}
	$("#minuteCapacity<?php echo $userss['id']; ?>").val(minuteCapacity);
	var minuteCapacityNew = $('#minuteCapacity<?php echo $userss['id']; ?>').val();

	$('#submitlinedetail').load('allaction.php?action=savelinedetails&id='+id+'&linename='+lineName+'&workers='+workers+'&hours='+hours+'&minuteCapacity='+minuteCapacityNew);
}
</script>

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



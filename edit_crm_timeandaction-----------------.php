<?php
$select='*';
$id=clean(decode($_GET['styleid']));
$where='id='.$id.'';
$rs=GetPageRecord($select,_QUERY_MASTER_,$where);
$resultpage=mysqli_fetch_array($rs);

?>

<style>
.listc .table thead th {
    vertical-align: middle;
    border-bottom: 1px solid #b7b7b7;
    padding: 9px;
}
.listc .table-bordered td, .table-bordered th {
    border: 1px solid #ddd;
    padding: 8px;
}
.icon-calendar3{
	position: absolute;
    top: 18px;
    right: 0px;
}
</style>
<div class="page-content">

		<!-- Main sidebar -->
		<?php include "left.php"; ?>
		<div class="content-wrapper">

			<div class="content pt-0" style="margin-top:20px;">

				<div class="row">


				<?php include "left-style.php" ?>


				 <!--Middle Section-->







				 <div class="col-xl-9">
				 <div class="card">
							 <div class="card-body navbar-green"   >
							<div class="media">
									 <div class="col-xl-6">
									<h6 class="media-title font-weight-semibold"  style="    margin-top: 8px;">TNA(Time & Action) </h6>
									</div>
									<div class="col-xl-6" style="text-align:right;">
									<div class="d-flex align-items-center" style="float:right; ">
		                    		<?php if($_GET['editid']==''){ ?> <div class="btn-group justify-content-center" style="float:right;">
 <a href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes&styleid=<?php echo encode($resultpage['id']); ?>&editid=<?php echo encode($resultpage['id']); ?>" class="btn bg-teal-400" aria-expanded="false" style="    background-color: #03d873b8;"> Edit</a>

						</div> <?php } ?>

		                    	</div>

									</div>

							</div>
						</div>

							<div class="card-body listc">
								<table class="table table-bordered ">
							<thead>
								<tr class="border-top-info">
									<th>TNA Submission</th>
									<th>Date</th>
									<th>Actual Date</th>
									<th>Remark</th>
								<?php if($_GET['editid']!=''){ ?> <th width="12%">&nbsp;</th> <?php  } ?>
								</tr>
							</thead>
							<tbody>
								<?php
								$select='';
								$where='';
								$rs='';
								$select='*';
								$where=' deletestatus=0 and status=1 order by id asc';
								$rs=GetPageRecord($select,'taskListMaster',$where);
								while($resListing=mysqli_fetch_array($rs)){

								$select1='';
								$where1='';
								$select1='*';
								$where1='taskListId="'.$resListing['id'].'" and styleId="'.$resultpage['id'].'"';
								$rs1=GetPageRecord($select1,'timeActionReport',$where1);
								$data=mysqli_fetch_array($rs1);
								?>
								<tr class="border-top-info">
									<td><?php echo $resListing['name']; ?><input type="hidden" name="taskListId" id="taskListId<?php echo $resListing['id']; ?>"/></td>

									<td style="position: relative;"><input  name="complitionDate" type="text" class="form-control" id="complitionDate<?php echo $resListing['id']; ?>" style="position: relative;" <?php if($_GET['editid']==''){ ?> disabled <?php  } ?> onchange="addTaskList<?php echo $resListing['id']; ?>();" value="<?php if($data['complitionDate']!=''){ echo date('d-m-Y', strtotime($data['complitionDate'])); } ?>"   maxlength="200"><i class="icon-calendar3 mr-3"></i></td>

									<td style="position: relative;"><input name="actualDate" type="text" class="form-control" id="actualDate<?php echo $resListing['id']; ?>" style="position: relative;" <?php if($_GET['editid']==''){ ?> disabled <?php  } ?> onchange="addTaskList<?php echo $resListing['id']; ?>();" value="<?php if($data['actualDate']!=''){ echo date('d-m-Y', strtotime($data['actualDate'])); } ?>"><i class="icon-calendar3 mr-3"></i></td>

									<td><input name="remark" type="text" <?php if($_GET['editid']==''){ ?> disabled <?php  }?> class="form-control" onblur="addTaskList<?php echo $resListing['id']; ?>();" id="remark<?php echo $resListing['id']; ?>" value="<?php echo $data['remark']; ?>"   maxlength="200"></td>
									<?php if($_GET['editid']!=''){ ?><td align="center"><label class="checkbox-inline"> <input type="checkbox" checked data-toggle="toggle"></label></td> <?php } ?>
								</tr>
<script>
$( function(){
	$( "#actualDate<?php echo $resListing['id']; ?>").datepicker();
} );
$( function(){
	$( "#complitionDate<?php echo $resListing['id']; ?>" ).datepicker();
} );


function addTaskList<?php echo $resListing['id']; ?>(){
	var taskListId = '<?php echo $resListing['id'];?>';
	var complitionDate = $('#complitionDate<?php echo $resListing['id'];?>').val();
	var actualDate = $('#actualDate<?php echo $resListing['id'];?>').val();
	var remark1 = $('#remark<?php echo $resListing['id'];?>').val();
	var remark = encodeURI(remark1);

	$('#hiddentasklist').load('loadtimeaction.php?taskid='+taskListId+'&compdate='+complitionDate+'&actdate='+actualDate+'&remark='+remark+'&action=timeaction&styleid='+<?php echo $resultpage['id'];?>);

}
</script>
<div id="hiddentasklist" style=""></div>

		<?php  } ?>

							</tbody>
						</table>



							</div>


						</div>
				 </div>




				</div>
				<!-- /dashboard content -->
			</div>
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

.btn-float i {
    display: block;
    top: 0;
    font-size: 20px;
}

.card-group-control-right .card-body{width:100%;}
 </style>

 <script>



 </script>



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
						 <div class="col-xl-3" style="    padding-right: 0px;"><div class="btn-group justify-content-center" style="float:right;">


          <?php  if($addpermission==1){ ?>


                 <a href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes&styleid=<?php echo encode($resultlists['id']); ?>"  class="btn bg-teal-400 addnotify"

                aria-expanded="false" style="background-color: #03d873b8;"  ><i class="fa fa-plus" aria-hidden="true"></i> Create New</a>
                <?php } ?>

						</div></div>
					</div>

			<div class="card">
			<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"> <div class="datatable-scroll">
			<table class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
			<thead style="background-color: #f5f5f5;">
			<tr role="row">
								<!--<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Requisition No.</th>-->
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Issuance No.</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Issuance Date</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Issued By</th>
							    <!--<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Requisition Type</th>-->
							    <!--<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Requisition Date</th>-->
							    <!--<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Requsted By</th>-->
							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Requested From</th>
							    <!--<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Due Date</th>-->
							    <!--<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Date</th>-->
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Status</th>
								<!--<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Pending/Approved</th>-->
							</tr>
						</thead>
						<tbody>



						<?php
						$where='1';
                        $rs=GetPageRecord($select,'issuance',$where);
                        while($operationData=mysqli_fetch_array($rs)){
						?>
					         <tr role="row" class="odd" >

							<td><a href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes&styleid=<?php echo encode($operationData['id']); ?>">
						    <?php echo $operationData['requisition_no']; ?>

							</a></td>

							 <!--<td><?php echo $operationData['issuance_no']; ?></td>-->

		                    <td><?php echo $operationData['Issuance_date']; ?></td>

								<td><?php echo $operationData['issued_by']; ?></td>
								<!--<td><?php echo $operationData['requisition_type']; ?></td>-->
								<!--<td><?php echo $operationData['requisition_date']; ?></td>-->
								<!--	<td><?php echo $operationData['requsted_by']; ?></td>-->
									<td><?php echo $operationData['requested_from']; ?></td>
							    <!--<td><?php echo $operationData['due_date']; ?></td>-->

								  <!--<td>-</td>-->
								  <td>-</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
					</div>
					</div>


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
 .liststyleimg{float: left;
    width: 70px;
    margin-right: 15px;
    padding: 5px;
    border: 2px solid #e6e6e6;}

	.badge.dropdown-toggle:after { display:none;
}


 </style>

 <script>
$('#DataTables_Table_2').DataTable( {
"order": [[ 0, "desc" ]]
} );
</script>

<script>
function issuance() {
     alert('test');

}
</script>

<!--<script>-->
<!--jQuery(document).ready(function(){-->
<!--jQuery("#issuances").click(function(){-->
 //alert('test');
<!--var requisition_no = jQuery("#requisition_no").val();-->
<!--var issuance_no = jQuery("#issuance_no").val();-->
<!--var issuance_date = jQuery("#issuance_date").val();-->
<!--var issued_by = jQuery("#issued_by").val();-->
<!--var collect='name='+name+'&email='+email+'&phone='+phone;-->
<!--jQuery.ajax({-->
<!--type : 'post',-->
<!--url : 'ajax.php',-->
<!--data : collect,-->
<!--success : function(response){-->
<!--jQuery('#homeres').html(response);-->
<!--$('#msg').fadeOut(5000);-->
<!--}-->
<!--});-->
<!--}-->

<!--</script>-->






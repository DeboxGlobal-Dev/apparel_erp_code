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
 <?php if($addpermission==1){ ?> <a href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes" class="btn bg-teal-400 addnotify" aria-expanded="false" style="    background-color: #03d873b8;"  ><i class="fa fa-plus" aria-hidden="true"></i> Create New</a> <?php } ?>
					 </div></div>
					</div>
					<div class="card">

					<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"> <div class="datatable-scroll">
					<table class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
						<thead>
							<tr role="row">
							<th class="sorting_desc" tabindex="0" aria-controls="" rowspan="1" colspan="1" aria-sort="descending">Chaalan&nbsp;No</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0">Chaalan&nbsp;Type</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0">Process</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0">From&nbsp;Factory</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0">To&nbsp;Supplier</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0">Creation&nbsp;Date</th>
						<th>Action</th>
							</tr>
						</thead>
						<tbody>




						    <?php


$rsssee=GetPageRecord('*','externalChallan','1 and status ="1"');
while($resListingssee=mysqli_fetch_array($rsssee)){
						    ?>

							<tr role="row" class="odd">
								<td tabindex="0" class="sorting_1"><a href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes&id=<?php echo encode($resListingssee['id']); ?>">

								    <?php if($resListingssee['challantype']=='Returnable'){




								     echo 'EC-R-0000'.$resListingssee['id'];
								    }elseif($resListingssee['challantype']=='Non-Returnable'){

								        								     echo 'EC-NR-0000'.$resListingssee['id'];

								    }else{
								     		  echo 'EC-0000'.$resListingssee['id'];

								    }

								    ?>


								    </a></td>
								<td><?php echo $resListingssee['challantype']; ?> </td>
								<td><?php echo $resListingssee['process']; ?></td>
								<td><?php echo $resListingssee['factoryname']; ?></td>
								<td>

								    <?php

$rsssez=GetPageRecord('*','suppliersMaster','1 and id="'.$resListingssee['supplier'].'"');
$resListingssez=mysqli_fetch_array($rsssez);

								    echo $resListingssez['name']; ?>
								    </td>
								<td>
								<?php echo $resListingssee['date']; ?>
								</td>

								  <td>

					   <div style="width:200px;">

						<a href="download-externalchallan.php?id=<?php echo encode($resListingssee['id']); ?>" target="_blank" style="background: #0288d1; outline: none; color: #fff; padding: 5px; border-radius: 2px; cursor: pointer; width: 95px; display: block; float:left;  text-align:center;"><i class="fa fa-download" aria-hidden="true"></i> Excel</a>
						<a href="tcpdf/examples/genratextchalan.php?pageurl=<?php echo $fullurl; ?>download-externalchallanpdf.php?id=<?php echo encode($resListingssee['id']); ?>" target="_blank" style="background: #e71c22; outline: none; color: #fff; padding: 5px; border-radius: 2px; cursor: pointer; width: 95px; display: block; float:right; margin-left:5px; text-align:center;"><i class="fa fa-download" aria-hidden="true"></i> PDF</a>
						</div>

					  </td>

						<!--		 <td>-->

						<!--<a href="download-externalchallan.php?id=<?php //echo encode($resListingssee['id']); ?>" target="_blank" style="background: #0288d1; outline: none; color: #fff; padding: 5px; border-radius: 2px; cursor: pointer; width: 95px; display: block; float:left;  text-align:center;"><i class="fa fa-download" aria-hidden="true"></i> Excel</a> -->

					 <!-- </td>-->

							</tr>
						<?php } ?>
						</tbody>
					</table></div>
					</div>


					</div>


				</div>
			</div>
		</div>
	</div>
</div>

</div>

 <style>


     .datatable-header{
         display:none;
     }
 </style>
<div class="page-content">

		<!-- Main sidebar -->
		<?php include "left.php"; ?>
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->
			<div class="page-header">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4><span class="font-weight-semibold">Chat Widget</span> -  Visitor Monitoring (<span id="totoalusers"></span>)</h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>

					 
				</div>
			</div>
			<!-- /page header -->


			<!-- Content area -->
			<div class="content pt-0">

				 
 

				<!-- Dashboard content -->
				<div class="row">
				<div class="col-xl-12">
				<div class="card">
				<div class="table-responsive">
						<div class="table-responsive" id="activeurls">
							<div style="padding:20px; text-align:center;">Loading Visitors....</div>	
				  </div>
				  </div>
						</div> 
 

					</div>

					 
				</div>
				<!-- /dashboard content -->

			</div>
			<!-- /content area -->


			<!-- Footer -->
			 
			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>
 
 <script>
setInterval(function() {
$('#activeurls').load('loadaction.php?action=showallvisitor');
}, 3000);
</script>
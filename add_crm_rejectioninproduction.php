
<div class="page-content">
  <!-- Main content -->
  <div class="content-wrapper">
    <!-- Page header -->
    <!-- /page header -->
    <!-- Content area -->
    <div class="content pt-0" style="margin-top:20px;">
      <!-- Dashboard content -->
      <div class="row">
        
        <div class="col-xl-12">
          <div class="card" >
            <div class="card-header header-elements-inline bg-info-700">
              <div class="col-xl-9">
                <h5 class="card-title">Allocate Resource - Buyer: <?php echo getBuyerName(decode($_GET['buyerId'])); ?> [<?php echo getBrandName(decode($_GET['brandId'])); ?>]</h5>
              </div>
              <div class="col-xl-3" style="padding-right: 0px;">
                <div class="d-flex align-items-center" style="float:right;">
		                    		
<a href="showpage.crm?module=buyermaster&view=yes&id=<?php echo $_GET['buyerId']; ?>" class="btn bg-blue-400 btn-labeled btn-labeled-right ml-auto" name="stylemailreply" id=""  style="margin-right: 0px;
    padding: 2px 36px 2px 10px; background-color: #8c8787;">
          <b><i class="fa fa-arrow-left" aria-hidden="true" style="font-size: 8px;
    padding: 0px;
    line-height:6px;"></i></b> Back </a>


		                    	</div>
              </div>
            </div>
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
              <div class="datatable-scroll">
                <table width="100%" class="table table-bordered datatable" id="DataTables_Table_2">
                  <thead>
                    <tr role="row">
					  <th style="text-align: center;"><a href="JavaScript:Void(0);" onclick="addNewRow(1)">+Add&nbsp;New</a></th>
                      <th>Role</th>
                      <th>User</th>
                    </tr>
                  </thead>
                  <tbody id="loadtrdata">
                    
                  </tbody>
                </table>
				<script>
				function addNewRow(addid){
					var buyerId = '<?php echo decode($_GET['buyerId']); ?>';
					var brandId = '<?php echo decode($_GET['brandId']); ?>';
					$('#loadtrdata').load('loadresourceallocation.php?action=loadresourceallrowdata&addid='+addid+'&buyerId='+buyerId+'&brandId='+brandId);
				}
				addNewRow(0);
				
				function deleterow(delrow){
					var buyerId = '<?php echo decode($_GET['buyerId']); ?>';
					var brandId = '<?php echo decode($_GET['brandId']); ?>';
				  $('#loadtrdata').load('loadresourceallocation.php?action=loadresourceallrowdata&deletestatus=yes&buyerId='+buyerId+'&brandId='+brandId+'&delrowid='+delrow);
				}

				</script>
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
<!-- /main content -->
</div>

<?php
$select='*';
$id=clean(decode($_GET['id']));
$where='id='.$id.'';
$rs=GetPageRecord($select,'brandMaster',$where);
$resultpage=mysqli_fetch_array($rs);


?>

<div class="page-content">
  <!-- Main sidebar -->
  <?php include "left.php"; ?>
  <div class="content-wrapper">
    <div class="content pt-0" style="margin-top:20px;">
      <div class="row">
        <!--Middle Section-->
        <div class="col-xl-12" style="padding:0px;">
          <div class="card">
            <div class="card-body navbar-green"   >
              <div class="media">
                <div class="col-xl-6" style="padding:0px;">
                  <h6 class="media-title font-weight-semibold">Brand Details</h6>
                </div>
                <div class="col-xl-6" style="text-align:right;padding:0px;">
                  <div class="d-flex align-items-center" style="float:right;"> <a href="showpage.crm?module=<?php echo $_GET['module']; ?>" class="btn bg-blue-400 btn-labeled btn-labeled-right ml-auto" name="stylemailreply" id=""  style="margin-right: 0px;
    padding: 2px 36px 2px 10px; background-color: #8c8787;"> <b><i class="fa fa-arrow-left" aria-hidden="true" style="font-size: 8px;
    padding: 0px;
    line-height:6px;"></i></b> Back </a> </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <ul class="nav nav-tabs nav-tabs-solid nav-justified rounded border-0" style="font-weight: 600;">
                <li class="nav-item"><a href="#solid-rounded-justified-tab1" class="nav-link active show" data-toggle="tab"> Brand&nbsp;Information</a></li>
                <li class="nav-item"><a href="#solid-rounded-justified-tab2" class="nav-link rounded-left" data-toggle="tab">Season</a></li>
                <li class="nav-item"><a href="#solid-rounded-justified-tab3" class="nav-link rounded-left" data-toggle="tab">Color</a></li>
                <li class="nav-item"><a href="#solid-rounded-justified-tab4" class="nav-link rounded-left" data-toggle="tab">Resources</a></li>
                <li class="nav-item"><a href="#solid-rounded-justified-tab5" class="nav-link rounded-left" data-toggle="tab">Approvals</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active show" id="solid-rounded-justified-tab1">
                  <div class="row">
                  	<div class="col-xl-12">
                      <div class="card">
                        <div class="card-header bg-white">
                          <h6 class="card-title">Brand Information</h6>
                        </div>
                        <div class="card-body">
                          <form action="ac.crm" method="post" class="submitstyleform" enctype="multipart/form-data" name="popid" target="acf" id="popid">
                            <div class="form-group">
                              <div class="row">
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label>Name</label>
                                    <input name="name" type="text" class="form-control" id="name" value="<?php echo $resultpage['name']; ?>" readonly  maxlength="200">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Description</label>
                                    <input name="description" type="text" class="form-control" id="description" value="<?php echo $resultpage['description']; ?>" readonly  maxlength="200">
                                  </div>
                                </div>
								<div class="col-md-3">
                                  <div class="form-group">
                                    <label>Buyer</label>
                                    <select id="buyerId" name="buyerId" class="form-control">
									  <option value="">Select</option>
										<?php
										$select='';
										$where='';
										$rs='';
										$select='*';
										$where=' deletestatus=0 and status=1 order by name asc';
										$rs=GetPageRecord($select,_BUYER_MASTER_,$where);
										while($resListing=mysqli_fetch_array($rs)){
										?>
												  <option value="<?php echo $resListing['id']; ?>" <?php if($resListing['id']==$resultpage['buyerId']){ ?> selected="selected" <?php } ?>> <?php echo strip($resListing['name']); ?></option>
												  <?php } ?>
										</select>
                                  </div>
                                </div>
                              </div>
                              <div class="row" style="margin-top:20px;">

						<div class="col-md-3">
							<div class="form-group">
								<label>Cost Per Minute(CPM)</label>
								<input name="cpm" type="text" class="form-control" id="cpm" value="<?php echo $resultpage['cpm']; ?>" >
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Commission/Discount(%)</label>
								<input name="discount" type="text" class="form-control" id="discount" value="<?php echo $resultpage['discount']; ?>" >
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>CST Number</label>
								<input name="subject" type="text" class="form-control" id="subject" value="<?php echo $editresult['subject']; ?>"   maxlength="200">
							</div>
						</div>



						<div class="col-md-3">
							<div class="form-group">
								<label>By Default</label>
								<select class="form-control " name="default" id="default">
									<option>Select</option>
									<option value="1" <?php if($resultpage['bydefault']=='1') { ?> selected="selected" readonly
													<?php } ?>>Yes</option>
									<option value="0" <?php if($resultpage['bydefault']=='0') { ?> selected="selected" readonly
													<?php } ?>>No</option>
								  </select>
							</div>
						</div>
					</div>

                            </div>

                            <input type="hidden" name="editId" value="<?php echo encode($resultpage['id']); ?>">
                            <input type="hidden" name="action" value="<?php echo $_GET['module']; ?>">
                            <input type="hidden" name="module" value="<?php echo $_GET['module']; ?>">
                            <div class="text-right">
                              <button type="button" name="submitbtn" id="submitbtn pnotify-solid-success" class="btn btn-primary" onclick="formValidation('popid','submitbtn','0');" style="margin:0px;" >Save<i class="fa fa-floppy-o ml-2" aria-hidden="true"></i></button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
                <div class="tab-pane fade" id="solid-rounded-justified-tab2">
                 <div class="card" style="width:100%">
                    <div class="card-body listc">
                      <div style="padding: 5px;font-weight: 500; color: #524f4f; width:100%"><span>Season</span> <span style=" float:right;"><a href="#" onclick="opmodalpop(' Add Season Master','modalpop.php?action=seasonmaster&brandId=<?php echo $resultpage['id']; ?>&buyerId=<?php echo decode($_REQUEST['buyerId']); ?>','600px','auto');" data-toggle="modal" data-target="#modalpop">+Add New Season</a></span></div>
                      <table class="table table-bordered">
                        <thead style="background-color: #dfffef;">
                          <tr class="border-top-info">
                            <th>Sr. No#</th>
                            <th>Season Name</th>
                            <th>Start Date </th>
                            <th>End By</th>
                            <th>Brand</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
							$sr=1;
							$rsseason=GetPageRecord('*',_SEASON_MASTER_,'1 and name!="" and buyerId="'.$resultpage['buyerId'].'" and brandId="'.$resultpage['id'].'" order by id desc');
							while($resultlists=mysqli_fetch_array($rsseason)){

							$rs2vz=GetPageRecord('*','seasonMaster','id="'.$resultlists['id'].'" and bydefault=1');
							$userssvz=mysqli_fetch_array($rs2vz);


							?>
                          <tr class="border-top-info">
                            <td><?php echo $sr; ?></td>
                            <td tabindex="0" class="sorting_1"><a href="#" onclick="opmodalpop(' Edit Season Master','modalpop.php?action=seasonmaster&id=<?php echo encode($resultlists['id']); ?>&brandId=<?php echo $resultpage['id']; ?>&buyerId=<?php echo $resultlists['buyerId']; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop"><?php echo $resultlists['name']; ?>
                              <?php if($userssvz==true){ ?>
                              <span style="margin: 0px 29px;" class="badge badge-success">Default</span>
                              <?php } ?>
                              </a></td>
                            <td><?php echo showDate($resultlists['startDate']); ?></td>
                            <td><?php echo showDate($resultlists['endDate']); ?></td>
                            <td><?php
								$rscolor2=GetPageRecord('*','brandMaster','id="'.$resultlists['brandId'].'"');
							$resultlists2=mysqli_fetch_array($rscolor2);
							echo $resultlists2['name'];
							?></td>
                            <td class="text-center"><?php if($resultlists['status']==1){ ?>
                              <span class="badge badge-success">Active</span>
                              <?php } ?>
                              <?php if($resultlists['status']==2){ ?>
                              <span class="badge badge-secondary">Inactive</span>
                              <?php } ?></td>
                          </tr>
                          <?php $sr++; } ?>
                        </tbody>
                      </table>
                      <?php if($sr==1){ ?>
                      <div align="center" style="padding: 5px; background: #f1f1f1; color: #9a9a9a;">No Record Found.</div>
                      <?php } ?>
                    </div>
                  </div>

                </div>
                <div class="tab-pane fade" id="solid-rounded-justified-tab3">
                  <div id="">
                     <div class="card" style="width:100%">
                    <div class="card-body listc">
                      <div style="padding: 5px;font-weight: 500; color: #524f4f; width:100%"><span>Color Information</span> <span style=" float:right;"><a href="#" onclick="opmodalpop(' Add Color Card','modalpop.php?action=colorcardmaster&brandId=<?php echo $resultpage['id']; ?>&buyerId=<?php echo $resultpage['buyerId']; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop"  aria-expanded="false">+Add New Color</a></span></div>
                      <table class="table table-bordered">
                        <thead style="background-color: #dfffef;">
                          <tr class="border-top-info">
                            <th>Sr. No#</th>
                            <th>Color Code</th>
                            <th>Color Name </th>
                            <th>Brand</th>
                            <th>Reference</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
							$sr=1;
							$rscolor=GetPageRecord('*',_COLOR_CARD_MASTER_,'1 and name!="" and buyerId="'.decode($_REQUEST['buyerId']).'" and brandId="'.decode($_REQUEST['id']).'" and deletestatus=0 order by id desc');
							while($resultlists=mysqli_fetch_array($rscolor)){
							?>
                          <tr class="border-top-info">
                            <td><?php echo $sr; ?></td>
                            <td><a href="#" onclick="opmodalpop(' Edit Color Card','modalpop.php?action=colorcardmaster&id=<?php echo encode($resultlists['id']); ?>&brandId=<?php echo $resultpage['id']; ?>&buyerId=<?php echo $resultpage['buyerId']; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop"><?php echo $resultlists['colorCode']; ?></a></td>
                            <!--<td tabindex="0" class="sorting_1"><div style="background-color:<?php echo $resultlists['colorCode']; ?>; padding: 11px; "></div></td>-->
                            <td><?php echo $resultlists['name']; ?></td>
                            <td><?php
								$rscolor2=GetPageRecord('*','brandMaster','id="'.$resultlists['brandId'].'"');
							$resultlists2=mysqli_fetch_array($rscolor2);
							echo $resultlists2['name'];
							?></td>
                            <td><?php  echo  $resultlists['reference']; ?></td>
                          </tr>
                          <?php $sr++; } ?>
                        </tbody>
                      </table>
                      <?php if($sr==1){ ?>
                      <div align="center" style="padding: 5px; background: #f1f1f1; color: #9a9a9a;">No Record Found.</div>
                      <?php } ?>
                    </div>
                  </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="solid-rounded-justified-tab4">
                  <div id="">
                    <div class="card">
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
					var brandId = '<?php echo decode($_GET['id']); ?>';
					$('#loadtrdata').load('loadresourceallocation.php?action=loadresourceallrowdata&addid='+addid+'&buyerId='+buyerId+'&brandId='+brandId);
				}
				addNewRow(0);

				function deleterow(delrow){
					var buyerId = '<?php echo decode($_GET['buyerId']); ?>';
					var brandId = '<?php echo decode($_GET['id']); ?>';
				  $('#loadtrdata').load('loadresourceallocation.php?action=loadresourceallrowdata&deletestatus=yes&buyerId='+buyerId+'&brandId='+brandId+'&delrowid='+delrow);
				}
				</script>
                    </div>
                  </div>
                </div>
				<div class="tab-pane fade" id="solid-rounded-justified-tab5">
                  <div id="">
                    <div class="card">
                      <table width="100%" class="table table-bordered datatable" id="DataTables_Table_1">
					  <thead>
						<tr role="row">
						  <th style="text-align: center;"><a href="JavaScript:Void(0);" onclick="addNewRowApproval(1)">+Add&nbsp;New</a></th>
						  <th>Role</th>
						  <th>Approval</th>
						  <th>User</th>
						</tr>
					  </thead>
					  <tbody id="loaddataapproval">

					  </tbody>
					</table>
				<script>
				function addNewRowApproval(addid){
					var buyerId = '<?php echo decode($_GET['buyerId']); ?>';
					var brandId = '<?php echo decode($_GET['id']); ?>';
					$('#loaddataapproval').load('loadresourceapproval.php?action=loadresourceapprowdata&addid='+addid+'&buyerId='+buyerId+'&brandId='+brandId);
				}
				addNewRowApproval(0);

				function deleterowapproval(delrow){
					var buyerId = '<?php echo decode($_GET['buyerId']); ?>';
					var brandId = '<?php echo decode($_GET['id']); ?>';
				  $('#loaddataapproval').load('loadresourceapproval.php?action=loadresourceapprowdata&deletestatus=yes&buyerId='+buyerId+'&brandId='+brandId+'&delrowid='+delrow);
				}
				</script>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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
 function deletethisaddress(id){
 	var confirmFirst = confirm("Are you sure you want to delete this address?");
	if(confirmFirst==true){
		var buyerid= '<?php echo encode($resultpage['id']); ?>';
		window.location.href = 'showpage.crm?module=buyermaster&view=yes&id='+buyerid+'&did='+id; //delete address
	}
 }

 </script>

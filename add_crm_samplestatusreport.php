<?php
//$updatepage='1';

if($_GET['styleid']!=''){
$select='*';
$where='id="'.decode($_GET['styleid']).'"';
$rs=GetPageRecord($select,'queryMaster',$where);
$editresultstyle=mysqli_fetch_array($rs);
$buyerId = $editresultstyle['buyerId'];
$buyerStyleRefNo = $editresultstyle['buyerStyleRefNo'];
$subject = $editresultstyle['subject'];
$displayId = $editresultstyle['displayId'];
$seasonId = $editresultstyle['seasonId'];
$categoryId = $editresultstyle['categoryId'];
$subCategoryId = $editresultstyle['subCategoryId'];
$departmentId = $editresultstyle['departmentId'];
$receivedDate = $editresultstyle['receivedDate'];
$patternDescription = $editresultstyle['patternDescription'];
$patternAttachment = $editresultstyle['patternAttachment'];

$lastId=$editresultstyle['id'];

}

?>

<div class="page-content">
  <!-- Main sidebar -->
  <?php include "left.php"; ?>
  <!-- /main sidebar -->
  <!-- Main content -->
  <div class="content-wrapper">
    <!-- Content area -->
    <div class="content pt-0" style="margin-top:20px;">
      <!-- Dashboard content -->

      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-white">
              <h6 class="card-title">Sample Status Report</h6>
            </div>
            <div class="card-body">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
				  <table width="100%" border="1" cellspacing="2" cellpadding="8" style="border:1px solid #ccc;">

					  <thead style="background: #ffffed;">
						<th>SR#</th>
              <th>Activity</th>
              <th>Color</th>
              <th>Planned Date</th>
              <th>WIP</th>
              <th>Dispatch</th>
              <th>Actual Date</th>
              <th>Status</th>
					  </thead>
						<?php
            $sno = 0;
            $whereAct='styleId="'.decode($_REQUEST['styleid']).'" order by id asc';
            $rsAct=GetPageRecord('*','samplingActivityMaster',$whereAct);
            while($resListingAct=mysqli_fetch_array($rsAct)){
            $sno++;
            ?>
            <tr>
                <td><?php echo $sno; ?></td>
                <td><?php echo getActivityTypeName($resListingAct['activityId']); ?></td>
                <td><?php echo getColorName($resListingAct['colorId']); ?></td>
                <td><?php echo date('d-m-Y',strtotime($resListingAct['plannedDate'])); ?></td>
                <td><?php echo $resListingAct['wip']; ?></td>
                <td><?php echo $resListingAct['totalDispatch']; ?></td>
                <td><?php if($resListingAct['actualDate']!='0000-00-00'){ echo date('d-m-Y',strtotime($resListingAct['actualDate'])); } ?></td>
                <td><?php if($resListingAct['status']==0){ echo 'In-Complete'; }else{ echo 'Completed'; } ?></td>
            </tr>
            <?php }
            if($sno==0){
            ?>
            <tr>
                <td colspan="7">No record found..</td>
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

      <div class="row" style="display:none;">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-white">
              <h6 class="card-title">Pattern Information</h6>
            </div>
            <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
              <div class="card-body">
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Attach File</label>
                        <div class="uniform-uploader">
                          <input type="file" name="patternAttachment" id="patternAttachment" class="form-input-styled" data-fouc="">
                          <span class="filename" style="user-select: none;">No file selected</span> <span class="action btn btn-secondary" style="user-select: none;"><i class="fa fa-upload"></i></span>
                          <script>
							$('#patternAttachment').on('change',function(){
							//get the file name
							var fileName = $(this).val();
							//replace the "Choose a file" label
							$(this).next('.filename').html(fileName);
							})
						</script>
                          <input type="hidden" name="patternAttachmentEdit" id="patternAttachmentEdit" value="<?php echo $patternAttachment; ?>"/>
                        </div>
                        <?php if($patternAttachment!=''){?>
                        <div style="display:block;margin-top:10px;"><a href="images/<?php echo $patternAttachment; ?>" target="blank"><i class="fa fa-download" aria-hidden="true"></i> Attachment</a></div>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="form-group">
                        <label>Remarks</label>
                        <input type="text" name="patternDescription" id="patternDescription" class="form-control" value="<?php echo $patternDescription; ?>"/>
                        <!--				<textarea name="patternDescription" id="patternDescription" class="form-control"><?php //echo $patternDescription; ?></textarea>-->
                      </div>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="patternploaded" value="patternploaded" />
                <input type="hidden" name="editId" value="<?php echo $_GET['styleid']; ?>">
                <input type="hidden" name="action" value="addpattern">
                <input type="hidden" name="module" value="<?php echo $_GET['module']; ?>">
                <div class="text-right">
                  <button type="submit" style="margin:0px;" class="btn btn-primary">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true"></i></button>
                  <label> </label>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- /dashboard content -->
  </div>
  <!-- /content area -->
</div>
<!-- /main content -->
</div>

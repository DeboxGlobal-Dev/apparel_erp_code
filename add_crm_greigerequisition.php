<?php

if($_GET['id']!=''){
$select='*';
$where='id="'.decode($_GET['id']).'"';
$rs=GetPageRecord($select,'greigeRequisition',$where);
$editresultstyle=mysqli_fetch_array($rs);
@extract($editresultstyle);
$lastId=$editresultstyle['id'];
$requisitionNo = $requisitionNo;
$styleNo = $styleNo;
}

if($_GET['id']==''){
deleteRecord('greigeRequisition','tabstatus=0');

$requisitionNo = 'G-REQ-'.rand();
$styleNo = 'STY'.date('dmy').'-'.mt_rand(1000,9999);
$namevalue ='addedBy="'.$_SESSION['userid'].'",requisitionNo="'.$requisitionNo.'"';
$lastId = addlistinggetlastid('greigeRequisition',$namevalue);
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
              <h6 class="card-title"><?php echo $pageName; ?></h6>
            </div>
            <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
              <div class="card-body">
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Requisition No</label>
                        <input type="text" name="requisitionNo" id="requisitionNo" class="form-control readonly" value="<?php echo $requisitionNo; ?>" required />
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Requisition Date</label>
                        <input type="text" name="requisitionDate" id="requisitionDate" class="form-control " value="<?php if($editresultstyle['requisitionDate']!=''){ echo date('d-M-Y', strtotime($editresultstyle['requisitionDate'])); }else{ echo date('d-M-Y'); } ?>" required readonly/>
                      </div>
                    </div>
					<div class="col-md-3">
                      <div class="form-group">
                        <label>Greige Style No</label>
                        <input type="text" name="styleNo" id="styleNo" class="form-control readonly" value="<?php echo $styleNo; ?>" required />
                      </div>
                    </div>
					   <script>

$(document).ready(function() {

$("#brandId").select2();

});

</script>
 <style>

.select2-search__field{

display:none;

}

</style>
<?php
$newdata = explode(',',$brandId);
?>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Brand</label>
                        <select name="brandId[]" id="brandId" class="form-control select2" multiple="multiple" required>
                          <option value="" disabled="disabled">Select</option>
                          <?php
							$select='';
							$where='';
							$rs='';
							$select='*';
							$where=' 1  order by name asc';
							$rs=GetPageRecord($select,'brandMaster',$where);
							while($resListing=mysqli_fetch_array($rs)){
							?>
                          <option value="<?php echo $resListing['id']; ?>" <?php foreach($newdata as $brand){ if($brand==$resListing['id']){ ?>selected="selected" <?php } } ?>><?php echo $resListing['name']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                   </div>

                  <div class="row" style="margin-top:10px;">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Requested By</label>
                        <input type="text" name="reqesBy" id="reqesBy" class="form-control readonly" value="<?php echo getUserName($_SESSION['userid']); ?>"/>
                        <input type="hidden" name="addedBy" id="addedBy" class="form-control" value="<?php echo $_SESSION['userid']; ?>"/>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>For Quarter</label>
                        <select id="seasonId" name="seasonId" class=" form-control" displayname="Season" required>
                         <option value="">Select</option>
						<?php
						$select='';
						$where='';
						$rs='';
						$select='*';
						$where=' 1 and brandId=0 and deletestatus=0 and status=1 order by id asc';
						$rs=GetPageRecord($select,_SEASON_MASTER_,$where);
						while($resListing=mysqli_fetch_array($rs)){
						?>
						<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$seasonId){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
						<?php } ?>
                        </select>
                      </div>
                    </div>
					<!--<div class="col-md-3">
                      <div class="form-group">
                        <label>Currency</label>
                        <select id="currencyId" name="currencyId" class=" form-control" displayname="Currency" required>
                         <option value="">Select</option>
						<?php
						$select='';
						$where='';
						$rs='';
						$select='*';
						$where=' 1 and status=1 order by name asc';
						$rs=GetPageRecord($select,'currencyMaster',$where);
						while($resListing=mysqli_fetch_array($rs)){
						?>
						<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$currencyId){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
						<?php } ?>
                        </select>
                      </div>
                    </div>-->
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control <?php if($_GET['id']=="" || $status=="1"){ echo 'readonly'; }?>" required>
                          <option value="0" <?php if(0==$status){ ?>selected="selected"<?php } ?>>Pending</option>
                          <option value="1"  <?php if(1==$status){ ?>selected="selected"<?php } ?>>Approve</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="editId" value="<?php echo encode($lastId); ?>">
                <input type="hidden" name="action" value="greigerequisition">

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
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-white">
              <h6 class="card-title">Item Information</h6>
            </div>
            <div class="card-body">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <table width="100%" class="table table-responsive table-bordered">
                      <thead style="background: #ffffed;">
                      <th>Item</th>
                        <th>Construction</th>
                        <th>Width</th>
                        <th>Qty.</th>
                        <th>UOM</th>
                        <th>Process&nbsp;Loss</th>
						<th>Shrinkage</th>
						<th>Pro.&nbsp;Cons.</th>
						<th>Pro.&nbsp;Width</th>
                        <th>Final&nbsp;Qty.</th>
                        <th>Supplier</th>
                        <th>Price</th>
                        <th>Currency</th>
                        <th style="text-align: center;"><a href="JavaScript:Void(0);" onclick="addNewRow(1)">+Add&nbsp;New</a></th>
						<?php if($_REQUEST['id']!=''){ ?><th>&nbsp;</th><?php } ?>
                        </thead>
                      <tbody id="loadtabledata">

                      </tbody>
                    </table>
<script>
function addNewRow(addid){
  var lastid = '<?php echo encode($lastId); ?>';
  var supplierPurchaseOrderId = $('#ponumber').val();
  $('#loadtabledata').load('loadgreigetable.php?action=addnewrow&editId=<?php echo $_REQUEST['id']; ?>&addsize='+addid+'&lastid='+lastid);
}
addNewRow(0);

function deleterow(delrow){
   var lastid = '<?php echo encode($lastId); ?>';
  $('#loadtabledata').load('loadgreigetable.php?deletestatus=yes&editId=<?php echo $_REQUEST['id']; ?>&lastid='+lastid+'&delrowid='+delrow);
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
    <!-- /dashboard content -->
  </div>
  <!-- /content area -->
</div>
<!-- /main content -->
</div>
<script>
$( function(){
	$( "#requisitionDate" ).datepicker({ minDate: 0 });
} );
</script>

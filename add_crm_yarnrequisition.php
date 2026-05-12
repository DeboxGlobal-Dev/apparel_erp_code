<?php

if($_GET['id']!=''){
$select='*';
$where='id="'.decode($_GET['id']).'"';
$rs=GetPageRecord($select,'yarnRequisition',$where);
$editresultstyle=mysqli_fetch_array($rs);
@extract($editresultstyle);
$lastId=$editresultstyle['id'];
$requisitionNo = $requisitionNo;
$styleNo = $styleNo;
}

if($_GET['id']==''){
deleteRecord('yarnRequisition','tabstatus=0');

$requisitionNo = 'Y-REQ-'.rand();
$styleNo = 'STY'.date('dmy').'-'.mt_rand(1000,9999);
$namevalue ='addedBy="'.$_SESSION['userid'].'",requisitionNo="'.$requisitionNo.'"';
$lastId = addlistinggetlastid('yarnRequisition',$namevalue);
}

?>

<div class="page-content">
  <!-- Main sidebar -->
  <?php include "left.php"; ?>
  <!-- /main sidebar -->
  <!-- Main content -->
  <div class="content-wrapper">
    <!-- Content area -->
    <div class="content pt-0" style="margin-top:20px; ">
      <!-- Dashboard content -->
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-white">
              <h6 class="card-title">
                <input type="radio" name="case" value="1" onclick="funcCheckCase();" <?php if($_GET['id']=='' || $editresultstyle['final_or_died_yarn']==1){ echo 'checked'; } ?> />
                <label for="javascript">Greige Yarn Procurement for final fabric</label>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="case" value="2" onclick="funcCheckCase();" <?php if($editresultstyle['final_or_died_yarn']==2){ echo 'checked'; } ?> />
                <label for="javascript">Greige yarn procurement for dyed yarn</label>
              </h6>
            </div>
          </div>
          <div class="card">
            <div class="card-header bg-white">
              <h6 class="card-title">
                <?php //echo $pageName; ?>
                <span id="heading"></span></h6>
            </div>

            <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
              <div class="card-body">
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Requisition No</label>
                        <input type="hidden" name="final_or_died_yarn" id="final_or_died_yarn" value="<?php if($editresultstyle['final_or_died_yarn']!=''){ echo $editresultstyle['final_or_died_yarn']; }else{  echo '1'; } ?>"  />
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
                        <label>Yarn Style No</label>
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

.select2-hidden-accessible {
    position:unset!important;
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
                <input type="hidden" name="action" value="yarnrequisition">
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
      <div class="row" style="">
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
                      <th style="text-align: center;"><a href="JavaScript:Void(0);" onclick="addNewRow(1)">+Add&nbsp;New</a></th>
                        <th>Item</th>
                        <th>Count</th>
                        <th>Construction</th>
                        <th class="gsm">GSM</th>
						<th class="fabWidth">Fabric Width</th>
                        <th>Qty/Cut</th>
                        <th>UOM</th>
                        <th>Excess %</th>
                        <th>Excess Qty Cut</th>
                        <th>SMPL</th>
                        <th>Total Pieces</th>
                        <th>Avg/Consum</th>
                        <th><span id="totalConsum"></span></th>
                        <?php
						$select='';
						$where='';
						$rs='';
						$select='*';
						$where=' 1 and deletestatus=0 order by id asc';
						$rspl=GetPageRecord($select,'processLossMaster',$where);
						while($rsplList=mysqli_fetch_array($rspl)){
						?>
                        <th><?php echo $rsplList['name']; ?></th>
                        <?php } ?>
                        <th>Price</th>
                        <th>Yarn Required</th>
						<th>Supplier</th>
                        <th style="display:none;">Currency</th>
                        <!--<?php if($_REQUEST['id']!=''){ ?>
                        <th>&nbsp;</th>
                        <?php } ?>-->
                        </thead>
                      <tbody id="loadtabledata" >
                      </tbody>
                    </table>
                    <script>
function addNewRow(addid){
  var lastid = '<?php echo encode($lastId); ?>';
  var supplierPurchaseOrderId = $('#ponumber').val();
  var caseid = $('input[name="case"]:checked').val();
  $('#loadtabledata').load('loadyarntable.php?action=addnewrow&editId=<?php echo $_REQUEST['id']; ?>&addsize='+addid+'&lastid='+lastid+'&caseid='+caseid);
}
addNewRow(0);

function deleterow(delrow){
   var lastid = '<?php echo encode($lastId); ?>';
   var caseid = $('input[name="case"]:checked').val();
  $('#loadtabledata').load('loadyarntable.php?deletestatus=yes&editId=<?php echo $_REQUEST['id']; ?>&lastid='+lastid+'&delrowid='+delrow+'&caseid='+caseid);
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
<script>
function funcCheckCase(){
	var caseid = $('input[name="case"]:checked').val();
	if(caseid==1){
		$('#totalConsum').text('Final(RTC) Fabric Req.');
		$('#heading').text('Fill Details For Final Fabric');
		$('#final_or_died_yarn').val(1);
		$('.gsm').show();
		$('.fabWidth').show();
	}else if(caseid==2){
		$('#totalConsum').text('Yarn Dyed Fabric Req.');
		$('#heading').text('Fill Details For Dyed Yarn');
		$('#final_or_died_yarn').val(2);
		$('.gsm').hide();
		$('.fabWidth').hide();
	}
}
funcCheckCase();
</script>
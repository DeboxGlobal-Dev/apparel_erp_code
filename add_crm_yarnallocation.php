<?php
if($loginuserprofileId==1){

$wheresearchassign=' 1 and ';

} else {

if($loginuserprofileId==92){

$wheresearchassign=' 1 and finalstatus="2" and assignTo in (select id from '._USER_MASTER_.' where empId in (select id from employeeMaster where (reportingTo='.$_SESSION['empid'].')) or assignTo="'.$_SESSION['userid'].'") and ';
} else{

$wheresearchassign=' ( id in (select styleId from styleAssignmentMaster where assignTo="'.$_SESSION['userid'].'" and styleAssignTo=0))';
$wheresearchassign=' '.$wheresearchassign.' and ';
}

}

if($loginuserprofileId==93){
$wheresearchassign='1 and finalstatus=2 and addedBy="'.$_SESSION['userid'].'" and ';
}

if($_GET['id']!=''){
$select='*';
$where='id="'.decode($_GET['id']).'"';
$rs=GetPageRecord($select,'yarnAllocation',$where);
$editresultstyle=mysqli_fetch_array($rs);
@extract($editresultstyle);
$lastId=$editresultstyle['id'];
$allocationNo = $allocationNo;


}

if($_GET['id']==''){

deleteRecord('yarnAllocation','tabstatus=0');
deleteRecord('yarnRequisition','tabstatus=0');

$allocationNo = 'Y-'.rand();
$namevalue ='addedBy="'.$_SESSION['userid'].'",allocationNo="'.$allocationNo.'"';
$lastId = addlistinggetlastid('yarnAllocation',$namevalue);
}


?>
<style>
.greigetable {
background: #fff;
display: none;
}
</style>
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
              <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf"
                  id="popid">
                  <div class="card-body">
                      <div class="form-group">
                          <div class="row">
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label>Allocation No</label>
                                      <input type="text" name="allocationNo" id="allocationNo"
                                          class="form-control readonly"
                                          value="<?php echo $allocationNo; ?>" />
                                  </div>
                              </div>

                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label>Allocation Date</label>
                                      <input type="text" name="allocationDate" id="allocationDate"
                                          class="form-control "
                                          value="<?php if($editresultstyle['allocationDate']!=''){ echo date('d-M-Y', strtotime($editresultstyle['allocationDate'])); }else{ echo date('d-M-Y'); } ?>"
                                          readonly />
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label>Style No</label>
                                      <select id="greigeStyleNo" name="greigeStyleNo" class=" form-control"
                                          displayname="styleNo" onchange="changeIndentNumber(this.value);">
                                          <option value="">Select</option>
                                          <?php
  $select='';
  $where='';
  $rs='';
  $select='*';
  $where=' 1 and seasonId!=0 and indentNumber!="" order by id asc';
  $rs=GetPageRecord($select,'yarnRequisition',$where);
  while($resListing=mysqli_fetch_array($rs)){
  ?>
                                          <option value="<?php echo strip($resListing['styleNo']); ?>"
                                              <?php if($resListing['styleNo']==$greigeStyleNo){ ?>selected="selected"
                                              <?php } ?>
                                              data-mytag="<?php echo strip($resListing['final_or_died_yarn']); ?>">
                                              <?php echo strip($resListing['styleNo']); ?></option>
                                          <?php } ?>
                                      </select>
                                  </div>
                              </div>


                          </div>

                          <div class="row" style="margin-top:10px;">
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label>Transfer From</label>
                                      <select id="indentNumber" name="indentNumber" class=" form-control"
                                          displayname="indentNumber">


                                      </select>
                                  </div>
                              </div>
                              <script>
                              function changeIndentNumber(greStyleNo) {
                                  var greStyleNo = encodeURI(greStyleNo);
                                  $('#indentNumber').load(
                                      'newaction.php?action=changeindentNumber&greStyleNo=' + greStyleNo +
                                      '&selectId=<?php echo $indentNumber; ?>');
                              }
                              changeIndentNumber('<?php echo $greigeStyleNo; ?>');
                              </script>
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label>Transfer To Style</label>
                                      <select id="styleId" name="styleId" class=" form-control"
                                          displayname="Season" onchange="loadindentdata(this.value,0,0);">
                                          <option value="">Select</option>
                                          <?php
  $select='';
  $where='';
  $rs='';
  $select='*';
  $where=' 1 and deletestatus=0 and (sampleStyle="1" or  sampleStyle="2")  order by id desc';
  $rs=GetPageRecord($select,'queryMaster',$where);
  while($resListing=mysqli_fetch_array($rs)){
  ?>
                                          <option value="<?php echo strip($resListing['id']); ?>"
                                              <?php if($resListing['id']==$styleId){ ?>selected="selected"
                                              <?php } ?>><?php echo strip($resListing['styleRefId']); ?>
                                          </option>
                                          <?php } ?>
                                      </select>
                                  </div>
                              </div>

<script>
function loadindentdata(styleId, allocationRowAddId, did) {
    // 	var indentid = $('#indentNumber').val();

    $('#indentNumber').val();
    var allocationNo = encodeURI("<?php echo $allocationNo; ?>");
    var tr = '<?php echo $_GET['id']; ?>'
    if (tr!= '') {
        var indentid = '<?php echo $indentNumber; ?>'

    } else {
        var indentid = $('#indentNumber').val();
    }
    var greStyleNo = $('#greigeStyleNo').val();
    greStyleNo = encodeURI(greStyleNo);
    var myTag = $('#greigeStyleNo').find('option:selected').attr('data-myTag');

    //alert(indentid);
    $('#loadtabledata').load(
        'loadyarnallocation.php?action=loadindenttabledata&indentid=' +
        indentid + '&styleId=' + styleId + '&allocationNo=' + allocationNo +
        '&allocationRowAddId=' + allocationRowAddId + '&did=' + did +
        '&greStyleNo=' + greStyleNo + '&diedYardCase2=' + myTag);
}
// loadindentdata('<?php echo $styleId; ?>');
$(function() {
    $("#allocationDate").datepicker({
        minDate: 0
    });
});
</script>



                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label>For Quarter</label>
                                      <select id="seasonId" name="seasonId" class=" form-control"
                                          displayname="Season">
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
                                          <option value="<?php echo strip($resListing['id']); ?>"
                                              <?php if($resListing['id']==$seasonId){ ?>selected="selected"
                                              <?php } ?>><?php echo strip($resListing['name']); ?></option>
                                          <?php } ?>
                                      </select>
                                  </div>
                              </div>
                          </div>

                          <div class="row" style="margin-top:10px;">
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label>Requested By</label>
                                      <input type="text" name="reqesBy" id="reqesBy"
                                          class="form-control readonly"
                                          value="<?php echo getUserName($_SESSION['userid']); ?>" />
                                      <input type="hidden" name="addedBy" id="addedBy" class="form-control"
                                          value="<?php echo $_SESSION['userid']; ?>" />
                                  </div>
                              </div>
                              <script>
                              $(document).ready(function() {

                                  //$("#brandId").select2();

                              });
                              </script>
                              <style>
                              .select2-search__field {

                                  display: none;

                              }
                              </style>

                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label>Brand</label>
                                      <select name="brandId" id="brandId" class="form-control ">
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
                                          <option value="<?php echo $resListing['id']; ?>"
                                              <?php  if($brandId==$resListing['id']){ ?>selected="selected"
                                              <?php }  ?>><?php echo $resListing['name']; ?></option>
                                          <?php } ?>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label>Quarter Used&nbsp;In</label>
                                      <select id="seasonUsedId" name="seasonUsedId" class=" form-control"
                                          displayname="Season">
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
                                          <option value="<?php echo strip($resListing['id']); ?>"
                                              <?php if($resListing['id']==$seasonUsedId){ ?>selected="selected"
                                              <?php } ?>><?php echo strip($resListing['name']); ?></option>
                                          <?php } ?>
                                      </select>
                                  </div>
                              </div>

                          </div>
                      </div>
                      <input type="hidden" name="editId" value="<?php echo encode($lastId); ?>">
                      <input type="hidden" name="action" value="yarnallocation">
                      <input type="hidden" name="module" value="<?php echo $_GET['module']; ?>">
                      <div class="text-right">
                          <button type="submit" style="margin:0px;" class="btn btn-primary">Save<i
                                  class="fa fa-floppy-o ml-2" aria-hidden="true"></i></button>
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
                          <!--<div style="padding:10px" id="availabeQtyDiv">
<span>Available Greige :10000</span>
</div>-->
                          <div class="col-md-12">
                              <table width="100%" class="table table-responsive table-bordered">
                                  <thead style="background: #ffffed;">
                                      <th></th>
                                      <th>Item</th>
                                      <!--<th>Initial Width</th>-->
                                      <!--                  <th>Proc.&nbsp;Width</th>-->
                                      <!--<th>Initial&nbsp;Cons.</th>-->
                                      <!--                  <th>Proc.&nbsp;Cons.</th>-->
                                      <th>Color-Qty</th>
                                      <th>Ready&nbsp;Fabric</th>
                                      <th>Ready&nbsp;Fabric Consu.</th>
                                      <th>Greige&nbsp;Consu.</th>
                                      <th>Color</th>
                                      <th>Order&nbsp;Qty.</th>
                                      <th style="display:none;">Greige&nbsp;Available</th>
                                      <th style="display:none;">Quantity Available</th>
                                      <th>Quantity Transferred</th>
                                      <!--<th>UOM</th>-->
                                  </thead>
                                  <tbody id="loadtabledata"></tbody>
                              </table>


                          </div>


                      </div>
                  </div>


              </div>
          </div>
      </div>
  </div>

  <div class="row greigetable">
      <div class="col-xl-12">
          <div class="card">
              <div class="card-header bg-white">
                  <h6 class="card-title">Style Fabric Details</h6>
              </div>
              <div class="card-body">
                  <div class="form-group">
                      <div class="row">
                          <div class="col-md-12">
                              <table width="100%" border="1" cellspacing="2" cellpadding="8"
                                  style="border:1px solid #ccc;">
                                  <thead style="background: #ffffed;">
                                      <th>Material ID</th>
                                      <th>Material Name</th>
                                      <th>Description</th>
                                      <th>Finish</th>
                                      <th>Width/Size</th>
                                      <th>Avg/Qty</th>
                                      <th>UOM</th>
                                      <th>Process Loss</th>
                                      <th>Avg/Loss</th>
                                  </thead>
                                  <tbody id="loadstylefabric">

                                  </tbody>
                              </table>
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
<?php
if($_GET['id']!=''){
?>
<script>
loadindentdata(<?php echo strip($styleId); ?>);
</script>
<?php
}
?>
<?php

if($_GET['id']!=''){
$select='*';
$where='id="'.decode($_GET['id']).'"';
$rs=GetPageRecord($select,'stockTransfer',$where);
$editresultstyle=mysqli_fetch_array($rs);
@extract($editresultstyle);
$lastId=$editresultstyle['id'];
$requisitionNo = $requisitionNo;
}

if($_GET['id']==''){
deleteRecord('stockTransfer','tabstatus=0');
$namevalue ='addedBy="'.$_SESSION['userid'].'"';
$lastId = addlistinggetlastid('stockTransfer',$namevalue);
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
                        <label>Transfer Type</label>
                         <select name="transferType" id="transferType" class="form-control <?php if($_GET['id']!=''){ echo "readonly"; }?>" onchange="funGetVal(this.value);">
						 	<option value="">Select</option>
							<option value="Loan Issuannce" <?php if($transferType=="Loan Issuannce"){ echo "selected"; }?>>Loan Issuannce</option>
							<option value="Loan Reversal" <?php if($transferType=="Loan Reversal"){ echo "selected"; }?>>Loan Reversal</option>
							<option value="For Consumption" <?php if($transferType=="For Consumption"){ echo "selected"; }?>>For Consumption</option>
						 </select>
                      </div>
                    </div>
<?php
if($_GET['id']==''){
?>
<script>
function funGetVal(name){
	if(name=="Loan Issuannce"){
		var reqNo = "LI-<?php echo rand(); ?>";
		$("#loadIssuanceNumber").addClass("readonly");
	}else if(name=="Loan Reversal"){
		var reqNo = "LR-<?php echo rand(); ?>";
		$("#loadIssuanceNumber").removeClass("readonly");
	}else if(name=="For Consumption"){
		var reqNo = "FR-<?php echo rand(); ?>";
		$("#loadIssuanceNumber").addClass("readonly");
	}else{

	}
	$('#requisitionNo').val(reqNo);
}
</script>
<?php
}
?>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Transfer Requisition No</label>
                        <input type="text" name="requisitionNo" id="requisitionNo" class="form-control readonly" value="<?php echo $requisitionNo; ?>"  />
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Transfer Requisition Date</label>
                        <input type="text" name="requisitionDate" id="requisitionDate" class="form-control " value="<?php if($editresultstyle['requisitionDate']=='0000-00-00'){ echo date('d-M-Y'); }else{ echo date('d-M-Y', strtotime($editresultstyle['requisitionDate'])); } ?>" readonly/>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                      <label>From Style</label>
                        <select id="fromStyle" name="fromStyle" class=" form-control" displayname="fromStyle" onchange="getIndentFrom(this.value);">
                          <option value="">Select</option>
						 <?php
						$select='';
						$where='';
						$rs='';
						$select='*';
						$where='1 and indentNumber!="" order by id desc';
						$rs=GetPageRecord($select,'buyerPurchaseOrderMaster',$where);
						while($resListing=mysqli_fetch_array($rs)){
						?>
						<option value="<?php echo strip($resListing['styleId']); ?>" <?php if($resListing['styleId']==$fromStyle){ ?>selected="selected"<?php } ?>><?php echo getStyleRefId($resListing['styleId']); ?></option>
						<?php } ?>
                        </select>
                      </div>
                    </div>

                  </div>
                  <div class="row" style="margin-top:10px;">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>To Style </label>
                        <select id="toStyle" name="toStyle" class=" form-control" displayname="toStyle" onchange="getIndentTo(this.value);">
                         <option value="">Select</option>
						<?php
						$select='';
						$where='';
						$rs='';
						$select='*';
						$where=' 1 and indentNumber!="" order by id desc';
						$rs=GetPageRecord($select,'buyerPurchaseOrderMaster',$where);
						while($resListing=mysqli_fetch_array($rs)){
						?>
						<option value="<?php echo strip($resListing['styleId']); ?>" <?php if($resListing['styleId']==$toStyle){ ?>selected="selected"<?php } ?>><?php echo getStyleRefId($resListing['styleId']); ?></option>
						<?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Caterory</label>
                        <select name="categoryId" id="categoryId" class="form-control">
                          <option value="">Select</option>
                          <?php
							$select='';
							$where='';
							$rs='';
							$select='*';
							$where=' 1  order by name asc';
							$rs=GetPageRecord($select,'materialTypeMaster',$where);
							while($resListing=mysqli_fetch_array($rs)){
							?>
                          <option value="<?php echo $resListing['id']; ?>" <?php if($resListing['id']==$categoryId){ ?>selected="selected"<?php } ?>><?php echo $resListing['name']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>From Indent</label>
                        <select id="fromIndent" name="fromIndent" class=" form-control" displayname="fromStyle" >

                        </select>

                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>To Indent</label>
                        <select id="toIndent" name="toIndent" class=" form-control" displayname="Season">

                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row" style="margin-top:10px;">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Purpose Reason</label>
                        <input type="text" name="reason" id="reason" class="form-control" value="<?php echo $reason; ?>"  />
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>From Store</label>
                        <select id="fromStore" name="fromStore" class=" form-control" displayname="Season">
                          <option value="">Select</option>
                          <?php
		  	                  $rs111111=GetPageRecord('*','departmentMaster','1 order by id asc');
                          while($userss1111=mysqli_fetch_array($rs111111)){ ?>
                          <option value="<?php echo $userss1111['id']; ?>" <?php if($editresultstyle['fromStore']==$userss1111['id']){ echo "selected"; } ?>><?php echo $userss1111['name']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>To Store</label>
                        <select id="toStore" name="toStore" class=" form-control" displayname="Season">
                          <option value="">Select</option>
                          <?php
		  	                  $rs111111=GetPageRecord('*','departmentMaster','1 order by id asc');
                          while($userss1111=mysqli_fetch_array($rs111111)){ ?>
                          <option value="<?php echo $userss1111['id']; ?>" <?php if($editresultstyle['toStore']==$userss1111['id']){ echo "selected"; } ?>><?php echo $userss1111['name']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3" style="display:none;">
                      <div class="form-group">
                        <label>Generated By</label>
                        <input type="text" name="addedBy" id="addedBy" class="form-control" value="" readonly=""  />
                      </div>
                    </div>
					<div class="col-md-3">
                      <div class="form-group">
                        <label>Loan Issuance Number</label>
                        <input type="text" name="loadIssuanceNumber" id="loadIssuanceNumber" class="form-control <?php if($_GET['id']!=''){ echo "readonly"; }?>" value="<?php echo $loadIssuanceNumber; ?>"  />
                      </div>
                    </div>
                  </div>
                  <div class="row" style="margin-top:10px;">

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control">
                          <option value="0" <?php if(0==$status){ ?>selected="selected"<?php } ?>>Pending</option>
                          <option value="1"  <?php if(1==$status){ ?>selected="selected"<?php } ?>>Approve</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3" style="display:none;">
                      <div class="form-group">
                        <label>Approved By</label>
                        <input type="text" name="a" id="a" class="form-control" value=""  />
                      </div>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="editId" value="<?php echo encode($lastId); ?>">
                <input type="hidden" name="action" value="stockTransfer">
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
          <div class="card mb-0 rounded-bottom-0" style="padding:15px;">
            <div class="panel panel-flat">
              <div class="table-responsive">
                <div id="add_indentmpl">
                  <table width="100%" border="1" cellspacing="2" cellpadding="8" style="border:1px solid #ccc;">
                      <thead style="background: #ffffed;">
                        <th>From Indent</th>
                        <th>To Indent</th>
                        <th>Quantity Available</th>
                        <th>Quantity Transfered</th>
                        <th>UOM</th>
						<th style="text-align: center;"><a href="javascript:void(0);" onclick="addnewline(1);">+Add&nbsp;New</a></strong></th>
                     </thead>
                      <tbody id="loadtabledata" style="">
                      </tbody>
					<script>
					function addnewline(did){
						var lastid = '<?php echo encode($lastId); ?>';
						var fromStyle = $('#fromStyle').val();
						var toStyle = $('#toStyle').val();
						var categoryId = $('#categoryId').val();
						$('#loadtabledata').load('loadstocktransfer.php?action=addnewrow&addsize='+did+'&id='+lastid+'&fromStyle='+fromStyle+'&toStyle='+toStyle+'&categoryId='+categoryId);
					}
					addnewline(0);
					</script>

					<script>
					function deleterow(deleteid){
						var fromStyle = $('#fromStyle').val();
						var toStyle = $('#toStyle').val();
						var categoryId = $('#categoryId').val();
						$('#loadtabledata').load('loadstocktransfer.php?deletestatus=yes&id=<?php echo encode($lastId); ?>&rowid='+deleteid+'&fromStyle='+fromStyle+'&toStyle='+toStyle+'&categoryId='+categoryId);
					}
					</script>

                  </table>
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
function getIndentFrom(syleid){
	$('#fromIndent').load('newaction.php?action=loadfromindent&selectedId=<?php echo $fromIndent; ?>&styleId='+syleid);
}
getIndentFrom('<?php echo $fromStyle; ?>')

function getIndentTo(syleid){
	$('#toIndent').load('newaction.php?action=loadtoindent&selectedId=<?php echo $toIndent; ?>&styleId='+syleid);
}
getIndentTo('<?php echo $toStyle; ?>')
</script>
<script>
$( function(){
	$( "#requisitionDate" ).datepicker({ minDate: 0 });
} );
</script>

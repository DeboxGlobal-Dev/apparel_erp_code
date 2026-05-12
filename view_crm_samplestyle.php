<?php
$select='*';
$id=clean(decode($_GET['id']));
$where='id='.$id.'';
$rs=GetPageRecord($select,_QUERY_MASTER_,$where);
$resultpage=mysqli_fetch_array($rs);

//echo $resultpage['id'];

$selectimg='*';
$whereimg='parentId="'.$resultpage['id'].'" and galleryType="image_gallery" order by id asc';
$rsimg=GetPageRecord($selectimg,'imageGallery',$whereimg);
$imgresult=mysqli_fetch_array($rsimg);


$select='';
$where='';
$rs='';
$select='*';
$where='styleId="'.$id.'" and statusId!=0 order by id desc';
$rs=GetPageRecord($select,'styleAssignmentMaster',$where);
$result=mysqli_fetch_array($rs);

$select1='*';
$where1='id="'.$result['statusId'].'" order by id desc';
$rs1=GetPageRecord($select1,'statusMaster',$where1);
$result1=mysqli_fetch_array($rs1);


if($_GET['d']!=''){
//delete style
$namevalue1 = 'deletestatus=1';
$whereval='id="'.decode($_GET['d']).'"';
updatelisting('queryMaster',$namevalue1,$whereval);
}

?>

<div class="page-content">
  <!-- Main sidebar -->
  <?php include "left.php"; ?>
  <div class="content-wrapper">
  <?php if(isset($_SESSION['MSG'])!=''){ ?>
        <span class="badge d-block badge-success form-text text-center" style="font-size: 12px; padding: 10px; width: 97% !important; margin: auto; margin-top: 20px; border: 2px dotted #ffffff;"><?php echo $_SESSION['MSG'];unset($_SESSION['MSG']); ?></span>
    <?php } ?>
    <div class="content pt-0" style="margin-top:20px;">
      <div class="row">
        <?php include "left-style.php" ?>
        <div class="col-xl-6" style="padding:0px;">
          <div class="card">
            <div class="card-body navbar-green"   >
              <div class="media">
                <div class="col-xl-6" style="padding:0px;">
                  <h6 class="media-title font-weight-semibold">Communications</h6>
                </div>
                <div class="col-xl-6" style="text-align:right;padding:0px;">
                  <div class="d-flex align-items-center" style="float:right; ">
                    <?php if($result1['id']!='13' && $result1['id']!='14' ) { ?>
                    <button type="button" class="btn bg-blue-400 btn-labeled btn-labeled-right ml-auto" name="stylemailreply" id="stylemailreply" onclick="stylemailreply();" style="margin-right: 0px;
    padding: 2px 36px 2px 10px;"> <b><i class="fa fa-reply" aria-hidden="true" style="font-size: 8px;
    padding: 0px;
    line-height: 6px;"></i></b> Reply </button>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <ul class="nav nav-tabs nav-tabs-solid nav-justified rounded border-0" style="font-weight: 600;">
                <li class="nav-item"  onclick="funloadbuyercommunication();"><a href="#solid-rounded-justified-tab1" class="nav-link active show" data-toggle="tab"> Internal</a></li>
                <li class="nav-item"><a href="#solid-rounded-justified-tab2" class="nav-link rounded-left" data-toggle="tab">Buyer</a></li>
                <li class="nav-item" onclick="funloadsuppliercommunication();"><a href="#solid-rounded-justified-tab3" class="nav-link rounded-left" data-toggle="tab">Supplier</a></li>
                <li class="nav-item" onclick="funloadvendorcommunication();"><a href="#solid-rounded-justified-tab4" class="nav-link rounded-left" data-toggle="tab">Vendor</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active show" id="solid-rounded-justified-tab1" >
                  <div id="loadstylereply"></div>
                  <div id="loadbuyercommunication"></div>
                </div>
                <div class="tab-pane fade" id="solid-rounded-justified-tab2"> Buyer Communication </div>
                <div class="tab-pane fade" id="solid-rounded-justified-tab3">
                  <div id="loadsuppliercommunication"></div>
                </div>
                <div class="tab-pane fade" id="solid-rounded-justified-tab4">
                  <div id="loadvendorcommunication"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3">
          <div class="card">
            <div class="card-body navbar-dark" style="background-image: url(http://demo.interface.club/limitless/assets/images/bg.png);">
              <div class="media" style="float:left;">
                <div class="mr-3 align-self-center">
                  <h6 class="media-title font-weight-semibold">Actions</h6>
                </div>
              </div>
              <div class="d-flex align-items-center" style="float:right;margin-right:0px;"> <a href="showpage.crm?module=style">
                <button type="button" class="btn bg-grey-400 btn-labeled btn-labeled-right ml-auto" style="margin-right: 0px;
				padding: 2px 36px 2px 10px;"><b><i class="fa fa-arrow-left" aria-hidden="true" style="font-size: 8px;
				padding: 0px;
				line-height: 6px;"></i></b>Back</button>
                </a> </div>
            </div>
            <div class="list-group list-group-flush">
              <?php if($result1['id']=='13' || $resultpage['stylestatus']=='0'){ ?>
              <!--<a href="#" onclick="opmodalpop('Change Status','modalpop.php?action=acceptreject&styleId=<?php echo $_GET['id']; ?>&styleTypeId=<?php echo $resultpage['styleTypeId']; ?>','400px','auto');" data-toggle="modal" data-target="#modalpop" class="list-group-item list-group-item-action">
									<i class="fa fa-shirtsinbulk  mr-3" aria-hidden="true"></i>
									Change Status	</a>-->
              <?php } ?>
              <?php
								////////////////////////////////////////////////////////
								?>
              <a href="#" onclick="opmodalpop('Assign Style ','modalpop.php?action=assignStyle&styleId=<?php echo $_GET['id']; ?>&buyerId=<?php echo $resultpage['buyerId']; ?>&brandId=<?php echo $resultpage['brandId']; ?>','400px','auto');" data-toggle="modal" data-target="#modalpop" class="list-group-item list-group-item-action"> <i class="fa fa-shirtsinbulk  mr-3" aria-hidden="true"></i>Assign To
              <!--<span class="badge" style=" background-color:#ff9933;  color:#fff; position: relative; margin-left: 24px;">  sdsfsd</span>	-->
              </a>
              <?php if($result1['id']=='6'){ ?>
              <a onclick="assigntopurchasesubmit();" class="list-group-item list-group-item-action" style="cursor:pointer;"> <i class="fa fa-users   mr-3" aria-hidden="true"></i> Assign To Purchase </a>
              <?php } ?>
              <div id="assigntopurchasesubmit" style="display:none;"></div>
              <script>
								function assigntopurchasesubmit(){
				                $('#assigntopurchasesubmit').load("allaction.php?action=assigntopurchasestatus&styleId=<?php echo $_GET['id']; ?>");
								}
								</script>
              <?php if($result1['id']=='16'){ ?>
              <a onclick="estimatecostsheetsubmit();" class="list-group-item list-group-item-action" style="cursor:pointer;"> <i class="fa fa-check-circle   mr-3" aria-hidden="true"></i> Estimate Cost Sheet </a>
              <?php } ?>
              <div id="estimatecostsheetsubmit" style="display:none;"></div>
              <script>
								function estimatecostsheetsubmit(){
				                $('#estimatecostsheetsubmit').load("allaction.php?action=estimatecostsheet&styleId=<?php echo $_GET['id']; ?>");
								}
								</script>
              <?php if($result1['id']=='10'){ ?>
              <a href="#" class="list-group-item list-group-item-action"> <i class="fa fa-list  mr-3" aria-hidden="true"></i> Assign To Senior </a>
              <?php } ?>
              <?php if($result1['id']=='11'){ ?>
              <a href="#" class="list-group-item list-group-item-action"> <i class="fa fa-list  mr-3" aria-hidden="true"></i> Dispatch To Buyer </a>
              <?php } ?>
              <?php if($editpermission==1){ ?>
              <a href="showpage.crm?module=techpack&add=yes&styleid=<?php echo encode($resultpage['id']); ?>" class="list-group-item list-group-item-action"> <i class="fa fa-angle-double-right  mr-3" aria-hidden="true"></i> Enter Tech-Pack </a> <a href="showpage.crm?module=samplestyle&edit=yes&id=<?php echo encode($resultpage['id']); ?>&styleid=<?php echo encode($resultpage['id']); ?>" class="list-group-item list-group-item-action"> <i class="fa fa-pencil  mr-3" aria-hidden="true"></i> Edit Style </a>
              <?php } ?>
              <?php if($deletepermission==1){ ?>
              <a href="#" class="list-group-item list-group-item-action" onclick="deletestyle('<?php echo encode($resultpage['id']); ?>');"> <i class="fa fa-trash  mr-3" aria-hidden="true" ></i> Delete Style</a>
              <?php } ?>
              <!--<a href="showpage.crm?module=timeandaction&add=yes&styleid=<?php echo encode($resultpage['id']); ?>" class="list-group-item list-group-item-action">
									<i class="fa fa-clock-o mr-3"></i>
									Make TNA(Time & Action)								</a>-->
              <?php if($loginuserprofileId!='153'){ ?>
              <?php if($editpermission==1){ ?>
              <a href="showpage.crm?module=materiallist&add=yes&styleid=<?php echo encode($resultpage['id']); ?>" class="list-group-item list-group-item-action"><i class="fa fa-angle-double-right  mr-3" aria-hidden="true"></i>Analyse Material List</a> <a href="showpage.crm?module=materialcost&add=yes&styleid=<?php echo encode($resultpage['id']); ?>" class="list-group-item list-group-item-action"><i class="fa fa-angle-double-right  mr-3" aria-hidden="true"></i>Material Cost</a> <a href="showpage.crm?module=prototypesample&add=yes&styleid=<?php echo encode($resultpage['id']); ?>" class="list-group-item list-group-item-action"><i class="fa fa-angle-double-right  mr-3" aria-hidden="true"></i>Prototype Sample</a>
              <?php } ?>
              <?php } ?>
              <a href="showpage.crm?module=chaalanmaster&add=yes&styleid=<?php echo encode($resultpage['id']); ?>" class="list-group-item list-group-item-action"><i class="fa fa-angle-double-right  mr-3" aria-hidden="true"></i>Create Challan</a>
              <?php if($result1['id']=='3'){ ?>
              <a href="showpage.crm?module=pattern&add=yes&styleid=<?php echo encode($resultpage['id']); ?>" class="list-group-item list-group-item-action" style="background: #fff;"><i class="fa fa-angle-double-right  mr-3" aria-hidden="true"></i>Pattern </a>
              <?php } ?>
              <?php if($result1['id']=='5'){ ?>
              <a href="showpage.crm?module=marker&add=yes&styleid=<?php echo encode($resultpage['id']); ?>" class="list-group-item list-group-item-action" style="background: #fff;"><i class="fa fa-angle-double-right  mr-3" aria-hidden="true"></i>Marker </a>
              <?php } ?>
              <?php if($result1['id']=='16'){ ?>
              <a href="showpage.crm?module=materialcost&add=yes&styleid=<?php echo encode($resultpage['id']); ?>" class="list-group-item list-group-item-action" style="background: #fff;"><i class="fa fa-angle-double-right mr-3" aria-hidden="true"></i>Purchase </a>
              <?php } ?>
              <?php if($result1['id']=='17'){ ?>
              <a href="showpage.crm?module=costsheet&add=yes&styleid=<?php echo encode($resultpage['id']); ?>" class="list-group-item list-group-item-action" style="background: #fff;"><i class="fa fa-angle-double-right mr-3" aria-hidden="true"></i>Estimate Cost Sheet </a>
              <?php } ?>
              <?php if($loginuserprofileId=='156' || $loginuserprofileId=='90'){ ?>
              <a href="#" onclick="opmodalpop('Assign To Vendor','modalpop.php?action=sendtopdoutsource&styleId=<?php echo $_GET['id']; ?>&styleTypeId=<?php echo $resultpage['styleTypeId']; ?>','400px','auto');" data-toggle="modal" data-target="#modalpop" class="list-group-item list-group-item-action" target="blank_"> <i class="fa fa-users  mr-3" aria-hidden="true"></i>Assign To Vendor</a>
              <!--<a href="#"  class="list-group-item list-group-item-action" target="blank_">
									<i class="fa fa-close mr-3" aria-hidden="true" style="color:#FF0000;"></i>Reject Style</a>	-->
              <a href="showpage.crm?module=comparevendorcost&view=yes&styleid=<?php echo $_GET['id']; ?>&pdoutsource=yes" class="list-group-item list-group-item-action" style="background: #fff;" target="_blank"><i class="fa fa-angle-double-right mr-3" aria-hidden="true"></i>Compare Cost</a>
              <?php } ?>
              <?php if($loginuserprofileId=='1' || $loginuserprofileId=='93'){ ?>
              <a href="showpage.crm?module=comparevendorcost&view=yes&styleid=<?php echo $_GET['id']; ?>&pdoutsource=yes" class="list-group-item list-group-item-action" style="background: #fff;" target="_blank"><i class="fa fa-angle-double-right mr-3" aria-hidden="true"></i>Compare Cost</a>
              <?php } ?>
            </div>
          </div>
          <div class="card">
            <div class="card card-body bg-blue-400" style="background-image: url(http://demo.interface.club/limitless/assets/images/bg.png);margin-bottom:0px;border-radius:0px; background-color:<?php echo $result1['statusColor']; ?>"  >
              <div class="media">
                <div class="media-body text-left" >
                  <!--<h6 class="media-title font-weight-semibold"><?php echo getDepartmentName($result1['departmentId']).' - '.$result1['name']; ?></h6>-->
                  <?php
									$select='';
									$where='';
									$rs='';
									$select='*';
									$where='styleId="'.$id.'" and stageStatus=0 and assignTo!=0 order by id desc';
									$rs=GetPageRecord($select,'styleAssignmentMaster',$where);
									while($result=mysqli_fetch_array($rs)){
									?>
                  &#9658 <span style="color: #fff;z-index: 9999;font-size: 13px;">Assign To - <?php echo getUserName($result['assignTo']); ?> [<?php echo getProfileName($result['profileId']); ?>]</span><br />
                  <?php } ?>
                  <!--<span class="opacity-75"><?php echo date('d M, Y - h:i A',$result['dateAdded']); ?></span>-->
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <?php if($resultpage['stylestatus']!='0'){ ?>
            <div class="card-header header-elements-inline">
              <h6 class="card-title">Notes</h6>
              <span style="padding: 5px 10px; background: #2196f3; color: #fff; font-size: 9px; font-weight: 500; cursor: pointer; border-radius: 2px;" onclick="opmodalpop('Add Notes','modalpop.php?action=addnotes&styleId=<?php echo $_GET['id']; ?>','400px','auto');" data-toggle="modal" data-target="#modalpop">+ Add Notes</span> </div>
            <?php } ?>
            <div>
              <div class="card-body" style="height: 330px;overflow-y: scroll;">
                <ul class="media-list" style="padding-top:20px;">
                  <?php
									$select='';
									$where='';
									$rs='';
									$select='*';
									$where='styleId="'.$id.'" order by id desc';
									$rs=GetPageRecord($select,'styleAssignmentMaster',$where);
									while($result=mysqli_fetch_array($rs)){
									?>
                  <li class="media">
                    <div class="mr-1" style="padding: 0px;
    margin: 0px;
    width: 23px;"> <a href="#" class="btn bg-transparent border-grey-400 text-blue-400 rounded-round border-0 btn-icon" style="color:#2196f3;"> <i class="icon-comment" style="margin-left: -7px;
    top: -4px;"></i> </a> </div>
                    <div class="media-body">
                      <?php
										if($result['assignTo']=='0'){
										?>
                      <strong><?php echo getUserName($result['addedBy']); ?></strong> <span class=""> Added Note: </span><?php echo ' - '.$result['notes']; ?>
                      <?php } else{ ?>
                      <strong><?php echo getUserName($result['addedBy']); ?></strong> Assigned To <span class=""><?php echo getUserName($result['assignTo']); ?>[<?php echo getProfileName($result['profileId']); ?>]</span><?php echo ' - '.$result['notes']; ?>
                      <?php }?>
                      <div class="text-muted font-size-sm"><?php echo date('d M, Y - h:i A',$result['dateAdded']); ?></div>
                    </div>
                  </li>
                  <style>
.{
font-weight: 500;
font-size: 12px;
color: #5c6bc0;
text-transform: uppercase;
}
</style>
                  <?php } ?>
                </ul>
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
 function funloadbuyercommunication(){

 $('#loadbuyercommunication').load('loadbuyercommunication.php?id=<?php echo decode($_REQUEST['id']); ?>');
 }

 function stylemailreply(){
 $('#loadstylereply').show();
 $('#loadstylereply').load('loadstylereply.php?styleid=<?php echo decode($_REQUEST['id']); ?>&assignTo=<?php echo  $resultpage['assignTo']; ?>');
 $('#stylemailreply').hide();
 }



 $(document).ready(function() {
  funloadbuyercommunication();
  });
 </script>
<script>
 function funloadvendorcommunication(){

 $('#loadvendorcommunication').load('loadvendorcommunication.php?id=<?php echo decode($_REQUEST['id']); ?>&module=<?php echo $_GET['module']; ?>');
 }

 funloadvendorcommunication();

 </script>
<script>
 function funloadsuppliercommunication(){

 $('#loadsuppliercommunication').load('loadsuppliercommunicationpurchase.php?id=<?php echo decode($_REQUEST['id']); ?>&module=<?php echo $_GET['module']; ?>');

 }

 funloadsuppliercommunication();

 </script>
<script>
function deletestyle(id){
var delStyle = confirm('Are you sure you want to delete this style?');
if(delStyle==true){
window.location.href = 'showpage.crm?module=style&d='+id; //delete style
}
}
</script>

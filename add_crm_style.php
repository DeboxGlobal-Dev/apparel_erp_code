<?php

//$updatepage='1';

if($_GET['id']==''){
$where=' subject="" and  addedBy='.$_SESSION['userid'].'';
deleteRecord('queryMaster',$where);

$dateAdded=time();
$namevalue ='subject="",addedBy='.$_SESSION['userid'].',dateAdded='.$dateAdded.'';
$lastId = addlistinggetlastid('queryMaster',$namevalue);

}

if($_GET['id']!=''){
$select1='*';
$where1='id="'.decode($_GET['id']).'"';
$rs1=GetPageRecord($select1,'queryMaster',$where1);
$editresult=mysqli_fetch_array($rs1);
$editId=clean($editresult['id']);
$lastId=$editresult['id'];
}



$mailid=decode($_REQUEST['mailid']);


if($mailid!=''){



include('incomingMailSetting.php');
$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to domain:' . imap_last_error());
$emails = imap_search($inbox,'ALL');
if($emails){
$output = '';
rsort($emails);
$totalmail=0;
$n=1;
foreach($emails as $email_number) {
if($email_number==$mailid){
$subject='';
$message='';
$body='';
$email='';
$date='';

$overview = imap_fetch_overview($inbox,$email_number,0);
$subject = $subject=$overview[0]->subject;
$message='';
	$message = (imap_fetchbody($inbox,$email_number,'2'));
	if (count(explode(' ', trim($message))) > 2) {} else {
	$message = nl2br(imap_fetchbody($inbox,$email_number,1.1));
	$g='1';

	}



	if(trim($message)=='' && $g!='1'){

	$message = nl2br(imap_fetchbody($inbox,$email_number,'1'));
	}





   $mailUserName = addslashes(strip_tags($overview[0]->from));
$email=$mailUserName=$overview[0]->from;
$ccemail=$from=$overview[0]->cc;



preg_match_all('/[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}/i', $email, $found_mails);
$email= str_replace('["','',json_encode($found_mails[0]));
$email=  str_replace('"]','',$email);

$timestamp = strtotime($date=$overview[0]->date);
date_default_timezone_set('asia/kolkata');
$maildate = date('Y-m-d H:i:s',$timestamp);










    /* get information specific to this email */
    $overview = imap_fetch_overview($inbox,$email_number,0);
    $structure = imap_fetchstructure($inbox,$email_number);




     $attachments = array();
       if(isset($structure->parts) && count($structure->parts)) {
         for($i = 0; $i < count($structure->parts); $i++) {
           $attachments[$i] = array(
              'is_attachment' => false,
              'filename' => '',
              'name' => '',
              'attachment' => '');

           if($structure->parts[$i]->ifdparameters) {
             foreach($structure->parts[$i]->dparameters as $object) {
               if(strtolower($object->attribute) == 'filename') {
                 $attachments[$i]['is_attachment'] = true;
                 $attachments[$i]['filename'] = $object->value;
               }
             }
           }

           if($structure->parts[$i]->ifparameters) {
             foreach($structure->parts[$i]->parameters as $object) {
               if(strtolower($object->attribute) == 'name') {
                 $attachments[$i]['is_attachment'] = true;
                 $attachments[$i]['name'] = $object->value;
               }
             }
           }

           if($attachments[$i]['is_attachment']) {
             $attachments[$i]['attachment'] = imap_fetchbody($inbox, $email_number, $i+1);
             if($structure->parts[$i]->encoding == 3) { // 3 = BASE64
               $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
             }
             elseif($structure->parts[$i]->encoding == 4) { // 4 = QUOTED-PRINTABLE
               $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
             }
           }
         } // for($i = 0; $i < count($structure->parts); $i++)
       } // if(isset($structure->parts) && count($structure->parts))

	$filenames='';
    if(count($attachments)!=0){
        foreach($attachments as $at){
            if($at['is_attachment']==1){

			 $filenames.=trim($at['filename']).',';

                file_put_contents('attachment/'.date('d-m-Y-H:i:s',$timestamp).'-'.$at['filename'], $at['attachment']);
            }
        }
    }






     } }}




}

?>


<div class="page-content">
  <!-- Main content -->
  <div class="content-wrapper">
    <!-- Content area -->
    <div class="content pt-0" style="margin-top:20px;">

	  <form action="ac.crm" method="post" class="submitstyleform" enctype="multipart/form-data" name="popid" target="acf" id="popid" style="display:non1e;">
        <!-- Dashboard content -->
        <div class="row">
          <div class="col-xl-<?php if($mailid!=''){ echo '7'; } else { echo '12'; } ?>">
            <div class="card">
              <div class="card-header bg-white">
                <h6 class="card-title">Style Information</h6>
              </div>
              <div class="card-body">
                <?php if($updatepage=='1'){ ?>
                <span class="badge d-block badge-info form-text text-center" style="margin-bottom: 20px; font-size: 12px; padding: 10px;">Successfully Updated</span>
                <?php } ?>

                <div class="form-group">
                  <div class="row">
                    <div class="col-md-2">
					  <div class="form-group">
						<label>Style Type</label>
						<select id="sampleStyle" name="sampleStyle" class="form-control" displayname="Brand" disabled="disabled">
						<option value="1" selected>Bulk</option>

						</select>
					  </div>
					</div>
          <div class="col-md-2">
                      <div class="form-group">
                        <label>Buyer</label>
                        <select id="buyerId" name="buyerId" class="form-control" displayname="Buyer" onchange="changeBuyer(this.value,1);changeBrand(this.value,1);">
							<option value="">Select</option>
							<option value="100" <?php if('100'==$editresult['buyerId']){ ?>selected="selected"<?php } ?>>Self</option>
							<?php
							$select='';
							$where='';
							$rs='';
							$select='*';

							if($loginuserprofileId==1){
							$where=' deletestatus=0 and status=1 order by name asc';
							$rs=GetPageRecord($select,_BUYER_MASTER_,$where);
							while($resListing=mysqli_fetch_array($rs)){
							?>
							<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$editresult['buyerId']){ ?>selected="selected"<?php } ?>><?php echo getBuyerName(strip($resListing['id'])); ?></option>
							<?php }
							}else{
							$where='profileId="'.trim($loginuserprofileId).'" and (FIND_IN_SET('.$_SESSION['userid'].',assignTo) or assignTo=0) group by buyerId';
							$rs=GetPageRecord('*','resourceAllocationBrandWise',$where);
							while($resListing=mysqli_fetch_array($rs)){
							?>
							<option value="<?php echo strip($resListing['buyerId']); ?>" <?php if($resListing['buyerId']==$editresult['buyerId']){ ?>selected="selected"<?php } ?>><?php echo getBuyerName(strip($resListing['buyerId'])); ?></option>
							<?php } } ?>


                        </select>
                      </div>
                    </div>




					<div class="col-md-1">
					  <div class="form-group">
						<label>Brand</label>
						<select id="brandId" name="brandId" class="form-control" displayname="Brand" onchange="funChangeBrand(this.value);">
						<option value="">Select</option>

						      <?php
                // $select1a='*';

                // $where1a='1';

                // $rs1a=GetPageRecord($select1a,'brandMaster',$where1a);

                // while($editresulta=mysqli_fetch_array($rs1a)){

                ?>

                <!--<option value="<?php echo $editresulta['id']; ?>"<?php if( $editresulta['id']==  $editresult['brandId']){ ?> selected <?php } ?>><?php echo $editresulta['name']; ?></option>-->
                <?php //} ?>
						</select>
					  </div>
					</div>

					<div class="col-md-1">
					  <div class="form-group">
						<label>Season</label>
						<select id="seasonId" name="seasonId" class=" form-control" displayname="Season">
						<option value="">Select</option>
						</select>
					  </div>
					</div>

					 <div class="col-md-3">
                      <div class="row">

					<div class="col-md-6">
                      <div class="form-group">
						  <label>Segment</label>
                        <select id="segment" name="segment" class="form-control" displayname="" onchange="selectCategory();">
                          <option value="">Select</option>
                          <?php
							$aa=GetPageRecord('*','segmenteMaster','1 and deletestatus=0 order by name');
							while($segData=mysqli_fetch_array($aa)){
							?>
 <option value="<?php echo $segData['id']; ?>" <?php if($segData['id']==$editresult['segment']){ ?>selected="selected"<?php } ?>><?php echo $segData['name']; ?></option>
						 <?php } ?>

                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Category&nbsp;<span style="color:red;">*</span></label>
                        <select id="categoryId" name="categoryId" class="validate form-control" displayname="Category" onchange="selectsubcategory();">
                          <option value="">Select</option>
                        </select>
                      </div>
                    </div>

		 </div>
		 </div>

<script>
function selectCategory(){
var segment = $('#segment').val();
$('#categoryId').load('loadcategory.php?id='+segment+'&selectId=<?php echo $editresult['categoryId']; ?>');
}
<?php
if($_GET['id']!=''){
?>
selectCategory();
<?php } ?>
</script>


<script>
function changeBuyer(buyerId,up){
	$('#brandId').load('loadbrand.php?buyerId='+buyerId+'&selectId=<?php echo $editresult['brandId']; ?>&action=changebrandaction&valid='+up);
}

<?php
if($_GET['id']!=''){
?>
changeBuyer(<?php echo $editresult['buyerId']; ?>,0);
<?php } ?>

function changeBrand(brandId,up){


$('#seasonId').load('loadseason.php?brandId='+brandId+'&selectId=<?php echo $editresult['seasonId']; ?>&action=changeseasonaction&valid='+up);

// $('#segment').load('loadseason.php?brandId='+brandId+'&selectId=<?php echo $editresult['segment']; ?>&action=changesegmentaction');

}
<?php
if($_GET['id']!=''){
?>
changeBrand(<?php echo $editresult['buyerId']; ?>,0);
<?php } ?>
</script>
                    <div class="col-md-3">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Sub&nbsp;Category&nbsp;<span style="color:red;">*</span></label>
                            <select id="subCategoryId" name="subCategoryId" class="validate form-control" displayname="Sub Category">
                            </select>
                            		<script>
									function selectsubcategory(){
									var categoryId = $('#categoryId').val();
									$('#subCategoryId').load('loadsubcategory.php?id='+categoryId+'&selectId=<?php echo $editresult['subCategoryId']; ?>');
									}
									<?php
									if($_GET['id']!=''){
									?>
									selectsubcategory();
									<?php } ?>
									</script>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Gender</label>
                            <select id="gender" name="gender" class="form-control" displayname="Gender">
                              <option value="">Select</option>
                              <?php
										$rs=GetPageRecord('*','genderMaster','1 order by name asc');
										while($resListingGender=mysqli_fetch_array($rs)){
										?>
                              <option value="<?php echo $resListingGender['id']; ?>" <?php if($editresult['gender']==$resListingGender['id']){ ?>selected="selected"<?php } ?>><?php echo $resListingGender['name']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row" style="margin-top:20px;">
                    <div class="col-md-2" >
                      <div class="form-group">
                        <label>Style# &nbsp;<span style="color:red;">*</span></label>
                        <input name="styleRefId" type="text" class="validate form-control" displayname="Sub Ref No." id="styleRefId" value="<?php echo $editresult['styleRefId']; ?>"   maxlength="200">
                      </div>
                    </div>

					<div class="col-md-4" >
                      <div class="form-group">
                        <label>Order NO. &nbsp;<span style="color:red;">*</span></label>
                        <input name="masterStyleNo" type="text" class="form-control validate" displayname="" id="masterStyleNo" value="<?php echo $editresult['masterStyleNo']; ?>"   maxlength="200">
                      </div>
                    </div>
					<div class="col-md-2" style="display:none;">
                      <div class="form-group">
                        <label>DVN</label>
                        <input name="merchantStyleNo" type="text" class=" form-control" displayname="" id="merchantStyleNo" value="<?php echo $editresult['merchantStyleNo']; ?>"   maxlength="200">
                      </div>
                    </div>
                    <div class="col-md-2" style="display:none;">
                      <div class="form-group">
                        <label>Refrence By</label>
                        <select id="refrenceBy" name="refrenceBy" class="form-control" displayname="Refrence By">
                          <option value="">Select</option>
                          <?php
							$select='';
							$where='';
							$rs='';
							$select='*';
							$where=' deletestatus=0 and status=1 and profileId=83 order by firstName asc';
							$rs=GetPageRecord($select,_USER_MASTER_,$where);
							while($resListing=mysqli_fetch_array($rs)){
							?>
                          <option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$editresult['refrenceBy']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['firstName'].' '.$resListing['lastName']); ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Risk&nbsp;Priority &nbsp;<span style="color:red;">*</span></label>
                        <select id="queryPriority" name="queryPriority" class="validate form-control" displayname="Priority" onchange="changepriority(this.value);">
                          <option value="">Select</option>
                          <option value="1" <?php if($editresult['queryPriority']=='1'){ ?>selected="selected"<?php } ?>>Low</option>
                          <option value="2" <?php if($editresult['queryPriority']=='2'){ ?>selected="selected"<?php } ?>>Medium</option>
                          <option value="3" <?php if($editresult['queryPriority']=='3'){ ?>selected="selected"<?php } ?>>High</option>
                        </select>
                      </div>
                    </div>
                    <!--<?php if($_GET['id']!=''){?>
					<div class="col-md-3" style="margin-top:20px;">
						<div class="form-group">
							<label>Style Type</label>
							<select id="styleType" name="styleType" class="form-control" displayname="Assign To">
							 <option value="">Select</option>
							 <option value="1" <?php if($editresult['styleType']=='1'){ ?>selected="selected"<?php } ?>>Inhouse</option>
							 <option value="2" <?php if($editresult['styleType']=='2'){ ?>selected="selected"<?php } ?>>Outsource</option>
							 <option value="3" <?php if($editresult['styleType']=='3'){ ?>selected="selected"<?php } ?>>Partial Outsource</option>
							</select>
						</div>
					</div>
					<?php } ?>-->
                    <div class="col-md-3" style="display:none;">
                      <div class="form-group">
                        <label>Assign To</label>
                        <select id="assignTo" name="assignTo" class="form-control" displayname="Assign To">
                          <option value="">Select</option>
                          <?php
							$select='';
							$where='';
							$rs='';
							$select='*';
							$where=' deletestatus=0 and status=1 order by firstName asc';
							$rs=GetPageRecord($select,'userMaster',$where);
							while($resListing=mysqli_fetch_array($rs)){
							?>
                          <option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$editresult['assignTo']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['firstName']).' '.strip($resListing['lastName']); ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-2" style="display:none;">
                      <div class="form-group">
                        <label>Division</label>
                        <select id="divisionId" name="divisionId" class="form-control" displayname="Division">
                          <option value="">Select</option>
                          <?php
							$select='';
							$where='';
							$rs='';
							$select='*';
							$where=' deletestatus=0 and status=1 order by name asc';
							$rs=GetPageRecord($select,'divisionMaster',$where);
							while($resListing=mysqli_fetch_array($rs)){
							?>
                          <option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$editresult['divisionId']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-2">
                    <div class="form-group">
                        <label>Risk&nbsp;Criterion</label>
                       <select name="risk" type="number" class="form-control" id="risk" maxlength="200">
                          <option>Select</option>
                            </select>
             </div>
                    </div>
<script type="text/javascript">
function changepriority(query){
$('#risk').load('loadbrand.php?risk='+query+'&selectId=<?php echo $editresult['riskPriority']; ?>&action=changeriskpriority');
}

<?php
if($_GET['id']!=''){
?>
changepriority(<?php echo $editresult['queryPriority']; ?>);
<?php } ?>
</script>

					 <div class="col-md-2">
                    <div class="form-group">
                        <label>Remarks</label>
                        <input name="remark" type="text" class="form-control" id="remarks" value="<?php echo stripslashes($editresult['remark']); ?>"   maxlength="200">
                      </div>
                    </div>
                  </div>
                  <div class="row" style="margin-top:20px;">
                 <!--   <div class="col-md-<?php if($editresult['attachmentFile']!=''){?>3<?php }else{ ?>6<?php } ?>">
                      <div class="form-group">
                        <label>Attach Tech Pack</label>
                        <div class="uniform-uploader btn-secondary">
                          <input type="file" name="patternAttachment" id="patternAttachment" class="form-input-styled" data-fouc="">
                          <span class="filename btn-secondary" style="user-select: none;">No file selected</span> <span class="action btn btn-secondary" style="user-select: none;"><i class="fa fa-upload"></i></span>
                          <script>
							$('#patternAttachment').on('change',function(){
							//get the file name
							var fileName = $(this).val();
							//replace the "Choose a file" label
							$(this).next('.filename').html(fileName);
							})
						</script>
                          <input type="hidden" name="patternAttachmentEdit" id="patternAttachmentEdit" value="<?php echo $editresult['techpackattachment']; ?>"/>
                        </div>
                      </div>
                    </div>
                    <?php if($editresult['attachmentFile']!=''){?>
                    <div class="col-md-3" style="margin-top:27px;">
                      <div class="form-group">
                        <?php if($editresult['attachmentFile']!=''){?>
                        <div> <a href="images/<?php echo $editresult['attachmentFile']; ?>" target="blank" class="btn btn-secondary" style="margin:0px;"><i class="fa fa-download"></i> Download Techpack</a> </div>
                        <?php } ?>
                      </div>
                    </div>
                    <?php } ?>-->

                    <!--<div class="col-md-3" style="">
                      <div class="form-group">
                        <label>Merchant</label>
                        <select id="merchantname" name="merchantname" class="form-control" displayname="Division">
                          <option value="">Select</option>
                          <?php
							$select='';
							$where='';
							$rs='';
							$select='*';
							$where=' deletestatus=0 ';
							$rs=GetPageRecord($select,'userMaster',$where);
							while($resListing=mysqli_fetch_array($rs)){
							?>
                          <option value="<?php echo strip($resListing['id']); ?>"><?php echo strip($resListing['firstName']); ?> &nbsp;<?php echo strip($resListing['lastName']); ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>-->
                    <!--<div class="col-md-3">
						<div class="form-group">
						<label>Attach File</label>
						<div class="uniform-uploader">
						<input type="file" name="attachmentFile" id="attachmentFile" class="form-input-styled" data-fouc="" multiple="multiple"><span class="filename" style="user-select: none;">No file selected</span><span class="action btn bg-pink-400" style="user-select: none;"><i class="icon-plus2"></i></span>
						</div>
						</div>
					</div>-->
					<!--<?php
					$newdata = explode(',', $editresult['sizerange']);
					?>
                    <div class="col-md-3">
                      <div class="form-group select2-form-group">
                        <label>Size Range</label>
                       <select id="sizerange" class="form-control "  name="sizerange[]" multiple="multiple">
                        <option value=""  disabled="disabled">Select</option>
                          <?php
							$select='';
							$where='';
							$rs='';
							$select='*';
							$where='1 and deletestatus=0 and status=1 order by name asc';
							$rs=GetPageRecord($select,'sizerangeMaster',$where);
							while($resListing=mysqli_fetch_array($rs)){
							?>
                          <option value="<?php echo strip($resListing['id']); ?>" <?php foreach($newdata as $key => $value) { if($value == $resListing['id']){ echo 'selected="selected"'; } }?>><?php echo strip($resListing['name']); ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>-->
                   <div class="col-md-4" style="">
                      <div class="form-group">
                        <label>Source&nbsp;Allocation &nbsp;<span style="color:red;">*</span></label>
                        <select id="styleTypeId" name="styleTypeId" class="validate form-control" displayname="Source Allocation">
                          <option value="1" <?php if($editresult['styleTypeId']=='1'){ ?>selected="selected"<?php } ?>>Inhouse</option>
                          <option value="2" <?php if($editresult['styleTypeId']=='2'){ ?>selected="selected"<?php } ?>>Outsource</option>
                          <!-- <option value="3" <?php if($editresult['styleTypeId']=='3'){ ?>selected="selected"<?php } ?>>Inhouse & Outsource</option>-->
                        </select>
                      </div>
                    </div>
                   <div class="col-md-4" style="">
                      <div class="form-group">
                        <label>Size Range</label>
                        <select id="sizerange" name="sizerange" class="form-control " displayname="" onchange="changeratio(this.value);">
                          <option  value="0">Select</option>
                          <?php
							$select='';
							$where='';
							$rs='';
							$select='*';
							$where='1 and deletestatus=0 and status=1 order by name asc';
							$rs=GetPageRecord($select,'sizerangeMaster',$where);
							while($resListing=mysqli_fetch_array($rs)){
							?>
                          <option value="<?php echo $resListing['id']; ?>" <?php if($resListing['id']==$editresult['sizerange']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Size Ratio</label>
                       <select name="sizeratio" type="number" class="form-control" id="sizeratio"  maxlength="200">
					  <option > Select</option>
					  </select>
					   </div>
                    </div>
                   </div>
                     <script>
function changeratio(sizerange){

	$('#sizeratio').load('loadbrand.php?sizerange='+sizerange+'&action=changesizeratio&selectedid=<?php echo  $editresult['sizeratio']; ?>');
}
changeratio(<?php echo $editresult['sizerange']; ?>);
</script>
				  <div class="row" style="margin-top:20px">
				 	 <div class="col-md-2">
                      <div class="form-group">
                        <label>Costing&nbsp;Qty</label>
                        <input name="costingQty" type="number" class="form-control <?php if($_GET['styleid']!=''){ echo "readonly";}?>" id="costingQty" value="<?php echo $editresult['costingQty']; ?>"  <?php if($_GET['styleid']!=''){ echo "readonly";}?>  maxlength="200">
                      </div>
                    </div>
					<div class="col-md-2">
                      <div class="form-group">
                        <label>Projection&nbsp;Qty</label>
                        <input name="projecQty" type="number" class="form-control" id="projecQty" value="<?php echo $editresult['projecQty']; ?>"   maxlength="200">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Placement&nbsp;Qty</label>
                        <input name="orderQty" type="number" class="form-control <?php if($editresult['poAttachment']!=''){ ?>readonly<?php } ?>" id="orderQty" value="<?php echo $editresult['orderQty']; ?>" <?php if($editresult['poAttachment']!=''){ ?>readonly<?php } ?>  maxlength="200">
                      </div>
                    </div>
                    <!--<div class="col-md-3" >
                      <div class="form-group">
                        <label>Color Break up</label>
                        <input name="colorbreakup" type="text" class="form-control" id="colorbreakup" value="<?php echo $editresult['colorbreakup']; ?>"   maxlength="200">
                      </div>
                    </div>-->
                    <div class="col-md-2" >
                      <div class="form-group">
                        <label>Repeat&nbsp;Order &nbsp;<span style="color:red;">*</span></label>
                       <select id="repeatorder" name="repeatorder" class="validate form-control" displayname="Priority">
                          <option value="">Select</option>
                          <option value="1" <?php if($editresult['repeatOrder']=='1'){ ?>selected="selected"<?php } ?>>Yes</option>
                          <option value="2" <?php if($editresult['repeatOrder']=='2'){ ?>selected="selected"<?php } ?>>No</option>
                        </select>
                       </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Creation Date</label>
                        <input name="receivedDate" type="text" class="form-control" id="receivedDate" value="<?php if($editresult['receivedDate']!=''){ echo date('d-m-Y', strtotime($editresult['receivedDate'])); }else{ echo date('d-m-Y'); } ?>" readonly="">
                      </div>
                    </div>
                    <div class="col-md-2" >
                      <div class="form-group">
                        <label>OCD&nbsp;Date</label>
                        <input name="ocdDate" type="text" class="form-control  <?php if($_GET['styleid']!=''){ ?>readonly<?php } ?>" id="ocdDate" value="<?php if($editresult['ocdDate']!='0000-00-00' && $editresult['ocdDate']!='' && $editresult['ocdDate']!='1970-01-01'){ echo date('d-m-Y', strtotime($editresult['ocdDate'])); } ?>" readonly="">
                      </div>
                    </div>
                  </div>
                  <div class="row" style="margin-top:20px">
                    <div class="col-md-3" >
                      <div class="form-group">
                        <label>PCD&nbsp;Date</label>
                        <input name="pcdDate" type="text" class="form-control <?php if($_GET['styleid']!=''){ ?>readonly<?php } ?>" id="pcdDate" value="<?php if($editresult['pcdDate']!='0000-00-00' && $editresult['pcdDate']!='' && $editresult['pcdDate']!='1970-01-01'){  echo date('d-m-Y', strtotime($editresult['pcdDate'])); } ?>" readonly="">
                      </div>
                    </div>
                    <div class="col-md-3" >
                      <div class="form-group">
                        <label>Ex.&nbsp;Factory&nbsp;Date</label>
                        <input name="shipDate" type="text" class="form-control <?php if($_GET['styleid']!=''){ ?>readonly<?php } ?>" id="shipDate" value="<?php if($editresult['pcdDate']!='0000-00-00' && $editresult['shipDate']!='' && $editresult['shipDate']!='1970-01-01'){ echo date('d-m-Y', strtotime($editresult['shipDate'])); } ?>" readonly="">
                      </div>
                    </div>
                    <div class="col-md-3" >
                      <div class="form-group">
                        <label>SAM(In Minutes)</label>
                        <input name="smv" type="number" class="form-control <?php if($_GET['styleid']!=''){ echo "readonly";}?>" id="smv" value="<?php echo $editresult['smv']; ?>"<?php if($_GET['styleid']!=''){ echo "readonly";}?> >
                      </div>
                    </div>
                    <div class="col-md-3" >
                      <div class="form-group">
                        <label>Efficiency(%)</label>
                        <input name="efficiency" type="number" class="form-control <?php if($_GET['styleid']!=''){ echo "readonly";}?>" id="efficiency" value="<?php echo  $editresult['efficiency']; ?>" <?php if($_GET['styleid']!=''){ echo "readonly";}?>>
                      </div>
                    </div>
                  </div>

				  <?php
					$addno=1;
					$select='';
					$where='';
					$rscolor='';
					$where='1 and styleId='.$lastId.' order by id asc';
					$rscolor=GetPageRecord('*','styleColorDetailMaster',$where);
					while($resListingcolor=mysqli_fetch_array($rscolor)){
					?>
					<div class="row" style="margin-top:20px;" id="partyAddrsId<?php echo $addno; ?>">
					<div class="col-md-3">
						<div class="form-group">
						 <label>Color &nbsp;<span style="color:red;">*</span></label>
						<select id="colorId<?php echo $addno; ?>" name="colorId<?php echo $addno; ?>" class="form-control validate <?php if($editresult['poAttachment']!=''){ ?>readonly<?php } ?>" displayname="" >
						  <option value="">Select</option>
						   <?php
							$select='';
							$where='';
							$rs='';
							$select='*';
							$where='1 and deletestatus=0 and status=1 and brandId='.$editresult['brandId'].' order by name asc';
							$rs11=GetPageRecord('name,id','colorCardMaster',$where);
							while($resListing11=mysqli_fetch_array($rs11)){
							?>
						  <option value="<?php echo strip($resListing11['id']); ?>" <?php if($resListingcolor['colorId']==$resListing11['id']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing11['name']); ?></option>
						  <?php } ?>
						</select>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
						 <label>Color Qty &nbsp;<span style="color:red;">*</span></label>
						 <input name="qty<?php echo $addno; ?>" min="0" type="number" class="form-control validate <?php if($editresult['poAttachment']!=''){ ?>readonly<?php } ?>" id="qty<?php echo $addno; ?>" value="<?php echo $resListingcolor['qty']?>"  >
						</div>
					</div>
				 <?php
					$newdata = explode(',', $resListingcolor['valueEdition']);
					?>
					<div class="col-md-3">
						<div class="form-group">
						<label>Value&nbsp;Addition &nbsp;<span style="color:red;">*</span></label>
						<select id="valueEdition<?php echo $addno; ?>" name="valueEdition<?php echo $addno; ?>[]" class="form-control validate select2" multiple="multiple" >
						  <option value="" disabled="disabled">Select</option>
						   <?php
							$select='';
							$where='';
							$rs='';
							$select='*';
							$where='1 and deletestatus=0 and status=1 order by name asc';
							$rs12=GetPageRecord($select,'embroideryTypeMaster',$where);
							while($resListing12=mysqli_fetch_array($rs12)){
							?>
						  <option value="<?php echo strip($resListing12['id']); ?>" <?php foreach($newdata as $key => $value) {  if($value == $resListing12['id']){ echo 'selected'; } }?>><?php echo strip($resListing12['name']); ?></option>
						  <?php } ?>
						</select>
					</div>
					</div>

				   <div class="col-md-3">
				   <table width="100%" border="0" cellpadding="0" cellspacing="0">
						 <tr>
							<td width="80%" align="left" style="">
							<div class="form-group">
							<label>Lining</label>
							<select id="lining<?php echo $addno; ?>" name="lining<?php echo $addno; ?>" class=" form-control" displayname="">
								  <option value="Yes" <?php if($resListingcolor['lining']=='Yes'){ ?>selected="selected"<?php } ?>>Yes</option>
								  <option value="No" <?php if($resListingcolor['lining']=='No'){ ?>selected="selected"<?php } ?>>No</option>
								</select>
							  </div>
							</td>
							<td width="10%" align="left" style="">
							<div class="form-group">
							<label>&nbsp;</label>
							</div>
							</td>
							<td width="10%" align="left" style="">
							<div class="form-group">
								<label>&nbsp;</label>
								<?php if($addno==1){ ?>
								<img src="images/addicon.png" width="20" height="20" onclick="addPartyAdd();" style="cursor:pointer; margin-top: 20px;" />
								<?php } else { ?>
								<img src="images/deleteicon.png"  onclick="removeAddInfo(<?php echo $addno; ?>);" style="cursor:pointer; margin-top: 23px;" />
								<?php } ?>
							</div>
							</td>
						</tr>
					</table>
						             <input name="date<?php echo $addno; ?>" type="hidden" class="form-control" id="date<?php echo $addno; ?>" value="<?php echo time(); ?>" >

					</div>

		 </div>
					<?php $addno++; } ?>

					<?php if($addno==1){ ?>
					<div class="row" style="margin-top:20px;" id="partyAddrsId1">
			<div class="col-md-3">
				<div class="form-group">
				<label>Color &nbsp;<span style="color:red;">*</span> <span><a href="#" onclick="opencolormodel();" data-toggle="modal" data-target="#modalpop"  aria-expanded="false"> + Add Color</a></span></label>
				<select id="colorId1" name="colorId1" class=" form-control validate" displayname="">

				</select>
 				</div>
			</div>
			<script>
			function opencolormodel(){
				var brandId = $('#brandId').val();
				var buyerId = $('#buyerId').val();
				opmodalpop(' Add Color Card','modalpop.php?action=colorcardmasterfromsyle&brandId='+brandId+'&buyerId='+buyerId,'600px','auto');

			}
			function funChangeBrand(brandId){
				$('#colorId1').load('loadBrandColorList.php?action=loadbrandcolorlist&brandId='+brandId);
			}
			funChangeBrand(2);
			</script>


		   <div class="col-md-3">
				<div class="form-group">
				<label>Color Qty &nbsp;<span style="color:red;">*</span></label>
				<input name="qty1" type="number" min="0" class="form-control validate" id="qty1" value="" >
			</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
				<label>Value&nbsp;Addition &nbsp;<span style="color:red;">*</span></label>
				<select id="valueEdition1" name="valueEdition1[]" class=" form-control validate select2" multiple="multiple">
				  <option value="" disabled="disabled">Select</option>
				   <?php
					$select='';
					$where='';
					$rs='';
					$select='*';
					$where='1 and deletestatus=0 and status=1 order by name asc';
					$rs12=GetPageRecord($select,'embroideryTypeMaster',$where);
					while($resListing12=mysqli_fetch_array($rs12)){
					?>
				  <option value="<?php echo strip($resListing12['id']); ?>" ><?php echo strip($resListing12['name']); ?></option>
				  <?php } ?>
				</select>
				 </div>
			</div>

			<div class="col-md-3">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				 <tr>
					<td width="80%" align="left">
					<div class="form-group">
						<label>Lining</label>
						<select id="lining1" name="lining1" class="form-control" displayname="">
							  <option value="Yes" <?php if($editresult['lining']=='Yes'){ ?>selected="selected"<?php } ?>>Yes</option>
							  <option value="No" <?php if($editresult['lining']=='No'){ ?>selected="selected"<?php } ?>>No</option>
						</select>
					</div>
					</td>
					<td width="10%" align="left" style="">
					<div class="form-group">
						<label>&nbsp;</label>
					</div>
					</td>
					<td width="10%" align="left" style="">
					<div class="form-group">
						<label>&nbsp;</label>
						<img src="images/addicon.png" width="20" height="20" onclick="addPartyAdd();" style="cursor:pointer; margin-top: 20px;" />
					</div>
					</td>
				 </tr>
			</table>
	             <input name="date1" type="hidden" class="form-control" id="date1" value="<?php echo time(); ?>" >

			</div>
		</div>
					<?php } ?>
					 <input name="addcount" type="hidden" id="addcount" value="<?php if($addno==1){ echo '1'; } else { echo $addno; } ?>" />
					 <script>
					 function addPartyAdd(){
					 var addcount = $('#addcount').val();
					 var brandId = $('#brandId').val();
					 //alert(empcount);
					 addcount=Number(addcount)+1;
					 $.get("loadcolordetail.php?id="+addcount+"&cityId=<?php echo $editcityId; ?>&brandId="+brandId, function (data) {
					$("#loadpartyaddress").append(data);
					});
					  $('#addcount').val(addcount);
					 $
					 }

					 function removeAddInfo(id){
					 $('#partyAddrsId'+id).remove();
					 var addcount = $('#addcount').val();
					 addcount=Number(addcount)-1;
					 $('#addcount').val(addcount);
					 }
					 </script>

		 			<div class="form-group" style="margin-top:20px;" id="loadpartyaddress">

					</div>



                </div>
                <input type="hidden" name="editId" value="<?php echo encode($lastId); ?>">
				<input type="hidden" name="module" value="<?php echo $_GET['module']; ?>">
                <input type="hidden" name="action" value="<?php if($_GET['id']!=''){ echo 'editquery'; } else { echo 'addquery'; } ?>">
                <?php if($_GET['id']=='' && $_GET['incomingid']!=''){ ?>
                <input name="incomingqueryId" type="hidden" id="incomingqueryId" value="<?php echo $_GET['incomingid']; ?>" />
                <?php } ?>
                <input name="mailId" type="hidden" id="mailId" value="<?php echo decode($_REQUEST['incomingid']); ?>" />
                <?php
				if($_GET['id']!=''){
				?>
                <input name="editedityes" type="hidden" id="editedityes" value="1" />
                <?php } ?>
                <div class="text-right">
                  <button type="button" name="submitbtn" id="submitbtn pnotify-solid-success" class="btn btn-primary" onclick="formValidation('popid','submitbtn','0');convertquerymaildata();" style="margin:0px;" >Save<i class="fa fa-floppy-o ml-2" aria-hidden="true"></i></button>
                  <script>
					function convertquerymaildata(){
					var maildatadiv = $('#maildatadiv').html();
					$('#maildata').val(maildatadiv);
					}
					</script>
                  <label>
                  <textarea  id="maildata" name="maildata" style="display:none;"></textarea>
                  <input type="hidden" name="maildate" id="maildate" value="<?php echo $maildate; ?>">
                  </label>
                </div>
              </div>
            </div>
          </div>
          <?php if($mailid!=''){ ?>
          <div class="col-xl-5">
            <div class="card">
              <div class="card-header bg-white">
                <h6 class="card-title">Mail</h6>
              </div>
              <div class="card-body navbar-light">
                <div class="media flex-column flex-md-row"> <a href="#" class="d-none d-md-block mr-md-3 mb-3 mb-md-0"> <span class="btn bg-teal-400 btn-icon btn-lg rounded-round"> <span class="letter-icon"><?php echo substr($mailUserName,0,1); ?></span> </span> </a>
                  <div class="media-body">
                    <h6 class="mb-0"><?php echo stripslashes($mailUserName); ?></h6>
                    <div class="letter-icon-title font-weight-semibold">
                      <?php if($email!=''){ echo 'From: '.$email; } else {  echo stripslashes($mailUserName); } ?>
                    </div>
                  </div>
                </div>
              </div>
              <div id="maildatadiv">
                <div class="card-body"> <?php echo stripslashes(imap_qprint($message)); ?> </div>
                <?php if($filenames!=''){ ?>
                <div class="card-body border-top">
                  <h6 class="mb-0">Attachment</h6>
                  <ul class="list-inline mb-0">
                    <?php
if($filenames!=''){
$string = rtrim($filenames,',');
$string = preg_replace('/\.$/', '', $string);
$array = explode(',', $string);
foreach($array as $value)
{ ?>
                    <li class="list-inline-item">
                      <div class="card bg-light py-2 px-3 mt-3 mb-0">
                        <div class="media my-1">
                          <div class="mr-3 align-self-center"><i class="fa fa-file-text" aria-hidden="true" style="font-size:30px;"></i></div>
                          <div class="media-body">
                            <div class="font-weight-semibold" style="max-width:200px;"><?php echo $value; ?></div>
                            <ul class="list-inline list-inline-condensed mb-0">
                              <li class="list-inline-item"><a href="<?php echo $fullurl; ?>attachment/<?php echo date('d-m-Y-H:i:s',$timestamp) ; ?>-<?php echo $value; ?>" target="_blank">Download</a></li>
                              <input type="radio" id="attachmentNewMail" name="attachmentNewMail" checked="checked" value="<?php echo date('d-m-Y-H:i:s',$timestamp) ; ?>-<?php echo $value; ?>" style="position: absolute;bottom: 18px;right: 30px;">
                              Attach Techpack
                            </ul>
                          </div>
                        </div>
                      </div>
                    </li>
                    <?php } } ?>
                  </ul>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </form>



<?php if($_GET['styleid']!=''){ ?>


<?php

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
$patternAttachment = $editresultstyle['patternAttachment'];
$attachmentFile = $editresultstyle['attachmentFile'];
$techpackdescription = $editresultstyle['techpackdescription'];
$lastId=$editresultstyle['id'];

}
?>
	  <div class="row">
        <div class="col-xl-12">

	   <div class="card">
									<div class="card-header bg-white">
										<h6 class="card-title">Techpack Information</h6>
									</div>



		<?php
		$i = 0;
		$k1=11111;
		$k2=22222;
		$k3=33333;
		$k4=44444;
		$k5=55555;
		$k6=66666;
		$k7=77777;
        $select22='*';
		$where22=' styleId="'.$lastId.'" order by id asc';
		$rs22=GetPageRecord($select22,'styleTechPackMaster',$where22);
		$count = mysql_num_rows($rs22);
		while($resListing22=mysqli_fetch_array($rs22)){
		$i++; $k1++; $k2++; $k3++; $k4++; $k5++; $k6++; $k7++;

		?>


		<div class="card" style="">
		 	<div id="collapsible-control-right-group<?php echo $i; ?>" class="collapse" style="display:block;">

				<div class="card-body">

					<ul class="nav nav-tabs nav-tabs-highlight nav-justified">
						<li class="nav-item"><a href="#highlighted-justified-tab<?php echo $k2; ?>" class="nav-link active show" data-toggle="tab">Construction</a></li>
						<li class="nav-item"><a href="#highlighted-justified-tab<?php echo $k3; ?>" class="nav-link" data-toggle="tab">Measurement&nbsp;Chart</a></li>
						<li class="nav-item"><a href="#highlighted-justified-tab<?php echo $k4; ?>" class="nav-link" data-toggle="tab">Accessories&nbsp;Artwork</a></li>
						<li class="nav-item"><a href="#highlighted-justified-tab<?php echo $k5; ?>" class="nav-link" data-toggle="tab">BOM</a></li>
						<li class="nav-item"><a href="#highlighted-justified-tab<?php echo $k6; ?>" class="nav-link" data-toggle="tab">Comment</a></li>
						<li class="nav-item"><a href="#highlighted-justified-tab<?php echo $k7; ?>" class="nav-link" data-toggle="tab">Measurement&nbsp;History</a></li>
					</ul>


					<div class="tab-content">
							<div class="tab-pane fade active show" id="highlighted-justified-tab<?php echo $k2; ?>">
							<fieldset class="card-body" style="padding:10px;">
							<div class="row">
							<table width="100%" class="table table-bordered table-responsive">
							<thead style="background-color: #e5fbfa;">
							<tr class="border-top-info">
							<th width="3%">SNO.</th>
							<th width="59%">Operation </th>
							<th width="15%">Type Of Machine</th>
							<th width="23%">Remark</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$sNo = 0;
							$select='';
							$where='';
							$rs='';
							$select='*';
							$where=' deletestatus=0 order by id asc';
							$rs=GetPageRecord($select,'techPackCategoryMaster',$where);
							while($resListing=mysqli_fetch_array($rs)){
							?>
							<tr class="border-top-info">
							<td colspan="4" style="font-weight: 500;background-color: #f9f9f9;"><?php echo $resListing['name']; ?>
							<?php
							$select1='*';
							$where1='techpackcategoryid="'.$resListing['id'].'" and deletestatus=0 order by id asc';
							$rs1=GetPageRecord($select1,'techPackSubCategoryMaster',$where1);
							while($resListing1=mysqli_fetch_array($rs1)){

							$select12='*';
							$where12='techPackSubCategoryId="'.$resListing1['id'].'" and styleTechPackId="'.$resListing22['id'].'" and sectionType="construction" order by id desc';
							$rs12=GetPageRecord($select12,'techPackDetailMaster',$where12);
							$resListing12=mysqli_fetch_array($rs12);

							$sNo++;
							?>
							<tr>
							<input type="hidden" name="techPackCategoryId<?php echo $sNo; ?>"  value="<?php echo $resListing1['techpackcategoryid']; ?>" />														                                        <input type="hidden" name="techPackSubCategoryId<?php echo $sNo; ?>"  value="<?php echo $resListing1['id']; ?>" />
							<td><?php echo $sNo; ?></td>
							<td><?php echo $resListing1['name']; ?></td>
							<td align="center"><input name="typeOfMachine<?php echo $sNo; ?>" type="text"  id="typeOfMachine<?php echo $sNo; ?>" value="<?php echo $resListing12['typeOfMachine']; ?>" autocomplete="off"  maxlength="200"></td>
							<td align="center">
							<input name="remark<?php echo $sNo; ?>" type="text"  id="remark<?php echo $sNo; ?>" value="<?php echo $resListing12['remark']; ?>" autocomplete="off"  maxlength="200">
							</td>
							</tr>
							<?php  } ?>
							</td>
							</tr>
							<?php } ?>

							<input type="hidden" name="constructTotalCount" value="<?php echo $sNo; ?>" />
							</tbody>
							</table>
							</div>
							</fieldset>
							</div>
							<div class="tab-pane fade" id="highlighted-justified-tab<?php echo $k3; ?>">
							<fieldset class="card-body" style="padding:10px;">
							<div class="row">
							<table width="100%" class="table table-bordered table-responsive">
							<thead style="background-color: #e5fbfa;">
							<tr class="border-top-info">
							<th width=""><a onclick="addNewRow(1);" style="color:#0000FF; cursor: pointer;">+Add&nbsp;New</a></th>
							<th width="3%">SNO.</th>
							<th >Specifications</th>
							<th width="">XS</th>
							<th width="">Small</th>
							<th width="">Medium</th>
							<th width="">Large</th>
							<th width="">XL</th>
							<th width="">XXL</th>
							<th width="">TOL (+/-)</th>

							</tr>
							</thead>
							<tbody id="addrow">
							</tbody>

							<script>
							function addNewRow(id){
							if(id==1){
							$("#addrow").load('loadmeasurementtable.php?add=1&styleId=<?php echo encode($lastId); ?>&costsheetVersionId=1');
							}else{
							$("#addrow").load('loadmeasurementtable.php?styleId=<?php echo encode($lastId); ?>');
							}

							}
							addNewRow(0);


							function deleteRow(id){
							var checkyes = confirm('Are your sure you you want to delete?');
							if(checkyes==true){
							$('#addrow').load('loadmeasurementtable.php?id='+id+'&deletestatus=yes&styleId=<?php echo encode($lastId); ?>');
							}
							}
							</script>
							</table>

							</div>
							</fieldset>
							</div>
							<div class="tab-pane fade" id="highlighted-justified-tab<?php echo $k4; ?>">
							<fieldset class="card-body" style="padding:10px;">
							<div class="row">
							<table width="100%" class="table table-bordered table-responsive">
							<thead style="background-color: #e5fbfa;">
							<tr class="border-top-info">
							<th width=""><a onclick="addNewAccessrory(1);" style="color:#0000FF; cursor: pointer;">+Add&nbsp;New</a></th>
							<th width="3%">SNO.</th>
							<th >Description</th>
							<th width="">Digital</th>
							<th width="">Image/Artwork</th>
							<th width="">Quality/Material</th>
							<th width="">Color/Finish</th>
							<th width="">Size</th>
							<th width="">Thickness/Shape</th>
							<th width="">Remark</th>
							</tr>
							</thead>

							<tbody id="addNewAccessrory">
							</tbody>

							<script>
							function addNewAccessrory(id){
							if(id==1){
							$("#addNewAccessrory").load('loadaccessoryartwork.php?add=1&styleId=<?php echo encode($lastId); ?>&costsheetVersionId=1');
							}else{
							$("#addNewAccessrory").load('loadaccessoryartwork.php?styleId=<?php echo encode($lastId); ?>');
							}

							}
							addNewAccessrory(0);


							function deleteAccessrory(id){
							var checkyes = confirm('Are your sure you you want to delete?');
							if(checkyes==true){
							$('#addNewAccessrory').load('loadaccessoryartwork.php?id='+id+'&deletestatus=yes&styleId=<?php echo encode($lastId); ?>');
							}
							}
							</script>


							</table>
							</div>
							</fieldset>
							</div>
							<div class="tab-pane fade" id="highlighted-justified-tab<?php echo $k5; ?>">
							<div class="card-body" style="padding:0px;">
							<?php
							$i = 0;
							$costsheetVersionId='0';
							$selectversion='*';
							$whereversion='styleId="'.decode($_GET['styleid']).'" order by id desc';
							$rsversion=GetPageRecord($selectversion,'costsheetVersionMaster',$whereversion);
							while($resListingVer=mysqli_fetch_array($rsversion)){
							$costsheetVersionId = $resListingVer['versionId'];
							$i++;
							?>
							<div id="accordion-group<?php echo $resListingVer['id']; ?>" style="margin-bottom: 10px;">
							<div class="card mb-0 rounded-bottom-0">
							<div class="abcspecial-class card-header collapsed" data-toggle="collapse" href="#accordion-item-group<?php echo $resListingVer['id']; ?>">
							<h6 class="card-title ">
							<a data-toggle="collapse" class="text-default collapsed" href="#accordion-item-group<?php echo $resListingVer['id']; ?>" style="color:#000000;">Material List - <strong><?php echo $resListingVer['versionName']; ?></strong></a>
							<a class="text-default collapsed" data-toggle="collapse" href="#accordion-item-group<?php echo $resListingVer['id']; ?>" aria-expanded="false" style="text-align: left; color: #000; font-size: 13px; width: 100%;"> -&nbsp;<?php echo date('d M, Y - h:ia',$resListingVer['dateAdded']); ?></a>
							</h6>
							</div>
							<div id="accordion-item-group<?php echo $resListingVer['id']; ?>" class="collapse" data-parent="#accordion-group<?php echo $resListingVer['id']; ?>">
							<div class="card-body" style="padding:0px;">
							<div id="collapsible-control-right-group<?php echo $i; ?>" class="collapse" style="display:block;">
							<div class="card-body">

							<div class="tab-content">
							<div class="card-body" style="padding: 10px;">

							<form action="ac.crm" method="post" class="submitstyleform" enctype="multipart/form-data" name="techPackFormV<?php echo $i; ?>" target="techpackiframe<?php echo $i; ?>" id="techPackFormV<?php echo $i; ?>">
							<input type="hidden" name="action2" value="techpackversion" />
							<input type="hidden" name="versionId" value="<?php echo encode($resListingVer['versionId']); ?>" />
							<input type="hidden" name="editId" value="<?php echo encode($lastId); ?>">
							<input type="hidden" name="module" value="<?php echo $_GET['module']; ?>">


							<div class="row" id="load_bom_list<?php echo $costsheetVersionId; ?>">  </div>

							<div class="text-right" style="width: 100%;display: block;margin-top: 25px;">

							<button type="button" onclick="delete_material<?php echo $costsheetVersionId; ?>();delete_material_extra<?php echo $costsheetVersionId; ?>();addfinaldata<?php echo $costsheetVersionId; ?>();" class="btn btn-primary" style="margin:0px;">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;"></i></button>


							</div>

							</form>


							</div>



							<script>
							function duplicateCostsheet<?php echo $costsheetVersionId; ?>(){
							var r = confirm("Are you sure you want to create duplicate?");
							if (r == true) {
							$('#cvId').val(1);
							$( "#techPackFormV<?php echo $i; ?>" ).submit();
							}
							}
							</script>

							<script>
							function load_bom_list_fun<?php echo $costsheetVersionId; ?>(){
							$('#load_bom_list<?php echo $costsheetVersionId; ?>').load("load_bom_list.php?styleId=<?php echo $editresultstyle['id'];?>&subCategoryId=<?php echo $editresultstyle['subCategoryId'];?>&costsheetVersionId=<?php echo $costsheetVersionId; ?>&loginuserprofileId=<?php echo $loginuserprofileId; ?>&page=");
							}

							load_bom_list_fun<?php echo $costsheetVersionId; ?>();

							</script>

							</div>
							</div>
							</div>
							</div>
							</div>
							</div>
							</div>
							<?php } ?> </div>

							</div>
							<div class="tab-pane fade" id="highlighted-justified-tab<?php echo $k6; ?>">
							<div class="row">
							<div class="col-md-12">
							<div class="form-group">
							<label style="background: #e5fbfa; width: 100%; padding: 10px; margin: 0px !important; border: 1px solid #e5fbfa; border-bottom: 0px;">WHITE SEALER</label>
							<textarea name="whitesealer" id="whitesealer" class="form-control" style="height:100px;"></textarea>
							</div>
							</div>
							<div class="col-md-12">
							<div class="form-group">
							<label style="background: #e5fbfa; width: 100%; padding: 10px; margin: 0px !important; border: 1px solid #e5fbfa; border-bottom: 0px;">YELLOW SEALER</label><textarea name="yellowsealer" id="yellowsealer" class="form-control" style="height:100px;"></textarea>
							</div>
							</div>
							<div class="col-md-12">
							<div class="form-group">
							<label style="background: #e5fbfa; width: 100%; padding: 10px; margin: 0px !important; border: 1px solid #e5fbfa; border-bottom: 0px;">GREEN SEALER</label><textarea name="greensealer" id="greensealer" class="form-control" style="height:100px;"></textarea>
							</div>
							</div>
							</div>
							</div>
							<div class="tab-pane fade" id="highlighted-justified-tab<?php echo $k7; ?>">
							<table border="1" cellpadding="4" style="display:none;">
							<thead>
							<th>Sr&nbsp;No#</th>
							<th>&nbsp;</th>
							</thead>
							<tbody>
							<tr>
							<td>1</td>
							<td></td>
							</tr>
							</tbody>
							</table>
							</div>
				   </div>

			    </div>

			</div>
		</div>

	<?php } ?>



	</div>


	   </div>
	   </div>

<?php } ?>

      <div class="row">
        <div class="col-xl-12">
          <!---Image Part--->
          <div class="card">
            <div class="col-md-12">
              <div class="page-header page-header-light">
                <div class="page-header-content header-elements-md-inline" style="padding:0px 15px;">
                  <div class="page-title d-flex">
                    <h4><span class="font-weight-semibold">Image Gallery</span></h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a> </div>
                  <div class="header-elements d-none">
                    <button type="button" class="btn btn-primary" onclick="opmodalpop(' Add Image','modalpop.php?action=styleimagegallery&id=<?php echo encode($lastId); ?>','600px','auto');" data-toggle="modal" data-target="#modalpop" aria-expanded="false" style="margin:0px;">Add&nbsp; <i class="fa fa-plus" aria-hidden="true"></i></button>
                  </div>
                </div>
              </div>
              <div class="row" style="margin-top:20px;">
                <div id="loadimagegrid" style="width:100%;text-align:center;margin:auto;padding-bottom:15px;">Loading...</div>
              </div>
            </div>
          </div>
          <!---Image Part--->
          <!---tech Pack Card Section--->
          <?php
		$i = 0;
		$k1=11111;
		$k2=22222;
		$k3=33333;
		$k4=44444;
		$k5=55555;
		$k6=66666;
		$k7=77777;

		$select22='*';
		$where22=' styleId="'.$lastId.'" order by id asc';
		$rs22=GetPageRecord($select22,'styleTechPackMaster',$where22);
		$count = mysql_num_rows($rs22);
		while($resListing22=mysqli_fetch_array($rs22)){
		$i++; $k1++; $k2++; $k3++; $k4++; $k5++; $k6++; $k7++;

		?>
          <form action="ac.crm" method="post" class="submitstyleform" enctype="multipart/form-data" name="techPackFormV<?php echo $i; ?>" target="techpackiframe<?php echo $i; ?>" id="techPackFormV<?php echo $i; ?>" style="display:none;">
            <input type="hidden" name="teckpackstatusname" class="teckpackstatus" value="" />
            <div class="card" style="">
              <div class="card-header">
                <h6 class="card-title"> <a class="text-default collapsed"  style="color:#000000;">Tech Pack</a> <a class="text-default collapsed " data-toggle="collapse" href="#collapsible-control-right-group<?php echo $i; ?>" aria-expanded="false" style="text-align:right;float:right; color:#1a5d0a;font-size: 14px;"><i class="fa fa-clock-o" aria-hidden="true" ></i> <?php echo date('d M, Y - h:ia',$resListing22['dateAdded']); ?></a> </h6>
              </div>
              <div id="collapsible-control-right-group<?php echo $i; ?>" class="collapse" style="display:block;">
                <div class="card-body">
                  <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                    <!--<li class="nav-item"><a href="#highlighted-justified-tab<?php echo $k1; ?>" class="nav-link active show" data-toggle="tab">Tech-Pack Image</a></li>-->
                    <li class="nav-item"><a href="#highlighted-justified-tab<?php echo $k2; ?>" class="nav-link active show" data-toggle="tab">Construction</a></li>
                    <li class="nav-item"><a href="#highlighted-justified-tab<?php echo $k3; ?>" class="nav-link" data-toggle="tab">Measurement&nbsp;Chart</a></li>
                    <li class="nav-item"><a href="#highlighted-justified-tab<?php echo $k4; ?>" class="nav-link" data-toggle="tab">Accessories&nbsp;Artwork</a></li>
                    <li class="nav-item"><a href="#highlighted-justified-tab<?php echo $k5; ?>" class="nav-link" data-toggle="tab">BOM</a></li>
                    <li class="nav-item"><a href="#highlighted-justified-tab<?php echo $k6; ?>" class="nav-link" data-toggle="tab">Comment</a></li>
                    <li class="nav-item"><a href="#highlighted-justified-tab<?php echo $k7; ?>" class="nav-link" data-toggle="tab">Measurement&nbsp;History</a></li>
                  </ul>
                  <div class="tab-content">
                    <?php /*?><div class="tab-pane fade active show" id="highlighted-justified-tab<?php echo $k1; ?>">

								<fieldset class="card-body">
									<!--<h6 class="font-weight-semibold mb-3">Personal details</h6>-->
									<!--<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Image Name: </label>
												<input type="text" name="imageName1" id="imageName1" class="form-control" placeholder="">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
											<label>Attach File</label>
												<div class="uniform-uploader">
												<input type="file" name="techPackImage1" id="techPackImage1" class="form-input-styled" data-fouc="">
												<span class="filename" style="user-select: none;">No file selected</span>
												<span class="action btn bg-pink-400" style="user-select: none;"><i class="icon-plus2"></i></span>
												</div>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label>&nbsp;</label>
												<div><i class="icon-add "style="font-size:25px;cursor:pointer;" onclick="loadtechpackimage();"></i></div>
											</div>
										</div>
										<input name="imageCount" type="hidden" id="imageCount" value="1">
									<script>
										function loadtechpackimage(){
										var imageCount = $('#imageCount').val();
										imageCount=Number(imageCount)+1;

										$.get("loadtechpackimage.php?id="+imageCount, function (data) {
										$("#techpackimageid").append(data);
										});
										$('#imageCount').val(imageCount);
										}
									</script>
									</div>

									<div id="techpackimageid"></div>-->

									<div class="card">
										<div class="col-md-12">
											<div class="">
												<div class="page-header-content header-elements-md-inline">
													<div class="page-title d-flex">
														<h4><span class="font-weight-semibold">Image Gallery</span></h4>
														<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
													</div>
													<div class="header-elements d-none"><button type="button" style="background-color:#11a006;" class="btn btn-primary" onclick="opmodalpop(' Add Image','modalpop.php?action=styleimagegallery&id=<?php echo encode($lastId); ?>','600px','auto');" data-toggle="modal" data-target="#modalpop" aria-expanded="false">Add&nbsp; <i class="fa fa-plus" aria-hidden="true"></i></button>
													</div>
												</div>
											</div>

											<div class="row" style="margin-top:20px;">
												<div id="loadimagegrid" style="width:100%;text-align:center;margin:auto;">Loading...</div>
											</div>
										</div>
									</div>



								</fieldset>




					</div><?php */?>
                    <div class="tab-pane fade active show" id="highlighted-justified-tab<?php echo $k2; ?>">
                      <fieldset class="card-body" style="padding:10px;">
                      <div class="row">
                        <table width="100%" class="table table-bordered">
                          <thead style="background-color: #e5fbfa;">
                            <tr class="border-top-info">
                              <th width="3%">SNO.</th>
                              <th width="59%">Operation</th>
                              <th width="15%">Type Of Machine</th>
                              <th width="23%">Remark</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
							$sNo = 0;
							$select='';
							$where='';
							$rs='';
							$select='*';
							$where=' deletestatus=0 order by id asc';
							$rs=GetPageRecord($select,'techPackCategoryMaster',$where);
							while($resListing=mysqli_fetch_array($rs)){
							?>
                            <tr class="border-top-info">
                              <td colspan="4" style="font-weight: 500;background-color: #f9f9f9;"><?php echo $resListing['name']; ?>
                                <?php
								$select1='*';
								$where1='techpackcategoryid="'.$resListing['id'].'" and deletestatus=0 order by id asc';
								$rs1=GetPageRecord($select1,'techPackSubCategoryMaster',$where1);
								while($resListing1=mysqli_fetch_array($rs1)){

								$select12='*';
							$where12='techPackSubCategoryId="'.$resListing1['id'].'" and styleTechPackId="'.$resListing22['id'].'" and sectionType="construction" order by id desc';
								$rs12=GetPageRecord($select12,'techPackDetailMaster',$where12);
								$resListing12=mysqli_fetch_array($rs12);

								$sNo++;
								?>
                            <tr>
                              <input type="hidden" name="techPackCategoryId<?php echo $sNo; ?>"  value="<?php echo $resListing1['techpackcategoryid']; ?>" />
                              <input type="hidden" name="techPackSubCategoryId<?php echo $sNo; ?>"  value="<?php echo $resListing1['id']; ?>" />
                              <td><?php echo $sNo; ?></td>
                              <td><?php echo $resListing1['name']; ?></td>
                              <td align="center"><input name="typeOfMachine<?php echo $sNo; ?>" type="text"  id="typeOfMachine<?php echo $sNo; ?>" value="<?php echo $resListing12['typeOfMachine']; ?>" autocomplete="off"  maxlength="200"></td>
                              <td align="center"><input name="remark<?php echo $sNo; ?>" type="text"  id="remark<?php echo $sNo; ?>" value="<?php echo $resListing12['remark']; ?>" autocomplete="off"  maxlength="200">
                              </td>
                            </tr>
                            <?php  } ?>
                            </td>

                            </tr>

                            <?php } ?>
                          <input type="hidden" name="constructTotalCount" value="<?php echo $sNo; ?>" />
                          </tbody>

                        </table>
                      </div>
                      </fieldset>
                    </div>
                    <div class="tab-pane fade" id="highlighted-justified-tab<?php echo $k3; ?>">
                      <fieldset class="card-body" style="padding:10px;">
                      <div class="row">
                        <table width="100%" class="table table-bordered">
                          <thead style="background-color: #e5fbfa;">
                            <tr class="border-top-info">
                              <th width="3%">SNO.</th>
                              <th >Specifications</th>
                              <th width="">Small</th>
                              <th width="">Medium</th>
                              <th width="">Large</th>
                              <th width="">XL</th>
                              <th width="">XXL</th>
                              <th width="">TOL (+/-)</th>
                              <th width=""><a onclick="addNewRow(1);" style="color:#0000FF; cursor: pointer;">+Add&nbsp;New</a></th>
                            </tr>
                          </thead>
                          <tbody id="addrow">
                          </tbody>
                          <script>
											function addNewRow(id){
												if(id==1){
													$("#addrow").load('loadmeasurementtable.php?add=1&styleId=<?php echo $_GET['id']; ?>&costsheetVersionId=1');
												}else{
													$("#addrow").load('loadmeasurementtable.php');
												}
											}
											addNewRow(0);
											</script>
                        </table>
                      </div>
                      </fieldset>
                    </div>
                    <div class="tab-pane fade" id="highlighted-justified-tab<?php echo $k4; ?>">
                      <fieldset class="card-body" style="padding:10px;">
                      <div class="row">
                        <table width="100%" class="table table-bordered">
                          <thead style="background-color: #e5fbfa;">
                            <tr class="border-top-info">
                              <th width="3%">SNO.</th>
                              <th >Description</th>
                              <th width="">Digital</th>
                              <th width="">Image/Artwork</th>
                              <th width="">Quality/Material</th>
                              <th width="">Color/Finish</th>
                              <th width="">Size</th>
                              <th width="">Thickness/Shape</th>
                              <th width="">Remark</th>
                              <th width=""><a onclick="addNewRow(1);" style="color:#0000FF; cursor: pointer;">+Add New</a></th>
                            </tr>
                          </thead>
                          <tbody>
                            <!--<tr>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>-->
                          </tbody>
                        </table>
                      </div>
                      </fieldset>
                    </div>
                    <div class="tab-pane fade" id="highlighted-justified-tab<?php echo $k5; ?>">
                      <fieldset class="card-body" style="padding:10px;">
                      <div class="row" id="load_bom_list"> </div>
                      <script>
									function load_bom_list_fun(){
									$('#load_bom_list').load("load_bom_list_all.php?styleId=<?php echo decode($_REQUEST['id']);?>&subCategoryId=<?php echo $editresult['subCategoryId'];?>&costsheetVersionId=1&page=style");
									}
									</script>
                      </fieldset>
                    </div>
                    <div class="tab-pane fade" id="highlighted-justified-tab<?php echo $k6; ?>">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label style="background: #f7f6f6; width: 100%;padding:5px;margin: 0px !important;">WHITE SEALER</label>
                            <textarea name="whitesealer" id="whitesealer" class="form-control" style="height:100px;"></textarea>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label style="background: #f1f1368f; width: 100%;padding:5px;margin: 0px !important;">YELLOW SEALER</label>
                            <textarea name="yellowsealer" id="yellowsealer" class="form-control" style="height:100px;"></textarea>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label style="background: #90f5be; width: 100%;padding:5px;margin: 0px !important;">GREEN SEALER</label>
                            <textarea name="greensealer" id="greensealer" class="form-control" style="height:100px;"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="highlighted-justified-tab<?php echo $k7; ?>">
                      <table border="1" cellpadding="4" style="display:none;">
                        <thead>
                        <th>Sr&nbsp;No#</th>
                          <th>&nbsp;</th>
                          </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="text-left" style="width: 49%;float: left;padding-left: 5px;display:none;">
                    <button type="submit" class="btn btn-danger" onclick="submitduplicateform('1');">Create Duplicate Tech Pack<i class="fa fa-copy ml-2" aria-hidden="true"></i></button>
                  </div>
                  <div class="text-right" style="width: 100%;float: right;margin-bottom: 15px;margin-right: 0px;">
                    <button type="submit" class="btn btn-primary" style="margin:0px;">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <input type="hidden" name="action2" value="techpackversion" />
            <input type="hidden" name="versionId" value="<?php echo encode($resListing22['id']); ?>" />
            <input type="hidden" name="editId" value="<?php echo encode($lastId); ?>">
          </form>
          <?php } ?>
          <!---tech Pack Card Section--->
        </div>
      </div>


    </div>
  </div>
</div>

<script>
$( function(){
	//$( "#receivedDate" ).datepicker();
	$( "#ocdDate" ).datepicker();
	$( "#pcdDate" ).datepicker();
	$( "#shipDate" ).datepicker();
} );

function loadimagefunc(){
	$('#loadimagegrid').load('loadimage.php?id=<?php echo encode($lastId); ?>');
}
loadimagefunc();
load_bom_list_fun();
  </script>
<style>
.loader {
    position: fixed;
    display: none;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url(images/pageLoader.gif) 50% 50% no-repeat rgb(236, 240, 241);
    opacity: 0.8;
}

</style>
<style>
.nav-justified .nav-item {
    text-align: center;
    width: 100% !important;
    display: block;
    float: left;
}

.nav-tabs-highlight .nav-link {
    width: 100% !important;
    float: left;

}
.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: #333;
    background-color: #fff;
    border-color: #ddd #ddd #fff;
    background-color: #fff178 !important;
    border: 1px solid #ccc;
}
.nav-tabs-highlight .nav-link {
    width: 100% !important;
    float: left;
    border: 1px solid #e9e9e9;
    background-color: #f9f9f9 !important;
}
</style>




<div class="loader"></div>

<style>
.select2-form-group .select2-container {
    width: 305px !important;
}
</style>

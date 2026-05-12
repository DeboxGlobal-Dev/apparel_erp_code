<?php
if($_GET['id']==''){
$where=' styleId=0 and  addedBy='.$_SESSION['userid'].'';
deleteRecord('inspectioninput',$where);

$kkkkk=GetPageRecord('inspectionNo','inspectioninput','1 and styleId!="" order by id desc');
$corporateData=mysqli_fetch_array($kkkkk);
$autiid = explode('-',$corporateData['inspectionNo']);

  $autoId = $autiid[1]+1;
  $finalDisplayId='INS-0000'.$autoId;
  $dateAdded=date('Y-m-d h:i:s A');
  $namevalue ='inspectionNo="'.$finalDisplayId.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'"';
 $lastId = addlistinggetlastid('inspectioninput',$namevalue);
 $ticketValue=$finalDisplayId;
 }

  if($_GET['id']!=''){
  $id=clean(decode($_GET['id']));
 $select1='*';
 $where1='id="'.$id.'"';
 $rs1=GetPageRecord($select1,'inspectioninput',$where1);
 $editresult=mysqli_fetch_array($rs1);
 $lastId=$editresult['id'];
 $ticketValue=$editresult['inspectionNo'];


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$select='*';
$where='id="'.$editresult['styleId'].'"';
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

}

?>
<style>
.select2-container {
    width: 198px !important;
}
.select2-search--dropdown .select2-search__field {
    width: 165px !important;
}
.form-group {
    margin-top: 20px;
}
.defect-class{
width:100%;
display:block;
}
.defect-class .label-defect {
    width: 35%;
    float: left;
    margin-right: 5%;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-top: 10px;
}
.defect-class select {
    width: 40% !important;
    float: right !important;
    margin-right: 15% !important;
}
.defect-class .form-control {
    width: 25%;
    float: left;
    margin-right: 5%;
}
</style>

  <div class="page-content">
  <div class="content-wrapper">
    <form action="ac.crm" method="post" class="submitstyleform" enctype="multipart/form-data" name="popid" target="acf" id="popid">
      <input name="action" type="hidden" id="action" value="addinspectioninput" />
      <input name="module" type="hidden" id="module" value="<?php echo $_GET['module']; ?>" />
      <input name="editId" type="hidden" id="editId" value="<?php echo encode($lastId); ?>" />
      <div class="content pt-0" style="margin-top:20px;">
        <?php if($_GET['id']!=""){ ?>
        <?php include "top-style.php"; ?>
        <?php } ?>
        <div class="row">
          <div class="col-xl-12">
            <div class="card">
              <div class="card-header bg-white">
             <h6 class="card-title">Inspection Input Information</h6>
              </div>
                <div class="card-body">
                <div class="form-group">
                <div class="text-right"> <a class="btn" href="<?php echo $fullurl; ?>showpage.crm?module=<?php echo $_GET['module']; ?>" style="background-color: #949494; color: #fff;">Back <i class="fa fa-backward" aria-hidden="true"></i> </a>
                    <button type="button" name="submitbtn" id="submitbtn" class="btn btn-primary" onClick="formValidation('popid','submitbtn','0');" style="margin:0px;" >Save<i class="fa fa-floppy-o ml-2" aria-hidden="true"></i></button>
                  </div>
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Inspection No.</label>
                        <input type="text" name="inspectionNo" id="inspectionNo" class="form-control" value="<?php echo $ticketValue; ?>" readonly="">
                      </div>
                    </div>
                      <div class="col-md-2">
                      <div class="form-group">
                        <label>Style No.</label>
                        <select name="styleId" id="styleId" class="select2 form-control" onChange="selectcolorcode();">
                          <option value="">Select</option>
                          <?php
$queryDataq=GetPageRecord('id,subject','queryMaster','1 and sampleStyle=1 and deletestatus=0 order by id desc');
while($queryData=mysqli_fetch_array($queryDataq)){

				?>
                          <option value="<?php echo $queryData['id']; ?>" <?php if($editresult['styleId']==$queryData['id']){ ?>selected="selected"<?php  } ?>><?php echo $queryData['subject']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      </div>
                      <div class="col-md-2">
                      <div class="form-group">
                        <label>Inspection Type</label>
                        <select name="inspectionType" id="inspectionType" class="select2 form-control">
                          <option value="">Select</option>
                          <?php
$instypeDataq=GetPageRecord('id,name','inspectiontypemaster','1 order by id');
while($instypeData=mysqli_fetch_array($instypeDataq)){

				?>
                          <option value="<?php echo $instypeData['id']; ?>" <?php if($editresult['inspectionType']==$instypeData['id']){ ?>selected="selected"<?php  } ?>><?php echo $instypeData['name']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Placement Qty.</label>
                        <input type="text" name="placementQty" id="placementQty" class="form-control" value="<?php echo $editresult['placementQty']; ?>">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Date</label>
                        <input type="text" name="dateField" id="dateField" class="newDatePicker form-control" value="<?php if($editresult['dateField']!="" && $editresult['dateField']!="0000-00-00" && $editresult['dateField']!="1970-01-01"){ echo date('d-m-Y',strtotime($editresult['dateField'])); } else{ echo date('d-m-Y'); }?>">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Color</label>
                        <select name="colorId" id="colorId" class="select2 form-control">
                          <option value="">Select</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Received From Embroidery</label>
                        <input type="text" name="receivedfEmbroidery" id="receivedfEmbroidery" class="form-control" value="<?php echo $editresult['receivedfEmbroidery']; ?>">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Factory</label>
                        <select name="factoryId" id="factoryId" class="select2 form-control" onChange="selectline();">
                          <option value="">Select</option>
                          <?php
$factoryDataq=GetPageRecord('id,name','factoryMaster','1 order by id');
while($factoryData=mysqli_fetch_array($factoryDataq)){

				?>
                          <option value="<?php echo $factoryData['id']; ?>" <?php if($editresult['factoryId']==$factoryData['id']){ ?>selected="selected"<?php  } ?>><?php echo $factoryData['name']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Line</label>
                        <select name="lineId" id="lineId" class="select2 form-control">
                          <option value="">Select</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Cut Quantity</label>
                        <input type="text" name="cutQty" id="cutQty" class="form-control" value="<?php echo $editresult['cutQty']; ?>">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Checked By</label>
                        <select name="checkedBy" id="checkedBy" class="form-control" readonly>
                          <?php
$userDataq=GetPageRecord('id,firstName,lastName','userMaster','1 and id="'.$_SESSION['userid'].'" order by id');
while($userData=mysqli_fetch_array($userDataq)){

				?>
                          <option value="<?php echo $userData['id']; ?>"><?php echo $userData['firstName'].' '.$userData['lastName']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Status</label>
                        <select id="status" name="status" class="form-control">
                          <option value="1" <?php if('1'==$editresult['status']){ ?>selected="selected"<?php } ?>>Active</option>
                          <option value="0" <?php if('0'==$editresult['status']){ ?>selected="selected"<?php } ?>>Inactive</option>
                          </select>
                      </div>
                    </div>
                  </div>
                   <div class="row">
                    <?php
$deTypeDataq=GetPageRecord('id,name','inspectionDefectType','1 order by id');
while($deTypeData=mysqli_fetch_array($deTypeDataq)){

				?>
                    <div class="col-md-12" style="margin-top:20px;">
                      <div style="padding: 10px; background-color: #2196f3; font-size: 14px; color: #fff;"><?php echo $deTypeData['name']; ?></div>
                    </div>
     <?php

    $defectDataq=GetPageRecord('id,name','inspectionDefectMaster','1 and defectType="'.$deTypeData['id'].'"');
    while($defectData=mysqli_fetch_array($defectDataq)){
    $inspectionsubinputDataq=GetPageRecord('*','inspectionsubinput','1 and defectiveType="'.$deTypeData['id'].'" and defectiveId="'.$defectData['id'].'" and inspectionId="'.$editresult['id'].'"');
    $inspectionsubinputData=mysqli_fetch_array($inspectionsubinputDataq);
    ?>
                          <div class="col-md-3">
                          <div class="form-group">
                          <div class="defect-class">
                          <div class="label-defect" title="<?php echo $defectData['name']; ?>"><?php echo $defectData['name']; ?></div>
                        <?php if($deTypeData['id']==1){ ?>
                        <select name="defectIdField<?php echo $deTypeData['id'].$defectData['id']; ?>" id="defectIdField" class="form-control">
                        <option value="">Select</option>
                        <option value="1" <?php if($inspectionsubinputData['defectIdField']==1){ ?> selected="selected" <?php } ?>>Ok</option>
                        <option value="2" <?php if($inspectionsubinputData['defectIdField']==2){ ?> selected="selected" <?php } ?>>Not Ok</option>
                        </select>
                          <?php } if($deTypeData['id']!=1){ ?>
                          <input type="text" name="defectIdFieldMajor<?php echo $deTypeData['id'].$defectData['id']; ?>" id="defectIdFieldMajor<?php echo $deTypeData['id'].$defectData['id']; ?>" class="form-control" placeholder="Major" value="<?php echo $inspectionsubinputData['defectIdFieldMajor']; ?>">
                          <input type="text" name="defectIdFieldMinor<?php echo $deTypeData['id'].$defectData['id']; ?>" id="defectIdFieldMinor<?php echo $deTypeData['id'].$defectData['id']; ?>" class="form-control" placeholder="Minor" value="<?php echo $inspectionsubinputData['defectIdFieldMinor']; ?>">
                          <?php } ?>
                        </div>
                      </div>
                      </div>

                    <?php } }  ?>

                  </div>
                  <hr />
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>On Machine</label>
                        <input type="text" name="onMachine" id="onMachine" class="form-control" value="<?php echo $editresult['onMachine']; ?>">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Off Machine</label>
                        <input type="text" name="offMachine" id="offMachine" class="form-control" value="<?php echo $editresult['offMachine']; ?>">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>In Finishing </label>
                        <input type="text" name="infinsihing" id="infinsihing" class="form-control" value="<?php echo $editresult['infinsihing']; ?>">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Packed</label>
                        <input type="text" name="packed" id="packed" class="form-control" value="<?php echo $editresult['packed']; ?>">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Pieces Available For Inspection</label>
                        <input type="text" name="piecesavaiforinspection" id="piecesavaiforinspection" class="form-control" value="<?php echo $editresult['piecesavaiforinspection']; ?>">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Pieces Inspected</label>
                        <input type="text" name="piecesinspected" id="piecesinspected" class="form-control" value="<?php echo $editresult['piecesinspected']; ?>">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Acceptance Level</label>
                        <input type="text" name="acceptanceLevel" id="acceptanceLevel" class="form-control" value="<?php echo $editresult['acceptanceLevel']; ?>">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Pieces Rejected</label>
                        <input type="text" name="piecesRejected" id="piecesRejected" class="form-control" value="<?php echo $editresult['piecesRejected']; ?>">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Total Majors </label>
                        <input type="text" name="totalMajors" id="totalMajors" class="form-control" value="<?php echo $editresult['totalMajors']; ?>">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Defective Percentages</label>
                        <input type="text" name="defectivePercentages" id="defectivePercentages" class="form-control" value="<?php echo $editresult['defectivePercentages']; ?>">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Inspection Results</label>
                        <input type="text" name="inspectionResults" id="inspectionResults" class="form-control" value="<?php echo $editresult['inspectionResults']; ?>">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>No. Of Machines</label>
                        <input type="text" name="noofmachines" id="noofmachines" class="form-control" value="<?php echo $editresult['noofmachines']; ?>">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Running</label>
                        <input type="text" name="running" id="running" class="form-control" value="<?php echo $editresult['running']; ?>">
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group">
                        <label>Detailed Comment</label>
                        <textarea name="detailedComment" id="detailedComment" class="form-control"><?php echo $editresult['detailedComment']; ?></textarea>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group">
                        <label>Actions to be taken by Production</label>
                        <textarea name="actionsproductions" id="actionsproductions" class="form-control"><?php echo $editresult['actionsproductions']; ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
function selectcolorcode(){
var styleId=$('#styleId').val();
$('#colorId').load('loadcolorcode.php?id='+styleId+'&selectId=<?php echo $editresult['colorId']; ?>');
}

function selectline(){
var factoryId=$('#factoryId').val();
$('#lineId').load('loadline.php?id='+factoryId+'&selectId=<?php echo $editresult['lineId']; ?>');
}

<?php if($_GET['id']!=''){ ?>
selectcolorcode();
selectline();
<?php } ?>
</script>

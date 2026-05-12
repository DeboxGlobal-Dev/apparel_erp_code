 <?php
 ob_start();
 include "inc.php";
 $assignto='download';
 $select='*';

   $where='id="'.decode($_REQUEST['styleId']).'"';
   $rs=GetPageRecord($select,'queryMaster',$where);
   $editresultstyle=mysqli_fetch_array($rs);

//  header("Content-type: application/vnd.ms-excel;charset=UTF-8");
//  header("Content-Disposition: attachment; filename=\"".$assignto."_".date('d-m-Y-H-i-s').".xls");
//  header("Cache-control: private");

 ?>

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
$placeValue=$editresult['placementQty'];
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$select='*';
$where='id="'.$editresult['styleId'].'"';
$rs=GetPageRecord($select,'queryMaster',$where);
$editresultstyle=mysqli_fetch_array($rs);
}

?>

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="https://apparelerp.in/apparelerp/global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="https://apparelerp.in/apparelerp/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="https://apparelerp.in/apparelerp/assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
	<link href="https://apparelerp.in/apparelerp/assets/css/layout.min.css" rel="stylesheet" type="text/css">
	<link href="https://apparelerp.in/apparelerp/assets/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="https://apparelerp.in/apparelerp/assets/css/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">
<!--<link href="css/default.css" rel="stylesheet" type="text/css" />-->
 <link href="https://apparelerp.in/apparelerp/css/owl.carousel.min.css" rel="stylesheet" type="text/css">

	<!-- Core JS files -->
	<!--<link rel="stylesheet" href="js/jquery-ui.css">-->

		<script src="js/jquery-1.12.4.js"></script>
		<script src="js/jquery-ui.js"></script>
		<script src="https://apparelerp.in/apparelerp/global_assets/js/main/bootstrap.bundle.min.js"></script>
		<script src="https://apparelerp.in/apparelerp/global_assets/js/plugins/loaders/blockui.min.js"></script>
		<script src="https://apparelerp.in/apparelerp/global_assets/js/plugins/ui/slinky.min.js"></script>
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


         <table class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
		 <thead style="background-color: #f5f5f5;">
							 <tr role="row">
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Inspection No.</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style No.</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Inspection Type</th>
							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Placement Qty.</th>
							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Date</th>
							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Color</th>
							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Received From Embroidery</th>
							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Factory</th>
							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Line</th>
							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Cut Quantity</th>
							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Checked By</th>
							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Status</th>

							  </tr>
						      </thead>
						      <tbody>


							     <tr role="row" class="odd" <?php if($resultlists['stylestatus']=='0'){ ?> style="background-color: #ff704359;" <?php } ?>>

								 <td><?php echo $ticketValue; ?></td>
								  <?php
                                  $queryDataq=GetPageRecord('id,subject','queryMaster','1 and sampleStyle=1 and deletestatus=0 order by id desc');
                                  $queryData=mysqli_fetch_array($queryDataq);

				                  ?>

								<td>

								<?php echo $queryData['subject']; ?>

								</td>

							  <?php
                              $instypeDataq=GetPageRecord('id,name','inspectiontypemaster','1 order by id');
                              $instypeData=mysqli_fetch_array($instypeDataq);

				              ?>
							    <td><?php echo $instypeData['name']; ?></td>


							    <td>18100</td>

								<td><?php if($editresult['dateField']!="" && $editresult['dateField']!="0000-00-00" && $editresult['dateField']!="1970-01-01"){ echo date('d-m-Y',strtotime($editresult['dateField'])); } else{ echo date('d-m-Y'); }?></td>
							    <td>
							Cream
							    </td>

								<td><?php echo $editresult['receivedfEmbroidery']; ?></td>
								 <?php
                             $factoryDataq=GetPageRecord('id,name','factoryMaster','1 order by id');
                             $factoryData=mysqli_fetch_array($factoryDataq);

				               ?>
							    <td><?php echo $factoryData['name']; ?></td>

						<td><select name="lineId" id="lineId" class="select2 form-control">
                        <option value="">Select</option>
                        </select></td>
					    <td><?php echo $editresult['cutQty']; ?></td>

						<?php
                         $userDataq=GetPageRecord('id,firstName,lastName','userMaster','1 and id="'.$_SESSION['userid'].'" order by id');
                         $userData=mysqli_fetch_array($userDataq);

				         ?>

						<td><?php echo $userData['firstName'].' '.$userData['lastName']; ?></td>

						<td><select id="status" name="status" class="form-control">
                          <option value="1" <?php if('1'==$editresult['status']){ ?>selected="selected"<?php } ?>>Active</option>
                          <option value="0" <?php if('0'==$editresult['status']){ ?>selected="selected"<?php } ?>>Inactive</option>
                          </select></td>
						</tr>


						 </tbody>
					     </table>

					    <div class="container-fluid">
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
    $inspectionsubinputDataq=GetPageRecord('*','inspectionsubinput','1 and defectiveType="'.$deTypeData['id'].'" and defectiveId="'.$defectData['id'].'"');
    $inspectionsubinputData=mysqli_fetch_array($inspectionsubinputDataq);
    ?>
                          <div class="col-md-3">
                          <div class="form-group">
                          <div class="defect-class">
                          <div class="label-defect" title="<?php echo $defectData['name']; ?>"><?php echo $defectData['name']; ?></div>
                          <?php if($deTypeData['id']==1){ ?>

                        <?php if($inspectionsubinputData['defectIdField']==1){ ?>
                         <input type="text"  class="form-control" placeholder="" value="Ok" readonly>
                         <?php } else {?>

                         <input type="text"  class="form-control" placeholder="" value="Not Ok" readonly>
                         <?php }?>

                          <?php } if($deTypeData['id']!=1){ ?>
                          <input type="text" name="defectIdFieldMajor<?php echo $deTypeData['id'].$defectData['id']; ?>" id="defectIdFieldMajor<?php echo $deTypeData['id'].$defectData['id']; ?>" class="form-control" placeholder="Major" value="<?php echo $inspectionsubinputData['defectIdFieldMajor']; ?>">
                          <input type="text" name="defectIdFieldMinor<?php echo $deTypeData['id'].$defectData['id']; ?>" id="defectIdFieldMinor<?php echo $deTypeData['id'].$defectData['id']; ?>" class="form-control" placeholder="Minor" value="<?php echo $inspectionsubinputData['defectIdFieldMinor']; ?>">
                          <?php } ?>
                        </div>
                      </div>
                      </div>

                    <?php } }  ?>

                  </div>
					</div>

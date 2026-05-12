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
$seasonId = $editresultsultstyle['subCategoryId'];
$departmentId = $editresultstyle['departmentId'];
$receivedDate = $editresultstyle['receivedDate'];
$patternDescription = $editresultstyle['patternDescription'];
$patternAttachment = $editretyle['seasonId'];
$categoryId = $editresultstyle['categoryId'];
$subCategoryId = $editressultstyle['patternAttachment'];

$lastId=$editresultstyle['id'];

}
$queryid=decode($_GET['styleid']);

if($loginuserprofileId==1 || $loginuserprofileId==91){
$wheresearchassign=' 1 and ';
} else {
if($loginuserprofileId==92){
$wheresearchassign=' 1 and finalstatus="2" and sampleStyle="1" and (assignTo in (select id from '._USER_MASTER_.' where empId in (select id from employeeMaster where reportingTo='.$_SESSION['empid'].')) or assignTo="'.$_SESSION['userid'].'" or ( id in (select styleId from styleAssignmentMaster where assignTo="'.$_SESSION['userid'].'" and styleAssignTo=0))) and ';
} else{

if($loginuserprofileId==93){

$wheresearchassign='1';
$wheresearchassign=' '.$wheresearchassign.' and addedBy="'.$_SESSION['userid'].'" and sampleStyle="1" and ';
}

else{
$wheresearchassign=' ( id in (select styleId from styleAssignmentMaster where assignTo="'.$_SESSION['userid'].'" and styleAssignTo=0))';
$wheresearchassign=' '.$wheresearchassign.' and ';
}
}
}

if($_GET['styleId']!=''){
$styleId = decode($_GET['styleId']);
}
if($_GET['brandId']!=''){
$brandId = decode($_GET['brandId']);
}
?>
<style>
.specialclass label {
    margin: 0px !important;
    margin-left: 5px !important;
}
</style>

<div class="page-content">
  <div class="content-wrapper">

    <?php include "savealert.php"; ?>
    <div class="content pt-0 filterable" style="margin-top:20px;">
         <?php include "top-style.php"; ?>
      <div class="row">
        <div class="col-xl-12">
          <div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
            <div class="col-xl-9">
              <h5 class="card-title" ><?php echo $pageName; ?></h5>
            </div>
            <div class="col-xl-1" style="padding-right: 0px;"> </div>
                 <a href="download-fittracker.php" class="btn bg-teal-400 addnotify" aria-expanded="false" style="background-color: #03d873b8;">Download Excel</a>

          </div>

           <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered table-responsive forbom summaryfinal" style="display: block; overflow: hidden; margin-bottom: 15px;">
                          <tbody style="width: 100%;display: inline-table;">


							<tr class="card-body" style="background-color: #f9f9f9;">
							  <td width="17%" align="left"><div align="center"><strong>SAM </strong></div></td>
							<td width="15%" align="left"><div align="center"><strong>Target(OB) </strong></div></td>
							<td width="17%" align="left"><div align="center"><strong>Factory </strong></div></td>
							<td width="29%" align="left"><div align="center"><strong>Line&nbsp;No</strong></div></td>
							</tr>
							<?php

///////////////////////////////////////////////////////////
$exfastaDataq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$editresultstyle['id'].'" and temid="'.$editresultstyle['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=47)');
$exfastaData=mysqli_fetch_array($exfastaDataq);
//////////////////////////////////////////////////////////
$ocdq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$editresultstyle['id'].'" and temid="'.$editresultstyle['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=3)');
$ocdData=mysqli_fetch_array($ocdq);
///////////////////////////////////////////////////////////
$fabricinhousstDataq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$editresultstyle['id'].'" and temid="'.$editresultstyle['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=22)');
$fabricinhousstData=mysqli_fetch_array($fabricinhousstDataq);
///////////////////////////////////////////////////////////
$filehanderDataq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$editresultstyle['id'].'" and temid="'.$editresultstyle['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=38)');
$filehanderData=mysqli_fetch_array($filehanderDataq);
///////////////////////////////////////////////////////////
$exfacendDataq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$editresultstyle['id'].'" and temid="'.$editresultstyle['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=49)');
$exfacendData=mysqli_fetch_array($exfacendDataq);
///////////////////////////////////////////////////////////
$cuttingstatrDataq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$editresultstyle['id'].'" and temid="'.$editresultstyle['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=42)');
$cuttingstatrData=mysqli_fetch_array($cuttingstatrDataq);

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$ttlorderleadtime=date_diff(date_create($exfastaData['complitionDate']),date_create($ocdData['complitionDate']));
$ttfabricleadtime=date_diff(date_create($fabricinhousstData['complitionDate']),date_create($ocdData['complitionDate']));
$merhcleadtime=date_diff(date_create($filehanderData['complitionDate']),date_create($ocdData['complitionDate']));
$prodleadtime=date_diff(date_create($exfacendData['complitionDate']),date_create($cuttingstatrData['complitionDate']));




    $krs=GetPageRecord('*','queryMaster','1 and id="'.$queryid.'"');
								$lineDatas=mysqli_fetch_array($krs);


				$costsheetVersionId='0';
				$selectversion='*';
				$whereversion='styleId="'.$queryid.'" order by id desc';
				$rsversion=GetPageRecord($selectversion,'operationBulletinVersionMaster',$whereversion);

				$resListingVer=mysqli_fetch_array($rsversion);
				$costsheetVersionId = $resListingVer['versionId'];
				$i++;

				$rrrr=GetPageRecord('*','operationbulletinentry','1 and styleId="'.$queryid.'" and costsheetVersionId="'.$costsheetVersionId.'"');
				$operationData=mysqli_fetch_array($rrrr);

				$fromDate=date("d-m-Y", strtotime($operationData['operationdate']));


	$kr=GetPageRecord('*','linePlanMaster','1 and styleId="'.$queryid.'"');
								$lineData=mysqli_fetch_array($kr);



		$kk=GetPageRecord('*','linePlanMaster','1 and styleId="'.$queryid.'" and factoryId="'.$lineData['factoryId'].'" group by lineId desc');
			$lineDataa=mysqli_fetch_array($kk);

			    $lo=GetPageRecord('*','factoryLineMaster','id="'.$lineDataa['lineId'].'"');
								$lineName=mysqli_fetch_array($lo);




							  ?>
							<tr class="card-body" style="background-color: #f9f9f9;">
							  <td width="17%" align="left"><div align="center"><?php echo $lineDatas['smv']; ?></div></td>
							<td width="15%" align="center"><div align="center"><?php echo $operationData['target']; ?></div></td>
							<td width="17%" align="center"><div align="center">
							    <?php
                      	$km=GetPageRecord('*','factoryMaster','id="'.$lineData['factoryId'].'"');
								$factotyData=mysqli_fetch_array($km);

								echo $factotyData['name'];
								?>
							</div></td>
							<td width="29%" align="center"><div align="center"><span style="padding: 5px 10px; background-color: #0097a7; color: #fff; margin-right: 2px; font-size: 12px; margin-bottom:5px;display: inline-block;"><?php echo str_replace(' ','&nbsp;',$lineName['lineName']);?></span></div></td>
							</tr>
                          </tbody>
                        </table>
          <div class="card">

            <form name="listform" id="listform" method="get">
              <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
              <div id="pageload">
                <div id="" >
                  <div class="datatable-scroll">
                    <table class="table table-bordered table-hover no-footer table-responsive">
                      <thead style="background-color: #f5f5f5; text-align:center;">
                        <tr role="row">

                                     <th rowspan="3" width="20%"><div align="center">Date</div></th>

                  <th colspan="4"><div align="center">Cutting</div></th>

                  <th rowspan="3"><div align="center">Variance</div></th>
                  <th colspan="4"><div align="center">Sewing</div></th>
                  <th rowspan="3"><div align="center">Variance</div></th>
                  <th colspan="4"><div align="center">Finishing</div></th>
                  <th rowspan="3"><div align="center">Variance</div></th>
                  <th colspan="4"><div align="center">packing</div></th>



</tr>
<tr role="row">

         <th colspan="2"><div align="center">Plan</div></th>
                  <th colspan="2"><div align="center">Actual</div></th>
                  <th colspan="2"><div align="center">Plan</div></th>
                  <th colspan="2"><div align="center">Actual</div></th>
                  <th colspan="2"><div align="center">Plan</div></th>
                  <th colspan="2"><div align="center">Actual</div></th>
                  <th colspan="2"><div align="center">Plan</div></th>
                  <th colspan="2"><div align="center">Actual</div></th>


</tr>
<tr role="row">

         <th><div align="center">Today</div></th>
                  <th><div align="center">Till&nbsp;Date</div></th>
                  <th><div align="center">Today</div></th>
                  <th><div align="center">Till&nbsp;Date</div></th>
                  <th><div align="center">Today</div></th>
                  <th><div align="center">Till&nbsp;Date</div></th>
                  <th><div align="center">Today</div></th>
                  <th><div align="center">Till&nbsp;Date</div></th>
                  <th><div align="center">Today</div></th>
                  <th><div align="center">Till&nbsp;Date</div></th>
                  <th><div align="center">Today</div></th>
                  <th><div align="center">Till&nbsp;Date</div></th>
                  <th><div align="center">Today</div></th>
                  <th><div align="center">Till&nbsp;Date</div></th>
                  <th><div align="center">Today</div></th>
                  <th><div align="center">Till&nbsp;Date</div></th>



</tr>

                      </thead>
                       <tbody id="allhotellisting">



                                   	<?php
								$snoo=0;
								//$rs=GetPageRecord('*','taskListMaster','deletestatus=0 and status=1 and tnatemplate="'.$editresultstyle['tnaTemplateId'].'" and tna=1 order by id asc');

								$rs=GetPageRecord('*','taskListMaster','1 and tnatemplate="'.$editresultstyle['tnaTemplateId'].'" and name="42"');
								$reslisttask=mysqli_fetch_array($rs);

								$where1='taskListId="'.$reslisttask['id'].'" and styleId="'.decode($_GET['styleid']).'" and status=1';
								$rs1=GetPageRecord('*','timeActionReport',$where1);
								$data=mysqli_fetch_array($rs1);


								?>





                                    <tr role="row" class="odd" <?php if($resultlists['stylestatus']=='0'){ ?> style="background-color: #ff704359;" <?php } ?>>

                                    <td><?php if($data['complitionDate']!='' && $data['complitionDate']!='1970-01-01' && $data['complitionDate']!='0000-00-00'){ echo date('d-m-Y', strtotime($data['complitionDate'])); } ?></td>
                                    <td></td>
                                    <td></td>
                                    <td><?php echo $styleDatawssw['']; ?></td>


                                    <td></td>
                                    <td></td>


                                    <td><?php echo $styleDatawssq['']; ?> </td>



                                    <td><?php        ?></td>

                                    <td></td>
                                    <td></td>
                                    <td><?php echo $resultlists['']; ?></td>
                                    <td>
                                    <?php echo $resultlists['']; ?>

                                    </td>



                                    <td><?php echo $styleDatawss['']; ?>&nbsp;<?php echo $styleDatawss['']; ?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>


                                    </tr>



                      </tbody>
                    </table>
                    <div class="pagingdiv" style="width: 97%;margin: 20px auto;">
                      <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                          <tr>
                            <td><table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td style="padding-right:20px;"><?php echo $no; ?> Entries</td>
                                  <td><select name="records" id="records" onchange="this.form.submit();" class="lightgrayfield" style="padding: 5px;border: 1px solid #ccc;">
                                      <option value="25" <?php if($_GET['records']=='25'){ ?> selected="selected"<?php } ?>>25 Records Per Page</option>
                                      <option value="50" <?php if($_GET['records']=='50'){ ?> selected="selected"<?php } ?>>50 Records Per Page</option>
                                      <option value="100" <?php if($_GET['records']=='100'){ ?> selected="selected"<?php } ?>>100 Records Per Page</option>
                                      <option value="200" <?php if($_GET['records']=='200'){ ?> selected="selected"<?php } ?>>200 Records Per Page</option>
                                      <option value="300" <?php if($_GET['records']=='300'){ ?> selected="selected"<?php } ?>>300 Records Per Page</option>
                                    </select></td>
                                </tr>
                              </table></td>
                            <td align="right"><div class="pagingnumbers"><?php echo $paging; ?></div></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<style>
 .liststyleimg{float: left;
    width: 70px;
    margin-right: 15px;
    padding: 5px;
    border: 2px solid #e6e6e6;}

	.badge.dropdown-toggle:after { display:none;
}
.pagingnumbers {
    border: 1px #EAEAEA solid;
    border-radius: 2px;
    overflow: hidden;
    float: right;
}
.pagingnumbers a {
    display: inline-block;
    padding: 8px 15px;
    min-width: 12px;
    text-align: center;
    color: #2c2c2c;
    text-decoration: none;
    border-right: #EAEAEA solid 1px;
    font-size: 12px;
    padding-top: 9px;
}
.pagingnumbers .disabled {
    display: inline-block;
    padding: 7px 8px;
    color: #CECECE;
}
.pagingnumbers .current {
    display: inline-block;
    padding: 8px 8px;
}
.pagingnumbers .current {
    background-color: #2ca1cc;
    color: #FFFFFF;
}
.dataTables_info,.dataTables_paginate,.dataTables_length {
	display:none !important;
 }

 </style>
<script>
function deletestyle(id){
var delStyle = confirm('Are you sure you want to delete this style?');
if(delStyle==true){
window.location.href = 'showpage.crm?module=style&d='+id; //delete style
}
}
</script>
<script>
$('#DataTables_Table_2').DataTable( {
"order": [[ 0, "desc" ]]
} );
</script>
<script>
$(document).ready(function(){
$("#filtersearch").on("keyup", function() {
var value = $(this).val().toLowerCase();
$("#allhotellisting tr").filter(function() {
$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
});
});
});
</script>



<style>
.color-box{
width:132px;
}
</style>

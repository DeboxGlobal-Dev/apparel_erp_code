<?php
if($loginuserprofileId==1 || $loginuserprofileId==93){

$wheresearchassign=' 1 and ';

} else {

if($loginuserprofileId==92){

$wheresearchassign=' 1 and finalstatus="2" and assignTo in (select id from '._USER_MASTER_.' where empId in (select id from employeeMaster where reportingTo='.$_SESSION['empid'].')) or assignTo="'.$_SESSION['userid'].'" and ';
} else{

$wheresearchassign=' ( id in (select styleId from styleAssignmentMaster where assignTo="'.$_SESSION['userid'].'" and styleAssignTo=0))';

$wheresearchassign=' '.$wheresearchassign.' and ';

}

}

?>
<?php
$quarterIdvalue=$_POST['quarterId'];
?>

<div class="page-content">
  <!-- Main sidebar -->
  <div class="content-wrapper">
    <div class="content pt-0" style="margin-top:20px;">
      <div class="row">
        <div class="col-xl-12">
          <div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
            <div class="col-xl-9">
              <h5 class="card-title"><?php echo $pageName; ?></h5>

            </div>
            <div class="col-xl-2" style="padding-right: 0px;">

                <a href="download-capacityvalidation.php" class="btn bg-teal-400 addnotify" aria-expanded="false" style="background-color: #03d873b8; margin-left: 66px;">Download Excel</a>
              <div class="btn-group justify-content-center" style="float:right;"> </div>

            </div>

           </div>
           <div class="card" style="padding-bottom:40px;">
            <div class="row" style="margin-top:20px;">
              <div class="col-md-12" style=" padding:0px 25px;">
                <form action="" method="post">
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <select name="quarterId[]" id="quarterId" multiple="multiple" class="form-control">
                          <?php
                          $fc=GetPageRecord('*','quarterMaster','1 order by id');
while($catData=mysqli_fetch_array($fc)){
$checked='';
if(in_array($catData['id'],$quarterIdvalue)){
$checked='selected';
}
?>
                          <option value="<?php echo $catData['id']; ?>" <?php echo $checked; ?> ><?php echo $catData['name']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <script>
$(function() {
$('#quarterId').multiselect({
includeSelectAllOption: true,
enableFiltering: true,
enableCaseInsensitiveFiltering: true,
filterPlaceholder: 'Search...'
});
});
</script>
                    <div class="col-md-2" style="display:none;">
                      <div class="form-group">
                        <input name="fromDate" id="fromDate"  type="text" class="newDatePicker form-control" placeholder="From Date" value="<?php if($_POST['fromDate']!=""){ echo date('d-m-Y',strtotime($_POST['fromDate'])); } ?>">
                      </div>
                    </div>
                    <div class="col-md-2" style="display:none;">
                      <div class="form-group">
                        <input name="toDate" id="toDate"  type="text" class="newDatePicker form-control" placeholder="To Date" value="<?php if($_POST['toDate']!=""){ echo date('d-m-Y',strtotime($_POST['toDate'])); } ?>">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <input name="" type="submit" id="" class=" btn btn-primary" value="Search" />
                        <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
                      </div>
                    </div>
                    <!--<div class="col-md-2">-->
                    <!--  <div class="form-group">-->
                    <!--   <a href="download-capacityvalidation.php" class="btn bg-teal-400 addnotify" aria-expanded="false" style="background-color: #03d873b8; margin-left: 668px;">Download Excel</a>-->
                    <!--  </div>-->
                    <!--</div>-->
                  </div>
                </form>
              </div>
            </div>
            <div style="padding:0px 15px;">
              <table class="table table-bordered capacity-class" style="width:100%;">
                <tr style="background-color: #fff7b3;">
                  <th colspan="7" style="text-align:center;">Capacity Allocation</th>
                </tr>
                <?php
						$qq=GetPageRecord('*','quarterMaster','1 order by id');
						while($quarData=mysqli_fetch_array($qq)){
						if(in_array($quarData['id'],$quarterIdvalue) || $quarterIdvalue==""){

						?>
                <tr style="background-color: #f5f5f5; font-size: 12px; text-transform: capitalize;">
                  <th colspan="7"><div align="left"><?php echo $quarData['name'].' - '.date('F',strtotime($quarData['fromDate'])).' To '.date('F',strtotime($quarData['toDate'])); ?></div></th>
                </tr>
                <tr style="background-color: #e9fff8;">
                  <th><div align="left">Brand</div></th>
                  <th><div align="center">Avg&nbsp;SAM</div></th>
                  <th><div align="center">Avg&nbsp;Efficiency % </div></th>
                  <th><div align="center">Capacity&nbsp;Allocated</div></th>
                  <th><div align="center">No.&nbsp;of&nbsp;Styles</div></th>
                  <th ><div align="center">Avg Quantity</div></th>
                  <th><div align="center">%&nbsp;of&nbsp;Business</div></th>
                </tr>
                <?php
						$bd=GetPageRecord('*','factoryBrandMaster','1 and quarter="'.$quarData['name'].'" group by brandId asc');
						while($brandData=mysqli_fetch_array($bd)){

						$countFactory=0;
						$nuCount=GetPageRecord('id','factoryBrandMaster','1 and quarter="'.$quarData['name'].'" and brandId="'.$brandData['brandId'].'"');
						$countFactory=mysql_num_rows($nuCount);

$aaaaaaaa=GetPageRecord('sum(avgSam) as totalavgSam,sum(avgEfficiency) as totalavgEfficiency,sum(outputquarter) as totaloutputquarter,sum(avgQty) as totalavgQty,sum(styleNo) as totalstyleNo','factoryBrandMaster','1 and quarter="'.$quarData['name'].'" and brandId="'.$brandData['brandId'].'"');
$brandDataFactory=mysqli_fetch_array($aaaaaaaa);
						?>
                <tr>
                  <td><div align="left"><a href="#" onclick="opmodalpop('Factory Wise Allocation','modalpop.php?action=viewfactorywiseallocation&brandId=<?php echo encode($brandData['brandId']); ?>&quarterId=<?php echo $quarData['name']; ?>','500px','auto');" data-toggle="modal" data-target="#modalpop"><?php echo getBrandName($brandData['brandId']); ?></a></div></td>

                  <td><div align="center" id="capacityavgsam<?php echo $quarData['id'].$brandData['brandId']; ?>"><?php echo $brandDataFactory['totalavgSam']/$countFactory; ?></div></td>
                  <td><div align="center" id="capacityavgefficiency<?php echo $quarData['id'].$brandData['brandId']; ?>"><?php echo $brandDataFactory['totalavgEfficiency']/$countFactory; ?></div></td>
                  <td><div align="center" id="capacityprojection<?php echo $quarData['id'].$brandData['brandId']; ?>"><?php echo round($brandDataFactory['totaloutputquarter'],2); ?></div></td>
                  <?php
$totalStyles=0;
$counttotalStyles=0;
$counttotalStylesq=GetPageRecord('sum(styleNo) as totalstyleNo','factoryBrandMaster','1 and quarter="'.$quarData['name'].'" and brandId="'.$brandData['brandId'].'"');
$counttotalStylessss=mysqli_fetch_array($counttotalStylesq);

$counttotalStyles=$counttotalStylessss['totalstyleNo'];

$kkkkkkkkkksss=GetPageRecord('sum(styleNo) as totalstyleNo','factoryBrandMaster','1 and quarter="'.$quarData['name'].'" order by id');

$totalStylessss=mysqli_fetch_array($kkkkkkkkkksss);
$totalStyles=$totalStylessss['totalstyleNo'];


?>
                  <td><div align="center" id="capacitystyles<?php echo $quarData['id'].$brandData['brandId']; ?>"><?php  echo $counttotalStyles; ?></div></td>
                  <td><div align="center" id="capacityquantity<?php echo $quarData['id'].$brandData['brandId']; ?>"><?php echo round($brandDataFactory['totalavgQty'],2); ?></div></td>
                  <td><div align="center" id="capacitybusiness<?php echo $quarData['id'].$brandData['brandId']; ?>"><?php echo round(($counttotalStyles*100)/$totalStyles); ?></div></td>
                </tr>
                <?php } } } ?>
              </table>
              <table class="table table-bordered capacity-class" style="width:100%; margin-top:30px;">
                <tr style="background-color: #fff7b3;">
                  <th colspan="7" style="text-align:center;">Projection Received</th>
                </tr>
                <?php
						$qq=GetPageRecord('*','quarterMaster','1 order by id');
						while($quarData=mysqli_fetch_array($qq)){
						if(in_array($quarData['id'],$quarterIdvalue) || $quarterIdvalue==""){

						?>
                <tr style="background-color: #f5f5f5; font-size: 12px; text-transform: capitalize;">
                  <th colspan="7"><div align="left"><?php echo $quarData['name'].' - '.date('F',strtotime($quarData['fromDate'])).' To '.date('F',strtotime($quarData['toDate'])); ?></div></th>
                </tr>
                <tr style="background-color: #e9fff8;">
                  <th><div align="left">Brand</div></th>
                  <th><div align="center">Avg&nbsp;SAM</div></th>
                  <th><div align="center">Avg&nbsp;Efficiency % </div></th>
                  <th><div align="center">Projection Received </div></th>
                  <th><div align="center">No.&nbsp;of&nbsp;Styles</div></th>
                  <th ><div align="center">Avg Quantity</div></th>
                  <th><div align="center">%&nbsp;of&nbsp;Business</div></th>
                </tr>
                <?php
						$bd=GetPageRecord('*','factoryBrandMaster','1 and quarter="'.$quarData['name'].'" group by brandId asc');
						while($brandData=mysqli_fetch_array($bd)){

$totalStylesq=0;
$totalBrandsStyles=0;
$sumFinal=0;

////////////////////////////////////////////////////////////////////// /
$totalStylesq=GetPageRecord('id','queryMaster','1 and subject!="" and deletestatus=0 and sampleStyle=1 and MONTH(receivedDate)>="'.date('m-d',strtotime($quarData['fromDate'])).'" and MONTH(receivedDate)<="'.date('m-d',strtotime($quarData['toDate'])).'" and receivedDate!="0000-00-00" and receivedDate!="1970-01-01" and receivedDate!="" order by id');
$totalStyles=mysql_num_rows($totalStylesq);
///////////////////////////////////////////////////////////////
$totalBrandsStylesq=GetPageRecord('id','queryMaster','1 and subject!="" and deletestatus=0 and sampleStyle=1 and brandId="'.$brandData['brandId'].'" and MONTH(receivedDate)>="'.date('m-d',strtotime($quarData['fromDate'])).'" and MONTH(receivedDate)<="'.date('m-d',strtotime($quarData['toDate'])).'" and receivedDate!="0000-00-00" and receivedDate!="1970-01-01" and receivedDate!="" order by id');
$totalBrandsStyles=mysql_num_rows($totalBrandsStylesq);
///////////////////////////////////////////////////////////////////
$sumFinalq=GetPageRecord('sum(smv) as totalsmv,sum(efficiency) as totalefficiency,sum(projecQty) as totalprojecQty','queryMaster','1 and brandId="'.$brandData['brandId'].'" and MONTH(receivedDate)>="'.date('m-d',strtotime($quarData['fromDate'])).'" and MONTH(receivedDate)<="'.date('m-d',strtotime($quarData['toDate'])).'" and receivedDate!="0000-00-00" and receivedDate!="1970-01-01" and receivedDate!=""');
$sumFinal=mysqli_fetch_array($sumFinalq);
						?>
                <tr>
                  <td><div align="left"><?php echo getBrandName($brandData['brandId']); ?></div></td>
                  <td><div align="center" id="projectionavgsam<?php echo $quarData['id'].$brandData['brandId']; ?>"><?php echo $sumFinal['totalsmv']/$totalBrandsStyles; ?></div></td>
                  <td><div align="center" id="projectionavgefficiency<?php echo $quarData['id'].$brandData['brandId']; ?>"><?php echo $sumFinal['totalefficiency']/$totalBrandsStyles; ?></div></td>
                  <td><div align="center" id="projectionprojection<?php echo $quarData['id'].$brandData['brandId']; ?>"><?php echo round($sumFinal['totalprojecQty'],2); ?></div></td>
                  <td><div align="center" id="projectionstyles<?php echo $quarData['id'].$brandData['brandId']; ?>"> <?php echo $totalBrandsStyles; ?> </div></td>
                  <td><div align="center" id="projectionquantity<?php echo $quarData['id'].$brandData['brandId']; ?>"><?php echo round(($sumFinal['totalprojecQty']/$totalBrandsStyles),2); ?></div></td>
                  <td><div align="center" id="projectionbusiness<?php echo $quarData['id'].$brandData['brandId']; ?>"><?php echo round(($totalBrandsStyles*100)/$totalStyles); ?></div></td>
                </tr>
                <?php } } } ?>
              </table>
              <table class="table table-bordered capacity-class" style="width:100%;margin-top:30px;">
                <tr style="background-color: #fff7b3;">
                  <th colspan="7" style="text-align:center;">Variance</th>
                </tr>
                <?php
						$qq=GetPageRecord('*','quarterMaster','1 order by id');
						while($quarData=mysqli_fetch_array($qq)){
						if(in_array($quarData['id'],$quarterIdvalue) || $quarterIdvalue==""){

						?>
                <tr style="background-color: #f5f5f5; font-size: 12px; text-transform: capitalize;">
                 <th colspan="7"><div align="left"><?php echo $quarData['name'].' - '.date('F',strtotime($quarData['fromDate'])).' To '.date('F',strtotime($quarData['toDate'])); ?></div></th>
                </tr>
                <tr style="background-color: #e9fff8;">
                  <th><div align="left">Brand</div></th>
                  <th><div align="center">Avg&nbsp;SAM</div></th>
                  <th><div align="center">Avg&nbsp;Efficiency % </div></th>
                  <th><div align="center">Booking Status </div></th>
                  <th><div align="center">No.&nbsp;of&nbsp;Styles</div></th>
                  <th ><div align="center">Avg Quantity</div></th>
                  <th><div align="center">%&nbsp;of&nbsp;Business</div></th>
                </tr>
                <?php
						$bd=GetPageRecord('*','factoryBrandMaster','1 and quarter="'.$quarData['name'].'" group by brandId asc');
						while($brandData=mysqli_fetch_array($bd)){

						  //echo $brandData['brandId'];
						 // echo $quarData['id'];

$totalStylesq=0;
$totalBrandsStyles=0;
$sumFinal=0;

////////////////////////////////////////////////////////////////////// /
$totalStylesq=GetPageRecord('id','queryMaster','1 and subject!="" and deletestatus=0 and sampleStyle=1 and MONTH(receivedDate)>="'.date('m-d',strtotime($quarData['fromDate'])).'" and MONTH(receivedDate)<="'.date('m-d',strtotime($quarData['toDate'])).'" and receivedDate!="0000-00-00" and receivedDate!="1970-01-01" and receivedDate!="" order by id');
$totalStyles=mysql_num_rows($totalStylesq);
///////////////////////////////////////////////////////////////
$totalBrandsStylesq=GetPageRecord('id','queryMaster','1 and subject!="" and deletestatus=0 and sampleStyle=1 and brandId="'.$brandData['brandId'].'" and MONTH(receivedDate)>="'.date('m-d',strtotime($quarData['fromDate'])).'" and MONTH(receivedDate)<="'.date('m-d',strtotime($quarData['toDate'])).'" and receivedDate!="0000-00-00" and receivedDate!="1970-01-01" and receivedDate!="" order by id');
$totalBrandsStyles=mysql_num_rows($totalBrandsStylesq);
///////////////////////////////////////////////////////////////////
$sumFinalq=GetPageRecord('sum(smv) as totalsmv,sum(efficiency) as totalefficiency,sum(projecQty) as totalprojecQty','queryMaster','1 and brandId="'.$brandData['brandId'].'" and MONTH(receivedDate)>="'.date('m-d',strtotime($quarData['fromDate'])).'" and MONTH(receivedDate)<="'.date('m-d',strtotime($quarData['toDate'])).'" and receivedDate!="0000-00-00" and receivedDate!="1970-01-01" and receivedDate!=""');
$sumFinal=mysqli_fetch_array($sumFinalq);
						?>
                <tr>
                  <td><div align="left"><?php echo getBrandName($brandData['brandId']); ?></div></td>
                  <td><div align="center" id="varianceavgsam<?php echo $quarData['id'].$brandData['brandId']; ?>">0</div></td>
                  <td><div align="center" id="varianceavgefficiency<?php echo $quarData['id'].$brandData['brandId']; ?>">0</div></td>
                  <td><div align="center" id="varianceprojection<?php echo $quarData['id'].$brandData['brandId']; ?>">0</div></td>
                  <td><div align="center" id="variancestyles<?php echo $quarData['id'].$brandData['brandId']; ?>">0</div></td>
                  <td><div align="center" id="variancequantity<?php echo $quarData['id'].$brandData['brandId']; ?>">0</div></td>
                  <td><div align="center" id="variancebusiness<?php echo $quarData['id'].$brandData['brandId']; ?>">0</div></td>
                </tr>
                <?php } } } ?>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Main sidebar -->
</div>
<!-- /main content -->
</div>
<script>
function CalVariance(){
<?php
$qq=GetPageRecord('*','quarterMaster','1 order by id');
while($quarData=mysqli_fetch_array($qq)){
if(in_array($quarData['id'],$quarterIdvalue) || $quarterIdvalue==""){

$bd=GetPageRecord('*','factoryBrandMaster','1 and quarter="'.$quarData['name'].'" group by brandId asc');
while($brandData=mysqli_fetch_array($bd)){ ?>

/////////////////////////////////////////////////////////////////////////////////////////////////////////
var capacityavgsam<?php echo $quarData['id'].$brandData['brandId']; ?>=$('#capacityavgsam<?php echo $quarData['id'].$brandData['brandId']; ?>').text();
var projectionavgsam<?php echo $quarData['id'].$brandData['brandId']; ?>=$('#projectionavgsam<?php echo $quarData['id'].$brandData['brandId']; ?>').text();
var varianceavgsam<?php echo $quarData['id'].$brandData['brandId']; ?>= projectionavgsam<?php echo $quarData['id'].$brandData['brandId']; ?> -Number(capacityavgsam<?php echo $quarData['id'].$brandData['brandId']; ?>);
$('#varianceavgsam<?php echo $quarData['id'].$brandData['brandId']; ?>').text(varianceavgsam<?php echo $quarData['id'].$brandData['brandId']; ?>);

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
var capacityavgefficiency<?php echo $quarData['id'].$brandData['brandId']; ?>=$('#capacityavgefficiency<?php echo $quarData['id'].$brandData['brandId']; ?>').text();
var projectionavgefficiency<?php echo $quarData['id'].$brandData['brandId']; ?>=$('#projectionavgefficiency<?php echo $quarData['id'].$brandData['brandId']; ?>').text();
var varianceavgefficiency<?php echo $quarData['id'].$brandData['brandId']; ?>= Number(capacityavgefficiency<?php echo $quarData['id'].$brandData['brandId']; ?> - projectionavgefficiency<?php echo $quarData['id'].$brandData['brandId']; ?>);
$('#varianceavgefficiency<?php echo $quarData['id'].$brandData['brandId']; ?>').text(varianceavgefficiency<?php echo $quarData['id'].$brandData['brandId']; ?>);

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
var capacityprojection<?php echo $quarData['id'].$brandData['brandId']; ?>=$('#capacityprojection<?php echo $quarData['id'].$brandData['brandId']; ?>').text();
var projectionprojection<?php echo $quarData['id'].$brandData['brandId']; ?>=$('#projectionprojection<?php echo $quarData['id'].$brandData['brandId']; ?>').text();
var varianceprojection<?php echo $quarData['id'].$brandData['brandId']; ?>= Number(capacityprojection<?php echo $quarData['id'].$brandData['brandId']; ?> - projectionprojection<?php echo $quarData['id'].$brandData['brandId']; ?>);
$('#varianceprojection<?php echo $quarData['id'].$brandData['brandId']; ?>').text(varianceprojection<?php echo $quarData['id'].$brandData['brandId']; ?>);


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
var capacitystyles<?php echo $quarData['id'].$brandData['brandId']; ?>=$('#capacitystyles<?php echo $quarData['id'].$brandData['brandId']; ?>').text();
var projectionstyles<?php echo $quarData['id'].$brandData['brandId']; ?>=$('#projectionstyles<?php echo $quarData['id'].$brandData['brandId']; ?>').text();
var variancestyles<?php echo $quarData['id'].$brandData['brandId']; ?>= Number(capacitystyles<?php echo $quarData['id'].$brandData['brandId']; ?> - projectionstyles<?php echo $quarData['id'].$brandData['brandId']; ?>);
$('#variancestyles<?php echo $quarData['id'].$brandData['brandId']; ?>').text(variancestyles<?php echo $quarData['id'].$brandData['brandId']; ?>);


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
var capacityquantity<?php echo $quarData['id'].$brandData['brandId']; ?>=$('#capacityquantity<?php echo $quarData['id'].$brandData['brandId']; ?>').text();
var projectionquantity<?php echo $quarData['id'].$brandData['brandId']; ?>=$('#projectionquantity<?php echo $quarData['id'].$brandData['brandId']; ?>').text();
var variancequantity<?php echo $quarData['id'].$brandData['brandId']; ?>= Number(capacityquantity<?php echo $quarData['id'].$brandData['brandId']; ?> - projectionquantity<?php echo $quarData['id'].$brandData['brandId']; ?>);
$('#variancequantity<?php echo $quarData['id'].$brandData['brandId']; ?>').text(variancequantity<?php echo $quarData['id'].$brandData['brandId']; ?>);


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
var capacitybusiness<?php echo $quarData['id'].$brandData['brandId']; ?>=$('#capacitybusiness<?php echo $quarData['id'].$brandData['brandId']; ?>').text();
var projectionbusiness<?php echo $quarData['id'].$brandData['brandId']; ?>=$('#projectionbusiness<?php echo $quarData['id'].$brandData['brandId']; ?>').text();
var variancebusiness<?php echo $quarData['id'].$brandData['brandId']; ?>= Number(capacitybusiness<?php echo $quarData['id'].$brandData['brandId']; ?> - projectionbusiness<?php echo $quarData['id'].$brandData['brandId']; ?>);
$('#variancebusiness<?php echo $quarData['id'].$brandData['brandId']; ?>').text(variancebusiness<?php echo $quarData['id'].$brandData['brandId']; ?>);


<?php }}} ?>

}
CalVariance();
</script>
<style>
 .liststyleimg{float: left;
    width: 70px;
    margin-right: 15px;
    padding: 5px;
    border: 2px solid #e6e6e6;}

	.badge.dropdown-toggle:after { display:none;
}
 </style>
<script>
$('#DataTables_Table_2').DataTable( {
"order": [[ 0, "desc" ]]
} );
</script>
<style>
.dataTables_filter {
    margin-top: 15px;
}
.dataTables_length {
    margin-top: 15px;
	margin-right:18px;
}
.dataTables_filter input {
    margin-left:10px;
}
.dataTables_info {
    margin-top: 15px;
    margin-left: 18px !important;
}
.dataTables_paginate {
    margin-top: 15px;
    margin-right: 18px;
}
table tr th,td{
border:1px solid #ccc !important;
}
</style>

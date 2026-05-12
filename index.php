<?php
ob_start();
include "inc.php";
include "config/logincheck.php";

$selectedpage='1';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Dashboard -<?php echo $systemname; ?></title>
<?php  include "headerinclude.php"; ?>
</head>
<!--style="background-image:url(images/banner.png); background-size:100% 100%;"-->
<body>
<script src="global_assets/js/plugins/visualization/echarts/echarts.min.js"></script>
<!-- Main navbar -->
<?php include "header.php"; ?>
<!-- /main navbar -->
<!-- Page content -->
<div class="content-wrapper">
  <div class="content">
    <!-- start of status-->
    <?php if($loginuserprofileId==1 || $loginuserprofileId==93 || $loginuserprofileId==91){ ?>
    <div class="row">
      <div class="col-sm-12 col-xl-12">
        <div class="card card-body text-center">
          <div style="overflow:auto; height:auto;">
            <table width="100%" class="table" cellpadding="5" cellspacing="0" style="border-collapse:collapse" id="dashboardstatus">
              <tbody>
                <tr>
                  <?php
									$selectcreted='*';
									$wherecreated='1 and subject!="" and deletestatus=0 and sampleStyle=1';
									$rscreated=GetPageRecord($selectcreted,_QUERY_MASTER_,$wherecreated);
									$resultcreated=mysqli_fetch_array($rscreated);
									$createdstyle = mysqli_num_rows($rscreated);

									$selectaccepted='*';
									$whereaccepted='stylestatus=1 and finalstatus=2 and subject!="" and deletestatus=0';
									$rsaccepted=GetPageRecord($selectaccepted,_QUERY_MASTER_,$whereaccepted);
									$resultaccepted=mysqli_fetch_array($rsaccepted);
									$acceptedstyle = mysqli_num_rows($rsaccepted);

									$select1b='*';
								    $where1b='styleId="'.$resulta['id'].'" order by id desc limit 1';
									$rs1b=GetPageRecord($select1b,'styleAssignmentMaster',$where1b);
									$result1b=mysqli_fetch_array($rs1b);

									$selectR='*';
									$whereR='1 and subject!="" and styleStatus=0 and deletestatus=0';
									$rsR=GetPageRecord($selectR,_QUERY_MASTER_,$whereR);
									$resultR=mysqli_fetch_array($rsR);
									$resultCR = mysqli_num_rows($rsR);
								    ?>
                  <td><div class="dashboard-outer" style="border: 1px solid #6699ff;">
                      <div class="dashboard-status" onClick="window.location.href ='showpage.crm?module=style'" style="color:#6699ff;"><?php echo $createdstyle; ?></div>
                      <div class="statusname">Styles Rcvd</div>
                    </div></td>
                  <!--<td><div class="dashboard-outer" style="border: 1px solid #33cc33;"><div class="dashboard-status" onClick="window.location.href ='showpage.crm?module=style&stylestatus=2'" style="color:#33cc33;"><?php echo $acceptedstyle; ?></div><div class="statusname">Accepted</div></div></td>
<td><div class="dashboard-outer" style="border: 1px solid #da0404;"><div class="dashboard-status" onClick="window.location.href ='showpage.crm?module=style&stylestatus=0'" style="color:#da0404;"><?php echo $resultCR; ?></div><div class="statusname">Rejected</div></div></td>-->
                  <td title="Product Development"><div class="dashboard-outer" style="border: 1px solid #ff9933;">
                      <div class="dashboard-status" onClick="window.location.href ='showpage.crm?module=style&main=<?php echo "2"; ?>'" style="color:#ff9933;">
                        <?php
$rspd=GetPageRecord('*',_QUERY_MASTER_,'stylestatus=1 and finalstatus=2 and subject!="" and sampleStyle = "1" and deletestatus=0 and styleTypeId in (1,3)');
$resultpd=mysqli_num_rows($rspd);
echo $resultpd;
?>
                      </div>
                      <div class="statusname" >PD Styles</div>
                    </div></td>

                  <td><div class="dashboard-outer" style="border: 1px solid #6699ff; ">
                      <div class="dashboard-status" onClick="window.location.href ='showpage.crm?module=style&confirmStyle=yes'" style="color:#6699ff;" title=""><?php
$rspo=GetPageRecord('*',_QUERY_MASTER_,'1  and subject!="" and poAttachment!="" and sampleStyle="1" and deletestatus=0 order by id desc');
$resultpocount=mysqli_num_rows($rspo);
echo $resultpocount;
?></div>
                      <div class="statusname">Confirmed Styles</div>
                    </div></td>
                  <td title="Long Lead Time Styles"><div class="dashboard-outer" style="border: 1px solid #669900;">
                      <div class="dashboard-status" onClick="window.location.href ='showpage.crm?module=style&riskPriority=yes'" style="color:#669900;">0</div>
                      <div class="statusname">LLT Styles</div>
                    </div></td>
                  <td><div class="dashboard-outer" style="border: 1px solid #f542b3;">
                      <div class="dashboard-status" style="color:#f542b3;">0</div>
                      <div class="statusname">Regular Styles</div>
                    </div></td>
                  <td><div class="dashboard-outer" style="border: 1px solid #15f008;">
                      <div class="dashboard-status" style="color:#15f008;">0</div>
                      <div class="statusname">Fast Track Styles</div>
                    </div></td>
                  <td title="Test and Run Styles"><div class="dashboard-outer" style="border: 1px solid #e4da5a;">
                      <div class="dashboard-status" style="color:#e4da5a;">0</div>
                      <div class="statusname">TNR Styles </div>
                    </div></td>
                 <!-- <td><div class="dashboard-outer" style="border: 1px solid #15f008;">
                      <div class="dashboard-status" style="color:#15f008;">8</div>
                      <div class="statusname">SMS Styles</div>
                    </div></td>-->
                  <td><div class="dashboard-outer" style="border: 1px solid #77eac5;">
                      <div class="dashboard-status" onClick="window.location.href ='showpage.crm?module=style&riskPriority=yes'" style="color:#77eac5;">
					  <?php
$rsrisk=GetPageRecord('*',_QUERY_MASTER_,'1 and subject!="" and sampleStyle="1" and deletestatus=0 and queryPriority in (2,3)  order by id desc');
$resultrsriskcount=mysqli_num_rows($rsrisk);
echo $resultrsriskcount;
?>
					  </div>
                      <div class="statusname">High Risk Styles</div>
                    </div></td>
                  <td><div class="dashboard-outer" style="border: 1px solid #0099ff;">
                      <div class="dashboard-status" style="color:#0099ff;">0</div>
                      <div class="statusname">To Be Planned Styles</div>
                    </div></td>
				<td title="Low Production Lead Time"><div class="dashboard-outer" style="border: 1px solid #0099ff;">
                      <div class="dashboard-status" style="color:#0099ff;">0</div>
                      <div class="statusname">Low PLT
</div>
                    </div></td>
                </tr>
              </tbody>
            </table>
            <script type="text/javascript">
    $('.dashboard-status').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 2000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});
</script>
            <style>
#dashboardstatus tr td{
padding:0px !important;
}
.dashboard-outer {
    width: 117px;
    margin: 0px 5px;
    float: left;
    border-radius: 5px;

    padding: 5px 0px;
}

#dashboardstatus tr td:hover .dashboard-outer{
    background: #ededed;
	cursor:pointer;
}


.dashboard-status{
font-size:30px;
font-weight:400;
}
.statusname{
text-transform:uppercase;
font-size:10px;
font-weight:500;
color:#000;
}
</style>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
    <!--end of status-->
    <!-- start pd head dashboard-->
    <!-- start of status-->
    <?php if($loginuserprofileId==92){ ?>
    <div class="row">
      <div class="col-sm-12 col-xl-12">
        <div class="card card-body text-center">
          <div style="overflow:auto; height:auto;">
            <table width="100%" class="table" cellpadding="5" cellspacing="0" style="border-collapse:collapse" id="dashboardstatus">
              <tbody>
                <tr>
                  <?php
$selecta='*';
$wherea='1 and subject!="" and stylestatus!=0 and assignTo in (select id from userMaster where empId in (select id from employeeMaster where reportingTo="'.$_SESSION['empid'].'") ) or  assignTo="'.$_SESSION['userid'].'" and deletestatus=0';

$rsa=GetPageRecord($selecta,_QUERY_MASTER_,$wherea);
$pdTotalStyle=mysqli_num_rows($rsa);

$selectb='*';
$whereb='1 and subject!="" and stylestatus!=0 and assignTo="'.$_SESSION['userid'].'" and deletestatus=0';

$rsb=GetPageRecord($selectb,_QUERY_MASTER_,$whereb);
$pdNewStyle=mysqli_num_rows($rsb);

$selectc='*';
$wherec='1 and subject!="" and stylestatus!=0 and assignTo in (select id from userMaster where empId in (select id from employeeMaster where reportingTo="'.$_SESSION['empid'].'") ) and deletestatus=0';
$rsc=GetPageRecord($selectc,_QUERY_MASTER_,$wherec);
$pdAssignedStyle=mysqli_num_rows($rsc);
?>
                  <td style="padding: 0px !important; width: 130px; display: block; float: left; margin-right: 20px;"><div class="dashboard-outer" style="border: 1px solid #6699ff;">
                      <div class="dashboard-status" onClick="window.location.href ='showpage.crm?module=style'" style="color:#6699ff;"><?php echo $pdTotalStyle; ?></div>
                      <div class="statusname">Total Styles </div>
                    </div></td>
                  <td style="padding: 0px !important; width: 130px; display: block; float: left; margin-right: 20px;"><div class="dashboard-outer" style="border: 1px solid #33cc33;">
                      <div class="dashboard-status" onClick="window.location.href ='showpage.crm?module=style&assignTo=<?php echo encode($_SESSION['userid']); ?>'" style="color:#33cc33;"><?php echo $pdNewStyle; ?></div>
                      <div class="statusname">New Styles </div>
                    </div></td>
                  <td style="padding: 0px !important; width: 130px; display: block; float: left; margin-right: 20px;"><div class="dashboard-outer" style="border: 1px solid #ff9933;">
                      <div class="dashboard-status" onClick="window.location.href ='showpage.crm?module=style&assignToMerchant=<?php echo encode($_SESSION['userid']); ?>'" style="color:#ff9933;"><?php echo $pdAssignedStyle; ?></div>
                      <div class="statusname">Assigned Style </div>
                    </div></td>
                </tr>
              </tbody>
            </table>
            <script type="text/javascript">
    $('.dashboard-status').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 2000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});
</script>
            <style>
#dashboardstatus tr td{
padding:0px !important;
}
.dashboard-outer {
    width: 117px;
    margin: 0px 5px;
    float: left;
    border-radius: 5px;

    padding: 5px 0px;
}

#dashboardstatus tr td:hover .dashboard-outer{
    background: #ededed;
	cursor:pointer;
}


.dashboard-status{
font-size:30px;
font-weight:400;
}
.statusname{
text-transform:uppercase;
font-size:10px;
font-weight:500;
color:#000;
}
</style>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
    <!--end of status-->
    <!-- end pd merchant dashboard-->
    <?php if($loginuserprofileId==85){ ?>
    <div class="row">
      <div class="col-sm-12 col-xl-12">
        <div class="card card-body text-center">
          <div style="overflow:auto; height:auto;">
            <table width="100%" class="table" cellpadding="5" cellspacing="0" style="border-collapse:collapse" id="dashboardstatus">
              <tbody>
                <tr>
                  <?php
$selecta='*';
//$wherea='1 and subject!="" and stylestatus!=0 and assignTo in (select id from userMaster where empId in (select id from employeeMaster where reportingTo="'.$_SESSION['empid'].'") ) or  assignTo="'.$_SESSION['userid'].'" and deletestatus=0';

$wheresearchassign=' brandId in (SELECT brandId FROM `resourceAllocationBrandWise` WHERE profileId="'.$loginuserprofileId.'" and FIND_IN_SET("'.$_SESSION['userid'].'",assignTo)) and ';

$wherea='1  and '.$wheresearchassign.' subject!="" and sampleStyle=1  and deletestatus=0 order by id desc';

$rsa=GetPageRecord($selecta,_QUERY_MASTER_,$wherea);
$pdTotalStyle=mysqli_num_rows($rsa);

$selectb='*';
$whereb='1 and subject!="" and stylestatus!=0 and assignTo="'.$_SESSION['userid'].'" and deletestatus=0';

$rsb=GetPageRecord($selectb,_QUERY_MASTER_,$whereb);
$pdNewStyle=mysqli_num_rows($rsb);

$selectc='*';
$wherec='1 and subject!="" and stylestatus!=0 and assignTo in (select id from userMaster where empId in (select id from employeeMaster where reportingTo="'.$_SESSION['empid'].'") ) and deletestatus=0';
$rsc=GetPageRecord($selectc,_QUERY_MASTER_,$wherec);
$pdAssignedStyle=mysqli_num_rows($rsc);
?>
                  <td style="padding: 0px !important; width: 130px; display: block; float: left; margin-right: 20px;"><div class="dashboard-outer" style="border: 1px solid #6699ff;">
                      <div class="dashboard-status" onClick="window.location.href ='showpage.crm?module=style'" style="color:#6699ff;"><?php echo $pdTotalStyle; ?></div>
                      <div class="statusname">Total Styles </div>
                    </div></td>
                  <td style="padding: 0px !important; width: 130px; display: block; float: left; margin-right: 20px;"><div class="dashboard-outer" style="border: 1px solid #33cc33;">
                      <div class="dashboard-status" onClick="#" style="color:#33cc33;">0</div>
                      <div class="statusname">Completed</div>
                    </div></td>
                </tr>
              </tbody>
            </table>
            <script type="text/javascript">
    $('.dashboard-status').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 2000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});
</script>
            <style>
#dashboardstatus tr td{
padding:0px !important;
}
.dashboard-outer {
    width: 117px;
    margin: 0px 5px;
    float: left;
    border-radius: 5px;

    padding: 5px 0px;
}

#dashboardstatus tr td:hover .dashboard-outer{
    background: #ededed;
	cursor:pointer;
}


.dashboard-status{
font-size:30px;
font-weight:400;
}
.statusname{
text-transform:uppercase;
font-size:10px;
font-weight:500;
color:#000;
}
</style>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
    <!-- start pd merchant dashboard-->
    <!--end of status-->
    <div class="row">
      <div class="col-sm-6 col-xl-4">
        <div class="card-header bg-white">
          <h6 class="card-title">To Do List </h6>
        </div>
        <div class="card card-body text-center">
          <div style="overflow:auto; height:372px;">
            <table width="100%" class="table">
              <thead>
                <tr>
                  <th width="30%" align="left" ><div align="left">Style&nbsp;ID </div></th>
                  <th width="15%" align="left"><div align="left">Date</div></th>
                  <th width="55%" align="left"><div align="left">Status</div></th>
                </tr>
              </thead>
              <tbody>
                <?php
									$select='';
									$where='';
									$rs='';
									$select='*';
									if($loginuserprofileId=='1'){
									$where='1 and subject!="" and styleStatus!=0 and deletestatus=0 order by id desc';
									}else{

									$where='1 and subject!="" and assignTo in (select id from userMaster where empId in (select id from employeeMaster where reportingTo="'.$_SESSION['empid'].'") ) or  assignTo="'.$_SESSION['userid'].'" or id in (select styleId from	styleAssignmentMaster where assignTo="'.$_SESSION['userid'].'") and deletestatus=0 order by id desc';

                  //$wheresearchassign=' brandId in (SELECT brandId FROM `resourceAllocationBrandWise` WHERE profileId="'.$loginuserprofileId.'" and FIND_IN_SET("'.$_SESSION['userid'].'",assignTo)) and ';

                  //$where='1  and '.$wheresearchassign.' subject!="" and deletestatus=0 order by id desc';

						 			}

									$rs=GetPageRecord($select,_QUERY_MASTER_,$where);
									while($result=mysqli_fetch_array($rs)){

									$select1='*';
								    $where1='styleId="'.$result['id'].'" and statusId!=0 order by id desc limit 1';
									$rs1=GetPageRecord($select1,'styleAssignmentMaster',$where1);
									$result1=mysqli_fetch_array($rs1);

									$select2='*';
									$where2='id="'.$result1['statusId'].'"';
									$rs2=GetPageRecord($select2,'statusMaster',$where2);
									$result2=mysqli_fetch_array($rs2);

									 ?>
                <tr>
                  <td align="left"><div align="left"><a href="showpage.crm?module=style&view=yes&id=<?php echo encode($result['id']); ?>"> <?php echo '#'.$result['styleRefId']; ?></a> </div></td>
                  <td align="left"><div align="left" style="width:80px;"><span class="text-default font-weight-semibold letter-icon-title"><?php echo date('d M, Y', $result1['dateAdded']); ?> </span> </div></td>
                  <td align="left"><span class="badge" style="background-color:<?php echo $result2['statusColor']; ?>; color:#FFFFFF; position: relative; width: fit-content;"><?php echo $result2['name']; ?></span></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

	  <div class="col-sm-6 col-xl-4" style="display: n1one;">
        <div class="card-header bg-white">
          <h6 class="card-title">Business Summary</h6>
        </div>
        <div class="card card-body text-center">
          <div id="pie_donut" style="height:372px;"></div>
        </div>
      </div>

	  <div class="col-sm-6 col-xl-4" style="display: n1one;">
	<div title="On Time Delivery" style="cursor:pointer;" class="card-header bg-white">
		<h6 class="card-title">OTD's</h6>
	</div>
	<div class="card card-body text-center" style="overflow:hidden;padding-left: 5px">
       <div id="columnchart_material23" style=" height: 372px;"></div>
	</div>
	</div>

		<div class="col-sm-6 col-xl-4" style="display:n1one;">
        <div class="card-header bg-white" title="File Hand Over and Plan Cut Date"style="cursor:pointer" >
          <h6 class="card-title">FHO & PCD Scorecard</h6>
        </div>
        <div class="card card-body text-center">
          <div id="qualityreport" style="height:371px;"></div>
          <!--<table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" style="margin-top:10px;">
            <tr>
              <td width="6%" align="right"><strong>Sewing&nbsp;DHU</strong></td>
              <td width="17%" align="left">12</td>
              <td width="14%" align="left">21</td>
              <td width="14%" align="left">8</td>
              <td width="14%" align="left">11</td>
              <td width="14%" align="left">6</td>
            </tr>
            <tr>
              <td align="right"><strong>Finishing&nbsp;DHU </strong></td>
              <td width="17%" align="left">15</td>
              <td width="14%" align="left">18</td>
              <td width="14%" align="left">12</td>
              <td width="14%" align="left">13</td>
              <td width="14%" align="left">10</td>
            </tr>
          </table>-->
        </div>
      </div>


    	<div class="col-sm-6 col-xl-4" style="display: n1one;">
	<div class="card-header bg-white">
		<h6 class="card-title">Critical Path</h6>
	</div>
	<div class="card card-body text-center" style="overflow:hidden;">
       <div id="columnchart_material1" style=" height: 372px;"></div>
	</div>
	</div>

	 <div class="col-sm-6 col-xl-4" style="display:n1one;">
        <div class="card-header bg-white">
          <h6 class="card-title">Quality Report</h6>
        </div>
        <div class="card card-body text-center">
          <div id="qualityreport2" style="height:300px;"></div>
          <table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" style="margin-top:10px;">
            <tr>
              <td width="6%" align="right"><strong>Sewing&nbsp;DHU</strong></td>
              <td width="17%" align="left">12</td>
              <td width="14%" align="left">21</td>
              <td width="14%" align="left">8</td>
              <td width="14%" align="left">11</td>
              <td width="14%" align="left">6</td>
            </tr>
            <tr>
              <td align="right"><strong>Finishing&nbsp;DHU </strong></td>
              <td width="17%" align="left">15</td>
              <td width="14%" align="left">18</td>
              <td width="14%" align="left">12</td>
              <td width="14%" align="left">13</td>
              <td width="14%" align="left">10</td>
            </tr>
          </table>
        </div>
      </div>

	   <?php if($loginuserprofileId==92){ ?>
      <div class="col-sm-6 col-xl-4">
        <div class="card-header bg-white">
          <h6 class="card-title">Pending Material List</h6>
        </div>
        <div class="card card-body text-center" >
          <div style="overflow:auto; height:372px;">
            <div class="tab-content card-body">
              <div class="tab-pane active fade show" id="messages-tue">
                <ul class="media-list">
                  <?php
									$select='';
									$where='';
									$rs='';
									$select='*';
									if($loginuserprofileId=='1' || $loginuserprofileId=='93'){
									$where='1 and subject!="" and styleStatus!=0 and deletestatus=0 order by id desc';
									}else{
									$where='1 and subject!="" and assignTo in (select id from userMaster where empId in (select id from employeeMaster where reportingTo="'.$_SESSION['empid'].'") ) or  assignTo="'.$_SESSION['userid'].'" and deletestatus=0 order by id desc';
						 			}
									$rs=GetPageRecord($select,_QUERY_MASTER_,$where);
									while($result=mysqli_fetch_array($rs)){

									$rsimg=GetPageRecord('*','imageGallery','parentId="'.$result['id'].'" and galleryType="image_gallery" order by id asc');
									$imgresult=mysqli_fetch_array($rsimg);

								$selectstatus='*';
								$wherestatus='styleId="'.$result['id'].'" and statusId!=0 order by id desc';
								$rsstatus=GetPageRecord($selectstatus,'styleAssignmentMaster',$wherestatus);
								$result1=mysqli_fetch_array($rsstatus);

								$select1='*';
								$where1='id="'.$result1['statusId'].'" order by id desc';
								$rs1=GetPageRecord($select1,'statusMaster',$where1);
								$result1=mysqli_fetch_array($rs1);

								$selecttotaltask='*';
								$wheretotaltask='styleId="'.$result['id'].'"';
								$rstotal=GetPageRecord($selecttotaltask,'styleSubCategoryMaster',$wheretotaltask);

								$selectqty='*';
								$whereqty='styleId="'.$result['id'].'" and qtyStatus=1';
								$rsqty=GetPageRecord($selectqty,'styleSubCategoryMaster',$whereqty);
								$totalqty = mysqli_num_rows($rsqty);

								$selectprice='*';
								$whereprice='styleId="'.$result['id'].'" and priceStatus=1';
								$rsprice=GetPageRecord($selectprice,'styleSubCategoryMaster',$whereprice);
								$totalprice = mysqli_num_rows($rsprice);

								$selectvendor='*';
								$wherevendor='styleId="'.$result['id'].'" and vendorStatus=1';
								$rsvendor=GetPageRecord($selectvendor,'styleSubCategoryMaster',$wherevendor);
								$totalvendor = mysqli_num_rows($rsvendor);

								//$totalTask = mysqli_num_rows($rstotal);




								$totalTask = $totalqty+$totalprice+$totalvendor;

								$selecttaskComplet='*';
								$wheretaskComplet='styleId="'.$result['id'].'" and approvedStatus=1';
								$rswheretaskComplet=GetPageRecord($selecttaskComplet,'materialCostChatMaster',$wheretaskComplet);
								$completed = mysqli_num_rows($rswheretaskComplet);



								$persent = round($completed*100/$totalTask);

								$selectfurther='*';
								$wherefurther='styleId="'.$result['id'].'" and approvedStatus=2 and materialFinalStatus=1';
								$rsfurther=GetPageRecord($selectfurther,'materialCostChatMaster',$wherefurther);
								$furtherassign = mysqli_num_rows($rsfurther);

								$selectwaiting='*';
								$wherewaiting='styleId="'.$result['id'].'" and approvedStatus=3 and materialFinalStatus=1';
								$rswaiting=GetPageRecord($selectwaiting,'materialCostChatMaster',$wherewaiting);
								$waiting = mysqli_num_rows($rswaiting);

								$selectreject='*';
								$wherereject='styleId="'.$result['id'].'" and approvedStatus=4 and materialFinalStatus=1';
								$rsreject=GetPageRecord($selectreject,'materialCostChatMaster',$wherereject);
								$reject = mysqli_num_rows($rsreject);


								$pending = $completed+$furtherassign+$waiting+$reject;
								?>
                  <?php if($waiting>0){ ?>
                  <li class="media" style="border-bottom:1px solid #ccc; padding-bottom:10px;">
                    <div class="mr-3 position-relative"> <img src="<?php if($imgresult['attachmentImage']!=''){?><?php echo $fullurl.'images/'.$imgresult['attachmentImage']; ?><?php }else{ ?>global_assets/images/placeholders/placeholder.jpg<?php } ?>" class="rounded-circle" width="36" height="36" alt=""> <span class="badge bg-danger-400 badge-pill badge-float border-2 border-white"><?php echo $waiting; ?></span> </div>
                    <div class="media-body">
                      <div class="d-flex justify-content-between"> <?php echo '#'.$result['styleRefId']; ?> <a href="showpage.crm?module=prototypesample&add=yes&styleid=<?php echo encode($result['id']); ?>" target="_blank"><span class="badge badge-info">Go To Approve</span></a> </div>
                    </div>
                  </li>
                  <?php } } ?>
                </ul>
              </div>
              <div class="tab-pane fade" id="messages-mon">
                <ul class="media-list">
                  <li class="media">
                    <div class="mr-3"> <img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="36" height="36" alt=""> </div>
                    <div class="media-body">
                      <div class="d-flex justify-content-between"> <a href="#">Isak Temes</a> <span class="font-size-sm text-muted">Tue, 19:58</span> </div>
                      Reasonable palpably rankly expressly grimy... </div>
                  </li>
                  <li class="media">
                    <div class="mr-3"> <img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="36" height="36" alt=""> </div>
                    <div class="media-body">
                      <div class="d-flex justify-content-between"> <a href="#">Vittorio Cosgrove</a> <span class="font-size-sm text-muted">Tue, 16:35</span> </div>
                      Arguably therefore more unexplainable fumed... </div>
                  </li>
                  <li class="media">
                    <div class="mr-3"> <img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="36" height="36" alt=""> </div>
                    <div class="media-body">
                      <div class="d-flex justify-content-between"> <a href="#">Hilary Talaugon</a> <span class="font-size-sm text-muted">Tue, 12:16</span> </div>
                      Nicely unlike porpoise a kookaburra past more... </div>
                  </li>
                  <li class="media">
                    <div class="mr-3"> <img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="36" height="36" alt=""> </div>
                    <div class="media-body">
                      <div class="d-flex justify-content-between"> <a href="#">Bobbie Seber</a> <span class="font-size-sm text-muted">Tue, 09:20</span> </div>
                      Before visual vigilantly fortuitous tortoise... </div>
                  </li>
                  <li class="media">
                    <div class="mr-3"> <img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="36" height="36" alt=""> </div>
                    <div class="media-body">
                      <div class="d-flex justify-content-between"> <a href="#">Walther Laws</a> <span class="font-size-sm text-muted">Tue, 03:29</span> </div>
                      Far affecting more leered unerringly dishonest... </div>
                  </li>
                </ul>
              </div>
              <div class="tab-pane fade" id="messages-fri">
                <ul class="media-list">
                  <li class="media">
                    <div class="mr-3"> <img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="36" height="36" alt=""> </div>
                    <div class="media-body">
                      <div class="d-flex justify-content-between"> <a href="#">Owen Stretch</a> <span class="font-size-sm text-muted">Mon, 18:12</span> </div>
                      Tardy rattlesnake seal raptly earthworm... </div>
                  </li>
                  <li class="media">
                    <div class="mr-3"> <img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="36" height="36" alt=""> </div>
                    <div class="media-body">
                      <div class="d-flex justify-content-between"> <a href="#">Jenilee Mcnair</a> <span class="font-size-sm text-muted">Mon, 14:03</span> </div>
                      Since hello dear pushed amid darn trite... </div>
                  </li>
                  <li class="media">
                    <div class="mr-3"> <img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="36" height="36" alt=""> </div>
                    <div class="media-body">
                      <div class="d-flex justify-content-between"> <a href="#">Alaster Jain</a> <span class="font-size-sm text-muted">Mon, 13:59</span> </div>
                      Dachshund cardinal dear next jeepers well... </div>
                  </li>
                  <li class="media">
                    <div class="mr-3"> <img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="36" height="36" alt=""> </div>
                    <div class="media-body">
                      <div class="d-flex justify-content-between"> <a href="#">Sigfrid Thisted</a> <span class="font-size-sm text-muted">Mon, 09:26</span> </div>
                      Lighted wolf yikes less lemur crud grunted... </div>
                  </li>
                  <li class="media">
                    <div class="mr-3"> <img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="36" height="36" alt=""> </div>
                    <div class="media-body">
                      <div class="d-flex justify-content-between"> <a href="#">Sherilyn Mckee</a> <span class="font-size-sm text-muted">Mon, 06:38</span> </div>
                      Less unicorn a however careless husky... </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>


      <?php if($loginuserprofileId==1){ ?>
     <!--<div class="col-sm-6 col-xl-4">
        <div class="card-header bg-white">
          <h6 class="card-title">Top 5 PD Merchant Styles</h6>
        </div>
        <div class="card card-body text-center">
          <div id="plie" style="height:372px;"></div>
        </div>
      </div>-->



	  <!--<div class="col-sm-6 col-xl-4">
        <div class="card-header bg-white">
          <h6 class="card-title">Category Status</h6>
        </div>
        <div class="card card-body text-center">
          <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer" style="overflow:auto; height:372px;">
            <div class="datatable-scroll">
              <table width="100%" class="table">
                <thead style="">
                  <tr role="row">
                    <th align="left" style="text-align:left;">Category</th>
                    <th align="left">Delay</th>
                    <th align="left">In-Progress</th>
                    <th align="left">Newly-Added</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
						$selectcat='*';
						$wherecat='1 order by  name asc';
						$rscat=GetPageRecord($selectcat,'categoryMaster',$wherecat);
						while($resultcat=mysqli_fetch_array($rscat)){
						?>
                  <tr role="row" class="odd">
                    <td align="left"><a href="showpage.crm?module=style&categoryId=<?php echo encode($resultcat['id']); ?>"><?php echo $resultcat['name']; ?></a></td>
                    <td><?php
							$selectq='*';
							$whereq='categoryId="'.$resultcat['id'].'" and stylestatus=1 and finalstatus=2 and subject!="" and deletestatus=0';
							$rsq=GetPageRecord($selectq,'queryMaster',$whereq);
							echo $count = mysqli_num_rows($rsq);
							?></td>
                    <td><?php
							$selectq='*';
							$whereq='categoryId="'.$resultcat['id'].'" and stylestatus=1 and finalstatus=2 and subject!="" and deletestatus=0';
							$rsq=GetPageRecord($selectq,'queryMaster',$whereq);
							echo $count = mysqli_num_rows($rsq);
							?></td>
                    <td><?php
							$selectq='*';
							$whereq='categoryId="'.$resultcat['id'].'" and subject!="" and deletestatus=0';
							$rsq=GetPageRecord($selectq,'queryMaster',$whereq);
							echo $count = mysqli_num_rows($rsq);
							?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>-->





	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([


          ['Task', 'Hours per Day'],

		  ['Line 1', 25],
		  ['Line 2', 30],
		  ['Line 3', 20],
		  ['Line 4', 15],
		  ['Line 5', 10]

        ]);

        var options = {
		 chartArea:{left:50,top:50,width:"100%",right:40,height:"100%"},
          title: '',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>

	<!--

      <div class="col-sm-6 col-xl-4" style="position:relative;">
        <div class="card-header bg-white" style="display: block;width: 100%;overflow: hidden;">
          <h6 class="card-title" style="width:50%;float:left;">Style Progress</h6>
          <select id="assignTo" name="assignTo" class="form-control"  style="width: 50%; float: right; height: auto; border-radius: 0px; text-align: right; padding: 2px 0px; border: 1px solid #ccc; <?php if($loginuserprofileId==85){ ?> display:none;<?php } ?>"  onChange="loadmerchantstyle();" >
            <option value="">Select Merchant</option>
            <?php
$select='';
$where='';
$rs='';
$select='*';
if($loginuserprofileId=1){
$where='1 and profileId=85 order by firstName asc';
}
else{
$where='id in (select id from userMaster where empId in (select id from employeeMaster where reportingTo="'.$_SESSION['empid'].'")) and deletestatus=0 and status=1 and profileId=85 order by firstName asc';
}

$rs=GetPageRecord($select,'userMaster',$where);
while($resListing=mysqli_fetch_array($rs)){
?>
            <option value="<?php echo $resListing['id']; ?>"><?php echo $resListing['firstName'].' '.$resListing['lastName']; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="card card-body text-center">
          <div style="overflow:auto; height:372px;" id="loadmerchantstyle"> </div>
          <script>
function loadmerchantstyle(){

 var userid = $('#assignTo').val();
 $('#loadmerchantstyle').load('loadmerchantstyle.php?userid='+userid);
}
loadmerchantstyle();
</script>
        </div>
      </div>
 -->


	  <div class="col-sm-6 col-xl-4" style="display:n1one;">
        <div class="card-header bg-white">
          <h6 class="card-title">Stylewise WIP</h6>
        </div>
        <div class="card card-body text-center">
          <div id="columnchart_material" style="height:210px;"></div>
          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
          <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['', 'Style 1', 'Style 2', 'Style 3', 'Style 4'],
          ['Cutting', 0, 940, 1100, 0],
          ['Sewing', 1000, 700, 500, 0],
          ['Finishing', 1500, 560, 0, 0],
          ['Shipment', 0, 0, 0, 3500]
        ]);

        var options = {
       legend: {position: 'none'},

        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
          <table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" style="margin-top:10px;">
            <tr>
              <td width="6%" align="right"><strong>Style&nbsp;1</strong></td>
              <td width="17%" align="left">0</td>
              <td width="14%" align="left">940</td>
              <td width="14%" align="left">1100</td>
              <td width="14%" align="left">0</td>
            </tr>
            <tr>
              <td align="right"><strong>Style&nbsp;2 </strong></td>
              <td width="17%" align="left">1000</td>
              <td width="14%" align="left">700</td>
              <td width="14%" align="left">500</td>
              <td width="14%" align="left">0</td>
            </tr>
            <tr>
              <td align="right"><strong>Style&nbsp;3 </strong></td>
              <td align="left">1500</td>
              <td align="left">560</td>
              <td align="left">0</td>
              <td align="left">0</td>
            </tr>
            <tr>
              <td align="right"><strong>Style&nbsp;4 </strong></td>
              <td align="left">500</td>
              <td align="left">0</td>
              <td align="left">0</td>
              <td align="left">0</td>
            </tr>
            <tr>
              <td align="right"><strong>Style&nbsp;5 </strong></td>
              <td align="left">0</td>
              <td align="left">0</td>
              <td align="left">500</td>
              <td align="left">3500</td>
            </tr>
          </table>
        </div>
      </div>







      <div class="col-sm-6 col-xl-4" style="display:n1one;">
        <div class="card-header bg-white">
          <h6 class="card-title">Line-wise Production and WIP</h6>
        </div>
        <div class="card card-body text-center">
          <div id="lwpaw" style="height:300px;"></div>
          <table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" style="margin-top:10px;">
            <tr>
              <td width="6%" align="right"><strong>Prodn.</strong></td>
              <td width="17%" align="left">500</td>
              <td width="14%" align="left">440</td>
              <td width="14%" align="left">700</td>
              <td width="14%" align="left">260</td>
              <td width="14%" align="left">300</td>
            </tr>
            <tr>
              <td align="right"><strong>WIP </strong></td>
              <td width="17%" align="left">350</td>
              <td width="14%" align="left">1080</td>
              <td width="14%" align="left">1400</td>
              <td width="14%" align="left">700</td>
              <td width="14%" align="left">500</td>
            </tr>
          </table>
        </div>
      </div>

	  <div class="col-sm-6 col-xl-4" style="display:n1one;">

        <div class="card-header bg-white">

          <h6 class="card-title">Productivity, SAM & Efficiency</h6>

        </div>

        <div class="card card-body text-center">

          <div id="plie" style="height:300px;"></div>

          <table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" style="margin-top:10px;">

            <tr>

              <td width="6%" align="right"><strong>Productivity</strong></td>

              <td width="22%" align="left">14</td>

              <td width="21%" align="left">21</td>

              <td width="21%" align="left">10</td>

              <td width="21%" align="left">12</td>

            </tr>

            <tr>

              <td align="right"><strong>Line Eff </strong></td>

              <td width="22%" align="left">11</td>

              <td width="21%" align="left">15</td>

              <td width="21%" align="left">3</td>

              <td width="21%" align="left">9</td>

            </tr>

          </table>

        </div>

      </div>
      <div class="col-sm-6 col-xl-4" style="display: none;">
  <div class="card-header bg-white">
    <h6 class="card-title">Shipment On Time Report</h6>
  </div>
  <div class="card card-body text-center" style="overflow:hidden;padding-left: 5px;">
       <div id="columnchart_material23" style=" height: 372px;"></div>
  </div>
  </div>

	   <!-- <div class="col-sm-6 col-xl-4">
	<div class="card-header bg-white">
		<h6 class="card-title">Quality Report</h6>
	</div>
	<div class="card card-body text-center" style="overflow:hidden;">
	 <div id="donutchart" style="height:372px;"></div>
	</div>
	</div>-->

	  <?php
$select='*';
$a=0;

$early=0;
$delayed=0;
$ontime=0;
$qqps=GetPageRecord('*','timeActionReport','1 ');
        while( $quarDataps=mysqli_fetch_array($qqps)){






$qqp=GetPageRecord('*','taskListMaster','1 and id="'.$quarDataps['taskListId'].'" and name="38"');
          $quarDatap=mysqli_num_rows($qqp);
          $quarDatapcc=mysqli_fetch_array($qqp);

          $qqpx=GetPageRecord('*','timeActionReport','1 and taskListId="'.$quarDatapcc['id'].'"');
          $quarDatapx=mysqli_fetch_array($qqpx);
          if($quarDatapx['complitionDate']!='' &&  $quarDatapx['complitionDate']!='1970-01-01' && $quarDatapx['complitionDate']!='0000-00-00' && $quarDatapx['actualDate']!='' && $quarDatapx['actualDate']!='1970-01-01' && $quarDatapx['actualDate']!='0000-00-00'){
             $plandate=date('d-m-Y', strtotime($quarDatapx['complitionDate']));
                  $start_date = strtotime($plandate);
                    $currentdate= date('d-m-Y', strtotime($quarDatapx['actualDate']));
                     $end_date = strtotime($currentdate);
                     $difference =  ($start_date - $end_date)/60/60/24;

 if($difference > "0"){  $early=$early+1; } else if($difference < "0"){ $delayed=$delayed+1; }else {  $ontime=$ontime+1; }

          }



         }
















$early1=0;
$delayed1=0;
$ontime1=0;
$qqps1=GetPageRecord('*','timeActionReport','1 ');
        while( $quarDataps1=mysqli_fetch_array($qqps1)){






$qqp1=GetPageRecord('*','taskListMaster','1 and id="'.$quarDataps1['taskListId'].'" and name="42"');
          $quarDatap1=mysqli_num_rows($qqp1);
          $quarDatapcc1=mysqli_fetch_array($qqp1);

          $qqpx1=GetPageRecord('*','timeActionReport','1 and taskListId="'.$quarDatapcc1['id'].'"');
          $quarDatapx1=mysqli_fetch_array($qqpx1);
          if($quarDatapx1['complitionDate']!='' &&  $quarDatapx1['complitionDate']!='1970-01-01' && $quarDatapx1['complitionDate']!='0000-00-00' && $quarDatapx1['actualDate']!='' && $quarDatapx1['actualDate']!='1970-01-01' && $quarDatapx1['actualDate']!='0000-00-00'){
             $plandate1=date('d-m-Y', strtotime($quarDatapx1['complitionDate']));
                  $start_date1 = strtotime($plandate1);
                    $currentdate1= date('d-m-Y', strtotime($quarDatapx1['actualDate']));
                     $end_date1 = strtotime($currentdate1);
                     $difference1 =  ($start_date1 - $end_date1)/60/60/24;


 if($difference1 > "0"){  $early1=$early1+1; } else if($difference1 < "0"){ $delayed1=$delayed1+1; }else {  $ontime1=$ontime1+1; }

          }



         }







         $earlyindent=0;
$delayedindent=0;
$ontimeindent=0;
$qqpsindent=GetPageRecord('*','timeActionReport','1 ');
        while( $quarDatapsindent=mysqli_fetch_array($qqpsindent)){






$qqpindent=GetPageRecord('*','taskListMaster','1 and id="'.$quarDatapsindent['taskListId'].'" and name="4"');
          $quarDatapindent=mysqli_num_rows($qqpindent);
          $quarDatapccindent=mysqli_fetch_array($qqpindent);

          $qqpxindent=GetPageRecord('*','timeActionReport','1 and taskListId="'.$quarDatapccindent['id'].'"');
          $quarDatapxindent=mysqli_fetch_array($qqpxindent);
          if($quarDatapxindent['complitionDate']!='' &&  $quarDatapxindent['complitionDate']!='1970-01-01' && $quarDatapxindent['complitionDate']!='0000-00-00' && $quarDatapxindent['actualDate']!='' && $quarDatapxindent['actualDate']!='1970-01-01' && $quarDatapxindent['actualDate']!='0000-00-00'){
             $plandateindent=date('d-m-Y', strtotime($quarDatapxindent['complitionDate']));
                  $start_dateindent = strtotime($plandateindent);
                    $currentdateindent= date('d-m-Y', strtotime($quarDatapxindent['actualDate']));
                     $end_dateindent = strtotime($currentdateindent);
                     $differenceindent =  ($start_dateindent - $end_dateindent)/60/60/24;


 if($differenceindent > "0"){  $earlyindent=$earlyindent+1; } else if($differenceindent < "0"){ $delayedindent=$delayedindent+1; }else {  $ontimeindent=$ontimeindent+1; }

          }



         }





            $earlyfob=0;
$delayedfob=0;
$ontimefob=0;
$qqpsfob=GetPageRecord('*','timeActionReport','1 ');
        while( $quarDatapsfob=mysqli_fetch_array($qqpsfob)){






$qqpfob=GetPageRecord('*','taskListMaster','1 and id="'.$quarDatapsfob['taskListId'].'" and name="14"');
          $quarDatapfob=mysqli_num_rows($qqpfob);
          $quarDatapccfob=mysqli_fetch_array($qqpfob);

          $qqpxfob=GetPageRecord('*','timeActionReport','1 and taskListId="'.$quarDatapccfob['id'].'"');
          $quarDatapxfob=mysqli_fetch_array($qqpxfob);
          if($quarDatapxfob['complitionDate']!='' &&  $quarDatapxfob['complitionDate']!='1970-01-01' && $quarDatapxfob['complitionDate']!='0000-00-00' && $quarDatapxfob['actualDate']!='' && $quarDatapxfob['actualDate']!='1970-01-01' && $quarDatapxfob['actualDate']!='0000-00-00'){
             $plandatefob=date('d-m-Y', strtotime($quarDatapxfob['complitionDate']));
                  $start_datefob = strtotime($plandatefob);
                    $currentdatefob= date('d-m-Y', strtotime($quarDatapxfob['actualDate']));
                     $end_datefob = strtotime($currentdatefob);
                     $differencefob =  ($start_datefob - $end_datefob)/60/60/24;


 if($differencefob > "0"){  $earlyfob=$earlyfob+1; } else if($differencefob < "0"){ $delayedfob=$delayedfob+1; }else {  $ontimefob=$ontimefob+1; }

          }



         }





            $earlyfpt=0;
$delayedfpt=0;
$ontimefpt=0;
$qqpsfpt=GetPageRecord('*','timeActionReport','1 ');
        while( $quarDatapsfpt=mysqli_fetch_array($qqpsfpt)){






$qqpfpt=GetPageRecord('*','taskListMaster','1 and id="'.$quarDatapsfpt['taskListId'].'" and name="18"');
          $quarDatapfpt=mysqli_num_rows($qqpfpt);
          $quarDatapccfpt=mysqli_fetch_array($qqpfpt);

          $qqpxfpt=GetPageRecord('*','timeActionReport','1 and taskListId="'.$quarDatapccfpt['id'].'"');
          $quarDatapxfpt=mysqli_fetch_array($qqpxfpt);
          if($quarDatapxfpt['complitionDate']!='' &&  $quarDatapxfpt['complitionDate']!='1970-01-01' && $quarDatapxfpt['complitionDate']!='0000-00-00' && $quarDatapxfpt['actualDate']!='' && $quarDatapxfpt['actualDate']!='1970-01-01' && $quarDatapxfpt['actualDate']!='0000-00-00'){
             $plandatefpt=date('d-m-Y', strtotime($quarDatapxfpt['complitionDate']));
                  $start_datefpt = strtotime($plandatefpt);
                    $currentdatefpt= date('d-m-Y', strtotime($quarDatapxfpt['actualDate']));
                     $end_datefpt = strtotime($currentdatefpt);
                     $differencefpt =  ($start_datefpt - $end_datefpt)/60/60/24;


 if($differencefpt > "0"){  $earlyfpt=$earlyfpt+1; } else if($differencefpt < "0"){ $delayedfpt=$delayedfpt+1; }else {  $ontimefpt=$ontimefpt+1; }

          }



         }








            $earlygpt=0;
$delayedgpt=0;
$ontimegpt=0;
$qqpsgpt=GetPageRecord('*','timeActionReport','1 ');
        while( $quarDatapsgpt=mysqli_fetch_array($qqpsgpt)){






$qqpgpt=GetPageRecord('*','taskListMaster','1 and id="'.$quarDatapsgpt['taskListId'].'" and name="37"');
          $quarDatapgpt=mysqli_num_rows($qqpgpt);
          $quarDatapccgpt=mysqli_fetch_array($qqpgpt);

          $qqpxgpt=GetPageRecord('*','timeActionReport','1 and taskListId="'.$quarDatapccgpt['id'].'"');
          $quarDatapxgpt=mysqli_fetch_array($qqpxgpt);
          if($quarDatapxgpt['complitionDate']!='' &&  $quarDatapxgpt['complitionDate']!='1970-01-01' && $quarDatapxgpt['complitionDate']!='0000-00-00' && $quarDatapxgpt['actualDate']!='' && $quarDatapxgpt['actualDate']!='1970-01-01' && $quarDatapxgpt['actualDate']!='0000-00-00'){
             $plandategpt=date('d-m-Y', strtotime($quarDatapxgpt['complitionDate']));
                  $start_dategpt = strtotime($plandategpt);
                    $currentdategpt= date('d-m-Y', strtotime($quarDatapxgpt['actualDate']));
                     $end_dategpt = strtotime($currentdategpt);
                     $differencegpt =  ($start_dategpt - $end_dategpt)/60/60/24;


 if($differencegpt > "0"){  $earlygpt=$earlygpt+1; } else if($differencegpt < "0"){ $delayedgpt=$delayedgpt+1; }else {  $ontimegpt=$ontimegpt+1; }

          }



         }





            $earlygp=0;
$delayedgp=0;
$ontimegp=0;
$qqpsgp=GetPageRecord('*','timeActionReport','1 ');
        while( $quarDatapsgp=mysqli_fetch_array($qqpsgp)){






$qqpgp=GetPageRecord('*','taskListMaster','1 and id="'.$quarDatapsgp['taskListId'].'" and name="21"');
          $quarDatapgp=mysqli_num_rows($qqpgp);
          $quarDatapccgp=mysqli_fetch_array($qqpgp);

          $qqpxgp=GetPageRecord('*','timeActionReport','1 and taskListId="'.$quarDatapccgp['id'].'"');
          $quarDatapxgp=mysqli_fetch_array($qqpxgp);
          if($quarDatapxgp['complitionDate']!='' &&  $quarDatapxgp['complitionDate']!='1970-01-01' && $quarDatapxgp['complitionDate']!='0000-00-00' && $quarDatapxgp['actualDate']!='' && $quarDatapxgp['actualDate']!='1970-01-01' && $quarDatapxgp['actualDate']!='0000-00-00'){
             $plandategp=date('d-m-Y', strtotime($quarDatapxgp['complitionDate']));
                  $start_dategp = strtotime($plandategp);
                    $currentdategp= date('d-m-Y', strtotime($quarDatapxgp['actualDate']));
                     $end_dategp = strtotime($currentdategp);
                     $differencegp =  ($start_dategp - $end_dategp)/60/60/24;


 if($differencegp > "0"){  $earlygp=$earlygp+1; } else if($differencegp < "0"){ $delayedgp=$delayedgp+1; }else {  $ontimegp=$ontimegp+1; }

          }



         }








						?>


 <script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Shipment", { role: "style" } ],
        ["Factory SOT", 0.576923077*100, "#b87333"],
        ["Overrall Brand SOT", 0.75*100, "silver"],
        ["C&F Air", 0.288461538*100, "gold"],
		["Air To Port", 0.269230769*100, "#00b5ea"],
		["Sea Ship", 0.711538462*100, "color: #e5e4e2"]
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "",
        width: "100%",
        height: "100%",
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };








      var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
      chart.draw(view, options);
  }
  </script>






      <?php } ?>
    </div>
  </div>
</div>
<script>
var EchartsPiesDonuts = function() {


    //
    // Setup module components
    //

    // Pie and donut charts
    var _piesDonutsExamples = function() {
        if (typeof echarts == 'undefined') {
            console.warn('Warning - echarts.min.js is not loaded.');
            return;
        }

        // Define elements
        var pie_basic_element = document.getElementById('pie_basic');
 var pie_donut_element = document.getElementById('pie_donut');


        //
        // Charts configuration
        if (pie_donut_element) {

            // Initialize chart
            var pie_donut = echarts.init(pie_donut_element);


            //
            // Chart config
            //

            // Options
            pie_donut.setOption({

                // Colors
                color: ['#32b725','#bb3f3f','#5ab1ef','#ffb980','#d87a80'],

                // Global text styles
                textStyle: {
                    fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                    fontSize: 13
                },



                // Add tooltip
                tooltip: {
                    trigger: 'item',
                    backgroundColor: 'rgba(0,0,0,0.75)',
                    padding: [10, 15],
                    textStyle: {
                        fontSize: 13,
                        fontFamily: 'Roboto, sans-serif'
                    },
                    formatter: "{a} <br/>{b}: {c} ({d}%)"
                },

                // Add legend

                // Add series
                series: [{
                    name: 'Type',
                    type: 'pie',
                    radius: ['50%', '70%'],
                    center: ['50%', '50.5%'],
                    itemStyle: {
                        normal: {
                            borderWidth: 1,
                            borderColor: '#fff'
                        }
                    },
                    data: [
					<?php
					$rscategory=GetPageRecord('*','buyerMaster','1  and deletestatus=0 order by name asc');
					while($result=mysqli_fetch_array($rscategory)){
					$rscreated=GetPageRecord('sum(orderQty) as totalqty',_QUERY_MASTER_,'buyerId="'.$result['id'].'" and deletestatus=0 group by buyerId');
					$resultcat=mysqli_fetch_array($rscreated);

					$resultcatd=mysqli_num_rows($rscreated);

					if($resultcatd>0){
					?>
					 {value: <?php echo $resultcat['totalqty']; ?>, name: '<?php echo $result['name'] ?>',  color: 'yellow'},
					<?php }  } ?>
				 	                    ]
                }]
            });
        }




        //
        // Resize charts
        //

        // Resize function
        var triggerChartResize = function() {
            pie_basic_element && pie_basic.resize();
			pie_donut_element && pie_donut.resize();
        };

        // On sidebar width change
        $(document).on('click', '.sidebar-control', function() {
            setTimeout(function () {
                triggerChartResize();
            }, 0);
        });

        // On window resize
        var resizeCharts;
        window.onresize = function () {
            clearTimeout(resizeCharts);
            resizeCharts = setTimeout(function () {
                triggerChartResize();
            }, 200);
        };
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _piesDonutsExamples();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    EchartsPiesDonuts.init();
});
















var EchartsColumnsWaterfalls = function() {


    //
    // Setup module components
    //

    // Column and waterfall charts
    var _columnsWaterfallsExamples = function() {
        if (typeof echarts == 'undefined') {
            console.warn('Warning - echarts.min.js is not loaded.');
            return;
        }


 		 var columns_thermometer_element = document.getElementById('columns_thermometer');
        var columns_plie_element = document.getElementById('plie');
		  var columns_basic_element = document.getElementById('lwpaw');

		  var columns_qualityreport_element = document.getElementById('qualityreport');
         var columns_qualityreport_element2 = document.getElementById('qualityreport2');
		 var columns_qualityreport_element3 = document.getElementById('qualityreport3');
        if (columns_thermometer_element) {

            // Initialize chart
            var columns_thermometer = echarts.init(columns_thermometer_element);


            //
            // Chart config
            //

            // Options
            var columns_thermometer_options = {

                // Global text styles
                textStyle: {
                    fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                    fontSize: 13
                },

                // Chart animation duration
                animationDuration: 750,

                // Setup grid
                grid: {
                    left: 10,
                    right: 10,
                    top: 35,
                    bottom: 0,
                    containLabel: true
                },

                // Add legend
                legend: {
                    data: ['Actual', 'Forecast'],
                    itemHeight: 8,
                    itemGap: 20,
                    selectedMode: false
                },

                // Add tooltip
                tooltip: {
                    trigger: 'axis',
                    backgroundColor: 'rgba(0,0,0,0.75)',
                    padding: [10, 15],
                    textStyle: {
                        fontSize: 13,
                        fontFamily: 'Roboto, sans-serif'
                    },
                    axisPointer: {
                        type: 'shadow',
                        shadowStyle: {
                            color: 'rgba(0,0,0,0.025)'
                        }
                    },
                    formatter: function (params) {
                        return params[0].name + '<br/>'
                        + params[0].seriesName + ': ' + params[0].value + '<br/>'
                        + params[1].seriesName + ': ' + (params[1].value + params[0].value);
                    }
                },

                // Horizontal axis
                xAxis: [{
                    type: 'category',
                    data: ['Cutting', 'Sewing', 'Finishing', 'Shipment'],
                    axisLabel: {
                        color: '#333'
                    },
                    axisLine: {
                        lineStyle: {
                            color: '#999'
                        }
                    },
                    splitLine: {
                        show: true,
                        lineStyle: {
                            color: '#eee',
                            type: 'dashed'
                        }
                    }
                }],

                // Vertical axis
                yAxis: [{
                    type: 'value',
                    boundaryGap: [0, 0.1],
                    axisLabel: {
                        color: '#333'
                    },
                    axisLine: {
                        lineStyle: {
                            color: '#999'
                        }
                    },
                    splitLine: {
                        lineStyle: {
                            color: '#eee'
                        }
                    },
                    splitArea: {
                        show: true,
                        areaStyle: {
                            color: ['rgba(250,250,250,0.1)', 'rgba(0,0,0,0.015)']
                        }
                    }
                }],

                // Add series
                series: [
                    {
                        name: 'Target',
                        type: 'bar',
                        stack: 'sum',
                        barCategoryGap: '50%',
                        itemStyle: {
                            normal: {
                                color: '#1ca805',
                                barBorderColor: '#1ca805',
                                barBorderWidth: 6,
                                label: {
                                    show: true,
                                    position: 'insideTop'
                                }
                            }
                        },
                        data: [2500, 2000, 1900, 2500]
                    },
                    {
                        name: 'Production',
                        type: 'bar',
                        stack: 'sum',
                        itemStyle: {
                            normal: {
                                color: '#f5f5f5',
                                barBorderColor: '#1ca805',
                                barBorderWidth: 6,
                                label: {
                                    show: true,
                                    position: 'top',
                                    formatter: function (params) {
                                        for (var i = 0, l = columns_thermometer_options.xAxis[0].data.length; i < l; i++) {
                                            if (columns_thermometer_options.xAxis[0].data[i] == params.name) {
                                                return columns_thermometer_options.series[0].data[i] + params.value;
                                            }
                                        }
                                    },
                                    textStyle: {
                                        color: '#1ca805'
                                    }
                                }
                            }
                        },
                        data: [500, 200, 500, 700]
                    }
                ]
            };

            // Set options
            columns_thermometer.setOption(columns_thermometer_options);
        }


if (columns_plie_element) {

            // Initialize chart
            var columns_plie = echarts.init(columns_plie_element);


            //
            // Chart config
            //

            // Options
            var columns_plie_options = {

                // Global text styles
                textStyle: {
                    fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                    fontSize: 13
                },

                // Chart animation duration
                animationDuration: 750,

                // Setup grid
                grid: {
                    left: 10,
                    right: 10,
                    top: 35,
                    bottom: 0,
                    containLabel: true
                },

                // Add legend
                legend: {
                    data: ['Actual', 'Forecast'],
                    itemHeight: 8,
                    itemGap: 20,
                    selectedMode: false
                },

                // Add tooltip
                tooltip: {
                    trigger: 'axis',
                    backgroundColor: 'rgba(0,0,0,0.75)',
                    padding: [10, 15],
                    textStyle: {
                        fontSize: 13,
                        fontFamily: 'Roboto, sans-serif'
                    },
                    axisPointer: {
                        type: 'shadow',
                        shadowStyle: {
                            color: 'rgba(0,0,0,0.025)'
                        }
                    },
                    formatter: function (params) {
                        return params[0].name + '<br/>'
                        + params[0].seriesName + ': ' + params[0].value + '<br/>'
                        + params[1].seriesName + ': ' + (params[1].value + params[0].value);
                    }
                },

                // Horizontal axis
                xAxis: [{
                    type: 'category',
                    data: ['1', '2', '3', '4'],
                    axisLabel: {
                        color: '#333'
                    },
                    axisLine: {
                        lineStyle: {
                            color: '#999'
                        }
                    },
                    splitLine: {
                        show: true,
                        lineStyle: {
                            color: '#eee',
                            type: 'dashed'
                        }
                    }
                }],

                // Vertical axis
                yAxis: [{
                    type: 'value',
                    boundaryGap: [0, 0.1],
                    axisLabel: {
                        color: '#333'
                    },
                    axisLine: {
                        lineStyle: {
                            color: '#999'
                        }
                    },
                    splitLine: {
                        lineStyle: {
                            color: '#eee'
                        }
                    },
                    splitArea: {
                        show: true,
                        areaStyle: {
                            color: ['rgba(250,250,250,0.1)', 'rgba(0,0,0,0.015)']
                        }
                    }
                }],

                // Add series
                series: [
                    {
                        name: 'Target',
                        type: 'bar',
                        stack: 'sum',
                        barCategoryGap: '50%',
                        itemStyle: {
                            normal: {
                                color: '#FF7043',
                                barBorderColor: '#FF7043',
                                barBorderWidth: 6,
                                label: {
                                    show: true,
                                    position: 'insideTop'
                                }
                            }
                        },
                        data: [11, 15, 3, 9]
                    },
                    {
                        name: 'Production',
                        type: 'bar',
                        stack: 'sum',
                        itemStyle: {
                            normal: {
                                color: '#f5f5f5',
                                barBorderColor: '#FF7043',
                                barBorderWidth: 6,
                                label: {
                                    show: true,
                                    position: 'top',
                                    formatter: function (params) {
                                        for (var i = 0, l = columns_plie_options.xAxis[0].data.length; i < l; i++) {
                                            if (columns_plie_options.xAxis[0].data[i] == params.name) {
                                                return columns_plie_options.series[0].data[i] + params.value;
                                            }
                                        }
                                    },
                                    textStyle: {
                                        color: '#FF7043'
                                    }
                                }
                            }
                        },
                        data: [3, 6, 7, 3]
                    }
                ]
            };

            // Set options
            columns_plie.setOption(columns_plie_options);
        }


 if (columns_basic_element) {

            // Initialize chart
            var columns_basic = echarts.init(columns_basic_element);


            //
            // Chart config
            //

            // Options
            columns_basic.setOption({

                // Define colors
                color: ['#1ca805','#ff7043','#5ab1ef','#ffb980','#d87a80'],

                // Global text styles
                textStyle: {
                    fontFamily: 'Roboto, Arial, Verdana, sans-serif',

                    fontSize: 13
                },

                // Chart animation duration
                animationDuration: 750,

                // Setup grid
                grid: {
                    left: 0,
                    right: 0,
                    top: 35,
                    bottom: 0,
                    containLabel: true
                },

                // Add legend
                legend: {
                    data: ['Evaporation', 'Precipitation'],
                    itemHeight: 8,
                    itemGap: 70,
                    textStyle: {
                        padding: [0, 10]
                    }
                },

                // Add tooltip
                tooltip: {
                    trigger: 'axis',
                    backgroundColor: 'rgba(0,0,0,0.75)',
                    padding: [10, 15],
                    textStyle: {
                        fontSize: 13,
                        fontFamily: 'Roboto, sans-serif'
                    }
                },

                // Horizontal axis
                xAxis: [{
                    type: 'category',
                    data: ['Line-1', 'Line-2', 'Line-3', 'Line-4', 'Line-5'],
                    axisLabel: {
                        color: '#333'
                    },
                    axisLine: {
                        lineStyle: {
                            color: '#999'
                        }
                    },
                    splitLine: {
                        show: true,
                        lineStyle: {
                            color: '#eee',
                            type: 'dashed'
                        }
                    }
                }],

                // Vertical axis
                yAxis: [{
                    type: 'value',
                    axisLabel: {
                        color: '#333'
                    },
                    axisLine: {
                        lineStyle: {
                            color: '#999'
                        }
                    },
                    splitLine: {
                        lineStyle: {
                            color: ['#eee']
                        }
                    },
                    splitArea: {
                        show: true,
                        areaStyle: {
                            color: ['rgba(250,250,250,0.1)', 'rgba(0,0,0,0.01)']
                        }
                    }
                }],

                // Add series
                series: [
                    {
                        name: 'Prodn.',
                        type: 'bar',
                        data: [500, 440, 700, 260, 300],
                        itemStyle: {
                            normal: {
                                label: {
                                    show: true,
                                    position: 'top',
                                    textStyle: {
                                        fontWeight: 500
                                    }
                                }
                            }
                        }
                    },
                    {
                        name: 'WIP',
                        type: 'bar',
                        data: [350, 1080, 1400, 700, 500],
                        itemStyle: {
                            normal: {
                                label: {
                                    show: true,
                                    position: 'top',
                                    textStyle: {
                                        fontWeight: 500
                                    }
                                }
                            }
                        }
                    }
                ]
            });
        }





 if (columns_qualityreport_element) {

            // Initialize chart
            var columns_qualityreport = echarts.init(columns_qualityreport_element);


            //
            // Chart config
            //

            // Options
            columns_qualityreport.setOption({

                // Define colors
                color: ['#bb3f3f','#f38382','#5ab1ef','#ffb980','#d87a80'],

                // Global text styles
                textStyle: {
                    fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                    fontSize: 13
                },

                // Chart animation duration
                animationDuration: 750,

                // Setup grid
                grid: {
                    left: 0,
                    right: 0,
                    top: 35,
                    bottom: 0,
                    containLabel: true
                },

                // Add legend
                legend: {
                    data: ['Evaporation', 'Precipitation'],
                    itemHeight: 8,
                    itemGap: 70,
                    textStyle: {
                        padding: [0, 10]
                    }
                },

                // Add tooltip
                tooltip: {
                    trigger: 'axis',
                    backgroundColor: 'rgba(0,0,0,0.75)',
                    padding: [10, 15],
                    textStyle: {
                        fontSize: 13,
                        fontFamily: 'Roboto, sans-serif'
                    }
                },

                // Horizontal axis
                xAxis: [{
                    type: 'category',
                    data: ['Early', 'Delayed', 'Ontime'],
                    axisLabel: {
                        color: '#333'
                    },
                    axisLine: {
                        lineStyle: {
                            color: '#999'
                        }
                    },
                    splitLine: {
                        show: true,
                        lineStyle: {
                            color: '#eee',
                            type: 'dashed'
                        }
                    }
                }],

                // Vertical axis
                yAxis: [{
                    type: 'value',
                    axisLabel: {
                        color: '#333'
                    },
                    axisLine: {
                        lineStyle: {
                            color: '#999'
                        }
                    },
                    splitLine: {
                        lineStyle: {
                            color: ['#eee']
                        }
                    },
                    splitArea: {
                        show: true,
                        areaStyle: {
                            color: ['rgba(250,250,250,0.1)', 'rgba(0,0,0,0.01)']
                        }
                    }
                }],

                // Add series
                series: [
                    {
                        name: 'FHO',
                        type: 'bar',
                        data: [<?php echo $early ?>, <?php echo $delayed ?>, <?php echo $ontime ?>],
                        itemStyle: {
                            normal: {
                                label: {
                                    show: true,
                                    position: 'top',
                                    textStyle: {
                                        fontWeight: 500
                                    }
                                }
                            }
                        }
                    },
                    {
                        name: 'PCD',
                        type: 'bar',
                        data: [<?php echo $early1 ?>, <?php echo $delayed1 ?>, <?php echo $ontime1 ?>],
                        itemStyle: {
                            normal: {
                                label: {
                                    show: true,
                                    position: 'top',
                                    textStyle: {
                                        fontWeight: 500
                                    }
                                }
                            }
                        }
                    },
                ]
            });
        }

 if (columns_qualityreport_element2) {

            // Initialize chart
            var columns_qualityreport = echarts.init(columns_qualityreport_element2);


            //
            // Chart config
            //

            // Options
            columns_qualityreport.setOption({

                // Define colors
                color: ['#4285f4','#93b8f7','#5ab1ef','#ffb980','#d87a80'],

                // Global text styles
                textStyle: {
                    fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                    fontSize: 13
                },

                // Chart animation duration
                animationDuration: 750,

                // Setup grid
                grid: {
                    left: 0,
                    right: 0,
                    top: 35,
                    bottom: 0,
                    containLabel: true
                },

                // Add legend
                legend: {
                    data: ['Evaporation', 'Precipitation'],
                    itemHeight: 8,
                    itemGap: 70,
                    textStyle: {
                        padding: [0, 10]
                    }
                },

                // Add tooltip
                tooltip: {
                    trigger: 'axis',
                    backgroundColor: 'rgba(0,0,0,0.75)',
                    padding: [10, 15],
                    textStyle: {
                        fontSize: 13,
                        fontFamily: 'Roboto, sans-serif'
                    }
                },

                // Horizontal axis
                xAxis: [{
                    type: 'category',
                    data: ['Line 1', 'Line 2', 'Line 3', 'Line 4', 'Line 5'],
                    axisLabel: {
                        color: '#333'
                    },
                    axisLine: {
                        lineStyle: {
                            color: '#999'
                        }
                    },
                    splitLine: {
                        show: true,
                        lineStyle: {
                            color: '#eee',
                            type: 'dashed'
                        }
                    }
                }],

                // Vertical axis
                yAxis: [{
                    type: 'value',
                    axisLabel: {
                        color: '#333'
                    },
                    axisLine: {
                        lineStyle: {
                            color: '#999'
                        }
                    },
                    splitLine: {
                        lineStyle: {
                            color: ['#eee']
                        }
                    },
                    splitArea: {
                        show: true,
                        areaStyle: {
                            color: ['rgba(250,250,250,0.1)', 'rgba(0,0,0,0.01)']
                        }
                    }
                }],

                // Add series
                series: [
                    {
                        name: 'Sewing DHU',
                        type: 'bar',
                        data: [50, 25, 25, 25, 15],
                        itemStyle: {
                            normal: {
                                label: {
                                    show: true,
                                    position: 'top',
                                    textStyle: {
                                        fontWeight: 500
                                    }
                                }
                            }
                        }
                    },
                    {
                        name: 'Finishing DHU',
                        type: 'bar',
                        data: [30, 10, 30, 10, 20],
                        itemStyle: {
                            normal: {
                                label: {
                                    show: true,
                                    position: 'top',
                                    textStyle: {
                                        fontWeight: 500
                                    }
                                }
                            }
                        }
                    },
                ]
            });
        }


        //
        // Resize charts
        //

        // Resize function
        var triggerChartResize = function() {
            columns_basic_element && columns_basic.resize();
            columns_qualityreport_element && columns_qualityreport.resize();
            columns_stacked_element && columns_stacked.resize();
            columns_thermometer_element && columns_thermometer.resize();
            columns_plie && columns_plie.resize();
            columns_clustered_element && columns_clustered.resize();
            columns_compositive_waterfall_element && columns_compositive_waterfall.resize();
            columns_change_waterfall_element && columns_change_waterfall.resize();
            columns_timeline_element && columns_timeline.resize();
        };

        // On sidebar width change
        $(document).on('click', '.sidebar-control', function() {
            setTimeout(function () {
                triggerChartResize();
            }, 0);
        });

        // On window resize
        var resizeCharts;
        window.onresize = function () {
            clearTimeout(resizeCharts);
            resizeCharts = setTimeout(function () {
                triggerChartResize();
            }, 200);
        };
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _columnsWaterfallsExamples();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    EchartsColumnsWaterfalls.init();
});
</script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
            google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['', 'Early', 'OnTime', 'Delayed'],
          ['P2P', 0.2, 0.6,0.2],
          ['Indent', <?php echo $earlyindent; ?>,<?php echo $delayedindent; ?>,  <?php echo $ontimeindent; ?>],
          ['FOB', <?php echo $earlyfob; ?>, <?php echo $delayedfob; ?>,  <?php echo $ontimefob; ?>],
          ['FPT', <?php echo $earlyfpt; ?>, <?php echo $delayedfpt; ?>, <?php echo $ontimefpt; ?>],
          ['GPT', <?php echo $earlygpt; ?>, <?php echo $delayedgpt; ?>, <?php echo $ontimegpt; ?>],
          ['PP',  <?php echo $earlygp; ?>, <?php echo $delayedgp; ?>, <?php echo $ontimegp; ?>]
        ]);

        var options = {
        legend: { position: 'none',},
          colors: ['#5b9bd5', '#ed7d31', '#a5a5a5']
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material1'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
<?php






$no=1;
$select='*';
$where='';
$rs='';
$wheresearch='';
$limit='20000';

$where='where status != "0" ';
$page=$_GET['page'];
$f=0;
 $gt=0;
 $fd=0;
 $air=0;
 $sea=0;
 $fvv=0;
$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
$rs=GetRecordList($select,'packinglistMaster',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){


$f=$f+1;


           if($resultlists['orignalshipmode']==$resultlists['actualshipmode']){
               $gt=$gt+1;




           }

             if($resultlists['orignalexfactory']==$resultlists['actualexfactory'] ){
               $fd=$fd+1;




           }

             if($resultlists['toport']=='1' ){
               $air=$air+1;




           }

             if($resultlists['actualshipmode']=='Sea' ){
               $sea=$sea+1;




           }

            if($resultlists['orignalexfactory']!=$resultlists['actualexfactory'] ){
               $fvv=$fvv+1;




           }

}



$calc=($gt/$f)*100;


$calc1=($fd/$f)*100;

$calc2=($air/$f)*100;
$calc3=($sea/$f)*100;

$calc4=($fvv/$f)*100;


?>


    <script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["", "", { role: "style" } ],
        ["Factory SOT", <?php echo round($calc1,2); ?>, 'fill-color:#B22222;stroke-width: 4;color: #CD853F'],
        ["Overall Brand SOT", <?php echo round($calc,2); ?>, 'fill-color:#008080;stroke-width: 4;color: #CD853F'],
        ["C&F Air", <?php echo round($calc4,2); ?>, 'fill-color:#800080;stroke-width: 4;color: #CD853F'],
        ["Air to Port",<?php echo round($calc2,2); ?>, 'fill-color:#5b9bd5;stroke-width: 4;color: #CD853F'],
        ["Sea Ship", <?php echo round($calc3,2); ?>, 'fill-color:#33b679;stroke-width: 4;color: #CD853F']
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        width: 460,
        height: 420,
        bar: {groupWidth: "80%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("columnchart_material23"));
      chart.draw(view, options);
  }
  </script>
<?php require "footer.php"; ?>
</body>
</html>

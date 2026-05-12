<div class="page-content">
<style>
.even{
background-color: #0097a71a;
}
</style>

		<!-- Main sidebar -->
		<?php include "left.php"; ?>
		<div class="content-wrapper">

		<!---Save Alert Notification---->
		<?php include "savealert.php"; ?>

<?php
$categoryIdvalue=$_POST['categoryId'];
?>

			<div class="content pt-0" style="margin-top:20px;">

				<div class="row">
				<div class="col-xl-12">

				<div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
						<div class="col-xl-12"><h5 class="card-title"><?php echo $pageName; ?></h5></div>

				  </div></div>
			  </div>


				<div class="card">
				<form name"search" method="post" action="">
				<input type="hidden" name="module" value="<?php echo $_GET['module']; ?>" />
				<div class="row" style="padding:20px;">

<div class="col-md-2" style="display:none;">
<div class="">
<select name="departmentId" id="departmentId" class="form-control">
<option value="">Department</option>
<?php
$fk=GetPageRecord('*','departmentMaster','1 and status=1 and deleteStatus=0 order by name asc');
while($depData=mysqli_fetch_array($fk)){ ?>
<option value="<?php echo $depData['id']; ?>"><?php echo $depData['name']; ?></option>
<?php } ?>
</select>
</div>
</div>

<div class="col-md-2">
						<div class="form-group">
						 	<select name="categoryId[]" id="categoryId" multiple="multiple" class="form-control" onChange="selectsubcategory();">

                              <?php

$fc=GetPageRecord('*','categoryMaster','1 and status=1 and deleteStatus=0 order by name asc');
while($catData=mysqli_fetch_array($fc)){
$checked='';
if(in_array($catData['id'],$categoryIdvalue)){
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
$('#categoryId').multiselect({
includeSelectAllOption: true,
enableFiltering: true,
enableCaseInsensitiveFiltering: true,
filterPlaceholder: 'Search...'
});
});
</script>


<div class="col-md-2" style="display:none;">
						<div class="form-group">
						 	 <select id="subCategoryId" name="subCategoryId" class="validate form-control" displayname="Sub Category">
							<option value="">Subcategory</option>
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



<div class="col-md-2" style="display:none;">
<div class="">
<select name="username" id="username" class="form-control">
<option value="">Merchant</option>
<?php
$fu=GetPageRecord('*','userMaster','1 and profileId="85" order by firstName asc');
while($userData=mysqli_fetch_array($fu)){ ?>
<option value="<?php echo $userData['id']; ?>"><?php echo $userData['firstName'].' '.$userData['lastName']; ?></option>
<?php } ?>
</select>
</div>
</div>
                  <div class="col-md-2">
					<div class="">
								<input name="search" type="submit" class="btn bg-teal-400" id="search" value="Select Category">
							</div>
						</div>
				  </div>
				</form>

<?php
//////////////////////////my find style performance=============================================================================================
if($_GET['categoryId']!=''){
$concategoryId='and categoryId="'.$_GET['categoryId'].'"';
}

if($_GET['subCategoryId']!=''){
$consubcategoryId='and subCategoryId="'.$_GET['subCategoryId'].'"';
}

$k=GetPageRecord('*','queryMaster','1 and subject!="" and deletestatus=0 '.$concategoryId.' '.$consubcategoryId.' order by id desc');

$queryCount=mysql_num_rows($k);
$queryData=mysqli_fetch_array($k);

$notassignedtotal=0;
$ontime=0;
$delayed=0;
$ahead=0;
$completedtotal=0;
while($resultlists=mysqli_fetch_array($k)){

$rsdaysk=GetPageRecord('*','styleAssignmentMaster','styleId="'.$resultlists['id'].'" and statusId=2');
$resultdays=mysqli_fetch_array($rsdaysk);

$assignDate = date('Y-m-d',$resultdays['dateAdded']);
$currDate =date('Y-m-d');

$datetime1 = date_create($assignDate);
$datetime2 = date_create($currDate);
$interval = date_diff($datetime1, $datetime2);
$durationcount = $interval->days;

$rsstatusk=GetPageRecord('*','departmentTimelineMaster','1 and categoryId="'.$resultlists['categoryId'].'" and subCategoryId="'.$resultlists['subCategoryId'].'" order by id desc');

$countdeptimeline=mysql_num_rows($rsstatusk);

$departmentTimeline=mysqli_fetch_array($rsstatusk);

$departmentDurationpersent = round($durationcount*100/$departmentTimeline['duration']);


$selectstatus='*';
$wherestatus='styleId="'.$resultlists['id'].'" and statusId!=0 order by id desc';
$rsstatus=GetPageRecord($selectstatus,'styleAssignmentMaster',$wherestatus);
$result=mysqli_fetch_array($rsstatus);

$select1='*';
$where1='id="'.$result['statusId'].'" order by id desc';
$rs1=GetPageRecord($select1,'statusMaster',$where1);
$result1=mysqli_fetch_array($rs1);

$selecttotaltask='*';
$wheretotaltask='styleId="'.$resultlists['id'].'"';
$rstotal=GetPageRecord($selecttotaltask,'styleSubCategoryMaster',$wheretotaltask);

$selectqty='*';
$whereqty='styleId="'.$resultlists['id'].'" and qtyStatus=1';
$rsqty=GetPageRecord($selectqty,'styleSubCategoryMaster',$whereqty);
$totalqty = mysql_num_rows($rsqty);

$selectprice='*';
$whereprice='styleId="'.$resultlists['id'].'" and priceStatus=1';
$rsprice=GetPageRecord($selectprice,'styleSubCategoryMaster',$whereprice);
$totalprice = mysql_num_rows($rsprice);

$selectvendor='*';
$wherevendor='styleId="'.$resultlists['id'].'" and vendorStatus=1';
$rsvendor=GetPageRecord($selectvendor,'styleSubCategoryMaster',$wherevendor);
$totalvendor = mysql_num_rows($rsvendor);

$totalTask = $totalqty+$totalprice+$totalvendor;

$selecttaskComplet='*';
$wheretaskComplet='styleId="'.$resultlists['id'].'" and approvedStatus=1';
$rswheretaskComplet=GetPageRecord($selecttaskComplet,'materialCostChatMaster',$wheretaskComplet);
$completed = mysql_num_rows($rswheretaskComplet);

$persent = round($completed*100/$totalTask);

$selectfurther='*';
$wherefurther='styleId="'.$resultlists['id'].'" and approvedStatus=2 and materialFinalStatus=1';
$rsfurther=GetPageRecord($selectfurther,'materialCostChatMaster',$wherefurther);
$furtherassign = mysql_num_rows($rsfurther);

$selectwaiting='*';
$wherewaiting='styleId="'.$resultlists['id'].'" and approvedStatus=3 and materialFinalStatus=1';
$rswaiting=GetPageRecord($selectwaiting,'materialCostChatMaster',$wherewaiting);
$waiting = mysql_num_rows($rswaiting);

$selectreject='*';
$wherereject='styleId="'.$resultlists['id'].'" and approvedStatus=4 and materialFinalStatus=1';
$rsreject=GetPageRecord($selectreject,'materialCostChatMaster',$wherereject);
$reject = mysql_num_rows($rsreject);

$pending = $completed+$furtherassign+$waiting+$reject;

if($resultlists['styleTypeId']!=2){

if($departmentDurationpersent>$persent){
++ $delayed;
}

if($departmentDurationpersent<$persent && $persent!=100){
++ $ahead;
}
if($departmentDurationpersent==$persent){
++ $ontime;
}
if($persent==100){
++ $completedtotal;
}
}
}
$notassignedtotal=$queryCount-($delayed+$ahead+$ontime+$completedtotal);
?>

<div class="content-wrapper">
		<div class="content">

	  <div class="row">

<?php
$rscategory=GetPageRecord('*','categoryMaster','1 and deletestatus=0  order by name asc');
while($result=mysqli_fetch_array($rscategory)){

if(in_array($result['id'],$categoryIdvalue) || $categoryIdvalue==''){ ?>

<div class="col-sm-12 col-xl-4">
<div class="card-header bg-white" style="background-color: #faffb0 !important;">
<h6 class="card-title"><?php echo $result['name']; ?></h6>
</div>

<div class="card card-body text-center" style="overflow:hidden; ">
<div id="barchart_rkdm<?php echo $result['id']; ?>" style="height:335px;">

</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load("current", {packages:['corechart']});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {

var data = google.visualization.arrayToDataTable(
[
         ['Element', 'Category wise performance', { role: 'style' }],
         ['Not Assigned', <?php echo $notassignedtotal; ?>, 'blue'],            // RGB value
         ['Ontime', <?php echo $ontime; ?>, 'CadetBlue'],            // English color name
         ['Delayed', <?php echo $delayed; ?>, 'Coral'],
         ['Ahead', <?php echo $ahead; ?>, 'DarkOrange' ],
		  ['Completed', <?php echo $completedtotal; ?>, 'green' ], // CSS-style declaration
      ]);

var options = {
chartArea:{left:10,top:50,width:"90%",right:10,height:"50%"},
width: 'auto',
height: 470,
legend: { position: 'top', maxLines: 3 },
bar: {groupWidth: '50%'},
isStacked: true,
colors: ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6'],
  is3D: true

};

var chart = new google.visualization.ColumnChart(document.getElementById('barchart_rkdm<?php echo $result['id']; ?>'));
chart.draw(data, options);
}
</script>

</div>
</div>

<?php } } ?>
</div>
</div>
</div>















		  </div></div>

</div>

			</div>

		</div>

	</div>


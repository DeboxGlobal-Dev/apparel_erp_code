<?php
if($loginuserprofileId==1 || $loginuserprofileId==91){
$wheresearchassign=' 1 and ';
} else {
if($loginuserprofileId==92){
$wheresearchassign=' 1 and finalstatus="2" and sampleStyle="2" and (assignTo in (select id from '._USER_MASTER_.' where empId in (select id from employeeMaster where reportingTo='.$_SESSION['empid'].')) or assignTo="'.$_SESSION['userid'].'" or ( id in (select styleId from styleAssignmentMaster where assignTo="'.$_SESSION['userid'].'" and styleAssignTo=0))) and ';
} else{


if($loginuserprofileId==93){

$wheresearchassign='1';
$wheresearchassign=' '.$wheresearchassign.' and addedBy="'.$_SESSION['userid'].'" and sampleStyle="2" and ';
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
if($_GET[' ']!=''){
$sampleId = decode($_GET['sampleId']);
}
if($_GET['brandId']!=''){
$brandId = decode($_GET['brandId']);
}
if($_GET['requestdate']!=''){
$rdate = $_GET['requestdate'];
}
if($_GET['targetdate']!=''){
$tdate = $_GET['targetdate'];
}
?>

<div class="page-content">
<style>
.even {
background-color: #0097a71a;
}
</style>


<div class="content-wrapper">
<?php include "savealert.php"; ?>
<div class="content pt-0 filterable" style="margin-top:20px;">
<div class="row">
<div class="col-xl-12">
<div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
<div class="col-xl-9">
<h5 class="card-title"><?php echo $pageName; ?></h5>
</div>
<div class="col-xl-1" style="padding-right: 0px;"> </div>
<!-- <a href="download-requisition-report.php" class="btn bg-teal-400 addnotify" aria-expanded="false" style="background-color: #03d873b8;">Download Excel</a> -->

</div>

<div class="card">
<div id="DataTables_Table_2_filter" class="dataTables_filter"
style="margin: 0px; margin-top: 15px;">
<div class="row" id="searchfilters">

<!-- <div class="col-md-2">
<label>
<input type="text" placeholder="Search:" name="filtersearch" id="filtersearch" onkeyup="filtersearch();"/>
</label>
</div> -->

<div class="col-md-12" style="margin: 10px">
<form action="" method="get">
<label>
<select name="brandId" class="form-control">
    <option value="">Select Brand</option>
    <?php
$qqqr=GetPageRecord('*','brandMaster','1');
while($quarData1=mysqli_fetch_array($qqqr)){
?>
    <option value="<?php echo encode($quarData1['id']); ?>"
        <?php if($quarData1['id'] == $brandId){ echo "selected"; } ?>>
        <?php echo $quarData1['name']; ?></option>
    <?php } ?>
</select>
</label>
<label>
<select name="styleId" class="form-control">
    <option value="">Select Style</option>
    <?php
$qqq=GetPageRecord('*','queryMaster','1 and subject!="" and sampleStyle=2 and deletestatus=0 order by id desc');
while($quarData2=mysqli_fetch_array($qqq)){
?>
    <option value="<?php echo encode($quarData2['id']); ?>"
        <?php if($quarData2['id'] == $styleId){ echo "selected"; } ?>>
        <?php echo $quarData2['styleRefId']; ?></option>
    <?php } ?>
</select>
</label>
<label>
<select name="sampleId" class="form-control">
    <option value="">Select Sample Type</option>
    <?php
$qqqq=GetPageRecord('*','sampleTypeMaster','1');
while($quarData3=mysqli_fetch_array($qqqq)){
?>
    <option value="<?php echo encode($quarData3['id']); ?>"
        <?php if($quarData3['id'] == $sampleId){ echo "selected"; } ?>>
        <?php echo $quarData3['name']; ?></option>
    <?php } ?>
</select>
</label>
<!-- <label>&nbsp;&nbsp;&nbsp;&nbsp;Requested Date
<input name="requestdate" type="date" class="form-control" value="<?php echo $rdate; ?>">
</label>
<label>&nbsp;&nbsp;&nbsp;&nbsp;Target Date
<input name="targetdate" type="date" class="form-control" value="<?php echo $tdate; ?>">
</label> -->

<label>&nbsp;&nbsp;
<input name="" type="submit" id="" class="" value="search"
    style="text-transform: uppercase; background-color: #03c28d; color: #fff; width: 200px; cursor:pointer;" />
</label>
<input name="module" id="module" type="hidden"
value="<?php echo $_REQUEST['module']; ?>" />
</form>
</div>
</div>
</div>
<form name="listform" id="listform" method="get">
<input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
<div id="pageload">
<div id="">
<div class="datatable-scroll">
<table class="table table-bordered table-hover no-footer table-responsive">
<thead style="background-color: #f5f5f5;">
    <tr role="row">
        <th>SR#</th>

        <th>Style&nbsp;Name</th>
        <th>Style#</th>
        <th>Sample&nbsp;Type</th>
        <th>Buyer</th>
        <th>Brand</th>
        <th>Season</th>
        <th>Sub-&nbsp;Category</th>
            <!-- <th width="170px">Requested&nbsp;Date</th>
<th width="170px">Target&nbsp;Date</th></th>
<th>Color</th>
<th>Quantity</th> -->

    </tr>
</thead>
<tbody>
    <?php
$no=1;
$select='*';
$where='';
$rs='';
$limit=clean($_GET['records']);

if($_GET['styleId']!=''){
$styleid = 'and id="'.decode($_GET['styleId']).'"';
}
if($_GET['sampleId']!=''){
$sampleid = 'and sampleType="'.decode($_GET['sampleId']).'"';
}
if($_GET['brandId']!=''){
$brandid = 'and brandId="'.decode($_GET['brandId']).'"';
}
if($_GET['requestdate']!=''){
$rdate = 'and requestedDate="'.$_GET['requestdate'].'"';
}
if($_GET['targetdate']!=''){
$tdate = 'and expectedDate="'.$_GET['targetdate'].'"';
}

$where='where subject!=""  '.$styleid.' '.$sampleid.' '.$brandid.' '.$rdate.' '.$tdate.' and deletestatus=0 and sampleStyle="2" order by id desc';
$page=$_GET['page'];

$targetpage=$fullurl.'loadstyle.php?module='.$modfile['moduleName'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&loginuserprofileId='.$loginuserprofileId.'&categoryId='.$_GET['categoryId'].'&';

$rs=GetRecordListJs($select,_QUERY_MASTER_,$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

$rsqtys=GetPageRecord('*','styleColorDetailMaster','1 and styleId="'.$resultlists['id'].'"');
while($totalqtys = mysqli_fetch_array($rsqtys)){

$rsqtysa=GetPageRecord('*','colorCardMaster','1 and id="'.$totalqtys['colorId'].'"');
$totalqtysa =mysqli_fetch_array($rsqtysa);

$rsample=GetPageRecord('*','sampleTypeMaster','1 and id="'.$resultlists['sampleType'].'"');
$smapleList = mysqli_fetch_array($rsample);

$nuCount1=GetPageRecord('*','seasonMaster','1 and id="'.$resultlists['seasonId'].'"');
$countFactory1=mysqli_fetch_array($nuCount1);

$nuCount4=GetPageRecord('*','subCategoryMaster','1 and id="'.$resultlists['subCategoryId'].'"');
$countFactory4=mysqli_fetch_array($nuCount4);

?>
    <tr role="row" class="odd">
        <td><?php echo $no; ?></td>

        <td><a href="showpage.crm?module=samplestatusreport&add=yes&styleid=<?php echo encode($resultlists['id']); ?>"><?php echo '#'.$resultlists['subject']; ?></a></td>
        <td><?php echo '#'.$resultlists['styleRefId']; ?></td>
        <td><?php echo $smapleList['name']; ?></td>
        <td><?php echo getBuyerName($resultlists['buyerId']); ?></td>
        <td><?php echo getBrandName($resultlists['brandId']); ?></td>
        <td><?php echo $countFactory1['name']; ?></td>
        <td><?php echo $countFactory4['name']; ?></td>
        <!-- <td><?php echo date('d-m-Y',strtotime($resultlists['requestedDate'])); ?></td>
<td><?php echo  date('d-m-Y',strtotime($resultlists['expectedDate'])); ?></td>

<td style=""><?php echo $totalqtysa['name']; ?></td>
<td align="left"><?php echo $totalqtys['qty']; ?>
</td> -->
    </tr>

    <?php $no++; }  } ?>

</tbody>
</table>
<div class="pagingdiv" style="width: 97%;margin: 20px auto;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tbody>
        <tr>
            <td>
                <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="padding-right:20px;">
                            <?php echo $totalentry; ?> entries</td>
                        <td><select name="records" id="records"
                                onchange="this.form.submit();"
                                class="lightgrayfield"
                                style="padding: 5px;border: 1px solid #ccc;">
                                <option value="25"
                                    <?php if($_GET['records']=='25'){ ?>
                                    selected="selected" <?php } ?>>25
                                    Records Per Page</option>
                                <option value="50"
                                    <?php if($_GET['records']=='50'){ ?>
                                    selected="selected" <?php } ?>>50
                                    Records Per Page</option>
                                <option value="100"
                                    <?php if($_GET['records']=='100'){ ?>
                                    selected="selected" <?php } ?>>100
                                    Records Per Page</option>
                                <option value="200"
                                    <?php if($_GET['records']=='200'){ ?>
                                    selected="selected" <?php } ?>>200
                                    Records Per Page</option>
                                <option value="300"
                                    <?php if($_GET['records']=='300'){ ?>
                                    selected="selected" <?php } ?>>300
                                    Records Per Page</option>
                            </select></td>
                    </tr>
                </table>
            </td>
            <td align="right">
                <div class="pagingnumbers"><?php echo $paging; ?></div>
            </td>
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
.liststyleimg {
float: left;
width: 70px;
margin-right: 15px;
padding: 5px;
border: 2px solid #e6e6e6;
}

.badge.dropdown-toggle:after {
display: none;
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

.dataTables_info,
.dataTables_paginate,
.dataTables_length {
display: none !important;
}
</style>
<script>
function deletestyle(id) {
var delStyle = confirm('Are you sure you want to delete this style?');
if (delStyle == true) {
window.location.href = 'showpage.crm?module=style&d=' + id; //delete style
}
}
</script>
<script>
$('#DataTables_Table_2').DataTable({
"order": [
[0, "desc"]
]
});
</script>

<script>
function filtersearch() {
var filtersearch = encodeURI($('#filtersearch').val());
var loginuserprofileId = '<?php echo $loginuserprofileId; ?>';
insidepageloader('<?php echo $targetpage; ?>searchname=' + filtersearch + '&loginuserprofileId=' +
loginuserprofileId);
}

function insidepageloader(page) {
$('#pageload').html(
'<div style="text-align: center; margin-top: 20%; width: 100%;" id="loadingpage"><div class="spinner-border text-success" role="status"></div></div>'
);
$('#pageload').load(page);
}
$(".pagingnumbers a").each(function() {
var thisdata = $(this).attr('pagecon');
thisdata = encodeURI(thisdata);
$(this).attr('onclick', 'insidepageloader("' + thisdata + '");');

});
</script>

<style>
.color-box {
width: 122px;
}
</style>
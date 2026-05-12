
<?php
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
      <div class="row">
        <div class="col-xl-12">
          <div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
            <div class="col-xl-9">
              <h5 class="card-title" ><?php echo $pageName; ?></h5>
            </div>
            <div class="col-xl-1" style="padding-right: 0px;"> </div>
                 <a href="download-losstimereport.php" class="btn bg-teal-400 addnotify" aria-expanded="false" style="background-color: #03d873b8;">Download Excel</a>

          </div>
          <div class="card">

            <form name="listform" id="listform" method="get">
              <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
              <div id="pageload">
                <div id="" >
                  <div class="datatable-scroll">
                    <table class="table table-bordered table-hover no-footer table-responsive">
                      <thead style="background-color: #f5f5f5; text-align:center;">
                        <tr role="row">

        	<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 50px;">Date</th>
																<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Factory</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Line&nbsp;No</th>

								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Total&nbsp;Output </th>
																<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Operators </th>

							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Output&nbsp;per&nbsp;operator</th>
							    							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Stitching&nbsp;Time&nbsp;per&nbsp;Piece&nbsp;per&nbsp; Operator</th>
							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Downtime </th>

							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Shift&nbsp;Time&nbsp;per&nbsp;operator&nbsp;(In&nbsp;Min)</th>

							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Downtime&nbsp;Percentage</th>

							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" style="display:none;">&nbsp;</th>


</tr>

                      </thead>
                       <tbody id="allhotellisting">


                          	<?php
$no=1;
$select='*';
$where='';
$rs='';
$wheresearch='';
$limit='20000';

if($_GET['stylestatus']!=''){
$stylestatus = 'and finalstatus="'.$_GET['stylestatus'].'"';
}

$wheres='group by factoryId,line,fromDate';
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
$rs=GetRecordList('*','recorderInputMaster',$wheres,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){


    $selectimg='*';
$whereimgs='id="'.$resultlists['factoryId'].'" ';
$rsimgs=GetPageRecord($selectimg,'factoryMaster',$whereimgs);
$imgresults=mysqli_fetch_array($rsimgs);



    $a=$resultlists['numberofpassgar']+$resultlists['numberofdefgar'];



    $dhu=($resultlists['numberofdefects']/$a)*100;

$selectimg='*';
$whereimg='id="'.$resultlists['styleId'].'" ';
$rsimg=GetPageRecord($selectimg,'queryMaster',$whereimg);
$imgresult=mysqli_fetch_array($rsimg);





$selectdays='*';
$wheredays='id="'.$resultlists['line'].'" ';
$rsdays=GetPageRecord($selectdays,'factoryLineMaster',$wheredays);
$resultdays=mysqli_fetch_array($rsdays);



$selectdaysa='*';
$wheredaysa='id="'.$resultlists['factoryId'].'" ';
$rsdaysa=GetPageRecord($selectdaysa,'factoryMaster',$wheredaysa);
$resultdaysa=mysqli_fetch_array($rsdaysa);




?>





                        <tr role="row" class="odd" <?php if($resultlists['stylestatus']=='0'){ ?> style="background-color: #ff704359;" <?php } ?>>

                       	<td align="center"><?php echo $resultlists['fromDate']; ?></td>
								 								<td><?php echo $imgresults['name']; ?></td>
								                          <td> <span style="padding: 5px 10px; background-color: #0097a7; color: #fff; margin-right: 2px; font-size: 12px; margin-bottom:5px;display: inline-block;"><?php echo str_replace(' ','&nbsp;', $resultdays['lineName']);?></span></td>

								<td>#<?php echo $imgresult['styleRefId']; ?></td>

<td><?php echo $resultlists['output']; ?></td>
<td><?php echo $resultlists['operator']; ?></td>

<?php
$per=$resultlists['output']/$resultlists['operator'];
?>
<td><?php echo round($per,2); ?></td>
<td><?php echo $imgresult['smv']; ?></td>

<?php
$down=$per*$imgresult['smv'];
?>
<td><?php echo round($down,2); ?></td>
<td> <?php if($resultlists['hours']=="1st Hour"){ echo "60 Mins";} else if($resultlists['hours']=="2nd Hour"){ echo "120 Mins";}  else if($resultlists['hours']=="3rd Hour"){ echo "180 Mins";} else if($resultlists['hours']=="4th Hour"){ echo "240 Mins";}  else if($resultlists['hours']=="5th"){ echo "300 Mins";} else if($resultlists['hours']=="6th Hour"){ echo "360 Mins";} else if($resultlists['hours']=="7th Hour"){ echo "420 Mins";} else if($resultlists['hours']=="8th Hour"){ echo "480 Mins";}else{} ?></td>
<?php
$a=60;
$b=120;
$c=180;
$d=240;
$e=300;
$f=360;
$g=420;
$h=480;

?>
<td><?php if($resultlists['hours']=="1st Hour"){ echo round(($down/$a)*100,2); } elseif($resultlists['hours']=="2nd Hour"){ echo round(($down/$b)*100,2); } elseif($resultlists['hours']=="3rd Hour"){ echo round(($down/$c)*100,2); } elseif($resultlists['hours']=="4th Hour"){ echo round(($down/$d)*100,2); } elseif($resultlists['hours']=="5th Hour"){ echo round(($down/$e)*100,2); } elseif($resultlists['hours']=="6th Hour"){ echo round(($down/$f)*100,2); }  elseif($resultlists['hours']=="7th Hour"){ echo round(($down/$g)*100,2); }elseif($resultlists['hours']=="8th Hour"){ echo round(($down/$g)*100,2); }    ?></td>


                                              </tr>

                                              <?php $i++; }     ?>

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




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

$styleId=$_POST['styleId'];
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
            <div class="col-xl-1" style="padding-right: 0px;"> </div>
            <a href="download-tna-status.php" class="btn bg-teal-400 addnotify" aria-expanded="false" style="background-color: #03d873b8;">Download Excel</a>
            </div>
            <div class="card" style="padding-bottom:40px;">
            <div class="row" style="margin-top:20px;">
            <div class="col-md-12" style=" padding:0px 25px;">
            <form action="" method="POST">

                  <div class="row">
                 <div class="col-md-2">
                      <div class="form-group">
                      <input type="text" placeholder="Search:" name="filtersearch" id="filtersearch" style="margin-left: 0px; width: 190px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;"/>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <select name="quarterId[]" id="quarterId" multiple="multiple" class="form-control">
                          <?php
$qq=GetPageRecord('*','tnaActivityMaster','1 order by id');
while($quarData1=mysqli_fetch_array($qq)){
$checked='';
if(in_array($quarData1['id'],$quarterIdvalue)){
$checked='selected';
}
?>
                          <option value="<?php echo $quarData1['id']; ?>" <?php echo $checked; ?> ><?php echo $quarData1['name']; ?></option>
                          <?php } ?>
                          </select>
                          </div>
                          </div>
                         <div class="col-md-2">
                         <div class="form-group">
                         <select name="styleId" class="form-control">
                         <option value="">Select Style</option>
                          <?php
$qqq=GetPageRecord('*','queryMaster','1 and subject!="" and sampleStyle=1 and deletestatus=0 order by id desc');
while($quarData2=mysqli_fetch_array($qqq)){
?>
                          <option value="<?php echo $quarData2['id']; ?>" <?php if($quarData2['id'] == $styleId){ echo "selected"; } ?>><?php echo $quarData2['styleRefId']; ?></option>
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
                      <div class="col-md-2">
                      <div class="form-group">
                        <input name="" type="submit" id="" class=" btn btn-primary" value="Search" />
                        <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div style="padding:0px 15px;">
            <table class="table table-bordered capacity-class" style="width:100%;">
            <thead>
                <tr style="background-color: #e9fff8;">
                  <th width="100px;"><div align="center">Style&nbsp;No</div></th>
                  <th><div align="center">Buyer</div></th>
                  <th><div align="center">Season</div></th>
                  <th><div align="center">Category</div></th>
                  <th><div align="center">Sub-&nbsp;Category</div></th>
                  <th><div align="center">Gender</div></th>
                  <th><div align="center">Activity&nbsp;Name</div></th>
                  <th><div align="center">Planned&nbsp;Date</div></th>
                  <th><div align="center">Actual&nbsp;Date</div></th>
                  <th><div align="center">Difference</div></th>
                  <th width="100px;"><div align="center">Status</div></th>
                </tr>
              </thead>
<?php
$select='*';
 if($styleId!=''){
      $stylestatus = 'and styleId="'.$styleId.'"';
              }
$where='where taskListId !="" '.$stylestatus.'';
$limit=clean($_GET['records']);
$page=$_GET['page'];
$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&stylerefid='.$_GET['stylerefid'].'&';

$rs=GetRecordList($select,'timeActionReport',$where,'20',$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($quarData1=mysqli_fetch_array($rs[0])){

$qqp=GetPageRecord('*','taskListMaster','1 and id="'.$quarData1['taskListId'].'"');
          $quarDatap=mysqli_fetch_array($qqp);


						$qq=GetPageRecord('*','tnaActivityMaster','1 and id="'.$quarDatap['name'].'"');
						$quarData=mysqli_fetch_array($qq);
            if(in_array($quarData['id'],$quarterIdvalue) || $quarterIdvalue==""){




						$bd=GetPageRecord('*','queryMaster','1 and id="'.$quarData1['styleId'].'" and subject!="" and sampleStyle=1 and deletestatus=0');
            $countstyle=mysql_num_rows($bd);
						$brandData=mysqli_fetch_array($bd);

						$nuCount=GetPageRecord('*','buyerMaster','1 and id="'.$brandData['buyerId'].'"');
						$countFactory=mysqli_fetch_array($nuCount);

            $nuCount1=GetPageRecord('*','seasonMaster','1 and id="'.$brandData['seasonId'].'"');
            $countFactory1=mysqli_fetch_array($nuCount1);

            $nuCount2=GetPageRecord('*','categoryMaster','1 and id="'.$brandData['categoryId'].'"');
            $countFactory2=mysqli_fetch_array($nuCount2);

            $nuCount3=GetPageRecord('*','genderMaster','1 and id="'.$brandData['gender'].'"');
            $countFactory3=mysqli_fetch_array($nuCount3);

            $nuCount4=GetPageRecord('*','subCategoryMaster','1 and id="'.$brandData['subCategoryId'].'"');
            $countFactory4=mysqli_fetch_array($nuCount4);


            $nuCount5=GetPageRecord('*','taskListMaster','1 and name="'.$quarData['id'].'" and tnatemplate="'.$brandData['tnaTemplateId'].'"');
            $countFactory5=mysqli_fetch_array($nuCount5);

            $nuCount6=GetPageRecord('*','timeActionReport','1 and taskListId="'.$countFactory5['id'].'"');
            $countFactory6=mysqli_fetch_array($nuCount6);

						?>
            <tbody id="allhotellisting">
                <tr>


                  <td><div align="center"><?php echo '#'.$brandData['styleRefId']; ?></div></td>
                  <td><div align="center"><?php echo $countFactory['name']; ?></div></td>
                  <td><div align="center"><?php echo $countFactory1['name']; ?></div></td>
                  <td><div align="center" ><?php echo $countFactory2['name']; ?></div></td>
                  <td><div align="center" ><?php echo $countFactory4['name']; ?></div></td>
                  <td><div align="center" ><?php echo $countFactory3['name']; ?></div></td>
                  <td><div align="center"><?php echo $quarData['name']; ?></div></td>
                  <td><div align="center"><?php if($quarData1['complitionDate']!='' && $quarData1['complitionDate']!='1970-01-01' && $quarData1['complitionDate']!='0000-00-00'){ echo date('d-m-Y', strtotime($quarData1['complitionDate'])); } else { echo "-";} ?></div></td>
                  <td><div align="center"><?php if($quarData1['actualDate']!='' && $quarData1['actualDate']!='1970-01-01' && $quarData1['actualDate']!='0000-00-00'){ echo date('d-m-Y', strtotime($quarData1['actualDate'])); } else { echo "-";} ?></div></td>
                  <td><div align="center" >
                       <?php
                       if($quarData1['complitionDate']!='' && $quarData1['complitionDate']!='1970-01-01' && $quarData1['complitionDate']!='0000-00-00' && $quarData1['actualDate']!='' && $quarData1['actualDate']!='1970-01-01' && $quarData1['actualDate']!='0000-00-00'){
                   $plandate=date('d-m-Y', strtotime($quarData1['complitionDate']));
                   $start_date = strtotime($plandate);
                    $currentdate= date('d-m-Y', strtotime($quarData1['actualDate']));
                     $end_date = strtotime($currentdate);
                     $difference =  ($start_date - $end_date)/60/60/24;
                     echo $difference;
                  } else { echo "-"; }
                    ?>

                  </div></td>
                  <td><div align="center" >
                    <?php
                    if($quarData1['complitionDate']=='' || $quarData1['complitionDate']=='1970-01-01' || $quarData1['complitionDate']=='0000-00-00' || $quarData1['actualDate']=='' || $quarData1['actualDate']=='1970-01-01' || $quarData1['actualDate']=='0000-00-00'){
                      ?><span style="color: red;"><?php echo "Pending"; ?></span><?php  } else if($difference > "0"){ ?><span style="color: green;">Early</span><?php } else if($difference < "0"){?><span style="color: orange;">Delayed</span><?php } else { ?><span style="color: #0288d1;">On Time</span><?php } ?>
                  </div></td>

                </tr>
                </tbody>

                <?php }
              }
               ?>
              </table>

              <!-- <code -->
                <div class="pagingdiv" style="width: 97%;margin: 20px auto;">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tbody>
                        <tr>
                          <td align="right"><div class="pagingnumbers"><?php echo $paging; ?></div></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                <!-- code -->
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

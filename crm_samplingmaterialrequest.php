
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
 if($_GET['id']!=''){
     $id = decode($_GET['id']);
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
            <a href="download-samplingmaterialrequest.php" class="btn bg-teal-400 addnotify" aria-expanded="false" style="background-color: #03d873b8;">Download Excel</a>

               </div>
              <div class="card">
              <div id="DataTables_Table_2_filter" class="dataTables_filter" style="margin: 0px; margin-top: 15px;">
              <div class="row" id="searchfilters">

                     <div class="col-md-12" style="margin: 10px">
                     <form action="" method="get">
                     <label>
                     <select name="styleId" class="form-control">
                           <option value="">Select Style Number</option>

                         <?php
                         $qqqq=GetPageRecord('*','queryMaster','1');
                         while($quarData3=mysqli_fetch_array($qqqq)){

                         ?>

                          <option value="<?php echo encode($quarData3['id']); ?>" <?php if($quarData3['id'] == $styleId){ echo "selected"; } ?>><?php echo $quarData3['styleRefId']; ?></option>
                          <?php } ?>
                        </select>
                        </label>

                        <label>
                        <select name="id" class="form-control">
                          <option value="">Select Material Type</option>
                          <?php
                         $qqqr=GetPageRecord('*','materialTypeMaster','1');
                         while($quarData1=mysqli_fetch_array($qqqr)){
                         ?>
                          <option value="<?php echo encode($quarData1['id']); ?>"><?php echo $quarData1['name']; ?></option>
                          <?php } ?>
                        </select>
                        </label>
                    <label>
                        <select name="mt" class="form-control" style="width:160px;">
                          <option value="">Select Material Name</option>
                             <?php
                            $qqq=GetPageRecord('*','styleSubCategoryMaster','1');
                            while($quarData2=mysqli_fetch_array($qqq)){
                             ?>

                          <option value="<?php echo encode($quarData2['id']); ?>" <?php if($quarData2['id'] == $styleId){ echo "selected"; } ?>><?php echo $quarData2['name']; ?></option>
                          <?php } ?>
                        </select>
                        </label>

                         <label>
                        <select name="art" class="form-control">
                          <option value="">Select Artwork No.</option>
                          <?php
$qqq=GetPageRecord('*','queryMaster','1 and subject!="" and sampleStyle=2 and deletestatus=0 order by id desc');
while($quarData2=mysqli_fetch_array($qqq)){
?>
                          <option value="<?php echo encode($quarData2['id']); ?>" <?php if($quarData2['id'] == $styleId){ echo "selected"; } ?>><?php echo $quarData2['styleRefId']; ?></option>
                          <?php } ?>
                        </select>
                        </label>



                     <label>&nbsp;&nbsp;
                     <input name="" type="submit" id="" class="" value="search" style="text-transform: uppercase; background-color: #03c28d; color: #fff; width: 200px; cursor:pointer;"/>
                     </label>
                    <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
                  </form>
                </div>
              </div>
            </div>
            <form name="listform" id="listform" method="get">
              <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
              <div id="pageload">
                <div id="" >
                  <div class="datatable-scroll">

                    <table class="table table-bordered table-hover no-footer table-responsive">
                      <thead style="background-color: #f5f5f5; text-align:center;">
                        <tr role="row">
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style&nbsp;No</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Material&nbsp;Name</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Material&nbsp;Type</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Material&nbsp;Quantity</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" >Material&nbsp;Value</th>
                          <th class="sorting" style="width: 225px;" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Artwork&nbsp;Number</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" >CAD&nbsp;Given&nbsp;Date</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">CAD&nbsp;Approval&nbsp;Date</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Color&nbsp;Standard&nbsp;Approval</th>
                         <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Lab&nbsp;Dip/Strike&nbsp;off&nbsp;Submission</th>

                         <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Lab&nbsp;Dip/Strike&nbsp;off&nbsp;Final&nbsp;Approval</th>


                       </thead>
                       <tbody id="">
<?php
$no=1;
$select='*';
$where='';
$rs='';
$limit=clean($_GET['records']);
if($_GET['styleId']!=''){
    $styleid = 'and id="'.decode($_GET['styleId']).'"';
}

if($_GET['id']!=''){
    $id = 'and id="'.decode($_GET['id']).'"';
}


//$where='where  deletestatus=0 and sampleStyle="2" order by id desc';

$where='where subject!=""  '.$styleid.' '.$id.'  and deletestatus=0 and sampleStyle="2" order by id desc';


 $page=$_GET['page'];

//$targetpage=$fullurl.'loadstyle.php?module='.$modfile['moduleName'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&loginuserprofileId='.$loginuserprofileId.'&categoryId='.$_GET['categoryId'].'&';

 $targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&loginuserprofileId='.$loginuserprofileId.'&categoryId='.$_GET['categoryId'].'&';


$rs=GetRecordListJs($select,_QUERY_MASTER_,$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){


        $wherecountmaterial='styleId="'.$resultlists['id'].'" ';

    $rsb=GetPageRecord('*','techPackDetailMaster',$wherecountmaterial);

       while($resultlistss=mysqli_fetch_array($rsb)){




    $wherecountmaterials='id="'.$resultlistss['styleId'].'" ';
    $rscountmaterialcc=GetPageRecord('*','queryMaster',$wherecountmaterials);
    $rescountmaterialcc=mysqli_fetch_array($rscountmaterialcc);


$wherecountmaterials2='id="'.$resultlistss['stylesubtabid'].'" ';
$rscountmaterialcc2=GetPageRecord('*','styleSubCategoryMaster',$wherecountmaterials2);
$rescountmaterialcc2=mysqli_fetch_array($rscountmaterialcc2);


$wherecou='id="'.$rescountmaterialcc2['materialType'].'" ';
$rscou=GetPageRecord('*','materialTypeMaster',$wherecou);
$rescount=mysqli_fetch_array($rscou);


$wherecouc='styleId="'.$resultlists['id'].'" ';
$rscouc=GetPageRecord('*','styleColorDetailMaster',$wherecouc);
$rescountc=mysqli_fetch_array($rscouc);

$orderQty='';
							$size='';
							$totalMaterialQty = '0';

							$orderQty+=$rescountc['qty'];


							$totalMaterialQty =  $orderQty*$resultlistss['avgIncWastage'];
 $totalMaterialValue = $totalMaterialQty*$resultlistss['bomRate'];

?>

                           <tr>
                           <td><?php echo '#'. $rescountmaterialcc['styleRefId']; ?></td>
                           <td><?php echo $rescountmaterialcc2['name']; ?></td>
                           <td><?php echo $rescount['name']; ?></td>
                           <td><?php echo $totalMaterialQty; ?></td>
                           <td><?php echo round($totalMaterialValue,2); ?></td>
                           <td><?php echo $resultlistss['artworkno']; ?></td>
                           <td><?php echo $resultlistss['cadgivendate']; ?></td>
                           <td></td>
                           <td><?php echo $resultlistss['qualityapproveddate']; ?></td>

                           <td><?php echo $resultlistss['labdipdate']; ?></td>
                           <td><?php echo $resultlistss['labdiproundtwo']; ?></td>


                           </tr>
                           <?php } } ?>
                                           </tbody>
                    </table>
                    <div class="pagingdiv" style="width: 97%;margin: 20px auto;">
                      <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                          <tr>
                            <td><table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td style="padding-right:20px;"><?php echo $no; ?> entries</td>
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

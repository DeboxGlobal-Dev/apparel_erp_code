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
                 <a href="download-samplingrequestreceipt.php" class="btn bg-teal-400 addnotify" aria-expanded="false" style="background-color: #03d873b8;">Download Excel</a>

             </div>
             <div class="card">
           <div id="DataTables_Table_2_filter" class="dataTables_filter" style="margin: 0px; margin-top: 15px;">
              <div class="row" id="searchfilters">
                <!-- <div class="col-md-2">
                  <label>
              <input type="text" placeholder="Search:" name="filtersearch" id="filtersearch" onkeyup="filtersearch();"/>
                  </label>
                </div> -->
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
                        <select name="id" class="form-control" style="width:160px;">
                          <option value="">Select Material Name</option>
                          <?php
                          $qqq=GetPageRecord('*','styleSubCategoryMaster',  '1 GROUP BY name');
                          while($quarData2=mysqli_fetch_array($qqq)){
                          ?>
                         <option value="<?php echo encode($quarData2['id']); ?>"><?php echo $quarData2['name']; ?></option>
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
                          <th class="sorting" style="width: 225px;" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">GE&nbsp;-&nbsp;GRN&nbsp;Number</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" >GRN/Rceived</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Stock&nbsp;Transfer</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Transfer&nbsp;Requisition&nbsp;Number</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Issued&nbsp;Till&nbsp;Date</th>
                         <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">In&nbsp;Hand</th>

                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Transact</th>



                      </thead>
                       <tbody id="allhotellisting">
                        <?php
 $no=1;
 $select='*';
 $where='';
 $rs='';
 $wheresearch='';
 //$limit='20000';
 $limit=clean($_GET['records']);


 if($_GET['styleId']!=''){
 $styleid = 'and id="'.decode($_GET['styleId']).'"';
 }

  if($_GET['id']!=''){

  $id = decode($_GET['id']);
  $matid=GetPageRecord('*','styleSubCategoryMaster','id="'.$id.'"');
  $matids=mysqli_fetch_array($matid);

  $matname=GetPageRecord('*','queryMaster','1 and id="'.$matids['styleId'].'"');
  $matnames=mysqli_fetch_array($matname);
  $sid = 'and styleRefId="'.$matnames['styleRefId'].'"';

  }



  $where='where subject!="" '.$styleid.' '.$sid.'    and deletestatus=0 and sampleStyle="1" order by id desc';


 $page=$_GET['page'];

 //$targetpage=$fullurl.'loadstyle.php?module='.$modfile['moduleName'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&loginuserprofileId='.$loginuserprofileId.'&categoryId='.$_GET['categoryId'].'&';

 $targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&loginuserprofileId='.$loginuserprofileId.'&categoryId='.$_GET['categoryId'].'&';


 $rs=GetRecordListJs($select,_QUERY_MASTER_,$where,$limit,$page,$targetpage);
 $totalentry=$rs[1];
 $paging=$rs[2];
 while($resultlists=mysqli_fetch_array($rs[0])){

//  if($_GET['id']!=''){
// $where1=' and id="'.decode($_GET['id']).'"';
// }
$color=GetPageRecord('*','styleSubCategoryMaster','1 and styleId="'.$resultlists['id'].'"');
while($colorlist=mysqli_fetch_array($color)){


$color1=GetPageRecord('*','materialTypeMaster','1 and id="'.$colorlist['materialType'].'"');
$colorlist1=mysqli_fetch_array($color1);




							$rs12=GetPageRecord('*','styleColorDetailMaster','styleId="'.$resultlists['id'].'"');
							$result1=mysqli_fetch_array($rs12);

							$orderQty='';
							$size='';
							$totalMaterialQty = '0';

							$orderQty+=$result1['qty'];

				// 		    $rs1=GetPageRecord('*','styleSubCategoryMaster','styleId="'.$resultlists['id'].'" and costsheetVersionId="'.$resultlists['defaultcostsheetVersionId'].'" and materialType="'.$colorlist1['id'].'" and parentId=0 ');
				// 			$resListing1=mysqli_fetch_array($rs1);

							$rs121=GetPageRecord('*','techPackDetailMaster',' stylesubtabid="'.$colorlist['id'].'" and sectionType="bom" and styleId="'.$colorlist['styleId'].'" and costsheetVersionId="'.$resultlists['defaultcostsheetVersionId'].'" ');
							$resListing12=mysqli_fetch_array($rs121);

							$totalMaterialQty =  $orderQty*$resListing12['avgIncWastage'];
                              $totalMaterialValue = $totalMaterialQty*$resListing12['bomRate'];

?>
                        <tr role="row" class="odd" <?php if($resultlists['stylestatus']=='0'){ ?> style="background-color: #ff704359;" <?php } ?>>

                          <td align="center"><?php echo '#'. $resultlists['styleRefId']; ?>
                            </td>
                          <td align="center"><?php echo $colorlist['name']; ?></td>
                          <td align="center">
                              <?php echo $colorlist1['name']; ?>
                          </td>
                          <td align="center"><?php echo $totalMaterialQty; ?></td>
                          <td  align="center"><?php echo round($totalMaterialValue,2); ?></td>


                          <td align="center">

                          </td>

                          <td align="center">

                          </td>



                           <td align="center"></td>

                           <td align="center"></td>
                          <td align="center"></td>
                                                   <td align="center"></td>
                          <td align="center"></td>




                                              </tr>
                        <?php } $no++; } ?>
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

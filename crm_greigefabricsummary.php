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
                 <a href="download-fittracker.php" class="btn bg-teal-400 addnotify" aria-expanded="false" style="background-color: #03d873b8;">Download Excel</a>

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
                          <option value="">Select Style</option>
                          <?php
$qqq=GetPageRecord('*','queryMaster','1 and subject!="" and sampleStyle=1 and deletestatus=0 order by id desc');
while($quarData2=mysqli_fetch_array($qqq)){
?>
                          <option value="<?php echo encode($quarData2['id']); ?>" <?php if($quarData2['id'] == $styleId){ echo "selected"; } ?>><?php echo $quarData2['styleRefId']; ?></option>
                          <?php } ?>
                        </select>
                        </label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <label>
                        <select name="brandId" class="form-control">
                          <option value="">Select Brand</option>
                          <?php
$qqqr=GetPageRecord('*','brandMaster','1');
while($quarData1=mysqli_fetch_array($qqqr)){
?>
                          <option value="<?php echo encode($quarData1['id']); ?>" <?php if($quarData1['id'] == $brandId){ echo "selected"; } ?>><?php echo $quarData1['name']; ?></option>
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
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 50px; display:none;">SR#</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Requisition&nbsp;Number</th>
                                                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style&nbsp;Number</th>

                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Item</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Construction </th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Width</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" >Quantity</th>
                          <th class="sorting" style="width: 225px;" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Supplier</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" >Price</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Quantity&nbsp;Required</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Quantity&nbsp;Received</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">GRN&nbsp;No.</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Bill&nbsp;No.</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Bill&nbsp;Date</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Amount</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Debit&nbsp;Note&nbsp;No.</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Debit&nbsp;Note&nbsp;Date</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Debit&nbsp;No&nbsp;Amount</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Greige&nbsp;Allocation&nbsp;No.</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Allocation&nbsp;Date</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Allocation&nbsp;Quantity</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Allocated&nbsp;to&nbsp;Style</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Allocated&nbsp;to&nbsp;Brand</th>
                                                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Remarks</th>


                       <tbody id="allhotellisting">


                        <?php
$no=0;
$select='*';
$where='';
$rs='';
$wheresearch='';
//$limit='20000';
$limit=clean($_GET['records']);


$where='where 1 and brandId!=0 and seasonId!=0 order by id desc';
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&stylerefid='.$_GET['stylerefid'].'&';

$rs=GetRecordList($select,'greigeRequisition',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

$rrrr=GetPageRecord('name','brandMaster','id="'.$resultlists['brandId'].'"');
$brandData=mysqli_fetch_array($rrrr);
	$wherethis='1 and materialSubTypeId=31 order by id desc';
	$rss=GetPageRecord('name,id','materialMaster',$wherethis);
	while($resListing1s=mysqli_fetch_array($rss)){

	    $rrrrcc=GetPageRecord('*','grnMaster','requisitionNo="'.$resultlists['requisitionNo'].'"');
$brandDatacc=mysqli_fetch_array($rrrrcc);

$rrrrccx=GetPageRecord('*','greigeRequisition','parentId="'.$resultlists['id'].'"');
while($brandDataccx=mysqli_fetch_array($rrrrccx)){


     $rrrrccz=GetPageRecord('*','suppliersMaster','id="'.$brandDataccx['supplier'].'"');
$brandDataccz=mysqli_fetch_array($rrrrccz);


?>

                        <tr role="row" class="odd" <?php if($resultlists['stylestatus']=='0'){ ?> style="background-color: #ff704359;" <?php } ?>>

                          <td align="center" style="display:none;"><?php echo $resultlists['requisitionNo']; ?></td>
                          <td align="center"><?php echo $resultlists['requisitionNo']; ?></td>
                          <td><?php echo $resultlists['styleNo']; ?></td>
                          <td align="center"><?php echo stripslashes($resListing1s['name']); ?></td>
                          <td align="center"><?php echo $brandDataccx['construction']; ?>

                          </td>
                          <td align="center"><?php echo $brandDataccx['greWidth'] ?></td>
                          <td  align="center"><?php echo $brandDataccx['qty'];  ?></td>
<td><?php echo $brandDataccz['name'];  ?></td>

                          <td align="center">
<?php echo $brandDataccx['price'];  ?>
                          </td>

                          <td align="center">
<?php echo $brandDataccx['finalQty'];  ?>
                          </td>



                          <td align="center"><?php if(mysql_num_rows($ex) > '0') { echo date('d-m-Y',strtotime($exf['complitionDate'])); } ?></td>

                          <td align="center"><?php echo $brandDatacc['grnNo'];  ?></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          <?php
  $ex1=GetPageRecord('*','timeActionReport','1 and styleId="'.$resultlists['id'].'" and temid="'.$resultlists['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=9)');
                              $ex11=mysqli_fetch_array($ex1);
?>
                          <td align="center">
                            <?php if(mysql_num_rows($ex1) > '0') { echo date('d-m-Y',strtotime($ex11['complitionDate'])); } ?>

                          </td>
                          <?php
  $ex2=GetPageRecord('*','timeActionReport','1 and styleId="'.$resultlists['id'].'" and temid="'.$resultlists['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=9)');
                              $ex21=mysqli_fetch_array($ex2);
?>
                          <td align="center">
                            <?php if(mysql_num_rows($ex2) > '0') { echo date('d-m-Y',strtotime($ex21['actualDate'])); } ?>

                          </td>
                          <?php
  $ex3=GetPageRecord('*','timeActionReport','1 and styleId="'.$resultlists['id'].'" and temid="'.$resultlists['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=10)');
                              $ex31=mysqli_fetch_array($ex3);
?>
                          <td align="center">
                            <?php if(mysql_num_rows($ex3) > '0') { echo date('d-m-Y',strtotime($ex31['complitionDate'])); } ?>

                          </td>
                          <?php
  $ex4=GetPageRecord('*','timeActionReport','1 and styleId="'.$resultlists['id'].'" and temid="'.$resultlists['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=10)');
                              $ex41=mysqli_fetch_array($ex4);
?>
                          <td align="center">
                            <?php if(mysql_num_rows($ex4) > '0') { echo date('d-m-Y',strtotime($ex41['actualDate'])); } ?>

                          </td>

                          <td></td>
                          <td></td>
                          <?php
  $ex5=GetPageRecord('*','timeActionReport','1 and styleId="'.$resultlists['id'].'" and temid="'.$resultlists['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=11)');
                              $ex51=mysqli_fetch_array($ex5);
?>
                          <td align="center">
                            <?php if(mysql_num_rows($ex5) > '0') { echo date('d-m-Y',strtotime($ex51['complitionDate'])); } ?>

                          </td>
                          <?php
  $ex6=GetPageRecord('*','timeActionReport','1 and styleId="'.$resultlists['id'].'" and temid="'.$resultlists['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=11)');
                              $ex61=mysqli_fetch_array($ex6);
?>
                          <td align="center">
                            <?php if(mysql_num_rows($ex6) > '0') { echo date('d-m-Y',strtotime($ex61['actualDate'])); } ?>

                          </td>

                          <?php
  $ex7=GetPageRecord('*','timeActionReport','1 and styleId="'.$resultlists['id'].'" and temid="'.$resultlists['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=20)');
                              $ex71=mysqli_fetch_array($ex7);
?>
                          <td align="center">
                            <?php if(mysql_num_rows($ex7) > '0') { echo date('d-m-Y',strtotime($ex71['actualDate'])); } ?>

                          </td>

                          <?php
  $ex8=GetPageRecord('*','timeActionReport','1 and styleId="'.$resultlists['id'].'" and temid="'.$resultlists['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=21)');
                              $ex81=mysqli_fetch_array($ex8);
?>
                          <td align="center">
                            <?php if(mysql_num_rows($ex8) > '0') { echo date('d-m-Y',strtotime($ex81['complitionDate'])); } ?>

                          </td>





                                              </tr>


                                              <?php  }  } } ?>

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

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
$styleId=$_GET['styleId'];
$materialType=$_GET['materialtype'];
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
                <form action="" method="GET">

                  <div class="row">
                 <div class="col-md-2">
                      <div class="form-group">
                        <input type="text" placeholder="Search:" name="filtersearch" id="filtersearch" style="margin-left: 0px; width: 190px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;"/>
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
                          <option value="<?php echo $quarData2['id']; ?>" <?php if($quarData2['id'] == $styleId){ echo "selected"; } ?>>#<?php echo $quarData2['styleRefId']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <select name="materialtype" class="form-control">
                          <option value="">Select Material Type</option>
                          <option value="1" <?php if($materialType == 1){ echo "selected"; } ?>>Fabric</option>
                          <option value="2" <?php if($materialType == 2){ echo "selected"; } ?>>Trims</option>
                          <option value="3" <?php if($materialType == 3){ echo "selected"; } ?>>Packaging</option>
                        </select>
                      </div>
                    </div>

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
            <table class="table table-bordered table-responsive capacity-class" style="width:100%;">
            <thead>
                <tr style="background-color: #e9fff8;">




                  <th><div align="center">Item&nbsp;Name</div></th>
                  <th><div align="center">Color</div></th>
                  <th><div align="center">Supplier</div></th>
                  <th><div align="center">Material&nbsp;Required</div></th>
                  <th><div align="center">Material&nbsp;Booked</div></th>
                  <th><div align="center">GRN/Received</div></th>

                  <th><div align="center">PO Number</div></th>


                              </tr>
              </thead>
<?php

$queryDataq=GetPageRecord('*','queryMaster','1 and subject!="" and deletestatus=0 order by id desc');
while($queryData=mysqli_fetch_array($queryDataq)){
  $costversion = $queryData['defaultcostsheetVersionId'];


$select='*';
 if($styleId!=''){
      $stylestatus = 'and styleId="'.$styleId.'"';
    }

    if($materialType!=''){
      $material = 'and materialType="'.$materialType.'"';
    }

$where='where 1 and costsheetVersionId="'.$costversion.'" and styleId="'.$queryData['id'].'" and parentId=0 '.$stylestatus.' '.$material.' order by sr asc';
$page=$_GET['page'];
$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&stylerefid='.$_GET['stylerefid'].'&';

$rs=GetRecordList($select,'styleSubCategoryMaster',$where,'10',$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($subcatData=mysqli_fetch_array($rs[0])) {



  $rs12=GetPageRecord('*','purchaseOrderStyleMaster','styleId="'.$subcatData['styleId'].'" and sectionType=0 order by id asc');
              while($result1=mysqli_fetch_array($rs12)){

                $orderQty='';
              $totalMaterialQty = '0';


                $purchaseDataq=GetPageRecord('*','purchaseOrderStyleMaster','parentId="'.$result1['id'].'"');
              while($purchaseData=mysqli_fetch_array($purchaseDataq)){
                $color = $purchaseData['color'];
                $orderQty+=$purchaseData['gdQty'];
                $orderQty = round($orderQty);
              }
               $materialtypeq=GetPageRecord('*','materialTypeMaster','1 and id="'.$subcatData['materialType'].'"');
               $materialtype=mysqli_fetch_array($materialtypeq);

              $grnDataq=GetPageRecord('sum(netReceived) as netReceivedTill,parentId','grnMaster',' materialId="'.$subcatData['id'].'" and styleId="'.$subcatData['styleId'].'" and color="'.$color.'"');
              $grnData=mysqli_fetch_array($grnDataq);
              $grndatacount=mysql_num_rows($grnDataq);


              $grnDataqq=GetPageRecord('*','grnMaster','id="'.$grnData['parentId'].'"');
              $grnDataq=mysqli_fetch_array($grnDataqq);
              $grncount=mysql_num_rows($grnDataqq);

              if($subcatData['materialType']==1){
$lotWiseDataFabricq=GetPageRecord('sum(acceptedField) as totalacceptedField','lotWiseData','1 and styleId="'.$subcatData['styleId'].'" and materialid="'.$subcatData['id'].'" and colorid="'.$color.'"');
$lotWiseDataFabric=mysqli_fetch_array($lotWiseDataFabricq);
$inspectedQty=$lotWiseDataFabric['totalacceptedField'];
        }
        if($subcatData['materialType']==2){
$qualityreportmasterDataq=GetPageRecord('sum(accepted) as totalaccepted','qualityreportmaster','1 and styleId="'.$subcatData['styleId'].'" and type="triminspectioninput" and materialid="'.$subcatData['id'].'" and colorid="'.$color.'"');
$qualityreportmasterData=mysqli_fetch_array($qualityreportmasterDataq);
$inspectedQty=$qualityreportmasterData['totalaccepted'];
        }
        if($subcatData['materialType']==3){

$packagingqualityreportmasterDataq=GetPageRecord('sum(accepted) as totalaccepted','packagingqualityreportmaster','1 and styleId="'.$subcatData['styleId'].'" and type="packagingtriminspectioninput" and materialid="'.$subcatData['id'].'" and colorid="'.$color.'"');
$packagingqualityreportmasterData=mysqli_fetch_array($packagingqualityreportmasterDataq);
$inspectedQty=$packagingqualityreportmasterData['totalaccepted'];

        }

              $techPackDataq=GetPageRecord('*','techPackDetailMaster',' stylesubtabid="'.$subcatData['id'].'" and sectionType="bom" and styleId="'.$subcatData['styleId'].'" and costsheetVersionId="'.$costversion.'" order by id asc');
              $techPackData=mysqli_fetch_array($techPackDataq);

              $totalallowance=0;
              $rspro=GetPageRecord('*','rejectioninproductionmaster','1 and qty>'.$orderQty.'');
              $resultpro=mysqli_fetch_array($rspro);
              $totalallowance = $resultpro['totalallwance'];
              $orderQty = round($orderQty+(($orderQty*$totalallowance)/100));

              $totalMaterialQty =  round($orderQty*$techPackData['avgIncWastage'],3);


                if($subcatData['sizeSeparate']==0){



?>
            <tbody id="allhotellisting">
                <tr>



                  <td><div align="left"><?php echo $subcatData['name'] ?></div></td>
                  <td><div align="center"><?php
                  $rs11=GetPageRecord('name','colorCardMaster','id="'.$color.'"');
                $resListing11=mysqli_fetch_array($rs11);
                  echo $colorarr = rtrim($resListing11['name'],',');
                   ?></div></td>
                  <td><div align="center"><?php if($grncount > 0){ echo getSupplierName($grnDataq['supplierId']); } else { echo '-'; } ?></div></td>
                  <td><div align="center">
                    <?php if($totalMaterialQty != ""){ echo $a = $totalMaterialQty; } else { echo "-"; } ?></div></td>
                  <td><div align="center"><?php if($grndatacount > 0){ echo round($grnData['netReceivedTill'],3); } else { echo '-'; } ?></div></td>
                  <td><div align="center"><?php if($grndatacount > 0){ echo round($grnData['netReceivedTill'],3); } else { echo '-'; } ?></div></td>

                  <td><div align="center"><?php if($totalMaterialQty != "-"){ echo round($a-$b) ; } else { echo "-"; } ?></div></td>



                </tr>
                </tbody>

                <?php
                 }
               }
               }
                  }  ?>
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

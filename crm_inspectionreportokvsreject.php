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
          <div class="card-header header-elements-inline bg-blue-700" style="padding:10px;">
          <div class="col-xl-9">
          <h5 class="card-title"><?php echo $pageName; ?></h5>
          </div>
          <div class="col-xl-1" style="padding-right: 0px;"> </div>
          <a href="download-inspectionreportokvsreject.php" class="btn bg-teal-400 addnotify" aria-expanded="false" style="background-color: #03d873b8;">Download Excel</a>
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



                  <th><div align="center">Buyer</div></th>
                  <th><div align="center">Brand</div></th>
                  <th><div align="center">Style</div></th>
                  <th><div align="center">Inspection&nbsp;Type</div></th>
                  <th><div align="center">GRN Number</div></th>
                  <th><div align="center">Supplier&nbsp;PO&nbsp;Number</div></th>
                  <th><div align="center">Supplier&nbsp;Name</div></th>
                  <th><div align="center">Material&nbsp;Name</div></th>
                  <th><div align="center">Color</div></th>
                  <th><div align="center">Lot&nbsp;No</div></th>
                  <th><div align="center">Lot&nbsp;Quantity</div></th>
                  <th><div align="center">Inspected&nbsp;Quantity</div></th>
                  <th><div align="center">Accepted</div></th>
                  <th><div align="center">Rejected</div></th>
                  <th><div align="center">Re-Processing</div></th>
                  <th><div align="center">OnHold</div></th>
                  <th><div align="center">Inspection&nbsp;Date</div></th>


                  </tr>
                  </thead>
<?php

$grnDataq=GetPageRecord('*','grnMaster','1 and parentId in (select id from grnMaster where grnNo!="") and materialId in (select id from styleSubCategoryMaster where materialType=1) order by id');
$lotNo=mysql_num_rows($grnDataq);

$grnDataq1=GetPageRecord('*','grnMaster','1 and parentId in (select id from grnMaster where grnNo!="") and materialId in (select id from styleSubCategoryMaster where materialType=2) order by id');
$lotNo1=mysql_num_rows($grnDataq1);

$grnDataq2=GetPageRecord('*','grnMaster','1 and parentId in (select id from grnMaster where grnNo!="") and materialId in (select id from styleSubCategoryMaster where materialType=3) order by id');
$lotNo2=mysql_num_rows($grnDataq2);

 $select='*';
 if($styleId!=''){
      $stylestatus = 'and styleId="'.$styleId.'"';
    }

   if($materialType!=''){
      $material = 'and materialId in (select id from styleSubCategoryMaster where materialType="'.$materialType.'")';
    }

$where='where 1 and parentId in (select id from grnMaster where grnNo!="") and materialId in (select id from styleSubCategoryMaster where materialType=1 or materialType=2 or materialType=3) '.$material.' '.$stylestatus.' order by id desc';

$page=$_GET['page'];
$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&stylerefid='.$_GET['stylerefid'].'&';

$rs=GetRecordList($select,'grnMaster',$where,'13',$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
$countgrn=mysql_num_rows($rs[0]);
if($countgrn>0){
$lotNor=0;
$lotNor1=0;
$lotNor2=0;
while($grnData=mysqli_fetch_array($rs[0])) {
 //$lotNor++;


            $grnParentDataq=GetPageRecord('*','grnMaster','1 and id="'.$grnData['parentId'].'"');
            $grnParentData=mysqli_fetch_array($grnParentDataq);

            $materialDataq=GetPageRecord('*','styleSubCategoryMaster','id="'.$grnData['materialId'].'"');
            $materialData=mysqli_fetch_array($materialDataq);

            $queryDataq=GetPageRecord('*','queryMaster','id="'.$grnData['styleId'].'"');
            $queryData=mysqli_fetch_array($queryDataq);

            $minsqty=GetPageRecord('*','loadmaintenanceinspectioninput','1');
            $minsqty=mysqli_fetch_array($minsqty);


            $rl=GetPageRecord('*','packagingqualityreportmaster',' styleId="'.decode($grnData['styleid']).'"');
            $trimData=mysqli_fetch_array($rl);

//          $grnDataq=GetPageRecord('*','grnMaster','1 and styleId="'.$grnData['styleId'].'"  and parentId in (select id from grnMaster where grnNo!="") and materialId in (select id from styleSubCategoryMaster where materialType=1)order by id');
// 			$countgrn=mysql_num_rows($grnDataq);
// 			if($countgrn>0){
// 			$lotNor=0;
// 			while($grnData=mysqli_fetch_array($grnDataq)){
// 			++$lotNor;


    if($materialData['materialType'] == 1){
    $lot=$lotNo;

     $k=GetPageRecord('*','qualitymodulemaster','1 and styleId="'.$grnData['styleId'].'" and lotNoMaster="'.$lot.'"');
     $lotData=mysqli_fetch_array($k);

    $lotNameDataq=GetPageRecord('*','lotMaster','1 and id="'.$grnData['styleId'].'" and id="'.$lotNor.'"');
    $lotNameData=mysqli_fetch_array($lotNameDataq);

     //  $lotResultq=GetPageRecord('*','lotWiseData','1  and lotId="'.$lotNor.'"');
     //  $lotResult=mysqli_fetch_array($lotResultq);

     // $chk=$grnData['styleId'];

     $lotNor++;


     $lotResultq=GetPageRecord('*','lotWiseData','1  and styleId="'.$grnData['styleId'].'" and lotId="'.$lotNor.'"');
     $lotResult=mysqli_fetch_array($lotResultq);

     $rsgrnSupplier=GetPageRecord('sum(received) as totalReceived,orderQty,sum(netReceived) as totalnetReceived','grnMaster','styleId="'.$grnData['styleId'].'" and parentId="'.$grnParentData['id'].'" and materialId="'.$grnData['materialId'].'" and color="'.$grnData['color'].'"');
     $rsgrnSupplierName=mysqli_fetch_array($rsgrnSupplier);

      }

    if($materialData['materialType'] == 2){
    $lot1=$lotNo1;

    $rl=GetPageRecord('*','qualityreportmaster','1 and styleId="'.$grnData['styleId'].'" and type="triminspectioninput" and lotId="'.$lot1.'"');
    $lotData=mysqli_fetch_array($rl);
    $lotNor1++;

    $lotResultq=GetPageRecord('*','grnMaster','1  and styleId="'.$grnData['styleId'].'"');
    $lotResultss=mysqli_fetch_array($lotResultq);

    $rsgrnSuppliert=GetPageRecord('sum(received) as totalReceived,orderQty,sum(netReceived) as totalnetReceived','grnMaster','styleId="'.$grnData['styleId'].'" and parentId="'.$grnParentData['id'].'" and materialId="'.$grnData['materialId'].'" and color="'.$grnData['color'].'" ORDER BY id Asc');
    $rsgrnSupplierName2=mysqli_fetch_array($rsgrnSuppliert);

    $trimDataq=GetPageRecord('sum(inspectionqty) as totalinspection, sum(okayqty) as totalokayqty,sum(rejectedqty) as totalrejectedqty,sum(disputedqty) as totaldisputeqty','trimdatamaster','1 and styleId="'.$grnData['styleId'].'" and costsheetVersionId=1 and status=1 and deletestatus=0 and lotNoMaster="'.$lotNor1.'"');
    $trimDataqq=mysqli_fetch_array($trimDataq);

    }

  if($materialData['materialType'] == 3){
  $lot2=$lotNo2;
  $rsgrnSupplier=GetPageRecord('sum(received) as totalReceived,orderQty,sum(netReceived) as totalnetReceived','grnMaster','styleId="'.$grnData['styleId'].'" and parentId="'.$grnParentData['id'].'" and materialId="'.$grnData['materialId'].'" and color="'.$grnData['color'].'"');
  $rsgrnSupplierName=mysqli_fetch_array($rsgrnSupplier);




  $rl=GetPageRecord('*','packagingqualityreportmaster','1 and styleId="'.$grnData['styleId'].'" and type="packagingtriminspectioninput"');
  $trimData=mysqli_fetch_array($rl);
  $lotNor2++;


  $packagingDataq=GetPageRecord('sum(inspectionqty) as totalinspection,sum(okayqty) as totalokayqty,sum(rejectedqty) as totalrejectedqty,sum(disputedqty) as totaldisputeqty','packagaingtrimdatamaster','1 and styleId="'.$grnData['styleId'].'" and costsheetVersionId=1 and status=1 and deletestatus=0 and lotNoMaster="'.$lotNor2.'"');
  $packagingDataqq=mysqli_fetch_array($packagingDataq);


}

?>
                  <tbody id="allhotellisting">
                  <tr>


                  <td><div align="center"><?php echo getBuyerName($queryData['buyerId']); ?></div></td>
                  <td><div align="center"><?php echo getbrandName($queryData['brandId']); ?></div></td>
                  <td><div align="center">#<?php echo getStyleRefId($grnData['styleId']); ?></div></td>
                  <td><div align="center">
                    <?php
                    if($materialData['materialType'] == 1){ echo "Fabric"; }
                    if($materialData['materialType'] == 2){ echo "Trims"; }
                    if($materialData['materialType'] == 3){ echo "Packaging"; }
                     ?>
                  </div></td>
                  <td><div align="center"><?php echo $grnParentData['grnNo']; ?></div></td>
                  <td><div align="center"><?php echo $grnData['supplierPurchaseOrderId']; ?></div></td>
                  <td><div align="center"><?php echo getSupplierName($grnParentData['supplierId']); ?></div></td>
                  <td><div align="center"><?php echo $materialData['name']; ?></div></td>
                  <td><div align="center"><?php
                  $rs112=GetPageRecord('name','colorCardMaster','id="'.$grnData['color'].'"');
                  $resListing112=mysqli_fetch_array($rs112);
                  echo $resListing112['name'];
                  ?></div></td>


                  <td>


                    <?php if($materialData['materialType'] == 1){ echo $lotNor; }?>
                    <?php if($materialData['materialType'] == 2){ echo $lotNor1; } ?>
                    <?php if($materialData['materialType'] == 3){ echo $lotNor2; } ?>

                    </td>

                    <td><div align="center">
                        <?php //echo $rsgrnSupplierName['totalnetReceived']; ?>

                    <?php if($materialData['materialType'] == 1){ echo $rsgrnSupplierName['totalnetReceived']; }  ?>
                    <?php if($materialData['materialType'] == 2){ echo $rsgrnSupplierName2['totalnetReceived']; } ?>
                    <?php if($materialData['materialType'] == 3){ echo $rsgrnSupplierName['totalnetReceived']; } ?>

                    </div></td>


                    <td><?php if($materialData['materialType'] == 1){ echo $lotResult['totalinspectedqty']; }  ?>
                    <?php if($materialData['materialType'] == 2){ echo $trimDataqq['totalinspection']; } ?>
                    <?php if($materialData['materialType'] == 3){ echo $packagingDataqq['totalinspection']; } ?></td>
                    <td><div align="center">
                    <?php if($materialData['materialType'] == 1){ echo $lotResult['acceptedField']; }  ?>
                    <?php if($materialData['materialType'] == 2){ echo $trimDataqq['totalokayqty']; } ?>
                    <?php if($materialData['materialType'] == 3){ echo $packagingDataqq['totalokayqty']; } ?>

                    </div></td>
                    <td><div align="center">
                    <?php if($materialData['materialType'] == 1){ echo $lotResult['rejectedField']; } ?>
                    <?php if($materialData['materialType'] == 2){ echo $trimDataqq['totalrejectedqty']; } ?>
                    <?php if($materialData['materialType'] == 3){ echo $packagingDataqq['totalrejectedqty']; } ?>
                    </div></td>
                    <td><div align="center">
                    <?php if($materialData['materialType'] == 1){ echo $lotResult['reprocessingField']; } ?>
                    <?php if($materialData['materialType'] == 2){ echo $trimDataqq['totaldisputeqty']; } ?>
                    <?php if($materialData['materialType'] == 3){ echo $packagingDataqq['totaldisputeqty']; } ?>
                    </div></td>
                    <td><div align="center">
                    <?php if($materialData['materialType'] == 1){ echo $lotResult['onholdField']; } ?>
                    <?php if($materialData['materialType'] == 2){ echo $trimDataqq['totaldisputeqty']; } ?>
                    <?php if($materialData['materialType'] == 3){ echo $packagingDataqq['totaldisputeqty']; } ?>

                    </div></td>
                    <td><div align="center"><?php if($lotResult['inspectedDate']!="" && $lotResult['inspectedDate']!="0000-00-00" && $lotResult['inspectedDate']!="1970-01-01" && $materialData['materialType'] == 1){ echo date('d-m-Y',strtotime($lotResult['inspectedDate'])); } ?>
                    <?php if($lotData['closurDate']!="" && $lotData['closurDate']!="0000-00-00" && $lotData['closurDate']!="1970-01-01" && $materialData['materialType'] == 2){ echo date('d-m-Y',strtotime($lotData['closurDate'])); } ?>
                    <?php if($packagingDataqq['inspectiondate']!="" && $packagingDataqq['inspectiondate']!="0000-00-00" && $packagingDataqq['inspectiondate']!="1970-01-01" && $materialData['materialType'] == 3){ echo date('d-m-Y',strtotime($packagingDataqq['inspectiondate'])); } ?>
                    </div>
                    </td>


                    </tr>
                    </tbody>

                <?php
               if($materialData['materialType'] == 1){ $lotNo--; }
                if($materialData['materialType'] == 2){ $lotNo1--; }
                if($materialData['materialType'] == 3){ $lotNo2--; }
                 } } ?>
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

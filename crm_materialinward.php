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

             <div class="page-content">
             <div class="content-wrapper">
            <?php include "savealert.php"; ?>
            <div class="content pt-0" style="margin-top:20px;">
            <div class="row">
            <div class="col-xl-12">
            <div class="card-header header-elements-inline bg-blue-700 filterable" style="padding: 10px;">
            <div class="col-xl-9">
            <h5 class="card-title"><?php echo $pageName; ?></h5>
            </div>
            <div class="col-xl-1" style="padding-right: 0px;"> </div>

            <a href="download-materialinward.php" class="btn bg-teal-400 addnotify" aria-expanded="false" style="    background-color: #03d873b8;"> Download Excel</a>



                      </div>
                      <div class="card">
                      <div id="DataTables_Table_2_filter" class="dataTables_filter">
                      <div class="row specialclass">
                  <form action="" method="get">
                  <div class="col-md-12" style="padding:0px;">
				  <label>
                    <input type="text" placeholder="Search:" name="filtersearch" id="filtersearch" style="margin-left: 0px; width: 190px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;"/>
                    </label>
                    <label>
                    <input type="text" class="datepick" placeholder="GRN Date" name="fromDate" id="fromDate" value="<?php if($_GET['fromDate']!=''){ echo date('d-m-Y',strtotime($_GET['fromDate'])); } ?>" style="margin-left: 0px; width: 190px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;" readonly />
                    </label>
					<label>
                     <input type="text" class="datepick" placeholder="GE Date" name="toDate" id="toDate" value="<?php if($_GET['toDate']!=''){ echo date('d-m-Y',strtotime($_GET['toDate'])); } ?>" style="margin-left: 0px; width: 190px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;" readonly="readonly" />
                     </label>


                      <label>
                     <input name="" type="submit" id="" class="" value="search" style="text-transform: uppercase; background-color: #03c28d; color: #fff; width: 200px; cursor:pointer; margin:0px !important;;"/>
                    </label>
                    <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
                  </div>
                </form>
                </div>
                </div>
                   <form name="listform" id="listform" method="get">
                   <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
                   <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                   <div class="datatable-scroll">

                    <table class="table table-bordered capacity-class" style="width:100%;">
         		    <thead>
                            <tr style="background-color: #e9fff8;">
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Brand</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style#</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Material Name</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Quantity Ordered</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Quantity Received</th>

							 <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Supplier </th>
							 <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">GE Number </th>
							 <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">GE Date </th>
							 <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">GRN Number </th>
							 <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">GRN Date  </th>
                             </tr>
                             </thead>
                             <tbody id="allhotellisting">
  <?php

if($_POST['stylerefid']!=''){
$stylerefCondition = 'and id="'.decode($_POST['stylerefid']).'"';
}

$bd=GetPageRecord('*','queryMaster','1 and subject!="" '.$stylerefCondition.' and deletestatus=0 and sampleStyle=1 and poAttachment!="" order by id desc');
while($queryData=mysqli_fetch_array($bd)){

$rsqty=GetPageRecord('qtyTotal','buyerPurchaseOrderMaster','styleId="'.$queryData['id'].'"');
$resultqty=mysqli_fetch_array($rsqty);

$tnadata="";
$tnadataaaaa="";
$tnadataq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$queryData['id'].'" and taskListId in (select id from taskListMaster where name in (select id from tnaActivityMaster where name="Ex-Factory Start Date")) order by id');
$tnadata=mysqli_fetch_array($tnadataq);

$tnadataaaaaq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$queryData['id'].'" and taskListId in (select id from taskListMaster where name in (select id from tnaActivityMaster where name="Ex-Factory End Date")) order by id');
$tnadataaaaa=mysqli_fetch_array($tnadataaaaaq);


$id=$queryData['id'];

// $materialType=decode($_GET['materialType']);
// $styleDataq=GetPageRecord('styleRefId,sampleStyle','queryMaster','1 and id="'.$id.'"');
// $styleData=mysqli_fetch_array($styleDataq);
// $matListDataq=GetPageRecord('name','materialTypeMaster','1 and id="'.$materialType.'"');
// $matListData=mysqli_fetch_array($matListDataq);

 $sr=1;
				 $gateEntryno='';
				 $rsListDatassq=GetPageRecord('*','grnMaster','1 and styleId="'.$id.'" and materialid in ( select id from styleSubCategoryMaster where materialType="1") group by color,materialId');
				 while($rsListDatass=mysqli_fetch_array($rsListDatassq)){


						 	$where2='styleId="'.$id.'" and materialType="1" and id="'.$rsListDatass['materialId'].'"';
				$rs2=GetPageRecord('*','styleSubCategoryMaster',$where2);
				while($matData=mysqli_fetch_array($rs2))
				{

				  $tsq=GetPageRecord('bomPlacement,storesupplier,supplierartname,bomAvg','techPackDetailMaster','1 and stylesubtabid='.$matData['id'].' order by id asc');
    	         $techShellData=mysqli_fetch_array($tsq);

    	       $rsd=GetPageRecord('*','grnMaster','1  and styleId="'.$queryData['styleId'].'"');
               $operationData3=mysqli_fetch_array($rsd);

               	$rsgrnrec=GetPageRecord('sum(netReceived) as netReceivedTill,color,parentId','grnMaster','styleId="'.$id.'" and materialId="'.$rsListDatass['materialId'].'" and color="'.$rsListDatass['color'].'"');
				$rsgrnrecTill=mysqli_fetch_array($rsgrnrec);

				$rsd=GetPageRecord('*','gateentrymaster','1  and registerno="Fabric"');
                $operationD=mysqli_fetch_array($rsd);

				?>

                                <tr>

                                <tr role="row" class="odd">
							    <td><?php echo getBrandName($queryData['brandId']); ?></td>
							    <td><?php echo $queryData['styleRefId'];?></td>





							<!--<td></td> -->

							 <td><?php echo $matData['name'];?></td>
							 <td><?php echo $resultqty['qtyTotal']; ?></td>
							 <td><?php echo round($rsgrnrecTill['netReceivedTill'],2); ?></td>



							 <td><?php echo getsupplierCompany($techShellData['storesupplier']); ?></td>
							 <td><?php
					$rsgrndata=GetPageRecord('*','grnMaster','styleId="'.$id.'" and materialId="'.$rsListDatass['materialId'].'" and color="'.$rsListDatass['color'].'"');
					while($rsgrndatalist=mysqli_fetch_array($rsgrndata)){
					$rsgrnno=GetPageRecord('gateEntryNo,grnNo','grnMaster','id="'.$rsgrndatalist['parentId'].'"');
					$rsgrnnolist=mysqli_fetch_array($rsgrnno);
					?>
                    <span style="font-weight:600; color:#00CC33;"><?php echo makeQueryId($rsgrnnolist['gateEntryNo']); ?></span>
                    <?php } ?>
                    </td>
							 <td><?php echo date('d-m-Y',strtotime($operationD['entrydate'])); ?></td>
							 <td><?php
					$rsgrndata=GetPageRecord('*','grnMaster','styleId="'.$id.'" and materialId="'.$rsListDatass['materialId'].'" and color="'.$rsListDatass['color'].'"');
					while($rsgrndatalist=mysqli_fetch_array($rsgrndata)){
					$rsgrnno=GetPageRecord('gateEntryNo,grnNo, docDate', 'grnMaster','id="'.$rsgrndatalist['parentId'].'"');
					$rsgrnnolist=mysqli_fetch_array($rsgrnno);
					?>
       <span style="font-weight:600; color: #0033FF;"><?php echo $rsgrnnolist['grnNo']; ?></span>
                    <?php } ?>
                    </td>


							 <td><?php if($rsgrnnolist['docDate']!=''){ echo date('d-m-Y',strtotime($rsgrnnolist['docDate'])); }else{ echo '-'; } ?></td>

						     </tr>
                            <?php } } } ?>

                              <?php

if($_POST['stylerefid']!=''){
$stylerefCondition = 'and id="'.decode($_POST['stylerefid']).'"';
}

$bd=GetPageRecord('*','queryMaster','1 and subject!="" '.$stylerefCondition.' and deletestatus=0 and sampleStyle=1 and poAttachment!="" order by id desc');
while($queryData=mysqli_fetch_array($bd)){

$rsqty=GetPageRecord('qtyTotal','buyerPurchaseOrderMaster','styleId="'.$queryData['id'].'"');
$resultqty=mysqli_fetch_array($rsqty);

$tnadata="";
$tnadataaaaa="";
$tnadataq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$queryData['id'].'" and taskListId in (select id from taskListMaster where name in (select id from tnaActivityMaster where name="Ex-Factory Start Date")) order by id');
$tnadata=mysqli_fetch_array($tnadataq);

$tnadataaaaaq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$queryData['id'].'" and taskListId in (select id from taskListMaster where name in (select id from tnaActivityMaster where name="Ex-Factory End Date")) order by id');
$tnadataaaaa=mysqli_fetch_array($tnadataaaaaq);


$id=$queryData['id'];

// $materialType=decode($_GET['materialType']);

// $styleDataq=GetPageRecord('styleRefId,sampleStyle','queryMaster','1 and id="'.$id.'"');
// $styleData=mysqli_fetch_array($styleDataq);

// $matListDataq=GetPageRecord('name','materialTypeMaster','1 and id="'.$materialType.'"');
// $matListData=mysqli_fetch_array($matListDataq);

 $sr=1;
				 $gateEntryno='';
				 $rsListDatassq=GetPageRecord('*','grnMaster','1 and styleId="'.$id.'" and materialid in ( select id from styleSubCategoryMaster where materialType="2") group by color,materialId');
				 while($rsListDatass=mysqli_fetch_array($rsListDatassq)){


				$where2='styleId="'.$id.'" and materialType="2" and id="'.$rsListDatass['materialId'].'"';
				$rs2=GetPageRecord('*','styleSubCategoryMaster',$where2);
				while($matData=mysqli_fetch_array($rs2))
				{

				  $tsq=GetPageRecord('bomPlacement,storesupplier,supplierartname,bomAvg','techPackDetailMaster','1 and stylesubtabid='.$matData['id'].' order by id asc');
    	         $techShellData=mysqli_fetch_array($tsq);

    	         $rsd=GetPageRecord('*','grnMaster','1  and styleId="'.$queryData['styleId'].'"');
               $operationData3=mysqli_fetch_array($rsd);

               	$rsgrnrec=GetPageRecord('sum(netReceived) as netReceivedTill,color,parentId','grnMaster','styleId="'.$id.'" and materialId="'.$rsListDatass['materialId'].'" and color="'.$rsListDatass['color'].'"');
				$rsgrnrecTill=mysqli_fetch_array($rsgrnrec);

				$rsd=GetPageRecord('*','gateentrymaster','1  and registerno="Trim"');
               $operationD=mysqli_fetch_array($rsd);

						?>

                                <tr>

                                <tr role="row" class="odd">
							    <td><?php echo getBrandName($queryData['brandId']); ?></td>
							    <td><?php echo $queryData['styleRefId'];?></td>





							<!--<td></td> -->

							 <td><?php echo $matData['name'];?></td>
							 <td><?php echo $resultqty['qtyTotal']; ?></td>
							 <td><?php echo round($rsgrnrecTill['netReceivedTill'],2); ?></td>



							 <td><?php echo getsupplierCompany($techShellData['storesupplier']); ?></td>
							 <td><?php
					$rsgrndata=GetPageRecord('*','grnMaster','styleId="'.$id.'" and materialId="'.$rsListDatass['materialId'].'" and color="'.$rsListDatass['color'].'"');
					while($rsgrndatalist=mysqli_fetch_array($rsgrndata)){
					$rsgrnno=GetPageRecord('gateEntryNo,grnNo,docDate', 'grnMaster','id="'.$rsgrndatalist['parentId'].'"');
					$rsgrnnolist=mysqli_fetch_array($rsgrnno);
					?>
                    <span style="font-weight:600; color:#00CC33;"><?php echo makeQueryId($rsgrnnolist['gateEntryNo']); ?></span>
                    <?php } ?>
                    </td>
					<td><?php echo date('d-m-Y',strtotime($operationD['entrydate'])); ?></td>
					<td><?php
					$rsgrndata=GetPageRecord('*','grnMaster','styleId="'.$id.'" and materialId="'.$rsListDatass['materialId'].'" and color="'.$rsListDatass['color'].'"');
					while($rsgrndatalist=mysqli_fetch_array($rsgrndata)){
					$rsgrnno=GetPageRecord('gateEntryNo,grnNo,docDate','grnMaster','id="'.$rsgrndatalist['parentId'].'"');
					$rsgrnnolist=mysqli_fetch_array($rsgrnno);
					?>
                    <span style="font-weight:600; color: #0033FF;"><?php echo $rsgrnnolist['grnNo']; ?></span>
                    <?php } ?>
                    </td>


							 <td><?php if($rsgrnnolist['docDate']!=''){ echo date('d-m-Y',strtotime($rsgrnnolist['docDate'])); }else{ echo '-'; } ?></td>

						     </tr>
                            <?php } } } ?>

                                        <?php

if($_POST['stylerefid']!=''){
$stylerefCondition = 'and id="'.decode($_POST['stylerefid']).'"';
}

$bd=GetPageRecord('*','queryMaster','1 and subject!="" '.$stylerefCondition.' and deletestatus=0 and sampleStyle=1 and poAttachment!="" order by id desc');
while($queryData=mysqli_fetch_array($bd)){

$rsqty=GetPageRecord('qtyTotal','buyerPurchaseOrderMaster','styleId="'.$queryData['id'].'"');
$resultqty=mysqli_fetch_array($rsqty);

$tnadata="";
$tnadataaaaa="";
$tnadataq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$queryData['id'].'" and taskListId in (select id from taskListMaster where name in (select id from tnaActivityMaster where name="Ex-Factory Start Date")) order by id');
$tnadata=mysqli_fetch_array($tnadataq);

$tnadataaaaaq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$queryData['id'].'" and taskListId in (select id from taskListMaster where name in (select id from tnaActivityMaster where name="Ex-Factory End Date")) order by id');
$tnadataaaaa=mysqli_fetch_array($tnadataaaaaq);


$id=$queryData['id'];

// $materialType=decode($_GET['materialType']);

// $styleDataq=GetPageRecord('styleRefId,sampleStyle','queryMaster','1 and id="'.$id.'"');
// $styleData=mysqli_fetch_array($styleDataq);

// $matListDataq=GetPageRecord('name','materialTypeMaster','1 and id="'.$materialType.'"');
// $matListData=mysqli_fetch_array($matListDataq);

 $sr=1;
				 $gateEntryno='';
				 $rsListDatassq=GetPageRecord('*','grnMaster','1 and styleId="'.$id.'" and materialid in ( select id from styleSubCategoryMaster where materialType="3") group by color,materialId');
				 while($rsListDatass=mysqli_fetch_array($rsListDatassq)){


				$where2='styleId="'.$id.'" and materialType="3" and id="'.$rsListDatass['materialId'].'"';
				$rs2=GetPageRecord('*','styleSubCategoryMaster',$where2);
				while($matData=mysqli_fetch_array($rs2))
				{

				  $tsq=GetPageRecord('bomPlacement,storesupplier,supplierartname,bomAvg','techPackDetailMaster','1 and stylesubtabid='.$matData['id'].' order by id asc');
    	         $techShellData=mysqli_fetch_array($tsq);

    	         $rsd=GetPageRecord('*','grnMaster','1  and styleId="'.$queryData['styleId'].'"');
               $operationData3=mysqli_fetch_array($rsd);

               	$rsgrnrec=GetPageRecord('sum(netReceived) as netReceivedTill,color,parentId','grnMaster','styleId="'.$id.'" and materialId="'.$rsListDatass['materialId'].'" and color="'.$rsListDatass['color'].'"');
				$rsgrnrecTill=mysqli_fetch_array($rsgrnrec);

				$rsd=GetPageRecord('*','gateentrymaster','1  and registerno="Packaging"');
               $operationD=mysqli_fetch_array($rsd);

						?>

                                <tr>

                                <tr role="row" class="odd">
							    <td><?php echo getBrandName($queryData['brandId']); ?></td>
							    <td><?php echo $queryData['styleRefId'];?></td>





							<!--<td></td> -->

							 <td><?php echo $matData['name'];?></td>
							 <td><?php echo $resultqty['qtyTotal']; ?></td>
							 <td><?php echo round($rsgrnrecTill['netReceivedTill'],2); ?></td>



							 <td><?php echo getsupplierCompany($techShellData['storesupplier']); ?></td>
							 <td><?php
					$rsgrndata=GetPageRecord('*','grnMaster','styleId="'.$id.'" and materialId="'.$rsListDatass['materialId'].'" and color="'.$rsListDatass['color'].'"');
					while($rsgrndatalist=mysqli_fetch_array($rsgrndata)){
					$rsgrnno=GetPageRecord('gateEntryNo,grnNo, docDate','grnMaster','id="'.$rsgrndatalist['parentId'].'"');
					$rsgrnnolist=mysqli_fetch_array($rsgrnno);
					?>
                    <span style="font-weight:600; color:#00CC33;"><?php echo makeQueryId($rsgrnnolist['gateEntryNo']); ?></span>
                    <?php } ?>
                    </td>
					<td><?php echo date('d-m-Y',strtotime($operationD['entrydate'])); ?></td>
					<td><?php
					$rsgrndata=GetPageRecord('*','grnMaster','styleId="'.$id.'" and materialId="'.$rsListDatass['materialId'].'" and color="'.$rsListDatass['color'].'"');
					while($rsgrndatalist=mysqli_fetch_array($rsgrndata)){
					$rsgrnno=GetPageRecord('gateEntryNo,grnNo,docDate','grnMaster','id="'.$rsgrndatalist['parentId'].'"');
					$rsgrnnolist=mysqli_fetch_array($rsgrnno);
					?>
                    <span style="font-weight:600; color: #0033FF;"><?php echo $rsgrnnolist['grnNo']; ?></span>
                    <?php } ?>
                    </td>


							 <td><?php if($rsgrnnolist['docDate']!=''){ echo date('d-m-Y',strtotime($rsgrnnolist['docDate'])); }else{ echo '-'; } ?></td>

						     </tr>
                            <?php } } } ?>

                              </tbody>
                              </table>
                             <div class="pagingdiv" style="width: 97%;margin: 20px auto;">
                             <table width="100%" border="0" cellpadding="0" cellspacing="0">
                             <tbody>
                             <tr>
                              <td><table border="0" cellpadding="0" cellspacing="0">
                              <tr>
                             <td style="padding-right:20px;"><?php echo $totalentry; ?> entries</td>
                                <td><select name="records" id="records" onchange="this.form.submit();" class="lightgrayfield" style="padding: 5px;border: 1px solid #ccc; outline:none;">
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
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<style>
.dataTables_info,.dataTables_paginate,.dataTables_length {
	display:none !important;
 }
</style>
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

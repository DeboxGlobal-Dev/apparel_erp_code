<?php
if($loginuserprofileId==1 || $loginuserprofileId==93){

$wheresearchassign=' 1 and ';

} else {

if($loginuserprofileId==92){

$wheresearchassign=' 1 and finalstatus="2" and assignTo in (select id from '._USER_MASTER_.' where empId in (select id from employeeMaster where reportingTo='.$_SESSION['empid'].')) or assignTo="'.$_SESSION['userid'].'" and ';
} else{

$wheresearchassign=' ( id in (select styleId from styleAssignmentMaster where assignTo="'.$_SESSION['userid'].'" and styleAssignTo=0 and statusId in (19,21)))';

$wheresearchassign=' '.$wheresearchassign.' and ';

}

}

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
            <div class="col-xl-3" style="padding-right: 0px;"></div>
          </div>
          <div class="card" style="padding-bottom:40px;">
            <div class="row" style="margin-top:20px;">
              <div class="col-md-12" style=" padding:0px 25px;">
                <form action="" method="get">
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <input type="text" placeholder="Search:" name="filtersearch" id="filtersearch" class="form-control"/>
                      </div>
                    </div>
                    <div class="col-md-2" style="display:none;">
                      <div class="form-group">
                        <select name="stylerefid" id="stylerefid" class="select2 form-control">
                          <option value="">Select Style</option>
                          <?php
			 	$fcref=GetPageRecord('*','queryMaster',''.$wheresearchassign.' deleteStatus=0 and subject!="" and sampleStyle=1 order by id desc');
				while($refData=mysqli_fetch_array($fcref)){ ?>
                          <option value="<?php echo encode($refData['id']); ?>" <?php if(decode($_GET['stylerefid'])==$refData['id']){ ?> selected="selected" <?php } ?>><?php echo $refData['styleRefId']; ?></option>
                          <?php } ?>
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
            <div class="card">
              <form name="listform" id="listform" method="get">
                <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
                <table class="table table-bordered" style="width:100%;">
                  <tr>
                    <th><div align="left">Style#</div></th>
                    <th><div align="left">StyleColor</div></th>
                    <th><div align="left">Style&nbsp;Name</div></th>
                    <th><div align="left">Category</div></th>
                    <th><div align="left">Total&nbsp;Quantity</div></th>
                    <th><div align="left">Factory</div></th>
                    <th><div align="left">Lines</div></th>
                    <th><div align="left">Date</div></th>
                  </tr>
                  <tbody id="allhotellisting">
                    <?php
$no=1;
$select='*';
$where='';
$rs='';
$wheresearch='';
$page=$_GET['page'];
$limit=clean($_GET['records']);

if($_GET['stylerefid']!=''){
$stylerefid = 'and id="'.decode($_GET['stylerefid']).'"';
}

$where='where '.$wheresearchassign.' styleStatus!=0 and sampleStyle=1 and subject!="" '.$stylerefid.' and poAttachment!="" and id in (select styleId from buyerPurchaseOrderMaster where qtyTotal!="" and qtyTotal!=0) order by id desc';

$targetpage=$fullurl.'showpage.crm?module='.$_GET['module'].'&records='.$limit.'&stylerefid='.$stylerefid.'&';

$rs=GetRecordList($select,_QUERY_MASTER_,$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

$rkdm=GetPageRecord('min(uploadInputDate) as minDate, max(uploadInputDate) as maxDate','linePlanMaster','1 and styleId="'.$resultlists['id'].'"');
$dateWise=mysqli_fetch_array($rkdm);

$startDate=	date('d-m-Y',strtotime($dateWise['minDate']));
$endDate=date('d-m-Y',strtotime($dateWise['maxDate']));

?>
                    <tr>
                      <td><div align="left"><a href="showpage.crm?module=lineallotmentplan&add=yes&styleid=<?php echo encode($resultlists['id']); ?>"><?php echo '#'.$resultlists['styleRefId']; ?> </a></div></td>
                      <td align="center"><div style=" color:#fff;background-color:<?php echo $resultlists['styleColor']; ?>;">
                          <div align="left"><?php echo $resultlists['styleColor']; ?></div>
                        </div></td>
                      <td><div align="left"><?php echo $resultlists['subject']; ?></div></td>
                      <td><div align="left"><?php echo getCategoryName($resultlists['categoryId']).' - '.getSubCategoryName($resultlists['subCategoryId']); ?></div></td>
                      <?php
							    $qtyTotal =0;
								$grossTotal = 0;
							  	$selectqty='*';
								$whereqty='styleId="'.$resultlists['id'].'"';
								$rsqty=GetPageRecord($selectqty,'buyerPurchaseOrderMaster',$whereqty);
								$resultqty=mysqli_fetch_array($rsqty);
								?>
                      <td><div align="left"><?php echo $resultqty['qtyTotal']; ?></div></td>
                      <td><div align="left">
                          <?php
							 	$kr=GetPageRecord('*','linePlanMaster','1 and styleId="'.$resultlists['id'].'"');
								$lineData=mysqli_fetch_array($kr);

								$km=GetPageRecord('*','factoryMaster','id="'.$lineData['factoryId'].'"');
								$factotyData=mysqli_fetch_array($km);

								echo $factotyData['name'];

								?>
                        </div></td>
                      <td><div align="left">
                          <?php

							 	$kk=GetPageRecord('*','linePlanMaster','1 and styleId="'.$resultlists['id'].'" and factoryId="'.$lineData['factoryId'].'" group by lineId desc');
								while($lineDataa=mysqli_fetch_array($kk)){
							    $lineDataa['lineId'];


								$lo=GetPageRecord('*','factoryLineMaster','id="'.$lineDataa['lineId'].'"');
								$lineName=mysqli_fetch_array($lo);

								?>
                          <span style="padding: 5px 10px; background-color: #0097a7; color: #fff; margin-right: 2px; font-size: 12px; margin-bottom:5px;display: inline-block;"><?php echo str_replace(' ','&nbsp;',$lineName['lineName']);?></span>
                          <?php


								}


								?>
                        </div></td>
                      <td align="left" style="width: 200px;"><div align="left">
                          <?php

	if($dateWise['minDate']!='' && $dateWise['maxDate']!=''){
	echo date('d-m-Y',strtotime($dateWise['minDate'])).' TO '.date('d-m-Y',strtotime($dateWise['maxDate']));
	}
								?>
                        </div></td>
                      <?php if($resultdays['statusId']=='19' || $resultdays['statusId']=='20'){  ?>
                      <?php }else{ ?>
                      <?php } ?>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
                <div class="pagingdiv" style="width: 97%;margin: 20px auto;">
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                      <tr>
                        <td><table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td style="padding-right:20px;"><?php echo $totalentry; ?> entries</td>
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
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
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

<?php
if($_GET['styleid']!=''){
$select='*';
$where='id="'.decode($_GET['styleid']).'"';
$rs=GetPageRecord($select,'queryMaster',$where);
$editresultstyle=mysqli_fetch_array($rs);
$buyerId = $editresultstyle['buyerId'];
$buyerStyleRefNo = $editresultstyle['buyerStyleRefNo'];
$subject = $editresultstyle['subject'];
$displayId = $editresultstyle['displayId'];
$seasonId = $editresultstyle['seasonId'];
$categoryId = $editresultstyle['categoryId'];
$subCategoryId = $editresultstyle['subCategoryId'];
$departmentId = $editresultstyle['departmentId'];
$receivedDate = $editresultstyle['receivedDate'];
$patternDescription = $editresultstyle['patternDescription'];
$patternAttachment = $editresultstyle['patternAttachment'];

$lastId=$editresultstyle['id'];

$rsqty=GetPageRecord('*','buyerPurchaseOrderMaster','styleId="'.$editresultstyle['id'].'"');
$resultqty=mysqli_fetch_array($rsqty);
$totalstylequantity=$resultqty['qtyTotal'];

}

?>

<div class="page-content">
  <div class="content-wrapper">
    <div class="content pt-0" style="margin-top:20px; overflow:hidden;">
      <?php include "top-style.php"; ?>
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-white">
              <h6 class="card-title">Style Allocation</h6>
            </div>
            <div class="card-body">
              <div class="form-group">
                <div class="row">
                  <div class="page-content">
                    <div class="content-wrapper">
                      <div class="content pt-0" style="margin-top:10px;">
                        <div class="row">
                          <div class="col-xl-12">
                            <form name"search" method="GET" action="">
                              <input type="hidden"  name="module" value="<?php echo $_GET['module']; ?>"/>
                              <input type="hidden"  name="add" value="yes"/>
                              <input type="hidden"  name="styleid" value="<?php echo $_GET['styleid']; ?>"/>
                              <div class="row" style="padding:15px 8px;">
                                <div class="col-md-2">
                                  <div class="">
                                    <input name="startDate" type="text" class="newDatePicker form-control" id="startDate" value="<?php echo $_GET['startDate']; ?>" placeholder="Line Loading Date" readonly="">
                                  </div>
                                </div>
                                <div class="col-md-2" >
                                  <div class="">
                                    <input name="endDate" type="text" class="newDatePicker form-control" id="endDate" value="<?php echo $_GET['endDate']; ?>" placeholder="Off Machine Date" readonly="">
                                  </div>
                                </div>
                                <div class="col-md-2">
                                  <div class="">
                                    <input name="search" type="submit" class="btn bg-teal-400" id="search" value="Search">
                                  </div>
                                </div>
                                <div class="col-md-2"> </div>
                                <div class="col-md-2">
                                  <div class="" style="text-align: center; background-color: #ffe599; padding: 8px; width: 100%;">Busy Lines - <span style="padding: 2px 10px; border: 2px solid #ff0000;">&nbsp;</span></div>
                                </div>
                                <div class="col-md-2" style="text-align:right;">
                                  <div class="" style="text-align: center; background-color: #ffe599; padding: 8px; width: 100%;">Style Color - <span style="height: 20px; width: 20px; color: #fff; padding: 5px 15px; border: 1px solid #fff;background-color:<?php echo $editresultstyle['styleColor']; ?>"> <?php echo $editresultstyle['styleColor']; ?> </span></div>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                        <div class="row">
                          <?php if($_GET['startDate']!='' && $_GET['endDate']!=''){ ?>
                          <div class="col-xl-12" id="abc">
                            <table width="100%" border="0" cellpadding="5" cellspacing="0" class="table table-responsive">
                              <?php

				if($_REQUEST['factoryId']!=''){
				$f=GetPageRecord('*','factoryMaster',' id="'.$_REQUEST['factoryId'].'" and status=1 order by id asc');
				} else {
				$f=GetPageRecord('*','factoryMaster','1 and status=1 order by id asc');

				}

				$no=1;

				while($factoryData=mysqli_fetch_array($f)){
				$finalvalue=0;
				$mainvaluedaywise=0;
				$abcfinalcheck=0;

				?>
                              <tbody id="factorylineplan<?php echo $factoryData['id']; ?>" style="display:block !important;">
                              </tbody>
                              <script>
				$('#factorylineplan<?php echo $factoryData['id']; ?>').load('loadfactorylineplan.php?id=<?php echo $factoryData['id']; ?>&startDate=<?php echo $_REQUEST['startDate']; ?>&endDate=<?php echo $_REQUEST['endDate']; ?>&styleid=<?php echo $editresultstyle['id']; ?>&factoryId=<?php echo $_REQUEST['factoryId']; ?>');
				</script>
                              <?php $no++; } ?>
                            </table>
                          </div>
                          <?php } else{ ?>
                          <div class="col-md-12" style="margin-bottom: 20px; padding: 10PX 20PX; font-size: 16px; color: #0288d1; text-align: left;">Select Date Range</div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
.table td, .table th, .table tr {
    padding: 0px 6px !important;
}
</style>

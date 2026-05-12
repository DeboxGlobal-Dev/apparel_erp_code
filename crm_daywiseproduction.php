<div class="page-content">
  <div class="content-wrapper">
    <div class="content pt-0" style="margin-top:20px;">
      <div class="row">
        <div class="col-xl-12">
          <div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
            <div class="col-xl-12">
              <h5 class="card-title"><?php echo $pageName; ?></h5>
            </div>
          </div>
        </div>
      </div>
      <?php
$factoryIdValue=$_POST['factoryId'];
?>
      <div class="card">
        <form name"search" method="post" action="">
          <input type="hidden" name="module" value="<?php echo $_POST['module']; ?>" />
          <div class="row" style="padding:20px;">
            <div class="col-md-2" >
              <div class="">
                <input name="fromDate" type="text" class="newDatePicker form-control" id="fromDate" value="<?php if($_POST['fromDate']!=''){ echo date('d-m-Y',strtotime($_POST['fromDate'])); } else{ echo date('d-m-Y'); } ?>" readonly="">
              </div>
            </div>
            <div class="col-md-2">
              <div class="">
                <select name="factoryId[]" id="factoryId" class="form-control" multiple="multiple">
                    <?php
								$fk=GetPageRecord('*','recorderMaster','1 group by factoryId');
								while($factoryData=mysqli_fetch_array($fk)){

								$checked='';
								if(in_array($factoryData['factoryId'],$factoryIdValue)){
								$checked='selected';
								}

								$a=GetPageRecord('*','factoryMaster','id="'.$factoryData['factoryId'].'"');
								$selectdata=mysqli_fetch_array($a); ?>
                  <option value="<?php echo $factoryData['factoryId']; ?>" <?php echo $checked; ?>><?php echo $selectdata['name']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <script>
$(function() {
$('#factoryId').multiselect({
includeSelectAllOption: true,
enableFiltering: true,
enableCaseInsensitiveFiltering: true,
filterPlaceholder: 'Search...'
});
});
</script>
            <div class="col-md-2">
              <div class="">
                <input name="search" type="submit" class="btn bg-teal-400" id="search" value="Search">
              </div>
            </div>
          </div>
        </form>
        <?php if($_POST['factoryId']!=''){ ?>
        <div class="col-md-12" style="padding:0px 20px;">
		<?php
		foreach($factoryIdValue as $myFactory){

		$factoryheadNameq=GetPageRecord('name','factoryMaster','1 and id="'.$myFactory.'"');
		$factoryheadName=mysqli_fetch_array($factoryheadNameq);

		?>
          <table cellspacing="0" cellpadding="5" style="width:100%; margin-bottom:20px;">
		   <tr style="background-color:#e5fbfa;">
		   <td colspan="14"><div style="font-size: 15px; padding: 5px;"><strong><?php echo $factoryheadName['name']; ?></strong></div></td>
		   </tr>
            <tr style="background-color: #fff7b3; text-align:center;">
              <td width="93"><strong>Line&nbsp;No.</strong></td>
              <td width="93"><strong>Style</strong></td>
              <td width="93"><strong>Color</strong></td>
              <td width="93"><strong>Order&nbsp;Quantity</strong></td>
              <td colspan="2"><strong>Loading </strong> </td>
              <td colspan="3"><strong>Output</strong> </td>
              <td colspan="5"><strong>Manpower </strong> </td>
            </tr>
            <tr style="background-color: #fff7b3; text-align:center;">
              <td width="93"><strong> </strong></td>
              <td width="93"><strong> </strong></td>
              <td width="93"><strong> </strong></td>
              <td width="93"><strong> </strong></td>
              <td><strong>Today</strong></td>
              <td><strong>Till&nbsp;Date</strong></td>
              <td><strong>Today</strong></td>
              <td><strong>Till&nbsp;Date</strong></td>
              <td><strong>Balance&nbsp;Till&nbsp;Date </strong></td>
              <td><strong>Operator</strong></td>
              <td><strong>Helper</strong></td>
              <td><strong>Supervisor</strong></td>
              <td><strong>Checker</strong></td>
              <td><strong>Total</strong></td>
            </tr>
            <?php

$totalloadingfirst=0;
$totaloutputfirst=0;
$rkdm=GetPageRecord('*','factoryLineMaster','1 and factoryId="'.$myFactory.'" order by id asc');

$styleData='';


while($lineData=mysqli_fetch_array($rkdm)){



$aa=GetPageRecord('styleId','linePlanMaster','1 and factoryId="'.$myFactory.'" and lineId="'.$lineData['id'].'" and uploadInputDate="'.date('Y-m-d',strtotime($_POST['fromDate'])).'"');
$getstyleid=mysqli_fetch_array($aa);



$a=GetPageRecord('*','queryMaster','id="'.$getstyleid['styleId'].'"');
$styleData=mysqli_fetch_array($a);


$km=GetPageRecord('SUM(loading) as totalLoading,SUM(output) as totalOutput,SUM(operator) as totaloperator,SUM(helper) as totalhelper,SUM(supervisor) as totalsupervisor,SUM(checker) as totalchecker,SUM(total) as totaltotal',' recorderInputMaster','1 and factoryId="'.$myFactory.'" and line="'.$lineData['id'].'" and fromDate="'.date('Y-m-d',strtotime($_POST['fromDate'])).'"');


$recorderInputData=mysqli_fetch_array($km);

//This is a liading result/////////////////===========================================================
$totalstylequantity=0;
$rsqty=GetPageRecord('*','buyerPurchaseOrderMaster','styleId="'.$getstyleid['styleId'].'"');
$resultqty=mysqli_fetch_array($rsqty);
$totalstylequantity=$resultqty['qtyTotal'];

$color='';


$rs12=GetPageRecord('*','purchaseOrderStyleMaster','styleId="'.$getstyleid['styleId'].'" and sectionType=1  group by color order by id asc');
$countcolor=mysql_num_rows($rs12);
while($result1=mysqli_fetch_array($rs12)){


$colornameDataq=GetPageRecord('name','colorCardMaster','1 and id="'.$result1['color'].'"');
$colornameData=mysqli_fetch_array($colornameDataq);

$color.=$colornameData['name'].',';
}


?>
            <tr>
              <td height="33" align="center" style="background-color: #e5fbfa;"><strong><?php echo $lineData['lineName']; ?></strong></td>
              <td><div align="left" style="width:300px;"><?php echo $styleData['subject']; ?></div></td>
              <td><?php if($countcolor>0){ ?>
                <div align="left" style="background-color: #0288d1; color: #fff; padding: 2px; width: 130px; text-align: center;">
                  <?php  echo rtrim($color,','); ?>
                </div>
                <?php } ?></td>
              <td ><div align="center"><?php echo $totalstylequantity; ?></div></td>
              <td width="65"><div align="center"><?php echo $recorderInputData['totalLoading'];  if($recorderInputData['totalLoading']!='' && $recorderInputData['totalLoading']>0){ $totalloadingfirst=$totalloadingfirst+$recorderInputData['totalLoading']; } ?></div></td>
              <td width="74"><div align="center">
                  <?php if($recorderInputData['totalLoading']!='' && $recorderInputData['totalLoading']>0){ echo $totalloadingfirst; } ?>
                </div></td>
              <td width="89" align="center"><div align="center"><?php echo $recorderInputData['totalOutput'];  if($recorderInputData['totalOutput']!='' && $recorderInputData['totalOutput']>0){ $totaloutputfirst=$totaloutputfirst+$recorderInputData['totalOutput']; } ?></div></td>
              <td width="89" align="center"><div align="center">
                  <?php if($recorderInputData['totalOutput']!='' && $recorderInputData['totalOutput']>0){ echo $totaloutputfirst; } ?>
                </div></td>
              <td width="89" align="center"><div align="center">
                  <?php if($recorderInputData['totalLoading']!="" && $recorderInputData['totalOutput']!=""){ echo $recorderInputData['totalLoading']-$recorderInputData['totalOutput']; } ?>
                </div></td>
              <td width="89" align="center"><div align="center"><?php echo $recorderInputData['totaloperator']; ?></div></td>
              <td width="89" align="center"><div align="center"><?php echo $recorderInputData['totalhelper']; ?></div></td>
              <td width="89" align="center"><div align="center"><?php echo $recorderInputData['totalsupervisor']; ?></div></td>
              <td width="89" align="center"><div align="center"><?php echo $recorderInputData['totalchecker']; ?></div></td>
              <td width="89" align="center"><div align="center"><?php echo $recorderInputData['totaltotal']; ?></div></td>
            </tr>
            <?php }  ?>
          </table>
		<?php } ?>
        </div>
        <?php } else{ ?>
        <div class="col-md-12" style="margin-bottom: 20px; padding: 10PX 20PX; font-size: 16px; color: #0288d1; text-align: left;"><strong>Select Factory</strong></div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<!-- /dashboard content -->
</div>
<!-- /content area -->
<!-- Footer -->
<!-- /footer -->
</div>
<!-- /main content -->
</div>
<style>
.liststyleimg{
	float: left;
    width: 70px;
    margin-right: 15px;
    padding: 5px;
    border: 2px solid #e6e6e6;}

.badge.dropdown-toggle:after { display:none;
}
.hwp tr{
border-bottom:1px solid #ccc;
}
table tr td{
border:1px solid #ccc;

}
</style>
<script>
$('#DataTables_Table_2').DataTable( {
"order": [[ 0, "desc" ]]
} );
</script>

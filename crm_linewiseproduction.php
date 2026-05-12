<div class="page-content">
  <div class="content-wrapper">
    <div class="content pt-0" style="margin-top:20px;">
      <div class="row">
        <div class="col-xl-12">
          <div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
            <div class="col-xl-9">
              <h5 class="card-title"><?php echo $pageName; ?></h5>
            </div>
            <div class="col-xl-3" style="padding-right: 0px;">
              <div class="btn-group justify-content-center" style="float:right;"> </div>
            </div>
          </div>
          <div class="card">
            <form name"search" method="GET">
              <input type="hidden" name="module" value="<?php echo $_GET['module']; ?>" />
              <div class="row" style="padding:20px;">
                <div class="col-md-2">
                  <div class="">
                    <select name="factoryId" id="factoryId" class="form-control">
                      <option value="">Select Factory</option>
                      <?php
								$fk=GetPageRecord('*','recorderMaster','1 group by factoryId');
								while($factoryData=mysqli_fetch_array($fk)){
								$a=GetPageRecord('*','factoryMaster','id="'.$factoryData['factoryId'].'"');
								$selectdata=mysqli_fetch_array($a); ?>
                      <option value="<?php echo $factoryData['factoryId']; ?>" <?php if($_GET['factoryId']==$factoryData['factoryId']){ ?> selected="selected" <?php } ?>><?php echo $selectdata['name']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-2" >
                  <div class="">
                    <input name="fromDate" type="text" class="newDatePicker form-control" id="fromDate" value="<?php if($_GET['fromDate']!=''){ echo date('d-m-Y',strtotime($_GET['fromDate'])); } else{ echo date('1-m-Y'); } ?>" readonly="">
                  </div>
                </div>
                <div class="col-md-2" >
                  <div class="">
                    <input name="toDate" type="text" class="newDatePicker form-control" id="toDate" value="<?php if($_GET['fromDate']!=''){ echo date('d-m-Y',strtotime($_GET['toDate'])); } else{ echo date('t-m-Y'); } ?>" readonly="">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="">
                    <input name="search" type="submit" class="btn bg-teal-400" id="search" value="Search">
                  </div>
                </div>
              </div>
            </form>
            <div class="datatable-scroll" style="overflow: auto !important;">

 <style>
.main-class {
    display: inline-block;
    width: 100%;
    font-size: 12px;
    padding: 0px 10px;
}
  .main-class table tr td{
  padding:5px;
 }
  .main-class table tr th{
  padding:5px;
 }
 </style>

			  <div class="main-class">
			  <div class="f-div" style="width:60%; float:left; overflow-y:auto;">
			  <?php

				   if($_GET['factoryId']!=''){ ?>
                 <table class="table-bordered" style="width:100%;">
                <tr style="background-color: #0288d1; font-weight: 500; text-align: center; color: #fff; font-size: 15px;">
                  <?php
					 $linenameFirstq=GetPageRecord('*','factoryLineMaster','factoryId="'.$_GET['factoryId'].'" order by id asc');
					while($linenameFirst=mysqli_fetch_array($linenameFirstq)){  ?>
                  <td><div><?php echo $linenameFirst['lineName']; ?></div></td>
                  <?php } ?>
                </tr>
				<tr>
                  <?php

					 //================================================
					$kr=GetPageRecord('*','factoryLineMaster','factoryId="'.$_GET['factoryId'].'" order by id asc');

					while($linename=mysqli_fetch_array($kr)){

					$totaltillDate=0;
					$totalPlannertillDate=0;
					$jvar=0;
						?>

                  <td><table  width="100%" class="table table-bordered">
                      <?php

					$startDate=date('Y-m-d',strtotime($_REQUEST['fromDate']));
					$endDate=date('Y-m-d',strtotime($_REQUEST['toDate'] . ' +1 day'));

					$begin = new DateTime($startDate);
					$end = new DateTime($endDate);

					$interval = DateInterval::createFromDateString('1 day');
					$period = new DatePeriod($begin, $interval, $end);

					foreach ($period as $dt) {

					$abc=date('Y-m-d',strtotime($dt->format("d-m-Y")));



$aa=GetPageRecord('*','linePlanMaster','1 and factoryId="'.$_GET['factoryId'].'" and lineId="'.$linename['id'].'" and uploadInputDate="'.$abc.'"');
$getstyleid=mysqli_fetch_array($aa);

$a=GetPageRecord('*','queryMaster','id="'.$getstyleid['styleId'].'"');
$styleData=mysqli_fetch_array($a);

$km=GetPageRecord('SUM(loading) as totalLoading,SUM(output) as totalOutput','recorderInputMaster','1 and factoryId="'.$_GET['factoryId'].'" and line="'.$linename['id'].'" and fromDate="'.$abc.'"');
$recorderInputData=mysqli_fetch_array($km);

					?>

					<?php if($jvar==0){ ?>
					<tr>
					  <td align="left"><strong>Date</strong> </td>
                  <td><div><strong>Style</strong></div></td>
				  <td><div><strong>Order Qty.</strong></div></td>
                  <td><div>
                    <div align="center"><strong>Planned</strong></div>
                  </div></td>
                  <td><div>
                    <div align="center"><strong>Today</strong></div>
                  </div></td>
				  <td><div>
				    <div align="center"><strong>Planned Till&nbsp;Date</strong></div>
				  </div></td>
                  <td><div>
                    <div align="center"><strong>Till Date</strong></div>
                  </div></td>
					</tr>
					<?php $jvar=1; } ?>


                      <tr>

                        <td><div style="min-height: 30px; vertical-align: middle; padding-top: 8px; width: 70px;">
                            <?php  echo $dt->format("d-m-Y");  ?>
                          </div></td>
                        <td bgcolor="#F8FFC1"><div style="width: 120px;"><?php echo $styleData['subject']; ?></div></td>
						<td bgcolor="#F8FFC1"><div style="width: 120px;"><?php if($styleData['subject']!=''){ echo '18100'; } ?></div></td>
                        <td align="center"><div align="center"><?php echo $getstyleid['dateWiseLineInput']; if($getstyleid['dateWiseLineInput']!='' && $getstyleid['dateWiseLineInput']>0){ $totalPlannertillDate=$totalPlannertillDate+$getstyleid['dateWiseLineInput']; } ?></div></td>

                        <td align="center"><div align="center"><?php echo $recorderInputData['totalLoading']; if($recorderInputData['totalLoading']!='' && $recorderInputData['totalLoading']>0){ $totaltillDate=$totaltillDate+$recorderInputData['totalLoading']; } ?></div></td>


						<td align="center"><div align="center">
						  <?php if($getstyleid['dateWiseLineInput']!='' && $getstyleid['dateWiseLineInput']>0){  echo $totalPlannertillDate; } ?>
					    </div></td>

						<td align="center"><div align="center">
						  <?php if($recorderInputData['totalLoading']!='' && $recorderInputData['totalLoading']>0){  echo $totaltillDate; } ?>
					    </div></td>
                      </tr>
                      <?php } ?>
                    </table></td>
                  <?php } ?>
                </tr>

              </table>
              <?php } else{ ?>
              <div class="col-md-12" style="margin-bottom: 20px; padding: 10PX 20PX; font-size: 16px; color: #0288d1; text-align: left;">Select Factory</div>
              <?php } ?>
			  </div>

			  <div class="s-div" style="width:39%; float:right; overflow-y:auto;">
			  <?php

				   if($_GET['factoryId']!=''){ ?>
                 <table class="table-bordered" style="width:100%;">
                <tr style="background-color: #ece9e9; font-weight: 500; text-align: center; color: #000; font-size: 15px;">
                  <td colspan="6" align="center"><div>TOTAL</div></td>
                </tr>
				<tr>

                  <td><table  width="100%" class="table table-bordered">
                      <?php
					$jvar=0;
					$startDate=date('Y-m-d',strtotime($_REQUEST['fromDate']));
					$endDate=date('Y-m-d',strtotime($_REQUEST['toDate'] . ' +1 day'));

					$begin = new DateTime($startDate);
					$end = new DateTime($endDate);

					$interval = DateInterval::createFromDateString('1 day');
					$period = new DatePeriod($begin, $interval, $end);

					 $totaltillDate=0;
					$totalPlannertillDate=0;

					foreach ($period as $dt) {


					$abc=date('Y-m-d',strtotime($dt->format("d-m-Y")));

$aa=GetPageRecord('sum(dateWiseLineInput) as totaldateWiseLineInput','linePlanMaster','1 and factoryId="'.$_GET['factoryId'].'" and uploadInputDate="'.$abc.'"');
$getstyleid=mysqli_fetch_array($aa);

$km=GetPageRecord('SUM(loading) as totalLoading,SUM(output) as totalOutput','recorderInputMaster','1 and factoryId="'.$_GET['factoryId'].'" and fromDate="'.$abc.'"');
$recorderInputData=mysqli_fetch_array($km);

					?>
					<?php if($jvar==0){ ?>
					<tr>
					  <td align="left"><strong>Date</strong> </td>
                  <td><div>
                    <div align="center"><strong>Planned</strong></div>
                  </div></td>
                  <td><div>
                    <div align="center"><strong>Today</strong></div>
                  </div></td>
				  <td><div>
                    <div align="center"><strong>Excess/Short</strong></div>
                  </div></td>
				  <td><div>
				    <div align="center"><strong>Planned<br />Till&nbsp;Date</strong></div>
				  </div></td>
                  <td><div>
                    <div align="center"><strong>Till Date</strong></div>
                  </div></td>
				  <td><div>
                    <div align="center"><strong>Excess/Short</strong></div>
                  </div></td>
					</tr>
						<?php $jvar=1; } ?>

                      <tr>

                        <td><div style="min-height: 30px; vertical-align: middle; padding-top: 8px; width: 70px;">
                            <?php  echo $dt->format("d-m-Y");  ?>
                          </div></td>
                        <td bgcolor="#F8FFC1"><div align="center"><?php echo $getstyleid['totaldateWiseLineInput']; if($getstyleid['totaldateWiseLineInput']!='' && $getstyleid['totaldateWiseLineInput']>0){ $totalPlannertillDate=$totalPlannertillDate+$getstyleid['totaldateWiseLineInput']; } ?></div></td>

                        <td align="center" bgcolor="#F8FFC1"><div align="center"><?php echo $recorderInputData['totalLoading']; if($recorderInputData['totalLoading']!='' && $recorderInputData['totalLoading']>0){ $totaltillDate=$totaltillDate+$recorderInputData['totalLoading']; } ?></div></td>
						 <?php
						 $totalExcessFirst=0;
						 $totalExcessFirst=$getstyleid['totaldateWiseLineInput']-$recorderInputData['totalLoading'];
						 ?>
						  <td align="center"><div align="center" style=" color: <?php if($totalExcessFirst<0){ ?>#ff0000 <?php } else{ ?>#0288d1 <?php } ?> ;"><strong><?php echo $totalExcessFirst; ?></strong></div></td>

						<td align="center"><div align="center">
						  <?php if($getstyleid['totaldateWiseLineInput']!='' && $getstyleid['totaldateWiseLineInput']>0){  echo $totalPlannertillDate; } ?>
					    </div></td>

						<td align="center"><div align="center">
						  <?php if($recorderInputData['totalLoading']!='' && $recorderInputData['totalLoading']>0){  echo $totaltillDate; } ?>
					    </div></td>

						<?php
						 $totalExcessSecond=0;
						 $totalExcessSecond=$totalPlannertillDate-$totaltillDate;
						 ?>

						<td align="center"><div align="center" style=" color: <?php if($totalExcessSecond<0){ ?>#ff0000 <?php } else{ ?>#0288d1 <?php } ?> ;"><strong><?php echo $totalExcessSecond; ?></strong></div></td>


                      </tr>
                      <?php } ?>
                    </table></td>
                </tr>

              </table>
              <?php }  ?>
			  </div>


			  </div>

            </div>
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
</style>
<script>
$('#DataTables_Table_2').DataTable( {
"order": [[ 0, "desc" ]]
} );
</script>

<?php
ob_start();
include "inc.php";
$assignto='download';
$select='*';

$where='id="'.decode($_REQUEST['styleId']).'"';
$rs=GetPageRecord($select,'queryMaster',$where);
$editresultstyle=mysqli_fetch_array($rs);

// header("Content-type: application/vnd.ms-excel;charset=UTF-8");
// header("Content-Disposition: attachment; filename=\"".$assignto."_".date('d-m-Y-H-i-s').".xls");
// header("Cache-control: private");

?>





                       <table class="table table-hover no-footer apparelclass" width="80%">

					  <tr style="padding: 5px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;">Sr. no.</div></td>
                      <td align="center"><div style="text-transform:capitalize;">GRADE</div></td>
					  <td align="center"><div style="text-transform:capitalize;">ATTACH.</div></td>
					  <td align="center"><div style="text-transform:capitalize;">ALLOCATED &nbsp;M/C</div></td>
					  <td align="center"><div style="text-transform:capitalize;">&nbsp;&nbsp;MACHINE&nbsp;&nbsp;</div></td>
					  <td align="center"><div style="text-transform:capitalize;">OPERATION</div></td>
					  <td align="center"><div style="text-transform:capitalize;">OPERATION</div></td>
					  <td align="center"><div style="text-transform:capitalize;">&nbsp;&nbsp;MACHINE&nbsp;&nbsp;</div></td>
					  <td align="center"><div style="text-transform:capitalize;">ALLOCATED&nbsp; M/C</div></td>
					  <td align="center"><div style="text-transform:capitalize;">ATTACH.</div></td>
					  <td align="center"><div style="text-transform:capitalize;">GRADE</div></td>
                      <!--<td align="center"><div style="text-transform:capitalize;">S.&nbsp;No</div></td>-->
					   </tr>

					       <?php
					       $count=1;
				           $rrrr=GetPageRecord('*','lineLayoutMaster','1 and styleId="'.decode($_REQUEST['styleId']).'"');
				           while($rsListData=mysqli_fetch_array($rrrr)) {

				           ?>
                      <tr>
                          <td style="padding-left:30px; text-align:center; border:1px solid black;"><?php echo $count;?></td>
        <td style="padding-left:30px; text-align:center;border:1px solid black;"><?php echo str_replace('%','+',$rsListData['grade']); ?></td>
        <td style="padding-left:30px; text-align:center;border:1px solid black;"><?php echo $rsListData['attachment']; ?></td>
        <td style="padding-left:30px; text-align:center;border:1px solid black;"><?php echo $rsListData['allocateMc']; ?></td>




	<?php
	 $abc=GetPageRecord('*','machineMaster','1 and id="'.$rsListData['machineId'].'"');
	 $machine=mysqli_fetch_array($abc);
	 //echo $critical['name'];

	 ?>

	 <td style="text-align:center;border:1px solid black;"><?php echo $machine['name'] ?></td>



		 <!--<select name="operation" class="form-control validate">-->
	     <!--   <option value="">Select</option>-->

	 <?php
	 $abc=GetPageRecord('*','assemblyoperationsMaster','1 and id="'.$rsListData['operationId'].'"');
	 $critical=mysqli_fetch_array($abc);
	 //echo $critical['name'];

	 ?>

   <td style="text-align:center;border:1px solid black;"><?php echo $critical['name'] ?></td>




	 <?php
	 $abc=GetPageRecord('*','assemblyoperationsMaster','1 and id="'.$rsListData['operationId'].'"');
	 $critical=mysqli_fetch_array($abc);
	 //echo $critical['name'];

	 ?>

   <td style="text-align:center;border:1px solid black;"><?php echo $critical['name'] ?></td>



	<?php
	 $abc=GetPageRecord('*','machineMaster','1 and id="'.$rsListData['machineId'].'"');
	 $machine=mysqli_fetch_array($abc);
	 //echo $critical['name'];

	 ?>

	 <td style="text-align:center;border:1px solid black;"><?php echo $machine['name'] ?></td>

	<?php
	$abc=GetPageRecord('*','machineMaster','1 and status=1 and deletestatus=0 order by name asc');
	$machine=mysqli_fetch_array($abc);

	?>

         <td style="text-align:center;border:1px solid black;"><?php echo $rsListData['allocateMcb']; ?></td>
        <td style="text-align:center;border:1px solid black;"><?php echo $rsListData['attachmentb']; ?></td>
        <td style="text-align:center;border:1px solid black;"><?php echo str_replace('%','+',$rsListData['gradeb']); ?></td>



    </tr>
    <?php $count++; } ?>



					 </table>
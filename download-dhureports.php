<?php
ob_start();
include "inc.php";
$assignto="Download";

header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment; filename=\"".$assignto."_".date('d-m-Y-H-i-s').".xls");
header("Cache-control: private");

?>
      	<table class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
						<thead style="background-color: #f5f5f5;">
							<tr role="row">
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 50px;">Date</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Factory</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Line&nbsp;No</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Total&nbsp;Number&nbsp;of&nbsp;Defects </th>
																<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Total&nbsp;Pieces&nbsp;Checked </th>

							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">DHU(%)</th>
							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" style="display:none;">&nbsp;</th>
							</tr>
						</thead>
						<tbody>
						<?php
$no=1;
$select='*';
$where='';
$rs='';
$wheresearch='';
$limit='20000';

if($_GET['stylestatus']!=''){
$stylestatus = 'and finalstatus="'.$_GET['stylestatus'].'"';
}

$wheres='parentId="'.$resultlists['id'].'" and galleryType="image_gallery" order by id asc';
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
$rs=GetRecordList($select,'qualityInspectionMaster',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){



    $a=$resultlists['numberofpassgar']+$resultlists['numberofdefgar'];



    $dhu=($resultlists['numberofdefects']/$a)*100;

$selectimg='*';
$whereimg='id="'.$resultlists['styleId'].'" ';
$rsimg=GetPageRecord($selectimg,'queryMaster',$whereimg);
$imgresult=mysqli_fetch_array($rsimg);





$selectdays='*';
$wheredays='id="'.$resultlists['line'].'" ';
$rsdays=GetPageRecord($selectdays,'factoryLineMaster',$wheredays);
$resultdays=mysqli_fetch_array($rsdays);



$selectdaysa='*';
$wheredaysa='id="'.$resultlists['factoryId'].'" ';
$rsdaysa=GetPageRecord($selectdaysa,'factoryMaster',$wheredaysa);
$resultdaysa=mysqli_fetch_array($rsdaysa);




?>

							<tr role="row" class="odd" <?php if($resultlists['stylestatus']=='0'){ ?> style="background-color: #ff704359;" <?php } ?>>
							<td align="center"><?php echo $resultlists['fromDate']; ?></td>

								<td>#<?php echo $imgresult['styleRefId']; ?></td>

								<td><?php echo $resultdaysa['name']; ?></td>
								                          <td> <span style="padding: 5px 10px; background-color: #0097a7; color: #fff; margin-right: 2px; font-size: 12px; margin-bottom:5px;display: inline-block;"><?php echo str_replace(' ','&nbsp;', $resultdays['lineName']);?></span></td>




							   <td><?php echo $resultlists['numberofdefects']; ?></td>

								<td><?php echo $a; ?>	</td>
																<td><?php echo round($dhu,2); ?>%</td>
								<td align="center" class="" style="display:none;">

								 <a class="btn btn-primary" style="padding:5px;" href="../21-01-2020/showpage.crm?module=stylewiselineplan&add=yes&styleid=<?php echo encode($resultlists['id']); ?>&startDate=<?php echo $startDate; ?>&endDate=<?php echo $endDate; ?>&factoryId=<?php echo $factotyData['id']; ?>"><i class="fa fa-eye " aria-hidden="true" style=" color: #fffffff1; font-size: 16px; "></i></a>								  </td>

								<?php if($resultdays['statusId']=='19' || $resultdays['statusId']=='20'){  ?>
								<?php }else{ ?>
								<?php } ?>
							</tr>

<?php } ?>
						</tbody>
					</table>



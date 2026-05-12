<?php
ob_start();
include "inc.php";
$assignto="Download";

header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment; filename=\"".$assignto."_".date('d-m-Y-H-i-s').".xls");
header("Cache-control: private");

?>
      <table class="table table-bordered table-hover no-footer table-responsive">
                      <thead style="background-color: #f5f5f5; text-align:center;">
                        <tr role="row">

        	<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 50px;">Date</th>
																<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Factory</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Line&nbsp;No</th>

								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Total&nbsp;Output </th>
																<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Operators </th>

							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Output&nbsp;per&nbsp;operator</th>
							    							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Stitching&nbsp;Time&nbsp;per&nbsp;Piece&nbsp;per&nbsp; Operator</th>
							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Downtime </th>

							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Shift&nbsp;Time&nbsp;per&nbsp;operator&nbsp;(In&nbsp;Min)</th>

							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Downtime&nbsp;Percentage</th>

							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" style="display:none;">&nbsp;</th>


</tr>

                      </thead>
                       <tbody id="allhotellisting">


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

$wheres='group by factoryId,line,fromDate';
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
$rs=GetRecordList('*','recorderInputMaster',$wheres,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){


    $selectimg='*';
$whereimgs='id="'.$resultlists['factoryId'].'" ';
$rsimgs=GetPageRecord($selectimg,'factoryMaster',$whereimgs);
$imgresults=mysqli_fetch_array($rsimgs);



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
								 								<td><?php echo $imgresults['name']; ?></td>
								                          <td> <span style="padding: 5px 10px; background-color: #0097a7; color: #fff; margin-right: 2px; font-size: 12px; margin-bottom:5px;display: inline-block;"><?php echo str_replace(' ','&nbsp;', $resultdays['lineName']);?></span></td>

								<td>#<?php echo $imgresult['styleRefId']; ?></td>

<td><?php echo $resultlists['output']; ?></td>
<td><?php echo $resultlists['operator']; ?></td>

<?php
$per=$resultlists['output']/$resultlists['operator'];
?>
<td><?php echo round($per,2); ?></td>
<td><?php echo $imgresult['smv']; ?></td>

<?php
$down=$per*$imgresult['smv'];
?>
<td><?php echo round($down,2); ?></td>
<td> <?php if($resultlists['hours']=="1st Hour"){ echo "60 Mins";} else if($resultlists['hours']=="2nd Hour"){ echo "120 Mins";}  else if($resultlists['hours']=="3rd Hour"){ echo "180 Mins";} else if($resultlists['hours']=="4th Hour"){ echo "240 Mins";}  else if($resultlists['hours']=="5th"){ echo "300 Mins";} else if($resultlists['hours']=="6th Hour"){ echo "360 Mins";} else if($resultlists['hours']=="7th Hour"){ echo "420 Mins";} else if($resultlists['hours']=="8th Hour"){ echo "480 Mins";}else{} ?></td>
<?php
$a=60;
$b=120;
$c=180;
$d=240;
$e=300;
$f=360;
$g=420;
$h=480;

?>
<td><?php if($resultlists['hours']=="1st Hour"){ echo round(($down/$a)*100,2); } elseif($resultlists['hours']=="2nd Hour"){ echo round(($down/$b)*100,2); } elseif($resultlists['hours']=="3rd Hour"){ echo round(($down/$c)*100,2); } elseif($resultlists['hours']=="4th Hour"){ echo round(($down/$d)*100,2); } elseif($resultlists['hours']=="5th Hour"){ echo round(($down/$e)*100,2); } elseif($resultlists['hours']=="6th Hour"){ echo round(($down/$f)*100,2); }  elseif($resultlists['hours']=="7th Hour"){ echo round(($down/$g)*100,2); }elseif($resultlists['hours']=="8th Hour"){ echo round(($down/$g)*100,2); }    ?></td>


                                              </tr>

                                              <?php $i++; }     ?>

                      </tbody>
                    </table>
                    <div class="pagingdiv" style="width: 97%;margin: 20px auto;">
                      <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                          <tr>
                            <td><table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td style="padding-right:20px;"><?php echo $no; ?> Entries</td>
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
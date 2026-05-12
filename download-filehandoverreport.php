<?php
ob_start();
include "inc.php";
$assignto="Download";

header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment; filename=\"".$assignto."_".date('d-m-Y-H-i-s').".xls");
header("Cache-control: private");

?>


       <?php
                             $rrrr=GetPageRecord('*','fileHandoverMaster','1 and styleId="'.decode($_GET['styleid']).'"');
                        $operation=mysqli_fetch_array($rrrr);
                ?>
							<table class="table erptab table-hover" style="width:100%">
                     <tr style="background: #0288d1;">
                         <td colspan="4"><div style="text-transform:capitalize;color:white;font-size: 15px;">File Handover
                         </div>
                         </td>
                     </tr>
                     <tr>
                          <td style="width:26%"><div style="text-transform:capitalize;"><b>PO&nbsp;Details&nbsp;Size&nbsp;Break</b></div></td>

                        <?php
                                $qtyTotal =0;
                                $grossTotal = 0;
                                $selectqty='*';
                                $whereqty='styleId="'.$editresultstyle['id'].'"';
                                $rsqty=GetPageRecord($selectqty,'buyerPurchaseOrderMaster',$whereqty);
                                $resultqty=mysqli_fetch_array($rsqty);

                                    $total=0;
                  $rrrr=GetPageRecord('*','poManageMaster','1 and styleId="'.$editresultstyle['id'].'"');
                while($operationData=mysqli_fetch_array($rrrr)){
                     $total+= $operationData['poQty'];
                  }
                   $difference = $resultqty['qtyTotal'] - $total;
                 if($difference == "0" && $resultqty['qtyTotal'] !="0"){ ?>
                <td>
                <a href="showpage.crm?module=buyerpo&add=yes&styleid=<?php echo $_GET['styleid']; ?>">Completed</a>
                </td>
                <?php } else if ($resultqty['qtyTotal'] == $difference) { ?>
                <td>
                <a href="showpage.crm?module=buyerpo&add=yes&styleid=<?php echo $_GET['styleid']; ?>">Pending</a>
                </td>
                <?php  } else { ?>
                <td>
                  <a href="showpage.crm?module=buyerpo&add=yes&styleid=<?php echo $_GET['styleid']; ?>">Partial</a>
                </td>
                <?php } ?>

                <td><div style="text-transform:capitalize"><b>Final&nbsp;Tech&nbsp;Pack</b></div></td>
                     <?php if($editresultstyle['attachmentFile']!=''){ ?>
                    <td><input style="color: green;border: none" type="text" class="erpint" name="techpack" id="techpack" value="Completed" readonly> </td>
                     <?php } else  {  ?>
                    <td> <input style="color: red;border: none" type="text" class="erpint" name="techpack" id="techpack" value="pending" readonly> </td>
                    <?php } ?>


                     </tr>
                          <tr>
                              <td><div style="text-transform:capitalize;"><b>Approved&nbsp;Sealer</b></div></td>
                         <td>

                             <?php
                             if($operation['appseal'] == "1"){
                                ?>
                            <div >Yes</div>
<?php
                             }else{
                             ?>
                         	<div>No</div>

                         	<?php } ?>
                     </td>
                              <td><div style="text-transform:capitalize"><b>Approved&nbsp;PP&nbsp;Comments</b></div></td>
                        <td>
                             <?php
                             if($operation['comments'] == "1"){
                                ?>
                            <div >Yes</div>
<?php
                             }else{
                             ?>
                         	<div>No</div>

                         	<?php } ?>
                         							 <a href="showpage.crm?module=criticalpath&add=yes&styleid=<?php echo $_GET['styleid']; ?>">Click for Details</a>

                     </td>
                         </td>
                     </tr>
                     <tr>
                        <td><div style="text-transform:capitalize;"><b>TNA</b></div></td>
                          <?php

                                $selectqty='*';
                                $whereqtye='styleId="'.$editresultstyle['id'].'"';
                                $rsqtye=GetPageRecord($selectqty,'timeActionReport',$whereqtye);

                  if(mysql_num_rows($rsqtye) > 0 ){ ?>
                  <td><a href="showpage.crm?module=timeandaction&add=yes&styleid=<?php echo $_GET['styleid']; ?>">Yes</a>
				  <input type="hidden" class="erpint" style="border: none;" name="tna" id="tna" value="Yes" readonly></td>
                         <?php } else { ?>
                  <td><input type="text" class="erpint" style="border: none;" name="tna" id="tna" value="No" readonly></td>
                <?php } ?>

                         <td style="width:26%"><div style="text-transform:capitalize"><b>Fabric & Trim Indent</b></div></td>
	 <?php
 $qtyTotal =0;
$grossTotal = 0;
$selectqty='*';
$whereqty='styleId="'.decode($_GET['styleid']).'"';
$rsqty=GetPageRecord($selectqty,'buyerPurchaseOrderMaster',$whereqty);
$resultqty=mysqli_fetch_array($rsqty);
						 ?>
                         <td><!--<input type="text" class="erpint" name="fabrictrim" id="fabrictrim" value="<?php echo $operation['fabrictrim'] ?>">-->
						 <a href="showpage.crm?module=approvedindent&add=yes&styleid=<?php echo $_GET['styleid']; ?>&indentno=<?php echo encode($resultqty['indentNumber']); ?>" target="_blank">GO TO Indent</a>
						 </td>                     </tr>
                     <tr>
                          <td style="width:18%;"><div style="text-transform:capitalize;"><b>CAD&nbsp;Marker</b></div></td>
  <td>
<?php
$whereccc='styleId="'.decode($_GET['styleid']).'" and sectionType="marker" order by id desc';
$rsccc=GetPageRecord('attachtp','techpackPatternMarkerUpload',$whereccc);
$resultccc=mysqli_fetch_array($rsccc);
?>
						 <div><?php echo $operation['cadmarker'] ?></div>
						 	<?php if($operation['cadmarker']=="Done"){ ?>
							<a href="images/<?php echo $resultccc['attachtp']; ?>" target="_blank">View Attachment</a>
							<?php } ?>
						 </td>                         <td><div style="text-transform:capitalize"><b>FPT&nbsp;Report</b></div></td>
                         <td>
                             <?php
                  $tdra=GetPageRecord('*','criticalPathMaster','1 and styleId="'.$editresultstyle['id'].'" limit 1');
                  if(mysql_num_rows($tdra) > "0") {
                  while($new1=mysqli_fetch_array($tdra)) {

                    if($new1['devFtp']!="" and $new1['bulkFtp']!=""){ ?>
                    <div style="font-size: 15px">Completed</div>
                  <?php  }
                  else if($new1['devFtp']!="" || $new1['bulkFtp']!="") { ?>
                  <div style="font-size: 15px">Partial</div>
                  <?php } else{ ?>
                  <div style="font-size: 15px">Pending</div>
                  <?php } } }
                  else{ ?>
                  <div style="font-size: 15px">Pending</div>
                   <?php } ?>
                         </td>
                     </tr>
                      <tr>

                         <td><div style="text-transform:capitalize"><b>GPT&nbsp;Report</b></div></td>
                         <td>
                            <?php
                  $tdra=GetPageRecord('*','criticalPathMaster','1 and styleId="'.$editresultstyle['id'].'" limit 1');
                  if(mysql_num_rows($tdra) > "0") {
                  while($new1=mysqli_fetch_array($tdra)) {

                    if($new1['devGtp']!="" and $new1['bulkGtp']!=""){ ?>
                     <div style="font-size: 15px">Completed</div>
                  <?php  }
                  else if($new1['devGtp']!="" || $new1['bulkGtp']!="") { ?>
                  <div style="font-size: 15px">Partial</div>
                  <?php } else{ ?>
                  <div style="font-size: 15px">Pending</div>
                  <?php } } }
                  else{ ?>
                  <div style="font-size: 15px">Pending</div>
                   <?php } ?>
                         </td>
                         <td style="width:26%"><div style="text-transform:capitalize"><b>Approved&nbsp;Fabric&nbsp;FOB&nbsp;&&nbsp;Lots </b></div></td>
                         <td>
                             <?php if($operation['fob'] == "1" ) { ?>
                          <div style="font-size: 15px">Partial</div>
                         <?php } if($operation['fob'] == "2" ) { ?>
                          <div style="font-size: 15px">Pending</div>
                        <?php } if($operation['fob'] == "3" ) { ?>
                          <div style="font-size: 15px">Completed</div>
                        <?php } ?>
						   <a href="showpage.crm?module=criticalpath&add=yes&styleid=<?php echo $_GET['styleid']; ?>">Click for Details</a>


 </td>
                     </tr>
                     <!--<tr>-->
                     <!--    <td><div style="text-transform:capitalize"><b>Approved&nbsp;Fabric&nbsp;FOB with&nbsp;Value&nbsp;Addition</b></div></td>-->
                     <!--    <td>-->
                     <!--       <?php if($operation['fobadd'] == "1" ) { ?>-->
                     <!--     <div style="font-size: 15px">Partial</div>-->
                     <!--    <?php } if($operation['fobadd'] == "2" ) { ?>-->
                     <!--     <div style="font-size: 15px">Pending</div>-->
                     <!--   <?php } if($operation['fobadd'] == "3" ) { ?>-->
                     <!--     <div style="font-size: 15px">Completed</div>-->
                     <!--   <?php } ?>-->
                     <!--    </td>-->
                     <!--    <td style="width:26%"><div style="text-transform:capitalize"><b>Fabric</b></div></td>-->
                     <!--    <td><div style="font-size: 15px"><?php echo $operation['fabric'] ?></div></td>-->
                     <!--</tr>-->
               </table>
<?php
ob_start();
include "inc.php";
$assignto="Download";
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
$patternAttachment = $editresultstyle['patternAttachment'];
$attachmentFile = $editresultstyle['attachmentFile'];
$techpackdescription = $editresultstyle['techpackdescription'];
$stle = $editresultstyle['styleRefId'];
$lastId=$editresultstyle['id'];

 }

header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment; filename=\"".$assignto."_".date('d-m-Y-H-i-s').".xls");
header("Cache-control: private");

?>




				     <?php
				     $rrrr=GetPageRecord('*','randdMaster','1 and styleId="'.decode($_GET['styleid']).'"');
				     $operationData=mysqli_fetch_array($rrrr);

				     ?>

				      <?php
                      $rsfab=GetPageRecord('*','styleSubCategoryMaster','materialType=1 and styleId="'.decode($_GET['styleid']).'" and costsheetVersionId="1" and name!=""');
					  $resultfab=mysqli_fetch_array($rsfab);

					  $rss=GetPageRecord('*','fabricDetailSheetMaster','fabricName in (select id from materialMaster where name="'.$resultfab['name'].'")');
					  $rslistss=mysqli_fetch_array($rss);
					  ?>
               	 <h3>Style no.
							<?php echo $stle; ?></h3>
                          <table class="table-hover" width="100%" style="border:1px solid black">
                          <tr>

                         <td><div style="text-transform:capitalize"><b>FDS&nbsp;Full&nbsp;width</b></div></td>
                         <td style="width:22%">
                             <?php echo $rslistss['fullwidthInches']; ?>

                          <?php if($operationData['unit2']=="meter"){

                                 echo "meters";
                             }
                             ?>

                             <select style="width:45%;" class="erpint" name="uom2" id="">
                             <option value="meter" <?php if($operationData['unit2'] == "meter") {?> selected <?php } ?>>meters</option>
                             <option value="cms" <?php if($operationData['unit2'] == "cms") {?> selected <?php } ?>>cms</option>
                             <option value="inches" <?php if($operationData['unit2'] == "inches") {?> selected <?php } ?>>inches</option>

                             </select>


                           </td>
                           <td><div style="text-transform:capitalize"><b>Bulk&nbsp;Full&nbsp;width</b></div></td>
                           <td style="width:22%">
                             <?php echo $operationData['fullWidthb'] ?>&nbsp;
                             <select style="width:45%;" class="erpint <?php if($operationData['unit6']!=''){ echo 'readonly'; } ?>" name="uom6" id="">
                             <option value="meter" <?php if($operationData['unit6'] == "meter") {?> selected <?php } ?>>meters</option>
                             <option value="cms" <?php if($operationData['unit6'] == "cms") {?> selected <?php } ?>>cms</option>
                            <option value="inches" <?php if($operationData['unit6'] == "inches") {?> selected <?php } ?>>inches</option>

                           </select>
                           </td>

                        </tr>
                        <tr>
                        <td><div style="text-transform:capitalize"><b>FDS&nbsp;Cut&nbsp;width</b></div></td>
                        <td>
                               <?php echo $rslistss['cuttablewidthinches']; ?>
                              <select style="width:45%;" class="erpint" name="uom4" id="">
                             <option value="meter" <?php if($operationData['unit4'] == "meter") {?> selected <?php } ?>>meters</option>

                         <option value="cms" <?php if($operationData['unit4'] == "cms") {?> selected <?php } ?>>cms</option>
                              <option value="inches" <?php if($operationData['unit4'] == "inches") {?> selected <?php } ?>>inches</option>

                           </select>

                         </td>
                          <td><div style="text-transform:capitalize"><b>Bulk&nbsp;Cut&nbsp;width</b></div></td>
                         <td><?php echo $operationData['cutWidthb'] ?>&nbsp;
                         <select style="width:45%;" class="erpint <?php if($operationData['unit7']!=''){ echo 'readonly'; } ?>" name="uom7" id="">
                         <option value="meter" <?php if($operationData['unit7'] == "meter") {?> selected <?php } ?>>meters</option>
                         <option value="cms" <?php if($operationData['unit7'] == "cms") {?> selected <?php } ?>>cms</option>
                         <option value="inches" <?php if($operationData['unit7'] == "inches") {?> selected <?php } ?>>inches</option>

                         </select>
                         </td>
                        </tr>
                         <tr>
                              <td><div style="text-transform:capitalize"><b>FDS&nbsp;Shrinkage&nbsp;Lengthwise</b></div></td>
                         <td>
                             <?php echo $rslistss['shrinkagewarp']; ?>
                            <select style="width:45%;" class="erpint <?php if($operationData['unit3']!=''){ echo 'readonly'; } ?>" name="uom3" id="">
                             <option value="meter" <?php if($operationData['unit3'] == "meter") {?> selected <?php } ?>>meters</option>
                             <option value="cms" <?php if($operationData['unit3'] == "cms") {?> selected <?php } ?>>cms</option>
                             <option value="inches" <?php if($operationData['unit3'] == "inches") {?> selected <?php } ?>>inches</option>


                           </select>

                         </td>

                         <td><div style="text-transform:capitalize"><b>Bulk&nbsp;Shrinkage&nbsp;Lengthwise</b></div></td>
                         <td><?php echo $operationData['lengthWiseb'] ?>&nbsp;

                         <select style="width:45%;" class="erpint <?php if($operationData['unit8']!=''){ echo 'readonly'; } ?>" name="uom8" id="">
                             <option value="meter" <?php if($operationData['unit8'] == "meter") {?> selected <?php } ?>>meters</option>
                             <option value="cms" <?php if($operationData['unit8'] == "cms") {?> selected <?php } ?>>cms</option>
                                <option value="inches" <?php if($operationData['unit8'] == "inches") {?> selected <?php } ?>>inches</option>

                           </select>
                         </td>
                        </tr>
                         <tr>
                        <td><div style="text-transform:capitalize"><b>FDS&nbsp;Shrinkage&nbsp;Widthwise</b></div></td>
                         <td>
                            <?php echo $rslistss['shrinkageweft']; ?>
                             <select style="width:45%;" class="erpint <?php if($operationData['unit5']!=''){ echo 'readonly'; } ?>" name="uom5" id="">
                             <option value="meter" <?php if($operationData['unit5'] == "meter") {?> selected <?php } ?>>meters</option>
                             <option value="cms" <?php if($operationData['unit5'] == "cms") {?> selected <?php } ?>>cms</option>
                               <option value="inches" <?php if($operationData['unit5'] == "inches") {?> selected <?php } ?>>inches</option>

                           </select>

                         </td>
                         <td><div style="text-transform:capitalize"><b>Bulk&nbsp;Shrinkage&nbsp;Widthwise</b></div></td>
                         <td><?php echo $operationData['widthWiseb'] ?>&nbsp;
                         <select style="width:45%;" class="erpint <?php if($operationData['unit9']!=''){ echo 'readonly'; } ?>" name="uom9" id="">
                             <option value="meter" <?php if($operationData['unit9'] == "meter") {?> selected <?php } ?>>meters</option>
                             <option value="cms" <?php if($operationData['unit9'] == "cms") {?> selected <?php } ?>>cms</option>
                               <option value="inches" <?php if($operationData['unit9'] == "inches") {?> selected <?php } ?>>inches</option>

                           </select>
                         </td>
                        </tr>
                     </table>

                      <td colspan="2"  style="">
                             <table class="table-hover" width="100%" style="border:1px solid black">
                        <tr>
                         <td><div style="text-transform:capitalize"><b>Shell Fabric</b></div></td>
                         <td><?php echo $operationData['shellFabric'] ?></td>
                         <td><div style="text-transform:capitalize"><b>Marker Size</b></div></td>
                         <td><?php echo $operationData['markerSize'] ?></td>
                        </tr>
                        <tr>
                         <td><div style="text-transform:capitalize"><b>Lining Fabric</b></div></td>
                         <td><?php echo $operationData['liningFabric'] ?></td>
                         <td><div style="text-transform:capitalize"><b>Nested Pieces</b></div></td>
                         <td><?php echo $operationData['nestedPiece'] ?></td>
                        </tr>
                        <tr>
                         <td><div style="text-transform:capitalize"><b>Border Print</b></div></td>
                         <td>
                                 <?php if($operationData['borderPrint'] == "1")
                                    {
                                    echo "Yes";
                                    }
                                    ?>

                                    <?php if($operationData['borderPrint'] == "2")
                                    {
                                    echo "No";
                                    }
                                    ?>

                                    <?php if($operationData['borderPrint'] == "3")
                                    {
                                    echo "Engineered Print";
                                    }
                                    ?>

                                    <?php if($operationData['borderPrint'] == "4")
                                    {
                                    echo "One Way Print";
                                    }
                                    ?>

                     </td>
                         <td><div style="text-transform:capitalize"><b>Marker Efficiency</b></div></td>
                         <td><?php echo $operationData['markerEff'] ?></td>
                        </tr>
                        <tr>
                         <td><div style="text-transform:capitalize"><b>Grain/Print Placement</b></div></td>
                         <td>
                             <?php if($operationData['placement'] == "1")
                                    {
                                    echo "Straight Grain";
                                    }
                                    ?>
                                    <?php if($operationData['placement'] == "2")
                                    {
                                    echo "Biased Grain";
                                    }
                                    ?>

                         </td>
                         <td><div style="text-transform:capitalize"><b>Seam Allowance</b></div></td>
                         <td><?php echo $operationData['seamAllow'] ?></td>
                        </tr>
                        </table>
                     </td>
                    <?php
$newdata = explode(':', $operationData['operation']);
?>




                         <table class="table-hover" width="100%" style="border:1px solid black;">
                         <tr>
                         <td style="width:16%"><div style="text-transform:capitalize"><b>Critical Operation</b></div></td>
                         <td>

							<?php
							$abc=GetPageRecord('*','assemblyoperationsMaster','1 and status=1 and deletestatus=0 order by name asc');
							while($critical=mysqli_fetch_array($abc)) {

							?>
								  <?php foreach($newdata as $operation){ if($operation == $critical['name'])
                                    {
                                   echo $critical['name'];
                                    }

                                  ?>

                                    <?php } ?>

							<?php } ?>

                         </td>
                         <?php
$newdata = explode(':', $operationData['highSam']);
?>
                         <td style="width:16%"><div style="text-transform:capitalize"><b>High SAM Operation</b></div></td>
                         <td>


                            <?php
                            $abf=GetPageRecord('*','assemblyoperationsMaster','1 and status=1 and deletestatus=0 order by name asc');
                            while($sam=mysqli_fetch_array($abf)) {

                            ?>
                            <?php foreach($newdata as $operation){ if($operation == $sam['name'])
                                    {
                                   echo $sam['name'];
                                    }
                                    ?>
                                    <?php } ?>

                            <?php } ?>

                        </td>
                        </tr>



                        <tr>
                         <td style="width:16%"><div style="text-transform:capitalize"><b>Additional Operation</b></div></td>
    <?php
$newdata = explode(':', $operationData['addOperate']);
?>
                         <td>

                            <?php
                            $abj=GetPageRecord('*','assemblyoperationsMaster','1 and status=1 and deletestatus=0 order by name asc');
                            while($operate=mysqli_fetch_array($abj)) {

                            ?>

                             <?php foreach($newdata as $operation){ if($operation == $operate['name'])
                                    {
                                   echo $operate['name'];
                                    }
                                    ?>
                                    <?php } ?>


                            <?php } ?>

                         </td>
                         <td style="text-align:center"><div style="text-transform:capitalize"><b>Additional Process</b></div></td>
                         <td><?php echo $operationData['addProcess'] ?></td>
                          <?php
					 if($operationData['techName']==''){
					 	$techName = getUserName($_SESSION['userid']);
					 }else{
					 	$techName = $operationData['techName'];
					 }
					 ?>

                        <tr>
                         <td style="width:16%"><div style="text-transform:capitalize"><b>Technical Name</b></div></td>
                         <td><?php echo $techName; ?></td>
                         <td style="text-align:end;width:23%"><div style="text-transform:capitalize"><b>Technical Approval/Submission</b></div></td>
                         <td>
                             <?php if($operationData['techFinal']=="1"){

                                 echo "WIP";
                             }else{
                               echo "Complete";
                             }
                             ?>

						 </td>
                        </tr>

                        </tr>
                        </table>



<?php   
ob_start();  
include "inc.php";
$assignto="Download";
 
header("Content-type: application/vnd.ms-excel;charset=UTF-8"); 
header("Content-Disposition: attachment; filename=\"".$assignto."_".date('d-m-Y-H-i-s').".xls");
header("Cache-control: private");
 
?> 
       <table class="table table-bordered table-hover no-footer">
                    <thead style="background-color: #f5f5f5;">
                      <tr role="row">
                         <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"><div align="center">Buyer</div></th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"><div align="center">Brand&nbsp;'s&nbsp;Season</div></th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"><div align="center">Production&nbsp;Season</div></th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"><div align="center">Planned</div></th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" ><div align="center">Actual</div></th>
						  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" ><div align="center">Short</div></th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"><div align="center">Excess</div></th>
                          
                      </tr>
                    </thead>
                    <tbody id="allhotellisting">
                     
                   <tr role="row" class="odd" <?php if($resultlists['stylestatus']=='0'){ ?> style="" <?php } ?>>
                           
                <td><div align="center">AEO</div></td>
                  <td><div align="center">Spring</div></td>
                  <td><div align="center"> Spring</div></td>
                  <td><div align="center">1200000 </div></td>
                  <td><div align="center">1475000</div></td>
                  <td><div align="center">0 </div></td>
                  <td><div align="center">275000</div></td>
     
						
                          
                          
                          
                                              </tr>
                                              
                                              
                                               <tr role="row" class="odd" <?php if($resultlists['stylestatus']=='0'){ ?> style="" <?php } ?>>
                           
                <td><div align="center">Gap</div></td>
                  <td><div align="center">Summer</div></td>
                  <td><div align="center">Summer</div></td>
                  <td><div align="center">1200000 </div></td>
                  <td><div align="center">1050000</div></td>
                  <td><div align="center"> 150000</div></td>
                  <td><div align="center">0</div></td>
     
						
                          
                          
                          
                                              </tr>
                                              
                                              
                                               <tr role="row" class="odd" <?php if($resultlists['stylestatus']=='0'){ ?> style="" <?php } ?>>
                           
                <td><div align="center">Ralph Lauren</div></td>
                  <td><div align="center"> Fall</div></td>
                  <td><div align="center">Fall</div></td>
                  <td><div align="center">1200000 </div></td>
                  <td><div align="center">0</div></td>
                  <td><div align="center">1200000 </div></td>
                  <td><div align="center">0</div></td>
     
						
                          
                          
                          
                                              </tr>
                                              
                                              
                                              
                                               <tr role="row" class="odd" <?php if($resultlists['stylestatus']=='0'){ ?> style="" <?php } ?>>
                           
                <td><div align="center">Lifestyle</div></td>
                  <td><div align="center">Holiday</div></td>
                  <td><div align="center"> Holiday</div></td>
                  <td><div align="center">1200000 </div></td>
                  <td><div align="center">0</div></td>
                  <td><div align="center">1200000 </div></td>
                  <td><div align="center">0</div></td>
     
						
                          
                          
                          
                                              </tr>
                       
                       
                         <tr role="row" class="odd" <?php if($resultlists['stylestatus']=='0'){ ?> style="" <?php } ?>>
                           
                <td><div align="center"></div></td>
                  <td><div align="center"></div></td>
                  <td><div align="center"> </div></td>
                  <td><div align="center"> </div></td>
                  <td><div align="center"></div></td>
                  <td><div align="center"> </div></td>
                  <td><div align="center"></div></td>
     
						
                          
                          
                          
                                              </tr>
                                              
                                              
                                              
                                                </tr>
                       
                       
                         <tr role="row" class="odd" <?php if($resultlists['stylestatus']=='0'){ ?> style="" <?php } ?>>
                           
                <td><div align="center"></div></td>
                  <td><div align="center"></div></td>
                  <td><div align="center"> Total</div></td>
                  <td><div align="center">4800000 </div></td>
                  <td><div align="center">2525000</div></td>
                  <td><div align="center">2550000 </div></td>
                  <td><div align="center">275000</div></td>
     
						
                          
                          
                          
                                              </tr>

                     
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
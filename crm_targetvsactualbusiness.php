<div class="page-content">
  <style>
.select2-container{
width:190px !important;
}
</style>
  <!-- Main sidebar -->
  <div class="content-wrapper">
    <?php include "savealert.php"; ?>
    <div class="content pt-0" style="margin-top:20px;">
      <div class="row">
        <div class="col-xl-12">
          <div class="card-header header-elements-inline bg-blue-700 filterable" style="padding: 10px;">
            <div class="col-xl-9">
              <h5 class="card-title"><?php echo $pageName; ?></h5>
            </div>
            <div class="col-xl-1" style="padding-right: 0px;"> 
            
            </div>
              <a href="download-targetvsactualbusiness.php" class="btn bg-teal-400 addnotify" aria-expanded="false" style="background-color: #03d873b8;">Download Excel</a>
          </div>
          <div class="card">
          
            <form name="listform" id="listform" method="get">
              <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
              <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                <div class="datatable-scroll">
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
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<style>
.dataTables_info,.dataTables_paginate,.dataTables_length {
  display:none !important; 
 } 
</style>
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

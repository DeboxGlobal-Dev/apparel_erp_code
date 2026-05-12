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
            <div class="col-xl-3" style="padding-right: 0px;"> </div>
           </div>
           <div class="card">

            <form name="listform" id="listform" method="get">
              <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
              <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                <div class="datatable-scroll">
                  <table class="table table-bordered table-hover no-footer">
                    <thead style="background-color: #f5f5f5;">
                      <tr role="row">
						<th >Style</th>
						<th>Description</th>
						<!--<th>Category</th>-->
						<!--<th>Sub&nbsp;Category</th>-->
						<!--<th>Department</th>	-->
						<!--<th>Assign&nbsp;To</th>-->
						<th style="text-align: center;">Status</th>
                      </tr>
                    </thead>
                    <tbody id="allhotellisting">
                      <?php
$no=0;
$select='*';
$where='';
$rs='';
$wheresearch='';
//$limit='20000';
$limit=clean($_GET['records']);


if($_GET['stylerefid']!=''){
$stylerefCondition = 'and id="'.decode($_GET['stylerefid']).'"';
}



$where='where '.$wheresearchassign.' subject!="" '.$stylerefCondition.' and sampleStyle=1 and deletestatus=0 order by id desc';
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&stylerefid='.$_GET['stylerefid'].'&';

$rs=GetRecordList($select,_QUERY_MASTER_,$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){


$tdr=GetPageRecord('*','styleColorDetailMaster','1 and styleId="'.$resultlists['id'].'"');
$temnamer=mysqli_fetch_array($tdr);
if(mysql_num_rows($tdr) > "0"){

$tdra=GetPageRecord('*','queryMaster','1 and id="'.$temnamer['styleId'].'"');
$temnamera=mysqli_fetch_array($tdra);

?>
                      <tr>
								 <td>
								 <a href="showpage.crm?module=criticalpath&add=yes&styleid=<?php echo encode($resultlists['id']); ?>"><?php echo '#'.$temnamera['styleRefId']; ?></a>
								 <a href="showpage.crm?module=timeandaction&add=yes&styleid=<?php echo encode($resultlists['id']); ?>">

								 </a>
								 </td>

								<td><?php echo $temnamera['subject']; ?></td>



												<td align="center">
                  <?php

                  $qq=0;
                   $tdr=GetPageRecord('*','styleColorDetailMaster','1 and styleId="'.$resultlists['id'].'"');
                    while($temnamer=mysqli_fetch_array($tdr)){

                    $tdra=GetPageRecord('*','colorCardMaster','1 and id="'.$temnamer['colorId'] .'"');
                    $temnamera=mysqli_fetch_array($tdra);
                    $crt=mysql_num_rows($tdra);
                    $qq=$qq+1;

                    }


                  $aw=0;
                  $tdra=GetPageRecord('*','criticpop','1 and styleid="'.$resultlists['id'].'"');
                  $new1=mysql_num_rows($tdra);



                  $fnal=$qq * 12;

                    if($fnal == $new1){ ?>
                    <span class="badge" style="background-color: green; color:#FFFFFF; position: relative;">Complete</span>
                  <?php  }
                  else if($new1 > 0 ) { ?>
                  <span class="badge" style="background-color: orange; color:#FFFFFF; position: relative;">Partial</span>
                  <?php } else{ ?>
                  <span class="badge" style="background-color:#e83333; color:#FFFFFF; position: relative;">Pending<?php echo $new1['id']; ?></span>
                  <?php }




                //   else{

                  ?>
                  <!--<span class="badge" style="background-color:#e83333; color:#FFFFFF; position: relative;">Pending<?php echo $new1['id']; ?></span>-->
                   <?php //}


                  ?>

                </td>
							</tr>
                      <?php } } ?>
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

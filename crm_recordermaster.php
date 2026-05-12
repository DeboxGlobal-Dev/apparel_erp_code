<div class="page-content">
  <div class="content-wrapper">
    <?php include "savealert.php"; ?>
    <div class="content pt-0 filterable" style="margin-top:20px;">
      <div class="row">
        <div class="col-xl-12">
          <div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
            <div class="col-xl-12">
              <h5 class="card-title" ><?php echo $pageName; ?></h5>
            </div>
          </div>
          <div class="card">
            <div class="row" style="margin-top:20px;">
              <div class="col-md-12" style=" padding:0px 25px;">
                <form action="" method="get">
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <input type="text" placeholder="Search:" name="filtersearch" id="filtersearch" class="form-control"/>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="card">
            <form name="listform" id="listform" method="get">
              <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
              <div id="pageload">
                <div id="" >
                  <div class="datatable-scroll">
                    <table class="table table-bordered table-hover" style="width:100%;">
                      <thead style="background-color: #f5f5f5;">
                        <tr>
                          <td><strong>Name</strong></td>
                          <td><strong>Factory</strong></td>
                          <td><strong>Line</strong></td>
                          <td align="center"><strong>Action</strong></td>
                        </tr>
                      </thead>
                      <tbody id="allhotellisting">
                        <?php
$no=1;
$select='*';
$where='';
$rs='';
$wheresearch='';
$limit=clean($_GET['records']);
$page=$_GET['page'];

$where='where  profileId=157 order by id desc';

$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&loginuserprofileId='.$loginuserprofileId.'&categoryId='.$_GET['categoryId'].'&';


$rs=GetRecordListJs($select,'userMaster',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

$rskk=GetPageRecord('*','recorderMaster','userid="'.$resultlists['id'].'"');
					  	$recorderData=mysqli_fetch_array($rskk);

?>
                        <tr>
								<td class="sorting_1"><a href="#" onClick="opmodalpop('Edit Recorder Master','modalpop.php?action=<?php echo $_GET['module']; ?>&id=<?php echo encode($recorderData['id']); ?>&userid=<?php echo encode($resultlists['id']); ?>','600px','auto');" data-toggle="modal" data-target="#modalpop"><?php echo $resultlists['firstName'].' '.$resultlists['lastName']; ?></a></td>

								<td>
								<?php
							 	$a=GetPageRecord('*','factoryMaster','id="'.$recorderData['factoryId'].'"');
								$selectdata=mysqli_fetch_array($a);
								echo $selectdata['name'];
								?>
								</td>
								<td>
								<?php
								$rk=GetPageRecord('*','recorderMaster','userid="'.$resultlists['id'].'"');
					  	        while($rkdata=mysqli_fetch_array($rk)){
								$b=GetPageRecord('*','factoryLineMaster','id="'.$rkdata['line'].'"');
								$linedata=mysqli_fetch_array($b);
								?>
								<span style="padding: 5px 10px; background-color: #0097a7; color: #fff; margin-right: 2px; font-size: 12px;"><?php echo $linedata['lineName']; ?></span>
							    <?php
								}

								?></td>
								<td class="text-center">
				<a href="#" onClick="opmodalpop('Edit Recorder Master','modalpop.php?action=<?php echo $_GET['module']; ?>&id=<?php echo encode($recorderData['id']); ?>&userid=<?php echo encode($resultlists['id']); ?>','600px','auto');" data-toggle="modal"   data-target="#modalpop" ><button type="button" class="btn btn-warning" style="padding:5px;"><i class="fa fa-pencil" aria-hidden="true" style=" color: #fffffff1;   font-size: 16px; "></i></button></a>								</td>
							</tr>
                        <?php } ?>
                      </tbody>
                    </table>
                    <div class="pagingdiv" style="width: 97%;margin: 20px auto;">
                      <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                          <tr>
                            <td><table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td style="padding-right:20px;"><?php echo $totalentry; ?> entries</td>
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
                    </div>
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

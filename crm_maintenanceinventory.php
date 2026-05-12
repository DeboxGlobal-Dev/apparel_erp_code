<div class="page-content">
  <div class="content-wrapper">
    <?php include "savealert.php"; ?>
    <div class="content pt-0 filterable" style="margin-top:20px;">
      <div class="row">
        <div class="col-xl-12">
          <div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
            <div class="col-xl-9">
              <h5 class="card-title" ><?php echo $pageName; ?></h5>
            </div>
            <!--<div class="col-xl-3" style="    padding-right: 0px;">-->
            <!--  <div class="btn-group justify-content-center" style="float:right;">-->

            <!--    <a href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes" class="btn bg-teal-400 addnotify" aria-expanded="false" style="    background-color: #03d873b8;"  ><i class="fa fa-plus" aria-hidden="true"></i> Create New</a>-->

            <!--  </div>-->
            <!--</div>-->
          </div>
          <!--<div class="card">-->
          <!--  <div class="row" style="margin-top:20px;">-->
          <!--    <div class="col-md-12" style=" padding:0px 25px;">-->
          <!--      <form action="" method="get">-->
          <!--        <div class="row">-->
          <!--          <div class="col-md-2">-->
          <!--            <div class="form-group">-->
          <!--              <input type="text" placeholder="Search:" name="filtersearch" id="filtersearch" class="form-control"/>-->
          <!--            </div>-->
          <!--          </div>-->
          <!--          <div class="col-md-2">-->
          <!--            <div class="form-group">-->
          <!--              <input name="" type="submit" id="" class=" btn btn-primary" value="Search" />-->
          <!--              <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />-->
          <!--            </div>-->
          <!--          </div>-->
          <!--        </div>-->
          <!--      </form>-->
          <!--    </div>-->
          <!--  </div>-->
          <!--</div>-->
          <div class="card">
            <form name="listform" id="listform" method="get">
              <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
              <div id="pageload">
                <div id="" >
                  <div class="datatable-scroll">
                    <table class="table table-bordered table-hover" style="width:100%;">
                      <thead style="background-color: #f5f5f5;">
                        <tr>
                                                      <td><strong>Requisition No</strong></td>

                          <td><strong>Item Name</strong></td>
                          <td><strong>For Department</strong></td>

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

$where='where 1 and status="2" and grnStatus="1" order by id desc';

$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&loginuserprofileId='.$loginuserprofileId.'&categoryId='.$_GET['categoryId'].'&';


$rs=GetRecordListJs($select,'maintenancegateentrymaster',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){



$queryDataq=GetPageRecord($select,'maintenancegateentrymaster','1 and parentId="'.$resultlists['id'].'"');
$queryData=mysqli_fetch_array($queryDataq);

	$wherenew='id="'.$resultlists['ponumber'].'"';
	$rsnew=GetPageRecord('*','requisitionIndentMaster',$wherenew);
$rslistnew=mysqli_fetch_array($rsnew);

	$wherenewd='id="'.$rslistnew['mainid'].'"';
	$rsnewd=GetPageRecord('*','loadmaintenance',$wherenewd);
$rslistnewd=mysqli_fetch_array($rsnewd);

$wherenewde='id="'.$rslistnewd['item'].'"';
	$rsnewde=GetPageRecord('*','maintenancegeneral_Master',$wherenewde);
$rslistnewde=mysqli_fetch_array($rsnewde);


// $instypeDataq=GetPageRecord('id,name','inspectiontypemaster','1 and id="'.$resultlists['inspectionType'].'" order by id');
// $instypeData=mysqli_fetch_array($instypeDataq);

?>
                        <tr>
                          <td><a href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes&requisitionid=<?php echo encode($resultlists['ponumber']); ?>"><?php echo $queryData['requisitionNo']; ?></a></td>
                          <td><?php echo $rslistnewde['material']; ?></td>
                          <td><?php echo $instypeData['name']; ?></td>

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

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
            <div class="col-xl-3" style="    padding-right: 0px;">
              <div class="btn-group justify-content-center" style="float:right;">
                <?php if($addpermission==1){ ?>
                <a href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes" class="btn bg-teal-400 addnotify" aria-expanded="false" style="    background-color: #03d873b8;"  ><i class="fa fa-plus" aria-hidden="true"></i> Create New</a>
                <?php } ?>
              </div>
            </div>
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
                <table class="table table-bordered table-responsive capacity-class" style="width:100%;">
                      <thead style="background-color: #f5f5f5;">
                        <tr>
                          <td><strong>SNo.</strong></td>
                          <td width="30"><strong>Order/Indent&nbsp;No.</strong></td>
                          <td><strong>Item&nbsp;Name</strong></td>
                          <td><strong>Color</strong></td>
                          <td><div align="center"><strong>Size</strong></div></td>
                          <td align="center"><strong>Supplier</strong></td>

                          <td><strong>Item&nbsp;Id</strong></td>
                          <td><strong> Requested&nbsp;Quantity</strong></td>
                          <td><strong>Ordered&nbsp;Quantity </strong></td>
                          <td><strong>Received/GRN</strong></td>
                          <td><div align="center"><strong>G&nbsp;E&nbsp;No&nbsp;-&nbsp;GRN&nbsp;No</strong></div></td>
                          <td align="center"><strong>Inspected&nbsp;Qty</strong></td>

                           <td><strong>Issued&nbsp;Till&nbsp;Date</strong></td>
                          <td><div align="center"><strong>In&nbsp;Hand</strong></div></td>
                          <td align="center"><strong>Transact</strong></td>
                        </tr>
                      </thead>
                      <tbody id="allhotellisting">
                        <?php
$no=1;
$select='*';
$where='';
// $rs='';
// $wheresearch='';
// $limit=clean($_GET['records']);
// $page=$_GET['page'];

// $where='where 1 and styleId!=0 order by id desc';

// $targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&loginuserprofileId='.$loginuserprofileId.'&categoryId='.$_GET['categoryId'].'&';


// $rs=GetRecordListJs($select,'inspectioninput',$where,$limit,$page,$targetpage);
// $totalentry=$rs[1];
// $paging=$rs[2];
// $resultlists=mysqli_fetch_array($rs[0]);

$wherenew='id="'.decode($_GET['requisitionid']).'"';
	$rsnew=GetPageRecord('*','requisitionIndentMaster',$wherenew);
$rslistnew=mysqli_fetch_array($rsnew);

$qu=GetPageRecord('SUM(orderQty) as totalorder','requisitionIndentMaster','1 and mainid="'.$rslistnew['mainid'].'"');
$quer=mysqli_fetch_array($qu);

$queryDataq=GetPageRecord('*','loadmaintenance','1 and id="'.$rslistnew['mainid'].'"');
$queryData=mysqli_fetch_array($queryDataq);


$instypeDataq=GetPageRecord('*','maintenancegi_Master','1 and id="'.$queryData['parentId'].'" order by id');
$instypeData=mysqli_fetch_array($instypeDataq);

$wherenewde='id="'.$queryData['item'].'"';
	$rsnewde=GetPageRecord('*','maintenancegeneral_Master',$wherenewde);
$rslistnewde=mysqli_fetch_array($rsnewde);

 	$wherenewxcz='id="'.$queryData['supplier'].'"';
						    	$rsnewxcz=GetPageRecord('*','suppliersMaster',$wherenewxcz);
						$rslistnewxcz=mysqli_fetch_array($rsnewxcz);

?>
                        <tr>
                          <td>1</td>
                          <td><?php echo 'R-IND'.date('dmy',($instypeData['dateAdded'])); ?>00<?php echo $instypeData['id']; ?></td>
                          <td><?php echo $rslistnewde['material']; ?></td>
                          <td></td>
                          <td class="text-center"><div align="center"><?php  echo $queryData['size']; ?></div></td>

                          <td align="center"><?php  echo $rslistnewxcz['name']; ?></td>


                           <td><?php echo 'MGI-0000'.$rslistnewde['maintenanceid']; ?></td>
                           <td><?php  echo $queryData['requestedquantity']; ?></td>
                           <td><?php echo $quer['totalorder']; ?></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                            </td>
                        </tr>
                        <?php //} ?>
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

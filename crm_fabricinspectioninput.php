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
                    <div class="col-md-2">
                      <div class="form-group">
                        <input name="" type="submit" id="" class=" btn btn-primary" value="Search" />
                        <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
			<div id="collapsible-control-right-group1" class="collapse" style="display:block;">
            <div class="card-body">
              <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                <li class="nav-item"><a href="#highlighted-justified-tab1" class="nav-link active show" data-toggle="tab"><strong>Bulk Fabric Inspection</strong></a></li>
                <li class="nav-item"><a href="#highlighted-justified-tab2" class="nav-link" data-toggle="tab"><strong>Greige Fabric Inspection</strong></a></li>
                <li class="nav-item"><a href="#highlighted-justified-tab3" class="nav-link" data-toggle="tab"><strong>Yarn Fabric Inspection</strong></a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane fade active show" id="highlighted-justified-tab1">
                 <form name="listform" id="listform" method="get">
                <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
                <div id="pageload">
                  <div id="" >
                    <div class="datatable-scroll">
                      <table class="table table-bordered" style="width:100%;">
                        <thead style="background-color: #f5f5f5;">
                          <tr>
                            <td><strong>Style</strong></td>
                            <td><strong>Style Name </strong></td>
                            <td><strong>Category</strong></td>
                            <td><strong></strong></td>
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

$where='where '.$wheresearchassign.' styleStatus!=0 and subject!="" '.$stylestatus.' and poAttachment!="" order by id desc';

$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&loginuserprofileId='.$loginuserprofileId.'&categoryId='.$_GET['categoryId'].'&';

$rs=GetRecordListJs($select,_QUERY_MASTER_,$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

?>
                          <tr>
                            <td align="left"><div align="left"><?php echo '#'.$resultlists['styleRefId']; ?></div></td>
                            <td><div align="left"><?php echo $resultlists['subject']; ?></div></td>
                            <td><div align="left"><?php echo getCategoryName($resultlists['categoryId']).' - '.getSubCategoryName($resultlists['subCategoryId']); ?></div></td>
                            <td><div style="max-height: 200px; overflow-y: auto;">
                                <table style="width:100%; font-size:11px;" class="table-bordered">
                                  <tr style="background-color: #f5f5f5;">
                                    <td width="5%"><div align="center"><strong>SR</strong>.</div></td>
                                    <td width="13%"><strong>GRN No.</strong></td>
                                    <td width="16%"><strong>Supplier PO No.</strong></td>
                                    <td width="41%"><strong>Material</strong></td>
                                    <td width="13%"><strong>Color</strong></td>
                                    <td width="13%"><strong>Received</strong></td>

                                    <td width="13%"><strong>Lot No.</strong></td>
                                    <td width="12%"><strong>Status</strong></td>
                                  </tr>
                        <?php

						$grnDataq=GetPageRecord('*','grnMaster','1 and styleId="'.$resultlists['id'].'" and parentId in (select id from grnMaster where grnNo!="") and materialId in (select id from styleSubCategoryMaster where materialType=1) order by id asc');
						$countgrn=mysql_num_rows($grnDataq);
						if($countgrn>0){
						$lotNo=0;
						while($grnData=mysqli_fetch_array($grnDataq)){
						++$lotNo;

						$grnParentDataq=GetPageRecord('grnNo','grnMaster','1 and id="'.$grnData['parentId'].'"');
						$grnParentData=mysqli_fetch_array($grnParentDataq);

						$materialDataq=GetPageRecord('name,id','styleSubCategoryMaster','id="'.$grnData['materialId'].'"');
						$materialData=mysqli_fetch_array($materialDataq);

            $countqualitymoduleq=GetPageRecord('id','qualitymodulemaster','1 and styleId="'.$resultlists['id'].'" and costsheetVersionId=1 and status=1 and deletestatus=0 and lotNoMaster="'.$lotNo.'" and fabricType=""');
            $countqualitymodule=mysql_num_rows($countqualitymoduleq);

    		            ?>
                                    <tr>
                                    <td><div align="center"><?php echo $lotNo; ?></div></td>
                                    <td><?php echo $grnParentData['grnNo']; ?></td>
                                    <td><?php echo $grnData['supplierPurchaseOrderId']; ?></td>
                                    <td><?php echo $materialData['name']; ?></td>
                                    <td><?php echo getColorName($grnData['color']); ?></td>
                                    <?php

                $rsgrnrec=GetPageRecord('sum(received) as netReceivedTill,color,parentId','grnMaster','styleId="'.$resultlists['id'].'" and materialId="'.$materialData['id'].'" and color="'.$grnData['color'].'" and parentId="'.$grnData['parentId'].'" order by id asc');
				$rsgrnrecTill=mysqli_fetch_array($rsgrnrec);
                                    ?>
                                    <td><?php echo round($rsgrnrecTill['netReceivedTill'],2); ?></td>
                                    <td><a href="showpage.crm?module=<?php echo $_GET['module']; ?>&view=yes&styleid=<?php echo encode($resultlists['id']); ?>&lotId=<?php echo encode($lotNo); ?>&grnid=<?php echo encode($grnData['parentId']); ?>&materialid=<?php echo encode($grnData['materialId']); ?>&colorid=<?php echo encode($grnData['color']); ?>&spo=<?php echo encode($grnData['supplierPurchaseOrderId']); ?>" style="padding: 5px 10px; border: 1px solid #0097a7; color: #0288d1; font-size: 12px; margin-bottom: 0px; margin-right: 5px; display: inline-block;">Lot <?php echo $lotNo; ?></a></td>
                                    <td><?php if($countqualitymodule>0){ ?>
                                      <span style="color: #368006;"><strong>Completed</strong></span>
                                      <?php } else{ ?>
                                      <span style="color: #ff0000;"><strong>Pending</strong></span>
                                      <?php } ?>
                                    </td>
                                  </tr>
                                  <?php }
                                   }
                                  else{ ?>
                                  <tr>
                                    <td colspan="7" align="center" style="text-align:center;">No Data Found</td>
                                  </tr>
                                  <?php }  ?>

                                </table>
                              </div></td>
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
				<div class="tab-pane fade" id="highlighted-justified-tab2">
                  <form name="listform" id="listform" method="get">
                <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
                <div id="pageload">
                  <div id="" >
                    <div class="datatable-scroll">
                      <table class="table table-bordered" style="width:100%;">
                        <thead style="background-color: #f5f5f5;">
                          <tr>
                            <td><strong>Requisition No</strong></td>
                            <td><strong>Greige Style No</strong></td>
                            <td><strong>Brand</strong></td>
                            <td><strong> </strong></td>
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

$where='where 1 and brandId!=0 and seasonId!=0 order by id desc';

$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&loginuserprofileId='.$loginuserprofileId.'&categoryId='.$_GET['categoryId'].'&';

$rs=GetRecordListJs($select,'greigeRequisition',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

?>
                          <tr>
                            <td align="left"><div align="left"><?php echo $resultlists['requisitionNo']; ?></div></td>
                            <td><div align="left"><?php echo $resultlists['styleNo']; ?></div></td>
                            <td><div align="left"><?php echo getBrandName($resultlists['brandId']); ?></div></td>
                            <td><div style="max-height: 200px; overflow-y: auto;">
                                <table style="width:100%; font-size:11px;" class="table-bordered">
                                  <tr style="background-color: #f5f5f5;">
                                    <td width="5%"><div align="center"><strong>SR</strong>.</div></td>
                                    <td width="13%"><strong>GRN No.</strong></td>
                                    <td width="16%"><strong>Supplier PO No.</strong></td>
                                    <td width="41%"><strong>Material</strong></td>
                                <!--    <td width="13%"><strong>Color</strong></td>-->
                                    <td width="13%"><strong>Lot No.</strong></td>
                                    <td width="12%"><strong>Status</strong></td>
                                  </tr>
                                  <?php

						$grnDataq=GetPageRecord('*','grnMaster','1 and requisitionNo="'.$resultlists['requisitionNo'].'"  and parentId in (select id from grnMaster where grnNo!="") and materialId in (select id from materialMaster where materialtype=1) order by id asc');
						$countgrn=mysql_num_rows($grnDataq);
						if($countgrn>0){
						$lotNo=0;
						while($grnData=mysqli_fetch_array($grnDataq)){
						++$lotNo;

						$grnParentDataq=GetPageRecord('grnNo','grnMaster','1 and id="'.$grnData['parentId'].'"');
						$grnParentData=mysqli_fetch_array($grnParentDataq);

						$materialDataq=GetPageRecord('name','materialMaster','id="'.$grnData['materialId'].'"');
						$materialData=mysqli_fetch_array($materialDataq);

						$greigestyle=GetPageRecord('id','greigeRequisition','requisitionNo="'.$resultlists['requisitionNo'].'"');
						$greigestyleId=mysqli_fetch_array($greigestyle);

$countqualitymoduleq=GetPageRecord('id','qualitymodulemaster','1 and styleId="'.$greigestyleId['id'].'" and costsheetVersionId=1 and status=1 and deletestatus=0 and lotNoMaster="'.$lotNo.'" and fabricType="greige"');
$countqualitymodule=mysql_num_rows($countqualitymoduleq);
    		 ?>
                                  <tr>
                                    <td><div align="center"><?php echo $lotNo; ?></div></td>
                                    <td><?php echo $grnParentData['grnNo']; ?></td>
                                    <td><?php echo $grnData['supplierPurchaseOrderId']; ?></td>
                                    <td><?php echo stripslashes($materialData['name']); ?></td>
                                 	<!--<td><?php
									$rs112=GetPageRecord('name','colorCardMaster','id="'.$grnData['color'].'"');
									$resListing112=mysqli_fetch_array($rs112);
									echo $resListing112['name'];
									?></td>-->
                                    <td><a href="showpage.crm?module=<?php echo $_GET['module']; ?>&view=yes&requisitionNo=<?php echo encode($resultlists['requisitionNo']); ?>&lotId=<?php echo encode($lotNo); ?>&styleid=<?php echo encode($greigestyleId['id']); ?>&grnid=<?php echo encode($grnData['parentId']); ?>&materialid=<?php echo encode($grnData['materialId']); ?>&greige=yes&colorid=<?php echo encode($grnData['color']); ?>&spo=<?php echo encode($grnData['supplierPurchaseOrderId']); ?>&fabricType=greige" style="padding: 5px 10px; border: 1px solid #0097a7; color: #0288d1; font-size: 12px; margin-bottom: 0px; margin-right: 5px; display: inline-block;">Lot <?php echo $lotNo; ?></a></td>
                                    <td><?php if($countqualitymodule>0){ ?>
                                      <span style="color: #368006;"><strong>Completed</strong></span>
                                      <?php } else{ ?>
                                      <span style="color: #ff0000;"><strong>Pending</strong></span>
                                      <?php } ?>
                                    </td>
                                  </tr>
                                  <?php } } else{ ?>
                                  <tr>
                                    <td colspan="7" align="center" style="text-align:center;">No Data Found</td>
                                  </tr>
                                  <?php } ?>
                                </table>
                              </div></td>
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
                <div class="tab-pane fade" id="highlighted-justified-tab3">
                  <form name="listform" id="listform" method="get">
                <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
                <div id="pageload">
                  <div id="" >
                    <div class="datatable-scroll">
                      <table class="table table-bordered" style="width:100%;">
                        <thead style="background-color: #f5f5f5;">
                          <tr>
                            <td><strong>Requisition No</strong></td>
                            <td><strong>Yarn Style No</strong></td>
                            <td><strong>Brand</strong></td>
                            <td><strong> </strong></td>
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

$where='where 1 and brandId!=0 and seasonId!=0 order by id desc';

$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&loginuserprofileId='.$loginuserprofileId.'&categoryId='.$_GET['categoryId'].'&';

$rs=GetRecordListJs($select,'yarnRequisition',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

?>
                          <tr>
                            <td align="left"><div align="left"><?php echo $resultlists['requisitionNo']; ?></div></td>
                            <td><div align="left"><?php echo $resultlists['styleNo']; ?></div></td>
                            <td><div align="left"><?php echo getBrandName($resultlists['brandId']); ?></div></td>
                            <td><div style="max-height: 200px; overflow-y: auto;">
                                <table style="width:100%; font-size:11px;" class="table-bordered">
                                  <tr style="background-color: #f5f5f5;">
                                    <td width="5%"><div align="center"><strong>SR</strong>.</div></td>
                                    <td width="13%"><strong>GRN No.</strong></td>
                                    <td width="16%"><strong>Supplier PO No.</strong></td>
                                    <td width="41%"><strong>Material</strong></td>
                                <!--    <td width="13%"><strong>Color</strong></td>-->
                                    <td width="13%"><strong>Lot No.</strong></td>
                                    <td width="12%"><strong>Status</strong></td>
                                  </tr>
                                  <?php

						$grnDataq=GetPageRecord('*','grnMaster','1 and requisitionNo="'.$resultlists['requisitionNo'].'"  and parentId in (select id from grnMaster where grnNo!="") and materialMasterId in (select materialMasterId from indentCreationMaster where isFinal="yes") and materialId in (select id from materialMaster where materialtype=1) order by id asc');
						$countgrn=mysql_num_rows($grnDataq);
						if($countgrn>0){
						$lotNo=0;
						while($grnData=mysqli_fetch_array($grnDataq)){
						++$lotNo;

						$grnParentDataq=GetPageRecord('grnNo','grnMaster','1 and id="'.$grnData['parentId'].'"');
						$grnParentData=mysqli_fetch_array($grnParentDataq);

						$materialDataq=GetPageRecord('name','materialMaster','id="'.$grnData['materialId'].'"');
						$materialData=mysqli_fetch_array($materialDataq);

						$greigestyle=GetPageRecord('id','yarnRequisition','requisitionNo="'.$resultlists['requisitionNo'].'"');
						$greigestyleId=mysqli_fetch_array($greigestyle);

$countqualitymoduleq=GetPageRecord('id','qualitymodulemaster','1 and styleId="'.$greigestyleId['id'].'" and costsheetVersionId=1 and status=1 and deletestatus=0 and lotNoMaster="'.$lotNo.'" and fabricType="yarn"');
$countqualitymodule=mysql_num_rows($countqualitymoduleq);
    		 ?>
                                  <tr>
                                    <td><div align="center"><?php echo $lotNo; ?></div></td>
                                    <td><?php echo $grnParentData['grnNo']; ?></td>
                                    <td><?php echo $grnData['supplierPurchaseOrderId']; ?></td>
                                    <td><?php echo stripslashes($materialData['name']); ?></td>
                                 	<!--<td><?php
									$rs112=GetPageRecord('name','colorCardMaster','id="'.$grnData['color'].'"');
									$resListing112=mysqli_fetch_array($rs112);
									echo $resListing112['name'];
									?></td>-->
                                    <td><a href="showpage.crm?module=<?php echo $_GET['module']; ?>&view=yes&requisitionNo=<?php echo encode($resultlists['requisitionNo']); ?>&lotId=<?php echo encode($lotNo); ?>&styleid=<?php echo encode($greigestyleId['id']); ?>&grnid=<?php echo encode($grnData['parentId']); ?>&materialid=<?php echo encode($grnData['materialId']); ?>&greige=yes&colorid=<?php echo encode($grnData['color']); ?>&spo=<?php echo encode($grnData['supplierPurchaseOrderId']); ?>&fabricType=yarn" style="padding: 5px 10px; border: 1px solid #0097a7; color: #0288d1; font-size: 12px; margin-bottom: 0px; margin-right: 5px; display: inline-block;">Lot <?php echo $lotNo; ?></a></td>
                                    <td><?php if($countqualitymodule>0){ ?>
                                      <span style="color: #368006;"><strong>Completed</strong></span>
                                      <?php } else{ ?>
                                      <span style="color: #ff0000;"><strong>Pending</strong></span>
                                      <?php } ?>
                                    </td>
                                  </tr>
                                  <?php } } else{ ?>
                                  <tr>
                                    <td colspan="7" align="center" style="text-align:center;">No Data Found</td>
                                  </tr>
                                  <?php } ?>
                                </table>
                              </div></td>
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

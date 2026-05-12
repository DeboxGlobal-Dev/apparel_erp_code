<?php
if($loginuserprofileId==1 || $loginuserprofileId==93){

$wheresearchassign=' 1 and ';

} else {

if($loginuserprofileId==92){

$wheresearchassign=' 1 and finalstatus="2" and assignTo in (select id from '._USER_MASTER_.' where empId in (select id from employeeMaster where reportingTo='.$_SESSION['empid'].')) or assignTo="'.$_SESSION['userid'].'" and ';
} else{

$wheresearchassign=' ( id in (select styleId from styleAssignmentMaster where assignTo="'.$_SESSION['userid'].'" and styleAssignTo=0 and statusId in (19,21)))';

$wheresearchassign=' '.$wheresearchassign.' and ';

}

}

?>

<div class="page-content">
  <div class="content-wrapper">
    <div class="content pt-0" style="margin-top:20px;">
      <div class="row">
        <div class="col-xl-12">
          <div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
            <div class="col-xl-9">
              <h5 class="card-title"><?php echo $pageName; ?></h5>
            </div>
            <div class="col-xl-2" style="padding-right: 10px;">
                 <a href="download-plcmnt.php" class="btn bg-teal-400 addnotify" aria-expanded="false" style="background-color: #03d873b8; margin-left: 66px;">Download Excel</a>
              <div class="btn-group justify-content-center" style="float:right;"> </div>
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
                        <select id="buyerId" name="buyerId" class="select2 form-control" displayname="Buyer" onchange="changeBuyer(this.value);">
						<option value="">Buyer</option>
						<option value="100" <?php if('100'==$editresult['buyerId']){ ?>selected="selected"<?php } ?>>Self</option>
                          <?php
							$select='';
							$where='';
							$rs='';
							$select='*';
							$where=' deletestatus=0 and status=1 order by name asc';
							$rs=GetPageRecord($select,_BUYER_MASTER_,$where);
							while($resListing=mysqli_fetch_array($rs)){
							?>
                          <option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$_GET['buyerId']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>

					<div class="col-md-2">
					  <div class="form-group">
					  <select id="brandId" name="brandId" class="select2 form-control" displayname="Brand">
						<option value="">Brand</option>
						</select>
					  </div>
					</div>

					<div class="col-md-2">
					  <div class="form-group">
					  <select id="valueEdition" name="valueEdition" class="select2 form-control">
						  <option value="">Value Addition</option>
						   <?php
							$aaaakr=GetPageRecord('*','embroideryTypeMaster','1 and deletestatus=0 and status=1 order by name asc');
							while($additonData=mysqli_fetch_array($aaaakr)){
							?>
						  <option value="<?php echo strip($additonData['id']); ?>" <?php if($additonData['id']==$_GET['valueEdition']){ ?>selected="selected"<?php } ?>><?php echo strip($additonData['name']); ?></option>
						  <?php } ?>
						</select>
					  </div>
					</div>



<script>
function changeBuyer(buyerId){
	$('#brandId').load('loadbrand.php?buyerId='+buyerId+'&selectId=<?php echo $_GET['brandId']; ?>&action=changebrandaction');
}

<?php
if($_GET['buyerId']!=''){
?>
changeBuyer(<?php echo $_GET['buyerId']; ?>);
<?php } ?>

</script>

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
          </div>
          <div class="card">
		  <form name="listform" id="listform" method="get">
              <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
            <table class="table table-bordered table-responsive">
              <tr height="20" style="background-color: #e5fbfa; color: #000;">
                <td height="20"><div align="left"><strong>Style</strong></div></td>
                <td width="4085"><div align="left"><strong>Brand</strong></div></td>
                <td width="4085"><div align="left"><strong>Buyer</strong></div></td>
                <td width="4085"><div align="left"><strong>Season</strong></div></td>
                <td width="4085"><div align="left"><strong>Color</strong></div></td>
                <td width="4085"><div align="center"><strong>Placement&nbsp;Quantity </strong></div></td>
                <td><div align="center"><strong>SAM</strong></div></td>
                <td width="4085"><div align="left"><strong>Value&nbsp;Addition</strong></div></td>
                <td width="4085"><div align="center"><strong>Shell&nbsp;Fabric </strong></div></td>
                <td width="4085"><div align="center"><strong>Shell&nbsp;Fabric&nbsp;Supplier</strong></div></td>
                <td width="4085"><div align="center"><strong>Lining&nbsp;Fabric</strong></div></td>
                <td width="4085"><div align="center"><strong>Lining&nbsp;Fabric&nbsp;Supplier</strong></div></td>
                <td width="20%"><div align="center"><strong>PCD</strong></div></td>
                <td width="4085"><div align="center"><strong>Ex.&nbsp;Factory&nbsp;Date</strong></div></td>

                </tr>
			   <tbody id="allhotellisting">
			            <?php

$no=1;
$select='*';
$where='';
$rs='';
$wheresearch='';
$page=$_GET['page'];
$limit=clean($_GET['records']);

if($_GET['buyerId']!=''){
$buyerId = 'and buyerId="'.$_GET['buyerId'].'"';
}

if($_GET['brandId']!=''){
$brandId = 'and brandId="'.$_GET['brandId'].'"';
}

if($_GET['valueEdition']!=''){
$valueEdition = 'and id in (select styleId from styleColorDetailMaster where valueEdition="'.$_GET['valueEdition'].'")';
}

$where='where '.$wheresearchassign.' deletestatus=0 and sampleStyle=1 and orderQty!=0 '.$buyerId.' '.$brandId.' '.$valueEdition.' and buyerId!="" and buyerId!=0 order by id desc';

$targetpage=$fullurl.'showpage.crm?module='.$_GET['module'].'&records='.$limit.'&searchField='.$searchField.'&buyerId='.$_GET['buyerId'].'&brandId='.$_GET['brandId'].'&valueEdition='.$_GET['valueEdition'].'&';

$rs=GetRecordList($select,_QUERY_MASTER_,$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($qdata=mysqli_fetch_array($rs[0])){

?>
              <tr>
                <td><div align="left"><a href="showpage.crm?module=style&view=yes&id=<?php echo encode($qdata['id']); ?>" target="_blank"><?php echo '#'.$qdata['styleRefId']; ?>
                </a></div></td>
                <td><div align="left"><?php echo getbrandName($qdata['brandId']); ?></div></td>
                <td><div align="left"><?php echo getBuyerName($qdata['buyerId']); ?></div></td>
                <td><div align="left"><?php echo getSeasonName($qdata['seasonId']); ?> </div></td>
                <td> <div align="left">
				<?php
					$proColor="";
					$rscolor=GetPageRecord('colorId','styleColorDetailMaster','1 and styleId='.$qdata['id'].' order by id asc');
					while($resListingcolor=mysqli_fetch_array($rscolor)){
					$ccq=GetPageRecord('name','colorCardMaster','1 and id="'.$resListingcolor['colorId'].'"');
				    $colName=mysqli_fetch_array($ccq);
					$proColor.=$colName['name'].',';
					}
					echo rtrim($proColor,',');
				?>
				</div></td>

				<td><div align="center"><?php echo $qdata['projecQty']; ?></div></td>
                <td ><div> <?php echo $qdata['smv']; ?></div></td>
                <td>
				  <div align="left">
				    <?php
				$proValueAddition="";
				$rscolorem=GetPageRecord('valueEdition','styleColorDetailMaster','1 and styleId='.$qdata['id'].' order by id asc');
				while($resListingcolorem=mysqli_fetch_array($rscolorem)){
				$valq=GetPageRecord('name','embroideryTypeMaster','1 and id="'.$resListingcolorem['valueEdition'].'"');
				$valAddData=mysqli_fetch_array($valq);
				$proValueAddition.=$valAddData['name'].',';
				}
				echo rtrim($proValueAddition,',');
				?>
		          </div></td>
                <td><div align="center">
				<?php
$shellNameFinal="";
$shellSupplierFinal="";

$shellFq=GetPageRecord('id,name','styleSubCategoryMaster','1 and styleId='.$qdata['id'].' and id in (select stylesubtabid from techPackDetailMaster where bomPlacement="Shell") order by id asc');
while($shellData=mysqli_fetch_array($shellFq)){

$shellNameFinal.=$shellData['name'].',';

$tsq=GetPageRecord('storesupplier','techPackDetailMaster','1 and stylesubtabid='.$shellData['id'].' order by id asc');
while($techShellData=mysqli_fetch_array($tsq)){
$shellSupplierFinal.=getsupplierCompany($techShellData['storesupplier']).',';
}


}
echo rtrim($shellNameFinal,',');
?>
				</div></td>

				<td><div align="center"><?php echo rtrim($shellSupplierFinal,','); ?></div></td>

                <td><div align="center">
<?php
$liningNameFinal="";
$liningSupplierFinal="";
$liningFq=GetPageRecord('id,name','styleSubCategoryMaster','1 and styleId='.$qdata['id'].' and id in (select stylesubtabid from techPackDetailMaster where bomPlacement="Lining") order by id asc');
while($liningData=mysqli_fetch_array($liningFq)){
$liningNameFinal.=$liningData['name'].',';

$tlq=GetPageRecord('storesupplier','techPackDetailMaster','1 and stylesubtabid='.$liningData['id'].' order by id asc');
while($techLiningData=mysqli_fetch_array($tlq)){
$liningSupplierFinal.=getsupplierCompany($techLiningData['storesupplier']).',';
}


}
echo rtrim($liningNameFinal,',');
?>

				</div></td>
				 <td><div align="center"><?php echo rtrim($liningSupplierFinal,','); ?></div></td>
                <td><div align="center"><?php if($qdata['pcdDate']!='0000-00-00' && $qdata['pcdDate']!='' && $qdata['pcdDate']!='1970-01-01'){  echo date('d-m-Y', strtotime($qdata['pcdDate'])); } ?></div></td>
                <td><div align="center">
                  <?php if($qdata['shipDate']!='0000-00-00' && $qdata['shipDate']!='' && $qdata['shipDate']!='1970-01-01'){  echo date('d-m-Y', strtotime($qdata['shipDate'])); } ?>
</div></td>


                </tr>


<script>
function saveUnitFactory<?php echo $qdata['id']; ?>(id){
$('#saveunitfactory<?php echo $qdata['id']; ?>').load('saveunitfactoryfile.php?action=saveunitfactory&styleId=<?php echo encode($qdata['id']); ?>&id='+id);
}
</script>

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
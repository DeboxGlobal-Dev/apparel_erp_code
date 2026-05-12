<?php
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

$lastId=$editresultstyle['id'];

}

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<div class="page-content">
  <!-- Main sidebar -->
  <?php include "left.php"; ?>
  <!-- /main sidebar -->
  <!-- Main content -->
  <div class="content-wrapper">
    <!---Save Alert Notification---->
    <?php include "savealert.php"; ?>
    <!-- Content area -->
    <div class="content pt-0" style="margin-top:20px;">
      <!-- Dashboard content -->
      <!---style information section--->
      <?php include "top-style.php"; ?>
      <!---style information section end--->
      <div class="row">
        <div class="col-xl-12">
          <?php
		$i = 0;
		$costsheetVersionId='0';
		$selectversion='*';
		$whereversion='styleId="'.decode($_GET['styleid']).'" and buyerCostStatus=0 order by id desc';
		$rsversion=GetPageRecord($selectversion,'costsheetVersionMaster',$whereversion);
		while($resListingVer=mysqli_fetch_array($rsversion)){
		$costsheetVersionId = $resListingVer['versionId'];
		$i++;
		?>
          <div id="accordion-group<?php echo $resListingVer['id']; ?>" style="margin-bottom: 10px;">
            <div class="card mb-0 rounded-bottom-0">
              <style>

.abcspecial-class:hover{
cursor:pointer;
background-color: #d8ff001f !important;
}
</style>
              <div class="abcspecial-class card-header text-default collapsed" onclick="showfobbydefault<?php echo $costsheetVersionId;?>();" data-toggle="collapse" href="#accordion-item-group<?php echo $resListingVer['id']; ?>" style="cursor:pointer;">
                <h6 class="card-title "> <a onclick="showfobbydefault<?php echo $costsheetVersionId;?>();" data-toggle="collapse" href="#accordion-item-group<?php echo $resListingVer['id']; ?>" class="text-default collapsed" style="color: #000000; width: fit-content; float: left; display: inline-block;margin-bottom: 10px;">Cost Sheet - <strong><?php echo $resListingVer['versionName']; ?></strong></a> <a onclick="showfobbydefault<?php echo $costsheetVersionId;?>();" class="text-default collapsed" data-toggle="collapse" href="#accordion-item-group<?php echo $resListingVer['id']; ?>" aria-expanded="false" style="text-align: left; color: #000; font-size: 13px; width: fit-content; float: left; margin-top: 2px; margin-left: 2px;">-&nbsp;<?php echo date('d M, Y - h:ia',$resListingVer['dateAdded']); ?></a>
                  <style>
div.options > label > input {
    visibility: hidden;
}

.options{
width: fit-content; float: right; margin-right: 0px; font-size: 13px;
}

div.options > label {
    display: block;
    margin: 0 0 0 -10px;
    padding: 0px;
    height: 20px;
    width: fit-content;
}

div.options > label > img {
    display: inline-block;
    padding: 0px;
    height: 18px;
    margin-left: 5px;
    width: 20px;
}

div.options > label > input:checked +img {
    background: url(http://cdn1.iconfinder.com/data/icons/onebit/PNG/onebit_34.png);
    background-repeat: no-repeat;
    background-position: center center;
    background-size: 10px 10px;
}


</style>
                  <div class="options">
                    <label title="item1">
                    <input type="radio" value="<?php echo $costsheetVersionId;?>" id="setasdefault<?php echo $costsheetVersionId;?>" name="setasdefaul"  onclick="submitcostsheetver<?php echo $costsheetVersionId;?>(<?php echo $costsheetVersionId;?>);"<?php if($costsheetVersionId==$editresultstyle['defaultcostsheetVersionId']) { ?> checked="checked" <?php } ?> />
                    Final Vesion <img /> </label>
                  </div>
                  <div class="options"> <span style="background-color: #f7f7f7; padding: 10px 10px; color: #000; margin-right: 10px; border: 1px solid #cacaca;">Costing&nbsp;Qty - <strong><?php echo $editresultstyle['costingQty']; ?></strong>&nbsp;&nbsp;|&nbsp;&nbsp;Projection&nbsp;Qty - <strong><?php echo $editresultstyle['projecQty']; ?></strong></span> </div>
                  <div class="options" style="display:none;">
                    <label title="item1">
                    <input type="checkbox" />
                    Forward <img /> </label>
                  </div>
                  <script>
function showfobbydefault<?php echo $costsheetVersionId;?>(){
var showfobdefault = $('#showfobdefault<?php echo $costsheetVersionId;?>').css('display');
	 if(showfobdefault=='block'){
	 $('#showfobdefault<?php echo $costsheetVersionId;?>').css('display','none');
	 } else {
	 $('#showfobdefault<?php echo $costsheetVersionId;?>').css('display','block');
	 }
}
</script>
                  <?php
$rs31=GetPageRecord('*','costsheetVersionMaster','styleId="'.$lastId.'" and versionId="'.$costsheetVersionId.'"');
$resListing31=mysqli_fetch_array($rs31);

$totalmrp=$resListing31['totalmrp'];
$mrptotallast=$resListing31['mrptotallast'];
$finalgrandtotalwithmrp =$resListing31['finalgrandtotalwithmrp'];

if($resListing31['effectivesellingprice']!='' || $resListing31['totalcostfob']!='' || $resListing31['profit']!=''){
?>
                  <div class="specialclassforsheetsecond" id="showfobdefault<?php echo $costsheetVersionId;?>" style="display:block;">
                    <table width="100%" class="table table-bordered table-responsive forbom" style="">
                      <tbody style="width: 100%;display: inline-table;margin-bottom:20px;">
                        <tr class="card-body" style="background: #e5fbfa;font-size: 15px;font-weight:600;">
                          <td width="22%" align="center">Effective FOB Price</td>
                          <td width="26%" align="center">PRODUCT COST </td>
                          <td width="30%" align="center">Profit/Loss</td>
                        </tr>
                        <tr class="card-body" style="background: #f7f7f7;font-size: 15px;font-weight: 500;">
                          <td align="center"><span class="" name="effectivepriceselling<?php echo $_REQUEST['costsheetVersionId']; ?>" id="effectivepriceselling<?php echo $_REQUEST['costsheetVersionId']; ?>"><?php echo $resListing31['effectivesellingprice']; ?>
						  <?php
						  $rsCurrency=GetPageRecord('value','currencyMaster','name="USD"');
						  $rsCurrencyValue=mysqli_fetch_array($rsCurrency);
						  ?>
						   ($ <?php echo round($resListing31['effectivesellingprice']/$rsCurrencyValue['value'],2); ?>)</span></td>
                          <td align="center"><span class="" name="totalfobcost<?php echo $_REQUEST['costsheetVersionId']; ?>" id="totalfobcost<?php echo $_REQUEST['costsheetVersionId']; ?>"><?php echo $resListing31['totalcostfob']; ?></span></td>
                          <td align="center"><span class="" name="totalallprofit<?php echo $_REQUEST['costsheetVersionId']; ?>" id="totalallprofit<?php echo $_REQUEST['costsheetVersionId']; ?>"><?php echo $resListing31['profit']; ?></span> (<span class="" name="totalallprofitlosspercent<?php echo $_REQUEST['costsheetVersionId']; ?>" id="totalallprofitlosspercent<?php echo $_REQUEST['costsheetVersionId']; ?>"><?php echo $resListing31['profitlosspercent']; ?></span>%) </td>
                        </tr>
                      </tbody>
                    </table>
                    <table width="100%" class="table table-bordered table-responsive forbom" style=" display:none;">
                      <tbody style="width: 100%;display: inline-table;">
                        <tr class="card-body" style="background: #e5fbfa;font-size: 15px;font-weight:600;">
                          <td align="center">M.R.P</td>
                          <td align="center">F.O.B</td>
                          <td align="center">Margin</td>
                        </tr>
                        <tr class="card-body" style="background: #f7f7f7;font-size: 15px;font-weight: 500;">
                          <td align="center"><span class=""><?php echo $totalmrp; ?></span> </td>
                          <td align="center"><span class=""><?php echo $mrptotallast; ?></span> </td>
                          <td align="center"><span class=""><?php echo $finalgrandtotalwithmrp; ?></span> </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <?php } ?>
                  <div id="savecostsheetversion<?php echo $costsheetVersionId;?>" name="savecostsheetversion<?php echo $costsheetVersionId;?>" style="display:none;"></div>
                  <script>
function submitcostsheetver<?php echo $costsheetVersionId;?>(vid){

var x = confirm("Are you sure you want to set as default?");
if (x == true) {
$('#savecostsheetversion<?php echo $costsheetVersionId;?>').load("load_costsheet_version.php?styleId=<?php echo $editresultstyle['id'];?>&costsheetVersionId=<?php echo $costsheetVersionId; ?>&action=setdefault");
} else{

}
location.reload();
}
</script>
                </h6>
              </div>
              <div id="accordion-item-group<?php echo $resListingVer['id']; ?>" class="collapse" data-parent="#accordion-group<?php echo $resListingVer['id']; ?>">
                <div class="card-body" style="padding:0px;">
                  <div id="collapsible-control-right-group<?php echo $i; ?>" >
                    <div class="card-body">
                      <div class="tab-content">
                        <fieldset class="card-body" style="padding: 10px;">
                        <form action="ac.crm" method="post" class="submitstyleform" enctype="multipart/form-data" name="techPackFormV<?php echo $costsheetVersionId; ?>" target="techpackiframe<?php echo $costsheetVersionId; ?>" id="techPackFormV<?php echo $costsheetVersionId; ?>">
                          <input type="hidden" name="action2" value="techpackversion" />
                          <input type="hidden" name="versionId" value="<?php echo encode($resListingVer['versionId']); ?>" />
                          <input type="hidden" name="editId" value="<?php echo encode($lastId); ?>">
                          <input type="hidden" name="module" value="<?php echo $_GET['module']; ?>">
                          <div class="row" id="load_bom_list<?php echo $costsheetVersionId; ?>"> </div>
                          <div class="text-right" style="width: 100%;display: block;margin-top: 25px;">
                            <button type="button" class="btn btn-danger" style=" float: left;" onclick="duplicateCostsheet<?php echo $costsheetVersionId; ?>();">Create Duplicate<i class="fa fa-copy ml-2" aria-hidden="true" style="margin:0px;"></i></button>



							<!--<button type="button" class="btn btn-success" style=" float: left;">Approve<i class="fa fa-check ml-2" aria-hidden="true" style="margin:0px;"></i></button>-->


							<?php
							if($_SESSION['userid']==1){
							?>
							<a href="#" class="btn btn-success"> <i class="fa fa-shirtsinbulk  mr-3" aria-hidden="true"></i>Approve</a>
			  				<?php
							}else{
							$where='';
							$where=' 1 and pageId=1 and buyerId="'.$editresultstyle['buyerId'].'" and brandId="'.$editresultstyle['brandId'].'" and profileId="'.$loginuserprofileId.'" and (assignTo="'.$_SESSION['userid'].'" or assignTo="0")';
							$rsapp=GetPageRecord('*','resourceApprovalBrandWise',$where);
							$resListingApp=mysqli_fetch_array($rsapp);
							if($resListingApp['assignTo']!=''){
							?>
							<a href="#" class="btn btn-success"> <i class="fa fa-shirtsinbulk  mr-3" aria-hidden="true"></i>Approve</a>
			  				<?php }
							 } ?>

                            <button type="button" onclick="delete_material<?php echo $costsheetVersionId; ?>();delete_material_extra<?php echo $costsheetVersionId; ?>();addfinaldata<?php echo $costsheetVersionId; ?>();" class="btn btn-primary" style="margin:0px;">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;"></i></button>
                          </div>
                        </form>
                        <script>

function duplicateCostsheet<?php echo $costsheetVersionId; ?>(){
var r = confirm("Are you sure you want to create duplicate?");
if (r == true) {
$('#cvId').val(1);
$( "#techPackFormV<?php echo $costsheetVersionId; ?>" ).submit();
}
}
</script>
                        <script>
function load_bom_list_fun<?php echo $costsheetVersionId; ?>(){
$('#load_bom_list<?php echo $costsheetVersionId; ?>').load("load_bom_list.php?styleId=<?php echo $editresultstyle['id'];?>&subCategoryId=<?php echo $editresultstyle['subCategoryId'];?>&page=costsheet&costsheetVersionId=<?php echo $costsheetVersionId; ?>&cpm=<?php echo $editresultstyle2['cpm']; ?>&sam=<?php echo $editresultstyle['smv']; ?>");
}

load_bom_list_fun<?php echo $costsheetVersionId; ?>();

 </script>
                        </fieldset>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
      <!-- /dashboard content -->
    </div>
    <!-- /content area -->
  </div>
  <!-- /main content -->
</div>

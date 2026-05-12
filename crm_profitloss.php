<div class="page-content">
<div class="content-wrapper">
  <div class="content pt-0" style="margin-top: 20px; width: 100%; margin-left: auto; margin-right: auto;">
    <div class="row">
      <div class="col-xl-12">
        <div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
          <div class="col-xl-9">
            <h5 class="card-title"><?php echo $pageName; ?></h5>
          </div>
          <div class="col-xl-3" style="padding-right: 0px;"> </div>
        </div>
        <div class="card border-left-3 border-left-danger-400 rounded-left-0" style="border: 1px solid #ccc !important;">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <form name"search" method="GET" action="">
                  <input type="hidden"  name="module" value="<?php echo $_GET['module']; ?>"/>
                  <div class="row" style="padding:15px 0px;">
                    <div class="col-md-2">
                      <div class="">
                        <input name="fromDate" type="text" class="datepickercommon form-control" id="fromDate" value="<?php if($_GET['fromDate']!=''){ echo date('d-m-Y', strtotime($_GET['fromDate'])); } ?>" placeholder="From Date" readonly="">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="">
                        <input name="toDate" type="text" class="datepickercommon form-control" id="toDate" value="<?php if($_GET['toDate']!=''){ echo date('d-m-Y', strtotime($_GET['toDate'])); } ?>" placeholder="To Date" readonly="">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="">
                        <select class="form-control" name="companyid" id="companyid">
                          <option value="">Company</option>
                          <?php
								$rsk=GetPageRecord('*','companyMaster','1 order by name asc');
								while($comData=mysqli_fetch_array($rsk)){
								?>
                          <option value="<?php echo $comData['id']; ?>" <?php if($comData['id']==$_GET['companyid']){ ?> selected="selected" <?php } ?>><?php echo $comData['name']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="">
                        <input name="search" type="submit" class="btn bg-teal-400" id="search" value="Search">
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="col-md-12">
                <form name="listform" id="listform" method="get">
                  <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />

			      <table class="table table-hover no-footer apparelclass" width="100%">


					<tr style="padding: 10px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td width="91%" align="center"><div align="left" style="text-transform:capitalize;">Revenues (Income)</div></td>
					  <td width="9%" align="center"><div align="left" style="text-transform:capitalize;">
					    <div align="center">Amount</div>
					  </div></td>
                    </tr>

							<?php
							$sNo=1;

							if($_REQUEST['companyid']!=''){
							$companyQ='and companyId="'.$_GET['companyid'].'"';
							}


							$rsk=GetPageRecord('*','finalheadcreationmaster','1 '.$companyQ.' and type="incomes" order by label asc');

							while($resultlists=mysqli_fetch_array($rsk)){ ?>
							<tr>
							<td><div align="left"><?php echo $resultlists['label']; ?></div></td>
							<td> <div align="center"></div></td></tr>

							<?php } ?>


					<tr style="padding: 10px; font-size: 13px; font-weight: 600; background-color: #eefafd; margin-top: 0; position: relative;">
                      <td align="center"><div align="left" style="text-transform:capitalize;">Total Revenues (Income)</div></td>
					  <td align="center"><div align="left" style="text-transform:capitalize;">
					    <div align="center">0</div>
					  </div></td>
                    </tr>

					<tr style="border:0px !important;">
					<td style="border:0px !important;">&nbsp;</td>
					</tr>

					<tr style="padding: 10px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div align="left" style="text-transform:capitalize;">Expenses</div></td>
                    	<td align="center"><div align="left" style="text-transform:capitalize;">
                    	  <div align="center">Amount</div>
                    	</div></td>
					</tr>


					<?php
							$sNo=1;

							if($_REQUEST['companyid']!=''){
							$companyQ='and companyId="'.$_GET['companyid'].'"';
							}

							$rskmm=GetPageRecord('*','finalheadcreationmaster','1 '.$companyQ.' and type="expenses" order by label asc');

							while($resultlistss=mysqli_fetch_array($rskmm)){ ?>
							<tr>
							<td><div align="left"><?php echo $resultlistss['label']; ?></div></td>
							<td> <div align="center"></div></td></tr>

							<?php } ?>


					<tr style="padding: 10px; font-size: 13px; font-weight: 600; background-color: #eefafd; margin-top: 0; position: relative;">
                      <td align="center"><div align="left" style="text-transform:capitalize;">Total Expenses</div></td>
					  <td align="center"><div align="left" style="text-transform:capitalize;">
					    <div align="center">0</div>
					  </div></td>
                    </tr>

					<tr style="border:0px !important;">
					<td style="border:0px !important;">&nbsp;</td>
					</tr>


					<tr style="padding: 10px; font-size: 13px; font-weight: 600; background-color: #f7ffa7; margin-top: 0; position: relative;">
                      <td align="center"><div align="left" style="text-transform:capitalize;">Net Income </div></td>
					  <td align="center"><div align="left" style="text-transform:capitalize;">
					    <div align="center">0</div>
					  </div></td>
                    </tr>
                  </table>
                </form>
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
<script>
 function isLedger(id,glId){

	if(glId=='0'){
		var conf = confirm('Are you sure you want to create General Ledger?');
		if(conf==true){
			window.location.href ='<?php echo $fullurl; ?>showpage.crm?module=headcreation&id='+id+'&glId=1';
		}
	}else{
		var conf = confirm('Are you sure you want to remove from General Ledger?');
		if(conf==true){
		window.location.href ='<?php echo $fullurl; ?>showpage.crm?module=headcreation&id='+id+'&glId=0';
		}
	}
 }


 function deleteHead(delId){
 	var conf = confirm('Are you sure you want delete?');
	if(conf==true){
		window.location.href ='<?php echo $fullurl; ?>showpage.crm?module=headcreation&delId='+delId;
	}
 }
 </script>
<style>
.apparelclass tr td{
border-top:0px solid #ccc !important;
border:1px solid #ccc !important;
vertical-align:middle !important;
}
</style>
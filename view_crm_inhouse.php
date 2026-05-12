<?php
if($loginuserprofileId==1 || $loginuserprofileId==93){
$wheresearchassign=' 1 and ';
} else {
if($loginuserprofileId==92){

$wheresearchassign=' 1 and finalstatus="2" and assignTo in (select id from '._USER_MASTER_.' where empId in (select id from employeeMaster where reportingTo='.$_SESSION['empid'].')) or assignTo="'.$_SESSION['userid'].'" and ';
} else{
$wheresearchassign=' ( id in (select styleId from styleAssignmentMaster where assignTo="'.$_SESSION['userid'].'" and styleAssignTo=0))';
$wheresearchassign=' '.$wheresearchassign.' and ';
}
}
$styleid=decode($_REQUEST['styleid'])."+";
$stylesubcategoryid=decode($_REQUEST['stylesubcategoryid'])."+";
$techpackid=decode($_REQUEST['techpackid']);

$select22='id,name';
$where22='id="'.$stylesubcategoryid.'"';
$rs22=GetPageRecord($select22,'styleSubCategoryMaster',$where22);
$resListing1=mysqli_fetch_array($rs22);

$rs121=GetPageRecord('*','techPackDetailMaster',' id="'.$techpackid.'"');
$resListing12=mysqli_fetch_array($rs121);
?>


<div class="page-content">

		 <div class="content-wrapper">

			<div class="content pt-0" style="margin-top:20px;">

				<div class="row">
				<div class="col-xl-12">

				 <div class="card mb-0 rounded-bottom-0" style="padding:15px;">
				 	<div class="panel panel-flat">
					 <div class="table-responsive">
					    <table width="100%" class="table table-bordered table-responsive forbom" id="tableid11" style="display:block;">
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body">
							 <td width="12%" align="left"><strong>Name</strong></td>
                              <td width="12%" align="center"><strong>Avg.</strong></td>
                              <td width="12%" align="center"><strong>Unit</strong></td>
                              <td width="12%" align="center"><strong>USD</strong></td>
                              <td width="12%" align="center"><strong>INR</strong></td>
                              <td width="12%" align="center"><strong>Landing&nbsp;Cost(%)</strong></td>
                              <td width="12%" align="center"><strong>Rate</strong></td>
                              <td width="13%" align="center"><strong>Value&nbsp;of&nbsp;1&nbsp;PC</strong></td>
                            </tr>

                            <tr class="card-body">
<td align="left"><?php echo $resListing1['name']; ?></td>
<td align="center">
<input name="bomAvg" type="text" id="bomAvg" autocomplete="off" maxlength="200" style="width: 90px;text-align: center;"  value="<?php echo $resListing12['bomAvg']; ?>"/>
</td>
<td align="center">
<input name="bomUnit" type="text" id="bomUnit" autocomplete="off" maxlength="200" style="width: 90px;text-align: center;"  value="<?php echo $resListing12['bomUnit']; ?>" />
</td>
<td align="center">
<input name="bomUSD" type="text" id="bomUSD" autocomplete="off" maxlength="200" style="width: 90px;text-align: center;"  value="<?php echo $resListing12['bomUSD']; ?>" />
</td>
<td align="center">
<input name="bomINR" type="text" id="bomINR" autocomplete="off" maxlength="200" style="width: 90px;text-align: center;"  value="<?php echo $resListing12['bomINR']; ?>" />
</td>
<td align="center">
<input name="landingcostper" type="text" id="landingcostper" autocomplete="off" maxlength="200" style="width: 90px;text-align: center;"  value="40"/>
</td>
<td align="center">
<input name="bomRate" type="text" id="bomRate" autocomplete="off" maxlength="200" style="width: 90px;text-align: center;"  value="<?php echo $resListing12['bomRate']; ?>" />
</td>
<td align="center">
<input name="bomvalueonepc" type="text" id="bomvalueonepc" autocomplete="off" maxlength="200" style="width: 90px;text-align: center;"  value="<?php echo $resListing12['bomvalueonepc']; ?>" />
</td>


			                 </tr>
                          </tbody>

                        </table>
					  </div>
					</div>
				  </div>



				 </div>
				 </div>

				 <div class="row" style="margin-top:20px;">


				  <div class="col-xl-9">
				 <div class="card">
							 <div class="card-body navbar-green"   >
							<div class="media">
									 <div class="col-xl-6" style="padding:0px;">
									<h6 class="media-title font-weight-semibold">Communication</h6>
									</div>

 									<div class="col-xl-6" style="text-align:right;padding:0px;">
									<div class="d-flex align-items-center" style="float:right; ">

<button type="button" class="btn bg-blue-400 btn-labeled btn-labeled-right ml-auto" name="stylemailreply" id="stylemailreply" onclick="stylemailreply();" style="margin-right: 0px;
    padding: 2px 36px 2px 10px;">
          <b><i class="fa fa-reply" aria-hidden="true" style="font-size: 8px;
    padding: 0px;
    line-height: 6px;"></i></b> Reply
</button>

		                    	</div>

									</div>

							</div>
						</div>

							<div class="card-body">
								<ul class="nav nav-tabs nav-tabs-solid nav-justified rounded border-0" style="font-weight: 600;">

<li class="nav-item"  onclick="funloadbuyercommunication();"><a href="#solid-rounded-justified-tab1" class="nav-link active show" data-toggle="tab"> Internal</a></li>
<li class="nav-item"><a href="#solid-rounded-justified-tab2" class="nav-link rounded-left" data-toggle="tab">Buyer</a></li>
<li class="nav-item"><a href="#solid-rounded-justified-tab3" class="nav-link rounded-left" data-toggle="tab">Supplier</a></li>
<li class="nav-item"><a href="#solid-rounded-justified-tab4" class="nav-link rounded-left" data-toggle="tab">Vendor</a></li>

								</ul>

								<div class="tab-content">

									<div class="tab-pane active show" id="solid-rounded-justified-tab1" >
										<!--<div id="loadstylereply"></div>
										<div id="loadbuyercommunication"></div>-->
										Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
									</div>

									<div class="tab-pane fade" id="solid-rounded-justified-tab2">
										Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
									</div>

									<div class="tab-pane fade" id="solid-rounded-justified-tab3">
										DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
									</div>

									<div class="tab-pane fade" id="solid-rounded-justified-tab4">
										Lorem Ipsum is simply dummy text of the printing and typesetting industry.
									</div>


								</div>
							</div>
						</div>
				 </div>


				   <div class="col-xl-3">


				 <div class="card">
				<div class="card-body navbar-dark" style="background-image: url(http://demo.interface.club/limitless/assets/images/bg.png);">
							<div class="media" style="float:left;">
								<div class="mr-3 align-self-center">
									<h6 class="media-title font-weight-semibold">Status</h6>
								</div>


							</div>

				   </div>


							<div class="list-group list-group-flush">

							<div class="list-group-item list-group-item-action"><i class="fa fa-angle-double-right  mr-3" aria-hidden="true"></i>Send to Vendor</div>


				   </div>
				   </div>


				 </div>

				 </div>





            </div>
</div>
</div>
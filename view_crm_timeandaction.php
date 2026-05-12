<?php

?>
<div class="page-content">
		<div class="content-wrapper">
			<div class="content pt-0" style="margin-top:20px;">

			     <div class="col-xl-12" style="padding:0px;">
			    <form action="" method="get">
			      <label>
                    <input type="text" placeholder="Search:" name="filtersearch" id="filtersearch" style="margin-left: 0px; width: 190px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;"/>
                    </label>
                    <label>
                    <select name="buyerId" id="buyerId" style="margin-left: 10px; width: 190px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;"  onchange="changeBuyer(this.value);">
                      <option value="">Select Buyer</option>

                      <?php
              $select='';
              $where='';
              $rs='';
              $select='*';
              $where=' deletestatus=0 and status=1 order by name asc';
              $rs=GetPageRecord($select,_BUYER_MASTER_,$where);
              while($resListing=mysqli_fetch_array($rs)){
              ?>
                          <option value="<?php echo strip($resListing['id']); ?>"><?php echo strip($resListing['name']); ?></option>
                      <?php } ?>
                    </select>
                    </label>
                    <label>
                    <select name="brandId" id="brandId" style="margin-left: 10px; width: 190px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;">
                      <option value="">Select Brand</option>
                       </select>
                    </label>
                    <!--  <label >
                    <select name="keyprocess" id="keyprocess" style="margin-left: 10px; width: 190px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;">
                      <option value="">Select Key Process</option>
                     <?php
				$fcref2=GetPageRecord('*','tnaActivityMaster','1 order by id desc');
				while($refData2=mysqli_fetch_array($fcref2)){ ?>
                          <option value="<?php echo encode($refData2['id']); ?>"><?php echo strip($refData2['name']); ?></option>
                      <?php } ?>
                    </select>
                    </label> -->

                     <label>
                    <select name="styleid" id="styleid" style="margin-left: 10px; width: 190px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;">
                      <option value="">Select Style</option>

                     <?php
				$fcref=GetPageRecord('*','queryMaster','1 and sampleStyle="1" and deletestatus="0" and subject!="" order by id asc');
				while($refData=mysqli_fetch_array($fcref)){ ?>
                <option value="<?php echo encode($refData['styleRefId']); ?>" <?php if($refData['styleRefId'] == decode($_GET['styleid'])) { ?> selected <?php } ?> >#<?php echo $refData['styleRefId']; ?></option>

                                 <?php } ?>
                    </select>
                    </label>

                    <script>
function changeBuyer(buyerId){
	$('#brandId').load('loadbrand.php?buyerId='+buyerId+'&action=changebrandaction');
}
</script>

                    <label>
                 <input name="" type="submit" id="" class="" value="search" style="text-transform: uppercase; padding:7px;background-color: #03c28d; color: #fff; width: 200px; cursor:pointer; margin:0px !important;;"/>
                    </label>
                    <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />

                    <input type="hidden" name="view" value="yes">

                      <?php if($_REQUEST['red']=='yes') { ?>
                    <input type="hidden" name="red" value="yes">
                    <?php } else if($_REQUEST['yellow']=='yes') { ?>
                    <input type="hidden" name="yellow" value="yes">
                    <?php } else { ?>
                    <input type="hidden" name="green" value="yes">
                    <?php } ?>
                    <?php if($_REQUEST['red']=='yes') { ?>
                    <input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>">
                <?php } ?>
                <?php if($_REQUEST['yellow']=='yes' || $_REQUEST['green']=='yes') {
                   $NewDate=Date('Y-m-d', strtotime('+14 days')) ?>
                   <input type="hidden" name="date" value="<?php echo $NewDate; ?>">
                      <?php } ?>


                    </form>
				 <div class="card">
							 <div class="card-body navbar-green"  style="padding:7px !important;" >
							<div class="media">
									 <div class="col-xl-12">
									<h6 class="media-title font-weight-semibold"  style="    margin-top: 8px;">TNA(Time & Action) </h6>
									</div>

							</div>
						</div>
						            <form name="listform" id="listform" method="get">

							<div class="card-body listc">

							  <table class="table table-bordered" style="font-size: 12px;" width="100%">
							<thead>
								<tr class="border-top-info" style="background-color: #fff;text-align: left;">
							      <th width="4%" align="center"><div align="center">Buyer<strong></strong></div></th>

							       <th width="4%" align="center"><div align="center">Brand<strong></strong></div></th>

								    <th width="5%" align="center"><div align="center"><strong>Style</strong></div></th>
									<th width="6%"><strong>Key&nbsp;Processes </strong></th>
									<th width="8%">Planned Date</th>
									<!--<th width="20%">Critical&nbsp;Path on which Process that 2nd point is dependent</th>-->
									<!--<th width="7%">Actual Date</th>-->
								  <!--<th width="20%"><div align="center">No of Days taken b/w critical path & that process </div></th>-->
									<th width="7%">Responsibility</th>
							    	<th width="7%"><?php if($_REQUEST['red']=='yes')  { ?> Delay <?php } ?> <?php if($_REQUEST['green']=='yes' or $_REQUEST['yellow']=='yes')  { ?> Time Remaining <?php } ?> </th>
                                    	<th width="7%">PCD</th>
									<th width="7%">Ex-Factory</th>



									<!--<th width="19%">Remark</th>-->
								</tr>
							</thead>


							<tbody id="allhotellisting">
								<?php
								$snoo=0;
								$nb=1;


			if($_GET['buyerId']!="" && ($_GET['red']=="yes" || $_GET['yellow']=="yes" || $_GET['green']=="yes")){
								  // $buyerId="";
								  $buyerId='and buyerId="'.$_GET['buyerId'].'"';
								}
			if($_GET['styleid']!="" && ($_GET['red']=="yes" || $_GET['yellow']=="yes" || $_GET['green']=="yes")){
								  $styleId='and styleRefId="'.decode($_GET['styleid']).'"';
									}

            if($_GET['brandId']!="" && ($_GET['red']=="yes" || $_GET['yellow']=="yes" || $_GET['green']=="yes")){
								  $brandId='and brandId="'.$_GET['brandId'].'"';
									}

									$whrek='1 '.$buyerId.' '.$brandId.' '.$styleId.' and deletestatus=0';

							     $topq=GetPageRecord('*','queryMaster',$whrek);
                                 while($topStyleData=mysqli_fetch_array($topq)) {


								if($_REQUEST['red']=='yes'){
								$where1='1 and styleId="'.$topStyleData['id'].'" and temid="'.$topStyleData['tnaTemplateId'].'" and actualDate="1970-01-01" and  complitionDate<="'.$_REQUEST['date'].'" and taskListId in (select id from taskListMaster where tna=1)  order by complitionDate asc';
								$bgcolor='#ff0000';
								}

								else if($_REQUEST['green']=='yes'){
								$where1='1 and styleId="'.$topStyleData['id'].'" and temid="'.$topStyleData['tnaTemplateId'].'"  and actualDate="1970-01-01" and complitionDate>="'.$_REQUEST['date'].'" and taskListId in (select id from taskListMaster where tna=1) order by complitionDate asc';
								$bgcolor='#82b767';
								}

								else {
							 $where1='1 and styleId="'.$topStyleData['id'].'" and temid="'.$topStyleData['tnaTemplateId'].'" and actualDate="1970-01-01" and complitionDate>"'.date('Y-m-d').'" and complitionDate<"'.$_REQUEST['date'].'"  and taskListId in (select id from taskListMaster where tna=1) order by complitionDate asc';
								$bgcolor='#f7c40a';
								}



								$rs1=GetPageRecord('*','timeActionReport',$where1);
								while($data=mysqli_fetch_array($rs1)){


								$rs=GetPageRecord('*','taskListMaster','1 and id="'.$data['taskListId'].'" and tnatemplate="'.$topStyleData['tnaTemplateId'].'" and deletestatus=0 and status=1 and tna=1 order by id asc');

								$reslisttask=mysqli_fetch_array($rs);

							    $cq=GetPageRecord('name','taskListMaster','1 and id="'.$reslisttask['criticalPath'].'"');
								$dData=mysqli_fetch_array($cq);

								  $cqe=GetPageRecord('name','brandMaster','1 and id="'.$topStyleData['brandId'].'"');
								$dDatae=mysqli_fetch_array($cqe);

								 $cqer=GetPageRecord('name','buyerMaster','1 and id="'.$topStyleData['buyerId'].'"');
								$dDatabu=mysqli_fetch_array($cqer);
			                      ?>
								<tr class="border-top-info">
								  <td align="center"><?php echo $dDatabu['name']; ?></td>

						     	  <td align="center"><?php echo $dDatae['name']; ?></td>


								   <td align="center" ><a style="color:blue;"href="showpage.crm?module=timeandaction&add=yes&styleid=<?php echo encode($topStyleData['id']); ?>" style="color:#000000;">#<?php echo $topStyleData['styleRefId']; ?></a></td>

									<td style="background-color:<?php echo $bgcolor; ?>; color:black;">
							    	<?php
									$activityquery=GetPageRecord('name','tnaActivityMaster','1 and id="'.$reslisttask['name'].'"');
                                    $activityData=mysqli_fetch_array($activityquery);
                                    echo $activityData['name'];	 ?>

									</td>
									<td><?php if($data['complitionDate']!='' && $data['complitionDate']!='1970-01-01' && $data['complitionDate']!='0000-00-00'){ echo date('d-m-Y', strtotime($data['complitionDate'])); } ?></td>
									<!--<td></td>-->
									<td><div ><?php echo getEmployeeName($data['responsiblity']); ?></div></td>
									<?php
									 $plandate=date('d-m-Y', strtotime($data['complitionDate']));
									 $currentdate= date ("d-m-Y");

									 $start_date = strtotime($plandate);
									 $end_date = strtotime($currentdate);

									 ?>
									<td><?php if($_REQUEST['yellow']=='yes' or $_REQUEST['green']=='yes')  { ?> + <?php }  ?> <?php echo ($start_date - $end_date)/60/60/24; ?>&nbsp;Days  </td>
									<td><?php echo date('d-m-Y',strtotime($topStyleData['pcdDate']));  ?></td>
									<td><?php echo date('d-m-Y',strtotime($topStyleData['shipDate'])); ?></td>

								</tr>



<?php $nb++; } }  ?>

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
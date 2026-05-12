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

$i=1;
while($i<6){

$select='*';
$id=clean(decode($_GET['styleid']));
$where='id='.$id.'';
$rs=GetPageRecord($select,_QUERY_MASTER_,$where);
$resultpage=mysqli_fetch_array($rs);

if($_GET['styleid']!='' && $resultpage['tnaTemplateId']!='0'){

$selecttask='*';
//$wheretask='1 and status=1 and tnatemplate="'.$resultpage['tnaTemplateId'].'" order by id asc';

$wheretask='1 and tnatemplate="'.$resultpage['tnaTemplateId'].'" order by id asc';

$rstask=GetPageRecord($selecttask,'taskListMaster',$wheretask);

while($reslisttask1=mysqli_fetch_array($rstask)){

//echo $reslisttask1['name'].'==<br>';

$wherecheck='styleId="'.$id.'" and taskListId="'.$reslisttask1['id'].'" and temid="'.$resultpage['tnaTemplateId'].'"';

$addnewyes = checkduplicate('timeActionReport',$wherecheck);

if($addnewyes!='yes'){

//============================================///////////////////////////

//echo '1 and criPath in (select criticalPath from taskListMaster where name="'.$reslisttask1['name'].'" and tnatemplate="'.$resultpage['tnaTemplateId'].'") and styleId="'.$id.'"';

$a=GetPageRecord('complitionDate','timeActionReport','1 and criPath in (select criticalPath from taskListMaster where name="'.$reslisttask1['name'].'" and tnatemplate="'.$resultpage['tnaTemplateId'].'") and styleId="'.$id.'"');
$criData=mysqli_fetch_array($a);

//echo $criData.'==========';

$aaaaaa=GetPageRecord('id','taskListMaster','1 and tnatemplate="'.$resultpage['tnaTemplateId'].'" and id="'.$reslisttask1['id'].'" and criticalPath in (select criPath from timeActionReport where complitionDate!="" and complitionDate!="1970-00-00" and complitionDate!="0000-00-00" and styleId="'.$id.'")');

$counttimeaction=0;

$counttimeaction=mysql_num_rows($aaaaaa);

//echo "==========".$reslisttask1['criticalPath'].'===';

if($reslisttask1['criticalPath']==0 || $counttimeaction>0){

$comDate= date('Y-m-d', strtotime($criData['complitionDate']. ''.$reslisttask1['totaldays'].' days'));

if($reslisttask1['name']==3){
$comDate=$editresultstyle['ocdDate'];
}

if($reslisttask1['name']==49){
$comDate=$editresultstyle['shipDate'];
}

$namevaluetask ='taskListId="'.$reslisttask1['id'].'",styleId="'.$id.'",status=1,complitionDate="'.$comDate.'",actualDate="1970-01-01",totaldays="'.$reslisttask1['totaldays'].'",temid="'.$resultpage['tnaTemplateId'].'",criPath="'.$reslisttask1['name'].'"';

addlistinggetlastid('timeActionReport',$namevaluetask);
}

}
}

}

$i++;
}
?>


<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<style>

.form-control {
     padding: 4px;
}

.toggle.btn {
    min-width: 59px;
    min-height: 34px;
    width: auto !important;
    height: auto !important;
    margin: 0px !important;
}


.listc .table thead th {
    vertical-align: middle;
    border-bottom: 1px solid #b7b7b7;
    padding: 9px;
}
.listc .table-bordered td, .table-bordered th {
    border: 1px solid #ddd;
    padding: 8px;
}
.icon-calendar3{
	position: absolute;
    top: 18px;
    right: 0px;
}
.tablecolor{
	padding: 10px 15px;
    border: 1px solid #3fd7de;
    font-size: 16px;
    cursor: pointer;
    background-color: #e5fbfa;
    position: relative;
    font-weight: 500;
    color: #000000;
    width: 100%;
    box-sizing: border-box;
}
.border-top-info > td {
	font-size: 13px!important;
}
.border-top-info > th {
	font-size: 13px!important;
}
.tablecolor:hover{
	background-color: #a7d4d26e;
}
                         </style>

                    <div class="page-content">


		            <div class="content-wrapper">

			        <div class="content pt-0" style="margin-top:20px;">
  	                <?php include "top-style.php"; ?>
			        <div class="col-xl-12" style="padding:0px;">
				    <div class="card">
					<div style="padding:10px;">
				    <?php
                    $tdr=GetPageRecord('*','styleColorDetailMaster','1 and styleId="'.$editresultstyle['id'].'"');
                    while($temnamer=mysqli_fetch_array($tdr)){

                    $tdra=GetPageRecord('*','colorCardMaster','1 and id="'.$temnamer['colorId'] .'"');
                    $temnamera=mysqli_fetch_array($tdra);
                    ?>

					<a href="<?php echo $fullurl; ?>showpage.crm?module=criticalpath&add=yes&styleid=<?php echo $_GET['styleid'] ?>&poId=<?php echo encode($temnamera['id']) ?>">
					<div class="tablecolor" id="tablehover<?php echo $temnamera['id'] ?>"><?php echo $temnamera['name']; ?>
					<!--<span style="background-color: <?php echo $temnamera['colorCode'] ?>;width: 60px;height: 20px;display: block;"></span>-->
					</div>
					</a>

					 <?php } ?>

                    <!-- code starts -->

                      <br>
                      <br>

<?php if($_GET['poId'] != "" ) { ?>
<style>
#tablehover<?php echo decode($_GET['poId']) ?>
{
background-color: #a7d4d26e;
}
</style>

<?php } ?>
                  <?php

				   if($_GET['poId'] != "") {
                   $count=1;
                   $rrrr=GetPageRecord('*','criticalPathMaster','1 and colorId="'.decode($_GET['poId']).'" and styleId="'.decode($_GET['styleid']).'"');
         		   $operation=mysqli_fetch_array($rrrr);





				         $rrrr1=GetPageRecord('max(uploadDate) as lastdate','criticpop','1 and parentId="'.decode($_GET['poId']).'" and styleId="'.decode($_GET['styleid']).'" and datarow="lapsubmission"');
         		         $popdata=mysqli_fetch_array($rrrr1);



				      $rrrr1=GetPageRecord('max(uploadDate) as lastdate1','criticpop','1 and parentId="'.decode($_GET['poId']).'" and styleId="'.decode($_GET['styleid']).'" and datarow="lapfinal"');
         		      $popdata1=mysqli_fetch_array($rrrr1);

         		      $lapsub=GetPageRecord('max(uploadDate) as lastdate2','criticpop','1 and parentId="'.decode($_GET['poId']).'" and styleId="'.decode($_GET['styleid']).'" and datarow="lapsubmissionlining"');
         		      $popdata11=mysqli_fetch_array($lapsub);

         		       $rrrr1=GetPageRecord('max(uploadDate) as lastdate3','criticpop','1 and parentId="'.decode($_GET['poId']).'" and styleId="'.decode($_GET['styleid']).'" and datarow="lapfinallining"');
         		      $popdata14=mysqli_fetch_array($rrrr1);

         		      $rrrr1=GetPageRecord('max(uploadDate) as lastdate4','criticpop','1 and parentId="'.decode($_GET['poId']).'" and styleId="'.decode($_GET['styleid']).'" and datarow="devlopfpt"');

         		      $popdata15=mysqli_fetch_array($rrrr1);

         		      $rrrr1=GetPageRecord('max(uploadDate) as lastdate5','criticpop','1 and parentId="'.decode($_GET['poId']).'" and styleId="'.decode($_GET['styleid']).'" and datarow="devlopgpt"');
         		      $popdata16=mysqli_fetch_array($rrrr1);

         		      $rrrr1=GetPageRecord('max(uploadDate) as lastdate6','criticpop','1 and parentId="'.decode($_GET['poId']).'" and styleId="'.decode($_GET['styleid']).'" and datarow="bulkfptshel"');
         		      $popdata17=mysqli_fetch_array($rrrr1);

         		       $rrrr1=GetPageRecord('max(uploadDate) as lastdate7','criticpop','1 and parentId="'.decode($_GET['poId']).'" and styleId="'.decode($_GET['styleid']).'" and datarow="bulkfptlining"');
         		      $popdata18=mysqli_fetch_array($rrrr1);

         		       $rrrr1=GetPageRecord('max(uploadDate) as lastdate8','criticpop','1 and parentId="'.decode($_GET['poId']).'" and styleId="'.decode($_GET['styleid']).'" and datarow="fobapproval"');
         		      $popdata19=mysqli_fetch_array($rrrr1);

         		      $rrrr1=GetPageRecord('max(uploadDate) as lastdate9','criticpop','1 and parentId="'.decode($_GET['poId']).'" and styleId="'.decode($_GET['styleid']).'" and datarow="ppsamples"');
         		      $popdata20=mysqli_fetch_array($rrrr1);

         		      $rrrr1=GetPageRecord('max(uploadDate) as lastdate10','criticpop','1 and parentId="'.decode($_GET['poId']).'" and styleId="'.decode($_GET['styleid']).'" and datarow="bulkgpt"');
         		      $popdata21=mysqli_fetch_array($rrrr1);

         		     $rrrr1=GetPageRecord('max(uploadDate) as lastdate11','criticpop','1 and parentId="'.decode($_GET['poId']).'" and styleId="'.decode($_GET['styleid']).'" and datarow="shadelot"');
         		      $popdata22=mysqli_fetch_array($rrrr1);




         	       //echo $operation['colorId']; die();

				   ?>


				    <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">

				    <input name="action" type="hidden" id="action" value="colorcriticalpath" />
					<input type="hidden" name="poid" id="poid" value="<?php echo $_GET['poId']; ?>"/>
					<input type="hidden" name="styleid" id="styleid" value="<?php echo $_GET['styleid']; ?>" />
					<input type="hidden" name="editId" id="editId" value="<?php echo encode($operation['id']); ?>" />

                    <table class="table table-bordered" style="font-size: 12px;" width="100%">
					<thead>
					<tr class="border-top-info" style="background-color: #fff7b3;text-align: left;">
					<th><div align="center">Report</div></th>
					<th><div align="center">Planned&nbsp;Date</div></th>
					<th><div align="center">Actual&nbsp;Date</div></th>
					<th width="220px;"><div align="center">Upload&nbsp;File</div></th>
					</tr>
					</thead>
					<tbody>

							       <tr class="border-top-info">
								   <td style="position: relative;padding: 5px;background-color: #f9f9f9;">
								         Lab&nbsp;Dip/&nbsp;Strike&nbsp;off&nbsp;Submission&nbsp;(Shell)</td>

								  <td style="position: relative;padding: 5px;background-color: #f9f9f9;">
								  <div align="center">

                                 <input type="text" name="subshellp" id="subshellp" value="<?php echo $operation['subshellp']; ?>">
								 </div>
								 </td>

								 <td style="position: relative;padding: 5px;background-color: #f9f9f9;"><div align="center">
							    <?php if($popdata['lastdate'] != "") { echo $popdata['lastdate']; } else{ echo "-"; } ?>
								</div></td>

								 <td><span class="badge" style="cursor:pointer;background-color:green; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;"  onclick="opmodalpop('Add','modalpop.php?action=upsc&styleid=<?php echo $_GET['styleid']; ?>&poId=<?php echo $_GET['poId']; ?>&datarow=lapsubmission','600px','auto');" data-toggle="modal" data-target="#modalpop">
								 Upload</span>

								 <div id="togglepo<?php $operation['styleid']; ?>" class="badge" style="cursor:pointer;background-color:blue; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;">

								 View</div>

								 </td>


                    </tr>
				    </tbody>
		            <tbody id="thisbodyShow<?php echo $count; ?>" style="display:none;text-align: center;">
				    <tr class="border-top-info" style="background-color: #fff7b3;text-align: left;">
					<th><div align="center">Stage</div></th>
				    <th><div align="center">Date</div></th>
					<th><div align="center">Remark</div></th>
					<th width="220px;"><div align="center">Attachment</div></th>
					</tr>

				      <?php
					  $total=1;
				      $rrrr1=GetPageRecord('*','criticpop','1 and parentId="'.decode($_GET['poId']).'" and styleId="'.decode($_GET['styleid']).'" and datarow="lapsubmission"');
         		      while($popdata=mysqli_fetch_array($rrrr1))
         		      {
         		      ?>

					<tr style="background-color: #fdffe0;">
				    <td style="width:30px;"><?php echo $popdata['stage']; ?></td>
					<td><?php echo $popdata['uploadDate']; ?></td>
					<td><?php echo $popdata['remark']; ?></td>

					<td align="center"><?php if($popdata['attachtp']!=''){ ?>
                    <a href="<?php echo $popdata['attachtp']; ?>" target="blank">&nbsp;&nbsp;<i class="fa fa-download" aria-hidden="true" style="display: inherit;margin-right: 5px;"></i>Download</a>
                    </td>
					</tr>
					<?php } ?>
					<?php $total++; }
					if($total==1){
					?>
					<tr style="background-color: #fdffe0;">
					<td colspan="11"><div align="center">No Record Found</div></td>
					</tr>
					<?php } ?>
				    </tbody>

<script>
$("#togglepo<?php $operation['styleid']; ?>").click(function(){
    $("#thisbodyShow<?php echo $count; ?>").toggle();
});
</script>

							          <tr class="border-top-info">
									  <td style="position: relative;padding: 5px;background-color: #f9f9f9;">
									  Lab&nbsp;Dip/&nbsp;Strike&nbsp;off&nbsp;Final&nbsp;Approval&nbsp;(Shell)</td>

								      <td style="position: relative;padding: 5px;background-color: #f9f9f9;">
								      <div align="center">

                                    <input type="text" name="finalshellp" id="finalshellp" value="<?php echo $operation['finalshellp']; ?>">
								    </div>
								    </td>

								<td style="position: relative;padding: 5px;background-color: #f9f9f9;"><div align="center">
								<?php if($popdata1['lastdate1'] != "") { echo $popdata1['lastdate1']; } else{ echo "-"; } ?>
								</div></td>

								 <td><span class="badge" style="cursor:pointer;background-color:green; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;"  onclick="opmodalpop('Add','modalpop.php?action=upsc&styleid=<?php echo $_GET['styleid']; ?>&poId=<?php echo $_GET['poId']; ?>&datarow=lapfinal','600px','auto');" data-toggle="modal" data-target="#modalpop">
								 Upload</span>
								<div id="togglepo2" class="badge" style="cursor:pointer;background-color:blue; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;">

								 View</div>

								</td>



                                   </tr>
					<tbody id="thisbodyShow" style="display:none;text-align: center;">
					  <tr class="border-top-info" style="background-color: #fff7b3;text-align: left;">
					  <th><div align="center">Stage</div></th>
					  <th><div align="center">Date</div></th>
					<th><div align="center">Remark</div></th>
					<th width="220px;"><div align="center">Attachment</div></th>
					</tr>

				      <?php
					  $total=1;
				     $rrrr1=GetPageRecord('*','criticpop','1 and parentId="'.decode($_GET['poId']).'" and styleId="'.decode($_GET['styleid']).'" and datarow="lapfinal"');
         		      while($popdata1=mysqli_fetch_array($rrrr1))
         		      {
         		      ?>

					<tr style="background-color: #fdffe0;">
				    <td style="width:30px;"><?php echo $popdata1['stage']; ?></td>
					<td><?php echo $popdata1['uploadDate']; ?></td>
					<td><?php echo $popdata1['remark']; ?></td>

					<td align="center"><?php if($popdata1['attachtp']!=''){ ?>
                    <a href="<?php echo $popdata1['attachtp']; ?>" target="blank">&nbsp;&nbsp;<i class="fa fa-download" aria-hidden="true" style="display: inherit;margin-right: 5px;"></i>Download</a>
                    </td>
					</tr>
					<?php }?>
					<?php $total++; }
					if($total==1){
					?>
					<tr style="background-color: #fdffe0;">
					<td colspan="11"><div align="center">No Record Found</div></td>
					</tr>
					<?php } ?>
				    </tbody>


                    <script>
                    $("#togglepo2").click(function(){
                        $("#thisbodyShow").toggle();
                    });
                    </script>

							        <tr class="border-top-info">
									<td style="position: relative;padding: 5px;background-color: #f9f9f9;">
									Lab&nbsp;Dip/&nbsp;Strike&nbsp;off&nbsp;Submission&nbsp;(Lining)</td>

									<td style="position: relative;padding: 5px;background-color: #f9f9f9;">
									<div align="center">
									<input type="text" name="sublinp" id="sublinp" value="<?php echo $operation['sublinp']; ?>">

								    </div>
							    	</td>

									<td style="position: relative;padding: 5px;background-color: #f9f9f9;"><div align="center">
									  <?php if($popdata11['lastdate2'] != "") { echo $popdata11['lastdate2']; } else{ echo "-"; } ?>
								    </div></td>

								    <td><span class="badge" style="cursor:pointer;background-color:green; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;"  onclick="opmodalpop('Add','modalpop.php?action=upsc&styleid=<?php echo $_GET['styleid']; ?>&poId=<?php echo $_GET['poId']; ?>&datarow=lapsubmissionlining','600px','auto');" data-toggle="modal" data-target="#modalpop">
								 Upload</span>
								 <div id="togglepo3" class="badge" style="cursor:pointer;background-color:blue; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;">

								 View</div>

								   </td>


                                  </tr>

				<tbody id="thisbodyShowd" style="display:none;text-align: center;">
					  <tr class="border-top-info" style="background-color: #fff7b3;text-align: left;">
					  <th><div align="center">Stage</div></th>
					  <th><div align="center">Date</div></th>
					<th><div align="center">Remark</div></th>
					<th width="220px;"><div align="center">Attachment</div></th>
					</tr>

				      <?php
					  $total=1;
				    $rrrr1=GetPageRecord('*','criticpop','1 and parentId="'.decode($_GET['poId']).'" and styleId="'.decode($_GET['styleid']).'" and datarow="lapsubmissionlining"');
         		      while($popdata11=mysqli_fetch_array($rrrr1))
         		      {
         		      ?>

					<tr style="background-color: #fdffe0;">
				    <td style="width:30px;"><?php echo $popdata11['stage']; ?></td>
					<td><?php echo $popdata11['uploadDate']; ?></td>
					<td><?php echo $popdata11['remark']; ?></td>

					<td align="center"><?php if($popdata11['attachtp']!=''){ ?>
                    <a href="<?php echo $popdata11['attachtp']; ?>" target="blank">&nbsp;&nbsp;<i class="fa fa-download" aria-hidden="true" style="display: inherit;margin-right: 5px;"></i>Download</a>
                    </td>
					</tr>
					<?php }?>
					<?php $total++; }
					if($total==1){
					?>
					<tr style="background-color: #fdffe0;">
					<td colspan="11"><div align="center">No Record Found</div></td>
					</tr>
					<?php } ?>
				    </tbody>


                    <script>
                    $("#togglepo3").click(function(){
                        $("#thisbodyShowd").toggle();
                    });
                    </script>



							       <tr class="border-top-info">
									<td style="position: relative;padding: 5px;background-color: #f9f9f9;">
									Lab&nbsp;Dip/&nbsp;Strike&nbsp;off&nbsp;Final&nbsp;Approval&nbsp;(Lining)</td>

									<td style="position: relative;padding: 5px;background-color: #f9f9f9;">
										<div align="center">

                                     <input type="text" name="finallinp" id="finallinp" value="<?php echo $operation['finallinp']; ?>">
								    </div>
								</td>

									<td style="position: relative;padding: 5px;background-color: #f9f9f9;"><div align="center">
									<?php if($popdata14['lastdate3'] != "") { echo $popdata14['lastdate3']; } else{ echo "-"; } ?>
								    </div></td>

								    <td><span class="badge" style="cursor:pointer;background-color:green; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;"  onclick="opmodalpop('Add','modalpop.php?action=upsc&styleid=<?php echo $_GET['styleid']; ?>&poId=<?php echo $_GET['poId']; ?>&datarow=lapfinallining','600px','auto');" data-toggle="modal" data-target="#modalpop">
								 Upload</span>
								 <div id="togglepo4" class="badge" style="cursor:pointer;background-color:blue; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;">

								 View</div>

								   </td>


                        </tr>


							   	<tbody id="thisbodyShow4" style="display:none;text-align: center;">
					  <tr class="border-top-info" style="background-color: #fff7b3;text-align: left;">
					  <th><div align="center">Stage</div></th>
					  <th><div align="center">Date</div></th>
					<th><div align="center">Remark</div></th>
					<th width="220px;"><div align="center">Attachment</div></th>
					</tr>

				      <?php
					  $total=1;
				    $rrrr1=GetPageRecord('*','criticpop','1 and parentId="'.decode($_GET['poId']).'" and styleId="'.decode($_GET['styleid']).'" and datarow="lapfinallining"');
         		      while($popdata14=mysqli_fetch_array($rrrr1))
         		      {
         		      ?>

					<tr style="background-color: #fdffe0;">
				    <td style="width:30px;"><?php echo $popdata14['stage']; ?></td>
					<td><?php echo $popdata14['uploadDate']; ?></td>
					<td><?php echo $popdata14['remark']; ?></td>

					<td align="center"><?php if($popdata14['attachtp']!=''){ ?>
                    <a href="<?php echo $popdata14['attachtp']; ?>" target="blank">&nbsp;&nbsp;<i class="fa fa-download" aria-hidden="true" style="display: inherit;margin-right: 5px;"></i>Download</a>
                    </td>
					</tr>
					<?php }?>
					<?php $total++; }
					if($total==1){
					?>
					<tr style="background-color: #fdffe0;">
					<td colspan="11"><div align="center">No Record Found</div></td>
					</tr>
					<?php } ?>
				    </tbody>


                    <script>
                    $("#togglepo4").click(function(){
                        $("#thisbodyShow4").toggle();
                    });
                    </script>




								<tr class="border-top-info">
									<td style="position: relative;padding: 5px;background-color: #f9f9f9;">
									Development&nbsp;FPT</td>

									<td style="position: relative;padding: 5px;background-color: #f9f9f9;">
										<div align="center">
											<?php
											$tdr=GetPageRecord('*','taskListMaster','1 and name="3" and tnatemplate="'.$editresultstyle['tnaTemplateId'].'"');
                                    $temnamer=mysqli_fetch_array($tdr);

                                    $tdra=GetPageRecord('*','timeActionReport ','1 and taskListId="'.$temnamer['id'] .'" and styleId="'.$resultpage['id'].'" and status=1');
                                    $counttdra=mysql_num_rows($tdra);
                                    $temnamera=mysqli_fetch_array($tdra);
                                    echo date('d-m-Y',strtotime($temnamera['complitionDate']))
                                    ?>

								    </div>
								</td>

									<td style="position: relative;padding: 5px;background-color: #f9f9f9;"><div align="center">
									 <?php if($popdata15['lastdate4'] != "") { echo $popdata15['lastdate4']; } else{ echo "-"; } ?>
								    </div></td>

								    <td><span class="badge" style="cursor:pointer;background-color:green; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;"  onclick="opmodalpop('','modalpop.php?action=upsc&styleid=<?php echo $_GET['styleid']; ?>&poId=<?php echo $_GET['poId']; ?>&datarow=devlopfpt','600px','auto');" data-toggle="modal" data-target="#modalpop">
								 Upload</span>
								 <div id="togglepo5" class="badge" style="cursor:pointer;background-color:blue; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;">

								 View</div>

								   </td>





                                  </tr>

                                  	<tbody id="thisbodyShow5" style="display:none;text-align: center;">
					  <tr class="border-top-info" style="background-color: #fff7b3;text-align: left;">
					  <th><div align="center">Stage</div></th>
					  <th><div align="center">Date</div></th>
					<th><div align="center">Remark</div></th>
					<th width="220px;"><div align="center">Attachment</div></th>
					</tr>

				      <?php
					  $total=1;
					  $rrrr1=GetPageRecord('*','criticpop','1 and parentId="'.decode($_GET['poId']).'" and styleId="'.decode($_GET['styleid']).'" and datarow="devlopfpt"');

         		      while($popdata14=mysqli_fetch_array($rrrr1))
         		      {
         		      ?>

					<tr style="background-color: #fdffe0;">
				    <td style="width:30px;"><?php echo $popdata14['stage']; ?></td>
					<td><?php echo $popdata14['uploadDate']; ?></td>
					<td><?php echo $popdata14['remark']; ?></td>

					<td align="center"><?php if($popdata14['attachtp']!=''){ ?>
                    <a href="<?php echo $popdata14['attachtp']; ?>" target="blank">&nbsp;&nbsp;<i class="fa fa-download" aria-hidden="true" style="display: inherit;margin-right: 5px;"></i>Download</a>
                    </td>
					</tr>
					<?php }?>
					<?php $total++; }
					if($total==1){
					?>
					<tr style="background-color: #fdffe0;">
					<td colspan="11"><div align="center">No Record Found</div></td>
					</tr>
					<?php } ?>
				    </tbody>


                    <script>
                    $("#togglepo5").click(function(){
                        $("#thisbodyShow5").toggle();
                    });
                    </script>

                                  <tr class="border-top-info">
									<td style="position: relative;padding: 5px;background-color: #f9f9f9;">
									Development&nbsp;GPT</td>

									<td style="position: relative;padding: 5px;background-color: #f9f9f9;">
										<div align="center">
											<?php
											$tdr=GetPageRecord('*','taskListMaster','1 and name="3" and tnatemplate="'.$editresultstyle['tnaTemplateId'].'"');
                                    $temnamer=mysqli_fetch_array($tdr);

                                    $tdra=GetPageRecord('*','timeActionReport ','1 and taskListId="'.$temnamer['id'] .'" and styleId="'.$resultpage['id'].'" and status=1');
                                    $counttdra=mysql_num_rows($tdra);
                                    $temnamera=mysqli_fetch_array($tdra);
                                    echo date('d-m-Y',strtotime($temnamera['complitionDate']))
                                    ?>
								    </div>
								</td>

									<td style="position: relative;padding: 5px;background-color: #f9f9f9;"><div align="center">
									  <?php if($popdata16['lastdate5'] != "") { echo $popdata16['lastdate5']; } else{ echo "-"; } ?>
								    </div></td>

								    <td><span class="badge" style="cursor:pointer;background-color:green; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;"  onclick="opmodalpop('','modalpop.php?action=upsc&styleid=<?php echo $_GET['styleid']; ?>&poId=<?php echo $_GET['poId']; ?>&datarow=devlopgpt','600px','auto');" data-toggle="modal" data-target="#modalpop">
								 Upload</span>
								 <div id="togglepo6" class="badge" style="cursor:pointer;background-color:blue; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;">

								 View</div>

								   </td>


                                  </tr>

                                  <tbody id="thisbodyShow6" style="display:none;text-align: center;">
					  <tr class="border-top-info" style="background-color: #fff7b3;text-align: left;">
					  <th><div align="center">Stage</div></th>
					  <th><div align="center">Date</div></th>
					<th><div align="center">Remark</div></th>
					<th width="220px;"><div align="center">Attachment</div></th>
					</tr>

				      <?php
					  $total=1;
				    $rrrr1=GetPageRecord('*','criticpop','1 and parentId="'.decode($_GET['poId']).'" and styleId="'.decode($_GET['styleid']).'" and datarow="devlopgpt"');
         		      while($popdata14=mysqli_fetch_array($rrrr1))
         		      {
         		      ?>

					<tr style="background-color: #fdffe0;">
				    <td style="width:30px;"><?php echo $popdata14['stage']; ?></td>
					<td><?php echo $popdata14['uploadDate']; ?></td>
					<td><?php echo $popdata14['remark']; ?></td>

					<td align="center"><?php if($popdata14['attachtp']!=''){ ?>
                    <a href="<?php echo $popdata14['attachtp']; ?>" target="blank">&nbsp;&nbsp;<i class="fa fa-download" aria-hidden="true" style="display: inherit;margin-right: 5px;"></i>Download</a>
                    </td>
					</tr>
					<?php }?>
					<?php $total++; }
					if($total==1){
					?>
					<tr style="background-color: #fdffe0;">
					<td colspan="11"><div align="center">No Record Found</div></td>
					</tr>
					<?php } ?>
				    </tbody>


                    <script>
                    $("#togglepo6").click(function(){
                        $("#thisbodyShow6").toggle();
                    });
                    </script>

                                  <tr class="border-top-info">
									<td style="position: relative;padding: 5px;background-color: #f9f9f9;">
									Bulk&nbsp;FPT&nbsp;(Shell)</td>

									<td style="position: relative;padding: 5px;background-color: #f9f9f9;">
										<div align="center">
											<?php
											$tdr=GetPageRecord('*','taskListMaster','1 and name="18" and tnatemplate="'.$editresultstyle['tnaTemplateId'].'"');
                                    $temnamer=mysqli_fetch_array($tdr);

                                    $tdra=GetPageRecord('*','timeActionReport ','1 and taskListId="'.$temnamer['id'] .'" and styleId="'.$resultpage['id'].'" and status=1');
                                    $counttdra=mysql_num_rows($tdra);
                                    $temnamera=mysqli_fetch_array($tdra);
                                    echo date('d-m-Y',strtotime($temnamera['complitionDate']))
                                    ?>
								    </div>
								</td>

									<td style="position: relative;padding: 5px;background-color: #f9f9f9;"><div align="center">
									   <?php if($popdata17['lastdate6'] != "") { echo $popdata17['lastdate6']; } else{ echo "-"; } ?>
								    </div></td>

								    <td><span class="badge" style="cursor:pointer;background-color:green; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;"  onclick="opmodalpop('','modalpop.php?action=upsc&styleid=<?php echo $_GET['styleid']; ?>&poId=<?php echo $_GET['poId']; ?>&datarow=bulkfptshel','600px','auto');" data-toggle="modal" data-target="#modalpop">
								 Upload</span>
								 <div id="togglepo7" class="badge" style="cursor:pointer;background-color:blue; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;">

								 View</div>

								   </td>


                        </tr>

                        <tbody id="thisbodyShow7" style="display:none;text-align: center;">
					  <tr class="border-top-info" style="background-color: #fff7b3;text-align: left;">
					  <th><div align="center">Stage</div></th>
					  <th><div align="center">Date</div></th>
					<th><div align="center">Remark</div></th>
					<th width="220px;"><div align="center">Attachment</div></th>
					</tr>

				      <?php
					  $total=1;
				      $rrrr1=GetPageRecord('*','criticpop','1 and parentId="'.decode($_GET['poId']).'" and styleId="'.decode($_GET['styleid']).'" and datarow="bulkfptshel"');
         		      while($popdata14=mysqli_fetch_array($rrrr1))
         		      {
         		      ?>

					<tr style="background-color: #fdffe0;">
				    <td style="width:30px;"><?php echo $popdata14['stage']; ?></td>
					<td><?php echo $popdata14['uploadDate']; ?></td>
					<td><?php echo $popdata14['remark']; ?></td>

					<td align="center"><?php if($popdata14['attachtp']!=''){ ?>
                    <a href="<?php echo $popdata14['attachtp']; ?>" target="blank">&nbsp;&nbsp;<i class="fa fa-download" aria-hidden="true" style="display: inherit;margin-right: 5px;"></i>Download</a>
                    </td>
					</tr>
					<?php }?>
					<?php $total++; }
					if($total==1){
					?>
					<tr style="background-color: #fdffe0;">
					<td colspan="11"><div align="center">No Record Found</div></td>
					</tr>
					<?php } ?>
				    </tbody>


                    <script>
                    $("#togglepo7").click(function(){
                        $("#thisbodyShow7").toggle();
                    });
                    </script>


                                    <tr class="border-top-info">
									<td style="position: relative;padding: 5px;background-color: #f9f9f9;">
									Bulk&nbsp;FPT&nbsp;(Lining)</td>

									<td style="position: relative;padding: 5px;background-color: #f9f9f9;">
										<div align="center">

                                        <input type="text" name="bulklinp" id="bulklinp" value="<?php echo $operation['bulklinp']; ?>">
								    </div>
								</td>

									<td style="position: relative;padding: 5px;background-color: #f9f9f9;"><div align="center">
									  <?php if($popdata18['lastdate7'] != "") { echo $popdata18['lastdate7']; } else{ echo "-"; } ?>
								    </div></td>

								    <td><span class="badge" style="cursor:pointer;background-color:green; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;"  onclick="opmodalpop('','modalpop.php?action=upsc&styleid=<?php echo $_GET['styleid']; ?>&poId=<?php echo $_GET['poId']; ?>&datarow=bulkfptlining','600px','auto');" data-toggle="modal" data-target="#modalpop">
								 Upload</span>
								 <div id="togglepo8" class="badge" style="cursor:pointer;background-color:blue; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;">

								 View</div>

								   </td>


                                  </tr>

                                       <tbody id="thisbodyShow8" style="display:none;text-align: center;">
					  <tr class="border-top-info" style="background-color: #fff7b3;text-align: left;">
					  <th><div align="center">Stage</div></th>
					  <th><div align="center">Date</div></th>
					<th><div align="center">Remark</div></th>
					<th width="220px;"><div align="center">Attachment</div></th>
					</tr>

				      <?php
					  $total=1;
				     $rrrr1=GetPageRecord('*','criticpop','1 and parentId="'.decode($_GET['poId']).'" and styleId="'.decode($_GET['styleid']).'" and datarow="bulkfptlining"');
         		      while($popdata14=mysqli_fetch_array($rrrr1))
         		      {
         		      ?>

					<tr style="background-color: #fdffe0;">
				    <td style="width:30px;"><?php echo $popdata14['stage']; ?></td>
					<td><?php echo $popdata14['uploadDate']; ?></td>
					<td><?php echo $popdata14['remark']; ?></td>

					<td align="center"><?php if($popdata14['attachtp']!=''){ ?>
                    <a href="<?php echo $popdata14['attachtp']; ?>" target="blank">&nbsp;&nbsp;<i class="fa fa-download" aria-hidden="true" style="display: inherit;margin-right: 5px;"></i>Download</a>
                    </td>
					</tr>
					<?php }?>
					<?php $total++; }
					if($total==1){
					?>
					<tr style="background-color: #fdffe0;">
					<td colspan="11"><div align="center">No Record Found</div></td>
					</tr>
					<?php } ?>
				    </tbody>


                    <script>
                    $("#togglepo8").click(function(){
                        $("#thisbodyShow8").toggle();
                    });
                    </script>



							        <tr class="border-top-info">
									<td style="position: relative;padding: 5px;background-color: #f9f9f9;">
									FOB&nbsp;Approval</td>

									<td style="position: relative;padding: 5px;background-color: #f9f9f9;">
									<div align="center">
									<input type="text" name="fobp" id="fobp" value="<?php echo $operation['fobp']; ?>">

								   </div>
							   	   </td>

									<td style="position: relative;padding: 5px;background-color: #f9f9f9;"><div align="center">
									  <?php if($popdata19['lastdate8'] != "") { echo $popdata19['lastdate8']; } else{ echo "-"; } ?>
								    </div></td>

								    <td><span class="badge" style="cursor:pointer;background-color:green; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;"  onclick="opmodalpop('','modalpop.php?action=upsc&styleid=<?php echo $_GET['styleid']; ?>&poId=<?php echo $_GET['poId']; ?>&datarow=fobapproval','600px','auto');" data-toggle="modal" data-target="#modalpop">
								 Upload</span>
								 <div id="togglepo9" class="badge" style="cursor:pointer;background-color:blue; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;">

								 View</div>

								   </td>


                                  </tr>


                                    <tbody id="thisbodyShow9" style="display:none;text-align: center;">
					  <tr class="border-top-info" style="background-color: #fff7b3;text-align: left;">
					  <th><div align="center">Stage</div></th>
					  <th><div align="center">Date</div></th>
					<th><div align="center">Remark</div></th>
					<th width="220px;"><div align="center">Attachment</div></th>
					</tr>

				      <?php
					  $total=1;
				    $rrrr1=GetPageRecord('*','criticpop','1 and parentId="'.decode($_GET['poId']).'" and styleId="'.decode($_GET['styleid']).'" and datarow="fobapproval"');
         		      while($popdata14=mysqli_fetch_array($rrrr1))
         		      {
         		      ?>

					<tr style="background-color: #fdffe0;">
				    <td style="width:30px;"><?php echo $popdata14['stage']; ?></td>
					<td><?php echo $popdata14['uploadDate']; ?></td>
					<td><?php echo $popdata14['remark']; ?></td>

					<td align="center"><?php if($popdata14['attachtp']!=''){ ?>
                    <a href="<?php echo $popdata14['attachtp']; ?>" target="blank">&nbsp;&nbsp;<i class="fa fa-download" aria-hidden="true" style="display: inherit;margin-right: 5px;"></i>Download</a>
                    </td>
					</tr>
					<?php }?>
					<?php $total++; }
					if($total==1){
					?>
					<tr style="background-color: #fdffe0;">
					<td colspan="11"><div align="center">No Record Found</div></td>
					</tr>
					<?php } ?>
				    </tbody>


                    <script>
                    $("#togglepo9").click(function(){
                        $("#thisbodyShow9").toggle();
                    });
                    </script>







                                  <tr class="border-top-info">
									<td style="position: relative;padding: 5px;background-color: #f9f9f9;">
									PP&nbsp;Sample</td>

									<td style="position: relative;padding: 5px;background-color: #f9f9f9;">
										<div align="center">
											<?php
											$tdr=GetPageRecord('*','taskListMaster','1 and name="21" and tnatemplate="'.$editresultstyle['tnaTemplateId'].'"');
                                    $temnamer=mysqli_fetch_array($tdr);

                                    $tdra=GetPageRecord('*','timeActionReport ','1 and taskListId="'.$temnamer['id'] .'" and styleId="'.$resultpage['id'].'" and status=1');
                                    $counttdra=mysql_num_rows($tdra);
                                    $temnamera=mysqli_fetch_array($tdra);
                                    echo date('d-m-Y',strtotime($temnamera['complitionDate']))
                                    ?>
								    </div>
								</td>

									<td style="position: relative;padding: 5px;background-color: #f9f9f9;"><div align="center">
									 <?php if($popdata20['lastdate9'] != "") { echo $popdata20['lastdate9']; } else{ echo "-"; } ?>
								    </div></td>

								    <td><span class="badge" style="cursor:pointer;background-color:green; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;"  onclick="opmodalpop('','modalpop.php?action=upsc&styleid=<?php echo $_GET['styleid']; ?>&poId=<?php echo $_GET['poId']; ?>&datarow=ppsamples','600px','auto');" data-toggle="modal" data-target="#modalpop">
								 Upload</span>
								 <div id="togglepo11" class="badge" style="cursor:pointer;background-color:blue; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;">

								 View</div>

								   </td>


                                  </tr>

                                  <tbody id="thisbodyShow11" style="display:none;text-align: center;">
					  <tr class="border-top-info" style="background-color: #fff7b3;text-align: left;">
					  <th><div align="center">Stage</div></th>
					  <th><div align="center">Date</div></th>
					<th><div align="center">Remark</div></th>
					<th width="220px;"><div align="center">Attachment</div></th>
					</tr>

				      <?php
					  $total=1;
				     $rrrr1=GetPageRecord('*','criticpop','1 and parentId="'.decode($_GET['poId']).'" and styleId="'.decode($_GET['styleid']).'" and datarow="ppsamples"');
         		      while($popdata14=mysqli_fetch_array($rrrr1))
         		      {
         		      ?>

					<tr style="background-color: #fdffe0;">
				    <td style="width:30px;"><?php echo $popdata14['stage']; ?></td>
					<td><?php echo $popdata14['uploadDate']; ?></td>
					<td><?php echo $popdata14['remark']; ?></td>

					<td align="center"><?php if($popdata14['attachtp']!=''){ ?>
                    <a href="<?php echo $popdata14['attachtp']; ?>" target="blank">&nbsp;&nbsp;<i class="fa fa-download" aria-hidden="true" style="display: inherit;margin-right: 5px;"></i>Download</a>
                    </td>
					</tr>
					<?php }?>
					<?php $total++; }
					if($total==1){
					?>
					<tr style="background-color: #fdffe0;">
					<td colspan="11"><div align="center">No Record Found</div></td>
					</tr>
					<?php } ?>
				    </tbody>


                    <script>
                    $("#togglepo11").click(function(){
                        $("#thisbodyShow11").toggle();
                    });
                    </script>

                                  <tr class="border-top-info">
									<td style="position: relative;padding: 5px;background-color: #f9f9f9;">
									Bulk&nbsp;GPT</td>

									<td style="position: relative;padding: 5px;background-color: #f9f9f9;">
										<div align="center">
											<?php
											$tdr=GetPageRecord('*','taskListMaster','1 and name="37" and tnatemplate="'.$editresultstyle['tnaTemplateId'].'"');
                                    $temnamer=mysqli_fetch_array($tdr);

                                    $tdra=GetPageRecord('*','timeActionReport ','1 and taskListId="'.$temnamer['id'] .'" and styleId="'.$resultpage['id'].'" and status=1');
                                    $counttdra=mysql_num_rows($tdra);
                                    $temnamera=mysqli_fetch_array($tdra);
                                    echo date('d-m-Y',strtotime($temnamera['complitionDate']))
                                    ?>
								    </div>
								</td>

									<td style="position: relative;padding: 5px;background-color: #f9f9f9;"><div align="center">
									  <?php if($popdata21['lastdate10'] != "") { echo $popdata21['lastdate10']; } else{ echo "-"; } ?>
								    </div></td>

								    <td><span class="badge" style="cursor:pointer;background-color:green; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;"  onclick="opmodalpop('','modalpop.php?action=upsc&styleid=<?php echo $_GET['styleid']; ?>&poId=<?php echo $_GET['poId']; ?>&datarow=bulkgpt','600px','auto');" data-toggle="modal" data-target="#modalpop">
								 Upload</span>
								 <div id="togglepo12" class="badge" style="cursor:pointer;background-color:blue; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;">

								 View</div>

								   </td>


                                  </tr>


                                  <tbody id="thisbodyShow12" style="display:none;text-align: center;">
					  <tr class="border-top-info" style="background-color: #fff7b3;text-align: left;">
					  <th><div align="center">Stage</div></th>
					  <th><div align="center">Date</div></th>
					<th><div align="center">Remark</div></th>
					<th width="220px;"><div align="center">Attachment</div></th>
					</tr>

				      <?php
					  $total=1;
				     $rrrr1=GetPageRecord('*','criticpop','1 and parentId="'.decode($_GET['poId']).'" and styleId="'.decode($_GET['styleid']).'" and datarow="bulkgpt"');
         		      while($popdata14=mysqli_fetch_array($rrrr1))
         		      {
         		      ?>

					<tr style="background-color: #fdffe0;">
				    <td style="width:30px;"><?php echo $popdata14['stage']; ?></td>
					<td><?php echo $popdata14['uploadDate']; ?></td>
					<td><?php echo $popdata14['remark']; ?></td>

					<td align="center"><?php if($popdata14['attachtp']!=''){ ?>
                    <a href="<?php echo $popdata14['attachtp']; ?>" target="blank">&nbsp;&nbsp;<i class="fa fa-download" aria-hidden="true" style="display: inherit;margin-right: 5px;"></i>Download</a>
                    </td>
					</tr>
					<?php }?>
					<?php $total++; }
					if($total==1){
					?>
					<tr style="background-color: #fdffe0;">
					<td colspan="11"><div align="center">No Record Found</div></td>
					</tr>
					<?php } ?>
				    </tbody>


                    <script>
                    $("#togglepo12").click(function(){
                    $("#thisbodyShow12").toggle();
                    });
                    </script>




                                    <tr class="border-top-info">
									<td style="position: relative;padding: 5px;background-color: #f9f9f9;">
									Shade&nbsp;Lot&nbsp;Approval</td>

									<td style="position: relative;padding: 5px;background-color: #f9f9f9;">
								    <div align="center">
								    <input type="text" name="shadep" id="shadep"  value="<?php echo $operation['shadep']; ?>">

								    </div>
								    </td>

									<td style="position: relative;padding: 5px;background-color: #f9f9f9;"><div align="center">
									   <?php if($popdata22['lastdate11'] != "") { echo $popdata22['lastdate11']; } else{ echo "-"; } ?>
								    </div></td>

								    <td><span class="badge" style="cursor:pointer;background-color:green; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;"  onclick="opmodalpop('','modalpop.php?action=upsc&styleid=<?php echo $_GET['styleid']; ?>&poId=<?php echo $_GET['poId']; ?>&datarow=shadelot','600px','auto');" data-toggle="modal" data-target="#modalpop">
								    Upload</span>
								    <div id="togglepo13" class="badge" style="cursor:pointer;background-color:blue; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;">

								 View</div>

								   </td>


                                  </tr>




                      <tbody id="thisbodyShow13" style="display:none;text-align: center;">
					  <tr class="border-top-info" style="background-color: #fff7b3;text-align: left;">
					  <th><div align="center">Stage</div></th>
					  <th><div align="center">Date</div></th>
					  <th><div align="center">Remark</div></th>
					  <th width="220px;"><div align="center">Attachment</div></th>
					  </tr>

				      <?php
					  $total=1;
				     $rrrr1=GetPageRecord('*','criticpop','1 and parentId="'.decode($_GET['poId']).'" and styleId="'.decode($_GET['styleid']).'" and datarow="shadelot"');
         		      while($popdata14=mysqli_fetch_array($rrrr1))
         		      {
         		      ?>

					<tr style="background-color: #fdffe0;">
				    <td style="width:30px;"><?php echo $popdata14['stage']; ?></td>
					<td><?php echo $popdata14['uploadDate']; ?></td>
					<td><?php echo $popdata14['remark']; ?></td>

					<td align="center"><?php if($popdata14['attachtp']!=''){ ?>
                    <a href="<?php echo $popdata14['attachtp']; ?>" target="blank">&nbsp;&nbsp;<i class="fa fa-download" aria-hidden="true" style="display: inherit;margin-right: 5px;"></i>Download</a>
                    </td>
					</tr>
					<?php }?>
					<?php $total++; }
					if($total==1){
					?>
					 <tr style="background-color: #fdffe0;">
					<td colspan="11"><div align="center">No Record Found</div></td>
					</tr>
					<?php } ?>
				    </tbody>


                    <script>
                    $("#togglepo13").click(function(){
                        $("#thisbodyShow13").toggle();
                    });
                    </script>























                                  <tr class="border-top-info">
									<td style="position: relative;padding: 5px;background-color: #f9f9f9;">
									Ad&nbsp;Sample</td>

									<td style="position: relative;padding: 5px;background-color: #f9f9f9;">
										<div align="center">
											<?php
											$currentdate= date('d-m-Y',strtotime($editresultstyle['shipDate']));
											$date=date_create($currentdate);
										   date_sub($date,date_interval_create_from_date_string("35 days"));
										   echo date_format($date,"d-m-Y");
											 ?>
								    </div>
								</td>

									<td style="position: relative;padding: 5px;background-color: #f9f9f9;"><div align="center">
									  <input  name="actualDate6" type="text" class="form-control" id="actualDate6" style="position: relative; width: 140px; text-align: center;background-color: white;" min="" value="<?php echo $operation['addSampleDate']; ?>"   maxlength="200" readonly="readonly">

								    </div></td>
								    <td style="position: relative;padding: 5px;background-color: #f9f9f9;">
										<div align="center">
								    <input type="text" name="addsample" id="addsample" value="<?php echo $operation['addSample'] ?>">
								    </div>
								    </td>
                                  </tr>
                                  <tr class="border-top-info">
									<td style="position: relative;padding: 5px;background-color: #f9f9f9;">
									TOP&nbsp;Sample</td>

									<td style="position: relative;padding: 5px;background-color: #f9f9f9;">
										<div align="center">
											<?php
											$currentdate= date('d-m-Y',strtotime($editresultstyle['shipDate']));
											$date=date_create($currentdate);
										   date_sub($date,date_interval_create_from_date_string("14 days"));
										   echo date_format($date,"d-m-Y");
											 ?>
								    </div>
								</td>

									<td style="position: relative;padding: 5px;background-color: #f9f9f9;"><div align="center">
									  <input  name="actualDate7" type="text" class="form-control" id="actualDate7" style="position: relative; width: 140px; text-align: center;background-color: white;" min="" value="<?php echo $operation['topSampleDate']; ?>"   maxlength="200" readonly="readonly">

								    </div></td>
								    <td style="position: relative;padding: 5px;background-color: #f9f9f9;">
										<div align="center">
											<input type="text" name="topsample" id="topsample" value="<?php echo $operation['topSample'] ?>">
								    </div>
								</td>
                                  </tr>





<script>
$( function(){
	// $( "#actualDate1").datepicker();
	// $( "#actualDate2").datepicker();
	// $( "#actualDate3").datepicker();
	// $( "#actualDate4").datepicker();
	// $( "#actualDate5").datepicker();
	$( "#actualDate6").datepicker();
	$( "#actualDate7").datepicker();

		$( "#subshella").datepicker();

	$( "#subshellp").datepicker();
		$( "#finalshella").datepicker();

	$( "#finalshellp").datepicker();
	$( "#sublina").datepicker();
	$( "#sublinp").datepicker();
	$( "#finallinp").datepicker();
	$( "#finallina").datepicker();

	$( "#bulklina").datepicker();
	$( "#bulklinp").datepicker();
	$( "#foba").datepicker();
	$( "#fobp").datepicker();
		$( "#shadep").datepicker();

	$( "#shadea").datepicker();


} );
</script>

				</table>
				<br>

    <button type="submit" class="btn btn-primary" style="float:right">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;"></i></button>

				</form>

					<?php

				}
				?>


<!-- code ends -->




					</div>
				   </div>
				 </div>

				</div>
			</div>
			</div>

		</div>

	</div>


  <!--<div class="modal fade" id="myModal<?php echo encode($_GET['styleid']); ?>" role="dialog" style="width:500px;">-->
  <!--   <div class="modal-dialog">-->

      <!-- Modal content-->
  <!--    <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">-->
  <!--    <div class="modal-content">-->
  <!--      <div class="modal-header">-->
          <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
  <!--        <h4 class="modal-title" style="text-align:right;">Add</h4>-->
  <!--      </div>-->
  <!--      <div class="modal-body">-->
  <!--      <input type="text" id="stage" name="stage" class="form-control">-->
  <!--      </div>-->
  <!--      <div class="modal-footer">-->
  <!--          <input name="action" type="hidden" id="action" value="yt"/>-->
  <!--          <button type="submit" class="btn btn-primary" style="float:right">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;"></i></button>-->
          <!--<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>-->
  <!--      </div>-->
  <!--    </div>-->
  <!--     </form>-->
  <!--     </div>-->
  <!--  </div>-->

 <style>
 .liststyleimg{float: left;
    width: 70px;
    margin-right: 15px;
    padding: 5px;
    border: 2px solid #e6e6e6;}

	.badge.dropdown-toggle:after { display:none;
}

.btn-float i {
    display: block;
    top: 0;
    font-size: 20px;
}

.card-group-control-right .card-body{width:100%;}

.table td, .table th {
    vertical-align: middle !important;
}

.form-control {
    display: block;
    width: 100%;
    font-size: .8125rem;
    line-height: 1.5385;
    color: #5d5d5d;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #d8d8d8;
    border-radius: 2px;
    box-shadow: 0 0 0 0 transparent;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
.listc .table-bordered td, .table-bordered th {
    border: 1px solid #ddd !important;
    padding: 8px;
}


 </style>


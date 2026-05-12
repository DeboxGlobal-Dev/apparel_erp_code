<?php

//$updatepage='1';

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

	<div class="page-content">



	 	<?php include "left.php"; ?>

	 	<div class="content-wrapper">







		 	<div class="content pt-0" style="margin-top:20px; overflow:hidden;">

			 	<?php include "top-style.php"; ?>



				     <div class="row" >

				     <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered table-responsive forbom summaryfinal" style="display: block; overflow: hidden; margin: 10px;">

                          <tbody style="width: 100%;display: inline-table;">





							<tr class="card-body" style="background-color: #f9f9f9;">

							  <td width="17%" align="left"><div align="center"><strong>Repeat </strong></div></td>

							<td width="15%" align="left"><div align="center"><strong>Regular/Chase </strong></div></td>

							<td width="17%" align="left"><div align="center"><strong>Shell Fabric</strong></div></td>

							</tr>



							<tr class="card-body" style="background-color: #f9f9f9;">







							  <td width="17%" align="left">

							  	<div align="center">

							  <?php

	                             if ($editresultstyle['repeatOrder'] == "1") {

	                             	echo "Yes";

	                             }

	                             else if($editresultstyle['repeatOrder'] == "2") {

	                             	echo "No";

	                             }

	                             else{

	                             	echo "-";

	                                  }

							        ?>

							  </div>

							</td>

							<?php

							$tdr=GetPageRecord('*','taskListMaster','1 and name="3" and tnatemplate="'.$editresultstyle['tnaTemplateId'].'"');

                                    $temnamer=mysqli_fetch_array($tdr);



                                    $tdra=GetPageRecord('*','timeActionReport ','1 and taskListId="'.$temnamer['id'] .'" and styleId="'.$editresultstyle['id'].'" and status=1');

                                    $counttdra=mysql_num_rows($tdra);

                                    $temnamera=mysqli_fetch_array($tdra);



									 $exdate=date('d-m-Y', strtotime($temnamera['complitionDate']));

									 $currentdate= date('d-m-Y',strtotime($editresultstyle['shipDate']));





									 $start_date = strtotime($currentdate);

									 $end_date = strtotime($exdate);

									  ?>

							<td width="15%" align="center"><div align="center">

								<?php

							  	if($editresultstyle['shipDate'] != "0000-00-00" &&  $editresultstyle['shipDate'] != "1970-01-01" && $counttdra != "0"){

							  	  $days = ($start_date - $end_date)/60/60/24;

							  	  if($days > "0" && $days < "60") {

							  	  	echo "Chase";

							  	  }

							  	  else if($days >= "60" && $days < "90") {

							  	  	echo "Regular";

							  	  }

							  	  else{

							  	  	echo "-";

							  	  }  } else { echo "-"; } ?>

							  	 </div></td>

							<td width="17%" align="center"><div align="center">



							  	 </div></td>



							</tr>

                          </tbody>

                        </table>



				<div class="col-xl-12">

				<div class="card">

							<div class="card-header bg-white">

								<h6 class="card-title">PD to Production Handover</h6>



				  </div>





				<div class="card-body">

				<div class="form-group">





				<div class="row">





					<table width="100%" border="0" cellpadding="5" cellspacing="0" class="table" style="font-size: 12px;">





  <tr height="35" style="background-color: #fff7b3;text-align: left;">

    <td width="3%"><div align="center"><strong>SR.</strong></div></td>

				<td><div align="left"><strong>List</strong></div></td>

				<td width="22%"><div align="center"><strong>Status</strong></div></td>

				<td width="15%"><div align="center"><strong>Date</strong></div></td>

    </tr>

    <?php

    $rsqtye=GetPageRecord('*','timeActionReport','1 and styleid="'.decode($_GET['styleid']).'"');

    if(mysql_num_rows($rsqtye) > 0 ) { $tna = "YES"; } else { $tna= "NO"; }



    $fff=GetPageRecord('*','styleColorDetailMaster','1 and styleid="'.decode($_GET['styleid']).'" limit 1');

	$line=mysqli_fetch_array($fff);

	if($editresultstyle['projecQty'] != "" && $editresultstyle['orderQty'] != ""){

		$order = "Confirmed";

	}

	else if ($editresultstyle['projecQty'] != "" && $editresultstyle['orderQty'] == "") {

		$order = "To be Confirmed";

	}

	else{

		$order="";

	}



	$fff=GetPageRecord('*','embroideryTypeMaster','1 and id="'.$line['valueEdition'].'"');

	$value=mysqli_fetch_array($fff);



	$sNo=0;
	$rs=GetPageRecord('id,name,type,typeValue','pdtopromaster','1 and status=1 order by id asc LIMIT 16');

	while($handoverData=mysqli_fetch_array($rs)){



	$kk=GetPageRecord('*','pdtopromasterenrty','1 and styleid="'.decode($_GET['styleid']).'" and handoverid="'.$handoverData['id'].'"');

	$handoverEntry=mysqli_fetch_array($kk);



    ?>



   <tr height="20">

     <td><div align="center"><?php echo ++$sNo; ?></div></td>

    	<td><div><?php echo $handoverData['name']; ?></div></td>







			<td style="position: relative; padding: 5px; background-color: #f9f9f9;"><div>

			  <div align="center">

			    <?php if($handoverData['type']==0){



			    	if($handoverData['id'] == "2"){ ?>

			    	<input style="width:250px;" type="text" value="<?php echo $editresultstyle['styleRefId'] ?>" onkeyup="savemeasurmentdata<?php echo $handoverData['id']; ?>();" class="form-control" name="handoverstatus<?php echo $handoverData['id']; ?>" id="handoverstatus<?php echo $handoverData['id']; ?>"><?php }

			    	else if($handoverData['id'] == "19"){ ?>

			    	<input style="width:250px;" type="text" value="<?php echo $tna; ?>" onkeyup="savemeasurmentdata<?php echo $handoverData['id']; ?>();" class="form-control" name="handoverstatus<?php echo $handoverData['id']; ?>" id="handoverstatus<?php echo $handoverData['id']; ?>"><?php }

			    	else if($handoverData['id'] == "5"){ ?>

			    	<input style="width:250px;" type="text" value="<?php echo $value['name'] ?>" onkeyup="savemeasurmentdata<?php echo $handoverData['id']; ?>();" class="form-control" name="handoverstatus<?php echo $handoverData['id']; ?>" id="handoverstatus<?php echo $handoverData['id']; ?>"><?php }

			    	else if($handoverData['id'] == "6"){ ?>

			    	<input style="width:250px;" type="text" value="<?php echo $line['lining']; ?>" onkeyup="savemeasurmentdata<?php echo $handoverData['id']; ?>();" class="form-control" name="handoverstatus<?php echo $handoverData['id']; ?>" id="handoverstatus<?php echo $handoverData['id']; ?>"><?php }

			    	else if($handoverData['id'] == "1"){ ?>

			    	<input style="width:250px;" type="text" value="<?php echo $order; ?>" onkeyup="savemeasurmentdata<?php echo $handoverData['id']; ?>();" class="form-control" name="handoverstatus<?php echo $handoverData['id']; ?>" id="handoverstatus<?php echo $handoverData['id']; ?>"><?php }



			    	else { ?>

			    	<input style="width:250px;" type="text" value="<?php echo $handoverEntry['handoverstatus']; ?>" onkeyup="savemeasurmentdata<?php echo $handoverData['id']; ?>();" class="form-control" name="handoverstatus<?php echo $handoverData['id']; ?>" id="handoverstatus<?php echo $handoverData['id']; ?>"><?php } }

			    	else{ ?>

				<select style="width:250px;" name="handoverstatus<?php echo $handoverData['id']; ?>" id="handoverstatus<?php echo $handoverData['id']; ?>" class="form-control" onchange="savemeasurmentdata<?php echo $handoverData['id']; ?>();">



					<?php if($handoverData['id'] != "10" && $handoverData['id'] != "15" && $handoverData['id'] != "16" && $handoverData['id'] != "17" && $handoverData['id'] != "18") { ?>

				<option value="">Select</option>

				<?php } ?>

				<?php

				$arrVal = explode(',',$handoverData['typeValue']);

				foreach($arrVal as $item){ ?>

				<option value="<?php echo $item; ?>" <?php if($handoverEntry['handoverstatus']==$item){ ?> selected="selected" <?php } ?>><?php echo $item; ?></option>



				<?php }

				?>



				</select>

				<?php } ?>

			    </div>

			</div></td>







		<td height="20" align="left">

		<div align="center">



		<input style="text-align:center;" name="handoverdate<?php echo $handoverData['id']; ?>" id="handoverdate<?php echo $handoverData['id']; ?>" readonly="" type="text" class="form-control datepicker" onchange="savemeasurmentdata<?php echo $handoverData['id']; ?>();" value="<?php if($handoverEntry['handoverdate']!='0000-00-00' && $handoverEntry['handoverdate']!='1970-01-01' && $handoverEntry['handoverdate']!=''){ echo date('d-m-Y',strtotime($handoverEntry['handoverdate'])); } ?>">



		</div>

		</td>

  </tr>





<script>

function savemeasurmentdata<?php echo $handoverData['id']; ?>(){

var a= $('#handoverstatus10').val();

var b= $('#handoverstatus15').val();

var c= $('#handoverstatus16').val();

var d= $('#handoverstatus17').val();

var date = "<?php echo date('d-m-Y'); ?>"

if(a == "YES"){

	$('#handoverdate10').val(date);

}else{

	$('#handoverdate10').val("");

}

if(b == "YES"){

	$('#handoverdate15').val(date);

}else{

	$('#handoverdate15').val("");

}

if(c == "YES"){

	$('#handoverdate16').val(date);

}else{

	$('#handoverdate16').val("");

}

if(d == "YES"){

	$('#handoverdate17').val(date);

}else{

	$('#handoverdate17').val("");

}

var handoverstatus = encodeURI($('#handoverstatus<?php echo $handoverData['id']; ?>').val());

var handoverdate = encodeURI($('#handoverdate<?php echo $handoverData['id']; ?>').val());



$('#savemeasurmentdata').load('apparelbomaction.php?action=savepoprohandover&id=<?php echo $handoverData['id']; ?>&styleid=<?php echo $_GET['styleid']; ?>&handoverstatus='+handoverstatus+'&handoverdate='+handoverdate);



}

</script>



 <tr id="savemeasurmentdata" style="display:none;"></tr>



 <?php } ?>



 </table>



 </div>

 <div class="text-right" style="padding-top: 10px;">

	<button type="submit" style="margin:0px;" class="btn btn-primary" onClick="window.location.reload();">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true"></i></button>

</div>

				</div>

				</div>

			  	  </div>



</div>

 </div>

 </div>

	  </div>

</div>



<style>

table tr td {

border: 1px solid #ccc !important;

vertical-align:middle !important;

}

.datepicker {

    outline: none !important;

    border: 1px solid #ccc;

}

</style>



<script>

$( function(){

$( ".datepicker" ).datepicker();

} );

</script>




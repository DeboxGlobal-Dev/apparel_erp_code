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

				<div class="col-xl-12">
				<div class="card">

				 <form name"search" method="GET" action="">
				<input type="hidden"  name="module" value="<?php echo $_GET['module']; ?>"/>
				<input type="hidden"  name="view" value="yes"/>

				<input type="hidden"  name="styleid" value="<?php echo encode($editresultstyle['id']); ?>"/>

				<div class="row" style="padding:15px;">

				<div class="col-md-2">
							<div class="">
								<input name="startDate" type="text" class="form-control" id="startDate" value="<?php echo $_GET['startDate']; ?>" placeholder="Select Date" readonly="">
							</div>
						</div>


						<div class="col-md-2">
							<div class="">
								<select id="factoryId" name="factoryId" class="form-control" displayname="Factory Id" onchange="loadLines(this.value);">
								 <option value="">Select Factory</option>
								 <?php
								$select='';
								$where='';
								$rs='';
								$select='*';
								$where=' deletestatus=0 and status=1 order by name asc';
								$rs=GetPageRecord($select,'factoryMaster',$where);
								while($resListing=mysqli_fetch_array($rs)){
								?>
								<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$_GET['factoryId']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
								<?php } ?>
								</select>
							</div>
						</div>

						<div class="col-md-2">
							<div id="loadlines">
							<select id="lines" name="lines" class="form-control">
								<option value="">Select Lines</option>
							</select>
							  </div>
						</div>
<script>
<?php
if($_GET['factoryId']!=''){ ?>
$factoryid=$('#factoryId').val();
loadLines($factoryid);


<?php } ?>

function loadLines(id){
$('#loadlines').load('loadlinessingle.php?id='+id+'&selectId=<?php echo $_GET['lines']; ?>');
}
</script>

<script>
$( function(){
	$( "#startDate" ).datepicker();
} );
</script>

						<div class="col-md-2">
							<div class="">
								<input name="search" type="submit" class="btn bg-teal-400" id="search" value="Search">
							</div>
						</div>

				  </div>
</form>



				<div class="card-body">
				<div class="form-group">


				<div class="row">


				<?php if($_GET['factoryId']!='' && $_GET['line']!='' && $_GET['startDate']!=''){ ?>
				  <div class="" style="padding: 10px; width: 100%; font-size: 20px; font-weight: 600; background-color: #F8F8F8; margin-top: 10px; position: relative; text-align: center; border: 1px solid #ccc;">Production Quality Inspection</div>


					<table width="100%" border="0" cellpadding="5" cellspacing="0" class="table" style="font-size:13px !important;">


  <tr height="35">
				<td width="6%"> <div align="center"></div></td>
				<td width="15%"><div align="center">Number of Defects Found </div></td>
				<td width="14%"><div align="center">Number of Pass Garments </div></td>
				<td width="18%"><div align="center">Number of Defective Garments </div></td>
                <td width="21%"><div align="center">Total pieces Checked </div></td>
				<td width="26%"><div align="left">Remarks</div></td>
  </tr>

<?php
$rdkm=GetPageRecord('*','qualityInspectionMaster','1 and styleId="'.decode($_GET['styleid']).'" and factoryId="'.$_GET['factoryId'].'" and line="'.$_GET['line'].'" and fromDate="'.date('Y-m-d',strtotime($_GET['startDate'])).'" and hours="1st Hour"');
$hourWiseReport1=mysqli_fetch_array($rdkm); ?>

   <tr height="20">
    	<td><div>
    	  <div align="center">Hour 1 </div>
    	</div></td>
			<td><div>
			  <div align="center"><?php echo $hourWiseReport1['numberofdefects']; ?></div>
			</div></td>

		<td><div>
		  <div align="center"><?php echo $hourWiseReport1['numberofpassgar']; ?></div>
		</div></td>


			<td><div>
			  <div align="center"><?php echo $hourWiseReport1['numberofdefgar']; ?></div>
			</div></td>
			<td><div>
			  <div align="center"><?php echo $hourWiseReport1['totalpricechck']; ?></div>
			</div></td>
			<td><div>
			  <div align="left"><?php echo $hourWiseReport1['remarks']; ?></div>
			</div></td>
   </tr>

<?php

$rdkm=GetPageRecord('*','qualityInspectionMaster','1 and styleId="'.decode($_GET['styleid']).'" and factoryId="'.$_GET['factoryId'].'" and line="'.$_GET['line'].'" and fromDate="'.date('Y-m-d',strtotime($_GET['startDate'])).'" and hours="2nd Hour"');
$hourWiseReport2=mysqli_fetch_array($rdkm); ?>


   <tr height="20">
    	<td><div>
    	  <div align="center">Hour 2 </div>
    	</div></td>
			<td><div>
			  <div align="center"> <?php echo $hourWiseReport2['numberofdefects']; ?></div>
			   </td>

		<td><div>
		  <div align="center"><?php echo $hourWiseReport2['numberofpassgar']; ?></div>
		</div></td>


			<td><div>
			  <div align="center"><?php echo $hourWiseReport2['numberofdefgar']; ?></div>
			</div></td>
			<td><div>
			  <div align="center"><?php echo $hourWiseReport2['totalpricechck']; ?></div>
			</div></td>
			<td><div>
			  <div align="left"><?php echo $hourWiseReport2['remarks']; ?></div>
			</div></td>
   </tr>



<?php

$rdkm=GetPageRecord('*','qualityInspectionMaster','1 and styleId="'.decode($_GET['styleid']).'" and factoryId="'.$_GET['factoryId'].'" and line="'.$_GET['line'].'" and fromDate="'.date('Y-m-d',strtotime($_GET['startDate'])).'" and hours="3rd Hour"');
$hourWiseReport3=mysqli_fetch_array($rdkm); ?>


   <tr height="20">
    	<td><div>
    	  <div align="center">Hour 3 </div>
    	</div></td>
			<td><div>
			  <div align="center"><?php echo $hourWiseReport3['numberofdefects']; ?></div>
			</div></td>

		<td><div>
		  <div align="center"><?php echo $hourWiseReport3['numberofpassgar']; ?></div>
		</div></td>

			<td><div>
			  <div align="center"><?php echo $hourWiseReport3['numberofdefgar']; ?></div>
			</div></td>
			<td><div>
			  <div align="center"><?php echo $hourWiseReport3['totalpricechck']; ?></div>
			</div></td>
			<td><div>
			  <div align="left"><?php echo $hourWiseReport3['remarks']; ?></div>
			</div></td>
   </tr>

<?php

$rdkm=GetPageRecord('*','qualityInspectionMaster','1 and styleId="'.decode($_GET['styleid']).'" and factoryId="'.$_GET['factoryId'].'" and line="'.$_GET['line'].'" and fromDate="'.date('Y-m-d',strtotime($_GET['startDate'])).'" and hours="4th Hour"');
$hourWiseReport4=mysqli_fetch_array($rdkm); ?>


   <tr height="20">
    	<td><div>
    	  <div align="center">Hour 4 </div>
    	</div></td>
			<td><div>
			  <div align="center"><?php echo $hourWiseReport4['numberofdefects']; ?></div>
			</div></td>

		<td><div>
		  <div align="center"><?php echo $hourWiseReport4['numberofpassgar']; ?></div>
		</div></td>


			<td><div>
			  <div align="center"><?php echo $hourWiseReport4['numberofdefgar']; ?></div>
			</div></td>
			<td><div>
			  <div align="center"><?php echo $hourWiseReport4['totalpricechck']; ?></div>
			</div></td>
			<td><div>
			  <div align="left"><?php echo $hourWiseReport4['remarks']; ?></div>
			</div></td>
   </tr>


<?php

$rdkm=GetPageRecord('*','qualityInspectionMaster','1 and styleId="'.decode($_GET['styleid']).'" and factoryId="'.$_GET['factoryId'].'" and line="'.$_GET['line'].'" and fromDate="'.date('Y-m-d',strtotime($_GET['startDate'])).'" and hours="5th Hour"');
$hourWiseReport5=mysqli_fetch_array($rdkm); ?>


   <tr height="20">
    	<td><div>
    	  <div align="center">Hour 5 </div>
    	</div></td>
			<td><div>
			  <div align="center"><?php echo $hourWiseReport5['numberofdefects']; ?></div>
			</div></td>

		<td><div>
		  <div align="center"><?php echo $hourWiseReport5['numberofpassgar']; ?></div>
		</div></td>


			<td><div>
			  <div align="center"><?php echo $hourWiseReport5['numberofdefgar']; ?></div>
			</div></td>
			<td><div>
			  <div align="center"><?php echo $hourWiseReport5['totalpricechck']; ?></div>
			</div></td>
			<td><div>
			  <div align="left"><?php echo $hourWiseReport5['remarks']; ?></div>
			</div></td>
   </tr>



<?php

$rdkm=GetPageRecord('*','qualityInspectionMaster','1 and styleId="'.decode($_GET['styleid']).'" and factoryId="'.$_GET['factoryId'].'" and line="'.$_GET['line'].'" and fromDate="'.date('Y-m-d',strtotime($_GET['startDate'])).'" and hours="6th Hour"');
$hourWiseReport6=mysqli_fetch_array($rdkm); ?>


   <tr height="20">
    	<td><div>
    	  <div align="center">Hour 6 </div>
    	</div></td>
			<td><div>
			  <div align="center"><?php echo $hourWiseReport6['numberofdefects']; ?></div>
			</div></td>

		<td><div>
		  <div align="center"><?php echo $hourWiseReport6['numberofpassgar']; ?></div>
		</div></td>


			<td><div>
			  <div align="center"><?php echo $hourWiseReport6['numberofdefgar']; ?></div>
			</div></td>
			<td><div>
			  <div align="center"><?php echo $hourWiseReport6['totalpricechck']; ?></div>
			</div></td>
			<td><div>
			  <div align="left"><?php echo $hourWiseReport6['remarks']; ?></div>
			</div></td>
   </tr>



<?php

$rdkm=GetPageRecord('*','qualityInspectionMaster','1 and styleId="'.decode($_GET['styleid']).'" and factoryId="'.$_GET['factoryId'].'" and line="'.$_GET['line'].'" and fromDate="'.date('Y-m-d',strtotime($_GET['startDate'])).'" and hours="7th Hour"');
$hourWiseReport7=mysqli_fetch_array($rdkm); ?>


   <tr height="20">
    	<td><div>
    	  <div align="center">Hour 7 </div>
    	</div></td>
			<td><div>
			  <div align="center"><?php echo $hourWiseReport7['numberofdefects']; ?></div>
			</div></td>

		<td><div>
		  <div align="center"><?php echo $hourWiseReport7['numberofpassgar']; ?></div>
		</div></td>


			<td><div>
			  <div align="center"><?php echo $hourWiseReport7['numberofdefgar']; ?></div>
			</div></td>
			<td><div>
			  <div align="center"><?php echo $hourWiseReport7['totalpricechck']; ?></div>
			</div></td>
			<td><div>
			  <div align="left"><?php echo $hourWiseReport7['remarks']; ?></div>
			</div></td>
   </tr>




<?php

$rdkm=GetPageRecord('*','qualityInspectionMaster','1 and styleId="'.decode($_GET['styleid']).'" and factoryId="'.$_GET['factoryId'].'" and line="'.$_GET['line'].'" and fromDate="'.date('Y-m-d',strtotime($_GET['startDate'])).'" and hours="8th Hour"');
$hourWiseReport8=mysqli_fetch_array($rdkm); ?>


   <tr height="20">
    	<td><div>
    	  <div align="center">Hour 8 </div>
    	</div></td>
			<td><div>
			  <div align="center"><?php echo $hourWiseReport8['numberofdefects']; ?></div>
			</div></td>

		<td><div>
		  <div align="center"><?php echo $hourWiseReport8['numberofpassgar']; ?></div>
		</div></td>

			<td><div>
			  <div align="center"><?php echo $hourWiseReport8['numberofdefgar']; ?></div>
			</div></td>
			<td><div>
			  <div align="center"><?php echo $hourWiseReport8['totalpricechck']; ?></div>
			</div></td>
			<td><div>
			  <div align="left"><?php echo $hourWiseReport8['remarks']; ?></div>
			</div></td>
   </tr>

   <!-- <?php

$rdkm=GetPageRecord('*','qualityInspectionMaster','1 and styleId="'.decode($_GET['styleid']).'" and factoryId="'.$_GET['factoryId'].'" and line="'.$_GET['line'].'" and fromDate="'.date('Y-m-d',strtotime($_GET['startDate'])).'" and hours="9th Hour"');
$hourWiseReport9=mysqli_fetch_array($rdkm); ?>


   <tr height="20">
    	<td><div>
    	  <div align="center">Hour 9 </div>
    	</div></td>
			<td><div>
			  <div align="center"><?php echo $hourWiseReport9['numberofdefects']; ?></div>
			</div></td>

		<td><div>
		  <div align="center"><?php echo $hourWiseReport9['numberofpassgar']; ?></div>
		</div></td>

			<td><div>
			  <div align="center"><?php echo $hourWiseReport9['numberofdefgar']; ?></div>
			</div></td>
			<td><div>
			  <div align="center"><?php echo $hourWiseReport9['totalpricechck']; ?></div>
			</div></td>
			<td><div>
			  <div align="left"><?php echo $hourWiseReport9['remarks']; ?></div>
			</div></td>
   </tr>

   <?php

$rdkm=GetPageRecord('*','qualityInspectionMaster','1 and styleId="'.decode($_GET['styleid']).'" and factoryId="'.$_GET['factoryId'].'" and line="'.$_GET['line'].'" and fromDate="'.date('Y-m-d',strtotime($_GET['startDate'])).'" and hours="10th Hour"');
$hourWiseReport10=mysqli_fetch_array($rdkm); ?>


   <tr height="20">
    	<td><div>
    	  <div align="center">Hour 10 </div>
    	</div></td>
			<td><div>
			  <div align="center"><?php echo $hourWiseReport10['numberofdefects']; ?></div>
			</div></td>

		<td><div>
		  <div align="center"><?php echo $hourWiseReport10['numberofpassgar']; ?></div>
		</div></td>

			<td><div>
			  <div align="center"><?php echo $hourWiseReport10['numberofdefgar']; ?></div>
			</div></td>
			<td><div>
			  <div align="center"><?php echo $hourWiseReport10['totalpricechck']; ?></div>
			</div></td>
			<td><div>
			  <div align="left"><?php echo $hourWiseReport10['remarks']; ?></div>
			</div></td>
   </tr>

   <?php

$rdkm=GetPageRecord('*','qualityInspectionMaster','1 and styleId="'.decode($_GET['styleid']).'" and factoryId="'.$_GET['factoryId'].'" and line="'.$_GET['line'].'" and fromDate="'.date('Y-m-d',strtotime($_GET['startDate'])).'" and hours="11th Hour"');
$hourWiseReport11=mysqli_fetch_array($rdkm); ?>


   <tr height="20">
    	<td><div>
    	  <div align="center">Hour 11 </div>
    	</div></td>
			<td><div>
			  <div align="center"><?php echo $hourWiseReport11['numberofdefects']; ?></div>
			</div></td>

		<td><div>
		  <div align="center"><?php echo $hourWiseReport11['numberofpassgar']; ?></div>
		</div></td>

			<td><div>
			  <div align="center"><?php echo $hourWiseReport11['numberofdefgar']; ?></div>
			</div></td>
			<td><div>
			  <div align="center"><?php echo $hourWiseReport11['totalpricechck']; ?></div>
			</div></td>
			<td><div>
			  <div align="left"><?php echo $hourWiseReport11['remarks']; ?></div>
			</div></td>
   </tr>

   <?php

$rdkm=GetPageRecord('*','qualityInspectionMaster','1 and styleId="'.decode($_GET['styleid']).'" and factoryId="'.$_GET['factoryId'].'" and line="'.$_GET['line'].'" and fromDate="'.date('Y-m-d',strtotime($_GET['startDate'])).'" and hours="12th Hour"');
$hourWiseReport12=mysqli_fetch_array($rdkm); ?>


   <tr height="20">
    	<td><div>
    	  <div align="center">Hour 12 </div>
    	</div></td>
			<td><div>
			  <div align="center"><?php echo $hourWiseReport12['numberofdefects']; ?></div>
			</div></td>

		<td><div>
		  <div align="center"><?php echo $hourWiseReport12['numberofpassgar']; ?></div>
		</div></td>

			<td><div>
			  <div align="center"><?php echo $hourWiseReport12['numberofdefgar']; ?></div>
			</div></td>
			<td><div>
			  <div align="center"><?php echo $hourWiseReport12['totalpricechck']; ?></div>
			</div></td>
			<td><div>
			  <div align="left"><?php echo $hourWiseReport12['remarks']; ?></div>
			</div></td>
   </tr> -->


<?php
//=================find sum of all calculations===============================

$k=GetPageRecord('sum(numberofdefects) as totalnumberofdefects,sum(numberofpassgar) as totalnumberofpassgar,sum(numberofdefgar) as totalnumberofdefgar,sum(totalpricechck) as totaltotalpricechck','qualityInspectionMaster','1 and styleId="'.decode($_GET['styleid']).'" and factoryId="'.$_GET['factoryId'].'" and line="'.$_GET['line'].'" and fromDate="'.date('Y-m-d',strtotime($_GET['startDate'])).'"');
$sumoftotal=mysqli_fetch_array($k);

?>

   <tr height="20" style="margin: 10px 5px; text-align: center; padding: 10px 15px; font-size: 15px; cursor: pointer; background-color: #ffffff; position: relative; font-weight: 500; color: #000000; width: 100%; box-sizing: border-box;">
    	<td><div>
    	  <div align="center">Total</div>
    	</div></td>
			<td><div>
			  <div align="center"><?php echo $sumoftotal['totalnumberofdefects']; ?></div>
			</div></td>

		<td><div>
		  <div align="center"><?php echo $sumoftotal['totalnumberofpassgar']; ?></div>
		</div></td>


			<td><div>
			  <div align="center"><?php echo $sumoftotal['totalnumberofdefgar']; ?></div>
			</div></td>
			<td><div>
			  <div align="center"><?php echo $sumoftotal['totaltotalpricechck']; ?></div>
			</div></td>
			<td><div>
			  <div align="left"></div>
			</div></td>
   </tr>

   <tr height="20" style="padding: 10px 15px; font-size: 16px; cursor: pointer; background-color: #f7f7f7; font-weight: 500; color: #000000; width: 100%; box-sizing: border-box; text-align: right; border: 2px #ccc solid; margin-bottom: 10px; border-top: 0px;">
    	<td><div>
    	  <div align="center"> </div>
    	</div></td>
			<td><div>
			  <div align="center"> </div>
			</div></td>

		<td><div>
		  <div align="center"> </div>
		</div></td>


			<td><div>
			  <div align="center"> </div>
			</div></td>
			<td><div>
			  <div align="center"> </div>
			</div></td>
			<td><div>
			  <div align="center">DHU :<?php $totaldhu=($sumoftotal['totalnumberofdefects']*100)/$sumoftotal['totaltotalpricechck'] ; echo round($totaldhu, 2); ?></div>
			</div></td>
   </tr>


</table>

				  <?php } else{ ?>
				   <div class="col-md-12" style="margin-bottom: 20px; padding: 10PX 20PX; font-size: 16px; color: #0288d1; text-align: left;">Select Date Factory and Line</div>
				  <?php } ?>

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
    border: 1px solid #ccc;
    padding: 5px !important;
}
</style>

<style>
/* Hide the browser's default checkbox */
.container input[type=checkbox] {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.container .checkmark {
    position: absolute;
    top: 1px;
    left: 0px;
    height: 17px;
    width: 20px;
    background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container input[type=checkbox] ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container input[type=checkbox]:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.container .checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container input[type=checkbox]:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
    left: 8px;
    top: 2px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
.container {
    display: block;
    position: relative;
    padding-left: 25px;
    margin-bottom: 10px;
    cursor: pointer;
    font-size: 14px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    font-weight: 400;
 }
.ui-datepicker-calendar tr td {
    padding: 1px 1px !important;
}

</style>



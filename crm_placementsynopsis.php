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
<style>
.even{
background-color: #0097a71a;
}
</style>
 
		<!-- Main sidebar -->
		<?php include "left.php"; ?> 
		<div class="content-wrapper">
		
		<!---Save Alert Notification---->
		<?php include "savealert.php"; ?> 
	
	
 
			<div class="content pt-0" style="margin-top:20px;"> 
				
				<div class="row">
				<div class="col-xl-12">
				
				<div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
						<div class="col-xl-9"><h5 class="card-title"><?php echo $pageName; ?></h5></div>
						 <div class="col-xl-3" style="padding-right: 0px;"><div class="btn-group justify-content-center" style="float:right;">
 						 </div></div>
				  </div>
				<div class="card">
<form name"search" method="GET" action="">
<input type="hidden"  name="module" value="<?php echo $_GET['module']; ?>"/>
		  	   
				<div class="row" style="padding:15px;">
						<div class="col-md-2">
			<input name="startDate" type="text" class="datepicker form-control" id="startDate" value="<?php echo $_GET['startDate']; ?>" placeholder="From Date" readonly="">
						
						</div>
						<div class="col-md-2">
			<input name="endtDate" type="text" class="datepicker form-control" id="endtDate" value="<?php echo $_GET['endtDate']; ?>" placeholder="To Date" readonly="">
						
						</div>
						<div class="col-md-2">
							<div class="">
								<input name="search" type="submit" class="btn bg-teal-400" id="search" value="Search">
							</div>
						</div>
						
				</div>		
</form>						
				</div>
				<div class="card" style="padding:0px;">
				   
				 <table cellspacing="0" cellpadding="0" class="table table-responsive placement-spread" style="font-size:11px;">
   
  <tr height="20" style="background-color: #fff7b3; color: #000;">
    <td width="769" height="20"><div align="center"></div></td>
    <td width="769"><div align="center"></div></td>
    <td colspan="2"><div align="center"><strong>Flow -1 Ship Cancel</strong></div></td>
    <td colspan="2"><div align="center"><strong>Flow -2 Ship Cancel</strong></div></td>
    <td colspan="4"><div align="center"><strong>Flow -3 Ship Cancel</strong></div></td>
    <td width="769"><div align="center"></div></td>
  </tr>
  <tr height="20" style="background-color: #e5fbfa; color: #000;">
    <td height="20"><div align="center"><strong>Brand</strong></div></td>
    <td><div align="center"><strong>Category</strong></div></td>
    <td width="769"><div align="center"><strong>26th May</strong></div></td>
    <td width="769"><div align="center"><strong>10th June</strong></div></td>
    <td width="769"><div align="center"><strong>24th July</strong></div></td>
    <td width="769"><div align="center"><strong>10th August</strong></div></td>
    <td width="769"><div align="center"><strong>26th August</strong></div></td>
    <td width="769"><div align="center"><strong>6th Oct</strong></div></td>
    <td width="769"><div align="center"><strong>12th Oct.</strong></div></td>
    <td width="769"><div align="center"><strong>6th Nov.</strong></div></td>
    <td><div align="center"><strong>Total</strong></div></td>
  </tr>
  <tr height="20">
    <td height="20"><div align="center">Calvin Klein</div></td>
    <td><div align="center">Tops</div></td>
    <td><div align="center">92739</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">52268</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">183984</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">2520</div></td>
    <td><div align="center">331511</div></td>
  </tr>
  <tr height="20">
    <td height="20"><div align="center"></div></td>
    <td><div align="center">Dress</div></td>
    <td><div align="center">80845</div></td>
    <td><div align="center">23000</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">10000</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">134,545</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">248390</div></td>
  </tr>
  <tr height="20">
    <td height="20"><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center">173584</div></td>
    <td><div align="center">23000</div></td>
    <td><div align="center">52268</div></td>
    <td><div align="center">10000</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">318529</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">2520</div></td>
    <td><div align="center">579901</div></td>
  </tr>
  <tr height="20">
    <td height="20"><div align="center">Calvin Klein Kids</div></td>
    <td><div align="center">Kids</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">27560</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">92950</div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center">120510</div></td>
  </tr>
  <tr height="20">
    <td height="20"><div align="center"></div></td>
    <td><div align="center">Toddlers</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">104000</div></td>
    <td><div align="center">35880</div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center">139880</div></td>
  </tr>
  <tr height="20">
    <td height="20"><div align="center"></div></td>
    <td><div align="center">M&amp;P</div></td>
    <td><div align="center">12120</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">9870</div></td>
    <td><div align="center">12140</div></td>
    <td><div align="center"></div></td>
    <td><div align="center">3070</div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center">37200</div></td>
  </tr>
  <tr height="20">
    <td height="20"><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center">12120</div></td>
    <td><div align="center">27560</div></td>
    <td><div align="center">113870</div></td>
    <td><div align="center">140970</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">3070</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">297590</div></td>
  </tr>
  <tr height="20">
    <td height="20"><div align="center">Ralph Lauren</div></td>
    <td><div align="center">Tops</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">111228</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">44000</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center"></div></td>
    <td><div align="center">37642</div></td>
    <td><div align="center"></div></td>
    <td><div align="center">192870</div></td>
  </tr>
  <tr height="20">
    <td height="20"><div align="center"></div></td>
    <td><div align="center">Dress</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">17461</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">12402</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center"></div></td>
    <td><div align="center">22738</div></td>
    <td><div align="center"></div></td>
    <td><div align="center">52601</div></td>
  </tr>
  <tr height="20">
    <td height="20"><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">128689</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">56402</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">60380</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">245471</div></td>
  </tr>
  <tr height="20">
    <td height="20"><div align="center">Ralph Lauren Kids</div></td>
    <td><div align="center">Kids</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">8977</div></td>
    <td><div align="center"></div></td>
    <td><div align="center">47153</div></td>
    <td><div align="center">31831</div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center">87961</div></td>
  </tr>
  <tr height="20">
    <td height="20"><div align="center"></div></td>
    <td><div align="center">Toddlers</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">18568</div></td>
    <td><div align="center"></div></td>
    <td><div align="center">43220</div></td>
    <td><div align="center">6488</div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center">68276</div></td>
  </tr>
  <tr height="20">
    <td height="20"><div align="center"></div></td>
    <td><div align="center">Infants</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">37751</div></td>
    <td><div align="center"></div></td>
    <td><div align="center">87663</div></td>
    <td><div align="center">57972</div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center">183386</div></td>
  </tr>
  <tr height="20">
    <td height="20"><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">65296</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">178036</div></td>
    <td><div align="center">96291</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">339623</div></td>
  </tr>
  <tr height="20" style="color: #fff; background-color: #555555;">
    <td height="20"><div align="center"><strong>Total</strong></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"><strong>185704</strong></div></td>
    <td><div align="center"><strong>244545</strong></div></td>
    <td><div align="center"><strong>166138</strong></div></td>
    <td><div align="center"><strong>385408</strong></div></td>
    <td><div align="center"><strong>96291</strong></div></td>
    <td><div align="center"><strong>321599</strong></div></td>
    <td><div align="center"><strong>60380</strong></div></td>
    <td><div align="center"><strong>2520</strong></div></td>
    <td><div align="center"><strong>1462585</strong></div></td>
  </tr>
</table>
				       
				  </div> 
				</div></div> 	
		  </div> 
  </div> </div>
		 </div> 
		 
<style>
.placement-spread tr td{
border:1px solid #ccc !important; 
vertical-align:middle;
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
				 
		 
		 
		 
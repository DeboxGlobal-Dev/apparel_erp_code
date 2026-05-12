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
  
  <tr height="22" style="background-color: #fff7b3; color: #000;">
    <td height="22"><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td colspan="21"><div align="center"><strong>Total Quantity by Brand</strong></div></td>
    <td width="2357"><div align="center"></div></td>
    <td width="2357"><div align="center"></div></td>
    <td width="98"><div align="center"></div></td>
    <td width="93"><div align="center"></div></td>
  </tr>
  <tr height="64" style="background-color: #e5fbfa; color: #000;">
    <td colspan="7" height="64" width="2357"><strong>&nbsp;
      </strong>
      <div align="center"><strong>RAYON SLUB    (PRINT)&nbsp;</strong></div></td>
    <td colspan="2"><div align="center"><strong>CK Dress</strong></div></td>
    <td colspan="2"><div align="center"><strong>CK Kids</strong></div></td>
    <td colspan="2"><div align="center"><strong>CK Toddlers</strong></div></td>
    <td colspan="2"><div align="center"><strong>CK Infants</strong></div></td>
    <td colspan="2"><div align="center"><strong>RL Tops</strong></div></td>
    <td colspan="2"><div align="center"><strong>RL Dress</strong></div></td>
    <td colspan="2"><div align="center"><strong>RL Kids</strong></div></td>
    <td colspan="2"><div align="center"><strong>RL Toddlers</strong></div></td>
    <td colspan="2"><div align="center"><strong>RL Infants</strong></div></td>
    <td colspan="2"><div align="center"><strong>Total</strong></div></td>
    <td colspan="2"><div align="center"><strong>Business %</strong></div></td>
  </tr>
  <tr height="22" style="background-color: #e5fbfa; color: #000;">
    <td height="22"><div align="center"><strong>Vendor&nbsp;Matrix</strong></div></td>
    <td><div align="center"><strong>Order&nbsp;Q'ty</strong></div></td>
    <td><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td><div align="center"><strong>Schifli&nbsp;O.&nbsp;Q'nty</strong></div></td>
    <td><div align="center"><strong>Schifli&nbsp;F&nbsp;Q'nty</strong></div></td>
    <td><div align="center"><strong>Schifly&nbsp;Order&nbsp;%</strong></div></td>
    <td><div align="center"><strong>Schifli&nbsp;Fabric&nbsp;%</strong></div></td>
    <td width="2357"><div align="center"><strong>Order&nbsp;Quantity</strong></div></td>
    <td width="2357"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="2357"><div align="center"><strong>Order&nbsp;Quantity</strong></div></td>
    <td width="2357"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="2357"><div align="center"><strong>Order&nbsp;Quantity</strong></div></td>
    <td width="2357"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="2357"><div align="center"><strong>Order&nbsp;Quantity</strong></div></td>
    <td width="2357"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="2357"><div align="center"><strong>Order&nbsp;Quantity</strong></div></td>
    <td width="2357"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="2357"><div align="center"><strong>Order&nbsp;Quantity</strong></div></td>
    <td width="2357"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="2357"><div align="center"><strong>Order&nbsp;Quantity</strong></div></td>
    <td width="2357"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="2357"><div align="center"><strong>Order&nbsp;Quantity</strong></div></td>
    <td width="2357"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="2357"><div align="center"><strong>Order&nbsp;Quantity</strong></div></td>
    <td width="2357"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td><div align="center"><strong>Order&nbsp;Quantity</strong></div></td>
    <td><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td><div align="center"><strong>Order&nbsp;Quantity</strong></div></td>
    <td><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
  </tr>
  <tr height="22">
    <td height="22"><div align="center">ALC</div></td>
    <td><div align="center">225471</div></td>
    <td><div align="center">298924.7</div></td>
    <td><div align="center"></div></td>
    <td><div align="center">298924.696</div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center">#REF!</div></td>
    <td><div align="center">298924.696</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
  </tr>
  <tr height="22">
    <td height="22"><div align="center">Kumar P&amp;D</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center">#REF!</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">#REF!</div></td>
    <td><div align="center">0</div></td>
  </tr>
  <tr height="22">
    <td height="22"><div align="center">Vardhman</div></td>
    <td><div align="center">70330</div></td>
    <td><div align="center">110418.1</div></td>
    <td><div align="center"></div></td>
    <td><div align="center">110418.1</div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center">#REF!</div></td>
    <td><div align="center">110418.1</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
  </tr>
  <tr height="22">
    <td height="22"><div align="center">Arvind</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center"></div></td>
    <td><div align="center">0</div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center">#REF!</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">#REF!</div></td>
    <td><div align="center">0</div></td>
  </tr>
  <tr height="22">
    <td height="22"><div align="center">Qualitex</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center"></div></td>
    <td><div align="center">0</div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center">#REF!</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">#REF!</div></td>
    <td><div align="center">0</div></td>
  </tr>
  <tr height="22">
    <td height="22"><div align="center">H Wear</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center"></div></td>
    <td><div align="center">0</div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center">#REF!</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">#REF!</div></td>
    <td><div align="center">0</div></td>
  </tr>
  <tr height="22">
    <td height="22"><div align="center">Raymond</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center"></div></td>
    <td><div align="center">0</div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center">#REF!</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">#REF!</div></td>
    <td><div align="center">0</div></td>
  </tr>
  <tr height="22">
    <td height="22"><div align="center">OCM</div></td>
    <td><div align="center">35710</div></td>
    <td><div align="center">47601.43</div></td>
    <td><div align="center"></div></td>
    <td><div align="center">47601.43</div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center">#REF!</div></td>
    <td><div align="center">47601.43</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
  </tr>
  <tr height="22" style="color: #fff; background-color: #555555;">
    <td height="22"><div align="center"></div></td>
    <td><div align="center">331511</div></td>
    <td><div align="center">456944.23</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">456944.226</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">#REF!</div></td>
    <td><div align="center">456944.226</div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
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
				 
		 
		 
		 
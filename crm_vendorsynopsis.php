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
    <td width="111"><div align="center"></div></td>
    <td colspan="19"><div align="center"><strong>Total Quantity by Brand</strong></div></td>
    <td width="1509"><div align="center"></div></td>
    <td width="1509"><div align="center"></div></td>
    <td width="98"><div align="center"></div></td>
    <td width="93"><div align="center"></div></td>
  </tr>
  <tr height="20" style="background-color: #e5fbfa; color: #000;">
    <td height="20"><div align="center"></div></td>
    <td colspan="2"><div align="center"><strong>CK Tops</strong></div></td>
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
  <tr height="20" style="background-color: #e5fbfa; color: #000;">
    <td height="20"><div align="center"><strong>Vendor&nbsp;Matrix</strong></div></td>
    <td><div align="center"><strong>Order&nbsp;Quantity</strong></div></td>
    <td width="89"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="99"><div align="center"><strong>Order&nbsp;Quantity</strong></div></td>
    <td width="94"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="94"><div align="center"><strong>Order&nbsp;Quantity</strong></div></td>
    <td width="85"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="102"><div align="center"><strong>Order&nbsp;Quantity</strong></div></td>
    <td width="1509"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="1509"><div align="center"><strong>Order&nbsp;Quantity</strong></div></td>
    <td width="1509"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="1509"><div align="center"><strong>Order&nbsp;Quantity</strong></div></td>
    <td width="1509"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="1509"><div align="center"><strong>Order&nbsp;Quantity</strong></div></td>
    <td width="1509"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="1509"><div align="center"><strong>Order&nbsp;Quantity</strong></div></td>
    <td width="1509"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="1509"><div align="center"><strong>Order&nbsp;Quantity</strong></div></td>
    <td width="1509"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="1509"><div align="center"><strong>Order&nbsp;Quantity</strong></div></td>
    <td width="1509"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td><div align="center"><strong>Order&nbsp;Quantity</strong></div></td>
    <td><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td><div align="center"><strong>Order&nbsp;Quantity</strong></div></td>
    <td><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
  </tr>
  <tr height="22">
    <td height="22"><div align="center">ALC</div></td>
    <td><div align="center">225471</div></td>
    <td><div align="center">298924.696</div></td>
    <td><div align="center">35890</div></td>
    <td><div align="center">20546</div></td>
    <td><div align="center">54860</div></td>
    <td><div align="center">42294.2</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">24824</div></td>
    <td><div align="center">37236</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">20951</div></td>
    <td><div align="center">10056.48</div></td>
    <td><div align="center">361996</div></td>
    <td><div align="center">409057.376</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
  </tr>
  <tr height="22">
    <td height="22"><div align="center">Kumar P&amp;D</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">68330</div></td>
    <td><div align="center">146909.5</div></td>
    <td><div align="center">65650</div></td>
    <td><div align="center">59117.5</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">77340</div></td>
    <td><div align="center">116010</div></td>
    <td><div align="center">40199</div></td>
    <td><div align="center">74368.15</div></td>
    <td><div align="center">49618</div></td>
    <td><div align="center">43608.035</div></td>
    <td><div align="center">57007</div></td>
    <td><div align="center">27926.01</div></td>
    <td><div align="center">122344</div></td>
    <td><div align="center">61563.25</div></td>
    <td><div align="center">480488</div></td>
    <td><div align="center">529502.445</div></td>
    <td><div align="center">480488</div></td>
    <td><div align="center">529502.445</div></td>
  </tr>
  <tr height="22">
    <td height="22"><div align="center">Vardhman</div></td>
    <td><div align="center">70330</div></td>
    <td><div align="center">110418.1</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">27888</div></td>
    <td><div align="center">41832</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">19906</div></td>
    <td><div align="center">19906</div></td>
    <td><div align="center">9731</div></td>
    <td><div align="center">3663.3</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">127855</div></td>
    <td><div align="center">175819.4</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
  </tr>
  <tr height="22">
    <td height="22"><div align="center">Arvind</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">47515</div></td>
    <td><div align="center">23260.25</div></td>
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
    <td><div align="center">47515</div></td>
    <td><div align="center">23260.25</div></td>
    <td><div align="center">47515</div></td>
    <td><div align="center">23260.25</div></td>
  </tr>
  <tr height="22">
    <td height="22"><div align="center">Qualitex</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">19720</div></td>
    <td><div align="center">40820.4</div></td>
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
    <td><div align="center">19720</div></td>
    <td><div align="center">40820.4</div></td>
    <td><div align="center">19720</div></td>
    <td><div align="center">40820.4</div></td>
  </tr>
  <tr height="22">
    <td height="22"><div align="center">H Wear</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">92365</div></td>
    <td><div align="center">55901.3</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">50000</div></td>
    <td><div align="center">75000</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">142365</div></td>
    <td><div align="center">130901.3</div></td>
    <td><div align="center">142365</div></td>
    <td><div align="center">130901.3</div></td>
  </tr>
  <tr height="22">
    <td height="22"><div align="center">Raymond</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">17490</div></td>
    <td><div align="center">30957.3</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">12818</div></td>
    <td><div align="center">19227</div></td>
    <td><div align="center">12402</div></td>
    <td><div align="center">22943.7</div></td>
    <td><div align="center">15522</div></td>
    <td><div align="center">5549.4</div></td>
    <td><div align="center">1538</div></td>
    <td><div align="center">815.14</div></td>
    <td><div align="center">29877</div></td>
    <td><div align="center">14861.6</div></td>
    <td><div align="center">89647</div></td>
    <td><div align="center">94354.14</div></td>
    <td><div align="center">89647</div></td>
    <td><div align="center">94354.14</div></td>
  </tr>
  <tr height="22">
    <td height="22"><div align="center">OCM</div></td>
    <td><div align="center">35710</div></td>
    <td><div align="center">47601.43</div></td>
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
    <td><div align="center">35710</div></td>
    <td><div align="center">47601.43</div></td>
    <td><div align="center">35710</div></td>
    <td><div align="center">47601.43</div></td>
  </tr>
  <tr height="22">
    <td height="22" width="199"><div align="center">Prosperity</div></td>
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
    <td><div align="center">2915</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">2915</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">2915</div></td>
    <td><div align="center">0</div></td>
  </tr>
  <tr height="22" style="color: #fff; background-color: #555555;">
    <td height="22"><div align="center"></div></td>
    <td><div align="center"><strong>331511</strong></div></td>
    <td><div align="center"><strong>456944.226</strong></div></td>
    <td><div align="center"><strong>141430</strong></div></td>
    <td><div align="center"><strong>239233.2</strong></div></td>
    <td><div align="center"><strong>120510</strong></div></td>
    <td><div align="center"><strong>101411.7</strong></div></td>
    <td><div align="center"><strong>139880</strong></div></td>
    <td><div align="center"><strong>79161.55</strong></div></td>
    <td><div align="center"><strong>0</strong></div></td>
    <td><div align="center"><strong>0</strong></div></td>
    <td><div align="center"><strong>192870</strong></div></td>
    <td><div align="center"><strong>289305</strong></div></td>
    <td><div align="center"><strong>52601</strong></div></td>
    <td><div align="center"><strong>97311.85</strong></div></td>
    <td><div align="center"><strong>85046</strong></div></td>
    <td><div align="center"><strong>69063.435</strong></div></td>
    <td><div align="center"><strong>68276</strong></div></td>
    <td><div align="center"><strong>32404.45</strong></div></td>
    <td><div align="center"><strong>173172</strong></div></td>
    <td><div align="center"><strong>86481.33</strong></div></td>
    <td><div align="center"><strong>1305296</strong></div></td>
    <td><div align="center"><strong>1451316.741</strong></div></td>
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
				 
		 
		 
		 
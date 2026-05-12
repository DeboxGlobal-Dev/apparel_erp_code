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
				  
				   
				
				<div class="card" style="padding:0px;">
				   
				  <table cellspacing="0" cellpadding="0" class="table table-responsive placement-spread" style="font-size:11px;"> 
  <tr height="45" style="background-color: #fff7b3; color: #000; font-size:14px;">
    <td colspan="8" height="45" width="1008"><div align="center"><strong>STYLE WISE DETAILS</strong></div></td>
    <td colspan="5" width="615"><div align="center"><strong>SETTLEMENT MODE-1: WITH NEW ORDER</strong></div></td>
    <td colspan="5" width="627"><div align="center"><strong>SETTLEMENT MODE-2: THROUGH INVOICE</strong></div></td>
    <td colspan="5" width="528"><div align="center"><strong>SETTLEMENT MODE-3: SOLD</strong></div></td>
    <td colspan="5" width="547"><div align="center"><strong>PENDING</strong></div></td>
  </tr>
  <tr height="74" style="background-color: #e5fbfa; color: #000;">
    <td height="74"><div align="center"><strong>BRAND</strong></div></td>
    <td width="100"><div align="center"><strong>STYLE</strong></div></td>
    <td><div align="center"><strong>SEASON</strong></div></td>
    <td width="215"><div align="center"><strong>LIABILITY ITEM</strong></div></td>
    <td width="109"><div align="center"><strong>LIABILITY QTY</strong></div></td>
    <td width="100"><div align="center"><strong>LIABILITY&nbsp;ITEM UNIT PRICE</strong></div></td>
    <td width="119"><div align="center"><strong>TOTAL&nbsp;LABILITY    AMOUNT</strong></div></td>
    <td width="120"><div align="center"><strong>SETTLEMENT DATE</strong></div></td>
    <td width="113"><div align="center"><strong>QTY</strong></div></td>
    <td width="100"><div align="center"><strong>UNIT PRICE</strong></div></td>
    <td width="111"><div align="center"><strong>AMOUNT</strong></div></td>
    <td width="191"><div align="center"><strong>UTILIZATION</strong></div></td>
    <td width="100"><div align="center"><strong>PAYMENT STATUS</strong></div></td>
    <td width="100"><div align="center"><strong>QTY</strong></div></td>
    <td width="100"><div align="center"><strong>UNIT PRICE</strong></div></td>
    <td width="100"><div align="center"><strong>AMOUNT</strong></div></td>
    <td width="198"><div align="center"><strong>UTILIZATION</strong></div></td>
    <td width="129"><div align="center"><strong>PAYMENT STATUS</strong></div></td>
    <td width="100"><div align="center"><strong>QTY</strong></div></td>
    <td width="100"><div align="center"><strong>UNIT PRICE</strong></div></td>
    <td width="100"><div align="center"><strong>AMOUNT</strong></div></td>
    <td width="100"><div align="center"><strong>UTILIZATION</strong></div></td>
    <td width="128"><div align="center"><strong>PAYMENT STATUS</strong></div></td>
    <td width="147"><div align="center"><strong>QTY</strong></div></td>
    <td width="100"><div align="center"><strong>UNIT PRICE</strong></div></td>
    <td width="100"><div align="center"><strong>AMOUNT</strong></div></td>
    <td width="100"><div align="center"><strong>UTILIZATION</strong></div></td>
    <td width="100"><div align="center"><strong>PAYMENT STATUS</strong></div></td>
  </tr>
  <tr height="54">
    <td height="54"><div align="center">CK</div></td>
    <td width="100"><div align="center">673010</div></td>
    <td width="145"><div align="center">FALL'19    + Fall'20</div></td>
    <td width="215"><div align="center">FABRIC    (AM-SELENA)</div></td>
    <td><div align="center">9100 YDS</div></td>
    <td><div align="center">$3.15</div></td>
    <td><div align="center">$28,665.00</div></td>
    <td rowspan="3" width="120"><div align="center">11/16/2019</div></td>
    <td><div align="center">9100 YDS</div></td>
    <td><div align="center">$3.15</div></td>
    <td width="111"><div align="center">$28,665.00</div></td>
    <td width="191"><div align="center">Used with    Fall'20 s/167177 &amp; s/175997</div></td>
    <td width="100"><div align="center">Settled</div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="198"><div align="center"></div></td>
    <td width="129"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="128"><div align="center"></div></td>
    <td width="147"><div align="center">0    YDS</div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
  </tr>
  <tr height="54">
    <td height="54"><div align="center">CK</div></td>
    <td width="100"><div align="center">673012</div></td>
    <td width="145"><div align="center">FALL'20</div></td>
    <td width="215"><div align="center">FABRIC    (AM-SELENA)</div></td>
    <td><div align="center">2965 YDS</div></td>
    <td><div align="center">$3.15</div></td>
    <td><div align="center">$9,339.75</div></td>
    <td><div align="center">2965 YDS</div></td>
    <td><div align="center">$3.15</div></td>
    <td width="111"><div align="center">$9,339.75</div></td>
    <td width="191"><div align="center">Used with    Fall'20 s/167177 &amp; s/175997</div></td>
    <td width="100"><div align="center">Settled</div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="198"><div align="center"></div></td>
    <td width="129"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="128"><div align="center"></div></td>
    <td width="147"><div align="center">0    YDS</div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
  </tr>
  <tr height="54">
    <td height="54"><div align="center">CK</div></td>
    <td width="100"><div align="center">FLOT    FABRIC</div></td>
    <td width="145"><div align="center">FALL'20</div></td>
    <td width="215"><div align="center">FABRIC    (AM-SELENA)</div></td>
    <td><div align="center">5000 YDS</div></td>
    <td><div align="center">$3.15</div></td>
    <td><div align="center">$15,750.00</div></td>
    <td><div align="center">5000 YDS</div></td>
    <td><div align="center">$3.15</div></td>
    <td width="111"><div align="center">$15,750.00</div></td>
    <td width="191"><div align="center">Used with    Fall'20 s/167177 &amp; s/175997</div></td>
    <td width="100"><div align="center">Settled</div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="198"><div align="center"></div></td>
    <td width="129"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="128"><div align="center"></div></td>
    <td width="147"><div align="center">0    YDS</div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
  </tr>
  <tr height="22">
    <td height="22"><div align="center">CK</div></td>
    <td width="100"><div align="center">FLOT    FABRIC</div></td>
    <td width="145"><div align="center">FALL'20</div></td>
    <td width="215"><div align="center">FABRIC    (AM-VORM)</div></td>
    <td><div align="center">5000 YDS</div></td>
    <td><div align="center">$3.84</div></td>
    <td><div align="center">$19,190.00</div></td>
    <td rowspan="3" width="120"><div align="center">11/16/2019</div></td>
    <td><div align="center">5000 YDS</div></td>
    <td><div align="center">$3.84</div></td>
    <td width="111"><div align="center">$19,190.00</div></td>
    <td width="191"><div align="center">Used with Sum'20    s/184098&nbsp;</div></td>
    <td width="100"><div align="center">Settled</div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="198"><div align="center"></div></td>
    <td width="129"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="128"><div align="center"></div></td>
    <td width="147"><div align="center">0    YDS</div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
  </tr>
  <tr height="22">
    <td height="22"><div align="center">CK</div></td>
    <td width="100"><div align="center">174616    &amp; 618</div></td>
    <td><div align="center">HOL'20</div></td>
    <td><div align="center">MATCH BOOK</div></td>
    <td><div align="center">32484 PCS</div></td>
    <td><div align="center">$0.10</div></td>
    <td><div align="center">$3,248.40</div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center">32484 PCS</div></td>
    <td><div align="center">$0.10</div></td>
    <td><div align="center">$3,248.40</div></td>
    <td width="198"><div align="center">Invoice#    174616&amp;174618</div></td>
    <td width="129"><div align="center">Payment Rcvd</div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center">0 PCS</div></td>
    <td><div align="center">$0.00</div></td>
    <td><div align="center">$0.00</div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
  </tr>
  <tr height="34" style="color: #fff; background-color: #555555;">
    <td colspan="6" height="34"><div align="center"></div></td>
    <td><div align="center"><strong>$76,193.15</strong></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"><strong>$72,944.75</strong></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"><strong>$3,248.40</strong></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"><strong>$0.00</strong></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"><strong>$0.00</strong></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
  </tr>
  
   <tr height="54">
    <td height="54"><div align="center">RL</div></td>
    <td width="100"><div align="center">673010</div></td>
    <td width="145"><div align="center">FALL'19    + Fall'20</div></td>
    <td width="215"><div align="center">FABRIC    (AM-SELENA)</div></td>
    <td><div align="center">9100 YDS</div></td>
    <td><div align="center">$3.15</div></td>
    <td><div align="center">$28,665.00</div></td>
    <td rowspan="3" width="120"><div align="center">11/16/2019</div></td>
    <td><div align="center">9100 YDS</div></td>
    <td><div align="center">$3.15</div></td>
    <td width="111"><div align="center">$28,665.00</div></td>
    <td width="191"><div align="center">Used with    Fall'20 s/167177 &amp; s/175997</div></td>
    <td width="100"><div align="center">Settled</div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="198"><div align="center"></div></td>
    <td width="129"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="128"><div align="center"></div></td>
    <td width="147"><div align="center">0    YDS</div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
  </tr>
  <tr height="54">
    <td height="54"><div align="center">RL</div></td>
    <td width="100"><div align="center">673012</div></td>
    <td width="145"><div align="center">FALL'20</div></td>
    <td width="215"><div align="center">FABRIC    (AM-SELENA)</div></td>
    <td><div align="center">2965 YDS</div></td>
    <td><div align="center">$3.15</div></td>
    <td><div align="center">$9,339.75</div></td>
    <td><div align="center">2965 YDS</div></td>
    <td><div align="center">$3.15</div></td>
    <td width="111"><div align="center">$9,339.75</div></td>
    <td width="191"><div align="center">Used with    Fall'20 s/167177 &amp; s/175997</div></td>
    <td width="100"><div align="center">Settled</div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="198"><div align="center"></div></td>
    <td width="129"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="128"><div align="center"></div></td>
    <td width="147"><div align="center">0    YDS</div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
  </tr>
  <tr height="54">
    <td height="54"><div align="center">RL</div></td>
    <td width="100"><div align="center">FLOT    FABRIC</div></td>
    <td width="145"><div align="center">FALL'20</div></td>
    <td width="215"><div align="center">FABRIC    (AM-SELENA)</div></td>
    <td><div align="center">5000 YDS</div></td>
    <td><div align="center">$3.15</div></td>
    <td><div align="center">$15,750.00</div></td>
    <td><div align="center">5000 YDS</div></td>
    <td><div align="center">$3.15</div></td>
    <td width="111"><div align="center">$15,750.00</div></td>
    <td width="191"><div align="center">Used with    Fall'20 s/167177 &amp; s/175997</div></td>
    <td width="100"><div align="center">Settled</div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="198"><div align="center"></div></td>
    <td width="129"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="128"><div align="center"></div></td>
    <td width="147"><div align="center">0    YDS</div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
  </tr>
  <tr height="22">
    <td height="22"><div align="center">RL</div></td>
    <td width="100"><div align="center">FLOT    FABRIC</div></td>
    <td width="145"><div align="center">FALL'20</div></td>
    <td width="215"><div align="center">FABRIC    (AM-VORM)</div></td>
    <td><div align="center">5000 YDS</div></td>
    <td><div align="center">$3.84</div></td>
    <td><div align="center">$19,190.00</div></td>
    <td rowspan="3" width="120"><div align="center">11/16/2019</div></td>
    <td><div align="center">5000 YDS</div></td>
    <td><div align="center">$3.84</div></td>
    <td width="111"><div align="center">$19,190.00</div></td>
    <td width="191"><div align="center">Used with Sum'20    s/184098&nbsp;</div></td>
    <td width="100"><div align="center">Settled</div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="198"><div align="center"></div></td>
    <td width="129"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="128"><div align="center"></div></td>
    <td width="147"><div align="center">0    YDS</div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
    <td width="100"><div align="center"></div></td>
  </tr>
  <tr height="22">
    <td height="22"><div align="center">RL</div></td>
    <td width="100"><div align="center">174616    &amp; 618</div></td>
    <td><div align="center">HOL'20</div></td>
    <td><div align="center">MATCH BOOK</div></td>
    <td><div align="center">32484 PCS</div></td>
    <td><div align="center">$0.10</div></td>
    <td><div align="center">$3,248.40</div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center">32484 PCS</div></td>
    <td><div align="center">$0.10</div></td>
    <td><div align="center">$3,248.40</div></td>
    <td width="198"><div align="center">Invoice#    174616&amp;174618</div></td>
    <td width="129"><div align="center">Payment Rcvd</div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center">0 PCS</div></td>
    <td><div align="center">$0.00</div></td>
    <td><div align="center">$0.00</div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
  </tr>
  <tr height="34" style="color: #fff; background-color: #555555;">
    <td colspan="6" height="34"><div align="center"></div></td>
    <td><div align="center"><strong>$76,193.15</strong></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"><strong>$72,944.75</strong></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"><strong>$3,248.40</strong></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"><strong>$0.00</strong></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"><strong>$0.00</strong></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
  </tr>
  
  
  
  
  
</table>
				       
				  </div> 
				  
				  
				<div class="card" style="padding:0px; margin-top:20px;">
				   
				   <table cellspacing="0" cellpadding="0" class="table table-responsive placement-spread" style="font-size:11px;"> 
  <tr height="31" style="background-color: #fff7b3; color: #000; font-size:14px;">
    <td colspan="9" height="31"><div align="center"><strong>SUMMARY OF LIABILITY</strong></div></td>
  </tr>
  <tr height="40" style="background-color: #e5fbfa; color: #000;">
    <td rowspan="2" height="87" width="124"><div align="center"><strong>BUYER&nbsp;</strong></div></td>
    <td rowspan="2" width="124"><div align="center"><strong>BRAND</strong></div></td>
    <td rowspan="2" width="180"><div align="center"><strong>TOTAL LABILITY AMOUNT</strong></div></td>
    <td colspan="4"><div align="center"><strong>SETTLED    LIABILITY AMOUNT&nbsp;</strong></div></td>
    <td rowspan="2" width="149"><div align="center"><strong>PENDING LIABILITY AMOUNT</strong></div></td>
    <td rowspan="2" width="279"><div align="center"><strong>REMARKS</strong></div></td>
  </tr>
  <tr height="47" style="background-color: #e5fbfa; color: #000;">
    <td width="172" height="47"><div align="center"><strong>WITH NEW    ORDER</strong></div></td>
    <td width="182"><div align="center"><strong>THROUGH INVOICE</strong></div></td>
    <td width="90"><div align="center"><strong>SOLD</strong></div></td>
    <td width="99"><div align="center"><strong>TOTAL</strong></div></td>
  </tr>
  <tr height="22">
    <td height="22"><div align="center">GAP INC</div></td>
    <td width="124"><div align="center">RL.</div></td>
    <td><div align="center">$76,193.15</div></td>
    <td><div align="center">$72,944.75</div></td>
    <td><div align="center">$3,248.40</div></td>
    <td><div align="center">$0.00</div></td>
    <td><div align="center">$76,193.15</div></td>
    <td><div align="center">$0.00</div></td>
    <td><div align="center"></div></td>
  </tr>
  <tr height="22">
    <td height="22"><div align="center">GAP INC</div></td>
    <td width="124"><div align="center">CK</div></td>
    <td><div align="center">$8,304.38</div></td>
    <td><div align="center">$1,136.38</div></td>
    <td><div align="center">$0.00</div></td>
    <td><div align="center">$0.00</div></td>
    <td><div align="center">$1,136.38</div></td>
    <td><div align="center">$7,168.00</div></td>
    <td><div align="center"></div></td>
  </tr>
  <tr height="22">
    <td height="22"><div align="center">GAP INC</div></td>
    <td width="124"><div align="center">CK</div></td>
    <td><div align="center">$174,547.31</div></td>
    <td><div align="center">$51,901.83</div></td>
    <td><div align="center">$25,072.04</div></td>
    <td><div align="center">$49,419.60</div></td>
    <td><div align="center">$126,393.47</div></td>
    <td><div align="center">$48,153.84</div></td>
    <td><div align="center"></div></td>
  </tr>
  <tr height="22">
    <td height="22"><div align="center">GAP INC</div></td>
    <td width="124"><div align="center">CKGO</div></td>
    <td><div align="center">$31,071.57</div></td>
    <td><div align="center">$23,793.37</div></td>
    <td><div align="center">$4,005.00</div></td>
    <td><div align="center">$0.00</div></td>
    <td><div align="center">$27,798.37</div></td>
    <td><div align="center">$3,273.20</div></td>
    <td><div align="center"></div></td>
  </tr>
  <tr height="22">
    <td height="22"><div align="center">GAP INC</div></td>
    <td width="124"><div align="center">RLFS</div></td>
    <td><div align="center">$56,623.13</div></td>
    <td><div align="center">$48,985.13</div></td>
    <td><div align="center">$0.00</div></td>
    <td><div align="center">$7,638.00</div></td>
    <td><div align="center">$56,623.13</div></td>
    <td><div align="center">$0.00</div></td>
    <td><div align="center"></div></td>
  </tr>
  <tr height="40" style="color: #fff;background-color: #555555;">
    <td height="40"><div align="center"><strong>TOTAL</strong></div></td>
    <td width="124"><div align="center"></div></td>
    <td><div align="center"><strong>$346,739.54</strong></div></td>
    <td><div align="center"><strong>$198,761.46</strong></div></td>
    <td><div align="center"><strong>$32,325.44</strong></div></td>
    <td><div align="center"><strong>$57,057.60</strong></div></td>
    <td><div align="center"><strong>$288,144.50</strong></div></td>
    <td><div align="center"><strong>$58,595.04</strong></div></td>
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
				 
		 
		 
		 
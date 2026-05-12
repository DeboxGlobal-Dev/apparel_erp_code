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
    <td width="6581" height="20"><div align="center"></div></td>
    <td width="6581"><div align="center"></div></td>
    <td width="6581"><div align="center"></div></td>
    <td width="6581"><div align="center"></div></td>
    <td width="6581"><div align="center"></div></td>
    <td width="6581"><div align="center"></div></td>
    <td colspan="24"><div align="center"><strong>Total Synopsis</strong></div></td>
    <td width="6581"><div align="center"></div></td>
    <td width="6581"><div align="center"></div></td>
    <td colspan="24"><div align="center"><strong>Schifli Synopsis</strong></div></td>
    <td width="6581"><div align="center"></div></td>
    <td width="6581"><div align="center"></div></td>
    <td colspan="24"><div align="center"><strong>Without Schifli Synopsis</strong></div></td>
    <td width="76"><div align="center"></div></td>
    <td width="76"><div align="center"></div></td>
    <td width="75"><div align="center"></div></td>
    <td width="76"><div align="center"></div></td>
    <td width="75"><div align="center"></div></td>
    <td width="76"><div align="center"></div></td>
    <td width="75"><div align="center"></div></td>
    <td width="76"><div align="center"></div></td>
    <td width="68"><div align="center"></div></td>
    <td width="74"><div align="center"></div></td>
  </tr>
  <tr height="20" style="background-color: #e5fbfa; color: #000;">
    <td height="20"><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td colspan="6"><div align="center"><strong>Flow 1</strong></div></td>
    <td colspan="8"><div align="center"><strong>Flow 2</strong></div></td>
    <td colspan="12"><div align="center"><strong>Flow 3</strong></div></td>
    <td colspan="4"><div align="center"><strong>Flow 1</strong></div></td>
    <td width="6581"><div align="center"></div></td>
    <td width="6581"><div align="center"></div></td>
    <td colspan="6"><div align="center"><strong>Flow 2</strong></div></td>
    <td width="6581"><div align="center"></div></td>
    <td width="6581"><div align="center"></div></td>
    <td colspan="10"><div align="center"><strong>Flow 3</strong></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td colspan="4"><div align="center"><strong>Flow 1</strong></div></td>
    <td width="6581"><div align="center"></div></td>
    <td width="6581"><div align="center"></div></td>
    <td colspan="6"><div align="center"><strong>Flow 2</strong></div></td>
    <td width="6581"><div align="center"></div></td>
    <td width="6581"><div align="center"></div></td>
    <td colspan="10"><div align="center"><strong>Flow 3</strong></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td colspan="2"><div align="center"><strong>Total</strong></div></td>
    <td colspan="2"><div align="center"><strong>With Schifli&nbsp;</strong></div></td>
    <td colspan="2"><div align="center"><strong>Without Schifli</strong></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
  </tr>
  <tr height="20" style="background-color: #e5fbfa; color: #000;">
    <td height="20"><div align="center"><strong>Brand</strong></div></td>
    <td><div align="center"><strong>No.&nbsp;of&nbsp;styles</strong></div></td>
    <td><div align="center"><strong>No.&nbsp;of&nbsp;SAM</strong></div></td>
    <td><div align="center"><strong>Avg.&nbsp;SAM</strong></div></td>
    <td><div align="center"><strong>Order&nbsp;Q'ty</strong></div></td>
    <td><div align="center"><strong>Fab&nbsp;Q'ty</strong></div></td>
    <td colspan="2">
      <div align="center" style="width:150px;"><strong>
        26 May
        </strong></div></td>
    <td colspan="2">
      <div align="center">
        <div align="center" style="width:150px;"><strong> 26 May </strong></div>
      </div></td>
    <td colspan="2"><div align="center"><strong>Total&nbsp;Q'nty</strong></div></td>
        <td colspan="2">
            <div align="center">
              <div align="center" style="width:150px;"><strong> 26 May </strong></div>
            </div></td>
        <td colspan="2">
            <div align="center">
              <div align="center" style="width:150px;"><strong> 26 May </strong></div>
            </div></td>
        <td colspan="2"><div align="center"></div></td>
    <td colspan="2"><div align="center"><strong>Total Q'nty</strong></div></td>
    <td colspan="2">
      <div align="center">
        <div align="center" style="width:150px;"><strong> 26 May </strong></div>
      </div></td>
    <td colspan="2">
      <div align="center">
        <div align="center" style="width:150px;"><strong> 26 May </strong></div>
      </div></td>
    <td colspan="2">
      <div align="center">
        <div align="center" style="width:150px;"><strong> 26 May </strong></div>
      </div></td>
    <td colspan="2">
      <div align="center">
        <div align="center" style="width:150px;"><strong> 26 May </strong></div>
      </div></td>
    <td colspan="2">
      <div align="center">
        <div align="center" style="width:150px;"><strong> 26 May </strong></div>
      </div></td>
    <td colspan="2"><div align="center"><strong>Total Q'nty</strong></div></td>
        <td colspan="2">
            <div align="center">
              <div align="center" style="width:150px;"><strong> 26 May </strong></div>
            </div></td>
        <td colspan="2">
            <div align="center">
              <div align="center" style="width:150px;"><strong> 26 May </strong></div>
            </div></td>
        <td colspan="2"><div align="center"><strong>Total Q'nty</strong></div></td>
                <td colspan="2">
                            <div align="center">
                              <div align="center" style="width:150px;"><strong> 26 May </strong></div>
                  </div></td>
                <td colspan="2">
                            <div align="center">
                              <div align="center" style="width:150px;"><strong> 26 May </strong></div>
                  </div></td>
                <td colspan="2"><div align="center"></div></td>
    <td colspan="2"><div align="center"><strong>Total Q'nty</strong></div></td>
    <td colspan="2">
      <div align="center">
        <div align="center" style="width:150px;"><strong> 26 May </strong></div>
      </div></td>
    <td colspan="2">
      <div align="center">
        <div align="center" style="width:150px;"><strong> 26 May </strong></div>
      </div></td>
    <td colspan="2">
      <div align="center">
        <div align="center" style="width:150px;"><strong> 26 May </strong></div>
      </div></td>
    <td colspan="2">
      <div align="center">
        <div align="center" style="width:150px;"><strong> 26 May </strong></div>
      </div></td>
    <td colspan="2">
      <div align="center">
        <div align="center" style="width:150px;"><strong> 26 May </strong></div>
      </div></td>
    <td colspan="2"><div align="center"><strong>Total</strong></div></td>
        <td colspan="2">
            <div align="center">
              <div align="center" style="width:150px;"><strong> 26 May </strong></div>
            </div></td>
        <td colspan="2">
            <div align="center">
              <div align="center" style="width:150px;"><strong> 26 May </strong></div>
            </div></td>
        <td colspan="2"><div align="center"><strong>Total Q'nty</strong></div></td>
                <td colspan="2">
                            <div align="center">
                              <div align="center" style="width:150px;"><strong> 26 May </strong></div>
                  </div></td>
                <td colspan="2">
                            <div align="center">
                              <div align="center" style="width:150px;"><strong> 26 May </strong></div>
                  </div></td>
                <td colspan="2"><div align="center"></div></td>
    <td colspan="2"><div align="center"><strong>Total Q'nty</strong></div></td>
    <td colspan="2">
      <div align="center">
        <div align="center" style="width:150px;"><strong> 26 May </strong></div>
      </div></td>
    <td colspan="2">
      <div align="center">
        <div align="center" style="width:150px;"><strong> 26 May </strong></div>
      </div></td>
    <td colspan="2">
      <div align="center">
        <div align="center" style="width:150px;"><strong> 26 May </strong></div>
      </div></td>
    <td colspan="2">
      <div align="center">
        <div align="center" style="width:150px;"><strong> 26 May </strong></div>
      </div></td>
    <td colspan="2">
      <div align="center">
        <div align="center" style="width:150px;"><strong> 26 May </strong></div>
      </div></td>
    <td colspan="2"><div align="center"><strong>Total Q'nty</strong></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td colspan="2"><div align="center"><strong>Tally w+ W/o S</strong></div></td>
  </tr>
  <tr height="20" style="background-color: #e5fbfa; color: #000;">
    <td height="20"><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td width="6581"><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Fabric Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Order Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Fabric Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Fabric Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Order Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Fabric Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Order Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Fabric Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Order Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Fabric Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Order Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Fabric Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Order Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Fabric Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Order Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Fabric Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Order Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Fabric Q'nty</strong></div></td>
    <td><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td width="6581"><div align="center"><strong>Fabric Q'nty</strong></div></td>
    <td><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td><div align="center"><strong>Order&nbsp;Q'nty</strong></div></td>
    <td><div align="center"><strong>Fabric&nbsp;Q'nty</strong></div></td>
    <td><div align="center"><strong>O.Q.</strong></div></td>
    <td><div align="center"><strong>F.Q.</strong></div></td>
  </tr>
  <tr height="20">
    <td height="20"><div style="width:120px;">
      <div align="center">Calvin Klein Tops</div>
    </div></td>
    <td><div align="center">6</div></td>
    <td><div align="center">4</div></td>
    <td><div align="center">26.7</div></td>
    <td><div align="center">331511</div></td>
    <td><div align="center">456944.226</div></td>
    <td><div align="center">92739</div></td>
    <td><div align="center">139087.747</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">92739</div></td>
    <td><div align="center">139087.747</div></td>
    <td><div align="center">52268</div></td>
    <td><div align="center">78614.429</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">52268</div></td>
    <td><div align="center">78614.429</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">183984</div></td>
    <td><div align="center">235910.34</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">2520</div></td>
    <td><div align="center">3331.71</div></td>
    <td><div align="center">186504</div></td>
    <td><div align="center">239242.05</div></td>
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
    <td><div align="center">148944</div></td>
    <td><div align="center">196956.52</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">2520</div></td>
    <td><div align="center">3331.71</div></td>
    <td><div align="center">151464</div></td>
    <td><div align="center">200288.23</div></td>
    <td><div align="center">92739</div></td>
    <td><div align="center">139087.747</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">92739</div></td>
    <td><div align="center">139087.747</div></td>
    <td><div align="center">52268</div></td>
    <td><div align="center">78614.429</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">52268</div></td>
    <td><div align="center">78614.429</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">35040</div></td>
    <td><div align="center">38953.82</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">35040</div></td>
    <td><div align="center">38953.82</div></td>
    <td><div align="center">331,511</div></td>
    <td><div align="center">456944.226</div></td>
    <td><div align="center">151,464</div></td>
    <td><div align="center">200,288</div></td>
    <td><div align="center">180,047</div></td>
    <td><div align="center">256655.996</div></td>
    <td><div align="center">331,511</div></td>
    <td><div align="center">456,944</div></td>
  </tr>
  <tr height="20">
    <td height="20"><div align="center">Calvin Klein    Dress</div></td>
    <td><div align="center">8</div></td>
    <td><div align="center">5</div></td>
    <td><div align="center">28.9</div></td>
    <td><div align="center">248390</div></td>
    <td><div align="center">490,624</div></td>
    <td><div align="center">80845</div></td>
    <td><div align="center">166417.4</div></td>
    <td><div align="center">23000</div></td>
    <td><div align="center">46550</div></td>
    <td><div align="center">103845</div></td>
    <td><div align="center">212967.4</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">10000</div></td>
    <td><div align="center">18600</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">10000</div></td>
    <td><div align="center">18600</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">134,545</div></td>
    <td><div align="center">259,057</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">134545</div></td>
    <td><div align="center">259056.55</div></td>
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
    <td><div align="center">70,100</div></td>
    <td><div align="center">132,065</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">70100</div></td>
    <td><div align="center">132065</div></td>
    <td><div align="center">80845</div></td>
    <td><div align="center">166417.4</div></td>
    <td><div align="center">23000</div></td>
    <td><div align="center">46550</div></td>
    <td><div align="center">103845</div></td>
    <td><div align="center">212967.4</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">10000</div></td>
    <td><div align="center">18600</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">10000</div></td>
    <td><div align="center">18600</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">64,445</div></td>
    <td><div align="center">126,992</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">64445</div></td>
    <td><div align="center">126991.55</div></td>
    <td><div align="center">248,390</div></td>
    <td><div align="center">490623.95</div></td>
    <td><div align="center">70,100</div></td>
    <td><div align="center">132,065</div></td>
    <td><div align="center">178,290</div></td>
    <td><div align="center">358558.95</div></td>
    <td><div align="center">248,390</div></td>
    <td><div align="center">490,624</div></td>
  </tr>
  <tr height="20">
    <td height="20"><div align="center">Calvin Klein    Kids</div></td>
    <td><div align="center">3</div></td>
    <td><div align="center">1</div></td>
    <td><div align="center">24</div></td>
    <td><div align="center">120510</div></td>
    <td><div align="center">101411.7</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">27560</div></td>
    <td><div align="center">23977.2</div></td>
    <td><div align="center">27560</div></td>
    <td><div align="center">23977.2</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">92950</div></td>
    <td><div align="center">77434.5</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">92950</div></td>
    <td><div align="center">77434.5</div></td>
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
    <td><div align="center">27560</div></td>
    <td><div align="center">23977.2</div></td>
    <td><div align="center">27560</div></td>
    <td><div align="center">23977.2</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">92950</div></td>
    <td><div align="center">77434.5</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">92950</div></td>
    <td><div align="center">77434.5</div></td>
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
    <td><div align="center">120,510</div></td>
    <td><div align="center">101411.7</div></td>
    <td><div align="center">120,510</div></td>
    <td><div align="center">101,412</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">120,510</div></td>
    <td><div align="center">101,412</div></td>
  </tr>
  <tr height="20">
    <td height="20"><div align="center">Calvin Klein    Toddlers</div></td>
    <td><div align="center">4</div></td>
    <td><div align="center">2</div></td>
    <td><div align="center">20</div></td>
    <td><div align="center">139880</div></td>
    <td><div align="center">79161.55</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">104000</div></td>
    <td><div align="center">57478.85</div></td>
    <td><div align="center">35880</div></td>
    <td><div align="center">21682.7</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">139880</div></td>
    <td><div align="center">79161.55</div></td>
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
    <td><div align="center">104000</div></td>
    <td><div align="center">57478.85</div></td>
    <td><div align="center">35880</div></td>
    <td><div align="center">21682.7</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">139880</div></td>
    <td><div align="center">79161.55</div></td>
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
    <td><div align="center">139,880</div></td>
    <td><div align="center">79161.55</div></td>
    <td><div align="center">139,880</div></td>
    <td><div align="center">79,162</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">139,880</div></td>
    <td><div align="center">79,162</div></td>
  </tr>
  <tr height="20">
    <td height="20"><div align="center">Calvin Klein    M+P</div></td>
    <td><div align="center">5</div></td>
    <td><div align="center">2</div></td>
    <td><div align="center">32</div></td>
    <td><div align="center">37200</div></td>
    <td><div align="center">25857</div></td>
    <td><div align="center">12120</div></td>
    <td><div align="center">20604</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">12120</div></td>
    <td><div align="center">20604</div></td>
    <td><div align="center">9870</div></td>
    <td><div align="center">16779</div></td>
    <td><div align="center">12140</div></td>
    <td><div align="center">20638</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">22010</div></td>
    <td><div align="center">37417</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">3070</div></td>
    <td><div align="center">5219</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">3070</div></td>
    <td><div align="center">5219</div></td>
    <td><div align="center">12120</div></td>
    <td><div align="center">20604</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">12120</div></td>
    <td><div align="center">20604</div></td>
    <td><div align="center">9870</div></td>
    <td><div align="center">15674</div></td>
    <td><div align="center">12140</div></td>
    <td><div align="center">20638</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">22010</div></td>
    <td><div align="center">36312</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">3070</div></td>
    <td><div align="center">5219</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">3070</div></td>
    <td><div align="center">5219</div></td>
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
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">37,200</div></td>
    <td><div align="center">63240</div></td>
    <td><div align="center">37,200</div></td>
    <td><div align="center">62,135</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">37,200</div></td>
    <td><div align="center">62,135</div></td>
  </tr>
  <tr height="20">
    <td height="20"><div align="center">Ralph    LaurenTops</div></td>
    <td><div align="center">2</div></td>
    <td><div align="center">2</div></td>
    <td><div align="center">25</div></td>
    <td><div align="center">192870</div></td>
    <td><div align="center">289305</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">111228</div></td>
    <td><div align="center">166842</div></td>
    <td><div align="center">111228</div></td>
    <td><div align="center">166842</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">44000</div></td>
    <td><div align="center">66000</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">44000</div></td>
    <td><div align="center">66000</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">37642</div></td>
    <td><div align="center">56463</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">37642</div></td>
    <td><div align="center">56463</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">44000</div></td>
    <td><div align="center">66000</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">44000</div></td>
    <td><div align="center">66000</div></td>
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
    <td><div align="center">111228</div></td>
    <td><div align="center">166842</div></td>
    <td><div align="center">111228</div></td>
    <td><div align="center">166842</div></td>
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
    <td><div align="center">37642</div></td>
    <td><div align="center">56463</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">37642</div></td>
    <td><div align="center">56463</div></td>
    <td><div align="center">192,870</div></td>
    <td><div align="center">289305</div></td>
    <td><div align="center">44,000</div></td>
    <td><div align="center">66,000</div></td>
    <td><div align="center">148,870</div></td>
    <td><div align="center">223305</div></td>
    <td><div align="center">192,870</div></td>
    <td><div align="center">289,305</div></td>
  </tr>
  <tr height="20">
    <td height="20"><div align="center">Ralph Lauren    Dress</div></td>
    <td><div align="center">2</div></td>
    <td><div align="center">2</div></td>
    <td><div align="center">29</div></td>
    <td><div align="center">52601</div></td>
    <td><div align="center">97311.85</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">17461</div></td>
    <td><div align="center">32302.85</div></td>
    <td><div align="center">17461</div></td>
    <td><div align="center">32302.85</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">12402</div></td>
    <td><div align="center">22943.7</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">12402</div></td>
    <td><div align="center">22943.7</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">22738</div></td>
    <td><div align="center">42065.3</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">22738</div></td>
    <td><div align="center">42065.3</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">4490</div></td>
    <td><div align="center">8306.5</div></td>
    <td><div align="center">4490</div></td>
    <td><div align="center">8306.5</div></td>
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
    <td><div align="center">22738</div></td>
    <td><div align="center">42065.3</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">22738</div></td>
    <td><div align="center">42065.3</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">12971</div></td>
    <td><div align="center">23996.35</div></td>
    <td><div align="center">12971</div></td>
    <td><div align="center">23996.35</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">12402</div></td>
    <td><div align="center">22943.7</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">12402</div></td>
    <td><div align="center">22943.7</div></td>
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
    <td><div align="center">52,601</div></td>
    <td><div align="center">97,312</div></td>
    <td><div align="center">27,228</div></td>
    <td><div align="center">50,372</div></td>
    <td><div align="center">25,373</div></td>
    <td><div align="center">46940.05</div></td>
    <td><div align="center">52,601</div></td>
    <td><div align="center">97,312</div></td>
  </tr>
  <tr height="20">
    <td height="20"><div align="center">Ralph Lauren    Kids</div></td>
    <td><div align="center">9</div></td>
    <td><div align="center">7</div></td>
    <td><div align="center">25</div></td>
    <td><div align="center">87961</div></td>
    <td><div align="center">69063.435</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">8977</div></td>
    <td><div align="center">4712.925</div></td>
    <td><div align="center">8977</div></td>
    <td><div align="center">4712.925</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">47153</div></td>
    <td><div align="center">44148.33</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">47153</div></td>
    <td><div align="center">44148.33</div></td>
    <td><div align="center">31831</div></td>
    <td><div align="center">20202.18</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">31831</div></td>
    <td><div align="center">20202.18</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">8977</div></td>
    <td><div align="center">4712.925</div></td>
    <td><div align="center">8977</div></td>
    <td><div align="center">4712.925</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">47153</div></td>
    <td><div align="center">44148.33</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">47153</div></td>
    <td><div align="center">44148.33</div></td>
    <td><div align="center">31831</div></td>
    <td><div align="center">20202.18</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">31831</div></td>
    <td><div align="center">20202.18</div></td>
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
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">87,961</div></td>
    <td><div align="center">69063.435</div></td>
    <td><div align="center">87,961</div></td>
    <td><div align="center">69,063</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">87,961</div></td>
    <td><div align="center">69,063</div></td>
  </tr>
  <tr height="20">
    <td height="20"><div align="center">Ralph Lauren    Toddlers</div></td>
    <td><div align="center">14</div></td>
    <td><div align="center">9</div></td>
    <td><div align="center">25</div></td>
    <td><div align="center">68276</div></td>
    <td><div align="center">32404.45</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">18568</div></td>
    <td><div align="center">9279.14</div></td>
    <td><div align="center">18568</div></td>
    <td><div align="center">9279.14</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">43220</div></td>
    <td><div align="center">19881.31</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">43220</div></td>
    <td><div align="center">19881.31</div></td>
    <td><div align="center">6488</div></td>
    <td><div align="center">3244</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">6488</div></td>
    <td><div align="center">3244</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">18568</div></td>
    <td><div align="center">9279.14</div></td>
    <td><div align="center">18568</div></td>
    <td><div align="center">9279.14</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">43220</div></td>
    <td><div align="center">19881.31</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">43220</div></td>
    <td><div align="center">19881.31</div></td>
    <td><div align="center">6488</div></td>
    <td><div align="center">3244</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">6488</div></td>
    <td><div align="center">3244</div></td>
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
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">68,276</div></td>
    <td><div align="center">32404.45</div></td>
    <td><div align="center">68,276</div></td>
    <td><div align="center">32,404</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">68,276</div></td>
    <td><div align="center">32,404</div></td>
  </tr>
  <tr height="20">
    <td height="20"><div align="center">Ralph Lauren Infants</div></td>
    <td><div align="center">16</div></td>
    <td><div align="center">7</div></td>
    <td><div align="center">29</div></td>
    <td><div align="center">183386</div></td>
    <td><div align="center">91894.75</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">37751</div></td>
    <td><div align="center">18602.7</div></td>
    <td><div align="center">37751</div></td>
    <td><div align="center">18602.7</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">87663</div></td>
    <td><div align="center">44112.18</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">87663</div></td>
    <td><div align="center">44112.18</div></td>
    <td><div align="center">57972</div></td>
    <td><div align="center">29179.87</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">57972</div></td>
    <td><div align="center">29179.87</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">37751</div></td>
    <td><div align="center">18602.7</div></td>
    <td><div align="center">37751</div></td>
    <td><div align="center">18602.7</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">87663</div></td>
    <td><div align="center">44112.18</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">87663</div></td>
    <td><div align="center">44112.18</div></td>
    <td><div align="center">57972</div></td>
    <td><div align="center">29179.87</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">57972</div></td>
    <td><div align="center">29179.87</div></td>
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
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">183,386</div></td>
    <td><div align="center">91894.75</div></td>
    <td><div align="center">183,386</div></td>
    <td><div align="center">91,895</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">0</div></td>
    <td><div align="center">183,386</div></td>
    <td><div align="center">91,895</div></td>
  </tr>
  <tr height="20" style="color: #fff; background-color: #555555;">
    <td height="20"><div align="center"></div></td>
    <td><div align="center"><strong>69</strong></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"><strong>26.46</strong></div></td>
    <td><div align="center"><strong>1462585</strong></div></td>
    <td><div align="center"><strong>1733977.911</strong></div></td>
    <td><div align="center"><strong>185704</strong></div></td>
    <td><div align="center"><strong>326109.147</strong></div></td>
    <td><div align="center"><strong>244545</strong></div></td>
    <td><div align="center"><strong>302266.815</strong></div></td>
    <td><div align="center"><strong>430249</strong></div></td>
    <td><div align="center"><strong>628375.962</strong></div></td>
    <td><div align="center"><strong>166138</strong></div></td>
    <td><div align="center"><strong>152872.279</strong></div></td>
    <td><div align="center"><strong>385408</strong></div></td>
    <td><div align="center"><strong>335440.72</strong></div></td>
    <td><div align="center"><strong>0</strong></div></td>
    <td><div align="center"><strong>0</strong></div></td>
    <td><div align="center"><strong>551546</strong></div></td>
    <td><div align="center"><strong>488312.999</strong></div></td>
    <td><div align="center"><strong>96291</strong></div></td>
    <td><div align="center"><strong>52626.05</strong></div></td>
    <td><div align="center"><strong>321599</strong></div></td>
    <td><div align="center"><strong>500185.89</strong></div></td>
    <td><div align="center"><strong>60380</strong></div></td>
    <td><div align="center"><strong>98528.3</strong></div></td>
    <td><div align="center"><strong>0</strong></div></td>
    <td><div align="center"><strong>0</strong></div></td>
    <td><div align="center"><strong>2520</strong></div></td>
    <td><div align="center"><strong>3331.71</strong></div></td>
    <td><div align="center"><strong>480790</strong></div></td>
    <td><div align="center"><strong>654671.95</strong></div></td>
    <td><div align="center"><strong>12120</strong></div></td>
    <td><div align="center"><strong>20604</strong></div></td>
    <td><div align="center"><strong>97346</strong></div></td>
    <td><div align="center"><strong>64878.465</strong></div></td>
    <td><div align="center"><strong>109466</strong></div></td>
    <td><div align="center"><strong>85482.465</strong></div></td>
    <td><div align="center"><strong>113870</strong></div></td>
    <td><div align="center"><strong>73152.85</strong></div></td>
    <td><div align="center"><strong>363006</strong></div></td>
    <td><div align="center"><strong>293897.02</strong></div></td>
    <td><div align="center"><strong>0</strong></div></td>
    <td><div align="center"><strong>0</strong></div></td>
    <td><div align="center"><strong>476876</strong></div></td>
    <td><div align="center"><strong>367049.87</strong></div></td>
    <td><div align="center"><strong>96291</strong></div></td>
    <td><div align="center"><strong>52626.05</strong></div></td>
    <td><div align="center"><strong>222114</strong></div></td>
    <td><div align="center"><strong>334240.52</strong></div></td>
    <td><div align="center"><strong>22738</strong></div></td>
    <td><div align="center"><strong>42065.3</strong></div></td>
    <td><div align="center"><strong>0</strong></div></td>
    <td><div align="center"><strong>0</strong></div></td>
    <td><div align="center"><strong>2520</strong></div></td>
    <td><div align="center"><strong>3331.71</strong></div></td>
    <td><div align="center"><strong>343663</strong></div></td>
    <td><div align="center"><strong>432263.58</strong></div></td>
    <td><div align="center"><strong>173584</strong></div></td>
    <td><div align="center"><strong>305505.147</strong></div></td>
    <td><div align="center"><strong>147199</strong></div></td>
    <td><div align="center"><strong>237388.35</strong></div></td>
    <td><div align="center"><strong>320783</strong></div></td>
    <td><div align="center"><strong>542893.497</strong></div></td>
    <td><div align="center"><strong>52268</strong></div></td>
    <td><div align="center"><strong>78614.429</strong></div></td>
    <td><div align="center"><strong>22402</strong></div></td>
    <td><div align="center"><strong>41543.7</strong></div></td>
    <td><div align="center"><strong>0</strong></div></td>
    <td><div align="center"><strong>0</strong></div></td>
    <td><div align="center"><strong>74670</strong></div></td>
    <td><div align="center"><strong>120158.129</strong></div></td>
    <td><div align="center"><strong>0</strong></div></td>
    <td><div align="center"><strong>0</strong></div></td>
    <td><div align="center"><strong>99485</strong></div></td>
    <td><div align="center"><strong>165945.37</strong></div></td>
    <td><div align="center"><strong>37642</strong></div></td>
    <td><div align="center"><strong>56463</strong></div></td>
    <td><div align="center"><strong>0</strong></div></td>
    <td><div align="center"><strong>0</strong></div></td>
    <td><div align="center"><strong>0</strong></div></td>
    <td><div align="center"><strong>0</strong></div></td>
    <td><div align="center"><strong>137127</strong></div></td>
    <td><div align="center"><strong>222408.37</strong></div></td>
    <td><div align="center"><strong>1462585</strong></div></td>
    <td><div align="center"><strong>1771360.91</strong></div></td>
    <td><div align="center"><strong>930005</strong></div></td>
    <td><div align="center"><strong>884795.915</strong></div></td>
    <td><div align="center"><strong>532580</strong></div></td>
    <td><div align="center"><strong>885459.996</strong></div></td>
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
				 
		 
		 
		 
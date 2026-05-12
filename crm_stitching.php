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

?>
<div class="page-content">
<style>
.even{
background-color: #0097a71a;
}
</style>
		<!-- Main sidebar -->
		
		<div class="content-wrapper">
 		<!---Save Alert Notification---->
		<?php include "savealert.php"; ?>	
 	
 
			<div class="content pt-0" style="margin-top:20px;"> 
				
				<div class="row">
				<div class="col-xl-12">
				
				<div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
					<div class="col-xl-9"><h5 class="card-title"><?php echo $pageName; ?></h5></div>
					<div class="col-xl-3" style="padding-right: 0px;"></div>
				</div>
				<div class="card">
				  <table cellspacing="0" cellpadding="0" class="table table-responsive" style="font-size:12px;">
                    <tr style="background-color: #fff7b3;color: #000;">
                      <td></td>
                      <td><strong>SEASON:&nbsp;Summer&nbsp;20</strong></td>
                      <td><strong>STYLE:&nbsp;274503</strong></td>
                      <td><strong>DESCRIPTION:-</strong></td>
                      <td><strong>COLOR-&nbsp;CHECK</strong></td>
                      <td><strong>PLANNED&nbsp;Cons:-</strong></td>
                      <td>&nbsp;</td>
                      <td><strong>ACTUAL&nbsp;Cons:-</strong></td>
                      <td>&nbsp;</td>
                      <td><strong>PLANNED&nbsp;PCD:-</strong></td>
                      <td>&nbsp;</td>
                      <td><strong>ACTUAL&nbsp;PCD</strong></td>
                      <td>&nbsp;</td>
                      <td><strong>NO.OF&nbsp;LINES</strong></td>
                      <td>&nbsp;</td>
                      <td><strong>PLANNED&nbsp;OUTPUT</strong></td>
                      <td>&nbsp;</td>
                      <td><strong>ACTUAL&nbsp;OUTPUT</strong></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  <tr style="background-color: #e5fbfa; color: #000;">
                      <td rowspan="2" height="42"><div align="center">MARKET</div></td>
                      <td rowspan="2"><div align="center">PO#/ORDER QTY</div></td>
                      <td rowspan="2"><div align="center">SHIP CNXL</div></td>
                      <td rowspan="2"><div align="center">PRIORITY</div></td>
                      <td rowspan="2"><div align="center">SHIP MODE&nbsp;</div></td>
                      <td colspan="17"><div align="center"></div></td>
                    </tr>
                    <tr style="background-color: #e5fbfa; color: #000;">
                      <td ><div align="center">XS</div></td>
                      <td><div align="center">S</div></td>
                      <td><div align="center">M</div></td>
                      <td><div align="center">L</div></td>
                      <td><div align="center">XL</div></td>
                      <td><div align="center">XXL</div></td>
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
                      <td><div align="center">TOTAL</div></td>
                    </tr>
                    <tr>
                      <td >&nbsp;</td>
                      <td>AB20CDA</td>
                      <td>14/Feb/20</td>
                      <td>P 1</td>
                      <td>SEA</td>
                      <td>151</td>
                      <td>411</td>
                      <td>216</td>
                      <td>102</td>
                      <td>80</td>
                      <td>80</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>1040</td>
                    </tr>
                    <tr>
                      <td >&nbsp;</td>
                      <td>CUT    QTY</td>
                      <td>14/Feb/20</td>
                      <td>P 1</td>
                      <td>SEA</td>
                      <td>50</td>
                      <td>411</td>
                      <td>216</td>
                      <td>102</td>
                      <td>80</td>
                      <td>80</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>939</td>
                    </tr>
                    <tr>
                      <td >&nbsp;</td>
                      <td>DISPACTHED    QTY</td>
                      <td>14/Feb/20</td>
                      <td>P 1</td>
                      <td>SEA</td>
                      <td>100</td>
                      <td>200</td>
                      <td>216</td>
                      <td>102</td>
                      <td>80</td>
                      <td>80</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>778</td>
                    </tr>
                    <tr>
                      <td >&nbsp;</td>
                      <td>BAL QTY TO CUT</td>
                      <td>14/Feb/20</td>
                      <td>P 1</td>
                      <td>SEA</td>
                      <td>101</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>101</td>
                    </tr>
                    <tr>
                      <td >&nbsp;</td>
                      <td>BAL TO DISPATCH</td>
                      <td>14/Feb/20</td>
                      <td>P 1</td>
                      <td>SEA</td>
                      <td>51</td>
                      <td>211</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>262</td>
                    </tr>
                    <tr>
                      <td >&nbsp;</td>
                      <td>1234567</td>
                      <td>20/Feb/20</td>
                      <td>P 2</td>
                      <td>SEA</td>
                      <td>37</td>
                      <td>52</td>
                      <td>62</td>
                      <td>42</td>
                      <td>22</td>
                      <td>10</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>225</td>
                    </tr>
                    <tr>
                      <td >&nbsp;</td>
                      <td>CUT QTY</td>
                      <td>20/Feb/20</td>
                      <td>P 2</td>
                      <td>SEA</td>
                      <td>37</td>
                      <td>39</td>
                      <td>34</td>
                      <td>148</td>
                      <td>170</td>
                      <td>80</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>508</td>
                    </tr>
                    <tr>
                      <td >&nbsp;</td>
                      <td>DISPACTHED    QTY</td>
                      <td>20/Feb/20</td>
                      <td>P 2</td>
                      <td>SEA</td>
                      <td>0</td>
                      <td>0</td>
                      <td>154</td>
                      <td>268</td>
                      <td>170</td>
                      <td>140</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>732</td>
                    </tr>
                    <tr>
                      <td >&nbsp;</td>
                      <td>BAL QTY TO CUT</td>
                      <td>20/Feb/20</td>
                      <td>P 2</td>
                      <td>SEA</td>
                      <td>0</td>
                      <td>13</td>
                      <td>28</td>
                      <td>-106</td>
                      <td>-148</td>
                      <td>-70</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>-283</td>
                    </tr>
                    <tr>
                      <td >&nbsp;</td>
                      <td>BAL TO DISPATCH</td>
                      <td>20/Feb/20</td>
                      <td>P 2</td>
                      <td>SEA</td>
                      <td>37</td>
                      <td>52</td>
                      <td>-92</td>
                      <td>-226</td>
                      <td>-148</td>
                      <td>-130</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>-507</td>
                    </tr>
                    <tr>
                      <td >&nbsp;</td>
                      <td>BC20CDA</td>
                      <td>20/Feb/20</td>
                      <td>P 3</td>
                      <td>SEA</td>
                      <td>279</td>
                      <td>767</td>
                      <td>403</td>
                      <td>187</td>
                      <td>140</td>
                      <td>137</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>1913</td>
                    </tr>
                    <tr>
                      <td >&nbsp;</td>
                      <td>CUT QTY</td>
                      <td>20/Feb/20</td>
                      <td>P 3</td>
                      <td>SEA</td>
                      <td>20</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>20</td>
                    </tr>
                    <tr>
                      <td >&nbsp;</td>
                      <td>DISPACTHED QTY</td>
                      <td>20/Feb/20</td>
                      <td>P 3</td>
                      <td>SEA</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>0</td>
                    </tr>
                    <tr>
                      <td >&nbsp;</td>
                      <td>BAL QTY TO CUT</td>
                      <td>20/Feb/20</td>
                      <td>P 3</td>
                      <td>SEA</td>
                      <td>259</td>
                      <td>767</td>
                      <td>403</td>
                      <td>187</td>
                      <td>140</td>
                      <td>137</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>1893</td>
                    </tr>
                    <tr>
                      <td >&nbsp;</td>
                      <td>BAL TO DISPATCH</td>
                      <td>20/Feb/20</td>
                      <td>P 3</td>
                      <td>SEA</td>
                      <td>279</td>
                      <td>767</td>
                      <td>403</td>
                      <td>187</td>
                      <td>140</td>
                      <td>137</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>1913</td>
                    </tr>
                    <tr>
                      <td >&nbsp;</td>
                      <td>CD18EFA</td>
                      <td>20/Feb/20</td>
                      <td>P 3</td>
                      <td>SEA</td>
                      <td>25</td>
                      <td>80</td>
                      <td>59</td>
                      <td>37</td>
                      <td>24</td>
                      <td>16</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>241</td>
                    </tr>
                    <tr>
                      <td >&nbsp;</td>
                      <td>CUT QTY</td>
                      <td>20/Feb/20</td>
                      <td>P 3</td>
                      <td>SEA</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>0</td>
                    </tr>
                    <tr>
                      <td >&nbsp;</td>
                      <td>DISPACTHED    QTY</td>
                      <td>20/Feb/20</td>
                      <td>P 3</td>
                      <td>SEA</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>0</td>
                    </tr>
                    <tr>
                      <td >&nbsp;</td>
                      <td>BAL QTY TO CUT</td>
                      <td>20/Feb/20</td>
                      <td>P 3</td>
                      <td>SEA</td>
                      <td>25</td>
                      <td>80</td>
                      <td>59</td>
                      <td>37</td>
                      <td>24</td>
                      <td>16</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>241</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>BAL TO DISPATCH</td>
                      <td>20/Feb/20</td>
                      <td>P 3</td>
                      <td>SEA</td>
                      <td>25</td>
                      <td>80</td>
                      <td>59</td>
                      <td>37</td>
                      <td>24</td>
                      <td>16</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>241</td>
                    </tr>
                  </table>
				</div>
				
				<div class="card">
				  <table cellspacing="0" cellpadding="0" class="table table-responsive" style="border:1px solid #ccc;">
                    <tr style="background-color: #fff9ce;font-weight:500;">
                      <td colspan="18" rowspan="2" height="42" width="1939">SUMMARY</td>
                    </tr>
                    <tr></tr>
                    <tr style="background-color: #eafdff; font-weight:500;">
                      <td colspan="9" >REGULAR SIZES</td>
                      <td colspan="4">TALL SIZES</td>
                      <td colspan="4">PETITE SIZES</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr >
                      <td >COLOR- HULLA    RED</td>
                      <td>XS</td>
                      <td>S</td>
                      <td>M</td>
                      <td>L</td>
                      <td>XL</td>
                      <td>XXL</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>TOTAL</td>
                    </tr>
                    <tr >
                      <td >ORDER QTY</td>
                      <td>492</td>
                      <td>1310</td>
                      <td>740</td>
                      <td>368</td>
                      <td>266</td>
                      <td>243</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>3419</td>
                    </tr>
                    <tr >
                      <td >CUT QTY</td>
                      <td>107</td>
                      <td>450</td>
                      <td>250</td>
                      <td>250</td>
                      <td>250</td>
                      <td>160</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>1467</td>
                    </tr>
                    <tr >
                      <td >DISPATCH QTY</td>
                      <td>100</td>
                      <td>200</td>
                      <td>370</td>
                      <td>370</td>
                      <td>250</td>
                      <td>220</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>1510</td>
                    </tr>
                    <tr >
                      <td >BAL QTY TO CUT</td>
                      <td>385</td>
                      <td>860</td>
                      <td>490</td>
                      <td>118</td>
                      <td>16</td>
                      <td>83</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>1952</td>
                    </tr>
                    <tr >
                      <td >BAL TO DISPATCH</td>
                      <td>392</td>
                      <td>1110</td>
                      <td>370</td>
                      <td>-2</td>
                      <td>16</td>
                      <td>23</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>1909</td>
                    </tr>
                  </table>
				</div>
				</div></div>

					 

					
		  </div>
				<!-- /dashboard content -->

  </div>
			<!-- /content area -->


			<!-- Footer -->
			 
			<!-- /footer -->

</div>
		<!-- /main content -->

	</div>
 
 <style>
 .liststyleimg{float: left;
    width: 70px;
    margin-right: 15px;
    padding: 5px;
    border: 2px solid #e6e6e6;}
	
	.badge.dropdown-toggle:after { display:none;
}
 </style>
 
<script>
$('#DataTables_Table_2').DataTable( {
"order": [[ 0, "desc" ]]
} );
</script> 

<style>
.dataTables_filter {
    margin-top: 15px;
}
.dataTables_length {
    margin-top: 15px;
	margin-right:18px;
}
.dataTables_filter input {
    margin-left:10px;
}
.dataTables_info {
    margin-top: 15px;
    margin-left: 18px !important;
}
.dataTables_paginate {
    margin-top: 15px;
    margin-right: 18px;
}
table tr td{
border:1px solid #ccc !important;
}
</style> 
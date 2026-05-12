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

/*$where='addedBy='.$_SESSION['userid'].''; 
deleteRecord('projectionPlanMaster',$where);

$namevalueadd = 'addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'"';
addlistinggetlastid('projectionPlanMaster',$namevalueadd);*/

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
				
				<div class="card" style="width: 100%; overflow-x: scroll;">
				  <table border="2" class="table table-responsive">
                    <tr  style="font-weight:500; font-size:14px;">
                      <td colspan="22"  ><a name="RANGE!A1:AB19" id="RANGE!A1:AB19">UPDATED :- 24 October 2019</a></td>
                      <td colspan="7"  align="center">&nbsp;CONFIRMED ORDERS 2018-19</td>
                    </tr>
                    <tr >
                      <td rowspan="3"  class="a"><i class="icon-add" style="font-size:20px;cursor:pointer;" onclick="addNewRow(1);"></i></td>
                      <td rowspan="3"  class="a">BUYER</td>
                      <td colspan="6" class="b">QUARTER 1</td>
                      <td colspan="6" class="c">QUARTER 2</td>
                      <td colspan="6" class="d">QUARTER 3</td>
                      <td colspan="6" class="e">QUARTER 4</td>
                      <td colspan="3" class="f">TOTAL</td>
                    </tr>
                    <tr >
                      <td colspan="2"  class="b">APR 2019</td>
                      <td colspan="2"  class="b">MAY    2019</td>
                      <td colspan="2"  class="b">JUN    2019</td>
                      <td colspan="2" class="c">JUL    2019</td>
                      <td colspan="2" class="c">AUG    2019</td>
                      <td colspan="2" class="c">SEP    2019</td>
                      <td colspan="2" class="d">OCT    2019</td>
                      <td colspan="2" class="d">NOV    2019</td>
                      <td colspan="2" class="d">DEC    2019</td>
                      <td colspan="2" class="e">JAN    2019</td>
                      <td colspan="2" class="e">FEB    2019</td>
                      <td colspan="2" class="e">MAR    2019</td>
                      <td colspan="3" class="f">2018-19</td>
                    </tr>
                    <tr >
                      <td  class="b">QTY</td>
                      <td class="b">$</td>
                      <td class="b">QTY</td>
                      <td class="b">$</td>
                      <td class="b">QTY</td>
                      <td class="b">$</td>
                      <td class="c">QTY</td>
                      <td class="c">$</td>
                      <td class="c">QTY</td>
                      <td class="c">$</td>
                      <td class="c">QTY</td>
                      <td class="c">$</td>
                      <td class="d">QTY</td>
                      <td class="d">$</td>
                      <td class="d">QTY</td>
                      <td class="d">$</td>
                      <td class="d">QTY</td>
                      <td class="d">$</td>
                      <td class="e">QTY</td>
                      <td class="e">$</td>
                      <td class="e">QTY</td>
                      <td class="e">$</td>
                      <td class="e">QTY</td>
                      <td class="e">$</td>
                      <td class="f">QTY</td>
                      <td class="f">$</td>
                      <td class="f">Rs.&nbsp;(Cr.)</td>
                    </tr>
                    <!--<tr >
                      <td  colspan="28" style="background-color:#FFFF00; font-weight:500;">INDIA</td>
                    </tr>-->
					
					<tbody id="addrow"> 
					</tbody>

					<script>
					function addNewRow(id){
						if(id==1){
							$("#addrow").load('addprojectionline.php?add=1');
						}else{
							$("#addrow").load('addprojectionline.php');
						}
					}
					addNewRow(0); 
					</script>
					 
					
                    <tr>
                      <td rowspan="4" >&nbsp;</td>
                      <td rowspan="4" >TOTAL</td>
                      <td style="text-align: center;"><span id="aprilTotalQty"></span></td>
                      <td style="text-align: center;"><span id="aprilTotalPrice"></span></td>
                      <td style="text-align: center;"><span id="mayTotalQty"></span></td>
                      <td style="text-align: center;"><span id="mayTotalPrice"></span></td>
                      <td>70487</td>
                      <td>1201793</td>
                      <td>40068</td>
                      <td>795789</td>
                      <td>85662</td>
                      <td>1250244</td>
                      <td>65100</td>
                      <td>1221095</td>
                      <td>85000</td>
                      <td>1030000</td>
                      <td>100000</td>
                      <td>1202500</td>
                      <td>102500</td>
                      <td>1250000</td>
                      <td>152500</td>
                      <td>1985000</td>
                      <td>147000</td>
                      <td>1865000</td>
                      <td>200000</td>
                      <td>2710000</td>
                      <td rowspan="4" style="background-color:#cece9b; font-weight:500;"><div align="center">1200138</div></td>
                      <td rowspan="4" style="background-color:#e6dddd; font-weight:500;"><div align="center">$17,040,350</div></td>
                      <td rowspan="4" style="background-color:#66ea66; font-weight:500;"><div align="center">&#8377; 110.76</div></td>
                    </tr>
                    <tr >
                      <td  class="g"><div align="center">10.07</div></td>
                      <td class="g"><div align="center">CR</div></td>
                      <td class="g"><div align="center">6.36</div></td>
                      <td class="g"><div align="center">CR</div></td>
                      <td class="g"><div align="center">7.81</div></td>
                      <td class="g"><div align="center">CR</div></td>
                      <td class="g"><div align="center">5.17</div></td>
                      <td class="g"><div align="center">CR</div></td>
                      <td class="g"><div align="center">8.13</div></td>
                      <td class="g"><div align="center">CR</div></td>
                      <td class="g"><div align="center">7.94</div></td>
                      <td class="g"><div align="center">CR</div></td>
                      <td class="g"><div align="center">6.70</div></td>
                      <td class="g"><div align="center">CR</div></td>
                      <td class="g"><div align="center">7.82</div></td>
                      <td class="g"><div align="center">CR</div></td>
                      <td class="g"><div align="center">8.13</div></td>
                      <td class="g"><div align="center">CR</div></td>
                      <td class="g"><div align="center">12.90</div></td>
                      <td class="g"><div align="center">CR</div></td>
                      <td class="g"><div align="center">12.12</div></td>
                      <td class="g"><div align="center">CR</div></td>
                      <td class="g"><div align="center">17.62</div></td>
                      <td class="g"><div align="center">CR</div></td>
                    </tr>
                    <tr >
                      <td rowspan="2"  class="g"><div align="center">Q 1</div></td>
                      <td class="g"><div align="center">PLAN</div></td>
                      <td  class="g"><div align="center">QTY</div></td>
                      <td class="g"><div align="center">$</div></td>
                      <td colspan="2"  class="h"><div align="center">Rs.</div></td>
                      <td rowspan="2" class="g"><div align="center">Q 2</div></td>
                      <td class="g"><div align="center">PLAN</div></td>
                      <td  class="g"><div align="center">QTY</div></td>
                      <td class="g"><div align="center">$</div></td>
                      <td colspan="2" width="92" class="h"><div align="center">Rs.</div></td>
                      <td rowspan="2" class="g"><div align="center">Q 3</div></td>
                      <td class="g"><div align="center">PLAN</div></td>
                      <td class="g"><div align="center">QTY</div></td>
                      <td  class="g"><div align="center">$</div></td>
                      <td colspan="2" width="92" class="h"><div align="center">Rs.</div></td>
                      <td rowspan="2" class="g"><div align="center">Q 4</div></td>
                      <td class="g"><div align="center">PLAN</div></td>
                      <td class="g"><div align="center">QTY</div></td>
                      <td class="g"><div align="center">$</div></td>
                      <td colspan="2" width="92" class="h"><div align="center">Rs.</div></td>
                    </tr>
                    <tr >
                      <td  class="g"><div align="center">30</div></td>
                      <td  class="g"><div align="center">222,308</div></td>
                      <td  class="g"><div align="center">3730722</div></td>
                      <td  class="h"><div align="center">24.25</div></td>
                      <td class="h"><div align="center">CR</div></td>
                      <td class="g"><div align="center">35</div></td>
                      <td  class="g"><div align="center">190,830</div></td>
                      <td  class="g"><div align="center">3267128</div></td>
                      <td  class="h"><div align="center">21.24</div></td>
                      <td class="h"><div align="center">CR</div></td>
                      <td class="g"><div align="center" class="g">35</div></td>
                      <td  class="g"><div align="center">287,500</div></td>
                      <td  class="g"><div align="center">3482500</div></td>
                      <td class="h"><div align="center">22.64</div></td>
                      <td  class="h"><div align="center">CR</div></td>
                      <td  class="g"><div align="center">35</div></td>
                      <td  class="g"><div align="center">499,500</div></td>
                      <td  class="g"><div align="center">6560000</div></td>
                      <td  class="h"><div align="center">42.64</div></td>
                      <td  class="h"><div align="center">CR</div></td>
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
.liststyleimg{
	float: left;
    width: 70px;
    margin-right: 15px;
    padding: 5px;
    border: 2px solid #e6e6e6;}
	
.badge.dropdown-toggle:after { display:none;
}
.a{
background-color:#CCCCCC;
font-weight: 500;
text-align:center;
}
.b{
background-color:#d3f7f7;
font-weight: 500;
text-align:center;
}
.c{
background-color:#f7d3d6;
font-weight: 500;
text-align:center;
}
.d{
background-color:#c3b086;
font-weight: 500;
text-align:center;
}
.e{
background-color:#68dcdc;
font-weight: 500;
text-align:center;
}
.f{
background-color:#c7d882;
font-weight: 500;
text-align:center;
}
.g{
background-color:#ecefe3;
}
.h{
background-color:#f3d6aa;
}
.table tr{
border-color: black !important;
}
.table td{
border-color: black !important;
}
</style>
 
<script>
$('#DataTables_Table_2').DataTable( {
"order": [[ 0, "desc" ]]
} );
</script> 


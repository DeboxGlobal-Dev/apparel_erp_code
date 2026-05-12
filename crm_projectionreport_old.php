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
				
				<div class="card" style="width: 100%; overflow-x: scroll;">
				  <table cellspacing="5" cellpadding="2" border="2">
                    <tr height="25" style=" font-weight:500; font-size:14px;">
                      <td colspan="8" height="25" width="373"><a name="RANGE!A1:AB19" id="RANGE!A1:AB19">MODELAMA EXPORTS PVT. LTD.</a></td>
                      <td colspan="5" width="230" align="center">US DIVISON</td>
                      <td colspan="4" width="187" align="center">UPDATED :-</td>
                      <td colspan="4" width="184" align="center">24 October 2019</td>
                      <td colspan="7" width="325" align="center">&nbsp;CONFIRMED ORDERS 2018-19</td>
                    </tr>
                    <tr height="25">
                      <td rowspan="3" height="75" width="69" class="a">BUYER</td>
                      <td colspan="6" class="b">QUARTER 1</td>
                      <td colspan="6" class="c">QUARTER 2</td>
                      <td colspan="6" class="d">QUARTER 3</td>
                      <td colspan="6" class="e">QUARTER 4</td>
                      <td colspan="3" class="f">TOTAL</td>
                    </tr>
                    <tr height="25">
                      <td colspan="2" height="25" width="86" class="b">APR 2018</td>
                      <td colspan="2" width="95" class="b">MAY    2018</td>
                      <td colspan="2" width="86" class="b">JUN    2018</td>
                      <td colspan="2" width="80" class="c">JUL    2018</td>
                      <td colspan="2" width="95" class="c">AUG    2018</td>
                      <td colspan="2" width="92" class="c">SEP    2018</td>
                      <td colspan="2" width="92" class="d">OCT    2018</td>
                      <td colspan="2" width="95" class="d">NOV    2018</td>
                      <td colspan="2" width="92" class="d">DEC    2018</td>
                      <td colspan="2" width="92" class="e">JAN    2019</td>
                      <td colspan="2" width="95" class="e">FEB    2019</td>
                      <td colspan="2" width="92" class="e">MAR    2019</td>
                      <td colspan="3" class="f">2017-18</td>
                    </tr>
                    <tr height="25">
                      <td height="25" class="b">QTY</td>
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
                    <tr height="25">
                      <td height="25" colspan="28" style="background-color:#FFFF00; font-weight:500;">INDIA</td>
                    </tr>
                    <tr height="25">
                      <td height="25">INC&nbsp;</td>
                      <td><div align="center">46910</div></td>
                      <td><div align="center">459098</div></td>
                      <td><div align="center">40728</div></td>
                      <td><div align="center">399376</div></td>
                      <td><div align="center">24594</div></td>
                      <td><div align="center">224598</div></td>
                      <td><div align="center">24315</div></td>
                      <td><div align="center">253105</div></td>
                      <td><div align="center">19434</div></td>
                      <td><div align="center">228383</div></td>
                      <td><div align="center">35000</div></td>
                      <td><div align="center">353500</div></td>
                      <td><div align="center">30000</div></td>
                      <td><div align="center">300000</div></td>
                      <td><div align="center">40000</div></td>
                      <td><div align="center">400000</div></td>
                      <td><div align="center">50000</div></td>
                      <td><div align="center">500000</div></td>
                      <td><div align="center">40000</div></td>
                      <td><div align="center">400000</div></td>
                      <td><div align="center">50000</div></td>
                      <td><div align="center">500000</div></td>
                      <td><div align="center">60000</div></td>
                      <td><div align="center">600000</div></td>
                      <td><div align="center">460981</div></td>
                      <td><div align="center">4618059</div></td>
                      <td><div align="center">&#8377; 30.02</div></td>
                    </tr>
                    <tr height="25">
                      <td height="25">POLO</td>
                      <td><div align="center">12964</div></td>
                      <td><div align="center">584745</div></td>
                      <td><div align="center">17738</div></td>
                      <td><div align="center">463522</div></td>
                      <td><div align="center">23845</div></td>
                      <td><div align="center">658243</div></td>
                      <td><div align="center">8989</div></td>
                      <td><div align="center">351542</div></td>
                      <td><div align="center">3399</div></td>
                      <td><div align="center">79877</div></td>
                      <td><div align="center">9200</div></td>
                      <td><div align="center">487445</div></td>
                      <td><div align="center">15000</div></td>
                      <td><div align="center">330000</div></td>
                      <td><div align="center">15000</div></td>
                      <td><div align="center">330000</div></td>
                      <td><div align="center">15000</div></td>
                      <td><div align="center">330000</div></td>
                      <td><div align="center">40000</div></td>
                      <td><div align="center">880000</div></td>
                      <td><div align="center">40000</div></td>
                      <td><div align="center">880000</div></td>
                      <td><div align="center">40000</div></td>
                      <td><div align="center">880000</div></td>
                      <td><div align="center">241135</div></td>
                      <td><div align="center">6255373</div></td>
                      <td><div align="center">&#8377; 40.66</div></td>
                    </tr>
                    <tr height="25">
                      <td height="25">CHICO'S</td>
                      <td><div align="center">18774</div></td>
                      <td><div align="center">327779</div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center">21449</div></td>
                      <td><div align="center">308470</div></td>
                      <td><div align="center">6575</div></td>
                      <td><div align="center">173054</div></td>
                      <td><div align="center">2598</div></td>
                      <td><div align="center">38840</div></td>
                      <td><div align="center">900</div></td>
                      <td><div align="center">30150</div></td>
                      <td><div align="center">15000</div></td>
                      <td><div align="center">225000</div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center">15000</div></td>
                      <td><div align="center">225000</div></td>
                      <td><div align="center">20000</div></td>
                      <td><div align="center">300000</div></td>
                      <td><div align="center">7000</div></td>
                      <td><div align="center">105000</div></td>
                      <td><div align="center">50000</div></td>
                      <td><div align="center">850000</div></td>
                      <td><div align="center">157296</div></td>
                      <td><div align="center">2583293</div></td>
                      <td><div align="center">&#8377; 16.79</div></td>
                    </tr>
                    <tr height="25">
                      <td height="25">LAUREN</td>
                      <td><div align="center">11463</div></td>
                      <td><div align="center">178242</div></td>
                      <td><div align="center">3244</div></td>
                      <td><div align="center">116168</div></td>
                      <td><div align="center">599</div></td>
                      <td><div align="center">10483</div></td>
                      <td><div align="center">89</div></td>
                      <td><div align="center">9523</div></td>
                      <td><div align="center">1505</div></td>
                      <td><div align="center">30100</div></td>
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
                      <td><div align="center">10000</div></td>
                      <td><div align="center">100000</div></td>
                      <td><div align="center">10000</div></td>
                      <td><div align="center">100000</div></td>
                      <td><div align="center">36900</div></td>
                      <td><div align="center">544516</div></td>
                      <td><div align="center">&#8377; 3.54</div></td>
                    </tr>
                    <tr height="25">
                      <td height="25">CHAPS</td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center">26488</div></td>
                      <td><div align="center">181484</div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center">15000</div></td>
                      <td><div align="center">105000</div></td>
                      <td><div align="center">15000</div></td>
                      <td><div align="center">105000</div></td>
                      <td><div align="center">10000</div></td>
                      <td><div align="center">70000</div></td>
                      <td><div align="center">25000</div></td>
                      <td><div align="center">175000</div></td>
                      <td><div align="center">20000</div></td>
                      <td><div align="center">140000</div></td>
                      <td><div align="center">20000</div></td>
                      <td><div align="center">140000</div></td>
                      <td><div align="center">131488</div></td>
                      <td><div align="center">916484</div></td>
                      <td><div align="center">&#8377; 5.96</div></td>
                    </tr>
                    <tr height="25">
                      <td height="25">FRYE</td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center">100</div></td>
                      <td><div align="center">8565</div></td>
                      <td><div align="center">1061</div></td>
                      <td><div align="center">39579</div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center">2500</div></td>
                      <td><div align="center">55000</div></td>
                      <td><div align="center">2500</div></td>
                      <td><div align="center">55000</div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center">6161</div></td>
                      <td><div align="center">158144</div></td>
                      <td><div align="center">&#8377; 1.03</div></td>
                    </tr>
                    <tr height="25">
                      <td height="25">W'LAND</td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center">31177</div></td>
                      <td><div align="center">651982</div></td>
                      <td><div align="center">20000</div></td>
                      <td><div align="center">350000</div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center">15000</div></td>
                      <td><div align="center">262500</div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center">66177</div></td>
                      <td><div align="center">1264482</div></td>
                      <td><div align="center">&#8377; 8.22</div></td>
                    </tr>
                    <tr height="25">
                      <td height="25">POLO B/G</td>
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
                      <td><div align="center">10000</div></td>
                      <td><div align="center">70000</div></td>
                      <td><div align="center">15000</div></td>
                      <td><div align="center">105000</div></td>
                      <td><div align="center">10000</div></td>
                      <td><div align="center">70000</div></td>
                      <td><div align="center">25000</div></td>
                      <td><div align="center">175000</div></td>
                      <td><div align="center">20000</div></td>
                      <td><div align="center">140000</div></td>
                      <td><div align="center">20000</div></td>
                      <td><div align="center">140000</div></td>
                      <td><div align="center">100000</div></td>
                      <td><div align="center">700000</div></td>
                      <td><div align="center">&#8377; 4.55</div></td>
                    </tr>
                    <tr height="25">
                      <td height="25">&nbsp;</td>
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
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center">0</div></td>
                      <td><div align="center">0</div></td>
                      <td><div align="center">&#8377; 0.00</div></td>
                    </tr>
                    <tr height="25">
                      <td height="25">&nbsp;</td>
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
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center">0</div></td>
                      <td><div align="center">0</div></td>
                      <td><div align="center">&#8377; 0.00</div></td>
                    </tr>
                    <tr height="25">
                      <td rowspan="4" height="100" width="69">TOTAL INDIA</td>
                      <td>90111</td>
                      <td>1549864</td>
                      <td>61710</td>
                      <td>979065</td>
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
                    <tr height="25">
                      <td height="25" class="g"><div align="center">10.07</div></td>
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
                    <tr height="25">
                      <td rowspan="2" height="50" class="g"><div align="center">Q 1</div></td>
                      <td class="g"><div align="center">PLAN</div></td>
                      <td width="46" class="g"><div align="center">QTY</div></td>
                      <td width="49" class="g"><div align="center">$</div></td>
                      <td colspan="2" width="86" class="h"><div align="center">Rs.</div></td>
                      <td rowspan="2" class="g"><div align="center">Q 2</div></td>
                      <td class="g"><div align="center">PLAN</div></td>
                      <td width="46" class="g"><div align="center">QTY</div></td>
                      <td width="49" class="g"><div align="center">$</div></td>
                      <td colspan="2" width="92" class="h"><div align="center">Rs.</div></td>
                      <td rowspan="2" class="g"><div align="center">Q 3</div></td>
                      <td class="g"><div align="center">PLAN</div></td>
                      <td width="46" class="g"><div align="center">QTY</div></td>
                      <td width="49" class="g"><div align="center">$</div></td>
                      <td colspan="2" width="92" class="h"><div align="center">Rs.</div></td>
                      <td rowspan="2" class="g"><div align="center">Q 4</div></td>
                      <td class="g"><div align="center">PLAN</div></td>
                      <td width="46" class="g"><div align="center">QTY</div></td>
                      <td width="49" class="g"><div align="center">$</div></td>
                      <td colspan="2" width="92" class="h"><div align="center">Rs.</div></td>
                    </tr>
                    <tr height="25">
                      <td height="25" class="g"><div align="center">30</div></td>
                      <td width="46" class="g"><div align="center">222,308</div></td>
                      <td width="49" class="g"><div align="center">3730722</div></td>
                      <td width="37" class="h"><div align="center">24.25</div></td>
                      <td width="49" class="h"><div align="center">CR</div></td>
                      <td class="g"><div align="center">35</div></td>
                      <td width="46" class="g"><div align="center">190,830</div></td>
                      <td width="49" class="g"><div align="center">3267128</div></td>
                      <td width="43" class="h"><div align="center">21.24</div></td>
                      <td width="49" class="h"><div align="center">CR</div></td>
                      <td class="g"><div align="center" class="g">35</div></td>
                      <td width="46" class="g"><div align="center">287,500</div></td>
                      <td width="49" class="g"><div align="center">3482500</div></td>
                      <td width="43" class="h"><div align="center">22.64</div></td>
                      <td width="49" class="h"><div align="center">CR</div></td>
                      <td  class="g"><div align="center">35</div></td>
                      <td width="46" class="g"><div align="center">499,500</div></td>
                      <td width="49" class="g"><div align="center">6560000</div></td>
                      <td width="43" class="h"><div align="center">42.64</div></td>
                      <td width="49" class="h"><div align="center">CR</div></td>
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
</style>
 
<script>
$('#DataTables_Table_2').DataTable( {
"order": [[ 0, "desc" ]]
} );
</script> 


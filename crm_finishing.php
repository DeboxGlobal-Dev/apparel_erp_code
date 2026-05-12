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
            <div class="col-xl-9">
              <h5 class="card-title"><?php echo $pageName; ?></h5>
            </div>
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
                <td rowspan="2" height="42">MARKET</td>
                <td rowspan="2">PO NO./ORDER QTY</td>
                <td rowspan="2">SHIP CNXL</td>
                <td rowspan="2">PRIORITY</td>
                <td rowspan="2">SHIP MODE&nbsp;</td>
                <td colspan="17">&nbsp;</td>
              </tr>
              <tr style="background-color: #e5fbfa; color: #000;">
                <td >XXXS&nbsp;</td>
                <td>XXS</td>
                <td>XS</td>
                <td>S</td>
                <td>M</td>
                <td>L</td>
                <td>XL</td>
                <td>XXL</td>
                <td>S/T</td>
                <td>M/T</td>
                <td>L/T</td>
                <td>XL/T</td>
                <td>XS/P</td>
                <td>S/P</td>
                <td>M/P</td>
                <td>L/P</td>
                <td>TOTAL</td>
              </tr>
              <tr >
                <td >&nbsp;</td>
                <td>AB20CDA</td>
                <td>14/Feb/20</td>
                <td>P 1</td>
                <td>SEA</td>
                <td>151</td>
                <td>411</td>
                <td>216</td>
                <td>216</td>
                <td>80</td>
                <td>80</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>1154</td>
              </tr>
              <tr >
                <td >&nbsp;</td>
                <td>STITCHING RECEIVED</td>
                <td>14/Feb/20</td>
                <td>P 1</td>
                <td>SEA</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>32</td>
              </tr>
              <tr >
                <td >&nbsp;</td>
                <td width="164">FINISHED    QTY</td>
                <td>14/Feb/20</td>
                <td>P 1</td>
                <td>SEA</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>16</td>
              </tr>
              <tr >
                <td >&nbsp;</td>
                <td width="164">REJECTED    QTY</td>
                <td>14/Feb/20</td>
                <td>P 1</td>
                <td>SEA</td>
                <td>1</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>1</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr >
                <td >&nbsp;</td>
                <td>BAL QTY</td>
                <td>14/Feb/20</td>
                <td>P 1</td>
                <td>SEA</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>16</td>
              </tr>
              <tr >
                <td >&nbsp;</td>
                <td>1234567</td>
                <td>20/Feb/20</td>
                <td>P 1</td>
                <td>SEA</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>32</td>
              </tr>
              <tr >
                <td >&nbsp;</td>
                <td>STITCHING RECEIVED</td>
                <td>20/Feb/20</td>
                <td>P 1</td>
                <td>SEA</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>32</td>
              </tr>
              <tr >
                <td >&nbsp;</td>
                <td>FINISHED QTY</td>
                <td>20/Feb/20</td>
                <td>P 1</td>
                <td>SEA</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>16</td>
              </tr>
              <tr >
                <td >&nbsp;</td>
                <td width="164">REJECTED    QTY</td>
                <td>20/Feb/20</td>
                <td>P 1</td>
                <td>SEA</td>
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
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr >
                <td >&nbsp;</td>
                <td>BAL QTY</td>
                <td>20/Feb/20</td>
                <td>P 1</td>
                <td>SEA</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>16</td>
              </tr>
              <tr >
                <td >&nbsp;</td>
                <td>BC20CDA</td>
                <td>2/20/2020</td>
                <td>P 2</td>
                <td>SEA</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>32</td>
              </tr>
              <tr >
                <td >&nbsp;</td>
                <td>STITCHING RECEIVED</td>
                <td>2/20/2020</td>
                <td>P 2</td>
                <td>SEA</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>32</td>
              </tr>
              <tr >
                <td >&nbsp;</td>
                <td>FINISHED QTY</td>
                <td>2/20/2020</td>
                <td>P 2</td>
                <td>SEA</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>16</td>
              </tr>
              <tr >
                <td >&nbsp;</td>
                <td>REJECTED QTY</td>
                <td>2/20/2020</td>
                <td>P 2</td>
                <td>SEA</td>
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
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr >
                <td >&nbsp;</td>
                <td>BAL QTY</td>
                <td>2/20/2020</td>
                <td>P 2</td>
                <td>SEA</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>16</td>
              </tr>
              <tr >
                <td >&nbsp;</td>
                <td>CD18EFA</td>
                <td>2/20/2020</td>
                <td>P 2</td>
                <td>SEA</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>32</td>
              </tr>
              <tr >
                <td >&nbsp;</td>
                <td>STITCHING RECEIVED</td>
                <td>2/20/2020</td>
                <td>P 2</td>
                <td>SEA</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>32</td>
              </tr>
              <tr >
                <td >&nbsp;</td>
                <td>FINISHED QTY</td>
                <td>2/20/2020</td>
                <td>P 2</td>
                <td>SEA</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>16</td>
              </tr>
              <tr >
                <td >&nbsp;</td>
                <td>REJECTED QTY</td>
                <td>2/20/2020</td>
                <td>P 2</td>
                <td>SEA</td>
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
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr >
                <td >&nbsp;</td>
                <td>BAL QTY</td>
                <td>2/20/2020</td>
                <td>P 2</td>
                <td>SEA</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>16</td>
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
                <td>COLOR-&nbsp;HULLA&nbsp;RED</td>
                <td>XXXS&nbsp;</td>
                <td width="120">XXS</td>
                <td width="136">XS</td>
                <td width="131">S</td>
                <td width="88">M</td>
                <td width="81">L</td>
                <td width="72">XL</td>
                <td width="72">XXL</td>
                <td width="72">S/T</td>
                <td width="72">M/T</td>
                <td width="72">L/T</td>
                <td width="72">XL/T</td>
                <td width="72">XS/P</td>
                <td width="72">S/P</td>
                <td width="72">M/P</td>
                <td width="60">L/P</td>
                <td width="91">TOTAL</td>
              </tr>
              <tr >
                <td >ORDER QTY</td>
                <td>157</td>
                <td>417</td>
                <td>222</td>
                <td>222</td>
                <td>86</td>
                <td>86</td>
                <td>6</td>
                <td>6</td>
                <td>6</td>
                <td>6</td>
                <td>6</td>
                <td>6</td>
                <td>6</td>
                <td>6</td>
                <td>6</td>
                <td>6</td>
                <td>1256</td>
              </tr>
              <tr >
                <td >STITCHING    RECEIVED</td>
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
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr >
                <td >STITCH Q'nty</td>
                <td>4</td>
                <td>4</td>
                <td>4</td>
                <td>4</td>
                <td>4</td>
                <td>4</td>
                <td>4</td>
                <td>4</td>
                <td>4</td>
                <td>4</td>
                <td>4</td>
                <td>4</td>
                <td>4</td>
                <td>4</td>
                <td>4</td>
                <td>4</td>
                <td>64</td>
              </tr>
              <tr >
                <td >REJECTED QTY</td>
                <td>1</td>
                <td>0</td>
                <td>0</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>0</td>
                <td>0</td>
                <td>1</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
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

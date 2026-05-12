<?php
 if($loginuserprofileId==1){

$wheresearchassign=' 1 and ';

} else {

$wheresearchassign=' ( assignTo in (select id from '._USER_MASTER_.' where  empId in (select id from employeeMaster where id ='.$_SESSION['empid'].')) or assignTo in (select id from '._USER_MASTER_.' where  empId in (select reportingTo from employeeMaster where id="'.$_SESSION['empid'].'"))) ';

//$wheresearchassign=' '.$wheresearchassign.' and ';
$wheresearchassign=' 1 and ';
}?>

<div class="page-content">
  <style>
.even{
background-color: #0097a71a;
}
.iconlistset {
width: 34px;
background-color: #000099;
padding: 5px 5px;
overflow: hidden;
float: left;
border-radius: 50px;
height: 34px;
margin: 0px 3px;
cursor: pointer;
}
.iconlistset img {
width: 16px;
margin-top: 6px;
mage-rendering: auto;
image-rendering: crisp-edges;
image-rendering: pixelated;
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
            <div class="col-xl-9">
              <h5 class="card-title"><?php echo $pageName; ?></h5>
            </div>
            <div class="col-xl-3" style="    padding-right: 0px;">
              <div class="btn-group justify-content-center" style="float:right;">
              </div>
            </div>
          </div>
          <div class="card">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
              <div class="datatable-scroll">
                <table class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
                  <thead style="background-color: #f5f5f5;">
                    <tr role="row">
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Invoice&nbsp;Number</th>
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style</th>
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Buyer</th>
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">PO&nbsp;Number</th>
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Invoice&nbsp;Date </th>
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Quantity</th>
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Total&nbsp;Value</th>
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
$no=1;
$select='*';
$where='';
$rs='';
$wheresearch='';
$limit='20000';


$where='where status=1 order by id desc';
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
$rs=GetRecordList($select,'innvoiceMaster',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

$pps=GetPageRecord('*','queryMaster','1 and styleRefId="'.$resultlists['styleId'].'"');
$user=mysqli_fetch_array($pps);

?>
                    <tr role="row" class="odd">
                      <td align="left"><a href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes&id=<?php echo encode($resultlists['id']); ?>&pid=<?php echo encode($resultlists['packingId']); ?>&s=<?php echo encode($user['id']); ?>"><?php echo $resultlists['invoiceNumber']; ?></a></td>

                      <td align="left"><a href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes&id=<?php echo encode($resultlists['id']); ?>&pid=<?php echo encode($resultlists['packingId']); ?>&s=<?php echo encode($user['id']); ?>">#<?php echo $resultlists['styleId']; ?></a></td>
                      <td align="left"><?php echo getBuyerName($user['buyerId']); ?></td>
                      <td align="left"><?php echo $resultlists['buyerpo']; ?></td>
                      <td align="left"><?php echo date('d-m-Y',$resultlists['dateAdded']) ?></td>
                      <td align="left">
                        <?php
$rrp=GetPageRecord('SUM(totalqty) as totalquantity','loadpackinglistmaster','parentId="'.$user['id'].'"');
            $operation2=mysqli_fetch_array($rrp);
            echo $operation2['totalquantity'];
?>
                      </td>
                      <td align="left">
                       <?php echo $resultlists['totalamoun']; ?>

                      </td>

                      <td style="" align="center"><?php if($resultlists['invoiceNumber']!=""){ ?>
                        <div style="width:162px;">
                          <!-- <div class="iconlistset" style="background-color:#ff9614;"><img src="images/emailiconsmall.png"></div> -->

                          <a href="tcpdf/examples/generateinvoice.php?pageurl=<?php echo $fullurl; ?>invoice.php?s=<?php echo encode($resultlists['id']); ?>" target="_blank">
                          <div class="iconlistset" style="background-color:#4493cc;"><img src="images/printicon.png"></div>
                          </a>

                          <a href="tcpdf/examples/generateinvoice.php?pageurl=<?php echo $fullurl; ?>invoice.php?s=<?php echo encode($resultlists['id']); ?>" target="_blank">
                          <div class="iconlistset" style="background-color:#5bbd1e;"><img src="images/downloadicon.png" style="margin-top:4px;"></div>
                          </a>

                          <!-- <a href="#">
                          <div class="iconlistset" style="background-color:#5bbd1e; color:#fff; font-size:25px;"><i class="fa fa-whatsapp" style="font-size:22px;"></i></div>
                          </a>  -->
                        </div>
                        <?php } ?>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
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

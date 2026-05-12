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
<?php
$styleId=$_GET['styleId'];
$materialType=$_GET['materialtype'];
?>

<div class="page-content">
  <!-- Main sidebar -->
  <div class="content-wrapper">
    <div class="content pt-0" style="margin-top:20px;">
      <div class="row">
        <div class="col-xl-12">
          <div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
            <div class="col-xl-9">
              <h5 class="card-title"><?php echo $pageName; ?></h5>
            </div>
            <div class="col-xl-1" style="padding-right: 0px;"> </div>
            <a href="download-reportsoncnf.php" class="btn bg-teal-400 addnotify" aria-expanded="false" style="background-color: #03d873b8;">Download Excel</a>
          </div>
          <div class="card" style="padding-bottom:40px;">
            <div class="row" style="margin-top:20px;">
              <div class="col-md-12" style=" padding:0px 25px;">
                <form action="" method="GET">

                 <!-- <div class="row">-->
                 <!--<div class="col-md-2">-->
                 <!--     <div class="form-group">-->
                 <!--       <input type="text" placeholder="Search:" name="filtersearch" id="filtersearch" style="margin-left: 0px; width: 190px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;"/>-->
                 <!--     </div>-->
                 <!--   </div>-->
                 <!--   <div class="col-md-2">-->
                 <!--     <div class="form-group">-->
                 <!--       <select name="styleId" class="form-control">-->
                 <!--         <option value="">Select Style</option>-->
                          <?php
$qqq=GetPageRecord('*','queryMaster','1 and subject!="" and sampleStyle=1 and deletestatus=0 order by id desc');
while($quarData2=mysqli_fetch_array($qqq)){
?>
                          <!--<option value="<?php echo $quarData2['id']; ?>" <?php if($quarData2['id'] == $styleId){ echo "selected"; } ?>>#<?php echo $quarData2['styleRefId']; ?></option>-->
                          <?php } ?>
                  <!--      </select>-->
                  <!--    </div>-->
                  <!--  </div>-->

                  <!--  <div class="col-md-2">-->
                  <!--    <div class="form-group">-->
                  <!--      <select name="materialtype" class="form-control">-->
                  <!--        <option value="">Select Material Type</option>-->
                  <!--        <option value="1" <?php if($materialType == 1){ echo "selected"; } ?>>Fabric</option>-->
                  <!--        <option value="2" <?php if($materialType == 2){ echo "selected"; } ?>>Trims</option>-->
                  <!--        <option value="3" <?php if($materialType == 3){ echo "selected"; } ?>>Packaging</option>-->
                  <!--      </select>-->
                  <!--    </div>-->
                  <!--  </div>-->

                  <!--  <div class="col-md-2">-->
                  <!--    <div class="form-group">-->
                  <!--      <input name="" type="submit" id="" class=" btn btn-primary" value="Search" />-->
                  <!--      <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />-->
                  <!--    </div>-->
                  <!--  </div>-->
                  <!--</div>-->
                </form>
              </div>
            </div>
            <div style="padding:0px 15px;">
            <table class="table table-bordered table-responsive capacity-class" style="width:100%;">
            <thead>
                <tr style="background-color: #e9fff8;">



                  <th><div align="center">Buyer</div></th>
                  <th><div align="center">Brand</div></th>

                  <th><div align="center">Season</div></th>


                  <th><div align="center">Style</div></th>

                  <th><div align="center">Quantity </div></th>
				  <th><div align="center">Price&nbsp;(FOB)  </div></th>
				  <th><div align="center">PO&nbsp;Number </div></th>
				   <th><div align="center">PO&nbsp;Quantity </div></th>

				    <th><div align="center">Quantity&nbsp;To&nbsp;Be&nbsp;Aired&nbsp;With&nbsp;UOM </div></th>

				   <th><div align="center">Original&nbsp;Ex-Factory </div></th>
				    <th><div align="center">Revised&nbsp;Ex-Factory </div></th>
					 <th><div align="center">Original&nbsp;Mode </div></th>
                  <th><div align="center">Revised&nbsp;Mode </div></th>
                  <th><div align="center">Delivery&nbsp;Term </div></th>

                              </tr>
              </thead>
<?php

$queryDataqa=GetPageRecord('*','airFreightMaster','1 and statusFinal="2"');
while($queryDataa=mysqli_fetch_array($queryDataqa)){


$queryDataq=GetPageRecord('*','queryMaster','1 and id="'.$queryDataa['styleId'].'"');
$queryData=mysqli_fetch_array($queryDataq);

 $queryDa=GetPageRecord('*','poManageMaster','1 and styleId="'.$queryData['id'].'" and poNumber="'.$queryDataa['buyerPo'].'"');
$quer=mysqli_fetch_array($queryDa);


 $queryDataqddd=GetPageRecord('*','seasonMaster','1 and id="'.$queryData['seasonId'].'"');
$queryDataddd=mysqli_fetch_array($queryDataqddd);


?>
            <tbody id="allhotellisting">
                <tr>


                  <td><div align="center"><?php echo getBuyerName($queryData['buyerId']); ?></div></td>
                  <td><div align="center"><?php echo getbrandName($queryData['brandId']); ?></div></td>



                  <td><div align=""><?php echo $queryDataddd['name'] ?></div></td>





                  <td><div align="center"><?php echo '#'.$queryData['styleRefId']; ?></div></td>

                  <td><div align="center">
                    <?php echo $queryData['orderQty'];   ?></div></td>


                  <td><div align="center"><?php echo $queryDataa['invoiceVal'];  ?></div></td>
                  <td><div align="center"><?php echo $queryDataa['buyerPo']  ?></div></td>






                 <td><?php echo $quer['poQty']; ?></td>
                 <td><?php echo $queryDataa['qtyuom']; ?></td>
                 <td><?php echo $queryDataa['orgfact']; ?></td>

                 <td><?php echo $queryDataa['factDate']; ?></td>
                 <td><?php echo $quer['shipMode']; ?></td>
                 <td>Air</td>
				  <td><?php if($queryDataa['shipTerm']=="1"){ echo "FOB";}elseif($queryDataa['shipTerm']=="2"){ echo "CIF"; }elseif($queryDataa['shipTerm']=="3"){ echo "CFR"; }  ?></td>
                </tr>
                </tbody>

                <?php
                 }
                ?>
              </table>

              <!-- <code -->
                <div class="pagingdiv" style="width: 97%;margin: 20px auto;">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tbody>
                        <tr>
                          <td align="right"><div class="pagingnumbers"><?php echo $paging; ?></div></td>
                        </tr>
                      </tbody>
                    </table>
              </div>
                <!-- code -->
            </div>




          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Main sidebar -->
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
<script>
$(document).ready(function(){
$("#filtersearch").on("keyup", function() {
var value = $(this).val().toLowerCase();
$("#allhotellisting tr").filter(function() {
$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
});
});
});
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
table tr th,td{
border:1px solid #ccc !important;
}
</style>

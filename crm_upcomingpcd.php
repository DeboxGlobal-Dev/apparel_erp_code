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
$supplierId=$_GET['supplierId'];
$materialId=$_GET['materialId'];
$podate = $_GET['podate'];

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

            <a href="download-upcomingpcd.php" class="btn bg-teal-400 addnotify" aria-expanded="false" style="background-color: #03d873b8;">Download Excel</a>

          </div>

          <div class="card" style="padding-bottom:40px;">

            <div class="row" style="margin-top:20px;">

              <div class="col-md-12" style=" padding:0px 25px;">

                <form action="" method="GET">



                  <div class="row">

                 <div class="col-md-2">

                      <div class="form-group">
                        <!-- <label style="visibility: hidden;">Search</label> -->

                        <input type="text" placeholder="Search:" name="filtersearch" id="filtersearch" style="margin-left: 0px; width: 190px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;"/>

                      </div>

                    </div>

                    <div class="col-md-2">

                      <div class="form-group">
<!--                         <label style="visibility: hidden;">Style</label> -->

                        <select name="styleId" class="form-control">

                          <option value="">Select Style</option>

                          <?php

$qqq=GetPageRecord('*','queryMaster','1 and subject!="" and sampleStyle=1 and deletestatus=0 order by id desc');

while($quarData2=mysqli_fetch_array($qqq)){

?>

                          <option value="<?php echo $quarData2['id']; ?>" <?php if($quarData2['id'] == $styleId){ echo "selected"; } ?>>#<?php echo $quarData2['styleRefId']; ?></option>

                          <?php } ?>

                        </select>

                      </div>

                    </div>


                    <div class="col-md-2">

                      <div class="form-group">
                        <!-- <label style="visibility: hidden;">Submit</label> -->

                        <input name="" type="submit" id="" class="form-control btn btn-primary" value="Search" />

                        <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />

                      </div>

                    </div>

                  </div>

                </form>

              </div>

            </div>

            <div style="padding:0px 15px;">

            <table class="table table-bordered capacity-class" style="width:100%;">

            <thead>

                <tr style="background-color: #e9fff8;">
                  <th><div align="center">Buyer</div></th>
                  <th><div align="center">Brand</div></th>
                  <th><div align="center">Style</div></th>
                  <!--<th><div align="center">Color</div></th>-->
                  <th><div align="center">Order&nbsp;Quantity</div></th>
                  <th><div align="center">Planned&nbsp;Quantity</div></th>
                  <th><div align="center">Factory</div></th>
                  <th><div align="center">Line</div></th>
                  <th><div align="center">Line&nbsp;Start&nbsp;Date</div></th>
                 <th><div align="center">Line&nbsp;End&nbsp;Date</div></th>

                  </tr>

              </thead>

<?php

$select='*';

 if($styleId!=''){

      $stylestatus = 'and styleId="'.$styleId.'"';

    }

$where='where 1 '.$stylestatus.' order by id asc ';

$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&stylerefid='.$_GET['stylerefid'].'&';


$rs=GetRecordList($select,'buyerPurchaseOrderMaster',$where,'20',$page,$targetpage);

$totalentry=$rs[1];

$paging=$rs[2];

while($resultlists=mysqli_fetch_array($rs[0])){

 $querydataq=GetPageRecord('*','queryMaster','1 and id="'.$resultlists['styleId'].'"');

        $querydata=mysqli_fetch_array($querydataq);


  if(mysql_num_rows($querydataq) > '0') {

	$kr=GetPageRecord('*','linePlanMaster','1 and styleId="'.$querydata['id'].'"');
								$lineData=mysqli_fetch_array($kr);
	$kk=GetPageRecord('*','linePlanMaster','1 and styleId="'.$querydata['id'].'" and factoryId="'.$lineData['factoryId'].'" group by lineId desc');
			while($lineDataa=mysqli_fetch_array($kk)){

			    $lo=GetPageRecord('*','factoryLineMaster','id="'.$lineDataa['lineId'].'"');
								$lineName=mysqli_fetch_array($lo);



 $rsSize=GetPageRecord('*','purchaseOrderStyleMaster','parentId="'.$purchaseOrderdata['id'].'" group by color');
          while($rsSizeList=mysqli_fetch_array($rsSize)){

$wherenew = 'styleId="'.$rsSizeList['styleId'].'" and color="'.$rsSizeList['color'].'" and parentId="'.$rsSizeList['parentId'].'"';

            $rsSizeTotal=GetPageRecord('SUM(gdQty) as totalQty','purchaseOrderStyleMaster',$wherenew);
          $rsSizeListTotal=mysqli_fetch_array($rsSizeTotal);



?>

            <tbody id="allhotellisting">

                <tr>
                  <td><div align="center"><?php echo getBuyerName($querydata['buyerId']); ?></div></td>

                  <td><div align="center"><?php echo getbrandName($querydata['brandId']); ?></div></td>

                  <td><div align="center">#<?php echo getStyleRefId($resultlists['styleId']); ?></div></td>



                  <td><div align="center"><?php echo $querydata['orderQty']; ?></div></td>

                  <?php

                  	$kks=GetPageRecord('SUM(dateWiseLineInput) as totalQtys','linePlanMaster','1 and styleId="'.$querydata['id'].'" and factoryId="'.$lineData['factoryId'].'" group by lineId desc');
			                    $lineDataas=mysqli_fetch_array($kks)
                  ?>

                  <td><div align="center"><?php echo $lineDataas['totalQtys'];  ?>   </div></td>

                  <td><div align="center">
                      <?php
                      	$km=GetPageRecord('*','factoryMaster','id="'.$lineData['factoryId'].'"');
								$factotyData=mysqli_fetch_array($km);

								echo $factotyData['name'];
								?>
                  </div></td>

                  <td><div align="center">
                                                                   <span style="padding: 5px 10px; background-color: #0097a7; color: #fff; margin-right: 2px; font-size: 12px; margin-bottom:5px;display: inline-block;"><?php echo str_replace(' ','&nbsp;',$lineName['lineName']);?></span>

                  </div></td>

                  <td><div align="center"><?php echo  $lineDataa['uploadInputDate']; ?></div></td>

                  <?php
                  $krs=GetPageRecord('*','linePlanMaster','1 and styleId="'.$querydata['id'].'" order by uploadInputDate desc');
								$lineDatas=mysqli_fetch_array($krs);
                  ?>
                <td><div align="center"><?php echo  $lineDatas['uploadInputDate']; ?></div></td>



                </tr>

                </tbody>

                <?php } } }
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


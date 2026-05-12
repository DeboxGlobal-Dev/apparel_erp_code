<?php
ob_start();
include "inc.php";
$assignto='download';
$select='*';

if($_GET['id']==''){

deleteRecord('maintenancegateentrymaster','1 and parentId=0 and gateno="" and registerno="" and potype=""');
deleteRecord('maintenancegateentrymaster','1 and supplierPurchaseOrderId!="" and qty=""');


$namevalue ='addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'"';
$gateLastId = addlistinggetlastid('maintenancegateentrymaster',$namevalue);
$gateEntryNo = 'GE-'.date('dmy').'-'.$gateLastId;
}

if($_GET['id']!=''){

$rs=GetPageRecord('*','maintenancegateentrymaster','id="'.decode($_GET['id']).'"');
$editresult=mysqli_fetch_array($rs);
$gateLastId = $editresult['id'];
$gateEntryNo = 'GE-'.date('dmy',strtotime($editresult['entrydate'])).'-'.$gateLastId;

}



?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <table class="table erptab" style="width:100%">
                   <tr style="background-color: black; color:white;">
                         <td colspan="12"><div style="text-transform:capitalize;color:white;font-size: 15px;">
                         Gate Entry

                         </div>
                         </td>
                     </tr>
                     </table>

                     	<?php

				if($_GET['id']!=""){
				 $rrrr=GetPageRecord('*','maintenancegateentrymaster','1 and id="'.decode($_GET['id']).'"');
				$operationData=mysqli_fetch_array($rrrr);
				}
				?>


				 <table class="table erptab table-hover" style="width:100%;border: 1px solid black;">
                     <tr style="border: 1px solid black;">
                         <td style="width:26%; border: 1px solid black;"><b>Gate Entry No</b></td>
                         <td style="border: 1px solid black;"> <?php echo $gateEntryNo; ?></td>
                         <td style="border: 1px solid black;"><b>Entry Date</b></td>
                         <td style="border: 1px solid black;">

                             <?php if($operationData['entrydate']!=''){ echo $operationData['entrydate']; }else{ echo date("Y-m-d"); } ?>
                         </td>


                         </tr>


                         <tr class="gap" style="border: 1px solid black;" >
                         <td class="gap" style="border: 1px solid black;"><b>Entry Time</b></td>
                         <td style="border: 1px solid black;"><?php if($operationData['entrytime']!=''){ echo $operationData['entrytime']; }else{ echo date("h:i A"); } ?></td>
                         <td><b>Gate No.</b></td>
                         <td style="border: 1px solid black;"><?php echo $operationData['gateno'] ?></td>


                        </tr>

                        <tr style="border: 1px solid black;">
                        <td style="border: 1px solid black;"><b>Register No.</b></td>
                        <td style="border: 1px solid black;"><?php echo $operationData['registerno'] ?></td>
                        <td style="width:26%;border: 1px solid black;"><b>PO Type</b></td>
                        <td style="border: 1px solid black;">
                              <?php if($operationData['potype'] == "1"){
                              echo "Procurement";
                              }
                              ?>
                              <?php if($operationData['potype'] == "2"){
                              echo "Job Work";
                              }
                              ?>
                              <?php if($operationData['potype'] == "3"){
                              echo "Service";
                              }
                              ?>

                          </td>
                     </tr>


                      <tr>

                         <td style="border: 1px solid black;"><b>PO Number</b></td>
                         <td style="border: 1px solid black;">
                         <?php
                             $rf=GetPageRecord('*','maintenancegateentrymaster','1 and parentId="'.$operationData['id'].'"');
		                   $rc=mysqli_fetch_array($rf);

		                   ?>
		                   	<?php

							$rsLi=GetPageRecord('*','requisitionIndentMaster','releasedpo="1"');
				            $queryLi=mysqli_fetch_array($rsLi);


							?>
                                 <?php
                                    $rssrt=GetPageRecord('*','loadmaintenance','1 and id="'.$queryLi['mainid'].'"');
		   $rrrrt=mysqli_fetch_array($rssrt);


				     $rssrtv=GetPageRecord('*','maintenancegi_Master','1 and id="'.$rrrrt['parentId'].'"');
		   $rrrrtv=mysqli_fetch_array($rssrtv);

                                if($rrrrtv['requisitiontype']==1) {
                                    echo 'GI-'. date('dmy',$rrrrtv['dateAdded']).'-'.$queryLi['id'];
                                }else{
                                    echo 'MN-'. date('dmy',$rrrrtv['dateAdded']).'-'.$queryLi['id'];
                                }


                                ?>

                             </td>
                         <td style="width:26%; border: 1px solid black;"><b>Supplier</b></td>
                         <td style="border: 1px solid black;">
                                       Best Dyeing Mill
                         </td>
                     </tr>





                      <tr>

                         <td style="border: 1px solid black;"><b>Bill Date</b></td>
                         <td style="border: 1px solid black;"><?php echo $operationData['billdate'] ?></td>
                         <td style="width:26%; border: 1px solid black;"><b>Bill No.</b></td>
                         <td style="border: 1px solid black;"><?php echo $operationData['billno'] ?></td>
                     </tr>
                      <tr>

                         <td style="border: 1px solid black;"><b>Vehicle In Time</b></td>
                         <td style="border: 1px solid black;"><?php echo $operationData['vehiclein'] ?></td>
                         <td style="width:26%; border: 1px solid black;"><b>Vehicle Out Time</b></td>
                         <td style="border: 1px solid black;"><?php echo $operationData['vehicleout'] ?></td>
                     </tr>
                      <tr>

                         <td style="border: 1px solid black;"><b>Driver Name</b></td>
                         <td style="border: 1px solid black;"><?php echo $operationData['drivername'] ?></td>
                         <td style="width:26%; border: 1px solid black;"><b>Driver Number</b></td>
                         <td style="border: 1px solid black;"><?php echo $operationData['drivernumber'] ?></td>
                     </tr>
                      <tr>

                         <td style="border: 1px solid black;"><b>Challan No.</b></td>
                         <td><?php echo $operationData['challanno'] ?></td>
                         <td style="width:26%; border: 1px solid black;"><b>Movement</b></td>
                         <td style="border: 1px solid black;">

                             <?php if($operationData['movement'] == "Inward") {

                            echo "Inward";
                             }?>
                              <?php if($operationData['movement'] == "Outward") {

                            echo "Inward";
                             }?>



                     </tr>
					 <tr>

                         <td style="border: 1px solid black;"><b>Factory</b></td>
                         <td>
                         <?php
							$select='';
							$where='';
							$rs='';
							$select='*';
							$where='1 and deletestatus=0 order by name asc';
							$rs=GetPageRecord($select,'factoryMaster',$where);
							$resListing=mysqli_fetch_array($rs);
							?>

                             <?php echo strip($resListing['name']); ?>

						 </td>
                         <td style="width:26%; border: 1px solid black;"><b>Vehicle No.</b></td>
                         <td style="border: 1px solid black;"><?php echo $operationData['vehicleNo'] ?></td>
                     </tr>
               </table>
               </br>
               </br>
               <div style="margin-top:100px;"></div>
    <table class="table table-bordered" style="margin-top:90px;">
    <thead style="background-color:black;">
    <tr style="background-color:black; color:white; font-size:12px; line-height:12px;">
                        <th>Material</th>
						<th>Color</th>
                        <th>PO&nbsp;Quantity</th>
                        <th>Quantity&nbsp;Received</th>
						<th>Net&nbsp;Received</th>
                        <th>UOM</th>
						<th>Rate(INR)</th>
                        <th>No.&nbsp;of&nbsp;Packages</th>
                        <th>Value(INR)</th>
                        <th>Dispatch No.</th>
      </tr>
    </thead>
    <tbody>
 <?php
$no = 1;
$wherenew='parentId="'.$gateLastId.'" order by id asc';
$rsnew=GetPageRecord('*','maintenancegateentrymaster',$wherenew);
while($rslistnew=mysqli_fetch_array($rsnew)){
?>
      <tr style="border: 1px solid black;">
        <td style="border: 1px solid black;">
  Chair
	</td>
	<td style="border: 1px solid black;">

  </td>
      <td style="border: 1px solid black;"><?php echo $rslistnew['orderQty']; ?></td>
  <td style="border: 1px solid black;"><?php echo $rslistnew['qty']; ?></td>
   <td style="border: 1px solid black;"><?php echo $rslistnew['netReceived']; ?></td>
  <td style="border: 1px solid black;"><?php echo $rslistnew['uom']; ?></td>
  <td style="border: 1px solid black;"><?php echo $rslistnew['price']; ?></td>
  <td style="border: 1px solid black;"><?php echo $rslistnew['packages']; ?></td>
  <td style="border: 1px solid black;"><?php echo $rslistnew['amount']; ?></td>
  <td style="border: 1px solid black;"><?php echo $rslistnew['dispatch']; ?></td>
      </tr>
     <?php } ?>
    </tbody>
  </table>


<?php
ob_start();
include "inc.php";
$assignto='download';
$select='*';

if($_GET['styleid']!=''){
$select='*';
$where='id="'.decode($_GET['styleid']).'"';
$rs=GetPageRecord($select,'queryMaster',$where);
$editresultstyle=mysqli_fetch_array($rs);
$buyerId = $editresultstyle['buyerId'];
$buyerStyleRefNo = $editresultstyle['buyerStyleRefNo'];
$subject = $editresultstyle['subject'];
$displayId = $editresultstyle['displayId'];
$seasonId = $editresultstyle['seasonId'];
$categoryId = $editresultstyle['categoryId'];
$subCategoryId = $editresultstyle['subCategoryId'];
$departmentId = $editresultstyle['departmentId'];
$receivedDate = $editresultstyle['receivedDate'];
$patternDescription = $editresultstyle['patternDescription'];
$patternAttachment = $editresultstyle['patternAttachment'];

$lastId=$editresultstyle['id'];

}



?>


  <?php

if($_GET['id']==''){

$namevalue ='addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'"';
$gateLast = addlistinggetlastid('maintenancegi_Master',$namevalue);
$gateLastId= mysql_insert_id();
}
if($_GET['id']!=''){

$rs=GetPageRecord('*','maintenancegi_Master','id="'.decode($_GET['id']).'"');
$editresult=mysqli_fetch_array($rs);
$gateLastId = $editresult['id'];

}

?>

              <?php
				$rrrr=GetPageRecord('*','maintenancegi_Master','1 and id="'.decode($_GET['id']).'"');
				$operationData=mysqli_fetch_array($rrrr);

				?>


 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

                        <table class="table erptab table-hover" style="width:100%">


                     <div style="margin-top:60px;"></div>
                        <tr>

                    <td style="width:26%"><div style="text-transform:capitalize; font-size:12px;"><b>Requisition No</b></div></td>

                        <td style="border: 1px solid black; font-size:12px; height:30px; line-height:30px;"><?php echo $operationData['requisitionno']; ?>

                         </td>

                 <td><div style="text-transform:capitalize;text-align:right; font-size:12px;"><b>Requested Date</b></div></td>
                        <td style="border: 1px solid black; font-size:12px; height:30px; line-height:30px;"><?php echo date('d-m-Y');?></td>

                     </tr>

                                 <div style="margin-top:60px;"></div>

              <tr>

                    <td style="width:26%"><div style="text-transform:capitalize; font-size:12px;"><b>Requisition Type</b></div></td>

                         <td style="border: 1px solid black; font-size:12px; height:30px; line-height:30px;">
                       <?php if($operationData['requisitiontype'] == "1")
                       {
                           echo "Maintenance";
                       }
                       ?>

                      <?php if($operationData['requisitiontype'] == "2")
                       {
                           echo "General Item";
                       }
                       ?>

                      </td>

                 <td><div style="text-transform:capitalize;text-align:right;font-size:12px;"><b>Requested By</b></div></td>
                         <td style="border: 1px solid black; font-size:12px; height:30px; line-height:30px;">

                              <?php

                              $fcref=GetPageRecord('*','userMaster','1 and (profileId="85" || profileId="92" || profileId="160")') ;
                              $refData=mysqli_fetch_array($fcref);
                              ?>
                              <?php echo $refData['firstName']; ?>&nbsp;<?php echo $refData['lastName']; ?>

                        </td>

                     </tr>
                    <div style="margin-top:60px;"></div>
                     <tr>


                        <td><div style="text-transform:capitalize;font-size:12px; "><b>Requested Department</b></div></td>
                         <td style="border: 1px solid black;font-size:12px; height:30px; line-height:30px;">

                             <?php

                              $fcrefd=GetPageRecord('*','departmentMaster','1 and deletestatus="0"') ;
                              $refDatad=mysqli_fetch_array($fcrefd);
                              ?>
                              <?php echo $refDatad['name']; ?>

                         </td>

                         <td><div style="text-transform:capitalize;text-align:right;font-size:12px;"><b>Requested From</b></div></td>
                         <td style="border: 1px solid black;font-size:12px; height:30px; line-height:30px;">

                      <?php

                  $fcrefdx=GetPageRecord('*','departmentMaster','1 and deletestatus="0"') ;
                              $refDatadx=mysqli_fetch_array($fcrefdx);
                              ?>
                              <?php echo $refDatadx['name']; ?>

                         <!--<input style="width:100%;" type="text" class="erpint" name="requestedfrom" id=""  value="<?php echo $operationData['requestedfrom']; ?>" >   -->
                         </td>
                     </tr>
         <div style="margin-top:60px;"></div>
          <tr>


                         <td><div style="text-transform:capitalize;font-size:12px;"><b>Due Date</b></div></td>
                         <td style="border: 1px solid black;font-size:12px; height:30px; line-height:30px;"><?php echo $operationData['duedate']; ?></td>

                      <td></td>
                      <td></td>
                     </tr>



                     </table>
                    </br>
               </br>

                <div style="margin-top:130px;"></div>

                      <table class="table table-bordered" style="margin-top:100px;">
    <thead>
      <tr style="background-color:black; color:white;font-size:10px; line-height:20px; height:20px;">
        <th>Item&nbsp;Name</th>
        <th>Size</th>
        <th>Requested&nbsp;Quantity</th>
        <th>UOM</th>
        <th>Purpose</th>
        <th>Supplier</th>
        <th>Price</th>
        <th>Amount</th>
        <th>Currency</th>
        <th>Remark</th>
      </tr>
    </thead>
    <tbody>
        <?php
if($_REQUEST['add']==1){
$namevalueadd = 'parentId="'.decode($_REQUEST['parentId']).'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'",status=1';
addlistinggetlastid('loadmaintenance',$namevalueadd);
}

if($_REQUEST['deletestatus']=="yes" && $_REQUEST['id']!=''){
deleteRecord('loadmaintenance','id="'.$_REQUEST['id'].'"');
}
$sNo2 = 0;
$select='';
$where='';
$rs='';
$select='*';
$where='parentId="'.$gateLastId.'"  and status=1  order by id asc';
$rs=GetPageRecord($select,'loadmaintenance',$where);
while($resListing1=mysqli_fetch_array($rs)){ ?>

<?php
$sNo2++;

$select='*';
$wherex='id="'.$gateLastId.'"';
$rsx=GetPageRecord($select,'maintenancegi_Master',$wherex);
$resListing1x=mysqli_fetch_array($rsx);
?>
      <tr>
        <td style="border: 1px solid black;">
        <?php
$select='*';
$where='1  order by id asc';
$rss=GetPageRecord($select,'maintenancegeneral_Master',$where);
$resListing1s=mysqli_fetch_array($rss);
?>

<?php echo $resListing1s['material']; ?> -<?php echo $resListing1s['color']; ?>

  </td>
        <td style="border: 1px solid black; font-size:12px;"><?php echo stripslashes($resListing1['size']); ?></td>
        <td style="border: 1px solid black;font-size:12px;"><?php echo stripslashes($resListing1['requestedquantity']); ?></td>
        <td style="border: 1px solid black;font-size:12px;"><?php echo stripslashes($resListing1['uom']); ?></td>
        <td style="border: 1px solid black;font-size:12px;"><?php echo stripslashes($resListing1['purpose']); ?></td>
         <td style="border: 1px solid black;font-size:12px;"> <?php
$select='*';
$wherea='1  order by id asc';
$rssa=GetPageRecord($select,'suppliersMaster',$wherea);
$resListing1sa=mysqli_fetch_array($rssa);

  ?>
  <?php echo $resListing1sa['name']; ?>
  </td>
          <td style="border: 1px solid black;font-size:12px;"><?php echo stripslashes($resListing1['price']); ?></td>
           <td style="border: 1px solid black;font-size:12px;">3500</td>
            <td style="border: 1px solid black;font-size:12px;">
            <?php if($resListing1['currency']=='1')
            {
            echo "USD";
            }
            ?>
            <?php if($resListing1['currency']=='2')
            {
            echo "INR";
            }
            ?>
            </td>
             <td style="border: 1px solid black;font-size:12px;"><?php echo stripslashes($resListing1['remark']); ?></td>
      </tr>
    <?php } ?>
 <?php if($sNo2==0){ ?>

<tr style="padding:8px;text-align: center; width: 100%;background-color: #efefef;"><td colspan="50"><div align="center">No Record Found.</div></td></tr>




<div align="center">
  <?php } ?>
    </tbody>
                     </table>
                     </div>
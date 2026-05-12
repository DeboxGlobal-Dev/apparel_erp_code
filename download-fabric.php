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
$gateLast = addlistinggetlastid('requisitionmaster',$namevalue);
$gateLastId= mysql_insert_id();
}
if($_GET['id']!=''){

$rs=GetPageRecord('*','requisitionmaster','id="'.decode($_GET['id']).'"');
$editresult=mysqli_fetch_array($rs);
$gateLastId = $editresult['id'];

}

?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<style>

</style>

     <?php
				$rrrr=GetPageRecord('*','requisitionmaster','1 and id="'.decode($_GET['id']).'"');
				$operationData=mysqli_fetch_array($rrrr);

				?>


                <table class="table  table-hover" style="width:100%">
                    <div style="margin-top:130px;"></div>
                     <tr>
                    <td style="width:18%"><div style="text-transform:capitalize;font-size:12px;"><b>Requisition No</b></div></td>
                         <td style="border: 1px solid black;font-size:12px; height:30px; line-height:30px;">
                           <?php echo 'REQ-'.date('d',$operationData['dateCreated']).date('m',$operationData['dateCreated']).date('y',$operationData['dateCreated']).'-'.$operationData['id']; ?>
                         </td>
                          <td style="width:26%"><div style="text-transform:capitalize;font-size:12px;text-align:end"><b>Requisition Date</b></div></td>
                         <td style="border: 1px solid black;font-size:12px; height:30px; line-height:30px;"><?php echo date('d-m-Y',$operationData['dateAdded']); ?></td>

                       </tr>

 <tr>
                    <td style="width:18%"><div style="text-transform:capitalize;font-size:12px;"><b>Style No</b></div></td>
                         <td style="border: 1px solid black;font-size:12px; height:30px; line-height:30px;">
                         <?php

			            	$fcref=GetPageRecord('*','queryMaster','1 and subject!="" and deletestatus=0 order by id desc');
				                    $refData=mysqli_fetch_array($fcref);
				                    ?>
                    <?php echo $refData['styleRefId']; ?>
                         </td>
                          <td style="width:26%"><div style="text-transform:capitalize;font-size:12px;text-align:end"><b>Indent No</b></div></td>
                         <td style="border: 1px solid black;font-size:12px; height:30px; line-height:30px;"> <?php echo $operationData['indentno'] ?></td>

                       </tr>



                     <tr>



                         <td style="width:18%"><div style="text-transform:capitalize;font-size:12px;"><b>Due Date</b></div></td>
                         <td style="border: 1px solid black;font-size:12px; height:30px;font-size:12px; line-height:30px;"><?php echo $operationData['duedate']; ?></td>
                          <td style="width:26%"><div style="text-transform:capitalize;font-size:12px;"><b>Order Qty</b></div></td>
                         <td style="border: 1px solid black;font-size:12px; height:30px; line-height:30px;"><?php echo $operationData['orderqty']; ?></td>

                     </tr>

          <tr>

         			<td style="width:18%"><div style="text-transform:capitalize;font-size:12px;"><b>Brand</b></div></td>
                         <td id="brandId" style="border: 1px solid black;font-size:12px; height:30px; line-height:30px;">
                   <?php echo $operationData['brandId'] ?>
                        </td>
                        <td style="width:26%"><div style="text-transform:capitalize;font-size:12px;"><b>Lot</b></div></td>
                         <td style="border: 1px solid black;font-size:12px; height:30px; line-height:30px;"><?php echo $operationData['lot']; ?></td>

                     </tr>
                     <tr>


                         <td style="width:18%"><div style="text-transform:capitalize;font-size:12px;"><b>Requested By</b></div></td>
                         <td style="border: 1px solid black;font-size:12px; height:30px; line-height:30px;">

                      <?php

                  $fcref=GetPageRecord('*','userMaster','1 and (profileId="85" || profileId="92" || profileId="160")') ;
                 $refData=mysqli_fetch_array($fcref);
                              ?>

                              <?php echo $refData['firstName']; ?>&nbsp;<?php echo $refData['lastName']; ?>

                        </td>
                        <td style="width:26%"><div style="text-transform:capitalize;font-size:12px;"><b>Department</b></div></td>
                         <td style="border: 1px solid black;font-size:12px; height:30px; line-height:30px;">
                        <?php echo $operationData['department']; ?>
                         </td>
                     </tr>

                      <tr>


                        <td><div style="text-transform:capitalize;font-size:12px;"><b>Requested From</b></div></td>
                         <td style="border: 1px solid black;font-size:12px; height:30px; line-height:30px;">
                         <?php echo $operationData['requestedfrom']; ?>
                         </td>

                     </tr>

                      </table>

                     <div style="margin-top:300px;"></div>

                      <table class="table table-bordered" style="margin-top:100px;">
    <thead>
      <tr style="background-color:black; color:white;font-size:12px; line-height:20px; height:20px;">
        <th>Item</th>
        <th>Color</th>
        <th>Marker Reference No</th>
        <th>Size</th>
        <th>Average</th>
        <th>No of Pcs.</th>
        <th>Quantity</th>
        <th>Available Quantity</th>

      </tr>
    </thead>
    <tbody>

 <?php

          $no = 1;

          $wherenew='parentId="'.$gateLastId.'" order by id asc';

          $rsnew=GetPageRecord('*','loadRequisitionMaster',$wherenew);

          while($rslistnew=mysqli_fetch_array($rsnew)){

            $style=GetPageRecord('id,materialType','styleSubCategoryMaster','1 and id="'.$rslistnew['materialId'].'"');

          $stylename=mysqli_fetch_array($style);

           $color=GetPageRecord('*','colorCardMaster','1 and name="'.$rslistnew['color'].'"');

          $colorname=mysqli_fetch_array($color);

          if($stylename['materialType'] == 1){
        $data=GetPageRecord('sum(acceptedField) as totalacceptedField','lotWiseData','1 and styleId="'.$rslistnew['styleId'].'" and materialid="'.$rslistnew['materialId'].'" and colorid="'.$colorname['id'].'"');
        $dataname=mysqli_fetch_array($data);
        $inspectedQty=$dataname['totalacceptedField'];
      }
      if($stylename['materialType'] == 2){
        $data=GetPageRecord('sum(accepted) as totalaccepted','qualityreportmaster','1 and styleId="'.$rslistnew['styleId'].'" and materialid="'.$rslistnew['materialId'].'" and type="triminspectioninput" and colorid="'.$colorname['id'].'"');
        $dataname=mysqli_fetch_array($data);
        $inspectedQty=$dataname['totalaccepted'];
      }
      if($stylename['materialType'] == 3){

$data=GetPageRecord('sum(accepted) as totalaccepted','packagingqualityreportmaster','1 and styleId="'.$rslistnew['styleId'].'" and type="packagingtriminspectioninput" and materialid="'.$rslistnew['materialId'].'" and colorid="'.$colorname['id'].'"');
$dataname=mysqli_fetch_array($data);
$inspectedQty=$dataname['totalaccepted'];

        }



          ?>
  <tr>
        <td style="border: 1px solid black; font-size:12px;">
        <?php
                     $rs1112=GetPageRecord('*','styleSubCategoryMaster','id="'.$rslistnew['materialId'].'"');
                       $resListing1112=mysqli_fetch_array($rs1112);

                    echo $resListing1112['name'];
                     ?></td>
        <td style="border: 1px solid black;font-size:12px;"><?php echo $rslistnew['color']; ?></td>
        <td style="border: 1px solid black;font-size:12px;"><?php echo $rslistnew['marker']; ?></td>
        <td style="border: 1px solid black;font-size:12px;"><?php echo $rslistnew['size']; ?></td>
         <td style="border: 1px solid black;font-size:12px;">  <?php
                $rs1113=GetPageRecord('*','techPackDetailMaster','id="'.$rslistnew['techpackId'].'"');
                       $resListing1113=mysqli_fetch_array($rs1113);

                ?>
 <?php echo $resListing1113['avgIncWastage']; ?>
  </td>
          <td style="border: 1px solid black;font-size:12px;"><?php echo $rslistnew['pcs']; ?></td>
           <td style="border: 1px solid black;font-size:12px;"><?php echo $rslistnew['quantity']; ?></td>
           <td style="border: 1px solid black;font-size:12px;"><?php echo $inspectedQty; ?></td>
           <!--<td style="border: 1px solid black;font-size:12px;"><?php // echo $rslistnew['quantity']; ?></td>-->

      </tr>

  <?php }?>

    </tbody>
                     </table>
                     </div>
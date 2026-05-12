<?php
ob_start();
include "inc.php";
$assignto='download';
$select='*';

if($_GET['id']!=''){
$select='*';
$where='id="'.decode($_GET['id']).'"';
$rs=GetPageRecord($select,'greigeRequisition',$where);
$editresultstyle=mysqli_fetch_array($rs);
@extract($editresultstyle);
$lastId=$editresultstyle['id'];
$requisitionNo = $requisitionNo;
$styleNo = $styleNo;
}

if($_GET['id']==''){
deleteRecord('greigeRequisition','tabstatus=0');

$requisitionNo = 'G-REQ-'.rand();
$styleNo = 'STY'.date('dmy').'-'.mt_rand(1000,9999);
$namevalue ='addedBy="'.$_SESSION['userid'].'",requisitionNo="'.$requisitionNo.'"';
$lastId = addlistinggetlastid('greigeRequisition',$namevalue);
}
?>



<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <style>

  </style>
 <div style="margin-top:80px;"></div>
 <div style="font-size:16px;">Greige Requisition</div>
 <div style="margin-top:80px;"></div>
                <table class="table  table-hover" style="width:100%">
                    <div style="margin-top:130px;"></div>

                         <tr>
                         <td style="width:10%"><div style="text-transform:capitalize;font-size:12px;"><b>Requisition No</b></div></td>
                         <td style="font-size:12px;">
                          <?php echo $requisitionNo; ?>
                         </td>
                          <td style="width:10%"><div style="text-transform:capitalize;font-size:12px;text-align:end"><b>Requisition Date</b></div></td>
                         <td style="font-size:12px;"><?php if($editresultstyle['requisitionDate']!=''){ echo date('d-M-Y', strtotime($editresultstyle['requisitionDate'])); }else{ echo date('d-M-Y'); } ?></td>
                          <td style="width:10%"><div style="text-transform:capitalize;font-size:12px;"><b>Greige Style No</b></div></td>
                         <td style="font-size:12px;">
                         <?php echo $styleNo; ?>
                         </td style="font-size:12px;">
                         <td style="width:10%"><div style="text-transform:capitalize;font-size:12px;"><b>Brand</b></div></td>
                         <td style="font-size:12px;">
                             AEO Austin
                         <?php
							$select='';
							$where='';
							$rs='';
							$select='*';
							$where=' 1  and id="'.$seasonId.'" order by name asc';
							$rs=GetPageRecord($select,'brandMaster',$where);
							$resListing=mysqli_fetch_array($rs);

							?>
							<?php echo $resListing['name']; ?>
                         </td>
                       </tr>

<div style="margin-top:130px;"></div>

 <div style="margin-top:130px;"></div>

                         <tr>
                    <td style="width:10%"><div style="text-transform:capitalize;font-size:12px;"><b>Requested By</b></div></td>
                         <td style="font-size:12px;">
                         Admin
                         </td>
                          <td style="width:10%"><div style="text-transform:capitalize;font-size:12px;text-align:end"><b>For Quarter</b></div></td>
                         <td style="font-size:12px;">
                           <?php
						$select='';
						$where='';
						$rs='';
						$select='*';
						$where=' 1 and brandId=0 and deletestatus=0 and status=1 and id="'.$seasonId.'"  order by id asc';
						$rs=GetPageRecord($select,_SEASON_MASTER_,$where);
						$resListing=mysqli_fetch_array($rs);
						?>
						<?php echo strip($resListing['name']); ?>

                             </td>
                          <td style="width:10%"><div style="text-transform:capitalize;font-size:12px;"><b>Currency</b></div></td>
                         <td style="font-size:12px;">
                        <?php
						$select='';
						$where='';
						$rs='';
						$select='*';
						$where=' 1 and status=1 and id="'.$currencyId.'" order by name asc';
						$rs=GetPageRecord($select,'currencyMaster',$where);
					    $resListing=mysqli_fetch_array($rs);
						?>
						<?php echo strip($resListing['name']); ?>
                         </td>
                            <td style="width:10%"><div style="text-transform:capitalize;font-size:12px;"><b>Status</b></div></td>
                         <td style="font-size:12px;">
                        <?php if(0==$status){

                            echo "Pending";

                        }
                        ?>
                        <?php if(1==$status){

                            echo "Approve";

                        }
                        ?>
                         </td>
                       </tr>

                      </table>

                     <div style="margin-top:300px;"></div>

                      <div style="margin-top:130px;"></div>

                          <div style="margin-top:130px;"></div>

                      <table class="table table-bordered" style="margin-top:100px;">
    <thead>
      <tr style="background-color:black; color:white;font-size:12px; line-height:20px; height:20px;">
        <th>Item</th>
        <th>Construction</th>
        <th>Width</th>
        <th>Qty.</th>
        <th>UOM</th>
        <th>Process Loss</th>
        <th>Shrinkage</th>
        <th>Pro. Cons.</th>
        <th>Pro. Width</th>
        <th>Final Qty.</th>
        <th>Supplier</th>
        <th>Price</th>
        <th>Currency</th>


      </tr>
    </thead>
    <tbody>

 <?php

  $no = 1;
$wherenew='parentId="'.$lastId.'" order by id asc';
$rsnew=GetPageRecord('*','greigeRequisition',$wherenew);
while($rslistnew=mysqli_fetch_array($rsnew)){
?>
  <tr>
        <td style="border: 1px solid black; font-size:12px;">
       <?php
	$wherethis='1 and materialSubTypeId=31 order by id desc';
	$rss=GetPageRecord('name,id','materialMaster',$wherethis);
	$resListing1s=mysqli_fetch_array($rss);
	?>
	<?php echo stripslashes($resListing1s['name']); ?>
	</td>
        <td style="border: 1px solid black;font-size:12px;"><?php echo $rslistnew['construction']; ?></td>
        <td style="border: 1px solid black;font-size:12px;">63</td>
        <td style="border: 1px solid black;font-size:12px;"><?php echo $rslistnew['qty']; ?></td>
        <td style="border: 1px solid black;font-size:12px;">
         Meter

            </td>
         <td style="border: 1px solid black;font-size:12px;">
         <?php echo $rslistnew['processLoss']; ?>
         </td>
          <td style="border: 1px solid black;font-size:12px;">5</td>
           <td style="border: 1px solid black;font-size:12px;"><?php echo $rslistnew['processCons']; ?></td>
           <td style="border: 1px solid black;font-size:12px;"><?php echo $rslistnew['processWidth']; ?></td>

           <td style="border: 1px solid black;font-size:12px;"><?php echo $rslistnew['finalQty']; ?></td>
           <!--<td style="border: 1px solid black;font-size:12px;">S.R. Fabrics</td>-->
           <td style="border: 1px solid black;font-size:12px;"> <?php
	$rssupplier=GetPageRecord('*','suppliersMaster','1 and deletestatus=0 and id="'.$rslistnew['supplier'].'" order by name asc');
	$rssupplierList=mysqli_fetch_array($rssupplier);
	?>
	<?php echo $rssupplierList['name']; ?>

	</td>
	<td style="border: 1px solid black;font-size:12px;"><?php echo $rslistnew['price']; ?></td>
	<td style="border: 1px solid black;font-size:12px;"><?php echo $rslistnew['currency']; ?></td>
	<!--<td style="border: 1px solid black;font-size:12px;">5</td>-->
           <!--<td style="border: 1px solid black;font-size:12px;"><?php // echo $rslistnew['quantity']; ?></td>-->

      </tr>

  <?php }?>

    </tbody>
                     </table>
                     </div>
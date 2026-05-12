<?php
ob_start();
include "inc.php";
$assignto='download';

header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment; filename=\"".$assignto."_".date('d-m-Y-H-i-s').".xls");
header("Cache-control: private");
?>
  <table class="table table-bordered table-hover no-footer table-responsive">
                      <thead style="background-color: #f5f5f5; text-align:center;">
                        <tr role="row">
                          <th class="sorting" tabindex="0" style="width: 225px;padding: 0px 124px;" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 50px; ">Line&nbsp;No</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 50px; ">Brand</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">&nbsp;&nbsp;Style&nbsp;No.&nbsp;&nbsp;</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Order&nbsp;Quantity&nbsp;</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Fabric&nbsp;Description</th>
                          <th class="sorting" style="width: 225px;padding: 0px 34px;" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" >Supplier</th>
                          <th class="sorting" style="width: 225px;padding: 0px 44px;" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Color</th>
                        <th class="sorting" style="width: 225px;padding: 0px 44px;" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Consumption</th>


                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" >Quantity&nbsp;Required</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Quantity&nbsp;Received</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Balance&nbsp;To&nbsp;Receive</th>
                          <th class="sorting" tabindex="0" style="padding: 0px 49px;" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">PCD</th>
                          <th class="sorting" tabindex="0" style="padding: 0px 49px;" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Production&nbsp;L/T</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Line&nbsp;Start&nbsp;Date</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Line&nbsp;End&nbsp;Date</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Ex&nbsp;-&nbsp;factory&nbsp;Date</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Issued&nbsp;Till&nbsp;Date</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Stock&nbsp;in&nbsp;Hand</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Ready&nbsp;Inspected</th>

                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">To&nbsp;be&nbsp;Inspected</th>

                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Per&nbsp;Day&nbsp;Feed</th>

                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">In&nbsp;-&nbsp;Flow&nbsp;Status</th>

                      </thead>
                       <tbody id="allhotellisting">
                          <?php
$no=0;
$select='*';
$where='';
$rs='';
$wheresearch='';
//$limit='20000';
$limit=clean($_GET['records']);


if($_GET['stylerefid']!=''){
$stylerefCondition = 'and id="'.decode($_GET['stylerefid']).'"';
}




    	$krxx=GetPageRecord('*','queryMaster','1 and subject!="" and sampleStyle=1 and  orderQty != "" and deletestatus=0   order by id desc');
								while($resultlists=mysqli_fetch_array($krxx)){




    	$kr=GetPageRecord('*','linePlanMaster','1 and styleId="'.$resultlists['id'].'"');
								$lineData=mysqli_fetch_array($kr);



    $rs1=GetPageRecord('*','styleSubCategoryMaster','styleId="'.$resultlists['id'].'" and costsheetVersionId="'.$resultlists['defaultcostsheetVersionId'].'" and materialType="1" and parentId=0 order by sr asc');
$resListing1=mysqli_fetch_array($rs1);


    $rs121=GetPageRecord('*','techPackDetailMaster',' stylesubtabid="'.$resListing1['id'].'" and sectionType="bom" and styleId="'.$resListing1['styleId'].'" and costsheetVersionId="'.$resultlists['defaultcostsheetVersionId'].'" order by id asc');
$resListing12=mysqli_fetch_array($rs121);



    $rs1213=GetPageRecord('*','styleColorDetailMaster',' styleid="'.$resultlists['id'].'"');
$resListing123=mysqli_fetch_array($rs1213);

    $rs12134=GetPageRecord('*','colorCardMaster',' id="'.$resListing123['colorId'].'"');
$resListing1234=mysqli_fetch_array($rs12134);



    	$kr=GetPageRecord('*','linePlanMaster','1 and styleId="'.$resultlists['id'].'"');
								$lineData=mysqli_fetch_array($kr);



    $rs1=GetPageRecord('*','styleSubCategoryMaster','styleId="'.$resultlists['id'].'" and costsheetVersionId="'.$resultlists['defaultcostsheetVersionId'].'" and materialType="1" and parentId=0 order by sr asc');
$resListing1=mysqli_fetch_array($rs1);


    $rs121=GetPageRecord('*','techPackDetailMaster',' stylesubtabid="'.$resListing1['id'].'" and sectionType="bom" and styleId="'.$resListing1['styleId'].'" and costsheetVersionId="'.$resultlists['defaultcostsheetVersionId'].'" order by id asc');
$resListing12=mysqli_fetch_array($rs121);



    $rs1213=GetPageRecord('*','styleColorDetailMaster',' styleid="'.$resultlists['id'].'"');
$resListing123=mysqli_fetch_array($rs1213);

    $rs12134=GetPageRecord('*','colorCardMaster',' id="'.$resListing123['colorId'].'"');
$resListing1234=mysqli_fetch_array($rs12134);


    	                        $rsv=GetPageRecord('*','taskListMaster','1 and tnatemplate="'.$resultlists['tnaTemplateId'].'" and name=42 ');
								$reslisttaskv=mysqli_fetch_array($rsv);

								$where12='taskListId="'.$reslisttaskv['id'].'" and styleId="'.$resultlists['id'].'" and status=1';
								$rs14=GetPageRecord('*','timeActionReport',$where12);
								$data=mysqli_fetch_array($rs14);



								$rsve=GetPageRecord('*','taskListMaster','1 and tnatemplate="'.$resultlists['tnaTemplateId'].'" and name=47 ');
								$reslisttaskve=mysqli_fetch_array($rsve);

								$where12e='taskListId="'.$reslisttaskve['id'].'" and styleId="'.$resultlists['id'].'" and status=1';
								$rs14=GetPageRecord('*','timeActionReport',$where12e);
								$datae=mysqli_fetch_array($rs14);



									$sr=1;
				$gateEntryno='';
				$rsListDatassq=GetPageRecord('*','grnMaster','1 and styleId="'.$resultlists['id'].'" and materialid in ( select id from styleSubCategoryMaster where materialType="1") group by color,materialId');
				while($rsListDatass4=mysqli_fetch_array($rsListDatassq)){


				    	$where244='styleId="'.$resultlists['id'].'" and materialType="1" and id="'.$rsListDatass4['materialId'].'"';
				$rs244=GetPageRecord('*','styleSubCategoryMaster',$where244);
				$matData44=mysqli_fetch_array($rs244);


    	$rsListitemq=GetPageRecord('*','indentCreationMaster','styleId="'.$resultlists['id'].'" and materialTypeId="1" and materialId="'.$rsListDatass4['materialId'].'" and color="'.$rsListDatass4['color'].'"');
				$rsListitem=mysqli_fetch_array($rsListitemq);

								$rsgrnrec=GetPageRecord('sum(netReceived) as netReceivedTill,color,parentId','grnMaster','styleId="'.$resultlists['id'].'" and materialId="'.$rsListDatass4['materialId'].'" and color="'.$rsListDatass4['color'].'"');
				$rsgrnrecTill=mysqli_fetch_array($rsgrnrec);



				$i=0;$totalissuetilldate=0;
        $issuance=GetPageRecord('*','issuanceMaster','1 and styleId="'.$resultlists['id'].'"');
        while($dataissue=mysqli_fetch_array($issuance)){

        $newdata = explode(',', $dataissue['materialId']);
        $newdata1 = explode(',', $dataissue['color']);
        $newdata2 = explode(',', $dataissue['issueqty']);
while($i < count($newdata)){
   if($newdata[$i] == $rsListDatass4['materialId'] && $newdata1[$i] == $rsListDatass4['color']) {
     $totalissuetilldate+=$newdata2[$i];
    }
$i++; }
}


			$lotWiseDataFabricq=GetPageRecord('sum(acceptedField) as totalacceptedField','lotWiseData','1 and styleId="'.$resultlists['id'].'" and materialid="'.$rsListDatass4['materialId'].'" and colorid="'.$rsListDatass4['color'].'"');
$lotWiseDataFabric=mysqli_fetch_array($lotWiseDataFabricq);
$inspectedQty=$lotWiseDataFabric['totalacceptedField'];

$rkdm=GetPageRecord('min(uploadInputDate) as minDate, max(uploadInputDate) as maxDate','linePlanMaster','1 and styleId="'.$resultlists['id'].'"');
$dateWise=mysqli_fetch_array($rkdm);


$k=GetPageRecord('max(dateWiseLineInput) as maxinput','linePlanMaster','1 and styleId="'.$resultlists['id'].'"');

$showstylecolor=mysqli_fetch_array($k);




?>

                        <tr role="row" class="odd" <?php if($resultlists['stylestatus']=='0'){ ?> style="background-color: #ff704359;" <?php } ?>>


                        <td>

                            <div align="left">
                          <?php

							 	$kk=GetPageRecord('*','linePlanMaster','1 and styleId="'.$resultlists['id'].'" and factoryId="'.$lineData['factoryId'].'" group by lineId desc');
								while($lineDataa=mysqli_fetch_array($kk)){
							    $lineDataa['lineId'];


								$lo=GetPageRecord('*','factoryLineMaster','id="'.$lineDataa['lineId'].'"');
								$lineName=mysqli_fetch_array($lo);

								?>
                          <span style="padding: 5px 10px; background-color: #0097a7; color: #fff; margin-right: 2px; font-size: 12px; margin-bottom:5px;display: inline-block;"><?php echo str_replace(' ','&nbsp;',$lineName['lineName']);?></span>
                          <?php


								}


								?>
                        </div>

                        </td>
                         <td><?php echo getbrandName($resultlists['brandId']) ?></td>
                          <td><?php echo '#'.$resultlists['styleRefId']; ?></td>
                          <td><?php echo $resultlists['orderQty']; ?></td>
                          <td><?php echo $matData44['name']; ?></td>
                          <td><?php  echo getSupplierName($resListing12['storesupplier']); ?></td>
                          <td><?php echo $resListing1234['name']; ?></td>
                          <td><?php  echo $resListing12['avgIncWastage']; ?></td>
                          <td><?php echo $rsListitem['poQty']*$rsListitem['avg']; ?></td>
                          <td><?php echo round($rsgrnrecTill['netReceivedTill'],2); ?></td>

                          <?php
                          $a= $rsListitem['poQty']*$rsListitem['avg'];
                          $b=round($rsgrnrecTill['netReceivedTill'],2);


                          $final=$a-$b;
                          ?>


                          <td><?php echo round($final,3); ?></td>
                          <td><?php  echo $data['complitionDate'];  ?></td>
                          <?php
                          $first=date('d-m-Y',strtotime($dateWise['minDate']));
                          $second=date('d-m-Y',strtotime($dateWise['maxDate']));
                          $newr=$second-$first;
                          ?>


                          <td><?php echo $newr;  ?></td>
                          <td><?php echo date('d-m-Y',strtotime($dateWise['minDate'])); ?></td>
                          <td><?php echo date('d-m-Y',strtotime($dateWise['maxDate'])); ?></td>
                          <td><?php  echo $datae['complitionDate'];  ?></td>
                          <td><?php echo $totalissuetilldate; ?></td>
                          <td><?php echo $inspectedQty - $totalissuetilldate;  ?></td>
                          <td><?php  echo $inspectedQty; ?></td>
                          <td><?php echo $final-$inspectedQty; ?></td>

                          <?php
                          $as=$resListing12['avgIncWastage'];
                          $ad=$showstylecolor['maxinput'];
                          $finals=$as*$ad;
                          ?>
                          <td><?php echo round($finals,2); ?></td>
                         <?php



                          $ee=$resultlists['orderQty'];

                          $pcd= $data['complitionDate'];

                          $today=date('Y-m-d');




                          $v1= round($rsgrnrecTill['netReceivedTill'],2);
                          $v2=$rsListitem['poQty']*$rsListitem['avg'];

                          $fin=($v1/$v2)*100;

 $date1=date_create($today);
$date2=date_create($pcd);
$diff=date_diff($date1,$date2);
$as= $diff->format("%r%a");




                          ?>

                                                        <td>
                                                        <?php



                                                        //  <under 500>

                                                        if($ee >= 0 && $ee <= 500){
                                                        if($as>=0 && $as<10){

                                                        if($fin>=0 && $fin<30){
                                                        echo 'Below Avg';


                                                        }elseif($fin >= 30 && $fin <= 60){
                                                        echo 'Avg';

                                                        }else{

                                                        echo 'Above Avg';
                                                        }


                                                        }
                                                        elseif ($as<0){

                                                        if($fin>=0 && $fin<60){
                                                        echo 'Below Avg';


                                                        }else{

                                                        echo 'Avg';
                                                        }

                                                        }else{

                                                        if($fin >= 0 && $fin<60){
                                                        echo 'Below Avg';


                                                        }else{

                                                        echo 'Avg';
                                                        }

                                                        }

                                                        }


                                                        //  <under 500>

                                                        // above 500 to 5000
                                                        elseif($ee > 500 && $ee < 5000){

                                                        if($as>=0 && $as<10){




                                                        if($fin=0 ){
                                                        echo 'Below Avg';


                                                        }elseif($fin > 0 && $fin <= 30){
                                                        echo 'Avg';

                                                        }else{

                                                        echo 'Above Avg';
                                                        }

                                                        }
                                                        elseif ($as<0){

                                                        if($fin>=0 && $fin<30){
                                                        echo 'Below Avg';


                                                        }elseif($fin >= 30 && $fin <= 60){
                                                        echo 'Avg';

                                                        }else{

                                                        echo 'Above Avg';
                                                        }

                                                        }else{

                                                        if($fin>=0 && $fin<60){
                                                        echo 'Below Avg';

                                                        }

                                                        else{

                                                        echo ' Avg';
                                                        }

                                                        }


                                                        }


                                                        // above 500 to 5000
                                                        //above 5000

                                                        elseif($ee > 5000 ){

                                                        if($as>=0 && $as<10){


                                                        echo 'Above Avg';

                                                        }
                                                        elseif ($as<0){


                                                        if($fin=0 ){
                                                        echo 'Below Avg';


                                                        }elseif($fin > 0 && $fin <= 30){
                                                        echo 'Avg';

                                                        }else{

                                                        echo 'Above Avg';
                                                        }

                                                        }else{
                                                        if($fin>=0 && $fin<30){
                                                        echo 'Below Avg';

                                                        }elseif($fin >= 30 && $fin <= 60){
                                                        echo 'Avg';

                                                        }else{

                                                        echo 'Above Avg';
                                                        }

                                                        }

                                                        }

                                                        //above 5000

                                                        else{

                                                        }



                                                        ?>




                                                        </td>







                                              </tr>


                                              <?php }  } ?>

                      </tbody>
                    </table>

<?php
ob_start();
include "inc.php";
?>

 <?php
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<body>
  <style type="text/css">
    .tableone{
border:1px solid #c1beba;
    }
    .tableone td{
border:1px solid #c1beba;
    }
  </style>
                <?php

				$rrrr=GetPageRecord('*','testRequisitionForm','1 and styleId="'.decode($_GET['styleid']).'"');
				$operationData=mysqli_fetch_array($rrrr);

				?>



		        <?php
				$rrrr=GetPageRecord('*','factoryMaster','1 and id="'.$operationData['factoryId'].'" and deletestatus=0');
				$factory=mysqli_fetch_array($rrrr);
			//	echo $factory['line'];


				$rrrr=GetPageRecord('*','labMaster',1);
				$lab=mysqli_fetch_array($rrrr);

				$rrrr=GetPageRecord('*','userMaster','1 and id="'.$operationData['contactId'].'" and profileId=85');
				$user=mysqli_fetch_array($rrrr);

				$rrrr=GetPageRecord('*','companyMaster','1 and id="'.$operationData['companyId'].'" and status=1 and deletestatus=0');
				$company=mysqli_fetch_array($rrrr);

					                        $styleId = decode($_GET['styleid']);
											$rs=GetPageRecord($select,'queryMaster','1 and id="'.$styleId.'" and deletestatus=0 and subject!="" order by id asc');
											$resultStyle=mysqli_fetch_array($rs);

				?>


				<h1><?php // echo $factory['name'] ?></h1>

                   <table class="table erptab table-hover" style="width:100%;border:1px solid black">
                        <tr>
                         <td style="width:18%"><div style="text-transform:capitalize;"><b>Style No.</b></div></td>
                         <td>
                             <td><?php echo $resultStyle['styleRefId']; ?></td>
                         </td>
                         <td></td>
                         <td></td>

                         </tr>
                       </table>

                     <table class="table erptab table-hover" style="width:100%;border:1px solid black">

                         <tr>
                         <td style="width:18%"><div style="text-transform:capitalize;"><b>Factory Name</b></div></td>
                         <td>
                             <td><?php echo $factory['name'] ?></td>
                         </td>
                         <td></td>
                         <td></td>

                         </tr>

                          <tr>
                        <td><div style="text-transform:capitalize;"><b>Lab</b></div></td>
                         <td>

                              <td><?php if($factory['name']=="Gurgaon Factory"){

                                 echo "Creations Lab";
                             }else{
                               echo "Method Labs";
                             }
                             ?></td>

                             </td>
                         <td style="width:26%"><div style="text-transform:capitalize;text-align:end"><b>Email (Lab)</b></div></td>
                         <td><td> <?php if($factory['name']=="Gurgaon Factory"){

                                 echo "creations@gmail.com";
                             }else{
                               echo "methodlabs@yahoo.in";
                             }
                             ?></td></td>
                       </tr>

                     <tr>
                         <td><div style="text-transform:capitalize"><b>Address (Lab)</b></div></td>
                         <td> <td>
                             <?php if($factory['name']=="Gurgaon Factory"){

                                 echo "B/25, Street No.5, Malviya Nagar, New Delhi";
                             }else{
                               echo "C-95, Plot no.7, Main Bazaar,Uttam Nagar, New Delhi";
                             }
                             ?>



                             </td>

                             </td>



                         <td><div style="text-transform:capitalize;text-align:end"><b>Mobile (Lab)</b></div></td>
                         <td><td><?php if($factory['name']=="Gurgaon Factory"){

                                 echo "9958746321";
                             }else{
                               echo "9936487512";
                             }
                             ?></td></td>
                     </tr>

                     <tr>
                         <td><div style="text-transform:capitalize"><b>Contact Person</b></div></td>
                         <td>
                         <td><?php echo strip($user['firstName']); ?> <?php echo strip($user['lastName']); ?></td>

                         </td>
         				<td><div style="text-transform:capitalize;text-align:end"><b>Email</b></div></td>
                         <td><td><?php if($factory['name']=="Gurgaon Factory"){

                                 echo "satendragurjar@gmail.com";
                             }else{
                               echo "kumarvikram";
                             }
                             ?></td></td>

                         </tr>
                         <tr>
                         <td style="width:%"><div style="text-transform:capitalize"><b>Mobile</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="mobile" id="contactPhone" readonly="readonly" value=""> </td>
                         <td></td>
                         <td></td>
                     </tr>
                     </table>

               <br>

               <br>
                 <table class="table erptab table-hover" style="width:100%; border:1px solid black">
                     <tr>
                         <td style="width:18%;"><div style="text-transform:capitalize;"><b>Invoice Info</b></div></td>
                         <td><td><?php echo $operationData['invoice'] ?></td></td>
                         <td></td>
                         <td></td>
                     </tr>
                          <tr>
                         <td><div style="text-transform:capitalize"><b>To be charged on</b></div></td>
                         <td><td><?php echo $operationData['charge'] ?></td></td>
                         <td></td>
                         <td></td>
                     </tr>
                     <tr>
                         <td><div style="text-transform:capitalize"><b>Company Name</b></div></td>
                         <td><td><?php echo $company['name'] ?></td>

                         </td>

                         <td style="text-align:end;width:26%"><div style="text-transform:capitalize"><b>Email</b></div></td>
                         <td><td><?php echo $company['email'] ?></td></td>
                         </tr>
                         <tr>

                         <td><div style="text-transform:capitalize"><b>Address</b></div></td>
                         <td><td>105-106, Udyog Vihar, Phase -I, Gurgaon, Haryana-India</td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>

                         <td><div style="text-transform:capitalize"><b>Contact No.</b></div></td>
                         <td><td><?php //echo $company['email'] ?></td></td>
                        <td></td>
                        <td></td>
                     </tr>
               </table>
               <br>

                   <br>
                   <table class="table erptab table-hover" style="width:1130px;border:1px solid black">
                   <tr>
                         <td style="width:18%"><div style="text-transform:capitalize; margin-top:10px;"><b>Test Description</b></div></td>

         <style>
.select2-search__field{
display:none;
}
.select2-container{
width: 40%!important;
}
</style>
<?php
$newdesc = explode(',', $operationData['testdesc']);
?>

                                    <td>
                                    <?php foreach($newdesc as $testdesc){ if($testdesc == "1")
                                    {
                                    echo "Development Fabric Package Test";
                                    }
                                    ?>

                                   <?php } ?>

                                    <?php foreach($newdesc as $testdesc){ if($testdesc == "2")
                                    {
                                    echo "Development Garment Package Test";
                                    }
                                    ?>

                                   <?php } ?>

                                   <?php foreach($newdesc as $testdesc){ if($testdesc == "3")
                                    {
                                    echo "Bulk Garment Full Package Test";
                                    }
                                    ?>

                                   <?php } ?>

                                   <?php foreach($newdesc as $testdesc){ if($testdesc == "4")
                                    {
                                    echo "Bulk Fabric Full Package Test";
                                    }
                                    ?>

                                   <?php } ?>

                                    <?php foreach($newdesc as $testdesc){ if($testdesc == "5")
                                    {
                                    echo "Trim Test";
                                    }
                                    ?>

                                   <?php } ?>


                                   </td>


                         <td style="width:30%;"></td>
                     </tr>
               </table>
               <br>

                      <?php
                      $newdata = explode(',', $operationData['dimensionStable']);
                      $newdata1 = explode(',', $operationData['appearanceR']);
                      $newdata2 = explode(',', $operationData['colorFastness']);
                      $newdata3 = explode(',', $operationData['physical']);
                      $newdata4 = explode(',', $operationData['ecoTest']);
                      ?>
                    <br>
                    <table class="table erptab table-hover" style="border:1px solid black;">

                    <tr style="background: #0288d1;">
                         <td colspan="4"><div style="text-transform:capitalize;color:white;font-size: 15px;">Care Instructions and/or Symbols:
                         &nbsp;&nbsp;<i class="fa fa-circle" style="font-size:20px"></i>&nbsp;
                         &nbsp;<i class="fa fa-play" style="font-size:20px;transform: rotate(-90deg);"></i>&nbsp;
                         &nbsp;<i class="fa fa-stop" style="font-size:20px"></i>
                         </div>
                         </td>
                         </tr>
                     <tr>
                         <td colspan="5"><div><b>Test (s) Required: </b>(Please fill all the information and tick appropriate boxes)</div></td>
                     </tr>
                     <tr>
                         <td colspan="5" style="padding-bottom:0px!important;">
                         <table class="erptab1" width="100%">
                      <tr>
                         <td colspan="5"><div style="text-decoration:underline"><b>Test (s) Required: </b></div></td>
                     </tr>
                         <tr>
                         <td><div style="text-transform:capitalize"><b>Dimensional Stability</b></div></td>
                         <td><div style="text-transform:capitalize"><b>Physical</b></div></td>
                         <td>

                                    <?php foreach($newdata3 as $physical){ if($physical == "16")
                                    {
                                    echo "Zipper Strength";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>

                        <td></td>
                        <td></td>
                     </tr>
                      <tr>
                         <td>

                                    <?php foreach($newdata as $dimension){ if($dimension == "1")
                                    {
                                    echo "Washing";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>

                                   <td>

                                    <?php foreach($newdata3 as $physical){ if($physical == "1")
                                    {
                                    echo "Spirality";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>


                        <td><div style="text-transform:capitalize"><b>ECO Test</b></div></td>

                        <td style=""><div style="text-transform:capitalize"><b>Test Method reference to</b></div></td>
                        <td></td>
                        </tr>
                        <tr>
                                    <td>

                                    <?php foreach($newdata as $dimension){ if($dimension == "2")
                                    {
                                    echo "Dry-cleaning";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>
                                    <td>

                                    <?php foreach($newdata3 as $physical){ if($physical == "2")
                                    {
                                    echo "Tensile Strength";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>

                                    <td>

                                    <?php foreach($newdata4 as $ecotest){ if($ecotest == "1")
                                    {
                                    echo "pH Value";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>

                                    <td>

                                  <?php if( $operationData['testMethod'] == "1"){
                                    {
                                    echo "pH Value";
                                    }
                                    ?>
                                    <?php } ?>
                                 </td>



                        <td></td>
                     </tr>
                     <tr>
                         <td><div style="text-transform:capitalize"><b>Appearance Retention</b></div></td>


                                  <td>

                                    <?php foreach($newdata3 as $physical){ if($physical == "3")
                                    {
                                    echo "Tear Strength";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>

                                    <td>

                                    <?php foreach($newdata4 as $ecotest){ if($ecotest == "2")
                                    {
                                    echo "Formadehyde Content";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>

                                    <td>

                                  <?php if( $operationData['testMethod'] == "2"){
                                    {
                                    echo "ISO International";
                                    }
                                    ?>
                                    <?php } ?>
                                </td>






                        <td></td>
                     </tr>
                     <tr>
                                    <td>

                                    <?php foreach($newdata1 as $appear){ if($appear == "1")
                                    {
                                    echo "After Laundering";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>

                                    <td>

                                    <?php foreach($newdata3 as $physical){ if($physical == "4")
                                    {
                                    echo "Seam Slippage";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>

                                   <td>

                                    <?php foreach($newdata4 as $ecotest){ if($ecotest == "3")
                                    {
                                    echo "Banned AZO Dyes";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>


                                   <td>
                                    <?php foreach($newdata4 as $ecotest){ if($ecotest == "3")
                                    {
                                    echo "Banned AZO Dyes";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>


                                   <td>
                                  <?php if( $operationData['testMethod'] == "3"){
                                    {
                                    echo "BS U.K";
                                    }
                                    ?>
                                    <?php } ?>
                                </td>


                        <td></td>
                     </tr>
                     <tr>
                         <td>

                                    <?php foreach($newdata1 as $appear){ if($appear == "2")
                                    {
                                    echo "After Dry-cleaning";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>



                                      <td>

                                    <?php foreach($newdata3 as $physical){ if($physical == "5")
                                    {
                                    echo "Seam Strength";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>



                         <td>

                                    <?php foreach($newdata4 as $ecotest){ if($ecotest == "41")
                                    {
                                    echo "Mixed Test";
                                    }
                                    ?>
                                    <?php } ?>
                                    <?php foreach($newdata4 as $ecotest){ if($ecotest == "42")
                                    {
                                    echo "Individual Test";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>

                      <td>

                                  <?php if( $operationData['testMethod'] == "4"){
                                    {
                                    echo "Other Please Specify";
                                    }
                                    ?>
                                    <?php } ?>
                                </td>


                        <td></td>
                     </tr>
                      <tr>
                         <td><div style="text-transform:capitalize"><b>Colour Fastness</b></div></td>
                          <td>

                                    <?php foreach($newdata3 as $physical){ if($physical == "5")
                                    {
                                    echo "Bursting Strength";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>

                         <td>

                                    <?php foreach($newdata4 as $ecotest){ if($ecotest == "5")
                                    {
                                    echo "Extractable Heavy Metals";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>


                        <td style=""></td>
                        <td></td>
                     </tr>
                      <tr>
                                   <td>

                                    <?php foreach($newdata2 as $color){ if($color == "1")
                                    {
                                    echo "Washing";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>

                                    <td>

                                    <?php foreach($newdata3 as $physical){ if($physical == "7")
                                    {
                                    echo "Pilling Resistance";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>

                                    <td>

                                    <?php foreach($newdata4 as $ecotest){ if($ecotest == "6")
                                    {
                                    echo "PCP";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>



                        <td style=""><div style=""><b>Exported to Market : </b></div></td>
                         <td></td>
                     </tr>
                     <tr>
                         <td>
                         <?php foreach($newdata2 as $color){ if($color == "2")
                                    {
                                    echo "Dry-cleaning";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>

                                    <td>
                         <?php foreach($newdata3 as $physical){ if($physical == "8")
                                    {
                                    echo "Abrasion Resistance";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>

                         <td>
                         <?php foreach($newdata4 as $ecotest){ if($ecotest == "9")
                                    {
                                    echo "Phthalates";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>


                        <td></td>
                        <td></td>
                     </tr>
                     <tr>
                         <td>
                         <?php foreach($newdata2 as $color){ if($color == "3")
                                    {
                                    echo "Rubbing / Crocking";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>
                                   <td>
                         <?php foreach($newdata3 as $physical){ if($physical == "9")
                                    {
                                    echo "Thread per inch";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>
                                    <td>

                         <?php foreach($newdata4 as $ecotest){ if($ecotest == "8")
                                    {
                                    echo "Total Cadmium";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>


                        <td></td>
                        <td></td>
                        </tr>
                     <tr>
                          <td>

                         <?php foreach($newdata2 as $color){ if($color == "4")
                                    {
                                    echo "Light";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>
                         <td>
                          <?php foreach($newdata3 as $physical){ if($color == "10")
                                    {
                                    echo "Yam Count";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>

                                     <td>
                          <?php foreach($newdata4 as $ecotest){ if($ecotest == "9")
                                    {
                                    echo "Release of Nickel";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>


                        <td></td>
                        <td></td>
                     </tr>
                     <tr>
                         <td>
                          <?php foreach($newdata2 as $color){ if($color == "5")
                                    {
                                    echo "Perspiration";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>

                                     <td>
                          <?php foreach($newdata3 as $physical){ if($physical == "11")
                                    {
                                    echo "Fabric Weight";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>

                                  <td>
                          <?php foreach($newdata4 as $ecotest){ if($ecotest == "10")
                                    {
                                    echo "Lead Content";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>


                        <td></td>
                        <td></td>
                     </tr>
                     <tr>
                               <td>
                          <?php foreach($newdata2 as $color){ if($color == "6")
                                    {
                                    echo "Water";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>

                                     <td>
                          <?php foreach($newdata3 as $physical){ if($physical == "12")
                                    {
                                    echo "Care Label Recommendations";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>



                        <td></td>
                        <td></td>
                     </tr>
                     <tr>
                         <td>
                          <?php foreach($newdata2 as $color){ if($color == "7")
                                    {
                                    echo "Actual Laundering";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>

                                    <td>
                          <?php foreach($newdata3 as $physical){ if($physical == "13")
                                    {
                                    echo "Print Durability";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>



                        <td></td>
                        <td></td>
                     </tr>
                     <tr>
                          <td>
                          <?php foreach($newdata2 as $color){ if($color == "8")
                                    {
                                    echo "Chlorine Bleach";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>

                                    <td>
                          <?php foreach($newdata3 as $physical){ if($physical == "14")
                                    {
                                    echo "Fibre Content";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>



                        <td></td>
                        <td></td>
                     </tr>
                     <tr>
                                   <td>
                          <?php foreach($newdata2 as $color){ if($color == "9")
                                    {
                                    echo "Non-Chlorine Bleach";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>

                                      <td>
                          <?php foreach($newdata3 as $physical){ if($physical == "15")
                                    {
                                    echo "Flammability";
                                    }
                                    ?>
                                    <?php } ?>
                                    </td>

                     <!--   <td style=""><div><b>Comment on test results</b></div></td>-->
                     <!--<td> No</td>-->

                        </tr>
                        </table>
                     </td>
                     </tr>
                     <tr>

                     <!--<td style=""><div><b>Is it a re-test ?</b></div></td>-->
                     <!--<td> No</td>-->
                     <!-- <td style=""><div><b>Returned Remained Sample</b></div></td>-->

                     <!-- <td> No</td>-->

                   <table class="erptab" width="100%">
                     <tr>
                         <td style="" colspan="5"><div><b>Other Tests (Please indicate test method if possible or special request) </b></div></td>
                     </tr>
                     <tr>
                         <td style=""><div><b>Comment on test results</b></div></td>
                         <td style="">
                            <?php if($operationData['comment']!=""){
                                    {
                                    echo "No";
                                    }
                                    ?>
                                    <?php } ?>
                            <?php if($operationData['comment'] == ""){
                                    {
                                    echo "No";
                                    }
                                    ?>
                                    <?php } ?>

                             </td>


                         <td colspan="3" style=""><input type="hidden" style="" name="remarks" placeholder="Remarks" value=""></td>
                     </tr>
                     <tr>
                         <td style=""><div><b>Is it a re-test ?</b></div></td>
                         <td>
                        <?php if( $operationData['reTest']!=""){
                                    {
                                    echo "No";
                                    }
                                    ?>
                            <?php } ?>
                            <?php if( $operationData['reTest'] == ""){
                                    {
                                    echo "yes";
                                    }
                                    ?>
                            <?php } ?>

                             </td>

                         <td><div><b>Returned Remained Sample</b></div></td>
                         <td>

                              <?php if( $operationData['returnSample'] == "yes"){
                                    {
                                    echo "yes";
                                    }
                                    ?>
                            <?php } ?>
                            <?php if( $operationData['returnSample'] == "no"){
                                    {
                                    echo "No";
                                    }
                                    ?>
                            <?php } ?>
                           </td>
                         <td style=""></td>
                     </tr>
                     <tr>
                         <td><?php echo $operationData['reportNumber'] ?></td>

                     </tr>
                     </table>
                     </td>
                     </tr>


                     </table>


              <br>
              <br>


              </body>
</html>

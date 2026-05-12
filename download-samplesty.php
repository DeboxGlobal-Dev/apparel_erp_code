
<?php
ob_start();
include "inc.php";
$assignto='download';
$select='*';

if($_GET['id']!=''){

    //echo decode($_GET['id']); die();

$select1='*';

$where1='id="'.$_GET['id'].'"';

$rs1=GetPageRecord($select1,'queryMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

$editId=clean($editresult['id']);

$lastId=$editresult['id'];

}

?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<style>

</style>
<div style="margin-top:130px;"></div>
                      <div style="font-size:14px; font-weight:700">Sampling Style Information</div>

                      <div style="margin-top:130px;"></div>
                      <table class="table  table-hover" style="width:100%">

                      <div style="margin-top:130px;"></div>
                      <tr>
                         <td style="width:15%"><div style="text-transform:capitalize;font-size:12px;"><b>Style Type</b></div>

                          <td style="font-size:12px; border:1px solid black;">
                          <div style="border: 1px solid black; height:20px; line-height:20px;">Sample</div>
                         </td>
                         </td>


                          <td style="width:15%"><div style="text-transform:capitalize;font-size:12px;text-align:end"><b>Sample For</b></div>
                         <td style="font-size:12px;">
                             <div style="border: 1px solid black; height:20px; line-height:20px;">

                            Buyer Inspiration

                         </div></td>
                         </td>
                          <td style="width:15%"><div style="text-transform:capitalize;font-size:12px;"><b>Sample Stage</b></div>
                         <td style="font-size:12px;">
                             <div style="border: 1px solid black; height:20px; line-height:20px;">
                         <?php

								$rsList=GetPageRecord('id,name','productionStageMaster','1 and deletestatus=0 order by id asc');

								$productionName=mysqli_fetch_array($rsList);

								?>

                             <?php echo $productionName['name']; ?>
                             </div>
                         </td>
                         </td>
                         <td style="width:15%"><div style="text-transform:capitalize;font-size:12px;"><b>Sample Type</b></div>
                         <td style="font-size:12px;">
                             <div style="border: 1px solid black; height:20px; line-height:20px;">
                         Sample
						</div>
                         </td>
                         </td>
                          <td style="width:15%"><div style="text-transform:capitalize;font-size:12px;"><b>Style</b></div>
                         <td style="font-size:12px;">
                             <div style="border: 1px solid black; height:20px; line-height:20px;">
                         <?php

								$rsList=GetPageRecord('id,name','productionStageMaster','1 and deletestatus=0 order by id asc');

								$productionName=mysqli_fetch_array($rsList);

								?>

                             <?php echo $productionName['name']; ?>
                             </div>
                         </td style="font-size:12px;">
                         </td>
                         <td style="width:15%"><div style="text-transform:capitalize;font-size:12px;"><b>Sample Style</b></div>
                         <td style="font-size:12px;">
                             <div style="border: 1px solid black; height:20px; line-height:20px;">
                         Sample
						</div>
                         </td>
                         </td>
                       </tr>



                      </table>

                                        <table class="table  table-hover" style="width:100%">

                    <div style="margin-top:130px;"></div>
                    <tr>
                         <td style="width:25%"><div style="text-transform:capitalize;font-size:12px;"><b>Requested By</b></div>

                          <td style="font-size:12px;">
                              <div style="border: 1px solid black; height:20px; line-height:20px;">
                          Neha
                          </div>
                         </td>
                         </td>


                          <td style="width:25%"><div style="text-transform:capitalize;font-size:12px;text-align:end"><b>Requested Date</b></div>
                         <td style="font-size:12px;">
                             <div style="border: 1px solid black;height:20px; line-height:20px;">
                        <?php if($editresult['requestedDate']!=''){ echo date('d-m-Y', strtotime($editresult['requestedDate'])); }else{ echo date('d-m-Y'); } ?>
                        </div>
                        </td>
                         </td>
                          <td style="width:25%"><div style="text-transform:capitalize;font-size:12px;"><b>Dispatch Date</b></div>
                         <td style="font-size:12px;">
                             <div style="border: 1px solid black;height:20px; line-height:20px;">
                        <?php if($editresult['dispatchDate']!=''){ echo date('d-m-Y', strtotime($editresult['dispatchDate'])); }else{ echo date('d-m-Y'); } ?>
                        </div>
                         </td>
                         </td>
                         <td style="width:25%"><div style="text-transform:capitalize;font-size:12px;"><b>Target Date</b></div>
                         <td style="font-size:12px;">
                             <div style="border: 1px solid black;height:20px; line-height:20px;">
                         <?php if($editresult['expectedDate']!=''){ echo date('d-m-Y', strtotime($editresult['expectedDate'])); }else{ echo date('d-m-Y', strtotime('+1 days')); } ?>
						</div>
                         </td>
                         </td>

                       </tr>


                         <div style="margin-top:130px;"></div>
                    <tr>
                         <td style="width:30%"><div style="text-transform:capitalize;font-size:12px;"><b>Dispatch Details</b></div>

                          <td style="font-size:12px;">
                              <div style="border: 1px solid black;height:20px; line-height:20px;">
                          <?php echo $editresult['dispatchDetail']; ?>
                          </div>
                         </td>
                         </td>


                          <td style="width:30%"><div style="text-transform:capitalize;font-size:12px;text-align:end"><b>Size Range</b></div>
                         <td style="font-size:12px;">
                         <div style="border: 1px solid black;height:20px; line-height:20px;">
                        <?php

							$select='';

							$where='';

							$rs='';

							$select='*';

							$where='1 and deletestatus=0 and status=1 order by name asc';

							$rs=GetPageRecord($select,'sizerangeMaster',$where);

							$resListing=mysqli_fetch_array($rs);

							?>
							<?php echo strip($resListing['name']); ?>
							</div>
							</td>
                         </td>
                          <td style="width:30%"><div style="text-transform:capitalize;font-size:12px;"><b>Size Ratio</b></div>
                         <td style="font-size:12px;">
                             <div style="border: 1px solid black;height:20px; line-height:20px;">
                        <?php echo $editresult['sizeratio']; ?>
                        </div>
                         </td>
                         </td>


                       </tr>


                         <div style="margin-top:130px;"></div>
                    <tr>
                         <td style="width:25%"><div style="text-transform:capitalize;font-size:12px;"><b>Color</b></div>

                          <td style="font-size:12px;">
                              <div style="border: 1px solid black;height:20px; line-height:20px;">
                           <?php

							$select='';

							$where='';

							$rs='';

							$select='*';

							$where='1 and deletestatus=0 and status=1 order by name asc';

							$rs11=GetPageRecord('DISTINCT(name),id','colorCardMaster',$where);

							$resListing11=mysqli_fetch_array($rs11);

							?>
							<?php echo strip($resListing11['name']); ?>
							</div>
                         </td>
                         </td>


                          <td style="width:25%"><div style="text-transform:capitalize;font-size:12px;text-align:end"><b>Color Qty.</b></div>
                         <td style="font-size:12px;">
                         <div style="border: 1px solid black;height:20px; line-height:20px;">
                        8
                        </div>
                        </td>
                         </td>
                          <td style="width:25%"><div style="text-transform:capitalize;font-size:12px;"><b>Value Addition</b></div>
                         <td style="font-size:12px;">
                             <div style="border: 1px solid black;height:20px; line-height:20px;">
                        <?php

							$select='';

							$where='';

							$rs='';

							$select='*';

							$where='1 and deletestatus=0 and status=1 order by name asc';

							$rs12=GetPageRecord($select,'embroideryTypeMaster',$where);

							$resListing12=mysqli_fetch_array($rs12);

							?>

                             <?php echo strip($resListing12['name']); ?>
                             </div>
                         </td>
                         </td>
                         <td style="width:25%"><div style="text-transform:capitalize;font-size:12px;"><b>Lining</b></div>
                         <td style="font-size:12px;">
                             <div style="border: 1px solid black;height:20px; line-height:20px;">
                         <?php if($resListingcolor['lining']=='Yes'){

                         echo "Yes";
                         }
                         ?>

                        <?php if($resListingcolor['lining']=='No'){

                         echo "No";
                         }
                         ?>
						</div>
                         </td>
                         </td>

                       </tr>

                      </table>


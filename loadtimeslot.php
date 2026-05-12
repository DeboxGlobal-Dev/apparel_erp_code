<?php
include "inc.php";
include "config/logincheck.php";
$assignTo =$_REQUEST['assignTo'];
$scheduleId =$_REQUEST['scheduleId'];
$styleId=$_REQUEST['styleId'];
?>
<div class="form-group">
<label>Time Slot</label>

 <div class="table-responsive" style="height: 100px;overflow-y: scroll;">
						<table class="table">
							<thead>
								<tr class="bg-blue">
									<th>&nbsp;</th>
									<th>Date</th>
									<th>From</th>
									<th>To</th>
									<th>Slot</th>
								</tr>
							</thead>
							<tbody>

								<?php
								$select1='*';
								$where1='1 and addedBy="'.$assignTo.'" and addDate>="'.date('Y-m-d').'" order by addDate,fromTime,toTime desc';
								$rs1=GetPageRecord($select1,'sheduleMaster',$where1);

								while($resListingtimeslot=mysqli_fetch_array($rs1)){
								$selecta='*';
						        $wherea='styleId="'.$styleId.'" and scheduleId="'.$resListingtimeslot['id'].'"';
								$rsa=GetPageRecord($selecta,'materialCostChatMaster',$wherea);
								$countbookedschedule = mysqli_num_rows($rsa);

								?>
								<tr>
									<td><input type="radio" name="timeSlot" id="timeSlot" value="<?php echo $resListingtimeslot['id']; ?>" <?php if($scheduleId==$resListingtimeslot['id']) { ?> checked <?php } ?>/></td>
									<td><?php echo date('d M Y',strtotime($resListingtimeslot['addDate'])); ?></td>
									<td><?php echo $resListingtimeslot['fromTime']; ?></td>
									<td><?php echo $resListingtimeslot['toTime']; ?></td>
									<td><?php echo $resListingtimeslot['approveLimit']-$countbookedschedule; ?></td>
								</tr>
								<?php } ?>

							</tbody>
						</table>
					</div>


</div>
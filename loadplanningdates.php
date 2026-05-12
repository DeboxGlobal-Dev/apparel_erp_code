<?php
include "inc.php";
$sno = 0;
$whereAct='styleId="'.decode($_REQUEST['styleid']).'" order by id asc';
$rsAct=GetPageRecord('*','samplingActivityMaster',$whereAct);
while($resListingAct=mysqli_fetch_array($rsAct)){
$sno++;
?>
<tr>
    <td><?php echo $sno; ?></td>
    <td><?php echo getActivityTypeName($resListingAct['activityId']); ?></td>
    <td><?php echo getColorName($resListingAct['colorId']); ?></td>
    <td><?php echo date('d-m-Y',strtotime($resListingAct['plannedDate'])); ?></td>
    <td><?php echo $resListingAct['wip']; ?></td>
    <td><?php echo $resListingAct['totalDispatch']; ?></td>
    <td><?php if($resListingAct['actualDate']!='0000-00-00'){ echo date('d-m-Y',strtotime($resListingAct['actualDate'])); } ?></td>
    <td><?php if($resListingAct['status']==0){ echo 'In-Complete'; }else{ echo 'Completed'; } ?></td>
    <td>
        <a href="#" onclick="opmodalpop(' Edit Activity','modalpop.php?action=editactivity&styleId=<?php echo $_REQUEST['styleid']; ?>&id=<?php echo encode($resListingAct['id']); ?>','600px','auto');" data-toggle="modal" data-target="#modalpop"><b>Edit</b></a>
    </td>
</tr>
<?php }
if($sno==0){
?>
<tr>
    <td colspan="7">No record found..</td>
</tr>
<?php } ?>
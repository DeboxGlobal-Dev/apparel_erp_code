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
$patternAttachment = $editresultstyle['patternAttachment'];
$attachmentFile = $editresultstyle['attachmentFile'];
$techpackdescription = $editresultstyle['techpackdescription'];
$lastId=$editresultstyle['id'];

}

?>
<style>
.erptab tr td {
    border-top: 0px solid #ccc !important;
    padding: 0.55rem !important;
}

.erptab {
    border: 1px solid #ccc !important;
}

.erpint {
    border: 1px solid #b3acac;
    padding: 3px 6px;
    width: 100%;
    font-size: 1.15em;
}
</style>
<div class="page-content">
    <?php include "left.php"; ?>
    <div class="content-wrapper">
        <div class="content pt-0" style="margin-top:20px;">
            <?php include "top-style.php"; ?>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h6 class="card-title">File Handover</h6>
                        </div>
                        <div class="card-body">
                            <?php
                             $rrrr=GetPageRecord('*','fileHandoverMaster','1 and styleId="'.decode($_GET['styleid']).'"');
                        $operation=mysqli_fetch_array($rrrr);
                ?>
                            <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf"
                                id="popid">
                                <input name="action" type="hidden" id="action" value="merchantfilehandover" />
                                <input type="hidden" name="styleid" id="styleid"
                                    value="<?php echo $_GET['styleid']; ?>" />
                                <input type="hidden" name="editId" id="editId"
                                    value="<?php echo encode($operation['id']); ?>" />
                                <table class="table erptab table-hover" style="width:100%">
                                    <tr style="background: #0288d1;">
                                        <td colspan="4">
                                            <div style="text-transform:capitalize;color:white;font-size: 15px;">File
                                                Handover
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:26%">
                                            <div style="text-transform:capitalize;">
                                                <b>PO&nbsp;Details&nbsp;Size&nbsp;Break</b></div>
                                        </td>

                                        <?php
                                $qtyTotal =0;
                                $grossTotal = 0;
                                $selectqty='*';
                                $whereqty='styleId="'.$editresultstyle['id'].'"';
                                $rsqty=GetPageRecord($selectqty,'buyerPurchaseOrderMaster',$whereqty);
                                $resultqty=mysqli_fetch_array($rsqty);

                                    $total=0;
                  $rrrr=GetPageRecord('*','poManageMaster','1  and styleId="'.$editresultstyle['id'].'"');
                while($operationData=mysqli_fetch_array($rrrr)){
                     $total+= $operationData['poQty'];
                  }
                   $difference = $resultqty['qtyTotal'] - $total;
                 if($difference == "0" && $resultqty['qtyTotal'] !="0"){ ?>
                                        <td>
                                            <a
                                                href="showpage.crm?module=buyerpo&add=yes&styleid=<?php echo $_GET['styleid']; ?>">Completed</a>

                                        </td>
                                        <?php } else if ($resultqty['qtyTotal'] == $difference) { ?>
                                        <td>
                                            <a
                                                href="showpage.crm?module=buyerpo&add=yes&styleid=<?php echo $_GET['styleid']; ?>">Pending</a>
                                        </td>
                                        <?php  } else { ?>
                                            <td>
                                        <a
                                            href="showpage.crm?module=buyerpo&add=yes&styleid=<?php echo $_GET['styleid']; ?>">Pending</a>
                                        </td>
                                        <?php } ?>

                                        <td>
                                            <div style="text-transform:capitalize"><b>Final&nbsp;Tech&nbsp;Pack</b>
                                            </div>

                                            </td>
                                        <?php
                                        $rrrr1=GetPageRecord('*','criticpop','1 and styleId="'.decode($_GET['styleid']).'" and datarow="finaltp" order by id desc');
                                        $popdata14=mysqli_fetch_array($rrrr1);
                                        $fptnum=mysql_num_rows($rrrr1);
                                        ?>

                                        <td>
                                        <span class="badge" style="cursor:pointer;background-color:green; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;"  onclick="opmodalpop('','modalpop.php?action=upsc&styleid=<?php echo $_GET['styleid']; ?>&poId=<?php echo $_GET['poId']; ?>&datarow=finaltp','600px','auto');" data-toggle="modal" data-target="#modalpop"> Upload</span>
                                        <?php if($fptnum>0){ ?>
<a href="<?php echo $popdata14['attachtp']; ?>" target="blank">&nbsp;&nbsp;<i class="fa fa-download" aria-hidden="true" style="display: inherit;margin-right: 5px;"></i>Download</a>
                                        <?php }
                                        ?></td>
                                        <!-- <?php if($editresultstyle['attachmentFile']!=''){ ?>
                                        <td><input style="color: green;border: none" type="text" class="erpint"
                                                name="techpack" id="techpack" value="Completed" readonly> </td>
                                        <?php } else  {  ?>
                                        <td> <input style="color: red;border: none" type="text" class="erpint"
                                                name="techpack" id="techpack" value="pending" readonly> </td>
                                        <?php } ?> -->


                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-transform:capitalize;"><b>Approved&nbsp;Sealer</b></div>
                                        </td>
                                        <td>
                                            <select name="appseal" id="appseal" class="erpint" style="padding:4px;">
                                                <option value="1" <?php if($operation['appseal'] == "1" ) { ?>
                                                    selected="selected" <?php } ?>>Yes</option>
                                                <option value="2" <?php if($operation['appseal'] == "2" ) { ?>
                                                    selected="selected" <?php } ?>>No</option>
                                            </select>
                                        </td>
                                        <td>
                                            <div style="text-transform:capitalize"><b>Approved&nbsp;PP&nbsp;Comments</b>
                                            </div>
                                        </td>
                                        <td>
                                            <select name="comments" id="comments" class="erpint" style="padding:4px;">
                                                <option value="1" <?php if($operation['comments'] == "1" ) { ?>
                                                    selected="selected" <?php } ?>>Yes</option>
                                                <option value="2" <?php if($operation['comments'] == "2" ) { ?>
                                                    selected="selected" <?php } ?>>No</option>
                                            </select>
                                            <a
                                                href="showpage.crm?module=criticalpath&add=yes&styleid=<?php echo $_GET['styleid']; ?>">Click
                                                for Details</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-transform:capitalize;"><b>TNA</b></div>
                                        </td>
                                        <?php

                                $selectqty='*';
                                $whereqtye='styleId="'.$editresultstyle['id'].'"';
                                $rsqtye=GetPageRecord($selectqty,'timeActionReport',$whereqtye);

                  if(mysql_num_rows($rsqtye) > 0 ){ ?>
                                        <td><a
                                                href="showpage.crm?module=timeandaction&add=yes&styleid=<?php echo $_GET['styleid']; ?>">Yes</a>
                                            <input type="hidden" class="erpint" style="border: none;" name="tna"
                                                id="tna" value="Yes" readonly>
                                        </td>
                                        <?php } else { ?>
                                        <td><input type="text" class="erpint" style="border: none;" name="tna" id="tna"
                                                value="No" readonly></td>
                                        <?php } ?>

                                        <td style="width:26%">
                                            <div style="text-transform:capitalize"><b>Fabric & Trim Indent</b></div>
                                        </td>
                                        <?php
 $qtyTotal =0;
$grossTotal = 0;
$selectqty='*';
$whereqty='styleId="'.decode($_GET['styleid']).'"';
$rsqty=GetPageRecord($selectqty,'buyerPurchaseOrderMaster',$whereqty);
$resultqty=mysqli_fetch_array($rsqty);
						 ?>
                                        <td>
                                            <!--<input type="text" class="erpint" name="fabrictrim" id="fabrictrim" value="<?php echo $operation['fabrictrim'] ?>">-->
                                            <a href="showpage.crm?module=approvedindent&add=yes&styleid=<?php echo $_GET['styleid']; ?>&indentno=<?php echo encode($resultqty['indentNumber']); ?>"
                                                target="_blank">GO TO Indent</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:18%;">
                                            <div style="text-transform:capitalize;"><b>CAD&nbsp;Marker</b></div>
                                        </td>
                                        <td>
                                            <?php
$whereccc='styleId="'.decode($_GET['styleid']).'" and sectionType="marker" order by id desc';
$rsccc=GetPageRecord('attachtp','techpackPatternMarkerUpload',$whereccc);
$resultccc=mysqli_fetch_array($rsccc);
?>
                                            <input type="text" class="erpint" name="cadmarker" id="cadmarker"
                                                value="<?php echo $operation['cadmarker'] ?>">
                                            <?php if($operation['cadmarker']=="Done"){ ?>
                                            <a href="images/<?php echo $resultccc['attachtp']; ?>" target="_blank">View
                                                Attachment</a>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <div style="text-transform:capitalize"><b>FPT&nbsp;Report</b></div>
                                        </td>
                                        <td>
                                            <!-- <?php
                  $tdra=GetPageRecord('*','criticalPathMaster','1 and styleId="'.$editresultstyle['id'].'" limit 1');
                  if(mysql_num_rows($tdra) > "0") {
                  while($new1=mysqli_fetch_array($tdra)) {

                    if($new1['devFtp']!="" and $new1['bulkFtp']!=""){ ?>
                                            <input style="color: green;border: none" type="text" class="erpint"
                                                name="ftp" id="ftp" value="Completed" readonly>
                                            <?php  }
                  else if($new1['devFtp']!="" || $new1['bulkFtp']!="") { ?>
                                            <input style="color: orange;border: none" type="text" class="erpint"
                                                name="ftp" id="ftp" value="Partial" readonly>
                                            <?php } else{ ?>
                                            <input style="color: red;border: none" type="text" class="erpint" name="ftp"
                                                id="ftp" value="Pending" readonly>
                                            <?php } } }
                  else{ ?>
                                            <input style="color: red;border: none" type="text" class="erpint" name="ftp"
                                                id="ftp" value="Pending" readonly>
                                            <?php } ?> -->
                                            <span class="badge" style="cursor:pointer;background-color:green; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;"  onclick="opmodalpop('','modalpop.php?action=upsc&styleid=<?php echo $_GET['styleid']; ?>&poId=<?php echo $_GET['poId']; ?>&datarow=devlopfpt','600px','auto');" data-toggle="modal" data-target="#modalpop"> Upload</span>
                                        <?php
                                        $rrrr1=GetPageRecord('*','criticpop','1 and styleId="'.decode($_GET['styleid']).'" and datarow="devlopfpt" order by id desc');
                                        $popdata14=mysqli_fetch_array($rrrr1);
                                        $fptnum=mysql_num_rows($rrrr1);
                                        if($fptnum>0){ ?>
<a href="<?php echo $popdata14['attachtp']; ?>" target="blank">&nbsp;&nbsp;<i class="fa fa-download" aria-hidden="true" style="display: inherit;margin-right: 5px;"></i>Download</a>
                                        <?php }
                                        ?>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td>
                                            <div style="text-transform:capitalize"><b>GPT&nbsp;Report</b></div>
                                        </td>
                                        <td>
                                            <!-- <?php
                  $tdra=GetPageRecord('*','criticalPathMaster','1 and styleId="'.$editresultstyle['id'].'" limit 1');
                  if(mysql_num_rows($tdra) > "0") {
                  while($new1=mysqli_fetch_array($tdra)) {

                    if($new1['devGtp']!="" and $new1['bulkGtp']!=""){ ?>
                                            <input style="color: green;border: none" type="text" class="erpint"
                                                name="gtp" id="gtp" value="Completed" readonly>
                                            <?php  }
                  else if($new1['devGtp']!="" || $new1['bulkGtp']!="") { ?>
                                            <input style="color: orange;border: none" type="text" class="erpint"
                                                name="gtp" id="gtp" value="Partial" readonly>
                                            <?php } else{ ?>
                                            <input style="color: red;border: none" type="text" class="erpint" name="gtp"
                                                id="gtp" value="Pending" readonly>
                                            <?php } } }
                  else{ ?>
                                            <input style="color: red;border: none" type="text" class="erpint" name="gtp"
                                                id="gtp" value="Pending" readonly>
                                            <?php } ?> -->
                                            <span class="badge" style="cursor:pointer;background-color:green; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;"  onclick="opmodalpop('','modalpop.php?action=upsc&styleid=<?php echo $_GET['styleid']; ?>&poId=<?php echo $_GET['poId']; ?>&datarow=devlopgpt','600px','auto');" data-toggle="modal" data-target="#modalpop"> Upload</span>
                                        <?php
                                        $rrrr1=GetPageRecord('*','criticpop','1 and styleId="'.decode($_GET['styleid']).'" and datarow="devlopgpt" order by id desc');
                                        $popdata14=mysqli_fetch_array($rrrr1);
                                        $fptnum=mysql_num_rows($rrrr1);
                                        if($fptnum>0){ ?>
<a href="<?php echo $popdata14['attachtp']; ?>" target="blank">&nbsp;&nbsp;<i class="fa fa-download" aria-hidden="true" style="display: inherit;margin-right: 5px;"></i>Download</a>
                                        <?php }
                                        ?>
                                        </td>
                                        <td style="width:26%">
                                            <div style="text-transform:capitalize">
                                                <b>Approved&nbsp;Fabric&nbsp;FOB&nbsp;&&nbsp;Lots </b></div>
                                        </td>
                                        <td><select name="fob" id="fob" class="erpint" style="padding:4px;">
                                                <option>Select</option>
                                                <option value="1" <?php if($operation['fob'] == "1" ) { ?>
                                                    selected="selected" <?php } ?>>Partial</option>
                                                <option value="2" <?php if($operation['fob'] == "2" ) { ?>
                                                    selected="selected" <?php } ?>>Pending</option>
                                                <option value="3" <?php if($operation['fob'] == "3" ) { ?>
                                                    selected="selected" <?php } ?>>Complete</option>
                                            </select>
                                            <a
                                                href="showpage.crm?module=criticalpath&add=yes&styleid=<?php echo $_GET['styleid']; ?>">Click
                                                for Details</a>
                                        </td>
                                    </tr>
                                    <!--<tr>
                         <td><div style="text-transform:capitalize"><b>Approved&nbsp;Fabric&nbsp;FOB with&nbsp;Value&nbsp;Addition</b></div></td>
                         <td><select name="fobadd" id="fobadd" class="erpint" style="padding:4px;">
                         	<option>Select</option>
                         	<option value="1" <?php if($operation['fobadd'] == "1" ) { ?> selected="selected" <?php } ?>>Partial</option>
                         	<option value="2" <?php if($operation['fobadd'] == "2" ) { ?> selected="selected" <?php } ?>>Pending</option>
                         	<option value="3" <?php if($operation['fobadd'] == "3" ) { ?> selected="selected" <?php } ?>>Complete</option>
                         </select></td>
                         <td style="width:26%"><div style="text-transform:capitalize"><b>Fabric</b></div></td>
                         <td><input type="text" class="erpint" name="fabric" id="fabric" value="<?php echo $operation['fabric'] ?>" > </td>
                     </tr>-->
                                    <tr>
                                        <td colspan="3"></td>
                                        <td>
                                            <?php if($operation['sendppc'] == "1") {
                            		?>
                                            <button class="btn"
                                                style="float:right;background-color:#39841e ;color: white;">File Sent<i
                                                    class="fa fa-share-square-o ml-2" aria-hidden="true"
                                                    style="margin:0px;"></i></button>
                                            <?php } else { ?>
                                            <button type="submit" name="sendppc" class="btn"
                                                style="float:right;background-color: #e62424;color: white;">Send to
                                                PPC<i class="fa fa-floppy-o ml-2" aria-hidden="true"
                                                    style="margin:0px;"></i></button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                </table>
                                <br>
                                <button type="submit" name="filesubmit" class="btn btn-primary"
                                    style="float:right;">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true"
                                        style="margin:0px;"></i></button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<style>
.nav-justified .nav-item {
    text-align: center;
    width: 50% !important;
    display: contents;
    float: left;
}

.nav-tabs-highlight .nav-link {
    width: 50% !important;
    float: left;

}

.nav-tabs .nav-item.show .nav-link,
.nav-tabs .nav-link.active {
    color: #333;
    background-color: #fff;
    border-color: #ddd #ddd #fff;
    background-color: #fff178 !important;
    border: 1px solid #ccc;
}

.nav-tabs-highlight .nav-link {
    width: 50% !important;
    float: left;
    border: 1px solid #e9e9e9;
    background-color: #f9f9f9 !important;
}
</style>

<style>
input[type=checkbox],
input[type=radio] {

    display: none !important;
}
</style>
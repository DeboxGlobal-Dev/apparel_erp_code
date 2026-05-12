<?php
include "inc.php";  
include "config/logincheck.php"; 

$accessoriesArtwork = "TRUNCATE TABLE accessoriesArtwork";
mysql_query($accessoriesArtwork) or die(mysql_error());

$accountsMaster = "TRUNCATE TABLE accountsMaster";
mysql_query($accountsMaster) or die(mysql_error());

$addressMaster = "TRUNCATE TABLE addressMaster";
mysql_query($addressMaster) or die(mysql_error());

$balancesMaster = "TRUNCATE TABLE balancesMaster";
mysql_query($balancesMaster) or die(mysql_error());

$bankDetailsMaster = "TRUNCATE TABLE bankDetailsMaster";
mysql_query($bankDetailsMaster) or die(mysql_error());

$bomPoMaster = "TRUNCATE TABLE bomPoMaster";
mysql_query($bomPoMaster) or die(mysql_error());

$bookembroideryMaster = "TRUNCATE TABLE bookembroideryMaster";
mysql_query($bookembroideryMaster) or die(mysql_error());

$bookWashingMaster = "TRUNCATE TABLE bookWashingMaster";
mysql_query($bookWashingMaster) or die(mysql_error());

$buyerPurchaseOrderMaster = "TRUNCATE TABLE buyerPurchaseOrderMaster";
mysql_query($buyerPurchaseOrderMaster) or die(mysql_error());

$cdnStyleMaster = "TRUNCATE TABLE cdnStyleMaster";
mysql_query($cdnStyleMaster) or die(mysql_error());

$chaalanMaster = "TRUNCATE TABLE chaalanMaster";
mysql_query($chaalanMaster) or die(mysql_error());

$chatMaster = "TRUNCATE TABLE chatMaster";
mysql_query($chatMaster) or die(mysql_error());

$complaintMaster = "TRUNCATE TABLE complaintMaster";
mysql_query($complaintMaster) or die(mysql_error());

$complaintRemarksMaster = "TRUNCATE TABLE complaintRemarksMaster";
mysql_query($complaintRemarksMaster) or die(mysql_error());

$contactPersonMaster = "TRUNCATE TABLE contactPersonMaster";
mysql_query($contactPersonMaster) or die(mysql_error());

$contactsMaster = "TRUNCATE TABLE contactsMaster";
mysql_query($contactsMaster) or die(mysql_error());

$criticalMaster = "TRUNCATE TABLE criticalMaster";
mysql_query($criticalMaster) or die(mysql_error());

$criticalPathMaster = "TRUNCATE TABLE criticalPathMaster";
mysql_query($criticalPathMaster) or die(mysql_error());

$cutplanmaster = "TRUNCATE TABLE cutplanmaster";
mysql_query($cutplanmaster) or die(mysql_error());

$cutplanmastersum = "TRUNCATE TABLE cutplanmastersum";
mysql_query($cutplanmastersum) or die(mysql_error());

$debitvoucherMaster = "TRUNCATE TABLE debitvoucherMaster";
mysql_query($debitvoucherMaster) or die(mysql_error());

$documentMaster = "TRUNCATE TABLE documentMaster";
mysql_query($documentMaster) or die(mysql_error());

$documentSubFolder = "TRUNCATE TABLE documentSubFolder";
mysql_query($documentSubFolder) or die(mysql_error());

$emailMaster = "TRUNCATE TABLE emailMaster";
mysql_query($emailMaster) or die(mysql_error());

$fabricDetailSheetMaster = "TRUNCATE TABLE fabricDetailSheetMaster";
mysql_query($fabricDetailSheetMaster) or die(mysql_error());

$fileHandoverMaster = "TRUNCATE TABLE fileHandoverMaster";
mysql_query($fileHandoverMaster) or die(mysql_error());

$grnMaster = "TRUNCATE TABLE grnMaster";
mysql_query($grnMaster) or die(mysql_error());

$indentCreationMaster = "TRUNCATE TABLE indentCreationMaster";
mysql_query($indentCreationMaster) or die(mysql_error());

$lineLayoutMaster = "TRUNCATE TABLE lineLayoutMaster";
mysql_query($lineLayoutMaster) or die(mysql_error());

$linePlanMaster = "TRUNCATE TABLE linePlanMaster";
mysql_query($linePlanMaster) or die(mysql_error());

$loadpackinglistmaster = "TRUNCATE TABLE loadpackinglistmaster";
mysql_query($loadpackinglistmaster) or die(mysql_error());

$materialSendToSupplier = "TRUNCATE TABLE materialSendToSupplier";
mysql_query($materialSendToSupplier) or die(mysql_error());

$materialSendToVendor = "TRUNCATE TABLE materialSendToVendor";
mysql_query($materialSendToVendor) or die(mysql_error());

$measurementchartmaster = "TRUNCATE TABLE measurementchartmaster";
mysql_query($measurementchartmaster) or die(mysql_error());

$mobile_register = "TRUNCATE TABLE mobile_register";
mysql_query($mobile_register) or die(mysql_error());

$notificationMaster = "TRUNCATE TABLE notificationMaster";
mysql_query($notificationMaster) or die(mysql_error());
 
$operationbulletinamaster = "TRUNCATE TABLE operationbulletinamaster";
mysql_query($operationbulletinamaster) or die(mysql_error());

$operationbulletinentry = "TRUNCATE TABLE operationbulletinentry";
mysql_query($operationbulletinentry) or die(mysql_error());

$operationBulletinVersionMaster = "TRUNCATE TABLE operationBulletinVersionMaster";
mysql_query($operationBulletinVersionMaster) or die(mysql_error());

$pdtopromaster = "TRUNCATE TABLE pdtopromaster";
mysql_query($pdtopromaster) or die(mysql_error());

$pdtopromasterenrty = "TRUNCATE TABLE pdtopromasterenrty";
mysql_query($pdtopromasterenrty) or die(mysql_error());

$poManageMaster = "TRUNCATE TABLE poManageMaster";
mysql_query($poManageMaster) or die(mysql_error());

$purchaseOrderStyleMaster = "TRUNCATE TABLE purchaseOrderStyleMaster";
mysql_query($purchaseOrderStyleMaster) or die(mysql_error());

$qualityInspectionMaster = "TRUNCATE TABLE qualityInspectionMaster";
mysql_query($qualityInspectionMaster) or die(mysql_error());

$qualitymodulemaster = "TRUNCATE TABLE qualitymodulemaster";
mysql_query($qualitymodulemaster) or die(mysql_error());
 
$qualityreportmaster = "TRUNCATE TABLE qualityreportmaster";
mysql_query($qualityreportmaster) or die(mysql_error());

$randdMaster = "TRUNCATE TABLE randdMaster";
mysql_query($randdMaster) or die(mysql_error());

$recorderInputMaster = "TRUNCATE TABLE recorderInputMaster";
mysql_query($recorderInputMaster) or die(mysql_error());

$sampleDispatchMaster = "TRUNCATE TABLE sampleDispatchMaster";
mysql_query($sampleDispatchMaster) or die(mysql_error());

$styleColorDetailMaster = "TRUNCATE TABLE styleColorDetailMaster";
mysql_query($styleColorDetailMaster) or die(mysql_error());

$subtnaMaster = "TRUNCATE TABLE subtnaMaster";
mysql_query($subtnaMaster) or die(mysql_error());

$suppliermiceCommunicationMail = "TRUNCATE TABLE suppliermiceCommunicationMail";
mysql_query($suppliermiceCommunicationMail) or die(mysql_error());

$supplierPurchasemail = "TRUNCATE TABLE supplierPurchasemail";
mysql_query($supplierPurchasemail) or die(mysql_error());

$testRequisitionForm = "TRUNCATE TABLE testRequisitionForm";
mysql_query($testRequisitionForm) or die(mysql_error());

$tightCostMaster = "TRUNCATE TABLE tightCostMaster";
mysql_query($tightCostMaster) or die(mysql_error());

$timeActionFavourite = "TRUNCATE TABLE timeActionFavourite";
mysql_query($timeActionFavourite) or die(mysql_error());

$timeActionReport = "TRUNCATE TABLE timeActionReport";
mysql_query($timeActionReport) or die(mysql_error());

$trimdatamaster = "TRUNCATE TABLE trimdatamaster";
mysql_query($trimdatamaster) or die(mysql_error());
 
$vendorPurchasemail = "TRUNCATE TABLE vendorPurchasemail";
mysql_query($vendorPurchasemail) or die(mysql_error());
 

$queryMaster = "TRUNCATE TABLE queryMaster";
mysql_query($queryMaster) or die(mysql_error());
 
$querymails = "TRUNCATE TABLE querymails";
mysql_query($querymails) or die(mysql_error());

$styleAssignmentMaster = "TRUNCATE TABLE styleAssignmentMaster";
mysql_query($styleAssignmentMaster) or die(mysql_error());

$materialCostChatMaster = "TRUNCATE TABLE materialCostChatMaster";
mysql_query($materialCostChatMaster) or die(mysql_error());

$costsheetVersionMaster = "TRUNCATE TABLE costsheetVersionMaster";
mysql_query($costsheetVersionMaster) or die(mysql_error());

$styleSubCategoryMaster = "TRUNCATE TABLE styleSubCategoryMaster";
mysql_query($styleSubCategoryMaster) or die(mysql_error());

$techPackDetailMaster = "TRUNCATE TABLE techPackDetailMaster";
mysql_query($techPackDetailMaster) or die(mysql_error());

$extraChargesDetailMaster = "TRUNCATE TABLE extraChargesDetailMaster";
mysql_query($extraChargesDetailMaster) or die(mysql_error());

$imageGallery = "TRUNCATE TABLE imageGallery";
mysql_query($imageGallery) or die(mysql_error());

$styleTechPackMaster = "TRUNCATE TABLE styleTechPackMaster";
mysql_query($styleTechPackMaster) or die(mysql_error());

$techPackImageMaster = "TRUNCATE TABLE techPackImageMaster";
mysql_query($techPackImageMaster) or die(mysql_error());


mysql_query("TRUNCATE TABLE loadExternalChallanMaster") or die(mysql_error());

mysql_query("TRUNCATE TABLE externalChallan") or die(mysql_error());

mysql_query("TRUNCATE TABLE greigeRequisition") or die(mysql_error());

mysql_query("TRUNCATE TABLE greigeAllocation") or die(mysql_error());

mysql_query("TRUNCATE TABLE gateentrymaster") or die(mysql_error());

mysql_query("TRUNCATE TABLE yarnAllocation") or die(mysql_error());

mysql_query("TRUNCATE TABLE yarnRequisition") or die(mysql_error());

mysql_query("TRUNCATE TABLE chaalanMaster") or die(mysql_error());

?>
 
<script type="text/javascript">
	alert('Database Truncated successfully..!');
</script>


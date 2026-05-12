<?php
include "inc.php";

if($_REQUEST['action']=="savemeasurmentdata" && $_REQUEST['id']!=''){
$name = clean($_REQUEST['name']);
$small = clean($_REQUEST['measureSmall']);
$medium = clean($_REQUEST['measureMedium']);
$large = clean($_REQUEST['measureLarge']);
$xl = clean($_REQUEST['measureXL']);
$xxl = clean($_REQUEST['measureXXL']);
$tol = clean($_REQUEST['measureTOL']);
$xs = clean($_REQUEST['measureXS']);
$namevalue ='name="'.$name.'",small="'.$small.'",medium="'.$medium.'",large="'.$large.'",xl="'.$xl.'",xxl="'.$xxl.'",tol="'.$tol.'",xs="'.$xs .'"';

$where='id="'.decode($_REQUEST['id']).'"';
$update = updatelisting(_MEASUREMENT_CHART_MASTER_,$namevalue,$where);

}

if($_REQUEST['action']=="showsupplierdetail" && $_REQUEST['id']!=''){
$id = clean($_REQUEST['id']);

$rs=GetPageRecord('*','suppliersMaster','id="'.$id.'"');
$resListing=mysqli_fetch_array($rs);

$rsAdd=GetPageRecord('*',_ADDRESS_MASTER_,'1 and addressParent="'.$resListing['id'].'" and addressType="supplier"');
$resultrsAdd=mysqli_fetch_array($rsAdd);
?>
<div style="background-color: #f1f1f1; padding: 15px; margin-top: 8px; border: 1px solid #ccc; height:137px;">
  <p><span style="font-weight: 500;font-size: 15px;"><?php echo $resListing['name']; ?></span><br />
  <span>Email: <?php echo $resListing['email']; ?><br /></span>
  <span>Phone: <?php echo $resListing['phone']; ?><br /></span>
  <span>Address: <?php echo $resultrsAdd['address'].', '.getStateName($resultrsAdd['stateId']).' ('.getCountryName($resultrsAdd['countryId']).')'; ?><br /></span>
  <span>GSTIN: </span>

</div>
<?php
}

if($_REQUEST['action']=="showbuyerdetail" && $_REQUEST['id']!=''){
$id = clean($_REQUEST['id']);

$rs=GetPageRecord('*','buyerMaster','id="'.$id.'"');
$resListing=mysqli_fetch_array($rs);

?>
<div style="background-color: #f1f1f1; padding: 15px; margin-top: 8px; border: 1px solid #ccc; height:137px;">
  <p><span style="font-weight: 500;font-size: 15px;"><?php echo $resListing['name']; ?></span><br />
  <span>867, Joshi Road, Karol Bagh,<br />Delhi - 110005<br />Delhi(07) India</span> <br />
  <span style="font-weight: 500;">GSTIN:</span>
  <strong>07AAFFA1530L1ZP</strong></p>
</div>
<?php
}

//=========================================================================addd quality module==================================================================
if($_REQUEST['action']=="savequalitymoduledata" && $_REQUEST['id']!=''){

$pee_empro = clean($_REQUEST['pee_empro']);
$shadelot = clean($_REQUEST['shadelot']);
$on_tag = clean($_REQUEST['on_tag']);
$actual = clean($_REQUEST['actual']);
$required = clean($_REQUEST['required']);
$actuala = clean($_REQUEST['actuala']);
$l = clean($_REQUEST['l']);
$w = clean($_REQUEST['w']);

$ll = clean($_REQUEST['ll']);
$ww = clean($_REQUEST['ww']);

$w03e = clean($_REQUEST['w03e']);
$w36e = clean($_REQUEST['w36e']);
$w69e = clean($_REQUEST['w69e']);
$wabove9e = clean($_REQUEST['wabove9e']);

$s03t = clean($_REQUEST['s03t']);
$s36t = clean($_REQUEST['s36t']);
$s69t = clean($_REQUEST['s69t']);
$sabove9t = clean($_REQUEST['sabove9t']);
$s03b = clean($_REQUEST['s03b']);
$s36b = clean($_REQUEST['s36b']);
$fc = clean($_REQUEST['fc']);

$wb = clean($_REQUEST['wb']);
$patta = clean($_REQUEST['patta']);
$Ho01le = clean($_REQUEST['Ho01le']);
$Hoabovee = clean($_REQUEST['Hoabovee']);

$p03d = clean($_REQUEST['p03d']);
$p36d = clean($_REQUEST['p36d']);
$p69d = clean($_REQUEST['p69d']);
$paboved = clean($_REQUEST['paboved']);

$inches = clean($_REQUEST['inches']);
$bowing = clean($_REQUEST['bowing']);



$beforew = clean($_REQUEST['beforew']);
$afterw = clean($_REQUEST['afterw']);



$totalpointsfound = clean($_REQUEST['totalpointsfound']);

$pperhun = clean($_REQUEST['pperhun']);
$remarks = clean($_REQUEST['remarks']);
$lotNoMaster = clean($_REQUEST['lotNoMaster']);

$where='id="'.decode($_REQUEST['id']).'"';

$namevalue ='pee_empro="'.$pee_empro.'",shadelot="'.$shadelot.'",on_tag="'.$on_tag.'",actual="'.$actual.'",required="'.$required.'",actuala="'.$actuala.'",l="'.$l.'",w="'.$w .'",ll="'.$ll.'",ww="'.$ww.'",w03e="'.$w03e.'",w36e="'.$w36e.'",w69e="'.$w69e.'",wabove9e="'.$wabove9e.'",s03t="'.$s03t.'",s36t="'.$s36t.'",s69t="'.$s69t.'",sabove9t="'.$sabove9t.'",s03b="'.$s03b.'",s36b="'.$s36b.'",fc="'.$fc.'",wb="'.$wb.'",patta="'.$patta.'",Ho01le="'.$Ho01le.'",Hoabovee="'.$Hoabovee.'",p03d="'.$p03d.'",p36d="'.$p36d.'",p69d="'.$p69d.'",paboved="'.$paboved.'",inches="'.$inches.'",bowing="'.$bowing.'",totalpointsfound="'.$totalpointsfound.'",pperhun="'.$pperhun.'",remarks="'.$remarks.'",lotNoMaster="'.$lotNoMaster.'",beforew="'.$beforew.'",afterw="'.$afterw.'"';

$update = updatelisting('qualitymodulemaster',$namevalue,$where);

}

//===========================================================================add trim inspection input

if($_REQUEST['action']=="savetrimdatamaster" && $_REQUEST['id']!=''){

$item_trims = clean($_REQUEST['item_trims']);
$item_code = clean($_REQUEST['item_code']);
$vendor_name = clean($_REQUEST['vendor_name']);
$pono = clean($_REQUEST['pono']);
$receivedqty = clean($_REQUEST['receivedqty']);
$totalorderqty = clean($_REQUEST['totalorderqty']);
$lotno = clean($_REQUEST['lotno']);
$lotreceiveddate = clean(date('Y-m-d',strtotime($_REQUEST['lotreceiveddate'])));
$recievedutytlot = clean($_REQUEST['recievedutytlot']);
$recievedutytillnow = clean($_REQUEST['recievedutytillnow']);
$balancetoreceive = clean($_REQUEST['balancetoreceive']);
$inspectiondate = clean(date('Y-m-d',strtotime($_REQUEST['inspectiondate'])));
$okayqty = clean($_REQUEST['okayqty']);
$inspectionqty = clean($_REQUEST['inspectionqty']);
$rejectedqty = clean($_REQUEST['rejectedqty']);
$disputedqty = clean($_REQUEST['disputedqty']);
$remarks = clean($_REQUEST['remarks']);

$where='id="'.decode($_REQUEST['id']).'"';

$namevalue ='item_trims="'.$item_trims.'",item_code="'.$item_code.'",vendor_name="'.$vendor_name.'",pono="'.$pono.'",receivedqty="'.$receivedqty.'",totalorderqty="'.$totalorderqty.'",lotno="'.$lotno.'",lotreceiveddate="'.$lotreceiveddate.'",recievedutytlot="'.$recievedutytlot.'",recievedutytillnow="'.$recievedutytillnow.'",balancetoreceive="'.$balancetoreceive.'",inspectiondate="'.$inspectiondate.'",okayqty="'.$okayqty.'",inspectionqty="'.$inspectionqty.'",rejectedqty="'.$rejectedqty.'",disputedqty="'.$disputedqty.'",remarks="'.$remarks.'"';

$update = updatelisting('trimdatamaster',$namevalue,$where);

}


//=========================================================================== add quallity report data

if($_REQUEST['action']=="savequaalityinputreport" && $_REQUEST['styleid']!=''){

$accepted = clean($_REQUEST['accepted']);
$reprocessing = clean($_REQUEST['reprocessing']);
$rejectedreplaced = clean($_REQUEST['rejectedreplaced']);
$onhold = clean($_REQUEST['onhold']);
$closurDate = clean(date('Y-m-d',strtotime($_REQUEST['closurDate'])));
$closureby = clean($_REQUEST['closureby']);
$styleid = clean(decode($_REQUEST['styleid']));
$lotId = clean($_REQUEST['lotId']);
$materialid = clean($_REQUEST['materialid']);
$colorid = clean($_REQUEST['colorid']);
$materialMasterId = clean($_REQUEST['materialMasterId']);

deleteRecord('qualityreportmaster','styleid="'.$styleid.'" and lotId="'.$lotId.'" and  type="triminspectioninput"');
$namevalue ='accepted="'.$accepted.'",reprocessing="'.$reprocessing.'",rejectedreplaced="'.$rejectedreplaced.'",onhold="'.$onhold.'",closurDate="'.$closurDate.'",closureby="'.$closureby.'",styleid="'.$styleid.'",lotId="'.$lotId.'",type="triminspectioninput",materialid="'.$materialid.'",colorid="'.$colorid.'",materialMasterId="'.$materialMasterId.'"';
addlisting('qualityreportmaster',$namevalue);

}

//============================all line plan

if($_REQUEST['action']=="savelineplans"){

$dateWiseLineInput = clean($_REQUEST['dateWiseLineInput']);

$styleid = decode(clean($_REQUEST['styleid']));
$uploadInputDate = clean($_REQUEST['uploadInputDate']);
$factoryId = clean($_REQUEST['factoryId']);
$lineId = clean($_REQUEST['lineId']);
$linewiseefficiency = clean($_REQUEST['totalmyalloted']);

$namevalue ='styleId="'.$styleid.'",uploadInputDate="'.$uploadInputDate.'",factoryId="'.$factoryId.'",lineId="'.$lineId.'",dateWiseLineInput="'.$dateWiseLineInput.'",linewiseefficiency="'.$linewiseefficiency.'"';

$whereCheckref='styleId="'.$styleid.'" and  uploadInputDate="'.$uploadInputDate.'" and factoryId="'.$factoryId.'" and lineId="'.$lineId.'"';

$checkCoderef = checkduplicate('linePlanMaster',$whereCheckref);

if($checkCoderef=="yes"){
deleteRecord('linePlanMaster','styleId="'.$styleid.'" and  uploadInputDate="'.$uploadInputDate.'" and factoryId="'.$factoryId.'" and lineId="'.$lineId.'"');
}

addlisting('linePlanMaster',$namevalue);

}

//======================================save po cost vendor outsourcing================================================
if($_REQUEST['action']=="savepooutsourcepo" && $_REQUEST['styleid']!=''){


$rateinr = clean($_REQUEST['rateinr']);
$gstper = clean($_REQUEST['gstper']);
$totalgstval = clean($_REQUEST['totalgstval']);

$where='styleId="'.decode($_REQUEST['styleid']).'"';
$namevalue ='rateinr="'.$rateinr.'",gstper="'.$gstper.'",totalgstval="'.$totalgstval.'"';
$update = updatelisting('purchaseOrderStyleMaster',$namevalue,$where);

}
//======================================================================================================================================

//rejection on production
if($_REQUEST['action']=="saveloadrejectioninproduction" && $_REQUEST['id']!=''){

$orderqtypcolor = clean($_REQUEST['orderqtypcolor']);
$allowedper = clean($_REQUEST['allowedper']);
$extraforemb = clean($_REQUEST['extraforemb']);
$totalallwance = clean($_REQUEST['totalallwance']);
$extraforgarment = clean($_REQUEST['extraforgarment']);
$extraforprinting = clean($_REQUEST['extraforprinting']);
$extraforRfd = clean($_REQUEST['extraforRfd']);
$extraforsolid = clean($_REQUEST['extraforsolid']);

$where='id="'.decode($_REQUEST['id']).'"';
$namevalue ='orderqtypcolor="'.$orderqtypcolor.'",allowedper="'.$allowedper.'",extraforemb="'.$extraforemb.'",totalallwance="'.$totalallwance.'",extraforgarment="'.$extraforgarment.'",extraforprinting="'.$extraforprinting.'",extraforRfd="'.$extraforRfd.'",extraforsolid="'.$extraforsolid.'"';
$update = updatelisting('rejectioninproductionmaster',$namevalue,$where);

}

//============================shrinkageallowed===============================
if($_REQUEST['action']=="saveloadloadshrinkageallowed" && $_REQUEST['id']!=''){

$fabric = clean($_REQUEST['fabric']);
$greigewidth = clean($_REQUEST['greigewidth']);
$dwShrinkage = clean($_REQUEST['dwShrinkage']);
$dwwidthinhes = clean($_REQUEST['dwwidthinhes']);
$dcShrinkage = clean($_REQUEST['dcShrinkage']);
$dcwidthinhes = clean($_REQUEST['dcwidthinhes']);
$pShrinkage = clean($_REQUEST['pShrinkage']);
$pwidthinhes = clean($_REQUEST['pwidthinhes']);
$eShrinkage = clean($_REQUEST['eShrinkage']);
$ewidthinhes = clean($_REQUEST['ewidthinhes']);

$where='id="'.decode($_REQUEST['id']).'"';
$namevalue ='fabric="'.$fabric.'",greigewidth="'.$greigewidth.'",dwShrinkage="'.$dwShrinkage.'",dwwidthinhes="'.$dwwidthinhes.'",dcShrinkage="'.$dcShrinkage.'",dcwidthinhes="'.$dcwidthinhes.'",pShrinkage="'.$pShrinkage.'",pwidthinhes="'.$pwidthinhes.'",eShrinkage="'.$eShrinkage.'",ewidthinhes="'.$ewidthinhes.'"';
$update = updatelisting('shrinkageallowedmaster',$namevalue,$where);

}
//=====================================================add trim wastage allowed============================

if($_REQUEST['action']=="loadtrimwastageallowance" && $_REQUEST['id']!=''){

$itemhead = clean($_REQUEST['itemhead']);
$fextracutinintent = clean($_REQUEST['fextracutinintent']);
$faddextra = clean($_REQUEST['faddextra']);
$ftotalallowed = clean($_REQUEST['ftotalallowed']);

$sextracutinintent = clean($_REQUEST['sextracutinintent']);
$saddextra = clean($_REQUEST['saddextra']);
$stotalallowed = clean($_REQUEST['stotalallowed']);

$textracutinintent = clean($_REQUEST['textracutinintent']);
$taddextra = clean($_REQUEST['taddextra']);
$ttotalallowed = clean($_REQUEST['ttotalallowed']);


$where='id="'.decode($_REQUEST['id']).'"';
$namevalue ='itemhead="'.$itemhead.'",fextracutinintent="'.$fextracutinintent.'",faddextra="'.$faddextra.'",ftotalallowed="'.$ftotalallowed.'",sextracutinintent="'.$sextracutinintent.'",saddextra="'.$saddextra.'",stotalallowed="'.$stotalallowed.'",textracutinintent="'.$textracutinintent.'",taddextra="'.$taddextra.'",ttotalallowed="'.$ttotalallowed.'"';
$update = updatelisting('trimwastageallowancemaster',$namevalue,$where);

}

//==================add packing trims wastage allowed==================================================================

if($_REQUEST['action']=="loadpackingmaterialwastageallowancemaster" && $_REQUEST['id']!=''){

$itemhead = clean($_REQUEST['itemhead']);
$fextracutinintent = clean($_REQUEST['fextracutinintent']);
$faddextra = clean($_REQUEST['faddextra']);
$ftotalallowed = clean($_REQUEST['ftotalallowed']);

$sextracutinintent = clean($_REQUEST['sextracutinintent']);
$saddextra = clean($_REQUEST['saddextra']);
$stotalallowed = clean($_REQUEST['stotalallowed']);

$textracutinintent = clean($_REQUEST['textracutinintent']);
$taddextra = clean($_REQUEST['taddextra']);
$ttotalallowed = clean($_REQUEST['ttotalallowed']);

$where='id="'.decode($_REQUEST['id']).'"';
$namevalue ='itemhead="'.$itemhead.'",fextracutinintent="'.$fextracutinintent.'",faddextra="'.$faddextra.'",ftotalallowed="'.$ftotalallowed.'",sextracutinintent="'.$sextracutinintent.'",saddextra="'.$saddextra.'",stotalallowed="'.$stotalallowed.'",textracutinintent="'.$textracutinintent.'",taddextra="'.$taddextra.'",ttotalallowed="'.$ttotalallowed.'"';
$update = updatelisting('packingmaterialwastageallowancemaster',$namevalue,$where);

}



//===========================================================================add load packing list=========================================================
if($_REQUEST['action']=="savepackinglist" && $_REQUEST['id']!=''){

$containf = clean($_REQUEST['containfrm']);
$containt = clean($_REQUEST['containto']);
$cartonf = clean($_REQUEST['cartonfrm']);
$cartont = clean($_REQUEST['cartonto']);
$colour = clean($_REQUEST['colour']);
$colorcode = clean($_REQUEST['colorcode']);
$xxs = clean($_REQUEST['xxs']);
$xs = clean($_REQUEST['xs']);
$s = clean($_REQUEST['s']);
$m = clean($_REQUEST['m']);
$l = clean($_REQUEST['l']);
$xl = clean($_REQUEST['xl']);
$x2l = clean($_REQUEST['x2l']);
$x3l = clean($_REQUEST['x3l']);
$totalqty = clean($_REQUEST['totalqty']);
$qtypercont = clean($_REQUEST['qtypercont']);
$contNo = clean($_REQUEST['contNo']);
$boxwt = clean($_REQUEST['boxwt']);
$length = clean($_REQUEST['length']);
$breadth = clean($_REQUEST['breadth']);
$height = clean($_REQUEST['height']);
$ctn_net = clean($_REQUEST['ctn_net']);
$netwt = clean($_REQUEST['netwt']);
$gwt = clean($_REQUEST['gwt']);
$nnwt = clean($_REQUEST['nnwt']);
$nnwtperpcs = clean($_REQUEST['nnwtperpcs']);
$sizeone = clean($_REQUEST['sizeone']);


$where='id="'.decode($_REQUEST['id']).'"';

$namevalue ='containfrom="'.$containf.'",containto="'.$containt.'",cartonfrom="'.$cartonf.'",cartonto="'.$cartont.'",colour="'.$colour.'",colorcode="'.$colorcode.'",xxs="'.$xxs.'",xs="'.$xs.'",s="'.$s.'",m="'.$m.'",l="'.$l.'",xl="'.$xl.'",x2l="'.$x2l.'",qtypercont="'.$qtypercont.'",contNo="'.$contNo.'",totalqty="'.$totalqty.'",length="'.$length.'",breadth="'.$breadth.'",height="'.$height.'",ctn_net="'.$ctn_net.'",net_wt="'.$netwt.'",boxwt="'.$boxwt.'",gwt="'.$gwt.'",nnwt="'.$nnwt.'",nnwtperpcs="'.$nnwtperpcs.'",sizeone="'.$sizeone.'",x3l="'.$x3l.'"';

$update = updatelisting('loadpackinglistmaster',$namevalue,$where);

}

//===========================================================================save debit voucher data=========================================================
if($_REQUEST['action']=="savedebitvoucherdata" && $_REQUEST['id']!=''){

$accountHeadId = clean($_REQUEST['accountHeadId']);
$code = clean($_REQUEST['code']);
$debit = clean($_REQUEST['debit']);
$credit = clean($_REQUEST['credit']);
$amount = clean($_REQUEST['amount']);

$where='id="'.decode($_REQUEST['id']).'"';
$namevalue ='accountHeadId="'.$accountHeadId.'",code="'.$code.'",debit="'.$debit.'",credit="'.$credit.'",amount="'.$amount.'"';

$update = updatelisting('debitvoucherMaster',$namevalue,$where);

}

//===========================================================================save account bulletin data=========================================================
if($_REQUEST['action']=="saveoperationbuldata" && $_REQUEST['id']!=''){

$particular = clean($_REQUEST['particular']);
$sam = clean($_REQUEST['sam']);
$prodhrs = clean($_REQUEST['prodhrs']);
$machinetype = clean($_REQUEST['machinetype']);
$workads = clean($_REQUEST['workads']);
$oprreq = clean($_REQUEST['oprreq']);
$roundoff = clean($_REQUEST['roundoff']);

$where='id="'.decode($_REQUEST['id']).'"';
$namevalue ='particular="'.$particular.'",sam="'.$sam.'",prodhrs="'.$prodhrs.'",machinetype="'.$machinetype.'",workads="'.$workads.'",oprreq="'.$oprreq.'",roundoff="'.$roundoff.'"';
$update = updatelisting('operationbulletinamaster',$namevalue,$where);
}

//====================add handover data=================

if($_REQUEST['action']=="savepoprohandover" && $_REQUEST['id']!='' && $_REQUEST['styleid']!=''){
$id = clean($_REQUEST['id']);
$styleid = decode(clean($_REQUEST['styleid']));
$handoverstatus = clean($_REQUEST['handoverstatus']);
$handoverdate = clean(date('Y-m-d',strtotime($_REQUEST['handoverdate'])));

deleteRecord('pdtopromasterenrty','styleid="'.$styleid.'" and handoverid="'.$id.'"');

$namevalue ='handoverid="'.$id.'",styleid="'.$styleid.'",handoverstatus="'.$handoverstatus.'",handoverdate="'.$handoverdate.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'"';

addlisting('pdtopromasterenrty',$namevalue);

}

 //====================add po confirmation=================

if($_REQUEST['action']=="savepoprohandovers" && $_REQUEST['poid']!='' ){
$poid = clean($_REQUEST['poid']);
$styleid = clean($_REQUEST['styleid']);
$startdate = clean(date('Y-m-d',strtotime($_REQUEST['startdate'])));
$enddate = clean(date('Y-m-d',strtotime($_REQUEST['enddate'])));
$revisedshipmode = clean($_REQUEST['revisedshipmode']);
$revstatus = clean($_REQUEST['revstatus']);


$select='*';
$where='poId="'.$poid.'"';
$rs=GetPageRecord($select,'buyerpoConfirmationMaster',$where);
$editresultstyle=mysqli_fetch_array($rs);

if($poid==$editresultstyle['poId']){
    $whr='poId="'.$editresultstyle['poId'].'"';

$namevalue ='poId="'.$poid.'",revisedexfactorystart="'.$startdate.'",revisedexfactoryend="'.$enddate.'",revisedshipmode="'.$revisedshipmode.'",status="'.$revstatus.'"';

updatelisting('buyerpoConfirmationMaster',$namevalue,$whr);
}else{

$namevalue ='poId="'.$poid.'",revisedexfactorystart="'.$startdate.'",revisedexfactoryend="'.$enddate.'",revisedshipmode="'.$revisedshipmode.'",status="'.$revstatus.'"';

addlisting('buyerpoConfirmationMaster',$namevalue);
}
}


//===========================================================================save cut plan 21may2020===============================================================================
if($_REQUEST['action']=="savecutplan" && $_REQUEST['id']!=''){

$colorlay = clean($_REQUEST['colorlay']);
$pieceslay = clean($_REQUEST['pieceslay']);
$fabricreq = clean($_REQUEST['fabricreq']);
$fabricrec = clean($_REQUEST['fabricrec']);
$markerratio = clean($_REQUEST['markerratio']);
$noofpcs = clean($_REQUEST['noofpcs']);
$markerlength = clean($_REQUEST['markerlength']);
$noodpiles = clean($_REQUEST['noodpiles']);
$fabricused = clean($_REQUEST['fabricused']);
$wastage = clean($_REQUEST['wastage']);
$endbits = clean($_REQUEST['endbits']);
$totalfabused = clean($_REQUEST['totalfabused']);
$fabricexceed = clean($_REQUEST['fabricexceed']);
$fabriccompunded = clean($_REQUEST['fabriccompunded']);
$totalfabricorder = clean($_REQUEST['totalfabricorder']);
$totalfabricafterinspection = clean($_REQUEST['totalfabricafterinspection']);
$totalfabricbal = clean($_REQUEST['totalfabricbal']);
$fabricinhand = clean($_REQUEST['fabricinhand']);
$endbittotal = clean($_REQUEST['endbittotal']);
$cutdate = clean(date('Y-m-d',strtotime($_REQUEST['cutdate'])));
$styleId = clean($_REQUEST['styleId']);
$noofpiecestotal = clean($_REQUEST['noofpiecestotal']);
$fabricreqtotal = clean($_REQUEST['fabricreqtotal']);
$lotNoMaster = clean($_REQUEST['lotNoMaster']);



$where='id="'.decode($_REQUEST['id']).'"';
$namevalue ='colorlay="'.$colorlay.'",pieceslay="'.$pieceslay.'",fabricreq="'.$fabricreq.'",fabricrec="'.$fabricrec.'",markerratio="'.$markerratio.'",noofpcs="'.$noofpcs.'",markerlength="'.$markerlength.'",noodpiles="'.$noodpiles.'",fabricused="'.$fabricused.'",wastage="'.$wastage.'",endbits="'.$endbits.'",totalfabused="'.$totalfabused.'",fabricexceed="'.$fabricexceed.'",fabriccompunded="'.$fabriccompunded.'",totalfabricorder="'.$totalfabricorder.'",totalfabricafterinspection="'.$totalfabricafterinspection.'",totalfabricbal="'.$totalfabricbal.'",fabricinhand="'.$fabricinhand.'",endbittotal="'.$endbittotal.'",cutdate="'.$cutdate.'"';

$update = updatelisting('cutplanmaster',$namevalue,$where);
//=========================================
deleteRecord('cutplanmastersum','styleId="'.$styleId.'" and lotNoMaster="'.$lotNoMaster.'"');
$a ='noofpiecestotal="'.$noofpiecestotal.'",styleId="'.$styleId.'",fabricreqtotal="'.$fabricreqtotal.'",lotNoMaster="'.$lotNoMaster.'"';
$ab = addlisting('cutplanmastersum',$a);

}


if($_REQUEST['action']=="savetnaSerialNo" && $_REQUEST['id']!=''){
$srNooo = clean($_REQUEST['srNooo']);
$namevalue ='sr="'.$srNooo.'"';
$where='id="'.decode($_REQUEST['id']).'"';
$update = updatelisting('taskListMaster',$namevalue,$where);

}

/////////////////////////////////////=====================================SAVE INDENT INSPECTION DATA
if($_REQUEST['action']=="saveindentinspectiondata" && $_REQUEST['poNumber']!='' && $_REQUEST['supplierId']!=''){
$poNumber = clean($_REQUEST['poNumber']);
$supplierId = clean($_REQUEST['supplierId']);
$poTypeEntry = clean($_REQUEST['poTypeEntry']);
$packingDetailEntry = clean($_REQUEST['packingDetailEntry']);
$trasportDetailEntry = clean($_REQUEST['trasportDetailEntry']);
$termsOfDelivery = clean($_REQUEST['termsOfDelivery']);
$paymentTerms = clean($_REQUEST['paymentTerms']);
$shipTo = clean($_REQUEST['shipTo']);

$namevalue ='poTypeEntry="'.$poTypeEntry.'",packingDetailEntry="'.$packingDetailEntry.'",trasportDetailEntry="'.$trasportDetailEntry.'",termsOfDelivery="'.$termsOfDelivery.'",paymentTerms="'.$paymentTerms.'",shipTo="'.$shipTo.'"';
$where='poNumber="'.$poNumber.'" and supplierId="'.$supplierId.'"';
$update = updatelisting('indentCreationMaster',$namevalue,$where);


}


if($_REQUEST['action']=="savepackagingtrimdatamaster" && $_REQUEST['id']!=''){

$item_trims = clean($_REQUEST['item_trims']);
$item_code = clean($_REQUEST['item_code']);
$vendor_name = clean($_REQUEST['vendor_name']);
$pono = clean($_REQUEST['pono']);
$receivedqty = clean($_REQUEST['receivedqty']);
$totalorderqty = clean($_REQUEST['totalorderqty']);
$lotno = clean($_REQUEST['lotno']);
$lotreceiveddate = clean(date('Y-m-d',strtotime($_REQUEST['lotreceiveddate'])));
$recievedutytlot = clean($_REQUEST['recievedutytlot']);
$recievedutytillnow = clean($_REQUEST['recievedutytillnow']);
$balancetoreceive = clean($_REQUEST['balancetoreceive']);
$inspectiondate = clean(date('Y-m-d',strtotime($_REQUEST['inspectiondate'])));
$okayqty = clean($_REQUEST['okayqty']);
$inspectionqty = clean($_REQUEST['inspectionqty']);
$rejectedqty = clean($_REQUEST['rejectedqty']);
$disputedqty = clean($_REQUEST['disputedqty']);
$remarks = clean($_REQUEST['remarks']);

$where='id="'.decode($_REQUEST['id']).'"';

$namevalue ='item_trims="'.$item_trims.'",item_code="'.$item_code.'",vendor_name="'.$vendor_name.'",pono="'.$pono.'",inspectionqty="'.$inspectionqty.'",receivedqty="'.$receivedqty.'",totalorderqty="'.$totalorderqty.'",lotno="'.$lotno.'",lotreceiveddate="'.$lotreceiveddate.'",recievedutytlot="'.$recievedutytlot.'",recievedutytillnow="'.$recievedutytillnow.'",balancetoreceive="'.$balancetoreceive.'",inspectiondate="'.$inspectiondate.'",okayqty="'.$okayqty.'",rejectedqty="'.$rejectedqty.'",disputedqty="'.$disputedqty.'",remarks="'.$remarks.'"';

$update = updatelisting('packagaingtrimdatamaster',$namevalue,$where);
}


if($_REQUEST['action']=="savepackagingquaalityinputreport" && $_REQUEST['styleid']!=''){

$accepted = clean($_REQUEST['accepted']);
$reprocessing = clean($_REQUEST['reprocessing']);
$rejectedreplaced = clean($_REQUEST['rejectedreplaced']);
$onhold = clean($_REQUEST['onhold']);
$closurDate = clean(date('Y-m-d',strtotime($_REQUEST['closurDate'])));
$closureby = clean($_REQUEST['closureby']);
$styleid = clean(decode($_REQUEST['styleid']));
$lotId = clean($_REQUEST['lotId']);
$materialid = clean($_REQUEST['materialid']);
$colorid = clean($_REQUEST['colorid']);
$materialMasterId = clean($_REQUEST['materialMasterId']);

deleteRecord('packagingqualityreportmaster','styleid="'.$styleid.'" and lotId="'.$lotId.'" and  type="packagingtriminspectioninput"');
$namevalue ='accepted="'.$accepted.'",reprocessing="'.$reprocessing.'",rejectedreplaced="'.$rejectedreplaced.'",onhold="'.$onhold.'",closurDate="'.$closurDate.'",closureby="'.$closureby.'",styleid="'.$styleid.'",lotId="'.$lotId.'",type="packagingtriminspectioninput",materialid="'.$materialid.'",colorid="'.$colorid.'",materialMasterId="'.$materialMasterId.'"';
addlisting('packagingqualityreportmaster',$namevalue);

}




if($_REQUEST['action']=="maintenancequalityreportmaster"){

$accepted = clean($_REQUEST['accepted']);
$reprocessing = clean($_REQUEST['reprocessing']);
$rejectedreplaced = clean($_REQUEST['rejectedreplaced']);
$onhold = clean($_REQUEST['onhold']);
$closurDate = clean(date('Y-m-d',strtotime($_REQUEST['closurDate'])));
$closureby = clean($_REQUEST['closureby']);
$styleid = clean(decode($_REQUEST['styleid']));
$lotId = clean($_REQUEST['lotId']);
$materialid = clean($_REQUEST['materialid']);
$colorid = clean($_REQUEST['colorid']);
 $gateentryId=clean($_REQUEST['gateentryid']);
deleteRecord('maintenancequalityreportmaster','gateentryId="'.$gateentryId.'"');
$namevalue ='accepted="'.$accepted.'",reprocessing="'.$reprocessing.'",rejectedreplaced="'.$rejectedreplaced.'",onhold="'.$onhold.'",closurDate="'.$closurDate.'",closureby="'.$closureby.'",gateentryId="'.$gateentryId.'"';
addlisting('maintenancequalityreportmaster',$namevalue);

}


?>


<?php



if($_REQUEST['action']=="savemaintenanceinspectioninput" && $_REQUEST['id']!=''){

$item_trims = clean($_REQUEST['item_trims']);
$item_code = clean($_REQUEST['item_code']);
$vendor_name = clean($_REQUEST['vendor_name']);
$pono = clean($_REQUEST['pono']);
$receivedqty = clean($_REQUEST['receivedqty']);
$totalorderqty = clean($_REQUEST['totalorderqty']);
$lotno = clean($_REQUEST['lotno']);
$lotreceiveddate = clean(date('Y-m-d',strtotime($_REQUEST['lotreceiveddate'])));
$recievedutytlot = clean($_REQUEST['recievedutytlot']);
$recievedutytillnow = clean($_REQUEST['recievedutytillnow']);
$balancetoreceive = clean($_REQUEST['balancetoreceive']);
$inspectiondate = clean(date('Y-m-d',strtotime($_REQUEST['inspectiondate'])));
$okayqty = clean($_REQUEST['okayqty']);
$inspectionqty = clean($_REQUEST['inspectionqty']);
$rejectedqty = clean($_REQUEST['rejectedqty']);
$disputedqty = clean($_REQUEST['disputedqty']);
$remarks = clean($_REQUEST['remarks']);

$where='id="'.decode($_REQUEST['id']).'"';

$namevalue ='item_trims="'.$item_trims.'",item_code="'.$item_code.'",vendor_name="'.$vendor_name.'",pono="'.$pono.'",inspectionqty="'.$inspectionqty.'",receivedqty="'.$receivedqty.'",totalorderqty="'.$totalorderqty.'",lotreceiveddate="'.$lotreceiveddate.'",recievedutytlot="'.$recievedutytlot.'",recievedutytillnow="'.$recievedutytillnow.'",balancetoreceive="'.$balancetoreceive.'",inspectiondate="'.$inspectiondate.'",okayqty="'.$okayqty.'",rejectedqty="'.$rejectedqty.'",disputedqty="'.$disputedqty.'",remarks="'.$remarks.'"';

$update = updatelisting('loadmaintenanceinspectioninput',$namevalue,$where);
}

/////////////////////////////////////=====================================SAVE INDENT INSPECTION DATA
if($_REQUEST['action']=="saveindentinspectiondataShipTo" && $_REQUEST['poNumber']!=''){
$poNumber = clean($_REQUEST['poNumber']);
$shipTo = clean($_REQUEST['shipTo']);

$namevalue ='shipTo="'.$shipTo.'"';
$where='poNumber="'.$poNumber.'"';
$update = updatelisting('indentCreationMaster',$namevalue,$where);


}

/////////////////////////////////////=====================================Approved issuance
if($_REQUEST['action']=="approveIssuance" && $_REQUEST['id']!=''){

  $id = clean($_REQUEST['id']);

  $namevalue ='isApprove="1"';
  $where='id="'.$id.'"';
  $update = updatelisting('requisitionmaster',$namevalue,$where);

  updatelisting('loadRequisitionMaster',$namevalue,'parentId="'.$id.'"');

  ?>
  <script>
    parent.reload_page();
  </script>
  <?php

  }

?>
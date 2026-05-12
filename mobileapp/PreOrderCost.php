        <?php
        include '../inc.php';




        header("Content-Type: application/json");
        class clsListData
        {
        public $StyleId;
        public $product;
        public $effective;
        public $profit;

        public $linkid;



        }
        $listArray=array();
        //total style
        $CountQuery1=GetPageRecord('*','queryMaster','1 and subject!="" and deletestatus=0 and sampleStyle="1" order by id desc');
        while($totalQuery1=mysqli_fetch_assoc($CountQuery1)){

// 		$selectqty='*';
// 		$whereqty='styleId="'.$totalQuery1['id'].'" and complitionDate != "1970-01-01" and complitionDate != "" and complitionDate !="0000-00-00" and status=1';
// 		$rsqty=GetPageRecord($selectqty,' timeActionReport',$whereqty);
// 		$totalTask = mysqli_num_rows($rsqty);


$i = 0;
$costsheetVersionId='0';
$selectversion='*';
$whereversion='styleId="'.$totalQuery1['id'].'" and buyerCostStatus=0 order by id desc';
$rsversion=GetPageRecord($selectversion,'costsheetVersionMaster',$whereversion);
$resListingVer=mysqli_fetch_array($rsversion);
$costsheetVersionId = $resListingVer['versionId'];

$rs31=GetPageRecord('*','costsheetVersionMaster','styleId="'.$totalQuery1['id'].'" and versionId="'.$costsheetVersionId.'"');
$resListing31=mysqli_fetch_array($rs31);

$totalmrp=$resListing31['totalmrp'];
$mrptotallast=$resListing31['mrptotallast'];
$finalgrandtotalwithmrp =$resListing31['finalgrandtotalwithmrp'];


$idz=encode($totalQuery1['id']);

if($resListing31['effectivesellingprice']!='' || $resListing31['totalcostfob']!='' || $resListing31['profit']!=''){




        $objListData = new clsListData();
        $objListData->StyleId = '#'.$totalQuery1['styleRefId'];
        $objListData-> product= $resListing31['totalcostfob'];
        $objListData->effective =$resListing31['effectivesellingprice'];
        $objListData->profit = $resListing31['profit'].'('.$resListing31['profitlosspercent'].')%';

        $objListData->linkid =$idz;




        array_push($listArray, $objListData);
        } }
        echo json_encode(['Status'=>'0','Message'=>'Success','TotalRecord'=>$listArray],JSON_PRETTY_PRINT);


        ?>
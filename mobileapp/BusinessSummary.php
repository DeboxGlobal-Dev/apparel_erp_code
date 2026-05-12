        <?php
        include '../inc.php';




        header("Content-Type: application/json");
        class clsListData
        {
        public $Buyer;
        public $Brand;
        public $Qty;



        }
        $listArray=array();

        $CountQuery1=GetPageRecord('*','buyerMaster','1 and name!=""');
        while($totalQuery1=mysqli_fetch_assoc($CountQuery1)){

     	$CountQuery12=GetPageRecord('*','brandMaster','1 and buyerId="'.$totalQuery1['id'].'"');
        while($totalQuery12=mysqli_fetch_assoc($CountQuery12)){

        $CountQuery123=GetPageRecord('*','queryMaster','1 and brandId="'.$totalQuery12['id'].'"');
        $totalQuery123=mysqli_fetch_assoc($CountQuery123);

        $rsList1ccx=GetPageRecord('*','styleColorDetailMaster','styleId="'.$totalQuery123['id'].'"');
        $smapleListccx=mysqli_fetch_array($rsList1ccx);

        $objListData = new clsListData();
        $objListData->Buyer = $totalQuery1['name'];
        $objListData->Brand = $totalQuery12['name'];
        $objListData->Qty = strval($smapleListccx['qty']);


        array_push($listArray, $objListData);
        } }
        echo json_encode(['Status'=>'0','Message'=>'Success','TotalRecord'=>$listArray],JSON_PRETTY_PRINT);


        ?>
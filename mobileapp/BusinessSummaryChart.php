        <?php
        include '../inc.php';




        header("Content-Type: application/json");
        class clsListData
        {
        public $BuyerName;
        public $BuyerQty;




        }
        $listArray=array();

        $rscategory=GetPageRecord('*','buyerMaster','1 and deletestatus=0 order by name asc');
		while($result=mysqli_fetch_array($rscategory)){
		$rscreated=GetPageRecord('sum(orderQty) as totalqty',_QUERY_MASTER_,'buyerId="'.$result['id'].'" and deletestatus=0');
		$resultcat=mysqli_fetch_array($rscreated);



        $objListData = new clsListData();
        $objListData->BuyerName =$result['name'];
        $objListData->BuyerQty =$resultcat['totalqty'];



        array_push($listArray, $objListData);
        }
        echo json_encode(['Status'=>'0','Message'=>'Success','ChartRecord'=>$listArray],JSON_PRETTY_PRINT);


        ?>
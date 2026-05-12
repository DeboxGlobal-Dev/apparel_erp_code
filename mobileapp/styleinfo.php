        <?php
        include '../inc.php';




        header("Content-Type: application/json");
        class clsListData
        {
        public $Id;
        public $StyleId;
        public $TnaProgress;
        public $Status;
        public $Priority;


        }
        $listArray=array();
        //total style
        $CountQuery1=GetPageRecord('*','queryMaster','1 and subject!="" and deletestatus=0 and sampleStyle="1" order by id desc');
        while($totalQuery1=mysqli_fetch_assoc($CountQuery1)){

		$selectqty='*';
		$whereqty='styleId="'.$totalQuery1['id'].'" and complitionDate != "1970-01-01" and complitionDate != "" and complitionDate !="0000-00-00" and status=1';
		$rsqty=GetPageRecord($selectqty,' timeActionReport',$whereqty);
		$totalTask = mysqli_num_rows($rsqty);

		$selectqty1='*';
		$whereqty1='styleId="'.$totalQuery1['id'].'" and actualDate != "1970-01-01" and actualDate != "" and actualDate !="0000-00-00" and status=1';
		$rsqty1=GetPageRecord($selectqty1,' timeActionReport',$whereqty1);
		$completed = mysqli_num_rows($rsqty1);

		$persent = round($completed*100/$totalTask);

        $date = date('Y-m-d');
        $selectqty='*';
        $whereqty='styleId="'.$totalQuery1['id'].'" and actualDate <= "'.$date.'" and actualDate != "0000-00-00" and actualDate != "1970-01-01" and status=1 order by actualDate desc';
        $status=GetPageRecord($selectqty,' timeActionReport',$whereqty);
        $resultstat=mysqli_fetch_array($status);

        $objListData = new clsListData();
        $objListData->Id = $totalQuery1['id'];
        $objListData->StyleId = '#'.$totalQuery1['styleRefId'];
        $objListData->TnaProgress = strval(round($persent));

        if($totalQuery1['queryPriority']==1){
            $objListData->Priority = 'Low';
        }elseif($totalQuery1['queryPriority']==2){
        $objListData->Priority ='Medium';
        }else{
        $objListData->Priority ='High';
        }

        if(mysqli_num_rows($status) > "0") {
        $whereqty1='id="'.$resultstat['taskListId'].'"';
        $status1=GetPageRecord($selectqty,'taskListMaster',$whereqty1);
        $resultstat1=mysqli_fetch_array($status1);

        $whereqty2='id="'.$resultstat1['name'].'"';
        $status2=GetPageRecord($selectqty,'tnaActivityMaster',$whereqty2);
        $resultstat2=mysqli_fetch_array($status2);


        $objListData->Status = $resultstat2['name'];
        }else{
        $objListData->Status ='Pending';

        }

        array_push($listArray, $objListData);
        }
        echo json_encode(['Status'=>'0','Message'=>'Success','TotalRecord'=>$listArray],JSON_PRETTY_PRINT);


        ?>
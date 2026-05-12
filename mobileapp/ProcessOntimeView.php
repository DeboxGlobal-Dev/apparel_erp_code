        <?php
        include '../inc.php';


    $ids=$_GET['id'];
        header("Content-Type: application/json");
        $parameterdata = file_get_contents('php://input');



        $dataToShare = json_decode($parameterdata);

        $userId=$dataToShare->userId;





        class clsListData
        {
       public $ResponsiblePerson;
        public $keys;
        public $styleid;
        public $planned;
        public $taskid;
        public $style;


        }
        $listArray=array();
        $dateo=Date('Y-m-d', strtotime('+14 days'));
        $rs1=GetPageRecord('*','timeActionReport','1 and responsiblity="'.$ids.'" and complitionDate>"'.date('Y-m-d').'" and actualDate="1970-01-01" and complitionDate<"'.$dateo.'"  and taskListId in (select id from taskListMaster where tna=1) and responsiblity!=""  order by complitionDate asc');
        while($data4=mysqli_fetch_array($rs1)){

   $rs=GetPageRecord('*','taskListMaster','1 and id="'.$data4['taskListId'].'" and deletestatus=0 and status=1 and tna=1 order by id asc');

        $reslisttask=mysqli_fetch_array($rs);


        $activityquery=GetPageRecord('name','tnaActivityMaster','1 and id="'.$reslisttask['name'].'"');
        $activityData=mysqli_fetch_array($activityquery);

        	$whrek='1 and id="'.$data4['styleId'].'"';

        $topq=GetPageRecord('*','queryMaster',$whrek);
        $topStyleData=mysqli_fetch_array($topq);






        $objListData = new clsListData();
        $objListData->ResponsiblePerson = getEmployeeName($data4['responsiblity']);
        $objListData->keys =$activityData['name'];
        $objListData->styleid =$topStyleData['styleRefId'];
        $objListData->planned =date('d-m-Y', strtotime($data4['complitionDate']));

              $objListData->taskid =$reslisttask['id'];
        $objListData->style =$topStyleData['id'];

        array_push($listArray, $objListData);

        }

        echo json_encode(['Status'=>'0','Message'=>'Success','TotalRecord'=>$listArray],JSON_PRETTY_PRINT);


        ?>
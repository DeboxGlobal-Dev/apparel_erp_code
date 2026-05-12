        <?php
        include '../inc.php';


        header("Content-Type: application/json");
        class clsListData
        {
        public $ResponsiblePerson;
        public $Count;
        public $id;


        }
        $listArray=array();

        $rs1=GetPageRecord('responsiblity,COUNT(responsiblity) as rescount','timeActionReport','1 and actualDate="1970-01-01" and  complitionDate<="'.date('Y-m-d').'" and taskListId in (select id from taskListMaster where tna=1) and responsiblity!=""  group by responsiblity order by complitionDate asc');
        while($data=mysqli_fetch_array($rs1)){


        // $rs1s=GetPageRecord('COUNT(responsiblity) as rescount','timeActionReport','1 and responsiblity="'.$data['responsiblity'].'"');
        // $datas=mysqli_fetch_array($rs1s);



        $objListData = new clsListData();
        $objListData->ResponsiblePerson = getEmployeeName($data['responsiblity']);
        $objListData->Count =$data['rescount'];
        $objListData->id =$data['responsiblity'];

        array_push($listArray, $objListData);

        }

        echo json_encode(['Status'=>'0','Message'=>'Success','TotalRecord'=>$listArray],JSON_PRETTY_PRINT);


        ?>
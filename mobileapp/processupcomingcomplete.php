            <?php
            include '../inc.php';
            
            
            
            
            header("Content-Type: application/json");
            $parameterdata = file_get_contents('php://input');
            
            
            
            $dataToShare = json_decode($parameterdata);
            $completeId=$dataToShare->completeId;
            $taskId=$dataToShare->taskId;
            $style=$dataToShare->style;
            
            
            
            
            class clsListData
            {
            public $msg;
            
            
            
            
            }
            
            $listArray=array();
            
            
            
            
            
            if($completeId=='1' && $taskId!='' && $style!=''){
            
            $dates=date('Y-m-d');
            
            
            $namevalue ='actualDate="'.$dates.'"'; 
            $where='taskListId="'.$taskId.'" and styleId="'.$style.'"';  
            $update = updatelisting('timeActionReport',$namevalue,$where);  
            
            
            
            $objListData = new clsListData();
            $objListData->msg = 'Data has been successfully updated';
            
            
            
            array_push($listArray, $objListData);
            
            echo json_encode(['Status'=>'0','Message'=>'Data has been successfully updated','Profile'=>$listArray],JSON_PRETTY_PRINT);
            
            }else{
            
            echo json_encode('Invalid Credentials',JSON_PRETTY_PRINT);
            }
            
            
            ?>
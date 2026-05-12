        <?php
        include '../inc.php';
        header("Content-Type: application/json");
        class clsListData
        {
          public $factoryId;
          public $factoryName;
        }
        $listArray = array();

        $rs14 = GetPageRecord('*', 'factoryMaster', '1 order by name asc');
        while ($factoryData = mysqli_fetch_array($rs14)) {

          //$rs = GetPageRecord('*', 'taskListMaster', '1 and id="' . $data4['taskListId'] . '" and deletestatus=0 and status=1 and tna=1 order by id asc');
         // $reslisttask = mysqli_fetch_array($rs);

          $objListData = new clsListData();

          $objListData->factoryId = $factoryData['id'];
          $objListData->factoryName = $factoryData['name'];
          array_push($listArray, $objListData);
        }

        echo json_encode(['Status' => '0', 'Message' => 'Success', 'TotalRecord' => $listArray], JSON_PRETTY_PRINT);
        ?>
<?php
include "inc.php";

header("Content-Type: application/json");
$parameterdata = file_get_contents('php://input');
$parameterdata = str_replace("null","\"\"",$parameterdata);
logger("INSIDE BUYER SUPPLIER LIST API: ".$parameterdata);
$dataToExport = json_decode($parameterdata);

$tableName = $dataToExport->tableName;
$code = $dataToExport->code;
$Status = $dataToExport->Status;

class clsDataTable
{
  public $AccountName;
  public $AccountCode;
  public $Balance;
  //public $LedgerId;
  public $status;
}

$arrayDataRows = array();

//////---------------------- Extraction from DataBase --------------------------------

$i=1;

if($code!=""){
  $tableName = substr($code,0, 2);

  if($tableName=="CP"){
    $rs=GetPageRecord('*',"companyMaster",'companyId="'.$code.'"');
    while($dataList=mysqli_fetch_array($rs)){

         $objDataTable = new clsDataTable();

         $objDataTable->AccountName =$dataList['name'];
         $objDataTable->AccountCode =$dataList['companyId'];
         $objDataTable->Balance =$dataList['balance'];
         //$objDataTable->LedgerId =$dataList['ledgerId'];
         $objDataTable->status =$dataList['status'];

         $a = array_push($arrayDataRows,$objDataTable);

         $i++;

         $total = count($arrayDataRows);

    }
  }else if($tableName=="BY"){
    $rs=GetPageRecord('*',"buyerMaster",'buyerId="'.$code.'"');
    while($dataList=mysqli_fetch_array($rs)){

         $objDataTable = new clsDataTable();

         $objDataTable->AccountName =$dataList['name'];
         $objDataTable->AccountCode =$dataList['buyerId'];
         $objDataTable->Balance =$dataList['balance'];
         //$objDataTable->LedgerId =$dataList['ledgerId'];
         $objDataTable->status =$dataList['status'];

         $a = array_push($arrayDataRows,$objDataTable);

         $i++;

         $total = count($arrayDataRows);

    }
  } else if($tableName=="SP"){
    $rs=GetPageRecord('*',"suppliersMaster",'supplierId="'.$code.'"');
    while($dataList=mysqli_fetch_array($rs)){

         $objDataTable = new clsDataTable();

         $objDataTable->AccountName =$dataList['name'];
         $objDataTable->AccountCode =$dataList['supplierId'];
         $objDataTable->Balance =$dataList['balance'];
         //$objDataTable->LedgerId =$dataList['ledgerId'];
         $objDataTable->status =$dataList['status'];

         $a = array_push($arrayDataRows,$objDataTable);

         $i++;

         $total = count($arrayDataRows);

    }

  }else{
    $rs=GetPageRecord('*',"othersMaster",'code="'.$code.'"');
    while($dataList=mysqli_fetch_array($rs)){

         $objDataTable = new clsDataTable();

         $objDataTable->AccountName =$dataList['name'];
         $objDataTable->AccountCode =$dataList['code'];
         $objDataTable->Balance =$dataList['balance'];
         $objDataTable->status =$dataList['status'];

         $a = array_push($arrayDataRows,$objDataTable);

         $i++;

         $total = count($arrayDataRows);

    }
  }
}else {
  if($tableName=="companyMaster"){
    $rs=GetPageRecord('*',"companyMaster",'1 and companyId!="" and status=1  order by name asc');
    while($dataList=mysqli_fetch_array($rs)){

         $objDataTable = new clsDataTable();

         $objDataTable->AccountName =$dataList['name'];
         $objDataTable->AccountCode =$dataList['companyId'];
         $objDataTable->Balance =$dataList['balance'];
         //$objDataTable->LedgerId =$dataList['ledgerId'];
         $objDataTable->status =$dataList['status'];

         $a = array_push($arrayDataRows,$objDataTable);

         $i++;

         $total = count($arrayDataRows);

    }
  }else if($tableName=="buyerMaster"){
    $rs=GetPageRecord('*',"buyerMaster",'1 and status=1 and buyerId!="" order by name asc');
    while($dataList=mysqli_fetch_array($rs)){

         $objDataTable = new clsDataTable();

         $objDataTable->AccountName =$dataList['name'];
         $objDataTable->AccountCode =$dataList['buyerId'];
         $objDataTable->Balance =$dataList['balance'];
         //$objDataTable->LedgerId =$dataList['ledgerId'];
         $objDataTable->status =$dataList['status'];

         $a = array_push($arrayDataRows,$objDataTable);

         $i++;

         $total = count($arrayDataRows);

    }
  }else if($tableName=="suppliersMaster"){
    $rs=GetPageRecord('*',"suppliersMaster",'1 and status=1 and supplierId!="" order by name asc');
    while($dataList=mysqli_fetch_array($rs)){

         $objDataTable = new clsDataTable();

         $objDataTable->AccountName =$dataList['name'];
         $objDataTable->AccountCode =$dataList['supplierId'];
         $objDataTable->Balance =$dataList['balance'];
         //$objDataTable->LedgerId =$dataList['ledgerId'];
         $objDataTable->status =$dataList['status'];

         $a = array_push($arrayDataRows,$objDataTable);

         $i++;

         $total = count($arrayDataRows);

    }
  }else if($tableName=="othersMaster"){
    $rs=GetPageRecord('*',"othersMaster",'1 and status=1 and code!="" order by name asc');
    while($dataList=mysqli_fetch_array($rs)){

         $objDataTable = new clsDataTable();

         $objDataTable->AccountName =$dataList['name'];
         $objDataTable->AccountCode =$dataList['code'];
         $objDataTable->Balance =$dataList['balance'];
         //$objDataTable->LedgerId =$dataList['ledgerId'];
         $objDataTable->status =$dataList['status'];

         $a = array_push($arrayDataRows,$objDataTable);

         $i++;

         $total = count($arrayDataRows);

    }
  }else{
    $rs=GetPageRecord('*',"companyMaster",'1 and companyId!="" and status=1  order by name asc');
    while($dataList=mysqli_fetch_array($rs)){

         $objDataTable = new clsDataTable();

         $objDataTable->AccountName =$dataList['name'];
         $objDataTable->AccountCode =$dataList['companyId'];
         $objDataTable->Balance =$dataList['balance'];
         //$objDataTable->LedgerId =$dataList['ledgerId'];
         $objDataTable->status =$dataList['status'];

         $a = array_push($arrayDataRows,$objDataTable);

         $i++;

         $total = count($arrayDataRows);

    }
    $rs=GetPageRecord('*',"buyerMaster",'1 and status=1 and buyerId!="" order by name asc');
    while($dataList=mysqli_fetch_array($rs)){

         $objDataTable = new clsDataTable();

         $objDataTable->AccountName =$dataList['name'];
         $objDataTable->AccountCode =$dataList['buyerId'];
         $objDataTable->Balance =$dataList['balance'];
         //$objDataTable->LedgerId =$dataList['ledgerId'];
         $objDataTable->status =$dataList['status'];

         $a = array_push($arrayDataRows,$objDataTable);

         $i++;

         $total = count($arrayDataRows);

    }
    $rs=GetPageRecord('*',"suppliersMaster",'1 and status=1 and supplierId!="" order by name asc');
    while($dataList=mysqli_fetch_array($rs)){

         $objDataTable = new clsDataTable();

         $objDataTable->AccountName =$dataList['name'];
         $objDataTable->AccountCode =$dataList['supplierId'];
         $objDataTable->Balance =$dataList['balance'];
         //$objDataTable->LedgerId =$dataList['ledgerId'];
         $objDataTable->status =$dataList['status'];

         $a = array_push($arrayDataRows,$objDataTable);

         $i++;

         $total = count($arrayDataRows);

    }
    $rs=GetPageRecord('*',"othersMaster",'1 and status=1 and code!="" order by name asc');
    while($dataList=mysqli_fetch_array($rs)){

         $objDataTable = new clsDataTable();

         $objDataTable->AccountName =$dataList['name'];
         $objDataTable->AccountCode =$dataList['code'];
         $objDataTable->Balance =$dataList['balance'];
         //$objDataTable->LedgerId =$dataList['ledgerId'];
         $objDataTable->status =$dataList['status'];

         $a = array_push($arrayDataRows,$objDataTable);

         $i++;

         $total = count($arrayDataRows);

    }
  }
}



echo json_encode(['status'=>0,'Total'=>$total,'AccountNameData'=>$arrayDataRows],JSON_PRETTY_PRINT);

?>
        <?php
        include '../inc.php';




        header("Content-Type: application/json");
        class clsListData
        {
        public $Style;
        public $PO;
        public $BrandSOT;
        public $FactorySOT;




        }
        $listArray=array();

       $no=1;
$select='*';
$where='';
$rs='';
$wheresearch='';
$limit='20000';

$where='where status != "0" ';
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
$rs=GetRecordList($select,'packinglistMaster',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

	$rss=GetPageRecord('*','queryMaster','1 and id="'.$resultlists['styleId'].'"');
           $result=mysqli_fetch_array($rss);

           $rsss=GetPageRecord('*','poManageMaster','1 and id="'.$resultlists['purchaseNo'].'"');
           $results=mysqli_fetch_array($rsss);




             $ax=$resultlists['orignalshipmode'];
             $bx= $resultlists['actualshipmode'];

              $cc=$resultlists['orignalexfactory'];
                        $vv=$resultlists['actualexfactory'];

        $objListData = new clsListData();
        $objListData->Style ='#'.$result['styleRefId'];
        $objListData->PO =$results['poNumber'];
        if($ax==$bx){
        $objListData->BrandSOT = 'On Time';
        }elseif($ax==''){
        $objListData->BrandSOT ='';
        }elseif($bx==''){
        $objListData->BrandSOT = '';
        }else{
        $objListData->BrandSOT = 'Delayed';
        }
        if($ax!=$bx){
        $objListData->FactorySOT= 'Delayed';
        }
        elseif ($cc==$vv){
        $objListData->FactorySOT= 'On Time';
        }
        else{
        $objListData->FactorySOT= 'Delayed';
        }



        array_push($listArray, $objListData);
        }
        echo json_encode(['Status'=>'0','Message'=>'Success','TotalRecord'=>$listArray],JSON_PRETTY_PRINT);


        ?>
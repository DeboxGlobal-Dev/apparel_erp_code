        <?php
        include '../inc.php';




        header("Content-Type: application/json");
        class clsListData
        {
        public $SupplierName;
        public $Date;
        public $MaterialId;



        }

        $listArray=array();

        $no=1;
        $select='*';
        $where='';
        $rs='';
        $wheresearch='';

        $limit=clean($_GET['records']);

        $where='where 1 group By createdDate,supplierId order by createdDate desc';

        $page=$_GET['page'];

        $targetpage=$fullurl.'showpage.crm?module="'.$modfile['url'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';

        $rs=GetRecordList($select,'indentCreationMaster',$where,$limit,$page,$targetpage);
        $totalentry=$rs[1];
        if($totalentry=1){
        $totalentry=2;
        }
        $paging=$rs[2];
        while($resultlists=mysqli_fetch_array($rs[0])){

        if($resultlists['supplierId']!=0){

        $list=GetPageRecord('*','indentCreationMaster','1 and supplierId="'.$resultlists['supplierId'].'" and createdDate="'.$resultlists['createdDate'].'"');
        $count=mysqli_num_rows($list);


        $list2=GetPageRecord('*','indentCreationMaster','1 and supplierId="'.$resultlists['supplierId'].'" and createdDate="'.$resultlists['createdDate'].'" and bomPoStatus=0');
        $countPending=mysqli_num_rows($list2);

        if($countPending!=0){



        	    $rstype=GetPageRecord('*','materialTypeMaster','1 order by id asc');
				while($resListingtype=mysqli_fetch_array($rstype)){



				$rsindent=GetPageRecord('*','indentCreationMaster','materialTypeId="'.$resListingtype['id'].'" and supplierId="'.$resultlists['supplierId'].'" and createdDate="'.$resultlists['createdDate'].'"');
				while($resListingIndent1=mysqli_fetch_array($rsindent)){
				if($resListingIndent1['requisitionNo']==''){

				$rs1=GetPageRecord('*','styleSubCategoryMaster','id="'.$resListingIndent1['materialId'].'"');
				$style = '#'.getStyleRefId($resListingIndent1['styleId']);
				}else{

				$rs1=GetPageRecord('*','materialMaster','id="'.$resListingIndent1['materialId'].'"');
				$style = $resListingIndent1['requisitionNo'];
				}
				$resListing1=mysqli_fetch_array($rs1);

				$rsstyle=GetPageRecord('sampleStyle','queryMaster','id="'.$resListingIndent1['styleId'].'"');
				$editstyle=mysqli_fetch_array($rsstyle);





        $objListData = new clsListData();
        $objListData->SupplierName = getSupplierName($resultlists['supplierId']); ;
        $objListData->Date =date('d-M-Y',strtotime($resultlists['createdDate']));
        $objListData->MaterialId =stripslashes($resListing1['name']);




        array_push($listArray, $objListData);
        } } } } }

        echo json_encode(['Status'=>'0','Message'=>'Success','TotalRecord'=>$listArray],JSON_PRETTY_PRINT);


        ?>
<?php
function currency_converter($OldCurrVal,$NewCurrVal,$OldPrice){
	$OldPriceINR = $OldCurrVal * $OldPrice; //Price in INR
	$INR = 1/$NewCurrVal; //convert New old value in INR
	$NewValue =$OldPriceINR * $INR;
	return $NewValue;
}
function getChangeCurrencyValue_New($oldCurId,$newCurId,$OldPrice){

	if($oldCurId!=''){
		$selectaa='currencyValue';
		$whereaa='id="'.$oldCurId.'"';
		$rsaa=GetPageRecord($selectaa,_QUERY_CURRENCY_MASTER_,$whereaa);
		$userss=mysqli_fetch_array($rsaa);
		$OldCurrVal= $userss['currencyValue'];
	}
	if($newCurId!=''){
		$selectaa='currencyValue';
		$whereaa='id="'.$newCurId.'"';
		$rsaa=GetPageRecord($selectaa,_QUERY_CURRENCY_MASTER_,$whereaa);
		$userss=mysqli_fetch_array($rsaa);
		$NewCurrVal= $userss['currencyValue'];
	}

	// $NewValue = currency_converter($OldCurrVal,$NewCurrVal,$OldPrice)
	$OldPriceINR = $OldCurrVal * $OldPrice; //Price in INR
	$INR = 1/$NewCurrVal; //convert New old value in INR
	$NewValue =$OldPriceINR * $INR;
	return $NewValue;
}
function getTwoDecimalNumberFormat($value){
 	$values=number_format((float)$value, 2, '.', '');
	return  $values;
}
function showStarrating($id){
if($id==7){
return 'starh2.png';
}
if($id==6){
return 'starh5.png';
}


if($id==8){
return 'starh5.png';
}
if($id==5){
return 'starh5.png';
}
if($id==4){
return 'starh4.png';
}
if($id==3){
return 'starh3.png';
}
if($id==2){
return 'starh2.png';
}
if($id==1){
return 'starh1.png';
}

}




function packageshowStarrating($id){
if($id==4){
return 'starh4.png';
}
if($id==2){
return 'starh2.png';
}
if($id==5){
return 'starh5.png';
}

if($id==3){
return 'starh3.png';
}

if($id==1){
return 'starh1.png';
}
}


function showClientType($type){
if($type==1){
return 'Agent';
}
if($type==2){
return 'B2C';
}
}


function showClientTypeUserName($type,$id){

	if($type==1){
		$selectaa='name';
		$whereaa='id="'.$id.'"';
		$rsaa=GetPageRecord($selectaa,_CORPORATE_MASTER_,$whereaa);
		while($userss=mysqli_fetch_array($rsaa)){
			return $userss['name'];
		}
	}

	// first name and
	if($type==2){
		$selectaa='firstName,lastName';
		$whereaa='id="'.$id.'"';
		$rsaa=GetPageRecord($selectaa,_CONTACT_MASTER_,$whereaa);
		while($userss=mysqli_fetch_array($rsaa)){
			return $userss['firstName'].' '.$userss['lastName'];
		}
	}
}


function get_cms_user_name($id){
	// user name from cms
	$selectaa='username';
	$whereaa='id="'.$id.'"';
	$rsaa=GetPageRecord($selectaa,_CMS_USER_MASTER_,$whereaa);
	while($userss=mysqli_fetch_array($rsaa)){
		return $userss['username'];
	}
}

function get_package_name($id){
	// user name from cms
	$selectaa='pacakageName';
	$whereaa='id="'.$id.'"';
	$rsaa=GetPageRecord($selectaa,_PACKAGE_DETAIL_MASTER_,$whereaa);
	while($userss=mysqli_fetch_array($rsaa)){
		return $userss['pacakageName'];
	}
}


 function makePackageId($id){
 if($id!=''){
 return str_pad($id, 6, '0', STR_PAD_LEFT);
 }
 }



function showClientTypeUserNameWithLink($type,$id){

if($type==1){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_CORPORATE_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return '<a href="showpage.crm?module=corporate&view=yes&id='.encode($id).'" target="_blank" class="maintablist">'.$userss['name'].'</a>';
}
}



if($type==2){
$selectaa='firstName,lastName';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_CONTACT_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return '<a href="showpage.crm?module=contacts&view=yes&id='.encode($id).'" target="_blank" class="maintablist">'.$userss['firstName'].' '.$userss['lastName'].'</a>';
}
}

}




function formatBytes($bytes, $precision = 2) {
if($bytes!='0'){
    if ($bytes > pow(1024,3)) return round($bytes / pow(1024,3), $precision)." GB";
    else if ($bytes > pow(1024,2)) return round($bytes / pow(1024,2), $precision)." MB";
    else if ($bytes > 1024) return round($bytes / 1024, $precision)." KB";
    else return ($bytes)." B";
} else {

return '0';
}
}

function getFileIcon($filetype){

$mainfile='images/filetype/fileunknown.png';
if($filetype=='png'){
$mainfile='images/filetype/filepng.png';
}
if($filetype=='docx'){
$mainfile='images/filetype/filedoc.png';
}

if($filetype=='xls'){
$mainfile='images/filetype/filexls.png';
}

if($filetype=='psd'){
$mainfile='images/filetype/filepsd.png';
}

if($filetype=='ppt'){
$mainfile='images/filetype/fileppt.png';
}

if($filetype=='pdf'){
$mainfile='images/filetype/filepdf.png';
}

if($filetype=='mp4'){
$mainfile='images/filetype/filemp4.png';
}

if($filetype=='jpg'){
$mainfile='images/filetype/filejpeg.png';
}
if($filetype=='html'){
$mainfile='images/filetype/filehtml.png';
}

if($filetype=='zip'){
$mainfile='images/filetype/filezip.png';
}

return $mainfile;
}





function getRoomType($id){
if($id!=''){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_ROOM_TYPE_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['name'];
}
}
}






function countQueryunreadMails($id){
if($id!=''){
$result =mysql_query ("select id from "._QUERYMAILS_MASTER_." where queryid='".clean($id)."' and description!='' and status=1")  or die(mysql_error());
$number =mysql_num_rows($result);
return $number;
}
}


function micecountQueryunreadMails($id){
if($id!=''){
$result =mysql_query ("select id from maicemails where queryid='".clean($id)."' and description!='' and status=1")  or die(mysql_error());
$number =mysql_num_rows($result);
return $number;
}
}



function makeQueryId($id){
if($id!=''){
return str_pad($id, 6, '0', STR_PAD_LEFT);
}
}

function makeInvoiceId($id){
if($id!=''){
return str_pad($id, 6, '0', STR_PAD_LEFT);
}
}

function makePaymentId($id){
if($id!=''){
return str_pad($id, 6, '0', STR_PAD_LEFT);
}
}


function getCorporateCompany($id){
if($id!=''){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_CORPORATE_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['name'];
}
}
}




function getsupplierCompany($id){
if($id!=''){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_SUPPLIERS_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['name'];
}
}
}


function getDestination($id){
if($id!=''){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_DESTINATION_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['name'];
}
}
}

function getDesignation($id){
if($id!=''){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_DESIGNATION_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['name'];
}
}
}



function getNameTitle($id){
if($id!=''){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_NAME_TITLE_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['name'];
}
}
}


function getsuppliersType($id){
if($id!=''){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_SUPPLIERS_TYPE_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['name'];
}
}
}




function getsuppliersTypeNameList($id){
if($id!=''){
$type='';
$selectaa='*';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_SUPPLIERS_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){

$selectaa2='name';
$whereaa2='id="'.$userss['companyTypeId'].'"';
$rsaa2=GetPageRecord($selectaa2,_SUPPLIERS_TYPE_MASTER_,$whereaa2);
while($userss2=mysqli_fetch_array($rsaa2)){
$type=$userss2['name'].', '.$type;
}

$selectaa2='name';
$whereaa2='id="'.$userss['airlinesType'].'"';
$rsaa2=GetPageRecord($selectaa2,_SUPPLIERS_TYPE_MASTER_,$whereaa2);
while($userss2=mysqli_fetch_array($rsaa2)){
$type=$userss2['name'].', '.$type;
}

$selectaa2='name';
$whereaa2='id="'.$userss['transferType'].'"';
$rsaa2=GetPageRecord($selectaa2,_SUPPLIERS_TYPE_MASTER_,$whereaa2);
while($userss2=mysqli_fetch_array($rsaa2)){
$type=$userss2['name'].', '.$type;
}

$selectaa2='name';
$whereaa2='id="'.$userss['sightseeingType'].'"';
$rsaa2=GetPageRecord($selectaa2,_SUPPLIERS_TYPE_MASTER_,$whereaa2);
while($userss2=mysqli_fetch_array($rsaa2)){
$type=$userss2['name'].', '.$type;
}
$selectaac='name';
$whereaac='id="'.$userss['cruiseType'].'"';
$rsaac=GetPageRecord($selectaac,_SUPPLIERS_TYPE_MASTER_,$whereaac);
while($userssc=mysqli_fetch_array($rsaac)){
$type=$userssc['name'].', '.$type;
}
}
 return ltrim(rtrim($type,', '),',');
}
}




function getUserName($id){
if($id!=''){
$selectaa='firstName,lastName';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_USER_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['firstName'].' '.$userss['lastName'];
}
}
}


function getEmployeeName($id){
if($id!=''){
$selectaa='empCode,name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,'employeeMaster',$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['name'];
}
}
}


function getGenderName($id){
if($id!=''){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,'genderMaster',$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['name'];
}
}
}







function getCountryName($id){
if($id!=''){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_COUNTRY_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['name'];
}
}
}

function getcountry($id){
if($id!=''){
$selectaa='countryId';
$whereaa='addressParent="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_ADDRESS_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
$c_country_id = $userss['countryId'];
}
return getCountryName($c_country_id);
}
}


function getStateName($id){
if($id!=''){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_STATE_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['name'];
}
}
}

function getstate($id){
if($id!=''){
$selectaa='stateId';
$whereaa='addressParent="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_ADDRESS_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
$c_state_id = $userss['stateId'];
}
return getStateName($c_state_id);
}
}


function getCityName($id){
if($id!=''){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_CITY_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['name'];
}
}
}

function getcity($id){
if($id!=''){
$selectcaa='cityId';
$wherecaa='addressParent="'.$id.'"';
$rscaa=GetPageRecord($selectcaa,_ADDRESS_MASTER_,$wherecaa);
while($usercss=mysqli_fetch_array($rscaa)){
$c_id = $usercss['cityId'];
}
 return getCityName($c_id);
}
}



function getPhoneType($id){
if($id!=''){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_PHONE_TYPE_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['name'];
}
}
}


function getEmailType($id){
if($id!=''){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_EMAIL_TYPE_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['name'];
}
}
}


function getPrimaryPhone($id,$sectionType){
if($id!=''){
$selectaa='phoneNo';
$whereaa='masterId="'.$id.'" and sectionType="'.$sectionType.'" and primaryvalue=1';
$rsaa=GetPageRecord($selectaa,_PHONE_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['phoneNo'];
}
}
}

function getPrimaryEmail($id,$sectionType){
if($id!=''){
$selectaa='email';
$whereaa='masterId="'.$id.'"  and sectionType="'.$sectionType.'" and primaryvalue=1';
$rsaa=GetPageRecord($selectaa,_EMAIL_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['email'];
}
}
}



function getPrimaryEmailCompany($id,$sectionType){
if($id!=''){
$selectaa='email';
$whereaa='corporateId="'.$id.'" and deletestatus=0 order by id asc';
$rsaa=GetPageRecord($selectaa,'contactPersonMaster',$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['email'];
}
}
}
function getPrimaryPhoneCompany($id,$sectionType){
if($id!=''){
$selectaa='phone';
$whereaa='corporateId="'.$id.'" and deletestatus=0 order by id asc';
$rsaa=GetPageRecord($selectaa,'contactPersonMaster',$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['phone'];
}
}
}

function getPrimaryNameCompany($id,$sectionType){
if($id!=''){
$selectaa='contactPerson';
$whereaa='corporateId="'.$id.'" and deletestatus=0 order by id asc';
$rsaa=GetPageRecord($selectaa,'contactPersonMaster',$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['contactPerson'];
}
}
}

function getMultiPrimaryEmail($id,$sectionType){
if($id!=''){
$mailsreturn='';
$selectaa='email';
$whereaa='masterId="'.$id.'"  and sectionType="'.$sectionType.'"  and primaryvalue!=1';
$rsaa=GetPageRecord($selectaa,_EMAIL_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
 $mailsreturn.=$userss['email'].',';
}
return $mailsreturn;

}
}

//-----------------Paging Listing-----------------





function GetRecordList($select,$tablename,$where,$limit,$page,$targetpage){

if(is_numeric($page) && $page!=''){

$page=$page;

} else {

$page=1;

}

if(is_numeric($limit) && $limit!=''){

$limit=$limit;

} else {

$limit=25;

}

$query = "SELECT COUNT(*) as num FROM ".$tablename."  ".$where."";

$total_pages = mysqli_fetch_array(mysql_query($query));

$total_pages = $total_pages[num];

$stages = 3;

$page = mysql_escape_string($page);

if($page){

$start = ($page - 1) * $limit;

}else{

$start = 0;

}

$query1 = "SELECT ".$select." FROM ".$tablename."  ".$where." LIMIT $start,  ".$limit."";

$result=mysql_query($query1) or die(mysql_error());





//--------------paging--------------------



if ($page == 0){$page = 1;}

$prev = $page - 1;

$next = $page + 1;

$lastpage = ceil($total_pages/$limit);

$LastPagem1 = $lastpage - 1;

$paginate = '';

if($lastpage > 1)

{

$paginate .= "<div class='paginate'>";

if ($page > 1){

$paginate.= "<a href='".$targetpage."page=$prev'>Previous</a>";

}else{

$paginate.= "<span class='disabled'>Previous</span>";	}



if ($lastpage < 7 + ($stages * 2))

{

for ($counter = 1; $counter <= $lastpage; $counter++)

{

if ($counter == $page){

$paginate.= "<span class='current'>$counter</span>";

}else{

$paginate.= "<a href='".$targetpage."page=$counter'>$counter</a>";}

}

}

elseif($lastpage > 5 + ($stages * 2))

{

if($page < 1 + ($stages * 2))

{

for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)

{

if ($counter == $page){

$paginate.= "<span class='current'>$counter</span>";

}else{

$paginate.= "<a href='".$targetpage."page=$counter'>$counter</a>";}

}

$paginate.= "...";

$paginate.= "<a href='".$targetpage."page=$LastPagem1'>$LastPagem1</a>";

$paginate.= "<a href='".$targetpage."page=$lastpage'>$lastpage</a>";

}

elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))

{

$paginate.= "<a href='".$targetpage."page=1'>1</a>";

$paginate.= "<a href='".$targetpage."page=2'>2</a>";

$paginate.= "...";

for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)

{

if ($counter == $page){

$paginate.= "<span class='current'>$counter</span>";

}else{

$paginate.= "<a href='".$targetpage."page=$counter'>$counter</a>";}

}

$paginate.= "...";

$paginate.= "<a href='".$targetpage."page=$LastPagem1'>$LastPagem1</a>";

$paginate.= "<a href='".$targetpage."page=$lastpage'>$lastpage</a>";

}

else

{

$paginate.= "<a href='".$targetpage."page=1'>1</a>";

$paginate.= "<a href='".$targetpage."page=2'>2</a>";

$paginate.= "...";

for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)

{

if ($counter == $page){

$paginate.= "<span class='current'>$counter</span>";

}else{

$paginate.= "<a href='".$targetpage."page=$counter'>$counter</a>";}

}

}

} if ($page < $counter - 1){

$paginate.= "<a href='".$targetpage."page=$next'>Next</a>";

}else{

$paginate.= "<span class='disabled'>Next</span>";

}

$paginate.= "</div>";

}











return array($result,$total_pages,$paginate);

}





function senderror($data){
mail("rohit.debox@gmail.com","Error Reporting From Debox CRM - ".date('d/m/Y h:i a')."",$data);
}
//----------------Get Record---------------------


function GetPageRecord($select,$tablename,$where){

$sql="select ".$select." from ".$tablename." where ".$where."";

;

$rs=mysql_query($sql) or die(senderror(mysql_error()));

return $rs;

}






//----------------Delete Record---------------------





function deleteRecord($tablename,$where){

 $sql="delete  from ".$tablename." where ".$where."";

mysql_query($sql) or die(mysql_error());

}









//----------------Clear String---------------------





function clean($string){

$string=trim($string);

$string=addslashes($string);

return addslashes($string);

}





//----------------Strip String---------------------







function strip($string){

return stripslashes(trim($string));

}





function addslash($string){

return addslashes(trim($string));

}



//----------------Login---------------------









function login($username,$password){
$cip=$_SERVER['REMOTE_ADDR'];
$clogin=date('Y-m-d H:i:s');
$result =mysql_query ("select * from "._USER_MASTER_." where email='".$username."' and  password='".md5($password)."' and status=1 ")  or die(mysql_error());
$number =mysql_num_rows($result);
if($number>0)
{

$select='';
$where='';
$rs='';

$select='*';
$where="email='".$username."' and  password='".md5($password)."'";
$rs=GetPageRecord($select,_USER_MASTER_,$where);
$userinfo=mysqli_fetch_array($rs);
$cLogin=$userinfo['cLogin'];
$currentIp=$userinfo['currentIp'];
$id=$userinfo['id'];
$randnum = mt_rand(100000, 999999);
$uSession=$randnum;


$_SESSION['userid']=$id;
$_SESSION['sessUserId']=$id;
$_SESSION['empid']=$userinfo['empId'];
$_SESSION['username']=$username;
$_SESSION['sessionid']=session_id();
$_SESSION['uSession']=$uSession;

$sql_ins="update "._USER_MASTER_." set lLogin='$cLogin',lastIp='$currentIp',cLogin='$clogin',currentIp='$cip',uSession='".$uSession."' where id=".$_SESSION['userid']."";
mysql_query($sql_ins) or die(mysql_error());

 return 'yes';

 }
}








function deletelist($tablename,$check_list,$userid){

if($check_list!=""){

for($i=0;$i<=count($check_list)-1;$i++)

{

$ansval=trim($check_list[$i]);

if(trim($ansval) != ''){



if($userid==''){

$sql_del="delete from ".$tablename."  where id='".$ansval."'";

mysql_query($sql_del) or die(mysql_error());



} else {



$sql_del="delete from ".$tablename."  where id='".$ansval."' and userid ='".$userid."'";

mysql_query($sql_del) or die(mysql_error());



}



} } }



return 'yes';

}









function encode($string)

{

$encoded = base64_encode(base64_encode(base64_encode($string)));

return  $encoded;



}



function decode($string)

{

$decoded = base64_decode(base64_decode(base64_decode($string)));

return  $decoded;



}


function addlistinggetlastid($tablename,$namevalue){

$sql_ins="insert into ".$tablename." set ".$namevalue."";
mysql_query($sql_ins) or die(mysql_error());

return mysql_insert_id();

}





function addlisting($tablename,$namevalue){

$sql_ins="insert into ".$tablename." set ".$namevalue."";
mysql_query($sql_ins) or die(mysql_error());

return 'yes';

}





function updatelisting($tablename,$namevalue,$where){

$sql_ins="update ".$tablename." set ".$namevalue." where ".$where."";

mysql_query($sql_ins) or die(mysql_error());

return 'yes';

}







function countlisting($select,$tablename,$where){

$sql_ins="SELECT ".$select." FROM ".$tablename."  ".$where."";

$sql_ins1 = mysql_query($sql_ins);

$totalcount=mysql_num_rows($sql_ins1);

return $totalcount;

}







function checkduplicate($tablename,$where){



$result =mysql_query ("select * from ".$tablename." where ".$where."")  or die(mysql_error());

$number =mysql_num_rows($result);

if($number>0)

{



return 'yes';



} else {



return 'no';



}



}





function substrstring($string,$lenth){
return substr($string, 0, $lenth);
}











// get Menu Id



function getMenuId($isId)

{

   if($isId=="")

   {

        $url = 'http://'. $_SERVER['HTTP_HOST']. $_SERVER['REQUEST_URI'];

		$path = parse_url($url, PHP_URL_PATH);

		$file_name = basename($path);

		$rs =mysql_query ("select id from "._menu_master_." where link ='".$file_name."'")  or die(mysql_error());

		$result=mysqli_fetch_array($rs);

		return $result['id'];



   } else {



     return $isId;

   }



}







function checkduplicateentry($tablename,$select,$where){



$result = mysql_query ("select ".$select." from ".$tablename."  ".$where."")  or die(mysql_error());

$number = mysql_num_rows($result);

if($number>0)

{

return  'yes';

} else {

return  'no';

}





}















function image_fix_orientation($filename) {
    $exif = exif_read_data($filename);
    if (!empty($exif['Orientation'])) {
        $image = imagecreatefromjpeg($filename);
        switch ($exif['Orientation']) {
            case 3:
                $image = imagerotate($image, 180, 0);
                break;

            case 6:
                $image = imagerotate($image, -90, 0);
                break;

            case 8:
                $image = imagerotate($image, 90, 0);
                break;
        }

        imagejpeg($image, $filename, 90);
    }
}









function imageResize($image, $thumb_width, $new_filename)
{
  $max_width = $thumb_width;
  //Check if GD extension is loaded
  if (!extension_loaded('gd') && !extension_loaded('gd2')) {
    trigger_error("GD is not loaded", E_USER_WARNING);
    return false;
  }
  //Get Image size info
  list($width_orig, $height_orig, $image_type) = getimagesize($image);
  switch ($image_type) {
    case 1:
      $im = imagecreatefromgif($image);
      break;
    case 2:
      $im = imagecreatefromjpeg($image);
      break;
    case 3:
      $im = imagecreatefrompng($image);
      break;
    default:
      trigger_error('Unsupported filetype!', E_USER_WARNING);
      break;
  }
  //calculate the aspect ratio
  $aspect_ratio = (float) $height_orig / $width_orig;
  //calulate the thumbnail width based on the height
  $thumb_height = round($thumb_width * $aspect_ratio);
  while ($thumb_height > $max_width) {
    $thumb_width -= 10;
    $thumb_height = round($thumb_width * $aspect_ratio);
  }
  $new_image = imagecreatetruecolor($thumb_width, $thumb_height);
  //Check if this image is PNG or GIF, then set if Transparent
  if (($image_type == 1) OR ($image_type == 3)) {
    imagealphablending($new_image, false);
    imagesavealpha($new_image, true);
    $transparent = imagecolorallocatealpha($new_image, 255, 255, 255, 127);
    imagefilledrectangle($new_image, 0, 0, $thumb_width, $thumb_height, $transparent);
  }
  imagecopyresampled($new_image, $im, 0, 0, 0, 0, $thumb_width, $thumb_height, $width_orig, $height_orig);
  //Generate the file, and rename it to $new_filename
  switch ($image_type) {
    case 1:
      imagegif($new_image, $new_filename);
      break;
    case 2:
      imagejpeg($new_image, $new_filename);
      break;
    case 3:
      imagepng($new_image, $new_filename);
      break;
    default:
      trigger_error('Failed resize image!', E_USER_WARNING);
      break;
  }
  return $new_filename;
}










function resize($img){
/*
only if you script on another folder get the file name*/
$r =explode("../",$img);
$name=end($r);


$vdir_upload = '../upload/thumb/';
list($width_orig, $height_orig) = getimagesize($img);
//ne size
$dst_width = 150;
$dst_height = ($dst_width/$width_orig)*$height_orig;
$im = imagecreatetruecolor($dst_width,$dst_height);
$image = imagecreatefromjpeg($img);
imagecopyresampled($im, $image, 0, 0, 0, 0, $dst_width, $dst_height, $width_orig, $height_orig);
//modive the name as u need
imagejpeg($im,$vdir_upload . "small" .$datef. $name);
//save memory
imagedestroy($im);
}





function generate_image_thumbnail($source_image_path, $thumbnail_image_path, $thumbnail_image_width, $source_image_height)
{
    list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
    switch ($source_image_type) {
        case IMAGETYPE_GIF:
            $source_gd_image = imagecreatefromgif($source_image_path);
            break;
        case IMAGETYPE_JPEG:
            $source_gd_image = imagecreatefromjpeg($source_image_path);
            break;
        case IMAGETYPE_PNG:
            $source_gd_image = imagecreatefrompng($source_image_path);
            break;
    }
    if ($source_gd_image === false) {
        return false;
    }
    $source_aspect_ratio = $source_image_width / $source_image_height;
    $thumbnail_aspect_ratio = $thumbnail_image_width / $thumbnail_image_height;
    if ($source_image_width <= $thumbnail_image_width && $source_image_height <= $thumbnail_image_height) {
        $thumbnail_image_width = $source_image_width;
        $thumbnail_image_height = $source_image_height;
    } elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) {
        $thumbnail_image_width = (int) ($thumbnail_image_height * $source_aspect_ratio);
        $thumbnail_image_height = $thumbnail_image_height;
    } else {
        $thumbnail_image_width = $thumbnail_image_width;
        $thumbnail_image_height = (int) ($thumbnail_image_width / $source_aspect_ratio);
    }
    $thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);
    imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);

    $img_disp = imagecreatetruecolor($thumbnail_image_width,$thumbnail_image_width);
    $backcolor = imagecolorallocate($img_disp,0,0,0);
    imagefill($img_disp,0,0,$backcolor);

        imagecopy($img_disp, $thumbnail_gd_image, (imagesx($img_disp)/2)-(imagesx($thumbnail_gd_image)/2), (imagesy($img_disp)/2)-(imagesy($thumbnail_gd_image)/2), 0, 0, imagesx($thumbnail_gd_image), imagesy($thumbnail_gd_image));

    imagejpeg($img_disp, $thumbnail_image_path, 90);
    imagedestroy($source_gd_image);
    imagedestroy($thumbnail_gd_image);
    imagedestroy($img_disp);
    return true;
}










function generateLogs($sectionType,$sectionAction,$sectionId){


$select='superParentId';
$where='id="'.$_SESSION['userid'].'" and email="'.$_SESSION['username'].'"';
$rs=GetPageRecord($select,_USER_MASTER_,$where);
$LoginUserDetails=mysqli_fetch_array($rs);
$loginusersuperParentId=$LoginUserDetails['superParentId'];



$dateAdded=time();
$namevalue ='userId="'.$loginusersuperParentId.'",modifyBy="'.$_SESSION['userid'].'",sectionType="'.$sectionType.'",sectionAction="'.$sectionAction.'",sectionId="'.$sectionId.'",modifyDate="'.$dateAdded.'"';
$sql_ins="insert into "._SYSTEM_LOGS_MASTER_." set ".$namevalue."";
mysql_query($sql_ins) or die(mysql_error());
return 'yes';
}


function datetimemix($date){
return date('j F Y, g:i A', $date);
}

function dateDMY($date){
return date('d-m-Y', $date);
}


function getExtension($str) {
$i = strrpos($str,".");
if (!$i) { return ""; }
$l = strlen($str) - $i;
$ext = substr($str,$i+1,$l);
return $ext;
}













function makedatetime($ptime)
{
    $etime = time() - $ptime;

    if ($etime < 1)
    {
        return '0 seconds';
    }

    $a = array( 365 * 24 * 60 * 60  =>  'year',
                 30 * 24 * 60 * 60  =>  'month',
                      24 * 60 * 60  =>  'day',
                           60 * 60  =>  'hour',
                                60  =>  'minute',
                                 1  =>  'second'
                );
    $a_plural = array( 'year'   => 'years',
                       'month'  => 'months',
                       'day'    => 'days',
                       'hour'   => 'hours',
                       'minute' => 'minutes',
                       'second' => 'seconds'
                );

    foreach ($a as $secs => $str)
    {
        $d = $etime / $secs;
        if ($d >= 1)
        {
            $r = round($d);
            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . '';
        }
    }
}









function getCurrencyName($id){
if($id!=''){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_QUERY_CURRENCY_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['name'];
}
}
}



function getCurrencyValue($id){
if($id!=''){
$selectaa='currencyValue';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_QUERY_CURRENCY_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['currencyValue'];
}
}
}





function getChangeCurrencyValue($id,$changeid,$valuefield){

if($id!='' && $changeid!=''){
$selectaa='currencyValue';
$whereaa='currencyFrom="'.$id.'" and currencyTo="'.$changeid.'" ';
$rsaa=GetPageRecord($selectaa,_CURRENCY_CONVERSION_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
$cr1= $userss['currencyValue'];
}


if($id!='' && $changeid!=''){
$selectaa='currencyValue';
$whereaa='currencyTo="'.$id.'" and currencyFrom="'.$changeid.'" ';
$rsaa=GetPageRecord($selectaa,_CURRENCY_CONVERSION_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
$cr2= $userss['currencyValue'];
}



if($cr1!='' && $cr2!=''){

if($cr1<$cr2){
$finalvalue=$valuefield*$cr2;
} else {
$finalvalue=$valuefield/$cr1;
}


} else {
$finalvalue=$valuefield;
}


}
}

return $finalvalue;
}

function getDepartmentName($id){
if($id!=''){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_DEPARTMENT_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['name'];
}
}
}

function getCategoryName($id){
if($id!=''){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_CATEGORY_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['name'];
}
}
}


function getBuyerName($id){
if($id!=''){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,'buyerMaster',$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['name'];
}
}
}

function getbrandName($id){
if($id!=''){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,'brandMaster',$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['name'];
}
}
}



function getSupplierName($id){
if($id!=''){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,'suppliersMaster',$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['name'];
}
}
}

function getSupplierCode($id){
if($id!=''){
$selectaa='supplierId';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,'suppliersMaster',$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['supplierId'];
}
}
}


function seasonName($id){
if($id!=''){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_SEASON_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['name'];
}
}
}





function getSubCategoryName($id){
if($id!=''){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_SUB_CATEGORY_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['name'];
}
}
}

function getDescriptionName($id){
if($id!=''){
$selectaa='longDescription';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,'materialDescriptionMaster',$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['longDescription'];
}
}
}

function getdatetime($datestring){
if($datestring!='0'){
return date("d M, Y - h:i A", strtotime($datestring));
} else {
return '-';
}
}

function getStyleRefId($id){
if($id!=''){
$selectaa='styleRefId';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_QUERY_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['styleRefId'];
}
}
}

function getSeasonName($id){
if($id!=''){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,'seasonMaster',$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['name'];
}
}
}



function GetRecordListJs($select,$tablename,$where,$limit,$page,$targetpage){
if(is_numeric($page) && $page!=''){
$page=$page;
} else {
$page=1;
}
if(is_numeric($limit) && $limit!=''){
$limit=$limit;
} else {
$limit=25;
}

$query = "SELECT COUNT(*) as num FROM ".$tablename."  ".$where."";
$total_pages = mysqli_fetch_array(mysql_query($query));
$total_pages = $total_pages[num];
$stages = 3;
$page = mysql_escape_string($page);
if($page){
$start = ($page - 1) * $limit;
}else{
$start = 0;
}
$query1 = "SELECT ".$select." FROM ".$tablename."  ".$where." LIMIT $start,  ".$limit."";
$result=mysql_query($query1) or die(mysql_error());
//--------------paging--------------------

if ($page == 0){$page = 1;}
$prev = $page - 1;
$next = $page + 1;
$lastpage = ceil($total_pages/$limit);
$LastPagem1 = $lastpage - 1;
$paginate = '';
if($lastpage > 1)
{

$paginate .= "<div class='paginate'>";

if ($page > 1){
$paginate.= "<a href='#' onclick='insidepageloader();'  pagecon='".$targetpage."page=$prev'>Previous</a>";

}else{
$paginate.= "<span class='disabled'>Previous</span>";	}



if ($lastpage < 7 + ($stages * 2))

{

for ($counter = 1; $counter <= $lastpage; $counter++)

{

if ($counter == $page){

$paginate.= "<span class='current'>$counter</span>";

}else{

$paginate.= "<a href='#' onclick='insidepageloader();' pagecon='".$targetpage."page=$counter'>$counter</a>";}

}

}

elseif($lastpage > 5 + ($stages * 2))

{

if($page < 1 + ($stages * 2))

{

for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)

{

if ($counter == $page){

$paginate.= "<span class='current'>$counter</span>";

}else{

$paginate.= "<a  onclick='insidepageloader();'  pagecon='".$targetpage."page=$counter'   href='#'>$counter</a>";}

}

$paginate.= "...";

$paginate.= "<a   onclick='insidepageloader();'  pagecon='".$targetpage."page=$LastPagem1'   href='#'>$LastPagem1</a>";

$paginate.= "<a  onclick='insidepageloader();'  pagecon='".$targetpage."page=$lastpage' href='#'>$lastpage</a>";

}

elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))

{

$paginate.= "<a onclick='insidepageloader();'  pagecon='".$targetpage."page=1'  href='#'>1</a>";

$paginate.= "<a onclick='insidepageloader();'  pagecon='".$targetpage."page=2'   href='#'>2</a>";

$paginate.= "...";

for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)

{

if ($counter == $page){

$paginate.= "<span class='current'>$counter</span>";

}else{

$paginate.= "<a onclick='insidepageloader();'  pagecon='".$targetpage."page=$counter' href='#'>$counter</a>";}

}

$paginate.= "...";

$paginate.= "<a onclick='insidepageloader();'  pagecon='".$targetpage."page=$LastPagem1'  href='#'>$LastPagem1</a>";

$paginate.= "<a onclick='insidepageloader();'  pagecon='".$targetpage."page=$lastpage'   href='#'>$lastpage</a>";

}

else

{

$paginate.= "<a onclick='insidepageloader();'  pagecon='".$targetpage."page=1'  href='#'>1</a>";

$paginate.= "<a  onclick='insidepageloader();'  pagecon='".$targetpage."page=2'   href='#'>2</a>";

$paginate.= "...";

for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)

{

if ($counter == $page){

$paginate.= "<span class='current'>$counter</span>";

}else{

$paginate.= "<a onclick='insidepageloader();'  pagecon='".$targetpage."page=$counter'   href='#'>$counter</a>";}

}
}

} if ($page < $counter - 1){

$paginate.= "<a  onclick='insidepageloader();'  pagecon='".$targetpage."page=$next'   href='#'>Next</a>";

}else{

$paginate.= "<span class='disabled'>Next</span>";

}

$paginate.= "</div>";

}

return array($result,$total_pages,$paginate);
}



function findExtension ($filename)
{
   $filename = strtolower($filename) ;
   $exts = explode(".", $filename) ;
   $n = count($exts)-1;
   $exts = $exts[$n];
   return $exts;
}


function showsmily($str)
{
  $siteurl='https://apparelerp.in/apparelerp/';

  $str=str_replace(':smi:','<img src="'.$siteurl.'images/emoji/happy.png">',$str);
  $str=str_replace('):','<img src="'.$siteurl.'images/emoji/unhappy.png">',$str);
  $str=str_replace(';)','<img src="'.$siteurl.'images/emoji/surprised.png">',$str);

  $str=str_replace(':win:','<img src="'.$siteurl.'images/emoji/wink.png">',$str);
  $str=str_replace(':tno:','<img src="'.$siteurl.'images/emoji/tongue-out.png">',$str);
  $str=str_replace(':sus:','<img src="'.$siteurl.'images/emoji/suspicious.png">',$str);
  $str=str_replace(':)','<img src="'.$siteurl.'images/emoji/smiling.png">',$str);
  $str=str_replace(':sml:','<img src="'.$siteurl.'images/emoji/smile.png">',$str);
  $str=str_replace(':srt:','<img src="'.$siteurl.'images/emoji/smart.png">',$str);
  $str=str_replace(':set:','<img src="'.$siteurl.'images/emoji/secret.png">',$str);
  $str=str_replace(':sd:','<img src="'.$siteurl.'images/emoji/sad.png">',$str);
  $str=str_replace(':qit:','<img src="'.$siteurl.'images/emoji/quiet.png">',$str);
  $str=str_replace(':nnj:','<img src="'.$siteurl.'images/emoji/ninja.png">',$str);
  $str=str_replace(':nrd:','<img src="'.$siteurl.'images/emoji/nerd.png">',$str);
  $str=str_replace(':md:','<img src="'.$siteurl.'images/emoji/mad.png">',$str);
  $str=str_replace(':kis:','<img src="'.$siteurl.'images/emoji/kissing.png">',$str);
  $str=str_replace(':lov:','<img src="'.$siteurl.'images/emoji/in-love.png">',$str);
  $str=str_replace(':ill:','<img src="'.$siteurl.'images/emoji/ill.png">',$str);
  $str=str_replace(':hp4:','<img src="'.$siteurl.'images/emoji/happy-4.png">',$str);
  $str=str_replace(':hp3:','<img src="'.$siteurl.'images/emoji/happy-3.png">',$str);
  $str=str_replace(':hp2:','<img src="'.$siteurl.'images/emoji/happy-2.png">',$str);
  $str=str_replace(':hp1:','<img src="'.$siteurl.'images/emoji/happy-1.png">',$str);
  $str=str_replace(':emt:','<img src="'.$siteurl.'images/emoji/emoticons.png">',$str);
  $str=str_replace(':emb:','<img src="'.$siteurl.'images/emoji/embarrassed.png">',$str);
  $str=str_replace(':cr:','<img src="'.$siteurl.'images/emoji/crying.png">',$str);
  $str=str_replace(':con:','<img src="'.$siteurl.'images/emoji/confused.png">',$str);
  $str=str_replace(':bo:','<img src="'.$siteurl.'images/emoji/bored.png">',$str);
  $str=str_replace(':brd:','<img src="'.$siteurl.'images/emoji/bored-2.png">',$str);
  $str=str_replace(':br1:','<img src="'.$siteurl.'images/emoji/bored-1.png">',$str);
  $str=str_replace(':ang:','<img src="'.$siteurl.'images/emoji/angry.png">',$str);
  $str=str_replace(':ned:','<img src="'.$siteurl.'images/emoji/mad.png">',$str);

 return $str;
}

function closeConn()
{
	mysql_close();
}


function normalclean($str)
{
	$str = @trim($str);
	//$str=preg_replace( '/\s+/', ' ',($str));
	//if(get_magic_quotes_gpc())
	//{
		$str = stripslashes($str);
	//}
	return mysql_real_escape_string($str);
}



?>
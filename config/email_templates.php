<?php

include "inc.php";

include "config/logincheck.php";

$activeleftmenuID=59;



if($_GET['status']!='' && $_GET['statusid']!=''){
$status=clean($_GET['status']);
$listid=clean(decode($_GET['statusid']));
$where='id='.$listid.'';
$namevalue ='status="'.$status.'"';
$returndeleteupdate = updatelisting(_email_templates_master_,$namevalue,$where);
if($returndeleteupdate=='yes'){
$truemsg='Record status  updated.';
}
}




if($_GET['action']=='add'){

$truemsg='Record has been successfully Added.';

}



if($_GET['action']=='update'){

$truemsg='Record has been successfully updated.';

}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Manage Templates - <?php echo $systeminfo['systemname']; ?></title>

<link href="css/main.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/jquery.min.js"></script>

<script type="text/javascript" src="js/ddaccordion.js"></script>

<script type="text/javascript" src="js/system_function.js"></script>

<script type="text/javascript" src="js/tablesortingjquery.js"></script>

<script src="js/validation.js"></script>



</head>



<body>





 <?php include("header_top.php"); ?>



<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">

  <tr>

    <td width="4%" align="left" valign="top" id="leftouter">





    <?php include("left.php"); ?>







    </td>

    <td width="96%" align="left" valign="top">

	<div class="innertop">

	  <table width="100%" border="0" cellpadding="0" cellspacing="0">

        <tr>

          <td width="50%" align="left" valign="top"><h1>Manage Email Templates </h1>

              <div class="brdc"><span><a href="<?php echo $fullurl; ?>">Dashboard</a></span><span>-</span><span>Manage Email Templates </span></div></td>

          <td width="50%" align="right" valign="bottom">



              <a href="add_email_templates.php?page=<?php echo encode('email_templates.php'); ?>"><input type="button" name="Submit2" value="+ Add New" class="darkgreenbutton" /></a>







			   </td>

        </tr>

      </table>

	</div>



	<div class="row1"><div class="whitebox">

		<?php if($truemsg!=''){ ?><div class="truemsg"><?php echo $truemsg; ?></div><?php } ?>

		<div class="sectionoption">

		  <table width="100%" border="0" cellpadding="0" cellspacing="0">

            <tr>

              <td width="7%" align="left" style="padding-right:10px; display:none;" id="deletelistbutton"><input type="button" name="Submit2" value="Delete" class="darkredbutton" style="margin-left:0px;" onclick="deletlist('Confirm!','Do you want to delete selected records?');"  /></td>

           <form method="get">   <td width="45%" align="left"><table border="0" cellpadding="0" cellspacing="0">

                <tr>

                  <td><select name="records" id="records" onchange="this.form.submit();">

                    <option value="25" <?php if($_GET['records']=='25'){ ?> selected="selected"<?php } ?>>25</option>

                    <option value="50" <?php if($_GET['records']=='50'){ ?> selected="selected"<?php } ?>>50</option>

                    <option value="100" <?php if($_GET['records']=='100'){ ?> selected="selected"<?php } ?>>100</option>

                    <option value="200" <?php if($_GET['records']=='200'){ ?> selected="selected"<?php } ?>>200</option>

                    <option value="300" <?php if($_GET['records']=='300'){ ?> selected="selected"<?php } ?>>300</option>

                  </select>                  </td>

                  <td style="padding-left:5px;">records</td>

                </tr>



              </table></td>

              <td width="48%" align="right"><table border="0" cellpadding="0" cellspacing="0">

                <tr>

                  <td>Search:                  </td>

                  <td style="padding-left:5px;"><input name="search" type="search" id="search" value="<?php echo clean($_GET['search']); ?>" placeholder="Enter Keyword" /></td>

                </tr>



              </table></td></form>

            </tr>

          </table>

		</div>

		</form>

		<div class="sectioninner">

<form name="alllistfrm" id="alllistfrm" method="post">

		<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tablesorter gridtable">

   <thead>

   <tr>

     <td width="9%" align="center" class="header"  style=" display:none;"><input type="checkbox"  onclick="checkallbox();" name="checkAll"  id="checkAll"  value="1" /></td>

    <th width="10%" align="center" class="header sortingbg">No.</th>

    <th width="37%" align="left" class="header">Subject</th>

    <th width="25%" align="left" class="header">Created Date </th>
    <th width="10%" align="center" class="header">Status</th>
    <th width="9%" align="left" class="header">&nbsp;</th>
   </tr></thead>



<?php

$no=1;

$select='';

$where='';

$rs='';

$page=clean($_GET['page']);

$limit=clean($_GET['records']);

$search=clean($_GET['search']);

$select='*';

$where='where subject like "%'.$search.'%" order by subject';

$targetpage=$fullurl.'email_templates.php?search='.$search.'&records='.$limit.'&';

$rs=GetRecordList($select,_email_templates_master_,$where,$limit,$page,$targetpage);

$totalentry=$rs[1];

$paging=$rs[2];

while($templates=mysqli_fetch_array($rs[0])){

?>



  <tr>

    <td align="center"  style=" display:none;"><input type="checkbox" name="check_list[]" class="chk" id="check_list[]"  value="<?php echo strip($templates['id']); ?>" /></td>

    <td align="center"><?php echo $no; ?></td>

    <td align="left"><?php echo strip($templates['subject']); ?></td>

    <td align="left"><?php echo date("F j, Y", strtotime($templates['createdTime'])); ?></td>
    <td align="center"><?php if($templates['status']==1){ ?>
      <a href="email_templates.php?records=<?php echo $_GET['records']; ?>&search=<?php echo $_GET['search']; ?>&page=<?php echo $_GET['page']; ?>&status=0&statusid=<?php echo encode($templates['id']); ?>"><img src="images/Ok.png" width="20" border="0" /></a>
      <?php } else { ?>
     <a href="email_templates.php?records=<?php echo $_GET['records']; ?>&search=<?php echo $_GET['search']; ?>&page=<?php echo $_GET['page']; ?>&status=1&statusid=<?php echo encode($templates['id']); ?>"><img src="images/No.png" width="20" border="0" /></a>      <?php } ?></td>
    <td align="right"><a href="add_email_templates.php?page=<?php echo encode('email_templates.php'); ?>&id=<?php echo encode($templates['id']); ?>"><img src="images/new-24-128.png" alt="Edit" width="20" height="20" border="0" title="Edit" /></a></td>
  </tr>

  <?php $no++; } ?>
</table>

<input name="formlist" type="hidden" id="formlist" value="1" />

</form>

		</div>



		<div class="pagingdiv">



		<table width="100%" border="0" cellpadding="0" cellspacing="0">

  <tr>

    <td><?php echo $totalentry; ?> entries</td>

    <td align="right"><div class="pagingnumbers"><?php echo $paging; ?></div></td>

  </tr>

</table>



		</div>

		</div></div>



         <?php include("footer.php"); ?>



	</td>

  </tr>

</table>



</body>

</html>


<?php
include_once('inc.php');
include_once('config/session-check.inc.php'); // check user login session
$pageIndex=3;

?>
<!DOCTYPE html>
<html>
<head>
<title>Tasks - <?php echo $companNameTitle;?></title>
<link rel="stylesheet" type="text/css" href="<?php echo $fullurl;?>css/responsive.css">
<link rel="stylesheet" type="text/css" href="<?php echo $fullurl;?>css/style.css">
<link rel="icon" href="<?php echo $fullurl;?>favicon.ico" type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
<script src="<?php echo $fullurl;?>js/jquery.min.js"></script>
<script src="<?php echo $fullurl;?>js/main.js"></script>
</head>
<body>
<div id="wrapper" class="active">
  <?php include('header.php');?>
  <div class="container main">
    <div class="premium_tag"><a href="#">Go Premium</a>
      <p id="typewriter"></p>
    </div>
    <div class="home_container">
      <?php include('left-sidebar.php');?>

    </div>
	<div class="center_content">

<div class="groups">

<div class="how-prjct-work">
  <h2>Tasks List</h2>
  <button class="btn btn-primary" style="padding: 3px 8px !important; border-radius: 4px; border: 1px solid #d8eefb;" onClick="funcommonpopupwin('520px','auto','https://virtualawfis.com/common_popup_inner.php?type=personaldatasetting','Create Task');">Create Task</button>
 	<table width="100%" cellspacing="2" cellpadding="2" style="border: 1px solid #ccc;">
	<thead>
	  <tr style="background-color:#47a6dc; color:#FFFFFF;">
	    <th>Task Id</th>
		<th>Subject</th>
		<th>Task Date</th>
		<th>Duration</th>
	  </tr>
  	</thead>
	<tbody>
<?php
$no=0;
$select='*';
$where='';
$rs='';
$limit=clean($_GET['records']);
$where='where 1 order by id desc';
$page=$_GET['page'];
$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
$rs=GetRecordList($select,'tasksMaster',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

?>
	  <tr>
		<td> </td>
		<td> </td>
		<td> </td>
		<td> </td>
	  </tr>
<?php $no++; } ?>
  </tbody>
</table>
<?php if($no==1){ ?>
<div>No record found.</div>
<?php } ?>
</div>



</div>


  </div>
  </div>
  <?php include('footer.php');?>
</div>
</body>
</html>

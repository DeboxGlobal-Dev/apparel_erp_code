<?php
//=============delete account head=============
if(trim($_REQUEST['action'])=='deleteaccounthead' && trim($_REQUEST['editId'])!=''){

$where='id="'.decode($_REQUEST['editId']).'"';
$namevalue ='deletestatus=1';
$update = updatelisting('finalheadcreationmaster',$namevalue,$where);

?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_REQUEST['module']; ?>&alt=2');
</script>
<?php }

?>
<div class="page-content">
<style>
/* CSS to style Treeview menu  */
.tree-structure ol.tree {
	padding: 0 0 0 30px;
	width: 300px;
}

.tree-structure li {
    position: relative;
    margin-left: -15px;
    list-style: none;
    margin-bottom: 20px;
}

.tree-structure li input + ol {
    background: url(images/toggle-small-expand.png) 40px 0 no-repeat;
    margin: -2.10em 0px 8px -44px;
    height: 1em;
}
.tree-structure li input + ol > li {
	display: none;
	margin-left: -14px !important;
	padding-left: 1px;
}
.tree-structure li label {
	background: url(images/folder.png) 15px 1px no-repeat;
	cursor: pointer;
	display: block;
	padding-left: 37px;
}
.tree-structure li input:checked + ol {
	background: url(images/toggle-small.png) 40px 5px no-repeat;
	margin: -2.50em 0px 8px -44px;
    padding: 1.563em 0 0 80px;
	height: auto;

}
.tree-structure li input:checked + ol > li {
	display: block;
	margin: 8px 0px 0px 0.125em;
}
.tree-structure li input:checked + ol > li:last-child {
	margin: 8px 0 0.063em;
}

.tree-structure li input {
    position: absolute;
    left: 0px;
    margin-left: 0;
    opacity: 0;
    z-index: 2;
    cursor: pointer;
    height: 1em;
    width: 1em;
    top: 0px;
}
a{
 cursor: pointer;
}


</style>


</head>
<body>
<div class="content-wrapper">
	<div class="content pt-0" style="margin-top:20px;">
		<div class="row">
			<div class="col-xl-12">
				<div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
					<div class="col-xl-11"><h5 class="card-title"><?php echo $pageName; ?></h5>
					</div>
					<div class="col-xl-1"><a href="showpage.crm?module=masters"  class="btn bg-teal-400" aria-expanded="false" style="background-color: gray;"><i class="fa fa-arrow-left mr-2"></i>Back</a>

					</div>

					</div>
					<div class="card">
					<div class="row">

					<div class="col-md-6">
					<div class="tree-structure" style="padding: 20px 10px;">
<?php
// function to create dynamic treeview menus
function createTreeView($parent, $menu) {
   $html = "";
   if (isset($menu['parents'][$parent])) {
      $html .= "
      <ol class='tree'>";
       foreach ($menu['parents'][$parent] as $itemId) {
          if(!isset($menu['parents'][$itemId])) {
		  //if($menu['items'][$itemId]['id']!=''){ $cls = "class='branch'";   }

             $html .= "<li><label for='subfolder2'
><a onclick='showpop(".$menu['items'][$itemId]['id'].");' data-toggle='modal'  data-target='#modalpop'>".$menu['items'][$itemId]['label']."</a></label>
 <input type='checkbox' name='subfolder2'/></li>";
          }
          if(isset($menu['parents'][$itemId])) {
             $html .= "
             <li class=''><label for='subfolder2'>
<a onclick='showpop(".$menu['items'][$itemId]['id'].");' data-toggle='modal' data-target='#modalpop'>".$menu['items'][$itemId]['label']
."</a></label> <input type='checkbox' name='subfolder2'/>

";
             $html .= createTreeView($itemId, $menu);
             $html .= "</li>";
          }
       }
       $html .= "</ol>";
   }
   return $html;
}
?>


<?php


$sqlm = "SELECT * FROM companyMaster order by id asc";
$resultm = mysql_query($sqlm);
while($comData=mysqli_fetch_array($resultm)){ ?>

<span style="font-size: 14px; margin-bottom: 12px; display: block; background-color: #fbe9a9; padding: 5px 13px; color: #000; font-weight: 500;"><?php echo $comData['name']; ?></span>

<?php
$sql = 'SELECT * FROM finalheadcreationmaster  where companyId="'.$comData['id'].'" and deletestatus=0 ORDER BY parent, sort, label';
//$sql = "SELECT id, label, link, parent FROM headcreationmaster ORDER BY parent, sort, label";

$result = mysql_query($sql);
// Create an array to conatin a list of items and parents
$menus = array(
	'items' => array(),
	'parents' => array()
);
// Builds the array lists with data from the SQL result
while ($items = mysqli_fetch_array($result)) {
	// Create current menus item id into array
	 $menus['items'][$items['id']] = $items;
	// Creates list of all items with children
	$menus['parents'][$items['parent']][] = $items['id'];
}
// Print all tree view menus
echo createTreeView(0, $menus);

}
?>
 </div>
 					</div>

					<div class="col-md-6">

 					</div>

 					</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

</div>
 <script>
 function showpop(id){
     opmodalpop('Add/Edit','modalpop.php?action=<?php echo $_GET['module']; ?>&id='+id,"500px","auto");
 }
 </script>
<?php
include "inc.php";
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

$sqlm = 'SELECT * FROM companyMaster where id="'.decode($_REQUEST['c']).'"';
$resultm = mysql_query($sqlm);
while($comData=mysqli_fetch_array($resultm)){ ?>

<span style="font-size: 14px;color: #000; font-weight: 500;"><?php echo $comData['name']; ?></span>
<?php
$sql = 'SELECT * FROM finalheadcreationmaster  where companyId="'.$comData['id'].'" and deletestatus=0 ORDER BY parent, sort, label';

$result = mysql_query($sql);
$menus = array(
	'items' => array(),
	'parents' => array()
);
while ($items = mysqli_fetch_array($result)) {
	 $menus['items'][$items['id']] = $items;
	$menus['parents'][$items['parent']][] = $items['id'];
}
echo createTreeView(0, $menus);
}
?>
<style>
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
    background: url(../images/toggle-small-expand.png) 40px 0 no-repeat;
    margin: -2.10em 0px 8px -44px;
    height: 1em;
}
.tree-structure li input + ol > li {
	display: none;
	margin-left: -14px !important;
	padding-left: 1px;
}
.tree-structure li label {
	background: url(../images/folder.png) 15px 1px no-repeat;
	cursor: pointer;
	display: block;
	padding-left: 37px;
}
.tree-structure li input:checked + ol {
	background: url(../images/toggle-small.png) 40px 5px no-repeat;
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

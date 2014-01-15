<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Category.php';

list($categoryTree, $subCategoryName, $mainCategoryName) = $_category->MakeMenuTree(!empty($request[1]) ? $request[1] : -1);
// echo $mainCategoryName;
// echo "<br>";
// echo $subCategoryName;
$smarty->assign('mainCategoryName', $mainCategoryName)
       ->assign('subCategoryName', $subCategoryName)
       ->assign('menu', $categoryTree)
       ->display('all_works.tpl');
?>
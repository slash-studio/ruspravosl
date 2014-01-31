<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Category.php';

$category = !empty($request[2]) ? $request[2] : null;
list($categoryTree, $subCategoryName, $mainCategoryName) = $_category->MakeMenuTree($contestID, $category, true);
$age = isset($request[3]) ? $request[3] : -1;

list($resImgs, $resUsers) = $_user->GetCatalogView($contestID, $category, $age);
$smarty->assign('mainCategoryName', $mainCategoryName)
       ->assign('subCategoryName', $subCategoryName)
       ->assign('age', $age % 3)
       ->assign('images', $resImgs)
       ->assign('users', $resUsers)
       ->assign('menu', $categoryTree)
       ->display('admin.photos.tpl');
?>
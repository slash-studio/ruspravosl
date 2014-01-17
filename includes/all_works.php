<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.User.php';

$category = !empty($request[1]) ? $request[1] : null;
list($categoryTree, $subCategoryName, $mainCategoryName) = $_category->MakeMenuTree($category);
$age = isset($request[2]) ? $request[2] : -1;

list($resImgs, $resUsers) = $_user->GetCatalogView($category, $age);

$smarty->assign('mainCategoryName', $mainCategoryName)
       ->assign('subCategoryName', $subCategoryName)
       ->assign('age', $age % 3)
       ->assign('images', $resImgs)
       ->assign('users', $resUsers)
       ->assign('menu', $categoryTree)
       ->display('all_works.tpl');
?>
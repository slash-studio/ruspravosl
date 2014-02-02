<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Category.php';


$contestID = !empty($request[1]) ? $request[1] : null;

$isWinnersPages = false;
if (isset($request[2])) {
   $isWinnersPages = $request[2] == 'winners';
}

$smarty->assign('isWinnersPages', $isWinnersPages);
if ($isWinnersPages) {
   $smarty->assign('winners_cat', $_category->MakeWinnerTree($contestID));
} else {
   $category = !empty($request[2]) ? $request[2] : null;
   list($categoryTree, $subCategoryName, $mainCategoryName) = $_category->MakeMenuTree($contestID, $category);
   $age = isset($request[3]) ? $request[3] : -1;

   list($resImgs, $resUsers) = $_user->GetCatalogView($contestID, $category, $age);

   $smarty->assign('contID', $contestID)
          ->assign('mainCategoryName', $mainCategoryName)
          ->assign('subCategoryName', $subCategoryName)
          ->assign('age', $age % 3)
          ->assign('images', $resImgs)
          ->assign('users', $resUsers);
}

list($cats, $contestName) = $_category->MakeArchiveTree($contestID);
$smarty->assign('cats', $cats)
       ->assign('contestName', $contestName)
       ->display('archive.tpl');
?>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Category.php';

$smarty->assign('categories_options', $_category->MakeSelectTree())
       ->assign('category_tree', $_category->MakeAdminTree())
       ->display('admin.categories.tpl');
?>
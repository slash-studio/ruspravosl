<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Contest.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Category.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/handler.php';

$addCats       = false;
$lastContest   = $_contest->GetLastContest();
// $lastContest['contest_status'] = !empty($lastContest) ? $lastContest['contest_status'] : 0;
$addCatSession = isset($_SESSION['add_category']) ? $_SESSION['add_category'] : false;
if (isset($_POST['enable_competitive'])) {
   $post = GetPOST();
   $post['mode'] = 'Update';
   $post['params'] = Array('id' => $post['contest_id'], 'status' => $post['contest_status'] % 2);
   HandleAdminData($_contest, $post, 'contests');
} elseif (isset($_POST['delete_contest'])) {
   $post = GetPOST();
   $post['mode'] = 'Delete';
   $post['params'] = Array('id' => $post['contest_id']);
   HandleAdminData($_contest, $post, 'contests');
} elseif (isset($request[2]) && $request[2] == 'new_contest') {
   if (!isset($_POST['new_contest'])) {
      header('Location: /admin/contests');
   }
   $post = GetPOST();
   if (empty($post['name'])) {
      $smarty->assign('error_txt', 'Имя не может быть пустым!');
   } else {
      $post['mode']   = 'Insert';
      $post['params'] = Array('name' => $post['name']);
      $_SESSION['add_category'] = true;
      HandleAdminData($_contest, $post, 'contests/add_category');

   }
} elseif ($addCats = isset($request[2]) && $request[2] == 'add_category') {
  if (!$addCatSession) header('Location: /admin/contests');
  $lastContestID = !empty($lastContest) ? $lastContest['contest_id'] : null;
  $smarty->assign('categories_options', $_category->MakeSelectTree($lastContestID))
         ->assign('category_tree', $_category->MakeAdminTree($lastContestID));
} elseif (isset($_POST['done_contest'])) {
  $_SESSION['add_category'] = false;
  unset($_SESSION['add_category']);
  header('Location: /admin/contests');
}

$smarty->assign('addCats', $addCats && !empty($lastContest))
       ->assign('last_contest', $lastContest)
       ->display('admin.contests.tpl');
?>
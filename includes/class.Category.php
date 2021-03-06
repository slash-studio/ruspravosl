<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Entity.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Image.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Contest.php';

class Category extends Entity
{
   const TABLE = 'categories';

   public function __construct()
   {
      parent::__construct();
      $this->fields = Array(
         new Field(
            'id',
            null,
            false
         ),
         new Field(
            'name',
            null,
            true,
            Array('IsNotEmpty')
         ),
         new Field(
            'parent_id',
            null,
            true,
            Array('IsNotEmpty')
         ),
         new Field(
            'contest_id',
            null,
            true,
            Array('IsNotEmpty')
         ),
         new Field(
            'path',
            null,
            false,
            Array('IsSetVar'),
            'Like'
         )
      );
   }

   public function OpenInTreeStyle($id)
   {
      $res = parent::_Select(
         SQL::GetListFieldsForSelect(
            SQL::PrepareFieldsForSelect(
               static::TABLE,
               $this->fields
            )
         ),
         SQL::ToWhrCls(Array($this->ToTblNm('id'))),
         Array($id)
      );
      $path     = explode('.', $res[0][$this->ToPrfxNm('path')]);
      $result   = '<style>';
      $css_path = Array();
      foreach ($path as $key => $c) {
         $css_path[$key] = '#c_' . $path[$key] . '>ul';
      }
      $result .= join(',', $css_path);
      $result .= '{display: block;}</style>';
      $js_path = Array();
      foreach ($path as $key => $c) {
         $js_path[$key] = '#c_' . $path[$key] . '>a';
      }
      $js_path[] = '#c_' . $id . '>a';
      $result .=
         "<script>
            $(function(){
               $('" . join(',', $js_path) . "').addClass('active open');
            });
         </script>";

      return $result;
   }

   public function GetAllRoot($lang)
   {
      $idField   = $this->GetFieldByName('id');
      $nameField = $this->GetFieldByName('name');

      return
         parent::SelectWithLang(
            Array(static::TABLE => Array($idField, $nameField)),
            $lang,
            SQL::GetListFieldsForSelect(
               SQL::PrepareFieldsForSelect(
                  static::TABLE,
                  Array($idField, $nameField)
               )
            ),
            $this->ToTblNm('id')
            . ' = '
            . $this->ToTblNm('parent_id')
         );
   }

   public function GetNames()
   {
      $this->CheckSearch();
      $idField     = $this->GetFieldByName('id');
      $nameField   = $this->GetFieldByName('name');
      $parentField = $this->GetFieldByName('parent_id');
      $fields      =
         array_merge(
            SQL::PrepareFieldsForSelect(
               static::TABLE,
               Array($nameField, $idField, $parentField)
            )
         );
      $result      =
         parent::_Select(
            SQL::GetListFieldsForSelect($fields),
            $this->search->GetClause(),
            $this->search->GetParams(),
            $this->search->GetJoins(),
            $this->search->GetLimit()
         );

      return $result;
   }

   private function SetTreeParams($id, $func = 'GetAll')
   {
      $this->CheckSearch();
      $this->search->AddClause(PackParam(static::TABLE, $this->GetFieldByName('contest_id')), $id);
      $result  = $this->$func();
      $this->search->RemoveLastClause();
      $names     = Array();
      $vertex    = Array();
      $sub_trees = Array();
      foreach ($result as $v) {
         if ($v[$this->ToPrfxNm('parent_id')] == $v[$this->ToPrfxNm('id')]) {
            $vertex[] = $v[$this->ToPrfxNm('parent_id')];
         } else {
            $sub_trees[$v[$this->ToPrfxNm('parent_id')]][] = $v[$this->ToPrfxNm('id')];
         }
         $names[$v[$this->ToPrfxNm('id')]] = $v;
      }
      $buildTree = function (&$t, $id) use (&$buildTree, $sub_trees) {
         $t[$id] = Array();
         if (isset($sub_trees[$id])) {
            foreach ($sub_trees[$id] as $k => $v) {
               $buildTree($t[$id], $v);
            }
         }
      };
      $tree      = Array();
      foreach ($vertex as $v) {
         $buildTree($tree, $v);
      }

      return Array($tree, $names);
   }

   public function MakeMenutree($contest_id, $id, $isAdminMenu = false)
   {
      if (empty($contest_id)) return Array('', null, null);
      $id = empty($id) ? -1 : $id;
      list($tree, $names) = $this->SetTreeParams($contest_id);
      $resName  = !empty($names[$id]) ? $names[$id][$this->ToPrfxNm('name')] : null;
      $resPName = null;
      if (!empty($resName)) {
         while ($id != $names[$id][$this->ToPrfxNm('parent_id')]) {
            $id = $names[$id][$this->ToPrfxNm('parent_id')];
         }
         $resPName = $names[$id][$this->ToPrfxNm('name')];
      }
      $buildTree = function ($t, $th) use (&$buildTree, $names, $isAdminMenu) {
         if (!count($t)) {
            return '';
         }
         $result = '<ul class="dropdown_block">';
         foreach ($t as $k => $sub) {
            $new_node  = "<li id='c_$k'>"
                       . "<a href='javascript:void(0)' class='dropdown_head'>" . $names[$k][$th->ToPrfxNm('name')] . '</a>';
			$next_node = $buildTree($sub, $th);
            if (empty($next_node)) {
               $id = $names[$k][$th->ToPrfxNm('id')];
               $href = $isAdminMenu ? '/admin/photos' : '/category';
               $next_node = "<ul class='dropdown_block'>"
                          . "<li><a href='$href/$id/0'>до 9 лет</a></li>"
                          . "<li><a href='$href/$id/1'>9 - 12 лет</a></li>"
                          . "<li><a href='$href/$id/2'>13 - 17 лет</a></li></ul>";
            }
            $result .= $new_node . $next_node . '</li>';
         }
         $result .= '</ul>';

         return $result;

      };
      return Array(isset($tree) ? $buildTree($tree, $this) : '', $resName, $resPName);
   }

   private function SetArchiveTreeParams()
   {
      $this->CheckSearch();
      $result  = $this->GetAll();
      $names     = Array();
      $vertex    = Array();
      $sub_trees = Array();
      foreach ($result as $v) {
         if ($v[$this->ToPrfxNm('parent_id')] == $v[$this->ToPrfxNm('id')]) {
            $vertex[] = $v[$this->ToPrfxNm('parent_id')];
         } else {
            $sub_trees[$v[$this->ToPrfxNm('parent_id')]][] = $v[$this->ToPrfxNm('id')];
         }
         $names[$v[$this->ToPrfxNm('id')]] = $v;
      }
      $buildTree = function (&$t, $id) use (&$buildTree, $sub_trees) {
         $t[$id] = Array();
         if (isset($sub_trees[$id])) {
            foreach ($sub_trees[$id] as $k => $v) {
               $buildTree($t[$id], $v);
            }
         }
      };
      $tree = Array();
      foreach ($vertex as $v) {
         $buildTree($tree, $v);
      }
      global $_contest;
      $contests = $_contest->GetAll();
      $newTree = Array();
      foreach ($contests as $contest) {
         array_push($newTree, Array());
         $newTree[count($newTree) - 1]['contest_cats'] = Array();
         $newTree[count($newTree) - 1]['contest_id']   = $contest['contest_id'];
         $newTree[count($newTree) - 1]['contest_name'] = $contest['contest_name'] . ' (' . $contest['contest_contest_date'] .' г.) ';
         foreach ($tree as $v => $sub_tree) {
            if ($contest['contest_id'] == $names[$v]['categories_contest_id']) {
               $newTree[count($newTree) - 1]['contest_cats'][$v] = $sub_tree;
            }
         }
      }
      return Array($newTree, $names);
   }

   public function MakeArchiveTree($contestID)
   {
      list($tree, $names) = $this->SetArchiveTreeParams(null);
      $buildTree = function ($contest_id, $d, $t, $th) use (&$buildTree, $names) {
         if (!count($t)) {
            return '';
         }
         $result = '<ul class="dropdown_block">';
         foreach ($t as $k => $sub) {
            $new_node  = "<li id='c_$k'>"
                       . "<a href='javascript:void(0)' class='dropdown_head'>" . $names[$k][$th->ToPrfxNm('name')] . '</a>';
         $next_node = $buildTree($contest_id, $d + 1, $sub, $th);
            if (empty($next_node)) {
               $id = $names[$k][$th->ToPrfxNm('id')];
               $next_node = "<ul class='dropdown_block'>"
                          . "<li><a href='/archive/$contest_id/$id/0'>до 9 лет</a></li>"
                          . "<li><a href='/archive/$contest_id/$id/1'>9 - 12 лет</a></li>"
                          . "<li><a href='/archive/$contest_id/$id/2'>13 - 17 лет</a></li></ul>";
            }
            $result .= $new_node . $next_node . '</li>';
         }
         if ($d == 0) {
            $result .= "<li><a href='/archive/$contest_id/winners'>Победители</a></li></ul>";
         } else {
            $result .= "</ul>";
         }
         return $result;

      };
      $result = '';
      $contestName = '';
      if (isset($tree)) {
         foreach ($tree as &$contest) {
            $id = $contest['contest_id'];
            if ($contestID == $id) {
               $contestName = $contest['contest_name'];
            }
            $result .= '<ul class="dropdown_block">'
                     . "<li><a href='javascript:void(0)' class='dropdown_head'>"
                     . $contest['contest_name']
                     . '</a>'
                     . $buildTree($contest['contest_id'], 0, $contest['contest_cats'], $this)
                     . '</li>'
                     . '</ul>';
         }
      }
      return Array($result, $contestName);
   }

   public function MakeAccountTree($contest_id, $id = -1)
   {
      if (empty($contest_id)) return '';
      list($tree, $names) = $this->SetTreeParams($contest_id);
      $buildTree = function ($t, $th) use (&$buildTree, $names) {
         if (!count($t)) {
            return Array();
         }
         $result = Array();
         foreach ($t as $k => $sub) {
            if (empty($sub)) {
               $result[] = $names[$k];
            } else {
               $result = $result + $buildTree($sub, $th);
            }
         }
         return $result;
      };
      global $_image;
      $images = $_image->GetImagesForUser($id);
      $roots = Array();
      foreach ($tree as $k => $sub) {
         $roots[$k]['info'] = $names[$k];
         $roots[$k]['subcat'] = $buildTree($sub, $this);
         if (empty($roots[$k]['subcat'])) {
            $roots[$k]['subcat'][0] = $roots[$k]['info'];
         }
         foreach ($roots[$k]['subcat'] as &$subcat) {
            $subcat['imgs_info'] = Array();
            foreach ($images as $image) {
               if ($subcat['categories_id'] == $image['images_category_id']) {
                  $subcat['imgs_info'][] = $image;
               }
            }
         }
      }
      return $roots;
   }

   public function MakeAdminTree($id)
   {
      if (empty($id)) return '';
      list($tree, $names) = $this->SetTreeParams($id);
      $buildTree = function ($t, $th) use (&$buildTree, $names) {
         if (!count($t)) {
            return '';
         }
         $result = '<ul>';
         foreach ($t as $k => $sub) {
            $result .= '<li'
               . ' data-id="' . $names[$k][$th->ToPrfxNm('id')] . '"'
               . '>'
               . '<a href="javascript:void(0)"'
               . ' data-id="' . $names[$k][$th->ToPrfxNm('id')] . '"'
               . ' data-name="' . $names[$k][$th->ToPrfxNm('name')] . '"'
               . ' data-parent-id="' . $names[$k][$th->ToPrfxNm('parent_id')] . '"'
               . '>'
               . $names[$k][$th->ToPrfxNm('name')]
               . '</a>'
               . $buildTree($sub, $th)
               . '</li>';
         }
         $result .= '</ul>';

         return $result;
      };

      return isset($tree) ? $buildTree($tree, $this) : '';
   }

   public function MakeWinnerTree($contest_id)
   {
      if (empty($contest_id)) return '';
      list($tree, $names) = $this->SetTreeParams($contest_id);
      $buildTree = function ($t, $th) use (&$buildTree, $names) {
         if (!count($t)) {
            return Array();
         }
         $result = Array();
         foreach ($t as $k => $sub) {
            if (empty($sub)) {
               $result[] = $names[$k];
            } else {
               $result = $result + $buildTree($sub, $th);
            }
         }
         return $result;
      };
      global $_image, $_user;
      $images = $_image->GetWinnersImages($contest_id);
      $roots = Array();
      foreach ($tree as $k => $sub) {
         $roots[$k]['info'] = $names[$k];
         $roots[$k]['subcat'] = $buildTree($sub, $this);
         if (empty($roots[$k]['subcat'])) {
            $roots[$k]['subcat'][0] = $roots[$k]['info'];
         }
         foreach ($roots[$k]['subcat'] as &$subcat) {
            $subcat['imgs_info'] = Array();
            $age = 0;
            while ($age < 3) {
               $subcat['imgs_info'][$age] = Array();
               foreach ($images as $image) {
                  if ($subcat['categories_id'] == $image['images_category_id'] && $_user->IsSuitableAge($image['users_age'], $age)) {
                     $subcat['imgs_info'][$age][] = $image;
                  }
               }
               $age++;
            }
         }
      }
      return $roots;
   }

   public function MakeSelectTree($id, $forCategory = true)
   {
      if (empty($id)) return '';
      list($tree, $names) = $this->SetTreeParams($id, 'GetNames');
      $buildTree = function ($t, $th, $depth) use (&$buildTree, $names, $forCategory) {
         if (!count($t)) {
            return '';
         }
         $result = '';
         foreach ($t as $k => $sub) {
            $child = $buildTree($sub, $th, $depth + 1);
            $result .= '<option value="'
               . $names[$k][$th->ToPrfxNm('id')]
               . '" '
               . (!$forCategory && !empty($child) ? 'disabled' : '')
               . '>'
               . str_repeat('&emsp;', $depth)
               . $names[$k][$th->ToPrfxNm('name')]
               . '</option>'
               . $child;
         }

         return $result;
      };
      $result    = isset($tree) ? $buildTree($tree, $this, 0) : '';

      return $forCategory ? '<option value="-1">Без родителя</option>' . $result : $result;
   }
}

$_category = new Category();
?>
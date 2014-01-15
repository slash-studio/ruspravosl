<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Entity.php';

class Category extends Entity
{
   const TABLE = 'categories';

   public function __construct()
   {
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

   private function SetTreeParams($func = 'GetAll')
   {
      $result    = $this->$func();
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

   public function MakeMenutree($id = -1)
   {
      list($tree, $names) = $this->SetTreeParams();
      $resName  = !empty($names[$id]) ? $names[$id][$this->ToPrfxNm('name')] : null;
      $resPName = null;
      if (!empty($resName)) {
         while ($id != $names[$id][$this->ToPrfxNm('parent_id')]) {
            $id = $names[$id][$this->ToPrfxNm('parent_id')];
         }
         $resPName = $names[$id][$this->ToPrfxNm('name')];
      }
      $buildTree = function ($t, $th) use (&$buildTree, $names) {
         if (!count($t)) {
            return '';
         }
         $result = '<ul class="dropdown_block">';
         foreach ($t as $k => $sub) {
            $new_node  = "<li id='c_$k'>";
            $next_node = $buildTree($sub, $th);
            if (empty($next_node)) {
               $new_node .= "<a href='/category/" . $names[$k][$th->ToPrfxNm('id')] . "'>";
            } else {
               $new_node .= "<a href='javascript:void(0)' class='dropdown_head'>";
            }
            $new_node .= $names[$k][$th->ToPrfxNm('name')] . '</a>';
            $new_node .= $next_node;
            $result .= $new_node . '</li>';
         }
         $result .= '</ul>';

         return $result;

      };

      return Array(isset($tree) ? $buildTree($tree, $this) : '', $resName, $resPName);
   }

   public function MakeAdminTree()
   {
      list($tree, $names) = $this->SetTreeParams();
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

   public function MakeSelectTree($forCategory = true)
   {
      list($tree, $names) = $this->SetTreeParams('GetNames');
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
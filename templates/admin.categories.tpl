{extends file='admin.tpl'}
{block name='links' append}
  <script src="/js/jquery.jstree.js"></script>
  <script src="/js/admin.categories.js"></script>
  <link href="/css/admin_categories.css" rel="stylesheet"/>
  <link href="/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" rel="stylesheet"/>
  <script src="/fancybox/jquery.fancybox.js?v=2.1.5"></script>
{/block}
{block name='div.main'}
<section id="categories_edit">
  <div id="category_tree">{$category_tree|default:''}</div>
  <div id="edit-box">
    <div class="edit_radio">
      <p>
        <input type="radio" id="in_add" name="sumbit_type" value="add" checked>
        <label for="in_add">Добавление</label>
      </p>
      <p>
        <input type="radio" id="in_change" name="sumbit_type" value="change" disabled>
        <label for="in_change">Редактирование</label>
      </p>
    </div>
    <form method="post" action="" class="edit-form">
    <table>
      <tr>
        <td>Родительская категория:</td>
        <td>
          <select class="select" name="category_id" id="category_id">
          {$categories_options}
          </select>
        </td>
      </tr>
      <tr>
        <td>Название категории:</td>
        <td><input class="edit_input" type="text" name="category_name" id="category_name"></td>
      </tr>
      <input type="text" name="id" id="id" style="display: none">
      <tr>
        <td></td>
        <td>
          <button type="submit" name="submit" class="button green" value="Insert">Добавить</button>
          <button type="submit" name="submit" class="button red" value="Delete" style="display: none;">Удалить</button>
        </td>
      </tr>
    </table>
    </form>
  </div>
</section>
{/block}
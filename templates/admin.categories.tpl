{extends file='admin.tpl'}
{block name='links' append}
  <script src="/js/jquery.jstree.js"></script>
  <script src="/js/admin.categories.js"></script>
  <link href="/css/admin_categories.css" rel="stylesheet"/>
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
    <form method="post" action="" class="edit-form" id="category_form">
		<label for="category_id">Родительская категория:</label>
		<select class="select" name="category_id" id="category_id">
			{$categories_options}
		</select>
		<label for="category_name">Название категории:</label>
		<input class="edit_input" name="category_name" id="category_name">
		<input name="id" id="id" style="display: none">
		<button type="submit" name="submit" class="button green" value="Insert">Добавить</button>
		<button type="submit" name="submit" class="button red" value="Delete" style="display: none;">Удалить</button>
    </form>
  </div>
</section>
{/block}
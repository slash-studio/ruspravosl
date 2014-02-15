{extends file='admin.tpl'}
{block name='links' append}
  <link href="/css/admin_contests.css" rel="stylesheet"/>
  <script src="/js/jquery.jstree.js"></script>
  <script src="/js/admin.categories.js"></script>
  <link href="/css/admin_categories.css" rel="stylesheet"/>
{/block}
{block name='div.main'}
  <div id="top_block">
    <h1>Конкурсы</h1>
    {if isset($last_contest.contest_status) && !$addCats}
    <h2>Текущий конкурс - {$last_contest.contest_name}</h2>
    <form action="/admin/contests" method="post">
    <input type="hidden" name="contest_id" value="{$last_contest.contest_id}" />
      <button id="save" class="normal" name="delete_contest">Удалить текущий конкурс</button>
    </form>
    <form action="/admin/contests" method="post" id="enable_competitive_form">
      <input type="hidden" name="contest_id" value="{$last_contest.contest_id}" />
      <input type="hidden" name="contest_status" value="{1 - $last_contest.contest_status}" />
      <button id="enable_competitive" class="normal" name="enable_competitive" value="enable_competitive">{if $last_contest.contest_status==1}Закончить{else}Начать{/if} прием работ!</button>
    </form>
    {/if}
    {if $addCats}
      <h2>Добавление категорий в конкурс "{$last_contest.contest_name}"</h2>
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
          <form method="post" action="" class="edit-form" id="category_form" data="{$last_contest.contest_id}">
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
      <form action="/admin/contests" method="post">
        <button id="save" class="normal" name="done_contest">Завершить создание конкурса</button>
      </form>
      </section>
    {elseif !(isset($last_contest.contest_status) && $last_contest.contest_status == 1)}
      <h2>Создать конкурс</h2>
      {if isset($error_txt)}<p class="db_error">{$error_txt}</p>{/if}
      <form action="/admin/contests/new_contest" method="post" id="enable_competitive_form">
        <label for="name">Название:</label>
        <input id="name" name="name" />
        <small class="red">При создании конкурса - текущий конкурс заносится в архив. Будьте внимательны!</small>
        <button id="save" class="normal" name="new_contest">Создать</button>
      </form>
    {/if}
  </div>
{/block}
{extends file='admin.tpl'}
{block name="div.main"}
<div id="top_block">
  <h1>Редактирование Жюри</h1>
  {foreach from=$jury item=judge name=foo}
  <form action="/admin/jury" method="post" class="form_jury">
    <input type="hidden" class="jury_id" name="id" value="{$judge.jury_id}" />
    <label for="jury_head_{$smarty.foreach.foo.index}">Имя:</label>
    <input class="jury_head" name="name" id="jury_head_{$smarty.foreach.foo.index}" value="{$judge.jury_name}" />
    <label for="jury_body_{$smarty.foreach.foo.index}">Текст:</label>
    <textarea class="jury_body" name="info" id="jury_body_{$smarty.foreach.foo.index}" rows="5" cols="70">{$judge.jury_info}</textarea>
    <button class="save_jury" name="mode" value="Update">Сохранить</button><button class="delete_jury" name="mode" value="Delete">Удалить</button>
  </form>
  {/foreach}
  <form action="/admin/jury" method="post" class="form_jury">
    <h2>Добавить жюри</h2>
    <label for="jury_head_new">Имя:</label>
    <input class="jury_head" name="name" id="jury_head_new" value="" />
    <label for="jury_body_new">Текст:</label>
    <textarea class="jury_body" name="info" id="jury_body_new" rows="5" cols="70"></textarea>
    <button class="save_jury" name="mode" value="Insert">Добавить</button>
  </form>
</div>
{/block}
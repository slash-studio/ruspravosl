{extends file='admin.tpl'}
{block name='title' append} - Тексты{/block}
{block name="div.main"}
<div id="top_block">
  <section>
    <h1>Новость на главной странице</h1>
	{if isset($error_txt)}<p class="db_error">{$error_txt}</p>{/if}
    <form action="/admin/texts" method="post" id="text_edit">
      <input name="text_id" type="hidden" value="{$texts[0].texts_id}">
      <label for="text_head">Заголовок:</label>
      <input id="text_head" name="text_head" value="{$texts[0].texts_text_head}" />
      <label for="text_body">Текст:</label>
      <textarea id="text_body" name="text_body" rows="10" cols="100">{$texts[0].texts_text_body}</textarea>
      <button id="save_text" name="save" class="normal" value="Update">Сохранить</button>
    </form>
  </section>
  <section>
    <h1>Текст над регистрацией</h1>
    <form action="/admin/texts" method="post" id="reg_text_edit">
      <input name="text_id" type="hidden" value="{$texts[1].texts_id}">
      <label for="reg_text_body">Текст:</label>
      <textarea id="reg_text_body" name="text_body" rows="10" cols="100">{$texts[1].texts_text_body}</textarea>
      <button id="reg_save_text" class="normal" name="save" value="Update">Сохранить</button>
    </form>
  </section>
</div>
{/block}

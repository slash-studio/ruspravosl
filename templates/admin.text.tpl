{extends file='admin.tpl'}
{block name="div.main"}
<div id="top_block">
  <section>
    <h1>Новость на главной странице</h1>
    <form action="/admin/texts" method="post" id="text_edit">
      <input name="text_id" type="hidden" value="{$texts[0].texts_id}">
      <label for="text_head">Заголовок:</label>
      <input id="text_head" name="text_head" value="{$texts[0].texts_text_head}" />
      <label for="text_body">Текст:</label>
      <textarea id="text_body" name="text_body" rows="10" cols="100">{$texts[0].texts_text_body}</textarea>
      <button id="save_text" name="save" value="Update">Сохранить</button>
    </form>
  </section>
  <section>
    <h1>Текст над регистрацией</h1>
    <form action="/admin/texts" method="post" id="reg_text_edit">
      <input name="text_id" type="hidden" value="{$texts[1].texts_id}">
      <label for="reg_text_body">Текст:</label>
      <textarea id="reg_text_body" name="text_body" rows="10" cols="100">{$texts[1].texts_text_body}</textarea>
      <button id="reg_save_text" name="save" value="Update">Сохранить</button>
    </form>
  </section>
  <form action="/admin/texts" method="post" id="enable_competitive_form">
    <input type="hidden" class="jury_id" name="competitive_status" value="{1 - $competitiveStatus}" />
    <button id="enable_competitive" name="enable_competitive" value="enable_competitive">{if $competitiveStatus==1}Закончить{else}Начать{/if} конкурс!</button>
  </form>
</div>
{/block}

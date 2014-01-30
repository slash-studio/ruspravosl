{extends file='admin.tpl'}
{block name="div.main"}
<div id="top_block">
  <section>
	  <h1>Новость на главной странице</h1>
	  <form action="/admin/main_news" method="post" id="text_edit">
		<label for="text_head">Заголовок:</label>
		<input id="text_head" name="text_head" value="{$mainNews[0].main_news_text_head}" />
		<label for="text_body">Текст:</label>
		<textarea id="text_body" name="text_body" rows="10" cols="100">{$mainNews[0].main_news_text_body}</textarea>
		<button id="save_text" class="normal" name="save" value="Update">Сохранить</button>
	  </form>
  </section>
  <section>
	  <h1>Текст над регистрацией</h1>
	  <form action="/admin/?" method="post" id="reg_text_edit">
		<label for="reg_text_head">Заголовок:</label>
		<input id="reg_text_head" name="text_head" value="" />
		<label for="reg_text_body">Текст:</label>
		<textarea id="reg_text_body" name="text_body" rows="10" cols="100"></textarea>
		<button id="reg_save_text" class="normal" name="save" value="Update">Сохранить</button>
	  </form>
  </section>
</div>
{/block}

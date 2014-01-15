{extends file='admin.tpl'}
{block name="div.main"}
<div id="top_block">
  <h1>Новость на главной странице</h1>
  <form action="/admin/main_news" method="post" id="text_edit">
    <label for="text_head">Заголовок:</label>
    <input id="text_head" name="text_head" value="{$mainNews[0].main_news_text_head}" />
    <label for="text_body">Текст:</label>
    <textarea id="text_body" name="text_body" rows="10" cols="100">{$mainNews[0].main_news_text_body}</textarea>
    <button id="save_text" name="save" value="Update">Сохранить</button>
  </form>
</div>
{/block}

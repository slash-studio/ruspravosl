{extends file='admin.tpl'}
{block name="div.main"}
	<div id="top_block">
		<h1>Новость на главной странице</h1>
		<form action="/includes/save_text.php" method="POST" id="text_edit">
			<label for="text_head">Заголовок:</label>
			<input id="text_head" name="text_head" value="Конкурс начался!" />
			<label for="text_body">Текст:</label>
			<textarea id="text_body" name="text_body" rows="10" cols="100"><p>Конкурс предусматривает два этапа. В ноябре во всех военных округах пройдет первый отборочный тур. Второй тур и заключительный концерт лауреатов конкурса состоятся в Москве в сентябре будущего года. Для каждого военного оркестра обязательным является исполнение Государственного гимна России, а также ряда других произведений - "Славься" М. Глинки, "Развод караулов" В. Павлова, "Красная заря" С. Чернецкого, военных маршей и плац-концертов.</p><button id="start" type="button" onClick="javascript:location.assign('/login')">Принять участие!</button></textarea>
			<button id="save_text">Сохранить</button>
		</form>
	</div>
{/block}

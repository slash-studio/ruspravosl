{extends file='admin.tpl'}
{block name="div.main"}
	<div id="top_block">
		<h1>Новость на главной странице</h1>
		<form action="/includes/edit_jury.php" method="POST" class="form_jury">
			<input type="hidden" class="jury_id" name="jury_id" value="1" />
			<label for="jury_head_1">Имя:</label>
			<input class="jury_head" name="jury_head" id="jury_head_1" value="Кристина Алехина" />
			<label for="jury_body_1">Текст:</label>
			<textarea class="jury_body" name="jury_body" id="jury_body_1" rows="5" cols="70">Декан факультета права. Быть хорошим преподавателем - это искусство, которое достигается сочетанием природных дарований и серьезной работой, в том числе, и обычной работой ремесленника.</textarea>
			<button class="save_jury">Сохранить</button><button class="delete_jury">Удалить</button>
		</form>
		<form action="/includes/edit_jury.php" method="POST" class="form_jury">
			<input type="hidden" class="jury_id" name="jury_id" value="2" />
			<label for="jury_head_2">Имя:</label>
			<input class="jury_head" name="jury_head" id="jury_head_2" value="Альбина Ладыжко" />
			<label for="jury_body_2">Текст:</label>
			<textarea class="jury_body" name="jury_body" id="jury_body_2" rows="5" cols="70">Декан факультета права. Быть хорошим преподавателем - это искусство, которое достигается сочетанием природных дарований и серьезной работой, в том числе, и обычной работой ремесленника.</textarea>
			<button class="save_jury">Сохранить</button><button class="delete_jury">Удалить</button>
		</form>
		<form action="/includes/edit_jury.php" method="POST" class="form_jury">
			<input type="hidden" class="jury_id" name="jury_id" value="3" />
			<label for="jury_head_3">Имя:</label>
			<input class="jury_head" name="jury_head" id="jury_head_3" value="Марк Тертышный" />
			<label for="jury_body_3">Текст:</label>
			<textarea class="jury_body" name="jury_body" id="jury_body_3" rows="5" cols="70">Декан факультета права. Быть хорошим преподавателем - это искусство, которое достигается сочетанием природных дарований и серьезной работой, в том числе, и обычной работой ремесленника.</textarea>
			<button class="save_jury">Сохранить</button><button class="delete_jury">Удалить</button>
		</form>
		<form action="/includes/new_jury.php" method="POST" class="form_jury">
			<h2>Добавить жюри</h2>
			<input type="hidden" class="jury_id" name="jury_id" value="" />
			<label for="jury_head_new">Имя:</label>
			<input class="jury_head" name="jury_head" id="jury_head_new" value="" />
			<label for="jury_body_new">Текст:</label>
			<textarea class="jury_body" name="jury_body" id="jury_body_new" rows="5" cols="70"></textarea>
			<button class="save_jury">Добавить</button>
		</form>
	</div>
{/block}

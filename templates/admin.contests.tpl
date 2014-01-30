{extends file='admin.tpl'}
{block name='links' append}
  <link href="/css/admin_contests.css" rel="stylesheet"/>
{/block}
{block name='div.main'}
	<div id="top_block">
		<h1>Конкурсы</h1>
		<h2>Текущий конкурс</h2>
		<form action="/admin/contests" method="post" id="enable_competitive_form">
			<input type="hidden" name="competitive_status" value="{1 - $competitiveStatus}" />
			<button id="enable_competitive" class="normal" name="enable_competitive" value="enable_competitive">{if $competitiveStatus==1}Закончить{else}Начать{/if} прием работ!</button>
		</form>
		<h2>Создать конкурс</h2>
		<form action="/admin/contests" method="post" id="enable_competitive_form">
			<label for="name">Название:</label>
			<input id="name" name="name" />
			<!-- ГОД -->
			<!-- Категории -->
			<small class="red">При создании конкурса - текущий конкурс заносится в архив. Удалить конкурс нельзя. Будьте внимательны!</small>
			<button id="save" class="normal">Создать</button>
		</form>
	</div>
{/block}
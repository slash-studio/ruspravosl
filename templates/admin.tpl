{extends file='html.tpl'}
{block name='links' append}
    <link href="/css/admin.css" rel="stylesheet" />
	<link href="/css/main.css" rel="stylesheet" />
{/block}
{block name='page'}
	<div id="wrap">
		<header>
			<nav>
				<ul>
					<li><a href="/admin/main_news">Тексты</a></li>
					<li><a href="/admin/jury">Редактирование жюри</a></li>
					<li><a href="/admin/categories">Редактирование категорий</a></li>
					<li><a href="/admin/photos">Работы с конкурса</a></li>
				</ul>
			</nav>
		</header>
		{block name='div.main'}{/block}
	</div>
{/block}

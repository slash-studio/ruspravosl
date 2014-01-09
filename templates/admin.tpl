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
					<li><a href="/admin/admin.text.php">Новость на главной странице</a></li>
					<li><a href="/admin/admin.jury.php">Редактирование жюри</a></li>
					<li><a href="/admin/admin.categories.php">Редактирование категорий</a></li>
					<li><a href="/admin/admin.photos.php">Работы с конкурса</a></li>
				</ul>
			</nav>
		</header>
		{block name='div.main'}{/block}
	</div>
{/block}

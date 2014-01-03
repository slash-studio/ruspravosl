{extends file='page.tpl'}
{block name='links' append}
	<link href="/css/header.css" rel="stylesheet" />
	<link href="/css/footer.css" rel="stylesheet" />
	<link href="/css/login_reg.css" rel="stylesheet" />
{/block}
{block name='div.main'}
	{include file="header.tpl"}
	<div id="top_block">
		<form action="/includes/check.php" method="POST">
			<h1>Вход</h1>
			<div>
				<div><label for="login">Логин:</label><input id="login" name="login" /></div>
				<div><label for="pass">Пароль:</label><input id="pass" name="pass" type="password" /></div>
				<button id="enter">Войти</button><button id="reg">Зарегистрироваться</button>
			</div>
		</form>
	</div>
{/block}

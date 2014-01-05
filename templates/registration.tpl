{extends file='page.tpl'}
{block name='links' append}
	<link href="/css/header.css" rel="stylesheet" />
	<link href="/css/footer.css" rel="stylesheet" />
	<link href="/css/login_reg.css" rel="stylesheet" />
{/block}
{block name='div.main'}
	{include file="header.tpl"}
	<div id="top_block">
		<form action="/includes/reg.php" method="POST">
			<h1>Регистрация</h1>
			<div>
				<div><label for="login">Логин:</label><input id="login" name="login" /></div>
				<div><label for="pass">Пароль:</label><input id="pass" name="pass" type="password" /></div>
				<div><label for="pass_rep">Повторите пароль:</label><input id="pass_rep" name="pass_rep" type="password" /></div>
				<div><label for="name">Имя:</label><input id="name" name="name" /></div>
				<div><label for="surname">Фамилия:</label><input id="surname" name="surname" /></div>
				<div><label for="adress">Адрес:</label><input id="adress" name="adress" /></div>
				<div><label for="school">Школа:</label><input id="school" name="school" /></div>
				<button id="reg">Зарегистрироваться</button>
			</div>
		</form>
	</div>
{/block}

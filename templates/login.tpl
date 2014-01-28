{extends file='page.tpl'}
{block name='links' append}
	<link href="/css/header.css" rel="stylesheet" />
	<link href="/css/footer.css" rel="stylesheet" />
	<link href="/css/login_reg.css" rel="stylesheet" />
{/block}
{block name='div.main'}
	{include file="header.tpl"}
	<div id="top_block">
		<form action="/login" method="post">
			<h1>Вход</h1>
			<p class="error">{$errorMsg|default:''}</p>
			<div>
				<div><label for="login">Логин:</label><input id="login" name="login" value="{$login}"/></div>
				<div><label for="pass">Пароль:</label><input id="pass" name="pass" type="password" /></div>
				<button id="enter" name="submit" value="submit">Войти</button>
				{if $competitiveStatus}<button id="reg" type="button" onClick="javascript:location.assign('/registration')">Зарегистрироваться</button>{/if}
			</div>
		</form>
	</div>
{/block}

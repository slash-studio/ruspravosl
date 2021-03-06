{extends file='page.tpl'}
{block name='links' append}
  <link href="/css/header.css" rel="stylesheet" />
  <link href="/css/footer.css" rel="stylesheet" />
  <link href="/css/reg.css" rel="stylesheet" />
  <meta http-equiv="Refresh" content="4; URL=/profile">
{/block}
{block name='div.main'}
  {include file="header.tpl"}
  <div id="top_block">
    <form action="/login" method="post">
      <h1 id="success_reg">Регистрация успешно завершена!<br /><br />Через несколько секунд вы автоматически перейдете на страницу своего аккаунта. Если этого не произошло, вы можете пройти по <a href="/includes/account.php">ссылке в свой аккаунт</a>.</h1>
    </form>
  </div>
{/block}

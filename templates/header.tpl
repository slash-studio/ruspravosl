<header>
  <img src="/images/header.jpg" />
  <nav class="left">
    <ul>
      <li><a href="/">Главная</a></li>
      <li><a href="/all_works">Все работы</a></li>
      <li><a href="/">Положение</a></li>
      <li><a href="/jury">Жюри</a></li>
      <li><a href="/archive">Архив</a></li>
      {if isset($competitiveStatus)}<li><a href="/winners">Победители</a></li>{/if}
    </ul>
  </nav>
  <nav class="right">
    <ul>
    {if $isLogin|default:false}
      <li><a href="/profile">Мой аккаунт</a></li>
      <li id="logout"><a href="/registration">Выход</a></li>
    {else}
      {if isset($competitiveStatus)}<li><a href="/login">Войти</a></li>{/if}
      {if $competitiveStatus}<li><a href="/registration">Регистрация</a></li>{/if}
    {/if}
    </ul>
  </nav>
</header>
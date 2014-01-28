<header>
  <img src="/images/header.jpg" />
  <nav class="left">
    <ul>
    <li>
      <a href="/">Главная</a>
    </li>
    <li>
      <a href="/all_works">Все работы</a>
    </li>
    <li>
      <a href="/">Положение</a>
    </li>
    <li>
      <a href="/jury">Жюри</a>
    </li>
	<li>
      <a href="/archiv">Архив</a>
    </li>
	<li>
      <a href="/winers">Победители</a>
    </li>
    </ul>
  </nav>
  <nav class="right">
    <ul>
    {if $isLogin|default:false}
      <li>
        <a href="/profile">Мой аккаунт</a>
      </li>
      <li id="logout">
        <a href="/registration">Выход</a>
      </li>
    {else}
      <li>
        <a href="/login">Войти</a>
      </li>
      {if $competitiveStatus}<li>
        <a href="/registration">Регистрация</a>
      </li>{/if}
    {/if}
    </ul>
  </nav>
</header>
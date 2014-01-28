{extends file='page.tpl'}
{block name='links' append}
  <link href="/css/header.css" rel="stylesheet" />
  <link href="/css/footer.css" rel="stylesheet" />
  <link href="/css/reg.css" rel="stylesheet" />
  <script src="/js/jquery.powerful-placeholder.min.js"></script>
  <script>
  {literal}
    $(function(){
      $.Placeholder.init({color: "#aaa"});
    });
  {/literal}
  </script>
{/block}
{block name='div.main'}
  {include file="header.tpl"}
  <div id="top_block">
    <form action="/registration" method="POST" id="registration_form">
      <h1>Регистрация</h1>
	  <p id="reg_text">
	  Для участия в конкурсе сфотографируйте свои работы либо сделайте скан-копии рисунков. Заполните поля регистрационной формы. Не забудьте указать телефон родителей или учителя, чтобы организаторы конкурса могли связаться с вашими представителями. Получите собственный аккаунт. Это ваша страничка в конкурсе, где вы можете выложить фотографии своих работ. Не стоит ждать, что жюри примет решение на следующий день. Жюри будет работать до 18 апреля 2014 года. До этого срока под фотографией своей работой вы увидите принята она к следующему этапу конкурса или отклонена. Официально результаты будут объявлены 24 мая 2014 года. 
	  </p>
      <p class="error">{$errorMsg|default:''}</p>
      <div>
        <div>
          <label for="login">Логин:</label>
		  <small>Только латинские буквы и цифры, минимум 5 символов.</small>
          <input id="login" name="login" value="{if isset($regInfo)}{$regInfo.login}{/if}" />
        </div>
        <div><label for="pass">Пароль:</label><input id="pass" name="pass" type="password" /></div>
        <div><label for="pass_rep">Повторите пароль:</label><input id="pass_rep" name="pass_rep" type="password" /></div>
        <div>
          <label for="name">Имя:</label>
          <input id="name" name="name" placeholder="Например: Илья" value="{if isset($regInfo)}{$regInfo.name}{/if}" />
        </div>
        <div>
          <label for="surname">Фамилия:</label>
          <input id="surname" name="surname" placeholder="Например: Иванов" value="{if isset($regInfo)}{$regInfo.surname}{/if}" />
        </div>
		<div>
          <label for="age">Возраст:</label>
          <input id="age" name="age" placeholder="Например: 15" value="{if isset($regInfo)}{$regInfo.age}{/if}" />
        </div>
        <div>
          <label for="address">Адрес:</label>
		  <small>Например: г. Владивосток, ул Светланская 101, к.6.</small>
          <input id="address" name="address" value="{if isset($regInfo)}{$regInfo.address}{/if}"/>
        </div>
		<div>
          <label for="phone">Телефон:</label>
		  <small>Телефон для связи с родителями или официальными представителями.</small>
          <input id="phone" name="phone" placeholder="Например: 89147123456" value=""/>
        </div>
		<div>
          <label for="teacher">Ваш педагог:</label>
		  <small>Фамилия, имя и отчество педагога.</small>
          <input id="teacher" name="teacher" value=""/>
        </div>
        <div>
          <label for="school">Место учебы:</label>
		  <small>Полное наименование учебного заведения и его адрес.</small>
          <input id="school" name="school" value="{if isset($regInfo)}{$regInfo.school}{/if}"/>
        </div>
        <div><button id="reg" name="submit" value="submit">Зарегистрироваться</button></div>
      </div>
    </form>
  </div>
{/block}

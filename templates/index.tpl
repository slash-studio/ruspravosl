{extends file='page.tpl'}
{block name='links' append}
  <link href="/css/header.css" rel="stylesheet" />
  <link href="/css/footer.css" rel="stylesheet" />
  <link href="/css/index.css" rel="stylesheet" />
{/block}
{block name='div.main'}
  {include file="header.tpl"}
  <div id="top_block">
    <section id="news">
      <img src="/images/news1.jpg" />
      <div>
        <h1>Конкурс начался!</h1>
        <p>
        Конкурс предусматривает два этапа. В ноябре во всех военных округах пройдет первый отборочный тур. Второй тур и заключительный концерт лауреатов конкурса состоятся в Москве в сентябре будущего года. Для каждого военного оркестра обязательным является исполнение Государственного гимна России, а также ряда других произведений - "Славься" М. Глинки, "Развод караулов" В. Павлова, "Красная заря" С. Чернецкого, военных маршей и плац-концертов.
        </p>
        <button id="start">Принять участие!</button>
      </div>
    </section>
    <section id="pop_works">
      <h1>Популярные работы</h1>
      <ul>
        <li>
          <a href="#" class="block"><img src="/images/min1.jpg" /></a>
          <a href="#" class="user">Василий Янкин (9 лет)</a>
        </li>
        <li>
          <a href="#" class="block"><img src="/images/min2.jpg" /></a>
          <a href="#" class="user">Марк Тертышный (11 лет)</a>
        </li>
        <li>
          <a href="#" class="block"><img src="/images/min3.jpg" /></a>
          <a href="#" class="user">Александраааа Лосницкий (12 лет)</a>
        </li>
        <li>
          <a href="#" class="block"><img src="/images/min4.jpg" /></a>
          <a href="#" class="user">Карина Штоль (18 лет)</a>
        </li>
      </ul>
    </section>
  </div>
{/block}

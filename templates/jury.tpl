{extends file='page.tpl'}
{block name='title' append} - Жюри{/block}
{block name='links' append}
  <link href="/css/header.css" rel="stylesheet" />
  <link href="/css/footer.css" rel="stylesheet" />
  <link href="/css/jury.css" rel="stylesheet" />
{/block}
{block name='div.main'}
{include file="header.tpl"}
<div id="top_block">
  <h1>Жюри</h1>
  <ul>
  {foreach from=$jury item=judge}
    <li>
    <h2>{$judge.jury_name}</h2>
    <p>{$judge.jury_info}</p>
    </li>
  {/foreach}
  </ul>
</div>
{/block}

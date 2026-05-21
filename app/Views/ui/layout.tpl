<!DOCTYPE html>
<html>
<head>
    <title>{$pageTitle|default:"Blog"}</title>

    <link rel="stylesheet" href="/assets/css/common.css">
    <link rel="stylesheet" href="/assets/css/navbar.css">
    <link rel="stylesheet" href="/assets/css/backBtn.css">
    <link rel="stylesheet" href="/assets/css/footer.css">

    {if isset($styles)}
	{foreach $styles as $style}
            <link rel="stylesheet" href="/assets/css/{$style}.css">
	{/foreach}
    {/if}
</head>
<body>

    {include file="ui/navbar.tpl"}
    
    {if $smarty.server.REQUEST_URI != "/"}
	{include file="ui/back-btn.tpl"}
    {/if}

    {block name="content"}{/block}
</body>

{include file="ui/footer.tpl"}

</html>

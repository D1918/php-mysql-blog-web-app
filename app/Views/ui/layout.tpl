<!DOCTYPE html>
<html>
    <head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
        <title>{$pageTitle|default:"Blog"}</title>
    
        <link rel="stylesheet" href="/assets/css/common.css">
        <link rel="stylesheet" href="/assets/css/navbar.css">
        <link rel="stylesheet" href="/assets/css/footer.css">
    
        {if isset($styles)}
    	{foreach $styles as $style}
                <link rel="stylesheet" href="/assets/css/{$style}.css">
    	{/foreach}
        {/if}
    </head>
    
    <body>
        {include file="ui/navbar.tpl"}
    
        {block name="content"}{/block}
    
        {include file="ui/footer.tpl"}
    </body>
</html>

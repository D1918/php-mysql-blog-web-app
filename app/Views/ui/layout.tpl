<!DOCTYPE html>
<html>
<head>
    <title>{$pageTitle|default:"Blog"}</title>

    <link rel="stylesheet" href="/assets/css/common.css">

    {if isset($styles)}
	{foreach $styles as $style}
            <link rel="stylesheet" href="/assets/css/{$style}.css">
	{/foreach}
    {/if}
</head>
<body>
    {block name="content"}{/block}
</body>
</html>

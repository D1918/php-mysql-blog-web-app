{extends file="ui/layout/index.tpl"}

{block name="content"}    
    <div class="container">
        <h1>{$category.name}</h1>
        
        <p>{$category.description}</p>
    
        <div class="sort">
            <a href="?sort=date" {if $sort == 'date'}class="btn active"{/if}>Sort by date</a>
            <a href="?sort=views" {if $sort == 'views'}class="btn active"{/if}>Sort by views</a>
        </div>
    
        <div class="articles-grid">
	    {foreach $articles as $article}
		{include file="ui/components/article-card.tpl"}
	    {/foreach}
        </div>
    
        {if $pagination.pages > 1}
            <div class="pagination">
    	    
                {for $i = 1 to $pagination.pages}
                    <a href="?page={$i}&sort={$sort}"
                       class="{if $i == $pagination.page}active{/if}">
                        {$i}
                    </a>
                {/for}
            </div>
        {/if}
    </div>
{/block}

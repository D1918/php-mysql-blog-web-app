{extends file="ui/layout/index.tpl"}

{block name="content"}
    <div class="container">
        <div class="article-page">
            <article>	    
                {if $article.image}
                    <div class="article-image">
                        <img src="{$article.image}" alt="{$article.title}">
                    </div>
                {/if}
    	    
                <div class="article-body">
                    <h1>{$article.title}</h1>
		    
                    <div class="meta">
			<p>{$article.views} views, {$article.created_at|date_format:"%B %e %Y"}</p>
                    </div>
    
                    <div class="article-content">
                        {$article.content}
                    </div>
                </div>
            </article>
    
            <hr style="margin:20px 0;">
    
            <h2>Similar articles</h2>
    
            <div class="articles-grid">
		{foreach $similar as $article}
		    {include file="ui/components/article-card.tpl"}
		{/foreach}
            </div>
        </div>
    </div>
{/block}

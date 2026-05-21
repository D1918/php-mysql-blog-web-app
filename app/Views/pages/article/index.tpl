{extends file="ui/layout.tpl"}

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
                    <article class="article-card">
                        <a class="article-link" href="/article/{$article.slug}">
    
                            {if $article.image}
                                <div class="article-image">
                                    <img src="{$article.image}" alt="{$article.title}">
                                </div>
                            {/if}
    
                            <div class="article-body">
    
                                <h3>{$article.title}</h3>
        
                                <p>{$article.excerpt|truncate:120}</p>
    			    <p>{$article.created_at|date_format:"%B %e %Y"}</p>
    
                            <div class="meta">
                                {$article.views} views
                            </div>
                            </div>
                        </a>
                    </article>
                {/foreach}
            </div>
        </div>
    </div>
{/block}

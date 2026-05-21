<article class="article-card">
    <a class="article-link" href="/article/{$article.slug}">
        {if $article.image}
            <div class="article-image">
                <img src="{$article.image}" alt="{$article.title}">
            </div>
        {/if}

        <div class="article-body">
            <h3>{$article.title}</h3>

            {if isset($article.created_at)}
                <p>{$article.created_at|date_format:"%B %e %Y"}</p>
            {/if}

            {if isset($article.excerpt)}
                <p>{$article.excerpt|truncate:120}</p>
            {/if}

            {if isset($article.views)}
                <div class="meta">
                    {$article.views} views
                </div>
            {/if}
        </div>
    </a>
</article>

{extends file="../../ui/layout.tpl"}

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

                        <div class="meta">
                            {$article.views} views
                        </div>

                    </div>

                </a>
            </article>
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

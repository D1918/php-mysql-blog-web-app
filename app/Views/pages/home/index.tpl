{extends file="../../ui/layout.tpl"}

{block name="content"}
    <div class="container">

	<h1>Geeks Rule!</h1>

        {foreach $sections as $section}
            <section class="category-section">

                <div class="category-header">
                    <div>
                        <h2>{$section.category.name}</h2>
                        <p>{$section.category.description}</p>
                    </div>

                    <a class="btn" href="/category/{$section.category.slug}">
                        All articles
                    </a>
                </div>

                <div class="articles-grid">

                    {foreach $section.articles as $article}
                        <article class="article-card">
                            <a class="article-link" href="/article/{$article.slug}">

                                {if $article.image}
                                    <div class="article-image">
                                        <img src="{$article.image}" alt="{$article.title}">
                                    </div>
                                {/if}

                                <div class="article-body">
				    <p>{$article.created_at|date_format:"%B %e %Y"}</p>
				    
                                    <h3>
                                        {$article.title}
                                    </h3>

                                    <p>{$article.excerpt|truncate:120}</p>

                                    <div class="meta">
                                        {$article.views} views
                                    </div>
                                </div>

                            </a>

                        </article>
                    {/foreach}

                </div>

            </section>
        {/foreach}

    </div>
{/block}

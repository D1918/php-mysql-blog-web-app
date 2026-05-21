{extends file="ui/layout/index.tpl"}

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
			{include file="ui/components/article-card.tpl"}
		    {/foreach}
                </div>
            </section>
        {/foreach}
    </div>
{/block}

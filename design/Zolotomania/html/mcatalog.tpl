{if !empty($categories)}
<!-- incl. mcatalog -->
<div class="box" id="catalog_menu">
	<div class="box-heading">Каталог</div>
	<div class="box-content">
		<div class="box-category" role="navigation">
			{function name=categories_tree level=1}
			<ul {if $level>1}class="included_cat"{/if}>
				{foreach $categories as $c}
					{if $c->visible}
					<li>
						<a title="{$c->name|escape}" href="catalog/{$c->url}" data-category="{$c->id}" {if !empty($category->id) && in_array($category->id,$c->children)}class="filter-active"{/if}>{$c->name|escape}{if !empty($c->subcategories)}<span>+</span>{/if}</a>
						{if !empty($c->subcategories)}
							{categories_tree categories=$c->subcategories level=$level+1}
						{/if}
					</li>
					{/if}
				{/foreach}
			</ul>
			{/function}
			{categories_tree categories=$categories}
		</div>
	</div>
</div>
<!-- incl. mcatalog @ -->
{/if}

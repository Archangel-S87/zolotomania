{if isset($smarty.server.HTTP_X_REQUESTED_WITH) && $smarty.server.HTTP_X_REQUESTED_WITH|strtolower == 'xmlhttprequest'}
    {$wrapper = '' scope=root}
	<input class="refresh_title" type="hidden" value="
		{if !empty($metadata_page)}
			{if $metadata_page->meta_title}
				{$metadata_page->meta_title|escape}{if $current_page_num>1} - страница {$current_page_num}{/if}
			{else}
				{$meta_title|escape}{if $current_page_num>1} - страница {$current_page_num}{/if}
			{/if}
		{else}
			{$meta_title|escape}{if $current_page_num>1} - страница {$current_page_num}{/if}
		{/if}
	" />
{/if}

{if !empty($metadata_page)}
	{$canonical="{$smarty.server.REQUEST_URI}" scope=root}
{elseif !empty($filter_features) && $settings->filtercan == 1}
	{$canonical="{$smarty.server.REQUEST_URI}" scope=root}
{elseif !empty($filter_features) && $settings->filtercan == 0}
	{$canonical="/catalog/{$category->url}" scope=root}
{elseif !empty($category) && !empty($brand)}
	{$canonical="/catalog/{$category->url}/{$brand->url}" scope=root}
{elseif !empty($category)}
	{$canonical="/catalog/{$category->url}" scope=root}
{elseif !empty($brand)}
	{$canonical="/brands/{$brand->url}" scope=root}
{elseif !empty($keyword)}
	{$canonical="/products?keyword={$keyword|escape}" scope=root}
{else}
	{$canonical="/products" scope=root}
{/if}

{if $settings->filtercan == 1 && (!empty($filter_features) || !empty($smarty.get.b))}
	{if !empty($meta_title)}{$mt = $meta_title|escape}{/if}
	
	{if !empty($category->name) && !empty($brand->name)}
    	{$ht = $category->name|escape|cat:' | '|cat:$brand->name|escape}
    {elseif !empty($brand->name)}
		{$ht = $brand->name|escape}
	{elseif !empty($category->name)}
		{$ht = $category->name|escape}
	{/if}
	
	{$seo_description = $meta_title|cat:$settings->seo_description|cat:" ★ "|cat:$settings->site_name}
	{if !empty($meta_description)}{$md = $meta_description|escape}{elseif !empty($seo_description)}{$md = $seo_description|escape}{/if}
	
	{if !empty($smarty.get.b) && !empty($category->brands)}
    	{foreach name=brands item=b from=$category->brands}
			{if $b->id|in_array:$smarty.get.b}
				{$mt = $mt|cat:' | '|cat:$b->name|escape}
				{$md = $md|cat:' ★ '|cat:$b->name|escape}
				{$ht = $ht|cat:' | '|cat:$b->name|escape}
			{/if}
		{/foreach}
	{/if}
	
	{if !empty($smarty.get.v) && !empty($features_variants)}
    	{foreach $features_variants as $o}
			{if $o|in_array:$smarty.get.v}
				{$mt = $mt|cat:' | '|cat:$o|escape}
				{$md = $md|cat:' ★ '|cat:$o|escape}
				{$ht = $ht|cat:' | '|cat:$o|escape}
			{/if}
		{/foreach}
	{/if}
	{if !empty($smarty.get.v1) && !empty($features_variants1)}
    	{foreach $features_variants1 as $o}
			{if $o|in_array:$smarty.get.v1}
				{$mt = $mt|cat:' | '|cat:$o|escape}
				{$md = $md|cat:' ★ '|cat:$o|escape}
				{$ht = $ht|cat:' | '|cat:$o|escape}
			{/if}
		{/foreach}
	{/if}
	{if !empty($smarty.get.v2) && !empty($features_variants2)}
    	{foreach $features_variants2 as $o}
			{if $o|in_array:$smarty.get.v2}
				{$mt = $mt|cat:' | '|cat:$o|escape}
				{$md = $md|cat:' ★ '|cat:$o|escape}
				{$ht = $ht|cat:' | '|cat:$o|escape}
			{/if}
		{/foreach}
	{/if}
    
    {if !empty($filter_features) && !empty($features)}
		{foreach $features as $f}
			{foreach $f->options as $o}
				{if !empty($filter_features.{$f->id}) && in_array($o->value,$filter_features.{$f->id})}                        
					{$mt = $mt|cat:' | '|cat:$f->name|cat:' - '|cat:$o->value}
					{$md = $md|cat:' ★ '|cat:$f->name|cat:' - '|cat:$o->value}
					{$ht = $ht|cat:' | '|cat:$f->name|cat:' - '|cat:$o->value}
				{/if}       
			{/foreach}
		{/foreach}
    {/if}
	
	{if !empty($mt)}
    	{$meta_title = $mt scope=root}
    {/if}	
    {if !empty($ht)}
    	{$page_name = $ht scope=root}
    {/if}
	{if !empty($md)}
		{$meta_description = $md scope=root}
	{/if}
{/if}

<input class="curr_page" type="hidden" data-url="{url page=$current_page_num}" value="{$current_page_num}" />
<input class="refresh_curr_page" type="hidden" data-url="{url page=$current_page_num}" value="{$current_page_num}" />
{if $current_page_num<$total_pages_num}<input class="refresh_next_page" type="hidden" data-url="{url page=$current_page_num+1}" value="{$current_page_num+1}" />{/if}
{if $current_page_num==2}<input class="refresh_prev_page" type="hidden" data-url="{url page=null}" value="{$current_page_num-1}" />{/if}
{if $current_page_num>2}<input class="refresh_prev_page" type="hidden" data-url="{url page=$current_page_num-1}" value="{$current_page_num-1}" />{/if}
<input class="total_pages" type="hidden" value="{$total_pages_num}" />

{* {include file='cfeatures.tpl'} *}

{if !empty($metadata_page->description)}		
	<div class="page-pg categoryintro" style="margin-bottom:16px;"><div class="top cutouter" style="max-height:{$settings->cutmob|escape}px;"><div class="disappear" style="display:none;"></div><div class="cutinner"><!--desc-->{$metadata_page->description}<!--/desc--></div></div><div class="top cutmore" style="display:none;">Развернуть...</div></div>	
{elseif !empty($page->body)}
	<div class="page-pg categoryintro" style="margin-bottom:16px;"><div class="top cutouter" style="max-height:{$settings->cutmob|escape}px;"><div class="disappear" style="display:none;"></div><div class="cutinner"><!--desc-->{$page->body}<!--/desc--></div></div><div class="top cutmore" style="display:none;">Развернуть...</div></div>
{else}
	{if $current_page_num==1}
		<div class="page-pg categoryintro" style="{if !empty($brand->description) || !empty($category->description)}margin-bottom:16px;{else}margin:0 15px;{/if}"><div class="top cutouter" style="max-height:{$settings->cutmob|escape}px;"><div class="disappear" style="display:none;"></div><div class="cutinner"><!--desc-->{if !empty($brand->description)}{$brand->description}{elseif !empty($category->description)}{$category->description}{/if}<!--/desc--></div></div><div class="top cutmore" style="display:none;">Развернуть...</div></div>
	{/if}
{/if}

{* subcat start *}
{if !empty($category->subcategories)}
	<ul class="category_products separator">
		{foreach name=cats from=$category->subcategories item=c}
		{if $c->visible}
		<li class="product" onClick="window.location='catalog/{$c->url}'">
			
			<div class="product_info">
				<h3>{$c->name|escape}</h3>
			</div>
			<div class="image">
				{if $c->image}
					<img loading="lazy" alt="{$c->name|escape}" title="{$c->name|escape}" src="{$config->categories_images_dir}{$c->image}" />
				{else}
					<svg class="nophoto"><use xlink:href='#folder' /></svg>
				{/if}
			</div>
		</li>
		{/if}
		{/foreach}
	</ul>
	{* subcat end *}
{else}
	{if !empty($products)}
		<div class="ajax_pagination">
			{*{include file='pagination.tpl'}*}
		
			{if $current_page_num >= 2}
				<div class="infinite_prev" style="display:none;">
					<div class="trigger_prev infinite_button">Загрузить пред. страницу</div>
				</div>
			{/if}

			<ul id="start" class="tiny_products infinite_load">

				{$numdashed=0}
				{foreach $products as $product}

				<li class="product {if !empty($settings->show_cart_wishcomp)}visible_button{/if}">
					<div class="image qwbox" onclick="window.location='products/{$product->url}'">
						{if !empty($product->image)}
							<img loading="lazy" alt="{$product->name|escape}" title="{$product->name|escape}" class="lazy" src="{$product->image->filename|resize:300:300}" />
						{else}
							<svg class="nophoto"><use xlink:href='#no_photo' /></svg>
						{/if}
					</div>

					<div class="product_info separator">
						<h3><a href="products/{$product->url}">{$product->name|escape}</a></h3>

				
						{if !empty($product->variants) && $product->variants|count > 0}
							<form class="variants" action="/cart">
							{if $product->vproperties}
								{$cntname1 = 0}	
								<span class="pricelist" style="display:none;">
									{foreach $product->variants as $v}
										<span class="c{$v->id}" v_unit="{if $v->unit}{$v->unit}{else}{$settings->units}{/if}">{$v->price|convert}</span>
										{if $v->name1}{$cntname1 = 1}{/if}
									{/foreach}
								</span>
				
								{$cntname2 = 0}
								<span class="pricelist2" style="display:none;">
									{foreach $product->variants as $v}
										{if $v->compare_price > 0}<span class="c{$v->id}">{$v->compare_price|convert}</span>{/if}
										{if $v->name2}{$cntname2 = 1}{/if}
									{/foreach}
								</span>
						
								<input id="vhidden" name="variant" value="" type="hidden"  />
						
								<div style="display: none; margin-bottom: 5px; height: 20px;">
						
									<select class="p0"{if $cntname1 == 0} style="display:none;"{/if}>
										{foreach $product->vproperties[0] as $pname => $pclass}
											<option value="{$pclass}" class="{$pclass}">{$pname}</option>
										{/foreach}
									</select>
				
									<select class="p1"{if $cntname2 == 0} style="display:none;"{/if}>
												{foreach $product->vproperties[1] as $pname => $pclass}
										<span><option value="{$pclass}" class="{$pclass}">{$pname}</option></span>
												{/foreach}
									</select>
						
								</div>
								<div class="pricecolor">
								{if !empty($settings->show_cart_wishcomp)}
									<span class="amount_wrap" style="display:none;"><input type="number" min="1" size="2" name="amount" value="1">&nbsp;x&nbsp;</span>
								{/if}
								<span ID="priceold" class="compare_price"></span> <span ID="price" class="price"></span> <span class="currency">{$currency->sign|escape}{if $settings->b9manage}/<span class="unit">{if $product->variant->unit}{$product->variant->unit}{else}{$settings->units}{/if}</span>{/if}</span>
								</div>
				
							{else}
								{if $product->variants|count==1  && !$product->variant->name}
									<span style="display: none; height: 20px;"></span>
								{/if}

								<select class="b1c_option" name="variant" style="display:none;"{if $product->variants|count==1  && !$product->variant->name}style='display:none;'{/if}>
									{foreach $product->variants as $v}
										<option value="{$v->id}" v_unit="{if $v->unit}{$v->unit}{else}{$settings->units}{/if}" {if $v->compare_price > 0}compare_price="{$v->compare_price|convert}"{/if} price="{$v->price|convert}" click="{$v->name}">
											{$v->name}
										</option>
									{/foreach}
								</select>
											
								<div class="price">
									{if !empty($settings->show_cart_wishcomp)}
									<span class="amount_wrap" style="display:none;">
										<input size="2" name="amount" min="1" type="number" value="1">&nbsp;x&nbsp;
									</span>
									{/if}
									{if $product->variant->compare_price > 0}
										<span class="compare_price">{$product->variant->compare_price|convert}</span>
									{/if}
									<span class="price">{$product->variant->price|convert}</span>
									<span class="currency">{$currency->sign|escape}{if $settings->b9manage}/<span class="unit">{if $product->variant->unit}{$product->variant->unit}{else}{$settings->units}{/if}</span>{/if}</span>
								</div>
							{/if}
								{if !empty($settings->show_cart_wishcomp)}
									<div class="sub_wishcomp_wrap" style="display:none;">
										<input type="submit" class="buttonred" value="в корзину" data-result-text="добавлено"/>
										{include file='wishcomp.tpl'}
									</div>
								{/if}
							</form>
						{else}
								<div style="display: table; margin-top: 15px; margin-bottom: 15px;">Нет в наличии</div>
								{if !empty($settings->show_cart_wishcomp)}{include file='wishcomp.tpl'}{/if}
							</form>
						{/if}

					</div>
			
				</li>

				{/foreach}
				
			</ul>

			{if $total_pages_num >1}
				<div class="infinite_pages infinite_button" style="display:none;">
					<div>Стр. {$current_page_num} из {$total_pages_num}</div>
				</div>
				<div class="infinite_trigger"></div>
			{/if}
			{*<div class="paginationwrapper">{include file='pagination.tpl'}</div>*}	

		</div>
		<script>
			function clicker(that) {
				var pick = that.options[that.selectedIndex].value;
				location.href = pick;
			};
		</script>

	{else}
		<div class="page-pg"><p>Товары не найдены</p></div>
	{/if}	
{/if}


{* Категории в бренде *}
{if !empty($brand) && !empty($brand_cat) && $brand_cat|count > 1 && $current_page_num && $current_page_num == 1}
	<div class="page-pg brand_cat">
		<div class="brand_disc">Категории:</div>
		<a class="brand_item {if ($smarty.server.REQUEST_URI|strstr:'brands')}selected{/if}" href="brands/{$brand->url}">Все категории</a>
		{foreach $brand_cat as $bc}
		<a class="brand_item {if !empty($category->url) && $category->url == $bc->url}selected{/if}" href="catalog/{$bc->url}/{$brand->url}">{$bc->name}</a>
		{/foreach}
	</div>
{/if}



{if $current_page_num==1}
	<div class="page-pg categoryintro">
		<div class="bottom cutouter" style="max-height:{$settings->cutmob|escape}px;">
			<div class="disappear"></div>
			<div class="cutinner"><!--seo-->{if !empty($brand->description_seo)}{$brand->description_seo}{elseif !empty($category->description_seo)}{$category->description_seo}{/if}<!--/seo--></div>
		</div>
		<div class="bottom cutmore" style="display:none;">Развернуть...</div>
	</div>
{/if}

{if empty($mobile_app)}
	<script>
		window.addEventListener("orientationchange", function() {
			location.reload();
		}, false);
	</script>
{/if}

{* Канонический адрес страницы *}
{$canonical="/products/{$product->url}" scope=root}
<div class="product">
	<div style="position:relative;">
		<div id="swipeimg" class="slider">
			{if !empty($product->images)}
				{foreach $product->images as $i=>$image}
					<div imcolor="{$image->color}" {if $image->color}class="blockwrapp" {else}class="showanyway" style="visibility:visible;"{/if}>
						<div class="imgwrapper">
							<img alt="{$product->name|escape}" title="{$product->name|escape}" class="blockimage" src="{$image->filename|resize:300:300:w}" />
						</div>
					</div>
				{/foreach}
			{else}
				<div class="showanyway" style="visibility:visible;">
					<div class="imgwrapper">
						<img loading="lazy" src="/design/mobile_mod/images/no-photo.png" alt="{$product->name|escape}" title="{$product->name|escape}"/>
					</div>
				</div>
			{/if}
		</div>
		{if !empty($product->images) && $product->images|count>1}
		<div class="directionNav">
			<span onClick="Swipeslider.Prev();" class="prev"></span><span onClick="Swipeslider.Next();" class="next"></span>
		</div>
		{/if}
	</div>

	{* Описание товара *}
	<div class="description">
		{$count_stock = 0}
		{foreach $product->variants as $pv}
			{$count_stock = $count_stock + $pv->stock}
		{/foreach}
		{if $count_stock > 0}
			{$notinstock=0}
		{else}
			{$notinstock=1}
		{/if}
		{if $notinstock == 0}

            {$sku = $product->variant->sku|default:''}
            {if !empty($product->variant->shop->name)}
                {$sku = "{$product->variant->shop->name}-$sku"}
            {/if}

			{* Выбор варианта товара *}
			<form class="variants" action="/cart">
				<div class="bm_good">	
					<h1>{if !empty($product->name)}{$product->name|escape}{/if}</h1>
					{if $product->vproperties}
						{$cntname1 = 0}
						<span class="pricelist" style="display:none;">
							{foreach $product->variants as $v}
								{$ballov = ($v->price * $settings->bonus_order/100)|convert|replace:' ':''|round}
								<span class="c{$v->id}"
									  v_stock="{if $v->stock < $settings->max_order_amount}{$v->stock}{else}много{/if}"
									  v_unit="{if $v->unit}{$v->unit}{else}{$settings->units}{/if}"
									  v_sku="{if $sku}{$v->shop->name}-{$v->sku}{/if}"
									  v_bonus="{$ballov} {$ballov|plural:'балл':'баллов':'балла'}">
									{$v->price|convert}
								</span>
								{if $v->name1}{$cntname1 = 1}{/if}
							{/foreach}
						</span>
	
						{$cntname2 = 0}
						<span class="pricelist2" style="display:none;">
							{foreach $product->variants as $v}
								{if $v->compare_price > 0}
									<span class="c{$v->id}">{$v->compare_price|convert}</span>
								{/if}
								{if $v->name2}{$cntname2 = 1}{/if}
							{/foreach}
						</span>
	
						<input id="vhidden" class="1clk" name="variant" value="" type="hidden" />

						<div class="skustock">
							<div class="skustockleft">
								{if $settings->showsku == 1 && $sku}
								    <p id="sku_wrap" class="sku">Артикул: <span>{$sku}</span></p>
								{/if}
							</div>
						</div>

						<div class="separator brand-sku-category">
							{if !empty($brand)}
								<p class="product-brand">Производитель: <a title="{$brand->name|escape}" href="/brands/{$brand->url}">{$brand->name|escape}</a></p>
							{/if}
							{if !empty($category)}
								<p class="catname">Категория: <a title="{$category->name|escape}" href="catalog/{$category->url|escape}">{$category->name|escape}</a></p>
							{/if}
						</div>

						<div class="variantsblock">
							<label {if $cntname1 == 0} style="display:none;"{/if}>Размер
								<select name="variant1" class="p0">
									{foreach $product->vproperties[0] as $pname => $pclass}
										{assign var="size" value="c"|explode:$pclass}
										<option v_size="{$pname}" value="{$pclass}" class="{$pclass}"
												{foreach $size as $sz}{if $product->variant->id == $sz|intval}selected{/if}{/foreach}
										>{$pname}</option>
									{/foreach}
								</select>
							</label>
							<label {if $cntname2 == 0} style="display:none;"{/if}>Вес
								<select name="variant2" id="bigimagep1" class="p1">
									{foreach $product->vproperties[1] as $pname => $pclass}
										{assign var="color" value="c"|explode:$pclass}
										<span><option v_color="{$pname}" value="{$pclass}" class="{$pclass}"
													  {foreach $color as $cl}{if $product->variant->id == $cl|intval}selected{/if}{/foreach}
									>{$pname}</option></span>
									{/foreach}
								</select>
							</label>
						</div>

						<ul class="features-description">
							{foreach $product->features as $f}
								<li>
									<span class="feature-name"><strong>{$f->name|escape}:</strong></span>
									<span class="feature-value">{$f->value|escape}</span>
								</li>
							{/foreach}
						</ul>

						<div class="amount-price">					
							<div class="price-block {if !$product->variant->compare_price > 0}pricebig{/if}">
								{if $product->variant->compare_price > 0}
									<div ID="priceold" class="compare_price"></div>
								{/if}
								<span ID="price" class="price"></span>
								<span class="currency">{$currency->sign|escape}</span>
							</div>
						</div>

                    <div class="additional-information-title">Кредит без переплат</div>
                    <div class="additional-information">
                        <label for="number_months">Период, месяцев
                            <select id="number_months">
                                <option value="6">6</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="12">12</option>
                                <option value="18">18</option>
                                <option value="24">24</option>
                            </select>
                        </label>
                        <div id="in_months" data-currency="{$currency->sign|escape}">Ежемесячный платеж <strong>{($product->variant->price / 6)|convert} {$currency->sign|escape}</strong></div>
                    </div>
					<script>
						$(window).load(function () {
							$('#number_months').on('change', update_number_months);
						});
					</script>
				</div>
					{else}
						<select class="b1c_option" name="variant" {if $product->variants|count==1  && !$product->variant->name}style='display:none;'{/if}>
							{foreach $product->variants as $v}
								{$ballov = ($v->price * $settings->bonus_order/100)|convert|replace:' ':''|round}
								<option {if $product->variant->id==$v->id}selected{/if} data-stock="{if $v->stock < $settings->max_order_amount}{$v->stock}{else}много{/if}" data-unit="{if $v->unit}{$v->unit}{else}{$settings->units}{/if}" data-sku="{if $sku}{$v->shop->name}-{$v->sku}{/if}" data-bonus="{$ballov} {$ballov|plural:'балл':'баллов':'балла'}" value="{$v->id}" {if $v->compare_price > 0}data-cprice="{$v->compare_price|convert}"{/if} data-varprice="{$v->price|convert}">
									{$v->name|escape}&nbsp;
								</option>
							{/foreach}
						</select>

						<ul class="features-description">
							{foreach $product->features as $f}
								<li>
									<span class="feature-name"><strong>{$f->name|escape}:</strong></span>
									<span class="feature-value">{$f->value|escape}</span>
								</li>
							{/foreach}
						</ul>

						<div class="price">
							<div id="amount" style="display: none;">
								<input type="button" class="minus" value="−" />
								<input type="number" class="amount" name="amount" value="1" size="2" data-max="{$settings->max_order_amount|escape}"/>
								<input type="button" class="plus" value="+" />
								<span class="umnozh">X</span>
							</div>

							<div class="price-block {if !$product->variant->compare_price > 0}pricebig{/if}">
								{if $product->variant->compare_price > 0}
									<div class="compare_price">{$product->variant->compare_price|convert}</div>
								{/if}
								<span class="price">{$product->variant->price|convert}</span>
								<span class="currency">{$currency->sign|escape}</span>
							</div>
						</div>

                        <div class="additional-information-title">Кредит без переплат</div>
                        <div class="additional-information">
                            <label for="number_months">Период, месяцев
                                <select id="number_months">
                                    <option value="6">6</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="12">12</option>
                                    <option value="18">18</option>
                                    <option value="24">24</option>
                                </select>
                            </label>
                            <div id="in_months" data-currency="{$currency->sign|escape}">Ежемесячный платеж <strong>{($product->variant->price / 6)|convert} {$currency->sign|escape}</strong></div>
                            </div>
                        <script>
                            $(window).load(function () {
                                $('#number_months').on('change', update_number_months);
                            });
                        </script>

						</div>
					{/if}

					{if $product->body}
						<div class="page-pg">{$product->body}</div>
					{/if}

					<div class="buttonsblock">
						{if !$product->variant->reservation}
							<input type="submit" class="buttonred" value="беру" data-result-text="добавлено"/>
							{include file='wishcomp.tpl'}
						{else}
							<div class="reservation">В резерве</div>
						{/if}
					</div>
					
				</div>
			</form>
			{* Выбор варианта товара (The End) *}
			{* rating *}
			{if isset($product->rating) && $product->rating > 0}
				{$rating = $product->rating}
			{else}
				{$rating = $settings->prods_rating|floatval}
			{/if}	
			{$votes = $settings->prods_votes|intval + $product->votes}
			{$views = $settings->prods_views|intval + $product->views}

		{else}
			{if $settings->showsku == 1 && !empty($product->variant->sku)}
				<p class="page-pg sku">Артикул {$product->variant->sku}</p>
			{/if}
			<p class="page-pg not_in_stock_label">Нет в наличии</p>
			<div class="separator" style="margin-bottom:10px;">
				{include file='wishcomp.tpl'}
			</div>
			<input name="variant" v_name="" v_price="" style="display:none;"/>
		{/if}
	
	</div>
</div>

<div class="product">
    <div class="labelsblock">
        {if !empty($product->featured)}
            <div class="hit">Хит</div>
        {/if}
        {if !empty($product->is_new)}
            <div class="new">Новинка</div>
        {/if}
        {if !empty($product->variant->compare_price)}
            <div class="lowprice">- {100-($product->variant->price*100/$product->variant->compare_price)|round}
            %</div>{/if}
    </div>
    <div class="image" onclick="window.location='/products/{$product->url}'" {if !empty($product->images[1]->filename)}
        onmouseover="$(this).find('img').attr('src', '{$product->images[1]->filename|resize:300:300}');"
        onmouseout="$(this).find('img').attr('src', '{$product->image->filename|resize:300:300}');"
            {/if}>
        {if !empty($product->image)}
            <img loading="lazy" src="{$product->image->filename|resize:300:300}" alt="{$product->name|escape}"
                 title="{$product->name|escape}"/>
        {else}
            <img loading="lazy" src="/design/Zolotomania/images/no-photo.png" alt="{$product->name|escape}"
                 title="{$product->name|escape}"/>
        {/if}
    </div>
    <div class="product_info product_item">
        <h3 class="product_title">
            <a title="{$product->name|escape}" data-product="{$product->id}" href="products/{$product->url}">
                {$product->name|escape}
            </a>
        </h3>
        {if $settings->showsku == 1}
            {* Расположение товара - склад *}
            <p class="sku">
                {if $group && $group->name == 'Магазины'}
                    {if $product->variant->sku && !empty($product->variant->shop->name)}
                        <span>{$product->variant->shop->name}-{$product->variant->sku}</span>
                    {/if}
                {else}
                    {if $product->variant->sku}
                        <span>Артикул: {$product->variant->sku}</span>
                    {/if}
                {/if}
            </p>
        {/if}

        {if !empty($smarty.cookies.view) && $smarty.cookies.view == 'table' && $mod == 'ProductsView'}
            <div class="annotation">
                {if $product->brand}
                    <div class="table_brand">Производитель: <span class="bluelink"
                                                                  onclick="window.location='/brands/{$product->brand_url}'">{$product->brand}</span>
                    </div>{/if}
                <div class="table_body">{$product->annotation}</div>
                {* свойства товара, раскомментировать в view/ProductsView.php*}
                {*{if $product->options}
                <div class="features">
                    {foreach $product->options as $f}
                        <p>{$f->name} : {$f->value}</p>
                    {/foreach}
                </div>
                {/if}*}
                {* свойства товара @ *}
            </div>
        {/if}
        <div {if !empty($smarty.cookies.view) && $smarty.cookies.view == 'table' && $mod == 'ProductsView'}id="prod_right"{/if}>
            {if isset($product->rating) && $product->rating|floatval > 0}
                {$prod_rating = $product->rating}
            {else}
                {$prod_rating = $settings->prods_rating|floatval}
            {/if}
            {if !empty($product->variants) && $product->variants|count > 0}
                <form class="variants" action="/cart">
                    {if $product->vproperties}
                        {$cntname1 = 0}
                        <span class="pricelist" style="display:none;">
						{foreach $product->variants as $v}
                            <span class="c{$v->id}"
                                  data-unit="{if $v->unit}{$v->unit}{else}{$settings->units}{/if}">{$v->price|convert}</span>
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
                        <input class="vhidden" name="variant" value="" type="hidden"/>
                        <div class="product__variants">
                            <select {if $cntname1 == 0}class="p0" style="display:none;"
                                    {else}class="p0 showselect"{/if}>
                                {foreach $product->vproperties[0] as $pname => $pclass}
                                    <option {if $cntname1 == 0}label="size"{/if} value="{$pclass}"
                                            class="{$pclass}">{$pname}</option>
                                {/foreach}
                            </select>

                            <select {if $cntname2 == 0}class="p1" style="display:none;"
                                    {else}class="p1 showselect"{/if}>
                                {foreach $product->vproperties[1] as $pname => $pclass}
                                    <option value="{$pclass}" class="{$pclass}">{$pname}</option>
                                {/foreach}
                            </select>

                            {if $cntname2 == 0 || $cntname1 == 0}
                                {if !empty($smarty.cookies.view) && $smarty.cookies.view == 'table' && $mod == 'ProductsView'}
                                    <div style="display: table; height: 27px;"></div>
                                {/if}
                            {/if}
                        </div>
                        <div class="pricecolor">
                            <span class="amountwrapper"><input type="number" name="amount" value="1" autocomplete="off">&nbsp;x&nbsp;</span>
                            <span class="compare_price"></span> <span class="price"></span> <span
                                    class="currency">{$currency->sign|escape}{if $settings->b9manage}/<span
                                        class="unit">{if $product->variant->unit}{$product->variant->unit}{else}{$settings->units}{/if}</span>{/if}</span>
                        </div>
                    {else}
                        {if $product->variants|count==1 && !$product->variant->name && !empty($smarty.cookies.view) && $smarty.cookies.view == 'table' && $mod == 'ProductsView'}
                            <span class="varspacer" style="display: block; height:55px;"></span>
                        {/if}
                        <select name="variant"
                                {if $product->variants|count==1 && !$product->variant->name}class="b1c_option"
                                style="display:none;" {else}class="b1c_option showselect"{/if}>
                            {foreach $product->variants as $v}
                                <option value="{$v->id}"
                                        data-unit="{if $v->unit}{$v->unit}{else}{$settings->units}{/if}"
                                        {if $v->compare_price > 0}data-cprice="{$v->compare_price|convert}"{/if}
                                        data-varprice="{$v->price|convert}">
                                    {$v->name}&nbsp;
                                </option>
                            {/foreach}
                        </select>
                        <div class="price">
                            <span class="amountwrapper"><input type="number" name="amount" value="1" autocomplete="off">&nbsp;x&nbsp;</span>
                            <span class="compare_price">{if $product->variant->compare_price > 0}{$product->variant->compare_price|convert}{/if}</span>
                            <span class="price">{$product->variant->price|convert}</span>
                            <span class="currency">{$currency->sign|escape}{if $settings->b9manage}/<span
                                        class="unit">{if $product->variant->unit}{$product->variant->unit}{else}{$settings->units}{/if}</span>{/if}</span>
                        </div>
                    {/if}
                    <div class="buy uk-flex">
                        {if !$product->variant->reservation}
                            <div class="wishprod">
                                <div class="wishlist towish" title="Избранное">
                                    {if !empty($wished_products) && $product->id|in_array:$wished_products}
                                        <span onclick="window.location='/wishlist'" class="inwish activewc">
										<span xlink:href='#activew'
                                              class="button button-default button-blue">В желаниях</span>
									</span>
                                    {else}
                                        <span onclick="window.location='/wishlist'"
                                              class="inwish activewc">
										<span xlink:href='#activew'
                                              class="button button-default button-blue">В желаниях</span>
									</span>
                                        <span class="basewc button button-default button-blue" data-wish="{$product->id}" xlink:href='#basew'>Подумаю</span>
                                    {/if}
                                </div>
                            </div>
                            <input {if $settings->trigger_id}onmousedown="try { rrApi.addToBasket({$product->variant->id}) } catch(e) {}"{/if}
                                   type="submit" class="button buttonred add-to-cart" value="Беру!"
                                   data-result-text="В корзине"/>
                        {else}
                            <div class="reservation">В резерве</div>
                        {/if}
                    </div>

                </form>
            {else}
                <div class="notinstocksep" style="display: table;">Нет в наличии</div>
            {/if}
        </div>
    </div>
</div>

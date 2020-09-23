{$meta_title = "Избранное" scope=root}
{$page_name = "Избранное" scope=root}
<h1 style="margin-top: 20px;">Список желаний</h1>

{if $wished_products|count}
    <div class="tiny_products relcontent">
        {foreach $wished_products as $product}
            <div class="product flex">

                {* Product images | Фото товара *}
                <div class="blockimg uk-grid">
                    <div class="labelsblock">
                        {if !empty($product->featured)}
                            <div class="hit">Хит</div>
                        {/if}
                        {if !empty($product->is_new)}
                            <div class="new">Новинка</div>
                        {/if}
                        {if !empty($product->variant->compare_price)}
                            <div class="lowprice">
                            - {100-($product->variant->price*100/$product->variant->compare_price)|round}%</div>{/if}
                    </div>
                    {* Большое фото *}
                    <div class="imagebig" id="lenss">
                        <div class="big_middle">
                            {if $product->image}
                                {if $product->images|count==1}
                                    <a href="{$product->image->filename|resize:800:600:w}" class="zoom cloud-zoom" id="zoom1" title="{$product->name|escape}" data-rel="{if !empty($product->image->color)}{$product->image->color}{else}gallery{/if}">
                                {/if}
                                <div onClick="$('.imagesmall a:visible:first').click();" class="image"><img
                                            src="{$product->image->filename|resize:800:600:w}"
                                            alt="{$product->name|escape}" title="{$product->name|escape}"
                                            class="imglenss"/></div>
                                {if $product->images|count==1}</a>{/if}
                            {else}
                                <div class="image">
                                    <svg fill="#dadada" style="width:50%;height:50%;" viewBox="0 0 24 24">
                                        <use xlink:href='#no_photo'/>
                                    </svg>
                                </div>
                            {/if}
                        </div>
                    </div>
                    {* Большое фото @ *}
                    {* Миниатюры *}
                    {if $product->images|count>1}
                        <div class="images">
                            {foreach $product->images as $i=>$image}
                                <div class="{if !$image->color}imgvisible{/if} cloud-zoom-gallery imagesmall"
                                     data-imcolor="{$image->color}" data-sm="{$image->filename|resize:800:600:w}">
                                    <a class="zoom" href="{$image->filename|resize:800:600:w}"
                                       title="{$product->name|escape}"
                                       data-rel="{if !empty($image->color)}{$image->color}{else}gallery{/if}">
                                        <img src="{$image->filename|resize:100:100}" alt="{$product->name|escape}"
                                             title="{$product->name|escape}"/>
                                    </a>
                                </div>
                            {/foreach}
                        </div>
                    {/if}
                    {* Миниатюры @ *}
                </div>
                {* Product images | Фото товара @ *}

                {$count_stock = 0}
                {foreach $product->variants as $pv}
                    {$count_stock = $count_stock + $pv->stock}
                {/foreach}
                {if $count_stock > 0}
                    {$notinstock=0}
                {else}
                    {$notinstock=1}
                {/if}

                {if isset($product->rating) && $product->rating|floatval > 0}
                    {$rating = $product->rating}
                {else}
                    {$rating = $settings->prods_rating|floatval}
                {/if}

                {$votes = $settings->prods_votes|intval + $product->votes}
                {$views = $settings->prods_views|intval + $product->views}

                {* Описание товара *}
                <div class="description {if empty($notinstock)}border_wrapper{/if}">

                    {if empty($notinstock)}
                        {if $settings->showsku == 1}
                            {* Расположение товара - склад *}
                            <p class="sku">
                                {if $product->variant->sku && !empty($product->variant->shop->name)}
                                    <span>{$product->variant->shop->name}-{$product->variant->sku}</span>
                                {/if}
                            </p>
                        {/if}
                    {/if}

                    <h1 class="product__title" data-product="{$product->id}">{$product->name|escape}</h1>
                    {* schema *}
                    {if $product->annotation}{$descr = $product->annotation|strip_tags:true}{elseif $product->body}{$descr = $product->body|strip_tags:true}{elseif !empty($seo_description)}{$descr = $seo_description}{elseif $meta_description}{$descr = $meta_description|escape}{else}{$descr = $product->name|escape}{/if}
                    <div itemscope itemtype="http://schema.org/Product">
                        <meta content="{$product->name|escape}" itemprop="name">
                        <meta content="{$descr|replace:'"':''}" itemprop="description">
                        <meta content="{if $product->image}{$product->image->filename|resize:800:600:w}{else}{$config->root_url}/js/nophoto.png{/if}"
                              itemprop="image">
                        {if !empty($product->variant->price)}
                            <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                <meta content="{$product->variant->price|convert|strip:''}" itemprop="price">
                                <meta content="{$currency->code|escape|replace:'RUR':'RUB'}" itemprop="priceCurrency">
                                <link itemprop="url" href="{$config->root_url}/products/{$product->url}"/>
                                {if $product->variant->stock == 0}
                                    <meta content="OutOfStock" itemprop="availability">
                                {else}
                                    <meta content="InStock" itemprop="availability">
                                {/if}
                            </div>
                        {/if}
                        {if !empty($product->variant->sku)}
                            <meta content="{$product->variant->sku}" itemprop="sku">{/if}
                        {if !empty($votes) && !empty($rating)}
                            <div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                                <meta itemprop="ratingValue" content="{$rating}">
                                <meta itemprop="ratingCount" content="{$votes}">
                                <meta itemprop="worstRating" content="1">
                                <meta itemprop="bestRating" content="5">
                            </div>
                        {/if}
                        {if !empty($brand->name)}
                            <div itemprop="brand" itemscope itemtype="http://schema.org/Brand">
                                <meta itemprop="name" content="{$brand->name|escape}">
                            </div>
                        {/if}
                    </div>
                    {* schema @ *}

                    {if empty($notinstock)}
                        {* Выбор варианта товара *}
                        <form class="variants" action="/cart">
                            <div class="bm_good">
                                {if $product->vproperties}
                                    {$cntname1 = 0}
                                    <span class="pricelist" style="display:none;">
							{foreach $product->variants as $v}
                                {$ballov = ($v->price * $settings->bonus_order/100)|convert|replace:' ':''|round}
                                <span class="c{$v->id}"
                                      data-stock="{if $v->stock < $settings->max_order_amount}{$v->stock}{else}много{/if}"
                                      data-unit="{if $v->unit}{$v->unit}{else}{$settings->units}{/if}"
                                      data-sku="{if $v->sku}Артикул: {$v->sku}{/if}"
                                      data-bonus="{$ballov} {$ballov|plural:'балл':'баллов':'балла'}">{$v->price|convert}</span>
                                {if $v->name1}{$cntname1 = 1}{/if}
                            {/foreach}
						</span>
                                    {$cntname2 = 0}
                                    <span class="pricelist2" style="display:none;">
                                    {foreach $product->variants as $v}
                                        {if $v->compare_price > 0}
                                            <spanclass
                                            ="c{$v->id}">{$v->compare_price|convert}</span>{/if}
                                        {if $v->name2}{$cntname2 = $cntname2 + 1}{/if}
                                    {/foreach}
                                    </span>
                                    <input class="vhidden 1clk" name="variant" value="" type="hidden"/>
                                    {if $settings->showsku == 1}<!--p class="sku">{if $product->variant->sku}Артикул: {$product->variant->sku}{/if}</p-->{/if}
                                    {if $settings->showstock == 1}<span class="stockblock">На складе: <span
                                                class="stock">{if $product->variant->stock < $settings->max_order_amount}{$product->variant->stock}{else}много{/if}</span>
                                        </span>{/if}
                                    <div class="variants-wrap flex" style="display: none; margin-bottom: 15px;">
                                        <select name="variant1"
                                                class="p0"{if $cntname1 == 0} style="display:none;"{/if}>
                                            {foreach $product->vproperties[0] as $pname => $pclass}
                                                {assign var="size" value="c"|explode:$pclass}
                                                <option {if $cntname1 == 0}label="size"{/if} value="{$pclass}"
                                                        class="{$pclass}"
                                                        {foreach $size as $sz}{if $product->variant->id == $sz|intval}selected{/if}{/foreach}
                                                >{$pname}</option>
                                            {/foreach}
                                        </select>
                                        <select name="variant2" id="bigimagep1"
                                                class="p1"{if $cntname2 == 0} style="display:none;"{/if}>
                                            {foreach $product->vproperties[1] as $pname => $pclass}
                                                {assign var="color" value="c"|explode:$pclass}
                                                <option value="{$pclass}" class="{$pclass}"
                                                        {foreach $color as $cl}{if $product->variant->id == $cl|intval}selected{/if}{/foreach}
                                                >{$pname}</option>
                                            {/foreach}
                                        </select>
                                    </div>
                                    <div class="colorpriceseparator">
                                        <div id="amount">
                                            <input type="button" class="minus" value="-"/>
                                            <input type="text" class="amount" name="amount"
                                                   data-max="{$settings->max_order_amount|escape}" value="1" size="2"/>
                                            <input type="button" class="plus" value="+"/>
                                        </div>
                                        <span class="compare_price"></span>
                                        <span class="price"></span>
                                        <span class="currency">
								{$currency->sign|escape}
                                            {if $settings->b9manage}/<span
                                                    class="unit">{if $product->variant->unit}{$product->variant->unit}{else}{$settings->units}{/if}</span>{/if}
							</span>
                                        {if $settings->bonus_limit && $settings->bonus_order}{$ballov = ($product->variant->price * $settings->bonus_order/100)|convert|replace:' ':''|round}
                                            <span class="bonus">+ <span
                                                    class="bonusnum">{$ballov} {$ballov|plural:'балл':'баллов':'балла'}</span>
                                            </span>{/if}
                                    </div>
                                {else}
                                    {if $product->variants|count==1  && !$product->variant->name}{else}
                                        <span class="b1c_caption" style="display: none;"> </span>
                                    {/if}


                                    {if $settings->showstock == 1}<span class="stockblock">На складе: <span
                                                class="stock">{if $product->variant->stock < $settings->max_order_amount}{$product->variant->stock}{else}много{/if}</span>
                                        </span>{/if}
                                    <select class="b1c_option" name="variant"
                                            {if $product->variants|count==1  && !$product->variant->name}style='display:none;'{/if}>
                                        {foreach $product->variants as $v}
                                            {$ballov = ($v->price * $settings->bonus_order/100)|convert|replace:' ':''|round}
                                            <option {if $product->variant->id==$v->id}selected{/if}
                                                    data-stock="{if $v->stock < $settings->max_order_amount}{$v->stock}{else}много{/if}"
                                                    data-unit="{if $v->unit}{$v->unit}{else}{$settings->units}{/if}"
                                                    data-sku="{if $v->sku}Артикул: {$v->sku}{/if}"
                                                    data-bonus="{$ballov} {$ballov|plural:'балл':'баллов':'балла'}"
                                                    value="{$v->id}" {if $v->compare_price > 0}data-cprice="{$v->compare_price|convert}"{/if}
                                                    data-varprice="{$v->price|convert}">
                                                {$v->name|escape}&nbsp;
                                            </option>
                                        {/foreach}
                                    </select>
                                    <div class="price noncolor">
                                        <div id="amount">
                                            <input type="button" class="minus" value="-"/>
                                            <input type="text" class="amount" name="amount"
                                                   data-max="{$settings->max_order_amount|escape}" value="1" size="2"/>
                                            <input type="button" class="plus" value="+"/>
                                        </div>
                                        <script>
                                            $(window).load(function () {
                                                stock = parseInt($('.productview select[name=variant]').find('option:selected').attr('data-stock'));
                                                if (!$.isNumeric(stock)) {
                                                    stock = {$settings->max_order_amount|escape};
                                                }
                                                $('.variants .amount').attr('data-max', stock);
                                            });
                                            $('.productview select[name=variant]').change(function () {
                                                stock = parseInt($(this).find('option:selected').attr('data-stock'));
                                                if (!$.isNumeric(stock))
                                                    stock = {$settings->max_order_amount|escape};

                                                $('.variants .amount').attr('data-max', stock);

                                                oldamount = parseInt($('.variants .amount').val());
                                                if (oldamount > stock)
                                                    $('.variants .amount').val(stock);
                                            });
                                        </script>
                                        <span class="compare_price">{if $product->variant->compare_price}{$product->variant->compare_price|convert}{/if}</span>
                                        <span class="price">{$product->variant->price|convert}</span>
                                        <span class="currency">
								{$currency->sign|escape}{if $settings->b9manage}/<span
                                                    class="unit">{if $product->variant->unit}{$product->variant->unit}{else}{$settings->units}{/if}</span>{/if}
							</span>
                                        {if $settings->bonus_limit && $settings->bonus_order}{$ballov = ($product->variant->price * $settings->bonus_order/100)|convert|replace:' ':''|round}
                                            <span class="bonus">+ <span
                                                    class="bonusnum">{$ballov} {$ballov|plural:'балл':'баллов':'балла'}</span>
                                            </span>{/if}
                                    </div>
                                {/if}
                                <div class="buy uk-flex">
                                    <div class="wishprod">
                                        <div class="wishlist towish" title="Избранное">
                                            <a class="button button-default button-blue"
                                               href="wishlist/remove/{$product->id}">Передумал</a>
                                        </div>
                                    </div>
                                    <input onmousedown="try { rrApi.addToBasket({$product->variant->id}) } catch(e) {}"
                                           style="margin-right: 15px;" type="submit"
                                           class="button button-default button-red add-to-cart" value="Беру!"
                                           data-result-text="В корзине"/>
                                </div>
                                {include file='1click.tpl'}


                            </div>
                        </form>
                        {* Выбор варианта товара (The End) *}
                        {if !empty($brand->name)}
                            <div class="annot-brand"><span>Производитель:</span> <a class="bluelink"
                                                                                    style="font-weight:700;"
                                                                                    href="brands/{$brand->url}">{$brand->name|escape}</a>
                            </div>{/if}

                    {else}
                        {if $settings->showsku == 1 && !empty($product->variant->sku)}
                            <!--p class="sku">Артикул: {$product->variant->sku}</p-->
                        {/if}
                        <p class="not_in_stock_label">Нет в наличии</p>
                        <div style="display:table; clear:both; width: 100%;">
                            {include file='wishcomp.tpl'}
                        </div>
                        {* same products *}
                        {get_products var=same_products category_id=$category->id limit=6}
                        {if $same_products}
                            <div id="same">
                                <div class="same_title">Похожие товары</div>
                                <ul class="relcontent tiny_products">
                                    {foreach $same_products as $same_product}
                                        <li class="product">
                                            <div onClick="window.location='/products/{$same_product->url}'"
                                                 class="image" style="cursor:pointer;">
                                                {if $same_product->image}
                                                    <a href="products/{$same_product->url}"
                                                       title="{$same_product->name|escape}"><img
                                                                src="{$same_product->image->filename|resize:300:300}"
                                                                alt="{$same_product->name|escape}"
                                                                title="{$same_product->name|escape}"/></a>
                                                {else}
                                                    <a href="products/{$same_product->url}"
                                                       title="{$same_product->name|escape}">
                                                        <svg>
                                                            <use xlink:href='#no_photo'/>
                                                        </svg>
                                                    </a>
                                                {/if}
                                            </div>
                                            <div class="product_info">
                                                <h3 class="product_title"><a data-product="{$same_product->id}"
                                                                             href="products/{$same_product->url}"
                                                                             title="{$same_product->name|escape}">{$same_product->name|escape}</a>
                                                </h3>
                                                {if isset($same_product->rating) && $same_product->rating > 0}
                                                    {$same_rating = $same_product->rating}
                                                {else}
                                                    {$same_rating = $settings->prods_rating|floatval}
                                                {/if}
                                                <div class="ratecomp">
                                                    <div class="catrater">
                                                        <div class="statVal">
										<span class="rater_sm">
											<span class="rater-starsOff_sm" style="width:60px;">
												<span class="rater-starsOn_sm"
                                                      style="width:{$same_rating*60/5|string_format:"%.0f"}px"></span>
											</span>
										</span>
                                                        </div>
                                                    </div>
                                                    <div style="float: right">
                                                        {foreach $same_product->variants as $v}
                                                            {if $v@first}
                                                                <span class="price">{$v->price|convert} <span
                                                                            class="currency">{$currency->sign|escape}</span></span>
                                                            {/if}
                                                        {/foreach}
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    {/foreach}
                                </ul>
                            </div>
                        {/if}
                        {* same products @ *}
                        <input name="variant" style="display:none;"/>
                    {/if}
                    {if $product->annotation}
                        <div class="annot">
                            {$product->annotation}
                        </div>
                    {/if}
                    {if $product->features}
                        <div id="tab2" class="tab_content">
                            <ul class="features">
                                {foreach $product->features as $f}
                                    <li>
                                        <label class="featurename"><span>{$f->name|escape}:</span></label>
                                        <label class="lfeature">{$f->value|escape}</label>
                                    </li>
                                {/foreach}
                            </ul>
                        </div>
                    {/if}
                    {* Add info *}
                    <ul class="product__add-info">
                        <li class="product__add-info--item">
                            Бесплатная доставка
                        </li>
                        <li class="product__add-info--item">
                            Примерка до 3 украшений
                        </li>
                        <li class="product__add-info--item">
                            Удобные способы оплаты
                        </li>
                    </ul>
                    {* Add info @ *}
                    {* Share *}
                    <div class="annot-brand share_wrapper">
                        <div class="share_title">Поделиться:</div>
                        <div class="share">
                            <div class="vk sprite"
                                 onClick='window.open("https://vk.com/share.php?url={$config->root_url|urlencode}/products/{$product->url|urlencode}&title={$product->name|urlencode}&noparse=false");'></div>
                            <div class="facebook sprite"
                                 onClick='window.open("https://www.facebook.com/sharer.php?u={$config->root_url|urlencode}/products/{$product->url|urlencode}");'></div>
                            <div class="twitter sprite"
                                 onClick='window.open("https://twitter.com/share?text={$product->name|urlencode}&url={$config->root_url|urlencode}/products/{$product->url|urlencode}&hashtags={$product->meta_keywords|replace:' ':''|urlencode}");'></div>
                            <div class="gplus sprite"
                                 onClick='window.open("https://plus.google.com/share?url={$config->root_url|urlencode}/products/{$product->url|urlencode}");'></div>
                            <div class="ok sprite"
                                 onClick='window.open("https://connect.ok.ru/offer?url={$config->root_url|urlencode}/products/{$product->url|urlencode}&title={$product->name|urlencode}&imageUrl={if $product->image}{$product->image->filename|resize:800:600:w}{else}{$config->root_url}/js/nophoto.png{/if}");'></div>
                        </div>
                    </div>
                    {* Share @ *}

                </div>

            </div>
        {/foreach}
    </div>
    <script>
        $(document).ready(function () {
            $('.minus').click(function () {
                var $input = $(this).parent().find('.amount');

                var count = parseInt($input.val()) - 1;
                count = count < 1 ? 1 : count;
                if (!$.isNumeric(count)) {
                    count = 1;
                }

                maxamount = parseInt($('#amount .amount').attr('data-max'));
                if (!$.isNumeric(maxamount)) {
                    maxamount = {$settings->max_order_amount|escape};
                    $('#amount .amount').attr('data-max', maxamount);
                }
                if (count < maxamount)
                    $input.val(count);
                else
                    $input.val(maxamount);

                $input.change();
                return false;
            });
            $('.plus').click(function () {
                var $input = $(this).parent().find('.amount');
                oldamount = parseInt($input.val());
                if (!$.isNumeric(oldamount)) {
                    oldamount = 1;
                }

                maxamount = parseInt($('#amount .amount').attr('data-max'));
                if (!$.isNumeric(maxamount)) {
                    maxamount = {$settings->max_order_amount|escape};
                    $('#amount .amount').attr('data-max', maxamount);
                }

                if (oldamount < maxamount)
                    $input.val(oldamount + 1);
                else
                    $input.val(maxamount);
                $input.change();
                return false;
            });
        });
    </script>
{else}
    <p>Сейчас список избранного пуст</p>
{/if}

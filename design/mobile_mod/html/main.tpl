<!-- main.tpl -->
{$wrapper = 'index.tpl' scope=root}

{* Канонический адрес страницы *}
{$canonical="" scope=root}

{include file='slides_mob.tpl'}

<section class="main">
    {if !empty($main_categories)}
        {foreach name=cats from=$main_categories item=mc}
            <div class="category-wrapper">
                <div class="category-title">
                    <a href="/catalog/{$mc->url}">{$mc->name|escape}</a>
                </div>
                <div class="owl-carousel sub-categories">
                    {foreach name=cats from=$mc->subcategories item=c}
                        {if $c->visible && $c->products_count > 0}
                            <div class="item-wrap category-wrap">
                                <a class="category" href="/catalog/{$c->url}">
                                    {if $c->image}
                                        <img loading="lazy" src="/files/categories/{$c->image}" alt="{$c->name}"
                                             title="{$c->name}"/>
                                    {else}
                                        <svg class="nophoto">
                                            <use xlink:href='#folder'/>
                                        </svg>
                                    {/if}
                                </a>
                            </div>
                        {/if}
                    {/foreach}
                </div>
            </div>
        {/foreach}
    {/if}

    {* new *}
    {if $settings->mainnew}
        {* available sort (or remove): position, name, date, views, rating, rand *}
        {get_products var=is_new_products is_new_temp=1 sort=rand limit=12}
        {if !empty($is_new_products)}
            <div class="category-wrapper">
                <div class="category-title">
                    <span>Новинки</span>
                </div>
                <div class="owl-carousel products-carousel">
                    {foreach $is_new_products as $product}
                        <div class="item-wrap product-wrap">
                            <div class="product">
                                <div class="image"
                                     onclick="window.location='/products/{$product->url}'"
                                        {if !empty($product->images[1]->filename)}
                                    onmouseover="$(this).find('img').attr('src', '{$product->images[1]->filename|resize:300:300}');"
                                    onmouseout="$(this).find('img').attr('src', '{$product->image->filename|resize:300:300}');"
                                        {/if}>
                                    {if !empty($product->image)}
                                        <img loading="lazy" src="{$product->image->filename|resize:300:300}"
                                             alt="{$product->name|escape}"
                                             title="{$product->name|escape}"/>
                                    {else}
                                        <img loading="lazy" src="/design/Zolotomania/images/no-photo.png"
                                             alt="{$product->name|escape}"
                                             title="{$product->name|escape}"/>
                                    {/if}
                                </div>
                                <div class="product-info">
                                    <h3 class="product-title">
                                        <a title="{$product->name|escape}"
                                           data-product="{$product->id}"
                                           href="products/{$product->url}">
                                            {$product->name|escape}
                                        </a>
                                    </h3>
                                    <div class="price">
                                            <span class="compare-price">
                                                {if $product->variant->compare_price > 0}
                                                    {$product->variant->compare_price|convert}
                                                {/if}
                                            </span>
                                        <span class="price">{$product->variant->price|convert}</span>
                                        <span class="currency">{$currency->sign|escape}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {/foreach}
                </div>
            </div>
        {/if}
    {/if}
    {* new end *}

    {* discounted *}
    {if $settings->mainsale}
        {* available sort (or remove): position, name, date, views, rating, rand *}
        {get_products var=discounted_products discounted_temp=1 sort=rand limit=12}
        {if !empty($discounted_products)}
            <div class="category-wrapper">
                <div class="category-title">
                    <span>Акционные предложения</span>
                </div>
                <div class="owl-carousel products-carousel">
                    {foreach $discounted_products as $product}
                        <div class="item-wrap product-wrap">
                            <div class="product">
                                <div class="image"
                                     onclick="window.location='/products/{$product->url}'"
                                        {if !empty($product->images[1]->filename)}
                                    onmouseover="$(this).find('img').attr('src', '{$product->images[1]->filename|resize:300:300}');"
                                    onmouseout="$(this).find('img').attr('src', '{$product->image->filename|resize:300:300}');"
                                        {/if}>
                                    {if !empty($product->image)}
                                        <img loading="lazy" src="{$product->image->filename|resize:300:300}"
                                             alt="{$product->name|escape}"
                                             title="{$product->name|escape}"/>
                                    {else}
                                        <img loading="lazy" src="/design/Zolotomania/images/no-photo.png"
                                             alt="{$product->name|escape}"
                                             title="{$product->name|escape}"/>
                                    {/if}
                                </div>
                                <div class="product-info">
                                    <h3 class="product-title">
                                        <a title="{$product->name|escape}"
                                           data-product="{$product->id}"
                                           href="products/{$product->url}">
                                            {$product->name|escape}
                                        </a>
                                    </h3>
                                    <div class="price">
                                            <span class="compare-price">
                                                {if $product->variant->compare_price > 0}
                                                    {$product->variant->compare_price|convert}
                                                {/if}
                                            </span>
                                        <span class="price">{$product->variant->price|convert}</span>
                                        <span class="currency">{$currency->sign|escape}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {/foreach}
                </div>
            </div>
        {/if}
    {/if}
    {* discounted end *}

    <script async src="/design/Zolotomania/js/slick191.min.js"></script>
    <script>
        $(window).load(function () {
            $('.sub-categories').slick({
                dots: true,
                infinite: false,
                speed: 600,
                slidesToShow: 3,
                slidesToScroll: 3,
                arrows: false,
                mobileFirst: true,
                responsive: [
                    {
                        breakpoint: 520,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 4
                        }
                    }
                ]
            });
            $('.products-carousel').slick({
                dots: true,
                infinite: false,
                speed: 600,
                slidesToShow: 2,
                slidesToScroll: 2,
                arrows: false,
                mobileFirst: true,
                adaptiveHeight: true,
                responsive: [
                    {
                        breakpoint: 520,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3
                        }
                    }
                ]
            });
        });
    </script>

</section>
<!-- main.tpl @ -->

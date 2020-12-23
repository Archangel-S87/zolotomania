{* Шаблон корзины *}

{$meta_title = "Корзина" scope=root}
{$page_name = "Корзина" scope=root}

<style>
    .cart-back a.buttonblue:hover {
        background-color: #5ed246;
        border-color: #5ed246;
    }
    .row {
        width: 700px;
        display: flex;
        align-items: center;
        margin: 0 auto;
    }
    .row .nn {
        width: 30px;
        margin-bottom: 10px;
    }
    .row label {
        width: 150px;
    }

    .data-block {
        padding: 20px;
    }

    .error {
        color: #d24a46;
        border: 1px solid #d24a46;
        border-radius: 4px;
        text-align: center;
        font-size: 18px;
        margin-top: 40px;
    }
    .message_error {
        text-align: center;
    }
    #purchases1 .name .no-stock {
        text-decoration: line-through;
    }
    .del_pay_info iframe {
        max-width: 600px;
        margin: 0 auto;
    }
</style>

<h1 class="flex" style="margin-top: 20px; flex-wrap: nowrap; justify-content: space-between;">
    <span></span>
    <span class="cart-back" style="margin-bottom: -10px; line-height: 1;">
        <a href="/catalog" class="buttonblue">Вернутся к покупкам</a>
    </span>
</h1>

<h2 style="font-size: 30px; text-align: center; color: #d24a46;">Мои покупки</h2>

{if $cart->purchases}
    <form class="main_cart_form"
          method="post"
          name="cart"
          {if $settings->attachment == 1}enctype="multipart/form-data"{/if}>

        {*        <div class="cart__after uk-flex">*}
        {*            <div class="cart-back"></div>*}

        {*            <div class="purchases_middle">*}
        {*                *}{* Discount *}
        {*                {if !empty($cart->full_discount)}*}
        {*                    <div class="c_discount">*}
        {*                        *}{*{if !empty($cart->discount2)}*}
        {*                            <p>Рег. скидка: {$cart->discount2}&nbsp;%</p>*}
        {*                        {/if}*}
        {*                        {if !empty($cart->value_discountgroup)}*}
        {*                            <p>Скидка от суммы: {$cart->value_discountgroup}&nbsp;%</p>*}
        {*                        {/if}*}
        {*                        {if !empty($cart->full_discount)}*}
        {*                            <p class="total_discount">Скидка: {$cart->full_discount}&nbsp;%</p>*}
        {*                        {/if}*}
        {*                    </div>*}
        {*                {else}*}
        {*                    <div class="nodiscount"></div>*}
        {*                {/if}*}
        {*                *}{* Discount end *}

        {*                {if $settings->bonus_limit && isset($user->balance) && $user->balance > 0}*}
        {*                    <div class="c_coupon bonusblock">*}
        {*                        <label>*}
        {*                            <input type="checkbox" name="bonus" value="1"{if !empty($bonus)} checked{/if} /> <span*}
        {*                                    class="c_title" style="text-transform:uppercase;">Оплатить баллами</span>*}
        {*                        </label>*}
        {*                        *}{*<div class="totalbonuses">Всего накоплено баллов на {$user->balance|convert}&nbsp;{$currency->sign}</div>*}
        {*                        <div class="availbonuses">*}
        {*                            {if ($cart->total_price * $settings->bonus_limit / 100) >= $user->balance}*}
        {*                                Доступно к списанию в данном заказе {$user->balance|convert}&nbsp;{$currency->sign}*}
        {*                            {else}*}
        {*                                Доступно к списанию в данном заказе {($cart->total_price * $settings->bonus_limit / 100)|convert}&nbsp;{$currency->sign}*}
        {*                            {/if}*}
        {*                        </div>*}
        {*                    </div>*}
        {*                {/if}*}

        {*                {if !empty($coupon_request)}*}
        {*                    <div class="c_coupon">*}
        {*                        <p class="c_title">КУПОН:</p>*}
        {*                        {if !empty($coupon_error)}*}
        {*                            <div class="message_error">*}
        {*                                {if $coupon_error == 'invalid'}Купон недействителен{/if}*}
        {*                            </div>*}
        {*                        {/if}*}
        {*                        <div{if $cart->coupon_discount>0} style="display: none"{/if}>*}
        {*                            <input type="text" name="coupon_code"*}
        {*                                   value="{if !empty($cart->coupon->code)}{$cart->coupon->code|escape}{/if}"*}
        {*                                   class="coupon_code"*}
        {*                                   autocomplete="off"/>*}
        {*                            <input class="buttonblue"*}
        {*                                   type="button"*}
        {*                                   name="apply_coupon"*}
        {*                                   value="Применить купон"*}
        {*                                   onclick="document.cart.submit();"/>*}
        {*                        </div>*}
        {*                        {if !empty($cart->coupon->min_order_price)}<span*}
        {*                                class="coupondisc">Купон "{$cart->coupon->code|escape}" <span>для заказов от {$cart->coupon->min_order_price|convert} {$currency->sign}</span>{/if}*}
        {*                            {if $cart->coupon_discount>0}*}
        {*                                <br/>*}
        {*                                <span class="coupondiscount">Скидка по купону: <strong>{$cart->coupon_discount|convert}&nbsp;{$currency->sign}</strong>*}
        {*                                </span>{/if}*}

        {*                            {literal}*}
        {*                                <script>*}
        {*							$("input[name='coupon_code']").keypress(function (event) {*}
        {*                                if (event.keyCode == 13) {*}
        {*                                    $("input[name='name']").attr('data-format', '');*}
        {*                                    $("input[name='email']").attr('data-format', '');*}
        {*                                    document.cart.submit();*}
        {*                                }*}
        {*                            });*}
        {*							</script>*}
        {*                            {/literal}*}
        {*                    </div>*}
        {*                {/if}*}

        {*                <div class="c_total rounded6">*}
        {*                    <p>Итого товаров {if !empty($cart->full_discount)} со скидкой{/if} на:</p>*}
        {*                    <span id="ems-total-price">{$cart->total_price|convert}</span>&nbsp;{$currency->sign}*}
        {*                </div>*}

        {*            </div>*}
        {*        </div>*}
        {*        <span style="{if $cart->total_price >= $settings->minorder}display:none;{/if}" class="minorder">Минимальная сумма заказа <strong*}
        {*                    style="white-space: nowrap;">{$settings->minorder|convert} {$currency->sign}</strong><br/> Чтобы оформить заказ Вам нужно <a href="/">добавить в корзину еще товаров!</a></span>*}

        {if isset($error_stock)}
            <div class="message_error">
                {if $error_stock == 'out_of_stock_order'}В вашем заказе есть закончившиеся товары{/if}
            </div>
        {/if}

        {* Список покупок *}
        <table id="purchases1">

            <tr id="carttitles">
                <td class="number">№</td>
                <td class="image" style="border-radius: 5px 0 0 5px;">
                    Фото
                </td>
                <td class="name">
                    Наименование
                </td>
                <td class="price">
                    Цена
                </td>
                <td class="bonuses">
                    Маннинги
                </td>
                <td class="amounts" style="display: none;">
                    Количество
                </td>
                <td class="price">
                    Сумма
                </td>
                <td class="remove" style="border-radius: 0 5px 5px 0; display: none;">
                </td>
            </tr>

            {foreach from=$cart->purchases item=purchase name=products}
                {if !empty($purchase->product->name)}
                    <tr data-purchase-id="{$purchase->variant->id}"
                        {if $purchase->variant->stock == 0}class="out_of_stock"{/if}>

                        {* № *}
                        <td style="text-align: center">{$smarty.foreach.products.iteration}</td>

                        {* Изображение товара *}
                        <td class="image">
                            {if !empty($purchase->product->images)}
                                {$image = $purchase->product->images|first}
                                <span class="purimage">
                                    <a href="{$image->filename|resize:800:600:w}" class="zoom">
                                        <img src="{$image->filename|resize:100:100}"
                                             alt="{$purchase->product->name|escape}">
                                    </a>
                                </span>
                            {else}
                                <span class="purimage"><svg class="nophoto"><use xlink:href='#no_photo'/></svg></span>
                            {/if}
                        </td>

                        {* Название товара *}
                        <td class="name">
                            <div style="display: flex; justify-content: space-between; align-items: center">
                                <a href="products/{$purchase->product->url}"{if $purchase->variant->stock == 0 || $purchase->variant->reservation} class="no-stock"{/if}>{$purchase->product->name|escape}</a>
                                {* Удалить из корзины *}
                                <div class="remove" style="">
                                    <a href="cart/remove/{$purchase->variant->id}">
                                        <img width="16" height="16" src="design/{$settings->theme}/images/delete.png"
                                             title="Удалить из корзины" alt="Удалить из корзины">
                                    </a>
                                </div>
                            </div>
                        </td>

                        {* Цена за единицу *}
                        <td class="unit-price price">
                            {($purchase->variant->price)|convert} {$currency->sign}
                        </td>

                        {* Количество *}
                        <td class="amount" style="display: none;">
                            <input {if $purchase->variant->stock == 0}disabled{/if} type="text"
                                   name="amounts[{$purchase->variant->id}]"
                                   value="{if $purchase->variant->stock == 0}0{else}{$purchase->amount}{/if}"/>

                            <span> {if $purchase->variant->unit}{$purchase->variant->unit}{else}{$settings->units}{/if}</span>
                        </td>

                        {* Бонусы *}
                        <td class="unit-bonus bonuses" style="text-align: center"></td>

                        {* Сумма с учётом бонуса *}
                        <td class="price">
                            {($purchase->variant->price)|convert} {$currency->sign}
                        </td>
                    </tr>
                {/if}
            {/foreach}

            <tr>
                <td>Итого:</td>
                <td></td>
                <td></td>
                <td class="price">{$cart->total_price|convert} {$currency->sign}</td>
                <td id='total_bonus' class="bonuses" style="text-align: center"></td>
                <td id='total_price' class="price">{$cart->total_price|convert} {$currency->sign}</td>
            </tr>

        </table>

        <div class="del_pay_info" style="{if $cart->total_price < $settings->minorder}display:none;{/if}">

            {if $is_shop}
                {include file='cart_form_shop.tpl'}
            {elseif $user}
                {include file='cart_form_is_user.tpl'}
            {else}
                {include file='cart_form_no_user.tpl'}
            {/if}

        </div>

    </form>
{else}
    В корзине нет товаров
{/if}

{literal}
    <script>
        $(function () {
            $("a.zoom").fancybox({'hideOnContentClick': true});

            $('.data-block input').on('change', function () {
                $('.message_error').remove();
            });
        });
    </script>
{/literal}

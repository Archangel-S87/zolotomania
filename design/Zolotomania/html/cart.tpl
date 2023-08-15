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

<h1 class="title"><span>Мои покупки</span></h1>

{if $cart->purchases}
    <form class="main_cart_form"
          method="post"
          name="cart"
          {if $settings->attachment == 1}enctype="multipart/form-data"{/if}>

        {if isset($error_stock)}
            <div class="message_error">
                {if $error_stock == 'out_of_stock_order'}В вашем заказе есть закончившиеся товары{/if}
            </div>
        {/if}

        {* Список покупок *}
        <table id="purchases1">

            <tr id="carttitles">
                <th class="name"></th>
                <th class="price">
                    Цена
                </th>
                <th class="bonuses">
                    Маннинги
                </th>
                <th class="amounts" style="display: none;">
                    Количество
                </th>
                <th class="price">
                    Сумма
                </th>
                <th class="remove" style="border-radius: 0 5px 5px 0; display: none;">
                </th>
            </tr>

            {foreach from=$cart->purchases item=purchase name=products}
                {if !empty($purchase->product->name)}
                    <tr class="purchases" data-purchase-id="{$purchase->variant->id}"
                        {if $purchase->variant->stock == 0}class="out_of_stock"{/if}>

                        {* Название товара *}
                        <td class="name">
                            <div style="display: flex; justify-content: space-between; align-items: center">
                                {$name1 = ''}
                                {if $purchase->variant->name1}
                                    {$name1 = "{$purchase->product->label1} {$purchase->variant->name1}"}
                                {/if}
                                {$name2 = ''}
                                {if $purchase->variant->name2}
                                    {$name2 = "вес {$purchase->variant->name2}г"}
                                {/if}
                                <a href="products/{$purchase->product->url}"{if $purchase->variant->stock == 0 || $purchase->variant->reservation} class="no-stock"{/if}>
                                    {$purchase->product->name|escape} {$name1|escape} {$name2|escape}
                                </a>
                                {* Удалить из корзины *}
                                <div class="remove">
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

            <tr id="cart_total">
                <td>Итого:</td>
                <td></td>
                <td></td>
                <td id='total_price' class="price">{$cart->total_price|convert} {$currency->sign}</td>
            </tr>

        </table>

        <div class="del_pay_info" style="{if $cart->total_price < $settings->minorder}display:none;{/if}">

            <style>
                #error {
                    padding: 10px;
                }
                #check_sms_code {
                    padding: 2px;
                    display: block;
                    background: none !important;
                    border: 1px solid #d24a46;
                    line-height: 1;
                    margin: 0 0 10px 4px;
                }
                #check_sms_code svg {
                    width: 20px;
                    height: 20px;
                    cursor: pointer;
                }
            </style>

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

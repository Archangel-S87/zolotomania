{* Шаблон корзины *}

{$meta_title = "Корзина" scope=root}
{$page_name = "Корзина" scope=root}

<style>
    .cart-back a.buttonblue:hover {
        background-color: #5ed246;
        border-color: #5ed246;
    }
    .main_cart_form .row {
        width: 100%;
        display: flex;
        align-items: center;
        margin: 0 auto;
    }
    .main_cart_form .row label {
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
</style>

{if $cart->purchases}
    <form class="main_cart_form" method="post" name="cart"
          {if $settings->attachment == 1}enctype="multipart/form-data"{/if}>

        {if isset($error_stock)}
            <div class="message_error">
                {if $error_stock == 'out_of_stock_order'}В вашем заказе есть закончившиеся товары{/if}
            </div>
        {/if}

        {* Список покупок *}
        <ul class="purchaseslist">
            {foreach from=$cart->purchases item=purchase}
                {if !empty($purchase->product->name)}
                    <li data-purchase-id="{$purchase->variant->id}"
                        class="purchase {if $purchase->variant->stock == 0}out_of_stock{/if}">
                        {* Изображение товара *}
                        <div class="image" onclick="window.location='products/{$purchase->product->url}'">
                            {if !empty($purchase->product->images)}
                                {$image = $purchase->product->images|first}
                                <img src="{$image->filename|resize:100:100}" alt="{$purchase->product->name|escape}">
                            {else}
                                <svg class="nophoto">
                                    <use xlink:href='#no_photo'/>
                                </svg>
                            {/if}
                        </div>
                        <div class="product_info separator">
                            {* Название товара *}
                            {$name1 = ''}
                            {if $purchase->variant->name1}
                                {$name1 = "{$purchase->product->label1} {$purchase->variant->name1}"}
                            {/if}
                            {$name2 = ''}
                            {if $purchase->variant->name2}
                                {$name2 = "вес {$purchase->variant->name2}г"}
                            {/if}
                            <h3 class="purchasestitle">
								<a href="products/{$purchase->product->url}">{$purchase->product->name|escape} {$name1|escape} {$name2|escape}</a>
                            </h3>

                            {* Цена за единицу *}
                            <div class="price">
                                <span class="purprice">{($purchase->variant->price)|convert}</span>
                                <span class="purcurr">{$currency->sign}</span>
                                <span class="purx" style="display: none;">x</span>
                            </div>
                            {* Количество *}
                            <div class="amount" style="display: none;">
                                <input {if $purchase->variant->stock == 0}disabled{/if} type="text"
                                       name="amounts[{$purchase->variant->id}]"
                                       value="{if $purchase->variant->stock == 0}0{else}{$purchase->amount}{/if}"/>
                                <span>
									{if $purchase->variant->unit}
										{$purchase->variant->unit}
									{else}
										{$settings->units}
									{/if}
								</span>
                            </div>
                            {* Удалить из корзины *}
                            <a class="purchase-remove" href="cart/remove/{$purchase->variant->id}"></a>
                        </div>
                    </li>
                {/if}
            {/foreach}
        </ul>

        <div class="del_pay_info" style="{if $cart->total_price < $settings->minorder}display:none;{/if}">

            {if $is_shop}
                <div class="form cart_form">

                    <label></label>
                    <textarea name="comment" id="order_comment" rows="1"
                              placeholder="Комментарий к заказу">{if !empty($comment)}{$comment|escape}{/if}</textarea>

                    {include file='antibot.tpl'}

                    <input id="purchase_method"
                           name="purchase_method"
                           value="i_pickup"
                           type="hidden">
                    <input name="shop_id"
                           value="{$user->id}"
                           type="hidden">
                    <input name="name"
                           value="{$user->name}"
                           type="hidden">
                    <input type="submit" name="check_order" class="button hideablebutton" value="Заказать"/>

                    <style>
                        .check_block {
                            display: none;
                        }
                    </style>
                    <script>
                        $('.check_block input[name=bttrue]').prop('checked', true);
                    </script>
                </div>
            {else}

            {if isset($error)}
                <div class="message_error">
                    {if $error == 'empty_name'}Введите имя{/if}
                    {if $error == 'empty_phone'}Введите телефон{/if}
                    {if $error == 'invalid_phone'}Не корректный номер телефона{/if}
                    {if $error == 'captcha'}Не пройдена проверка на бота{/if}
                    {if $error == 'empty_address'}Введите адрес{/if}
                    {if $error == 'min_order'}Сумма товаров в заказе меньше минимума{/if}
                    {if $error == 'empty_shop_id'}Не найден магазин{/if}
                </div>
            {/if}

            {if isset($error_sber)}
                <h3 style="text-align: center;">Оплата онлаин не удалась поробуйте позже</h3>
                {$error_sber}
            {/if}

                <style>
                    .button-block .row {
                        justify-content: space-between;
                    }
                    .button-block .button {
                        border-color: #c1c1c1;
                        width: 48%;
                        font-size: 14px;
                    }
                    .button-block .button.active {
                        background-color: #F7BDD6;
                        border-color: #F7BDD6;
                    }

                    .purchaseslist h3 {
                        height: auto;
                    }

                    @media (max-width: 440px) {
                        .button-block .row {
                            padding: 0 10px;
                            display: block;
                        }

                        .button-block .button {
                            width: 100%;
                        }
                    }

                    .data-block {
                        padding: 20px;
                    }

                    .tab-data {
                        display: none;
                    }

                    .tab-data.active {
                        display: block;
                    }
                </style>

            {if $user}
                <div class="flex button-block">
                    <div class="row">
                        <button id="bring_me" class="button{if $purchase_method =='bring_me'} active{/if}">Доставьте мне</button>
                        <button id="i_pickup" class="button{if $purchase_method =='i_pickup'} active{/if}">Заберу в магазине</button>
                    </div>
                    <input id="purchase_method"
                           name="purchase_method"
                            {if isset($purchase_method)}
                                value="{$purchase_method|escape}"
                            {/if}
                           type="hidden">
                </div>
            {/if}
                <div class="form cart_form data-block">
                    {if $user}
                        <label for="user_phone">Телефон * </label>
                        <input id="user_phone" name="phone"
                               type="tel"
                               disabled="disabled"
                               data-format=".+"
                               value="{if !empty($phone)}{$phone|escape}{/if}"
                               data-notice="Укажите телефон"/>
                        <label for="user_name">ФИО *</label>
                        <input id="user_name" name="name" type="text"
                               value="{if !empty($name)}{$name|escape}{/if}"
                               data-format=".+"
                               data-notice="Введите ФИО"/>
                        <label for="birthday">День рождения</label>
                        <input id="birthday"
                               type="text"
                               name="user_data[birthday]"
                               value="{if !empty($user_data->birthday)}{$user_data->birthday|date}{/if}"
                               disabled="disabled"
                               style="text-align: center;">
                    {else}
                        <style>
                            #check_sms_code {
                                padding: 2px;
                                display: block;
                                background: none !important;
                                border: 1px solid #d24a46;
                                line-height: 1;
                                margin: 0 0 -29px 53px;
                            }
                            #check_sms_code svg {
                                width: 20px;
                                height: 20px;
                                cursor: pointer;
                            }
                        </style>

                        <label for="user_phone" style="width: 100px;">Телефон *</label>
                        <input id="user_phone"
                               name="phone"
                               type="tel"
                               data-format=".+"
                               value="{if !empty($phone)}{$phone|escape}{/if}"
                               style="width: 200px; margin-right: 20px;"
                               data-notice="Укажите телефон"/>

                        <div id="sms_code" class="row" style="display: none;position:relative;">
                            <label for="sms_code_input" style="width: 77px;">СМС код
                                <input id="sms_code_input"
                                       type="text"
                                       data-format=".+"
                                       data-notice="Введите код из СМС"
                                       style="width: 100px;">
                            </label>
                            <button id="check_sms_code" class="button">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.0" width="1171.000000pt" height="1280.000000pt" viewBox="0 0 1171.000000 1280.000000" preserveAspectRatio="xMidYMid meet"><g transform="translate(0.000000,1280.000000) scale(0.100000,-0.100000)" fill="green" stroke="none"><path d="M11555 12694 c-1288 -888 -2591 -2076 -3945 -3594 -1475 -1656 -3026 -3783 -4315 -5918 -72 -119 -115 -180 -123 -177 -8 3 -716 474 -1575 1048 -859 574 -1568 1047 -1576 1052 -11 6 -10 2 2 -16 98 -140 3704 -5078 3709 -5079 3 0 34 66 68 148 1225 2918 2422 5234 3838 7427 1148 1777 2481 3497 3899 5028 91 97 163 177 161 177 -2 0 -67 -43 -143 -96z"/></g></svg>
                            </button>
                        </div>

                        <p id="error" class="error" style="display: none;"></p>

                        <script src="/js/jquery/maskedinput/dist/jquery.maskedinput.min.js"></script>
                        <script>
                            jQuery(function ($) {
                                const tel = $("#user_phone");
                                tel.click(function () {
                                    $(this).setCursorPosition(3);
                                });
                                tel.mask('+7(999) 999-99-99', {
                                    completed: function () {
                                        $('#error').html('').hide();
                                        $('#sms_code').hide();
                                        $('#check_sms_code').hide();

                                        const phone = $(this).val();
                                        $.ajax({
                                            url: '/cart',
                                            method: 'POST',
                                            data: {
                                                get_code: 1,
                                                phone: phone
                                            },
                                            dataType: 'json',
                                            success: function (data) {
                                                if (data.error) {
                                                    $('#error').html(data.error).show();
                                                }
                                                if (!data.is_code) return false;
                                                $('#sms_code').show().css('display', 'flex');
                                                $('#check_sms_code').show();
                                            }
                                        });
                                    }
                                });
                                $('#check_sms_code').on('click', function () {
                                    $.ajax({
                                        url: '/cart',
                                        method: 'POST',
                                        data: {
                                            check_sms_code: 1,
                                            sms_code: $('#sms_code input').val()
                                        },
                                        dataType: 'json',
                                        success: function (data) {
                                            if (data.error) {
                                                $('#error').html(data.error).show();
                                                return false;
                                            }
                                            window.location = data.url;
                                            return false;
                                        }
                                    });
                                    return false;
                                });
                            });
                        </script>

                        <div class="flex button-block">
                            <div class="row">
                                <button id="bring_me" class="button{if $purchase_method =='bring_me'} active{/if}">Доставьте мне</button>
                                <button id="i_pickup" class="button{if $purchase_method =='i_pickup'} active{/if}">Заберу в магазине</button>
                            </div>
                            <input id="purchase_method"
                                   name="purchase_method"
                                    {if isset($purchase_method)}
                                        value="{$purchase_method|escape}"
                                    {/if}
                                   type="hidden">
                        </div>
                    {/if}

                    {if $user}
                        <div class="tab-data user-data{if $purchase_method =='bring_me'} active{/if}">
                            <div class="row">
                                <label>Адрес</label>
                            </div>
                            <div id="user_data_address">
                                <label>Область</label>
                                <input type="text" name="user_data[region]" {if isset($user_data_region)}value="{$user_data_region|escape}"{/if}>
                                <label>Район</label>
                                <input type="text" name="user_data[district]" {if isset($user_data_district)}value="{$user_data_district|escape}"{/if}>
                                <label>Город</label>
                                <input type="text" name="user_data[city]" {if isset($user_data_city)}value="{$user_data_city|escape}"{/if}>
                                <label>Улица</label>
                                <input type="text" name="user_data[street]" {if isset($user_data_street)}value="{$user_data_street|escape}"{/if}>
                                <label>Дом</label>
                                <input type="text" name="user_data[house]" {if isset($user_data_house)}value="{$user_data_house|escape}"{/if}>
                                <label>Квартира</label>
                                <input type="text" name="user_data[apartment]" {if isset($user_data_apartment)}value="{$user_data_apartment|escape}"{/if}>
                            </div>

                        </div>
                        <div class="tab-data shop-data{if $purchase_method =='i_pickup'} active{/if}">
                            <div class="row">
                                <label>Адрес</label>
                            </div>
                            <div id="shop_data_address">
                                <label>Область</label>
                                <input type="text" id="region" disabled="disabled">
                                <label>Район</label>
                                <input type="text" id="district" disabled="disabled">
                                <label>Город</label>
                                <input type="text" id="city" disabled="disabled">
                                <label>Улица</label>
                                <input type="text" id="street" disabled="disabled">
                                <label>Дом</label>
                                <input type="text" id="house" disabled="disabled">
                            </div>

                        </div>

                        <div class="all-data"{if !$purchase_method} style="display: none;" {/if}>
                            <label for="order_comment">Ваши желания</label>
                            <textarea name="comment" id="order_comment" rows="1" style="margin-bottom: 10px;">{if !empty($comment)}{$comment|escape}{/if}</textarea>
                        </div>

                        <div class="tab-data user-data{if $purchase_method =='bring_me'} active{/if}">
                            <div class="row" style="display: block; margin-top: 20px;">
                                <p>Доставка заказа от 3000 рублей по Центральному Федеральному Округу - бесплатно!</p>
                            </div>
                        </div>
                        <div class="tab-data shop-data{if $purchase_method =='i_pickup'} active{/if}">
                            <div class="row" style="display: block; margin-top: 20px;">
                                <p>✅ При получении в наших магазинах:</p>
                                <p>✅ Бесплатная доставка: 48 часов (Курск, Курская область)</p>
                                <p>✅ Заказ до трёх украшений</p>
                                <p>✅ Возможность поменять на новое изделие (30 дней)</p>
                                <p>✅ Удобные способы оплаты</p>
                                <p style="margin-left: 20px;">Кредит без переплат (6, 9, 10, 12, 18, 24 месяцев)</p>
                                <p style="margin-left: 20px;">Наличные/терминал</p>
                                <p style="margin-left: 20px;">Обмен старого золота на новое</p>
                                <p style="margin-left: 20px;">Оплата маннингами (бонусами) до 100% покупки</p>
                                <p>✅ Ремонт наших украшения - с 50% скидкой</p>
                            </div>
                        </div>

                        <div class="all-data"{if !$purchase_method} style="display: none;" {/if}>
                            {if $new_user}
                                <div class="row">
                                    <label class="button" for="get_bonus" style="width: auto; margin: 20px auto;">Получить {$bonus} манингов
                                        <input id="get_bonus" name="bonus" type="checkbox" value="{$bonus}" style="display: none;">
                                    </label>
                                </div>
                                <script>
                                    jQuery(function ($) {
                                        $('#get_bonus').on('change', function () {
                                            if ($(this).is(':checked')) {
                                                $(this).parent().hide();
                                                const total_price = parseInt('{$cart->total_price|convert}'),
                                                    total_bonus = parseInt('{$bonus}');
                                                $('.unit-price').each(function () {
                                                    const row = $(this).closest('tr');
                                                    const price = parseInt($(this).html());
                                                    let k = price / total_price;
                                                    $('.unit-bonus', row).html(Math.round(total_bonus * k));
                                                });
                                                $('#total_bonus').html(total_bonus);
                                            }
                                        });
                                    });
                                </script>
                            {else}
                            {if $user->balance > 0}
                                <div class="row">
                                    <label for="have_manning" class="totalbonuses" style="padding-bottom: 0; line-height: 24px; padding-left: 10px;">Мои маннинги</label>
                                    <input id="have_manning" type="text"  style="width: 80px;" value="{$user->balance|convert}" disabled="disabled">
                                </div>
                                <div class="row">
                                    <label for="input_bonus" style="width: 182px; padding-bottom: 0; padding-left: 10px; line-height: 24px;">Потратить Маннинги</label>
                                    <input id="input_bonus" type="text"
                                           name="bonus"
                                           style="width: 80px;"
                                           value="{if !empty($bonus)}{$bonus}{/if}"/>
                                </div>

                                {*                                        <div class="availbonuses">*}
                                {*                                            {if ($cart->total_price * $settings->bonus_limit / 100) >= $user->balance} Доступно к списанию в данном заказе {$user->balance|convert}&nbsp;{$currency->sign}*}
                                {*                                            {else}*}
                                {*                                                Доступно к списанию в данном заказе {($cart->total_price * $settings->bonus_limit / 100)|convert}&nbsp;{$currency->sign}*}
                                {*                                            {/if}*}
                                {*                                        </div>*}
                            {/if}
                                <script src="/js/jquery/maskedinput/dist/jquery.maskedinput.min.js"></script>
                                <script>
                                    jQuery(function ($) {
                                        const input_bonus = $('#input_bonus');
                                        input_bonus.click(function () {
                                            $(this).setCursorPosition(0);
                                        });
                                        input_bonus.mask('?999999', {
                                            autoclear: false,
                                            placeholder: ''
                                        });
                                        input_bonus.on('change', function () {

                                            const total_price = parseInt('{$cart->total_price|convert}');

                                            let total_bonus = Math.abs(parseInt($(this).val())),
                                                user_balance = 0;
                                            {if ($cart->total_price * $settings->bonus_limit / 100) >= $user->balance}
                                            user_balance = parseInt({$user->balance|convert});
                                            {else}
                                            user_balance = parseInt({($cart->total_price * $settings->bonus_limit / 100)|convert});
                                            {/if}

                                            if (total_bonus > user_balance) {
                                                total_bonus = user_balance;
                                                $(this).val(total_bonus);
                                            }

                                            $('.unit-price').each(function () {
                                                const row = $(this).closest('tr');
                                                const price = parseInt($(this).html());
                                                let k = price / total_price;
                                                $('.unit-bonus', row).html(Math.round(total_bonus * k));
                                            });
                                            $('#total_bonus').html(total_bonus);
                                        });
                                    });

                                </script>
                            {/if}

                            <style>
                                .row .confcheck, .row .check_block {
                                    flex: 0 0 48%
                                }
                                .row .confcheck {
                                    margin-left: 0;
                                    border: 2px solid #bcd4e4;
                                }
                                .row .check_bt {
                                    width: 100%;
                                    justify-content: center;
                                }
                            </style>

                            <div style="justify-content: space-between">
                                {include file='conf.tpl'}
                                {include file='antibot.tpl'}
                            </div>
                        </div>

                        <div class="tab-data user-data{if $purchase_method =='bring_me'} active{/if}">
                            <input {if $settings->counters || $settings->analytics}onclick="{if $settings->counters}ym({$settings->counters},'reachGoal','cart'); {/if}{if $settings->analytics}ga ('send', 'event', 'cart', 'order_button');{/if} return true;"{/if}
                                   type="submit" name="check_buy" class="button hideablebutton checkout"
                                   value="Оплатить"/>
                            <input {if $settings->counters || $settings->analytics}onclick="{if $settings->counters}ym({$settings->counters},'reachGoal','cart'); {/if}{if $settings->analytics}ga ('send', 'event', 'cart', 'order_button');{/if} return true;"{/if}
                                   type="submit" name="check_buy_credit" class="button hideablebutton checkout"
                                   value="В рассрочку"/>
                        </div>
                        <div class="tab-data shop-data{if $purchase_method =='i_pickup'} active{/if}">
                            <input {if $settings->counters || $settings->analytics}onclick="{if $settings->counters}ym({$settings->counters},'reachGoal','cart'); {/if}{if $settings->analytics}ga ('send', 'event', 'cart', 'order_button');{/if} return true;"{/if}
                                   type="submit" name="check_buy" class="button hideablebutton checkout"
                                   value="Оплатить"/>
                            <input {if $settings->counters || $settings->analytics}onclick="{if $settings->counters}ym({$settings->counters},'reachGoal','cart'); {/if}{if $settings->analytics}ga ('send', 'event', 'cart', 'order_button');{/if} return true;"{/if}
                                   type="submit" name="check_buy_credit" class="button hideablebutton checkout"
                                   value="В рассрочку"/>
                            <input {if $settings->counters || $settings->analytics}onclick="{if $settings->counters}ym({$settings->counters},'reachGoal','cart'); {/if}{if $settings->analytics}ga ('send', 'event', 'cart', 'order_button');{/if} return true;"{/if}
                                   type="submit" name="check_order" class="button hideablebutton checkout"
                                   value="Заказать"/>
                        </div>

                    {/if}

                </div>

            {if $user}
                <style>
                    #addresses_list .checkbox, #shop_list .checkbox {
                        display: none;
                    }
                </style>
                <div class="hidden" style="display: none;">
                    <div id="addresses_content" style="padding: 10px;">
                        <h2 style="text-align: center; margin-bottom: 20px;">Выберите адрес</h2>
                        <ul id="addresses_list">
                            {foreach from=$users_address_list key=hash item=$address}
                                <li style="display: flex;">
                                    <label for="address_{$hash}" style="margin-left: 10px; margin-bottom: 20px;">
                                        <span class="checkbox">
                                            <input id="address_{$hash}" type="radio" value="{$address}"/>
                                        </span>
                                        <span class="address-header">{$address}</span>
                                    </label>
                                </li>
                            {/foreach}
                            <li style="display: flex">
                                <label for="address_user_new" style="margin-left: 10px; margin-bottom: 20px;">
                                    <span class="checkbox">
                                        <input id="address_user_new" type="radio" value=""/>
                                    </span>
                                    <span class="address-header">Новый адрес</span>
                                </label>
                            </li>
                        </ul>
                    </div>
                    <div id="shops-content" style="padding: 10px;">
                        <h2 style="text-align: center; margin-bottom: 20px;">Наши магазины</h2>
                        <ul id="shop_list">
                            {foreach from=$shops_address_list key=$id item=$address}
                                <li style="display: flex">
                                    <label for="shops_{$id}" style="margin-left: 10px; margin-bottom: 20px;">
                                            <span class="checkbox">
                                                <input id="shops_{$id}" type="radio"
                                                       name="shop_id"
                                                       value="{$id}"
                                                       {if $shop_id == $id}checked{/if}
                                                       data-address="{$address}"/>
                                            </span>
                                        <span class="shop-header">{$address}</span>
                                    </label>
                                </li>
                            {/foreach}
                        </ul>
                    </div>
                </div>
                <script>
                    $(document).ready(function () {
                        const fancy_config = {
                            hideOnContentClick: false,
                            hideOnOverlayClick: false,
                            enableEscapeButton: false,
                            showCloseButton: false,
                            scrolling: 'no'
                        };
                        $('#bring_me').on('click', function () {

                            $('.all-data').show();

                            $('.button-block button').removeClass('active');
                            $(this).addClass('active');
                            $('.tab-data').removeClass('active');
                            $('.user-data').addClass('active');

                            $('#purchase_method').val($(this).attr('id'));

                            fancy_config.href = '#addresses_content';
                            $.fancybox(fancy_config);
                            $('#addresses_list input:checked').prop('checked', false);

                            return false;
                        });

                        $('#i_pickup').on('click', function () {

                            $('.all-data').show();

                            $('.button-block button').removeClass('active');
                            $(this).addClass('active');
                            $('.tab-data').removeClass('active');
                            $('.shop-data').addClass('active');

                            $('#purchase_method').val($(this).attr('id'));

                            fancy_config.href = '#shops-content';
                            $.fancybox(fancy_config);
                            $('#shop_list input:checked').prop('checked', false);

                            return false;
                        });

                        $('#addresses_list input').change(function () {
                            const value = $('#addresses_list input:checked').val(),
                                arr = value.split(', ');
                            $('#user_data_address input').each(function (index, item) {
                                $(item).val(arr[index]);
                            });
                            $.fancybox.close();
                            $('.message_error').remove();
                        });

                        set_active_shop();

                        $('#shop_list input').change(function () {
                            set_active_shop();
                            $.fancybox.close();
                            $('.message_error').remove();
                        });

                        // Заполняет поля адреса выбраного магазина
                        function set_active_shop() {
                            const value = $('#shop_list input:checked').attr('data-address'),
                                arr = value ? value.split(', ') : [];
                            $('#shop_data_address input').each(function (index, item) {
                                $(item).val(arr[index]);
                            });
                        }

                    });
                </script>
            {/if}

            {/if}

        </div>

    </form>
{else}
    В корзине нет товаров
{/if}

{literal}
    <script>
        jQuery(function ($) {
            $('.data-block input').on('change', function () {
                $('.message_error').remove();
            });
        });

        $(function () {
            $("a.zoom").fancybox({'hideOnContentClick': true});
        });

        function hideShow(el) {
            $(el).toggleText('подробнее', 'свернуть').toggleClass('show').siblings('div#hideCont').slideToggle('normal');
            return false;
        }
    </script>
{/literal}
				

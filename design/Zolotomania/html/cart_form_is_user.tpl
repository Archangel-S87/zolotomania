{if isset($error)}
    <div class="message_error">
        {if $error == 'empty_name'}Введите имя{/if}
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
    .button-block .button {
        border-color: #dbc0ce;
    }

    .button-block .button:hover {
        background-color: #dbc0ce;
    }

    .button-block .button.active {
        background-color: #dbc0ce;
    }

    .tab-data {
        display: none;
    }

    .tab-data.active {
        display: block;
    }

    #addresses_content, #shops-content {
        position: relative;
        z-index: 1;
        width: 600px;
    }

    .form-back-page {
        z-index: 5;
        top: -3px;
        right: -3px;
    }

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

<div class="flex button-block">
    <div class="row" style="justify-content: space-between">
        <button id="bring_me" class="button{if $purchase_method =='bring_me'} active{/if}" style="width: 48%;">Доставьте
            мне
        </button>
        <button id="i_pickup" class="button{if $purchase_method =='i_pickup'} active{/if}" style="width: 48%;">Заберу в
            магазине
        </button>
    </div>
    <input id="purchase_method"
           name="purchase_method"
            {if isset($purchase_method)}
                value="{$purchase_method|escape}"
            {/if}
           type="hidden">
</div>

<div class="form cart_form data-block">

    <div class="row">
        <div class="nn">1</div>
        <label for="user_phone">Телефон * </label>
        <input id="user_phone" name="phone"
               type="text"
               disabled="disabled"
               data-format=".+"
               value="{if !empty($phone)}{$phone|escape}{/if}"
               data-notice="Укажите телефон"/>
    </div>
    <div class="row">
        <div class="nn">2</div>
        <label for="user_name">ФИО *</label>
        <input id="user_name" name="name" type="text"
               value="{if !empty($name)}{$name|escape}{/if}"
               data-format=".+"
               data-notice="Введите ФИО"/>
    </div>
    <div class="row">
        <div class="nn">3</div>
        <label for="birthday">День рождения</label>
        <input id="birthday"
               type="text"
               name="user_data[birthday]"
               value="{if !empty($user_data->birthday)}{$user_data->birthday|date}{/if}"
               disabled="disabled"
               style="text-align: center;">
    </div>

    <div class="tab-data user-data{if $purchase_method =='bring_me'} active{/if}">
        <div class="row">
            <div class="nn" style="width: 24px;">4</div>
            <label>Адрес</label>
        </div>
        <div id="user_data_address">
            <div class="row">
                <div class="nn"></div>
                <label>Область</label>
                <input type="text" name="user_data[region]"
                       {if isset($user_data_region)}value="{$user_data_region|escape}"{/if}>
            </div>
            <div class="row">
                <div class="nn"></div>
                <label>Район</label>
                <input type="text" name="user_data[district]"
                       {if isset($user_data_district)}value="{$user_data_district|escape}"{/if}>
            </div>
            <div class="row">
                <div class="nn"></div>
                <label>Город</label>
                <input type="text" name="user_data[city]"
                       {if isset($user_data_city)}value="{$user_data_city|escape}"{/if}>
            </div>
            <div class="row">
                <div class="nn"></div>
                <label>Улица</label>
                <input type="text" name="user_data[street]"
                       {if isset($user_data_street)}value="{$user_data_street|escape}"{/if}>
            </div>
            <div class="row">
                <div class="nn"></div>
                <label>Дом</label>
                <input type="text" name="user_data[house]"
                       {if isset($user_data_house)}value="{$user_data_house|escape}"{/if}>
            </div>
            <div class="row">
                <div class="nn"></div>
                <label>Квартира</label>
                <input type="text" name="user_data[apartment]"
                       {if isset($user_data_apartment)}value="{$user_data_apartment|escape}"{/if}>
            </div>
        </div>

    </div>
    <div class="tab-data shop-data{if $purchase_method =='i_pickup'} active{/if}">
        <div class="row">
            <div class="nn" style="width: 24px;">4</div>
            <label>Адрес</label>
        </div>
        <div id="shop_data_address">
            <div class="row">
                <div class="nn"></div>
                <label>Область</label>
                <input type="text" id="region" disabled="disabled">
            </div>
            <div class="row">
                <div class="nn"></div>
                <label>Район</label>
                <input type="text" id="district" disabled="disabled">
            </div>
            <div class="row">
                <div class="nn"></div>
                <label>Город</label>
                <input type="text" id="city" disabled="disabled">
            </div>
            <div class="row">
                <div class="nn"></div>
                <label>Улица</label>
                <input type="text" id="street" disabled="disabled">
            </div>
            <div class="row">
                <div class="nn"></div>
                <label>Дом</label>
                <input type="text" id="house" disabled="disabled">
            </div>
        </div>

    </div>

    <div class="all-data"{if !$purchase_method} style="display: none;" {/if}>
        <div class="row">
            <div class="nn">5</div>
            <label for="order_comment">Ваши желания</label>
            <textarea name="comment" id="order_comment" rows="1"
                      style="margin-bottom: 10px;">{if !empty($comment)}{$comment|escape}{/if}</textarea>
        </div>
    </div>

    <div class="tab-data user-data{if $purchase_method =='bring_me'} active{/if}">
        <div class="row" style="display: block; margin-top: 20px; text-align: center;">
            <p>Доставка заказа от 3000 рублей по Центральному Федеральному Округу - бесплатно!</p>
        </div>
    </div>
    <div class="tab-data shop-data{if $purchase_method =='i_pickup'} active{/if}">
        <div class="row" style="display: block; margin-top: 20px; text-align: center;">
            <p>✅ При получении в наших магазинах:</p>
            <p>✅ Бесплатная доставка: 48 часов (Курск, Курская область)</p>
            <p>✅ Заказ до трёх украшений</p>
            <p>✅ Возможность поменять на новое изделие (30 дней)</p>
            <p>✅ Удобные способы оплаты</p>
            <p style="margin-left: 20px;">Рассрочка (3,6,9,12)</p>
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
                <div class="row" style="margin-top: 20px; justify-content: space-around">
                    <div class="row" style="justify-content: center">
                        <label for="have_manning" class="totalbonuses"
                               style="border: 2px solid #bcd4e4; margin-bottom: 10px; padding-bottom: 0; line-height: 24px; padding-left: 10px;">Мои
                            маннинги</label>
                        <input id="have_manning" type="text" style="width: 80px;" value="{$user->balance|convert}"
                               disabled="disabled">
                    </div>
                    <div class="row" style="justify-content: center">
                        <label for="input_bonus"
                               style="width: 182px; border: 2px solid #bcd4e4; margin-bottom: 10px; padding-bottom: 0; padding-left: 10px; line-height: 24px;">Потратить
                            Маннинги</label>
                        <input id="input_bonus" type="text"
                               name="bonus"
                               style="width: 80px;"
                               value="{if !empty($bonus)}{$bonus}{/if}"/>
                    </div>
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

        <div class="row" style="justify-content: space-between">
            {include file='conf.tpl'}
            {include file='antibot.tpl'}
        </div>
    </div>

    <div class="tab-data user-data{if $purchase_method =='bring_me'} active{/if}">
        <input {if $settings->counters || $settings->analytics}onclick="{if $settings->counters}ym({$settings->counters},'reachGoal','cart'); {/if}{if $settings->analytics}ga ('send', 'event', 'cart', 'order_button');{/if} return true;"{/if}
               type="submit" name="check_buy" class="button hideablebutton checkout"
               value="Оплата онлаин"/>
    </div>

    <div class="tab-data shop-data{if $purchase_method =='i_pickup'} active{/if}">
        <div class="row" style="justify-content: space-around;">
            <input {if $settings->counters || $settings->analytics}onclick="{if $settings->counters}ym({$settings->counters},'reachGoal','cart'); {/if}{if $settings->analytics}ga ('send', 'event', 'cart', 'order_button');{/if} return true;"{/if}
                   type="submit" name="check_buy" class="button hideablebutton checkout"
                   value="Оплата онлаин"/>
            <input {if $settings->counters || $settings->analytics}onclick="{if $settings->counters}ym({$settings->counters},'reachGoal','cart'); {/if}{if $settings->analytics}ga ('send', 'event', 'cart', 'order_button');{/if} return true;"{/if}
                   type="submit" name="check_order" class="button hideablebutton checkout"
                   value="Заказать"/>
        </div>
    </div>

</div>

<div class="hidden" style="display: none;">

    <div id="addresses_content">
        <a href="/" class="form-back-page"></a>
        <h2 style="text-align: center; margin-bottom: 20px;">Выберите адрес</h2>
        <ul id="addresses_list">
            {foreach from=$users_address_list key=hash item=$address}
                <li style="display: flex">
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

    <div id="shops-content">
        <a href="/" class="form-back-page"></a>
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
            padding: 20,
            scrolling: 'no',
        };
        $('#bring_me').on('click', function () {

            $('.all-data').show();

            $('.button-block button').removeClass('active');
            $(this).addClass('active');
            $('.tab-data').removeClass('active');
            $('.user-data').addClass('active');

            $('#purchase_method').val($(this).attr('id'));

            if ($('#addresses_list input').length > 1) {
                fancy_config.href = '#addresses_content';
                $.fancybox(fancy_config);
            }

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

        $('.form-back-page').on('click', function () {
            $.fancybox.close();
            return false;
        });
    });
</script>
